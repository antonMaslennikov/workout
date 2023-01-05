import axios from "axios";
import {commit} from "lodash/seq";
import store from "../index";

export default {
    state: () => ({
        data: null,
        isLoading: true,
    }),
    getters: {
        isLoading: state => state.isLoading,
        data(state) {
            return state.data;
        },
    },
    mutations: {
        setLoading(state, bool) {
            state.isLoading = bool;
        },
        setData(state, data) {
            state.data = data;
        },
        saveName(state, text) {
            state.data.name = text;
            store.commit('auth/userName', text);
        },
        saveEmail(state, text) {
            state.data.email = text;
        }
    },
    actions: {

        fetchProfile({state, commit}) {
            return new Promise((resolve, reject) => {
                commit('setLoading', true);
                axios.get(store.state.api_url + '/profile')
                    .then(resp => {
                        commit('setData', resp.data);
                        commit('setLoading', false);
                        resolve(resp)
                    })
                    .catch(err => {
                        reject(err)
                    });
            });
        },

        saveName({commit,state}, text) {
            axios
                .post(store.state.api_url + '/profile', {'key' : 'name', 'value' : text}, {
                    headers: {
                        'Content-type':'application/json'
                    }
                })
                .then(res => {
                    if (res.data.status == 'ok') {
                        commit('saveName', text);
                    }
                });
        },

        saveEmail({commit}, text) {

            commit('saveEmail', text);
        }

    },
    namespaced: true
}
