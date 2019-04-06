<?php

namespace roulette\backend;

/**
 * Сущность, управляющая настройками игры
 * */
class SettingsService {
	// Для простоты кода используем файл для сохранения настроек
	const SETTINGS_FILE_PATH = 'data/settings.json';

	// Константы для именования различных настроек
	const SLUG_FULL_PRIZE = 'fullPrize';
	const SLUG_PART_PRIZE = 'partPrize';
	const SLUG_TRY_COST = 'tryCost';
	const SLUG_START_AMOUNT = 'startAmount';

	// Ограничения для настроек - минимальное и максимальное значения
	const LIMITS = [
		self::SLUG_FULL_PRIZE => [50, 500],
		self::SLUG_PART_PRIZE => [5, 50],
		self::SLUG_TRY_COST => [3, 30],
		self::SLUG_START_AMOUNT => [100, 1000],
	];

	/**
	 * Загрузка настроек
	 * */
	public function load() {
		$file = $this->getSettingsFile();
		$settings = $file->get();
		return json_decode($settings, true);
	}

	/**
	 * Сохранение настроек - с проверкой ограничений
	 * */
	public function save($newSettings) {
		// Загрузим текущие настройки
		$settings = $this->load();
		// Пройдем по настройкам, которые нам передали
		foreach ($newSettings as $paramName => $value) {
			// Если имя настройки не предсмотено - будем ее игнорировать
			if (!array_key_exists($paramName, self::LIMITS)) {
				continue;
			}

			// Ограничения для данной настройки
			$limits = self::LIMITS[$paramName];

			// Проверка несоответствия переданного значения настройки ее ограничениям
			if (!is_numeric($value) || $value < $limits[0]) {
				$value = $limits[0];
			} elseif ($value > $limits[1]) {
				$value = $limits[1];
			}

			// Теперь можно перезаписать значение настройки
			$settings[$paramName] = $value;
		}

		// Запись в файл
		$settingsJson = json_encode($settings);
		$file = $this->getSettingsFile();
		$file->put($settingsJson);

		// Вернем настройки в актуальном виде
		return $settings;
	}

	/**
	 * Получить доступ к файлу с настройками
	 * */
	private function getSettingsFile() {
		$module = \lx::getModule('lx/lx-demo:roulette');
		return $module->getFile(self::SETTINGS_FILE_PATH);
	}
}
