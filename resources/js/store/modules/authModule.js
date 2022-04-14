import axios from "axios";
import {commit} from "lodash/seq";

export default {
    state: () => ({
        auth_error: '',
        register_errors: '',
        token: localStorage.getItem('token') || '',
        user: localStorage.getItem('user') ? JSON.parse(localStorage.getItem('user')) : {},
    }),
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
    mutations: {
        auth_request(state) {
            state.status = 'loading'
        },
        auth_success(state, data) {
            state.status = 'success'
            state.token = data.token
            state.user = data.user
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
        register_success(state, data) {
            state.status = 'success'
            state.user = data.user
            state.token = data.token
            state.register_errors = ''
        },
        logout(state) {
            state.status = ''
            state.token = ''
            state.user = {}
        },
    },
    actions: {
        login({commit}, user) {
            return new Promise((resolve, reject) => {
                commit('auth_request')
                axios({url: '/api/v1/auth/login', data: user, method: 'POST'})
                    .then(resp => {
                        const token = resp.data.access_token
                        localStorage.setItem('token', token)
                        localStorage.setItem('user', JSON.stringify(resp.data.user))
                        axios.defaults.headers.common['Authorization'] = 'Bearer ' + token
                        commit('auth_success', {'token': token, 'user': resp.data.user})
                        resolve(resp)
                    })
                    .catch(err => {
                        commit('auth_error', 'Не удалось авторизоваться')
                        localStorage.removeItem('token')
                        localStorage.removeItem('user')
                        reject(err)
                    })
            })
        },
        logout({commit}) {
            return new Promise((resolve, reject) => {
                commit('logout')
                localStorage.removeItem('token')
                localStorage.removeItem('user')
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
                        const token = resp.data.access_token
                        localStorage.setItem('token', token)
                        localStorage.setItem('user', JSON.stringify(user))
                        axios.defaults.headers.common['Authorization'] = 'Bearer ' + token
                        // commit('auth_success', {'token': token, 'user': user})
                        commit('register_success', {'token': token, 'user': user});
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
    namespaced: true
}
