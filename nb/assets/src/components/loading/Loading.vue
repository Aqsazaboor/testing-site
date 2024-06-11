<template>
  <div class="loading">
    <div class="loading-spinner"></div>
    <p>{{ loadingText }}</p>
  </div>
</template>

<script>
export default {
  name: "Loading",
  components: {},
  data() {
    return {};
  },
  props: {
    loadingText: {
      type: String,
      default: "Loading...",
    },
  },
};
</script>

<style scoped lang="scss">
.loading {
  display: flex;
  justify-content: center;
  align-items: center;
  flex-direction: column;
  width: 100%;
  height: 200px;
  .loading-spinner {
    width: 60px;
    height: 60px;
    background-image: url("../../../images/svg/loader.svg");
    background-repeat: no-repeat;
    background-position: center center;
    background-size: 25px;
  }
}
</style>
