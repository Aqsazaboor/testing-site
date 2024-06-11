import "./vendor/pep.min.js";
import "./vendor/drawer-menu.js";
// import FastClick from "./vendor/fastclick.js";

// Bulma DropDown
// const dropdown = document.querySelector(".dropdown");
// dropdown.addEventListener("click", function (event) {
//   event.preventDefault();
//   event.stopPropagation();
//   dropdown.classList.toggle("is-active");
// });

// Get all dropdowns on the page that aren't hoverable.
const dropdowns = document.querySelectorAll(".dropdown:not(.is-hoverable)");
if (dropdowns.length > 0) {
  // For each dropdown, add event handler to open on click.
  dropdowns.forEach(function (el) {
    el.addEventListener("click", function (e) {
      e.stopPropagation();
      el.classList.toggle("is-active");
    });
  });

  // If user clicks outside dropdown, close it.
  document.addEventListener("click", function (e) {
    closeDropdowns();
  });
}

/*
 * Close dropdowns by removing `is-active` class.
 */
function closeDropdowns() {
  dropdowns.forEach(function (el) {
    el.classList.remove("is-active");
  });
}

// Close dropdowns if ESC pressed
document.addEventListener("keydown", function (event) {
  let e = event || window.event;
  if (e.key === "Esc" || e.key === "Escape") {
    closeDropdowns();
  }
});

// Cookie Consent Code
// If cookie consent = empty or === notapproved
// Add class to cookie-modal to show it...
// if approved, don't do anything

const cookieConsentApproval = localStorage.getItem("cookieConsent");
if (
  cookieConsentApproval !== "approved" ||
  cookieConsentApproval === null ||
  cookieConsentApproval === undefined
) {
  const div = document.querySelector("#cookie-consent-modal");
  div.classList.add("not-approved");
  const cookieConsentButton = document.getElementById("approve-cookies-policy");
  cookieConsentButton.addEventListener("click", function () {
    localStorage.setItem("cookieConsent", "approved");
    div.classList.remove("not-approved");
  });
}

function add_click_event_to_cart_offers() {
  const cartItems = document.querySelectorAll(".cart-offer");
  if (typeof cartItems != "undefined" && cartItems != null) {
    [].forEach.call(cartItems, function (element) {
      const product_id = element.getAttribute("data-pid");
      element.addEventListener("click", function (event, index) {
        event.preventDefault();
        add_offer_to_cart(product_id, 1);
      });
    });
  }
}

// Wrap login form in div
const loginForm = document.querySelector(".woocommerce-form-login");
if (loginForm && loginForm.length > 0) {
  const el = document.querySelector(".entry .woocommerce");
  const loginWrapper = document.createElement("div");
  if (loginWrapper) {
    el.parentNode.insertBefore(loginWrapper, el);
    loginWrapper.classList.add("woocommerce-form-login__wrapper");
    loginWrapper.appendChild(el);
  }
}

// Add to cart with jQuery
function add_offer_to_cart(product_id, quantity = 1) {
  // let's check is add-to-cart.min.js is enqueued and parameters are presented
  if ("undefined" === typeof wc_add_to_cart_params) {
    return false;
  }

  jQuery.post(
    wc_add_to_cart_params.wc_ajax_url
      .toString()
      .replace("%%endpoint%%", "add_to_cart"),
    {
      product_id: product_id,
      quantity: quantity, // quantity is hardcoced her
    },
    function (response) {
      if (!response) {
        return;
      }
      // redirect is optional and it depends on what is set in WooCommerce configuration
      if (response.error && response.product_url) {
        window.location = response.product_url;
        return;
      }
      if ("yes" === wc_add_to_cart_params.cart_redirect_after_add) {
        window.location = wc_add_to_cart_params.cart_url;
        return;
      }
      // refresh cart fragments etc
      jQuery(document.body).trigger("added_to_cart", [
        response.fragments,
        response.cart_hash,
      ]);
    }
  );
}

// When cart is updated, the cart offers must get event triggers again...
function refresh_click_events() {
  // https://wordpress.stackexchange.com/questions/342148/list-of-js-events-in-the-woocommerce-frontend
  setTimeout(() => {
    add_click_event_to_cart_offers();
  }, 500);
}

// It's enough to listen to this event:
jQuery("body").on({
  updated_cart_totals: function () {
    refresh_click_events();
  },
});

