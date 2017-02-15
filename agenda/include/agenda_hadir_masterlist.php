<?php
include(getabspath("include/agenda_hadir_settings.php"));

function DisplayMasterTableInfo_agenda_hadir($params)
{
	$detailtable=$params["detailtable"];
	$keys=$params["keys"];
	global $conn,$strTableName;
	$xt = new Xtempl();
	$oldTableName=$strTableName;
	$strTableName="agenda_hadir";

//$strSQL = "SELECT  id_hadir,  id_agenda,  Instansi,  id_bos,  Jabatan,  Jam  FROM agenda_hadir  ORDER BY id_hadir  ";

$sqlHead="SELECT id_hadir,  id_agenda,  Instansi,  id_bos,  Jabatan,  Jam";
$sqlFrom="FROM agenda_hadir";
$sqlWhere="";
$sqlTail="";

$where="";
$mKeys = array();
$showKeys = "";

if($detailtable=="agenda_hasil")
{
		$where.= GetFullFieldName("id_bos")."=".make_db_value("id_bos",$keys[1-1]);
	$showKeys .= " Petugas: ".$keys[1-1];
	$xt->assign('showKeys',$showKeys);
}
	if(!$where)
	{
		$strTableName=$oldTableName;
		return;
	}
	$str = SecuritySQL("Search");
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
	$keylink.="&key1=".htmlspecialchars(rawurlencode(@$data["id_hadir"]));
	


//	id_agenda - 
			$value="";
				$value=DisplayLookupWizard("id_agenda",$data["id_agenda"],$data,$keylink,MODE_LIST);
			$xt->assign("id_agenda_mastervalue",$value);

//	Instansi - 
			$value="";
				$value=DisplayLookupWizard("Instansi",$data["Instansi"],$data,$keylink,MODE_LIST);
			$xt->assign("Instansi_mastervalue",$value);

//	id_bos - 
			$value="";
				$value=DisplayLookupWizard("id_bos",$data["id_bos"],$data,$keylink,MODE_LIST);
			$xt->assign("id_bos_mastervalue",$value);

//	Jabatan - 
			$value="";
				$value=DisplayLookupWizard("Jabatan",$data["Jabatan"],$data,$keylink,MODE_LIST);
			$xt->assign("Jabatan_mastervalue",$value);

//	Jam - Short Date
			$value="";
				$value = ProcessLargeText(GetData($data,"Jam", "Short Date"),"field=Jam".$keylink);
			$xt->assign("Jam_mastervalue",$value);
	$strTableName=$oldTableName;
	$xt->display("agenda_hadir_masterlist.htm");
}

// events

?>