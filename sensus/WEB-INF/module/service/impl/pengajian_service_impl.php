<?php 
class pengajian_service_impl extends base_service_impl{
	protected static $_instance = null;
	
	function __construct() {
		$this->dao = pengajian_dao::getInstance();
	}
	
	final public static function getInstance(){
        if(null !== pengajian_service_impl::$_instance){
            return pengajian_service_impl::$_instance;
        }

        pengajian_service_impl::$_instance = new pengajian_service_impl();
        return pengajian_service_impl::$_instance;
    } 
}