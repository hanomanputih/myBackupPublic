<?php 
class role_dao extends base_dao
{
	protected static $_instance = null;
	
	function __construct() {
		parent::__construct("role");
	}
	
	final public static function getInstance(){
        if(null !== role_dao::$_instance){
            return role_dao::$_instance;
        }

        role_dao::$_instance = new role_dao();
        return role_dao::$_instance;
    } 
}