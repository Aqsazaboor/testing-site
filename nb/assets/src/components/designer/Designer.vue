<template>
  <div class="designer-add-to-cart">
    <div
      class="order-checkout"
      :class="producOutOfStock ? 'product-out-of-stock' : ''"
    >
      <div class="price-group">
        <div
          itemprop="offers"
          itemscope="itemscope"
          itemtype="http://schema.org/Offer"
          class="price"
          style="vertical-align: sub"
        >
          <span class="price-group-real-price" v-if="getSign.saleprice !== '0'"
            >{{ getSign.price }}
            <span
              v-if="languageStrings.currency_symbol"
              v-html="languageStrings.currency_symbol"
            ></span></span
          ><span itemprop="price"
            >{{ aggregatedPrice }}
            <span
              v-if="languageStrings.currency_symbol"
              v-html="languageStrings.currency_symbol"
            ></span>
          </span>
        </div>
        <div class="price-vat">
          <span itemprop="price">{{ calculateVat(aggregatedPrice) }}</span>
          <span v-if="languageStrings.ex_vat">
            {{ languageStrings.ex_vat }}</span
          >
        </div>
      </div>

      <div class="add-to-cart-group">
        <button
          :disabled="addedToCart || producOutOfStock"
          class="button is-primary"
          @click.prevent="addCurrentToCart"
        >
          <span v-if="!producOutOfStock">{{
            languageStrings.add_to_cart
          }}</span>
          <span v-if="producOutOfStock">{{
            languageStrings.out_of_stock
          }}</span>
        </button>
      </div>
    </div>
  </div>
</template>

<script>
import calculateVat from "../mixins/calculateVat";

export default {
  name: "Designer",
  props: {
    advancedEditor: {
      type: Boolean,
      default: false,
    },
    appSettings: {
      type: Object,
      default: {},
    },
    getSign: {
      type: Object,
      default: {},
    },
    getTextSizes: {
      type: Object,
      default: {},
    },
    getFonts: {
      type: Object,
      default: {},
    },
    currentDesign: {
      type: Object,
      default: {},
    },
    languageStrings: {
      type: Object,
      default: {},
    },
    aggregatedPrice: {
      type: String,
      default: 0,
    },
    textRows: {
      type: Array,
      default: [],
    },
  },
  mixins: [calculateVat],
  data() {
    return {
      // fixed
      // freeform
      settings: {},
      carturl: {},
      addedToCart: false,
      realsignicon: false,
      textuppercase: false,
      redirectOnAddToCart: true,

      // Editor UI
      showLineHeight: false,
      showTextAlignment: false,
      onlyLaser: false,

      // Sign
      sign: {},
      signwidth: 0,
      signheight: 0,
      sizes: {},

      signalert: "",

      // Price
      order: {},
      orderextras: {},
      realPrice: 0,
      salePrice: 0,
      signInterface: [],
      hasSavedData: false,
      debug: true,
      producOutOfStock: false,
    };
  },

  mounted() {
    // Get order object, and update text rows...
    this.producOutOfStock =
      this.getSign.stockstatus === "outofstock" ? true : false;
  },

  computed: {
    parseSignDescription() {
      return this.sign.description.replace(/&quot;/g, "");
    },
  },

  methods: {
    addCurrentToCart() {
      this.$emit("addToCart");
    },

    setfont() {
      // -------------------------------------------------
      // Fonts, handle weights, reset etc
      // -------------------------------------------------

      let font;
      const fontbase = this.font.slug;

      // Remove font variant if font doesnt have this variant
      if (this.font.italic == 0) {
        this.fontitalic = false;
      }
      if (this.font.bold == 0) {
        this.fontbold = false;
      }

      // Put together the font and it's weight
      if (this.fontitalic && this.fontbold) {
        font = fontbase + "bolditalic";
      } else if (this.fontitalic) {
        font = fontbase + "italic";
      } else if (this.fontbold) {
        font = fontbase + "bold";
      } else {
        font = fontbase;
      }

      this.textattr = this.textsize + "px " + font;
    },
    updateOrderObject() {},
    exportToSvg() {
      // Todo export to SVG with text in outlines
      // https://github.com/fabricjs/fabric.js/issues/100
      const editorCanvas = this.editorCanvas;
      console.table(editorCanvas.toSVG());
    },
  },
};
</script>

<style scoped lang="scss">
.designer-add-to-cart {
  @media (max-width: 768px) {
    width: 100%;
    max-width: 100%;
    padding: 16px 0 8px 0;

    .order-checkout {
      display: flex;
    }
  }
  .order-checkout {
    text-align: center;
    line-height: 1.2;

    @media (min-width: 768px) {
      text-align: right;
      width: 400px;
      padding: 20px;
      position: absolute;
      right: 0;
      bottom: 0;
      z-index: 10;
    }

    .add-to-cart-group {
      display: inline-block;

      .button {
        span {
          font-weight: 600;
        }
        &:hover {
          color: white;
        }

        &[disabled] {
          pointer-events: none;
          background-color: #666666 !important;
        }
      }

      @media (max-width: 768px) {
        .button {
          width: 100%;
          height: auto;
          padding: 14px;
        }
      }
    }

    .price-group-real-price {
      font-size: 1rem;
      text-decoration: line-through;
      opacity: 0.5;
      margin-right: 6px;
    }

    & > div {
      vertical-align: top;
    }

    ul {
      li {
        vertical-align: top;
      }
    }

    .price {
      font-weight: bold;

      &-group {
        font-size: 1.3em;
        display: inline-block;
        padding-right: 10px;
        margin-top: -2px;

        .price {
          color: var(--orange);
          margin-bottom: 0;
        }

        .price-vat {
          font-size: 0.8rem;
        }
      }
    }

    @media (min-width: 768px) {
      position: absolute;
      right: 0;
      bottom: 0;
      z-index: 10;
    }
    @media (max-width: 768px) {
      .price {
        &-group {
          font-size: 1.8em;
        }
      }
    }

    @media (max-width: 768px) {
      .price-group {
        text-align: center;
        width: 100%;
        margin-bottom: 0.5rem;
      }

      .add-to-cart-group {
        width: 100%;
      }

      .vue-designer .designer-main-container .add-to-cart-group button {
        width: 100%;
      }
    }
  }
}
</style>
