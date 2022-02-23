import Vue from 'vue'
import VueRouter from 'vue-router'

//componenti per rotta
import Home from './pages/Home';
import Blog from './pages/Blog';
import About from './pages/About';
import PostDetail from './pages/PostDetail';
import Contact from './pages/Contact';
import NotFound from './pages/NotFound';

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
            path: '/blog',
            name: 'blog',
            component: Blog,
        },
        {
            path: '/about',
            name: 'about',
            component: About,
        },
        {
            path: '/blog/:slug',
            name: 'postDetail',
            component: PostDetail,
        },
        {
            path: '/contact',
            name: 'contact',
            component: Contact,
        },
        {
            path: '*',
            name: 'not-found',
            component: NotFound,
        },
    ]
});

// export delle rotte
export default router;