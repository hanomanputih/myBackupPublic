<?php

//	field labels
$fieldLabelsagenda_petugas = array();
$fieldLabelsagenda_petugas["Indonesian"]=array();
$fieldLabelsagenda_petugas["Indonesian"]["id_user"] = "Nomor User";
$fieldLabelsagenda_petugas["Indonesian"]["Username"] = "Username";
$fieldLabelsagenda_petugas["Indonesian"]["Passw"] = "Password";
$fieldLabelsagenda_petugas["Indonesian"]["Nama_Lengkap"] = "Nama Lengkap";
$fieldLabelsagenda_petugas["Indonesian"]["Instansi"] = "Instansi";
$fieldLabelsagenda_petugas["Indonesian"]["NIP"] = "NIP";
$fieldLabelsagenda_petugas["Indonesian"]["Alamat_Kantor"] = "Alamat Kantor";
$fieldLabelsagenda_petugas["Indonesian"]["Telp_Kantor"] = "Telp Kantor";
$fieldLabelsagenda_petugas["Indonesian"]["Telp_HP"] = "Telp HP";


$tdataagenda_petugas=array();
	$tdataagenda_petugas[".ShortName"]="agenda_petugas";
	$tdataagenda_petugas[".OwnerID"]="";
	$tdataagenda_petugas[".OriginalTable"]="agenda_petugas";
	$tdataagenda_petugas[".NCSearch"]=false;
	

$tdataagenda_petugas[".shortTableName"] = "agenda_petugas";
$tdataagenda_petugas[".dataSourceTable"] = "agenda_petugas";
$tdataagenda_petugas[".nSecOptions"] = 0;
$tdataagenda_petugas[".nLoginMethod"] = 1;
$tdataagenda_petugas[".recsPerRowList"] = 1;	
$tdataagenda_petugas[".tableGroupBy"] = "0";
$tdataagenda_petugas[".dbType"] = 0;
$tdataagenda_petugas[".mainTableOwnerID"] = "";
$tdataagenda_petugas[".moveNext"] = 1;

$tdataagenda_petugas[".listAjax"] = true;

	$tdataagenda_petugas[".audit"] = false;

	$tdataagenda_petugas[".locking"] = false;
	
$tdataagenda_petugas[".listIcons"] = true;




$tdataagenda_petugas[".showSimpleSearchOptions"] = false;

$tdataagenda_petugas[".showSearchPanel"] = false;


$tdataagenda_petugas[".isUseAjaxSuggest"] = false;

$tdataagenda_petugas[".rowHighlite"] = true;

$tdataagenda_petugas[".delFile"] = true;

// button handlers file names

// start on load js handlers








// end on load js handlers



$tdataagenda_petugas[".arrKeyFields"][] = "id_user";

// use datepicker for search panel
$tdataagenda_petugas[".isUseCalendarForSearch"] = false;

// use timepicker for search panel
$tdataagenda_petugas[".isUseTimeForSearch"] = false;






$tdataagenda_petugas[".isUseInlineJs"] = $tdataagenda_petugas[".isUseInlineAdd"] || $tdataagenda_petugas[".isUseInlineEdit"];

$tdataagenda_petugas[".allSearchFields"] = array();



$tdataagenda_petugas[".isDynamicPerm"] = true;

	


$tdataagenda_petugas[".isResizeColumns"] = false;


$tdataagenda_petugas[".createLoginPage"] = true;


 	




$tdataagenda_petugas[".pageSize"] = 5;

$gstrOrderBy = "ORDER BY id_user";
if(strlen($gstrOrderBy) && strtolower(substr($gstrOrderBy,0,8))!="order by")
	$gstrOrderBy = "order by ".$gstrOrderBy;
$tdataagenda_petugas[".strOrderBy"] = $gstrOrderBy;
	
$tdataagenda_petugas[".orderindexes"] = array();
$tdataagenda_petugas[".orderindexes"][] = array(1, (1 ? "ASC" : "DESC"), "id_user");

$tdataagenda_petugas[".sqlHead"] = "SELECT id_user,  Username,  Passw,  Nama_Lengkap,  Instansi,  NIP,  Alamat_Kantor,  Telp_Kantor,  Telp_HP";

$tdataagenda_petugas[".sqlFrom"] = "FROM agenda_petugas";

$tdataagenda_petugas[".sqlWhereExpr"] = "";

