export default {
	auth: {
		method: 'post',
		url: 'auth',
		body: {
			login: '',
			password: ''
		}
	},
	refresh: {
		method: 'post',
		url: 'auth/refresh',
		body: {
			refresh_token: ''
		}
	}

}