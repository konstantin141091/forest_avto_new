<template>
    <aside class="order-summary__outer">
        <div class="loader-wrapper" v-show="loading">
            <LoaderComponent></LoaderComponent>
        </div>
        <div class="loader-wrapper-dark" v-show="order_created">
            <OrderCreatedComponent :url_index="this.url_index"></OrderCreatedComponent>
        </div>
        <div class="order-summary">
            <div class="order-summary__title"><span>Состав заказа</span> <span>{{ CART_TOTAL_QUANTITY }} товара</span></div>

            <ul class="order-summary__list">

                <li class="order-summary__item order-product-item" v-for="(item) in cartList">
                    <div class="order-product-item__title">{{ item.name }}</div>
                    <div class="order-product-item__count">{{ item.quantity }} шт.</div>
                    <div class="order-product-item__price">
                        <span class="price">{{ item.offers_price }} ₽</span>
                    </div>
                </li>
<!--со скидкой вариант-->
<!--                <li class="order-summary__item order-product-item">-->
<!--                    <div class="order-product-item__title">Lorem ipsum dolor sit amet</div>-->
<!--                    <div class="order-product-item__count">1 шт.</div>-->
<!--                    <div class="order-product-item__price">-->
<!--                        <span class="price">2 530 ₽</span>-->
<!--                        <span class="price&#45;&#45;old">2 530 ₽</span>-->
<!--                    </div>-->
<!--                </li>-->
                <li class="order-summary__item">
                    <div class="order-summary__item-title">Всего:</div>
                    <div class="order-summary__item-value">{{ CART_TOTAL_PRICE }} ₽</div>
                </li>

                <li class="order-summary__item">
                    <div class="order-summary__item-title">Скидка:</div>
                    <div class="order-summary__item-value">0 ₽</div>
                </li>

            </ul>


            <footer class="order-summary__footer">
                <div class="order-summary__sum"><span>Итого:</span><span>{{ CART_TOTAL_PRICE }} ₽</span></div>
                <button disabled class="btn btn_filled order-summary__btn vue-btn" id="cart_btn" @click="createOrder">Оформить заказ</button>
            </footer>
        </div>
    </aside>

</template>

<script>
  import {mapActions, mapGetters} from "vuex/dist/vuex.mjs";
  import LoaderComponent from './LoaderComponent';
  import OrderCreatedComponent from './OrderCreatedComponent';
  export default {
    name: "CartListForCheckout",
    components: {
      LoaderComponent, OrderCreatedComponent
    },
    props: {
      url_index: {
        required: true,
        type: String,
      }
    },
    data() {
      return ({
        loading: false,
        order_created: false,
      })
    },
    computed: {
      ...mapGetters ([
        'CART', 'CART_TOTAL_PRICE', 'CART_TOTAL_QUANTITY'
      ]),
      cartList() {
        return this.CART;
      }
    },
    methods: {
      ...mapActions([
        'API_ADD_ORDER',
      ]),

      async createOrder() {
        this.loading = true;
        const orderForm = await this.$root.$refs.checkoutForm.getForm();
        orderForm.total_price = this.CART_TOTAL_PRICE;
        orderForm.total_quantity = this.CART_TOTAL_QUANTITY;

        const orderResponse = await this.$store.dispatch('API_ADD_ORDER', {
          order: orderForm,
          cart: this.CART,
        });

        // разруливание ответа от сервера
        if (orderResponse.status === 201) {
          await this.$store.dispatch('CLEAR_ALL_CART');
          console.log('Всё прошло успешно. Заказ оформлен');
          this.loading = false;
          this.order_created = true;
        }
        if (orderResponse === 409) {
          await this.$store.dispatch('CLEAR_ALL_CART');
          console.log('Заказ или корзина с такой сессией уже есть, поэтому текущий заказ неоформился. ' +
            'Перегенирили сессию и сбросили текущую корзину.');
        }
      },
    },
  }
</script>

<style lang="scss" scoped>
    @media screen and (max-width: 440px){
        .vue-btn {
            line-height: 0;
        }
    }

</style>
