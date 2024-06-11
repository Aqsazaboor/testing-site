<template>
  <div v-if="getSign">
    <div class="more-product-information-trigger">
      <button
        class="button"
        :class="showProductInformation && 'active'"
        role="button"
        @click.prevent="showProductInformation = !showProductInformation"
      >
        {{ languageStrings.show_product_information }}
      </button>
    </div>

    <div
      v-if="getSign"
      class="column is-full more-product-information"
      :class="showProductInformation ? 'show' : null"
    >
      <div class="columns is-multiline">
        <div class="column base-information__description">
          <div class="base-information">
            <h2 v-if="getSign.name">{{ getSign.name }}</h2>
            <div>
              <p v-if="getSign.description" v-html="parseSignDescription"></p>
            </div>
          </div>

          <div v-if="languageStrings.material" class="mb-2">
            <div class="is-size-7">{{ languageStrings.material_title }}</div>

            {{ languageStrings.color }}
          </div>

          <div class="mt-2">
            <div class="is-size-7">{{ languageStrings.size }}</div>
            {{ getSign.width }} x {{ getSign.height }} mm
          </div>

          <div v-if="languageStrings.color" class="mt-2">
            <div class="is-size-7">{{ languageStrings.variant }}</div>
            {{ languageStrings.material }}
          </div>

          <div class="mt-2" v-if="getSign.interfaces">
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
                    interfaceItem === 'sign_interface_screws' &&
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

          <div v-if="languageStrings.terms && settings.termspage" class="mt-2">
            <a :href="settings.termspage">{{ languageStrings.terms }}</a>
          </div>
        </div>

        <div class="column column base-information__technical">
          <div class="terms">
            <div v-if="getSign.saleprice !== '0'">
              <div v-if="getSign.saleprice" class="is-size-4">
                <span class="is-size-7">{{ languageStrings.base_price }} </span>
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
                <span class="is-size-7">{{ languageStrings.base_price }} </span>
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

            <div v-if="languageStrings.in_stock" class="in-stock">
              {{ languageStrings.in_stock }}
            </div>

            <div
              v-if="languageStrings.tape_included && getSign.hasholes !== '1'"
            >
              <div class="product-promises-item tape-included">
                {{ languageStrings.tape_included }}
              </div>
            </div>

            <div
              v-if="languageStrings.screws_included && getSign.hasholes === '1'"
            >
              <div class="product-promises-item screws-included">
                {{ languageStrings.screws_included }}
              </div>
            </div>

            <div v-if="languageStrings.delivery_times">
              {{ languageStrings.delivery_times }}
            </div>
            <div v-if="languageStrings.large_orders">
              {{ languageStrings.large_orders }}
            </div>
            <div v-if="languageStrings.sku && getSign.sku">
              <span class="is-size-7"
                >{{ languageStrings.sku }} {{ getSign.sku }}</span
              >
            </div>
          </div>
        </div>
        <div v-if="languageStrings.reservation" class="column is-full">
          <div class="mt-2">
            <div class="is-size-7">
              {{ languageStrings.reservation }}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import calculateVat from "../mixins/calculateVat";

export default {
  name: "ProductInformation",
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
    };
  },
  computed: {
    parseSignDescription() {
      return this.getSign.description.replace(/&quot;/g, "");
    },
    interfaces() {
      if (this.getSign !== undefined) {
        console.log(this.getSign.interfaces);
        return JSON.parse(this.getSign.interfaces);
      }
      return null;
    },
  },
  methods: {
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
.more-product-information {
  display: flex;

  @media (max-width: 768px) {
    display: none;
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
    display: none;

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
      }
    }

    &__technical {
      padding-top: 70px;

      @media (max-width: 768px) {
        padding-top: 0;
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
