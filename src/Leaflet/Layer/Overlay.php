<?php

namespace Leaflet\Layer;

/**
 * @abstract
 * @extends GSProxy
 * @implements Attachable
 * @implements ILayer
 */
abstract class Overlay extends Layer {
	
	/**
	 * @access public
	 * @param mixed $identifier
	 * @param array $coords (default: array())
	 * @param array $options (default: array())
	 * @return void
	 */
	public function __construct(array $coords = array(), array $options = array())
	{
		$this->setEvent();
		$this->setOptions($options);

		$this->event->constructor(array($coords, $options));
	}
	
	/**
	 * @access public
	 * @return void
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
	 * @return void
	 */
	public function openPopup($popup = null)
	{
		$popup and $this->event->method('bindPopup', $popup);
		$this->event->method('openPopup');
		
		return $this;
	}
}