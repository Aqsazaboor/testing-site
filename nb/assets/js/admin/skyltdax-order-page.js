var orders = allorders;
console.log(orders, 'ssss');

var app = new Vue({
	el: '#skyltdaxorderapp',
	data: {
		currentorders: orders,
		currentorder: {},
		showorder: false
	}
})