<?php

//	field labels
$fieldLabelsadmin_members = array();
$fieldLabelsadmin_members["Indonesian"]=array();
$fieldLabelsadmin_members["Indonesian"]["id_user"] = "Id User";
$fieldLabelsadmin_members["Indonesian"]["Username"] = "Username";
$fieldLabelsadmin_members["Indonesian"]["Passw"] = "Password";
$fieldLabelsadmin_members["Indonesian"]["Nama_Lengkap"] = "Nama Lengkap";
$fieldLabelsadmin_members["Indonesian"]["Instansi"] = "Instansi";
$fieldLabelsadmin_members["Indonesian"]["NIP"] = "NIP";
$fieldLabelsadmin_members["Indonesian"]["Alamat_Kantor"] = "Alamat Kantor";
$fieldLabelsadmin_members["Indonesian"]["Telp_Kantor"] = "Telp Kantor";
$fieldLabelsadmin_members["Indonesian"]["Telp_HP"] = "Telp HP";


$tdataadmin_members=array();
	$tdataadmin_members[".ShortName"]="admin_members";
	$tdataadmin_members[".OwnerID"]="";
	$tdataadmin_members[".OriginalTable"]="agenda_petugas";
	$tdataadmin_members[".NCSearch"]=false;
	

$tdataadmin_members[".shortTableName"] = "admin_members";
$tdataadmin_members[".dataSourceTable"] = "admin_members";
$tdataadmin_members[".nSecOptions"] = 0;
$tdataadmin_members[".nLoginMethod"] = 1;
$tdataadmin_members[".recsPerRowList"] = 1;	
$tdataadmin_members[".tableGroupBy"] = "0";
$tdataadmin_members[".dbType"] = 0;
$tdataadmin_members[".mainTableOwnerID"] = "";
$tdataadmin_members[".moveNext"] = 1;

$tdataadmin_members[".listAjax"] = true;

	$tdataadmin_members[".audit"] = false;

	$tdataadmin_members[".locking"] = false;
	
$tdataadmin_members[".listIcons"] = true;




$tdataadmin_members[".showSimpleSearchOptions"] = false;

$tdataadmin_members[".showSearchPanel"] = false;


$tdataadmin_members[".isUseAjaxSuggest"] = false;

$tdataadmin_members[".rowHighlite"] = true;

$tdataadmin_members[".delFile"] = true;

// button handlers file names

// start on load js handlers








// end on load js handlers



$tdataadmin_members[".arrKeyFields"][] = "id_user";

// use datepicker for search panel
$tdataadmin_members[".isUseCalendarForSearch"] = false;

// use timepicker for search panel
$tdataadmin_members[".isUseTimeForSearch"] = false;






$tdataadmin_members[".isUseInlineJs"] = $tdataadmin_members[".isUseInlineAdd"] || $tdataadmin_members[".isUseInlineEdit"];

$tdataadmin_members[".allSearchFields"] = array();

$tdataadmin_members[".globSearchFields"][] = "id_user";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("id_user", $tdataadmin_members[".allSearchFields"]))
{
	$tdataadmin_members[".allSearchFields"][] = "id_user";	
}
$tdataadmin_members[".globSearchFields"][] = "Username";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("Username", $tdataadmin_members[".allSearchFields"]))
{
	$tdataadmin_members[".allSearchFields"][] = "Username";	
}
$tdataadmin_members[".globSearchFields"][] = "Passw";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("Passw", $tdataadmin_members[".allSearchFields"]))
{
	$tdataadmin_members[".allSearchFields"][] = "Passw";	
}
$tdataadmin_members[".globSearchFields"][] = "Nama_Lengkap";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("Nama_Lengkap", $tdataadmin_members[".allSearchFields"]))
{
	$tdataadmin_members[".allSearchFields"][] = "Nama_Lengkap";	
}
$tdataadmin_members[".globSearchFields"][] = "Instansi";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("Instansi", $tdataadmin_members[".allSearchFields"]))
{
	$tdataadmin_members[".allSearchFields"][] = "Instansi";	
}
$tdataadmin_members[".globSearchFields"][] = "NIP";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("NIP", $tdataadmin_members[".allSearchFields"]))
{
	$tdataadmin_members[".allSearchFields"][] = "NIP";	
}
$tdataadmin_members[".globSearchFields"][] = "Alamat_Kantor";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("Alamat_Kantor", $tdataadmin_members[".allSearchFields"]))
{
	$tdataadmin_members[".allSearchFields"][] = "Alamat_Kantor";	
}
$tdataadmin_members[".globSearchFields"][] = "Telp_Kantor";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("Telp_Kantor", $tdataadmin_members[".allSearchFields"]))
{
	$tdataadmin_members[".allSearchFields"][] = "Telp_Kantor";	
}
$tdataadmin_members[".globSearchFields"][] = "Telp_HP";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("Telp_HP", $tdataadmin_members[".allSearchFields"]))
{
	$tdataadmin_members[".allSearchFields"][] = "Telp_HP";	
}


