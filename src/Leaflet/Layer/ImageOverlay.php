<?php

namespace Leaflet\Layer;

use Leaflet\Core;

/**
 * Image Overlay Layer.
 * 
 * @extends Layer
 */
class ImageOverlay extends Core\Layer {
	
	const jsName = 'L.imageOverlay';
	
	/**
	 * @access public
	 * @param mixed $url: the image url
	 * @param array $bounds: the image coords array
	 * @return void
	 */
	public function __construct($url, array $bounds, array $options = array())
	{
		$this->setEvent();
		$this->setOptions($options);
		$this->event->constructor(array($url, $bounds, $this->options));
	}
	
}