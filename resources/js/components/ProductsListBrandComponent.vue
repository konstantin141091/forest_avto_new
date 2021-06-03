<template>
    <div class="result-table">
        <div class="product-info-td">
            <div class="tr">
                <div class="caption">Описание товара</div>
            </div>
            <div class="tr">
                <div class="td">
                    <div class="product-info-td__title">{{ brand[0].brand_name }}
<!--                        <span>{{ brand[0].product_id }}</span>-->
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
            <ProductComponent v-for="(product, index) in brand" :product="product" :index="index" v-if="index < paginate"></ProductComponent>
            <div class="vue-paginate" v-show="paginateClick">
                <p @click="incrementPaginate">Показать еще 4 предложения</p>
            </div>
        </div>
    </div>
</template>

<script>
  import ProductComponent from './ProductComponent';
  export default {
    name: "ProductsListBrandComponent",
    components: {
      ProductComponent
    },
    props: {
      brand: {
        required: true,
      }
    },
    data() {
      return {
        paginate: 4,
      }
    },
    methods: {
      incrementPaginate() {
        this.paginate = this.paginate + 4;
      }
    },
    computed: {
      paginateClick() {
        if (this.brand.length > this.paginate) {
          return true;
        } else {
          return false;
        }
      }
    },
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
