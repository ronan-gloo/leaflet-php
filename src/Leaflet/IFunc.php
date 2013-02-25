<?php

namespace Leaflet;
use Leaflet\Core\Jsonable;

interface IFunc extends Jsonable {
	
	public function args($arg);
	
	public function line($str);
	
	public function name($var);
	
}