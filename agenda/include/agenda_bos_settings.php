<?php

//	field labels
$fieldLabelsagenda_bos = array();
$fieldLabelsagenda_bos["Indonesian"]=array();
$fieldLabelsagenda_bos["Indonesian"]["id_bos"] = "No";
$fieldLabelsagenda_bos["Indonesian"]["id_unit"] = "Unit Organisasi";
$fieldLabelsagenda_bos["Indonesian"]["Nama"] = "Nama lengkap";
$fieldLabelsagenda_bos["Indonesian"]["Jabatan"] = "Jabatan";
$fieldLabelsagenda_bos["Indonesian"]["Telp"] = "Telp";
$fieldLabelsagenda_bos["Indonesian"]["Foto"] = "Pas Foto";
$fieldLabelsagenda_bos["Indonesian"]["Alamat_Rumah"] = "Alamat Rumah";
$fieldLabelsagenda_bos["Indonesian"]["Alamat_Kantor"] = "Alamat Kantor";
$fieldLabelsagenda_bos["Indonesian"]["HP"] = "HP";
$fieldLabelsagenda_bos["Indonesian"]["email"] = "Email";


$tdataagenda_bos=array();
	$tdataagenda_bos[".ShortName"]="agenda_bos";
	$tdataagenda_bos[".OwnerID"]="";
	$tdataagenda_bos[".OriginalTable"]="agenda_bos";
	$tdataagenda_bos[".NCSearch"]=false;
	

$tdataagenda_bos[".shortTableName"] = "agenda_bos";
$tdataagenda_bos[".dataSourceTable"] = "agenda_bos";
$tdataagenda_bos[".nSecOptions"] = 0;
$tdataagenda_bos[".nLoginMethod"] = 1;
$tdataagenda_bos[".recsPerRowList"] = 1;	
$tdataagenda_bos[".tableGroupBy"] = "0";
$tdataagenda_bos[".dbType"] = 0;
$tdataagenda_bos[".mainTableOwnerID"] = "";
$tdataagenda_bos[".moveNext"] = 1;

$tdataagenda_bos[".listAjax"] = true;

	$tdataagenda_bos[".audit"] = false;

	$tdataagenda_bos[".locking"] = false;
	
$tdataagenda_bos[".listIcons"] = true;
$tdataagenda_bos[".edit"] = true;



$tdataagenda_bos[".delete"] = true;

$tdataagenda_bos[".showSimpleSearchOptions"] = false;

$tdataagenda_bos[".showSearchPanel"] = false;


$tdataagenda_bos[".isUseAjaxSuggest"] = false;

$tdataagenda_bos[".rowHighlite"] = true;

$tdataagenda_bos[".delFile"] = true;

// button handlers file names

// start on load js handlers








// end on load js handlers



$tdataagenda_bos[".arrKeyFields"][] = "id_bos";

// use datepicker for search panel
$tdataagenda_bos[".isUseCalendarForSearch"] = false;

// use timepicker for search panel
$tdataagenda_bos[".isUseTimeForSearch"] = false;






$tdataagenda_bos[".isUseInlineJs"] = $tdataagenda_bos[".isUseInlineAdd"] || $tdataagenda_bos[".isUseInlineEdit"];

$tdataagenda_bos[".allSearchFields"] = array();

$tdataagenda_bos[".globSearchFields"][] = "id_unit";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("id_unit", $tdataagenda_bos[".allSearchFields"]))
{
	$tdataagenda_bos[".allSearchFields"][] = "id_unit";	
}
$tdataagenda_bos[".globSearchFields"][] = "Nama";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("Nama", $tdataagenda_bos[".allSearchFields"]))
{
	$tdataagenda_bos[".allSearchFields"][] = "Nama";	
}
$tdataagenda_bos[".globSearchFields"][] = "Jabatan";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("Jabatan", $tdataagenda_bos[".allSearchFields"]))
{
	$tdataagenda_bos[".allSearchFields"][] = "Jabatan";	
}
$tdataagenda_bos[".globSearchFields"][] = "Telp";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("Telp", $tdataagenda_bos[".allSearchFields"]))
{
	$tdataagenda_bos[".allSearchFields"][] = "Telp";	
}
$tdataagenda_bos[".globSearchFields"][] = "Foto";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("Foto", $tdataagenda_bos[".allSearchFields"]))
{
	$tdataagenda_bos[".allSearchFields"][] = "Foto";	
}
$tdataagenda_bos[".globSearchFields"][] = "Alamat_Rumah";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("Alamat_Rumah", $tdataagenda_bos[".allSearchFields"]))
{
	$tdataagenda_bos[".allSearchFields"][] = "Alamat_Rumah";	
}
$tdataagenda_bos[".globSearchFields"][] = "Alamat_Kantor";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("Alamat_Kantor", $tdataagenda_bos[".allSearchFields"]))
{
	$tdataagenda_bos[".allSearchFields"][] = "Alamat_Kantor";	
}
$tdataagenda_bos[".globSearchFields"][] = "HP";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("HP", $tdataagenda_bos[".allSearchFields"]))
{
	$tdataagenda_bos[".allSearchFields"][] = "HP";	
}
$tdataagenda_bos[".globSearchFields"][] = "email";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("email", $tdataagenda_bos[".allSearchFields"]))
{
	$tdataagenda_bos[".allSearchFields"][] = "email";	
}

