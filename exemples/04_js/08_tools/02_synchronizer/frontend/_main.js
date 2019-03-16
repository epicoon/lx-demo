// Сюда запишем результаты ответов
var responses = [];
// Здесь отобразятся результаты запросов и работы синхронизатора
var logger = new lx.LogBox({geom: [10, 30, 80, 40]}).border();

// Класс-запрос - может обращаться к серверу и
// имеет метод, срабатывающий при ответе сервера
class TestRequest {
	// Метод, срабатывающий при ответе сервера
	onLoad(res) {
		responses.push(res);
		logger.log('Response result:', res);
	}

	// Если получили ошибку
	onError(res) {
		logger.log('Response error:', res);
	}

	// Метод для запуска запроса
	send() {
		// Здесь отправляется запрос на сервер сгенерировать
		// случайное число от 1 до 10
		^Resp.getRand() ? this.onLoad : this.onError;
		/* Этот странный синтаксис - то же самое, что:
		 * Module.ajax('Resp/getRand', [], {success:this.onLoad, error:this.onError});
		 * Подроднее см. расширенный js-синтаксис
		 */
	}
}

// Создадим пару запросов-объектов
var request0 = new TestRequest();
var request1 = new TestRequest();

// При нажатии на кнопку запускается механизм синхронизации запросов
new lx.Button({
	geom: [10, 10, 80, 10],
	text: 'click me',
	click: function() {
		// Обнулим кэширующий массив и логгер
		responses = [];
		logger.clear();

		// Создадим экземпляр синхронизатора
		var synchronizer = new lx.Synchronizer();

		// Зарегистируем в нем запросы
		synchronizer.register(request0, 'onLoad', 'onError');
		synchronizer.register(request1, 'onLoad', 'onError');

		// Запустим работу синхронизатора - функцию можно объявить и в конструкторе,
		// но так визуально последовательность лучше прослеживается
		synchronizer.start(function() {
			logger.log('Synchronizer result:', +responses[0] + +responses[1]);
		});
		
		// Запустим запросы
		request0.send();
		request1.send();
	}
});
