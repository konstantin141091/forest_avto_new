<template>
    <div>
        <div class="result-table" v-for="(brand) in productList" v-if="loading">
            <div class="product-info-td">
                <div class="tr">
                    <div class="caption">Описание товара</div>
                </div>
                <div class="tr">
                    <div class="td">
                        <div class="product-info-td__title">{{ brand[0].brand_name }}
                            <span>{{ brand[0].product_id }}</span>
                        </div>
                        <div class="product-info-td__desc">{{ brand[0].name }}</div>
                    </div>
                </div>
            </div>
            <div class="stocks-info-td">
                <div class="tr">
                    <div class="caption">Наличие</div>
                    <div class="caption">Дата доставки</div>
                    <div class="caption">Цена</div>
                    <div class="caption">Кол-во</div>
                </div>
                <ProductComponent v-for="(product, index) in brand" :product="product" v-if="index < paginate[brand[0].brand_name]"></ProductComponent>
                <div class="vue-paginate">
                    <p @click="incrementPaginate(brand[0].brand_name)">Показать еще 4 предложения</p>
                </div>

            </div>

        </div>
    </div>
</template>

<script>
  import ProductComponent from './ProductComponent';
  export default {
    name: "ProductsListComponent",
    components: {
      ProductComponent
    },
    data() {
      return ({
        paginate: {
          'NISSAN': 4,
          'RENAULT': 4,
        },
        loading: false,
      })
    },
    props: {
      products: {
        required: true,
      }
    },
    computed: {
      productList() {
        return this.products;
      },

    },
    methods: {
      incrementPaginate(brand) {
        this.paginate[brand] = this.paginate[brand] + 4;
      },
      getPaginateBrand(brand) {
        console.log(this.paginate[brand]);
        if (this.paginate[brand]) {
          return this.paginate[brand]
        } else return 4;
      },
      paginateName(brand) {
        return this.paginate[brand];

      },
      sortByPrice() {

      },
      test() {
        console.log('123');
      }
    },
    mounted() {
      for (let brand in this.products) {
          this.paginate[brand] = 4;
      }
      this.loading = true;
    }
  }
</script>

<style lang="scss" scoped>
    .vue-paginate {
        padding: 16px 0;
        p {
            margin: 0;
            font-style: normal;
            font-weight: 600;
            font-size: 14px;
            line-height: 17px;
            text-align: center;
            color: #D63838;
            cursor: pointer;
        }
        p:hover {
            color: #F06A6A;
        }

    }

</style>
