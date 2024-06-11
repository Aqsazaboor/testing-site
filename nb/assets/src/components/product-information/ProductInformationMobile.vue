<template>
  <div v-if="getSign" class="product-information__mobile--wrapper">
    <div class="product-information">
      <div v-if="languageStrings.delivery_times">
        <div class="icon icon-delivery"></div>
        <div>{{ languageStrings.delivery_times }}</div>
      </div>
      <div v-if="languageStrings.shipping_cost">
        <div class="icon icon-box"></div>
        <div>{{ languageStrings.shipping_cost }}</div>
      </div>
      <div v-if="trustIcons" class="service-logos">
        <div class="icon icon-credit-card"></div>
        <div v-for="(iconItem, index) in trustIcons[0]" :key="index">
          <div class="service-logo" :class="iconItem.class">
            <span class="sr-only">{{ iconItem.class }}</span>
          </div>
        </div>
      </div>
      <div>
        <div class="icon icon-information"></div>
        <div v-if="languageStrings.terms && settings.termspage">
          <a :href="settings.termspage">{{ languageStrings.terms }}</a>
        </div>
      </div>
    </div>
    <div class="accordion" :class="description && 'accordion__open'">
      <button
        @click.prevent="description = !description"
        class="accordion__button"
      >
        Produktinformation
      </button>
      <div v-if="description" class="accordion__panel">
        <!-- <h2 v-if="getSign.name">{{ getSign.name }}</h2> -->
        <div
          class="product-description"
          :class="`${
            checkDescriptionLength()
              ? ''
              : descriptionFold
              ? 'product-description-folded'
              : ''
          }`"
        >
          <button
            class="button button-toggle-description"
            v-if="descriptionFold && !checkDescriptionLength()"
            @click.prevent="descriptionFold = false"
          >
            {{ languageStrings.show_product_information }}
          </button>
          <p v-if="getSign.description" v-html="parseSignDescription"></p>
        </div>
      </div>
    </div>

    <div class="accordion" :class="specification && 'accordion__open'">
      <button
        @click.prevent="specification = !specification"
        class="accordion__button"
      >
        Specifikationer
      </button>
      <div
        v-if="specification"
        class="accordion__panel accordion__panel--white"
      >
        <div>
          <div v-if="languageStrings.material">
            <div class="is-size-7">{{ languageStrings.material_title }}</div>
            {{ languageStrings.color }}
          </div>

          <div>
            <div class="is-size-7">{{ languageStrings.size }}</div>
            {{ getSign.width }} x {{ getSign.height }} mm
          </div>

          <div v-if="languageStrings.color">
            <div class="is-size-7">{{ languageStrings.variant }}</div>
            {{ languageStrings.material }}
          </div>

          <div v-if="getSign.interfaces">
            <div class="is-size-7" v-if="languageStrings.interface_application">
              {{ languageStrings.interface_application }}
            </div>
            <ul>
              <li
                v-for="(interfaceItem, index) in getInterfaces()"
                :key="index"
              >
                <template
                  v-if="
                    interfaceItem === 'sign_interface_tape' &&
                    languageStrings.sign_interface_tape
                  "
                >
                  {{ languageStrings.sign_interface_tape }}
                </template>
                <template
                  v-if="
                    interfaceItem === 'sign_interface_militaryclip' &&
                    languageStrings.sign_interface_militaryclip
                  "
                >
                  {{ languageStrings.sign_interface_militaryclip }}
                </template>
                <template
                  v-if="
                    interfaceItem === 'sign_interface_screw' &&
                    languageStrings.sign_interface_screws
                  "
                >
                  {{ languageStrings.sign_interface_screws }}
                </template>
                <template
                  v-if="
                    interfaceItem === 'sign_interface_safetypin' &&
                    languageStrings.sign_interface_safetypin
                  "
                >
                  {{ languageStrings.sign_interface_safetypin }}
                </template>
                <template
                  v-if="
                    interfaceItem === 'sign_interface_metalmagnet' &&
                    languageStrings.sign_interface_metalmagnet
                  "
                >
                  {{ languageStrings.sign_interface_metalmagnet }}
                </template>
                <template
                  v-if="
                    interfaceItem === 'sign_interface_plasticmagnet' &&
                    languageStrings.sign_interface_plasticmagnet
                  "
                >
                  {{ languageStrings.sign_interface_plasticmagnet }}
                </template>
                <template
                  v-if="
                    interfaceItem === 'sign_interface_keyring' &&
                    languageStrings.sign_interface_keyring
                  "
                >
                  {{ languageStrings.sign_interface_keyring }}
                </template>
              </li>
            </ul>
          </div>

          <div v-if="languageStrings.tape_included && getSign.hasholes !== '1'">
            <div class="product-promises-item tape-included">
              {{ languageStrings.tape_included }}
            </div>
          </div>

          <div>
            <div class="product-promises-item screws-included">
              {{ languageStrings.screws_included }}
            </div>
          </div>

          <div v-if="languageStrings.large_orders">
            {{ languageStrings.large_orders }}
          </div>

          <div v-if="languageStrings.sku && getSign.sku">
            <span class="is-size-7"
              >{{ languageStrings.sku }} {{ getSign.sku }}</span
            >
          </div>

          <div v-if="getSign.saleprice !== '0'">
            <div v-if="getSign.saleprice" class="is-size-4">
              <span class="is-size-7"
                >{{ languageStrings.base_price }}&nbsp;&nbsp;</span
              >
              <span class="price">
                <span class="price__original">{{ getSign.price }}</span>
                <span>{{ getSign.saleprice }}</span>
                <span
                  v-if="languageStrings.currency_symbol"
                  v-html="languageStrings.currency_symbol"
                ></span>
              </span>
            </div>
            <div v-if="getSign.saleprice" class="is-size-7">
              <span>{{ calculateVat(getSign.saleprice) }}</span>
              <span v-if="languageStrings.ex_vat">{{
                languageStrings.ex_vat
              }}</span>
            </div>
          </div>
          <div v-else>
            <div v-if="getSign.price" class="is-size-4">
              <span class="is-size-7"
                >{{ languageStrings.base_price }}&nbsp;&nbsp;</span
              >
              <span class="price">
                <span>{{ getSign.price }}</span>
                <span
                  v-if="languageStrings.currency_symbol"
                  v-html="languageStrings.currency_symbol"
                ></span>
              </span>
            </div>
            <div v-if="getSign.price" class="is-size-7">
              <span>{{ calculateVat(getSign.price) }}</span>
              <span v-if="languageStrings.ex_vat">{{
                languageStrings.ex_vat
              }}</span>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div v-if="languageStrings.reservation" class="reserved-for-typos">
      <div class="is-size-7">
        {{ languageStrings.reservation }}
      </div>
    </div>
  </div>
</template>

<script>
// :class="showProductInformation ? 'show' : null"
import calculateVat from "../mixins/calculateVat";

export default {
  name: "ProductInformationMobile",
  props: {
    getSign: {
      type: Object,
      default: {},
    },
    languageStrings: {
      type: Object,
      default: {},
    },
    settings: {
      type: Object,
      default: {},
    },
    siteSettings: {
      type: Object,
      default: {},
    },
  },
  mixins: [calculateVat],
  data() {
    return {
      counter: 0,
      showProductInformation: false,
      interfaceList: {},
      description: true,
      specification: false,
      descriptionFold: true,
    };
  },
  computed: {
    parseSignDescription() {
      const descriptionParsed = this.getSign.description.replace(/&quot;/g, "");
      this.description = descriptionParsed;
      return descriptionParsed;
    },
    interfaces() {
      if (this.getSign !== undefined) {
        return JSON.parse(this.getSign.interfaces);
      }
      return null;
    },
    trustIcons() {
      return this.siteSettings?.trust_icons && this.siteSettings.trust_icons;
    },
  },
  methods: {
    checkDescriptionLength() {
      return this.description.length <= 200;
    },
    getInterfaces() {
      return (
        this.getSign?.interfaces.length > 0 &&
        JSON.parse(this.getSign.interfaces)
      );
    },
  },
};
</script>

<style scoped lang="scss">
.icon-box {
  background-image: url(../../../images/icons/icon-box.svg);
}

.icon-credit-card {
  background-image: url(../../../images/icons/icon-credit-card.svg);
}

.icon-delivery {
  background-image: url(../../../images/icons/icon-delivery.svg);
}

.icon-information {
  background-image: url(../../../images/icons/icon-information.svg);
}

.product-information {
  display: flex;
  flex-direction: column;
  border-top: 1px solid #eee;
  border-bottom: 1px solid #eee;
  background-color: #fff;

  &__mobile--wrapper {
    .product-description {
      position: relative;
      .button-toggle-description {
        position: absolute;
        left: 50%;
        bottom: 10px;
        transform: translateX(-50%);
      }
      &-folded {
        height: 116px;
        overflow: hidden;
        &::before {
          content: "";
          display: block;
          width: 100%;
          height: 100%;
          background: rgb(247, 247, 247);
          background: linear-gradient(
            0deg,
            rgba(247, 247, 247, 1) 0%,
            rgba(247, 247, 247, 0) 100%
          );
          position: absolute;
          top: 0;
          left: 0;
        }
      }
    }

    @media (min-width: 768px) {
      display: none;
    }
  }

  & > div {
    font-size: 0.85rem;
    display: flex;
    flex: 1;
    padding: 8px 0;
    border-bottom: 1px solid #eee;

    &:last-of-type {
      border: none;
    }

    a {
      color: var(--black);
      border-bottom: 1px solid var(--black);
    }
  }

  .icon {
    width: 50px;
    background-repeat: no-repeat;
    background-size: contain;
    background-position: center;
  }

  .service-logos {
    display: flex;
    gap: 4px;

    .service-logo {
      width: 50px;
      height: 21px;
      background-size: contain;
    }
  }
}

.accordion {
  border-bottom: 1px solid #ddd;

  &__panel {
    font-size: 0.85rem;
    padding: 8px;
    border-bottom: 1px solid #eee;

    & > div {
      padding: 0 8px;

      & > div {
        padding: 8px 0;
      }
    }

    ul {
      list-style-type: none;
      margin: 0;
      padding: 0;
    }
  }

  &__panel--white {
    padding: 0 8px 8px;

    & > div {
      padding: 16px;
      border-radius: 8px;
      background-color: #fff;

      & > div {
        border-bottom: 1px solid #eee;

        &:last-of-type {
          border: none;
        }
      }
    }
  }

  &__button {
    font-size: 1.4rem;
    text-align: left;
    width: 100%;
    padding: 8px 16px;
    border: none;
    background-color: transparent;
    position: relative;

    &::after {
      content: "";
      display: inline-block;
      width: 10px;
      height: 10px;
      border-left: 2px solid #43454b;
      border-bottom: 2px solid #43454b;
      position: absolute;
      top: calc(50% - 5px);
      right: 22px;
      transform-origin: center;
      transform: rotate(-135deg) translateY(-50%);
      transition: transform ease-in-out 0.3s;
    }

    &:hover {
      color: black;
    }
  }

  &__open {
    .accordion__button {
      &::after {
        transform: rotate(-45deg) translateY(-50%);
      }
    }
  }
}

.reserved-for-typos {
  padding: 8px 16px;
}

.more-product-information {
  display: flex;

  @media (max-width: 768px) {
    padding: 0;
  }

  ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
  }

  a {
    color: var(--theme-link-color);
    text-decoration: underline;
  }

  @media (min-width: 768px) {
    &.show {
      display: flex;
    }
  }

  .in-stock::before {
    content: "";
    display: inline-block;
    vertical-align: initial;
    width: 11px;
    height: 11px;
    margin-left: 5px;
    margin-right: 5px;
    border-radius: 100%;
    background-color: var(--main-green);
  }

  .terms {
    margin-top: -12px;

    & > div {
      padding-top: 0.5rem;
      margin-top: 0.5rem;
      border-top: 1px solid #ddd;

      &:first-of-type {
        margin-top: 0;
        padding-top: 0;
      }

      .price {
        font-weight: 600;
        color: var(--orange);

        .price__original {
          font-size: 1rem;
          text-decoration: line-through;
          opacity: 0.5;
          margin-left: 6px;
        }
      }
    }

    @media (min-width: 992px) {
      margin-top: -8px;

      & > div {
        &:first-of-type {
          border-top: none;
        }
      }
    }
  }

  .base-information {
    margin-bottom: 1rem;

    &__header {
      padding-bottom: 0;

      h2 {
        margin-bottom: 0;
      }
    }

    &__description {
      @media (max-width: 768px) {
        padding-top: 0;
        background-color: #fff;
      }
    }

    &__technical {
      padding-top: 70px;

      @media (max-width: 768px) {
        padding-top: 0;
        background-color: #fff;
      }
    }
  }

  &-trigger {
    text-align: center;

    button {
      font-weight: 600;
      color: var(--main-black);
      border: none;
      background-color: transparent;

      &.active {
        &::after {
          transform: rotate(-180deg);
        }
      }

      &::after {
        content: "";
        display: inline-block;
        width: 15px;
        height: 15px;
        margin-left: 5px;
        background-image: url("../../../images/svg/arrow-down.svg");
        background-size: contain;
      }
    }

    @media (max-width: 768px) {
      display: none;
    }
  }
}
</style>
