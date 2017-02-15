<?php 
class desa_service_impl extends base_service_impl{
	protected static $_instance = null;
	
	function __construct() {
		$this->dao = desa_dao::getInstance();
	}
	
	final public static function getInstance(){
        if(null !== desa_service_impl::$_instance){
            return desa_service_impl::$_instance;
        }

        desa_service_impl::$_instance = new desa_service_impl();
        return desa_service_impl::$_instance;
    } 
}