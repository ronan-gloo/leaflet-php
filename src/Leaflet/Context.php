<?php

namespace Leaflet;

use Leaflet\Core\IQueue;
use Leaflet\Core\IBuilder;

/**
 * The Leaftlet env.
 * This class allow to instanciate a builder,
 * Set global configuration options... etc.
 */
class Context {
	
	/**
	 * @var mixed
	 * @access protected
	 * @static
	 */
	protected static $instances = array();
	
	/**
	 * Current Context
	 * 
	 * (default value: null)
	 * 
	 * @var mixed
	 * @access protected
	 * @static
	 */
	protected static $current = null;

	/**
	 * The instance name
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $id;
	
	/**
	 * Queue instance
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $queue;
	
	/**
	 * Builder instance
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $builder;
	
	/**
	 * Context options
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $options = array();
		
	/**
	 * @access public
	 * @static
	 * @return void
	 */
	public static function instance($id = null)
	{
		if (! isset(static::$instances[$id]))
		{
			if (null === $id)
			{
				if (! count(static::$instances))
				{
					return new self();
				}
				return static::$current;
			}
		}
		return static::$instances[$id];
	}
		
	/**
	 * Switch to the desired context.
	 *
	 * @access public
	 * @static
	 * @param mixed $id: context id or context instance
	 * @return mixed self instance, or false
	 */
	public static function switchTo($id)
	{
		if ($id instanceof self)
		{
			if ($id === static::$current)
			{
				return static::$current;
			}
			$id = array_search($id, static::$instances, true);
		}
		if (isset(static::$instances[$id]))
		{
			return static::$current = static::$instances[$id];
		}
		return false;
	}
	
	/**
	 * @access public
	 * @static
	 * @return void
	 */
	public static function instances()
	{
		return static::$instances;
	}
	
	/**
	 * Returns the current context.
	 * If no instances are created, we invoke
	 * a new object
	 * 
	 * @access public
	 * @static
	 * @return self instance
	 */
	public static function current()
	{
		return static::$current ?: static::instance();
	}

	/**
	 * @access public
	 * @param IQueue $queue (default: null)
	 * @param IBuilder $builder (default: null)
	 * @return void
	 */
	public function __construct($id = null, array $options = array(), IBuilder $builder = null, IQueue $queue = null)
	{
		$this->builder	= $builder	?: new Core\Builder;
		$this->queue		= $queue 		?: new Core\Queue;
		
		$this->options = $options + array(
			'eventRef'			=> 'e',
			'refName' 			=> 'llet',
			'refIncrement' 	=> 0,
			'jsonFlags'			=> null,
		);
		
		$this->id = (string)($id ?: spl_object_hash($this));

		static::$instances[$this->id] = static::$current = $this;
	}
	
	/**
	 * Set context options, or retrieve them if
	 * no arguments are provided
	 * 
	 * @access public
	 * @param array $options (default: array())
	 * @return Mixed array() options or $his if no arguments
	 */
	public function options(array $options = array())
	{
		if (func_num_args() === 0)
		{
			return $this->options;
		}
		else
		{
			$this->options = $options + $this->options;
		}
		return $this;
	}
	
	/**
	 * @access public
	 * @return Builder instance
	 */
	public function builder()
	{
		return $this->builder;
	}
	
	/**
	 * @access public
	 * @return Queue instance
	 */
	public function queue()
	{
		return $this->queue;
	}
	
	/**
	 * @access public
	 * @return string id
	 */
	public function id()
	{
		return $this->id;
	}
	
	/**
	 * @access public
	 * @return void
	 */
	public function build()
	{
		// Setup the builder
		$this->builder->setQueue($this->queue);
		
		$this->builder->setRefName($this->options['refName']);
		$this->builder->setRefIncrement($this->options['refIncrement']);
		$this->builder->setJsonFlags($this->options['jsonFlags']);
		
		return $this->builder->build();
	}
	
	/**
	 * output function.
	 * 
	 * @access public
	 * @return void
	 */
	public function getJs()
	{
		$this->build();
		
		return $this->builder->output();
	}
	
	/**
	 * Bridge to __destruct method
	 * 
	 * @access public
	 * @return void
	 */
	public function destroy()
	{
		$this->__destruct();
	}
	
	/**
	 * When destruct the object, we need to
	 * remove it from the instances array()
	 * We also switchBack to the last invoked context
	 * 
	 * @access public
	 * @return void
	 */
	public function __destruct()
	{
		if (static::$current === $this)
		{
			static::$current = end(static::$instances);
		}
		unset(static::$instances[$this->id]);
	}
	
}