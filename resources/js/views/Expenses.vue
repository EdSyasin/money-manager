<template>
	<main class="expenses-page">

	</main>
</template>

<script>
export default {
	name: "Expenses",
	inject:['Api'],
	data(){
		return {
			loading: false,
			expenses: []
		}
	},
	methods:{
		updateExpenses(){
			this.loading = true;
			this.api.getByUser({
				userId: this.$store.state.user.id
			})
			.then(res => {
				this.expenses = res.data.expenses;
			})
			.finally(() => {
				this.loading = false;
			})
		}
	},
	created() {
		this.api = this.Api.expenses;
		this.updateExpenses();
	}
}
</script>

<style lang="scss" scoped>
	.expenses-page{
		min-height: 100vh;
	}

	@mixin expenses-page-sizes($pageSize){
		.expenses-page{
			padding: 0 $main-padding;
		}
	}

	@include expenses-page-sizes($xlg-max);

	@media (max-width: $xlg){
		@include expenses-page-sizes($xlg);
	}

	@media (max-width: $lg){
		@include expenses-page-sizes($lg);
	}

	@media (max-width: $md){
		@include expenses-page-sizes($md);
	}

	@media (max-width: $tablet-horizontal){
		@include expenses-page-sizes($tablet-horizontal);
	}

	@media (max-width: $sm){
		@include expenses-page-sizes($sm);
	}

	@media (max-width: $xs){
		@include expenses-page-sizes($xs);
	}

	@media (max-width: $xs-mid){
		@include expenses-page-sizes($xs-mid);
	}
</style>