<?php

namespace Leaflet\Control;

use Closure;
use Leaflet\Core\Detachable;
use Leaflet\Core\Layer;
use Leaflet\Map;

class Control extends Layer implements Detachable {
	
	const jsName = 'L.control';
	
	/**
	 * SetupClass events
	 * 
	 * @access public
	 * @return void
	 */
	public function update(Closure $closure)
	{
		$this->useRef();
		$this->event->callback('update', $closure);
		return $this;
	}
	
	/**
	 * @access public
	 * @param mixed $position
	 * @return void
	 */
	public function __construct(array $options = array())
	{
		$this->setEvent();
		$this->setOptions($options);
		
		$this->event->constructor(array($this->options));
	}
	
	
	/**
	 * @access public
	 * @param Map $orig
	 * @return void
	 */
	public function removeFrom(Map $orig)
	{
		$this->event->method('removeFrom', $orig);
		return $this;
	}
	
}
