// Модель подсчета очков
class Score extends lx.BindableModel {
	// Используем модель из yaml-конфигурации
	#lx:MODEL_NAME Score;

	// Установить баланс
	setBalance(value) {
		this.balance = value;
	}
}

// Создаем экземпляр
const score = new Score();

// Связываем модель с интерфейсом
score.bind(Module->>pointsPult);