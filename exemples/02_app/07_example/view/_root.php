<?php
/**
 * @var lx\Module $Module
 * @var lx\Block $Block
 * */

// Колонка со структурой
$structure = new lx\ActiveBox([
	'width' => 25,
	'header' => 'Application',
	'adhesive' => true
]);
$structure->border();
$tree = new lx\TreeBox([ 'key' => 'tree', 'parent' => $structure->get('body') ]);

// Колонка с кодом
$view = new lx\ActiveBox([
	'left' => 25,
	'width' => 50,
	'header' => 'Code',
	'adhesive' => true
]);
$view->border();
$code = new lx\Box([ 'key' => 'code', 'parent' => $view->get('body') ]);

$code->setModule(lx::getService('lx/lx-dev-wizard')->getModule('codeRedactor'));

// Колонка с рулеткой
$stand = new lx\ActiveBox([
	'left' => 75,
	'width' => 25,
	'header' => 'Roulette',
	'adhesive' => true
]);
$stand->border();
$stand->get('body')->setModule( $Module->getService()->getModule('roulette') );
