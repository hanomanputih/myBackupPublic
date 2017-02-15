<?php 
class keluarga_service_impl extends base_service_impl{
	protected static $_instance = null;
	
	function __construct() {
		$this->dao = keluarga_dao::getInstance();
	}
	
	final public static function getInstance(){
        if(null !== keluarga_service_impl::$_instance){
            return keluarga_service_impl::$_instance;
        }

        keluarga_service_impl::$_instance = new keluarga_service_impl();
        return keluarga_service_impl::$_instance;
    } 
}