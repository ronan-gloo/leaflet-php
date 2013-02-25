<?php

namespace Leaflet;

use
	Leaflet\Core\GSProxy,
	Leaflet\Core\ILayer,
	Leaflet\Control,
	Leaflet\Exception\BadTypeException,
	OutOfBoundsException
;

class Map extends GSProxy implements Core\Nameable {
	
	const jsName = 'L.map';
	
	/**
	 * @access public
	 * @return void
	 */
	public function __construct($identifier, array $options = array())
	{
		$this->setRef($identifier);
		$this->setOptions($options);
		$this->setEvent();
		
		$this->event->constructor(array($identifier, $this->options));
	}
	
	/**
	 * @access public
	 * @param Layer $layer
	 * @return $this
	 */
	public function addLayer(IVar $layer, $insertAtBottom = null)
	{
		if (is_bool($insertAtBottom))
		{
			$this->event->method('addLayer', $layer, $insertAtBottom);
		}
		else
		{
			$this->event->method('addLayer', $layer);
		}
		return $this;
	}

	/**
	 * @access public
	 * @param Layer $layer
	 * @return $this
	 */
	public function addLayers(array $layers)
	{
		foreach ($layers as $layer) $this->addLayer($layer);
		return $this;
	}
	
	/**
	 * @access public
	 * @param Layer $layer
	 * @return $this
	 */
	public function removeLayer(IVar $layer)
	{
		$this->event->method('removeLayer', $layer);
		return $this;
	}
	
	/**
	 * @access public
	 * @param Control $control
	 * @return void
	 */
	public function addControl(Control\Control $control)
	{
		$this->event->method('addControl', $control);
		return $this;
	}
	
	/**
	 * @access public
	 * @param array $coords
	 * @param mixed $zoom (default: null)
	 * @param bool $forceReset (default: false)
	 * @return $this
	 */
	public function setView()
	{
		$this->event->method('setView', func_get_args());
		return $this;
	}

	/**
	 * Filter non ILayer instances from the array.
	 * Convert associative array to indexed array if
	 * layers are named, then pass them to the option.
	 *
	 * @access public
	 * @param array $layers
	 * @return $this
	 */
	public function setLayers(array $layers)
	{
		// be sure we have layers there
		array_filter($layers, function($item){
			return ! $item instanceof IVar;
		});
		
		$this->options->set('layers', array_values($layers));
		
		return $this;
	}
	
	/**
	 * Tries to locate the user using Geolocation API
	 * 
	 * @access public
	 * @param array $options (default: array())
	 * @return $this
	 */
	public function locate(array $options = array())
	{
		$this->event->method('locate', array($options));
		
		return $this;
	}
	
	/**
	 * @access public
	 * @return $this
	 */
	public function fitWorld()
	{
		$this->event->method('fitWorld');
		return $this;
	}
	
	/**
	 * Open the specified popup.
	 * 
	 * @access public
	 * @param Popup $popup
	 * @return $this
	 */
	public function openPopup(Popup $popup)
	{
		$this->event->method('openPopup', $popup);
		return $this;
	}
	
	/**
	 * Close the opened popup by openPopup.
	 * 
	 * @access public
	 * @return void
	 */
	public function closePopup()
	{
		$this->event->method('closePopup');
		return $this;
	}
}