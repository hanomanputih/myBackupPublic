<?php 
class jamaah_dao extends base_dao
{
	protected static $_instance = null;
	
	function __construct() {
		parent::__construct("jamaah");
	}
	
	final public static function getInstance(){
        if(null !== jamaah_dao::$_instance){
            return jamaah_dao::$_instance;
        }

        jamaah_dao::$_instance = new jamaah_dao();
        return jamaah_dao::$_instance;
    } 
}