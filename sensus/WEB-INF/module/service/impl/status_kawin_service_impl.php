<?php 
class status_kawin_service_impl extends base_service_impl{
	protected static $_instance = null;
	
	function __construct() {
		$this->dao = status_kawin_dao::getInstance();
	}
	
	final public static function getInstance(){
        if(null !== status_kawin_service_impl::$_instance){
            return status_kawin_service_impl::$_instance;
        }

        status_kawin_service_impl::$_instance = new status_kawin_service_impl();
        return status_kawin_service_impl::$_instance;
    } 
}