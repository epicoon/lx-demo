<?php
/**
 * @var lx\Module $Module
 * @var lx\Block $Block
 * */

$Block->fill('lightgray');
// Настраиваем стратегию позиционирования
$Block->gridProportional([
	'cols' => 4,
	'rows' => 4,
	'indent' => '5px'
]);

// Поля для визуализации модели очков
new lx\Box(['size'=>[3, 1], 'text'=>'Баланс:']);
new lx\Box(['size'=>[1, 1], 'field'=>'balance']);

new lx\Box(['size'=>[3, 1], 'text'=>'Полных совпадений:']);
new lx\Box(['size'=>[1, 1], 'field'=>'fullMatches']);

new lx\Box(['size'=>[3, 1], 'text'=>'Частичных совпадений:']);
new lx\Box(['size'=>[1, 1], 'field'=>'partMatches']);

// Кнопки управления игрой
new lx\Button(['key'=>'newGame', 'size'=>[2, 1], 'text' => 'Начать новую игру']);
new lx\Button(['key'=>'dropGame', 'size'=>[2, 1], 'text' => 'Сбросить данные']);

$Block->find('text')->call('ellipsis');
