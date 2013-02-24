<?php

namespace Leaflet\Layer;

/**
 * Creates map markers.
 * 
 * @extends GSProxy
 * @implements Attachable
 */
class Marker extends Overlay {
	
	const jsName = 'L.marker';
	
	/**
	 * @access public
	 * @param array $coords (default: array())
	 * @param array $options (default: array())
	 * @return void
	 */
	public function __construct($coords = array(), array $options = array())
	{
		$this->setOptions($options);
		$this->setEvent();
		
		$this->event->constructor(array($coords, $this->options));
		
		return $this;
	}
	
	/**
	 * 
	 * @access public
	 * @param Icon $icon
	 * @return void
	 */
	public function setIcon(Icon $icon)
	{
		$this->event->method('setIcon', $icon);
		
		return $this;
	}

}