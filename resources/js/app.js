require('./bootstrap');
// require('./scripts/cleave.min');
// require('./scripts/map');
// require('./scripts/script');
import store from './store/index.js';

Vue.component('cart-header-component', require('./components/CartHeaderComponent.vue').default);
Vue.component('product-component', require('./components/ProductComponent.vue').default);
Vue.component('cart-page-component', require('./components/CartPageComponent.vue').default);
Vue.component('cart-list-for-checkout', require('./components/CartListForCheckout.vue').default);
Vue.component('checkout-form', require('./components/CheckoutForm.vue').default);
Vue.component('loader-component', require('./components/LoaderComponent.vue').default);
Vue.component('order-created-component', require('./components/OrderCreatedComponent.vue').default);

new Vue({
    el: '#app',
    store: new Vuex.Store(store)
});
