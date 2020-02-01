// Модель настроек
class Settings extends lx.BindableModel {
	#lx:schema
		fullPrize,
		partPrize,
		tryCost,
		startAmount;

	// Обработчик, навешиваемый на изменение значения полей
	beforeSet(field, value) {
		// Если значение не изменилось - ничего не делаем
		if (this[field] == value) return value;

		// Готовим объект данных для отправки на сервер
		let newSettings = {};
		newSettings[field] = value;
		
		// Отправляем на сервер данные с новым значением настройки
		^ServerGame.changeSettings(newSettings).then((response)=> {
			// Сервер отвечает значением, которое ему удалось сохранить
			if (field in response) {
				this[field] = +response[field];
			}
		});
	}
}

// Создаем экземпляр
const settings = new Settings();

// Связываем модель с интерфейсом
settings.bind(Module->>menu);
