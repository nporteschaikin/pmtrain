<?php

namespace Db;

class Model {
	
	private $attrs = array();
	private $new_record = true;
	
	static $accessible = array ();
	
	public static function class_name () {
		
		return get_called_class ();
		
	}
	
	public static function table () {
		
		return Table::init ( static::class_name () );
		
	}
	
	public function __construct ( array $attrs = array (), $new_record = true ) {
	
		$this->new_record = $new_record;
		$this-> set_attributes ( $attrs );
		
	}
	
	private function set_attributes ( array $attrs, $protect = true ) {
		
		foreach ( $attrs as $attr => $value ) {
			
			$this->$attr = $value;
			$this->attributes[$attr] = $value;
			
		}
		
	}
	
	public static function create ( array $attrs = array ()  ) {
		
		$class = static::class_name ();
		$model = new $class ( $attrs );
		return $model;
		
	}
	
	public function save ( array $attrs = array () ) {
		
		$table = static::table ();
		$table-> save ( $this->attributes, $this->new_record );
		
	}
	
	public function update ( array $attrs = array () ) {
		
		$this-> set_attributes ( $attrs );
		
	}
	
}
