<?php 
class status_sambung_dao extends base_dao
{
	protected static $_instance = null;
	
	function __construct() {
		parent::__construct("status_sambung");
	}
	
	final public static function getInstance(){
        if(null !== status_sambung_dao::$_instance){
            return status_sambung_dao::$_instance;
        }

        status_sambung_dao::$_instance = new status_sambung_dao();
        return status_sambung_dao::$_instance;
    } 
}