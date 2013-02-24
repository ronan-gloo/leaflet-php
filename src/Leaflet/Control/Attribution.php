<?php

namespace Leaflet\Control;

/**
 * @extends ControlAbstract
 */
class Attribution extends Control {
	
	const jsName = 'L.control.attribution';
	
	/**
	 * Sets the text before the attributions
	 *
	 * @access public
	 * @param mixed $prefix
	 * @return $this
	 */
	public function setPrefix($prefix)
	{
		if (is_scalar($prefix))
		{
			$this->event->method('setPrefix', $prefix);
		}
	}
	
	/**
	 * @access public
	 * @param mixed $text
	 * @return void
	 */
	public function addAttribution($text)
	{
		if (is_scalar($text))
		{
			$this->event->method('addAttribution', $text);
		}
		return $this;
	}
	
	/**
	 * @access public
	 * @param mixed $text
	 * @return void
	 */
	public function removeAttribution($text)
	{
		if (is_scalar($text))
		{
			$this->event->method('removeAttribution', $text);
		}
		return $this;
	}
	
}