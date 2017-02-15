<?php

//	field labels
$fieldLabelsadmin_users = array();
$fieldLabelsadmin_users["Indonesian"]=array();
$fieldLabelsadmin_users["Indonesian"]["id_user"] = "Id User";
$fieldLabelsadmin_users["Indonesian"]["Username"] = "Username";
$fieldLabelsadmin_users["Indonesian"]["Passw"] = "Password";
$fieldLabelsadmin_users["Indonesian"]["Nama_Lengkap"] = "Nama Lengkap";
$fieldLabelsadmin_users["Indonesian"]["Instansi"] = "Instansi";
$fieldLabelsadmin_users["Indonesian"]["NIP"] = "NIP";
$fieldLabelsadmin_users["Indonesian"]["Alamat_Kantor"] = "Alamat Kantor";
$fieldLabelsadmin_users["Indonesian"]["Telp_Kantor"] = "Telp Kantor";
$fieldLabelsadmin_users["Indonesian"]["Telp_HP"] = "Telp HP";


$tdataadmin_users=array();
	$tdataadmin_users[".ShortName"]="admin_users";
	$tdataadmin_users[".OwnerID"]="";
	$tdataadmin_users[".OriginalTable"]="agenda_petugas";
	$tdataadmin_users[".NCSearch"]=false;
	

$tdataadmin_users[".shortTableName"] = "admin_users";
$tdataadmin_users[".dataSourceTable"] = "admin_users";
$tdataadmin_users[".nSecOptions"] = 0;
$tdataadmin_users[".nLoginMethod"] = 1;
$tdataadmin_users[".recsPerRowList"] = 1;	
$tdataadmin_users[".tableGroupBy"] = "0";
$tdataadmin_users[".dbType"] = 0;
$tdataadmin_users[".mainTableOwnerID"] = "";
$tdataadmin_users[".moveNext"] = 1;

$tdataadmin_users[".listAjax"] = true;

	$tdataadmin_users[".audit"] = false;

	$tdataadmin_users[".locking"] = false;
	
$tdataadmin_users[".listIcons"] = true;
$tdataadmin_users[".inlineEdit"] = true;



$tdataadmin_users[".delete"] = true;

$tdataadmin_users[".showSimpleSearchOptions"] = false;

$tdataadmin_users[".showSearchPanel"] = false;


$tdataadmin_users[".isUseAjaxSuggest"] = false;

$tdataadmin_users[".rowHighlite"] = true;

$tdataadmin_users[".delFile"] = true;

// button handlers file names

// start on load js handlers








// end on load js handlers



$tdataadmin_users[".arrKeyFields"][] = "id_user";

// use datepicker for search panel
$tdataadmin_users[".isUseCalendarForSearch"] = false;

// use timepicker for search panel
$tdataadmin_users[".isUseTimeForSearch"] = false;





$tdataadmin_users[".isUseInlineAdd"] = true;

$tdataadmin_users[".isUseInlineEdit"] = true;
$tdataadmin_users[".isUseInlineJs"] = $tdataadmin_users[".isUseInlineAdd"] || $tdataadmin_users[".isUseInlineEdit"];

$tdataadmin_users[".allSearchFields"] = array();

$tdataadmin_users[".globSearchFields"][] = "Username";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("Username", $tdataadmin_users[".allSearchFields"]))
{
	$tdataadmin_users[".allSearchFields"][] = "Username";	
}
$tdataadmin_users[".globSearchFields"][] = "Nama_Lengkap";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("Nama_Lengkap", $tdataadmin_users[".allSearchFields"]))
{
	$tdataadmin_users[".allSearchFields"][] = "Nama_Lengkap";	
}
$tdataadmin_users[".globSearchFields"][] = "Instansi";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("Instansi", $tdataadmin_users[".allSearchFields"]))
{
	$tdataadmin_users[".allSearchFields"][] = "Instansi";	
}
$tdataadmin_users[".globSearchFields"][] = "NIP";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("NIP", $tdataadmin_users[".allSearchFields"]))
{
	$tdataadmin_users[".allSearchFields"][] = "NIP";	
}
$tdataadmin_users[".globSearchFields"][] = "Alamat_Kantor";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("Alamat_Kantor", $tdataadmin_users[".allSearchFields"]))
{
	$tdataadmin_users[".allSearchFields"][] = "Alamat_Kantor";	
}
$tdataadmin_users[".globSearchFields"][] = "Telp_Kantor";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("Telp_Kantor", $tdataadmin_users[".allSearchFields"]))
{
	$tdataadmin_users[".allSearchFields"][] = "Telp_Kantor";	
}
$tdataadmin_users[".globSearchFields"][] = "Telp_HP";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("Telp_HP", $tdataadmin_users[".allSearchFields"]))
{
	$tdataadmin_users[".allSearchFields"][] = "Telp_HP";	
}


