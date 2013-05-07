<?php

namespace Leaflet;

use Leaflet\Core\JsObject;

/**
 * Class LatLng
 * @package Leaflet
 */
class LatLng extends JsObject {

    /**
     *
     */
    const jsName = 'L.latLng';
	
	/**
	 * @var float
	 * @access protected
	 */
	protected $lat = 0.0;
	
	/**
	 * @var float
	 * @access protected
	 */
	protected $lng = 0.0;

    /**
     * @param float $lat
     * @param float $lng
     */
    public function __construct($lat = 0.0, $lng = 0.0)
	{
		$this->setLat($lat);
		$this->setLng($lng);
		
		$this->setEvent();
		$this->event->constructor(array($this->lat, $this->lng));
	}

    /**
     * @param $lat
     * @return float
     */
    public function setLat($lat)
	{
		return $this->lat = (float)$lat;
	}

    /**
     * @return float
     */
    public function getLat()
	{
		return $this->lat;
	}

    /**
     * @param $lng
     * @return float
     */
    public function setLng($lng)
	{
		return $this->lng = (float)$lng;
	}

    /**
     * @return float
     */
    public function getLng()
	{
		return $this->lng;
	}

}