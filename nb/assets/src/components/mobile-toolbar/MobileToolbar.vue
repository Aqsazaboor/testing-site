<template>
  <div class="designer-mobile-toolbar">
    <div v-if="checkIfFontHasBold">
      <button
        type="button"
        :title="languageStrings.bold"
        class="button button-bold"
        @click.prevent="
          (currentDesign.fontBold = !currentDesign.fontBold),
            handleSelectChange()
        "
        :class="currentDesign.fontBold ? 'active' : ''"
      >
        <span class="button-badge">B</span>
        <span v-if="languageStrings.bold" class="is-sr-only">{{
          languageStrings.bold
        }}</span>
      </button>
    </div>
    <div v-if="checkIfFontHasItalic">
      <button
        type="button"
        :title="languageStrings.italic"
        class="button button-italic"
        @click.prevent="
          (currentDesign.fontItalic = !currentDesign.fontItalic),
            handleSelectChange()
        "
        :class="currentDesign.fontItalic ? 'active' : ''"
      >
        <span class="button-badge">I</span>
        <span v-if="languageStrings.italic" class="is-sr-only">{{
          languageStrings.italic
        }}</span>
      </button>
    </div>
    <div>
      <button
        type="button"
        :title="languageStrings.uppercase"
        class="button button-uppercase"
        @click.prevent="
          (currentDesign.uppercase = !currentDesign.uppercase),
            handleSelectChange()
        "
        :class="currentDesign.uppercase ? 'active' : ''"
      >
        <span class="is-sr-only">{{ languageStrings.uppercase }}</span>
      </button>
    </div>
    <div>
      <button
        type="button"
        :title="languageStrings.clear_design"
        class="button button-delete"
        @click.prevent="clearDesignTrigger"
      >
        <span v-if="languageStrings.clear_design" class="is-sr-only">{{
          languageStrings.clear_design
        }}</span>
      </button>
    </div>
  </div>
</template>

<script>
export default {
  name: "MobileToolbar",
  props: {
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
  },
  data() {
    return {
      fontbold: false,
      fontitalic: false,
      bold: false,
    };
  },
  computed: {
    checkIfFontHasBold() {
      return this.currentDesign?.font?.bold;
    },
    checkIfFontHasItalic() {
      return this.currentDesign?.font?.italic;
    },
  },
  methods: {
    handleInputChange() {
      this.$emit("changeTextRows", this.textrows);
    },
    clearDesignTrigger() {
      this.$emit("clearDesign");
    },
    handleSelectChange(prop, event) {
      if (prop === "font") {
        const fontObj = JSON.parse(
          event.target.options[event.target.options.selectedIndex].value
        );
        this.currentDesign.font = fontObj;
      }

      if (prop === "textsize") {
        const textSizeValue = JSON.parse(
          event.target.options[event.target.options.selectedIndex].value
        );
        this.currentDesign.fontSize = Number(textSizeValue);
      }
      this.$emit("changeFontTextsize", this.currentDesign);
    },
  },
};
</script>

<style scoped lang="scss">
.designer-mobile-toolbar {
  display: flex;
  display: none !important;
  gap: 6px;
  width: 100%;
  padding: 0 0 8px 0;
  border-bottom: 1px solid #eee;

  @media (min-width: 768px) {
    padding: 5px 25px;
  }

  .button {
    &-delete {
    }
  }

  & > div {
    display: flex;
    flex-direction: row;

    // .button {
    //   cursor: default;
    //   margin: 0 6px 0 5px;
    //   border: 0 !important;
    //   background-color: transparent;
    // }

    & > div {
      position: relative;
      &::after {
        content: "";
        width: 1px;
        height: 100%;
        background-color: var(--main-border);
        position: absolute;
        right: 0;
        top: 0;
      }
      &:last-of-type {
        margin-left: auto;
        .button {
          margin: 0;
          padding-right: 5px;
        }
        &::after {
          display: none;
        }
      }
    }
  }
  @media (min-width: 768px) {
    display: none;
  }
}

/*
.mobile-toolbar {
  width: 100%;
  padding: 5px 0;
  margin-top: -11px;
  border-bottom: 1px solid #eee;
  background: white;
}

.mobile-toolbar > div {
  display: flex;
  flex-direction: row;
}

.mobile-toolbar > div .button {
  cursor: default;
  margin: 0 6px 0 5px;
  border: 0 !important;
  background-color: transparent;
}

.mobile-toolbar > div > div {
  position: relative;
}

.mobile-toolbar > div > div:after {
  content: "";
  width: 1px;
  height: 100%;
  background-color: var(--main-border);
  position: absolute;
  right: 0;
  top: 0;
}

.mobile-toolbar > div > div:last-of-type {
  margin-left: auto;
}

.mobile-toolbar > div > div:last-of-type .button {
  margin: 0;
  padding-right: 5px;
}

.mobile-toolbar > div > div:last-of-type:after {
  display: none;
}

@media (min-width: 768px) {
  .mobile-toolbar {
    display: none;
  }
}
*/

/*
.mobile-toolbar {
  width: 100%;
  padding: 5px 15px;
  margin-top: -11px;
  border-bottom: 1px solid #eee;

  .button {
    span:not(.button-badge) {
      display: none;
    }
    &.button-italic {
    }
    &.button-bold {
    }
    &:hover {
      color: var(--black);
    }
    &.active {
      color: white;
      background-color: var(--black);
      &:hover {
        color: white;
      }
    }
  }

  & > div {
    display: flex;
    flex-direction: row;
  }

  & > div > div {
    position: relative;
  }

  & > div .button {
    cursor: default;
    margin: 0 6px 0 5px;
    border: 0 !important;
    background-color: transparent;
  }

  @media (min-width: 768px) {
    display: none;
  }
}
*/
</style>
