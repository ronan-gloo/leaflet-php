<?php

namespace Leaflet\Layer\Tile;

/**
 * Open Street Map Provider.
 * 
 * @extends Layer
 * @implements IProvider
 */
class Mapbox extends Layer {
	
	const jsName = 'L.tileLayer';
	
	/**
	 * @var mixed
	 * @access protected
	 */
	protected $config = array(
		'location'	=> 'http://{s}.tiles.mapbox.com/v3/{style}/{z}/{x}/{y}.png?updated={hash}',
		'options'		=> array(
			'maxZoom'	=> 17,
			'style'		=> 'mapbox.world-blue',
			/*
			'style'		=> array(
				'e8e0d8',
				'base.live-landuse',
				'base.live-water',
				'base.live-buildings',
				'base.live-streets'
			),
			*/
			'hash' => '78224b8',
			'subdomains'=> 'abcd',
		)
	);
	
	/**
	 * preconfigured Tiles are here: https://tiles.mapbox.com/mapbox
	 * The location is different if we need to compose our own map.
	 * To be aware of this, style config key has to be an array of
	 * desired layers.
	 * 
	 * @access public
	 * @param mixed $location
	 * @param array $options (default: array())
	 * @return void
	 */
	public function beforeRegister()
	{
		if ($style = $this->options->get('style') and is_array($style))
		{
			// implode styles
			$this->options->set('style', implode(',', $style));
			
			// change the tiles location
			$this->setLocation(str_replace('{s}.', '', $this->config['location']));
		}
	}
	
}