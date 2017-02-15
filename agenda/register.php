<?php
@ini_set("display_errors","1");
@ini_set("display_startup_errors","1");

include("include/dbcommon.php");
include("include/agenda_petugas_variables.php");
include("classes/runnerpage.php");


$registered=false;
//event for onsubmit
$onsubmit="";
$strMessage="";
$allow_registration=true;
$strUsername="";
$strPassword="";
$strEmail="";
$values=array();
$id =1;
$formname="editform".$id;	
include('include/xtempl.php');

$xt = new Xtempl();

$params = array("pageType" => PAGE_EDIT,"id" => $id);
$params['xt'] = &$xt;
$params["calendar"] = false;

$pageObject = new RunnerPage($params);

// add onload event

$pageObject->AddJsCode("window.PASSWORDS_DONT_MATCH='".jsreplace("Password tidak cocok")."';");

$isUseCaptcha = false;

$isUseCaptcha = true;

if((!isset($_SESSION[$strTableName."_count_captcha"])) or ($_SESSION[$strTableName."_count_captcha"]>4)) 
{
	$_SESSION[$strTableName."_count_captcha"]=0;
}

if(@$_POST["btnSubmit"] == "Register")
{
	if(($_SESSION[$strTableName."_count_captcha"]==0) or ($_SESSION[$strTableName."_count_captcha"]>4))
	{
		if(@strtolower(postvalue("value_captcha_".$id))!=strtolower(@$_SESSION["captcha"]))
		{
			$captchaId = "captcha";
			DisplayCAPTCHA();;
			$allow_registration=false;
			$isCaptchaOk = 0;
		}
		else
		 	$isCaptchaOk = 1;
	}
    else
    { 
		$isCaptchaOk = 1;
    }
}
else
{
	if(($_SESSION[$strTableName."_count_captcha"]==0) or ($_SESSION[$strTableName."_count_captcha"]>4))
	{
		$captchaId = "captcha";
		DisplayCAPTCHA();;
	}	
}



//	Before Process event
if(function_exists("BeforeProcessRegister"))
	BeforeProcessRegister($conn);
//Send activation link to user's email

$includes="";
$includes.="<script language=\"JavaScript\" src=\"include/jquery.js\"></script>\r\n";
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
	

if(@$_POST["btnSubmit"] == "Register")
{

	$filename_values=array();
	$blobfields=array();
	$files_move=array();
	$files_save=array();
	$inlineedit=ADD_SIMPLE;


//	processing Username - start
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


		$values["Username"]=$value;
	}
//	processibng Username - end

//	processing Passw - start
	$value = postvalue("value_Passw_".$id);
	$type=postvalue("type_Passw_".$id);
	if (FieldSubmitted("Passw_".$id))
	{
		$value=prepare_for_db("Passw",$value,$type);
	}
	else
		$value=false;
	if(!($value===false))
	{


		$values["Passw"]=$value;
	}
//	processibng Passw - end

//	processing Nama_Lengkap - start
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


		$values["Nama_Lengkap"]=$value;
	}
//	processibng Nama_Lengkap - end

//	processing NIP - start
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


		$values["NIP"]=$value;
	}
//	processibng NIP - end

//	processing Instansi - start
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


		$values["Instansi"]=$value;
	}
//	processibng Instansi - end

//	processing Alamat_Kantor - start
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


		$values["Alamat_Kantor"]=$value;
	}
//	processibng Alamat_Kantor - end

//	processing Telp_Kantor - start
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


		$values["Telp_Kantor"]=$value;
	}
//	processibng Telp_Kantor - end

//	processing Telp_HP - start
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


		$values["Telp_HP"]=$value;
	}
//	processibng Telp_HP - end

	$strUsername = $values["Username"];
	$strPassword = $values["Passw"];


//	add filenames to values
	foreach($filename_values as $key=>$value)
		$values[$key]=$value;

