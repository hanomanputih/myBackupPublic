<?php 
@ini_set("display_errors","1");
@ini_set("display_startup_errors","1");

include("include/dbcommon.php");
include("include/agenda_bos_variables.php");
include('include/xtempl.php');
include('classes/runnerpage.php');
include("classes/searchclause.php");

/////////////////////////////////////////////////////////////
//	check if logged in
/////////////////////////////////////////////////////////////
if(!@$_SESSION["UserID"] || !CheckSecurity(@$_SESSION["_".$strTableName."_OwnerID"],"Edit"))
{ 
	$_SESSION["MyURL"]=$_SERVER["SCRIPT_NAME"]."?".$_SERVER["QUERY_STRING"];
	header("Location: login.php?message=expired"); 
	return;
}

$auditObj = GetAuditObject($strTableName);
$lockingObj = GetLockingObject($strTableName);
if($lockingObj)
{
	$system_attrs = "style='visibility:hidden;'";
	$system_message = "";
}

if($_REQUEST["action"]!="")
{
	if($lockingObj)
	{
		$arrkeys = explode("&",refine($_REQUEST["keys"]));
		foreach($arrkeys as $ind=>$val)
		{
			$arrkeys[$ind]=urldecode($val);
		}
		if($_REQUEST["action"]=="unlock")
		{
			$lockingObj->UnlockRecord($strTableName,$arrkeys,$_REQUEST["sid"]);
			exit();	
		}
		else if($_REQUEST["action"]=="lockadmin" && (IsAdmin() || $_SESSION["AccessLevel"] == ACCESS_LEVEL_ADMINGROUP))
		{
			$lockingObj->UnlockAdmin($strTableName,$arrkeys,$_REQUEST["startEdit"]=="yes");
			if($_REQUEST["startEdit"]=="no")
				echo "unlock";
			else if($_REQUEST["startEdit"]=="yes")
				echo "lock";
			exit();	
		}
		else if($_REQUEST["action"]=="confirm")
		{
			if(!$lockingObj->ConfirmLock($strTableName,$arrkeys,$message));
				echo $message;
			exit();	
		}
	}
	else
	{
		exit();
	}
}

/////////////////////////////////////////////////////////////
//init variables
/////////////////////////////////////////////////////////////

$filename = "";
$status = "";
$message = "";
$mesClass = "";
$usermessage = "";
$error_happened = false;
$readevalues = false;
$bodyonload = "";
$key = array();
$next = array();
$prev = array();


$showKeys = array();
$showValues = array();
$showRawValues = array();
$showFields = array();
$showDetailKeys = array();
$IsSaved = false;
$HaveData = true;

$strWhereClause = "";
	
$inlineedit = (postvalue("editType")=="inline") ? true : false;
$templatefile = "agenda_bos_edit.htm";

//Get detail table keys	
$detailKeys = array();
$detailKeys = GetDetailKeysByMasterTable($_SESSION[$strTableName."_mastertable"], $strTableName);	

$xt = new Xtempl();

// SearchClause class stuff
if (isset($_SESSION[$strTableName.'_advsearch']))
	$searchClauseObj = unserialize($_SESSION[$strTableName.'_advsearch']);
else
{
	$allSearchFields = GetTableData($strTableName, '.allSearchFields', array());
	$searchClauseObj = new SearchClause($strTableName, $allSearchFields, $strTableName);
}
$searchClauseObj->parseRequest();
$_SESSION[$strTableName.'_advsearch'] = serialize($searchClauseObj);

if(postvalue("recordID"))
	$id = postvalue("recordID");
else 
{
	$id=postvalue("id");
	if(intval($id)==0)
		$id = 1;
}

// assign an id		
$xt->assign("id",$id);
$formname="editform".$id;

//array of params for classes
$params = array("pageType" => PAGE_EDIT,"id" => $id,"mode" => $inlineedit);
$enableCtrlsForEditing = true;

$params['tName'] = $strTableName;
$params['xt'] = &$xt;
$params['includes_js']=$includes_js;
$params['includes_jsreq']=$includes_jsreq;
$params['includes_css']=$includes_css;
$params['locale_info']=$locale_info;

$pageObject = new RunnerPage($params);

$isCaptchaOk=1;
// proccess captcha
if (!$inlineedit)
{
	
}
// end proccess captcha


// add onload event
$onLoadJsCode = GetTableData($pageObject->tName, ".jsOnloadEdit", '');
$pageObject->addOnLoadJsEvent($onLoadJsCode);


if (!$inlineedit)
{
	// add button events if exist
	$buttonHandlers = GetTableData($pageObject->tName, ".buttonHandlers_".$pageObject->getPageType(), array());
	$pageObject->addButtonHandlers($buttonHandlers);
}
//	Before Process event
if(function_exists("BeforeProcessEdit"))
	BeforeProcessEdit($conn);

$keys=array();
$savedKeys=array();
$skeys="";
$keys["id_bos"]=postvalue("editid1");
$savedKeys["id_bos"]=postvalue("editid1");
$skeys.=rawurlencode(postvalue("editid1"))."&";
if($skeys!="")
	$skeys=substr($skeys,0,-1);
	
$isShowDetailTables = displayDetailsOn($strTableName,PAGE_EDIT);	
$dpParams = array();
if($isShowDetailTables && !$inlineedit)
{
	$ids = $id;
	$pageObject->AddJSCode("window.dpObj = new dpInlineOnAddEdit({
			'mTableName':'".jsreplace($strTableName)."',
			'mForm':$('#".$formname."'),
			'mPageType':'".PAGE_EDIT."',
			'dMessages':'',
			'dCaptions':[],			
			'dInlineObjs':[]});");		
	$pageObject->AddJSFile("detailspreview");
}	
	
