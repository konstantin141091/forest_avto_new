import axios from 'axios'

export default {
  // namespaced: true,
  state: {
    CART: JSON.parse(localStorage.getItem('cart' ) || '[]'),
  },

  getters: {
    CART (state) {
      return state.CART
    },
    CART_TOTAL_PRICE: state => {
      return state.CART.reduce((total, product) => {
        return Math.floor((total + product.quantity * product.offers_price) * 100) / 100;
      }, 0)
    },
    CART_TOTAL_QUANTITY: state => {
      return state.CART.reduce((total, product) => {
        return total + product.quantity;
      }, 0)
    }
  },

  mutations: {
    PUSH_PRODUCT_TO_CART: (state, product) => {
      state.CART.push(product);
    },
    SAVE_CART: (state) => {
      localStorage.setItem('cart', JSON.stringify(state.CART))
    },

    INCREMENT: (state, data) => {
      const cartItem = state.CART.find(item => item.offers_id === data.offers_id && item.offers_price === data.offers_price);
      cartItem.quantity = data.quantity;
      cartItem.total = Math.floor((cartItem.quantity * cartItem.offers_price) * 100) / 100;
    },
    DELETE_ALL_CART: (state) => {
      state.cart = [];
    },
    DELETE_FROM_CART_INDEX: (state, index) => {
      state.CART.splice(index, 1);
    },
    INCREMENT_INDEX: (state, index) => {
      state.CART[index].quantity++;
    },
    DECREMENT_INDEX: (state, index) => {
      state.CART[index].quantity--;
    }
  },

  actions: {
    ADD_TO_CART: ({commit, state}, data) => {
      const cartItem = state.CART.find(item => item.offers_id === data.product.offers_id && item.offers_price === data.product.offers_price);
      if (!cartItem) {
        let product = data.product;
        product.quantity = data.countQuantity;
        product.total = Math.floor((product.quantity * product.offers_price) * 100) / 100;
        commit('PUSH_PRODUCT_TO_CART', product)
      } else {
        let increment = {
          offers_id: cartItem.offers_id,
          offers_price: cartItem.offers_price,
          quantity: data.countQuantity,
        };
        commit('INCREMENT', increment)
      }
      commit('SAVE_CART')
    },

    ACTION_INCREMENT_INDEX: ({commit}, index) => {
      commit('INCREMENT_INDEX', index);
      commit('SAVE_CART');
    },
    ACTION_DECREMENT_INDEX: ({commit, state}, index) => {
      if(state.CART[index].quantity > 1) {
        commit('DECREMENT_INDEX', index);
      } else {
        commit('DELETE_FROM_CART_INDEX', index);
      }
      commit('SAVE_CART');
    },
    ACTION_DELETE_FROM_CART_INDEX: ({commit}, index) => {
      commit('DELETE_FROM_CART_INDEX', index);
      commit('SAVE_CART');
    },

    // async API_ADD_TO_CART ({ dispatch }, credentials) {
    //   await axios.get('/sanctum/csrf-cookie');
    //   const answer = await axios.post('/cart', credentials)
    //     .then((response) => {
    //       return response;
    //     })
    //     .catch((error) => {
    //       return error.response;
    //     });
    //   return answer;
    // },

    CLEAR_ALL_CART: ({state}) => {
      localStorage.clear();
      state.CART = [];
    },
  }
}
