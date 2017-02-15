<?php 
class status_jamaah_service_impl extends base_service_impl{
	protected static $_instance = null;
	
	function __construct() {
		$this->dao = status_jamaah_dao::getInstance();
	}
	
	final public static function getInstance(){
        if(null !== status_jamaah_service_impl::$_instance){
            return status_jamaah_service_impl::$_instance;
        }

        status_jamaah_service_impl::$_instance = new status_jamaah_service_impl();
        return status_jamaah_service_impl::$_instance;
    } 
}