//	check if entered username already exists
	if(!strlen($strUsername))
	{
		$xt->assign("user_msg","Username tidak boleh kosong");
		$allow_registration=false;
	}	
	else
	{
		$strSQL="select count(*) from `agenda_petugas` where `Username`=".add_db_quotes("Username",$strUsername);
	   	$rs=db_query($strSQL,$conn);
		$data=db_fetch_numarray($rs);
		if($data[0]>0)
		{
			$xt->assign("user_msg","Username"." <i>".$strUsername."</i> "."sudah terpakai. Pilih username lainnya.");
			$allow_registration=false;
		}
	}


	$retval=true;
	
	if($allow_registration)
	{
		if(function_exists("BeforeRegister"))
			$retval = BeforeRegister($values,$strMessage);
	}
	else
		$retval=false;

	if($retval)
	{
//	encrypt password
		$originalpassword=$values["Passw"];
		$values["Passw"]=md5($values["Passw"]);
		$message="";
		$retval=DoInsertRecord("agenda_petugas",$values,$blobfields,$id);
		$strMessage=$message;
		$values["Passw"]=$originalpassword;
	}
	else
		$retval=false;
	if($retval)
	{
		if(function_exists("AfterSuccessfulRegistration"))
			AfterSuccessfulRegistration($values);
		$url = GetSiteUrl();
		$url.=$_SERVER["SCRIPT_NAME"];


//	show Registartion successful message
		
	
	
	// button handlers file names
	$buttonHandlers = array();
	$pageObject->addButtonHandlers($buttonHandlers);
	
	if (strlen($pageObject->onLoadJsEventCode))
	{
		$pageObject->body["begin"] = "<script language=\"JavaScript\" src=\"include/jsfunctions.js\"></script>".$pageObject->body["begin"];
	}
	
	$pageObject->body["begin"] .= $includes."<form method=\"POST\" action=\"login.php\" name=\"loginform\">
	<input type=\"Hidden\" name=username value=\"".htmlspecialchars($strUsername)."\">".
	"<input type=\"Hidden\" name=password value=\"".htmlspecialchars($strPassword)."\">".
	"</form>";
	$pageObject->body["end"] .= "<script>".$pageObject->PrepareJS()."</script>";
	$xt->assign("registered_block",true);
	
	
		$xt->assign("body",$pageObject->body);
		$xt->assign("loginlink_attrs","onclick=\"document.forms.loginform.submit();return false;\"");
		if ($isUseCaptcha && $isCaptchaOk==1)
		{
			$_SESSION[$strTableName."_count_captcha"]=$_SESSION[$strTableName."_count_captcha"]+1;
		}

		$xt->display("register_success.htm");
		return;
	}
	else
	{
		if(function_exists("AfterUnsuccessfulRegistration"))
			AfterUnsuccessfulRegistration($values,$strMessage);
	}
	if(!$retval)
	{
		if($strMessage!="")
		{
			$xt->assign("message",$strMessage);
			$xt->assign("message_block",true);
		}
		if($isUseCaptcha && $isCaptchaOk==1)
		{
			$_SESSION[$strTableName."_count_captcha"]=$_SESSION[$strTableName."_count_captcha"]+1;
		}
	}
}

// button handlers file names
$buttonHandlers = array();
$pageObject->addButtonHandlers($buttonHandlers);

$onsubmit.= "
	var ctrlPass = Runner.controls.ControlManager.getAt('".$strTableName."', ".$pageObject->id.", 'password');
	var ctrlConf = Runner.controls.ControlManager.getAt('".$strTableName."', ".$pageObject->id.", 'confirm');
		
	if (ctrlConf.invalid() === true || ctrlConf.invalid() === true){		
		Runner.Event.prototype.stopEvent(Runner.Event.prototype.getEvent(e));
		return false;
	}
";

