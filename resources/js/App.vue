<template>
	<component :is="layout" class="app">
		<router-view v-if="!loading"></router-view>
	</component>
</template>

<script>
export default {
	name: "App",
	inject: ['Api'],
	data: () => ({
		loading: true
	}),
	computed: {
		layout(){
			return this.$route.meta.layout || 'default-layout'
		}
	},
	created(){
		const refreshToken = localStorage.getItem('refreshToken');
		if(refreshToken){
			this.Api.auth().refresh({
				'refresh_token': refreshToken
			})
			.then(res => {
				this.Api.setTokens(res.data.access_token, res.data.refresh_token);
				this.$store.commit('SET_USER', res.data.user);
			})
			.catch(() => {
				this.$store.commit('DEL_USER');
			})
			.finally(() => {
				this.loading = false;
			})
		} else {
			this.loading = false;
		}
	}
}
</script>

<style lang="scss">
	@font-face {
		font-family: 'Open Sans';
		src: url(../fonts/Roboto/Roboto-Regular.ttf) format('truetype');
	}

	body{
		min-height: 100vh;
		font-family: Roboto, sans-serif;
		background: $bg-color;
        color: $textColor;
	}

	*{
		box-sizing: border-box;
	}

</style>
