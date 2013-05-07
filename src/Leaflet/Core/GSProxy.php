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
     * @var \Leaflet\Util\Option
     */
    protected $options;

    /**
     * @param $m
     * @param $args
     * @return mixed
     * @throws \BadMethodCallException
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
     * @param $key
     * @param $val
     * @return $this
     */
    private function _set_($key, $val)
	{
		$this->options->set($key, $val);
		return $this;
	}

    /**
     * @param $key
     * @return mixed
     */
    private function _get_($key)
	{
		return $this->options->get($key);
	}

    /**
     * @param $key
     * @return bool
     */
    private function _del_($key)
	{
		return $this->options->delete($key);
	}
}