import {createStore} from "vuex";
import {activitieModule} from "./modules/activitieModule";
import calendarModule from "./modules/calendarModule";
import authModule from "./modules/authModule";
import profileModule from "./modules/profileModule";
import trainingsModule from "./modules/trainingsModule";
import plansModule from "./modules/plansModule";
import trainingModule from "./modules/trainingModule";

export default createStore({
    state: {
        api_url: '/api/v1',
        status: '',
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
    },

    actions: {
    },

    getters: {
    },

    modules: {
        auth: authModule,
        activitie: activitieModule,
        calendar: calendarModule,
        profile: profileModule,
        trainings: trainingsModule, // список тренировок
        training: trainingModule,   // одна тренировка
        plans: plansModule
    }
})
