import Vue from 'vue';
import App from './views/App';


// app router
import router from './routes';

// init vue instance
const app = new Vue({
    el: '#root',
    router,
    render: h => h(App)
});