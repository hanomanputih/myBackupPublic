<?php
require_once 'WEB-INF/controller/sessions_aksi.php';
class session_manager {
	var $life_time;
	var $sess_aksi;
	
	
	function session_manager() {
		//create obj controller
		$this->sess_aksi = new sessions_aksi($command);
		
		//baca setting maxlifetime dari PHP
		$this->life_time = get_cfg_var("session.gc_maxlifetime");

		//registrasikan fungsi yang akan dipanggil pada saat
		//terjadi proses baca tulis session
		session_set_save_handler(
		array(&$this, "open"),
		array(&$this, "close"),
		array(&$this, "read"),
		array(&$this, "write"),
		array(&$this, "destroy"),
		array(&$this, "gc")
		);
	}
	 
	function open($save_path, $session_name) {
		global $sess_save_path;
		$sess_save_path = $save_path;
		return true;
	}

	function close() {
		return true;
	}

	function read($id) {
		$data = '';
		$time = time();
		$newid = mysql_real_escape_string($id);
		$rows = $this->sess_aksi->read($newid, $time);
		if (count($rows) > 0)
		{
			$data = $rows[0][1];
		}
		return $data;
	}

	function write($id, $data) {
		if ($data == '')
			return true;
		
		$time = time() + $this->life_time;
		$newid = mysql_real_escape_string($id);
		$newdata = mysql_real_escape_string($data);
		$this->sess_aksi->write($newid, $newdata, $time);
		return true;
	}

	function destroy($id) {
		$oldid = mysql_real_escape_string($id);
		$this->sess_aksi->destroy($oldid);
		return true;
	}

	function gc() {
		$this->sess_aksi->gc();
		return true;
	}
}
?>