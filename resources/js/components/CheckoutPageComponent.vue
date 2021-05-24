<template>
    <div>
        <h2>Логика оформления заказа готова. Нужна верстка чтобы всё было красиво!!!</h2>
<!--        <input type="text" v-model="order.name">-->
<!--        <input type="tel" v-model="order.phone">-->

<!--        <input type="radio" id="1" value="самовывоз" checked v-model="order.delivery_method">-->
<!--        <label for="1">Самовывоз</label>-->

<!--        <input type="radio" id="2" value="доставка" checked v-model="order.delivery_method">-->
<!--        <label for="2">Доставка</label>-->

<!--        <button @click="createOrder()">start</button>-->

    </div>
</template>

<script>
  import {mapActions, mapGetters} from "vuex/dist/vuex.mjs";
  export default {
    name: "CheckoutPageComponent",
    props: {
      url_index: {
        type: String,
        required: true,
      }
    },
    data() {
      return {
        order: {
          name: 'default_name',
          phone: 9145226691,
          delivery_method: 'самовывоз',
          // address and comment are not required
          address: '',
          comment: '',
          payment_method: 'при самовывозе',
          // total_price: this.CART_TOTAL_PRICE,
        }
      }
    },
    computed: {
      ...mapGetters ([
        'CART_TOTAL_PRICE', 'CART'
      ]),
    },
    methods: {
      ...mapActions([
        'API_ADD_TO_CART', 'API_ADD_ORDER',
      ]),

      async createOrder() {
        const cartResponse = await this.$store.dispatch('API_ADD_TO_CART', this.CART);
        if (cartResponse.status === 201) {
          this.order.total_price = this.CART_TOTAL_PRICE;
          const orderResponse = await this.$store.dispatch('API_ADD_ORDER', this.order);
          if (orderResponse.status === 201) {
            await this.$store.dispatch('CLEAR_ALL_CART');
            console.log('Всё прошло успешно. Заказ оформлен');
            window.location.href = this.url_index;
          } else {
            console.log('Корзина добавилась, но заказ не оформился');
          }
        } else {
          console.log('Не удалось добавить корзину в бд. Соответственно и заказ не оформился');
          console.log('Нужно как-то сказать об этом юзеру');
        }
      },
    }
  }
</script>

<style scoped>

</style>
