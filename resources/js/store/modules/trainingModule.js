import axios from "axios";
import store from "../index";

export default {
    state: () => ({
        id: null,
        training: null,
        currentActivitie: null,
        isLoading: true,
        saveResultsError: null,
    }),
    getters: {
        training(state) {
            return state.training;
        },
        isLoading(state) {
            return state.isLoading;
        },
        currentActivitie(state) {
            return state.currentActivitie;
        },
        resultRepeatsError(state) {
            if (state.saveResultsError && typeof state.saveResultsError.repeats !== 'undefined')
                return state.saveResultsError.repeats.join(',')
            else
                return '';
        },
        resultWeightError(state) {
            if (state.saveResultsError && typeof state.saveResultsError.weight !== 'undefined')
                return state.saveResultsError.weight.join(',')
            else
                return '';
        },
    },
    mutations: {
        setId(state, id) {
            state.id = id;
        },
        setTraining(state, t) {
            state.training = t;
        },
        setLoading(state, bool) {
            state.isLoading = bool;
        },
        setCurrentActivitie(state, a) {
            state.currentActivitie = a;
        },
        saveResultsError(state, errors) {
            state.saveResultsError = errors
        },
        newResult(state, r) {
            if (typeof state.currentActivitie.results == 'undefined') {
                state.currentActivitie.results = [];
            }
            state.currentActivitie.results.push(r);
        }
    },
    actions: {

        async fetch({state, commit}) {
            try {
                const response = await axios.get(store.state.api_url + '/trainings/' + state.id, {});

                if (response.data.status == 'ok') {
                    commit('setTraining', response.data.t);
                }

            } catch (e) {
                //alert('Ошибка');
            } finally {
                commit('setLoading', false);
            }
        },

        saveResults({state, commit}, form) {
            return new Promise((resolve, reject) => {
                axios
                    .post(store.state.api_url + '/trainings/activities/results', form)
                    .then(response => {
                        if (response.data.status == 'ok') {
                            commit('newResult', response.data.a)
                            resolve(response)
                        }
                    })
                    .catch(err => {
                        commit('saveResultsError', err.response.data.errors)
                        reject(err)
                    })
                ;
            });
        },
    },
    namespaced: true
}
