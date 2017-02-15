<?php 
include_once 'base_service_impl.php';
class user_service_impl extends base_service_impl{
	
	protected static $_instance = null;
	
	function __construct() {
		$this->dao = user_dao::getInstance();
	}
	
	final public static function getInstance(){
        if(null !== user_service_impl::$_instance){
            return user_service_impl::$_instance;
        }

        user_service_impl::$_instance = new user_service_impl();
        return user_service_impl::$_instance;
    } 
}