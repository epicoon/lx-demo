<?php

namespace lx\demo\tools\viewBuilder\HtmpViewBuilderSource;

class Css {
	public function __construct($module) {
		$this->contextModule = $module;
	}

	public function classList() {return [

		'demo_nav' => '
			.demo_nav {
				color: blue;
				text-decoration: underline;
				cursor: pointer;
			}
			.demo_nav:hover {
				color: darkviolet;
				text-decoration: none;
			}
		',

		'demo_toUp' => '
			.demo_toUp {
				display: inline;
				margin-left: 10px;
				width: 25px;
				height: 25px;
				background-image: url('. $this->contextModule->getImageRoute('toUp.png') .');
				background-size: 100% 100%;
				cursor: pointer;
			}
			.demo_toUp:hover {
				opacity: 0.7;
			}
		',

		'demo_code_back' => '
			.demo_code_back {
				margin-left: 5%;
				margin-right: 5%;
				padding: 15px;
				border-radius: 20px;
				background-color: #272822;
				color: white;
				font-family: Courier;
			}
		',

		'demo_code_spec' => '
			.demo_code_spec {
				color: red;
				font-width: bold;
			}
		',

		'demo_code_string' => '
			.demo_code_string {
				color: yellow;
			}
		',

		'demo_code_comment' => '
			.demo_code_comment {
				color: #8D8872 !important;
			}
		',
	];}
}
