import axios from 'axios';
export default {
    namespaced: true,
    state: {
        items: [],
        item: false
    },
    mutations: {

        save(state, payload) {
            state.items.push(payload);
        },

        getOne(state, payload) {
            state.item = payload;
        }

    },
    actions: {

        save({commit}, url) {

            return new Promise((resolve, reject) => {
                axios.post(`/api/pages`, {
                    url
                }).then((response) => {
                    commit('save', response.data.data);
                    resolve(response.data.data);
                }).catch((err) => {
                    reject(err.response);
                })
            })

        },

        getOne({commit}, id) {
            return new Promise((resolve, reject) => {
                axios.get(`/api/pages/${id}`).then((response) => {
                    commit('getOne', response.data.data);
                    resolve(response.data.data);
                }).catch((err) => {
                    reject(err.response);
                })
            })
        }
    },
    getters: {
        getItemById: (state) => (id) => {
            return state.items.find(item => item.id === parseInt(id));
        }
    }
}
