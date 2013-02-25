<?php

namespace Leaflet\Util;

use ArrayObject;
use Leaflet\Core\Jsonable;

/**
 * Custom json conversion in order to support object serialization.
 * BaseCode from http://w3programming.wordpress.com/2012/10/26/overcoming-json_encode-limitations-in-php-5-3/
 */
class Json {

	public static function encode( $data, $flags = null) {
		
		if( is_array($data) && is_int(key($data)) ) {
			return '[' . self::implode($data, ',', function( $value, $key ) use($flags) {
					return self::encode($value, $flags);
				}) . ']';
		}
		elseif( is_array($data) ) {
			return '{' . self::implode($data, ',', function( $value, $key ) use($flags) {
					return (ctype_alnum($key) ? $key :'"'.$key.'"') . ':' . self::encode($value, $flags);
				}) . '}';
		}
		elseif( is_object($data) ) {
			return $data instanceof Jsonable
				? $data->toJson()
				: self::encode(get_object_vars($data), $flags);
		}
		else {
			return json_encode($data, $flags);
		}
	}
	public static function implode(array $arr, $delimiter=',', $callback=null ) {
		$callback   = $callback ?: function($value,$key) { return $value; };
		$result     = '';
		foreach( $arr as $key => $value ) {
			$result .= (empty($result) ? '' : $delimiter) . $callback($value, $key);
		}
		return $result;
	}
}