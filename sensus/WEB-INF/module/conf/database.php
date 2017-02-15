<?php
class database 
{
	private $log = null;
	private $b_debugmode = true;
	private $conn = null;
	private $config = array(
					        'username' => 'root', 
					        'password' => '', 
					        'hostname' => 'ivan.server', 
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
        if(null !== database::$_instance){
            return database::$_instance;
        }
		
        database::$_instance = new database();
	    return database::$_instance;
        } 
    
	private function connect()
        {
        if (is_null($this->conn))
        {
        	$db = $this->config;
        	$this->conn = mysql_connect($db['hostname'], $db['username'], $db['password']);
        	
        	if(!$this->conn)
        	{
        		die("Cannot connect to database server");
        	}
        	
        	if(!mysql_select_db($db['database']))
        	{
        		die("Cannot select database");
        	}
        }
        return $this->conn;
        }
        
	private function close() 
		{
		mysql_close($this->conn);
		}
    
        function _die($message, $query) {
        if ($this->b_debugmode)
        	$message .= ' : (' . $query . ')';
        
        throw new Exception($message);
        }

        function execute_query($query)
        {
        $conn = $this->conn;
        return mysql_query($query, $conn) or $this->_die("Gagal Query " . mysql_error(), $query);
        }
        
	function insert_query($query)
        {
        $conn = $this->conn;
        $result = mysql_query($query, $conn);
        if ($result)
        	return mysql_insert_id();
        else 
        	return $this->_die("Gagal Query " . mysql_error(), $query);
        }
        
    function _fetch_array($result)
        {
        echo $result;
        exit();
        return mysql_fetch_array($result, MYSQL_BOTH);
        }
        
    function fetch_array($query) 
        {
        //echo $query;
        //exit();
        $result=array();
		$sqlExcec = mysql_query($query);
		if ($sqlExcec === FALSE) {
			if ($this->b_debugmode)
        		echo $message .= ' : (' . $query . ')';
			$this->log->logInfo("Gagal Query " . mysql_error(), $query);
        	return $result;
		}
		
		while ($itemArray=mysql_fetch_array($sqlExcec))
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
		$sqlExcec = mysql_query($query);
		if ($sqlExcec === FALSE) {
			if ($this->b_debugmode)
        		echo $message .= ' : (' . $query . ')';
			$this->log->logInfo("Gagal Query " . mysql_error(), $query);
        	return $result;
		}
		
		while ($itemObj=mysql_fetch_object($sqlExcec))
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
		$sqlExcec = mysql_query($query);
		if ($sqlExcec === FALSE) {
			if ($this->b_debugmode)
        		echo $message .= ' : (' . $query . ')';
			$this->log->logInfo("Gagal Query " . mysql_error(), $query);
        	return $result;
		}
		
		while ($itemRow=mysql_fetch_row($sqlExcec))
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
		$sqlExcec = mysql_query($query);
		if ($sqlExcec === FALSE) {
			if ($this->b_debugmode)
        		echo $message .= ' : (' . $query . ')';
			$this->log->logInfo("Gagal Query " . mysql_error(), $query);
        	return 0;
		}
        $result = mysql_num_rows($sqlExcec);
        return $result;
 		}
}
