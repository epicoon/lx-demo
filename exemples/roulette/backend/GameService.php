<?php

namespace roulette\backend;

use \lx\Math;

/**
 * Сущность, управляющая сохранениями игр
 * */
class GameService {
	// Для простоты кода для сохранения игр используем файл
	const GAMES_FILE_PATH = 'data/games.json';

	// Кэширование карты сохранений игр, чтобы не загружать более одного раза
	private $_gamesMap;

	/**
	 * Сбросить текущую игру и начать новую
	 * */
	public function switchGame($oldGameKey, $startAmount) {
		// Ленивая загрузка карты сохранений
		$games = $this->getGamesMap();
		// Удаление из карты текущей игры (если она есть)
		if (array_key_exists($oldGameKey, $games)) {
			unset($games[$oldGameKey]);
		}

		// Генерация ключа для новой игры
		$gameKey = $this->genKey();

		// Добавляем в карту сохранений данные о новой игре
		$games[$gameKey] = [
			'balance' => $startAmount,
			'fullMatches' => 0,
			'partMatches' => 0,
		];

		// Сохраняем все в файл
		$this->save($games);

		// Возвращаем ключ игры и баланс
		return [
			'startAmount' => $startAmount,
			'gameKey' => $gameKey
		];
	}

	/**
	 * Удалить текущую игру из карты сохранений
	 * */
	public function drop($gameKey) {
		$games = $this->getGamesMap();
		if (array_key_exists($gameKey, $games)) {
			unset($games[$gameKey]);
		}
		$this->save($games);		
	}

	/**
	 * Загрузить из карты сохранений конкретную игру по ключу
	 * */
	public function loadGame($gameKey) {
		$games = $this->getGamesMap();
		if (array_key_exists($gameKey, $games)) {
			return $games[$gameKey];
		}
		return null;
	}

	/**
	 * Метод для запуска рулетки в рамках конкретной игры
	 * */
	public function run($gameKey, $settings) {
		// Ленивая загрузка карты сохранений
		$games = $this->getGamesMap();
		// Если нет такой игры - ничего не делаем
		if (!array_key_exists($gameKey, $games)) {
			return false;
		}

		// Создадим экземпляр игры и запустим рулетку
		$game = new Game($games[$gameKey], $settings);
		$game->run();
		// Будем возвращать состояние очков и рулетки
		$result = [
			'score' => $game->currentState(),
			'roulette' => $game->rouletteState()
		];
		// Перезапишем в карте сохранений обновленные очки для этой игры
		$games[$gameKey] = $result['score'];
		$this->save($games);

		return $result;
	}

	/**
	 * Ленивая загрузка карты сохранений
	 * */
	private function getGamesMap() {
		if ($this->_gamesMap === null) {
			$this->_gamesMap = $this->load();
			if ($this->_gamesMap === null) {
				$this->_gamesMap = [];
			}
		}
		return $this->_gamesMap;
	}

	/**
	 * Генерация случайного ключа для новой игры
	 * */
	private function genKey() {
		$randKey = function() {
			return
				Math::decChangeNotation(Math::rand(0, 255), 16).
				Math::decChangeNotation(Math::rand(0, 255), 16).
				Math::decChangeNotation(Math::rand(0, 255), 16);
		};
		$map = $this->getGamesMap();
		do {
			$uniqRand = $randKey();
		} while ( array_key_exists($uniqRand, $map) );

		return $uniqRand;
	}

	/**
	 * Метод загрузки карты сохранений
	 * */
	private function load() {
		$file = $this->getGamesFile();
		$games = $file->get();
		return json_decode($games, true);
	}

	/**
	 * Метод записи карты сохранений
	 * */
	private function save($data) {
		$dataJson = json_encode($data);
		$file = $this->getGamesFile();
		$file->put($dataJson);
	}

	/**
	 * Метод доступа к файлу с сохранениями
	 * */
	private function getGamesFile() {
		$module = \lx::getModule('lx/lx-demo:roulette');
		return $module->getFile(self::GAMES_FILE_PATH);
	}
}
