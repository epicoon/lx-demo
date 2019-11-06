<?php

namespace roulette\backend;

use lx\model\Model;

/**
 * Серверная модель состояния очков
 * */
class Score extends Model {
	// Используем модель из yaml-конфигурации
	protected static $modelName = 'Score';
}
