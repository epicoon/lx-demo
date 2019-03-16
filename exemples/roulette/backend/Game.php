<?php

namespace roulette\backend;

use \lx\Math;

/**
 * Сущность, осуществляющая логику игры - генерацию случайных чисел и контроль очков
 * */
class Game {
	const MIN_RANDOM_NUMBER = 1;
	const MAX_RANDOM_NUMBER = 7;

	// Состояние очков
	private $score;
	// Состояние плашек рулетки после генераци случайных чисел
	private $roulette;
	// Кэширование игровых настроек
	private $settings;

	/**
	 * Данные дает GameService - загружает с диска
	 * */
	public function __construct($data, $settings) {
		$this->score = new Score();
		$this->score->setFields($data);

		// Для каждого поля хранится значение и совпадение с другими полями
		$this->roulette = [
			['value' => '-', 'match' => false],
			['value' => '-', 'match' => false],
			['value' => '-', 'match' => false],
		];

		$this->settings = $settings;
	}

	/**
	 * Генерация рулетки и подсчет изменившихся очков
	 * */
	public function run() {
		$score = $this->score;
		// Сколько стоит одна попытка
		$cost = $this->settings[SettingsService::SLUG_TRY_COST];
		// Если не хватает средств - просто ничего не делаем, для простоты кода без GameOver
		if ($cost > $score->balance) {
			return;
		}

		// Заплатили за попытку
		$score->balance -= $cost;

		// Сгенерировали рулетку
		$this->randomizeRoulette();

		// Проверим рулетку - есть ли выигрыш
		if ($this->checkFullMatches()) {
			$score->balance += $this->settings[SettingsService::SLUG_FULL_PRIZE];
			$score->fullMatches++;
		} elseif ($this->checkPartMatches()) {
			$score->balance += $this->settings[SettingsService::SLUG_PART_PRIZE];
			$score->partMatches++;
		}
	}

	/**
	 * Возвращает текущее состояние очков
	 * */
	public function currentState() {
		return $this->score->getFields();
	}

	/**
	 * Возвращает текущее состояние рулетки
	 * */
	public function rouletteState() {
		return $this->roulette;
	}

	/**
	 * Непосредственно крутим рулетку
	 * */
	private function randomizeRoulette() {
		// Сначала сгенерируем три случайных числа
		$rand = [0, 0, 0];
		foreach ($rand as $i => $value) {
			$rand[$i] = Math::rand(self::MIN_RANDOM_NUMBER, self::MAX_RANDOM_NUMBER);
		}

		// Запишем данные в поле рулетки
		foreach ($rand as $i => $value) {
			// Значение рулетки
			$this->roulette[$i]['value'] = $value;

			// Определение совпадений
			foreach ($rand as $j => $matchTest) {
				// Если индексы совпадают - число само с собой сравнивать не надо
				if ($i == $j) continue;
				// Если есть совпадение
				if ($matchTest == $value) {
					$this->roulette[$i]['match'] = true;
				}
			}
		}
	}

	/**
	 * Подсчет совпавших значений рулетки
	 * */
	private function rouletteMatchesCount() {
		$count = 0;
		foreach ($this->roulette as $unitState) {
			if ($unitState['match']) {
				$count++;
			}
		}
		return $count;
	}

	/**
	 * Проверка рулетки на полное совпадение
	 * */
	private function checkFullMatches() {
		return $this->rouletteMatchesCount() == 3;
	}

	/**
	 * Проверка рулетки на частичное совпадение
	 * */
	private function checkPartMatches() {
		return $this->rouletteMatchesCount() == 2;
	}
}
