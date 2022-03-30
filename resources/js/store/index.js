import {createStore} from "vuex";
import { activitieModule } from "./modules/activitieModule";

export default createStore({
    state: {
        body_parts: [
            {'id' : 1, 'name' : 'Руки'},
            {'id' : 2, 'name' : 'Ноги'},
            {'id' : 3, 'name' : 'Спина'},
            {'id' : 4, 'name' : 'Грудь'},
            {'id' : 5, 'name' : 'Плечи'},
            {'id' : 6, 'name' : 'Живот'},
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

    modules: {
        activitie : activitieModule
    }
})
