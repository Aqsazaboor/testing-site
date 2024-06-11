<template>
  <div>
    <dialog ref="dialog" id="designer__dialog" class="dialog">
      <div class="dialog__header">
        <slot name="header"></slot>
        <button class="button button__close" @click.prevent="emitCloseDialog()">
          &times;
          <span class="is-sr-only">Close</span>
        </button>
      </div>
      <div class="dialog__wrapper">
        <div class="dialog__content">
          <slot name="content"></slot>
        </div>
      </div>
    </dialog>
  </div>
</template>

<script>
import { ref } from "vue";
const dialog = ref;

export default {
  name: "DialogElement",
  props: {
    dialogToggle: {
      type: Boolean,
      default: false,
    },
    maxWidth: {
      type: String,
      default: "0",
    },
  },
  data() {
    return {};
  },
  methods: {
    emitCloseDialog() {
      this.$emit("closeDialog");
    },
  },
  watch: {
    dialogToggle: function (val) {
      if (val) {
        this.$refs.dialog.showModal();
      } else {
        this.$refs.dialog.close();
      }
    },
  },
};
</script>

<style scoped lang="scss">
dialog {
  width: 400px;
  max-width: 100%;
  padding: 16px 8px;
  background-color: white;
  &::backdrop {
    background-color: rgba(0, 0, 0, 0.5);
  }
  @media (min-width: 992px) {
    padding: 24px;
  }
}
.dialog {
  .button__close {
    font-size: 1.5rem;
    width: 44px;
    height: 44px;
    padding: 8px;
    border: none;
    position: absolute;
    top: -11px;
    right: 0;
  }

  &__wrapper {
    display: flex;
    flex-direction: column;
  }
  &__header {
    text-align: center;
    display: flex;
    align-content: center;
    justify-content: center;
    min-height: 44px;
    padding-bottom: 8px;
    margin-bottom: 8px;
    border-bottom: 1px solid #ddd;
    position: relative;
    h2 {
      font-size: 1.2rem;
      margin: 0;
    }
  }
}
</style>
