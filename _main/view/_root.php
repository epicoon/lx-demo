<?php
/**
 * @var lx\Module $Module
 * @var lx\Block $Block
 * */

$Module->title = $Module->l10n('Title');

$menu = new lx\ActiveBox([
	'key' => 'MainMenu',
	'adhesive' => true,
	'header' => $Module->l10n('MainMenu'),
	'width' => 20
]);
$menu->border();
$menu->get('body')->setBlock('mainMenu');

$code = new lx\ActiveBox([
	'key' => 'demoBox',
	'header' => $Module->l10n('Article'),
	'adhesive' => true,
	'left' => 20,
]);
$code->border();
$code->fill('white');
