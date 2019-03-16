<?php

namespace lx\demo\exemple_04_08_02\backend;

class Resp extends \lx\Respondent {
	public function getRand() {
		return \lx\Math::rand(1, 10);
	}
}
