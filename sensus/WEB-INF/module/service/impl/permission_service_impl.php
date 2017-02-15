<?php 
class permission_service_impl extends base_service_impl{
	protected static $_instance = null;
	
	function __construct() {
		$this->dao = permission_dao::getInstance();
	}
	
	final public static function getInstance(){
        if(null !== permission_service_impl::$_instance){
            return permission_service_impl::$_instance;
        }

        permission_service_impl::$_instance = new permission_service_impl();
        return permission_service_impl::$_instance;
    } 
}