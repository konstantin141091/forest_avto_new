<template>
    <ul class="sort">
        <li>Сортировать по:</li>
<!--        <li class="current">умолчанию</li>-->
        <li @click="sortByPrice"><p v-bind:class="{ selected: price }">цене</p></li>
        <li @click="sortByDate"><p v-bind:class="{ selected: date }">дате доставки</p></li>
    </ul>
</template>

<script>
  export default {
    name: "ProductSortComponent",
    props: {
      type: {
        required: true,
      }
    },
    data() {
      return {
        price: false,
        date: false,
      }
    },
    methods: {
      sortByPrice() {
        if (this.type === 'original') {
          this.$root.$refs.productListOriginal.sortByPrice();
        } else {
          this.$root.$refs.productListAnalog.sortByPrice();
        }
        this.price = true;
        this.date = false;
      },
      sortByDate() {
        if (this.type === 'original') {
          this.$root.$refs.productListOriginal.sortByDate();
        } else {
          this.$root.$refs.productListAnalog.sortByDate();
        }
        this.price = false;
        this.date = true;
      }
    }
  }
</script>

<style lang="scss" scoped>
    .sort {
        li p {
            cursor: pointer;
            margin: 0;
            font-weight: 600;
            color: #26272D;
            border-bottom: 1px dashed #26272D;
        }
    }
    .selected {
        color: #989898!important;
        border-bottom: none!important;
    }

</style>
