<?php

namespace Leaflet\Layer\Tile;

/**
 * Cloudmade Provider.
 * You'll need an Api key in order to make requests
 * 
 * @extends Layer
 * @implements IProvider
 */
class Cloudmade extends Layer {
	
	const jsName = 'L.tileLayer';
	
	/**
	 * @var mixed
	 * @access protected
	 */
	protected $config = array(
		'location'	=> 'http://{s}.tile.cloudmade.com/{key}/{style}/256/{z}/{x}/{y}.png',
		'options'		=> array(
			'style' => 997,
		)
	);
	
}