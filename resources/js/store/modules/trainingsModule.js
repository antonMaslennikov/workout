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
        year: null,
        month: null,
        day: null,
        save_results_error: null,
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
        setYear(state, year) {
            state.year = year;
        },
        setMonth(state, month) {
            state.month = month;
        },
        setDay(state, day) {
            state.day = day;
        },
        save_results_error(state, errors) {
            state.save_results_error = errors
        },
    },
    actions: {

        async fetch({state, commit}) {
            try {
                commit('setLoading', true);
                const response = await axios.get(store.state.api_url + '/trainings/' + state.year + '/' + state.month + '/' + state.day, {});
                commit('setList', response.data);
            } catch (e) {
                alert('Ошибка');
            } finally {
                commit('setLoading', false);
            }
        },

        saveTraining({state, commit}, form) {
            if (!form.id || form.id == 0) {
                axios
                    .post(store.state.api_url + '/trainings', form, {
                        headers: {
                            'Content-type': 'application/json'
                        }
                    })
                    .then(res => {
                        if (res.data.status == 'ok') {
                            res.data.t.hour = form.hour;
                            res.data.t.minute = form.minute;
                            state.list.push(res.data.t);
                            form = {};
                        }
                    });
            } else {
                axios
                    .post(store.state.api_url + '/trainings/' + form.id, {
                        ...form,
                        _method: 'PUT'
                    })
                    .then(res => {
                        if (res.data.status == 'ok') {
                            state.list = state.list.map(item => {
                                if (item.id == form.id) {
                                    item.training.name = form.name;
                                    item.hour = form.hour;
                                    item.minute = form.minute;
                                    item.start_at = res.data.a.start_at;
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
                    .post(store.state.api_url + '/trainings/' + training.id, {
                        _method: 'DELETE'
                    })
                    .then(response => {
                        state.list = state.list.filter(a => a.id !== training.id)
                    });
            }
        },


        addSet({state, commit}, training) {
            axios
                .post(store.state.api_url + '/trainings/sets', {
                    training_id: training.id,
                })
                .then(response => {
                    if (!training.sets) {
                        training.sets = [];
                    }
                    training.sets.push(response.data.set);
                });
        },

        removeSet({state, commit}, set) {
            if (confirm('Вы уверены что хотите удалить сет?')) {
                axios
                    .post(store.state.api_url + '/trainings/sets/' + set.id, {
                        _method: 'DELETE'
                    })
                    .then(response => {
                        state.list.forEach(function(item, kt) {
                            if (item.training.id == set.training_id) {
                                item.training.sets = item.training.sets.filter(s => s.id != set.id);
                            }
                        });
                    });
            }
        },


        saveActivitie({state, commit}, form) {

            if (!form.id) {
                axios
                    .post(store.state.api_url + '/trainings/activities', form)
                    .then(response => {

                        let a = response.data.a;

                        state.list.forEach(function(item, kt) {
                            if (item.training.id == a.set.training_id) {
                                if (!state.list[kt].training.sets) {
                                    state.list[kt].training.sets = [];
                                }
                                item.training.sets.forEach(function(set, ks) {

                                    if (set.id == a.set.id) {
                                        if (!state.list[kt].training.sets[ks].activities) {
                                            state.list[kt].training.sets[ks].activities = [];
                                        }
                                        state.list[kt].training.sets[ks].activities.push(a);
                                    }

                                });
                            }
                        });

                    });
            } else {
                axios
                    .post(store.state.api_url + '/trainings/activities/' + form.id, {
                        ...form,
                        _method: 'PUT'
                    })
                    .then(response => {

                        let a = response.data.a;

                        state.list.forEach(function(item, kt) {
                            if (item.training.id == a.set.training_id) {
                                item.training.sets.forEach(function(set, ks) {
                                    if (set.id == a.set.id) {
                                        set.activities.forEach(function(activitie, ka) {
                                            if (activitie.id == a.id) {
                                                state.list[kt].training.sets[ks].activities[ka] = a;
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
                    .post(store.state.api_url + '/trainings/activities/' + activitie.id, {
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
