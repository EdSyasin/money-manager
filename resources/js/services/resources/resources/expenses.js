export default {
	getByUser: {
		method: 'get',
		url: 'users/:userId/expenses',
		queryParams: {
			page: '',
			itemsPerPage: 15
		}
	},
}