/////////////////////////////////////////////////////////////
//	process entered data, read and save
/////////////////////////////////////////////////////////////

if(@$_POST["a"] == "edited")
{
	$strWhereClause = whereAdd($strWhereClause,KeyWhere($keys));
		if(function_exists("AfterEdit") || function_exists("BeforeEdit") || $auditObj)
	{
		//	read old values
		$rsold=db_query(gSQLWhere($strWhereClause), $conn);
		$dataold=db_fetch_array($rsold);
	}
	$evalues=array();
	$efilename_values=array();
	$files_delete=array();
	$files_move=array();
	$files_save=array();
	$blobfields=array();

	$condition = !$inlineedit;

	if($condition)
	{
	$value = postvalue("value_id_bos_".$id);
	$type=postvalue("type_id_bos_".$id);
	if(FieldSubmitted("id_bos_".$id))
	{
		
		$value=prepare_for_db("id_bos",$value,$type);
	}
	else
	{
		$value=false;
	}
	if($value!==false)
	{	




		$evalues["id_bos"]=$value;
	}

//	update key value
	if($value!==false)
	{
		$keys["id_bos"]=$value;
	}

//	processibng id_bos - end
	}
	$condition = !$inlineedit;

	if($condition)
	{
	$value = postvalue("value_id_unit_".$id);
	$type=postvalue("type_id_unit_".$id);
	if(FieldSubmitted("id_unit_".$id))
	{
		
		$value=prepare_for_db("id_unit",$value,$type);
	}
	else
	{
		$value=false;
	}
	if($value!==false)
	{	




		$evalues["id_unit"]=$value;
	}


//	processibng id_unit - end
	}
	$condition = !$inlineedit;

	if($condition)
	{
	$value = postvalue("value_Nama_".$id);
	$type=postvalue("type_Nama_".$id);
	if(FieldSubmitted("Nama_".$id))
	{
		
		$value=prepare_for_db("Nama",$value,$type);
	}
	else
	{
		$value=false;
	}
	if($value!==false)
	{	




		$evalues["Nama"]=$value;
	}


//	processibng Nama - end
	}
	$condition = !$inlineedit;

	if($condition)
	{
	$value = postvalue("value_Jabatan_".$id);
	$type=postvalue("type_Jabatan_".$id);
	if(FieldSubmitted("Jabatan_".$id))
	{
		
		$value=prepare_for_db("Jabatan",$value,$type);
	}
	else
	{
		$value=false;
	}
	if($value!==false)
	{	




		$evalues["Jabatan"]=$value;
	}


//	processibng Jabatan - end
	}
	$condition = !$inlineedit;

	if($condition)
	{
	$value = postvalue("value_Telp_".$id);
	$type=postvalue("type_Telp_".$id);
	if(FieldSubmitted("Telp_".$id))
	{
		
		$value=prepare_for_db("Telp",$value,$type);
	}
	else
	{
		$value=false;
	}
	if($value!==false)
	{	




		$evalues["Telp"]=$value;
	}


//	processibng Telp - end
	}
	$condition = !$inlineedit;

	if($condition)
	{
	$value = postvalue("value_Foto_".$id);
	$type=postvalue("type_Foto_".$id);
	if(FieldSubmitted("Foto_".$id))
	{
		
			$fileNameForPrepareFunc = postvalue("filename_Foto_".$id);
		if($fileNameForPrepareFunc)
			$value = $fileNameForPrepareFunc;
		if(substr($type,0,4)=="file")
		{		
			$value = prepare_file($value,"Foto",$type,$fileNameForPrepareFunc ,$id);
		}
		else if(substr($type,0,6)=="upload")
		{		
			$value=prepare_upload("Foto",$type,$fileNameForPrepareFunc,$value,"" ,$id);
		}
			
	}
	else
	{
		$value=false;
	}
	if($value!==false)
	{	
		if($value)
		{
			$contents = GetUploadedFileContents("value_Foto_".$id);
		}


	// resize image on upload
	

		$evalues["Foto"]=$value;
	}


//	processibng Foto - end
	}
	$condition = !$inlineedit;

	if($condition)
	{
	$value = postvalue("value_Alamat_Rumah_".$id);
	$type=postvalue("type_Alamat_Rumah_".$id);
	if(FieldSubmitted("Alamat_Rumah_".$id))
	{
		
		$value=prepare_for_db("Alamat_Rumah",$value,$type);
	}
	else
	{
		$value=false;
	}
	if($value!==false)
	{	




		$evalues["Alamat_Rumah"]=$value;
	}


//	processibng Alamat_Rumah - end
	}
	$condition = !$inlineedit;

	if($condition)
	{
	$value = postvalue("value_Alamat_Kantor_".$id);
	$type=postvalue("type_Alamat_Kantor_".$id);
	if(FieldSubmitted("Alamat_Kantor_".$id))
	{
		
		$value=prepare_for_db("Alamat_Kantor",$value,$type);
	}
	else
	{
		$value=false;
	}
	if($value!==false)
	{	




		$evalues["Alamat_Kantor"]=$value;
	}


//	processibng Alamat_Kantor - end
	}
	$condition = !$inlineedit;

	if($condition)
	{
	$value = postvalue("value_HP_".$id);
	$type=postvalue("type_HP_".$id);
	if(FieldSubmitted("HP_".$id))
	{
		
		$value=prepare_for_db("HP",$value,$type);
	}
	else
	{
		$value=false;
	}
	if($value!==false)
	{	




		$evalues["HP"]=$value;
	}


//	processibng HP - end
	}
	$condition = !$inlineedit;

	if($condition)
	{
	$value = postvalue("value_email_".$id);
	$type=postvalue("type_email_".$id);
	if(FieldSubmitted("email_".$id))
	{
		
		$value=prepare_for_db("email",$value,$type);
	}
	else
	{
		$value=false;
	}
	if($value!==false)
	{	




		$evalues["email"]=$value;
	}


//	processibng email - end
	}

	foreach($efilename_values as $ekey=>$value)
	{
		$evalues[$ekey]=$value;
	}
	
	if($lockingObj )
	{
		$lockmessage="";
		if(!$lockingObj->ConfirmLock($strTableName,$savedKeys,$lockmessage))
		{
			$enableCtrlsForEditing = false;
			$system_attrs = "style='visibility:visible;'";
			if($inlineedit)
			{
				if(IsAdmin() || $_SESSION["AccessLevel"] == ACCESS_LEVEL_ADMINGROUP)
					echo $lockingObj->GetLockInfo($strTableName,$savedKeys,false,$id);
				else
					echo $lockmessage;
				exit();
			}
			else
			{
				if(IsAdmin() || $_SESSION["AccessLevel"] == ACCESS_LEVEL_ADMINGROUP)
					$system_message = $lockingObj->GetLockInfo($strTableName,$savedKeys,true,$id);
				else
					$system_message = $lockmessage;
			}
			$status="DECLINED";
			$readevalues=true;
		}
	}
	
	if($readevalues==false)
	{
	//	do event
		$retval=true;
		if(function_exists("BeforeEdit"))
		{
			$retval=BeforeEdit($evalues,$strWhereClause,$dataold,$keys,$usermessage,$inlineedit);
		}
		if($retval && $isCaptchaOk == 1)
		{		
			if(DoUpdateRecord($strOriginalTableName,$evalues,$blobfields,$strWhereClause,$id))
			{
				$IsSaved=true;
				
				//	after edit event
				if($lockingObj && $inlineedit)
				{
					$lockingObj->UnlockRecord($strTableName,$savedKeys,"");
				}
				if($auditObj || function_exists("AfterEdit"))
				{
					foreach($dataold as $idx=>$val)
					{
						if(!array_key_exists($idx,$evalues))
						{
							$evalues[$idx]=$val;
						}
					}
				}

				if($auditObj)
				{
					$auditObj->LogEdit($strTableName,$evalues,$dataold,$keys);
				}
				if(function_exists("AfterEdit"))
				{
					AfterEdit($evalues,KeyWhere($keys),$dataold,$keys,$inlineedit);
				}
				
				if(!$inlineedit)
				{	
					$_SESSION[$strTableName."_count_captcha"] = $_SESSION[$strTableName."_count_captcha"]+1;
					$mesClass = "mes_ok";	
				}
			}
			elseif(!$inlineedit)
				$mesClass = "mes_not";	
		}
		else
		{
			$readevalues=true;
			$message = $usermessage;
			$status="DECLINED";
		}
	}
	if($readevalues)
		$keys=$savedKeys;
}
//else
{
	/////////////////////////
	//Locking recors
	/////////////////////////

	if($lockingObj)
	{
		$enableCtrlsForEditing = $lockingObj->LockRecord($strTableName,$keys);
		if(!$enableCtrlsForEditing)
		{
			if($inlineedit)
			{
				if(IsAdmin() || $_SESSION["AccessLevel"] == ACCESS_LEVEL_ADMINGROUP)
					echo "lock ".$lockingObj->GetLockInfo($strTableName,$keys,false,$id);
				else
					echo "lock ".$lockingObj->LockUser;
				exit();
			}
			$system_attrs = "style='visibility:visible;'";

			$system_message = $lockingObj->LockUser;
			
			if(IsAdmin() || $_SESSION["AccessLevel"] == ACCESS_LEVEL_ADMINGROUP)
			{
				$rb = $lockingObj->GetLockInfo($strTableName,$keys,true,$id);
				if($rb!="")
				{
					$system_attrs = "style='visibility:visible;'";
					$system_message = $rb;
				}
			}
		}
	}
}

