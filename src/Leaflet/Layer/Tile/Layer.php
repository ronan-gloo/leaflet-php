<?php

namespace Leaflet\Layer\Tile;

use Leaflet;

/**
 * Providers must extends this class.
 * Some providers: http://wiki.openstreetmap.org/wiki/Tileserver
 * 
 * @abstract
 * @extends Core
 */
abstract class Layer extends Leaflet\Layer\Layer implements IProvider {
	
	/**
	 * The map url
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $location;
	
	/**
	 * The provider options
	 * 
	 * (default value: array())
	 * 
	 * @var array
	 * @access protected
	 */
	protected $config = array();
	
	/**
	 * Profiles
	 * 
	 * (default value: array())
	 * 
	 * @var array
	 * @access protected
	 */
	protected $profiles = array();
	
	/**
	 * @access public
	 * @param mixed $api
	 * @param array $options (default: array())
	 * @return void
	 */
	public function __construct($location = array(), array $options = array())
	{
		// switch args if no location is provided
		if (is_array($location))
		{
			$options	= $location;
			$location	= null;
		}
		
		$this->setLocation($location);
		$this->setOptions($options);
		$this->setEvent();
		
		if (method_exists($this, 'beforeRegister') and is_callable(array($this, 'beforeRegister')))
		{
			$this->beforeRegister();
		}
		
		$this->event->constructor(array($this->getLocation(), $this->options));
	}
	
	/**
	 * @access public
	 * @return void
	 */
	public function setOptions(array $options)
	{
		if (isset($this->config['options']) and is_array($this->config['options']))
		{
			$options = $options + $this->config['options'];
		}
		
		return parent::setOptions($options);
	}
		
	/**
	 * @access public
	 * @return void
	 */
	public function getLocation()
	{
		return $this->location;
	}
	
	/**
	 * @access public
	 * @param mixed $url
	 * @return void
	 */
	public function setLocation($location)
	{
		if (null === $location and isset($this->config['location']))
		{
			$location = $this->config['location'];
		}

		$this->location = $location;
		
		return $this;
	}
		
	
}
