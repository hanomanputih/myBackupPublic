<?php 
class jenis_pengurus_service_impl extends base_service_impl{
	protected static $_instance = null;
	
	function __construct() {
		$this->dao = jenis_pengurus_dao::getInstance();
	}
	
	final public static function getInstance(){
        if(null !== jenis_pengurus_service_impl::$_instance){
            return jenis_pengurus_service_impl::$_instance;
        }

        jenis_pengurus_service_impl::$_instance = new jenis_pengurus_service_impl();
        return jenis_pengurus_service_impl::$_instance;
    } 
}