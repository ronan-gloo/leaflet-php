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

    /**
     *
     */
    const jsName = 'L.layerGroup';

    /**
     * @param array $layers
     */
    public function __construct(array $layers = array())
	{
		$this->setEvent();
		
		$layers and $this->event->constructor(array($layers));
		
		return $this;
	}

    /**
     * @param $layer
     * @return $this
     * @throws \Leaflet\Exception\BadTypeException
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
     * @param $layer
     * @return $this
     * @throws \Leaflet\Exception\BadTypeException
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
	 * @return $this
	 */
	public function clearLayers()
	{
		$this->event->method('clearLayers');
		
		return $this;
	}

    /**
     * @param callable $closure
     * @return $this
     */
    public function eachLayer(Closure $closure)
	{
		$this->useRef();
		$this->event->callbackMethod('eachLayer', $closure);
		$this->useRef();
		return $this;
	}
	
}