$tdataadmin_members[".isDynamicPerm"] = true;

	


$tdataadmin_members[".isResizeColumns"] = false;


$tdataadmin_members[".createLoginPage"] = true;


 	




$tdataadmin_members[".pageSize"] = 5;

$gstrOrderBy = "ORDER BY Nama_Lengkap";
if(strlen($gstrOrderBy) && strtolower(substr($gstrOrderBy,0,8))!="order by")
	$gstrOrderBy = "order by ".$gstrOrderBy;
$tdataadmin_members[".strOrderBy"] = $gstrOrderBy;
	
$tdataadmin_members[".orderindexes"] = array();
$tdataadmin_members[".orderindexes"][] = array(4, (1 ? "ASC" : "DESC"), "Nama_Lengkap");

$tdataadmin_members[".sqlHead"] = "SELECT id_user,  Username,  Passw,  Nama_Lengkap,  Instansi,  NIP,  Alamat_Kantor,  Telp_Kantor,  Telp_HP";

$tdataadmin_members[".sqlFrom"] = "FROM agenda_petugas";

$tdataadmin_members[".sqlWhereExpr"] = "";

$tdataadmin_members[".sqlTail"] = "";



	$tableKeys=array();
	$tableKeys[]="id_user";
	$tdataadmin_members[".Keys"]=$tableKeys;

	
//	id_user
	$fdata = array();
	$fdata["strName"] = "id_user";
	$fdata["ownerTable"] = "agenda_petugas";
		$fdata["Label"]="Id User"; 
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
			 $fdata["bListPage"]=true; 
				$fdata["FieldPermissions"]=true;
							$fdata["ListPage"]=true;
			$tdataadmin_members["id_user"]=$fdata;
	
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
		 $fdata["bListPage"]=true; 
				$fdata["FieldPermissions"]=true;
							$fdata["ListPage"]=true;
			$tdataadmin_members["Username"]=$fdata;
	
//	Passw
	$fdata = array();
	$fdata["strName"] = "Passw";
	$fdata["ownerTable"] = "agenda_petugas";
		$fdata["Label"]="Password"; 
			$fdata["FieldType"]= 200;
				$fdata["UseiBox"] = false;
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	

		
			$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "Passw";
		$fdata["FullName"]= "Passw";
						$fdata["Index"]= 3;
	
			$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=30";
		 $fdata["bListPage"]=true; 
				$fdata["FieldPermissions"]=true;
							$fdata["ListPage"]=true;
			$tdataadmin_members["Passw"]=$fdata;
	
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
						$fdata["Index"]= 4;
	
			$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=35";
		 $fdata["bListPage"]=true; 
				$fdata["FieldPermissions"]=true;
							$fdata["ListPage"]=true;
			$tdataadmin_members["Nama_Lengkap"]=$fdata;
	
