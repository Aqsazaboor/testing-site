export default {
  methods: {
    calculateVat(price) {
      const varPrecentage = 20;
      const vat = price - (price / 100) * varPrecentage;
      return Math.round(vat * 100) / 100;
    },
  },
};
