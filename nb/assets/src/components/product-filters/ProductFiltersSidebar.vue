<template>
  <div class="product-filters product-filters__desktop">
    <div class="product_list__filters-wrapper">
      <form>
        <div v-if="productFiltersObject" class="product_list__filters">
          <div
            v-if="productFiltersObject.materials"
            class="product_list__filters__group"
          >
            <!-- Dropdown Start -->
            <div>
              <h3>
                <span v-if="languageStrings.all_materials">{{
                  languageStrings.all_materials
                }}</span>
              </h3>
              <div>
                <div
                  class="filter-item"
                  v-for="(
                    materialItem, index
                  ) in productFiltersObject.materials"
                  :key="index"
                >
                  <div>
                    <input
                      :id="materialItem.slug"
                      :name="materialItem.slug"
                      type="checkbox"
                      :value="materialItem.slug"
                      v-model="tagFilters"
                      @change="filterEvent"
                    />
                    <label :for="materialItem.slug">{{
                      materialItem.name
                    }}</label>
                  </div>
                </div>
              </div>
            </div>
            <!-- Dropdown End -->
          </div>

          <div
            v-if="productFiltersObject.tags"
            class="product_list__filters__group"
          >
            <!-- Dropdown Start -->
            <div>
              <h3>
                <span v-if="languageStrings.all_shapes">{{
                  languageStrings.all_shapes
                }}</span>
              </h3>
              <div
                class="filter-item"
                v-for="(tagItem, index) in productFiltersObject.tags"
                :key="index"
              >
                <div>
                  <input
                    :id="'tags' + tagItem.slug"
                    :name="'tags' + tagItem.slug"
                    type="checkbox"
                    :value="tagItem.slug"
                    v-model="tagFilters"
                    @change="filterEvent"
                  />
                  <label :for="'tags' + tagItem.slug">{{ tagItem.name }}</label>
                </div>
              </div>
            </div>
            <!-- Dropdown End -->
          </div>

          <div
            v-if="productFiltersObject.interfaces"
            class="product_list__filters__group"
          >
            <!-- Dropdown Start -->
            <div>
              <h3>
                <span v-if="languageStrings.all_interfaces">{{
                  languageStrings.all_interfaces
                }}</span>
              </h3>
              <div
                class="filter-item"
                v-for="(
                  interfaceItem, index
                ) in productFiltersObject.interfaces"
                :key="index"
              >
                <div>
                  <input
                    :id="'interface' + interfaceItem.slug"
                    :name="'interface' + interfaceItem.slug"
                    type="checkbox"
                    :value="interfaceItem.slug"
                    v-model="tagFilters"
                    @change="filterEvent"
                  />
                  <label :for="'interface' + interfaceItem.slug">{{
                    interfaceItem.name
                  }}</label>
                </div>
              </div>
            </div>
            <!-- Dropdown End -->
          </div>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
export default {
  name: "ProductFiltersSidebar",
  props: {
    productFiltersObject: {
      type: Object,
      default: {},
    },
    languageStrings: {
      type: Object,
      default: {},
    },
    clearFilters: {
      type: Function,
    },
  },
  data() {
    return {
      filtered: [],
      tagFilters: [],
      materialFiltersOptions: [],
      tagFiltersOptions: [],
      dropDownOpen: "",
    };
  },
  computed: {
    tagFilters() {
      return this.productFiltersObject?.tags;
    },
  },
  methods: {
    filterEvent() {
      this.$emit("filter-trigger", this.tagFilters);
    },
    toggleDropDown(dropDownName) {
      if (this.dropDownOpen.length > 0 && this.dropDownOpen === dropDownName) {
        this.dropDownOpen = "";
      } else {
        this.dropDownOpen = dropDownName;
      }
    },
    clearAllFilters() {
      this.tagFilters = [];
      this.$emit("filter-trigger", this.tagFilters);
    },
  },
};
</script>

<style scoped lang="scss">
.product-filters {
  display: flex;

  @media (max-width: 768px) {
    &.product-filters__desktop {
      // Filters on mobile is opened in dialog
      // display: none;
    }
  }

  .product_list__filters {
    display: flex;
    flex-direction: column;
    flex-wrap: wrap;
    padding-bottom: 24px;
    gap: 16px;

    &-wrapper {
      display: flex;
      flex-direction: column;
      align-items: start;
      max-width: 560px;
      width: 100%;
      padding: 0 24px 24px 24px;

      form {
        width: 100%;
        margin-bottom: 0;
      }
    }

    &__group {
      h3 {
        font-size: 1rem;
        margin-bottom: 8px;
      }
      .filter-item {
        color: #4a4a4a;
        display: block;
        font-size: 0.875rem;
        line-height: 1.5;
        padding: 0.375rem 1rem;
      }
    }

    & > div {
      flex: 1;
    }
    &--desktop {
    }
  }

  label {
    cursor: pointer;
  }
  input {
    &[type="checkbox"] {
    }
  }
  &__options {
    display: flex;
  }
}
</style>
