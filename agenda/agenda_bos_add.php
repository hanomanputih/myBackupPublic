<?php 
include("include/dbcommon.php");

@ini_set("display_errors","1");
@ini_set("display_startup_errors","1");

header("Expires: Thu, 01 Jan 1970 00:00:01 GMT");
header("Pragma: no-cache");
header("Cache-Control: no-cache");

include("include/agenda_bos_variables.php");
include('include/xtempl.php');
include('classes/runnerpage.php');

//	check if logged in
if(@$_SESSION["UserID"] && IsAdmin() && !CheckSecurity(@$_SESSION["_".$strTableName."_OwnerID"],"Add"))
{
	echo "<p>"."Anda tidak punya ijin untuk mengakses tabel ini"."<br>Proceed to <a href=\"admin.php\">Admin Area</a> to set up user permissions</p>";
	return;
}
if(!@$_SESSION["UserID"] || !CheckSecurity(@$_SESSION["_".$strTableName."_OwnerID"],"Add"))
{ 
	$_SESSION["MyURL"]=$_SERVER["SCRIPT_NAME"]."?".$_SERVER["QUERY_STRING"];
	header("Location: login.php?message=expired"); 
	return;
}


$filename="";
$status="";
$message="";
$mesClass = "";
$usermessage="";
$error_happened=false;
$readavalues=false;

$keys=array();
$showKeys = array();
$showValues = array();
$showRawValues = array();
$showFields = array();
$showDetailKeys = array();
$IsSaved = false;
$HaveData = true;

$sessionPrefix = $strTableName;

if(@$_REQUEST["editType"]=="inline")
	$inlineadd=ADD_INLINE;
elseif(@$_REQUEST["editType"]=="onthefly")
{
	$inlineadd=ADD_ONTHEFLY;
	$sessionPrefix = $strTableName."_add";	
}
elseif(@$_REQUEST["editType"]=="addmaster")
	$inlineadd=ADD_MASTER;
else
	$inlineadd=ADD_SIMPLE;

if($inlineadd==ADD_INLINE)
	$templatefile = "agenda_bos_inline_add.htm";
else
	$templatefile = "agenda_bos_add.htm";

if($inlineadd==ADD_ONTHEFLY)
	$id=postvalue("id");	
elseif($inlineadd==ADD_INLINE)
	$id=postvalue("recordID");
else
{
	$id=postvalue("id");
	if(intval($id)==0)
		$id = 1;
}
//If undefined session value for mastet table, but exist post value master table, than take second
//It may be happen only when use dpInline mode on page add
if(!@$_SESSION[$sessionPrefix."_mastertable"] && postvalue("mastertable"))
	$_SESSION[$sessionPrefix."_mastertable"] = postvalue("mastertable");
//Get detail table keys	
$detailKeys = array();
$detailKeys = GetDetailKeysByMasterTable($_SESSION[$sessionPrefix."_mastertable"], $strTableName);	

$xt = new Xtempl();
	
// assign an id		
$xt->assign("id",$id);
$formname="editform".$id;
	

$auditObj = GetAuditObject($strTableName);

//array of params for classes
$params = array("pageType" => PAGE_ADD,"id" => $id,"mode" => $inlineadd);

$params['tName'] = $strTableName;
$params['xt'] = &$xt;
$params['includes_js']=$includes_js;
$params['includes_jsreq']=$includes_jsreq;
$params['includes_css']=$includes_css;
$params['locale_info']=$locale_info;

$pageObject = new RunnerPage($params);

$isCaptchaOk=1;
// proccess captcha
if ($inlineadd==ADD_SIMPLE || $inlineadd==ADD_MASTER)
{
	
}
// end proccess captcha

// add onload event
$onLoadJsCode = GetTableData($pageObject->tName, ".jsOnloadAdd", '');
$pageObject->addOnLoadJsEvent($onLoadJsCode);


if ($inlineadd==ADD_SIMPLE)
{
	// add button events if exist
	$buttonHandlers = GetTableData($pageObject->tName, ".buttonHandlers_".$pageObject->getPageType(), array());
	$pageObject->addButtonHandlers($buttonHandlers);
}
$url_page=substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1,12);

$isShowDetailTables = displayDetailsOn($strTableName,PAGE_ADD);
$dpParams = array();
if($isShowDetailTables && ($inlineadd==ADD_SIMPLE || $inlineadd==ADD_MASTER))
{
	$ids = $id;
	if($inlineadd==ADD_SIMPLE)
	{
		$pageObject->AddJSCode("window.dpObj = new dpInlineOnAddEdit({
			'mTableName':'".jsreplace($strTableName)."',
			'mShortTableName':'agenda_bos', 
			'mForm':$('#".$formname."'),
			'mPageType':'".PAGE_ADD."',
			'mMessage':'', 
			'mId':".$id.",
			'ext':'php',
			'dMessages':'', 
			'dCaptions':[],
			'dInlineObjs':[]});
			window.dpInline".$id." = new detailsPreviewInline({'pageId':".$id.",'mode':'add_master'}); 
			window.dpInline".$id.".createPreviewIframe();");
		$pageObject->AddJSFile("detailspreview");
	}
}

//	Before Process event
if(function_exists("BeforeProcessAdd"))
	BeforeProcessAdd($conn);

// insert new record if we have to
if(@$_POST["a"]=="added")
{
	$afilename_values=array();
	$avalues=array();
	$blobfields=array();
	$files_move=array();
	$files_save=array();
//	processing id_unit - start
    
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
	$value = postvalue("value_id_unit_".$id);
	$type=postvalue("type_id_unit_".$id);
	if (FieldSubmitted("id_unit_".$id))
	{
		$value=prepare_for_db("id_unit",$value,$type);
	}
	else
		$value=false;
	if(!($value===false))
	{


		if(1 && "id_unit"=="Passw" && $url_page=="admin_users_")
			$value=md5($value);
		$avalues["id_unit"]=$value;
	}
	}
