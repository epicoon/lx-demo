<?php

namespace lx\demo\_main;

class Plugin extends \lx\Plugin {

//TODO все закоменченное касается локализации. Есть нормальный механизм, надо к нему подвязаться

//	/**
//	 * Этот метод избавляет от необходимости переопределять конструктор
//	 * Для данного модуля он вызывается внутри конструктора при базовой загрузке страницы
//	 * */
//	protected function init() {
//		$lang = null;
//		if (isset(\lx::$dialog)) {
//			$lang = \lx::$dialog->get('lang');
//		}
//		if (!$lang) $lang = \lx\demo\Service::DEFAULT_LANGUAGE;
//
//		//todo - нормальную локализацию делать!
//		$this->params->l10n = ['lang' => $lang];
//	}

//	/**
//	 * Если не передано аргументов - вернет текущий язык, если есть аргумент - это ключ фразы, которая будет возвращена для текущего языка
//	 * */
//	public function l10n($key = null) {
//		if ($key === null) {
//			return \lx\DataObject::create($this->params->l10n);
//		}
//
//		return (new \lx\demo\tools\l10n\Localizator($this->params->l10n['lang']))->translate($key);
//	}

	/**
	 * Ответ для активного GET AJAX-запроса - при переходе по страницам
	 * */
	public function ajaxResponse($data) {
		$pluginName = $data['caption'];
		$plugin = $this->service->getPlugin($pluginName);

//		// Этому ajax-запросу надо соответствовать текущим параметрам страницы, поэтому узнаем их вот так:
//		$location = \lx::$dialog->location();
//		$plugin->params->lang = isset($location->searchArray['lang'])
//			? $location->searchArray['lang']
//			: \lx\demo\Service::DEFAULT_LANGUAGE;

		$builder = new \lx\PluginBuildContext(['plugin' => $plugin]);
		return $builder->build();
	}
}
