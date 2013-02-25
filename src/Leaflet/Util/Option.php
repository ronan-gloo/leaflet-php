<?php

namespace Leaflet\Util;

use ArrayObject;
use Closure;
use Leaflet\JsFunc;

class Option extends ArrayObject {
	
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
			if (ctype_alnum($name))
			{
				if ($value instanceof Closure)
				{
					$func = new JsFunc();
					$value = $func->closure($value, $this);
				}
				$this[$name] = $value;
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
		if (isset($this[$key]))
		{
			return $this[$key];
		}
	}
	
	/**
	 * @access public
	 * @param mixed $key
	 * @return void
	 */
	public function delete($key)
	{
		if (isset($this[$key]))
		{
			unset($this[$key]);
			return true;
		}
		return false;
	}
}