//	processibng id_unit - end
//	processing Nama - start
    
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
	$value = postvalue("value_Nama_".$id);
	$type=postvalue("type_Nama_".$id);
	if (FieldSubmitted("Nama_".$id))
	{
		$value=prepare_for_db("Nama",$value,$type);
	}
	else
		$value=false;
	if(!($value===false))
	{


		if(1 && "Nama"=="Passw" && $url_page=="admin_users_")
			$value=md5($value);
		$avalues["Nama"]=$value;
	}
	}
//	processibng Nama - end
//	processing Jabatan - start
    
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
	$value = postvalue("value_Jabatan_".$id);
	$type=postvalue("type_Jabatan_".$id);
	if (FieldSubmitted("Jabatan_".$id))
	{
		$value=prepare_for_db("Jabatan",$value,$type);
	}
	else
		$value=false;
	if(!($value===false))
	{


		if(1 && "Jabatan"=="Passw" && $url_page=="admin_users_")
			$value=md5($value);
		$avalues["Jabatan"]=$value;
	}
	}
//	processibng Jabatan - end
//	processing Telp - start
    
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
	$value = postvalue("value_Telp_".$id);
	$type=postvalue("type_Telp_".$id);
	if (FieldSubmitted("Telp_".$id))
	{
		$value=prepare_for_db("Telp",$value,$type);
	}
	else
		$value=false;
	if(!($value===false))
	{


		if(1 && "Telp"=="Passw" && $url_page=="admin_users_")
			$value=md5($value);
		$avalues["Telp"]=$value;
	}
	}
//	processibng Telp - end
//	processing Foto - start
    
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
	$value = postvalue("value_Foto_".$id);
	$type=postvalue("type_Foto_".$id);
	if (FieldSubmitted("Foto_".$id))
	{
	$fileNameForPrepareFunc = postvalue("filename_Foto_".$id);
			$value=prepare_upload("Foto","upload2",$fileNameForPrepareFunc,$fileNameForPrepareFunc,"" ,$id);
			
	}
	else
		$value=false;
	if(!($value===false))
	{
		if($value)
			$contents = GetUploadedFileContents("value_Foto_".$id);


//	resize
		if($value)
		{
			}
		if(1 && "Foto"=="Passw" && $url_page=="admin_users_")
			$value=md5($value);
		$avalues["Foto"]=$value;
	}
	}
//	processibng Foto - end
//	processing Alamat_Rumah - start
    
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
	$value = postvalue("value_Alamat_Rumah_".$id);
	$type=postvalue("type_Alamat_Rumah_".$id);
	if (FieldSubmitted("Alamat_Rumah_".$id))
	{
		$value=prepare_for_db("Alamat_Rumah",$value,$type);
	}
	else
		$value=false;
	if(!($value===false))
	{


		if(1 && "Alamat_Rumah"=="Passw" && $url_page=="admin_users_")
			$value=md5($value);
		$avalues["Alamat_Rumah"]=$value;
	}
	}
//	processibng Alamat_Rumah - end
//	processing Alamat_Kantor - start
    
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
	$value = postvalue("value_Alamat_Kantor_".$id);
	$type=postvalue("type_Alamat_Kantor_".$id);
	if (FieldSubmitted("Alamat_Kantor_".$id))
	{
		$value=prepare_for_db("Alamat_Kantor",$value,$type);
	}
	else
		$value=false;
	if(!($value===false))
	{


		if(1 && "Alamat_Kantor"=="Passw" && $url_page=="admin_users_")
			$value=md5($value);
		$avalues["Alamat_Kantor"]=$value;
	}
	}
//	processibng Alamat_Kantor - end
//	processing HP - start
    
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
	$value = postvalue("value_HP_".$id);
	$type=postvalue("type_HP_".$id);
	if (FieldSubmitted("HP_".$id))
	{
		$value=prepare_for_db("HP",$value,$type);
	}
	else
		$value=false;
	if(!($value===false))
	{


		if(1 && "HP"=="Passw" && $url_page=="admin_users_")
			$value=md5($value);
		$avalues["HP"]=$value;
	}
	}
//	processibng HP - end
//	processing email - start
    
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
	$value = postvalue("value_email_".$id);
	$type=postvalue("type_email_".$id);
	if (FieldSubmitted("email_".$id))
	{
		$value=prepare_for_db("email",$value,$type);
	}
	else
		$value=false;
	if(!($value===false))
	{


		if(1 && "email"=="Passw" && $url_page=="admin_users_")
			$value=md5($value);
		$avalues["email"]=$value;
	}
	}
//	processibng email - end


	if(postvalue("table")=="agenda_hadir" && postvalue("field")=="id_bos") 
	{
		if(!array_key_exists("id_unit",$avalues))
			$avalues["id_unit"]=postvalue("category");
	}
	if(postvalue("table")=="agenda_hadir" && postvalue("field")=="Jabatan") 
	{
		if(!array_key_exists("id_bos",$avalues))
			$avalues["id_bos"]=postvalue("category");
	}

	$failed_inline_add=false;
//	add filenames to values
	foreach($afilename_values as $akey=>$value)
		$avalues[$akey]=$value;
	
