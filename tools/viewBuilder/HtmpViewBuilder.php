<?php

namespace lx\demo\tools\viewBuilder;

use \lx\File;
use \lx\demo\tools\l10n\Localizator;


//TODO Htmp это типа идея для шаблонизатора. Но ну его нахрен. Надо основательно идею шаблонизатора продумывать.
// тут и так ничего сделано не было


class HtmpViewBuilder {
	const SOURCE_FILE = 'view/info.html';

	private static $contextModule = null;

	public static function build($Module, $block, $header) {
		self::$contextModule = $Module;

		$text = self::getSourceText();
		$text = self::colorCodeExemples($text);
		$text = self::extendHtmlWithCss($text);

		$block->overflow('auto');
		$block->renderHtml($text);
		$block->get('text')->addClass('demo_text');
		$block->get('text')->width('100%');

		self::initJs($header);
	}

	/**
	 * Немного js-кода дял навигации по статье
	 * */
	private static function initJs($header) {
		$headerL10n = (new Localizator(self::$contextModule->params->lang))->localizeKey($header);
		if ($headerL10n) $header = $headerL10n;

		//Устарело. пост-жс признан ерундой и искоренён. Решать задачу другими путями
		self::$contextModule->postJs("()=>
			if (Module.root.parent && Module.root.parent->header)
				Module.root.parent->header.text('$header');

			var toUp = (new lx.TagRenderer({classList:['demo_toUp']})).toString();

			?>.demo_nav.each((a)=> {
				let el = ?>#{a.pointTo};
				if (!el) return;
				el.html(a.html() + toUp);
				a.click(()=> Module.root.scrollTo({y: el.top('px')}));
			});
			?>.demo_toUp.call('click', ()=> Module.root.scrollTo({y: 0}));
		");
	}

	/**
	 * Раскрашивание примеров кода
	 * */
	private static function colorCodeExemples($text) {
		$text = preg_replace_callback('/<div class="demo_code_back code"><pre>[\w\W]*?<\/pre><\/div>/', function($matches) {
			$code = $matches[0];

			// Подсветка строк
			$code = preg_replace('/(?>!\s\/\/[^\n]*?)(\'[^\']*?\')/', '<span class="demo_code_string">$1</span>', $code);

			// Раскрасить особые символы
			$arr = ['=>', '::', 'return', 'var', 'new'];
			foreach ($arr as $value) {
				if (preg_match('/^\w/', $value)) $reg = '/(?>!\s\/\/[^\n]*?)(\b' . $value . '\b)/';
				else $reg = '/(?>!\s\/\/[^\n]*?)(' . $value . ')/';
				$code = preg_replace($reg, '<span class="demo_code_spec">$1</span>', $code);
			}

			// Подсветка комментов
			$code = preg_replace('/(\s)(\/\/[^\n]*?)(\n)/', '$1<span class="demo_code_comment">$2</span>$3', $code);

			return $code;
		}, $text);

		return $text;
	}

	/**
	 * Включение css-классов, используемых на странице
	 * */
	private static function extendHtmlWithCss($text) {
		$style = "<style>
			pre {overflow: auto; font-size: 140%;}
			.demo_text {line-height: 1.33;}";

		$usedClasses = self::getUsedClasses($text);
		$definedClasses = self::getDefinedClasses();
		foreach ($usedClasses as $usedClass) {
			if (!array_key_exists($usedClass, $definedClasses)) continue;
			$style .= $definedClasses[$usedClass];
		}

		$style .= '</style>';

		return $style . $text;
	}

	/**
	 * Найти все используемые css-классы в статье
	 * */
	private static function getUsedClasses($text) {
		$usedClasses = ['demo_toUp'];

		preg_match_all('/class="(.+?)"/', $text, $matches);
		if (empty($matches[1])) return $usedClasses;

		foreach ($matches[1] as $match) {
			$classes = explode(' ', $match);
			$usedClasses = array_merge($usedClasses, $classes);
		}
		$usedClasses = array_unique($usedClasses);

		return $usedClasses;
	}

	/**
	 * Получить список css-классов, которые билдер может подключить сам
	 * */
	private static function getDefinedClasses() {
		return (new HtmpViewBuilderSource\Css(self::$contextModule))->classList();
	}

	/**
	 * Получить текст статьи
	 * */
	private static function getSourceText() {
		$path = self::$contextModule->getFilePath(self::SOURCE_FILE);

		$file = new File($path);
		$text = $file->exists() ? $file->get() : '';

		$text = self::localizate($text);

		return $text;
	}

	/**
	 * Перевести статью на нужный язык
	 * */
	private static function localizate($text) {
		$lang = self::$contextModule->params->lang;

		$result = preg_replace_callback('/\[\[:([\w\W]*?):\]\]/', function($matches) use ($lang) {
			$fullText = $matches[1];
			preg_match_all('/<'.$lang.'>([\w\W]*?)<\/'.$lang.'>/', $fullText, $localText);
			return $localText[1][0];
		}, $text);

		return $result;
	}
}
