import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

const routes = [
	{
		name: 'welcome',
		path: "/",
		component: () => import('@/views/Welcome')
	},
	{
		name: 'Login',
		path: "/login",
		component: () => import('@/views/login/Login'),
		meta: {
			layout: 'clean-layout'
		}
	},

];

const router = new VueRouter({
	mode: 'history',
	routes: routes
})

export default router;