<?php 
class absensi_pengajian_service_impl extends base_service_impl{
	protected static $_instance = null;
	
	function __construct() {
		$this->dao = absensi_pengajian_dao::getInstance();
	}
	
	final public static function getInstance(){
        if(null !== absensi_pengajian_service_impl::$_instance){
            return absensi_pengajian_service_impl::$_instance;
        }

        absensi_pengajian_service_impl::$_instance = new absensi_pengajian_service_impl();
        return absensi_pengajian_service_impl::$_instance;
    } 
}