//	Instansi
	$fdata = array();
	$fdata["strName"] = "Instansi";
	$fdata["ownerTable"] = "agenda_petugas";
				$fdata["FieldType"]= 200;
				$fdata["UseiBox"] = false;
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	

		
			$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "Instansi";
		$fdata["FullName"]= "Instansi";
						$fdata["Index"]= 5;
	
			$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=4";
		 $fdata["bListPage"]=true; 
				$fdata["FieldPermissions"]=true;
							$fdata["ListPage"]=true;
			$tdataadmin_members["Instansi"]=$fdata;
	
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
						$fdata["Index"]= 6;
	
			$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=15";
		 $fdata["bListPage"]=true; 
				$fdata["FieldPermissions"]=true;
							$fdata["ListPage"]=true;
			$tdataadmin_members["NIP"]=$fdata;
	
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
		 $fdata["bListPage"]=true; 
				$fdata["FieldPermissions"]=true;
							$fdata["ListPage"]=true;
			$tdataadmin_members["Alamat_Kantor"]=$fdata;
	
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
		 $fdata["bListPage"]=true; 
				$fdata["FieldPermissions"]=true;
							$fdata["ListPage"]=true;
			$tdataadmin_members["Telp_Kantor"]=$fdata;
	
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
		 $fdata["bListPage"]=true; 
				$fdata["FieldPermissions"]=true;
							$fdata["ListPage"]=true;
			$tdataadmin_members["Telp_HP"]=$fdata;

	
$tables_data["admin_members"]=&$tdataadmin_members;
$field_labels["admin_members"] = &$fieldLabelsadmin_members;

// -----------------start  prepare master-details data arrays ------------------------------//
// tables which are detail tables for current table (master)
$detailsTablesData["admin_members"] = array();

	
// tables which are master tables for current table (detail)
$masterTablesData["admin_members"] = array();

// -----------------end  prepare master-details data arrays ------------------------------//

require_once(getabspath("classes/sql.php"));










$proto31=array();
$proto31["m_strHead"] = "SELECT";
$proto31["m_strFieldList"] = "id_user,  Username,  Passw,  Nama_Lengkap,  Instansi,  NIP,  Alamat_Kantor,  Telp_Kantor,  Telp_HP";
$proto31["m_strFrom"] = "FROM agenda_petugas";
$proto31["m_strWhere"] = "";
$proto31["m_strOrderBy"] = "ORDER BY Nama_Lengkap";
$proto31["m_strTail"] = "";
$proto32=array();
$proto32["m_sql"] = "";
$proto32["m_uniontype"] = "SQLL_UNKNOWN";
	$obj = new SQLNonParsed(array(
	"m_sql" => ""
));

$proto32["m_column"]=$obj;
$proto32["m_contained"] = array();
$proto32["m_strCase"] = "";
$proto32["m_havingmode"] = "0";
$proto32["m_inBrackets"] = "0";
$proto32["m_useAlias"] = "0";
$obj = new SQLLogicalExpr($proto32);

$proto31["m_where"] = $obj;
$proto34=array();
$proto34["m_sql"] = "";
$proto34["m_uniontype"] = "SQLL_UNKNOWN";
	$obj = new SQLNonParsed(array(
	"m_sql" => ""
));

$proto34["m_column"]=$obj;
$proto34["m_contained"] = array();
$proto34["m_strCase"] = "";
$proto34["m_havingmode"] = "0";
$proto34["m_inBrackets"] = "0";
$proto34["m_useAlias"] = "0";
$obj = new SQLLogicalExpr($proto34);

$proto31["m_having"] = $obj;
$proto31["m_fieldlist"] = array();
						$proto36=array();
			$obj = new SQLField(array(
	"m_strName" => "id_user",
	"m_strTable" => "agenda_petugas"
));

$proto36["m_expr"]=$obj;
$proto36["m_alias"] = "";
$obj = new SQLFieldListItem($proto36);

$proto31["m_fieldlist"][]=$obj;
						$proto38=array();
			$obj = new SQLField(array(
	"m_strName" => "Username",
	"m_strTable" => "agenda_petugas"
));

$proto38["m_expr"]=$obj;
$proto38["m_alias"] = "";
$obj = new SQLFieldListItem($proto38);

$proto31["m_fieldlist"][]=$obj;
						$proto40=array();
			$obj = new SQLField(array(
	"m_strName" => "Passw",
	"m_strTable" => "agenda_petugas"
));

$proto40["m_expr"]=$obj;
$proto40["m_alias"] = "";
$obj = new SQLFieldListItem($proto40);

