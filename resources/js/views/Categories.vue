<template>
	<main class="categories-page">
		<app-data-table :items="categories" :headers="$options.headers"></app-data-table>
	</main>
</template>

<script>
export default {
	name: "Expenses",
	inject: ['Api'],
	data(){
		return {
			loading: false,
			categories: [],
			options: {
				page: 1,
				itemsPerPage: 10
			}
		}
	},
	headers: [
		{
			name: 'id',
			value: 'id'
		},
		{
			name: 'Название',
			value: 'name'
		},
		{
			name: '',
			value: 'action',
			align: 'right'
		}
	],
	methods:{
		updateExpenses(){
			this.loading = true;
			this.api.getByUser({
				userId: this.$store.state.user.id,
				...this.options
			})
			.then(res => {
				this.categories = res.data.categories;
			})
			.finally(() => {
				this.loading = false;
			})
		}
	},
	created() {
		this.api = this.Api.categories();
		this.updateExpenses();
	}
}
</script>

<style lang="scss" scoped>
	.categories-page{
		min-height: 100vh;
	}

	@mixin categories-page-sizes($pageSize){
		.categories-page{
			padding: convertByVw($pageSize, 50px) $main-padding;
		}
	}

	@include categories-page-sizes($xlg-max);

	@media (max-width: $xlg){
		@include categories-page-sizes($xlg);
	}

	@media (max-width: $lg){
		@include categories-page-sizes($lg);
	}

	@media (max-width: $md){
		@include categories-page-sizes($md);
	}

	@media (max-width: $tablet-horizontal){
		@include categories-page-sizes($tablet-horizontal);
	}

	@media (max-width: $sm){
		@include categories-page-sizes($sm);
	}

	@media (max-width: $xs){
		@include categories-page-sizes($xs);
	}

	@media (max-width: $xs-mid){
		@include categories-page-sizes($xs-mid);
	}
</style>