<?php 
class role_detail_service_impl extends base_service_impl{
	protected static $_instance = null;
	
	function __construct() {
		$this->dao = role_detail_dao::getInstance();
	}
	
	final public static function getInstance(){
        if(null !== role_detail_service_impl::$_instance){
            return role_detail_service_impl::$_instance;
        }

        role_detail_service_impl::$_instance = new role_detail_service_impl();
        return role_detail_service_impl::$_instance;
    } 
}