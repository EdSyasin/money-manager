export default {
	notEmpty: (value) => {
		if(!value){
			return false;
		}
		return true;
	},
	length: (value, parameters) => {
		if(!value) return false;

		let result = true;
		if(parameters.min){
			if(value.length < parameters.min){
				result = false;
			}
		}
		if(parameters.max){
			if(value.length > parameters.max){
				result = false;
			}
		}
		return result;
	}
}