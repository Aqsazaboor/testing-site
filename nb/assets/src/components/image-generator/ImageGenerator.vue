<template>
  <div class="column designer-result">
    <div v-if="loading" class="designer-result__loader"></div>
    <div class="designer-results-image">
      <div id="signcontainer" class="generated-sign-container">
        <div class="generator-image">
          <div class="generated-image" data-material-id="1">
            <canvas
              ref="canvas"
              id="generator-canvas"
              class="generator-canvas"
            ></canvas>
          </div>
        </div>
      </div>
    </div>

    <div v-if="overSizedText" class="motif-to-big">
      <span v-if="languageStrings.motif_to_big">{{
        languageStrings.motif_to_big
      }}</span>
      <span v-else
        >Woops, the design is to big to fit the sign, please adjust.</span
      >
    </div>

    <div v-if="error">No product image found.</div>
  </div>
</template>

<script>
export default {
  name: "ImageGenerator",
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
    currentDesign: {
      type: Object,
      default: {},
    },
    getTextSizes: {
      type: Object,
      default: {},
    },
    textRows: {
      type: Array,
      default: [],
    },
    languageStrings: {
      type: Object,
      default: {},
    },
  },
  data() {
    return {
      loading: true,
      error: false,
      editorCanvas: {},
      canvasWidth: 0,
      canvasHeight: 0,
      offsetTop: 0,
      offsetLeft: 0,
      initialRun: false,
      itemSelectable: false,
      overSizedText: false,
    };
  },
  mounted() {
    const vm = this;
    if (vm.getSign.image.length < 1) {
      vm.error = true;
      console.log("Sign has no image, abort canvas.");
      return false;
    }
    vm.canvasWidth = Number(vm.getSign.imagewidth);
    vm.canvasHeight = Number(vm.getSign.imageheight);
    vm.offsetTop = vm.getSign?.topoffset ? Number(vm.getSign.topoffset) : 0;
    vm.offsetLeft = vm.getSign?.leftoffset ? Number(vm.getSign.leftoffset) : 0;
    vm.loading = false;

    document
      .getElementById("vue-designer")
      .addEventListener("click", function () {
        vm.updateSignImage;
      });

    vm.initCanvas();
  },
  methods: {
    initCanvas() {
      const vm = this;
      vm.editorCanvas = new fabric.Canvas(vm.$refs.canvas);

      if (vm.editorCanvas?.cacheCanvasEl?.width !== undefined) {
        const canvasWidth = vm.canvasWidth;
        const canvasHeight = vm.canvasHeight;

        vm.editorCanvas.setWidth(canvasWidth);
        vm.editorCanvas.setHeight(canvasHeight);
      } else {
        console.table("test fail: " + JSON.stringify(editorCanvas));
      }

      vm.updateSignImage();

      // Do a extra render to make sure fonts are loaded... Run once
      setTimeout(() => {
        vm.updateSignImage();
        vm.loading = false;
      }, 1000);

      function runRenderOnFirstClick() {
        vm.updateSignImage();
        removeEventListener("click", runRenderOnFirstClick);
      }
      addEventListener("click", runRenderOnFirstClick);
    },

    checkIfLaser() {
      if (
        this.getSign.onlylaser === "yes" ||
        this.getSign.productmaterial === "Plastic" ||
        this.currentDesign.fontSize < 24
      ) {
        return true;
      }
      return false;
    },

    mergeFontSlug() {
      const vm = this;
      let fontSlug = vm.currentDesign?.font?.slug;
      let fontHasItalic = vm.currentDesign?.font.italic === 1 ? true : false;
      let fontHasBold = vm.currentDesign?.font.bold === 1 ? true : false;

      if (
        vm.currentDesign?.fontItalic &&
        fontHasItalic &&
        vm.currentDesign?.fontBold &&
        fontHasBold
      ) {
        fontSlug = `${vm.currentDesign?.font?.slug}bolditalic`;
      } else if (vm.currentDesign?.fontItalic && fontHasItalic) {
        fontSlug = `${vm.currentDesign?.font?.slug}italic`;
      } else if (vm.currentDesign?.fontBold && fontHasBold) {
        fontSlug = `${vm.currentDesign?.font?.slug}bold`;
      }
      return fontSlug;
    },

    rerenderCanvas() {
      setTimeout(() => {
        this.updateSignImage();
      }, 3000);
    },

    converToPixels(textSizeMm) {
      const vm = this;
      if (textSizeMm) {
        const signRealHeight = vm.getSign.realheight;
        const signHeightInPixels = vm.canvasHeight;
        const oneMillimeter = signHeightInPixels / signRealHeight;
        return textSizeMm * oneMillimeter;
      } else {
        return 21.3;
      }
    },

    stripEmojis(string) {
      const regex =
        /(?:[\u2700-\u27bf]|(?:\ud83c[\udde6-\uddff]){2}|[\ud800-\udbff][\udc00-\udfff]|[\u0023-\u0039]\ufe0f?\u20e3|\u3299|\u3297|\u303d|\u3030|\u24c2|\ud83c[\udd70-\udd71]|\ud83c[\udd7e-\udd7f]|\ud83c\udd8e|\ud83c[\udd91-\udd9a]|\ud83c[\udde6-\uddff]|\ud83c[\ude01-\ude02]|\ud83c\ude1a|\ud83c\ude2f|\ud83c[\ude32-\ude3a]|\ud83c[\ude50-\ude51]|\u203c|\u2049|[\u25aa-\u25ab]|\u25b6|\u25c0|[\u25fb-\u25fe]|\u00a9|\u00ae|\u2122|\u2139|\ud83c\udc04|[\u2600-\u26FF]|\u2b05|\u2b06|\u2b07|\u2b1b|\u2b1c|\u2b50|\u2b55|\u231a|\u231b|\u2328|\u23cf|[\u23e9-\u23f3]|[\u23f8-\u23fa]|\ud83c\udccf|\u2934|\u2935|[\u2190-\u21ff])/g;
      return string.replace(regex, "");
    },

    updateSignImage() {
      const vm = this;
      // Fabric JS SVG export, todo
      // https://codepen.io/kadmy/pen/gxgboo
      const editorCanvas = vm.editorCanvas;
      const signTextrows = vm.textRows;
      // const textFont = vm.currentDesign?.font?.slug
      //   ? this.currentDesign.font.slug
      //   : "Roboto";
      const textFont = vm.mergeFontSlug();

      // This should reflect real size of the text more accurate!
      // const textSize = Number(vm.currentDesign.fontSize);
      const textSize = this.converToPixels(vm.currentDesign.fontMmSize);

      const textAlignment = vm.currentDesign?.textalign
        ? vm.currentDesign.textalign
        : "center";

      let textShadowColor = vm.getSign?.textcolorshadow
        ? vm.getSign.textcolorshadow
        : "";

      // If engraving is none, the text color should be the shadow color!
      const noFilling = vm.currentDesign?.engraving_type
        ? vm.currentDesign.engraving_type
        : "laquer";

      let textColor = vm.getSign?.textcolor ? vm.getSign.textcolor : "#000000";
      const textUppercase = vm.currentDesign?.uppercase;

      // notLaser = false = invert, else not invert
      const notLaser =
        (vm.checkIfLaser() || vm.checkIfLaser() !== undefined) &&
        !vm.checkIfLaser()
          ? true
          : false;

      // -------------------------------------------------
      // Render sign with Fabric.js
      // -------------------------------------------------
      // Text editor
      // https://codepen.io/psbolden/pen/NbLJbV

      const productImage = vm.getSign.editorimage
        ? vm.getSign.editorimage
        : vm.getSign.image;

      // Wait for the image to load...
      const imgObj = new Image();
      imgObj.src = productImage;
      imgObj.onload = function () {
        if (typeof editorCanvas.requestRenderAll !== "function") {
          // Stop from being used throwing error when not a function
          return false;
        }

        // Stop text from rendering blurry
        fabric.Object.prototype.objectCaching = false;
        editorCanvas.requestRenderAll();

        const addImageToggle = true;
        if (addImageToggle) {
          // ---------------------------------------
          // Add image
          // ---------------------------------------
          // https://jsfiddle.net/mpedersen15/0rw98wws/2/
          // http://jsfiddle.net/yj78d/
          fabric.Image.fromURL(productImage, function (img) {
            const imageObject = new fabric.Group([img], {
              left: 0,
              top: 0,
              selectable: false,
              hasControls: false,
              hoverCursor: "default",
            });
            editorCanvas.add(imageObject);
            editorCanvas.bringToFront(linesObject);
          });
        } else {
          editorCanvas.backgroundColor = "#DDD";
        }

        // ---------------------------------------------------
        // Add text
        // ---------------------------------------------------
        let aggregatedTextRows = "";

        if (noFilling === "unfilled" && notLaser) {
          const saveTextColor = textColor;
          const saveShadowColor = textShadowColor;
          textColor = saveShadowColor;
          textShadowColor = saveTextColor;
        }

        const textShadow = new fabric.Shadow({
          color: textShadowColor,
          blur: 0,
          offsetX: 1,
          offsetY: 1,
        });

        signTextrows.map((textRow) => {
          if (textRow.length >= 1) {
            let textRowString = vm.stripEmojis(textRow);
            aggregatedTextRows += textRowString + "\n";
          }
        });

        // Clean rows breaks in beginning and end of string
        aggregatedTextRows = aggregatedTextRows
          .trim()
          .replace(/^\s\n+|\s\n+$/g, "");

        if (textUppercase) {
          aggregatedTextRows = aggregatedTextRows.toUpperCase();
        }

        // If sign has text offset, do not center with centerObject...
        const linesObjectHeight = 50;
        const linesObjectWidth = 50;
        let localOffsetTop = 0;
        let localOffsetLeft = 0;

        if (vm.offsetTop && vm.offsetTop !== 0) {
          localOffsetTop =
            vm.canvasHeight / 2 - linesObjectHeight - vm.offsetTop;
        }

        if (vm.offsetLeft && vm.offsetLeft !== 0) {
          localOffsetLeft =
            vm.canvasWidth / 2 - linesObjectWidth - vm.offsetLeft;
        }

        // Work with textboxes instead
        const circle = new fabric.Circle({
          radius: 100,
          fill: "rgba(0,0,0,0)", // transparent
          originX: "center",
          originY: "center",
        });

        // Handle offset lines
        let linesStarter = 0;
        signTextrows.map((theLine) => {
          if (theLine.length > 0) {
            linesStarter++;
          }
        });

        // Adjust size on font
        const excludeOffset = ["couriernew", "garamond"]; // Have to exclude this for now
        let topOffestAdjusmentFactor = 0;
        if (!excludeOffset.includes(textFont) && linesStarter === 1) {
          topOffestAdjusmentFactor = textSize * 0.05;
        }
        // Exit offset lines

        const text = new fabric.IText(aggregatedTextRows, {
          originY: "center",
          originX: "center",
          top: topOffestAdjusmentFactor,

          fontFamily: textFont,
          fontSize: textSize,
          // fontWeight: textBold || textItalic ? aggregatedFontStyle : "",
          fill: textColor,
          textAlign: textAlignment,
          lineHeight: 1,
          shadow: textShadow,
          // Bad support for letter spacing...
          // charSpacing: 100,
        });

        const linesObject = new fabric.Group([circle, text], {
          width: linesObjectWidth,
          height: linesObjectHeight,
          top: localOffsetTop - linesObjectHeight,
          left: localOffsetLeft - linesObjectWidth,
          selectable: vm.itemSelectable ? true : false,
          hasControls: vm.itemSelectable ? true : false,
          hoverCursor: "default",
        });

        editorCanvas.add(linesObject);

        if (
          vm.offsetTop !== undefined &&
          vm.offsetTop !== null &&
          vm.offsetLeft !== undefined &&
          vm.offsetLeft !== null &&
          (vm.offsetTop !== 0 || vm.offsetLeft !== 0)
        ) {
          // Center if not vertical offset in sign
          if (vm.offsetTop === 0) {
            linesObject.centerV();
          }
          if (vm.offsetLeft === 0) {
            linesObject.centerH();
          }
        } else {
          editorCanvas.centerObject(linesObject);
        }

        // Check if text object is wider than canvas
        if (text && vm.canvasWidth && text.getScaledWidth() > vm.canvasWidth) {
          vm.overSizedText = true;
        } else {
          vm.overSizedText = false;
        }

        // -----------------------------------------
        // Just update the text, do not create new:
        // -----------------------------------------
        // text.set({ text: newText }); // Change the text
        // text.set({ text: "newText\nEkelund" }); //Change the text
        // canvas.renderAll(); //Update the canvas
      };
    },
  },
  watch: {
    currentDesign: {
      handler: function (after, before) {
        this.updateSignImage();
      },
      deep: true,
      immediate: true,
    },
    textRows: {
      handler: function (after, before) {
        this.updateSignImage();
      },
      deep: true,
      immediate: true,
    },
  },
};
</script>

<style lang="scss" scoped>
.designer-result {
  position: relative;
  &__loader {
    width: 100%;
    height: 100%;
    background-color: rgba(255, 255, 255, 0.5);
    background-image: url("../../../images/svg/loader.svg");
    background-repeat: no-repeat;
    background-position: center center;
    background-size: 30px;
    position: absolute;
    top: 0;
    left: 0;
    z-index: 1;
  }
  .motif-to-big {
    color: var(--orange);
    padding: 2px 6px 2px 26px;
    border-radius: 5px;
    border: 1px solid var(--orange);
    background-color: #fff;
    box-shadow: 0px 3px 10px 0px rgba(0, 0, 0, 0.2);

    position: absolute;
    bottom: -60px;

    background-image: url("../../../images/icons/icon-attention-orange.svg");
    background-repeat: no-repeat;
    background-position: 4px center;
    background-size: 19px;

    @media (max-width: 768px) {
      font-size: 0.9rem;
      top: -10px;
      bottom: auto;
    }
  }

  @media (max-width: 992px) {
    margin-top: 70px;
  }
}
</style>
