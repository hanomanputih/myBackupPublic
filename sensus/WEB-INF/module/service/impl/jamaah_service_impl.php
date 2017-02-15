<?php 
class jamaah_service_impl extends base_service_impl{
	protected static $_instance = null;
	
	function __construct() {
		$this->dao = jamaah_dao::getInstance();
	}
	
	final public static function getInstance(){
        if(null !== jamaah_service_impl::$_instance){
            return jamaah_service_impl::$_instance;
        }

        jamaah_service_impl::$_instance = new jamaah_service_impl();
        return jamaah_service_impl::$_instance;
    } 
}