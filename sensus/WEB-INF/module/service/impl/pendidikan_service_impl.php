<?php 
class pendidikan_service_impl extends base_service_impl{
	protected static $_instance = null;
	
	function __construct() {
		$this->dao = pendidikan_dao::getInstance();
	}
	
	final public static function getInstance(){
        if(null !== pendidikan_service_impl::$_instance){
            return pendidikan_service_impl::$_instance;
        }

        pendidikan_service_impl::$_instance = new pendidikan_service_impl();
        return pendidikan_service_impl::$_instance;
    } 
}