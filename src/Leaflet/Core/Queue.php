<?php

namespace Leaflet\Core;

class Queue extends \splQueue implements IQueue {
		
	/**
	 * Register a new element in the queue
	 * @access public
	 * @param mixed $element
	 * @param bool $new (default: true)
	 * @return void
	 */
	public function register(ObjectEvent $object, $new = true)
	{
		$type = $new ? $object::typeNew : $object::typeRef;
		
		$this->enqueue((object)array(
			'instance'=> $object,
			'type'		=> $type
		));
		
		// Set the queue ref index, for further manipulations
		$object->setIndex($this->count() -1);
		
		return $this;
	}
}