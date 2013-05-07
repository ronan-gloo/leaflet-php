<?php

namespace Leaflet\Layer;

/**
 * @abstract
 * @implements Layer
 */
/**
 * Class Overlay
 * @package Leaflet\Layer
 */
abstract class Overlay extends Layer {


    /**
     * @param array $coords
     * @param array $options
     */
    public function __construct(array $coords = array(), array $options = array())
	{
		$this->setEvent();
		$this->setOptions($options);

		$this->event->constructor(array($coords, $options));
	}


    /**
     * @param $contents
     * @return $this
     */
    public function bindPopup($contents)
	{
		$this->event->method('bindPopup', $contents);
		return $this;
	}
	
	/**
	 * OpenPoup, or binf then open if $popup is provided.
	 * 
	 * @access public
	 * @param mixed $popup (default: null): Popup string
	 * @return $this
	 */
	public function openPopup($popup = null)
	{
		$popup and $this->event->method('bindPopup', $popup);
		$this->event->method('openPopup');
		
		return $this;
	}
}