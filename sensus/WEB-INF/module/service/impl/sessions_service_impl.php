<?php 
class sessions_service_impl extends base_service_impl{
	protected static $_instance = null;
	
	function __construct() {
		$this->dao = sessions_dao::getInstance();
	}
	
	final public static function getInstance(){
        if(null !== sessions_service_impl::$_instance){
            return sessions_service_impl::$_instance;
        }

        sessions_service_impl::$_instance = new sessions_service_impl();
        return sessions_service_impl::$_instance;
    } 
}