<template>
  <div v-if="fonts">
    <div>
      <ul class="font-loader">
        <li
          class="font-loader-item"
          :class="['font__' + fontVariant.slug]"
          v-for="(fontVariant, index) in fonts"
          :key="index"
        >
          <div :class="fontVariant.slug">{{ fontVariant.name }}</div>
          <div v-if="fontVariant.bold == 1" :class="fontVariant.slug + 'bold'">
            1
          </div>
          <div
            v-if="fontVariant.italic == 1"
            :class="fontVariant.slug + 'italic'"
          >
            2
          </div>
          <div
            v-if="fontVariant.italic == 1 && fontVariant.bold == 1"
            :class="fontVariant.slug + 'bolditalic'"
          >
            3
          </div>
        </li>
      </ul>
    </div>
  </div>
</template>

<script>
export default {
  name: "FontLoader",
  props: {
    fonts: {
      type: Object,
      default: {},
    },
  },
  data() {
    return {};
  },
  methods: {},
};
</script>

<style lang="scss">
// ---------------------------------------------
// Font Loader
// ---------------------------------------------
.font-loader {
  list-style-type: none;
  display: flex;
  margin: 0;
  padding: 0;

  width: 100%;
  height: 2px;
  position: relative;
  overflow: hidden;
  visibility: hidden;

  li {
    text-align: center;
    flex: 1;
    height: 5px;
    overflow: hidden;
    vertical-align: top;
    background-color: #eee;
  }
  //   display: inline-block;
  //   margin: 0;
  //   padding: 0;
  //   width: 100%;
  //   height: 2px;
  //   list-style-type: none;
  //   position: relative;
  //   overflow: hidden;
  //   visibility: hidden;

  /*
  &::before {
    content: "";
    width: 100%;
    height: 100%;
    background-color: white;
    position: absolute;
    top: 0;
    left: 0;
  }

  .font-loader-item {
    font-size: 0;
    line-height: 0;
    height: 2px;

    &.active {
      //
    }
  }

  li {
    display: inline-block;
    vertical-align: top;

    div {
      color: var(--main-green);
      display: inline-block;
      height: 5px;
      background-color: var(--main-green);

      overflow: hidden;
      vertical-align: top;
    }
  }
  */
}
</style>