$tdataagenda_bos[".panelSearchFields"][] = "id_unit";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("id_unit", $tdataagenda_bos[".allSearchFields"])) 
{
	$tdataagenda_bos[".allSearchFields"][] = "id_unit";	
}
$tdataagenda_bos[".panelSearchFields"][] = "Nama";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("Nama", $tdataagenda_bos[".allSearchFields"])) 
{
	$tdataagenda_bos[".allSearchFields"][] = "Nama";	
}
$tdataagenda_bos[".panelSearchFields"][] = "Jabatan";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("Jabatan", $tdataagenda_bos[".allSearchFields"])) 
{
	$tdataagenda_bos[".allSearchFields"][] = "Jabatan";	
}
$tdataagenda_bos[".panelSearchFields"][] = "Telp";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("Telp", $tdataagenda_bos[".allSearchFields"])) 
{
	$tdataagenda_bos[".allSearchFields"][] = "Telp";	
}
$tdataagenda_bos[".panelSearchFields"][] = "Foto";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("Foto", $tdataagenda_bos[".allSearchFields"])) 
{
	$tdataagenda_bos[".allSearchFields"][] = "Foto";	
}
$tdataagenda_bos[".panelSearchFields"][] = "Alamat_Rumah";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("Alamat_Rumah", $tdataagenda_bos[".allSearchFields"])) 
{
	$tdataagenda_bos[".allSearchFields"][] = "Alamat_Rumah";	
}
$tdataagenda_bos[".panelSearchFields"][] = "Alamat_Kantor";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("Alamat_Kantor", $tdataagenda_bos[".allSearchFields"])) 
{
	$tdataagenda_bos[".allSearchFields"][] = "Alamat_Kantor";	
}
$tdataagenda_bos[".panelSearchFields"][] = "HP";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("HP", $tdataagenda_bos[".allSearchFields"])) 
{
	$tdataagenda_bos[".allSearchFields"][] = "HP";	
}
$tdataagenda_bos[".panelSearchFields"][] = "email";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("email", $tdataagenda_bos[".allSearchFields"])) 
{
	$tdataagenda_bos[".allSearchFields"][] = "email";	
}

$tdataagenda_bos[".isDynamicPerm"] = true;

	


$tdataagenda_bos[".isResizeColumns"] = false;


$tdataagenda_bos[".createLoginPage"] = true;


 	




$tdataagenda_bos[".pageSize"] = 5;

$gstrOrderBy = "ORDER BY id_bos";
if(strlen($gstrOrderBy) && strtolower(substr($gstrOrderBy,0,8))!="order by")
	$gstrOrderBy = "order by ".$gstrOrderBy;
$tdataagenda_bos[".strOrderBy"] = $gstrOrderBy;
	
$tdataagenda_bos[".orderindexes"] = array();
$tdataagenda_bos[".orderindexes"][] = array(1, (1 ? "ASC" : "DESC"), "id_bos");

$tdataagenda_bos[".sqlHead"] = "SELECT id_bos,  id_unit,  Nama,  Jabatan,  Telp,  Foto,  Alamat_Rumah,  Alamat_Kantor,  HP,  email";

$tdataagenda_bos[".sqlFrom"] = "FROM agenda_bos";

$tdataagenda_bos[".sqlWhereExpr"] = "";

$tdataagenda_bos[".sqlTail"] = "";



	$tableKeys=array();
	$tableKeys[]="id_bos";
	$tdataagenda_bos[".Keys"]=$tableKeys;

	
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
			
				$fdata["FieldPermissions"]=true;
								$tdataagenda_bos["id_bos"]=$fdata;
	
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
			$tdataagenda_bos["id_unit"]=$fdata;
	
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
			$tdataagenda_bos["Nama"]=$fdata;
	
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
			$tdataagenda_bos["Jabatan"]=$fdata;
	
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
			$tdataagenda_bos["Telp"]=$fdata;
	
