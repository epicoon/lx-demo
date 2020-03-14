// Модель представляющая состояние рулетки
class Roulette extends lx.BindableModel {
	// Объявим поля для синхронизации с виджетом
	#lx:schema
		rouletteState0 : {default: {value: '-'}},
		rouletteState1 : {default: {value: '-'}},
		rouletteState2 : {default: {value: '-'}};

	// Метод для обновления состояния
	renew(state) {
		// Защищаемся на случай, если данные не пришли
		if (!state) {
			return;
		}

		// Для каждого поля обновляемся
		for (var i=0; i<3; i++) {
			this['rouletteState' + i] = state[i];
		}
	}
}

// Создаем экземпляр
const roulette = new Roulette();

// Связываем модель с интерфейсом
roulette.bind(Module->>gamePult);
