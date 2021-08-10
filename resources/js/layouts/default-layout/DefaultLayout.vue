<template>
	<div class="default-layout">
		<the-navigation/>
		<slot></slot>
	</div>
</template>

<script>
import TheNavigation from "@/layouts/default-layout/TheNavigation";

export default {
	name: "DefaultLayout",
	components: {
		TheNavigation
	}
}
</script>

<style scoped lang="scss">
	.default-layout{
		min-height: 100vh;
	}

	@mixin default-layout-sizes($pageSize){
		.default-layout{
			margin-left: convertByVw($pageSize, $default-sidebar-width);
		}
	}

	@include default-layout-sizes($xlg-max);

	@media (max-width: $xlg){
		@include default-layout-sizes($xlg);
	}

	@media (max-width: $lg){
		@include default-layout-sizes($lg);
	}

	@media (max-width: $md){
		@include default-layout-sizes($md);
	}

	@media (max-width: $tablet-horizontal){
		@include default-layout-sizes($tablet-horizontal);
	}

	@media (max-width: $sm){
		@include default-layout-sizes($sm);
	}

	@media (max-width: $xs){
		@include default-layout-sizes($xs);
	}

	@media (max-width: $xs-mid){
		@include default-layout-sizes($xs-mid);
	}
</style>