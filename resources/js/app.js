import { createApp } from 'vue';
import App from "./components/App";
import router from "./router/router";
import components from './components/UI';
// import directives from "@/directives";
// import store from "@/store";

const app = createApp(App);

components.forEach(component => {
    console.log(component);
    app.component(component.name, component);
})

// directives.forEach(directive => {
//     app.directive(directive.name, directive);
// });

app
    .use(router)
    // .use(store)
    .mount('#app');

require('./bootstrap');