$tdataadmin_users[".isDynamicPerm"] = true;

	


$tdataadmin_users[".isResizeColumns"] = false;


$tdataadmin_users[".createLoginPage"] = true;


 	




$tdataadmin_users[".pageSize"] = 5;

$gstrOrderBy = "ORDER BY Nama_Lengkap";
if(strlen($gstrOrderBy) && strtolower(substr($gstrOrderBy,0,8))!="order by")
	$gstrOrderBy = "order by ".$gstrOrderBy;
$tdataadmin_users[".strOrderBy"] = $gstrOrderBy;
	
$tdataadmin_users[".orderindexes"] = array();
$tdataadmin_users[".orderindexes"][] = array(4, (1 ? "ASC" : "DESC"), "Nama_Lengkap");

$tdataadmin_users[".sqlHead"] = "SELECT id_user,  Username,  Passw,  Nama_Lengkap,  Instansi,  NIP,  Alamat_Kantor,  Telp_Kantor,  Telp_HP";

$tdataadmin_users[".sqlFrom"] = "FROM agenda_petugas";

$tdataadmin_users[".sqlWhereExpr"] = "";

$tdataadmin_users[".sqlTail"] = "";



	$tableKeys=array();
	$tableKeys[]="id_user";
	$tdataadmin_users[".Keys"]=$tableKeys;

	
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
			
											$tdataadmin_users["id_user"]=$fdata;
	
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
			$tdataadmin_users["Username"]=$fdata;
	
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
		
											$tdataadmin_users["Passw"]=$fdata;
	
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
			$tdataadmin_users["Nama_Lengkap"]=$fdata;
	
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
			$tdataadmin_users["Instansi"]=$fdata;
	
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
			$tdataadmin_users["NIP"]=$fdata;
	
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
			$tdataadmin_users["Alamat_Kantor"]=$fdata;
	
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
			$tdataadmin_users["Telp_Kantor"]=$fdata;
	
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
			$tdataadmin_users["Telp_HP"]=$fdata;

	
$tables_data["admin_users"]=&$tdataadmin_users;
$field_labels["admin_users"] = &$fieldLabelsadmin_users;

// -----------------start  prepare master-details data arrays ------------------------------//
// tables which are detail tables for current table (master)
$detailsTablesData["admin_users"] = array();

	
// tables which are master tables for current table (detail)
$masterTablesData["admin_users"] = array();

// -----------------end  prepare master-details data arrays ------------------------------//

require_once(getabspath("classes/sql.php"));










$proto0=array();
$proto0["m_strHead"] = "SELECT";
$proto0["m_strFieldList"] = "id_user,  Username,  Passw,  Nama_Lengkap,  Instansi,  NIP,  Alamat_Kantor,  Telp_Kantor,  Telp_HP";
$proto0["m_strFrom"] = "FROM agenda_petugas";
$proto0["m_strWhere"] = "";
$proto0["m_strOrderBy"] = "ORDER BY Nama_Lengkap";
$proto0["m_strTail"] = "";
$proto1=array();
$proto1["m_sql"] = "";
$proto1["m_uniontype"] = "SQLL_UNKNOWN";
	$obj = new SQLNonParsed(array(
	"m_sql" => ""
));

$proto1["m_column"]=$obj;
$proto1["m_contained"] = array();
$proto1["m_strCase"] = "";
$proto1["m_havingmode"] = "0";
$proto1["m_inBrackets"] = "0";
$proto1["m_useAlias"] = "0";
$obj = new SQLLogicalExpr($proto1);

$proto0["m_where"] = $obj;
$proto3=array();
$proto3["m_sql"] = "";
$proto3["m_uniontype"] = "SQLL_UNKNOWN";
	$obj = new SQLNonParsed(array(
	"m_sql" => ""
));

$proto3["m_column"]=$obj;
$proto3["m_contained"] = array();
$proto3["m_strCase"] = "";
$proto3["m_havingmode"] = "0";
$proto3["m_inBrackets"] = "0";
$proto3["m_useAlias"] = "0";
$obj = new SQLLogicalExpr($proto3);

$proto0["m_having"] = $obj;
$proto0["m_fieldlist"] = array();
						$proto5=array();
			$obj = new SQLField(array(
	"m_strName" => "id_user",
	"m_strTable" => "agenda_petugas"
));

$proto5["m_expr"]=$obj;
$proto5["m_alias"] = "";
$obj = new SQLFieldListItem($proto5);

$proto0["m_fieldlist"][]=$obj;
						$proto7=array();
			$obj = new SQLField(array(
	"m_strName" => "Username",
	"m_strTable" => "agenda_petugas"
));

