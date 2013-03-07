<?php

namespace Db;

class Table {
	
	private $table_name;
	private $connection;
	
	public $columns = array ();
	public $primary_key;
	
	public function __construct ( $model_name, $new_record ) {
		
		$this-> create_connection ();
		$this-> set_table_name ( $model_name );
		$this-> set_columns ();
		$this-> set_primary_key ();
		
	}
	
	public static function init ( $model_name ) {
		
		$table = new Table ( $model_name, true );
		return $table;
		
	}
	
	private function create_connection () {
		
		$this->connection = Connection::retrieve ();
		
	}
	
	public function set_table_name ( $model_name ) {
		
		$this->table_name = strtolower ( $model_name );
		
	}
	
	private function set_columns () {
		
		$columns = array ();
		
		$connection = $this->connection;
		$sql = new Sql ( $this->table_name );
		$sql->get_columns ();
		$fetch = $connection->query_and_fetch ( $sql->str() );
		
		foreach ( $fetch as $column ) {
			array_push ( $columns, $column['Field'] );
		}
		
		$this->columns = $columns;
		
	}
	
	private function set_primary_key () {
		
		$connection = $this->connection;
		$sql = new Sql ( $this->table_name );
		$sql->get_primary_key ();
		$fetch = $connection->query_and_fetch ( $sql->str(), true );
		
		$this->primary_key = $fetch['Column_name'];
		
		return $this;
		
	}
	
	public function find () {
		
	
		
	}
	
	public function save ( $attrs, $new_record ) {
		
		$attrs = $this->process ( $attrs );
		
		$connection = $this->connection;
		$sql = new Sql ( $this->table_name );
		$new_record ? $sql-> insert ( $attrs ) : $sql-> update ( $attrs );
		$connection->query ( $sql-> str () );
		
	}
	
	private function process ( $attrs ) {
		
		$data = array ();
		
		foreach ( $attrs as $key => $value ) {
			
			if ( !in_array ( $key, $this->columns ) )
				continue;
				
			$data[$key] = $value;
			
		}
		
		return $data;
		
	}
	
}