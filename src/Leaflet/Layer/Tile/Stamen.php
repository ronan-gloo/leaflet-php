<?php

namespace Leaflet\Layer\Tile;

/**
 * Cloudmade Provider.
 * You'll need an Api key in order to make requests
 * 
 * @extends Layer
 * @implements IProvider
 */
class Stamen extends Layer {
	
	const jsName = 'L.tileLayer';
	
	/**
	 * Available styles:
	 * toner
	 * toner-lite
	 * toner-hybrid
	 * toner-lines
	 * toner-labels
	 * toner-background
	 * terrain
	 * watercolor
	 *
	 * @var mixed
	 * @access protected
	 */
	protected $config = array(
		'location'	=> 'http://{s}.tile.stamen.com/{style}/{z}/{x}/{y}.{ext}',
		'options'		=> array(
			'style' 	=> 'toner',
			'ext'			=> 'png',
			'maxZoom' => 18,
		)
	);
	
}