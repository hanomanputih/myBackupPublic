<?php 
class role_detail_dao extends base_dao
{
	protected static $_instance = null;
	
	function __construct() {
		parent::__construct("role_detail");
	}
	
	final public static function getInstance(){
        if(null !== role_detail_dao::$_instance){
            return role_detail_dao::$_instance;
        }

        role_detail_dao::$_instance = new role_detail_dao();
        return role_detail_dao::$_instance;
    } 
}