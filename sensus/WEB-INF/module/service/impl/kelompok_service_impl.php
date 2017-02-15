<?php 
class kelompok_service_impl extends base_service_impl{
	protected static $_instance = null;
	
	function __construct() {
		$this->dao = kelompok_dao::getInstance();
	}
	
	final public static function getInstance(){
        if(null !== kelompok_service_impl::$_instance){
            return kelompok_service_impl::$_instance;
        }

        kelompok_service_impl::$_instance = new kelompok_service_impl();
        return kelompok_service_impl::$_instance;
    } 
}