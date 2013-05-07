<?php

namespace Leaflet\Layer;

/**
 * Creates map markers.
 * 
 * @extends GSProxy
 * @implements Attachable
 */
/**
 * Class Marker
 * @package Leaflet\Layer
 */
class Marker extends Overlay {

    /**
     *
     */
    const jsName = 'L.marker';


    /**
     * @param array $coords
     * @param array $options
     */
    public function __construct($coords = array(), array $options = array())
	{
		$this->setOptions($options);
		$this->setEvent();
		
		$this->event->constructor(array($coords, $this->options));
		
		return $this;
	}


    /**
     * @param Icon $icon
     * @return $this
     */
    public function setIcon(Icon $icon)
	{
		$this->event->method('setIcon', $icon);
		
		return $this;
	}

}