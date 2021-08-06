<template>
	<component :is="layout" class="app">
		<router-view></router-view>
	</component>
</template>

<script>
export default {
	name: "App",
	computed: {
		layout(){
			return this.$route.meta.layout || 'default-layout'
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
	}

	*{
		box-sizing: border-box;
	}

</style>