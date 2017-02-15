<?php 
class masjid_dao extends base_dao
{
	protected static $_instance = null;
	
	function __construct() {
		parent::__construct("masjid");
	}
	
	final public static function getInstance(){
        if(null !== masjid_dao::$_instance){
            return masjid_dao::$_instance;
        }

        masjid_dao::$_instance = new masjid_dao();
        return masjid_dao::$_instance;
    } 
}