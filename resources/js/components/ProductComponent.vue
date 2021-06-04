<template>
    <div class="tr">
        <add-to-cart :messages="messages"></add-to-cart>
        <div class="td vue-td__quantity">{{ this.product.offers_quantity }}</div>
        <div class="td vue-td__date">{{ this.product.offers_assured_period }}</div>
        <div class="td vue-td__price">{{ this.product.offers_price }}₽</div>
        <div class="td vue-td__buy">
            <div class="vue-product">
                <div class="count-group">
                    <span class="dec" @click="decrement()">-</span>
                    <div class="vue-product__quantity">{{ this.countQuantity }} шт.</div>
                    <span class="inc" @click="increment()">+</span>
                </div>
                <button class="btn-buy" type="submit" @click="add()">
                    <i class="icon-font icon-cart"></i> Добавить
                </button>
            </div>
        </div>
    </div>
</template>

<script>
  import {mapActions, mapGetters} from "vuex/dist/vuex.mjs";
  import AddToCart from "./modals/AddToCart";
  export default {
    name: "ProductComponent",
    components: {AddToCart},
    props: {
      product: {
        required: true,
      },
      index: {
        required: true,
      }
    },
    data() {
      return ({
        countQuantity: 1,
        messages: []
      })
    },
    methods: {
      ...mapActions([
        'ADD_TO_CART'
      ]),

      increment() {
        if (this.product.offers_quantity > this.countQuantity) {
          this.countQuantity++;
        }
      },

      decrement() {
        if (this.countQuantity > 1) {
          this.countQuantity--;
        }
      },

      add() {
        this.ADD_TO_CART({
          product: this.product,
          countQuantity: this.countQuantity
        });
        let timeStamp = Date.now().toLocaleString();
        this.messages.unshift(
          {name: 'Товар добавлен в корзину!', id: timeStamp}
        )
      }
    },
    computed: {

    },
  }
</script>

<style type="scss" scoped>
    .vue-product {
        display: flex;
        align-items: center;
        width: 100%;
        justify-content: space-between;
        flex-wrap: wrap;
    }
    .vue-product__quantity {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 4%;
    }

    @media screen and (max-width: 1200px){
        .vue-product {
            justify-content: center;
        }
        .btn-buy {
            margin: 10px 0 0 0;
        }
    }
</style>
