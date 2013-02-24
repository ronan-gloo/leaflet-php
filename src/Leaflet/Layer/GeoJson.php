<?php

namespace Leaflet\Layer;

/**
 * Represents a GeoJson object
 * http://leafletjs.com/reference.html#geojson
 * 
 * @extends Feature
 */
class GeoJson extends Overlay {
	
	const jsName = 'L.geoJson';
	
	public $data = null;
	
	/**
	 * @access public
	 * @param array $options (default: array())
	 * @return void
	 */
	public function __construct($data = array(), array $options = array())
	{
		$this->setOptions($options);
		$this->setEvent();
		
		$data and $this->setData($data);
		$this->event->constructor(array($this->data, $this->options));

		return $this;
	}
		
	/**
	 * @access public
	 * @param mixed $data
	 * @return void
	 */
	public function setData($data)
	{
		is_string($data) and $data = json_decode($data);
		
		$this->data = $data;
		
		return $this;
	}

	/**
	 * @access public
	 * @param mixed $data
	 * @return void
	 */
	public function addData($data)
	{
		$this->event->method('addData', $data);
		return $this;
	}
	
	/**
	 * @access public
	 * @return void
	 */
	public function getData()
	{
		return $this->data;
	}
	
}