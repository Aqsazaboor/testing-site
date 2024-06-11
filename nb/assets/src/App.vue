<template>
  <div>
    <section id="application" class="container-fluid vue-designer" v-cloak>
      <FontLoader :fonts="getFonts" />

      <div v-if="producOutOfStock" class="notification is-warning">
        <span v-if="getLanguageStrings.out_of_stock">{{
          getLanguageStrings.out_of_stock
        }}</span>
      </div>

      <form id="generator" class="sign-generator">
        <div
          v-if="ajaxUrl && appSettings && getSign && getFonts && getTextSizes"
          id="vue-designer"
          class="vue-designer"
        >
          <div
            class="columns has-background-white is-multiline has-border-grey"
          >
            <div class="column">
              <div class="columns designer-main-container">
                <MobileToolbar
                  :currentDesign="currentDesign"
                  :languageStrings="getLanguageStrings"
                  @clearDesign="clearSavedDesign"
                />

                <Designer
                  :aggregatedPrice="aggregatedPrice"
                  :appSettings="appSettings"
                  :getSign="getSign"
                  :getFonts="getFonts"
                  :getTextSizes="getTextSizes"
                  :languageStrings="getLanguageStrings"
                  :currentDesign="currentDesign"
                  :textRows="textRows"
                  :advancedEditor="advancedEditor"
                  :priceObject="priceObject"
                  @addToCart="addtocart"
                />

                <div
                  v-if="getLanguageStrings.designer_tip"
                  class="switch-sign-message"
                >
                  <p>{{ getLanguageStrings.designer_tip }}</p>
                </div>

                <DesignerSidebar
                  :appSettings="appSettings"
                  :getSign="getSign"
                  :getFonts="getFonts"
                  :getTextSizes="getTextSizes"
                  :languageStrings="getLanguageStrings"
                  :currentDesign="currentDesign"
                  :savedTextrows="textRows"
                  :advancedEditor="advancedEditor"
                  @changeFontTextsize="changeFont"
                  @changeTextRows="changeTextRows"
                />

                <ImageGenerator
                  :appSettings="appSettings"
                  :getSign="getSign"
                  :textRows="textRows"
                  :currentDesign="currentDesign"
                  :advancedEditor="advancedEditor"
                  :getTextSizes="getTextSizes"
                  :languageStrings="getLanguageStrings"
                />
              </div>
            </div>

            <MediaGallery
              v-if="getGalleryImages()"
              :galleryImages="getGalleryImages()"
              @dialogHandler="openDialog"
              :dialogOpen="dialogToggle"
            />
          </div>
        </div>
      </form>

      <ProductInformation
        :getSign="getSign"
        :languageStrings="getLanguageStrings"
        :settings="appSettings"
        :siteSettings="getSiteSettings"
      />

      <ProductInformationMobile
        :getSign="getSign"
        :languageStrings="getLanguageStrings"
        :settings="appSettings"
        :siteSettings="getSiteSettings"
      />
    </section>
  </div>
</template>

<script>
const url = ajax.ajaxurl;
const getsign = signobj;
const getfonts = settings.fonts;
const getsizes = settings.textsizes;
const appsettings = settings;
const sitesettings = siteSettings;
const languageStrings = language_string;
const productLanguageStrings = product_language_strings;

import FontLoader from "./components/font-loader/FontLoader.vue";
import Designer from "./components/designer/Designer.vue";
import DesignerSidebar from "./components/designer-sidebar/DesignerSidebar.vue";
import MobileToolbar from "./components/mobile-toolbar/MobileToolbar.vue";
import ProductInformation from "./components/product-information/ProductInformation.vue";
import ProductInformationMobile from "./components/product-information/ProductInformationMobile.vue";
import MediaGallery from "./components/media-gallery/MediaGallery.vue";
import ImageGenerator from "./components/image-generator/ImageGenerator.vue";
import FastTools from "./components/fast-tools/FastTools.vue";

import getFontTrueSizeMixin from "./components/mixins/getFontTrueSizeMixin";

