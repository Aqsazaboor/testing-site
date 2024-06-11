// Order line items
const app = new Vue({
  el: "#order_line_items",
  data: {
    showEditFields: false,
    showCustomFields: true,
    openExtraFields: [],
  },
  methods: {
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

// Order items aggregated
if (typeof orderLines === "object") {
  const orderStatuses = [
    { name: "Processing", key: "wc-processing" },
    { name: "Skickad och klar", key: "wc-skickad-klar" },
    { name: "Under arbete", key: "wc-in-production" },
    { name: "Pausat", key: "wc-on-hold" },
    { name: "Prioritet", key: "wc-prio-order" },
    { name: "Utkast", key: "wc-checkout-draft" },
    // { name: "Pending", key: "wc-pending" },
    // { name: "Completed", key: "wc-completed" },
    // { name: "Cancelled", key: "wc-cancelled" },
    // { name: "Refunded", key: "wc-refunded" },
    // { name: "Failed", key: "wc-failed" },
  ];
  const ordersObject = orderLines;
  const orderlineApp = new Vue({
    el: "#sdx-app",
    data: {
      allOrders: {},
      orderSingleActive: false,
      orderSingleData: {},
      orderStatusesData: [],
      filtered: "processing",
      prioOrdersCount: 0,
      toggleStatus: "",
      statusChangeSuccess: false,
      loading: false,
      noteText: "",
      orderNotesFiltered: true,
      autoOpenSingle: null,
      checkedOrders: [],
      showDescription: false,
    },
    mounted() {
      this.getOrders(false);

      if (typeof orderStatuses === "object" && orderStatuses.length > 0) {
        this.orderStatusesData = orderStatuses;
      }

      // Get order id
      const urlParams = new URLSearchParams(window.location.search);
      const getOrderId = urlParams.get("order");
      if (getOrderId) {
        this.autoOpenSingle = getOrderId;
      }
    },
    methods: {
      checkIfUndefined(value) {
        const checkValue =
          value === undefined ||
          value === "undefined" ||
          value === null ||
          value === "null" ||
          value === "none";
        return checkValue ? false : true;
      },
      checkEngravingType(value) {
        if (value === "none") {
          return true;
        } else {
          return this.checkIfUndefined(value);
        }
      },
      checkItemEngraving(orderItem) {
        if (
          orderItem === undefined ||
          orderItem === null ||
          orderItem.text_rows === null ||
          orderItem.text_size === 0 ||
          orderItem.order_image.length === 0
        ) {
          return null;
        }
        if (orderItem?.text_size > 6.5 && orderItem?.engravingtype === "none") {
          return "Oifylld lasergravyr";
        } else if (
          orderItem?.product_variant.includes("Plastic") ||
          orderItem?.onlylaser ||
          orderItem?.text_size < 7.5
        ) {
          return "Laser";
        } else {
          return "Djupgravyr";
        }
      },
      getOrderItemOnId(orderId) {
        const updateActiveAgain = this.allOrders.filter((currentItem) => {
          return currentItem?.order_id === Number(orderId);
        });
        this.toggleSingleOrder(updateActiveAgain[0]);
      },
      openSingleOrderOnQuery(orderId) {
        this.getOrderItemOnId(orderId);
      },
      toggleSingleOrder(orderItem) {
        const orderId = orderItem?.order_id;
        const urlParams = new URLSearchParams(window.location.search);
        const getPageParam = urlParams.get("page");
        if (orderId !== undefined && orderId !== null) {
          window?.history?.pushState(
            {},
            window.location,
            "?page=" + getPageParam + "&order=" + orderId
          );
          this.orderSingleData = orderItem;
          this.toggleStatus = orderItem?.order_status;
          this.orderSingleActive = true;
        } else {
          window?.history?.pushState(
            {},
            window.location,
            "?page=" + getPageParam
          );
        }
      },
      countTotalOrderItems() {
        console.log(this.orderSingleData.order_items);
        if (this.orderSingleData.order_items) {
          let orderItemsCount = 0;
          this.orderSingleData.order_items.map((orderItem) => {
            console.log(orderItem.quantity);
            orderItemsCount = orderItemsCount + orderItem.quantity;
          });
          return orderItemsCount;
        }
        return false;
      },
      closeSingleOrder() {
        // Clear query
        const urlParams = new URLSearchParams(window.location.search);
        const getPageParam = urlParams.get("page");
        window?.history?.pushState(
          {},
          window.location,
          "?page=" + getPageParam
        );
        this.showDescription = false;
        this.noteText = "";
        this.orderSingleData = {};
        this.orderSingleActive = false;
        this.orderNotesFiltered = true;
      },
      searchMediaFileURL(noteContent) {
        if (noteContent.search("wp-content/uploads/") !== -1) {
          const urlRegex = /(https?:\/\/[^\s]+)/g;
          return noteContent.replace(urlRegex, function (url) {
            return '<a download href="' + url + '">' + url + "</a>";
          });
        }
        return false;
      },
      convertToCountryString(countryCode) {
        switch (countryCode) {
          case "SE":
            return "Sverige";
          case "DA":
            return "Danmark";
          case "DK":
            return "Danmark";
          case "FI":
            return "Finland";
          case "DE":
            return "Deutschland";
          case "EN":
            return "Great Britain";
          case "UK":
            return "Great Britain";
          case "NL":
            return "Holland";
          default:
            return "Sverige";
        }
      },
      getMaterialLetter(material) {
        if (typeof material === "object" && material.length > 0) {
          const materialString = material[0].toLowerCase();
          switch (materialString) {
            case "brass":
              return "M";
            case "plastic":
              return "P";
            case "aluminum":
              return "A";
            case "oak":
              return "E";
            case "birch":
              return "B";
            case "steel":
              return "S";
          }
        }
        return null;
      },
      triggerPrint() {
        window.print();
      },
      checkOrderStatus(statusOption, orderStatus) {
        return statusOption.indexOf(orderStatus) !== -1;
      },
      toggleOrderStatus(event) {
        this.toggleStatus = event.target.value;
      },
      translateShipping(string) {
        if (
          string.search("Postnord") !== -1 ||
          string.search("Posti") !== -1 ||
          string.search("Pauschale") !== -1 ||
          string.search("PostNL") !== -1
        ) {
          return "Postnord Brev - Ej spårbart";
        } else if (string.toLowerCase().search("dhl") !== -1) {
          return "DHL - Spårbart";
        } else if (string.toLowerCase().search("ups") !== -1) {
          return "UPS - Spårbart";
        }
        return string;
      },
      getPaymentMethod(string) {
        if (string.search("kco") !== -1) {
          return "Klarna Checkout";
        }
        if (string.search("cod") !== -1) {
          return "Cash on Delivery";
        }
      },
      handleOrders(ordersObject, update) {
        const ordersFromAllCountries = ordersObject?.orders
          ? ordersObject.orders
          : {};
        let aggregatedOrders = [];

        Object.entries(ordersFromAllCountries).map((ordersItems) => {
          let addOrders = ordersItems[1];
          aggregatedOrders = aggregatedOrders.concat(addOrders);
        });

        const sortBy = (function () {
          let toString = Object.prototype.toString,
            // default parser function
            parse = function (x) {
              return x;
            },
            // gets the item to be sorted
            getItem = function (x) {
              var isObject = x != null && typeof x === "object";
              var isProp = isObject && this.prop in x;
              return this.parser(isProp ? x[this.prop] : x);
            };

          /**
           * Sorts an array of elements.
           *
           * @param {Array} array: the collection to sort
           * @param {Object} cfg: the configuration options
           * @property {String}   cfg.prop: property name (if it is an Array of objects)
           * @property {Boolean}  cfg.desc: determines whether the sort is descending
           * @property {Function} cfg.parser: function to parse the items to expected type
           * @return {Array}
           */
          return function sortby(array, cfg) {
            if (!(array instanceof Array && array.length)) return [];
            if (toString.call(cfg) !== "[object Object]") cfg = {};
            if (typeof cfg.parser !== "function") cfg.parser = parse;
            cfg.desc = !!cfg.desc ? -1 : 1;
            return array
              .sort(function (a, b) {
                a = getItem.call(cfg, a);
                b = getItem.call(cfg, b);
                return cfg.desc * (a < b ? -1 : +(a > b));
              })
              .reverse(); // Latest at the top...
          };
        })();

        this.allOrders = sortBy(aggregatedOrders, {
          prop: "order_timestamp_created",
        });

        if (update) {
          this.updateActiveSingleOrder();
        }
        // Find prio and add amount to badge
        if (this.allOrders) {
          let prioOrderCount = 0;
          this.allOrders.map((orderItem) => {
            if (orderItem.order_status === "prio-order") {
              prioOrderCount = prioOrderCount + 1;
            }
          });
          this.prioOrdersCount = prioOrderCount;
        }
      },
      getShippingMethod(method) {
        if (method.toLowerCase().indexOf("postnord") !== -1) {
          return "postnord";
        }
        return method.toLowerCase();
      },
      checkMultipleItems(event) {
        console.log(event);
      },
      checkIfClientArea(blogUrl) {
        console.log("check");
        return blogUrl.includes("kundzon");
      },
      updateActiveSingleOrder() {
        const currentActiveId = this.orderSingleData.order_id;
        const updateActiveAgain = this.allOrders.filter((currentItem) => {
          return currentItem?.order_id === currentActiveId;
        });
        this.orderSingleData = updateActiveAgain[0];
      },
      async getOrders(update) {
        this.loading = true;
        const data = new FormData();
        data.append("action", "getorders");
        data.append("nonce", custom_order_page.nonce);

        fetch(custom_order_page.ajax_url, {
          method: "POST",
          credentials: "same-origin",
          body: data,
        })
          .then((response) => response.json())
          .then((data) => {
            this.loading = false;
            if (data.status === 1) {
              this.handleOrders(data, update);
              if (
                this.autoOpenSingle !== null &&
                this.autoOpenSingle !== undefined &&
                this.autoOpenSingle !== "undefined"
              ) {
                this.openSingleOrderOnQuery(this.autoOpenSingle);
              }
            } else {
              console.log("Error, couldn't fetch orders");
            }
          })
          .catch((err) => {
            this.loading = false;
            console.log(err);
          });
      },
      async createOrderLabel(orderId) {
        if (orderId && sslabels_api) {
          const orders = [orderId];
          this.loading = true;

          const data = new FormData();
          data.append("action", "sslabels_api");
          data.append("_ajax_nonce", `${sslabels_api._ajax_nonce}`);
          data.append("orders[]", orders);
          data.append("api_action", "generate_labels");
          data.append("pll_ajax_backend", 1);
          data.append("pll_post_id", orders);

          // Open new browser tab and fill it with labels to print.
          // const popup_window = window.open("", "Shipping Labels");
          // popup_window.document.write(response); // Write the content of the document.
          // popup_window.document.close(); // Finishes writing to a document.

          try {
            fetch(custom_order_page.ajax_url, {
              method: "POST",
              credentials: "same-origin",
              body: data,
            })
              .then((response) => {
                return response.text();
              })
              .then((data) => {
                this.loading = false;
                // Open new browser tab and fill it with labels to print.
                if (data) {
                  const popup_window = window.open("", "Shipping Labels");
                  popup_window.document.write(data); // Write the content of the document.
                  popup_window.document.close(); // Finishes writing to a document.
                }
              })
              .catch((err) => {
                this.loading = false;
                console.log(err);
              });
          } catch (e) {
            console.log(
              "Browser or extension pop-up blocker is enabled. Please add this site to your exceptions list for the generated labels page pop-up window."
            );
          }
        } else {
          console.log("ss labels is not installed!");
        }
      },
      async updateOrderStatus(orderId, blogId) {
        if (orderId && blogId.length > 0) {
          this.loading = true;
          const data = new FormData();
          data.append("action", "cos");
          data.append("nonce", custom_order_page.nonce);
          data.append("order_id", orderId);
          data.append("order_status", this.toggleStatus);
          data.append("blog_id", blogId);

          fetch(custom_order_page.ajax_url, {
            method: "POST",
            credentials: "same-origin",
            body: data,
          })
            .then((response) => response.json())
            .then((data) => {
              this.loading = false;
              if (data.success) {
                // Also reload active single object...
                this.getOrders(true);
              } else {
                console.log("Error, couldn't change order status");
              }
            })
            .catch((err) => {
              this.loading = false;
              console.log(err);
            });
        } else {
          console.log("updateOrderStatus is empty, abort");
        }
      },
      async addOrderNote(orderId, blogId) {
        if (this.noteText.length > 0 && orderId && blogId.length > 0) {
          const data = new FormData();
          data.append("action", "add_note");
          data.append("nonce", custom_order_page.nonce);
          data.append("order_id", orderId);
          data.append("blog_id", blogId);
          data.append("order_note", this.noteText);

          fetch(custom_order_page.ajax_url, {
            method: "POST",
            credentials: "same-origin",
            body: data,
          })
            .then((response) => response.json())
            .then((data) => {
              this.loading = false;
              if (data.success) {
                this.noteText = "";
                this.getOrders(true);
              } else {
                console.log("Error, couldn't add note to order");
              }
            })
            .catch((err) => {
              this.loading = false;
              console.log(err);
            });
        } else {
          console.log("noteContent is empty");
        }
      },
      // changeUrlOnOrder() {
      //   history.pushState(state, "", url);
      // },
    },
  });
}

jQuery(function ($) {
  // Display badge on shortcut to admin page
  if ($(".toplevel_page_woocommerce").length > 0) {
    let ordercount = $(
      ".toplevel_page_woocommerce .awaiting-mod.update-plugins .processing-count"
    ).text();
    if (ordercount > 0) {
      $("#toplevel_page_edit-post_type-shop_order .wp-menu-name").append(
        '<span class="awaiting-mod update-plugins"><span class="processing-count">' +
          ordercount +
          "</span></span>"
      );
    }
  }
});

// --------------------------------------------------------
// Dashboard widget
// --------------------------------------------------------
const appDashboard = new Vue({
  el: "#dashboard-widget",
  data: {
    allOrders: {},
    filtered: "processing",
    prioOrdersCount: 0,
    toggleStatus: "",
    loading: false,
    checkedOrders: [],
  },
  mounted() {
    this.getOrders();
  },
  methods: {
    getProductColor(color) {
      return color.toLowerCase();
    },
    getMaterialLetter(material) {
      if (typeof material === "object" && material.length > 0) {
        const materialString = material[0].toLowerCase();
        switch (materialString) {
          case "brass":
            return "M";
          case "plastic":
            return "P";
          case "aluminum":
            return "A";
          case "oak":
            return "E";
          case "birch":
            return "B";
          case "steel":
            return "S";
        }
      }
      return null;
    },
    getRealOrderUrl(orderItem) {
      return `${orderItem.blog_url}${orderItem.order_url}`;
    },
    handleOrders(ordersObject) {
      const ordersFromAllCountries = ordersObject?.orders
        ? ordersObject.orders
        : {};
      let aggregatedOrders = [];

      Object.entries(ordersFromAllCountries).map((ordersItems) => {
        if (ordersItems.length > 0) {
          let addOrders = ordersItems[1];
          aggregatedOrders = aggregatedOrders.concat(addOrders);
        } else {
          console.log("STOP! No orders to sort!");
          return false;
        }
      });

      const sortBy = (function () {
        let toString = Object.prototype.toString,
          // default parser function
          parse = function (x) {
            return x;
          },
          // gets the item to be sorted
          getItem = function (x) {
            var isObject = x != null && typeof x === "object";
            var isProp = isObject && this.prop in x;
            return this.parser(isProp ? x[this.prop] : x);
          };

        /**
         * Sorts an array of elements.
         *
         * @param {Array} array: the collection to sort
         * @param {Object} cfg: the configuration options
         * @property {String}   cfg.prop: property name (if it is an Array of objects)
         * @property {Boolean}  cfg.desc: determines whether the sort is descending
         * @property {Function} cfg.parser: function to parse the items to expected type
         * @return {Array}
         */
        return function sortby(array, cfg) {
          if (!(array instanceof Array && array.length)) return [];
          if (toString.call(cfg) !== "[object Object]") cfg = {};
          if (typeof cfg.parser !== "function") cfg.parser = parse;
          cfg.desc = !!cfg.desc ? -1 : 1;
          return array
            .sort(function (a, b) {
              a = getItem.call(cfg, a);
              b = getItem.call(cfg, b);
              return cfg.desc * (a < b ? -1 : +(a > b));
            })
            .reverse(); // Latest at the top...
        };
      })();

      this.allOrders = sortBy(aggregatedOrders, {
        prop: "order_timestamp_created",
      });

      // Find prio and add amount to badge
      if (this.allOrders) {
        let prioOrderCount = 0;
        this.allOrders.map((orderItem) => {
          if (orderItem.order_status === "prio-order") {
            prioOrderCount = prioOrderCount + 1;
          }
        });
        this.prioOrdersCount = prioOrderCount;
      }
    },
    async getOrders() {
      this.loading = true;
      const data = new FormData();
      data.append("action", "getorders");
      data.append("nonce", custom_order_page.nonce);

      fetch(custom_order_page.ajax_url, {
        method: "POST",
        credentials: "same-origin",
        body: data,
      })
        .then((response) => response.json())
        .then((data) => {
          this.loading = false;
          if (data.status === 1) {
            this.handleOrders(data);
          } else {
            console.log("Error, couldn't fetch orders");
          }
        })
        .catch((err) => {
          this.loading = false;
          console.log(err);
        });
    },
  },
});
