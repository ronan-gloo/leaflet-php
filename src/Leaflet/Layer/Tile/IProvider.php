<?php

namespace Leaflet\Layer\Tile;

use Leaflet\Core\ILayer;

/**
 * implementation for providers.
 */
interface IProvider extends ILayer {
	
	/**
	 * @access public
	 * @param mixed $url
	 */
	public function setLocation($url);
	
	/**
	 * @access public
	 */
	public function getLocation();
	
	/**
	 * @access public
	 */
	public function setOptions(array $options);
}