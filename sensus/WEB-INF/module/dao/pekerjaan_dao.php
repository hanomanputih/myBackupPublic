<?php 
class pekerjaan_dao extends base_dao
{
	protected static $_instance = null;
	
	function __construct() {
		parent::__construct("pekerjaan");
	}
	
	final public static function getInstance(){
        if(null !== pekerjaan_dao::$_instance){
            return pekerjaan_dao::$_instance;
        }

        pekerjaan_dao::$_instance = new pekerjaan_dao();
        return pekerjaan_dao::$_instance;
    } 
}