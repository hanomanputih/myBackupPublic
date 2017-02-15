<?php 
class kedatangan_service_impl extends base_service_impl{
	protected static $_instance = null;
	
	function __construct() {
		$this->dao = kedatangan_dao::getInstance();
	}
	
	final public static function getInstance(){
        if(null !== kedatangan_service_impl::$_instance){
            return kedatangan_service_impl::$_instance;
        }

        kedatangan_service_impl::$_instance = new kedatangan_service_impl();
        return kedatangan_service_impl::$_instance;
    } 
}