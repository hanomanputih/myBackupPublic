<?php 
class keluarga_dao extends base_dao
{
	protected static $_instance = null;
	
	function __construct() {
		parent::__construct("keluarga");
	}
	
	final public static function getInstance(){
        if(null !== keluarga_dao::$_instance){
            return keluarga_dao::$_instance;
        }

        keluarga_dao::$_instance = new keluarga_dao();
        return keluarga_dao::$_instance;
    } 
}