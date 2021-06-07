<template>
    <div :key="componentKey">
        <div v-for="(brand) in productList">
            <products-list-brand-component :brand="brand">
            </products-list-brand-component>
        </div>
    </div>
</template>

<script>
  import ProductsListBrandComponent from './ProductsListBrandComponent';
  export default {
    name: "ProductsListComponent",
    components: {
      ProductsListBrandComponent
    },
    props: {
      products: {
        required: true,
      },
      type: {
        required: true,
      }
    },
    data() {
      return {
        lastSortPrice: 'min',
        lastSortDate: 'min',
        componentKey: 0,
      }
    },
    computed: {
      productList() {
        return this.products;
      },
    },
    methods: {
      sortByPrice() {
        if (this.lastSortPrice === 'min') {
          for(let brand in this.products) {
            this.products[brand].sort(function (a, b) {
              if(a.offers_price > b.offers_price)
                return -1;
              if(a.offers_price < b.offers_price)
                return 1;
              if(a.offers_price == b.offers_price)
                return 0;
            })
          }
          this.lastSortPrice = 'max';
        } else {
          for(let brand in this.products) {
            this.products[brand].sort(function (a, b) {
              if(a.offers_price < b.offers_price)
                return -1;
              if(a.offers_price > b.offers_price)
                return 1;
              if(a.offers_price == b.offers_price)
                return 0;
            })
          }
          this.lastSortPrice = 'min';
        }
        this.forceRerender();
      },
      sortByDate() {
        if (this.lastSortDate === 'min') {
          for(let brand in this.products) {
            this.products[brand].sort(function (a, b) {
              if(a.offers_average_period > b.offers_average_period)
                return -1;
              if(a.offers_average_period < b.offers_average_period)
                return 1;
              if(a.offers_average_period == b.offers_average_period)
                return 0;
            })
          }
          this.lastSortDate = 'max';
        } else {
          for(let brand in this.products) {
            this.products[brand].sort(function (a, b) {
              if(a.offers_average_period < b.offers_average_period)
                return -1;
              if(a.offers_average_period > b.offers_average_period)
                return 1;
              if(a.offers_average_period == b.offers_average_period)
                return 0;
            })
          }
          this.lastSortDate = 'min';
        }
        this.forceRerender();
      },
      forceRerender() {
        this.componentKey += 1;
      }
    },
  }
</script>

<style lang="scss" scoped>

</style>
