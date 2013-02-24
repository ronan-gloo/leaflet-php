<?php

namespace Leaflet;

use Leaflet\Exception\InvalidJsVarNameException;

/**
 * Basic class to use as var in during compilation.
 * 
 * @implements Jsonable
 */
class JsVar implements IVar {
	
	/**
	 * @var mixed
	 * @access protected
	 */
	protected $name;
	
	/**
	 * @access public
	 * @static
	 * @param mixed $varname
	 * @return $this
	 */
	public static function make($name = null)
	{
		return new self($name);
	}
	
	/**
	 * @access public
	 * @param mixed $name
	 * @return void
	 */
	public function __construct($name = null)
	{
		$name and $this->set($name);
	}
	
	/**
	 * @access public
	 * @return Mixed $this or throw BadTypeException
	 */
	public function set($name)
	{
		if (is_string($name) and ! is_numeric($name))
		{
			$this->name = trim($name);
			return $this;
		}
		throw new InvalidJsVarNameException($name);
	}

	/**
	 * @access public
	 * @return String
	 */
	public function get()
	{
		return $this->name;
	}
	
	/**
	 * @access public
	 * @return String
	 */
	public function toJson()
	{
		return $this->name;
	}
	
	/**
	 * @access public
	 * @return void
	 */
	public function __toString()
	{
		return $this->name;
	}
			
}