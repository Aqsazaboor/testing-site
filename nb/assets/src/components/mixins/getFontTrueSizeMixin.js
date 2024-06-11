export default {
  methods: {
    getFontTrueSizeMixin(getTextSizes, textSize) {
      return getTextSizes.filter((size) => {
        return Number(size.truesize) === Number(textSize);
      });
    },
  },
};
