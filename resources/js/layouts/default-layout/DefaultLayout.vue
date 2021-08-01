<template>
	<div class="default-layout">
		<slot></slot>
	</div>
</template>

<script>
export default {
	name: "DefaultLayout"
}
</script>

<style scoped lang="scss">
	.default-layout{
		min-height: 100vh;
	}
</style>