<?php
/**
 * @var lx\Module $Module
 * @var lx\Block $Block
 * */

// Выберем стратегию позиционирования
$Block->streamProportional(['indent' => '10px']);

// Загрузим блоки интерфейса
$Block->addBlocks([
	'description' => ['height' => 3],
	'gamePult'    => ['height' => 2],
	'pointsPult'  => ['height' => 3],
	'menu'        => ['height' => 3],
]);
