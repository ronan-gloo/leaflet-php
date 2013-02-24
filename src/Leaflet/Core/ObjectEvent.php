<?php

namespace Leaflet\Core;

use Closure;
use Leaflet\JsFunc;
use Leaflet\Util\Helper;

/**
 * Object Events registry.
 * Each JsObject instance own a ObjectEvent instance,
 * wich is a part of the Queue SqlQueue element.
 * If we call JsObject::useRef(), a new registry is instanciate
 * and added to the queue.
 */
class ObjectEvent {
	
	// Set the context for our builder
	const typeNew = 'construct';
	const typeRef = 'variable';

	/**
	 * (default value: array())
	 * 
	 * @var array
	 * @access protected
	 */
	protected $constructor = null;
	
	/**
	 * (default value: array())
	 * 
	 * @var array
	 * @access protected
	 */
	protected $methods = array();
		
	/**
	 * JsObect reference
	 * 
	 * (default value: null)
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $jsObject = null;
	
	/**
	 * @access public
	 * @param JsObject $object
	 * @return void
	 */
	public function __construct(JsObject $object = null)
	{
		$object and $this->setObject($object);
	}
	
	/**
	 * Injects the JsObject.
	 * 
	 * @access public
	 * @param JsObject $object
	 * @return void
	 */
	public function setObject(JsObject $object)
	{
		$this->jsObject = $object;
	}
	
	/**
	 * Queue Index.
	 * 
	 * @access public
	 * @return void
	 */
	public function setIndex($index)
	{
		$this->index = $index;
		return $this;
	}
	
	/**
	 * Get queue index.
	 * 
	 * @access public
	 * @return void
	 */
	public function getIndex()
	{
		return $this->index;
	}
	
	/**
	 * @access public
	 * @return void
	 */
	public function isEmpty()
	{
		return null === $this->constructor;
	}
	
	/**
	 * Set constructor arguments.
	 * 
	 * @access public
	 * @param mixed $args
	 * @return void
	 */
	public function constructor($args = array())
	{
		if (! is_array($args)) $args = array($args);
		$this->constructor = $args;
	}
	
	/**
	 * @access public
	 * @return Mixed
	 */
	public function getConstructor()
	{
		return $this->constructor;
	}

	/**
	 * @access public
	 * @return Boolean
	 */
	public function hasConstructor()
	{
		return (bool)$this->constructor;
	}
	
	/**
	 * Register a new method.
	 * 
	 * @access public
	 * @param mixed $name
	 * @param mixed $arguments
	 * @return void
	 */
	public function method($name, $arguments = null)
	{
		! is_array($arguments) and $arguments = array($arguments);
		
		$this->methods[] = (object)compact('name', 'arguments');
		
		return $this;
	}
	
	/**
	 * @access public
	 * @return Mixed
	 */
	public function getMethods()
	{
		return $this->methods;
	}
	
	/**
	 * @access public
	 * @return void
	 */
	public function hasMethod()
	{
		return (bool)$this->methods;
	}
	
	/**
	 * Register an event (function builder)
	 * 
	 * @access public
	 * @param mixed $name
	 * @param mixed $arguments
	 * @return $this
	 */
	public function callback($name, Closure $callback)
	{
		$func = new JsFunc;
		$arguments = $func->getClosure($callback, $this->jsObject);
		
		$this->methods[] = (object)compact('name', 'arguments');
		return $this;
	}
	
	/**
	 * @access public
	 * @param mixed $callback
	 * @return void
	 */
	public function callbackMethod($name, Closure $callback)
	{
		$func = new JsFunc;
		return $this->method($name, $func->getClosure($callback, $this->jsObject));
	}
	
	/**
	 * Attach a callback event to the JsObject 
	 * @access public
	 * @return void
	 */
	public function event($event, $handler, Closure $callback)
	{
		$func = new JsFunc;
		$args = $func->getClosure($callback, $this->jsObject);
		
		$this->methods[] = (object)array(
			'name' 			=> $event,
			'arguments'	=> array($handler, $args)
		);
		return $this;
	}
	
	/**
	 * @access public
	 * @return void
	 */
	public function getObject()
	{
		return $this->jsObject;
	}

	
}