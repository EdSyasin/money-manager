<template>
	<div class="login-form">
		<div class="login-form__item">
			<app-text-filed
					v-model="form.login"
					placeholder="Login"
					class="login-form__item-input"
			></app-text-filed>
			<template v-if="this.validationErrors.login">
				<span
						class="login-form__item-error"
						v-if="this.validationErrors.login.includes('notEmpty')"
				>
					Поле не может быть пустым
				</span>
				<span
						class="login-form__item-error"
						v-else-if="this.validationErrors.login.includes('length')"
				>
					Логин слишком короткий
				</span>
				<span
						class="login-form__item-error"
						v-else-if="this.validationErrors.login.includes('user is not found')"
				>
					Пользователь не найден
				</span>

			</template>
		</div>
		<div class="login-form__item">
			<app-text-filed
				v-model="form.password"
				placeholder="Password"
				class="login-form__item-input"
			></app-text-filed>
			<template v-if="this.validationErrors.password">
				<span
					class="login-form__item-error"
					v-if="this.validationErrors.password.includes('notEmpty')"
				>
					Поле не может быть пустым
				</span>
				<span
					class="login-form__item-error"
					v-else-if="this.validationErrors.password.includes('length')"
				>
					Пароль слишком короткий
				</span>
				<span
					class="login-form__item-error"
					v-else-if="this.validationErrors.password.includes('Wrong password')"
				>
					Неверный пароль
				</span>

			</template>
		</div>
		<app-button @click="submit">Войти</app-button>
	</div>
</template>

<script>
import Validator from "@/services/validator";

export default {
	name: "LoginForm",
	inject: ['Api'],
	data:() => ({
		form: {
			login: '',
			password: ''
		},
		validationErrors: {},
		loading: false
	}),
	methods: {
		validate(){
			this.validationErrors = this.loginValidator.validate(this.form);
			return Object.keys(this.validationErrors).length === 0;
		},
		submit() {
			if(!this.validate()) return false;
			this.loading = true;
			this.api.auth(this.form)
				.then(res => {
					this.Api.setTokens(res.data.access_token, res.data.refresh_token);
					this.$store.commit('SET_USER', res.data.user);
					this.$router.push('/');
				})
				.catch(err => {
					this.validationErrors = err.response.data.errors;
				})
		}
	},
	created(){
		this.loginValidator = new Validator({
			login: ['notEmpty', { rule: 'length', parameters: {min: 3}}],
			password: ['notEmpty', { rule: 'length', parameters: {min: 6}}]
		});
		this.api = this.Api.auth();
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

		&__item{
			&-error{
				color: darkred;
			}
		}
	}

	@mixin login-form-sizes($pageSize){
		.login-form{
			width: convertByVw($pageSize, 400px);
			height: convertByVw($pageSize, 400px);
			padding: convertByVw($pageSize, 16px);

			&__item{
				height: convertByVw($pageSize, 83px);

				&-input{
					margin-bottom: convertByVw($pageSize, 10px);
				}
			}
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