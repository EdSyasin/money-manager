export default {
	state: () => ({
		id: null,
		first_name: '',
		last_name: '',
		email: ''
	}),
	mutations: {
		SET_USER(state, user){
			for(let stateItem in state){
				state[stateItem] = user[stateItem] || state[stateItem]
			}
		},
		DEL_USER(state){
			state.id = null;
			state.first_name = '';
			state.last_name = '';
			state.email = '';
		}
	},
	getters: {
		isLogin(state){
			return !!state.id;
		}
	}
}