import "./components/BulmaModal.js";

if(document.getElementById("checkout-container")){
	
	function kcoSuspend(autoResumeBool) {
		if ( window._klarnaCheckout ) {
			window._klarnaCheckout( function( api ) {
				api.suspend({
					autoResume: {
					  enabled: autoResumeBool
					}
				  });
			});
		}
	}
	
	function kcoResume() {
		if ( window._klarnaCheckout ) {
			window._klarnaCheckout( function( api ) {
				api.resume();
			});
		}
	};
	
	const checkoutObj = cart ? cart : {};
	const localObj = localSettings ? localSettings : {};
	const languageObj = langContext ? langContext : {};
	const fontsObj = designerData ? designerData : {};
	
	const currentLanguageBlob = languageObj.filter( (lang) => {
		return lang.langid === localObj.lang;
	});
	
	new Vue({
		el: '#checkout',
		data: {
			currency: '',
			lang: '',
			siteid: 0,
			
			settings: {},
			cart: {},
			language: {},
			debug: false,
			
			cartTotal: {},
			
			systemCartTotal: 0,
			systemCartVat: 0,
			systemCartSum: 0,
			error: false,
			
			allFonts: {},
			
			modalToggle: false,
			modalContent: ''
		},
		
		created: function() {
			const vm = this;
			
			if( typeof localObj !== 'undefined' ) {
				vm.lang = localObj.lang; // Lang string
				vm.siteid = localObj.siteid; // Site id
				vm.currency = localObj.currency; // Currency
			} else {
				throw new Error('Something went wrong with fetching the data!'); 
			}
			
			if( typeof localObj !== 'undefined' ) {
				vm.settings = localObj;
			} else {
				throw new Error('Something went wrong with fetching the local data!'); 
			}
			
			if( typeof currentLanguageBlob !== 'undefined' && currentLanguageBlob.length > 0 ) {
				vm.language = currentLanguageBlob[0].strings;
			} else {
				throw new Error('Something went wrong with language data! Not found.'); 
			}			

			// Get all fonts
			if( typeof fontsObj !== 'undefined' && Object.keys(fontsObj.fonts).length > 0 ) {
				vm.allFonts = fontsObj.fonts;
			} else {
				throw new Error('Something went wrong with fonts data! No fonts found.'); 
			}
			
			if( typeof checkoutObj !== 'undefined' ) {
				vm.cart = checkoutObj;
				this.updateCart(checkoutObj);
			} else {
				throw new Error('Something went wrong with fetching the cart data!'); 
			}
		},
		
		methods: {
			
			// Modal
			toggleModal: function(data) {
				this.modalToggle = true;
				this.modalContent = data;
			},

			updateCart: function() {
				const vm = this;
				
				vm.formatCartSums(checkoutObj.total);
				vm.thisCart();
			},
			
			thisCart: function() {
				const vm = this;
				
				vm.systemCartTotal = vm.cart.total;
			},
			
			// Fix currency function
			localCurrency: function(sum) {
				let currencyFix;
				switch(this.settings.currency) {
					case 'SEK':
						return (sum/100) + ' kr';
					case 'EUR':
						return (sum/100) + ' €';
					case 'DKK':
						return (sum/100) + ' kr';
					case 'GBP':
						return ' £' + (sum/100);
						// £
				}
			},
			
			// Save in localStorage
			saveDesignInLocalStorage: function(signObject) {
				if( Number(signObject.model.designer_id) !== 0) {
					const currentData = {};
					currentData.id = signObject.relid;
					currentData.properties = signObject.properties;
					currentData.additionalproperties = signObject.additionalproperties;
					window.localStorage.setItem('design', JSON.stringify(currentData));
					
					const returnUrl = this.settings.designerUrl+signObject.model.url;
				}
			},
			
			calculatePrice: function(basePrice, additionalProperties, amount) {
				let extrasCost = 0;
				
				if(additionalProperties === null) return Number(basePrice) * amount;

				// New way to calculate extras
				if( additionalProperties.length !== null && additionalProperties.length > 0) {
					extrasCost = Object.keys(additionalProperties).reduce(function (previous, key) {
						return previous + additionalProperties[key].cost;
					}, 0);
				}
				
				return ( Number(basePrice) + extrasCost ) * amount;
			},
			
			// Test
			increaseExistingItem: async function(id) {
				const vm = this;		
				
				if(id) {
					kcoSuspend( true );
					
					const headers = {
						headers: {
							'Content-Type': 'json'
						}
					}
					const params = { relID: Number(id) };
					
					// must have 'url', params, { headers } to work
					const addItemInCart = await axios.post('/api/?action=addItemInCart', params, { headers })
					
					.then(function (response) {
						return response.data;
					})
					.then(function(data) {
						
						if(data.cartobject) {
							vm.error = false;
							vm.cart = data.cartobject;
							kcoResume();
						} else {
							vm.error = true;
						}
					})
					.catch(function (error) {
						vm.error = true;
						console.log('err', error);
					});
				}
				
			},
			
			decreaseExistingItem: async function(id) {
				const vm = this;
				
				if(id) {
					kcoSuspend( true );
					
					const headers = {
						headers: {
							'Content-Type': 'json'
						}
					}
					const params = { relID: Number(id) };
					
					// must have 'url', null, { headers, params }
					const subtractItemInCart = await axios.post('/api/?action=subtractItemInCart', null, { headers, params })
					
					.then(function (response) {
						return response.data;
					})
					.then(function (data) {
						if(data.cartobject) {
							vm.error = false;
							vm.cart = data.cartobject;
							kcoResume();
						} else {
							vm.error = true;
							console.log('Something went wrong, cant update cart!');
						}
									
					})
					.catch(function (error) {
						vm.error = true;
						console.log('err', error);
					});					
				}

				
			},
			
			removeItem: async function(id) {
				const vm = this;				
				
				let confirmDelete = confirm("Vill du ta bort produkten?");
				
				if (confirmDelete) {
					kcoSuspend( true );
					
					const headers = {
						headers: {
							'Content-Type': 'json'
						}
					}
					const params = { relID: Number(id) };
					
					const removeItemFromCart = await axios.post('/api/?action=removeItemFromCart', null, { headers, params })
					
					.then(function (response) {
						return response.data;
					})
					.then(function (data) {

						if(data.cartobject) {
							vm.error = false;
							vm.cart = data.cartobject;
							kcoResume();
						} else {
							vm.error = true;
							console.log('Something went wrong, cant update cart!');
						}
						
					})
					.catch(function (error) {
						vm.error = true;
						console.log('err', error);
					});				
				}
			},
			
			orderDetails: function(orderItem) {
				let orderDetails = {};
				let orderItemFonts = [];
				let orderTextSizes = [];
				
				if(orderItem.properties && orderItem.properties !== null) {
					orderItem.properties.map((item) => {
						let orderItemSpecs = {}
						
						orderItemSpecs.font = item.font;
						orderItemSpecs.size = item.size;
						
						if(orderItemFonts.indexOf(item.font) === -1) {
							orderItemFonts.push(item.font);
						}
						if(orderTextSizes.indexOf(item.size) === -1) {
							orderTextSizes.push(item.size);
						}

					});
				}
				
				orderDetails.fonts = orderItemFonts;
				orderDetails.textsizes = orderTextSizes;				
				
				return orderDetails;
			},
			
			// Add Ingen reklam tack to cart
			addProductToCart: async function(itemid) {
				const vm = this;
				
				if(itemid !== null) {
					kcoSuspend( true );
					
					const headers = {
						headers: {
							'Content-Type': 'json'
						}
					}
					// This API endpoint uses itemID
					const params = { itemID: Number(itemid) }					

					const addItemToCart = await axios.post('/api/?action=addItemToCart', null, { headers, params })
					
					.then(function (response) {
						return response.data;
					})
					.then( function (data) {
												
						if(data.cartobject && data.cartobject !== undefined) {
							vm.error = false;
							vm.cart = data.cartobject;
							kcoResume();
						} else {
							vm.error = true;
							console.log('Something went wrong, cant update cart!');
						}
						
					})
					.catch( function (error) {
						vm.error = true;
						console.log(error);
					});
					
				} else {
					console.log('Error occured when adding item to cart!');
				}
			},
			
			formatCartSums: function(total) {
				if( typeof(total) === 'number' ) {
					let vat = total * 0.8;
					let sum = total - vat;
					
					this.systemCartTotal = total;
					this.systemCartSum = sum;
					this.systemCartVat = vat;

				} else {
					throw 'Total is not a number';
				}
			},
			
			formatMoney: function(sum, country) {
				switch(country) {
					case 'sv':
						return sum.toLocaleString('sv-SE', {
							style: 'currency',
							currency: 'SEK',
							minimumFractionDigits: 0,
							maximumFractionDigits: 2
						});
					case 'de':
						return sum.toLocaleString('de-DE', {
							style: 'currency',
							currency: 'EUR',
							minimumFractionDigits: 0,
							maximumFractionDigits: 2
						});
					//'de-DE', { style: 'currency', currency: 'EUR' }));
					case 'dk':
						return sum.toLocaleString('en-DK', {
							style: 'currency',
							currency: 'DKK',
							minimumFractionDigits: 0,
							maximumFractionDigits: 2
						});
					case 'en':
						return sum.toLocaleString('en-GB', {
							style: 'currency',
							currency: 'GBP',
							minimumFractionDigits: 0,
							maximumFractionDigits: 2
						});
					case 'fi':
						return sum.toLocaleString('fi-FI', {
							style: 'currency',
							currency: 'EUR',
							minimumFractionDigits: 0,
							maximumFractionDigits: 2
						});
					case 'nl':
						return sum.toLocaleString('nl-NL', {
							style: 'currency',
							currency: 'EUR',
							minimumFractionDigits: 0,
							maximumFractionDigits: 2
						});
					default:
						return sum.toLocaleString('de-DE', {
							style: 'currency',
							currency: 'EUR',
							minimumFractionDigits: 0,
							maximumFractionDigits: 2
					});
				}
			},
		},
		
		computed: {

			sumTotal: function() {
				const vm = this;
				const cartObj = vm.cart.signs;
				const shipping = vm.cart.shipping;
				let totalCart = 0;
				
				// Sum cart
				let sumCart = cartObj.reduce( ( prevValue, currValue ) => {
					var extraStuff = 0;
					
					if(currValue.additionalproperties !== null && currValue.additionalproperties > 0) {
						extraStuff = currValue.additionalproperties.reduce((pv, cv) => {
							return pv + cv.cost;
						}, 0);
					}
					return prevValue + (Number(currValue.model.price) * Number(currValue.amount)) + (extraStuff * Number(currValue.amount));
				}, 0);
				
				// Add shipping
				totalCart = sumCart + shipping;

				// Calculate VAT 25%
				const vat = totalCart - (totalCart * 0.8);
				
				// Sum ex VAT 25%
				const sum = totalCart * 0.8;
				
				let cartTotalObj = {
					shipping: vm.cart.shipping/100,
					vat: vat/100,
					sum: sum/100,
					total: totalCart/100
				}
				
				return cartTotalObj;
			}

		}
		
	});

}