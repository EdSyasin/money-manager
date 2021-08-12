<template>
	<div class="app-data-table">
		<table class="app-data-table__table">
			<tr class="app-data-table__header-row">
				<th v-for="(item) in headers" :key="item.name">{{item.name}}</th>
			</tr>
			<tbody>
				<tr
					v-for="(item, index) in items"
					:key="index"
					class="app-data-table__data-row"
				>
					<td v-for="(header, headerIndex) in headers" :key="headerIndex" :align="header.align || 'center' ">
						<slot :name="'item.' + header.value" :item="items[index]">
							{{items[index][header.value]}}
						</slot>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
</template>

<script>
export default {
	name: "AppDataTable",
	props: {
		headers: {
			required: true,
			type: Array
		},
		items: {
			required: true,
			type: Array
		}
	}
}
</script>

<style lang="scss" scoped>
	.app-data-table{
		@include neumorphic-in;
		border-radius: $border-radius;
		color: $textColor;

		&__table{
			width: 100%;
		}
	}

	@mixin app-data-table($pageSize){
		.app-data-table{
			padding: convertByVw($pageSize, 16px);

			&__table{
				width: 100%;
			}

			&__header-row,
			&__data-row{
				height: convertByVw($pageSize, 51px);
				tr, td{
					padding: 0;
				}
			}
		}
	}

	@include app-data-table($xlg-max);

	@media (max-width: $xlg){
		@include app-data-table($xlg);
	}

	@media (max-width: $lg){
		@include app-data-table($lg);
	}

	@media (max-width: $md){
		@include app-data-table($md);
	}

	@media (max-width: $tablet-horizontal){
		@include app-data-table($tablet-horizontal);
	}

	@media (max-width: $sm){
		@include app-data-table($sm);
	}

	@media (max-width: $xs){
		@include app-data-table($xs);
	}

	@media (max-width: $xs-mid){
		@include app-data-table($xs-mid);
	}
</style>