import Vue from 'vue';
import router from './router';
import App from './App.vue';
import '../css/normalize.css';

//Global components
import DefaultLayout from "@/layouts/default-layout/DefaultLayout";
import CleanLayout from "@/layouts/CleanLayout";
import AppButton from "@/components/AppButton";
import AppTextField from "@/components/AppTextField";

Vue.component('default-layout', DefaultLayout);
Vue.component('clean-layout', CleanLayout);
Vue.component('app-button', AppButton);
Vue.component('app-text-filed', AppTextField);


new Vue({
	router,
	render: h => h(App)
}).$mount("#app")