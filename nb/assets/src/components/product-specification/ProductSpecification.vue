<template>
  <div>
    <aside class="product-delivery-info">
      <ul>
        <li>
          <div
            v-if="!producOutOfStock && languageStrings.in_stock"
            class="product-promises-item stock-availability"
          >
            {{ languageStrings.in_stock }}
          </div>
        </li>
        <li>
          <div
            v-if="producOutOfStock"
            class="product-promises-item stock-availability out-of-stock"
          >
            {{ languageStrings.out_of_stock }}
          </div>
        </li>
        <li v-if="!appSettings.engraving_options">
          <div
            v-if="!checkIfLaser()"
            class="product-promises-item gravure-icon"
          >
            {{ languageStrings.laquer_engraving }}
          </div>
          <div v-else class="product-promises-item laser-icon">
            {{ languageStrings.laser_engraving }}
          </div>
        </li>
      </ul>

      <div v-if="interfaceList.length > 0">
        <div v-for="(interfaceItem, index) in interfaceList" :key="index">
          <div
            v-if="interfaceItem === 'sign_interface_tape'"
            class="product-promises-item tape-included"
          >
            {{ languageStrings.tape_included_short }}
          </div>
          <div
            v-if="interfaceItem === 'sign_interface_militaryclip'"
            class="product-promises-item militaryclip-included"
          >
            Militärfäste
          </div>
          <div
            v-if="interfaceItem === 'sign_interface_screw'"
            class="product-promises-item screws-included"
          >
            {{ languageStrings.screws_included_short }}
          </div>
          <div
            v-if="interfaceItem === 'sign_interface_safetypin'"
            class="product-promises-item safetypin-included"
          >
            Säkerhetsnål
          </div>
          <div
            v-if="interfaceItem === 'sign_interface_metalmagnet'"
            class="product-promises-item militaryclip-included"
          >
            Magnet metall
          </div>
          <div
            v-if="interfaceItem === 'sign_interface_plasticmagnet'"
            class="product-promises-item militaryclip-included"
          >
            Magnet plast
          </div>
          <div
            v-if="interfaceItem === 'sign_interface_keyring'"
            class="product-promises-item militaryclip-included"
          >
            Nyckelring
          </div>
        </div>
      </div>
    </aside>
  </div>
</template>

<script>
/*
  <li v-for="(interfaceItem, index) in signInterface" :key="index">
    <div
      v-if="interfaceItem === 'sign_interface_tape'"
      class="product-promises-item tape-included"
    >
      Dubbelhäftande tejp
    </div>
    <div
      v-if="interfaceItem === 'sign_interface_militaryclip'"
      class="product-promises-item militaryclip-included"
    >
      Militärfäste
    </div>
    <div
      v-if="interfaceItem === 'sign_interface_screws'"
      class="product-promises-item screws-included"
    >
      Skruvar ingår
    </div>
    <div
      v-if="interfaceItem === 'sign_interface_safetypin'"
      class="product-promises-item safetypin-included"
    >
      Säkerhetsnål
    </div>
    <div
      v-if="interfaceItem === 'sign_interface_metalmagnet'"
      class="product-promises-item militaryclip-included"
    >
      Magnet metall
    </div>
    <div
      v-if="interfaceItem === 'sign_interface_plasticmagnet'"
      class="product-promises-item militaryclip-included"
    >
      Magnet plast
    </div>
    <div
      v-if="interfaceItem === 'sign_interface_keyring'"
      class="product-promises-item militaryclip-included"
    >
      Nyckelring
    </div>
  </li>
*/
export default {
  name: "ProductSpecification",
  components: {},
  props: {
    appSettings: {
      type: Object,
      default: {},
    },
    getSign: {
      type: Object,
      default: {},
    },
    interfaceList: {
      type: Object,
      default: {},
    },
    languageStrings: {
      type: Object,
      default: {},
    },
    checkIfLaser: {
      type: Function,
    },
  },
  data() {
    return {
      interfaceList: {},
      producOutOfStock: false,
    };
  },
  mounted() {
    const vm = this;
    vm.producOutOfStock =
      vm.getSign.stockstatus === "outofstock" ? true : false;
    if (
      vm.getSign?.interfaces &&
      JSON.parse(vm.getSign?.interfaces).length > 0
    ) {
      vm.interfaceList = JSON.parse(vm.getSign?.interfaces);
    }
  },
  methods: {},
};
</script>

<style lang="scss" scoped>
.product {
  &-delivery-info {
    .product-promises-item {
      padding-left: 20px;
      background-size: 10px;
      background-position: 0 center;
      position: relative;

      &.laser-icon {
        background-size: 17px;
      }

      &.gravure-icon {
        background-size: 17px;
      }

      &.screws-included {
        background-size: 17px;
      }

      &.tape-included {
        background-size: 17px;
      }
    }
  }
}
</style>
