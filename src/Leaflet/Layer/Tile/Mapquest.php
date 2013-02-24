<?php

namespace Leaflet\Layer\Tile;

/**
 * Open Street Map Provider.
 * 
 * @extends Layer
 * @implements IProvider
 */
class Mapquest extends Layer {
	
	const jsName = 'L.tileLayer';
	
	/**
	 * @var mixed
	 * @access protected
	 */
	protected $config = array(
		'location'	=> 'http://mtile0{s}.mqcdn.com/tiles/1.0.0/vy/{style}/{z}/{x}/{y}.png',
		'options'		=> array(
			'style' => 'map', // Actually: 'map', 'hyb', 'sat'. more ?
			'subdomains'=> '1234',
		)
	);
	
}