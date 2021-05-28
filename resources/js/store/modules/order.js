import axios from 'axios'

export default {
  // namespaced: true,
  state: {
    LAST_ID_ORDER: null,
  },

  getters: {
    GET_LAST_ID_ORDER (state) {
      return state.LAST_ID_ORDER;
    }
  },

  mutations: {
    SET_LAST_ID_ORDER: (state, id) => {
      state.LAST_ID_ORDER = id;
    }

  },

  actions: {
    async API_ADD_ORDER ({ dispatch, commit }, credentials) {
      const answer = await axios.post('/order', credentials)
        .then((response) => {
          if (response.data.order.id) {
            commit('SET_LAST_ID_ORDER', response.data.order.id);
          }
          return response;
        })
        .catch((error) => {
          console.log('ошибка при оформление заказа', error);
          return error.response;
        });
      return answer;
    },
  }
}