$proto31["m_fieldlist"][]=$obj;
						$proto42=array();
			$obj = new SQLField(array(
	"m_strName" => "Nama_Lengkap",
	"m_strTable" => "agenda_petugas"
));

$proto42["m_expr"]=$obj;
$proto42["m_alias"] = "";
$obj = new SQLFieldListItem($proto42);

$proto31["m_fieldlist"][]=$obj;
						$proto44=array();
			$obj = new SQLField(array(
	"m_strName" => "Instansi",
	"m_strTable" => "agenda_petugas"
));

$proto44["m_expr"]=$obj;
$proto44["m_alias"] = "";
$obj = new SQLFieldListItem($proto44);

$proto31["m_fieldlist"][]=$obj;
						$proto46=array();
			$obj = new SQLField(array(
	"m_strName" => "NIP",
	"m_strTable" => "agenda_petugas"
));

$proto46["m_expr"]=$obj;
$proto46["m_alias"] = "";
$obj = new SQLFieldListItem($proto46);

$proto31["m_fieldlist"][]=$obj;
						$proto48=array();
			$obj = new SQLField(array(
	"m_strName" => "Alamat_Kantor",
	"m_strTable" => "agenda_petugas"
));

$proto48["m_expr"]=$obj;
$proto48["m_alias"] = "";
$obj = new SQLFieldListItem($proto48);

$proto31["m_fieldlist"][]=$obj;
						$proto50=array();
			$obj = new SQLField(array(
	"m_strName" => "Telp_Kantor",
	"m_strTable" => "agenda_petugas"
));

$proto50["m_expr"]=$obj;
$proto50["m_alias"] = "";
$obj = new SQLFieldListItem($proto50);

$proto31["m_fieldlist"][]=$obj;
						$proto52=array();
			$obj = new SQLField(array(
	"m_strName" => "Telp_HP",
	"m_strTable" => "agenda_petugas"
));

$proto52["m_expr"]=$obj;
$proto52["m_alias"] = "";
$obj = new SQLFieldListItem($proto52);

$proto31["m_fieldlist"][]=$obj;
$proto31["m_fromlist"] = array();
												$proto54=array();
$proto54["m_link"] = "SQLL_MAIN";
			$proto55=array();
$proto55["m_strName"] = "agenda_petugas";
$proto55["m_columns"] = array();
$proto55["m_columns"][] = "id_user";
$proto55["m_columns"][] = "Username";
$proto55["m_columns"][] = "Passw";
$proto55["m_columns"][] = "Nama_Lengkap";
$proto55["m_columns"][] = "Instansi";
$proto55["m_columns"][] = "NIP";
$proto55["m_columns"][] = "Alamat_Kantor";
$proto55["m_columns"][] = "Telp_Kantor";
$proto55["m_columns"][] = "Telp_HP";
$obj = new SQLTable($proto55);

$proto54["m_table"] = $obj;
$proto54["m_alias"] = "";
$proto56=array();
$proto56["m_sql"] = "";
$proto56["m_uniontype"] = "SQLL_UNKNOWN";
	$obj = new SQLNonParsed(array(
	"m_sql" => ""
));

$proto56["m_column"]=$obj;
$proto56["m_contained"] = array();
$proto56["m_strCase"] = "";
$proto56["m_havingmode"] = "0";
$proto56["m_inBrackets"] = "0";
$proto56["m_useAlias"] = "0";
$obj = new SQLLogicalExpr($proto56);

$proto54["m_joinon"] = $obj;
$obj = new SQLFromListItem($proto54);

$proto31["m_fromlist"][]=$obj;
$proto31["m_groupby"] = array();
$proto31["m_orderby"] = array();
												$proto58=array();
						$obj = new SQLField(array(
	"m_strName" => "Nama_Lengkap",
	"m_strTable" => "agenda_petugas"
));

$proto58["m_column"]=$obj;
$proto58["m_bAsc"] = 1;
$proto58["m_nColumn"] = 0;
$obj = new SQLOrderByItem($proto58);

$proto31["m_orderby"][]=$obj;					
$obj = new SQLQuery($proto31);

$queryData_admin_members = $obj;
$tdataadmin_members[".sqlquery"] = $queryData_admin_members;



?>
