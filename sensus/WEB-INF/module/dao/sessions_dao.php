<?php 
class sessions_dao extends base_dao
{
	protected static $_instance = null;
	
	function __construct() {
		parent::__construct("sessions");
	}
	
	final public static function getInstance(){
        if(null !== sessions_dao::$_instance){
            return sessions_dao::$_instance;
        }

        sessions_dao::$_instance = new sessions_dao();
        return sessions_dao::$_instance;
    } 
}