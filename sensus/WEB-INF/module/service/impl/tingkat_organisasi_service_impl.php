<?php 
class tingkat_organisasi_service_impl extends base_service_impl{
	protected static $_instance = null;
	
	function __construct() {
		$this->dao = tingkat_organisasi_dao::getInstance();
	}
	
	final public static function getInstance(){
        if(null !== tingkat_organisasi_service_impl::$_instance){
            return tingkat_organisasi_service_impl::$_instance;
        }

        tingkat_organisasi_service_impl::$_instance = new tingkat_organisasi_service_impl();
        return tingkat_organisasi_service_impl::$_instance;
    } 
}