if($lockingObj && !$inlineedit)
{
	$pageObject->body["begin"] .='<div id="system_div'.$id.'" class="admin_message" '.$system_attrs.'>'.$system_message.'</div>';
}

$message = "<div class='message ".$mesClass."'>".$message."</div>";

// PRG rule, to avoid POSTDATA resend
if ($IsSaved && no_output_done() && !$inlineedit )
{
	// saving message
	$_SESSION["message"] = ($message ? $message : "");
	// key get query
	$keyGetQ = "";
		$keyGetQ.="editid1=".rawurldecode($keys["id_bos"])."&";
	// cut last &
	$keyGetQ = substr($keyGetQ, 0, strlen($keyGetQ)-1);	
	// redirect
	header("Location: agenda_bos_".$pageObject->getPageType().".php?".$keyGetQ);
	// turned on output buffering, so we need to stop script
	exit();
}
// for PRG rule, to avoid POSTDATA resend. Saving mess in session
if (!$inlineedit && isset($_SESSION["message"])){
	$message = $_SESSION["message"];
	unset($_SESSION["message"]);
}



/////////////////////////////////////////////////////////////
//	read current values from the database
/////////////////////////////////////////////////////////////
$query = $queryData_agenda_bos->Copy();



$strWhereClause = KeyWhere($keys);


$searchWhereClause = $searchClauseObj->getWhere(GetListOfFieldsByExprType(false));
$searchHavingClause = $searchClauseObj->getWhere(GetListOfFieldsByExprType(true));

$strWhereClause = whereAdd($strWhereClause,$searchWhereClause);
$strHavingClause = $searchHavingClause;

