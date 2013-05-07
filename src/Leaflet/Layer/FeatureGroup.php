<?php

namespace Leaflet\Layer;

/**
 * Class FeatureGroup
 * @package Leaflet\Layer
 */
class FeatureGroup extends Group {

    /**
     * @const string
     */
    const jsName = 'new L.FeatureGroup';

    /**
     * @param $popup
     * @return $this
     */
    public function bindPopup($popup)
	{
		$this->event->method('bindPopup', $popup);
		return $this;
	}
	
}