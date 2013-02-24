<?php

namespace Leaflet\Layer\Tile;

/**
 * Open Street Map Provider.
 * 
 * @extends Layer
 * @implements IProvider
 */
class Ocm extends Layer {
	
	const jsName = 'L.tileLayer';
	
	/**
	 * Styles:
	 * ---------
	 * landscape
	 * cycle
	 * transport
	 * ---------
	 * @var mixed
	 * @access protected
	 */
	protected $config = array(
		'location' => 'http://{s}.tile{tile}.opencyclemap.org/{style}/{z}/{x}/{y}.png',
		'options' => array(
			'style'	=> 'cycle',
		),
	);
	
	/**
	 * Hook the tile for styles
	 * 
	 * @access protected
	 * @return void
	 */
	protected function beforeRegister()
	{
		switch ($this->options->get('style'))
		{
			case 'cycle':
			return $this->setLocation(str_replace('{tile}', '', $this->config['location']));

			case 'transport':
			$key = 2;
			break;
			case 'landscape':
			$key = 3;
			break;
		}
		$this->options->set('tile', $key);
	}
}