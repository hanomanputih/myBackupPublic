<?php 
class string_tools{
	/**
	 * @param String $str
	 * @return mengembalikan false jika $str null atau string kosong
	 */
	static function is_not_empty_or_null($str) {
		if(($str == "") OR (strlen($str) == 0)){
			return false;
		} else {
			return true;
		}
	}
	
	/**
	 * @param String $date format dd-mm-yyyy
	 * @return mengembalikan nilai date format yyyy/mm/dd
	 */
	static function reverseDateFormat($date){
		$partDate = explode("-", $date);
		return $partDate[2]."-".$partDate[1]."-".$partDate[0];
	}
	
	/**
	 * 
	 * @param date $date format yyyy-mm-dd hh:mm:ss
	 * @return mengembalikan data format dd/mm/yyyy hh:mm
	 */
	static function standardDateFormat($date) {
		if (!string_tools::is_not_empty_or_null($date))
			return false;
		
		list($d,$t) = explode(" ",$date);
		if (strlen($date) == 10)
			$d = $date;
		list($year,$month,$day) = explode("-",$d);
		$t="";
		return  $day."/".$month."/".$year . ((string_tools::is_not_empty_or_null($t)) ? " " . substr($t,0,5) : "");
	}
	
	/**
	 * same with Date.UTC(yyyy,mm,dd) in javascript
	 * @param $date mysql format %d-%m-%Y %H:%i:%s
	 */
	static function stringToTime($date){
		date_default_timezone_set('UTC');
		return (strtotime($date) * 1000) - (strtotime('01-01-1970 00:00:00') * 1000);
	}
	
	/**
	 * 
	 * Cek string start with
	 * @param $haystack = string
	 * @param $needle = yang dicek
	 */
	static function startsWith($haystack, $needle) {
	    $length = strlen($needle);
	    return (substr($haystack, 0, $length) === $needle);
	}
	
	/**
	 * 
	 * Cek string end with
	 * @param $haystack = string
	 * @param $needle = yang dicek
	 */
	static function endsWith($haystack, $needle) {
	    $length = strlen($needle);
	    if ($length == 0) {
	        return true;
	    }
	
	    return (substr($haystack, -$length) === $needle);
	}
	
	/**
	 * 
	 * Menambahkan backslash untuk single dan double quote
	 * @param string $string
	 * @return nilai string yang telah diberi backslash untuk single dan double quote
	 */
	static function addSlashes($string) {
		return preg_replace('/\'/', '\\\'',$string);
	}
	
	/**
	 * 
	 * Mengubah Strip ke Underscore
	 * @param string $url
	 */
	static function replaceStripToUnderscore($url) {
		return preg_replace('/_/', '-',$url);
	}

	/**
	 * 
	 * Mengubah Underscore ke Strip
	 * @param string $url
	 */
	static function replaceUnderscoreToStrip($url) {
		return preg_replace('/-/', '_',$url);
	}
	
	/**
	 * 
	 * Convert int to boolean
	 * @param int $int enum (0,1)
	 * @return true / false
	 */
	static function intToBool($int) {
		return $int == 1 ? true : false;
	}
	
	/**
	 * 
	 * implode 2 date dengan delimeter ' - '
	 * @param date $range
	 * return list($st,$en), array 'start' : H, 'end' : H+1
	 */
	static function between2Date($range) {
		list($st,$en) = explode(' - ', $range);
		list($d, $m, $y) = explode('/', $st);
		$mk=mktime(0, 0, 0, $m, $d, $y);
		$result[] = date("Y-m-d H:i:s", $mk);
		
		list($d, $m, $y) = explode('/', $en);
		$mk=mktime(0, 0, 0, $m, $d+1, $y);
		$result[] = date("Y-m-d H:i:s", $mk);
		return $result;
	}
	
	static function js2PhpTime($jsdate){
	  if(preg_match('@(\d+)/(\d+)/(\d+)\s+(\d+):(\d+)@', $jsdate, $matches)==1){
	    $ret = mktime($matches[4], $matches[5], 0, $matches[1], $matches[2], $matches[3]);
	    //echo $matches[4] ."-". $matches[5] ."-". 0  ."-". $matches[1] ."-". $matches[2] ."-". $matches[3];
	  }else if(preg_match('@(\d+)/(\d+)/(\d+)@', $jsdate, $matches)==1){
	    $ret = mktime(0, 0, 0, $matches[1], $matches[2], $matches[3]);
	    //echo 0 ."-". 0 ."-". 0 ."-". $matches[1] ."-". $matches[2] ."-". $matches[3];
	  }
	  return $ret;
	}
	
	static function php2JsTime($phpDate){
	    return date("m/d/Y H:i", $phpDate);
	}
	
	static function php2MySqlTime($phpDate){
	    return date("Y-m-d H:i:s", $phpDate);
	}
	
	static function mySql2PhpTime($sqlDate){
	    $arr = date_parse($sqlDate);
	    return mktime($arr["hour"],$arr["minute"],$arr["second"],$arr["month"],$arr["day"],$arr["year"]);
	}
}