<?php

namespace Leaflet\Util;

use ArrayObject;
use Closure;
use Leaflet\JsFunc;

/**
 * Class Option
 * @package Leaflet\Util
 */
class Option extends ArrayObject {

    /**
     * @param array $options
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
     * @param null $key
     * @return mixed
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
	 * @return bool
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