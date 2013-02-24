<?php

namespace leaflet\Layer\Tile;

/**
 * Open Street Map Provider.
 * 
 * @extends Layer
 * @implements IProvider
 */
class Googlemap extends Layer {
	
	const jsName = 'L.tileLayer';
	
	/**
	 * Styles:
	 * ---------
	 * khms
	 * mts
	 * ---------
	 * @var mixed
	 * @access protected
	 */
	protected $config = array(
		'location' => 'https://{subpath}{s}.google.com/{segment}?x={x}&y={y}&z={z}',
		'options' => array(
			'subdomains'	=> '0123',
			'style'				=> 'plan',
		),
	);
	
	/**
	 * Predefined profiles
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $profiles = array(
		// Plan view
		'plan' => array(
			'options' => array(
				'subpath' => 'mt',
				'segment' => 'vt'
			)
		),
		
		// Only roads
		'label' => array(
			'options' => array(
				'subpath' => 'mts',
				'segment' => 'vt'
			),
			'params' => array(
				'lyrs'	=> 'h@207000000',
				's'			=> 'Galil'
			)
		),
		
		// Traffic infos
		'traffic' => array(
			'options' => array(
				'subpath' => 'mts',
				'segment' => 'vt'
			),
			'params' => array(
				'lyrs'	=> 'traffic|seconds_into_week:-1',
				'style'	=> '15'
			)
		),
		
		'meteo' => array(
			'options' => array(
				'subpath' => 'mts',
				'segment' => 'mapslt'
			),
			'params' => array(
				'lyrs' => 'weather_c_kph|invert:0'
			),
		),
		
		// Sat view
		'satellite' => array(
			'options' => array(
				'subpath' => 'khms',
				'segment' => 'kh',
			),
			'params' => array(
				'v' => 125,
				's' => 'Gal'
			)
		)
	);
	
	/**
	 * Inject profile.
	 * 
	 * @access public
	 * @return void
	 */
	public function beforeRegister()
	{
		$style = $this->options->get('style');
		
		// setup profile and fallback to default
		if (! isset($this->profiles[$style]))
		{
			$style = $this->config['options']['style'];
		}
		
		// Injet options & finalize request
		$profile = $this->profiles[$style];
		
		$this->options->set($profile['options']);
		
		if (isset($profile['params']))
		{
			$this->location .= '&'.http_build_query($profile['params']);
		}
		
		// Delete unused config entry
		$this->options->delete('style');
		
	}
	
}