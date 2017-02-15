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

if((!@$_SESSION["UserID"] || !CheckSecurity(@$_SESSION["_".$strTableName."_OwnerID"],"Search")) && postvalue("action")<>"add")
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
$cfieldname=GoodFieldName($field)."_".($id!=='' ? $id : '1');
$cfield="value_".GoodFieldName($field)."_".($id!=='' ? $id : '1');

$onsubmit="";
if(@$_REQUEST["browser"]!="ie")
	$onsubmit="onsubmit=\"return document.getElementById('".$cfield."').value;\"";
echo "<html><body style=\"margin:0\"><form name=\"innovaform\" ".$onsubmit.">";
echo "<script type=\"text/javascript\" src=\"plugins/innovaeditor/scripts/innovaeditor.js\"></script>";
echo "<textarea id='".$cfield."' name='" . $cfield . "' style='width: " . ($nWidth) . "px;height: " . ($nHeight) . "px;'>"  ;
if($data)
	echo htmlspecialchars($data[$field]);
echo "</textarea>";
echo "<script>";
echo "var oEdit" . $cfieldname . " = new InnovaEditor('oEdit" . $cfieldname . "');";
echo "oEdit" . $cfieldname . ".mode='HTMLBody';";
echo "oEdit" . $cfieldname . ".width='" . ($nWidth) . "px';";
echo "oEdit" . $cfieldname . ".height='" . ($nHeight) . "px';";
echo "oEdit" . $cfieldname . ".REPLACE('" . $cfield . "');";
echo "</script>";
echo "</form></body></html>";

return;

?>