$proto7["m_expr"]=$obj;
$proto7["m_alias"] = "";
$obj = new SQLFieldListItem($proto7);

$proto0["m_fieldlist"][]=$obj;
						$proto9=array();
			$obj = new SQLField(array(
	"m_strName" => "Passw",
	"m_strTable" => "agenda_petugas"
));

$proto9["m_expr"]=$obj;
$proto9["m_alias"] = "";
$obj = new SQLFieldListItem($proto9);

$proto0["m_fieldlist"][]=$obj;
						$proto11=array();
			$obj = new SQLField(array(
	"m_strName" => "Nama_Lengkap",
	"m_strTable" => "agenda_petugas"
));

$proto11["m_expr"]=$obj;
$proto11["m_alias"] = "";
$obj = new SQLFieldListItem($proto11);

$proto0["m_fieldlist"][]=$obj;
						$proto13=array();
			$obj = new SQLField(array(
	"m_strName" => "Instansi",
	"m_strTable" => "agenda_petugas"
));

$proto13["m_expr"]=$obj;
$proto13["m_alias"] = "";
$obj = new SQLFieldListItem($proto13);

$proto0["m_fieldlist"][]=$obj;
						$proto15=array();
			$obj = new SQLField(array(
	"m_strName" => "NIP",
	"m_strTable" => "agenda_petugas"
));

$proto15["m_expr"]=$obj;
$proto15["m_alias"] = "";
$obj = new SQLFieldListItem($proto15);

$proto0["m_fieldlist"][]=$obj;
						$proto17=array();
			$obj = new SQLField(array(
	"m_strName" => "Alamat_Kantor",
	"m_strTable" => "agenda_petugas"
));

$proto17["m_expr"]=$obj;
$proto17["m_alias"] = "";
$obj = new SQLFieldListItem($proto17);

$proto0["m_fieldlist"][]=$obj;
						$proto19=array();
			$obj = new SQLField(array(
	"m_strName" => "Telp_Kantor",
	"m_strTable" => "agenda_petugas"
));

$proto19["m_expr"]=$obj;
$proto19["m_alias"] = "";
$obj = new SQLFieldListItem($proto19);

$proto0["m_fieldlist"][]=$obj;
						$proto21=array();
			$obj = new SQLField(array(
	"m_strName" => "Telp_HP",
	"m_strTable" => "agenda_petugas"
));

$proto21["m_expr"]=$obj;
$proto21["m_alias"] = "";
$obj = new SQLFieldListItem($proto21);

$proto0["m_fieldlist"][]=$obj;
$proto0["m_fromlist"] = array();
												$proto23=array();
$proto23["m_link"] = "SQLL_MAIN";
			$proto24=array();
$proto24["m_strName"] = "agenda_petugas";
$proto24["m_columns"] = array();
$proto24["m_columns"][] = "id_user";
$proto24["m_columns"][] = "Username";
$proto24["m_columns"][] = "Passw";
$proto24["m_columns"][] = "Nama_Lengkap";
$proto24["m_columns"][] = "Instansi";
$proto24["m_columns"][] = "NIP";
$proto24["m_columns"][] = "Alamat_Kantor";
$proto24["m_columns"][] = "Telp_Kantor";
$proto24["m_columns"][] = "Telp_HP";
$obj = new SQLTable($proto24);

$proto23["m_table"] = $obj;
$proto23["m_alias"] = "";
$proto25=array();
$proto25["m_sql"] = "";
$proto25["m_uniontype"] = "SQLL_UNKNOWN";
	$obj = new SQLNonParsed(array(
	"m_sql" => ""
));

$proto25["m_column"]=$obj;
$proto25["m_contained"] = array();
$proto25["m_strCase"] = "";
$proto25["m_havingmode"] = "0";
$proto25["m_inBrackets"] = "0";
$proto25["m_useAlias"] = "0";
$obj = new SQLLogicalExpr($proto25);

$proto23["m_joinon"] = $obj;
$obj = new SQLFromListItem($proto23);

$proto0["m_fromlist"][]=$obj;
$proto0["m_groupby"] = array();
$proto0["m_orderby"] = array();
												$proto27=array();
						$obj = new SQLField(array(
	"m_strName" => "Nama_Lengkap",
	"m_strTable" => "agenda_petugas"
));

$proto27["m_column"]=$obj;
$proto27["m_bAsc"] = 1;
$proto27["m_nColumn"] = 0;
$obj = new SQLOrderByItem($proto27);

$proto0["m_orderby"][]=$obj;					
$obj = new SQLQuery($proto0);

$queryData_admin_users = $obj;
$tdataadmin_users[".sqlquery"] = $queryData_admin_users;



?>
