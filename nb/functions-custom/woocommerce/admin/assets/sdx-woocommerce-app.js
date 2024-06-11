// Order line items

const orderAppElement = document.getElementById("custom_order_app");
if (orderAppElement !== null && orderAppElement !== undefined) {
  // This should be dynamic
  // const lineItemObject = lineItem;
  const app = new Vue({
    el: "#order_line_items",
    data: {
      showEditFields: false,
      showCustomFields: true,
      openExtraFields: [],
      lineItemData: {},

      // Fabric
      editorCanvas: {},
      canvasWidth: 0,
      canvasHeight: 0,
    },
    mounted() {
      const vm = this;
      // if (lineItemObject) {
      //   vm.lineItemData = lineItemObject;
      // }
    },
    methods: {
      saveOrderIdLocalstorage(data) {
        localStorage.setItem("lineItemDesign", JSON.stringify(data));
        window.open(
          "/wp-admin/admin.php?page=download-image",
          "download-image"
        );
      },

      showExtraFields(id) {
        if (this.openExtraFields.indexOf(id) < 0) {
          this.openExtraFields.push(id);
        } else {
          const idPos = this.openExtraFields.indexOf(id);
          this.openExtraFields.splice(idPos, 1);
        }
      },
    },
  });
}

const designViewerAppElement = document.getElementById("design_viewer_app");
if (designViewerAppElement !== null && designViewerAppElement !== undefined) {
  // Make vector from fonts...
  // https://github.com/opentypejs/opentype.js

  const viewerApp = new Vue({
    el: "#design_viewer_app",
    data: {
      showEditFields: false,
      showCustomFields: true,
      openExtraFields: [],
      lineItemData: {},
      allFonts: {},
      appError: false,

      // Fabric
      editorCanvas: {},
      canvasWidth: 0,
      canvasHeight: 0,
      sizeMultiplier: 5,

      // Link created
      linkCreated: false,
    },
    mounted() {
      const vm = this;
      const lineItemObject = JSON.parse(localStorage.getItem("lineItemDesign"));

      if (lineItemObject) {
        vm.lineItemData = lineItemObject;
        vm.canvasWidth = vm.parseUnitMm(lineItemObject.product_width);
        vm.canvasHeight = vm.parseUnitMm(lineItemObject.product_height);
      }
      if (fontsObject) {
        vm.allFonts = fontsObject;
      }
      vm.initCanvas();
    },
    methods: {
      initCanvas() {
        const vm = this;
        vm.editorCanvas = new fabric.Canvas(vm.$refs.canvas);
        // console.table(this.editorCanvas?.cacheCanvasEl?.width === undefined);

        if (vm.editorCanvas?.cacheCanvasEl?.width !== undefined) {
          // console.table(this.editorCanvas.cacheCanvasEl.width);
          const canvasWidth = vm.canvasWidth;
          const canvasHeight = vm.canvasHeight;

          vm.editorCanvas.setWidth(canvasWidth);
          vm.editorCanvas.setHeight(canvasHeight);
        } else {
          console.table("test fail: " + JSON.stringify(editorCanvas));
        }
        vm.updateSignImage();
      },
      // Utilities
      parseUnitMm(value) {
        const valueMultiplier = value * this.sizeMultiplier;
        const valueTransform = `${valueMultiplier}mm`;
        return fabric.util.parseUnit(valueTransform);
      },

      // Fonts
      getFontSlug(name) {
        if (name && this.allFonts) {
          const selectedFont = Object.entries(this.allFonts).filter(
            (fontItem) => {
              return fontItem[1].name === name;
            }
          );
          return selectedFont[0][1].slug;
        } else {
          this.appError = true;
          return "arial";
        }
      },

      // Sign handling
      updateSignImage() {
        const vm = this;
        // Fabric JS SVG export, todo
        // https://codepen.io/kadmy/pen/gxgboo
        const editorCanvas = vm.editorCanvas;

        const textSize = vm.parseUnitMm(vm.lineItemData.text_size);
        const textAlignment = vm.lineItemData.text_alignment;
        const textFont = vm.lineItemData.text_font;
        const textFontSlug = vm.getFontSlug(textFont);

        // Stop text from rendering blurry
        fabric.Object.prototype.objectCaching = false;
        editorCanvas.requestRenderAll();

        // Canvas Border
        const strokeSize = 2;
        const square = new fabric.Rect({
          width: vm.canvasWidth,
          height: vm.canvasHeight,
          top: vm.canvasHeight / 2,
          left: vm.canvasWidth / 2,
          stroke: "black",
          strokeWidth: strokeSize,
          fill: "white", // transparent

          originX: "center",
          originY: "center",

          selectable: false,
          hasControls: false,
          hoverCursor: "default",
        });

        // Render the circle in canvas
        editorCanvas.add(square);

        // Add text
        let aggregatedTextRows = vm.lineItemData.text_rows;
        const text = new fabric.IText(aggregatedTextRows, {
          originY: "center",
          originX: "center",
          fontFamily: textFontSlug,
          fontSize: textSize,
          fill: "black",
          textAlign: textAlignment,
          lineHeight: 1,
          // fontWeight: textBold || textItalic ? aggregatedFontStyle : "",
          // Bad support for letter spacing...
          // charSpacing: 100,
        });

        const circle = new fabric.Circle({
          radius: 100,
          fill: "rgba(0,0,0,0)", // transparent
          // fill: "rgba(235,235,235,1)", // transparent
          originX: "center",
          originY: "center",
        });

        const linesObjectHeight = 50;
        const linesObjectWidth = 50;
        let localOffsetTop = 0;
        let localOffsetLeft = 0;

        const linesObject = new fabric.Group([circle, text], {
          width: linesObjectWidth,
          height: linesObjectHeight,
          // top: localOffsetTop - linesObjectHeight,
          // left: localOffsetLeft - linesObjectWidth,
          top: vm.canvasHeight / 2,
          left: vm.canvasWidth / 2,

          // Remove possibilities to move text
          selectable: false,
          hasControls: false,
          hoverCursor: "default",
        });

        // Centering
        // linesObject.centerV();
        // linesObject.centerH();

        editorCanvas.centerObject(linesObject);
        editorCanvas.add(linesObject);
      },

      // https://github.com/eligrey/canvas-toBlob.js/blob/master/canvas-toBlob.js

      downloadCanvasAsImage() {
        const vm = this;
        const editorCanvas = vm.editorCanvas;
        const fileType = "image/png";
        const dataURL = editorCanvas.toDataURL();

        const fileNameString = `${this.lineItemData.order_id}-${this.lineItemData.item_id}-${this.lineItemData.product_width}x${this.lineItemData.product_height}-x5size.png`;

        const a = document.createElement("a");
        a.download = fileNameString;
        a.href = dataURL;
        a.dataset.downloadurl = [fileType, a.download, a.href].join(":");
        a.style.display = "none";
        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);
        setTimeout(function () {
          URL.revokeObjectURL(a.href);
        }, 1500);
      },

      downloadCanvasAsSvg() {
        // https://codepen.io/Kidkie/pen/rNRwXWb
        // 'image/svg+xml, 'ittsasvg.svg'
        const vm = this;
        const editorCanvas = vm.editorCanvas;
        const fileType = "image/svg";
        // const fileType = "application/pdf";
        const fileEnding = ".svg";
        // const fileEnding = ".pdf";
        const svg = editorCanvas.toSVG();

        const fileNameString = `${this.lineItemData.order_id}-${this.lineItemData.item_id}-${this.lineItemData.product_width}x${this.lineItemData.product_height}${fileEnding}`;

        const blob = new Blob([svg], { type: fileType });

        const a = document.createElement("a");
        a.download = fileNameString;
        a.href = URL.createObjectURL(blob);
        a.dataset.downloadurl = [fileType, a.download, a.href].join(":");
        a.style.display = "none";
        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);
        setTimeout(function () {
          URL.revokeObjectURL(a.href);
        }, 1500);
      },
    },
  });
}
