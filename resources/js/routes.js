import Vue from 'vue'
import VueRouter from 'vue-router'

//componenti per rotta
import Home from './pages/Home';
import About from './pages/About';
import PostDetail from './pages/PostDetail';

// attvazione router in vue
Vue.use(VueRouter)

// definizione rotte
const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home,
        },
        {
            path: '/about',
            name: 'about',
            component: About,
        },
        {
            path: '/post-deatil',
            name: 'postDetail',
            component: PostDetail,
        },
    ]
});

// export delle rotte
export default router;