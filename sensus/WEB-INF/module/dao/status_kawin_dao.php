<?php 
class status_kawin_dao extends base_dao
{
	protected static $_instance = null;
	
	function __construct() {
		parent::__construct("status_kawin");
	}
	
	final public static function getInstance(){
        if(null !== status_kawin_dao::$_instance){
            return status_kawin_dao::$_instance;
        }

        status_kawin_dao::$_instance = new status_kawin_dao();
        return status_kawin_dao::$_instance;
    } 
}