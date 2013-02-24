<?php

namespace Leaflet\Layer;

/**
 * Represents an icon object
 * http://leafletjs.com/reference.html#icon
 * 
 * @extends Feature
 */
class Icon extends Layer {
	
	const jsName = 'L.icon';
	
	/**
	 * @access public
	 * @param array $options (default: array())
	 * @return void
	 */
	public function __construct(array $options = array())
	{
		$this->setOptions($options);
		$this->setEvent();
		
		$this->event->constructor(array($this->options));
		
		return $this;
	}
	
}