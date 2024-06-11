import Vue from "vue";
import App from "./App.vue";

const editorAppElement = document.getElementById("app");
if (editorAppElement !== null && editorAppElement !== undefined) {
  new Vue({
    render: (h) => h(App),
  }).$mount("#app");
}