//	before Add event
	$retval = true;
	if(function_exists("BeforeAdd"))
		$retval=BeforeAdd($avalues,$usermessage,$inlineadd);
	if($retval && $isCaptchaOk == 1)
	{
		if(DoInsertRecord($strOriginalTableName,$avalues,$blobfields,$id))
		{
			$IsSaved=true;
			
//	after edit event
			if($auditObj || function_exists("AfterAdd"))
			{
				foreach($keys as $idx=>$val)
					$avalues[$idx]=$val;
			}
			
			if($auditObj)
				$auditObj->LogAdd($strTableName,$avalues,$keys);

			if(function_exists("AfterAdd"))
				AfterAdd($avalues,$keys,$inlineadd);
				
			if($inlineadd==ADD_SIMPLE || $inlineadd==ADD_MASTER)
			{
				$_SESSION[$strTableName."_count_captcha"] = $_SESSION[$strTableName."_count_captcha"]+1;
				$permis = array();
				$keylink = "";$k = 0;
				foreach($keys as $idx=>$val)
				{
					if($k!=0)
						$keylink .="&";
					$keylink .="editid".(++$k)."=".htmlspecialchars(rawurlencode(@$val));
				}
				$permis = $pageObject->getPermissions();
				$message .="</br>";
				if(GetTableData($strTableName,".edit",false) && $permis['edit'])
					$message .='&nbsp;<a href=\'agenda_bos_edit.php?'.$keylink.'\'>Edit</a>&nbsp;';
				if(GetTableData($strTableName,".view",false) && $permis['search'])
					$message .='&nbsp;<a href=\'agenda_bos_view.php?'.$keylink.'\'>View</a>&nbsp;';
				$mesClass = "mes_ok";	
			}
		}
		else
			$mesClass = "mes_not";	
	}
	else
	{
		$message = $usermessage;
		$status="DECLINED";
		$readavalues=true;
	}
}

$message = "<div class='message ".$mesClass."'>".$message."</div>";

// PRG rule, to avoid POSTDATA resend
if (no_output_done() && $inlineadd==ADD_SIMPLE && $IsSaved)
{
	// saving message
	$_SESSION["message"] = ($message ? $message : "");
	// redirect
	header("Location: agenda_bos_".$pageObject->getPageType().".php");
	// turned on output buffering, so we need to stop script
	exit();
}

if($inlineadd==ADD_MASTER && $IsSaved)
	$_SESSION["message"] = ($message ? $message : "");
	
// for PRG rule, to avoid POSTDATA resend. Saving mess in session
if($inlineadd==ADD_SIMPLE && isset($_SESSION["message"]))
{
	$message = $_SESSION["message"];
	unset($_SESSION["message"]);
}

$defvalues=array();

//	copy record
if(array_key_exists("copyid1",$_REQUEST) || array_key_exists("editid1",$_REQUEST))
{
	$copykeys=array();
	if(array_key_exists("copyid1",$_REQUEST))
	{
		$copykeys["id_bos"]=postvalue("copyid1");
	}
	else
	{
		$copykeys["id_bos"]=postvalue("editid1");
	}
	$strWhere=KeyWhere($copykeys);
	$strSQL = gSQLWhere($strWhere);

	LogInfo($strSQL);
	$rs=db_query($strSQL,$conn);
	$defvalues=db_fetch_array($rs);
	if(!$defvalues)
		$defvalues=array();
//	clear key fields
	$defvalues["id_bos"]="";
//call CopyOnLoad event
	if(function_exists("CopyOnLoad"))
		CopyOnLoad($defvalues,$strWhere);
}
else
{
}

if(postvalue("table")=="agenda_hadir" && postvalue("field")=="id_bos") 
	$defvalues["id_unit"]=postvalue("category");
if(postvalue("table")=="agenda_hadir" && postvalue("field")=="Jabatan") 
	$defvalues["id_bos"]=postvalue("category");
if($readavalues)
{
	$defvalues["id_unit"]=@$avalues["id_unit"];
	$defvalues["Nama"]=@$avalues["Nama"];
	$defvalues["Jabatan"]=@$avalues["Jabatan"];
	$defvalues["Telp"]=@$avalues["Telp"];
	$defvalues["Alamat_Rumah"]=@$avalues["Alamat_Rumah"];
	$defvalues["Alamat_Kantor"]=@$avalues["Alamat_Kantor"];
	$defvalues["HP"]=@$avalues["HP"];
	$defvalues["email"]=@$avalues["email"];
}
//for basic files
$includes="";
if ($inlineadd!==ADD_INLINE && $inlineadd!=ADD_ONTHEFLY)
	$pageObject->addJSCode("AddEventForControl('".jsreplace($strTableName)."', '', ".$id.");\r\n");

		
	
$onsubmit = $pageObject->onSubmitForEditingPage($formname);
	

//////////////////////////////////////////////////////////////////	
////////////////////// time picker
//////////////////////

$pageObject->AddJSFile('customlabels');
if(isset($params["calendar"]))
	$pageObject->AddJSFile("calendar");
