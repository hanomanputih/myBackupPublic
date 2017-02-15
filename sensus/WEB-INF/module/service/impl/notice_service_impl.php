<?php 
class notice_service_impl extends base_service_impl{
	protected static $_instance = null;
	
	function __construct() {
		$this->dao = notice_dao::getInstance();
	}
	
	final public static function getInstance(){
        if(null !== notice_service_impl::$_instance){
            return notice_service_impl::$_instance;
        }

        notice_service_impl::$_instance = new notice_service_impl();
        return notice_service_impl::$_instance;
    } 
}