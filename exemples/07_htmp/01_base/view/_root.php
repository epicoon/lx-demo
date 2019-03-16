<?php
/**
 * @var lx\Module $Module
 * @var lx\Block $Block
 * */

$Block->overflow('auto');
$Block->renderHtmlFile('view/info.html');
$Block->get('text')->addClass('demo_yaml_main');

$Block->get('text')->width('100%');

