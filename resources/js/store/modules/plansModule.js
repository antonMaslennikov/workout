import axios from "axios";
import store from "../index";

export default {
    state: () => ({
        list: [],
        isLoading: false,
        page: 1,
        limit: 50,
        totalPages: 0,
        searchQuery: '',
    }),
    getters: {
        list(state) {
            return state.list;
        },
        page(state) {
            return state.page;
        },
        totalPages(state) {
            return state.totalPages;
        },
        isLoading(state) {
            return state.isLoading;
        }
    },
    mutations: {
        setList(state, list) {
            state.list = list;
        },
        setLoading(state, bool) {
            state.isLoading = bool;
        },
        setPage(state, page) {
            state.page = page;
        },
        setLimit(state, limit) {
            state.limit = limit;
        },
        setTotalPages(state, totalPages) {
            state.totalPages = totalPages;
        },
    },
    actions: {

        async fetch({state, commit}) {
            commit('setLoading', true);

            const response = await axios.get(store.state.api_url + '/plans', {
                params: {
                    limit: state.limit,
                    page: state.page,
                },
                headers: {
                    'Content-type':'application/json'
                }
            });

            commit('setTotalPages', Math.ceil(response.data.total / state.limit));
            commit('setList', response.data.data);
            commit('setLoading', false);
        },


        saveTraining({state, commit}, form) {
            if (!form.id || form.id == 0) {
                axios
                    .post(store.state.api_url + '/plans', form, {
                        headers: {
                            'Content-type': 'application/json'
                        }
                    })
                    .then(res => {
                        if (res.data.status == 'ok') {
                            state.list.push(res.data.t);
                            form = {};
                        }
                    });
            } else {
                axios
                    .post(store.state.api_url + '/plans/' + form.id, {
                        ...form,
                        _method: 'PUT'
                    })
                    .then(res => {
                        if (res.data.status == 'ok') {
                            state.list = state.list.map(item => {
                                if (item.id == form.id) {
                                    item.name = form.name;
                                }
                                return item;
                            });

                        }
                    });
            }
        },

        removeTraining({state, commit}, training) {
            if (confirm('Подтверждаете удаление?')) {
                axios
                    .post(store.state.api_url + '/plans/' + training.id, {
                        _method: 'DELETE'
                    })
                    .then(response => {
                        state.list = state.list.filter(a => a.id !== training.id)
                    });
            }
        },


        saveSet({state, commit}, form) {
            if (!form.id || form.id == 0) {
                axios
                    .post(store.state.api_url + '/plans/sets', form, {
                        headers: {
                            'Content-type': 'application/json'
                        }
                    })
                    .then(res => {
                        if (res.data.status == 'ok') {

                            let set = res.data.set;

                            state.list.forEach(function(item, kt) {
                                if (item.id == set.training_id) {
                                    if (!state.list[kt].sets) {
                                        state.list[kt].sets = [];
                                    }
                                    state.list[kt].sets.push(set);
                                }
                            });

                        }
                    });
            } else {
                axios
                    .post(store.state.api_url + '/plans/sets/' + form.id, {
                        ...form,
                        _method: 'PUT'
                    })
                    .then(res => {
                        if (res.data.status == 'ok') {
                            let set = res.data.set;

                            state.list.forEach(function(item, kt) {
                                if (item.id == set.training_id) {
                                    item.sets.forEach(function(s, ks) {
                                        if (s.id == set.id) {
                                            state.list[kt].sets[ks] = set;
                                        }
                                    });
                                }
                            });
                        }
                    });
            }
        },

        removeSet({state, commit}, set) {
            if (confirm('Вы уверены что хотите удалить сет?')) {
                axios
                    .post(store.state.api_url + '/plans/sets/' + set.id, {
                        _method: 'DELETE'
                    })
                    .then(response => {
                        state.list.forEach(function(item, kt) {
                            if (item.id == set.training_id) {
                                item.sets = item.sets.filter(s => s.id != set.id);
                            }
                        });
                    });
            }
        },


        saveActivitie({state, commit}, form) {

            if (!form.id) {
                axios
                    .post(store.state.api_url + '/plans/activities', form)
                    .then(response => {

                        let a = response.data.a;

                        state.list.forEach(function(item, kt) {
                            if (item.id == a.set.training_id) {
                                if (!state.list[kt].sets) {
                                    state.list[kt].sets = [];
                                }
                                item.sets.forEach(function(set, ks) {

                                    if (set.id == a.set.id) {
                                        if (!state.list[kt].sets[ks].activities) {
                                            state.list[kt].sets[ks].activities = [];
                                        }
                                        state.list[kt].sets[ks].activities.push(a);
                                    }

                                });
                            }
                        });

                    });
            } else {
                axios
                    .post(store.state.api_url + '/plans/activities/' + form.id, {
                        ...form,
                        _method: 'PUT'
                    })
                    .then(response => {

                        let a = response.data.a;

                        state.list.forEach(function(item, kt) {
                            if (item.id == a.set.training_id) {
                                item.sets.forEach(function(set, ks) {
                                    if (set.id == a.set.id) {
                                        set.activities.forEach(function(activitie, ka) {
                                            if (activitie.id == a.id) {
                                                state.list[kt].sets[ks].activities[ka] = a;
                                            }
                                        });
                                    }

                                });
                            }
                        });
                    });
            }
        },

        removeActivitie({state, commit}, activitie) {

            if (confirm('Вы уверены что хотите удалить упражнение?')) {
                axios
                    .post(store.state.api_url + '/plans/activities/' + activitie.id, {
                        _method: 'DELETE'
                    })
                    .then(response => {
                        state.list.forEach(function(item, kt) {
                            item.sets.forEach(function(itemA, ks) {
                                if (itemA.id == activitie.set_id) {
                                    itemA.activities = itemA.activities.filter(a => a.id != activitie.id);
                                }
                            });
                        });
                    });
            }
        },

    },
    namespaced: true
}
