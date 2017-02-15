<?php
include_once  "WEB-INF/controller/base_controller.php";

class sessions_aksi extends base_controller {
	public function __construct($command){
		$this->titleClass = "sessions";
		parent::__construct("sessions",$command);
	}
	
	public function read($newid,$time) {
		$this->model->set_select_full_suffix("id_session = '" . $newid . "' AND expires > " . $time);
		$rows = $this->svc->select($this->model);
		return $rows;
	}
	
	public function write($newid,$newdata,$time) {
		$sql = "REPLACE sessions (id_session, data, expires) VALUES ('" . $newid . "','" . $newdata . "'," . $time . ")";
		try {
			$this->svc->execute_query($sql);
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}
	
	public function destroy($oldid) {
		$this->model->set_id_session(array($oldid));
		try {
			$this->svc->delete($this->model);
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}
	
	public function gc() {
		$sql = "DELETE FROM sessions WHERE expires < UNIX_TIMESTAMP();";
		try {
			$this->svc->execute_query($sql);
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}
}
?>