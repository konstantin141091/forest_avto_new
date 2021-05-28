<template>
    <div class="wrap-spinner">
        <div class="vue-order">
            <div class="vue-order__close" @click="close">
                <img src="/storage/img/icons/order_close.svg" alt="close">
            </div>
            <div class="vue-order__check">
                <img src="/storage/img/icons/order-check.svg" alt="check-mark">
            </div>
            <div class="vue-order__text">
                <h3>Заказ оформлен</h3>
                <p>
                    Наш специалист свяжется
                    с Вами в ближайшее время.
                </p>
            </div>
            <div class="vue-order__info">
                <p>Заказ №{{ GET_LAST_ID_ORDER }}</p>
            </div>
            <div class="vue-order__logo">
                <div class="vue-order__logo-img">
                    <img src="/storage/img/order_modal.png" alt="order_logo">
<!--                    <img src="/storage/img/Ellipse 84.png" alt="ellipse">-->
                </div>
                <div class="vue-order__logo-ellipse">

                </div>
            </div>

        </div>
    </div>
</template>

<script>
  import {mapGetters} from "vuex/dist/vuex.mjs";
  export default {
    name: "OrderCreatedComponent",
    props: ['url_index'],
    methods: {
      close() {
        window.location.href = this.url_index;
      }
    },
    computed: {
      ...mapGetters ([
        'GET_LAST_ID_ORDER'
      ]),
    },
  }
</script>

<style lang="scss" scoped>
    $colorText: #ffffff;
    p {
        margin: 0;
    }
    .wrap-spinner {
        display: flex;
        height: 100%;
        align-items: center;
        justify-content: center;
        flex-direction:column
    }
    .vue-order {
        width: 325px;
        background-color: #D63838;
        padding: 46px 63px 0 63px;
        position: relative;
        &__check {
            display: flex;
            justify-content: center;
        }
        &__text {
            margin-top: 20px;
            color: $colorText;
            font-size: 19px;
            font-weight: 300;
            font-style: normal;
            & h3 {
                font-size: 22px;
                font-weight: bold;
            }
            & p {
                line-height: 26px;
                text-align: center;
            }
        }
        &__info {
            margin-top: 22px;
            padding: 5% 0;
            border: 1px dashed $colorText;
            box-sizing: border-box;
            border-radius: 5px;
            & p {
                color: $colorText;
                text-align: center;
                font-size: 16px;
                font-weight: bold;
            }
        }
        &__logo {
            margin-top: 24px;
            position: relative;
        }
        &__close {
            position: absolute;
            right: 20px;
            top: 20px;
            cursor: pointer;
        }
    }
</style>
