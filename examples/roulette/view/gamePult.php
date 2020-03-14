<?php
/**
 * @var lx\Module $Module
 * @var lx\Block $Block
 * */

$Block->fill('lightgray');
// Настраиваем стратегию позиционирования
$Block->gridProportional([
	'cols' => 3,
	'rows' => 3,
	'indent' => '5px'
]);

// Создаем экран рулетки
for ($i=0; $i<3; $i++) {
	$roulette = new lx\Box([
		'key' => 'rouletteScreen',
		'size' => [1, 2]
	]);
	$roulette->align(\lx::CENTER, \lx::MIDDLE);
	// Чтобы не перегружать пример файлами обойдемся без css
	$roulette->style('font-size', '400%');
	$roulette->border();
	$roulette->roundCorners(8);
}

// Добавляем кнопку запуска рулетки
new lx\Button(['key' => 'runGame', 'text' => 'Попытать удачу']);
