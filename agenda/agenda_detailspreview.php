<?php
@ini_set("display_errors","1");
@ini_set("display_startup_errors","1");

include("include/dbcommon.php");
header("Expires: Thu, 01 Jan 1970 00:00:01 GMT"); 

include("include/agenda_variables.php");

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

if($mastertable=="masuk")
{
	$where ="";
		$where.= GetFullFieldName("id_masuk")."=".make_db_value("id_masuk",$_SESSION[$strTableName."_masterkey1"]);
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
		$keylink.="&key1=".htmlspecialchars(rawurlencode(@$data["id_agenda"]));

	
	//	id_masuk - 
		    $value="";
				$value=DisplayLookupWizard("id_masuk",$data["id_masuk"],$data,$keylink,MODE_PRINT);
			$row["id_masuk_value"]=$value;
	//	Apa - HTML
		    $value="";
				$value = GetData($data,"Apa", "HTML");
			$row["Apa_value"]=$value;
	//	Tgl_mulai - Long Date
		    $value="";
				$value = ProcessLargeText(GetData($data,"Tgl_mulai", "Long Date"),"field=Tgl%5Fmulai".$keylink,"",MODE_PRINT);
			$row["Tgl_mulai_value"]=$value;
	//	Tgl_akhir - Long Date
		    $value="";
				$value = ProcessLargeText(GetData($data,"Tgl_akhir", "Long Date"),"field=Tgl%5Fakhir".$keylink,"",MODE_PRINT);
			$row["Tgl_akhir_value"]=$value;
	//	Jam_mulai - Time
		    $value="";
				$value = ProcessLargeText(GetData($data,"Jam_mulai", "Time"),"field=Jam%5Fmulai".$keylink,"",MODE_PRINT);
			$row["Jam_mulai_value"]=$value;
	//	Jam_akhir - Time
		    $value="";
				$value = ProcessLargeText(GetData($data,"Jam_akhir", "Time"),"field=Jam%5Fakhir".$keylink,"",MODE_PRINT);
			$row["Jam_akhir_value"]=$value;
	//	Tempat - 
		    $value="";
				$value = ProcessLargeText(GetData($data,"Tempat", ""),"field=Tempat".$keylink,"",MODE_PRINT);
			$row["Tempat_value"]=$value;
	$rowinfo[]=$row;
	}
	$xt->assign_loopsection("details_row",$rowinfo);
} else {
}
$xt->display("agenda_detailspreview.htm");
if($mode!="inline")
	echo "counterSeparator".postvalue("counter");
?>