$strSQL = gSQLWhere($strWhereClause,$strHavingClause);

$strSQLbak = $strSQL;
//	Before Query event
if(function_exists("BeforeQueryEdit"))
	BeforeQueryEdit($strSQL, $strWhereClause);

if($strSQLbak == $strSQL)
{
	$strSQL = gSQLWhere($strWhereClause,$strHavingClause);
}	
LogInfo($strSQL);

$rs=db_query($strSQL, $conn);
$data=db_fetch_array($rs);

if(!$data)
{
	if(!$inlineedit)
	{
		header("Location: agenda_bos_list.php?a=return");
		exit();
	}
	else
		$data=array();
}

$readonlyfields=array();


if($readevalues)
{
	$data["id_bos"]=$evalues["id_bos"];
	$data["id_unit"]=$evalues["id_unit"];
	$data["Nama"]=$evalues["Nama"];
	$data["Jabatan"]=$evalues["Jabatan"];
	$data["Telp"]=$evalues["Telp"];
	$data["Alamat_Rumah"]=$evalues["Alamat_Rumah"];
	$data["Alamat_Kantor"]=$evalues["Alamat_Kantor"];
	$data["HP"]=$evalues["HP"];
	$data["email"]=$evalues["email"];
}
/////////////////////////////////////////////////////////////
//	assign values to $xt class, prepare page for displaying
/////////////////////////////////////////////////////////////
//Basic includes js files
$includes="";
//javascript code
if (!$inlineedit)
	$pageObject->addJSCode("AddEventForControl('".jsreplace($strTableName)."', prevNextButtonHandler,".$id.");\r\n");
	
//event for onsubmit
$onsubmit = $pageObject->onSubmitForEditingPage($formname);

////////////////////// time picker
//////////////////////
$pageObject->AddJSFile("customlabels");
if(isset($params["calendar"]))
	$pageObject->AddJSFile("calendar");
	
	
