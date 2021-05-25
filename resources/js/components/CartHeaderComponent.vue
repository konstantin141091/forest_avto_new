<template>
    <a v-bind:href="this.url" class="header-cart">
        <i class="icon-font icon-cart"></i>
        <span class="header-cart__text">Корзина:</span>
        <span class="header-cart__price">{{ CART_TOTAL_PRICE }} &#8381;</span>
    </a>
</template>

<script>
  import { mapGetters } from "vuex/dist/vuex.mjs";
  export default {
    name: "CartHeaderComponent",
    props: {
      url: {
        type: String,
        required: true,
      }
    },
    computed: {
      ...mapGetters([
        'CART_TOTAL_PRICE'
      ]),
    },
  }
</script>

<style lang="scss" scoped>
    .header-cart:hover {
        text-decoration: none;
    }
</style>
