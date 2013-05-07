<?php

namespace Leaflet;

use Leaflet\Exception\InvalidJsVarNameException;


/**
 * Basic class to use scalar as javascript var in during compilation
 * Class JsVar
 * @package Leaflet
 */
class JsVar implements IVar {

    /**
     * @var
     */
    protected $name;

    /**
     * @param null $name
     * @return JsVar
     */
    public static function make($name = null)
	{
		return new self($name);
	}

    /**
     * @param null $name
     */
    public function __construct($name = null)
	{
		$name and $this->set($name);
	}

    /**
     * @param $name
     * @return $this
     * @throws Exception\InvalidJsVarNameException
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
     * @return mixed
     */
    public function get()
	{
		return $this->name;
	}

    /**
     * @return mixed
     */
    public function toJson()
	{
		return $this->name;
	}

    /**
     * @return mixed
     */
    public function __toString()
	{
		return $this->name;
	}
			
}