if(!$inlineedit)
{
	$includes .="<script language=\"JavaScript\" src=\"include/jquery.js\"></script>\r\n";
	$includes .="<script language=\"JavaScript\" src=\"include/jsfunctions.js\"></script>\r\n";	
	if ($pageObject->debugJSMode === true)
	{
		$includes.="<script language=\"JavaScript\" src=\"include/runnerJS/Runner.js\"></script>\r\n";
		$includes.="<script language=\"JavaScript\" src=\"include/runnerJS/RunnerEvent.js\"></script>\r\n";
		$includes.= "<script type=\"text/javascript\" src=\"include/runnerJS/Util.js\"></script>";	
	}
	else
	{
		$includes.="<script language=\"JavaScript\" src=\"include/runnerJS/RunnerBase.js\"></script>\r\n";
	}	
		
	$pageObject->AddJSFile("ajaxsuggest");	
	$includes.="<div id=\"search_suggest".$id."\"></div>\r\n";
	$xt->assign("id_bos_fieldblock",true);
	$xt->assign("id_bos_label",true);
	if(isEnableSection508())
		$xt->assign_section("id_bos_label","<label for=\"".GetInputElementId("id_bos", $id)."\">","</label>");
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
	
	if(strlen($onsubmit))
		$onsubmit="onSubmit=\"".htmlspecialchars($onsubmit)."\"";
	$pageObject->body["begin"] .= $includes;
	
	
	$hiddenKeys = '';
	$hiddenKeys .= "<input type=\"hidden\" name=\"editid1\" value=\"".htmlspecialchars($keys["id_bos"])."\">";
	$xt->assign("show_key1", htmlspecialchars(GetData($data,"id_bos", "")));
	
	$xt->assign('editForm', array('begin'=>'<form name="'.$formname.'" id="'.$formname.'" encType="multipart/form-data" method="post" action="agenda_bos_edit.php" '.$onsubmit.'>'.
		'<input type="hidden" name="a" value="edited">'.$hiddenKeys, 'end'=>'</form>'));
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//Begin Next Prev button
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////    
if(!@$_SESSION[$strTableName."_noNextPrev"])
{
	$where_next="";
	$where_prev="";
	$order_next="";
	$order_prev="";
	$arrFieldForSort=array();
	$arrHowFieldSort=array();
	$where=$_SESSION[$strTableName."_where"];
	
	if(GetFieldIndex("id_bos"))
		$key[]=GetFieldIndex("id_bos");
	
//if session mass sorting empty, then create it as a sheet
	if(@$_SESSION[$strTableName."_arrFieldForSort"] && @$_SESSION[$strTableName."_arrHowFieldSort"])
	{
		$arrFieldForSort=$_SESSION[$strTableName."_arrFieldForSort"];
		$arrHowFieldSort=$_SESSION[$strTableName."_arrHowFieldSort"];
		$lenArr=count($arrFieldForSort);
	}
	else
	{
		if(count($g_orderindexes))
		{
			for($i=0;$i<count($g_orderindexes);$i++)
			{
				$arrFieldForSort[]=$g_orderindexes[$i][0];
				$arrHowFieldSort[]=$g_orderindexes[$i][1];
			}
		}
		elseif($gstrOrderBy!='')
		{
			$_SESSION[$strTableName."_noNextPrev"] = 1;
		}
		
		if(count($key))
		{
			for($i=0;$i<count($key);$i++)
			{
				$idsearch=array_search($key[$i],$arrFieldForSort);
				if($idsearch===false)
				{
					$arrFieldForSort[]=$key[$i];
					$arrHowFieldSort[]="ASC";
				}
			}
		}
		
		$_SESSION[$strTableName."_arrFieldForSort"]=$arrFieldForSort;
		$_SESSION[$strTableName."_arrHowFieldSort"]=$arrHowFieldSort;
		$lenArr=count($arrFieldForSort);
	}
//if session order by empty, then create a line order		
	if(@$_SESSION[$strTableName."_order"])
	{
		$order_next=$_SESSION[$strTableName."_order"];
	}
	elseif($lenArr>0)
	{
		for($i=0;$i<$lenArr;$i++)
		{
			$order_next .=(GetFieldByIndex($arrFieldForSort[$i]) ? ($order_next!="" ? ", " : " ORDER BY ").$arrFieldForSort[$i]." ".$arrHowFieldSort[$i] : "");
		}
	}
//create a line where and order for the two queries
	if($lenArr>0 and count($key) and !$_SESSION[$strTableName."_noNextPrev"])
	{
		if($where)
			$where = "(".$where.") and ";
		$scob="";
		$flag=0;
		for($i=0;$i<$lenArr;$i++)
		{
			$fieldName=GetFieldByIndex($arrFieldForSort[$i]);
			if($fieldName)
			{
				$order_prev .=($order_prev!="" ? ", " : " ORDER BY ").$arrFieldForSort[$i].($arrHowFieldSort[$i]=="ASC" ? " DESC" : " ASC");
				$dbg=GetFullFieldName($fieldName);
				if(!is_null($data[$fieldName]))
				{
					$mdv=make_db_value($fieldName,$data[$fieldName]);
					$ga=($arrHowFieldSort[$i]=="ASC" ? ">" : "<");
					$gd=($arrHowFieldSort[$i]=="ASC" ? "<" : ">");
					$gasc=$dbg.$ga.$mdv;
					$gdesc=$dbg.$gd.$mdv;
					$gravn=($i!=$lenArr-1 ? $dbg."=".$mdv : "");
					$ganull=($ga=="<" ? " or ".$dbg." IS NULL" : "");
					$gdnull=($gd=="<" ? " or ".$dbg." IS NULL" : "");
				}
				else
				{
					$gasc=($arrHowFieldSort[$i]=="ASC" ? $dbg." IS NOT NULL" : "");
					$gdesc=($arrHowFieldSort[$i]=="ASC" ? "" : $dbg." IS NOT NULL");
					$gravn=($i!=$lenArr-1 ? $dbg." IS NULL" : "");
					$ganull=$gdnull="";
				}
				
				//create where clause for next sql
				$where_next .= ($where_next!="" ? " and (" : " (");
				if($gasc=="" && $gravn=="") 
					$where_next .= " 1=0 "; 
				else{
						if($gasc!="") 
							$where_next .= $gasc.$ganull;
						if($gasc!="" && $gravn!="")
							$where_next .= " or ";
						$where_next .= $gravn." ";
					}
				
				//create where clause for prev sql
				$where_prev .= ($where_prev!="" ? " and (" : " (");
				if($gdesc=="" && $gravn=="") 
					$where_prev .= " 1=0 ";
				else{
						
						if($gdesc!="")
							$where_prev .= $gdesc.$gdnull;
						if($gdesc!="" && $gravn!="") 
							$where_prev .= " or ";
						$where_prev .= $gravn." ";
					}
				$scob .=")";
			}
			else 
				$flag=1;
		}
		$where_next =$where_next.$scob;
		$where_prev =$where_prev.$scob;
		$where_next=whereAdd($where_next,SecuritySQL("Edit"));
		$where_prev=whereAdd($where_prev,SecuritySQL("Edit"));
		$oWhere = $query->Where();
		$where_next=whereAdd($where_next,$oWhere->toSql($query));
		$where_prev=whereAdd($where_prev,$oWhere->toSql($query));

		if($flag==1)
		{
			$order_next="";
			for($i=0;$i<$lenArr;$i++)
				$order_next .=(GetFieldByIndex($arrFieldForSort[$i]) ? ($order_next!="" ? ", " : " ORDER BY ").$arrFieldForSort[$i]." ".$arrHowFieldSort[$i] : "");
		}
		
		$query->ReplaceFieldsWithDummies(GetBinaryFieldsIndices());
		$sql_next = $query->toSql($where.$where_next, $order_next);
		$sql_prev = $query->toSql($where.$where_prev, $order_prev);
		
		if($where_next!="" and $order_next!="" and $where_prev!="" and $order_prev!="")
		{
					$sql_next.=" limit 1";
			$sql_prev.=" limit 1";
		
			$res_next=db_query($sql_next,$conn);		
			if($row_next=db_fetch_array($res_next))
			{
					$next[1]=$row_next["id_bos"];
			}
			
			$res_prev=db_query($sql_prev,$conn);	
			if($row_prev=db_fetch_array($res_prev))
			{
					$prev[1]=$row_prev["id_bos"];
			}
		}
	}
}
	$nextlink=$prevlink="";
	// reset button handler
	$resetEditors="";
	$unblRec="UnlockRecord('agenda_bos_edit.php','".$skeys."','',function(){window.location.href='agenda_bos_edit.php?";
	if(count($next))
	{
		$xt->assign("next_button",true);
				$nextlink .="editid1=".htmlspecialchars(rawurlencode($next[1]));
		$xt->assign("nextbutton_attrs","align=\"absmiddle\" onclick=\"".$unblRec.$nextlink."'});return false;\"");
		$resetEditors.="$('#next".$id."').attr('style','');$('#next".$id."').attr('disabled','');";
	}
	else 
		$xt->assign("next_button",false);
	if(count($prev))
	{
		$xt->assign("prev_button",true);
				$prevlink .="editid1=".htmlspecialchars(rawurlencode($prev[1]));
		$xt->assign("prevbutton_attrs","align=\"absmiddle\" onclick=\"".$unblRec.$prevlink."'});return false;\"");
		$resetEditors.="$('#prev".$id."').attr('style','');$('#prev".$id."').attr('disabled','');";
	}
	else 
		$xt->assign("prev_button",false);
	
	$resetEditors .= "Runner.controls.ControlManager.resetControlsForTable('".htmlspecialchars(jsreplace($strTableName))."');return false;";
	$xt->assign("resetbutton_attrs",'onclick="'.$resetEditors.'" onmouseover="this.focus();"');
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//End Next Prev button
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////    
	$xt->assign("backbutton_attrs","onclick=\"UnlockRecord('agenda_bos_edit.php','".$skeys."','',function(){window.location.href='agenda_bos_list.php?a=return'});return false;\"");
	// onmouseover event, for changing focus. Needed to proper submit form
	$onmouseover = "this.focus();";
	$onmouseover = 'onmouseover="'.$onmouseover.'"';
	
	if(!$enableCtrlsForEditing)
		$xt->assign("savebutton_attrs","disabled=true style='background-color:#dcdcdc' ".$onmouseover);
	else
		$xt->assign("savebutton_attrs",$onmouseover);
	
	$xt->assign("save_button",true);
	$xt->assign("reset_button",true);
	$xt->assign("back_button",true);
}
$showKeys[] = rawurlencode($keys["id_bos"]);
if($message)
{
	$xt->assign("message_block",true);
	$xt->assign("message",$message);
}
/////////////////////////////////////////////////////////////
//process readonly and auto-update fields
/////////////////////////////////////////////////////////////
//old way to disabled button prev next
	if(!$inlineedit) 
		$pageObject->AddJSCode($bodyonload."\r\n SetToFirstControl('".$formname."');\r\n");
	
