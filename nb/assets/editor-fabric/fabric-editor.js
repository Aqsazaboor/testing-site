/*

When working with custom fonts on a fabric canvas, it is recommended to
use a font preloader. Not doing so is likely to cause texts that are
imported onto the canvas to be rendered with a wrong (default) font. It
can also cause you to see a FOUT (Flash of Unstyled Text) right after
changing the font of a text. The reason behind this is that the browser
will only load a font after it is used in the DOM. Preloading fonts
prevents this from happening. In this example we are using Font Face
Observer (https://github.com/bramstein/fontfaceobserver) to preload
Google Fonts, using the following steps:

- Add the custom fonts using @import in your CSS
- Make an array containing the names of all the custom fonts
- Load all the custom fonts using a promise or load them by request
- When the promise is fulfilled, initialize the fabric canvas

*/

// Fonts
// http://fabricjs.com/loadfonts

window.onload = function () {
  console.table(signobj);

  let canvas = new fabric.Canvas("fcanvas");

  const canvasWidth = signobj.imagewidth;
  const canvasHeight = signobj.imageheight;

  canvas.setWidth(canvasWidth);
  canvas.setHeight(canvasHeight);

  // ---------------------------------------
  // Add image
  // ---------------------------------------
  const productImg = signobj.image;

  // Text editor
  // https://codepen.io/psbolden/pen/NbLJbV

  // ---------------------------------------------------
  // load image
  // ---------------------------------------------------
  fabric.Image.fromURL(productImg, function (img) {
    // img.scaleToWidth(100);
    // img.scaleToHeight(100);

    // add image and text to a group
    var imageObject = new fabric.Group([img], {
      left: 0,
      top: 0,
      selectable: false,
      hasControls: false,
      hoverCursor: "default",
    });

    // add the group to canvas
    canvas.add(imageObject);
    canvas.sendToBack(imageObject);
  });

  // ---------------------------------------------------
  // Add text
  // ---------------------------------------------------

  const textRows = ["Martin", "Ekelund"];
  let aggregatedTextRows = "";

  // Create shadow object
  var shadow = new fabric.Shadow({
    color: "#FFFFFF",
    blur: 0,
    offsetX: 1,
    offsetY: 1,
  });

  textRows.map((textRow, index) => {
    if (index === textRows.length - 1) {
      line = textRow;
    } else {
      line = textRow + "\n";
    }
    aggregatedTextRows += line;
  });

  const multipleLines = new fabric.IText(aggregatedTextRows, {
    left: 0,
    top: 0,
    fontFamily: "Arial",
    fontSize: 29,
    fill: "#000000",
    textAlign: "center",
    lineHeight: 0.9,
    shadow: shadow,

    // Remove possibilities to move text
    selectable: false,
    hasControls: false,
    hoverCursor: "default",
  });

  canvas.add(multipleLines);
  canvas.centerObject(multipleLines);

  // // create text row 1
  // const textRow1 = new fabric.Text("Martin Ekelund", {
  //   left: canvasWidth / 2,
  //   top: 5,
  //   fontSize: 29,
  //   fontFamily: "Verdana",
  //   fill: "black",
  //   editable: true,
  // });

  // // create text row 2
  // const textRow2 = new fabric.Text("Hello", {
  //   left: canvasWidth / 2,
  //   top: 50,
  //   fontSize: 29,
  //   fontFamily: "Verdana",
  //   fill: "black",
  //   editable: true,
  // });

  // canvas.add(textRow1);
  // canvas.centerObject(textRow1);

  // canvas.add(textRow2);
  // canvas.centerObject(textRow2);

  // canvas.moveTo(textRow1, 1);

  // const imgInstance = fabric.Image.fromURL(
  //   "http://fabricjs.com/assets/pug_small.jpg",
  //   function (myImg) {
  //     //i create an extra var for to change some image properties
  //     var img1 = myImg.set({
  //       left: 0,
  //       top: 0,
  //       width: canvasWidth,
  //       height: canvasHeight,
  //       lockMovementX: true,
  //       lockMovementY: true,
  //       lockScalingX: true,
  //       lockScalingY: true,
  //       lockRotation: true,
  //       hasControls: false,
  //       hasBorders: false,
  //     });
  //     canvas.add(img1);
  //   }
  // );
  // canvas.add(imgInstance);

  // const newTextBox = new fabric.Textbox("Hello", {
  //   left: 30,
  //   top: 70,
  //   width: 90,
  // });

  // canvas.add(newTextBox);

  // fabric.Image.fromURL(productImg, function (myImg, err) {
  //   canvas.add(myImg);
  //   // console.log(err);
  // });

  // canvas.requestRenderAll();

  // canvas.renderAll();
  // myCanvas.requestRenderAll();

  // const fabricCanvas = new fabric.Canvas("fcanvas");

  // const newTextBox = new fabric.Textbox("Hello", {
  //   left: 0,
  //   top: 70,
  //   width: 90,
  // });
  // fabricCanvas.add(newTextBox);
  // fabricCanvas.backgroundColor = "yellow";
  // fabricCanvas.renderAll();

  // fabric.Image.fromURL(
  //   "http://fabricjs.com/assets/pug_small.jpg",
  //   function (myImg) {
  //     //i create an extra var for to change some image properties
  //     var img1 = myImg.set({ left: 0, top: 0, width: 150, height: 150 });
  //     fabricCanvas.add(img1);
  //   }
  // );

  // fabricCanvas.on("mouse:down", function (event) {
  //   if (canvas.getActiveObject()) {
  //     alert(event.target);
  //   }
  // });

  // var canvas = (this.__canvas = new fabric.Canvas("c"));
  // create a rectangle object
  // const itext = new fabric.IText("This is a IText object", {
  //   left: 100,
  //   top: 150,
  //   fill: "#D81B60",
  //   strokeWidth: 2,
  //   stroke: "#880E4F",
  // });

  // fabricCanvas.add(itext);

  // var canvas = new fabric.Canvas("canvas");
  // // Define an array with all fonts
  // var fonts = ["Pacifico", "VT323", "Quicksand", "Inconsolata"];

  // var textbox = new fabric.Textbox("Lorum ipsum dolor sit amet", {
  //   left: 50,
  //   top: 50,
  //   width: 150,
  //   fontSize: 20,
  // });
  // canvas.add(textbox).setActiveObject(textbox);
  // fonts.unshift("Times New Roman");
  // // Populate the fontFamily select
  // var select = document.getElementById("font-family");
  // fonts.forEach(function (font) {
  //   var option = document.createElement("option");
  //   option.innerHTML = font;
  //   option.value = font;
  //   select.appendChild(option);
  // });

  // // Apply selected font on change
  // document.getElementById("font-family").onchange = function () {
  //   if (this.value !== "Times New Roman") {
  //     loadAndUse(this.value);
  //   } else {
  //     canvas.getActiveObject().set("fontFamily", this.value);
  //     canvas.requestRenderAll();
  //   }
  // };

  // function loadAndUse(font) {
  //   var myfont = new FontFaceObserver(font);
  //   myfont
  //     .load()
  //     .then(function () {
  //       // when font is loaded, use it.
  //       canvas.getActiveObject().set("fontFamily", font);
  //       canvas.requestRenderAll();
  //     })
  //     .catch(function (e) {
  //       console.log(e);
  //       alert("font loading failed " + font);
  //     });
  // }

  // Load all fonts using Font Face Observer
};