$tdataagenda_petugas[".sqlTail"] = "";



	$tableKeys=array();
	$tableKeys[]="id_user";
	$tdataagenda_petugas[".Keys"]=$tableKeys;

	
//	id_user
	$fdata = array();
	$fdata["strName"] = "id_user";
	$fdata["ownerTable"] = "agenda_petugas";
		$fdata["Label"]="Nomor User"; 
			$fdata["FieldType"]= 3;
				$fdata["UseiBox"] = false;
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	

		
			$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "id_user";
		$fdata["FullName"]= "id_user";
		$fdata["IsRequired"]=true; 
					$fdata["Index"]= 1;
	
			$fdata["EditParams"]="";
			
											$tdataagenda_petugas["id_user"]=$fdata;
	
//	Username
	$fdata = array();
	$fdata["strName"] = "Username";
	$fdata["ownerTable"] = "agenda_petugas";
				$fdata["FieldType"]= 200;
				$fdata["UseiBox"] = false;
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	

		
			$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "Username";
		$fdata["FullName"]= "Username";
						$fdata["Index"]= 2;
	
			$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=15";
		
											$tdataagenda_petugas["Username"]=$fdata;
	
//	Passw
	$fdata = array();
	$fdata["strName"] = "Passw";
	$fdata["ownerTable"] = "agenda_petugas";
		$fdata["Label"]="Password"; 
			$fdata["FieldType"]= 200;
				$fdata["UseiBox"] = false;
	$fdata["EditFormat"]= "Password";
	$fdata["ViewFormat"]= "";
	
	

		
			$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "Passw";
		$fdata["FullName"]= "Passw";
						$fdata["Index"]= 3;
	
			$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=30";
		
											$tdataagenda_petugas["Passw"]=$fdata;
	
//	Nama_Lengkap
	$fdata = array();
	$fdata["strName"] = "Nama_Lengkap";
	$fdata["ownerTable"] = "agenda_petugas";
		$fdata["Label"]="Nama Lengkap"; 
			$fdata["FieldType"]= 200;
				$fdata["UseiBox"] = false;
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	

		
			$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "Nama_Lengkap";
		$fdata["FullName"]= "Nama_Lengkap";
		$fdata["IsRequired"]=true; 
					$fdata["Index"]= 4;
	
			$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=35";
			$fdata["EditParams"].= " size=30";
	
											$tdataagenda_petugas["Nama_Lengkap"]=$fdata;
	
//	Instansi
	$fdata = array();
	$fdata["strName"] = "Instansi";
	$fdata["ownerTable"] = "agenda_petugas";
				$fdata["FieldType"]= 200;
				$fdata["UseiBox"] = false;
	$fdata["EditFormat"]= "Lookup wizard";
	$fdata["ViewFormat"]= "";
	
	

		$fdata["LookupType"]=1;
	
				
					
	$fdata["LinkField"]="A5";
	$fdata["LinkFieldType"]=200;
	$fdata["DisplayField"]="Unit_org";
				$fdata["LookupTable"]="unit";
	$fdata["LookupOrderBy"]="";
						
				
										$fdata["SimpleAdd"]=true;
	
					
			$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "Instansi";
		$fdata["FullName"]= "Instansi";
						$fdata["Index"]= 5;
	
			
											$tdataagenda_petugas["Instansi"]=$fdata;
	
//	NIP
	$fdata = array();
	$fdata["strName"] = "NIP";
	$fdata["ownerTable"] = "agenda_petugas";
				$fdata["FieldType"]= 200;
				$fdata["UseiBox"] = false;
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	

		
			$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "NIP";
		$fdata["FullName"]= "NIP";
		$fdata["IsRequired"]=true; 
					$fdata["Index"]= 6;
	
			$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=15";
			$fdata["EditParams"].= " size=15";
	
											$tdataagenda_petugas["NIP"]=$fdata;
	
//	Alamat_Kantor
	$fdata = array();
	$fdata["strName"] = "Alamat_Kantor";
	$fdata["ownerTable"] = "agenda_petugas";
		$fdata["Label"]="Alamat Kantor"; 
			$fdata["FieldType"]= 200;
				$fdata["UseiBox"] = false;
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	

		
			$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "Alamat_Kantor";
		$fdata["FullName"]= "Alamat_Kantor";
						$fdata["Index"]= 7;
	
			$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=200";
			$fdata["EditParams"].= " size=70";
	
											$tdataagenda_petugas["Alamat_Kantor"]=$fdata;
	