if($inlineadd!=ADD_INLINE)
{
	if($inlineadd!=ADD_ONTHEFLY)
	{
		$includes .="<script language=\"JavaScript\" src=\"include/jquery.js\"></script>\r\n";
		$includes .="<script language=\"JavaScript\" src=\"include/jsfunctions.js\"></script>\r\n";	
		if ($pageObject->debugJSMode===true)
		{
			$includes .= "<script type=\"text/javascript\" src=\"include/runnerJS/Runner.js\"></script>";
			$includes .= "<script type=\"text/javascript\" src=\"include/runnerJS/Util.js\"></script>";
		}
		else 
		{
			$includes .= "<script type=\"text/javascript\" src=\"include/runnerJS/RunnerBase.js\"></script>";
		}
		$pageObject->AddJSFile("ajaxsuggest");		
		$includes.="<script language=\"JavaScript\" src=\"include/jsfunctions.js\"></script>\r\n";
		$includes.="<div id=\"search_suggest\"></div>\r\n";
	}
	$xt->assign("id_unit_fieldblock",true);
	$xt->assign("id_unit_label",true);
	if(isEnableSection508())
		$xt->assign_section("id_unit_label","<label for=\"".GetInputElementId("id_unit", $id)."\">","</label>");
	$xt->assign("Nama_fieldblock",true);
	$xt->assign("Nama_label",true);
	if(isEnableSection508())
		$xt->assign_section("Nama_label","<label for=\"".GetInputElementId("Nama", $id)."\">","</label>");
	$xt->assign("Jabatan_fieldblock",true);
	$xt->assign("Jabatan_label",true);
	if(isEnableSection508())
		$xt->assign_section("Jabatan_label","<label for=\"".GetInputElementId("Jabatan", $id)."\">","</label>");
	$xt->assign("Telp_fieldblock",true);
	$xt->assign("Telp_label",true);
	if(isEnableSection508())
		$xt->assign_section("Telp_label","<label for=\"".GetInputElementId("Telp", $id)."\">","</label>");
	$xt->assign("Foto_fieldblock",true);
	$xt->assign("Foto_label",true);
	if(isEnableSection508())
		$xt->assign_section("Foto_label","<label for=\"".GetInputElementId("Foto", $id)."\">","</label>");
	$xt->assign("Alamat_Rumah_fieldblock",true);
	$xt->assign("Alamat_Rumah_label",true);
	if(isEnableSection508())
		$xt->assign_section("Alamat_Rumah_label","<label for=\"".GetInputElementId("Alamat_Rumah", $id)."\">","</label>");
	$xt->assign("Alamat_Kantor_fieldblock",true);
	$xt->assign("Alamat_Kantor_label",true);
	if(isEnableSection508())
		$xt->assign_section("Alamat_Kantor_label","<label for=\"".GetInputElementId("Alamat_Kantor", $id)."\">","</label>");
	$xt->assign("HP_fieldblock",true);
	$xt->assign("HP_label",true);
	if(isEnableSection508())
		$xt->assign_section("HP_label","<label for=\"".GetInputElementId("HP", $id)."\">","</label>");
	$xt->assign("email_fieldblock",true);
	$xt->assign("email_label",true);
	if(isEnableSection508())
		$xt->assign_section("email_label","<label for=\"".GetInputElementId("email", $id)."\">","</label>");
	
	
	if($inlineadd!=ADD_ONTHEFLY)
	{
		if($onsubmit)
			$onsubmit="onsubmit=\"".htmlspecialchars($onsubmit)."\"";
		
		$pageObject->body["begin"] .= $includes;
		$xt->assign("backbutton_attrs","onclick=\"window.location.href='agenda_bos_list.php?a=return'\"");
		$xt->assign("back_button",true);
		
		$xt->assign('addForm', array('begin'=>'<form name="'.$formname.'" id="'.$formname.'" encType="multipart/form-data" method="post" action="agenda_bos_add.php" '.$onsubmit.'>'.		
			'<input type=hidden name="a" value="added">'.
			($isShowDetailTables ? '<input type=hidden name="editType" value="addmaster">' : ''), 'end'=>'</form>'));
	}
	else
	{
		$destroyCtrls = "Runner.controls.ControlManager.unregister('".htmlspecialchars(jsreplace($strTableName))."');";
		$onsubmit="onsubmit=\"".htmlspecialchars($onsubmit.$destroyCtrls)."\"";
		
		$pageObject->body["begin"] .='<form name="'.$formname.'" id="'.$formname.'" encType="multipart/form-data" method="post" action="agenda_bos_add.php" '.$onsubmit.' target="flyframe'.$id.'">'.
		'<input type=hidden name="a" value="added">'.
		'<input type=hidden name="editType" value="onthefly">'.
		'<input type=hidden name="table" value="'.postvalue('table').'">'.
		'<input type=hidden name="field" value="'.postvalue('field').'">'.
		'<input type=hidden name="category" value="'.postvalue('category').'">'.
		'<input type=hidden name="id" value="'.$id.'">';

		$xt->assign("cancelbutton_attrs", "onclick=\"RemoveFlyDiv('".$id."');".$destroyCtrls."\"");
		$xt->assign("cancel_button",true);
		$xt->assign("header","");
		// destroy controls befor destroy win		
		//$xt->assign("savebutton_attrs","onclick=\"$destroyCtrls\"");		
	}
	$xt->assign("save_button",true);
}

if($message)
{
	$xt->assign("message_block",true);
	$xt->assign("message",$message);
}
//$xt->assign("status",$status);

$readonlyfields=array();

//	show readonly fields
$linkdata="";

if(!$inlineadd==ADD_INLINE) 
	$pageObject->AddJSCode("SetToFirstControl('".$formname."');");
	
if(@$_POST["a"]=="added" && $inlineadd==ADD_ONTHEFLY && !$error_happened && $status!="DECLINED")
{
	$LookupSQL="";
	if(postvalue("table")=="agenda_hadir" && postvalue("field")=="id_bos") 
	{
	$linkfield = "id_bos";
	$dispfield = "Nama";
	$LookupSQL = "select ";
	$LookupSQL .= "`id_bos`";
		$LookupSQL .= ",`Nama`";
	}
	if(postvalue("table")=="agenda_hasil" && postvalue("field")=="id_hadir") 
	{
	$linkfield = "id_bos";
	$dispfield = "Nama";
	$LookupSQL = "select ";
	$LookupSQL .= "`id_bos`";
		$LookupSQL .= ",`Nama`";
	}
	if($LookupSQL)
		$LookupSQL.=" from ".AddTableWrappers($strOriginalTableName);

	$data=0;
	if(count($keys) && $LookupSQL)
	{
		$where=KeyWhere($keys);
		$LookupSQL.=" where ".$where;
		$rs=db_query($LookupSQL,$conn);
		$data=db_fetch_numarray($rs);
	}
	if(!$data)
	{
		$data=array(@$avalues[$linkfield],@$avalues[$dispfield]);
	}
	echo "<textarea id=\"data\">";
	echo "added";
	print_inline_array($data);
	echo "</textarea>";
	exit();
}