//	Foto
	$fdata = array();
	$fdata["strName"] = "Foto";
	$fdata["ownerTable"] = "agenda_bos";
		$fdata["Label"]="Pas Foto"; 
			$fdata["LinkPrefix"]="foto/"; 
	$fdata["FieldType"]= 200;
				$fdata["UseiBox"] = false;
	$fdata["EditFormat"]= "Document upload";
	$fdata["ViewFormat"]= "Document Download";
	
	

		
			
	$fdata["GoodName"]= "Foto";
		$fdata["FullName"]= "Foto";
				$fdata["UseTimestamp"]=true; 
		$fdata["UploadFolder"]="foto"; 
		$fdata["Index"]= 6;
	
			 $fdata["bListPage"]=true; 
				$fdata["FieldPermissions"]=true;
					$fdata["ResizeImage"]=true;
	$fdata["NewSize"]=200;
			$fdata["ListPage"]=true;
			$tdataagenda_bos["Foto"]=$fdata;
	
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
	
				$fdata["FieldPermissions"]=true;
								$tdataagenda_bos["Alamat_Rumah"]=$fdata;
	
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
	
				$fdata["FieldPermissions"]=true;
								$tdataagenda_bos["Alamat_Kantor"]=$fdata;
	
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
			$tdataagenda_bos["HP"]=$fdata;
	
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
			$tdataagenda_bos["email"]=$fdata;

	
$tables_data["agenda_bos"]=&$tdataagenda_bos;
$field_labels["agenda_bos"] = &$fieldLabelsagenda_bos;

// -----------------start  prepare master-details data arrays ------------------------------//
// tables which are detail tables for current table (master)
$detailsTablesData["agenda_bos"] = array();

	
// tables which are master tables for current table (detail)
$masterTablesData["agenda_bos"] = array();

// -----------------end  prepare master-details data arrays ------------------------------//

require_once(getabspath("classes/sql.php"));










$proto117=array();
$proto117["m_strHead"] = "SELECT";
$proto117["m_strFieldList"] = "id_bos,  id_unit,  Nama,  Jabatan,  Telp,  Foto,  Alamat_Rumah,  Alamat_Kantor,  HP,  email";
$proto117["m_strFrom"] = "FROM agenda_bos";
$proto117["m_strWhere"] = "";
$proto117["m_strOrderBy"] = "ORDER BY id_bos";
$proto117["m_strTail"] = "";
$proto118=array();
$proto118["m_sql"] = "";
$proto118["m_uniontype"] = "SQLL_UNKNOWN";
	$obj = new SQLNonParsed(array(
	"m_sql" => ""
));

$proto118["m_column"]=$obj;
$proto118["m_contained"] = array();
$proto118["m_strCase"] = "";
$proto118["m_havingmode"] = "0";
$proto118["m_inBrackets"] = "0";
$proto118["m_useAlias"] = "0";
$obj = new SQLLogicalExpr($proto118);

$proto117["m_where"] = $obj;
$proto120=array();
$proto120["m_sql"] = "";
$proto120["m_uniontype"] = "SQLL_UNKNOWN";
	$obj = new SQLNonParsed(array(
	"m_sql" => ""
));

$proto120["m_column"]=$obj;
$proto120["m_contained"] = array();
$proto120["m_strCase"] = "";
$proto120["m_havingmode"] = "0";
$proto120["m_inBrackets"] = "0";
$proto120["m_useAlias"] = "0";
$obj = new SQLLogicalExpr($proto120);

$proto117["m_having"] = $obj;
$proto117["m_fieldlist"] = array();
						$proto122=array();
			$obj = new SQLField(array(
	"m_strName" => "id_bos",
	"m_strTable" => "agenda_bos"
));

$proto122["m_expr"]=$obj;
$proto122["m_alias"] = "";
$obj = new SQLFieldListItem($proto122);

$proto117["m_fieldlist"][]=$obj;
						$proto124=array();
			$obj = new SQLField(array(
	"m_strName" => "id_unit",
	"m_strTable" => "agenda_bos"
));

$proto124["m_expr"]=$obj;
$proto124["m_alias"] = "";
$obj = new SQLFieldListItem($proto124);

$proto117["m_fieldlist"][]=$obj;
						$proto126=array();
			$obj = new SQLField(array(
	"m_strName" => "Nama",
	"m_strTable" => "agenda_bos"
));

$proto126["m_expr"]=$obj;
$proto126["m_alias"] = "";
$obj = new SQLFieldListItem($proto126);

