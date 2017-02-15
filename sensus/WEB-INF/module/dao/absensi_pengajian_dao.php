<?php 
class absensi_pengajian_dao extends base_dao
{
	protected static $_instance = null;
	
	function __construct() {
		parent::__construct("absensi_pengajian");
	}
	
	final public static function getInstance(){
        if(null !== absensi_pengajian_dao::$_instance){
            return absensi_pengajian_dao::$_instance;
        }

        absensi_pengajian_dao::$_instance = new absensi_pengajian_dao();
        return absensi_pengajian_dao::$_instance;
    } 
}