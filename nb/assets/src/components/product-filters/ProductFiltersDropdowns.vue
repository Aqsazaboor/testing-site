<template>
  <div class="product-filters product-filters__desktop">
    <div class="product_list__filters-wrapper">
      <form>
        <div v-if="productFiltersObject" class="product_list__filters">
          <div v-if="productFiltersObject.materials">
            <!-- Dropdown Start -->
            <div>
              <div
                class="dropdown"
                :class="dropDownOpen === 'materials' ? 'is-active' : ''"
              >
                <div class="dropdown-trigger">
                  <button
                    class="button is-primary"
                    aria-haspopup="true"
                    aria-controls="dropdown-menu"
                    type="button"
                    @click.prevent="toggleDropDown('materials')"
                  >
                    <span v-if="languageStrings.all_materials">{{
                      languageStrings.all_materials
                    }}</span>
                    <span class="icon is-small">
                      <i class="fas fa-angle-down" aria-hidden="true"></i>
                    </span>
                  </button>
                </div>
                <div class="dropdown-menu" id="dropdown-menu" role="menu">
                  <div class="dropdown-content">
                    <div>
                      <div
                        class="dropdown-item"
                        v-for="(
                          materialItem, index
                        ) in productFiltersObject.materials"
                        :key="index"
                      >
                        <div>
                          <input
                            :id="'material' + materialItem.slug"
                            :name="'material' + materialItem.slug"
                            type="checkbox"
                            :value="materialItem.slug"
                            v-model="tagFilters"
                            @change="filterEvent"
                          />
                          <label :for="'material' + materialItem.slug">{{
                            materialItem.name
                          }}</label>
                        </div>
                      </div>
                    </div>
                    <template
                      v-if="
                        tagFilters.length > 0 && languageStrings.clear_filters
                      "
                    >
                      <hr class="dropdown-divider" />
                      <div class="dropdown-item is-active">
                        <button
                          class="button is-small"
                          @click.prevent="(tagFilters = []), filterEvent()"
                        >
                          {{ languageStrings.clear_filters }}
                        </button>
                      </div>
                    </template>
                  </div>
                </div>
              </div>
            </div>
            <!-- Dropdown End -->
          </div>

          <div v-if="productFiltersObject.tags">
            <!-- Dropdown Start -->
            <div>
              <div
                class="dropdown"
                :class="dropDownOpen === 'tags' ? 'is-active' : ''"
              >
                <div class="dropdown-trigger">
                  <button
                    class="button is-primary"
                    aria-haspopup="true"
                    aria-controls="dropdown-menu"
                    type="button"
                    @click.prevent="toggleDropDown('tags')"
                  >
                    <span v-if="languageStrings.all_shapes">{{
                      languageStrings.all_shapes
                    }}</span>
                    <span class="icon is-small">
                      <i class="fas fa-angle-down" aria-hidden="true"></i>
                    </span>
                  </button>
                </div>
                <div class="dropdown-menu" id="dropdown-menu" role="menu">
                  <div class="dropdown-content">
                    <div>
                      <div
                        class="dropdown-item"
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
                          <label :for="'tags' + tagItem.slug">{{
                            tagItem.name
                          }}</label>
                        </div>
                      </div>
                    </div>
                    <template
                      v-if="
                        tagFilters.length > 0 && languageStrings.clear_filters
                      "
                    >
                      <hr class="dropdown-divider" />
                      <div class="dropdown-item is-active">
                        <button
                          class="button is-small"
                          @click.prevent="(tagFilters = []), filterEvent()"
                        >
                          {{ languageStrings.clear_filters }}
                        </button>
                      </div>
                    </template>
                  </div>
                </div>
              </div>
            </div>
            <!-- Dropdown End -->
          </div>

          <div v-if="productFiltersObject.interfaces">
            <!-- Dropdown Start -->
            <div
              class="dropdown"
              :class="dropDownOpen === 'interface' ? 'is-active' : ''"
            >
              <div class="dropdown-trigger">
                <button
                  class="button is-primary"
                  aria-haspopup="true"
                  aria-controls="dropdown-menu"
                  type="button"
                  @click.prevent="toggleDropDown('interface')"
                >
                  <span v-if="languageStrings.all_interfaces">{{
                    languageStrings.all_interfaces
                  }}</span>
                  <span class="icon is-small">
                    <i class="fas fa-angle-down" aria-hidden="true"></i>
                  </span>
                </button>
              </div>
              <div class="dropdown-menu" id="dropdown-menu" role="menu">
                <div class="dropdown-content">
                  <div>
                    <div
                      class="dropdown-item"
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
                  <template
                    v-if="
                      tagFilters.length > 0 && languageStrings.clear_filters
                    "
                  >
                    <hr class="dropdown-divider" />
                    <div class="dropdown-item is-active">
                      <button
                        class="button is-small"
                        @click.prevent="(tagFilters = []), filterEvent()"
                      >
                        {{ languageStrings.clear_filters }}
                      </button>
                    </div>
                  </template>
                </div>
              </div>
            </div>
          </div>
          <!-- Dropdown End -->
        </div>
      </form>
    </div>
  </div>
</template>

<script>
export default {
  name: "ProductFiltersDropdowns",
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
  justify-content: center;

  @media (max-width: 768px) {
    &.product-filters__desktop {
      // Filters on mobile is opened in dialog
      // display: none;
    }
  }

  .product_list__filters {
    display: flex;
    align-items: center;
    flex-direction: column;
    flex-wrap: wrap;
    padding-bottom: 24px;
    gap: 16px;

    &-wrapper {
      display: flex;
      flex-direction: row;
      align-items: start;
      max-width: 560px;
      width: 100%;

      form {
        width: 100%;
        margin-bottom: 0;
      }
    }

    & > div {
      flex: 1;
    }
    &--desktop {
    }
    @media (min-width: 768px) {
      flex-direction: row;
    }

    .dropdown-content {
    }

    .dropdown {
      width: 100%;

      .dropdown-trigger {
        width: 100%;
      }

      .button {
        display: flex;
        width: 100%;
        justify-content: space-between;
      }
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

// .product_list {
//     &__wrapper {
//       background-color: white;
//     }
//     &__filters {
//       display: flex;
//       align-items: center;
//       flex-direction: column;
//       padding-top: 32px;
//       padding-bottom: 24px;
//       background-color: #ddd;
//     }
//     &__count {
//       text-align: center;
//     }

//     &__buttons {
//       display: flex;
//       gap: 8px;
//       margin-bottom: 16px;
//     }

//     .product {
//       padding-bottom: 16px;
//       .product-name {
//       }
//       .price {
//         font-size: 1rem;
//         border-top: none;
//         position: relative;
//       }
//       .product-cta {
//         font-weight: 600;
//         color: var(--blue-500);
//       }
//     }
//   }
</style>
