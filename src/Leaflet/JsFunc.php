<?php

namespace Leaflet;

use Closure;
use Leaflet\Core\JsObject;

/**
 * @implements IFunc
 */
class JsFunc implements IFunc {
	
	/**
	 * Js function arguments
	 * 
	 * (default value: array())
	 * 
	 * @var array
	 * @access public
	 */
	public $args = array();
	
	/**
	 * Js function lines
	 * 
	 * (default value: array())
	 * 
	 * @var array
	 * @access public
	 */
	public $lines = array();
	
	/**
	 * If a name is set, the function is rendered
	 * as var name = function()...
	 * 
	 * (default value: null)
	 * 
	 * @var mixed
	 * @access public
	 */
	public $name = null;
	
	
	/**
	 * @access public
	 * @param Closure $closure (default: null)
	 * @return void
	 */
	public function __construct(Closure $closure = null)
	{
		$closure and $this->closure($closure);
	}
	
	/**
	 * Set the varname.
	 * 
	 * @access public
	 * @param mixed $var
	 * @return $this
	 */
	public function name($var = null)
	{
		$this->name = (string)$var;
		return $this;
	}
	
	/**
	 * Get the varname.
	 * 
	 * @access public
	 * @return String
	 */
	public function getName()
	{
		return $this->name;
	}
	
	/**
	 * Add function arguments.
	 * 
	 * @access public
	 * @return void
	 */
	public function args($arg)
	{
		foreach (func_get_args() as $arg)
		{
			$this->args[] = $arg;
		}
		return $this;
	}
	
	/**
	 * Add body line to the function
	 * 
	 * @access public
	 * @param mixed $str: line, force to string in order to inkove __toString
	 * @return $this
	 */
	public function line($str)
	{
		$this->lines[] = (string)$str;
		return $this;
	}
	
	/**
	 * Returns stringified arguments.
	 * 
	 * @access public
	 * @return String
	 */
	public function getArgs()
	{
		return implode(',', $this->args);
	}
	
	/**
	 * Returns stringified body.
	 * 
	 * @access public
	 * @return String
	 */
	public function getLines()
	{	
		$lines = '';
		
		foreach ($this->lines as $line)
		{
			$lines .= "\t".trim($line)."\n";
		}
		return $lines;
	}
	
	/**
	 * Get the callback output
	 * We need to create a new context in order to wrap new instances
	 * queue in the callback context.
	 * All method's arguments after Closure are passed to the Closure
	 * 
	 * @access public
	 * @static
	 * @param Closure $closure
	 * @return void
	 */
	public function closure(Closure $closure)
	{
		$args			= func_get_args();
		$args[0]	= $this;
		
		$current	= Context::current();
		$context	= new Context(spl_object_hash($this));
		$output		= call_user_func_array($closure, $args) ?: $this;

		// Destroy temp context
		$context->destroy();
		Context::switchTo($current);
		
		return $output;
	}
	
	/**
	 * toJson function.
	 * 
	 * @access public
	 * @return void
	 */
	public function toJson()
	{
		$output  = ($this->name) ? 'var '.$this->name.' = ' : '';
		$output .= 'function('.$this->getArgs().'){'."\n";
		$output .= $this->getLines();
		$output .= '}';
		
		return $output;
		/*
		$pattern = array();
		foreach ($this->args as $key => $arg) {
			$pattern[] = '$'.($key+1);
		}
		return $pattern ? str_replace($pattern, $this->args, $output) : $output;
		*/
	}
	
	public function __toString()
	{
		return $this->toJson();
	}
	
}