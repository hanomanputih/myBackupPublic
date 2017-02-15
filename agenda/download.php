<?php
@ini_set("display_errors","1");
@ini_set("display_startup_errors","1");

include("include/dbcommon.php");

$table = postvalue("table");
$strTableName = GetTableByShort($table);

if (!checkTableName($table))
{
	exit(0);
}

include("include/".$table."_variables.php");


if(!@$_SESSION["UserID"] || !CheckSecurity(@$_SESSION["_".$strTableName."_OwnerID"],"Search"))
{ 
	header("Location: login.php"); 
	return;
}

$field = postvalue("field");

//	check permissions
if(!CheckFieldPermissions($field))
	return;
	
$fieldsArr = GetFieldsList($strTableName);	

foreach ($fieldsArr as $f)
{
	$fViewFormat = GetFieldData($strTableName, $f, 'ViewFormat', false);
	if ($field == $f && $fViewFormat != FORMAT_FILE)
	{
		exit(0);
	}
}

//	construct sql
$keysArr = GetTableData($strTableName, '.Keys', array());
$keys = array();
foreach ($keysArr as $ind=>$k)
{	
	$keys[$k]=postvalue("key".($ind+1));
}
$where=KeyWhere($keys);


$secOpt = GetTableData($strTableName, '.nSecOptions', ADVSECURITY_NONE);
if ($secOpt == ADVSECURITY_VIEW_OWN)
{
	$where=whereAdd($where,SecuritySQL("Search"));	
}

$sql = gSQLWhere($where);


$rs = db_query($sql,$conn);
if(!$rs)
  return;

$data=db_fetch_array($rs);


if(!$data)
	return;

$filename=$data[$field];
$ext=substr($filename,strlen($filename)-4);


switch($ext)
{
	case ".asf":
		$ctype = "video/x-ms-asf";
	case ".avi":
		$ctype = "video/avi";
	case ".doc":
		$ctype = "application/msword";
	case ".zip":
		$ctype = "application/zip";
	case ".xls":
		$ctype = "application/vnd.ms-excel";
	case ".gif":
		$ctype = "image/gif";
	case ".jpg":
	case "jpeg":
		$ctype = "image/jpeg";
	case ".wav":
		$ctype = "audio/wav";
	case ".mp3":
		$ctype = "audio/mpeg3";
	case ".mpg":
	case "mpeg":
		$ctype = "video/mpeg";
	case ".rtf":
		$ctype = "application/rtf";
	case ".htm":
	case "html":
		$ctype = "text/html";
	case ".asp":
		$ctype = "text/asp";
	default:
		$ctype = "application/octet-stream";
}

// file exists chache results
//clearstatcache();

if(GetFieldData($strTableName,$field,"Absolute",false))
	$absFileName = GetUploadFolder($field).$filename;
else
	$absFileName = getabspath(GetUploadFolder($field).$filename);
	
		
// if no file exists return 404 err
if (!file_exists($absFileName))
{
	returnError404();
	exit();
}
// get file size
$strfilesize = filesize($absFileName);
if($strfilesize===FALSE)
{
	returnError404();
	exit();
}

header("Content-Type: ".$ctype);
header("Content-Disposition: attachment;Filename=\"".$filename."\"");
header("Cache-Control: private");
header("Content-Length: ".$strfilesize);
printfile($absFileName);
?>
