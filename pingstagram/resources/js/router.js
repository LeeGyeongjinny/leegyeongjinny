import { createWebHistory, createRouter } from 'vue-router';
import LoginComponent from '../views/components/auth/LoginComponent.vue';
import BoardListComponent from '../views/components/board/BoardListComponent.vue';
import BoardCreateComponent from '../views/components/board/BoardCreateComponent.vue';
import UserRegistrationComponent from '../views/components/user/UserRegistrationComponent.vue';
import NotFoundComponent from '../views/components/NotFoundComponent.vue';
import { useStore } from 'vuex';


const chkAuth = (to, from, next) => {
    const store = useStore();
    const authFlg = store.state.user.authFlg;
    const noAuthPassFlg = (to.path === '/' || to.path === '/login' || to.path === '/registration');
    
    if(authFlg && noAuthPassFlg) {
        next('/boards');
    } else if(!authFlg && !noAuthPassFlg) {
        next('/login');
    } else {
        next();
    }
    
}

const routes = [
    {
        path: '/',
        redirect: 'login',
        beforeEnter: chkAuth,
    },
    {
        path: '/login',
        component: LoginComponent,
        beforeEnter: chkAuth,
    },
    {
        path: '/registration',
        component: UserRegistrationComponent,
        beforeEnter: chkAuth,
    },
    {
        path: '/boards',
        component: BoardListComponent,
        beforeEnter: chkAuth,
    },
    {
        path: '/boards/create',
        component: BoardCreateComponent,
        beforeEnter: chkAuth,
    },
    {
        path: '/:catchAll(.*)',
        component: NotFoundComponent,
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;