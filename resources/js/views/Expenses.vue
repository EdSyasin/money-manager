<template>
	<main class="expenses-page">
        <app-button @click="showForm = true">Добавить</app-button>
        <the-expense-add-modal
            v-if="showForm"
            @close="showForm = false"
        ></the-expense-add-modal>
		<app-data-table
                :items="expenses"
                :headers="$options.headers"
        ></app-data-table>
	</main>
</template>

<script>
import TheExpenseAddModal from "@/components/TheExpenseAddModal";

export default {
	name: "Expenses",
	inject: ['Api'],
	data(){
		return {
			loading: false,
			expenses: [],
			options: {
				page: 1,
				itemsPerPage: 10
			},
            showForm: true
		}
	},
	headers: [
		{
			name: 'Сумма',
			value: 'amount'
		},
		{
			name: 'Категория',
			value: 'category_id'
		},
		{
			name: 'Комментарий',
			value: 'description'
		},
		{
			name: 'Дата',
			value: 'spent_at'
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
				this.expenses = res.data.expenses;
			})
			.finally(() => {
				this.loading = false;
			})
		}
	},
	created() {
		this.api = this.Api.expenses();
		this.updateExpenses();
	},
    components: {
	    TheExpenseAddModal
    }
}
</script>

<style lang="scss" scoped>
	.expenses-page{
		min-height: 100vh;
	}

	@mixin expenses-page-sizes($pageSize){
		.expenses-page{
			padding: convertByVw($pageSize, 50px) $main-padding;
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