// add additional validation when submit form
$onsubmit.= "	
	var arrCntrl = Runner.controls.ControlManager.getAt('".$strTableName."');
	var form = $('#".$formname."');
	var valRes = true;
	for (var i = 0; i < arrCntrl.length; i++){
		if (arrCntrl[i].invalid() === true){
			valRes = false;
			continue;
		}
		var vRes = arrCntrl[i].validate();
		if (!vRes.result){ 		
			valRes = false;
		}
		var vType = arrCntrl[i].getControlType();
		var useRTE = arrCntrl[i].useRTE;
		if(vType=='RTE' && useRTE){
			var clone = arrCntrl[i].getForSubmit();	
			$(clone).prependTo(form);
		}
	}	
	if (!valRes){
		Runner.Event.prototype.stopEvent(Runner.Event.prototype.getEvent(e));
	}	
	return valRes;
";
//////////////////////////////////////////////////////////////
////////////////////// time picker
//////////////////////

$pageObject->AddJSFile("ajaxsuggest");
$includes.="<script language=\"JavaScript\" src=\"include/customlabels.js\"></script>\r\n";
$includes.="<script language=\"JavaScript\" src=\"include/jsfunctions.js\"></script>\r\n";
$includes.="<div id=\"search_suggest\"></div>\r\n";
if($params["calendar"])
	$pageObject->AddJSFile("calendar");



$onsubmit = "formOnSubmit = function(e){".$onsubmit."};";
$pageObject->addJSCode($onsubmit);
$onsubmit="onSubmit=\"formOnSubmit(event)\"";

//	assign values to the controls

