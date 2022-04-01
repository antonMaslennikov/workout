import {createStore} from "vuex";
import {activitieModule} from "./modules/activitieModule";

export default createStore({
    state: {
        status: '',
        token: localStorage.getItem('token') || '',
        user: {},
        body_parts: [
            {'id': 1, 'name': 'Руки'},
            {'id': 2, 'name': 'Ноги'},
            {'id': 3, 'name': 'Спина'},
            {'id': 4, 'name': 'Грудь'},
            {'id': 5, 'name': 'Плечи'},
            {'id': 6, 'name': 'Живот'},
        ],
        months: [
            'Январь',
            'Февраль',
            'Март',
            'Апрель',
            'Май',
            'Июнь',
            'Июль',
            'Август',
            'Сентябрь',
            'Октябрь',
            'Ноябрь',
            'Декабрь',
        ],
    },

    mutations: {
        auth_request(state) {
            state.status = 'loading'
        },
        auth_success(state, token, user) {
            state.status = 'success'
            state.token = token
            state.user = user
        },
        auth_error(state) {
            state.status = 'error'
        },
        logout(state) {
            state.status = ''
            state.token = ''
        },
    },

    actions: {
        login({commit}, user) {
            return new Promise((resolve, reject) => {
                commit('auth_request')
                axios({url: '/api/auth/login', data: user, method: 'POST'})
                    .then(resp => {
                        const token = resp.data.access_token
                        const user = resp.data.user
                        localStorage.setItem('token', token)
                        localStorage.setItem('user', JSON.stringify(user))
                        axios.defaults.headers.common['Authorization'] = 'Bearer ' + token
                        commit('auth_success', token, user)
                        resolve(resp)
                    })
                    .catch(err => {
                        commit('auth_error')
                        localStorage.removeItem('token')
                        reject(err)
                    })
            })
        },
        logout({commit}) {
            return new Promise((resolve, reject) => {
                commit('logout')
                localStorage.removeItem('token')
                delete axios.defaults.headers.common['Authorization']
                resolve()
            })
        },
        register({commit}, user) {
            return new Promise((resolve, reject) => {
                commit('auth_request')
                axios({url: '/api/auth/register', data: user, method: 'POST'})
                    .then(resp => {
                        const token = resp.data.token
                        const user = resp.data.user
                        localStorage.setItem('token', token)
                        localStorage.setItem('user', JSON.stringify(user))
                        axios.defaults.headers.common['Authorization'] = 'Bearer ' + token
                        commit('auth_success', token, user)
                        resolve(resp)
                    })
                    .catch(err => {
                        commit('auth_error', err)
                        localStorage.removeItem('token')
                        reject(err)
                    })
            })
        }
    },

    getters: {
        isLoggedIn: state => !!state.token,
        authStatus: state => state.status,
    },

    modules: {
        activitie: activitieModule
    }
})
