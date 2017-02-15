<?php 
include("include/dbcommon.php");

@ini_set("display_errors","1");
@ini_set("display_startup_errors","1");

header("Expires: Thu, 01 Jan 1970 00:00:01 GMT");
header("Pragma: no-cache");
header("Cache-Control: no-cache");

include("include/admin_users_variables.php");
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
	$templatefile = "admin_users_inline_add.htm";
else
	$templatefile = "admin_users_add.htm";

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
			'mShortTableName':'admin_users', 
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
//	processing Username - start
    
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd==ADD_INLINE;
	if($inlineAddOption)
	{
	$value = postvalue("value_Username_".$id);
	$type=postvalue("type_Username_".$id);
	if (FieldSubmitted("Username_".$id))
	{
		$value=prepare_for_db("Username",$value,$type);
	}
	else
		$value=false;
	if(!($value===false))
	{


		if(1 && "Username"=="Passw" && $url_page=="admin_users_")
			$value=md5($value);
		$avalues["Username"]=$value;
	}
	}
//	processibng Username - end
//	processing Nama_Lengkap - start
    
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd==ADD_INLINE;
	if($inlineAddOption)
	{
	$value = postvalue("value_Nama_Lengkap_".$id);
	$type=postvalue("type_Nama_Lengkap_".$id);
	if (FieldSubmitted("Nama_Lengkap_".$id))
	{
		$value=prepare_for_db("Nama_Lengkap",$value,$type);
	}
	else
		$value=false;
	if(!($value===false))
	{


		if(1 && "Nama_Lengkap"=="Passw" && $url_page=="admin_users_")
			$value=md5($value);
		$avalues["Nama_Lengkap"]=$value;
	}
	}
//	processibng Nama_Lengkap - end
//	processing Instansi - start
    
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd==ADD_INLINE;
	if($inlineAddOption)
	{
	$value = postvalue("value_Instansi_".$id);
	$type=postvalue("type_Instansi_".$id);
	if (FieldSubmitted("Instansi_".$id))
	{
		$value=prepare_for_db("Instansi",$value,$type);
	}
	else
		$value=false;
	if(!($value===false))
	{


		if(1 && "Instansi"=="Passw" && $url_page=="admin_users_")
			$value=md5($value);
		$avalues["Instansi"]=$value;
	}
	}
//	processibng Instansi - end
//	processing NIP - start
    
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd==ADD_INLINE;
	if($inlineAddOption)
	{
	$value = postvalue("value_NIP_".$id);
	$type=postvalue("type_NIP_".$id);
	if (FieldSubmitted("NIP_".$id))
	{
		$value=prepare_for_db("NIP",$value,$type);
	}
	else
		$value=false;
	if(!($value===false))
	{


		if(1 && "NIP"=="Passw" && $url_page=="admin_users_")
			$value=md5($value);
		$avalues["NIP"]=$value;
	}
	}
//	processibng NIP - end
//	processing Alamat_Kantor - start
    
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd==ADD_INLINE;
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
//	processing Telp_Kantor - start
    
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd==ADD_INLINE;
	if($inlineAddOption)
	{
	$value = postvalue("value_Telp_Kantor_".$id);
	$type=postvalue("type_Telp_Kantor_".$id);
	if (FieldSubmitted("Telp_Kantor_".$id))
	{
		$value=prepare_for_db("Telp_Kantor",$value,$type);
	}
	else
		$value=false;
	if(!($value===false))
	{


		if(1 && "Telp_Kantor"=="Passw" && $url_page=="admin_users_")
			$value=md5($value);
		$avalues["Telp_Kantor"]=$value;
	}
	}
//	processibng Telp_Kantor - end
//	processing Telp_HP - start
    
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd==ADD_INLINE;
	if($inlineAddOption)
	{
	$value = postvalue("value_Telp_HP_".$id);
	$type=postvalue("type_Telp_HP_".$id);
	if (FieldSubmitted("Telp_HP_".$id))
	{
		$value=prepare_for_db("Telp_HP",$value,$type);
	}
	else
		$value=false;
	if(!($value===false))
	{


		if(1 && "Telp_HP"=="Passw" && $url_page=="admin_users_")
			$value=md5($value);
		$avalues["Telp_HP"]=$value;
	}
	}
