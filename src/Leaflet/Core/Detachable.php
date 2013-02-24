<?php

namespace Leaflet\Core;

use Leaflet\Map;

/**
 * Remove element (like Control) to the main Leafleft instance.
 */
interface Detachable {
	
	/**
	 * Detach the element from the Leaflet instance
	 * 
	 * @access public
	 * @param Leaflet\Leaflet $orig
	 * @return AttachInterface instance
	 */
	public function removeFrom(Map $orig);
	
}