import Axios from 'axios';

const http = new Axios.create({
	baseURL: '/api/',
	responseType: 'json'
});

const accessToken = localStorage.getItem('accessToken');
if(accessToken){
	http.defaults.headers.Authorization = `Bearer ${accessToken}`;
}

http.interceptors.response.use(response => response,(error) => {
	const originalRequest = error.config;
	if (error.response.status === 401 && !originalRequest._retry){
		originalRequest._retry = true;
		console.log('retry!')
		return http.post('auth/refresh', {refresh_token: localStorage.getItem('refreshToken')})
			.then( response => {
				localStorage.setItem('refreshToken', response.data.refresh_token)
				http.defaults.headers.Authorization = `Bearer ${response.data.access_token}`;
				originalRequest.headers.Authorization = `Bearer ${response.data.access_token}`;
				return http(originalRequest)
			})
	}
	return Promise.reject(error);
});

export default http;