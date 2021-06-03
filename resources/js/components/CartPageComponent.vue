<template>
    <div>
        <div class="page-title-block">
            <h1 class="page-title">Корзина</h1>
            <div class="cart-amount">{{ CART_TOTAL_QUANTITY }} товара</div>
        </div>


        <div class="cart">
            <div class="cart-sum">
<!--                TODO логикики применения промокода нет-->
                <div class="cart-sum__promo">
                    <div class="ok"></div>
                    <input type="text" id="promo" name="promo" placeholder="Введите код купона для скидки">
                    <div class="error">Неверный промокод</div>
                    <button class="btn btn_transparent">Применить</button>
                </div>

                <div class="cart-sum__total">
                    <span>Итого: </span>
                    <span>{{ CART_TOTAL_PRICE }} ₽</span>
                    <!-- для применения промокода -->
<!--                    TODO логики скидки нет-->
<!--                    <span>23 135 ₽</span>-->
                </div>

                <a v-bind:href="this.order_url" class="btn btn_filled vue-btn__filled">Перейти к оформлению</a>
            </div>

            <div class="cart-form">
                <table class="cart-table">
                    <tr>
                        <th>Описание товара</th>
                        <th>Срок доставки</th>
                        <th>Кол-во</th>
                        <th>Цена</th>
                        <th>
                            <div class="cart__clear" @click="clearCart">
                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M14.6668 3.33331C14.6668 3.51012 14.5966 3.67969 14.4716 3.80472C14.3465 3.92974 14.177 3.99998 14.0002 3.99998H2.00016C1.82335 3.99998 1.65378 3.92974 1.52876 3.80472C1.40373 3.67969 1.3335 3.51012 1.3335 3.33331C1.3335 3.1565 1.40373 2.98693 1.52876 2.86191C1.65378 2.73688 1.82335 2.66665 2.00016 2.66665H5.3335V1.99998C5.3335 1.82317 5.40373 1.6536 5.52876 1.52858C5.65378 1.40355 5.82335 1.33331 6.00016 1.33331H10.0002C10.177 1.33331 10.3465 1.40355 10.4716 1.52858C10.5966 1.6536 10.6668 1.82317 10.6668 1.99998V2.66665H14.0002C14.177 2.66665 14.3465 2.73688 14.4716 2.86191C14.5966 2.98693 14.6668 3.1565 14.6668 3.33331ZM3.2895 14.0473L2.66683 5.33331H13.3335L12.7108 14.0473C12.6988 14.2158 12.6233 14.3734 12.4996 14.4884C12.3758 14.6034 12.2131 14.6671 12.0442 14.6666H3.95416C3.7856 14.6666 3.62333 14.6026 3.5 14.4877C3.37668 14.3728 3.30146 14.2155 3.2895 14.0473ZM10.0002 12C10.0002 12.1768 10.0704 12.3464 10.1954 12.4714C10.3204 12.5964 10.49 12.6666 10.6668 12.6666C10.8436 12.6666 11.0132 12.5964 11.1382 12.4714C11.2633 12.3464 11.3335 12.1768 11.3335 12V7.99998C11.3335 7.82317 11.2633 7.6536 11.1382 7.52858C11.0132 7.40355 10.8436 7.33331 10.6668 7.33331C10.49 7.33331 10.3204 7.40355 10.1954 7.52858C10.0704 7.6536 10.0002 7.82317 10.0002 7.99998V12ZM7.3335 12C7.3335 12.1768 7.40373 12.3464 7.52876 12.4714C7.65378 12.5964 7.82335 12.6666 8.00016 12.6666C8.17697 12.6666 8.34654 12.5964 8.47157 12.4714C8.59659 12.3464 8.66683 12.1768 8.66683 12V7.99998C8.66683 7.82317 8.59659 7.6536 8.47157 7.52858C8.34654 7.40355 8.17697 7.33331 8.00016 7.33331C7.82335 7.33331 7.65378 7.40355 7.52876 7.52858C7.40373 7.6536 7.3335 7.82317 7.3335 7.99998V12ZM4.66683 12C4.66683 12.1768 4.73707 12.3464 4.86209 12.4714C4.98712 12.5964 5.15669 12.6666 5.3335 12.6666C5.51031 12.6666 5.67988 12.5964 5.8049 12.4714C5.92992 12.3464 6.00016 12.1768 6.00016 12V7.99998C6.00016 7.82317 5.92992 7.6536 5.8049 7.52858C5.67988 7.40355 5.51031 7.33331 5.3335 7.33331C5.15669 7.33331 4.98712 7.40355 4.86209 7.52858C4.73707 7.6536 4.66683 7.82317 4.66683 7.99998V12Z" fill="#DCDCDC"/>
                                </svg>
                                Очистить
                            </div>
                        </th>
                    </tr>

                    <tr v-for="(item, index) in cartList"
                        :key="index">
                        <td>
                            <img src="/storage/img/product.png" alt="product_img">
                            <div>
                                <strong class="product-title">{{ item.id }} {{ item.brand_name }} {{ item.name }}</strong>
                                <div class="product-info">
                                    <span class="product-presence">В наличии</span>
                                    <span class="product-art">Арт. {{ item.article }}</span>
                                </div>
                            </div>
                        </td>
                        <td><span>{{ item.offers_average_period }} дня</span></td>
                        <td>
                            <div class="product-count">
                                <button class="dec" @click="decrementCart(index)">
                                    <svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M10 6H0V4H10V6Z" fill="#989898"/>
                                    </svg></button>
                                <span>{{ item.quantity }} шт.</span>
                                <button class="inc" @click="incrementCart(index)">
                                    <svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M10 6H0V4H10V6Z" fill="#989898"/>
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M6 -8.74228e-08L6 10L4 10L4 0L6 -8.74228e-08Z" fill="#989898"/>
                                    </svg>
                                </button>
                            </div>
                        </td>
                        <td>
                            <div class="product-price">{{ item.offers_price }} ₽</div>
