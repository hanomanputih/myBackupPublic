<?php 
class status_jamaah_dao extends base_dao
{
	protected static $_instance = null;
	
	function __construct() {
		parent::__construct("status_jamaah");
	}
	
	final public static function getInstance(){
        if(null !== status_jamaah_dao::$_instance){
            return status_jamaah_dao::$_instance;
        }

        status_jamaah_dao::$_instance = new status_jamaah_dao();
        return status_jamaah_dao::$_instance;
    } 
}