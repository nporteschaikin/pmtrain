<?php

namespace Db;

class Table {
	
	private $table_name;
	private $connection;
	
	public function __construct ( $model_name, $new_record ) {
		
		$this-> create_connection ();
		$this-> set_table_name ( $model_name );
		
	}
	
	public static function init ( $model_name ) {
		
		$table = new Table ( $model_name, true );
		return $table;
		
	}
	
	private function create_connection () {
		
		$this->connection = Connection::retrieve ();
		
	}
	
	public function set_table_name ( $model_name ) {
		
		// Rails/ActiveRecord would pluralize the word.
		// For now, we'll just strtolower.
		// There is an Inflector framework 
		// that would do this right.
		$this->table_name = strtolower ( $model_name );
		
	}
	
	public function columns () {
		
	}
	
	public function save ( $attrs, $new_record ) {
		
		$connection = $this->connection;
		$sql = new Sql ( $this->table_name );
		$new_record ? $sql-> insert ( $attrs ) : $sql-> update ( $attrs );
		$connection->query ( $sql-> str () );
		
	}
	
}