<?php

//	field labels
$fieldLabelsAgenda_Pejabat = array();
$fieldLabelsAgenda_Pejabat["Indonesian"]=array();
$fieldLabelsAgenda_Pejabat["Indonesian"]["id_bos"] = "No";
$fieldLabelsAgenda_Pejabat["Indonesian"]["id_unit"] = "Unit Organisasi";
$fieldLabelsAgenda_Pejabat["Indonesian"]["Nama"] = "Nama lengkap";
$fieldLabelsAgenda_Pejabat["Indonesian"]["Jabatan"] = "Jabatan";
$fieldLabelsAgenda_Pejabat["Indonesian"]["Telp"] = "Telp";
$fieldLabelsAgenda_Pejabat["Indonesian"]["Foto"] = "Pas Foto";
$fieldLabelsAgenda_Pejabat["Indonesian"]["Alamat_Rumah"] = "Alamat Rumah";
$fieldLabelsAgenda_Pejabat["Indonesian"]["Alamat_Kantor"] = "Alamat Kantor";
$fieldLabelsAgenda_Pejabat["Indonesian"]["HP"] = "HP";
$fieldLabelsAgenda_Pejabat["Indonesian"]["email"] = "Email";


$tdataAgenda_Pejabat=array();
	$tdataAgenda_Pejabat[".ShortName"]="Agenda_Pejabat";
	$tdataAgenda_Pejabat[".OwnerID"]="";
	$tdataAgenda_Pejabat[".OriginalTable"]="agenda_bos";
	$tdataAgenda_Pejabat[".NCSearch"]=false;
	

$tdataAgenda_Pejabat[".shortTableName"] = "Agenda_Pejabat";
$tdataAgenda_Pejabat[".dataSourceTable"] = "Agenda Pejabat";
$tdataAgenda_Pejabat[".nSecOptions"] = 0;
$tdataAgenda_Pejabat[".nLoginMethod"] = 1;
$tdataAgenda_Pejabat[".recsPerRowList"] = 1;	
$tdataAgenda_Pejabat[".tableGroupBy"] = "0";
$tdataAgenda_Pejabat[".dbType"] = 0;
$tdataAgenda_Pejabat[".mainTableOwnerID"] = "";
$tdataAgenda_Pejabat[".moveNext"] = 1;

$tdataAgenda_Pejabat[".listAjax"] = true;

	$tdataAgenda_Pejabat[".audit"] = false;

	$tdataAgenda_Pejabat[".locking"] = false;
	
$tdataAgenda_Pejabat[".listIcons"] = true;



$tdataAgenda_Pejabat[".delete"] = true;

$tdataAgenda_Pejabat[".showSimpleSearchOptions"] = false;

$tdataAgenda_Pejabat[".showSearchPanel"] = false;


$tdataAgenda_Pejabat[".isUseAjaxSuggest"] = false;

$tdataAgenda_Pejabat[".rowHighlite"] = true;

$tdataAgenda_Pejabat[".delFile"] = true;

// button handlers file names

// start on load js handlers








// end on load js handlers



$tdataAgenda_Pejabat[".arrKeyFields"][] = "id_bos";

// use datepicker for search panel
$tdataAgenda_Pejabat[".isUseCalendarForSearch"] = false;

// use timepicker for search panel
$tdataAgenda_Pejabat[".isUseTimeForSearch"] = false;






$tdataAgenda_Pejabat[".isUseInlineJs"] = $tdataAgenda_Pejabat[".isUseInlineAdd"] || $tdataAgenda_Pejabat[".isUseInlineEdit"];

$tdataAgenda_Pejabat[".allSearchFields"] = array();