$proto117["m_fieldlist"][]=$obj;
						$proto128=array();
			$obj = new SQLField(array(
	"m_strName" => "Jabatan",
	"m_strTable" => "agenda_bos"
));

$proto128["m_expr"]=$obj;
$proto128["m_alias"] = "";
$obj = new SQLFieldListItem($proto128);

$proto117["m_fieldlist"][]=$obj;
						$proto130=array();
			$obj = new SQLField(array(
	"m_strName" => "Telp",
	"m_strTable" => "agenda_bos"
));

$proto130["m_expr"]=$obj;
$proto130["m_alias"] = "";
$obj = new SQLFieldListItem($proto130);

$proto117["m_fieldlist"][]=$obj;
						$proto132=array();
			$obj = new SQLField(array(
	"m_strName" => "Foto",
	"m_strTable" => "agenda_bos"
));

$proto132["m_expr"]=$obj;
$proto132["m_alias"] = "";
$obj = new SQLFieldListItem($proto132);

$proto117["m_fieldlist"][]=$obj;
						$proto134=array();
			$obj = new SQLField(array(
	"m_strName" => "Alamat_Rumah",
	"m_strTable" => "agenda_bos"
));

$proto134["m_expr"]=$obj;
$proto134["m_alias"] = "";
$obj = new SQLFieldListItem($proto134);

$proto117["m_fieldlist"][]=$obj;
						$proto136=array();
			$obj = new SQLField(array(
	"m_strName" => "Alamat_Kantor",
	"m_strTable" => "agenda_bos"
));

$proto136["m_expr"]=$obj;
$proto136["m_alias"] = "";
$obj = new SQLFieldListItem($proto136);

$proto117["m_fieldlist"][]=$obj;
						$proto138=array();
			$obj = new SQLField(array(
	"m_strName" => "HP",
	"m_strTable" => "agenda_bos"
));

$proto138["m_expr"]=$obj;
$proto138["m_alias"] = "";
$obj = new SQLFieldListItem($proto138);

$proto117["m_fieldlist"][]=$obj;
						$proto140=array();
			$obj = new SQLField(array(
	"m_strName" => "email",
	"m_strTable" => "agenda_bos"
));

$proto140["m_expr"]=$obj;
$proto140["m_alias"] = "";
$obj = new SQLFieldListItem($proto140);

$proto117["m_fieldlist"][]=$obj;
$proto117["m_fromlist"] = array();
												$proto142=array();
$proto142["m_link"] = "SQLL_MAIN";
			$proto143=array();
$proto143["m_strName"] = "agenda_bos";
$proto143["m_columns"] = array();
$proto143["m_columns"][] = "id_bos";
$proto143["m_columns"][] = "id_unit";
$proto143["m_columns"][] = "Nama";
$proto143["m_columns"][] = "Jabatan";
$proto143["m_columns"][] = "Telp";
$proto143["m_columns"][] = "Foto";
$proto143["m_columns"][] = "Alamat_Rumah";
$proto143["m_columns"][] = "Alamat_Kantor";
$proto143["m_columns"][] = "HP";
$proto143["m_columns"][] = "email";
$obj = new SQLTable($proto143);

$proto142["m_table"] = $obj;
$proto142["m_alias"] = "";
$proto144=array();
$proto144["m_sql"] = "";
$proto144["m_uniontype"] = "SQLL_UNKNOWN";
	$obj = new SQLNonParsed(array(
	"m_sql" => ""
));

$proto144["m_column"]=$obj;
$proto144["m_contained"] = array();
$proto144["m_strCase"] = "";
$proto144["m_havingmode"] = "0";
$proto144["m_inBrackets"] = "0";
$proto144["m_useAlias"] = "0";
$obj = new SQLLogicalExpr($proto144);

$proto142["m_joinon"] = $obj;
$obj = new SQLFromListItem($proto142);

$proto117["m_fromlist"][]=$obj;
$proto117["m_groupby"] = array();
$proto117["m_orderby"] = array();
												$proto146=array();
						$obj = new SQLField(array(
	"m_strName" => "id_bos",
	"m_strTable" => "agenda_bos"
));

$proto146["m_column"]=$obj;
$proto146["m_bAsc"] = 1;
$proto146["m_nColumn"] = 0;
$obj = new SQLOrderByItem($proto146);

$proto117["m_orderby"][]=$obj;					
$obj = new SQLQuery($proto117);

$queryData_agenda_bos = $obj;
$tdataagenda_bos[".sqlquery"] = $queryData_agenda_bos;



?>
