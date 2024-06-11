<template>
  <div class="designer-sidebar__wrapper column is-one-quarter is-full-mobile">
    <div
      v-if="visualEditor"
      class="product-layout-options product-layout-options-visual"
    >
      <button
        class="button button__close"
        v-if="languageStrings.close"
        @click.prevent="visualEditor = !visualEditor"
      >
        <span>{{ languageStrings.close }}</span>
      </button>

      <div v-if="visualEditorFonts" class="product-layout-options__wrapper">
        <div class="type-tester">
          <div class="type-tester__font-name">
            {{ currentDesign.font.name }}
          </div>
          <div
            class="type-tester__font-test"
            :class="`${currentDesign.uppercase ? 'text-uppercase' : ''} ${
              currentDesign.font.slug
            }`"
          >
            <div v-if="checkTextrows()">{{ textRows[0] }}</div>
            <div v-else>
              <span v-if="languageStrings.text_in_sign">{{
                languageStrings.text_in_sign
              }}</span>
              <span v-else>Text</span>
            </div>
          </div>
          <div class="type-tester__available-styles">
            <div
              :class="`${currentDesign.font.bold ? 'enabled' : ''}`"
              class="button-bold"
            >
              B
            </div>
            <div
              :class="`${currentDesign.font.italic ? 'enabled' : ''}`"
              class="button-italic"
            >
              I
            </div>
          </div>
        </div>
        <div class="product-layout-options">
          <aside v-if="visualFontsViewer" class="control font-variant">
            <div class="form-group">
              <label
                v-if="languageStrings.font"
                for="font_all"
                class="control-group-title"
                >{{ languageStrings.font }}</label
              >
              <div>
                <div id="font_all" name="font_all" class="font__list">
                  <div
                    class="font-item"
                    :class="font.slug == fontVariant.slug ? 'active' : ''"
                    v-for="(fontVariant, index) in getFonts"
                    :key="index"
                  >
                    <button
                      role="button"
                      class="button"
                      :class="`${fontVariant.slug} ${
                        currentDesign.font.slug === fontVariant.slug && 'active'
                      }`"
                      @click.prevent="
                        (currentDesign.font = fontVariant), handleInputChange
                      "
                    >
                      {{ fontVariant.name }}
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </aside>
        </div>
        <div v-if="visualEditorSize" class="product-layout-options">
          <aside
            v-if="getTextSizes && visualTextSizeViewer"
            class="control font-size"
          >
            <div class="form-group">
              <label
                v-if="languageStrings.textsize"
                for="fontsize_all fontsize"
                class="control-group-title"
                >{{ languageStrings.textsize }}</label
              >
              <div class="">
                <div id="fontsize_all" class="sizes__list">
                  <div
                    class="textsize-item"
                    :class="textsize == size.truesize ? 'active' : ''"
                    v-for="(size, index) in getTextSizes"
                    :key="index"
                  >
                    <button
                      role="button"
                      class="button"
                      @click.prevent="
                        (currentDesign.fontSize = size.truesize),
                          handleInputChange
                      "
                      :data-size="size.truesize"
                    >
                      {{ size.name }} mm
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </aside>
        </div>
      </div>
    </div>
    <div class="designer-sidebar">
      <div class="designer-sidebar">
        <div class="fast-tools__container">
          <FastTools
            :getSign="getSign"
            :currentDesign="currentDesign"
            :advancedEditor="advancedEditor"
            :languageStrings="languageStrings"
            :visualEditorVisible="visualEditor"
            @handleDesignChanges="handleDesignChanges"
            @toggleVisualDesigner="toggleVisualDesigner"
          />
        </div>
        <aside class="product-information">
          <h1 v-if="getSign.name" class="product-name">{{ getSign.name }}</h1>

          <div class="product-material">
            <span v-if="languageStrings.color">{{
              languageStrings.color
            }}</span>
            <span class="product-variant" v-if="languageStrings.material"
              >{{ languageStrings.material }},</span
            >
          </div>

          <div
            v-if="getSign.realwidth && getSign.realheight"
            class="product-size"
          >
            <span>{{ getSign.realwidth }}</span> x
            <span>{{ getSign.realheight }}</span> mm
          </div>
        </aside>

        <div class="product-layout-options">
          <div v-if="languageStrings.text_in_sign" class="control-group-title">
            {{ languageStrings.text_in_sign }}
          </div>
          <div v-if="debug">
            <button @click.prevent="exportToSvg">Export SVG</button>
          </div>

          <aside v-if="getSign.rowsnum" class="control order-textrows">
            <div
              v-for="index in Number(getSign.rowsnum)"
              :key="index"
              class="form-group linehandler textrow"
              :class="index > 2 && showAllLines ? 'is-hidden' : ''"
            >
              <input
                type="text"
                class="input text"
                :id="'row' + index"
                :name="'row' + index"
                :placeholder="handleTextRowPlaceholder(index)"
                @input="handleInputChange"
                v-model="textRows[index - 1]"
              />
            </div>
            <button
              type="button"
              v-if="showAllLines && Number(getSign.rowsnum) > 1"
              class="add-row-button"
              @click="showAllLines = false"
            >
              {{ languageStrings.extra_textrows }}
            </button>
          </aside>

          <div class="control-group-title"></div>

          <aside v-if="getFonts" class="control font-variant">
            <div class="form-group">
              <label
                v-if="languageStrings.font"
                for="font_all"
                class="control-group-title"
                >{{ languageStrings.font }}</label
              >
              <div class="select is-fullwidth">
                <select
                  id="font_all"
                  name="font_all"
                  class="font"
                  @change="handleSelectChange('font', $event)"
                >
                  <option
                    class="font-item"
                    v-for="(fontVariant, index) in getFonts"
                    :key="index"
                    :value="fontVariant.slug"
                    :selected="fontVariant.slug === currentDesign.font.slug"
                  >
                    {{ fontVariant.name }}
                  </option>
                </select>
              </div>
            </div>
          </aside>

          <aside v-if="getTextSizes" class="control font-size">
            <div class="form-group">
              <label
                v-if="languageStrings.textsize"
                for="fontsize_all fontsize"
                class="control-group-title"
                >{{ languageStrings.textsize }}</label
              >

              <div class="select is-fullwidth">
                <select
                  id="fontsize_all"
                  name="fontsize_all"
                  @change="handleSelectChange('textsize', $event)"
                >
                  <option
                    v-for="(size, index) in getTextSizes"
                    :key="index"
                    :value="size.truesize"
                    :selected="Number(size.truesize) === currentDesign.fontSize"
                  >
                    {{ size.name }} mm
                    {{ checkIfLaserEngraving(size) }}
                    <template
                      v-if="
                        shouldHaveFee() &&
                        size.fee &&
                        size.fee > 0 &&
                        appSettings.currency
                      "
                      >(+{{ size.fee }} {{ appSettings.currency }})</template
                    >
                  </option>
                </select>
              </div>
            </div>
          </aside>

          <aside class="control font-weight-style is-hidden">
            <div class="text-layout-options">
              <button
                v-if="currentDesign.font.bold"
                type="button"
                title="Fet text"
                class="button button-bold is-fullwidth mt-2"
                @click="(fontbold = !fontbold), handleSelectChange()"
                :class="fontbold ? 'active' : ''"
              >
                <span class="button-badge">B</span>
                <span class="is-sr-only">Fet text</span>
              </button>
              <button
                v-if="currentDesign.font.italic"
                type="button"
                title="Italic text"
                class="button button-italic is-fullwidth mt-2"
                @click="(fontitalic = !fontitalic), handleSelectChange()"
                :class="fontitalic ? 'active' : ''"
              >
                <span class="button-badge">I</span>
                <span class="is-sr-only">Kursiv</span>
              </button>
            </div>
          </aside>

          <div v-if="advancedEditor">
            <button
              class="button"
              @click.prevent="visualEditor = !visualEditor"
            >
              Visual fonts
            </button>
          </div>

          <aside
            v-if="appSettings.engraving_options"
            class="control product-engraving__selector"
          >
            <div
              v-if="languageStrings.engraving_type"
              class="control-group-title"
            >
              {{ languageStrings.engraving_type }}
            </div>
            <div v-if="!checkIfLaser()">
              <div>
                <button
                  class="button"
                  :class="currentDesign.engraving_type === 'laquer' && 'active'"
                  @click.prevent="
                    (currentDesign.engraving_type = 'laquer'),
                      handleSelectChange()
                  "
                >
                  <div
                    v-if="getSign.textcolor"
                    class="color-block"
                    :style="{ 'background-color': getSign.textcolor }"
                  ></div>
                  <div>{{ languageStrings.laquer_engraving }}</div>
                </button>
              </div>
              <div v-if="engravingSelectorPricing">
                <button
                  class="button"
                  :class="currentDesign.engraving_type === 'laser' && 'active'"
                  @click.prevent="
                    (currentDesign.engraving_type = 'laser'),
                      handleSelectChange()
                  "
                >
                  <div
                    v-if="getSign.textcolorshadow"
                    class="color-block"
                    :style="{ 'background-color': getSign.textcolorshadow }"
                  ></div>
                  {{ languageStrings.laser_engraving }}
                </button>
              </div>
              <div>
                <button
                  class="button"
                  :class="
                    currentDesign.engraving_type === 'unfilled' && 'active'
                  "
                  @click.prevent="
                    (currentDesign.engraving_type = 'unfilled'),
                      handleSelectChange()
                  "
                >
                  <div
                    v-if="getSign.textcolorshadow"
                    class="color-block"
                    :style="{ 'background-color': getSign.textcolorshadow }"
                  ></div>
                  <div>{{ languageStrings.laquer_unfilled_engraving }}</div>
                </button>
              </div>
            </div>
            <div v-else>
              <div class="product-promises-item laser-icon">
                {{ languageStrings.laser_engraving }}
              </div>
            </div>
            <div class="engraving-information">
              <a
                href="#"
                @click.prevent="displayEngravingInformation()"
                role="button"
                >Läs om våra gravyrtyper</a
              >
            </div>
          </aside>

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

              <div v-if="interfaceList.length > 0">
                <div
                  v-for="(interfaceItem, index) in interfaceList"
                  :key="index"
                >
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
            </ul>
          </aside>
        </div>
      </div>

      <DialogElement
        :dialogToggle="dialogToggle"
        @closeDialog="closeDialog"
        maxWidth="600"
      >
        <template v-slot:header>Våra gravyrtyper</template>
        <template v-slot:content> INfo </template>
      </DialogElement>
    </div>
  </div>
</template>

<script>
import FastTools from "../fast-tools/FastTools.vue";
import DialogElement from "../dialog-element/DialogElement.vue";
import ProductSpecification from "../product-specification/ProductSpecification.vue";

export default {
  name: "DesignerSidebar",
  components: {
    FastTools,
    DialogElement,
    ProductSpecification,
  },
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
    savedTextrows: {
      type: Array,
      default: () => [],
    },
  },
  data() {
    return {
      counter: 0,
      font: {},
      textRows: [],
      debug: false,
      showAllLines: true,

      // Misc
      visualEditor: false,
      visualEditorFonts: true,
      visualEditorSize: false,
      visualFontsViewer: true,
      visualTextSizeViewer: true,
      engravingSelectorPricing: false,
      disableTextsizeFee: true,

      // Current set design
      font: "",
      fontitalic: false,
      fontbold: false,
      lineHeight: 0,
      uppercase: false,
      producOutOfStock: false,

      interfaceList: {},

      currentDesign: {
        font: {
          font: "arial",
          textalign: "center",
        },
        fontSize: 21.3,
        fontMmSize: 6.5,
      },
      dialogToggle: false,
    };
  },
  mounted() {
    const vm = this;
    if (
      vm.savedTextrows?.length > 0 &&
      vm.savedTextrows !== undefined &&
      vm.savedTextrows?.length !== null
    ) {
      vm.textRows = vm.savedTextrows;
    }
    vm.producOutOfStock =
      vm.getSign.stockstatus === "outofstock" ? true : false;
    if (
      vm.getSign?.interfaces &&
      JSON.parse(vm.getSign?.interfaces).length > 0
    ) {
      vm.interfaceList = JSON.parse(vm.getSign?.interfaces);
    }
  },
  methods: {
    checkIfLaser() {
      if (
        this.getSign.onlylaser === "yes" ||
        this.getSign.productmaterial === "Plastic" ||
        this.currentDesign.fontSize < 24 ||
        this.currentDesign.fontSize > 45.2
      ) {
        return true;
      }
      return false;
    },
    checkTextrows() {
      return (
        this.textRows && this.textRows.length > 0 && this.textRows[0].length > 0
      );
    },
    shouldHaveFee() {
      // No extra fee
      // Designer type = 0 is from the shelf and has no extra charge for text sizes
      // Designer type = 1 is plastic and has no extra charge for text sizes
      // Designer type = 2 is brass and has extra charge for text sizes
      const designerType = Number(this.getSign?.designertype);
      if (!this.disableTextsizeFee && designerType !== 1) {
        return true;
      }
      return false;
    },
    checkIfLaserEngraving(size) {
      const laserEngraving = this.languageStrings?.laser_engraving
        ? this.languageStrings.laser_engraving
        : "laser";
      return this.getSign?.productmaterial.toLowerCase() !== "plastic" &&
        (size.simple === 0 || size.truesize < 24)
        ? `(${laserEngraving.toLowerCase()})`
        : null;
    },
    handleTextRowPlaceholder(index) {
      return index > 2
        ? `${this.languageStrings.enter_text} (+${this.appSettings.rowextraprice} ${this.appSettings.currency})`
        : this.languageStrings.enter_text;
    },
    checkSimpleEditor(simpleSize) {
      return Number(simpleSize.simple) === 1 &&
        Number(this.getSign.designertype) === 1
        ? true
        : false;
    },
    handleInputChange: function () {
      this.$emit("changeTextRows", this.textRows);
    },
    getFontObject(fontSlug) {
      const fontItemObj = this.getFonts.filter((fontItem) => {
        return fontItem.slug === fontSlug;
      });
      return fontItemObj[0];
    },
    getTextsizeObject(textSize) {
      return this.getTextSizes.filter((size) => {
        return Number(size.truesize) === Number(textSize);
      });
    },
    handleSelectChange(prop, event) {
      const vm = this;
      if (prop === "font") {
        this.currentDesign.font = vm.getFontObject(event.target.value);
      }

      if (prop === "textsize") {
        const textSizeValue = JSON.parse(
          event.target.options[event.target.options.selectedIndex].value
        );
        const fontObject = vm.getTextsizeObject(textSizeValue);
        vm.currentDesign.fontSize = Number(textSizeValue);
        if (fontObject.length > 0) {
          vm.currentDesign.fontMmSize = Number(fontObject[0].name);
        } else {
          vm.currentDesign.fontMmSize = 0;
        }
      }
      vm.$emit("changeFontTextsize", this.currentDesign);
    },
    handleDesignChanges(event) {
      this.currentDesign.fontBold = event.fontBold;
      this.currentDesign.fontItalic = event.fontItalic;
      this.currentDesign.uppercase = event.uppercase;
      this.$emit("changeFontTextsize", this.currentDesign);
    },
    toggleVisualDesigner() {
      this.visualEditor = !this.visualEditor;
    },
    // Dialog
    closeDialog() {
      this.dialogToggle = false;
    },
    openDialog() {
      this.dialogToggle = !this.dialogToggle;
    },
    displayEngravingInformation() {
      this.openDialog();
    },
  },
};
</script>

<style lang="scss" scoped>
.designer-sidebar {
  @media (min-width: 992px) {
    position: relative;
  }

  &__wrapper {
    @media (max-width: 768px) {
      order: 2;
    }
  }
  .fast-tools__container {
    margin-bottom: 16px;
    @media (min-width: 768px) {
      margin: 0;
    }
  }

  .product-information {
    padding: 5px 15px;

    .product {
      &-size {
        font-size: 0.8rem;
        margin-bottom: 1rem;
      }

      &-name {
        font-size: 1.2rem;
        font-weight: 800;
        line-height: 1.2;
        color: var(--main-black);
        margin-bottom: 0;

        @media (min-width: 768px) {
          font-size: 1.4rem;
        }
      }

      &-variant {
        opacity: 0.8;
        text-transform: lowercase;
      }

      &-material {
        font-size: 0.8rem;
      }

      @media (min-width: 768px) {
        &-material {
          font-size: 1rem;
        }

        &-size {
          font-size: 1rem;
        }
      }
    }

    @media (max-width: 768px) {
      padding: 0;
    }
  }

  @media (max-width: 768px) {
    padding: 0;
  }
}

.product-layout-options {
  padding: 0;

  @media (min-width: 768px) {
    padding: 5px 15px 15px;
  }

  &__wrapper {
    border-radius: 4px;
    .control-group-title {
      color: var(--main-grey-dark);
      display: inline-block;
      width: 100%;
      text-align: center;
    }
  }

  &__wrapper {
    border-radius: 4px;
    .control-group-title {
      color: var(--main-grey-dark);
      display: inline-block;
      width: 100%;
      text-align: center;
    }
  }

  .add-row-button {
    display: inline-block;
    border: 1px solid var(--main-border);
    border-radius: 15px;
    background: white;
    box-shadow: 1px 1px 5px -3px rgba(50, 50, 50, 0.35);

    cursor: pointer;

    &:hover {
      color: var(--main-black);
    }
  }

  &-visual {
    max-width: 650px;
    width: 100%;
    padding: 24px;
    border-radius: 4px;
    background-color: white;
    box-shadow: -2px 11px 10px 0 rgba(0, 0, 0, 0.5);
    position: absolute;
    top: 0;
    left: 50%;
    z-index: 12;
    transform: translateX(-50%);

    .font-item {
      .button {
        &:hover {
          background-color: #f7f7f7;
        }
      }
    }

    @media (min-width: 768px) {
      top: 70px;
    }

    .type-tester {
      display: flex;
      justify-content: center;
      align-items: center;
      flex-direction: column;
      margin-bottom: 8px;
      width: 100%;
      height: 120px;
      border-radius: 8px;
      background-color: var(--icy-blue);
      position: relative;

      & > span {
        padding: 16px;
      }

      &__font-name {
        font-size: 1rem;
        font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI",
          Roboto, Oxygen, Ubuntu, Cantarell, "Open Sans", "Helvetica Neue",
          sans-serif;
        border-bottom: 1px solid #808080;
      }

      &__font-test {
        & > div {
          font-size: 2.5rem;
          overflow: hidden;
          white-space: nowrap;
          text-align: left;
          text-overflow: ellipsis;
          white-space: nowrap;

          line-height: 1.2;
          max-width: 300px;
        }

        &.text-uppercase {
          text-transform: uppercase;
        }
      }

      &__available-styles {
        display: flex;
        flex-direction: row;
        gap: 4px;
        position: absolute;
        right: 4px;
        bottom: 4px;

        & > div {
          opacity: 0.2;
          font-size: 0.8rem;
          line-height: 18px;
          text-align: center;
          display: inline-block;
          width: 20px;
          height: 20px;
          min-width: 20px;
          padding: 0;
          border-radius: 4px;
          border: 1px solid rgba(0, 0, 0, 0.3);
          background-color: transparent;
          transition: opacity 0.3s ease-in-out;
          &.enabled {
            opacity: 1;
          }
        }
        @media (min-width: 992px) {
          & > div {
            font-size: 1rem;
            line-height: 28px;
            width: 30px;
            height: 30px;
            min-width: 30px;
          }
        }
      }

      @media (min-width: 768px) {
        &__font-test {
          font-size: 3rem;
        }
      }
    }

    .button {
      &.button__close {
        font-size: 0.9rem;
        padding: 0 16px;
        margin: 0;
        border: 1px solid #ddd;
        border-radius: 20px;
        background: white;
        cursor: pointer;
        position: absolute;
        top: 10px;
        right: 10px;
        z-index: 10;
        &:hover {
          background-color: #f7f7f7;
        }
      }
    }

    .product-layout-options {
      display: flex;

      & > aside {
        flex: 1;

        .button {
          transition: background 0.3s ease-in-out;
          &.active {
            background-color: var(--icy-blue);
          }
        }

        .sizes__list,
        .font__list {
          display: flex;
          flex-wrap: wrap;
          justify-content: center;
          align-items: center;
          gap: 8px;
        }

        @media (min-width: 768px) {
          .sizes__list,
          .font__list {
            display: flex;
            flex-wrap: wrap;
            gap: 16px;
          }
        }
      }
    }
  }
}
</style>
