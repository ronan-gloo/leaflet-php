<?php

namespace Leaflet\Exception;

class InvalidJsVarNameException extends \Exception {
	
	protected $message = 'Variable name must be a non-numeric string, "%s" provided';
	
	public function __construct($message = '', $code = 0, \Exception $previous = null)
	{
		parent::__construct(sprintf($this->message, $message), $code, $previous);
	}
	
};