if(@$_POST["a"]=="added" && ($inlineadd==ADD_INLINE || $inlineadd==ADD_MASTER)) 
{
	//Preparation   view values
	//	get current values and show edit controls
	$dispFieldAlias = "";
	$data=0;
	if(count($keys))
	{
		$where=KeyWhere($keys);
			
		$sqlHead = $gQuery->HeadToSql();
		$sqlGroupBy = $gQuery->GroupByToSql();
		$oHaving = $gQuery->Having();
		$sqlHaving = $oHaving->toSql($gQuery);
		
		$dispFieldAlias = postvalue('dispFieldAlias');
		$dispField = postvalue('dispField');
		
		if ($dispFieldAlias)
		{
			$sqlHead.=", ".($dispField)." as ".AddFieldWrappers($dispFieldAlias)." ";
		}
		$strSQL = gSQLWhere_having($sqlHead, $gsqlFrom, $gsqlWhereExpr, $sqlGroupBy, $sqlHaving, $where, '');		
		
		LogInfo($strSQL);
		$rs=db_query($strSQL,$conn);
		$data=db_fetch_array($rs);
	}
	if(!$data)
	{
		$data=$avalues;
		$HaveData=false;
	}
	//check if correct values added

	$showKeys[] = htmlspecialchars($keys["id_bos"]);

	$keylink="";
	$keylink.="&key1=".htmlspecialchars(rawurlencode(@$data["id_bos"]));

////////////////////////////////////////////
//	id_unit - 
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($inlineadd==ADD_INLINE)
		$display = true;
	if($display)
	{	
		$value="";
				$value=DisplayLookupWizard("id_unit",$data["id_unit"],$data,$keylink,MODE_LIST);
		$showValues[] = $value;
		$showFields[] = "id_unit";
				$showRawValues[] = substr($data["id_unit"],0,100);
	}	
//	Nama - 
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($inlineadd==ADD_INLINE)
		$display = true;
	if($display)
	{	
		$value="";
				$value = ProcessLargeText(GetData($data,"Nama", ""),"field=Nama".$keylink,"",MODE_LIST);
		$showValues[] = $value;
		$showFields[] = "Nama";
				$showRawValues[] = substr($data["Nama"],0,100);
	}	
//	Jabatan - 
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($inlineadd==ADD_INLINE)
		$display = true;
	if($display)
	{	
		$value="";
				$value = ProcessLargeText(GetData($data,"Jabatan", ""),"field=Jabatan".$keylink,"",MODE_LIST);
		$showValues[] = $value;
		$showFields[] = "Jabatan";
				$showRawValues[] = substr($data["Jabatan"],0,100);
	}	
//	Telp - 
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($inlineadd==ADD_INLINE)
		$display = true;
	if($display)
	{	
		$value="";
				$value = ProcessLargeText(GetData($data,"Telp", ""),"field=Telp".$keylink,"",MODE_LIST);
		$showValues[] = $value;
		$showFields[] = "Telp";
				$showRawValues[] = substr($data["Telp"],0,100);
	}	
//	Foto - Document Download
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($inlineadd==ADD_INLINE)
		$display = true;
	if($display)
	{	
		$value="";
				$value = GetData($data,"Foto", "Document Download");
		$showValues[] = $value;
		$showFields[] = "Foto";
				$showRawValues[] = substr($data["Foto"],0,100);
	}	
//	Alamat_Rumah - 
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($display)
	{	
		$value="";
				$value = ProcessLargeText(GetData($data,"Alamat_Rumah", ""),"field=Alamat%5FRumah".$keylink,"",MODE_LIST);
		$showValues[] = $value;
		$showFields[] = "Alamat_Rumah";
				$showRawValues[] = substr($data["Alamat_Rumah"],0,100);
	}	
//	Alamat_Kantor - 
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($display)
	{	
		$value="";
				$value = ProcessLargeText(GetData($data,"Alamat_Kantor", ""),"field=Alamat%5FKantor".$keylink,"",MODE_LIST);
		$showValues[] = $value;
		$showFields[] = "Alamat_Kantor";
				$showRawValues[] = substr($data["Alamat_Kantor"],0,100);
	}	
//	HP - 
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($inlineadd==ADD_INLINE)
		$display = true;
	if($display)
	{	
		$value="";
				$value = ProcessLargeText(GetData($data,"HP", ""),"field=HP".$keylink,"",MODE_LIST);
		$showValues[] = $value;
		$showFields[] = "HP";
				$showRawValues[] = substr($data["HP"],0,100);
	}	
//	email - 
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($inlineadd==ADD_INLINE)
		$display = true;
	if($display)
	{	
		$value="";
				$value = ProcessLargeText(GetData($data,"email", ""),"field=email".$keylink,"",MODE_LIST);
		$showValues[] = $value;
		$showFields[] = "email";
				$showRawValues[] = substr($data["email"],0,100);
	}	
	
	// for custom expression for display field
	if ($dispFieldAlias)
	{
		$showValues[] = $data[$dispFieldAlias];	
		$showFields[] = $dispFieldAlias;
		$showRawValues[] = substr($data[$dispFieldAlias],0,100);
	}		
	
	if($inlineadd==ADD_INLINE)
	{	
		echo "<textarea id=\"data\">";
		if($IsSaved && count($showValues))
		{
			if($HaveData)
				echo "saved";
			else
				echo "savnd";
			print_inline_array($showKeys);
			echo "\n";
			print_inline_array($showValues);
			echo "\n";
			print_inline_array($showFields);
			echo "\n";
			print_inline_array($showRawValues);
			echo "\n";
			print_inline_array($showDetailKeys,true);
			echo "\n";
			print_inline_array($showDetailKeys);
			echo "\n";
			echo str_replace(array("&","<","\\","\r","\n"),array("&amp;","&lt;","\\\\","\\r","\\n"),$usermessage);
		}
		else
		{
			if($status=="DECLINED")
				echo "decli";
			else
				echo "error";
			echo str_replace(array("&","<","\\","\r","\n"),array("&amp;","&lt;","\\\\","\\r","\\n"),$message);
		}
		echo "</textarea>";
		exit();
	}	
} 

