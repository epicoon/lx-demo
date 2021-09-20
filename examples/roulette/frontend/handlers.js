// Кнопка запуска новой игры
Module->>newGame.click(function() {
	// Ключ текущей игры лежит в cookie
	let oldGameKey = lx.Cookie.get('gameKey');

	// Запрос к серверу на регистрацию новой игры взамен текущей
	^ServerGame.register(oldGameKey).then((response)=> {
		// Положим в cookie новый ключ
		lx.Cookie.set('gameKey', response.gameKey);
		// Обновим очки
		score.resetFields();
		score.setBalance(response.startAmount);
	});
});

// Кнопка остановки игры
Module->>dropGame.click(function() {
	// Если ключа в cookie нет - нет текущей игры
	let gameKey = lx.Cookie.get('gameKey');
	if (gameKey === undefined) return;

	// Запрос к серверу на остановку текущей игры
	^ServerGame.dropGame(gameKey);
	// Удаляем ключ из cookie
	lx.Cookie.remove('gameKey');
	// Обнулим очки
	score.resetFields();
});

// Кнопка запуска раунда игры
Module->>runGame.click(function() {
	// Если ключа в cookie нет - нет текущей игры
	let gameKey = lx.Cookie.get('gameKey');
	if (gameKey === undefined) return;

	// Запрос к серверу для запуска рулетки
	^ServerGame.runRoulette(gameKey).then((response)=> {
		// Получаем обновленное состояние очков
		score.setFields(response.score);

		// Обновим состояние рулетки
		roulette.renew(response.roulette);
	});
});

// Создадим обработчики для отслеживания изменения значений рулетки:
// 'rouletteState' + index - виджет слушает поле с этим названием
// function(info) - эта функция будет вызываться, когда полю будет присвоено новое значение,
// info - новое значение, присвоенное полю
Module->>rouletteScreen.forEach(screen=>{
	screen.setField('rouletteState' + screen.index, function(info) {
		// info - придет в формате {value, match}, где:
		// value - новое значение 
		// match - совпадает ли значение с другими

		// Отобразим число
		screen.text(info.value);
		// Если экран совпадает с другими - отметим это зеленым цветом
		screen.fill(info.match ? 'green' : '');
	});
});
