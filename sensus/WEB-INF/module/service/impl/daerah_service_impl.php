<?php 
class daerah_service_impl extends base_service_impl{
	protected static $_instance = null;
	
	function __construct() {
		$this->dao = daerah_dao::getInstance();
	}
	
	final public static function getInstance(){
        if(null !== daerah_service_impl::$_instance){
            return daerah_service_impl::$_instance;
        }

        daerah_service_impl::$_instance = new daerah_service_impl();
        return daerah_service_impl::$_instance;
    } 
}