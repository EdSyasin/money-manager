<template>
	<div class="app-text-field">
		<input class="app-text-field__input" :placeholder="placeholder"/>
	</div>
</template>

<script>
export default {
	name: "AppTextField",
	props: {
		value: String,
		placeholder: String
	}
}
</script>

<style lang="scss" scoped>
.app-text-field{
	@include neumorphic-out;
	background: $bg-color;
	color: $textColor;
	display: block;
	border: none;
	border-radius: $border-radius-small;

	&__input{
		@include neumorphic-in;
		border-radius: $border-radius-small;
		width: 100%;
		background: none;
		outline: none;
		border: none;
		height: 100%;
		color: $textColor;
	}
}

@mixin app-text-field($pageSize){
	.app-text-field{
		padding: convertByVw($pageSize, 7px);
		//height: convertByVw($pageSize, 38px);

		&__input{
			padding: convertByVw($pageSize, 10px);
		}
	}
}

@media (min-width: $xlg+1){
	@include app-text-field($xlg-max);
}

@media (max-width: $xlg){
	@include app-text-field($xlg);
}

@media (max-width: $lg){
	@include app-text-field($lg);
}

@media (max-width: $md){
	@include app-text-field($md);
}

@media (max-width: $tablet-horizontal){
	@include app-text-field($tablet-horizontal);
}

@media (max-width: $sm){
	@include app-text-field($sm);
}

@media (max-width: $xs){
	@include app-text-field($xs);
}

@media (max-width: $xs-mid){
	@include app-text-field($xs-mid);
}
</style>