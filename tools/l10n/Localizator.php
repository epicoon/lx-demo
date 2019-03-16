<?php

namespace lx\demo\tools\l10n;

class Localizator {
	const FILE_PATH = __DIR__ . '/list-';

	public function __construct($lang) {
		$this->lang = $lang;
		$this->_map = null;
	}

	public function translate($key) {
		$map = $this->map();

		if (array_key_exists($key, $map)) {
			return $map[$key];
		}

		return '';
	}

	private function map() {
		if ($this->_map === null) {
			$file = $this->getFile();
			$this->_map = $file->load();
		}

		return $this->_map;
	}

	private function getFile() {
		$f = new \lx\File($this->fileName());
		return $f;
	}

	private function fileName() {
		return self::FILE_PATH . $this->lang . '.php';
	}
}
