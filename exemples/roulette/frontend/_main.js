#lx:require handlers;
#lx:require Score;
#lx:require Settings;
#lx:require Roulette;

// В cookie лежит ключ текущей игры
let gameKey = lx.Cookie.get('gameKey');

// Запрашиваем у сервера состояние настроек и игры (если есть ключ текущей игры)
^ServerGame.load(gameKey) : (data)=> {
	// Полученные данные о настройках запишем в модель
	settings.setFields(data.settings);

	// Если получили данные о игре - загрузим в модель
	if (data.game) {
		score.setFields(data.game);
	}
};
