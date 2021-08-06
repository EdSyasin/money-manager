<template>
	<div class="login-page">
		<login-form class="login-page__form"/>
	</div>
</template>

<script>
import LoginForm from "@/views/login/LoginForm";

export default {
	name: "Login",
	components: {
		LoginForm
	}
}
</script>

<style lang="scss" scoped>
	.login-page{
		min-height: 100vh;
		display: flex;
		justify-content: center;
		align-items: center;
	}
</style>