<?php
class mysqlid 
{
	private $log = null;
	private $b_debugmode = false;
	private $conn = null;
	private $config = array(
					        'username' => 'root', 
					        'password' => '',
					        'hostname' => '127.0.0.1', 
					        'database' => 'jokam' 
					        );
	private static $_instance;
        
    function __construct()
        {
        $this->log = new KLogger('log/db', KLogger::DEBUG);
        $this->connect();
        }
        
	final public static function getInstance()
        {
        if(null !== mysqlid::$_instance){
            return mysqlid::$_instance;
        }
		
        mysqlid::$_instance = new mysqlid();
	    return mysqlid::$_instance;
        } 
    
	private function connect()
        {
        if (is_null($this->conn))
        {
        	$db = $this->config;
        	$this->conn = new mysqli($db['hostname'], $db['username'], $db['password'], $db['database']);
        	
        	if($this->conn->connect_errno)
        	{
        		die("Failed to connect to MySQL: (" . $this->conn->connect_errno . ") " . $this->conn->connect_error);
        	}        	
        }
        return $this->conn;
        }
        
	private function close() 
		{
		$this->conn->close();
		}
    
        function _die($message, $query) {
        if ($this->b_debugmode)
        	$message .= ' : (' . $query . ')';
        
        throw new Exception($message);
        }

        function execute_query($query)
        {
        $conn = $this->conn;
        return $conn->query($query) or $this->_die("Gagal Query " . $conn->error, $query);
        }
        
	function insert_query($query)
        {
        $conn = $this->conn;
        $result = $conn->query($query);
        if ($result)
        	return $conn->insert_id;
        else 
        	return $this->_die("Gagal Query " . $this->conn->error, $query);
        }
        
    function _fetch_array($result)
        {
        echo $result;
        exit();
        return mysqli_fetch_array($result, MYSQL_BOTH);
        }
        
    function fetch_array($query) 
        {
        $result=array();
		$sqlExcec = $this->conn->query($query);
		if ($sqlExcec === FALSE) {
			if ($this->b_debugmode)
        		echo $message .= ' : (' . $query . ')';
			$this->log->logInfo("Gagal Query " . $this->conn->error, $query);
        	return $result;
		}
		
		while ($itemArray=mysqli_fetch_array($sqlExcec))
		{
			$result[]=$itemArray;
		}
            
        if (mysql_errno() and $b_debugmode) {
        	echo  $query . "<br>";
        }
        
		return $result;
        }
        
	function select_object($query) 
		{
        $result=array();
		$sqlExcec = $this->conn->query($query);
		if ($sqlExcec === FALSE) {
			if ($this->b_debugmode)
        		echo $message .= ' : (' . $query . ')';
			$this->log->logInfo("Gagal Query " . $this->conn->error, $query);
        	return $result;
		}
		
		while ($itemObj=mysqli_fetch_object($sqlExcec))
		{
			$result[]=$itemObj;
		}
            
        if (mysql_errno() and $b_debugmode) {
        	echo  $query . "<br>";
        }
        
		return $result;
		}
                
    function fetch_row($query) 
        {
        $result=array();
		$sqlExcec = $this->conn->query($query);
		if ($sqlExcec === FALSE) {
			if ($this->b_debugmode)
        		echo $message .= ' : (' . $query . ')';
			$this->log->logInfo("Gagal Query " . $this->conn->error, $query);
        	return $result;
		}
		
		while ($itemRow=mysqli_fetch_row($sqlExcec))
		{
			$result[]=$itemRow;
		}
            
		if (mysql_errno() and $b_debugmode) {
        	echo  $query . "<br>";
        }
        
		return $result;
        }

	function hitung_row($query)
        {
		$sqlExcec = $this->conn->query($query);
		if ($sqlExcec === FALSE) {
			if ($this->b_debugmode)
        		echo $message .= ' : (' . $query . ')';
			$this->log->logInfo("Gagal Query " . $this->conn->error, $query);
        	return 0;
		}
        $result = mysqli_num_rows($sqlExcec);
        return $result;
 		}
}
