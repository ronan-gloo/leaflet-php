<?php

namespace Leaflet\Core;

use BadMethodCallException;
use Closure;
use Leaflet\Context;
use Leaflet\Util\Option;
use ReflectionClass;

/**
 * Redirect set* and get* methods to .
 */
abstract class JsObject implements Nameable, Jsonable {
	
	/**
	 * @var mixed
	 * @access protected
	 * @static
	 */
	protected static $_option;
	
	/**
	 * @var mixed
	 * @access protected
	 * @static
	 */
	protected static $_registry;
	
	/**
	 * @var mixed
	 * @access protected
	 */
	protected $identifier;
	
	/**
	 * @var mixed
	 * @access protected
	 */
	protected $registry;
	
	/**
	 * Bind instance constructor.
	 * 
	 * @access public
	 * @static
	 * @return void
	 */
	public static function make()
	{
		$ref = new ReflectionClass(get_called_class());
		return $ref->newInstanceArgs(func_get_args());
	}
	
	/**
	 * Catch instance events.
	 * 
	 * @access public
	 * @param mixed $m
	 * @param mixed $args
	 * @return void
	 */
	public function on($event, Closure $callback)
	{
		$this->useRef();
		$this->event->event('on', $event, $callback);
		return $this;
	}
	
	/**
	 * Create new buidser.
	 * 
	 * @access public
	 * @return void
	 */
	public function setEvent($new = true)
	{
		$this->event = new ObjectEvent($this);
		
		Context::current()->queue()->register($this->event, $new);
		
		return $this;
	}
	
	/**
	 * Initialize the options.
	 * 
	 * @access public
	 * @return void
	 */
	public function setOptions(array $options)
	{
		! static::$_option and static::$_option = new Option();
		
		$obj = clone static::$_option;
		$this->options = $obj->set($options);
		
		return $this;
	}
	
	/**
	 * @access public
	 * @param mixed $identifier
	 * @return void
	 */
	public function setRef($identifier)
	{
		$this->identifier = $identifier;
		
		return $this;
	}
	
	/**
	 * @access public
	 * @return void
	 */
	public function getRef()
	{
		return $this->identifier;
	}
	
	/**
	 * When calling this method on object,
	 * the compilator will creates a new var entry
	 * 
	 * @access public
	 * @return void
	 */
	public function useRef()
	{
		$this->setEvent(false);
		return $this;
	}
	
	/**
	 * @access public
	 * @return void
	 */
	public function getOptions()
	{
		return $this->options;
	}

	/**
	 * Nameable implementation.
	 * 
	 * @access public
	 * @return void
	 */
	public function jsName()
	{
		return $this::jsName;
	}
	
	/**
	 * Jsonable implementation.
	 * 
	 * @access public
	 * @return void
	 */
	public function toJson()
	{
		return $this->identifier;
	}
	
	/**
	 * Build element then remove it from queue
	 * @access public
	 * @return void
	 */
	public function __toString()
	{
		// Get the Queue element
		$queue = Context::current()->queue();
		$index = $this->event->getIndex();
		
		if ($queue->offsetExists($index))
		{
			$element = $queue->offsetGet($index);
			$queue->offsetUnset($index);
			
			$builder = Context::current()->builder();
			
			return $builder->buildElement($element);
		}
		return '';
	}
	
}