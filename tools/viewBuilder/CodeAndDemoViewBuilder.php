<?php

namespace lx\demo\tools\viewBuilder;

use \lx\ActiveBox;

class CodeAndDemoViewBuilder {
	private static $contextModule = null;

	public static function build($Module, $headerText) {
		self::$contextModule = $Module;

		// Окошко с кодом
		$codeBox = new ActiveBox([
			'key' => 'code',
			'header' => "$headerText: code",
			'adhesive' => true,
			'width' => 50
		]);
		$codeBox->border();
		$codeBox->fill('white');

		// Окошко с визуализацией
		$demo = new ActiveBox([
			'key' => 'demo',
			'header' => "$headerText: demo",
			'adhesive' => true,
			'left' => 50
		]);
		$demo->border();
		$demo->fill('white');

		// В окошко с кодом загружаем сам код (при помощи модуля подсветки кода)
		$f = $Module->findFile('_main.js');

		$code = self::localizate($f->get());
		$service = \lx\Service::create('lx/lx-dev-wizard');
		$codeRedactor = $service->getModule('codeRedactor');
		$codeBox->get('body')->setModule($codeRedactor, [
			'text' => $code,
			'lang' => 'js'
		]);

		// Чтобы в окошко с визуализацией создавались виджеты - выставим его тело как дефолтного родителя
		$Module->preJs('()=> lx.WidgetHelper.autoParent = Module->demo->body;');
	}

	public static function localizate($text) {
		$langs = new \lx\Vector(['en', 'ru']);

		$lang = self::$contextModule->params->lang;
		$langs->remove($lang);

		$result = $text;
		$result = preg_replace('/\t*?\/\*<'. $lang .'>\*\/\n/', '', $result);
		$result = preg_replace('/\t*?\/\*<\/'. $lang .'>\*\/\n/', '', $result);

		$langs->each(function($lang) use (&$result) {
			$result = preg_replace('/\t*?\/\*<'. $lang .'>\*\/\n[\w\W]*?\/\*<\/'. $lang .'>\*\/\n/', '', $result);
		});

		return $result;
	}
}