export default {
  name: "App",
  components: {
    FontLoader,
    Designer,
    DesignerSidebar,
    ProductInformation,
    ProductInformationMobile,
    MobileToolbar,
    FastTools,
    ImageGenerator,
    MediaGallery,
  },
  mixins: [getFontTrueSizeMixin],
  data() {
    return {
      count: 0,
      ajaxUrl: "",
      producOutOfStock: false,
      appSettings: {},
      getSiteSettings: {},
      getSign: {},
      getFonts: {},
      getTextSizes: {},
      getLanguageStrings: {},
      signWidth: 0,
      signHeight: 0,
      advancedEditor: false,
      carturl: "",
      currentDesign: {}, // App owns the currentDesign object
      orderData: {},
      addedToCart: false,
      realsignicon: "",
      textRows: [],
      redirectOnAddToCart: true,
      aggregatedPrice: 0,
      initialState: {
        font: {
          name: "Roboto",
          slug: "roboto",
          bold: 0,
          italic: 0,
          simple: 1,
        },
        fontSize: 21.3,
        fontMmSize: 6.5,
        fontBold: false,
        fontItalic: false,
        textalign: "center",
        uppercase: false,
        lineHeight: 0,
        textoffset: 0,
        interface: "none",
        signicon: "none",
        engraving_type: "",
      },
      textsizeFee: false,
    };
  },
  created() {
    // --------------------------------------------------------------------------
    // Get querystring
    // --------------------------------------------------------------------------
    const params = new URLSearchParams(window.location.search);

    if (params.has("advanced")) {
      this.advancedEditor = true;
    }
  },
  mounted() {
    const vm = this;

    // Setup vars
    vm.ajaxUrl = url;
    vm.appSettings = appsettings;
    vm.getSiteSettings = sitesettings;
    vm.getSign = getsign;
    if (languageStrings && productLanguageStrings) {
      const mergeLanguageString = {
        ...languageStrings,
        ...productLanguageStrings,
      };
      vm.getLanguageStrings = mergeLanguageString;
    } else {
      vm.getLanguageStrings = languageStrings;
    }

    vm.sign = this.getSign ? this.getSign : {};
    vm.signWidth = this.getSign.realwidth;
    vm.signHeight = this.getSign.realheight;

    // Handle text sizes, remove big ones for brass
    const enablebigSizesForAll = true;
    if (!enablebigSizesForAll) {
      const sizesArray = [];
      Object.entries(getsizes).map((sizeItem) => {
        if (
          Number(this.getSign.designertype) === 2 &&
          sizeItem[1].simple !== 1
        ) {
        } else {
          sizesArray.push(sizeItem[1]);
        }
      });
      vm.getTextSizes = sizesArray.length > 0 ? sizesArray : [];
    } else {
      vm.getTextSizes = getsizes;
    }

    // --------------------------------------------------------------------------
    // Handle fonts
    // --------------------------------------------------------------------------
    const fontsArray = [];
    Object.entries(getfonts).map((fontItem) => {
      if (Number(this.getSign.designertype) === 2 && fontItem[1].simple !== 1) {
      } else {
        fontsArray.push(fontItem[1]);
      }
    });
    vm.getFonts = fontsArray.length > 0 ? fontsArray : [];

    vm.producOutOfStock =
      this.getSign.stockstatus === "outofstock" ? true : false;

    // --------------------------------------------------------------------------
    // Settings
    // vm.settings = this.appSettings;
    // --------------------------------------------------------------------------
    vm.carturl = this.appSettings.carturl;

    vm.onlyLaser = this.getSign.onlylaser === "yes" ? true : false;
    vm.signInterface = this.getSign.interfaces
      ? JSON.parse(this.getSign.interfaces)
      : {};

    // --------------------------------------------------------------------------
    // Sign image
    // --------------------------------------------------------------------------
    vm.image = vm.getSign.image ? vm.getSign.image : {};
    vm.imagewidth = vm.getSign.imagewidth ? vm.getSign.imagewidth : 0;
    vm.imageheight = vm.getSign.imageheight ? vm.getSign.imageheight : 0;
    vm.signinfo = vm.getSign.desc ? vm.sign.desc : "";

    vm.realPrice = this.getSign.price ? Number(this.getSign.price) : 0;
    vm.salePrice = this.getSign.saleprice ? Number(this.getSign.saleprice) : 0;

    const getSavedData = window.localStorage.getItem("design");

    // Check if fetched data is ok
    function isJsonString(str) {
      try {
        JSON.parse(str);
      } catch (e) {
        return false;
      }
      return true;
    }
    const savedDesign =
      getSavedData && isJsonString(getSavedData)
        ? JSON.parse(getSavedData)
        : {};
    if (
      savedDesign &&
      savedDesign !== undefined &&
      savedDesign !== null &&
      typeof savedDesign === "object" &&
      Object.values(savedDesign).length > 0
    ) {
      this.preCheckFont(savedDesign.design);
      if (
        Number(this.getSign?.designertype) === 2 &&
        savedDesign?.design?.font?.simple === 0
      ) {
        savedDesign.design.font = this.initialState.font;
      }

      vm.currentDesign = savedDesign.design;
      vm.textRows = savedDesign.textrows;

      // Remove bold and italic if font dont have it
      // if (vm.currentDesign?.fontBold && !vm.currentDesign?.font?.bold) {
      //   console.log("Bold but font dont have bold...");
      //   vm.currentDesign.fontBold = false;
      // }
      // if (vm.currentDesign?.fontItalic && !vm.currentDesign?.font?.italic) {
      //   vm.currentDesign.fontItalic = false;
      // }

      // Loop text rows, add to form input
      // Force text size down if sign can't have it.
      const largestAllowedTextSize =
        vm.getTextSizes[vm.getTextSizes.length - 1]?.truesize;
      if (vm.currentDesign?.fontSize > Number(largestAllowedTextSize)) {
        const realSize = vm.getFontTrueSizeMixin(
          vm.getTextSizes,
          vm.currentDesign.fontSize
        );
        vm.currentDesign.fontSize = largestAllowedTextSize;
        vm.currentDesign.fontMmSize = realSize.name;
      }
      vm.updateOrderObject();
    } else {
      // Setup default data
      vm.currentDesign = this.initialState;
      vm.updateOrderObject();
    }

    // Pust visit to data layer
    vm.pushToDataLayer("view_item");
  },

  methods: {
    // --------------------------------------------------------
    // State changes
    // --------------------------------------------------------
    changeFont(event) {
      this.currentDesign = event;
      this.updateOrderObject();
    },

    changeTextRows(event) {
      this.textRows = event;
      this.updateOrderObject();
    },

    applyDefaultOptions() {
      // --------------------------------
      // Init font, setup base
      // --------------------------------
      //   const firstKey = Object.keys(getfonts)[0];
      //   this.font = getfonts[firstKey];
      //   this.textattr = this.textsize + "px " + this.font.slug;
      //   this.updateOrderObject();
    },

    saveDesignInLocalStorage(saveData) {
      // -----------------------------------------------
      // Save state in localStorage
      // -----------------------------------------------
      //   if (typeof saveData !== "object") {
      //     console.log("error, currentData object does not exist");
      //     return false;
      //   } else {
      //     // The data to save
      //     // Don't save it all, let the editor handle all the logic from a small object
      //   }
      window.localStorage.setItem("design", JSON.stringify(saveData));
      this.hasSavedData = true;
    },

    applySavedDesign(savedDesignObj) {
      //   // --------------------------------------------------
      //   // Get design on start
      //   // --------------------------------------------------
      //   const vm = this;
      //   const applySavedDesign = JSON.parse(savedDesignObj);
      //   if (
      //     applySavedDesign.signid === "" ||
      //     applySavedDesign.signid === "null"
      //   ) {
      //     return false;
      //   }
      //   vm.font = applySavedDesign.font;
      //   vm.textsize = applySavedDesign.fontsize;
      //   vm.textalign = applySavedDesign.textalign;
      //   vm.uppercase = applySavedDesign.uppercase;
      //   vm.fontitalic = applySavedDesign.italic;
      //   vm.fontbold = applySavedDesign.bold;
      //   vm.ffholesnum = applySavedDesign.holes;
      //   vm.offset = applySavedDesign.offset;
      //   vm.orderData = applySavedDesign;
      //   // This doesnt work:
      //   vm.textRows = applySavedDesign.rows;
      //   applySavedDesign.rows.map((row, index) => {
      //     if (row.length > 0) {
      //       vm.textRows[index] = row;
      //     }
      //   });
      //   // Let the updateOrderObj handle the update after...
      //   // Needs next tick to work... But, sometimes the font is not loaded... And that makes this buggy.
      //   this.$nextTick(() => {
      //     // vm.updateOrderObject();
      //     setTimeout(() => {
      //       // Make sure sign renders...
      //       // vm.updateSignImage();
      //     }, 200);
      //   });
    },

    preCheckFont(designObject) {
      // First check if the current sign can take the font
      if (
        Number(this.getSign?.designertype) === 2 &&
        designObject?.design?.font?.simple === 0
      ) {
        // If the sign does not take that Font, set it to initial state for font
        designObject.design.font = this.initialState.font;
      }

      return designObject;
    },

    // Gallery
    getGalleryImages() {
      return this.getSign?.gallery ? this.getSign.gallery : null;
    },

    checkIfLaser() {
      if (
        this.getSign?.productmaterial.toLowerCase() !== "plastic" &&
        (this.currentDesign.fontSize < 24 || this.currentDesign.fontSize > 45.2)
      ) {
        return true;
      }
      return false;
    },

    // --------------------------------------------------------
    // Price
    // --------------------------------------------------------

    calculateprice() {
      const vm = this;
      let currentPrice = Number(vm.getSign?.price);
      const salePrice = Number(vm.getSign?.saleprice);
      const textSize = vm.currentDesign?.fontSize;
      const largeExtraPrice = Number(vm.appSettings?.largeextraprice);
      const rowExtraPrice = Number(vm.appSettings?.rowextraprice);
      const textRowsLength = vm.textRows?.length;

      if (
        typeof salePrice === "number" &&
        salePrice !== undefined &&
        salePrice !== 0
      ) {
        currentPrice = Number(salePrice);
      }

      // No extra fee
      // Designer type = 0 is from the shelf and has no extra charge for text sizes
      // Designer type = 1 is plastic and has no extra charge for text sizes
      // Designer type = 2 is brass and has extra charge for text sizes
      const designerType = Number(vm.getSign?.designertype);
      if (this.textsizeFee && designerType !== 1) {
        if (
          textSize !== undefined &&
          typeof textSize === "number" &&
          textSize > 24.2
        ) {
          if (textRowsLength > 0) {
            currentPrice = currentPrice + largeExtraPrice;
          }
        }
      }

      // Only charge for more lines than 2...
      let countTextRows = 0;
      vm.textRows.map((rowContent) => {
        if (rowContent.length > 0) {
          countTextRows = countTextRows + 1;
        }
      });

      if (countTextRows > 2) {
        vm.textRows.map((textRow, index) => {
          if (index > 1 && textRow.length > 0) {
            currentPrice = currentPrice + rowExtraPrice;
          }
        });
      }

      // Text rows, count used... And add extra price on the ones that cost extra
      vm.aggregatedPrice = currentPrice;
    },

    // ---------------------------------------------------------------
    // Tools
    // ---------------------------------------------------------------

    getFontTrueSize(sizePx) {
      const textSizesObj = this.getTextSizes;
      return Object.values(textSizesObj).filter((size) => {
        return Number(size.truesize) === sizePx;
      });
    },

    // Convert font size mm to pixels
    convertMmToPixels() {
      const realTextSize = this.getFontTrueSize(this.textsize);
      const sizeInPixels = Number(realTextSize.name) * this.apixel;
      return sizeInPixels;
    },

    clearSavedDesign() {
      const vm = this;
      vm.hasSavedData = false;
      vm.fontitalic = false;
      vm.fontbold = false;
      vm.uppercase = false;
      vm.textRows = [];

      // Clear localStorage
      window.localStorage.removeItem("design");
    },

    updateOrderObject() {
      const vm = this;

      const currentDataObj = {
        design: vm.currentDesign,
        textrows: vm.textRows,
      };
      vm.orderData = currentDataObj;
      this.saveDesignInLocalStorage(currentDataObj);

      // Calculate price
      this.calculateprice();
    },

    jsonToQueryString(json) {
      // Make string from json
      return Object.keys(json)
        .map(function (key) {
          return encodeURIComponent(key) + "=" + encodeURIComponent(json[key]);
        })
        .join("&");
    },

    pushToDataLayer(event) {
      if (
        event === null ||
        event === undefined ||
        window === undefined ||
        typeof window?.dataLayer !== "object"
      ) {
        return false;
      }
      const currentProduct = this.getSign;
      const siteCurrency = this.appSettings.sitecurrency;

      if (event === "add_to_cart") {
        window?.dataLayer?.push({
          event: "add_to_cart",
          ecommerce: {
            items: [
              {
                item_name: currentProduct.name,
                item_id: currentProduct.id,
                price: currentProduct.price,
                // item_brand: "PARKA4LIFE",
                // item_category: "Apparel",
                item_variant: `${currentProduct.productmaterial} - ${currentProduct.productcolor}`,
                quantity: "1",
                currencyCode: siteCurrency,
              },
            ],
          },
        });
      } else if (event === "view_item") {
        window?.dataLayer?.push({
          event: "view_item",
          ecommerce: {
            detail: {
              // actionField: { list: "Apparel Gallery" }, // 'detail' actions have an optional list property.
              products: [
                {
                  name: currentProduct.name,
                  id: currentProduct.id,
                  price: currentProduct.price,
                  // brand: "Google",
                  // category: "Apparel",
                  item_variant: `${currentProduct.productmaterial} - ${currentProduct.productcolor}`,
                  currencyCode: siteCurrency,
                },
              ],
            },
          },
        });
      }
    },

    async addtocart(event) {
      // -----------------------------------------------
      // Finally, Add to cart
      // -----------------------------------------------

      const vm = this;
      vm.addedToCart = true;
      if (vm.offset == 0) {
        vm.offset = false;
      }

      const canvas = document.getElementById("generator-canvas");
      const dataURL = canvas.toDataURL();
      const product_qty = 1;
      const product_id = vm.getSign.id;
      const designData = vm.orderData.design;
      const textData = vm.orderData.textrows;
      let order_interface = vm.signInterface[0];
      const textSizeTrue = designData?.fontSize
        ? vm.getFontTrueSize(designData.fontSize)
        : 0;

      let boldIsEnabled = false;
      if (designData.fontBold && designData.font.bold === 1) {
        boldIsEnabled = true;
      } else if (designData.fontBold && designData.font.bold === 0) {
        boldIsEnabled = false;
      }

      // Checka if fonten har bold eller italic i sig. Sätt false om inte...
      let addToCart = {
        action: "woocommerce_ajax_add_to_cart",
        product_id: product_id,
        product_sku: "sign" + product_id,
        quantity: product_qty,
        id: product_id,

        textrow1:
          textData[0] !== undefined && designData.uppercase
            ? textData[0].toUpperCase()
            : textData[0],
        textrow2:
          textData[1] !== undefined && designData.uppercase
            ? textData[1].toUpperCase()
            : textData[1],
        textrow3:
          textData[2] !== undefined && designData.uppercase
            ? textData[2].toUpperCase()
            : textData[2],
        textrow4:
          textData[3] !== undefined && designData.uppercase
            ? textData[3].toUpperCase()
            : textData[3],
        textrow5:
          textData[4] !== undefined && designData.uppercase
            ? textData[4].toUpperCase()
            : textData[4],

        font: designData.font.name ? designData.font.name : "",
        textsize: textSizeTrue[0]?.name ? textSizeTrue[0].name : "",
        textbold: boldIsEnabled ? 1 : 0,
        textitalic: designData.fontItalic ? 1 : 0,
        textalignment: designData.textalign ? designData.textalign : "center",
        textoffset: vm.offset ? vm.offset : "",
        textuppercase: designData.uppercase ? designData.uppercase : "",
        interface: order_interface,
        signicon: vm.realsignicon ? vm.realsignicon : "",
        engravingtype: !this.checkIfLaser()
          ? designData.engraving_type
          : "laser",

        // Create PNG from the canvas
        oi: dataURL,
        sxnonce: ajax.sxnonce,
      };

      const addToCartToString = vm.jsonToQueryString(addToCart);

      // Pust to datalayer
      vm.pushToDataLayer("add_to_cart");

      await axios({
        method: "post",
        url: url,
        data: addToCartToString,
      })
        .then((response) => {
          if (vm.redirectOnAddToCart) {
            window.location.href = vm.carturl;
          }
        })
        .catch((err) => {
          console.log(err);
        });

      return false;
    },
  },
};
</script>

<style scoped lang="scss">
.vue-designer {
  & > div {
    margin-top: 0;
  }
}

.designer {
  &-main-container {
    display: flex;
    flex-direction: column;

    @media (min-width: 768px) {
      flex-direction: row;
    }
  }

  @media (max-width: 768px) {
    &-mobile-toolbar {
    }

    &-sidebar {
      order: 2;
    }

    &-result {
      padding: 30px 20px;
      order: 1;
    }

    &-add-to-cart {
      order: 3;
    }
  }
}

.sign-generator {
  @media (max-width: 768px) {
    margin-bottom: 10px;
  }
}
</style>
