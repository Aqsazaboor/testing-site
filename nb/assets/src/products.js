import Vue from "vue";
import ProductsApp from "./ProductsApp";

const productsAppElement = document.getElementById("productsapp");
if (productsAppElement !== null && productsAppElement !== undefined) {
  new Vue({
    render: (h) => h(ProductsApp),
  }).$mount("#productsapp");
}
