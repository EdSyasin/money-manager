import Vue from 'vue';
import router from './router';
import store from './store';
import App from './App.vue';
import '../css/normalize.css';
import Api from '@/services/resources';

//Global components
import DefaultLayout from "@/layouts/default-layout/DefaultLayout";
import CleanLayout from "@/layouts/CleanLayout";
import AppButton from "@/components/AppButton";
import AppTextField from "@/components/AppTextField";
import AppDataTable from "@/components/AppDataTable";

Vue.component('default-layout', DefaultLayout);
Vue.component('clean-layout', CleanLayout);
Vue.component('app-button', AppButton);
Vue.component('app-text-filed', AppTextField);
Vue.component('app-data-table', AppDataTable);

const vueInstance = new Vue({
	provide: {Api},
	router,
	store,
	render: h => h(App)
}).$mount("#app")


window.vue = vueInstance;
