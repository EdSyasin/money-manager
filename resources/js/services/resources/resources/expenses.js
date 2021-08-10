export default {
	getByUser: {
		method: 'get',
		url: 'users/:userId/expenses',
		queryParams: {
			page: '',
			itemPerPage: 15
		}
	},
}