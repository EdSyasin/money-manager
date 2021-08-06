<template>
	<button class="app-button" @click="$emit('click')">
		<slot></slot>
	</button>
</template>

<script>
export default {
	name: "AppButton"
}
</script>

<style lang="scss" scoped>
	.app-button{
		@include neumorphic-out;
		background: $bg-color;
		color: $textColor;
		display: block;
		border: none;
		border-radius: $border-radius-small;

		&:focus{
			outline: none;
		}

		&:active{
			@include neumorphic-in;
		}
	}

	@mixin app-button-sizes($pageSize){
		.app-button{
			padding: convertByVw($pageSize, 10px) convertByVw($pageSize, 16px);
			height: convertByVw($pageSize, 53px);
		}
	}

	@media (min-width: $xlg+1){
		@include app-button-sizes($xlg-max);
	}

	@media (max-width: $xlg){
		@include app-button-sizes($xlg);
	}

	@media (max-width: $lg){
		@include app-button-sizes($lg);
	}

	@media (max-width: $md){
		@include app-button-sizes($md);
	}

	@media (max-width: $tablet-horizontal){
		@include app-button-sizes($tablet-horizontal);
	}

	@media (max-width: $sm){
		@include app-button-sizes($sm);
	}

	@media (max-width: $xs){
		@include app-button-sizes($xs);
	}

	@media (max-width: $xs-mid){
		@include app-button-sizes($xs-mid);
	}
</style>