window.addEventListener("load", (event) => {
  // Previous orders popup
  const getPreviousOrders = previousOrders ? previousOrders : {};
  if (getPreviousOrders?.products?.length > 0) {
    const randomMax = getPreviousOrders.products.length;
    const langString = getPreviousOrders?.lang_string;
    let randomIndex = Math.floor(Math.random() * randomMax);
    const randomProduct =
      getPreviousOrders.products[randomIndex]?.order_product;
    if (
      randomProduct?.product_url !== undefined &&
      randomProduct?.product_image !== undefined &&
      randomProduct?.product_name !== undefined &&
      randomProduct?.product_name.length > 0
    ) {
      const previousOrdersElement = document.getElementById("recent-orders");
      const recentOrders = document.getElementById("recent-orders__content");

      const closeRecentOrdersPopup = () => {
        previousOrdersElement.classList.remove("active");
      };
      recentOrders.innerHTML = `<div><a href="${randomProduct.product_url}"><div class="product-image"><img src="${randomProduct.product_image}" alt="${randomProduct.product_name}" /></div><div class="product-title"><span class="text-bold">${langString} </span><span>${randomProduct.product_name}</span></div></a>`;

      setTimeout(() => {
        previousOrdersElement.classList.add("active");
      }, 2000);

      setTimeout(() => {
        previousOrdersElement.classList.remove("active");
      }, 10000);

      const closeRecentOrders = document.getElementById("recent-orders__close");
      closeRecentOrders.addEventListener("click", closeRecentOrdersPopup);
    }
  }

  (() => {
    const openButton = document.getElementById("drawer-menu__trigger");
    const openButtonMobile = document.getElementById(
      "drawer-menu__trigger--mobile"
    );
    const openButtonMobileMenuOnly = document.getElementById(
      "drawer-menu__trigger--mobile--menu"
    );
    //
    const closeButton = document.getElementById("drawer-menu__close");
    const dialog = document.getElementById("drawer-menu");
    dialog.returnValue = "favAnimal";

    function openCheck(dialog) {
      if (dialog.open) {
        dialog.close();
        document.body.classList.add("drawer-menu-active");
      } else {
        dialog.showModal();
        document.body.classList.remove("drawer-menu-active");
      }
    }

    // Button opens a modal dialog
    if (typeof openButton != "undefined" && openButton != null) {
      openButton.addEventListener("click", () => {
        openCheck(dialog);
      });
    }

    // Button opens a modal dialog
    if (typeof openButtonMobile != "undefined" && openButtonMobile != null) {
      openButtonMobile.addEventListener("click", () => {
        openCheck(dialog);
      });
    }

    // Menu only
    if (
      typeof openButtonMobileMenuOnly != "undefined" &&
      openButtonMobileMenuOnly != null
    ) {
      openButtonMobileMenuOnly.addEventListener("click", () => {
        openCheck(dialog);
      });
    }

    // Form close button closes the dialog box
    if (typeof closeButton != "undefined" && closeButton != null) {
      closeButton.addEventListener("click", () => {
        openCheck(dialog);
      });
    }
  })();

  // Back button
  const backbuttonTrigger = document.getElementById("menu-item-back-button");
  if (typeof backbuttonTrigger != "undefined" && backbuttonTrigger != null) {
    backbuttonTrigger.addEventListener("click", (event) => {
      event.preventDefault();
      history.back();
    });
  }

  // Checkout Accordion
  function triggerAccordion(questionId) {
    const accordionContent = document.getElementById(questionId);
    if (accordionContent.classList.contains("faq__answer--open")) {
      accordionContent.classList.remove("faq__answer--open");
    } else {
      accordionContent.classList.add("faq__answer--open");
    }
  }
  const checkoutFaqContainer = document.getElementById(
    "checkout__faq--container"
  );
  if (
    typeof checkoutFaqContainer != "undefined" &&
    checkoutFaqContainer != null
  ) {
    const accordionTrigger = document.querySelectorAll(
      ".faq__question--trigger"
    );
    for (let i = 0; i < accordionTrigger.length; i++) {
      accordionTrigger[i].addEventListener("click", (event) => {
        event.preventDefault();
        const thisElement = accordionTrigger[i];
        const dataAttr = thisElement.dataset.content;
        triggerAccordion(dataAttr);
      });
    }
  }

  // Site search
  function showSearch() {
    const accordionContent = document.getElementById("site-search");
    if (accordionContent.classList.contains("site-search__active")) {
      accordionContent.classList.remove("site-search__active");
    } else {
      accordionContent.classList.add("site-search__active");
    }
  }
  const searchTrigger = document.querySelector(".search-trigger");
  if (typeof searchTrigger != "undefined" && searchTrigger != null) {
    searchTrigger.addEventListener("click", (event) => {
      event.preventDefault();
      showSearch();
    });
  }

  // Cart offer item
  const cartItems = document.querySelectorAll(".cart-offer");
  if (typeof cartItems != "undefined" && cartItems != null) {
    add_click_event_to_cart_offers();
  }
});
