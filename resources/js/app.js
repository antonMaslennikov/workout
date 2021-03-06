import { createApp } from 'vue';
import App from "./components/App";
import router from "./router/router";
import components from './components/UI';
// import directives from "@/directives";
import store from "./store";
import axios from "axios";

const app = createApp(App);

components.forEach(component => {
    app.component(component.name, component);
})

// directives.forEach(directive => {
//     app.directive(directive.name, directive);
// });

const token = localStorage.getItem('token')
if (token && token != 'undefined') {
    // устанавливаем по дефолту для axios заголовок авторизации с токеном
    axios.defaults.headers.common['Authorization'] = 'Bearer ' + token
}

app
    .use(router)
    .use(store)
    .mount('#app');

require('./bootstrap');
