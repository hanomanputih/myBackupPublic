<?php 
class tingkat_organisasi_dao extends base_dao
{
	protected static $_instance = null;
	
	function __construct() {
		parent::__construct("tingkat_organisasi");
	}
	
	final public static function getInstance(){
        if(null !== tingkat_organisasi_dao::$_instance){
            return tingkat_organisasi_dao::$_instance;
        }

        tingkat_organisasi_dao::$_instance = new tingkat_organisasi_dao();
        return tingkat_organisasi_dao::$_instance;
    } 
}