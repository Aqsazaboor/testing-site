<template>
  <div
    class="product column is-one-quarter-tablet is-half-mobile"
    :class="productData.tags"
  >
    <div v-if="productData.saleprice" class="onsale">
      {{ languageStrings.sale }}
    </div>
    <div>
      <div
        v-if="
          productData.stock === 'outofstock' && languageStrings.out_of_stock
        "
        class="outofstock-badge"
      >
        {{ languageStrings.out_of_stock }}
      </div>
      <a v-if="productData.imgsrc" :href="productData.url">
        <div class="product-image">
          <img
            :src="productData.imgsrc"
            :srcset="productData.imgsrcset"
            sizes="(max-width: 50em) 87vw, 680px"
            :alt="productData.imagealt"
          />
        </div>
      </a>
      <a :href="productData.url">
        <div class="product-description__wrapper">
          <div v-if="productData.name" class="product-name">
            {{ productData.name }}
          </div>
          <div v-if="productData.specs" v-html="productData.specs"></div>
          <div
            v-if="productData.pricehtml"
            class="price"
            v-html="productData.pricehtml"
          ></div>
        </div>
        <div class="product__cta">
          <div
            v-if="languageStrings.choose_product && productData.designer > 0"
            class="button"
            role="button"
          >
            {{ languageStrings.choose_product }}
          </div>
          <div v-else class="button" role="button">
            {{ languageStrings.show_product }}
          </div>
        </div>
      </a>
    </div>
  </div>
</template>

<script>
export default {
  name: "ProductItem",
  props: {
    productData: {
      type: Object,
      default: {},
    },
    languageStrings: {
      type: Object,
      default: {},
    },
  },
  data() {
    return {};
  },
  computed: {},
  methods: {},
};
</script>

<style scoped lang="scss">
.product {
  width: calc(25% - 10px);
  padding: 0.5rem;
  padding-bottom: 42px;
  text-align: center;
  border: 1px solid #eee;
  position: relative;

  .onsale {
    font-weight: 800;
    color: white;
    padding: 1px 7px;
    border-color: var(--orange);
    background-color: var(--orange);
    border-top-left-radius: 0;
    border-top-right-radius: 0;
    border-bottom-left-radius: 0;
    border-bottom-right-radius: 6px;
    position: absolute;
    top: 0;
    left: 0;
  }

  .outofstock-badge {
    font-weight: 800;
    color: #333;
    padding: 1px 7px;
    border-color: var(--yellow);
    background-color: var(--yellow);
    border-top-left-radius: 0;
    border-top-right-radius: 0;
    border-bottom-left-radius: 0;
    border-bottom-right-radius: 6px;
    position: absolute;
    top: 0;
    left: 0;
  }

  .product-image {
    img {
      max-height: 50px;
      width: auto;
      margin: 1.618em auto 1.618em auto !important;
      padding-left: 30px;
      padding-right: 30px;
    }
  }

  .product-name {
    font-size: 1rem !important;
    font-weight: 600 !important;
    color: var(--main-black);
    line-height: 1;
    width: 100%;
    margin-bottom: 0;
    padding-left: 15px;
    padding-right: 15px;
    color: var(--main-black);
    line-height: 1;
  }

  .product-description__wrapper {
    :deep() .product-description {
      line-height: 1.2;
      margin-top: 4px;
      margin-bottom: 8px;
      .woocommerce-loop-product__material {
        .product-material,
        .product-color {
          font-size: 0.8rem;
        }
      }
      .woocommerce-loop-product__size {
        font-size: 0.8rem;
      }
    }
    .product-color {
      text-transform: lowercase;
    }
  }

  .price {
    font-weight: 600;
  }

  .button {
    font-weight: 600;
    color: var(--blue-600);
    border: none;
  }

  .woocommerce-loop-product__size {
    line-height: 1;
  }

  &__cta {
    text-align: center;
    width: 100%;
    position: absolute;
    left: 0;
    bottom: 0;

    .button {
      background-color: transparent;
    }
  }

  @media (max-width: 992px) {
    width: calc(50% - 10px);

    .button {
      font-size: 0.8rem;
      height: auto;
      white-space: unset;
    }
  }
}
</style>