/////////////////////////////////////////////////////////////
if($inlineadd==ADD_MASTER)
{
	echo "<textarea id=\"data\">";
	$code = "";
	if(($_POST["a"]=="added" && $IsSaved))
	{
		$code .= "window.dpObj.Opts.mSavedValues = {";
		for($i=0;$i<count($showFields);$i++)
			$code .= "'".jsreplace($showFields[$i])."':'".jsreplace($showValues[$i])."'".($i!=(count($showFields)-1) ? "," : "")." ";
		$code .= "};";
		for($i=0;$i<count($dpParams['ids']);$i++)
		{
			$data=0;
			if(count($keys))
			{
				$where=KeyWhere($keys);
							$strSQL = gSQLWhere($where);
				LogInfo($strSQL);
				$rs=db_query($strSQL,$conn);
				$data=db_fetch_array($rs);
			}
			if(!$data)
				$data=$avalues;
				
			$code .= "var obj = window.inlineEditing".$dpParams['ids'][$i].";
					  if(obj && obj.isSbmSuc){obj.mKeys = [";
			foreach($mKeys[$dpParams['strTableNames'][$i]] as $mk)
				$code .= "'".jsreplace($data[$mk])."',";
			$code = substr($code, 0, -1);
			$code .= "];}";
		}
		if((isset($_SESSION[$strTableName."_count_captcha"])) or ($_SESSION[$strTableName."_count_captcha"]>0) or ($_SESSION[$strTableName."_count_captcha"]<5))
			$code .= "window.dpObj.hideCaptcha();";	
		$code .= "window.dpObj.saveAllDetail();";
	}
	elseif(@$_REQUEST["isSbmSuc"]==='0')
		$code .= "window.dpObj.saveAllDetail();";
	elseif(!$isCaptchaOk)
		$code .= "window.dpObj.showHideInvalidCaptcha('show');";
	else
		$code .= "window.dpObj.Opts.mMessage =\"".$message."\";
				  window.dpObj.showMessage();
				  window.dpObj.showHideInvalidCaptcha('hide');";	
	echo $code."</textarea>";
	exit();
}


/////////////////////////////////////////////////////////////
//	prepare Edit Controls
/////////////////////////////////////////////////////////////
//	validation stuff
$regex='';
$regexmessage='';
$regextype = '';
//	control - id_unit
$control_id_unit=array();
$control_id_unit["func"]="xt_buildeditcontrol";
$control_id_unit["params"] = array();
$control_id_unit["params"]["field"]="id_unit";
$control_id_unit["params"]["value"]=@$defvalues["id_unit"];

//	Begin Add validation
$arrValidate = array();	
$control_id_unit["params"]["validate"]=$arrValidate;
//	End Add validation

$control_id_unit["params"]["id"]=$id;
if($inlineadd==ADD_INLINE || $inlineadd==ADD_ONTHEFLY)
	$control_id_unit["params"]["mode"]="inline_add";
else
	$control_id_unit["params"]["mode"]="add";
if(!$detailKeys || !in_array("id_unit", $detailKeys))
	$xt->assignbyref("id_unit_editcontrol",$control_id_unit);
else if(array_key_exists("id_unit", $defvalues))
{
				$value=DisplayLookupWizard("id_unit",$defvalues["id_unit"],$defvalues,"",MODE_VIEW);
		$xt->assignbyref("id_unit_editcontrol",$value);
}
// add prevent submit on enter js if only one text record
//	control - Nama
$control_Nama=array();
$control_Nama["func"]="xt_buildeditcontrol";
$control_Nama["params"] = array();
$control_Nama["params"]["field"]="Nama";
$control_Nama["params"]["value"]=@$defvalues["Nama"];

//	Begin Add validation
$arrValidate = array();	
$arrValidate['basicValidate'][] = "IsRequired";
$control_Nama["params"]["validate"]=$arrValidate;
//	End Add validation

$control_Nama["params"]["id"]=$id;
if($inlineadd==ADD_INLINE || $inlineadd==ADD_ONTHEFLY)
	$control_Nama["params"]["mode"]="inline_add";
else
	$control_Nama["params"]["mode"]="add";
if(!$detailKeys || !in_array("Nama", $detailKeys))
	$xt->assignbyref("Nama_editcontrol",$control_Nama);
else if(array_key_exists("Nama", $defvalues))
{
				$value = ProcessLargeText(GetData($defvalues,"Nama", ""),"field=Nama","",MODE_VIEW);
		$xt->assignbyref("Nama_editcontrol",$value);
}
// add prevent submit on enter js if only one text record
//	control - Jabatan
$control_Jabatan=array();
$control_Jabatan["func"]="xt_buildeditcontrol";
$control_Jabatan["params"] = array();
$control_Jabatan["params"]["field"]="Jabatan";
$control_Jabatan["params"]["value"]=@$defvalues["Jabatan"];

//	Begin Add validation
$arrValidate = array();	
$arrValidate['basicValidate'][] = "IsRequired";
$control_Jabatan["params"]["validate"]=$arrValidate;
//	End Add validation

$control_Jabatan["params"]["id"]=$id;
if($inlineadd==ADD_INLINE || $inlineadd==ADD_ONTHEFLY)
	$control_Jabatan["params"]["mode"]="inline_add";
else
	$control_Jabatan["params"]["mode"]="add";
if(!$detailKeys || !in_array("Jabatan", $detailKeys))
	$xt->assignbyref("Jabatan_editcontrol",$control_Jabatan);
else if(array_key_exists("Jabatan", $defvalues))
{
				$value = ProcessLargeText(GetData($defvalues,"Jabatan", ""),"field=Jabatan","",MODE_VIEW);
		$xt->assignbyref("Jabatan_editcontrol",$value);
}
// add prevent submit on enter js if only one text record
//	control - Telp
$control_Telp=array();
$control_Telp["func"]="xt_buildeditcontrol";
$control_Telp["params"] = array();
$control_Telp["params"]["field"]="Telp";
$control_Telp["params"]["value"]=@$defvalues["Telp"];

//	Begin Add validation
$arrValidate = array();	
$arrValidate['basicValidate'][] = "IsRequired";
$control_Telp["params"]["validate"]=$arrValidate;
//	End Add validation

$control_Telp["params"]["id"]=$id;
if($inlineadd==ADD_INLINE || $inlineadd==ADD_ONTHEFLY)
	$control_Telp["params"]["mode"]="inline_add";
else
	$control_Telp["params"]["mode"]="add";
if(!$detailKeys || !in_array("Telp", $detailKeys))
	$xt->assignbyref("Telp_editcontrol",$control_Telp);
else if(array_key_exists("Telp", $defvalues))
{
				$value = ProcessLargeText(GetData($defvalues,"Telp", ""),"field=Telp","",MODE_VIEW);
		$xt->assignbyref("Telp_editcontrol",$value);
}
// add prevent submit on enter js if only one text record
//	control - Foto
$control_Foto=array();
$control_Foto["func"]="xt_buildeditcontrol";
$control_Foto["params"] = array();
$control_Foto["params"]["field"]="Foto";
$control_Foto["params"]["value"]=@$defvalues["Foto"];

//	Begin Add validation
$arrValidate = array();	
$control_Foto["params"]["validate"]=$arrValidate;
//	End Add validation

$control_Foto["params"]["id"]=$id;
if($inlineadd==ADD_INLINE || $inlineadd==ADD_ONTHEFLY)
	$control_Foto["params"]["mode"]="inline_add";
else
	$control_Foto["params"]["mode"]="add";
if(!$detailKeys || !in_array("Foto", $detailKeys))
	$xt->assignbyref("Foto_editcontrol",$control_Foto);
else if(array_key_exists("Foto", $defvalues))
{
				$value = GetData($defvalues,"Foto", "Document Download");
		$xt->assignbyref("Foto_editcontrol",$value);
}
// add prevent submit on enter js if only one text record
//	control - Alamat_Rumah
$control_Alamat_Rumah=array();
$control_Alamat_Rumah["func"]="xt_buildeditcontrol";
$control_Alamat_Rumah["params"] = array();
$control_Alamat_Rumah["params"]["field"]="Alamat_Rumah";
$control_Alamat_Rumah["params"]["value"]=@$defvalues["Alamat_Rumah"];

//	Begin Add validation
$arrValidate = array();	
$control_Alamat_Rumah["params"]["validate"]=$arrValidate;
//	End Add validation

$control_Alamat_Rumah["params"]["id"]=$id;
if($inlineadd==ADD_INLINE || $inlineadd==ADD_ONTHEFLY)
	$control_Alamat_Rumah["params"]["mode"]="inline_add";
else
	$control_Alamat_Rumah["params"]["mode"]="add";
if(!$detailKeys || !in_array("Alamat_Rumah", $detailKeys))
	$xt->assignbyref("Alamat_Rumah_editcontrol",$control_Alamat_Rumah);
else if(array_key_exists("Alamat_Rumah", $defvalues))
{
				$value = ProcessLargeText(GetData($defvalues,"Alamat_Rumah", ""),"field=Alamat%5FRumah","",MODE_VIEW);
		$xt->assignbyref("Alamat_Rumah_editcontrol",$value);
}
// add prevent submit on enter js if only one text record
//	control - Alamat_Kantor
$control_Alamat_Kantor=array();
$control_Alamat_Kantor["func"]="xt_buildeditcontrol";
$control_Alamat_Kantor["params"] = array();
$control_Alamat_Kantor["params"]["field"]="Alamat_Kantor";
$control_Alamat_Kantor["params"]["value"]=@$defvalues["Alamat_Kantor"];

//	Begin Add validation
$arrValidate = array();	
$arrValidate['basicValidate'][] = "IsRequired";
$control_Alamat_Kantor["params"]["validate"]=$arrValidate;
//	End Add validation

$control_Alamat_Kantor["params"]["id"]=$id;
if($inlineadd==ADD_INLINE || $inlineadd==ADD_ONTHEFLY)
	$control_Alamat_Kantor["params"]["mode"]="inline_add";
else
	$control_Alamat_Kantor["params"]["mode"]="add";
if(!$detailKeys || !in_array("Alamat_Kantor", $detailKeys))
	$xt->assignbyref("Alamat_Kantor_editcontrol",$control_Alamat_Kantor);
else if(array_key_exists("Alamat_Kantor", $defvalues))
{
				$value = ProcessLargeText(GetData($defvalues,"Alamat_Kantor", ""),"field=Alamat%5FKantor","",MODE_VIEW);
		$xt->assignbyref("Alamat_Kantor_editcontrol",$value);
}
// add prevent submit on enter js if only one text record
//	control - HP
$control_HP=array();
$control_HP["func"]="xt_buildeditcontrol";
$control_HP["params"] = array();
$control_HP["params"]["field"]="HP";
$control_HP["params"]["value"]=@$defvalues["HP"];

//	Begin Add validation
$arrValidate = array();	
$control_HP["params"]["validate"]=$arrValidate;
//	End Add validation

$control_HP["params"]["id"]=$id;
if($inlineadd==ADD_INLINE || $inlineadd==ADD_ONTHEFLY)
	$control_HP["params"]["mode"]="inline_add";
else
	$control_HP["params"]["mode"]="add";
if(!$detailKeys || !in_array("HP", $detailKeys))
	$xt->assignbyref("HP_editcontrol",$control_HP);
else if(array_key_exists("HP", $defvalues))
{
				$value = ProcessLargeText(GetData($defvalues,"HP", ""),"field=HP","",MODE_VIEW);
		$xt->assignbyref("HP_editcontrol",$value);
}
// add prevent submit on enter js if only one text record
//	control - email
$control_email=array();
$control_email["func"]="xt_buildeditcontrol";
$control_email["params"] = array();
$control_email["params"]["field"]="email";
$control_email["params"]["value"]=@$defvalues["email"];

//	Begin Add validation
$arrValidate = array();	
$control_email["params"]["validate"]=$arrValidate;
//	End Add validation

$control_email["params"]["id"]=$id;
if($inlineadd==ADD_INLINE || $inlineadd==ADD_ONTHEFLY)
	$control_email["params"]["mode"]="inline_add";
else
	$control_email["params"]["mode"]="add";
if(!$detailKeys || !in_array("email", $detailKeys))
	$xt->assignbyref("email_editcontrol",$control_email);
else if(array_key_exists("email", $defvalues))
{
				$value = ProcessLargeText(GetData($defvalues,"email", ""),"field=email","",MODE_VIEW);
		$xt->assignbyref("email_editcontrol",$value);
}
// add prevent submit on enter js if only one text record
$pageObject->addCommonJs();
/////////////////////////////////////////////////////////////
if($isShowDetailTables)
{
	$options = array();
	//array of params for classes
	$options["mode"] = LIST_DETAILS;
	$options["pageType"] = PAGE_LIST;
	$options["masterPageType"] = PAGE_ADD;
	$options['masterTable'] = $strTableName;
	$options['firstTime'] = 1;

	$detailTables = array();
	for($d=0;$d<count($dpParams['ids']);$d++)
	{
		$strTableName = $dpParams['strTableNames'][$d];
		include("include/".GetTableURL($strTableName)."_settings.php");
		if(!$d)
		{
			include('classes/listpage.php');
			include('classes/listpage_embed.php');
			include('classes/listpage_dpinline.php');
			include("classes/searchclause.php");
		}
		$options['xt'] = new Xtempl();
		$options['id'] = $dpParams['ids'][$d];

		$listPageObject = ListPage::createListPage($strTableName,$options);
		// prepare code
		$listPageObject->prepareForBuildPage();
		
		if($listPageObject->isDispGrid())
		{
			$listJsFiles = array();
			$listCssFiles = array();
			
			//Add Detail's js code to master's code
			$pageObject->AddJSCode("\n /*---Begin code for detailsPreview_".$options['id']."---*/ \n".
									$listPageObject->grabAllJsCode().
									"\n /*---End code for detailsPreview_".$options['id']."---*/ \n");
			
			//Add detail's js files to master's files
			$listJsFiles = $listPageObject->grabAllJSFiles();
			for($i=0;$i<count($listJsFiles);$i++)
				$pageObject->AddJSFile($listJsFiles[$i]);
			
			//Add detail's css files to master's files	
			$listCssFiles = $listPageObject->grabAllCSSFiles();	
			for($i=0;$i<count($listCssFiles);$i++)
				$pageObject->AddCSSFile($listCssFiles[$i]);
		}
		$detailTables[] = array("displayDetailTable_".GoodFieldName($strTableName) => array("func" => "showDetailTable","params" => array("dpObject" => $listPageObject, "dpParams" => $strTableName)));
	}
	$xt->assign_loopsection("detail_tables",$detailTables);	
	$strTableName = "agenda_bos";
}
/////////////////////////////////////////////////////////////

$jscode = $pageObject->PrepareJS();
if($inlineadd!=ADD_ONTHEFLY && $inlineadd!=ADD_MASTER)
{
	if($inlineadd==ADD_INLINE)
	{
		$jscode=str_replace(array("&","<",">"),array("&amp;","&lt;","&gt;"),$jscode);
		$xt->assignbyref("linkdata",$jscode);
	}
	$pageObject->body["end"] .= "<script>".$jscode."</script>";
	$xt->assign("body",$pageObject->body);
	$xt->assign("flybody",true);
}
else
{
	if(!@$_POST["a"]=="added")
	{
		echo "<jscode>";
		echo str_replace(array("\\","\r","\n"),array("\\\\","\\r","\\n"),$jscode);;
		echo "</jscode>";
	}
	else if(@$_POST["a"]=="added" && ($error_happened || $status=="DECLINED"))
	{
		echo "<textarea id=\"data\">decli";
		//$jscode = "\n\rwindow.Runner = window.opener.Runner;console.log(window.Runner, window.opener.Runner);".$jscode;
		echo htmlspecialchars($jscode);
		echo "</textarea>";
	}
	$pageObject->body["end"] .= "</form>";
	$xt->assign("footer","");
	$xt->assign("flybody",$pageObject->body);
	$xt->assign("body",true);
}	



$xt->assign("style_block",true);
$pageObject->xt->assign("legend", true);


if(function_exists("BeforeShowAdd"))
	BeforeShowAdd($xt,$templatefile);

if($inlineadd==ADD_ONTHEFLY)
{
	$xt->load_template($templatefile);
	if(@$_POST["a"]=="added" && ($error_happened || $status=="DECLINED"))
	{
		echo "<textarea id=\"html\">";		
		$xt->display_loaded("style_block");
		$xt->display_loaded("flybody");
		echo "</textarea>";
	}
	else
	{		
		$xt->display_loaded("style_block");
		$xt->display_loaded("flybody");
	}
	
}
else
	$xt->display($templatefile);
?>
