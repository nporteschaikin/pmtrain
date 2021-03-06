<?php

namespace Db;

class Connection {
	
	protected static $connection = null;
	
	public $conn;
	
	private $host;
	private $user;
	private $pass;
	private $db;
	
	public function __construct () {
		
		$this-> set_configuration ();
		$this-> create ();
		
	}
	
	public static function retrieve () {
		
		if ( static::$connection === null ) {
			static::$connection = new self;
		}
		
		return static::$connection;
		
	}
	
	private function set_configuration () {
		
		$config = \Config\Config::load ();
		$this->host = $config->mysql['host'];
		$this->user = $config->mysql['user'];
		$this->pass = $config->mysql['pass'];
		$this->db = $config->mysql['db'];
		
	}
	
	private function create () {
		
		// add support for environments
		$mysql = new \mysqli ( $this->host, $this->user, $this->pass, $this->db ) 
			or die ( $mysql->error );
		$this->conn = $mysql;
		
	}
	
	public function query ( $sql ) { 
		
		$connection = $this->conn;
		$query = $connection-> query ( $sql );
		return $query;
		
	}
	
	public function query_and_fetch ( $query, $one = false ) {
		
		$query = $this->query ( $query );
		$fetch = array ();
		if ( $one ) {
			$fetch = $query->fetch_array ( MYSQLI_ASSOC );
		} else {
			while ( $row = $query->fetch_array ( MYSQLI_ASSOC ) ) {
				array_push ( $fetch, $row );
			}
		}
		
		return $fetch;
		
	}
	
}