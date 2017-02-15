<?php 
class permission_dao extends base_dao
{
	protected static $_instance = null;
	
	function __construct() {
		parent::__construct("permission");
	}
	
	final public static function getInstance(){
        if(null !== permission_dao::$_instance){
            return permission_dao::$_instance;
        }

        permission_dao::$_instance = new permission_dao();
        return permission_dao::$_instance;
    } 
}