/////////////////////////////////////////////////////////////
//	prepare Edit Controls
/////////////////////////////////////////////////////////////
//	validation stuff
$regex='';
$regexmessage='';
$regextype = '';
//	control - id_bos
$control_id_bos=array();
$control_id_bos["func"]="xt_buildeditcontrol";
$control_id_bos["params"] = array();
$control_id_bos["params"]["field"]="id_bos";
$control_id_bos["params"]["value"]=@$data["id_bos"];
//	Begin Add validation
$arrValidate = array();	
$validatetype = getJsValidatorName("Number");
$arrValidate['basicValidate'][] = $validatetype;

$arrValidate['basicValidate'][] = "IsRequired";

$control_id_bos["params"]["validate"]=$arrValidate;
//	End Add validation
$control_id_bos["params"]["id"]=$id;
$additionalCtrlParams = array();
$additionalCtrlParams["disabled"] = !$enableCtrlsForEditing;
$control_id_bos["params"]["additionalCtrlParams"]=$additionalCtrlParams;
if($inlineedit)
	$control_id_bos["params"]["mode"]="inline_edit";
else
	$control_id_bos["params"]["mode"]="edit";
if(!$detailKeys || !in_array("id_bos", $detailKeys))	
	$xt->assignbyref("id_bos_editcontrol",$control_id_bos);
else if(array_key_exists("id_bos",$data))
{
				$value = ProcessLargeText(GetData($data,"id_bos", ""),"field=id%5Fbos","",MODE_VIEW);
		$xt->assignbyref("id_bos_editcontrol",$value);
}


// add prevent submit on enter js if only one text record
//	control - id_unit
$control_id_unit=array();
$control_id_unit["func"]="xt_buildeditcontrol";
$control_id_unit["params"] = array();
$control_id_unit["params"]["field"]="id_unit";
$control_id_unit["params"]["value"]=@$data["id_unit"];
//	Begin Add validation
$arrValidate = array();	

$control_id_unit["params"]["validate"]=$arrValidate;
//	End Add validation
$control_id_unit["params"]["id"]=$id;
$additionalCtrlParams = array();
$additionalCtrlParams["disabled"] = !$enableCtrlsForEditing;
$control_id_unit["params"]["additionalCtrlParams"]=$additionalCtrlParams;
if($inlineedit)
	$control_id_unit["params"]["mode"]="inline_edit";
else
	$control_id_unit["params"]["mode"]="edit";
if(!$detailKeys || !in_array("id_unit", $detailKeys))	
	$xt->assignbyref("id_unit_editcontrol",$control_id_unit);
else if(array_key_exists("id_unit",$data))
{
				$value=DisplayLookupWizard("id_unit",$data["id_unit"],$data,"",MODE_VIEW);
		$xt->assignbyref("id_unit_editcontrol",$value);
}


// add prevent submit on enter js if only one text record
//	control - Nama
$control_Nama=array();
$control_Nama["func"]="xt_buildeditcontrol";
$control_Nama["params"] = array();
$control_Nama["params"]["field"]="Nama";
$control_Nama["params"]["value"]=@$data["Nama"];
//	Begin Add validation
$arrValidate = array();	

$arrValidate['basicValidate'][] = "IsRequired";

$control_Nama["params"]["validate"]=$arrValidate;
//	End Add validation
$control_Nama["params"]["id"]=$id;
$additionalCtrlParams = array();
$additionalCtrlParams["disabled"] = !$enableCtrlsForEditing;
$control_Nama["params"]["additionalCtrlParams"]=$additionalCtrlParams;
if($inlineedit)
	$control_Nama["params"]["mode"]="inline_edit";
else
	$control_Nama["params"]["mode"]="edit";
if(!$detailKeys || !in_array("Nama", $detailKeys))	
	$xt->assignbyref("Nama_editcontrol",$control_Nama);
