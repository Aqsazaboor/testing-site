<template>
  <div v-cloak>
    <Loading v-if="loading" :loadingText="getLanguageStrings.loading" />
    <div
      class="container"
      v-if="!loading && filteredProducts && products.length > 0"
    >
      <div v-if="products.length > 0" class="columns is-multiline">
        <div
          class="column product_list__filters"
          :class="setColumnLayout('sidebar')"
        >
          <template
            v-if="filterOptions && filterOptions.layout === 'dropdowns'"
          >
            <ProductFiltersDropdowns
              ref="productFiltersComponent"
              :productFiltersObject="filterOptions"
              @filter-trigger="filterValuesCallback"
              :languageStrings="getLanguageStrings"
            />
          </template>
          <template v-if="filterOptions && filterOptions.layout === 'sidebar'">
            <ProductFiltersSidebar
              ref="productFiltersComponent"
              :productFiltersObject="filterOptions"
              @filter-trigger="filterValuesCallback"
              :languageStrings="getLanguageStrings"
            />
          </template>
        </div>

        <div
          class="column product_list__products"
          :class="setColumnLayout('product')"
        >
          <div class="column product_list__count">
            <div v-if="products.length > 0">
              <div>
                <span
                  ><template v-if="getLanguageStrings.products"
                    >{{ getLanguageStrings.products }}:</template
                  >
                  {{ productsFilter.length }} st
                </span>
              </div>
              <div v-if="!filterTags.includes('all')">
                <button
                  class="button is-text"
                  @click.prevent="
                    $refs.productFiltersComponent.clearAllFilters()
                  "
                >
                  {{ getLanguageStrings.clear_filters }}
                </button>
              </div>
            </div>
          </div>
          <div
            v-if="productsFilter.length > 0"
            class="columns product-list is-multiline"
          >
            <ProductItem
              v-for="(productItem, index) in productsFilter"
              :key="index"
              :productData="productItem"
              :languageStrings="getLanguageStrings"
            />
          </div>
          <div v-else class="column is-full">
            <div class="product-list__empty">
              <p v-if="getLanguageStrings.filter_no_products_found">
                <span>{{ getLanguageStrings.filter_no_products_found }}</span>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
const siteSettingsObject = siteSettings;
const languageStrings =
  typeof language_string !== "undefined" ? language_string : [];
const getFilterOptions =
  typeof filterOptions !== "undefined" ? filterOptions : [];

import ProductItem from "./components/product/ProductItem.vue";
import ProductFiltersDropdowns from "./components/product-filters/ProductFiltersDropdowns.vue";
import ProductFiltersSidebar from "./components/product-filters/ProductFiltersSidebar.vue";
import Loading from "./components/loading/Loading.vue";

export default {
  name: "ProductsApp",
  components: {
    ProductItem,
    ProductFiltersDropdowns,
    ProductFiltersSidebar,
    Loading,
  },
  data() {
    return {
      products: [],
      filterOptions: {},
      siteSettings: {},
      uploadsDir: "",
      productsObject: {},
      loading: true,
      filterTags: ["all"],
      filteredProducts: {},
      getLanguageStrings: {},
    };
  },
  mounted() {
    const vm = this;
    vm.siteSettings = siteSettingsObject;
    vm.uploadsDir = vm.siteSettings.uploads_dir;

    if (languageStrings) {
      vm.getLanguageStrings = languageStrings;
    }

    if (getFilterOptions.products.length > 0) {
      vm.products = getFilterOptions.products;
      vm.loading = false;
    }
    if (Object.entries(getFilterOptions).length > 0) {
      vm.filterOptions = getFilterOptions.filters;
    }
  },
  computed: {
    productsFilter() {
      const filterTagsArray = this.filterTags;
      const filterAllProducts = this.products;

      if (filterTagsArray.includes("all")) {
        return filterAllProducts;
      } else {
        const filterPrefix = "material-";
        let productsFilteredMaterials = [];
        let productsFilterOther = [];

        const filterMaterials = (productSpecs) => {
          // When filtering materials, include everything that's in there.
          // Then do filters that are not material on this
          const productSpecsArray = productSpecs.split(" ");
          const hasFilter = filterTagsArray.map((filter) => {
            if (
              filter.includes(filterPrefix) &&
              productSpecsArray.includes(filter)
            ) {
              return true;
            }
            return false;
          });
          return hasFilter.includes(true);
        };

        filterAllProducts.forEach((productItem) => {
          if (filterMaterials(productItem.filters)) {
            productsFilteredMaterials.push(productItem);
          }
        });

        const filterMultiple = (productSpecs) => {
          // Filters with material- as prefix should be added if they
          // match any filter option, not excluded
          const excludeMaterials = filterTagsArray.filter((filterName) => {
            return !filterName.includes(filterPrefix);
          });
          const filterTagsArrayLength = excludeMaterials.length;
          const productSpecsArray = productSpecs.split(" ");
          let matchedFilters = 0;
          excludeMaterials.map((filterCondition) => {
            if (productSpecsArray.includes(filterCondition)) {
              matchedFilters++;
            }
            return matchedFilters === filterTagsArrayLength;
          });
          return matchedFilters === filterTagsArrayLength;
        };

        productsFilteredMaterials.forEach((productItem) => {
          if (filterMultiple(productItem.filters)) {
            productsFilterOther.push(productItem);
          }
        });
        return productsFilterOther;
      }
    },
  },
  methods: {
    setColumnLayoutClass(columnName) {
      return `${columnName}__${this.filterOptions.layout}`;
    },
    setColumnLayout(columnName) {
      if (columnName === "sidebar") {
        return this.filterOptions.layout === "dropdowns"
          ? "is-full"
          : "is-one-quarter";
      } else if (columnName === "products") {
        return this.filterOptions.layout === "dropdowns" ? "is-full" : "";
      }
    },

    filterValuesCallback(filters) {
      if (filters.length < 1) {
        this.filterTags = ["all"];
      } else {
        this.filterTags = filters;
      }
    },
  },
};
</script>

<style scoped lang="scss">
.product-list {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  margin-top: 8px;
  padding: 16px;

  @media (max-width: 992px) {
    justify-content: center;
    padding: 0;
  }
}

// .product_list {
//   &__filters {
//     padding-bottom: 0;
//     & + .product_list__products {
//       padding-top: 0;
//     }
//   }
// }
</style>