$tdataAgenda_Pejabat[".globSearchFields"][] = "id_unit";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("id_unit", $tdataAgenda_Pejabat[".allSearchFields"]))
{
	$tdataAgenda_Pejabat[".allSearchFields"][] = "id_unit";	
}
$tdataAgenda_Pejabat[".globSearchFields"][] = "Nama";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("Nama", $tdataAgenda_Pejabat[".allSearchFields"]))
{
	$tdataAgenda_Pejabat[".allSearchFields"][] = "Nama";	
}
$tdataAgenda_Pejabat[".globSearchFields"][] = "Jabatan";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("Jabatan", $tdataAgenda_Pejabat[".allSearchFields"]))
{
	$tdataAgenda_Pejabat[".allSearchFields"][] = "Jabatan";	
}
$tdataAgenda_Pejabat[".globSearchFields"][] = "Telp";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("Telp", $tdataAgenda_Pejabat[".allSearchFields"]))
{
	$tdataAgenda_Pejabat[".allSearchFields"][] = "Telp";	
}
$tdataAgenda_Pejabat[".globSearchFields"][] = "Foto";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("Foto", $tdataAgenda_Pejabat[".allSearchFields"]))
{
	$tdataAgenda_Pejabat[".allSearchFields"][] = "Foto";	
}
$tdataAgenda_Pejabat[".globSearchFields"][] = "Alamat_Rumah";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("Alamat_Rumah", $tdataAgenda_Pejabat[".allSearchFields"]))
{
	$tdataAgenda_Pejabat[".allSearchFields"][] = "Alamat_Rumah";	
}
$tdataAgenda_Pejabat[".globSearchFields"][] = "Alamat_Kantor";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("Alamat_Kantor", $tdataAgenda_Pejabat[".allSearchFields"]))
{
	$tdataAgenda_Pejabat[".allSearchFields"][] = "Alamat_Kantor";	
}
$tdataAgenda_Pejabat[".globSearchFields"][] = "HP";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("HP", $tdataAgenda_Pejabat[".allSearchFields"]))
{
	$tdataAgenda_Pejabat[".allSearchFields"][] = "HP";	
}
$tdataAgenda_Pejabat[".globSearchFields"][] = "email";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("email", $tdataAgenda_Pejabat[".allSearchFields"]))
{
	$tdataAgenda_Pejabat[".allSearchFields"][] = "email";	
}

$tdataAgenda_Pejabat[".panelSearchFields"][] = "id_unit";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("id_unit", $tdataAgenda_Pejabat[".allSearchFields"])) 
{
	$tdataAgenda_Pejabat[".allSearchFields"][] = "id_unit";	
}
$tdataAgenda_Pejabat[".panelSearchFields"][] = "Nama";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("Nama", $tdataAgenda_Pejabat[".allSearchFields"])) 
{
	$tdataAgenda_Pejabat[".allSearchFields"][] = "Nama";	
}
$tdataAgenda_Pejabat[".panelSearchFields"][] = "Jabatan";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("Jabatan", $tdataAgenda_Pejabat[".allSearchFields"])) 
{
	$tdataAgenda_Pejabat[".allSearchFields"][] = "Jabatan";	
}
$tdataAgenda_Pejabat[".panelSearchFields"][] = "Telp";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("Telp", $tdataAgenda_Pejabat[".allSearchFields"])) 
{
	$tdataAgenda_Pejabat[".allSearchFields"][] = "Telp";	
}
$tdataAgenda_Pejabat[".panelSearchFields"][] = "Foto";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("Foto", $tdataAgenda_Pejabat[".allSearchFields"])) 
{
	$tdataAgenda_Pejabat[".allSearchFields"][] = "Foto";	
}
$tdataAgenda_Pejabat[".panelSearchFields"][] = "Alamat_Rumah";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("Alamat_Rumah", $tdataAgenda_Pejabat[".allSearchFields"])) 
{
	$tdataAgenda_Pejabat[".allSearchFields"][] = "Alamat_Rumah";	
}
$tdataAgenda_Pejabat[".panelSearchFields"][] = "Alamat_Kantor";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("Alamat_Kantor", $tdataAgenda_Pejabat[".allSearchFields"])) 
{
	$tdataAgenda_Pejabat[".allSearchFields"][] = "Alamat_Kantor";	
}
$tdataAgenda_Pejabat[".panelSearchFields"][] = "HP";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("HP", $tdataAgenda_Pejabat[".allSearchFields"])) 
{
	$tdataAgenda_Pejabat[".allSearchFields"][] = "HP";	
}
$tdataAgenda_Pejabat[".panelSearchFields"][] = "email";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("email", $tdataAgenda_Pejabat[".allSearchFields"])) 
{
	$tdataAgenda_Pejabat[".allSearchFields"][] = "email";	
}

