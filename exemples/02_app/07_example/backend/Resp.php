<?php

namespace lx\demo\exemples_02_07\backend;

class Resp extends \lx\Respondent {
	const MAP = [
		'view_root' => 'showModule/view/_root.php',
		'view_description' => 'showModule/view/description.php',
		'view_game' => 'showModule/view/gamePult.php',
		'view_points' => 'showModule/view/pointsPult.php',
		'view_menu' => 'showModule/view/menu.php',

		'score_yaml' => 'showModule/models/Score.yaml',

		'js_main' => 'showModule/frontend/_main.js',
		'js_handlers' => 'showModule/frontend/handlers.js',
		'js_score' => 'showModule/frontend/Score.js',
		'js_settings' => 'showModule/frontend/Settings.js',
		'js_roulette' => 'showModule/frontend/Roulette.js',

		'php_server_game' => 'showModule/backend/ServerGame.php',
		'php_settings_service' => 'showModule/backend/SettingsService.php',
		'php_game_service' => 'showModule/backend/GameService.php',
		'php_score' => 'showModule/backend/Score.php',
		'php_game' => 'showModule/backend/Game.php',

		'json_settings' => 'showModule/data/settings.json',
		'json_games' => 'showModule/data/games.json',

		'dum_m_config' => 'dummies/m_config.php',
		'dum_config_main' => 'dummies/config_main.php',
		'dum_config_module' => 'dummies/config_module.php',
		'dum_index' => 'dummies/index.php',
		'dum_style' => 'dummies/style.php',
		'dum_bootstrap' => 'dummies/bootstrap.js',
		'dum_main' => 'dummies/main.js',
		'dum_core' => 'dummies/core.php',
	];

	public function loadFile($key) {
		$file = $this->module->getFile(self::MAP[$key]);

		preg_match_all('/\.([^.]+)$/', $file->getPath(), $matches);

		$ext = $matches[1][0];
		if ($ext != 'js' && $ext != 'php') $ext = 'js';

		$code = $file->get();

		return [
			'code' => $code,
			'ext' => $ext
		];
	}
}
