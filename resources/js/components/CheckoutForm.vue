<template>
    <form method="post" action="">
        <ol class="order-steps">

            <li class="order-step" id="order-step-1">
                <div class="step-title-block">
                    <h4 class="step-title">Контактные данные</h4>
                </div>

                <div class="row">
                    <div class="field-group col-12 col-sm-6">
                        <label for="name">Введите имя <sup>*</sup></label>
                        <input class="name-field" type="text" name="fullname" id="name" placeholder="ФИО" v-model="order.name">
                        <span class="error-field">Это поле обязательное</span>
                    </div>


                    <div class="field-group col-12 col-sm-6">
                        <label for="phone">Введите телефон <sup>*</sup></label>
                        <input class="phone-field" type="text" name="phone" id="phone" placeholder="+7 (___) ___ - __ - __" v-model="order.phone">
                        <span class="error-field">Неверный формат номера</span>
                    </div>
                </div>
            </li>

            <li class="order-step" id="order-step-2">
                <div class="step-title-block">
                    <h4 class="step-title">Где и как вы хотите получить заказ?</h4>
                    <span class="error-field">Выберите способ доставки</span>
                </div>

                <div class="row">
                    <div class="field-group col-12 col-lg-6 radio-group">
                        <input type="radio" id="delivery" class="required" name="delivery" value="доставка" v-model="order.delivery_method">
                        <label for="delivery">
                            <span>Доставка по адресу</span>
                            <span>Бесплатно от 1990 ₽</span>
                        </label>
                    </div>

                    <div class="field-group col-12 col-lg-6 radio-group">
                        <input type="radio" id="by-myself" class="required" name="delivery" value="самовывоз" v-model="order.delivery_method">
                        <label for="by-myself">
                            <span>Самовывоз</span>
                            <span>из нашего магазина</span>
                        </label>
                    </div>
                </div>

                <div class="delivery-tab radio-tab">
                    <span class="error-field">Заполните адрес доставки</span>

                    <label>Введите адрес доставки <sup>*</sup></label>

                    <div class="row">
                        <div class="field-group col-12">
                            <input class="required-group" type="text" id="street" name="street" v-model="order.address_street">
                            <label class="placeholder">Улица</label>
                        </div>
                        <div class="field-group col-12 col-sm-6 col-lg-3">
                            <input class="required-group" type="text" id="house" name="house" v-model="order.address_house">
                            <label class="placeholder">Дом</label>
                        </div>
                        <div class="field-group col-12 col-sm-6 col-lg-3">
                            <input class="required-group" type="text" id="flat" name="flat" v-model="order.address_flat">
                            <label class="placeholder">Квартира</label>
                        </div>
                        <div class="field-group col-12 col-sm-6 col-lg-3">
                            <input class="required-group" type="text" id="entrance" name="entrance" v-model="order.address_entrance">
                            <label class="placeholder">Подъезд</label>
                        </div>
                        <div class="field-group col-12 col-sm-6 col-lg-3">
                            <input class="required-group" type="text" id="floor" name="floor" v-model="order.address_floor">
                            <label class="placeholder">Этаж</label>
                        </div>
                    </div>

                    <div class="doorphone">
                        <input type="checkbox" id="doorphone" value="да" name="doorphone"><label for="doorphone">Домофон работает</label>
                    </div>

                    <div class="row">
                        <div class="field-group col-12">
                            <label>Комментарий</label>
                            <textarea name="comment" id="" cols="30" rows="10" v-model="order.comment"></textarea>
                        </div>
                    </div>


                </div>

                <div class="bymslf-tab radio-tab">
                    <div id="order-map"></div>

                    <div class="order-contacts">
                        <div class="order-contact" data-addr-id="addr1" data-coords="52.03067107205304,113.49252399999997">
                            <div class="order-contact__info">
                                <div class="order-contact__title">Контактный телефон</div>
                                <div class="order-contact__value order-contact__value--phone"><i class="icon-font icon-phone"></i>+7 925 755 53 59</div>
                            </div>
                            <div class="order-contact__info">
                                <div class="order-contact__title">Адрес точки самовывоза</div>
                                <div class="order-contact__value order-contact__value--addr"><i class="icon-font icon-map"></i>Журавлева 2, бутик 14</div>
                            </div>
                        </div>
                    </div>
                </div>
            </li>

            <li class="order-step required-radio" id="order-step-3">
                <div class="step-title-block">
                    <h4 class="step-title">Как вам будет удобнее оплатить заказ?</h4>
                    <span class="error-field">Выберите способ оплаты</span>
                </div>

                <div class="row">
                    <div class="field-group col-12 col-lg-6 radio-group">
                        <input type="radio" id="pay-1" class="required pay-type" name="pay-type" value="наличными курьеру" v-model="order.payment_method">
                        <label for="pay-1" style="display: block;">
                            <span>Наличными курьеру</span>
                            <span>при доставке по адресу</span>
                        </label>
                    </div>

                    <div class="field-group col-12 col-lg-6 radio-group">
                        <input type="radio" id="pay-2" class="required pay-type" name="pay-type" value="картой курьеру" v-model="order.payment_method">
                        <label for="pay-2" style="display: block;">
                            <span>Картой курьеру</span>
                            <span>Картами Visa, MasterCard, Мир</span>
                        </label>
                    </div>

                    <div class="field-group col-12 col-lg-6 radio-group">
                        <input type="radio" id="pay-3" class="required pay-type" name="pay-type" value="картой на сайте" v-model="order.payment_method">
                        <label for="pay-3">
                            <span>Картой на сайте</span>
                            <span>Картами Visa, MasterCard, Мир</span>
                        </label>
                    </div>

                    <div class="field-group col-12 col-lg-6 radio-group">
                        <input type="radio" id="pay-4" class="required pay-type" name="pay-type" value="при самовывозе" v-model="order.payment_method">
                        <label for="pay-4">
                            <span>При самовывозе</span>
                            <span>Оплата в магазине</span>
                        </label>
                    </div>
                </div>
            </li>
        </ol>
    </form>
</template>

<script>
  export default {
    name: "CheckoutForm",
    data() {
      return ({
        order: {
          name: '',
          phone: '',
          delivery_method: '',
          address_street: '',
          address_house: '',
          address_flat: '',
          address_entrance: '',
          address_floor: '',
          payment_method: '',
          comment: '',
          total_price: 0,
        }
      })
    },
    methods: {
      getForm() {
        return this.order;
      }
    }
  }
</script>

<style scoped>

</style>