<!--                            TODO логика скидки не написана-->
<!--                            <div class="product-price&#45;&#45;old">3 100 ₽</div>-->
                        </td>
                        <td>
                            <div class="cart__btn-delete-position" @click="deleteFormCart(index)">
                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M14.6668 3.33331C14.6668 3.51012 14.5966 3.67969 14.4716 3.80472C14.3465 3.92974 14.177 3.99998 14.0002 3.99998H2.00016C1.82335 3.99998 1.65378 3.92974 1.52876 3.80472C1.40373 3.67969 1.3335 3.51012 1.3335 3.33331C1.3335 3.1565 1.40373 2.98693 1.52876 2.86191C1.65378 2.73688 1.82335 2.66665 2.00016 2.66665H5.3335V1.99998C5.3335 1.82317 5.40373 1.6536 5.52876 1.52858C5.65378 1.40355 5.82335 1.33331 6.00016 1.33331H10.0002C10.177 1.33331 10.3465 1.40355 10.4716 1.52858C10.5966 1.6536 10.6668 1.82317 10.6668 1.99998V2.66665H14.0002C14.177 2.66665 14.3465 2.73688 14.4716 2.86191C14.5966 2.98693 14.6668 3.1565 14.6668 3.33331ZM3.2895 14.0473L2.66683 5.33331H13.3335L12.7108 14.0473C12.6988 14.2158 12.6233 14.3734 12.4996 14.4884C12.3758 14.6034 12.2131 14.6671 12.0442 14.6666H3.95416C3.7856 14.6666 3.62333 14.6026 3.5 14.4877C3.37668 14.3728 3.30146 14.2155 3.2895 14.0473ZM10.0002 12C10.0002 12.1768 10.0704 12.3464 10.1954 12.4714C10.3204 12.5964 10.49 12.6666 10.6668 12.6666C10.8436 12.6666 11.0132 12.5964 11.1382 12.4714C11.2633 12.3464 11.3335 12.1768 11.3335 12V7.99998C11.3335 7.82317 11.2633 7.6536 11.1382 7.52858C11.0132 7.40355 10.8436 7.33331 10.6668 7.33331C10.49 7.33331 10.3204 7.40355 10.1954 7.52858C10.0704 7.6536 10.0002 7.82317 10.0002 7.99998V12ZM7.3335 12C7.3335 12.1768 7.40373 12.3464 7.52876 12.4714C7.65378 12.5964 7.82335 12.6666 8.00016 12.6666C8.17697 12.6666 8.34654 12.5964 8.47157 12.4714C8.59659 12.3464 8.66683 12.1768 8.66683 12V7.99998C8.66683 7.82317 8.59659 7.6536 8.47157 7.52858C8.34654 7.40355 8.17697 7.33331 8.00016 7.33331C7.82335 7.33331 7.65378 7.40355 7.52876 7.52858C7.40373 7.6536 7.3335 7.82317 7.3335 7.99998V12ZM4.66683 12C4.66683 12.1768 4.73707 12.3464 4.86209 12.4714C4.98712 12.5964 5.15669 12.6666 5.3335 12.6666C5.51031 12.6666 5.67988 12.5964 5.8049 12.4714C5.92992 12.3464 6.00016 12.1768 6.00016 12V7.99998C6.00016 7.82317 5.92992 7.6536 5.8049 7.52858C5.67988 7.40355 5.51031 7.33331 5.3335 7.33331C5.15669 7.33331 4.98712 7.40355 4.86209 7.52858C4.73707 7.6536 4.66683 7.82317 4.66683 7.99998V12Z" fill="#DCDCDC"/>
                                </svg>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
  import {mapActions, mapGetters} from "vuex/dist/vuex.mjs";
  export default {
    name: "CartPageComponent",
    props: {
      order_url: {
        type: String,
        required: true,
      }
    },
    data() {
      return ({
        countQuantity: 1,
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
        'ACTION_INCREMENT_INDEX', 'ACTION_DECREMENT_INDEX', 'ACTION_DELETE_FROM_CART_INDEX', 'CLEAR_ALL_CART'
      ]),
      incrementCart(index) {
        if (this.cartList[index].quantity < this.cartList[index].offers_quantity) {
          this.ACTION_INCREMENT_INDEX(index);
        }
      },
      decrementCart(index) {
        this.ACTION_DECREMENT_INDEX(index);
      },
      deleteFormCart(index) {
        this.ACTION_DELETE_FROM_CART_INDEX(index);
      },
      clearCart() {
        this.CLEAR_ALL_CART();
      }
    },
  }
</script>

<style lang="scss" scoped>
    .cart {
        &__btn-delete-position {
            cursor: pointer;
        }
    }
    .cart__clear {
        cursor: pointer;
    }
    .vue-btn__filled {
        display: flex;
    }
</style>
