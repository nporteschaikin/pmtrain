<?php

namespace Db;

class Model {
	
	private $attrs = array();
	private $new_record = true;
	
	static $accessible = array ();
	static $protected = array ();
	
	public static function class_name () {
		
		return get_called_class ();
		
	}
	
	public static function table () {
		
		return Table::init ( static::class_name () );
		
	}
	
	public function __construct ( array $attrs = array (), $new_record = true ) {
	
		$this->new_record = $new_record;
		$this->set_attributes ( $attrs );
		
	}
	
	public function __set ( $attr, $value ) {
		
		$this->assign_attribute ( $attr, $value );
		
	}
	
	private function set_attributes ( array $attrs, $protect = true ) {
		
		foreach ( $attrs as $attr => $value ) {
			
			$this->assign_attribute ( $attr, $value );
			
		} 
		
	}
	
	private function assign_attribute ( $attr, $value ) {
		
		$this->$attr = $value;
		$this->attributes[$attr] = $value;
		
	}
	
	public static function find () {
		
		$arguments = func_get_args ();
		$num_arguments = func_num_args ();
		
		if ( $num_arguments == 1 ) 
			// select by primary key
		else
			// second parameter is options
			
		
		// $class = static::class_name ();
		// $table = static::table ();
		// 
		// $attrs = $table->find ( $primary_key_value );
		// $model = new $class ( $attrs, false );
		// return $model;
		
	}
	
	public static function create ( array $attrs = array ()  ) {
		
		$class = static::class_name ();
		$model = new $class ( $attrs );
		return $model;
		
	}
	
	public function save () {
		
		$table = static::table();
		$table->save ( $this->attributes, $this->new_record );
		
	}
	
	public function update ( array $attrs = array () ) {
		
		$this->set_attributes ( $attrs );
		
	}
	
}
