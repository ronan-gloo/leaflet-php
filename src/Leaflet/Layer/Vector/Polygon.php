<?php

namespace Leaflet\Layer\Vector;

class Polygon extends Polyne {
	
	const jsName = 'L.polygon';
	
	/**
	 * @access public
	 * @param array $coords (default: array())
	 * @param array $options (default: array())
	 * @return void
	 */
	public function __construct(array $coords = array(), array $options = array())
	{
		$this->setOptions($options);
		$this->setEvent();
		
		$this->event->constructor(array($coords, $this->options));
		
		return $this;
	}

}