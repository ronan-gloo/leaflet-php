<?php

namespace Leaflet\Core;

use Leaflet\Ifunc;
use Leaflet\Util\Json;
use Leaflet\Util\Option;
use Leaflet\Exception\InvalidJsVarNameException;

/**
 * Transform JS\Queue instances to javascript strings.
 */
class Builder implements IBuilder {
	
	/**
	 * @var mixed
	 * @access protected
	 */
	protected $queue;
	
	/**
	 * The default identifier if doens't provided
	 * 
	 * (default value: 'item')
	 * 
	 * @var string
	 * @access protected
	 */
	public $identifier = 'leafl';
	
	/**
	 * (default value: null)
	 * 
	 * @var mixed
	 * @access public
	 */
	public $jsonFlags = null;
	
	/**
	 * Base ref incrementation
	 * 
	 * (default value: 0)
	 * 
	 * @var int
	 * @access public
	 */
	public $increment = 0;
	
	/**
	 * (default value: '')
	 * 
	 * @var string
	 * @access protected
	 */
	protected $output = '';

    /**
     * @param mixed $ref
     * @return $this
     * @throws \Leaflet\Exception\InvalidJsVarNameException
     */
    public function setRefName($ref)
	{
		if (is_string($ref) and ! is_numeric($ref))
		{
			$this->identifier = trim($ref);
		}
		else
		{
			throw new InvalidJsVarNameException($ref);
		}
		return $this;
	}

    /**
     * @param mixed $inc
     * @return $this
     */
    public function setRefIncrement($inc)
	{
		$this->increment = $inc;
		return $this;
	}
	
	/**
	 * @access public
	 * @param mixed $flags
	 * @return $this
	 */
	public function setJsonFlags($flags)
	{
		$this->jsonFlags = $flags;
		return $this;
	}
	
	/**
	 * See interface doc
	 * 
	 * @access public
	 */
	public function getRefName()
	{
		return $this->identifier;
	}

    /**
     * @param IQueue $queue
     */
    public function setQueue(IQueue $queue)
	{
		$this->queue = $queue;
	}

	/**
	 * @access public
	 * @return string
	 */
	public function build()
	{
		$this->output = '';
		
		if (! $this->queue->isEmpty())
		{
			// Set build context
			foreach ($this->queue as $element)
			{
				$this->output .= $this->buildElement($element);
			}
		}
		return $this->output;
	}

    /**
     * @param $item
     * @return string
     */
    public function buildElement($item)
	{
		$instance = $item->instance;
		$element	= $instance->getObject();
		$output		= '';
		
		// Create an identifier if not found
		// according the current queue position
		if (null === ($identifier = $element->getRef()))
		{
			// Used later by the buildArguments() method
			$identifier = $this->identifier.$this->increment++;
			$element->setRef($identifier);
		}
		
		// Type: creates a new var or call it
		switch ($item->type)
		{
			case $instance::typeNew:
			// define the variable if identifier is not false
			if ( $identifier !== false)
			{
				$output .= 'var '.$identifier.' = ';
			}
			// add the class name
			$output .= $element->jsName();
			// setup the constructor parameters if found
			$output .= $this->buildArguments($instance->getConstructor());
			break;
			
			case $instance::typeRef:
			$output .= $identifier;
			break;
		}
		// Setup methods
		$output .= $this->buildMethods($instance);
		// close the chained object
		$output .= ';'."\n";
		
		return $output;
	}

    /**
     * @param ObjectEvent $instance
     * @return string
     */
    public function buildMethods(ObjectEvent $instance)
	{
		$chain = '';
		
		if ($methods = $instance->getMethods())
		{
			foreach ($methods as $method)
			{
				// Check if arg is func
				$args = $method->arguments instanceof Ifunc
					? ' = '.$method->arguments->toJson()
					: $this->buildArguments($method->arguments);

				$chain .= '.'.$method->name.$args;
			}
		}
		return $chain;
	}

    /**
     * @param $parameters
     * @return string
     */
    protected function buildArguments($parameters)
	{
		$arguments = array();
		
		if ($parameters)
		{
			foreach ($parameters as $param)
			{
				$param and $arguments[] = Json::encode($param, $this->jsonFlags);
			}
		}
		return '('. ($arguments ? implode(',', $arguments) : '') . ')';
	}

    /**
     * @return string
     */
    public function output()
	{
		return $this->output;
	}
}