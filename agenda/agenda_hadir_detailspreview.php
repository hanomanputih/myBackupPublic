<?php
@ini_set("display_errors","1");
@ini_set("display_startup_errors","1");

include("include/dbcommon.php");
header("Expires: Thu, 01 Jan 1970 00:00:01 GMT"); 

include("include/agenda_hadir_variables.php");

$mode=postvalue("mode");

if(!@$_SESSION["UserID"])
{ 
	return;
}
if(!CheckSecurity(@$_SESSION["_".$strTableName."_OwnerID"],"Search"))
{
	return;
}

include('include/xtempl.php');
$xt = new Xtempl();


$recordsCounter = 0;

//	process masterkey value
$mastertable=postvalue("mastertable");
if($mastertable!="")
{
	$_SESSION[$strTableName."_mastertable"]=$mastertable;
//	copy keys to session
	$i=1;
	while(isset($_REQUEST["masterkey".$i]))
	{
		$_SESSION[$strTableName."_masterkey".$i]=$_REQUEST["masterkey".$i];
		$i++;
	}
	if(isset($_SESSION[$strTableName."_masterkey".$i]))
		unset($_SESSION[$strTableName."_masterkey".$i]);
}
else
	$mastertable=$_SESSION[$strTableName."_mastertable"];

//$strSQL = $gstrSQL;

if($mastertable=="agenda")
{
	$where ="";
		$where.= GetFullFieldName("id_agenda")."=".make_db_value("id_agenda",$_SESSION[$strTableName."_masterkey1"]);
}


$str = SecuritySQL("Search");
if(strlen($str))
	$where.=" and ".$str;
$strSQL = gSQLWhere($where);

$strSQL.=" ".$gstrOrderBy;

$rowcount=gSQLRowCount($where,0);

$xt->assign("row_count",$rowcount);
if ( $rowcount ) {
	$xt->assign("details_data",true);
	$rs=db_query($strSQL,$conn);

	$display_count=10;
	if($mode=="inline")
		$display_count*=2;
	if($rowcount>$display_count+2)
	{
		$xt->assign("display_first",true);
		$xt->assign("display_count",$display_count);
	}
	else
		$display_count = $rowcount;

	$rowinfo=array();
		
	while (($data = db_fetch_array($rs)) && $recordsCounter<$display_count) {
		$recordsCounter++;
		$row=array();
		$keylink="";
		$keylink.="&key1=".htmlspecialchars(rawurlencode(@$data["id_hadir"]));

	
	//	id_agenda - 
		    $value="";
				$value=DisplayLookupWizard("id_agenda",$data["id_agenda"],$data,$keylink,MODE_PRINT);
			$row["id_agenda_value"]=$value;
	//	Instansi - 
		    $value="";
				$value=DisplayLookupWizard("Instansi",$data["Instansi"],$data,$keylink,MODE_PRINT);
			$row["Instansi_value"]=$value;
	//	id_bos - 
		    $value="";
				$value=DisplayLookupWizard("id_bos",$data["id_bos"],$data,$keylink,MODE_PRINT);
			$row["id_bos_value"]=$value;
	//	Jabatan - 
		    $value="";
				$value=DisplayLookupWizard("Jabatan",$data["Jabatan"],$data,$keylink,MODE_PRINT);
			$row["Jabatan_value"]=$value;
	//	Jam - Short Date
		    $value="";
				$value = ProcessLargeText(GetData($data,"Jam", "Short Date"),"field=Jam".$keylink,"",MODE_PRINT);
			$row["Jam_value"]=$value;
	$rowinfo[]=$row;
	}
	$xt->assign_loopsection("details_row",$rowinfo);
} else {
}
$xt->display("agenda_hadir_detailspreview.htm");
if($mode!="inline")
	echo "counterSeparator".postvalue("counter");
?>