if(!count($values))
{
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////
//	Begin Add validation params for Regester	
$regex='';
$regexmessage='';
$regextype = '';
$passName='';
$arrCntrls = array();	
//	control - Username
$control_Username=array();
$control_Username["func"]="xt_buildeditcontrol";
$control_Username["params"] = array();
$control_Username["params"]["field"]="Username";
$control_Username["params"]["value"]=@$values["Username"];
//	Begin Add validation
$arrValidate = array('basicValidate'=>array());	

if(!in_array('IsRequired',$arrValidate['basicValidate']))
	$arrValidate['basicValidate'][] = 'IsRequired';
$arrCntrls[]='Username';



$control_Username["params"]["validate"]=$arrValidate;
//	End Add validation
$control_Username["params"]["id"]=$id;
$control_Username["params"]["mode"]="add";
$xt->assignbyref("Username_editcontrol",$control_Username);

$xt->assign("Username_label",true);
	if(isEnableSection508())
	$xt->assign_section("Username_label","<label for=\"".GetInputElementId("Username", $id)."\">","</label>");

$xt->assign("Username_fieldblock",true);
//	control - Passw
$control_Passw=array();
$control_Passw["func"]="xt_buildeditcontrol";
$control_Passw["params"] = array();
$control_Passw["params"]["field"]="Passw";
$control_Passw["params"]["format"]="Password";
$control_Passw["params"]["value"]=@$values["Passw"];
//	Begin Add validation
$arrValidate = array('basicValidate'=>array());	

if(!in_array('IsRequired',$arrValidate['basicValidate']))
	$arrValidate['basicValidate'][] = 'IsRequired';
$arrCntrls[]='Passw';


$passName='Passw';

$control_Passw["params"]["validate"]=$arrValidate;
//	End Add validation
$control_Passw["params"]["id"]=$id;
$control_Passw["params"]["mode"]="add";
$xt->assignbyref("Passw_editcontrol",$control_Passw);

$xt->assign("Passw_label",true);
	if(isEnableSection508())
	$xt->assign_section("Passw_label","<label for=\"".GetInputElementId("Passw", $id)."\">","</label>");

$xt->assign("Passw_fieldblock",true);
//Begin second field for re-enter password
$xt->assign("confirm_label",true);
	if(isEnableSection508())
	$xt->assign_section("confirm_label","<label for=\"value_confirm_".$id."\">","</label>");

$control1_confirm=array();
$control1_confirm["func"]="xt_buildeditcontrol";
$control1_confirm["params"] = array();
$control1_confirm["params"]["field"]="confirm";
$control1_confirm["params"]["format"]="Password";
$control1_confirm["params"]["validate"]['basicValidate']=array('IsRequired');
$control1_confirm["params"]["id"]=$id;
$control1_confirm["params"]["mode"]="add";
$arrCntrls[]='confirm';
$xt->assignbyref("confirm_editcontrol1",$control1_confirm);
$xt->assign("confirm_block",true);
//	control - Nama_Lengkap
$control_Nama_Lengkap=array();
$control_Nama_Lengkap["func"]="xt_buildeditcontrol";
$control_Nama_Lengkap["params"] = array();
$control_Nama_Lengkap["params"]["field"]="Nama_Lengkap";
$control_Nama_Lengkap["params"]["value"]=@$values["Nama_Lengkap"];
//	Begin Add validation
$arrValidate = array('basicValidate'=>array());	
	
		$arrValidate['basicValidate'][] = "IsRequired";




$control_Nama_Lengkap["params"]["validate"]=$arrValidate;
//	End Add validation
$control_Nama_Lengkap["params"]["id"]=$id;
$control_Nama_Lengkap["params"]["mode"]="add";
$xt->assignbyref("Nama_Lengkap_editcontrol",$control_Nama_Lengkap);

$xt->assign("Nama_Lengkap_label",true);
	if(isEnableSection508())
	$xt->assign_section("Nama_Lengkap_label","<label for=\"".GetInputElementId("Nama_Lengkap", $id)."\">","</label>");

$xt->assign("Nama_Lengkap_fieldblock",true);
//	control - NIP
$control_NIP=array();
$control_NIP["func"]="xt_buildeditcontrol";
$control_NIP["params"] = array();
$control_NIP["params"]["field"]="NIP";
$control_NIP["params"]["value"]=@$values["NIP"];
//	Begin Add validation
$arrValidate = array('basicValidate'=>array());	
	
		$arrValidate['basicValidate'][] = "IsRequired";




$control_NIP["params"]["validate"]=$arrValidate;
//	End Add validation
$control_NIP["params"]["id"]=$id;
$control_NIP["params"]["mode"]="add";
$xt->assignbyref("NIP_editcontrol",$control_NIP);

$xt->assign("NIP_label",true);
	if(isEnableSection508())
	$xt->assign_section("NIP_label","<label for=\"".GetInputElementId("NIP", $id)."\">","</label>");

$xt->assign("NIP_fieldblock",true);
//	control - Instansi
$control_Instansi=array();
$control_Instansi["func"]="xt_buildeditcontrol";
$control_Instansi["params"] = array();
$control_Instansi["params"]["field"]="Instansi";
$control_Instansi["params"]["value"]=@$values["Instansi"];
//	Begin Add validation
$arrValidate = array('basicValidate'=>array());	




$control_Instansi["params"]["validate"]=$arrValidate;
//	End Add validation
$control_Instansi["params"]["id"]=$id;
$control_Instansi["params"]["mode"]="add";
$xt->assignbyref("Instansi_editcontrol",$control_Instansi);

$xt->assign("Instansi_label",true);
	if(isEnableSection508())
	$xt->assign_section("Instansi_label","<label for=\"".GetInputElementId("Instansi", $id)."\">","</label>");

$xt->assign("Instansi_fieldblock",true);
//	control - Alamat_Kantor
$control_Alamat_Kantor=array();
$control_Alamat_Kantor["func"]="xt_buildeditcontrol";
$control_Alamat_Kantor["params"] = array();
$control_Alamat_Kantor["params"]["field"]="Alamat_Kantor";
$control_Alamat_Kantor["params"]["value"]=@$values["Alamat_Kantor"];
//	Begin Add validation
$arrValidate = array('basicValidate'=>array());	




$control_Alamat_Kantor["params"]["validate"]=$arrValidate;
//	End Add validation
$control_Alamat_Kantor["params"]["id"]=$id;
$control_Alamat_Kantor["params"]["mode"]="add";
$xt->assignbyref("Alamat_Kantor_editcontrol",$control_Alamat_Kantor);

$xt->assign("Alamat_Kantor_label",true);
	if(isEnableSection508())
	$xt->assign_section("Alamat_Kantor_label","<label for=\"".GetInputElementId("Alamat_Kantor", $id)."\">","</label>");

$xt->assign("Alamat_Kantor_fieldblock",true);
//	control - Telp_Kantor
$control_Telp_Kantor=array();
$control_Telp_Kantor["func"]="xt_buildeditcontrol";
$control_Telp_Kantor["params"] = array();
$control_Telp_Kantor["params"]["field"]="Telp_Kantor";
$control_Telp_Kantor["params"]["value"]=@$values["Telp_Kantor"];
//	Begin Add validation
$arrValidate = array('basicValidate'=>array());	




$control_Telp_Kantor["params"]["validate"]=$arrValidate;
//	End Add validation
$control_Telp_Kantor["params"]["id"]=$id;
$control_Telp_Kantor["params"]["mode"]="add";
$xt->assignbyref("Telp_Kantor_editcontrol",$control_Telp_Kantor);

$xt->assign("Telp_Kantor_label",true);
	if(isEnableSection508())
	$xt->assign_section("Telp_Kantor_label","<label for=\"".GetInputElementId("Telp_Kantor", $id)."\">","</label>");

$xt->assign("Telp_Kantor_fieldblock",true);
//	control - Telp_HP
$control_Telp_HP=array();
$control_Telp_HP["func"]="xt_buildeditcontrol";
$control_Telp_HP["params"] = array();
$control_Telp_HP["params"]["field"]="Telp_HP";
$control_Telp_HP["params"]["value"]=@$values["Telp_HP"];
//	Begin Add validation
$arrValidate = array('basicValidate'=>array());	




$control_Telp_HP["params"]["validate"]=$arrValidate;
//	End Add validation
$control_Telp_HP["params"]["id"]=$id;
$control_Telp_HP["params"]["mode"]="add";
$xt->assignbyref("Telp_HP_editcontrol",$control_Telp_HP);

$xt->assign("Telp_HP_label",true);
	if(isEnableSection508())
	$xt->assign_section("Telp_HP_label","<label for=\"".GetInputElementId("Telp_HP", $id)."\">","</label>");

$xt->assign("Telp_HP_fieldblock",true);


// Add events for register controls
$prepCntrls = array();
for($i=0;$i<count($arrCntrls);$i++)
	$prepCntrls[] = "'".$arrCntrls[$i]."'";
$strCntrls = implode(",", $prepCntrls);
$pageObject->AddJsCode("AddEventRegControl('".$strTableName."',[".$strCntrls."],".$id.",'".$passName."');");
//////////////////////////////////
$xt->assign("buttons_block",true);

$readonlyfields=array();

//	show readonly fields



$pageObject->body["begin"].= $includes.
	"<form encType=\"multipart/form-data\" method=\"POST\" action=\"register.php\" id=\"".$formname."\" name=\"".$formname."\" ".$onsubmit.">
	<input type=hidden name=btnSubmit value=\"Register\">";
$pageObject->AddJsCode("\r\n SetToFirstControl('".$formname."');\r\n");


$pageObject->addCommonJs();

$pageObject->body["end"] .= "</form><script>".$pageObject->PrepareJS()."</script>";	



$xt->assignbyref("body",$pageObject->body);

$pageObject->xt->assign("legend", true);

$templatefile="register.htm";
if(function_exists("BeforeShowRegister"))
{
	BeforeShowRegister($xt,$templatefile);
}
$xt->display($templatefile);

?>
