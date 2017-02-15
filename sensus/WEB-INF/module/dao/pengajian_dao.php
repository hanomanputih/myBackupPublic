<?php 
class pengajian_dao extends base_dao
{
	protected static $_instance = null;
	
	function __construct() {
		parent::__construct("pengajian");
	}
	
	final public static function getInstance(){
        if(null !== pengajian_dao::$_instance){
            return pengajian_dao::$_instance;
        }

        pengajian_dao::$_instance = new pengajian_dao();
        return pengajian_dao::$_instance;
    } 
}