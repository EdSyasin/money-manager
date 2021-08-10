import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

const routes = [
	{
		name: 'welcome',
		path: "/",
		component: () => import(/* webpackChunkName: "WelcomePage" */ '@/views/Welcome')
	},
	{
		name: 'Login',
		path: "/login",
		component: () => import(/* webpackChunkName: "LoginPage" */ '@/views/login/Login'),
		meta: {
			layout: 'clean-layout'
		}
	},
	{
		name: 'Expenses',
		path: '/expenses',
		component: () => import(/* webpackChunkName: "ExpensesPage" */ '@/views/Expenses')
	}

];

const router = new VueRouter({
	mode: 'history',
	routes: routes
})

export default router;