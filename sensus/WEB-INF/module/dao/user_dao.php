<?php 
class user_dao extends base_dao
{
	protected static $_instance = null;
	
	function __construct() {
		parent::__construct("user");
	}
	
	final public static function getInstance(){
        if(null !== user_dao::$_instance){
            return user_dao::$_instance;
        }

        user_dao::$_instance = new user_dao();
        return user_dao::$_instance;
    } 
}