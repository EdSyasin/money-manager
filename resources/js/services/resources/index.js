import resList from "./resourcesList";
import HTTP from '@/http';

class Resource {
	constructor(name, config) {
		this.name = name;
		this.config = config;

		let self = this;
		for(let action in config){
			this[action] = function(settings){
				const actionItem = self.config[action];
				const url = self.#prepareUrl(actionItem.url, settings);
				const body = self.#prepareBody(actionItem.body, settings);
				const queryParams = self.#prepareQueryParams(actionItem.queryParams, settings);
				if (actionItem.method === 'post' || actionItem.method === 'put'){
					return HTTP[actionItem.method](url, body, { params: queryParams});
				} else {
					return HTTP[actionItem.method](url, { params: queryParams});
				}
			}
		}
	}

	#prepareUrl(url, settings){
		const result = [...url.matchAll(/:[a-zA-Z0-9]+/g)].map(item => {
			return item[0]
		});
		let localUrl = url;
		result.forEach(param => {
			localUrl = localUrl.replace(param, settings[param.replace(':', '')]);
		})
		return localUrl;
	}

	#prepareBody(body, settings){
		if(!body) return {};
		let result = {};

		for(let field in body){
			result[field] = settings[field] || body[field];
		}
		return result;
	}

	#prepareQueryParams(queryParams, settings){
		if(!queryParams) return {};
		let result = {};

		for(let field in queryParams){
			result[field] = settings[field] || queryParams[field];
		}
		return result;
	}
}

class Resources {
	constructor() {
		let self = this;
		Object.keys(resList).forEach(resourceName => {
			self[resourceName] = () => new Resource(resourceName, resList[resourceName]);
		})
	}

	setTokens(access, refresh){
		localStorage.setItem('accessToken', access);
		localStorage.setItem('refreshToken', refresh);
		HTTP.defaults.headers.Authorization = `Bearer ${access}`;
	}

	cleanTokens(){
		localStorage.removeItem('accessToken');
		localStorage.removeItem('refreshToken');
		HTTP.defaults.headers.Authorization = ``;
	}
}

const Api = new Resources();
export default Api