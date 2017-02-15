<?php 
class pekerjaan_service_impl extends base_service_impl{
	protected static $_instance = null;
	
	function __construct() {
		$this->dao = pekerjaan_dao::getInstance();
	}
	
	final public static function getInstance(){
        if(null !== pekerjaan_service_impl::$_instance){
            return pekerjaan_service_impl::$_instance;
        }

        pekerjaan_service_impl::$_instance = new pekerjaan_service_impl();
        return pekerjaan_service_impl::$_instance;
    } 
}