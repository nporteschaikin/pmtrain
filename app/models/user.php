<?php

class User extends Db\Model {
	
	static $accessible = array ( "firstname", "lastname" );
	
}