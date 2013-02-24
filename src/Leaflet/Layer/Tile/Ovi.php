<?php

namespace Leaflet\Layer\Tile;

/**
 * Open Street Map Provider.
 * 
 * @extends Layer
 * @implements IProvider
 */
class Ovi extends Layer {
	
	const jsName = 'L.tileLayer';
	
	/**
	 * Free Styles:
	 * ---------
	 * normal.day
	 * normal.day.grey
	 * satellite.day
	 * hybrid.day
	 * terrain.day
	 * ---------
	 * @var mixed
	 * @access protected
	 */
	protected $config = array(
		'location' => 'http://{s}.maptile.lbs.ovi.com/maptiler/{api}/maptile/newest/{style}.{display}/{z}/{x}/{y}/256/{format}?token={key}&app_id={appId}',
		'options' => array(
			'style'				=> 'normal',
			'display'			=> 'day',
			'key'					=> 'xxx',
			'appId' 			=> '111',
			'format'			=> 'png8',
			'api'					=> 'v2',
			'subdomains'	=> '1234'
		),
	);
}