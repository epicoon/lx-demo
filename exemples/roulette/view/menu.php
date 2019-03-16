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

// Поля для визуализации модели настроек
new lx\Box(['size'=>[3, 1], 'text'=>'Приз за полное совпадение:']);
new lx\Input(['size'=>[1, 1], 'field'=>'fullPrize']);

new lx\Box(['size'=>[3, 1], 'text'=>'Приз за частичное совпадение:']);
new lx\Input(['size'=>[1, 1], 'field'=>'partPrize']);

new lx\Box(['size'=>[3, 1], 'text'=>'Цена попытки:']);
new lx\Input(['size'=>[1, 1], 'field'=>'tryCost']);

new lx\Box(['size'=>[3, 1], 'text'=>'Стартовая сумма:']);
new lx\Input(['size'=>[1, 1], 'field'=>'startAmount']);

$Block->find('text')->call('ellipsis');
