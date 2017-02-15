<?php
include(getabspath("include/agenda_settings.php"));

function DisplayMasterTableInfo_agenda($params)
{
	$detailtable=$params["detailtable"];
	$keys=$params["keys"];
	global $conn,$strTableName;
	$xt = new Xtempl();
	
	$oldTableName=$strTableName;
	$strTableName="agenda";

//$strSQL = "SELECT  id_agenda,  id_masuk,  Apa,  Tgl_mulai,  Tgl_akhir,  Jam_mulai,  Jam_akhir,  Tempat  FROM agenda  ORDER BY id_agenda  ";

$sqlHead="SELECT id_agenda,  id_masuk,  Apa,  Tgl_mulai,  Tgl_akhir,  Jam_mulai,  Jam_akhir,  Tempat";
$sqlFrom="FROM agenda";
$sqlWhere="";
$sqlTail="";

$where="";

if($detailtable=="agenda_hadir")
{
		$where.= GetFullFieldName("id_agenda")."=".make_db_value("id_agenda",$keys[1-1]);
}
if(!$where)
{
	$strTableName=$oldTableName;
	return;
}
	$str = SecuritySQL("Export");
	if(strlen($str))
		$where.=" and ".$str;
	
	$strWhere=whereAdd($sqlWhere,$where);
	if(strlen($strWhere))
		$strWhere=" where ".$strWhere." ";
	$strSQL= $sqlHead.' '.$sqlFrom.$strWhere.$sqlTail;

//	$strSQL=AddWhere($strSQL,$where);

	LogInfo($strSQL);
	$rs=db_query($strSQL,$conn);
	$data=db_fetch_array($rs);
	if(!$data)
	{
		$strTableName=$oldTableName;
		return;
	}
	$keylink="";
	$keylink.="&key1=".htmlspecialchars(rawurlencode(@$data["id_agenda"]));
	


//	id_masuk - 
			$value="";
				$value=DisplayLookupWizard("id_masuk",$data["id_masuk"],$data,$keylink,MODE_PRINT);
			$xt->assign("id_masuk_mastervalue",$value);

//	Apa - HTML
			$value="";
				$value = GetData($data,"Apa", "HTML");
			$xt->assign("Apa_mastervalue",$value);

//	Tgl_mulai - Long Date
			$value="";
				$value = ProcessLargeText(GetData($data,"Tgl_mulai", "Long Date"),"field=Tgl%5Fmulai".$keylink,"",MODE_PRINT);
			$xt->assign("Tgl_mulai_mastervalue",$value);

//	Tgl_akhir - Long Date
			$value="";
				$value = ProcessLargeText(GetData($data,"Tgl_akhir", "Long Date"),"field=Tgl%5Fakhir".$keylink,"",MODE_PRINT);
			$xt->assign("Tgl_akhir_mastervalue",$value);

//	Jam_mulai - Time
			$value="";
				$value = ProcessLargeText(GetData($data,"Jam_mulai", "Time"),"field=Jam%5Fmulai".$keylink,"",MODE_PRINT);
			$xt->assign("Jam_mulai_mastervalue",$value);

//	Jam_akhir - Time
			$value="";
				$value = ProcessLargeText(GetData($data,"Jam_akhir", "Time"),"field=Jam%5Fakhir".$keylink,"",MODE_PRINT);
			$xt->assign("Jam_akhir_mastervalue",$value);

//	Tempat - 
			$value="";
				$value = ProcessLargeText(GetData($data,"Tempat", ""),"field=Tempat".$keylink,"",MODE_PRINT);
			$xt->assign("Tempat_mastervalue",$value);
	$strTableName=$oldTableName;
	$xt->display("agenda_masterprint.htm");

}

// events

?>