$tdataAgenda_Pejabat[".isDynamicPerm"] = true;

	


$tdataAgenda_Pejabat[".isResizeColumns"] = false;


$tdataAgenda_Pejabat[".createLoginPage"] = true;


 	




$tdataAgenda_Pejabat[".pageSize"] = 5;

$gstrOrderBy = "ORDER BY Nama";
if(strlen($gstrOrderBy) && strtolower(substr($gstrOrderBy,0,8))!="order by")
	$gstrOrderBy = "order by ".$gstrOrderBy;
$tdataAgenda_Pejabat[".strOrderBy"] = $gstrOrderBy;
	
$tdataAgenda_Pejabat[".orderindexes"] = array();
$tdataAgenda_Pejabat[".orderindexes"][] = array(3, (1 ? "ASC" : "DESC"), "Nama");

$tdataAgenda_Pejabat[".sqlHead"] = "SELECT id_bos,  id_unit,  Nama,  Jabatan,  Telp,  Foto,  Alamat_Rumah,  Alamat_Kantor,  HP,  email";

$tdataAgenda_Pejabat[".sqlFrom"] = "FROM agenda_bos";

$tdataAgenda_Pejabat[".sqlWhereExpr"] = "";

$tdataAgenda_Pejabat[".sqlTail"] = "";



	$tableKeys=array();
	$tableKeys[]="id_bos";
	$tdataAgenda_Pejabat[".Keys"]=$tableKeys;

	
//	id_bos
	$fdata = array();
	$fdata["strName"] = "id_bos";
	$fdata["ownerTable"] = "agenda_bos";
		$fdata["Label"]="No"; 
			$fdata["FieldType"]= 3;
		$fdata["AutoInc"]=true;
			$fdata["UseiBox"] = false;
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	

		
			$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "id_bos";
		$fdata["FullName"]= "id_bos";
		$fdata["IsRequired"]=true; 
					$fdata["Index"]= 1;
	
			$fdata["EditParams"]="";
			 $fdata["bListPage"]=true; 
				$fdata["FieldPermissions"]=true;
							$fdata["ListPage"]=true;
			$tdataAgenda_Pejabat["id_bos"]=$fdata;
	
//	id_unit
	$fdata = array();
	$fdata["strName"] = "id_unit";
	$fdata["ownerTable"] = "agenda_bos";
		$fdata["Label"]="Unit Organisasi"; 
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
	
	$fdata["GoodName"]= "id_unit";
		$fdata["FullName"]= "id_unit";
						$fdata["Index"]= 2;
	
			 $fdata["bListPage"]=true; 
				$fdata["FieldPermissions"]=true;
							$fdata["ListPage"]=true;
			$tdataAgenda_Pejabat["id_unit"]=$fdata;
	
//	Nama
	$fdata = array();
	$fdata["strName"] = "Nama";
	$fdata["ownerTable"] = "agenda_bos";
		$fdata["Label"]="Nama lengkap"; 
			$fdata["FieldType"]= 200;
				$fdata["UseiBox"] = false;
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	

		
			$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "Nama";
		$fdata["FullName"]= "Nama";
		$fdata["IsRequired"]=true; 
					$fdata["Index"]= 3;
	
			$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=50";
			$fdata["EditParams"].= " size=40";
	 $fdata["bListPage"]=true; 
				$fdata["FieldPermissions"]=true;
							$fdata["ListPage"]=true;
			$tdataAgenda_Pejabat["Nama"]=$fdata;
	
