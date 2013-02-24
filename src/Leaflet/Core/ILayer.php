<?php

namespace Leaflet\Core;

use Closure;
use Leaflet\Map;
use Leaflet\IVar;

/**
 * Used by  tile layers, markers, popups, image overlays, vector layers and layer groups
 */
interface ILayer extends IVar {
	
	public function onAdd(Closure $closure);
	
	public function onRemove(Closure $closure);
	
	public function addTo(Map $map);
	
}