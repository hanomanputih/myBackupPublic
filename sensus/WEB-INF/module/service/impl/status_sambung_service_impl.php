<?php 
class status_sambung_service_impl extends base_service_impl{
	protected static $_instance = null;
	
	function __construct() {
		$this->dao = status_sambung_dao::getInstance();
	}
	
	final public static function getInstance(){
        if(null !== status_sambung_service_impl::$_instance){
            return status_sambung_service_impl::$_instance;
        }

        status_sambung_service_impl::$_instance = new status_sambung_service_impl();
        return status_sambung_service_impl::$_instance;
    } 
}