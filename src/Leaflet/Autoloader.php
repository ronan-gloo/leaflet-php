<?php

namespace Leaflet;

class Autoloader {
	
	public static function register()
  {
	  spl_autoload_register(array(new self, 'autoload'));
  }

  static public function autoload($class)
  {
    if (strncmp($class, 'Leaflet', 7) !== 0) {
        return;
    }

    if (file_exists($file = __DIR__ . '/../' . strtr($class, '\\', '/').'.php')) {
        require $file;
    }
  }
}