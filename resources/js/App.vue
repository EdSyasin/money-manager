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
	body{
		min-height: 100vh;
	}
</style>