//	Jabatan
	$fdata = array();
	$fdata["strName"] = "Jabatan";
	$fdata["ownerTable"] = "agenda_bos";
				$fdata["FieldType"]= 200;
				$fdata["UseiBox"] = false;
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	

		
			$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "Jabatan";
		$fdata["FullName"]= "Jabatan";
		$fdata["IsRequired"]=true; 
					$fdata["Index"]= 4;
	
			$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=150";
			$fdata["EditParams"].= " size=70";
	 $fdata["bListPage"]=true; 
				$fdata["FieldPermissions"]=true;
							$fdata["ListPage"]=true;
			$tdataAgenda_Pejabat["Jabatan"]=$fdata;
	
//	Telp
	$fdata = array();
	$fdata["strName"] = "Telp";
	$fdata["ownerTable"] = "agenda_bos";
				$fdata["FieldType"]= 200;
				$fdata["UseiBox"] = false;
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	

		
			$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "Telp";
		$fdata["FullName"]= "Telp";
		$fdata["IsRequired"]=true; 
					$fdata["Index"]= 5;
	
			$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=50";
			$fdata["EditParams"].= " size=20";
	 $fdata["bListPage"]=true; 
				$fdata["FieldPermissions"]=true;
							$fdata["ListPage"]=true;
			$tdataAgenda_Pejabat["Telp"]=$fdata;
	
//	Foto
	$fdata = array();
	$fdata["strName"] = "Foto";
	$fdata["ownerTable"] = "agenda_bos";
		$fdata["Label"]="Pas Foto"; 
			$fdata["LinkPrefix"]="foto/"; 
	$fdata["FieldType"]= 200;
				$fdata["UseiBox"] = false;
	$fdata["EditFormat"]= "Document upload";
	$fdata["ViewFormat"]= "File-based Image";
	
	

		
			$fdata["ImageWidth"] = 50;
	$fdata["ImageHeight"] = 50;
		
	$fdata["GoodName"]= "Foto";
		$fdata["FullName"]= "Foto";
				$fdata["UseTimestamp"]=true; 
		$fdata["UploadFolder"]="foto"; 
		$fdata["Index"]= 6;
	
			 $fdata["bListPage"]=true; 
				$fdata["FieldPermissions"]=true;
		$fdata["CreateThumbnail"]=true;
	$fdata["ThumbnailPrefix"]="th";
				$fdata["ResizeImage"]=true;
	$fdata["NewSize"]=200;
			$fdata["ListPage"]=true;
			$tdataAgenda_Pejabat["Foto"]=$fdata;
	
//	Alamat_Rumah
	$fdata = array();
	$fdata["strName"] = "Alamat_Rumah";
	$fdata["ownerTable"] = "agenda_bos";
		$fdata["Label"]="Alamat Rumah"; 
			$fdata["FieldType"]= 200;
				$fdata["UseiBox"] = false;
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	

		
			$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "Alamat_Rumah";
		$fdata["FullName"]= "Alamat_Rumah";
						$fdata["Index"]= 7;
	
			$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=150";
			$fdata["EditParams"].= " size=70";
	
											$tdataAgenda_Pejabat["Alamat_Rumah"]=$fdata;
	
//	Alamat_Kantor
	$fdata = array();
	$fdata["strName"] = "Alamat_Kantor";
	$fdata["ownerTable"] = "agenda_bos";
		$fdata["Label"]="Alamat Kantor"; 
			$fdata["FieldType"]= 200;
				$fdata["UseiBox"] = false;
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	

		
			$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "Alamat_Kantor";
		$fdata["FullName"]= "Alamat_Kantor";
		$fdata["IsRequired"]=true; 
					$fdata["Index"]= 8;
	
			$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=150";
			$fdata["EditParams"].= " size=70";
	
											$tdataAgenda_Pejabat["Alamat_Kantor"]=$fdata;
	
