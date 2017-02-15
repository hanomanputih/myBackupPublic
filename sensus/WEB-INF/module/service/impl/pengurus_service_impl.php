<?php 
class pengurus_service_impl extends base_service_impl{
	protected static $_instance = null;
	
	function __construct() {
		$this->dao = pengurus_dao::getInstance();
	}
	
	final public static function getInstance(){
        if(null !== pengurus_service_impl::$_instance){
            return pengurus_service_impl::$_instance;
        }

        pengurus_service_impl::$_instance = new pengurus_service_impl();
        return pengurus_service_impl::$_instance;
    } 
}