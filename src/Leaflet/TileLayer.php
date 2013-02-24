<?php

namespace Leaflet;

use Leaflet\Layer\Tile\IProvider;

/**
 * Facade for Tile providers or Tile Layer base class.
 */
class TileLayer {
	
	const providerNs = 'Leaflet\\Layer\\Tile\\';
	
	/**
	 * @access public
	 * @param string $provider (default: '')
	 * @param array $options (default: array())
	 * @return Provider Instance
	 */
	public static function make($provider, $api = null, array $options = array())
	{
		// Init the provider if class is found
		if ($class = static::getProviderClass($provider))
		{
			return new $class($api, $options);
		}
		
		// We launch the default Tile\Layer instance.
		// Here, we treat the $provider var as an url and api as options.
		return new Layer\Tile\Tile($provider, (array)$api);
	}
	
	/**
	 * Retuns the $provider clas name if exists
	 * @access public
	 * @static
	 * @return mixed Class name or false
	 */
	public static function getProviderClass($name)
	{
		// First, look if class exists as it
		// If not, check for pre-defined providers
		if (class_exists($name) or ($name = self::providerNs.ucfirst($name) and class_exists($name)))
		{
			// Check for the interface implemetation with classname
			if (is_subclass_of($name, self::providerNs.'IProvider'))
			{
				return $name;
			}
		}
		return false;
	}
	
}