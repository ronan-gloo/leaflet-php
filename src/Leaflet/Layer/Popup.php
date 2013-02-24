<?php

namespace Leaflet\Layer;

use Leaflet\Map;

/**
 * @extends Feature
 */
class Popup extends Layer {
	
	const jsName = 'L.popup';
	
	/**
	 * @access public
	 * @return void
	 */
	public function __construct(array $options = array())
	{
		$this->setEvent();
		$this->setOptions($options);
		
		$this->event->constructor(array($this->options));
	}
	
	/**
	 * 
	 * @access public
	 * @param Map $map
	 */
	public function openOn(Map $map)
	{
		$this->event->method('openOn', $map);
		
		return $this;
	}
	
	/**
	 * Set the popup content.
	 * 
	 * @access public
	 * @param mixed $content
	 * @return void
	 */
	public function setContent($content)
	{
		$this->event->method('setContent', $content);
		
		return $this;
	}
	
}