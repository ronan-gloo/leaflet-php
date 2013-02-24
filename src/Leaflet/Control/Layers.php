<?php

namespace Leaflet\Control;

/**
 * @extends ControlAbstract
 */
class Layers extends Control {
	
	const jsName = 'L.control.layers';
	
	/**
	 * @access public
	 * @return void
	 */
	public function __construct(array $base = array(), array $overlay = array())
	{
		$this->setEvent();
				
		$this->event->constructor(func_get_args());
	}
	
	/**
	 * Add new raido layer.
	 * 
	 * @access public
	 * @param ILayer $layer
	 * @return void
	 */
	public function addBaseLayer(ILayer $layer)
	{
		$this->event->method('addBaseLayer', $layer);
		return $this;
	}
	
	/**
	 * Add an overlay layer.
	 * 
	 * @access public
	 * @param ILayer $layer
	 * @return void
	 */
	public function addOverlay(ILayer $layer)
	{
		$this->event->method('addBaseLayer', $layer);
		return $this;
	}
	
}