<template>
	<div class="clean-layout">
		<slot></slot>
	</div>
</template>

<script>
export default {
	name: "CleanLayout"
}
</script>

<style lang="scss" scoped>
	.clean-layout{
		min-height: 100vh;
	}
</style>