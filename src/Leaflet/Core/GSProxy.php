<?php

namespace Leaflet\Core;

use BadMethodCallException;

/**
 * Reassign set*, get*, del* methods.
 */
abstract class GSProxy extends JsObject {
	
	/**
	 * @var array
	 * @access protected
	 */
	private $proxify = array('set', 'get', 'del');
	
	/**
	 * The options
	 * 
	 * (default value: array())
	 * 
	 * @var array
	 * @access protected
	 */
	protected $options = null;
	
	/**
	 * @access public
	 * @param mixed $m
	 * @param mixed $args
	 */
	public function __call($m, $args)
	{
		if (($method = substr($m, 0, 3)) and (in_array($method, $this->proxify)))
		{
			$prop = lcfirst(substr($m, 3));
			
			array_unshift($args, $prop);
			
			return call_user_func_array(array($this, '_'.$method.'_'), $args);
		}
		throw new BadMethodCallException("Method {$m} doesn't exists");
	}
		
	/**
	 * @access private
	 * @param mixed $key
	 * @param mixed $val
	 */
	private function _set_($key, $val)
	{
		$this->options->set($key, $val);
		return $this;
	}
	
	/**
	 * @access protected
	 * @param mixed $key
	 */
	private function _get_($key)
	{
		return $this->options->get($key);
	}
	
	/**
	 * @access public
	 * @param mixed $key
	 */
	private function _del_($key)
	{
		return $this->options->delete($key);
	}
}