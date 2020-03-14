<?php

namespace lx\demo;

class Service extends \lx\Service {
	const EXAMPLES_DIR = 'examples/';
	const
		DEFAULT_PATH = 'stdResponse',
		DEFAULT_LANGUAGE = 'ru',

		BASIC = '01_basic/',
		BASIC_GUI = '04_gui/',

		APP = '02_app/',

		JS = '04_js/',
		JS_POSITIONING = '04_positioning/',
		JS_BIND = '06_bind/',
		JS_TOOLS = '08_tools/',

		PHP = '05_php/',
		PHP_TOOLS = '06_tools/',

		GUI = '06_gui/',
		GUI_WIDGETS = '02_widgets/',

		HTMP = '07_htmp/';

	private $__basis = [
		'bs-nginx'    => self::BASIC . '03_server_settings',
		'bs-new-elem' => self::BASIC . self::BASIC_GUI . '02_elemsCreation',
		'bs-add-elem' => self::BASIC . self::BASIC_GUI . '03_elemsAdding',
	];
	private $__app = [
		'app-struct'        => self::APP . '01_struct',
		'app-ajax'          => self::APP . '02_ajax',
		'app-config'        => self::APP . '03_config',
		'app-modules'       => self::APP . '04_modules',
		'app-module-config' => self::APP . '05_module_config',
		'app-js-compiler'   => self::APP . '06_js_compiler',
		'app-example'       => self::APP . '07_example',
	];
	private $__module = [
	];
	private $__js = [
		'ps-align'  => self::JS . self::JS_POSITIONING . 'align',
		'ps-stream' => self::JS . self::JS_POSITIONING . 'stream',
		'ps-grid'   => self::JS . self::JS_POSITIONING . 'grid',
		'ps-slot'   => self::JS . self::JS_POSITIONING . 'slot',

		'bn-simple'     => self::JS . self::JS_BIND . 'simple',
		'bn-matrix'     => self::JS . self::JS_BIND . 'matrix',
		'bn-agregation' => self::JS . self::JS_BIND . 'agregation',

		'bs-synchronizer' => self::JS . self::JS_TOOLS . '02_synchronizer',
	];
	private $__php = [
		'php-yaml' => self::PHP . self::PHP_TOOLS . '03_yaml'
	];
	private $__gui = [
		'wd-scheme'         => self::GUI . self::GUI_WIDGETS . '_scheme',
		'wd-text-box'       => self::GUI . self::GUI_WIDGETS . 'textBox',
		'wd-image'          => self::GUI . self::GUI_WIDGETS . 'image',
		'wd-image-slider'   => self::GUI . self::GUI_WIDGETS . 'imageSlider',
		'wd-table'          => self::GUI . self::GUI_WIDGETS . 'table',
		'wd-labeled-group'  => self::GUI . self::GUI_WIDGETS . 'labeledGroup',
		'wd-radio-group'    => self::GUI . self::GUI_WIDGETS . 'radioGroup',
		'wd-checkbox-group' => self::GUI . self::GUI_WIDGETS . 'checkboxGroup',
		'wd-multi-box'      => self::GUI . self::GUI_WIDGETS . 'multiBox',
		'wd-tree-box'       => self::GUI . self::GUI_WIDGETS . 'treeBox',
		'wd-active-box-0'   => self::GUI . self::GUI_WIDGETS . 'activeBox/ex0',
		'wd-active-box-1'   => self::GUI . self::GUI_WIDGETS . 'activeBox/ex1',
		'wd-active-box-2'   => self::GUI . self::GUI_WIDGETS . 'activeBox/ex2',
	];
	private $__htmp = [
		'mp-base' => self::HTMP . '01_base',
	];
	private $__tools = [
	];
	private $__special = [
		'roulette' => 'roulette',
	];

	//=========================================================================================================================

	/**
	 * Если запрошен несуществующий плагин - вернем стандартный ответ
	 * */
	public function getPlugin($pluginName, $params = [], $cParams = []) {
		if ($pluginName == '_main') {
			return parent::getPlugin('_main', $params);
		}

		$path = $this->getPluginPath($pluginName);
		$plugin = \lx\Plugin::create($this, $pluginName, $path);
		if ($plugin) {
			$plugin->setConfig('images', '@site/web/images/demo');
		} else {
			$path = $this->getPath() . '/' . self::EXAMPLES_DIR . self::DEFAULT_PATH;
			$plugin = \lx\Plugin::create($this, $pluginName, $path);
		}
		return $plugin;
	}

	public function getStaticPluginsDataList() {
		$result = parent::getStaticPluginsDataList();
		$arrs = $this->totalPathArray();
		foreach ($arrs as $arr) {
			foreach ($arr as $name => $path) {
				$result[$name] = self::EXAMPLES_DIR . $path;
			}
		}
		$result['default'] = self::EXAMPLES_DIR . self::DEFAULT_PATH;
		return $result;
	}

	/**
	 * По ключу модуля найдем где он находится
	 * */
	private function getPluginPath($pluginName) {
		$arrs = $this->totalPathArray();
		$path = $this->getPath() . '/' . self::EXAMPLES_DIR;
		foreach ($arrs as $arr) {
			if (array_key_exists($pluginName, $arr)) {
				return $path . $arr[$pluginName];
			}
		}

		return $path . self::DEFAULT_PATH;
	}

	/**
	 * Консолидирует массивы путей
	 * */
	private function totalPathArray() {
		return [
			$this->__basis,
			$this->__app,
			$this->__module,
			$this->__js,
			$this->__php,
			$this->__gui,
			$this->__tools,
			$this->__htmp,
			$this->__special,
		];
	}
}
