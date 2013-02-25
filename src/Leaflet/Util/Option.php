<?php

namespace Leaflet\Util;

use Closure;
use Leaflet\JsFunc;

class Option {
	
	/**
	 * Options storage
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $data = array();
	
	/**
	 * @access public
	 * @param array $options (default: array())
	 * @return void
	 */
	public function __construct(array $options = array())
	{
		! empty($options) and $this->set($options);
	}
	
	/**
	 * set an or more option.
	 * 
	 * @access public
	 * @param mixed $key: string or an array for massive set
	 * @param mixed $val
	 * @return $this
	 */
	public function set($key, $val = null)
	{
		! is_array($key) and $key = array($key => $val);

		foreach ($key as $name => $value)
		{
			if ($value instanceof Closure)
			{
				$func = new JsFunc();
				$value = $func->closure($value, $this);
			}
			
			// Options key should be a non numeric string
			if (is_string($name) and ! is_numeric($name))
			{
				$this->data[$name] = $value;
			}
		}
		return $this;
	}
	
	/**
	 * get an option.
	 * 
	 * @access public
	 * @param mixed $key (default: null)
	 * @return $option contents
	 */
	public function get($key = null)
	{
		if (isset($this->data[$key]))
		{
			return $this->data[$key];
		}
	}
	
	/**
	 * @access public
	 * @param mixed $key
	 * @return void
	 */
	public function delete($key)
	{
		if (array_key_exists($key, $this->data))
		{
			unset($this->data[$key]);
			return true;
		}
		return false;
	}
	
	/**
	 * @access public
	 * @return void
	 */
	public function toArray()
	{
		return $this->data;
	}
	
}