<?php 
class role_service_impl extends base_service_impl{
	protected static $_instance = null;
	
	function __construct() {
		$this->dao = role_dao::getInstance();
	}
	
	final public static function getInstance(){
        if(null !== role_service_impl::$_instance){
            return role_service_impl::$_instance;
        }

        role_service_impl::$_instance = new role_service_impl();
        return role_service_impl::$_instance;
    } 
}