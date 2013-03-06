<?php

namespace Config;

class Config {
	
	protected static $config = null;
	
	public static function load () {
		
		if ( static::$config === null ) {
			static::$config = new self;
		}
		
		return static::$config;
		
	}
	
	function set_attribute ( $attr, $value ) {
		
		$this-> $attr = $value;
		
	}
	
}