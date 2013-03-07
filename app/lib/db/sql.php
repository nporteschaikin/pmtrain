<?php

namespace Db;

class Sql {
	
	private $table_name;
	private $order;
	private $limit;
	private $sql;
	private $data;
	
	public function __construct ( $table_name ) {
	
		$this-> set_table_name ( $table_name );
		
	}
	
	private function set_table_name ( $table_name ) {
		
		$this->table_name = $table_name;
		
	}
	
	public function order ( $order ) {
		
		$this->order = $order;
		return $this;
		
	}
	
	public function limit ( $limit ) {
		
		$this->limit = $limit;
		return $this;
		
	}
	
	public function offset ( $offset ) {
		
		$this->offset = $offset;
		return $this;
		
	}
	
	public function insert ( $attrs ) {
		
		$this->operation = 'insert';
		$this->data = $attrs;
		return $this;
		
	}
	
	public function update ( $attrs ) {
		
		$this->operation = 'update';
		$this->data = $attrs;
		return $this;
		
	}
	
	public function select () {
		
		$this->operation = 'select';
		return $this;
		
	}
	
	public function get_columns () {
		
		$this->operation = 'columns';
		return $this;
		
	}
	
	public function get_primary_key () {
		
		$this->operation = 'primary_key';
		return $this;
		
	}
	
	public function construct () {
		if ( $this->operation ) {
			$function = 'construct_' . $this->operation;
			return $this->$function();
		}
		return false;
	}
	
	public function str () {
		return $this-> construct (); 
		
	}
	
	private function construct_select () {
		
		// select
		
	}
	
	private function construct_insert () {
		
		if ( $this->data ) {
			
			$keys = join ( ',', array_keys ( $this->data ) );
			$values = $this->insert_quoted_values ( $this->data );
			
			$sql = 'INSERT INTO ' . $this->table_name;
			$sql .= ' (' . $keys . ')';
			$sql .= ' VALUES (' . $values . ')';
			
			return $sql;
			
		}
		
	}
	
	private function construct_columns () {
		
		$sql = 'SHOW COLUMNS FROM ' . $this->table_name;
		return $sql;
		
	}
	
	private function construct_primary_key () {
		
		$sql = 'SHOW INDEX FROM ' . $this->table_name . ' WHERE key_name = "PRIMARY"';
		return $sql;
		
	}
	
	private function insert_quoted_values ( $attrs ) {
		
		return "'" . join ( "','", $attrs ) . "'";
		
	}
	
}