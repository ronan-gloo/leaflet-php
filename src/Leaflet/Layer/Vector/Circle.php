<?php

namespace Leaflet\Layer\Vector;

class Circle extends Polyne {
	
	const jsName = 'L.circle';
	
	/**
	 * @access public
	 * @param array $coords (default: array())
	 * @param array $options (default: array())
	 * @return void
	 */
	public function __construct($coords, $radius = 200, array $options = array())
	{
		$this->setOptions($options);
		$this->setEvent();

		$this->event->constructor(array($coords, $radius, $this->options));
		
		return $this;
	}
	
	/**
	 * Set the object radius.
	 * 
	 * @access public
	 * @param mixed $radius
	 * @return void
	 */
	public function setRadius($radius)
	{
		$this->event->method('setRadius', $radius);
		return $this;
	}
	
}