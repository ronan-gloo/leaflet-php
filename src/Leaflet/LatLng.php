<?php

namespace Leaflet;

use Leaflet\Core\JsObject;

class LatLng extends JsObject {
	
	const jsName = 'L.latLng';
	
	/**
	 * @var mixed
	 * @access protected
	 */
	protected $lat = 0.0;
	
	/**
	 * @var mixed
	 * @access protected
	 */
	protected $lng = 0.0;
	
	/**
	 * @access public
	 * @param array $coords (default: array())
	 * @param array $options (default: array())
	 * @return void
	 */
	public function __construct($lat, $lng)
	{
		$this->setLat($lat);
		$this->setLng($lng);
		
		$this->setEvent();
		$this->event->constructor(array($this->lat, $this->lng));
	}
	
	public function setLat($lat)
	{
		return $this->lat = (float)$lat;
	}
	
	public function geLat()
	{
		return $this->lat;
	}

	public function setLng($lng)
	{
		return $this->lng = (float)$lng;
	}
	
	public function geLng()
	{
		return $this->lng;
	}

}