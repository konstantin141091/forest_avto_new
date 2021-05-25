import axios from 'axios'

export default {
  // namespaced: true,
  state: {

  },

  getters: {

  },

  mutations: {

  },

  actions: {
    async API_ADD_ORDER ({ dispatch }, credentials) {
      const answer = await axios.post('/order', credentials)
        .then((response) => {
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
