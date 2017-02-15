<?php 
@ini_set("display_errors","1");
@ini_set("display_startup_errors","1");

include("include/dbcommon.php");
include("include/admin_users_variables.php");
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
$templatefile = ( $inlineedit ) ? "admin_users_inline_edit.htm" : "admin_users_edit.htm";

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
$keys["id_user"]=postvalue("editid1");
$savedKeys["id_user"]=postvalue("editid1");
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

	$condition = $inlineedit;

	if($condition)
	{
	$value = postvalue("value_Username_".$id);
	$type=postvalue("type_Username_".$id);
	if(FieldSubmitted("Username_".$id))
	{
		
		$value=prepare_for_db("Username",$value,$type);
	}
	else
	{
		$value=false;
	}
	if($value!==false)
	{	




		$evalues["Username"]=$value;
	}


//	processibng Username - end
	}
	$condition = $inlineedit;

	if($condition)
	{
	$value = postvalue("value_Nama_Lengkap_".$id);
	$type=postvalue("type_Nama_Lengkap_".$id);
	if(FieldSubmitted("Nama_Lengkap_".$id))
	{
		
		$value=prepare_for_db("Nama_Lengkap",$value,$type);
	}
	else
	{
		$value=false;
	}
	if($value!==false)
	{	




		$evalues["Nama_Lengkap"]=$value;
	}


//	processibng Nama_Lengkap - end
	}
	$condition = $inlineedit;

	if($condition)
	{
	$value = postvalue("value_Instansi_".$id);
	$type=postvalue("type_Instansi_".$id);
	if(FieldSubmitted("Instansi_".$id))
	{
		
		$value=prepare_for_db("Instansi",$value,$type);
	}
	else
	{
		$value=false;
	}
	if($value!==false)
	{	




		$evalues["Instansi"]=$value;
	}


//	processibng Instansi - end
	}
	$condition = $inlineedit;

	if($condition)
	{
	$value = postvalue("value_NIP_".$id);
	$type=postvalue("type_NIP_".$id);
	if(FieldSubmitted("NIP_".$id))
	{
		
		$value=prepare_for_db("NIP",$value,$type);
	}
	else
	{
		$value=false;
	}
	if($value!==false)
	{	




		$evalues["NIP"]=$value;
	}


//	processibng NIP - end
	}
	$condition = $inlineedit;

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
	$condition = $inlineedit;

	if($condition)
	{
	$value = postvalue("value_Telp_Kantor_".$id);
	$type=postvalue("type_Telp_Kantor_".$id);
	if(FieldSubmitted("Telp_Kantor_".$id))
	{
		
		$value=prepare_for_db("Telp_Kantor",$value,$type);
	}
	else
	{
		$value=false;
	}
	if($value!==false)
	{	




		$evalues["Telp_Kantor"]=$value;
	}


//	processibng Telp_Kantor - end
	}
	$condition = $inlineedit;

	if($condition)
	{
	$value = postvalue("value_Telp_HP_".$id);
	$type=postvalue("type_Telp_HP_".$id);
	if(FieldSubmitted("Telp_HP_".$id))
	{
		
		$value=prepare_for_db("Telp_HP",$value,$type);
	}
	else
	{
		$value=false;
	}
	if($value!==false)
	{	




		$evalues["Telp_HP"]=$value;
	}


//	processibng Telp_HP - end
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
		$keyGetQ.="editid1=".rawurldecode($keys["id_user"])."&";
	// cut last &
	$keyGetQ = substr($keyGetQ, 0, strlen($keyGetQ)-1);	
	// redirect
	header("Location: admin_users_".$pageObject->getPageType().".php?".$keyGetQ);
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
$query = $queryData_admin_users->Copy();



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
		header("Location: admin_users_list.php?a=return");
		exit();
	}
	else
		$data=array();
}

$readonlyfields=array();


