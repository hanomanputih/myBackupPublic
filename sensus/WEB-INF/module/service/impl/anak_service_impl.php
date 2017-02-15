<?php 
class anak_service_impl extends base_service_impl{
	protected static $_instance = null;
	
	function __construct() {
		$this->dao = anak_dao::getInstance();
	}
	
	final public static function getInstance(){
        if(null !== anak_service_impl::$_instance){
            return anak_service_impl::$_instance;
        }

        anak_service_impl::$_instance = new anak_service_impl();
        return anak_service_impl::$_instance;
    } 
}