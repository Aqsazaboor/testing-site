<template>
  <div v-if="galleryImages" class="column is-narrow media-sidebar">
    <div v-if="galleryItems" class="gallery__items">
      <div v-for="(image, index) in JSON.parse(galleryImages)" :key="index">
        <button @click.prevent="handleGalleryItems(image)" role="button">
          <img :src="image" alt="" width="600" height="600" />
        </button>
      </div>
    </div>

    <DialogElement
      :dialogToggle="dialogToggle"
      @closeDialog="closeDialog"
      maxWidth="600"
    >
      <template v-slot:header></template>
      <template v-slot:content>
        <div v-if="currentGalleryItem">
          <div class="media-item__large">
            <img alt="" :src="currentGalleryItem" width="600" height="600" />
          </div>
        </div>
      </template>
    </DialogElement>
  </div>
</template>

<script>
import DialogElement from "../dialog-element/DialogElement.vue";

export default {
  name: "MediaGallery",
  components: {
    DialogElement,
  },
  props: {
    galleryImages: {
      type: Object,
      default: {},
    },
  },
  data() {
    return {
      galleryItems: [],
      galleryOpen: false,
      currentGalleryItem: null,
      dialogToggle: false,
    };
  },
  computed() {
    this.galleryItems = JSON.parse(galleryImages);
  },
  methods: {
    closeDialog() {
      this.dialogToggle = false;
    },
    openDialog() {
      this.dialogToggle = !this.dialogToggle;
    },
    handleGalleryItems(image) {
      this.currentGalleryItem = image;
      this.openDialog();
    },
  },
};
</script>

<style scoped lang="scss">
.media-sidebar {
  padding: 8px 24px;
  border-left: none;
  border-top: 1px solid #ddd;
  background-color: white;

  .gallery {
    &__items {
      display: flex;
      flex-direction: row;
      gap: 8px;
    }
  }

  button {
    padding: 0;
    margin: 0;
    border: none;
    background-color: transparent;
  }

  @media (min-width: 992px) {
    max-width: 110px;
    padding: 20px 20px 0 20px;
    border-top: none;
    border-left: 1px solid #ddd;
    background-color: var(--main-lightgrey);

    .gallery {
      &__items {
        gap: 4px;
        flex-direction: column;
      }
    }
  }
  :deep() {
    .dialog {
      max-width: 650px;
      width: 100%;

      .dialog__header {
        border-bottom: 0;
      }

      .media-item {
        &__large {
          padding: 8px;
          background-color: white;
        }
      }
    }
  }
}
</style>