if($readevalues)
{
	$data["Username"]=$evalues["Username"];
	$data["Nama_Lengkap"]=$evalues["Nama_Lengkap"];
	$data["Instansi"]=$evalues["Instansi"];
	$data["NIP"]=$evalues["NIP"];
	$data["Alamat_Kantor"]=$evalues["Alamat_Kantor"];
	$data["Telp_Kantor"]=$evalues["Telp_Kantor"];
	$data["Telp_HP"]=$evalues["Telp_HP"];
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
	
	if(strlen($onsubmit))
		$onsubmit="onSubmit=\"".htmlspecialchars($onsubmit)."\"";
	$pageObject->body["begin"] .= $includes;
	
	
	$hiddenKeys = '';
	$hiddenKeys .= "<input type=\"hidden\" name=\"editid1\" value=\"".htmlspecialchars($keys["id_user"])."\">";
	$xt->assign("show_key1", htmlspecialchars(GetData($data,"id_user", "")));
	
	$xt->assign('editForm', array('begin'=>'<form name="'.$formname.'" id="'.$formname.'" encType="multipart/form-data" method="post" action="admin_users_edit.php" '.$onsubmit.'>'.
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
	
	if(GetFieldIndex("id_user"))
		$key[]=GetFieldIndex("id_user");
	
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
					$next[1]=$row_next["id_user"];
			}
			
			$res_prev=db_query($sql_prev,$conn);	
			if($row_prev=db_fetch_array($res_prev))
			{
					$prev[1]=$row_prev["id_user"];
			}
		}
	}
}
	$nextlink=$prevlink="";
	// reset button handler
	$resetEditors="";
	$unblRec="UnlockRecord('admin_users_edit.php','".$skeys."','',function(){window.location.href='admin_users_edit.php?";
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
	$xt->assign("backbutton_attrs","onclick=\"UnlockRecord('admin_users_edit.php','".$skeys."','',function(){window.location.href='admin_users_list.php?a=return'});return false;\"");
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
$showKeys[] = rawurlencode($keys["id_user"]);
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
//	return new data to the List page or report an error
/////////////////////////////////////////////////////////////
if (postvalue("a")=="edited" && $inlineedit ) 
{
	if(!$data)
	{
		$data=$evalues;
		$HaveData=false;
	}
	//Preparation   view values

//	detail tables

	$keylink="";
	$keylink.="&key1=".htmlspecialchars(rawurlencode(@$data["id_user"]));


//	Username - 

		$value="";
				$value = ProcessLargeText(GetData($data,"Username", ""),"field=Username".$keylink,"",MODE_LIST);
		$showValues[] = $value;
		$showFields[] = "Username";
				$showRawValues[] = substr($data["Username"],0,100);

//	Nama_Lengkap - 

		$value="";
				$value = ProcessLargeText(GetData($data,"Nama_Lengkap", ""),"field=Nama%5FLengkap".$keylink,"",MODE_LIST);
		$showValues[] = $value;
		$showFields[] = "Nama_Lengkap";
				$showRawValues[] = substr($data["Nama_Lengkap"],0,100);

//	Instansi - 

		$value="";
				$value = ProcessLargeText(GetData($data,"Instansi", ""),"field=Instansi".$keylink,"",MODE_LIST);
		$showValues[] = $value;
		$showFields[] = "Instansi";
				$showRawValues[] = substr($data["Instansi"],0,100);

//	NIP - 

		$value="";
				$value = ProcessLargeText(GetData($data,"NIP", ""),"field=NIP".$keylink,"",MODE_LIST);
		$showValues[] = $value;
		$showFields[] = "NIP";
				$showRawValues[] = substr($data["NIP"],0,100);

//	Alamat_Kantor - 

		$value="";
				$value = ProcessLargeText(GetData($data,"Alamat_Kantor", ""),"field=Alamat%5FKantor".$keylink,"",MODE_LIST);
		$showValues[] = $value;
		$showFields[] = "Alamat_Kantor";
				$showRawValues[] = substr($data["Alamat_Kantor"],0,100);

//	Telp_Kantor - 

		$value="";
				$value = ProcessLargeText(GetData($data,"Telp_Kantor", ""),"field=Telp%5FKantor".$keylink,"",MODE_LIST);
		$showValues[] = $value;
		$showFields[] = "Telp_Kantor";
				$showRawValues[] = substr($data["Telp_Kantor"],0,100);

//	Telp_HP - 

		$value="";
				$value = ProcessLargeText(GetData($data,"Telp_HP", ""),"field=Telp%5FHP".$keylink,"",MODE_LIST);
		$showValues[] = $value;
		$showFields[] = "Telp_HP";
				$showRawValues[] = substr($data["Telp_HP"],0,100);
/////////////////////////////////////////////////////////////
//	start inline output
/////////////////////////////////////////////////////////////
	echo "<textarea id=\"data\">";
	if($IsSaved)
	{
		if($lockingObj)
			$lockingObj->UnlockRecord($strTableName,$keys,"");
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
$control_Username["params"]["value"]=@$data["Username"];
//	Begin Add validation
$arrValidate = array();	

$control_Username["params"]["validate"]=$arrValidate;
//	End Add validation
$control_Username["params"]["id"]=$id;
$additionalCtrlParams = array();
$additionalCtrlParams["disabled"] = !$enableCtrlsForEditing;
$control_Username["params"]["additionalCtrlParams"]=$additionalCtrlParams;
if($inlineedit)
	$control_Username["params"]["mode"]="inline_edit";
else
	$control_Username["params"]["mode"]="edit";
if(!$detailKeys || !in_array("Username", $detailKeys))	
	$xt->assignbyref("Username_editcontrol",$control_Username);
else if(array_key_exists("Username",$data))
{
				$value = ProcessLargeText(GetData($data,"Username", ""),"field=Username","",MODE_VIEW);
		$xt->assignbyref("Username_editcontrol",$value);
}


// add prevent submit on enter js if only one text record
//	control - Nama_Lengkap
$control_Nama_Lengkap=array();
$control_Nama_Lengkap["func"]="xt_buildeditcontrol";
$control_Nama_Lengkap["params"] = array();
$control_Nama_Lengkap["params"]["field"]="Nama_Lengkap";
$control_Nama_Lengkap["params"]["value"]=@$data["Nama_Lengkap"];
//	Begin Add validation
$arrValidate = array();	

$control_Nama_Lengkap["params"]["validate"]=$arrValidate;
//	End Add validation
$control_Nama_Lengkap["params"]["id"]=$id;
$additionalCtrlParams = array();
$additionalCtrlParams["disabled"] = !$enableCtrlsForEditing;
$control_Nama_Lengkap["params"]["additionalCtrlParams"]=$additionalCtrlParams;
if($inlineedit)
	$control_Nama_Lengkap["params"]["mode"]="inline_edit";
else
	$control_Nama_Lengkap["params"]["mode"]="edit";
if(!$detailKeys || !in_array("Nama_Lengkap", $detailKeys))	
	$xt->assignbyref("Nama_Lengkap_editcontrol",$control_Nama_Lengkap);
else if(array_key_exists("Nama_Lengkap",$data))
{
				$value = ProcessLargeText(GetData($data,"Nama_Lengkap", ""),"field=Nama%5FLengkap","",MODE_VIEW);
		$xt->assignbyref("Nama_Lengkap_editcontrol",$value);
}


// add prevent submit on enter js if only one text record
//	control - Instansi
$control_Instansi=array();
$control_Instansi["func"]="xt_buildeditcontrol";
$control_Instansi["params"] = array();
$control_Instansi["params"]["field"]="Instansi";
$control_Instansi["params"]["value"]=@$data["Instansi"];
//	Begin Add validation
$arrValidate = array();	

$control_Instansi["params"]["validate"]=$arrValidate;
//	End Add validation
$control_Instansi["params"]["id"]=$id;
$additionalCtrlParams = array();
$additionalCtrlParams["disabled"] = !$enableCtrlsForEditing;
$control_Instansi["params"]["additionalCtrlParams"]=$additionalCtrlParams;
if($inlineedit)
	$control_Instansi["params"]["mode"]="inline_edit";
else
	$control_Instansi["params"]["mode"]="edit";
if(!$detailKeys || !in_array("Instansi", $detailKeys))	
	$xt->assignbyref("Instansi_editcontrol",$control_Instansi);
else if(array_key_exists("Instansi",$data))
{
				$value = ProcessLargeText(GetData($data,"Instansi", ""),"field=Instansi","",MODE_VIEW);
		$xt->assignbyref("Instansi_editcontrol",$value);
}


// add prevent submit on enter js if only one text record
//	control - NIP
$control_NIP=array();
$control_NIP["func"]="xt_buildeditcontrol";
$control_NIP["params"] = array();
$control_NIP["params"]["field"]="NIP";
$control_NIP["params"]["value"]=@$data["NIP"];
//	Begin Add validation
$arrValidate = array();	

$control_NIP["params"]["validate"]=$arrValidate;
//	End Add validation
$control_NIP["params"]["id"]=$id;
$additionalCtrlParams = array();
$additionalCtrlParams["disabled"] = !$enableCtrlsForEditing;
$control_NIP["params"]["additionalCtrlParams"]=$additionalCtrlParams;
if($inlineedit)
	$control_NIP["params"]["mode"]="inline_edit";
else
	$control_NIP["params"]["mode"]="edit";
if(!$detailKeys || !in_array("NIP", $detailKeys))	
	$xt->assignbyref("NIP_editcontrol",$control_NIP);
else if(array_key_exists("NIP",$data))
{
				$value = ProcessLargeText(GetData($data,"NIP", ""),"field=NIP","",MODE_VIEW);
		$xt->assignbyref("NIP_editcontrol",$value);
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
//	control - Telp_Kantor
$control_Telp_Kantor=array();
$control_Telp_Kantor["func"]="xt_buildeditcontrol";
$control_Telp_Kantor["params"] = array();
$control_Telp_Kantor["params"]["field"]="Telp_Kantor";
$control_Telp_Kantor["params"]["value"]=@$data["Telp_Kantor"];
//	Begin Add validation
$arrValidate = array();	

$control_Telp_Kantor["params"]["validate"]=$arrValidate;
//	End Add validation
$control_Telp_Kantor["params"]["id"]=$id;
$additionalCtrlParams = array();
$additionalCtrlParams["disabled"] = !$enableCtrlsForEditing;
$control_Telp_Kantor["params"]["additionalCtrlParams"]=$additionalCtrlParams;
if($inlineedit)
	$control_Telp_Kantor["params"]["mode"]="inline_edit";
else
	$control_Telp_Kantor["params"]["mode"]="edit";
if(!$detailKeys || !in_array("Telp_Kantor", $detailKeys))	
	$xt->assignbyref("Telp_Kantor_editcontrol",$control_Telp_Kantor);
else if(array_key_exists("Telp_Kantor",$data))
{
				$value = ProcessLargeText(GetData($data,"Telp_Kantor", ""),"field=Telp%5FKantor","",MODE_VIEW);
		$xt->assignbyref("Telp_Kantor_editcontrol",$value);
}


// add prevent submit on enter js if only one text record
//	control - Telp_HP
$control_Telp_HP=array();
$control_Telp_HP["func"]="xt_buildeditcontrol";
$control_Telp_HP["params"] = array();
$control_Telp_HP["params"]["field"]="Telp_HP";
$control_Telp_HP["params"]["value"]=@$data["Telp_HP"];
//	Begin Add validation
$arrValidate = array();	

$control_Telp_HP["params"]["validate"]=$arrValidate;
//	End Add validation
$control_Telp_HP["params"]["id"]=$id;
$additionalCtrlParams = array();
$additionalCtrlParams["disabled"] = !$enableCtrlsForEditing;
$control_Telp_HP["params"]["additionalCtrlParams"]=$additionalCtrlParams;
if($inlineedit)
	$control_Telp_HP["params"]["mode"]="inline_edit";
else
	$control_Telp_HP["params"]["mode"]="edit";
if(!$detailKeys || !in_array("Telp_HP", $detailKeys))	
	$xt->assignbyref("Telp_HP_editcontrol",$control_Telp_HP);
else if(array_key_exists("Telp_HP",$data))
{
				$value = ProcessLargeText(GetData($data,"Telp_HP", ""),"field=Telp%5FHP","",MODE_VIEW);
		$xt->assignbyref("Telp_HP_editcontrol",$value);
}


// add prevent submit on enter js if only one text record
$pageObject->addCommonJs();


if($lockingObj && $enableCtrlsForEditing)
	$pageObject->AddJSCode("window.timeid".$id."=setInterval( function() {ConfirmLock('admin_users_edit.php','".jsreplace($strTableName)."','".$skeys."',".$id.",'".$inlineedit."');},".($lockingObj->ConfirmTime*1000).");");

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
	$strTableName = "admin_users";		
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

$pageObject->xt->assign("legendBreak", '<br/>');


/////////////////////////////////////////////////////////////
//display the page
/////////////////////////////////////////////////////////////
if(function_exists("BeforeShowEdit"))
	BeforeShowEdit($xt,$templatefile);

$xt->display($templatefile);

?>