//	Telp_Kantor
	$fdata = array();
	$fdata["strName"] = "Telp_Kantor";
	$fdata["ownerTable"] = "agenda_petugas";
		$fdata["Label"]="Telp Kantor"; 
			$fdata["FieldType"]= 200;
				$fdata["UseiBox"] = false;
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	

		
			$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "Telp_Kantor";
		$fdata["FullName"]= "Telp_Kantor";
						$fdata["Index"]= 8;
	
			$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=20";
			$fdata["EditParams"].= " size=10";
	
											$tdataagenda_petugas["Telp_Kantor"]=$fdata;
	
//	Telp_HP
	$fdata = array();
	$fdata["strName"] = "Telp_HP";
	$fdata["ownerTable"] = "agenda_petugas";
		$fdata["Label"]="Telp HP"; 
			$fdata["FieldType"]= 200;
				$fdata["UseiBox"] = false;
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	

		
			$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "Telp_HP";
		$fdata["FullName"]= "Telp_HP";
						$fdata["Index"]= 9;
	
			$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=20";
			$fdata["EditParams"].= " size=10";
	
											$tdataagenda_petugas["Telp_HP"]=$fdata;

	
$tables_data["agenda_petugas"]=&$tdataagenda_petugas;
$field_labels["agenda_petugas"] = &$fieldLabelsagenda_petugas;

// -----------------start  prepare master-details data arrays ------------------------------//
// tables which are detail tables for current table (master)
$detailsTablesData["agenda_petugas"] = array();

	
// tables which are master tables for current table (detail)
$masterTablesData["agenda_petugas"] = array();

// -----------------end  prepare master-details data arrays ------------------------------//

require_once(getabspath("classes/sql.php"));










$proto44=array();
$proto44["m_strHead"] = "SELECT";
$proto44["m_strFieldList"] = "id_user,  Username,  Passw,  Nama_Lengkap,  Instansi,  NIP,  Alamat_Kantor,  Telp_Kantor,  Telp_HP";
$proto44["m_strFrom"] = "FROM agenda_petugas";
$proto44["m_strWhere"] = "";
$proto44["m_strOrderBy"] = "ORDER BY id_user";
$proto44["m_strTail"] = "";
$proto45=array();
$proto45["m_sql"] = "";
$proto45["m_uniontype"] = "SQLL_UNKNOWN";
	$obj = new SQLNonParsed(array(
	"m_sql" => ""
));

$proto45["m_column"]=$obj;
$proto45["m_contained"] = array();
$proto45["m_strCase"] = "";
$proto45["m_havingmode"] = "0";
$proto45["m_inBrackets"] = "0";
$proto45["m_useAlias"] = "0";
$obj = new SQLLogicalExpr($proto45);

$proto44["m_where"] = $obj;
$proto47=array();
$proto47["m_sql"] = "";
$proto47["m_uniontype"] = "SQLL_UNKNOWN";
	$obj = new SQLNonParsed(array(
	"m_sql" => ""
));

$proto47["m_column"]=$obj;
$proto47["m_contained"] = array();
$proto47["m_strCase"] = "";
$proto47["m_havingmode"] = "0";
$proto47["m_inBrackets"] = "0";
$proto47["m_useAlias"] = "0";
$obj = new SQLLogicalExpr($proto47);

$proto44["m_having"] = $obj;
$proto44["m_fieldlist"] = array();
						$proto49=array();
			$obj = new SQLField(array(
	"m_strName" => "id_user",
	"m_strTable" => "agenda_petugas"
));

$proto49["m_expr"]=$obj;
$proto49["m_alias"] = "";
$obj = new SQLFieldListItem($proto49);

$proto44["m_fieldlist"][]=$obj;
						$proto51=array();
			$obj = new SQLField(array(
	"m_strName" => "Username",
	"m_strTable" => "agenda_petugas"
));

$proto51["m_expr"]=$obj;
$proto51["m_alias"] = "";
$obj = new SQLFieldListItem($proto51);

$proto44["m_fieldlist"][]=$obj;
						$proto53=array();
			$obj = new SQLField(array(
	"m_strName" => "Passw",
	"m_strTable" => "agenda_petugas"
));

