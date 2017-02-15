<?php 
class jenis_pengurus_dao extends base_dao
{
	protected static $_instance = null;
	
	function __construct() {
		parent::__construct("jenis_pengurus");
	}
	
	final public static function getInstance(){
        if(null !== jenis_pengurus_dao::$_instance){
            return jenis_pengurus_dao::$_instance;
        }

        jenis_pengurus_dao::$_instance = new jenis_pengurus_dao();
        return jenis_pengurus_dao::$_instance;
    } 
}