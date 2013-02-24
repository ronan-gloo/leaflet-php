<?php

namespace Leaflet\Core;

/**
 * Queue implementation.
 */
interface IBuilder {
	
	/**
	 * Invoke the compilation to javascript.
	 * 
	 * @access public
	 * @return String generated javascript
	 */
	public function build();
	
	/**
	 * Set the javascipt base var name.
	 * When developer doesn't provide an explicit
	 * variable name, the builder base name is used.
	 * Each time a new Leaflet class is instanciated,
	 * a new incremented reference from this base is generated.
	 * 
	 * @access public
	 * @param mixed $ref: the ref basename
	 * @return $this
	 */
	public function setRefName($ref);
	
	/**
	 * Set base ref incrementation.
	 * Must be something compatible with $inc++
	 * 
	 * @access public
	 * @param mixed $inc
	 * @return void
	 */
	public function setRefIncrement($inc);
	
	/**
	 * Set json_encode flags.
	 * 
	 * @access public
	 * @param mixed $flags
	 * @return void
	 */
	public function setJsonFlags($flags);
	
	/**
	 * get the ref basename.
	 * 
	 * @access public
	 * @return String
	 */
	public function getRefName();
	
	/**
	 * Get the Ouput string.
	 * 
	 * @access public
	 * @return String
	 */
	public function output();
	
	/**
	 * Set the builder queue.
	 * 
	 * @access public
	 * @param IQueue $queue
	 * @return void
	 */
	public function setQueue(IQueue $queue);
}