//	HP
	$fdata = array();
	$fdata["strName"] = "HP";
	$fdata["ownerTable"] = "agenda_bos";
				$fdata["FieldType"]= 200;
				$fdata["UseiBox"] = false;
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	

		
			$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "HP";
		$fdata["FullName"]= "HP";
						$fdata["Index"]= 9;
	
			$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=50";
			$fdata["EditParams"].= " size=30";
	 $fdata["bListPage"]=true; 
				$fdata["FieldPermissions"]=true;
							$fdata["ListPage"]=true;
			$tdataAgenda_Pejabat["HP"]=$fdata;
	
//	email
	$fdata = array();
	$fdata["strName"] = "email";
	$fdata["ownerTable"] = "agenda_bos";
		$fdata["Label"]="Email"; 
			$fdata["FieldType"]= 200;
				$fdata["UseiBox"] = false;
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	

		
			$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "email";
		$fdata["FullName"]= "email";
						$fdata["Index"]= 10;
	
			$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=50";
			$fdata["EditParams"].= " size=40";
	 $fdata["bListPage"]=true; 
				$fdata["FieldPermissions"]=true;
							$fdata["ListPage"]=true;
			$tdataAgenda_Pejabat["email"]=$fdata;

	
$tables_data["Agenda Pejabat"]=&$tdataAgenda_Pejabat;
$field_labels["Agenda_Pejabat"] = &$fieldLabelsAgenda_Pejabat;

// -----------------start  prepare master-details data arrays ------------------------------//
// tables which are detail tables for current table (master)
$detailsTablesData["Agenda Pejabat"] = array();

	
// tables which are master tables for current table (detail)
$masterTablesData["Agenda Pejabat"] = array();

// -----------------end  prepare master-details data arrays ------------------------------//

require_once(getabspath("classes/sql.php"));










$proto0=array();
$proto0["m_strHead"] = "SELECT";
$proto0["m_strFieldList"] = "id_bos,  id_unit,  Nama,  Jabatan,  Telp,  Foto,  Alamat_Rumah,  Alamat_Kantor,  HP,  email";
$proto0["m_strFrom"] = "FROM agenda_bos";
$proto0["m_strWhere"] = "";
$proto0["m_strOrderBy"] = "ORDER BY Nama";
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
	"m_strName" => "id_bos",
	"m_strTable" => "agenda_bos"
));

$proto5["m_expr"]=$obj;
$proto5["m_alias"] = "";
$obj = new SQLFieldListItem($proto5);

$proto0["m_fieldlist"][]=$obj;
						$proto7=array();
			$obj = new SQLField(array(
	"m_strName" => "id_unit",
	"m_strTable" => "agenda_bos"
));

$proto7["m_expr"]=$obj;
$proto7["m_alias"] = "";
$obj = new SQLFieldListItem($proto7);

$proto0["m_fieldlist"][]=$obj;
						$proto9=array();
			$obj = new SQLField(array(
	"m_strName" => "Nama",
	"m_strTable" => "agenda_bos"
));

$proto9["m_expr"]=$obj;
$proto9["m_alias"] = "";
$obj = new SQLFieldListItem($proto9);

$proto0["m_fieldlist"][]=$obj;
						$proto11=array();
			$obj = new SQLField(array(
	"m_strName" => "Jabatan",
	"m_strTable" => "agenda_bos"
));

$proto11["m_expr"]=$obj;
$proto11["m_alias"] = "";
$obj = new SQLFieldListItem($proto11);

$proto0["m_fieldlist"][]=$obj;
						$proto13=array();
			$obj = new SQLField(array(
	"m_strName" => "Telp",
	"m_strTable" => "agenda_bos"
));

$proto13["m_expr"]=$obj;
$proto13["m_alias"] = "";
$obj = new SQLFieldListItem($proto13);

