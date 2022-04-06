import {createStore} from "vuex";
import {activitieModule} from "./modules/activitieModule";

export default createStore({
    state: {
        status: '',
        auth_error: '',
        register_errors: '',
        token: localStorage.getItem('token') || '',
        user: localStorage.getItem('user') ? JSON.parse(localStorage.getItem('user')) : {},
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
            state.auth_error = ''
        },
        auth_error(state, error) {
            state.status = 'error'
            state.auth_error = error
        },
        register_error(state, errors) {
            state.status = 'error'
            state.register_errors = errors
        },
        register_success(state, user) {
            state.status = 'success'
            state.user = user
            state.register_errors = ''
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
                axios({url: '/api/v1/auth/login', data: user, method: 'POST'})
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
                        commit('auth_error', 'Не удалось авторизоваться')
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
                axios({url: '/api/v1/auth/register', data: user, method: 'POST'})
                    .then(resp => {
                        const user = resp.data.user
                        // const token = resp.data.access_token
                        // localStorage.setItem('token', token)
                        // localStorage.setItem('user', JSON.stringify(user))
                        // axios.defaults.headers.common['Authorization'] = 'Bearer ' + token
                        // commit('auth_success', token, user)
                        commit('register_success', user);
                        resolve(resp)
                    })
                    .catch(err => {
                        commit('register_error', err.response.data.errors)
                        localStorage.removeItem('token')
                        reject(err)
                    })
            })
        },
        verify({commit}, token) {
            return new Promise((resolve, reject) => {
                commit('auth_request')
                axios({url: '/api/v1/auth/verify', data: {'token' : token}, method: 'POST'})
                    .then(resp => {
                        const user = resp.data.user
                        const token = resp.data.access_token
                        localStorage.setItem('token', token)
                        localStorage.setItem('user', JSON.stringify(user))
                        axios.defaults.headers.common['Authorization'] = 'Bearer ' + token
                        commit('auth_success', token, user)
                        resolve(resp)
                    })
                    .catch(err => {
                        // commit('verify_error', err.response.data.message)
                        reject(err)
                    })
            })
        }
    },

    getters: {
        isLoggedIn: state => !!state.token && state.token != 'undefined',
        authStatus: state => state.status,
        userLogin(state) {
            if (state.user) {
                return state.user.name || state.user.email;
            }
        },
        nameError(state) {
            if (typeof state.register_errors.name !== 'undefined')
                return state.register_errors.name.join(',')
            else
                return '';
        },
        emailError(state) {
            if (typeof state.register_errors.email !== 'undefined')
                return state.register_errors.email.join(',')
            else
                return '';
        },
        passwordError(state) {
            if (typeof state.register_errors.password !== 'undefined')
                return state.register_errors.password.join(',')
            else
                return '';
        }
    },

    modules: {
        activitie: activitieModule
    }
})
