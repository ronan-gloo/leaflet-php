<?php

namespace Leaflet\Core;

use Closure;
use Leaflet\Map;

/**
 * Base class for layers.
 * 
 * @abstract
 * @implements Ilayer
 */
abstract class Layer extends GSProxy implements ILayer {
	
	/**
	 * @access public
	 * @param Closure $closure
	 * @return $this
	 */
	public function onAdd(Closure $closure)
	{
		$this->useRef();
		$this->event->callback('onAdd', $closure);
		return $this;
	}
	
	/**
	 * @access public
	 * @param Closure $closure
	 * @return $this
	 */
	public function onRemove(Closure $closure)
	{
		$this->useRef();
		$this->event->callback('onRemove', $closure);
		return $this;
	}
	
	/**
	 * @access public
	 * @param Map $map
	 * @return $this
	 */
	public function addTo(Map $map)
	{
		$this->event->method('addTo', $map);
		return $this;
	}
	
	/**
	 * Brings the image layer to the top of all tile layers.
	 * 
	 * @access public
	 * @return $this
	 */
	public function bringToFront()
	{
		$this->event->method('bringToFront');
		return $this;
	}
	
	/**
	 * Brings the image layer to the bottom of all tile layers.
	 * 
	 * @access public
	 * @return $this
	 */
	public function bringToBack()
	{
		$this->event->method('bringToBack');
		return $this;
	}
}