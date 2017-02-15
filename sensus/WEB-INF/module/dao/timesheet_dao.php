<?php 
class timesheet_dao extends base_dao
{
	protected static $_instance = null;
	
	function __construct() {
		parent::__construct("timesheet");
	}
	
	final public static function getInstance(){
        if(null !== timesheet_dao::$_instance){
            return timesheet_dao::$_instance;
        }

        timesheet_dao::$_instance = new timesheet_dao();
        return timesheet_dao::$_instance;
    } 
}