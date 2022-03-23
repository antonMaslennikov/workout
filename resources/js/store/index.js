import {createStore} from "vuex";
// import {postModule} from "./store/postModule";

export default createStore({
    state: {
        body_parts: [
            {'id' : 1, 'name' : 'Руки'},
            {'id' : 2, 'name' : 'Ноги'},
            {'id' : 3, 'name' : 'Спина'},
            {'id' : 4, 'name' : 'Грудь'},
            {'id' : 5, 'name' : 'Плечи'},
            {'id' : 6, 'name' : 'Живот'},
        ]
    },
    getters: {
        // doubleLikes(state) {
        //     return state.likes * 2;
        // }
    },
    // mutations: {
    //     incrementLikes(state) {
    //         state.likes++;
    //     },
    //     decrementLikes(state) {
    //         state.likes--;
    //     }
    // }

    modules: {
        // post: postModule
    }
})
