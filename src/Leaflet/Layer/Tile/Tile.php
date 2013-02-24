<?php

namespace leaflet\Layer\Tile;

/**
 * Open Street Map Provider.
 * 
 * @extends Layer
 */
class Tile extends Layer {
	
	const jsName = 'L.tileLayer';
	
	/**
	 * @access public
	 * @return void
	 */
	public function __construct($url, array $options = array())
	{
		if (empty($url) or ! is_string($url))
		{
			throw new InvalidProviderException($url.": is not a valid provider or url");
		}
		parent::__construct($url, $options);
	}	
	
}