<?php

namespace Leaflet\Layer;

class FeatureGroup extends Group {
	
	const jsName = 'new L.FeatureGroup';
	
	/**
	 * @access public
	 * @return void
	 */
	public function bindPopup($popup)
	{
		$this->event->method('bindPopup', $popup);
		return $this;
	}
	
}