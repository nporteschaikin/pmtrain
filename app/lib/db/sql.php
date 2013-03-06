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
	
	public function construct_select () {
		
		$sql = 'SELECT';
		
	}
	
	public function construct_insert () {
		
		if ( $this->data ) {
			
			$keys = join ( ',', array_keys ( $this->data ) );
			$values = $this->insert_quoted_values ( $this->data );
			
			$sql = 'INSERT INTO ' . $this->table_name;
			$sql .= ' (' . $keys . ')';
			$sql .= ' VALUES (' . $values . ')';
			
			return $sql;
			
		}
		
	}
	
	private function insert_quoted_values ( $attrs ) {
		
		return "'" . join ( "','", $attrs ) . "'";
		
	}
	
}