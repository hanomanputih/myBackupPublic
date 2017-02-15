<?php 
include_once 'base_service_impl.php';
class timesheet_service_impl extends base_service_impl{
	
	protected static $_instance = null;
	
	function __construct() {
		$this->dao = timesheet_dao::getInstance();
	}
	
	final public static function getInstance(){
        if(null !== timesheet_service_impl::$_instance){
            return timesheet_service_impl::$_instance;
        }

        timesheet_service_impl::$_instance = new timesheet_service_impl();
        return timesheet_service_impl::$_instance;
    } 
}