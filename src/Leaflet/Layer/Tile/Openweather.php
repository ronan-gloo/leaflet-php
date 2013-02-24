<?php

namespace Leaflet\Layer\Tile;

/**
 * http://openweathermap.org/hugemaps
 * 
 * @extends Layer
 * @implements IProvider
 */
class Openweather extends Layer {
	
	const jsName = 'L.tileLayer';
	
	/**
	 * Some Styles:
	 * ------------
	 * clouds
	 * clouds_cls
	 * precipitation
	 * precipitation_cls
	 * rain
	 * rain_cls
	 * pressure
	 * pressure_cntr
	 * wind
	 * temp
	 * snow
	 * ------------
	 *
	 * @var mixed
	 * @access protected
	 */
	protected $config = array(
		'location'=> 'http://{s}.tile.openweathermap.org/map/{style}/{z}/{x}/{y}.png',
		'options'	=> array(
			'style' => 'clouds'
		)
	);
	
}