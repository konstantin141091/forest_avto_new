require('./bootstrap');
import store from './store/index.js';

Vue.component('cart-header-component', require('./components/CartHeaderComponent.vue').default);
Vue.component('product-component', require('./components/ProductComponent.vue').default);
Vue.component('cart-page-component', require('./components/CartPageComponent.vue').default);
Vue.component('checkout-page-component', require('./components/CheckoutPageComponent.vue').default);

new Vue({
    el: '#app',
    store: new Vuex.Store(store)
});
