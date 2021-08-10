<template>
	<nav class="default-navbar">
		<ul class="default-navbar__list">
			<navigation-list-item
					v-for="link in links"
					:key="link.link"
					:item="link"
			/>
		</ul>
	</nav>
</template>

<script>
import NavigationListItem from "@/layouts/default-layout/NavigationListItem";

export default {
	name: "TheNavigation",
	data(){
		return {
			links: [
				{
					title: '$',
					link: '/expenses',
					icon: 'expenses'
				},
				{
					title: 'Ca',
					link: '/categories',
					icon: 'categories'
				},
				{
					title: 'set',
					link: '/settings',
					icon: 'settings'
				}
			]
		}
	},
	components: {
		NavigationListItem
	},
}
</script>

<style lang="scss" scoped>
	.default-navbar{
		position: fixed;
		top: 0;
		left: 0;
		height: 100vh;
		display: flex;
		justify-content: center;
		align-items: center;

		&__list{
			list-style: none;
			margin: 0;
			padding: 0;
			display: flex;
			flex-direction: column;
			justify-content: space-between;
			align-items: center;
			height: fit-content;
		}
	}

	@mixin default-navbar-sizes($pageSize){
		.default-navbar{
			width: convertByVw($pageSize, $default-sidebar-width);

			&__list{

			}
		}
	}

	@include default-navbar-sizes($xlg-max);

	@media (max-width: $xlg){
		@include default-navbar-sizes($xlg);
	}

	@media (max-width: $lg){
		@include default-navbar-sizes($lg);
	}

	@media (max-width: $md){
		@include default-navbar-sizes($md);
	}

	@media (max-width: $tablet-horizontal){
		@include default-navbar-sizes($tablet-horizontal);
	}

	@media (max-width: $sm){
		@include default-navbar-sizes($sm);
	}

	@media (max-width: $xs){
		@include default-navbar-sizes($xs);
	}

	@media (max-width: $xs-mid){
		@include default-navbar-sizes($xs-mid);
	}

</style>