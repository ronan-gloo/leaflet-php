<?php

namespace Leaflet\Core;

/**
 * Queue implementation.
 */
interface IQueue {
	
	public function register(ObjectEvent $element, $new = true);
	
/*
	public function getObject();
		
	public function getMethods();
	
	public function getConstructor();
	
	public function constructor($args = array());
	
	public function method($name, $arguments = null);
	
	public function callback($name, $callback);
	
	public function isEmpty();
*/
	
}