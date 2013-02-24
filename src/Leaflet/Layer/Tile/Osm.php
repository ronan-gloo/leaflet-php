<?php

namespace Leaflet\Layer\Tile;

/**
 * Open Street Map Provider.
 * 
 * @extends Layer
 * @implements IProvider
 */
class Osm extends Layer {
	
	const jsName = 'L.tileLayer';
	
	/**
	 * @var mixed
	 * @access protected
	 */
	protected $config = array(
		'location' => 'http://{s}.tile.osm.org/{z}/{x}/{y}.png',
	);
}