$proto0["m_fieldlist"][]=$obj;
						$proto15=array();
			$obj = new SQLField(array(
	"m_strName" => "Foto",
	"m_strTable" => "agenda_bos"
));

$proto15["m_expr"]=$obj;
$proto15["m_alias"] = "";
$obj = new SQLFieldListItem($proto15);

$proto0["m_fieldlist"][]=$obj;
						$proto17=array();
			$obj = new SQLField(array(
	"m_strName" => "Alamat_Rumah",
	"m_strTable" => "agenda_bos"
));

$proto17["m_expr"]=$obj;
$proto17["m_alias"] = "";
$obj = new SQLFieldListItem($proto17);

$proto0["m_fieldlist"][]=$obj;
						$proto19=array();
			$obj = new SQLField(array(
	"m_strName" => "Alamat_Kantor",
	"m_strTable" => "agenda_bos"
));

$proto19["m_expr"]=$obj;
$proto19["m_alias"] = "";
$obj = new SQLFieldListItem($proto19);

$proto0["m_fieldlist"][]=$obj;
						$proto21=array();
			$obj = new SQLField(array(
	"m_strName" => "HP",
	"m_strTable" => "agenda_bos"
));

$proto21["m_expr"]=$obj;
$proto21["m_alias"] = "";
$obj = new SQLFieldListItem($proto21);

$proto0["m_fieldlist"][]=$obj;
						$proto23=array();
			$obj = new SQLField(array(
	"m_strName" => "email",
	"m_strTable" => "agenda_bos"
));

$proto23["m_expr"]=$obj;
$proto23["m_alias"] = "";
$obj = new SQLFieldListItem($proto23);

$proto0["m_fieldlist"][]=$obj;
$proto0["m_fromlist"] = array();
												$proto25=array();
$proto25["m_link"] = "SQLL_MAIN";
			$proto26=array();
$proto26["m_strName"] = "agenda_bos";
$proto26["m_columns"] = array();
$proto26["m_columns"][] = "id_bos";
$proto26["m_columns"][] = "id_unit";
$proto26["m_columns"][] = "Nama";
$proto26["m_columns"][] = "Jabatan";
$proto26["m_columns"][] = "Telp";
$proto26["m_columns"][] = "Foto";
$proto26["m_columns"][] = "Alamat_Rumah";
$proto26["m_columns"][] = "Alamat_Kantor";
$proto26["m_columns"][] = "HP";
$proto26["m_columns"][] = "email";
$obj = new SQLTable($proto26);

$proto25["m_table"] = $obj;
$proto25["m_alias"] = "";
$proto27=array();
$proto27["m_sql"] = "";
$proto27["m_uniontype"] = "SQLL_UNKNOWN";
	$obj = new SQLNonParsed(array(
	"m_sql" => ""
));

$proto27["m_column"]=$obj;
$proto27["m_contained"] = array();
$proto27["m_strCase"] = "";
$proto27["m_havingmode"] = "0";
$proto27["m_inBrackets"] = "0";
$proto27["m_useAlias"] = "0";
$obj = new SQLLogicalExpr($proto27);

$proto25["m_joinon"] = $obj;
$obj = new SQLFromListItem($proto25);

$proto0["m_fromlist"][]=$obj;
$proto0["m_groupby"] = array();
$proto0["m_orderby"] = array();
												$proto29=array();
						$obj = new SQLField(array(
	"m_strName" => "Nama",
	"m_strTable" => "agenda_bos"
));

$proto29["m_column"]=$obj;
$proto29["m_bAsc"] = 1;
$proto29["m_nColumn"] = 0;
$obj = new SQLOrderByItem($proto29);

$proto0["m_orderby"][]=$obj;					
$obj = new SQLQuery($proto0);

$queryData_Agenda_Pejabat = $obj;
$tdataAgenda_Pejabat[".sqlquery"] = $queryData_Agenda_Pejabat;



?>