else if(array_key_exists("Nama",$data))
{
				$value = ProcessLargeText(GetData($data,"Nama", ""),"field=Nama","",MODE_VIEW);
		$xt->assignbyref("Nama_editcontrol",$value);
}


// add prevent submit on enter js if only one text record
//	control - Jabatan
$control_Jabatan=array();
$control_Jabatan["func"]="xt_buildeditcontrol";
$control_Jabatan["params"] = array();
$control_Jabatan["params"]["field"]="Jabatan";
$control_Jabatan["params"]["value"]=@$data["Jabatan"];
//	Begin Add validation
$arrValidate = array();	

$arrValidate['basicValidate'][] = "IsRequired";

$control_Jabatan["params"]["validate"]=$arrValidate;
//	End Add validation
$control_Jabatan["params"]["id"]=$id;
$additionalCtrlParams = array();
$additionalCtrlParams["disabled"] = !$enableCtrlsForEditing;
$control_Jabatan["params"]["additionalCtrlParams"]=$additionalCtrlParams;
if($inlineedit)
	$control_Jabatan["params"]["mode"]="inline_edit";
else
	$control_Jabatan["params"]["mode"]="edit";
if(!$detailKeys || !in_array("Jabatan", $detailKeys))	
	$xt->assignbyref("Jabatan_editcontrol",$control_Jabatan);
else if(array_key_exists("Jabatan",$data))
{
				$value = ProcessLargeText(GetData($data,"Jabatan", ""),"field=Jabatan","",MODE_VIEW);
		$xt->assignbyref("Jabatan_editcontrol",$value);
}


// add prevent submit on enter js if only one text record
//	control - Telp
$control_Telp=array();
$control_Telp["func"]="xt_buildeditcontrol";
$control_Telp["params"] = array();
$control_Telp["params"]["field"]="Telp";
$control_Telp["params"]["value"]=@$data["Telp"];
//	Begin Add validation
$arrValidate = array();	

$arrValidate['basicValidate'][] = "IsRequired";

$control_Telp["params"]["validate"]=$arrValidate;
//	End Add validation
$control_Telp["params"]["id"]=$id;
$additionalCtrlParams = array();
$additionalCtrlParams["disabled"] = !$enableCtrlsForEditing;
$control_Telp["params"]["additionalCtrlParams"]=$additionalCtrlParams;
if($inlineedit)
	$control_Telp["params"]["mode"]="inline_edit";
else
	$control_Telp["params"]["mode"]="edit";
if(!$detailKeys || !in_array("Telp", $detailKeys))	
	$xt->assignbyref("Telp_editcontrol",$control_Telp);
else if(array_key_exists("Telp",$data))
{
				$value = ProcessLargeText(GetData($data,"Telp", ""),"field=Telp","",MODE_VIEW);
		$xt->assignbyref("Telp_editcontrol",$value);
}


// add prevent submit on enter js if only one text record
//	control - Foto
$control_Foto=array();
$control_Foto["func"]="xt_buildeditcontrol";
$control_Foto["params"] = array();
$control_Foto["params"]["field"]="Foto";
$control_Foto["params"]["value"]=@$data["Foto"];
//	Begin Add validation
$arrValidate = array();	

$control_Foto["params"]["validate"]=$arrValidate;
//	End Add validation
$control_Foto["params"]["id"]=$id;
$additionalCtrlParams = array();
$additionalCtrlParams["disabled"] = !$enableCtrlsForEditing;
$control_Foto["params"]["additionalCtrlParams"]=$additionalCtrlParams;
if($inlineedit)
	$control_Foto["params"]["mode"]="inline_edit";
else
	$control_Foto["params"]["mode"]="edit";
if(!$detailKeys || !in_array("Foto", $detailKeys))	
	$xt->assignbyref("Foto_editcontrol",$control_Foto);
else if(array_key_exists("Foto",$data))
{
				$value = GetData($data,"Foto", "Document Download");
		$xt->assignbyref("Foto_editcontrol",$value);
}


// add prevent submit on enter js if only one text record
//	control - Alamat_Rumah
$control_Alamat_Rumah=array();
$control_Alamat_Rumah["func"]="xt_buildeditcontrol";
$control_Alamat_Rumah["params"] = array();
$control_Alamat_Rumah["params"]["field"]="Alamat_Rumah";
$control_Alamat_Rumah["params"]["value"]=@$data["Alamat_Rumah"];
//	Begin Add validation
$arrValidate = array();	

$control_Alamat_Rumah["params"]["validate"]=$arrValidate;
//	End Add validation
$control_Alamat_Rumah["params"]["id"]=$id;
$additionalCtrlParams = array();
$additionalCtrlParams["disabled"] = !$enableCtrlsForEditing;
$control_Alamat_Rumah["params"]["additionalCtrlParams"]=$additionalCtrlParams;
if($inlineedit)
	$control_Alamat_Rumah["params"]["mode"]="inline_edit";
else
	$control_Alamat_Rumah["params"]["mode"]="edit";
if(!$detailKeys || !in_array("Alamat_Rumah", $detailKeys))	
	$xt->assignbyref("Alamat_Rumah_editcontrol",$control_Alamat_Rumah);
else if(array_key_exists("Alamat_Rumah",$data))
{
				$value = ProcessLargeText(GetData($data,"Alamat_Rumah", ""),"field=Alamat%5FRumah","",MODE_VIEW);
		$xt->assignbyref("Alamat_Rumah_editcontrol",$value);
}


// add prevent submit on enter js if only one text record
//	control - Alamat_Kantor
$control_Alamat_Kantor=array();
$control_Alamat_Kantor["func"]="xt_buildeditcontrol";
$control_Alamat_Kantor["params"] = array();
$control_Alamat_Kantor["params"]["field"]="Alamat_Kantor";
$control_Alamat_Kantor["params"]["value"]=@$data["Alamat_Kantor"];
//	Begin Add validation
$arrValidate = array();	

