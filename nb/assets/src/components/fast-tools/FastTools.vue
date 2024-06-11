<template>
  <aside v-if="currentDesign.font" class="fast-tools">
    <div>
      <div :class="currentDesign.font.bold ? '' : 'disabled'">
        <button
          :disabled="!currentDesign.font.bold"
          role="button"
          class="button is-small button-bold"
          @click.prevent="
            (localDesign.fontBold = !localDesign.fontBold), handleToggleChange()
          "
          :class="
            localDesign.fontBold && currentDesign.font.bold ? 'active' : ''
          "
        >
          <span>B</span>
          <span class="tooltip" v-if="languageStrings.bold">{{
            languageStrings.bold
          }}</span>
        </button>
      </div>

      <div :class="currentDesign.font.italic ? '' : 'disabled'">
        <button
          :disabled="!currentDesign.font.italic"
          role="button"
          class="button is-small button-italic"
          @click.prevent="
            (localDesign.fontItalic = !localDesign.fontItalic),
              handleToggleChange()
          "
          :class="
            localDesign.fontItalic && currentDesign.font.italic ? 'active' : ''
          "
        >
          <span>I</span>
          <span class="tooltip" v-if="languageStrings.italic">{{
            languageStrings.italic
          }}</span>
        </button>
      </div>

      <div>
        <button
          role="button"
          class="button is-small button-uppercase"
          @click.prevent="
            (localDesign.uppercase = !localDesign.uppercase),
              handleToggleChange()
          "
          :class="localDesign.uppercase ? 'active' : ''"
        >
          <span class="tooltip" v-if="languageStrings.uppercase">{{
            languageStrings.uppercase
          }}</span>
        </button>
      </div>

      <div v-if="hasSavedData">
        <button
          title="Rensa"
          class="button is-small button-delete"
          @click.prevent="clearSavedDesign"
        >
          <span class="tooltip" v-if="languageStrings.clear_design">{{
            languageStrings.clear_design
          }}</span>
        </button>
      </div>

      <div v-if="showTextAlignment" class="toolbar-separator">
        <div></div>
      </div>

      <div v-if="showTextAlignment">
        <button
          role="button"
          class="button is-small button-align-left"
          @click.prevent="
            (currentDesign.textalign = 'left'), handleToggleChange()
          "
          :class="currentDesign.textalign == 'left' ? 'active' : ''"
        >
          <span class="icon"></span>
          <span class="tooltip" v-if="languageStrings.left_aligned">{{
            languageStrings.left_aligned
          }}</span>
        </button>
      </div>

      <div v-if="showTextAlignment">
        <button
          role="button"
          class="button is-small button-align-center"
          @click.prevent="
            (currentDesign.textalign = 'center'), handleToggleChange()
          "
          :class="currentDesign.textalign == 'center' ? 'active' : ''"
        >
          <span class="tooltip" v-if="languageStrings.center_aligned">{{
            languageStrings.center_aligned
          }}</span>
        </button>
      </div>

      <div v-if="showTextAlignment">
        <button
          role="button"
          class="button is-small button-align-right"
          @click.prevent="
            (currentDesign.textalign = 'right'), handleToggleChange()
          "
          :class="currentDesign.textalign == 'right' ? 'active' : ''"
        >
          <span class="tooltip" v-if="languageStrings.right_aligned">{{
            languageStrings.right_aligned
          }}</span>
        </button>
      </div>

      <div v-if="showLineHeight">
        <select
          class="form-control"
          name="lineheight"
          v-model="textspacingy"
          @change="updateOrderObject"
        >
          <option value="3">0</option>
          <option value="10">1</option>
          <option value="20">2</option>
          <option value="30">3</option>
          <option value="40">4</option>
          <option value="50">5</option>
        </select>
      </div>

      <div>
        <button
          role="button"
          class="button is-small gravure-icon"
          :class="`${visualEditorVisible ? 'active-light active-arrow' : ''}`"
          @click.prevent="toggleVisualDesigner()"
        >
          <span class="sr-only">Designer</span>
        </button>
      </div>

      <div v-if="showTextAlignment && textalign == 'left'">
        <div class="toolbar-item toolbar-item-align-left">
          <label
            ><input
              type="number"
              placeholder="0 mm"
              v-model="offset"
              @change="updateOrderObject"
            />
            mm</label
          >
        </div>
      </div>

      <div v-if="showTextAlignment && textalign == 'right'">
        <div class="toolbar-item toolbar-item-align-right">
          <label
            ><input
              type="number"
              placeholder="0 mm"
              v-model="offset"
              @change="updateOrderObject"
            />
            mm</label
          >
        </div>
      </div>
    </div>
  </aside>
