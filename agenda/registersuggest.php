<?php
@ini_set("display_errors","1");
@ini_set("display_startup_errors","1");
include("include/dbcommon.php");
include("include/agenda_petugas_variables.php");
header("Expires: Thu, 01 Jan 1970 00:00:01 GMT");
$captcha="";
$email="";
$password="";
$userName="";
$field = postvalue('field');
$val = postvalue('val');
if($field == 'Username')
	$userName = $val;
else if($field == 'Passw')
	$password = $val;
else if($field == '')
	$email = $val;
else if($field == 'captcha')
	$captcha = $val;

if(strlen($captcha) && @strtolower($captcha)!=strtolower(@$_SESSION["captcha"]))
	echo "Invalid security code.";

//	check if entered username already exists
if(strlen($userName))
{
	$strSQL="select count(*) from `agenda_petugas` where `Username`=".add_db_quotes("Username",$userName);
   	$rs=db_query($strSQL,$conn);
	$data=db_fetch_numarray($rs);
	if($data[0]>0)
		echo "Username"." <i>".$userName."</i> "."sudah terpakai. Pilih username lainnya.";
}



?>