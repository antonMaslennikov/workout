import axios from "axios";

export const activitieModule = {
    state: () => ({
        activities: [],
        isLoading: true,
        page: 1,
        limit: 10,
        totalPages: 0,
        searchQuery: '',
    }),
    getters: {
        list(state) {
            return state.activities;
        },
        page(state) {
            return state.page;
        },
        totalPages(state) {
            return state.totalPages;
        }
    },
    mutations: {
        setActivities(state, activities) {
            state.activities = activities;
        },
        addNewActivitie(state, activitie) {
            state.activities.push(activitie);
        },
        updateActivitie(state, activitie) {
            state.activities = state.activities.map(item => {
                if (item.id == activitie.id) {
                    return activitie;
                } else {
                    return item;
                }
            });
        },
        removeActivitie(state, activitie) {
            state.activities = state.activities.filter(a => a.id !== activitie.id)
        },
        setLoading(state, bool) {
            state.isLoading = bool;
        },
        setSearchQuery(state, searchQuery) {
            state.searchQuery = searchQuery;
        },
        setPage(state, page) {
            state.page = page;
        },
        setLimit(state, limit) {
            state.limit = limit;
        },
        setTotalPages(state, totalPages) {
            state.totalPages = totalPages;
        }
    },
    actions: {
        async fetchActivities({state, commit}) {
                commit('setLoading', true);

                const response = await axios.get('/api/v1/activities', {
                    params: {
                        limit: state.limit,
                        page: state.page,
                    },
                    headers: {
                        'Content-type':'application/json'
                    }
                });

                commit('setTotalPages', Math.ceil(response.data.total / state.limit));
                commit('setActivities', response.data.data);
        },

        createActivitie({state, commit}, activitie) {
            axios
                .post('/api/v1/activities', activitie, {
                    headers: {
                        'Content-type':'application/json'
                    }
                })
                .then(res => {
                    if (res.data.status == 'ok') {
                        activitie.id = res.data.a.id;
                        commit('addNewActivitie', activitie);
                    }
                });
        },

        updateActivitie({state, commit}, activitie) {
            axios
                .post('/api/v1/activities/' + activitie.id, {
                    name : activitie.name,
                    description : activitie.description,
                    body_part : activitie.body_part,
                    _method: 'PUT'
                })
                .then(res => {
                    if (res.data.status == 'ok') {
                        commit('updateActivitie', activitie);
                    }
                });
        },

        removeActivitie({state, commit}, activitie) {
            if (confirm('Подтверждаете удаление?')) {
                axios
                    .post('/api/v1/activities/' + activitie.id, {
                        _method: 'DELETE'
                    })
                    .then(response => {
                        commit('removeActivitie', activitie);
                    });
            }
        },

        saveSort({state}, order) {
            axios
                .post('/api/v1/activities/savesort', {'order' : order})
                .then(response => {
                });
        },

        setPage({state, commit, dispatch}, page) {
            commit('setPage', page);
            dispatch('fetchActivities');
        }
    },
    namespaced: true
}
