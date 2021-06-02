<template>
    <div class="tr">
        <add-to-cart :messages="messages"></add-to-cart>
        <div class="td">{{ this.product.offers_quantity }}</div>
        <div class="td">{{ this.product.offers_assured_period }}</div>
        <div class="td">{{ this.product.offers_price }}₽</div>
        <div class="td">
            <div class="vue-product">
                <div class="count-group">
<!--                    TODO span шт убрал из интупа, здесь надо поравить верстку, позиционирование-->
<!--                    <span>.шт</span>-->
                    <span class="dec" @click="decrement()">-</span>
<!--                    <input type="number" v-model="this.countQuantity">-->
                    <div class="vue-product__quantity">{{ this.countQuantity }} шт.</div>
                    <span class="inc" @click="increment()">+</span>
                </div>
                <button class="btn-buy" type="submit" @click="add()">
                    <i class="icon-font icon-cart"></i> Купить
                </button>
            </div>
        </div>
    </div>
</template>

<script>
  import {mapActions} from "vuex/dist/vuex.mjs";
  import AddToCart from "./modals/AddToCart";
  export default {
    name: "ProductComponent",
    components: {AddToCart},
    props: {
      product: {
        required: true,
      },
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
  }
</script>

<style type="scss" scoped>
    .vue-product {
        display: flex;
        align-items: center;
        width: 100%;
        justify-content: space-between;
        flex-wrap: wrap;
        /*&__quantity {*/
        /*    display: flex;*/
        /*    justify-content: center;*/
        /*    align-items: center;*/
        /*    margin-top: 4%;*/
        /*}*/
    }
    .vue-product__quantity {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 4%;
    }
</style>
