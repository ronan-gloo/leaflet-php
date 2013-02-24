<?php

namespace Leaflet\Core;

use Leaflet\Map;

/**
 * Add  element (like Control) to the main Leafleft instance.
 */
interface Attachable {
	
	/**
	 * Attach the element to the Leaflet instance
	 * 
	 * @access public
	 * @param Leaflet\Leaflet $dest
	 * @return AttachInterface instance
	 */
	public function addTo(Map $dest);
}