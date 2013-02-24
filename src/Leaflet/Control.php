<?php

namespace Leaflet;

/**
 * Stabtic facade for controls classes
 * 
 */
class Control {
		
	/**
	 * @access protected
	 * @static
	 * @return void
	 */
	public static function layers(array $base = array(), array $overlay = array())
	{
		return new Control\Layers($base, $overlay);
	}

	/**
	 * @access protected
	 * @static
	 * @return void
	 */
	public static function zoom(array $options = array())
	{
		return new Control\Zoom($options);
	}

	/**
	 * @access protected
	 * @static
	 * @return void
	 */
	public static function attribution(array $options = array())
	{
		return new Control\Attribution($options);
	}

	/**
	 * @access protected
	 * @static
	 * @return void
	 */
	public static function scale(array $options = array())
	{
		return new Control\Scale($options);
	}
	
	/**
	 * @access public
	 * @static
	 * @param array $options (default: array())
	 * @return void
	 */
	public static function make(array $options = array())
	{
		return new Control\Control($options);
	}

}