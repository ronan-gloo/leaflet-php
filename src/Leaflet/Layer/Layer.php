<?php

namespace Leaflet\Layer;

use Leaflet\Core;

/**
 * Base Layer class.
 * 
 * @abstract
 * @extends GSProxy
 */
abstract class Layer extends Core\Layer {
		
	/**
	 * @access public
	 * @param mixed $coords
	 * @return $this
	 */
	public function setLatLng($coords)
	{
		$this->event->method('setLatLng', func_get_args());
		
		return $this;
	}

	
}