//	processibng Telp_HP - end



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
					$message .='&nbsp;<a href=\'admin_users_edit.php?'.$keylink.'\'>Edit</a>&nbsp;';
				if(GetTableData($strTableName,".view",false) && $permis['search'])
					$message .='&nbsp;<a href=\'admin_users_view.php?'.$keylink.'\'>View</a>&nbsp;';
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
	header("Location: admin_users_".$pageObject->getPageType().".php");
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
		$copykeys["id_user"]=postvalue("copyid1");
	}
	else
	{
		$copykeys["id_user"]=postvalue("editid1");
	}
	$strWhere=KeyWhere($copykeys);
	$strSQL = gSQLWhere($strWhere);

	LogInfo($strSQL);
	$rs=db_query($strSQL,$conn);
	$defvalues=db_fetch_array($rs);
	if(!$defvalues)
		$defvalues=array();
//	clear key fields
	$defvalues["id_user"]="";
//call CopyOnLoad event
	if(function_exists("CopyOnLoad"))
		CopyOnLoad($defvalues,$strWhere);
}
else
{
}

if($readavalues)
{
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
	
	
	if($inlineadd!=ADD_ONTHEFLY)
	{
		if($onsubmit)
			$onsubmit="onsubmit=\"".htmlspecialchars($onsubmit)."\"";
		
		$pageObject->body["begin"] .= $includes;
		$xt->assign("backbutton_attrs","onclick=\"window.location.href='admin_users_list.php?a=return'\"");
		$xt->assign("back_button",true);
		
		$xt->assign('addForm', array('begin'=>'<form name="'.$formname.'" id="'.$formname.'" encType="multipart/form-data" method="post" action="admin_users_add.php" '.$onsubmit.'>'.		
			'<input type=hidden name="a" value="added">'.
			($isShowDetailTables ? '<input type=hidden name="editType" value="addmaster">' : ''), 'end'=>'</form>'));
	}
	else
	{
		$destroyCtrls = "Runner.controls.ControlManager.unregister('".htmlspecialchars(jsreplace($strTableName))."');";
		$onsubmit="onsubmit=\"".htmlspecialchars($onsubmit.$destroyCtrls)."\"";
		
		$pageObject->body["begin"] .='<form name="'.$formname.'" id="'.$formname.'" encType="multipart/form-data" method="post" action="admin_users_add.php" '.$onsubmit.' target="flyframe'.$id.'">'.
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

	$showKeys[] = htmlspecialchars($keys["id_user"]);

	$keylink="";
	$keylink.="&key1=".htmlspecialchars(rawurlencode(@$data["id_user"]));

////////////////////////////////////////////
//	Username - 
	$display = false;
	if($inlineadd==ADD_INLINE)
		$display = true;
	if($display)
	{	
		$value="";
				$value = ProcessLargeText(GetData($data,"Username", ""),"field=Username".$keylink,"",MODE_LIST);
		$showValues[] = $value;
		$showFields[] = "Username";
				$showRawValues[] = substr($data["Username"],0,100);
	}	
//	Nama_Lengkap - 
	$display = false;
	if($inlineadd==ADD_INLINE)
		$display = true;
	if($display)
	{	
		$value="";
				$value = ProcessLargeText(GetData($data,"Nama_Lengkap", ""),"field=Nama%5FLengkap".$keylink,"",MODE_LIST);
		$showValues[] = $value;
		$showFields[] = "Nama_Lengkap";
				$showRawValues[] = substr($data["Nama_Lengkap"],0,100);
	}	
//	Instansi - 
	$display = false;
	if($inlineadd==ADD_INLINE)
		$display = true;
	if($display)
	{	
		$value="";
				$value = ProcessLargeText(GetData($data,"Instansi", ""),"field=Instansi".$keylink,"",MODE_LIST);
		$showValues[] = $value;
		$showFields[] = "Instansi";
				$showRawValues[] = substr($data["Instansi"],0,100);
	}	
//	NIP - 
	$display = false;
	if($inlineadd==ADD_INLINE)
		$display = true;
	if($display)
	{	
		$value="";
				$value = ProcessLargeText(GetData($data,"NIP", ""),"field=NIP".$keylink,"",MODE_LIST);
		$showValues[] = $value;
		$showFields[] = "NIP";
				$showRawValues[] = substr($data["NIP"],0,100);
	}	
//	Alamat_Kantor - 
	$display = false;
	if($inlineadd==ADD_INLINE)
		$display = true;
	if($display)
	{	
		$value="";
				$value = ProcessLargeText(GetData($data,"Alamat_Kantor", ""),"field=Alamat%5FKantor".$keylink,"",MODE_LIST);
		$showValues[] = $value;
		$showFields[] = "Alamat_Kantor";
				$showRawValues[] = substr($data["Alamat_Kantor"],0,100);
	}	
//	Telp_Kantor - 
	$display = false;
	if($inlineadd==ADD_INLINE)
		$display = true;
	if($display)
	{	
		$value="";
				$value = ProcessLargeText(GetData($data,"Telp_Kantor", ""),"field=Telp%5FKantor".$keylink,"",MODE_LIST);
		$showValues[] = $value;
		$showFields[] = "Telp_Kantor";
				$showRawValues[] = substr($data["Telp_Kantor"],0,100);
	}	
//	Telp_HP - 
	$display = false;
	if($inlineadd==ADD_INLINE)
		$display = true;
	if($display)
	{	
		$value="";
				$value = ProcessLargeText(GetData($data,"Telp_HP", ""),"field=Telp%5FHP".$keylink,"",MODE_LIST);
		$showValues[] = $value;
		$showFields[] = "Telp_HP";
				$showRawValues[] = substr($data["Telp_HP"],0,100);
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
//	control - Username
$control_Username=array();
$control_Username["func"]="xt_buildeditcontrol";
$control_Username["params"] = array();
$control_Username["params"]["field"]="Username";
$control_Username["params"]["value"]=@$defvalues["Username"];

//	Begin Add validation
$arrValidate = array();	
$control_Username["params"]["validate"]=$arrValidate;
//	End Add validation

$control_Username["params"]["id"]=$id;
if($inlineadd==ADD_INLINE || $inlineadd==ADD_ONTHEFLY)
	$control_Username["params"]["mode"]="inline_add";
else
	$control_Username["params"]["mode"]="add";
if(!$detailKeys || !in_array("Username", $detailKeys))
	$xt->assignbyref("Username_editcontrol",$control_Username);
else if(array_key_exists("Username", $defvalues))
{
				$value = ProcessLargeText(GetData($defvalues,"Username", ""),"field=Username","",MODE_VIEW);
		$xt->assignbyref("Username_editcontrol",$value);
}
// add prevent submit on enter js if only one text record
//	control - Nama_Lengkap
$control_Nama_Lengkap=array();
$control_Nama_Lengkap["func"]="xt_buildeditcontrol";
$control_Nama_Lengkap["params"] = array();
$control_Nama_Lengkap["params"]["field"]="Nama_Lengkap";
$control_Nama_Lengkap["params"]["value"]=@$defvalues["Nama_Lengkap"];

//	Begin Add validation
$arrValidate = array();	
$control_Nama_Lengkap["params"]["validate"]=$arrValidate;
//	End Add validation

$control_Nama_Lengkap["params"]["id"]=$id;
if($inlineadd==ADD_INLINE || $inlineadd==ADD_ONTHEFLY)
	$control_Nama_Lengkap["params"]["mode"]="inline_add";
else
	$control_Nama_Lengkap["params"]["mode"]="add";
if(!$detailKeys || !in_array("Nama_Lengkap", $detailKeys))
	$xt->assignbyref("Nama_Lengkap_editcontrol",$control_Nama_Lengkap);
else if(array_key_exists("Nama_Lengkap", $defvalues))
{
				$value = ProcessLargeText(GetData($defvalues,"Nama_Lengkap", ""),"field=Nama%5FLengkap","",MODE_VIEW);
		$xt->assignbyref("Nama_Lengkap_editcontrol",$value);
}
// add prevent submit on enter js if only one text record
//	control - Instansi
$control_Instansi=array();
$control_Instansi["func"]="xt_buildeditcontrol";
$control_Instansi["params"] = array();
$control_Instansi["params"]["field"]="Instansi";
$control_Instansi["params"]["value"]=@$defvalues["Instansi"];

//	Begin Add validation
$arrValidate = array();	
$control_Instansi["params"]["validate"]=$arrValidate;
//	End Add validation

$control_Instansi["params"]["id"]=$id;
if($inlineadd==ADD_INLINE || $inlineadd==ADD_ONTHEFLY)
	$control_Instansi["params"]["mode"]="inline_add";
else
	$control_Instansi["params"]["mode"]="add";
if(!$detailKeys || !in_array("Instansi", $detailKeys))
	$xt->assignbyref("Instansi_editcontrol",$control_Instansi);
else if(array_key_exists("Instansi", $defvalues))
{
				$value = ProcessLargeText(GetData($defvalues,"Instansi", ""),"field=Instansi","",MODE_VIEW);
		$xt->assignbyref("Instansi_editcontrol",$value);
}
// add prevent submit on enter js if only one text record
//	control - NIP
$control_NIP=array();
$control_NIP["func"]="xt_buildeditcontrol";
$control_NIP["params"] = array();
$control_NIP["params"]["field"]="NIP";
$control_NIP["params"]["value"]=@$defvalues["NIP"];

//	Begin Add validation
$arrValidate = array();	
$control_NIP["params"]["validate"]=$arrValidate;
//	End Add validation

$control_NIP["params"]["id"]=$id;
if($inlineadd==ADD_INLINE || $inlineadd==ADD_ONTHEFLY)
	$control_NIP["params"]["mode"]="inline_add";
else
	$control_NIP["params"]["mode"]="add";
if(!$detailKeys || !in_array("NIP", $detailKeys))
	$xt->assignbyref("NIP_editcontrol",$control_NIP);
else if(array_key_exists("NIP", $defvalues))
{
				$value = ProcessLargeText(GetData($defvalues,"NIP", ""),"field=NIP","",MODE_VIEW);
		$xt->assignbyref("NIP_editcontrol",$value);
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
//	control - Telp_Kantor
$control_Telp_Kantor=array();
$control_Telp_Kantor["func"]="xt_buildeditcontrol";
$control_Telp_Kantor["params"] = array();
$control_Telp_Kantor["params"]["field"]="Telp_Kantor";
$control_Telp_Kantor["params"]["value"]=@$defvalues["Telp_Kantor"];

//	Begin Add validation
$arrValidate = array();	
$control_Telp_Kantor["params"]["validate"]=$arrValidate;
//	End Add validation

$control_Telp_Kantor["params"]["id"]=$id;
if($inlineadd==ADD_INLINE || $inlineadd==ADD_ONTHEFLY)
	$control_Telp_Kantor["params"]["mode"]="inline_add";
else
	$control_Telp_Kantor["params"]["mode"]="add";
if(!$detailKeys || !in_array("Telp_Kantor", $detailKeys))
	$xt->assignbyref("Telp_Kantor_editcontrol",$control_Telp_Kantor);
else if(array_key_exists("Telp_Kantor", $defvalues))
{
				$value = ProcessLargeText(GetData($defvalues,"Telp_Kantor", ""),"field=Telp%5FKantor","",MODE_VIEW);
		$xt->assignbyref("Telp_Kantor_editcontrol",$value);
}
// add prevent submit on enter js if only one text record
//	control - Telp_HP
$control_Telp_HP=array();
$control_Telp_HP["func"]="xt_buildeditcontrol";
$control_Telp_HP["params"] = array();
$control_Telp_HP["params"]["field"]="Telp_HP";
$control_Telp_HP["params"]["value"]=@$defvalues["Telp_HP"];

//	Begin Add validation
$arrValidate = array();	
$control_Telp_HP["params"]["validate"]=$arrValidate;
//	End Add validation

$control_Telp_HP["params"]["id"]=$id;
if($inlineadd==ADD_INLINE || $inlineadd==ADD_ONTHEFLY)
	$control_Telp_HP["params"]["mode"]="inline_add";
else
	$control_Telp_HP["params"]["mode"]="add";
if(!$detailKeys || !in_array("Telp_HP", $detailKeys))
	$xt->assignbyref("Telp_HP_editcontrol",$control_Telp_HP);
else if(array_key_exists("Telp_HP", $defvalues))
{
				$value = ProcessLargeText(GetData($defvalues,"Telp_HP", ""),"field=Telp%5FHP","",MODE_VIEW);
		$xt->assignbyref("Telp_HP_editcontrol",$value);
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
	$strTableName = "admin_users";
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
$pageObject->xt->assign("legendBreak", '<br/>');


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