$proto53["m_expr"]=$obj;
$proto53["m_alias"] = "";
$obj = new SQLFieldListItem($proto53);

$proto44["m_fieldlist"][]=$obj;
						$proto55=array();
			$obj = new SQLField(array(
	"m_strName" => "Nama_Lengkap",
	"m_strTable" => "agenda_petugas"
));

$proto55["m_expr"]=$obj;
$proto55["m_alias"] = "";
$obj = new SQLFieldListItem($proto55);

$proto44["m_fieldlist"][]=$obj;
						$proto57=array();
			$obj = new SQLField(array(
	"m_strName" => "Instansi",
	"m_strTable" => "agenda_petugas"
));

$proto57["m_expr"]=$obj;
$proto57["m_alias"] = "";
$obj = new SQLFieldListItem($proto57);

$proto44["m_fieldlist"][]=$obj;
						$proto59=array();
			$obj = new SQLField(array(
	"m_strName" => "NIP",
	"m_strTable" => "agenda_petugas"
));

$proto59["m_expr"]=$obj;
$proto59["m_alias"] = "";
$obj = new SQLFieldListItem($proto59);

$proto44["m_fieldlist"][]=$obj;
						$proto61=array();
			$obj = new SQLField(array(
	"m_strName" => "Alamat_Kantor",
	"m_strTable" => "agenda_petugas"
));

$proto61["m_expr"]=$obj;
$proto61["m_alias"] = "";
$obj = new SQLFieldListItem($proto61);

$proto44["m_fieldlist"][]=$obj;
						$proto63=array();
			$obj = new SQLField(array(
	"m_strName" => "Telp_Kantor",
	"m_strTable" => "agenda_petugas"
));

$proto63["m_expr"]=$obj;
$proto63["m_alias"] = "";
$obj = new SQLFieldListItem($proto63);

$proto44["m_fieldlist"][]=$obj;
						$proto65=array();
			$obj = new SQLField(array(
	"m_strName" => "Telp_HP",
	"m_strTable" => "agenda_petugas"
));

$proto65["m_expr"]=$obj;
$proto65["m_alias"] = "";
$obj = new SQLFieldListItem($proto65);

$proto44["m_fieldlist"][]=$obj;
$proto44["m_fromlist"] = array();
												$proto67=array();
$proto67["m_link"] = "SQLL_MAIN";
			$proto68=array();
$proto68["m_strName"] = "agenda_petugas";
$proto68["m_columns"] = array();
$proto68["m_columns"][] = "id_user";
$proto68["m_columns"][] = "Username";
$proto68["m_columns"][] = "Passw";
$proto68["m_columns"][] = "Nama_Lengkap";
$proto68["m_columns"][] = "Instansi";
$proto68["m_columns"][] = "NIP";
$proto68["m_columns"][] = "Alamat_Kantor";
$proto68["m_columns"][] = "Telp_Kantor";
$proto68["m_columns"][] = "Telp_HP";
$obj = new SQLTable($proto68);

$proto67["m_table"] = $obj;
$proto67["m_alias"] = "";
$proto69=array();
$proto69["m_sql"] = "";
$proto69["m_uniontype"] = "SQLL_UNKNOWN";
	$obj = new SQLNonParsed(array(
	"m_sql" => ""
));

$proto69["m_column"]=$obj;
$proto69["m_contained"] = array();
$proto69["m_strCase"] = "";
$proto69["m_havingmode"] = "0";
$proto69["m_inBrackets"] = "0";
$proto69["m_useAlias"] = "0";
$obj = new SQLLogicalExpr($proto69);

$proto67["m_joinon"] = $obj;
$obj = new SQLFromListItem($proto67);

$proto44["m_fromlist"][]=$obj;
$proto44["m_groupby"] = array();
$proto44["m_orderby"] = array();
												$proto71=array();
						$obj = new SQLField(array(
	"m_strName" => "id_user",
	"m_strTable" => "agenda_petugas"
));

$proto71["m_column"]=$obj;
$proto71["m_bAsc"] = 1;
$proto71["m_nColumn"] = 0;
$obj = new SQLOrderByItem($proto71);

$proto44["m_orderby"][]=$obj;					
$obj = new SQLQuery($proto44);

$queryData_agenda_petugas = $obj;
$tdataagenda_petugas[".sqlquery"] = $queryData_agenda_petugas;



?>
