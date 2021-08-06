import rules from './validation-rules';

/**
 * Валидатор
 *
 * Служит для валидирования форм
 */
class Validator {

	/**
	 * При создание сохраняет конфигурацию для валидирования
	 *
	 * @param config Обьект, где каждое поле - массив с названием валидируемого значения и правилами вида строка или обьекта (название и параметры для валидации)
	 */
	constructor(config) {
		this.config = config;
	}

	/**
	 * Функция проверяет значения в передаваемом обьекте по правилам, заданным в конструкторе валидатора
	 *
	 * @param form обьект с проверяемыми значениями
	 * @returns {{}} объект с массивами не пройденных проверок
	 */
	validate(form){
		let errors = {};
		Object.keys(this.config).forEach(configItem => {
			const value = form[configItem];
			this.config[configItem].forEach(rule => {
				let valid = false;
				if(typeof rule === 'object'){
					valid = rules[rule.rule](value, rule.parameters);
				} else {
					valid = rules[rule](value);
				}
				if(!valid){
					if(!errors[configItem]){
						errors[configItem] = [];
					}
					errors[configItem].push(rule.rule || rule);
				}
			})
		})
		return errors;
	}

}

export default Validator;