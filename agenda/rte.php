<?php 
@ini_set("display_errors","1");
@ini_set("display_startup_errors","1");


include("include/dbcommon.php");

$table = postvalue("table");
if (!checkTableName($table))
{
	exit(0);
}
include("include/".$table."_variables.php");

if((!@$_SESSION["UserID"] || !CheckSecurity(@$_SESSION["_".$strTableName."_OwnerID"],"Search")) && @$_GET["action"]<>"add")
{ 
	return;
}

$field = postvalue("field");
if(!CheckFieldPermissions($field) && @$_GET["action"]<>"add")
	return;

//	construct sql

$data=false;
if(@$_GET["action"]<>"add")
{
	$keysArr = GetTableData($strTableName, '.Keys', array());
	$keys = array();
	foreach ($keysArr as $ind=>$k)
	{	
		$keys[$k]=postvalue("key".($ind+1));
	}
	$where=KeyWhere($keys);

	$secOpt = GetTableData($strTableName, '.nSecOptions', array());
		if ($secOpt == ADVSECURITY_VIEW_OWN)
	{
		$where=whereAdd($where,SecuritySQL("Search"));	
	}

	$sql = gSQLWhere($where);

	$rs = db_query($sql,$conn);
	if(!$rs)
	  return;

	$data=db_fetch_array($rs);
}
else 
{	
	$data[$field] = GetDefaultValue($field, $strTableName);
}

$nWidth = GetNCols($field);
$nHeight = GetNRows($field);
$id=postvalue("id");
$cfield="value_".GoodFieldName($field)."_".($id!=='' ? $id : '1');

if(@$_REQUEST["browser"]=="ie")
	$onsubmit="onsubmit=\"updateRTEs();\"";
else
	$onsubmit="onsubmit=\"updateRTEs();return this.elements['".$cfield."'].value;\"";

echo "<html><body style=\"margin:0;\"><form name=\"rteform\" ".$onsubmit.">";
echo "<script type=\"text/javascript\" src=\"include/richtext.js\"></script>";
echo "<script language=\"JavaScript\" type=\"text/javascript\">\r\n";
echo "var TEXT_VIEW_SOURCE='".jsreplace("Lihat sumber")."';\r\n";
echo "initRTE('include/images/', 'include/', '');\r\n";
echo "</script>";
echo "<script language=\"JavaScript\" type=\"text/javascript\">\r\n";
echo "writeRichText('".$cfield."', '";
if($data)
	echo jsreplace($data[$field]);
echo "', " . $nWidth . ", " . $nHeight . ", true, false);\r\n".
"</script>";
echo "</form></body></html>";

return;

?>
