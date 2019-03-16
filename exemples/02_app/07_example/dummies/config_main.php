<?php

/**
 * Основной конфиг приложения
 * */
return [
	// Глобальный js-код, выполняемый до разворачивания корневого модуля
	'jsBootstrap' => '@web/js/_bootstrap.js',
	// Глобальный js-код, выполняемый после разворачивания корневого модуля
	'jsMain' => '@web/js/_main.js',

	// Нам нужен единственный модуль, мы делаем фактически SPA.
	// Соответственно в каталоге для модулей смысла нет, а наш единственный
	// Модуль будет лежать в каталоге 'home' в корне приложения
	'modulesDirectory' => null,
	'homeModule' => 'home',


	// Алиасы всего приложения
	'aliases' => [
	],
];
