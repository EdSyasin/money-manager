import Axios from 'axios';

const http = new Axios.create({
	baseURL: '/api/',
	responseType: 'json'
});

const accessToken = localStorage.getItem('accessToken');
if(accessToken){
	http.defaults.headers.Authorization = `Bearer ${accessToken}`;
}

export default http;