$arrValidate['basicValidate'][] = "IsRequired";

$control_Alamat_Kantor["params"]["validate"]=$arrValidate;
//	End Add validation
$control_Alamat_Kantor["params"]["id"]=$id;
$additionalCtrlParams = array();
$additionalCtrlParams["disabled"] = !$enableCtrlsForEditing;
$control_Alamat_Kantor["params"]["additionalCtrlParams"]=$additionalCtrlParams;
if($inlineedit)
	$control_Alamat_Kantor["params"]["mode"]="inline_edit";
else
	$control_Alamat_Kantor["params"]["mode"]="edit";
if(!$detailKeys || !in_array("Alamat_Kantor", $detailKeys))	
	$xt->assignbyref("Alamat_Kantor_editcontrol",$control_Alamat_Kantor);
else if(array_key_exists("Alamat_Kantor",$data))
{
				$value = ProcessLargeText(GetData($data,"Alamat_Kantor", ""),"field=Alamat%5FKantor","",MODE_VIEW);
		$xt->assignbyref("Alamat_Kantor_editcontrol",$value);
}


// add prevent submit on enter js if only one text record
//	control - HP
$control_HP=array();
$control_HP["func"]="xt_buildeditcontrol";
$control_HP["params"] = array();
$control_HP["params"]["field"]="HP";
$control_HP["params"]["value"]=@$data["HP"];
//	Begin Add validation
$arrValidate = array();	

$control_HP["params"]["validate"]=$arrValidate;
//	End Add validation
$control_HP["params"]["id"]=$id;
$additionalCtrlParams = array();
$additionalCtrlParams["disabled"] = !$enableCtrlsForEditing;
$control_HP["params"]["additionalCtrlParams"]=$additionalCtrlParams;
if($inlineedit)
	$control_HP["params"]["mode"]="inline_edit";
else
	$control_HP["params"]["mode"]="edit";
if(!$detailKeys || !in_array("HP", $detailKeys))	
	$xt->assignbyref("HP_editcontrol",$control_HP);
else if(array_key_exists("HP",$data))
{
				$value = ProcessLargeText(GetData($data,"HP", ""),"field=HP","",MODE_VIEW);
		$xt->assignbyref("HP_editcontrol",$value);
}


// add prevent submit on enter js if only one text record
//	control - email
$control_email=array();
$control_email["func"]="xt_buildeditcontrol";
$control_email["params"] = array();
$control_email["params"]["field"]="email";
$control_email["params"]["value"]=@$data["email"];
//	Begin Add validation
$arrValidate = array();	

$control_email["params"]["validate"]=$arrValidate;
//	End Add validation
$control_email["params"]["id"]=$id;
$additionalCtrlParams = array();
$additionalCtrlParams["disabled"] = !$enableCtrlsForEditing;
$control_email["params"]["additionalCtrlParams"]=$additionalCtrlParams;
if($inlineedit)
	$control_email["params"]["mode"]="inline_edit";
else
	$control_email["params"]["mode"]="edit";
if(!$detailKeys || !in_array("email", $detailKeys))	
	$xt->assignbyref("email_editcontrol",$control_email);
else if(array_key_exists("email",$data))
{
				$value = ProcessLargeText(GetData($data,"email", ""),"field=email","",MODE_VIEW);
		$xt->assignbyref("email_editcontrol",$value);
}


// add prevent submit on enter js if only one text record
$pageObject->addCommonJs();


if($lockingObj && $enableCtrlsForEditing)
	$pageObject->AddJSCode("window.timeid".$id."=setInterval( function() {ConfirmLock('agenda_bos_edit.php','".jsreplace($strTableName)."','".$skeys."',".$id.",'".$inlineedit."');},".($lockingObj->ConfirmTime*1000).");");

/////////////////////////////////////////////////////////////
if($isShowDetailTables)
{
	$options = array();
	//array of params for classes
	$options["mode"] = LIST_DETAILS;
	$options["pageType"] = PAGE_LIST;
	$options["masterPageType"] = PAGE_EDIT;
	$options['masterTable'] = $strTableName;
	$options['firstTime'] = 1;
	
	$detailTables = array();
	
	for($d=0;$d<count($dpParams['ids']);$d++)
	{
		$strTableName = $dpParams['strTableNames'][$d];
		include("include/".GetTableUrl($strTableName)."_settings.php");
		if(!$d)
		{
			include('classes/listpage.php');
			include('classes/listpage_embed.php');
			include('classes/listpage_dpinline.php');
		}
		$options['xt'] = new Xtempl();
		$options['id'] = $dpParams['ids'][$d];
		$mkr=1;
		foreach($mKeys[$strTableName] as $mk)
			$options['masterKeysReq'][$mkr++] = $data[$mk];

		$listPageObject = ListPage::createListPage($strTableName, $options);
		// prepare code
		$listPageObject->prepareForBuildPage();
		// show page
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

if($inlineedit)
{
	$jscode = str_replace(array("&","<",">"),array("&amp;","&lt;","&gt;"),$jscode);
	$xt->assignbyref("linkdata",$jscode);
}
else{
	$pageObject->body["end"] .= "<script>".$jscode."</script>";	
	$xt->assignbyref("body",$pageObject->body);
}

$pageObject->xt->assign("legend", true);


/////////////////////////////////////////////////////////////
//display the page
/////////////////////////////////////////////////////////////
if(function_exists("BeforeShowEdit"))
	BeforeShowEdit($xt,$templatefile);

$xt->display($templatefile);

?>
