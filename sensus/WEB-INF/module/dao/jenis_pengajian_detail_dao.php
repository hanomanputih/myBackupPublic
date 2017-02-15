<?php 
class jenis_pengajian_detail_dao extends base_dao
{
	protected static $_instance = null;
	
	function __construct() {
		parent::__construct("jenis_pengajian_detail");
	}
	
	final public static function getInstance(){
        if(null !== jenis_pengajian_detail_dao::$_instance){
            return jenis_pengajian_detail_dao::$_instance;
        }

        jenis_pengajian_detail_dao::$_instance = new jenis_pengajian_detail_dao();
        return jenis_pengajian_detail_dao::$_instance;
    } 
}