</template>

<script>
export default {
  name: "FastTools",
  props: {
    getSign: {
      type: Object,
      default: {},
    },
    advancedEditor: {
      type: Boolean,
      default: false,
    },
    currentDesign: {
      type: Object,
      default: {},
    },
    languageStrings: {
      type: Object,
      default: {},
    },
    visualEditorVisible: {
      type: Boolean,
      default: false,
    },
  },
  data() {
    return {
      font: {},
      textAlign: "center",
      showTextAlignment: false,
      showLineHeight: false,
      hasSavedData: false,
      localDesign: {
        fontBold: false,
        fontItalic: false,
        uppercase: false,
      },
    };
  },
  created() {
    const vm = this;
    vm.localDesign.fontBold = vm.currentDesign.fontBold;
    vm.localDesign.fontItalic = vm.currentDesign.fontItalic;
    vm.localDesign.uppercase = vm.currentDesign.uppercase;

    if (vm.advancedEditor) {
      vm.showLineHeight = true;
      vm.showTextAlignment = true;
    }
  },
  computed: {
    checkHasSavedData() {
      return true;
    },
  },
  methods: {
    handleToggleChange(prop, event) {
      this.$emit("handleDesignChanges", this.localDesign);
    },
    toggleVisualDesigner() {
      this.$emit("toggleVisualDesigner");
    },
  },
};
</script>

<styles scoped lang="scss">
.fast-tools {
  white-space: pre;
  padding: 6px;
  border-radius: 5px;
  border: 1px solid var(--main-border);
  background-color: white;
  box-shadow: 0px 3px 10px 0px rgba(0, 0, 0, 0.2);

  position: absolute;
  top: 0;

  @media (min-width: 992px) {
    left: 100%;
    z-index: 10;
  }
  @media (max-width: 992px) {
    width: 100%;
    top: 0;
    left: 0;
    z-index: 10;
  }

  .button {
    font-size: 1rem;
    text-align: center;
    white-space: nowrap;
    width: 44px;
    height: 44px;
    margin-right: 6px;

    background-color: white;
    border-color: #dbdbdb;
    border-width: 1px;
    color: #363636;
    cursor: pointer;
    justify-content: center;
    padding-bottom: calc(0.5em - 1px);
    padding-left: 1em;
    padding-right: 1em;
    padding-top: calc(0.5em - 1px);

    background-repeat: no-repeat;
    background-size: 29px;
    background-position: center center;

    &.active {
      color: white !important;
      border-color: var(--black);
      background-color: var(--black);
    }

    &.active-light {
      background-color: var(--icy-blue);
    }

    & > span {
      &.tooltip {
        font-size: 0.7rem;
        color: white;
        display: none;
        padding: 2px 4px;
        background-color: black;

        position: absolute;
        top: -14px;
        left: 30px;
        border-radius: 4px;
        z-index: 10;
      }
    }

    &:hover {
      & span {
        &.tooltip {
          display: block;
        }
      }
    }

    &.active-arrow {
      position: relative;
      &::after {
        content: "";
        display: inline-block;
        width: 18px;
        height: 18px;
        background-color: white;
        position: absolute;
        left: 50%;
        bottom: -23px;
        transform: translateX(-50%) rotate(45deg);
        box-shadow: 4px 6px 13px 0 rgba(0, 0, 0, 0.5);
      }
    }
  }

  & > div {
    display: flex;
    flex-direction: row;
    margin: 0;

    & > div {
      &:first-child {
      }
      &:last-of-type {
        button {
          margin-right: 0;
        }
      }
      position: relative;
    }
  }

  input[type="number"] {
    border: none;
  }
}
</styles>
