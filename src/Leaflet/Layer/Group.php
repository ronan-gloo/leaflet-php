<?php

namespace Leaflet\Layer;

use Closure;
use Leaflet\Core\ILayer;
use Leaflet\Map;
use Leaflet\JsVar;
use Leaflet\Exception\BadTypeException;

/**
 * Manager multiple layers.
 * 
 * @extends GSproxy
 * @implements Attachable
 */
class Group extends Layer {
	
	const jsName = 'L.layerGroup';
	
	/**
	 * @access public
	 * @return void
	 */
	public function __construct(array $layers = array())
	{
		$this->setEvent();
		
		$layers and $this->event->constructor(array($layers));
		
		return $this;
	}
	
	/**
	 * Add a layer to the group.
	 * 
	 * @access public
	 * @param mixed $layer
	 * @return void
	 */
	public function addLayer($layer)
	{
		if (! $layer instanceof Ilayer and ! $layer instanceof JsVar)
		{
			throw new BadTypeException(__METHOD__.': Layer must be an instance of JsVar or ILayer');
		}
		$this->event->method('addLayer', $layer);
		
		return $this;
	}
	
	/**
	 * Remove layer from group.
	 * 
	 * @access public
	 * @param mixed $layer
	 * @return void
	 */
	public function removeLayer($layer)
	{
		if (! $layer instanceof Ilayer and ! $layer instanceof JsVar)
		{
			throw new BadTypeException(__METHOD__.': Layer must be an instance of JsVar or ILayer');
		}
		$this->event->method('removeLayer', $layer);
		
		return $this;
	}
	
	/**
	 * @access public
	 * @return void
	 */
	public function clearLayers()
	{
		$this->event->method('clearLayers');
		
		return $this;
	}
	
	/**
	 * Loop throught layers.
	 * 
	 * @access public
	 * @return void
	 */
	public function eachLayer(Closure $closure)
	{
		$this->useRef();
		$this->event->callbackMethod('eachLayer', $closure);
		$this->useRef();
		return $this;
	}
	
}