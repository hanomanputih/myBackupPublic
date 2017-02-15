<?php 
class jenis_pengajian_service_impl extends base_service_impl{
	protected static $_instance = null;
	
	function __construct() {
		$this->dao = jenis_pengajian_dao::getInstance();
	}
	
	final public static function getInstance(){
        if(null !== jenis_pengajian_service_impl::$_instance){
            return jenis_pengajian_service_impl::$_instance;
        }

        jenis_pengajian_service_impl::$_instance = new jenis_pengajian_service_impl();
        return jenis_pengajian_service_impl::$_instance;
    } 
}