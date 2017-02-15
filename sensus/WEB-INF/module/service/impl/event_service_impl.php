<?php 
class event_service_impl extends base_service_impl{
	protected static $_instance = null;
	
	function __construct() {
		$this->dao = event_dao::getInstance();
	}
	
	final public static function getInstance(){
        if(null !== event_service_impl::$_instance){
            return event_service_impl::$_instance;
        }

        event_service_impl::$_instance = new event_service_impl();
        return event_service_impl::$_instance;
    } 
}