<?php

namespace Leaflet;
use Leaflet\Core\Jsonable;

interface IFunc extends Jsonable {
	
	public function args();
	
	public function line($str);
	
}