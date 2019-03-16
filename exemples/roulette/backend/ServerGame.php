<?php

namespace roulette\backend;

/**
 * Класс, отвечающий на ajax-запросы клиента
 * */
class ServerGame extends \lx\Respondent {
	/**
	 * Данные для старта при первой загрузке страницы
	 * */
	public function load($gameKey) {
		$result = [
			'settings' => (new SettingsService())->load()
		];

		if ($gameKey !== null) {
			$game = (new GameService())->loadGame($gameKey);
			if ($game !== null) {
				$result['game'] = $game;
			}
		}

		return $result;
	}

	/**
	 * Запрос на изменение настроек - сервис проверит и вернет состояние, в котором удалось сохранить
	 * Вернем это состояние клиенту
	 * */
	public function changeSettings($settings) {
		$newSettings = (new SettingsService())->save($settings);
		return $newSettings;
	}

	/**
	 * Запрос на регистрации новой игры, взамен старой (если была)
	 * */
	public function register($oldGameKey) {
		$settings = (new SettingsService())->load();
		$startAmount = $settings[SettingsService::SLUG_START_AMOUNT];

		return (new GameService())->switchGame($oldGameKey, $startAmount);
	}

	/**
	 * Запрос на окончание игры
	 * */
	public function dropGame($gameKey) {
		(new GameService())->drop($gameKey);
	}

	/**
	 * Запрос на запуск рулетки
	 * */
	public function runRoulette($gameKey) {
		$settings = (new SettingsService())->load();
		return (new GameService())->run($gameKey, $settings);
	}
}
