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
      await axios.get('/sanctum/csrf-cookie');
      const answer = await axios.post('/order', credentials)
        .then((response) => {
          return response;
        })
        .catch((error) => {
          return error.response;
        });
      return answer;
    },
  }
}
