<?php
/**
 * @var lx\Module $Module
 * @var lx\Block $Block
 * */

$Block->streamProportional(['indent' => '5px']);

(new lx\Box(['height' => '25px', 'text' => $Module->l10n('Lang')]))->align(\lx::CENTER, \lx::MIDDLE);
$l10n = new lx\Box(['height' => '25px']);

(new lx\Box(['height' => '25px', 'text' => $Module->l10n('Content')]))->align(\lx::CENTER, \lx::MIDDLE);
new lx\TreeBox([ 'key' => 'tree', 'labelWidth' => 270 ]);


$l10n->grid(['step' => '5px', 'cols' => 2]);
$l10n->begin();

new lx\Button([
	'width' => 1,
	'text' => 'English',
	'click' => '()=>
		if (Module.data.l10n.lang == "en") return;
		window.location = "/?lang=en" + window.location.hash;
	'
]);

new lx\Button([
	'width' => 1,
	'text' => 'Русский',
	'click' => '()=>
		if (Module.data.l10n.lang == "ru") return;
		window.location = "/?lang=ru" + window.location.hash;
	'
]);

$l10n->end();
