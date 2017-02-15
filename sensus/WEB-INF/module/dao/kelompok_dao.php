<?php 
class kelompok_dao extends base_dao
{
	protected static $_instance = null;
	
	function __construct() {
		parent::__construct("kelompok");
	}
	
	final public static function getInstance(){
        if(null !== kelompok_dao::$_instance){
            return kelompok_dao::$_instance;
        }

        kelompok_dao::$_instance = new kelompok_dao();
        return kelompok_dao::$_instance;
    }
}