<template>
	<div class="login-form">
		<app-text-filed
				v-model="form.login"
				placeholder="Login"
		></app-text-filed>
		<app-text-filed
				v-model="form.password"
				placeholder="Password"
		></app-text-filed>
		<app-button @click="validate">Войти</app-button>
	</div>
</template>

<script>
import Validator from "@/services/validator";

export default {
	name: "LoginForm",
	data:() => ({
		form: {
			login: '',
			password: ''
		},
		validationErrors: {}
	}),
	methods: {
		validate(){
			this.validationErrors = this.loginValidator.validate(this.form);
		}
	},
	created(){
		this.loginValidator = new Validator({
			login: ['notEmpty', { rule: 'length', parameters: {min: 3, max: 10}}],
			password: ['notEmpty', { rule: 'length', parameters: {min: 6}}]
		});
	}
}
</script>

<style scoped lang="scss">
	.login-form{
		@include neumorphic-in;
		border-radius: $border-radius;
		transition: 0.5s;
		display: flex;
		flex-direction: column;
		justify-content: space-around;
	}

	@mixin login-form-sizes($pageSize){
		.login-form{
			width: convertByVw($pageSize, 400px);
			height: convertByVw($pageSize, 400px);
			padding: convertByVw($pageSize, 16px);
		}
	}

	@media (min-width: $xlg + 1){
		@include login-form-sizes($xlg-max);
	}

	@media (max-width: $xlg){
		@include login-form-sizes($xlg);
	}

	@media (max-width: $lg){
		@include login-form-sizes($lg);
	}

	@media (max-width: $md){
		@include login-form-sizes($md);
	}

	@media (max-width: $tablet-horizontal){
		@include login-form-sizes($tablet-horizontal);
	}

	@media (max-width: $sm){
		@include login-form-sizes($sm);
	}

	@media (max-width: $xs){
		@include login-form-sizes($xs);
	}

	@media (max-width: $xs-mid){
		@include login-form-sizes($xs-mid);
	}

</style>