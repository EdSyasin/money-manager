<template>
	<li class="navigation-item">
		<router-link
				:to="item.link"
				class="navigation-item__link"
				active-class="navigation-item__link_active"
		>{{item.title}}</router-link>
	</li>
</template>

<script>
export default {
	name: "NavigationListItem",
	props: {
		item: Object
	}
}
</script>

<style lang="scss" scoped>

	.navigation-item{
		display: block;

		&__link{
			@include neumorphic-out;
			border-radius: $border-radius;
			text-decoration: none;
			display: flex;
			justify-content: center;
			align-items: center;
			color: $textColor;

			&_active{
				@include neumorphic-in;
			}
		}
	}

	@mixin navigation-item-sizes($pageSize){
		.navigation-item{
			margin: convertByVw($pageSize, 20px);

			&__link{
				width: convertByVw($pageSize, 60px);
				height: convertByVw($pageSize, 60px);
			}
		}
	}

	@include navigation-item-sizes($xlg-max);

	@media (max-width: $xlg){
		@include navigation-item-sizes($xlg);
	}

	@media (max-width: $lg){
		@include navigation-item-sizes($lg);
	}

	@media (max-width: $md){
		@include navigation-item-sizes($md);
	}

	@media (max-width: $tablet-horizontal){
		@include navigation-item-sizes($tablet-horizontal);
	}

	@media (max-width: $sm){
		@include navigation-item-sizes($sm);
	}

	@media (max-width: $xs){
		@include navigation-item-sizes($xs);
	}

	@media (max-width: $xs-mid){
		@include navigation-item-sizes($xs-mid);
	}
</style>