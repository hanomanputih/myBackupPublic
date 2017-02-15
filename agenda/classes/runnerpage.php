<?php
          
          
/**
 * That function  copies all elements from associative array to object, as object properties with same names
 * Usefull when you need to copy many properties
 *
 * @param link $obj
 * @param link $argsArr
 */
function RunnerApply (&$obj, &$argsArr)
{	
	//$i=0;
	foreach ($argsArr as $key=>$var)
	{
		//if (isset($obj->$key))		
			setObjectProperty($obj,$key,$argsArr[$key]);
//			$obj->$key = &$argsArr[$key];		
		//$i++;
	}
}
/**
 *  Define constants of name page 
 *
 * @var constants
 */
define('PAGE_LIST',"list");
define('PAGE_ADD',"add");
define('PAGE_EDIT',"edit");
define('PAGE_VIEW',"view");
define('PAGE_MENU',"menu");
define('PAGE_REGISTER',"register");
define('PAGE_SEARCH',"search");
define('PAGE_REPORT',"report");
define('PAGE_CHART',"chart");
define('PAGE_PRINT',"print");
define('PAGE_EXPORT',"export");
define('PAGE_IMPORT',"import");



/**
 * Abstract base class for all pages. Contains main functionality
 *
 */
class RunnerPage
{
	/**
      * Id on page
      *
      * @var integer
      */
	var $id = 1;
	/**
      * Total js code for page
      *
      * @var string
      */
	var $totalCode = "";
	/**
      * If use calendar or not
      *
      * @var bool
      */
	var $calendar = false;
	/**
      * Type of page
      *
      * @var string
      */
	var $pageType = "";
	/**
      * Mode of page
      *
      * @var integer
      */
	var $mode = 0;
	/**
	 * If use display loading or not
	 *
	 * @var bool
	 */
	var $isDisplayLoading = false;
	/**
      * Original table name
      *
      * @var string
      */
	var $strOriginalTableName = "";
	/**
      * Short table name
      *
      * @var string
      */
	var $shortTableName = '';
	/**
      * Prefix for session variable
      *
      * @var integer
      */
	var $sessionPrefix = "";
	/**
      * Name of current table
      *
      * @var string
      */	
	var $tName = "";
	/**
      * Connect to database
      *
      * @var string
      */
	var $conn = "";
	/**
      * Array of order index in table
      *
      * @var array()
      */
	var $gOrderIndexes = array();
	/**
      * String of OrderBy for query
      *
      * @var string
      */
	var $gstrOrderBy = "";
	/**
      * Page size
      *
      * @var integer
      */
	var $gPageSize = 0;
	/**
      * Extence of class Xtempl
      *
      * @var object
      */
	var $xt = null;
	
	/**
	 * Instance of SearchClause class
	 *
	 * @var object
	 */
	var $searchClauseObj = null;

	var $flyId = 1;
	/*
	 *	The list of including js files 
	 */	  
	var $includes_js = array();
	/*
	 *	The list of including js files 
	 */
	var $includes_jsreq = array();
	/*
	 *	The list of including css files
	 */
	var $includes_css = array();
	/*
	 *	Loacale tunes
	 */
	var $locale_info = array();
	
	/**
	 * Id of record
	 *
	 * @var integer
	 */
	var $recId = 0;
	
	var $googleMapCfg = array('markerAsLinkToView'=>true, 'isUseMainMaps'=>false, 'isUseFieldsMaps'=> false, 'isUseGoogleMap'=>false, 'APIcode'=>'', 'mainMapIds'=>array(), 'fieldMapsIds'=>array(), 'mapsData'=>array());
	/**
	 * Array of menu tables
	 *
	 * @var array
	 */
	var $menuTablesArr = array();
	/**
	 * Array of permissions for pages
	 *
	 * @var array
	 */
	var $permis = array();
	/**
	 * If use group scurity or not
	 *
	 * @var bool
	 */
	var $isGroupSecurity = true;
	
	var $debugJSMode = false;

	/**
	 * Use mode ajax for simple listPage
	 *
	 * @var boolean
	 */
	var $listAjax = false;
	
	/**
	 * Array of body begin, end code and body attributs
	 *
	 * @var array
	 */
	var $body = array('begin' => '', 'end'=> '');
	
	var $onLoadJsEventCode = '';
	
	/**
	  * Constructor, set initial params
	  *
	  * @param array $params
	  */
	function RunnerPage(&$params)
	{
		// copy properties to object
		RunnerApply($this, $params);	
		$this->flyId = $this->id+1;
		// get permissions 
		if ($this->tName)
		{
			$this->permis[$this->tName]= $this->getPermissions();
		}
		// get perm for menu tables
		for($i = 0; $i < count($this->menuTablesArr); $i ++) {
			$this->permis[$this->menuTablesArr[$i]["dataSourceTName"]]= $this->getPermissions($this->menuTablesArr[$i]["dataSourceTName"]);
		}
		
		
		$this->body['begin'] .= '
			<script type="text/javascript">
				window.debugMode = '.($this->debugJSMode ? 'true' : 'false').';
			</script>';		
	}
		
	/**
	 * Generates new id, same as flyId on front-end
	 *
	 * @return int
	 */
	function genId()
	{
		$this->flyId++;
		$this->recId = $this->flyId;
		return $this->flyId;
	}
	
	/**
	  * Get page type
	  */
	function getPageType()
	{
		return $this->pageType;
	}
	/**
	  * Accumulation of js code for page
	  */
	function AddJSCode($jscode)
	{
		$this->totalCode .=$jscode;
	}
	/**
	  * Add js files for page
	  */	
	function AddJSFile($file,$req1="",$req2="",$req3="")
	{
		$this->includes_js[]=$file;
		if($req1!="")
			$this->includes_jsreq[$file]=array($req1);
		if($req2!="")
			$this->includes_jsreq[$file][]=$req2;
		if($req3!="")
			$this->includes_jsreq[$file][]=$req3;
	}
	/**
	  * Add css files for page
	  */	
	function AddCSSFile($file)
	{
		$this->includes_css[]=$file;
	}
	/**
	  * Load js and css files
	  */	
	function LoadJS_CSS()
	{
		
		$this->includes_js = array_unique($this->includes_js);
		$this->includes_css = array_unique($this->includes_css);
		$out = "";
		if (count($this->includes_css)){
			$out .= "Runner.util.ScriptLoader.loadCSS([";
			foreach($this->includes_css as $file)
			{
				$out.="'".$file."', ";
			}
			$out = substr($out, 0, strlen($out)-2);
			$out .= "]);\r\n";
		}
		foreach($this->includes_js as $file)
		{
			$out .= "Runner.util.ScriptLoader.addJS(['".$file."']";
			if(array_key_exists($file,$this->includes_jsreq))
			{
				foreach($this->includes_jsreq[$file] as $req)
					$out.=",'".$req."'";
			}
			$out.=");\r\n";
		}
		$out.="Runner.util.ScriptLoader.load(".$this->id.");";
		return $out;
	}
	/**
	  * Set languge params for page
	  */	
	function setLangParams()
	{
	}
	/**
	  * Accumulate general code for page
	  *
	  * @return generalCode
	  */		
	function getTextVariables()
	{
		$generalCode="";
		
		if($this->pageType == PAGE_LIST || $this->pageType == PAGE_REPORT)
		{
			$generalCode.="\nwindow.TEXT_FIRST = '".jsreplace("Pertama")."';".
			"\nwindow.TEXT_PREVIOUS = '".jsreplace("Sebelumnya")."';".
			"\nwindow.TEXT_NEXT = '".jsreplace("Berikutnya")."';".
			"\nwindow.TEXT_LAST = '".jsreplace("Terakhir")."';".
			"\nwindow.TEXT_PROCEED_TO = '".jsreplace("Proceses")."';".
			"\nwindow.TEXT_DETAIL_NOT_SAVED = '".jsreplace("")."';".
			"\nwindow.TEXT_DETAIL_GOTO = '".jsreplace("")."';".
			"\nwindow.TEXT_SHOW_ALL = '".jsreplace("Tampil semua")."';";
		}	
		
		//for calendar
		if($this->pageType == PAGE_EDIT || $this->pageType == PAGE_ADD || $this->pageType == PAGE_SEARCH || $this->pageType == PAGE_REGISTER || GetTableData($this->tName, ".isUseCalendarForSearch", true))
		{
			$generalCode.="window.TEXT_MONTH_JAN='".jsreplace("Januari")."';\r\n";
			$generalCode.="window.TEXT_MONTH_FEB='".jsreplace("Februari")."';\r\n";
			$generalCode.="window.TEXT_MONTH_MAR='".jsreplace("Maret")."';\r\n";
			$generalCode.="window.TEXT_MONTH_APR='".jsreplace("April")."';\r\n";
			$generalCode.="window.TEXT_MONTH_MAY='".jsreplace("Mei")."';\r\n";
			$generalCode.="window.TEXT_MONTH_JUN='".jsreplace("Juni")."';\r\n";
			$generalCode.="window.TEXT_MONTH_JUL='".jsreplace("Juli")."';\r\n";
			$generalCode.="window.TEXT_MONTH_AUG='".jsreplace("Agustus")."';\r\n";
			$generalCode.="window.TEXT_MONTH_SEP='".jsreplace("September")."';\r\n";
			$generalCode.="window.TEXT_MONTH_OCT='".jsreplace("Oktober")."';\r\n";
			$generalCode.="window.TEXT_MONTH_NOV='".jsreplace("Nopember")."';\r\n";
			$generalCode.="window.TEXT_MONTH_DEC='".jsreplace("Desember")."';\r\n";
			$generalCode.="window.TEXT_DAY_SU='".jsreplace("Mg")."';\r\n";
			$generalCode.="window.TEXT_DAY_MO='".jsreplace("Sn")."';\r\n";
			$generalCode.="window.TEXT_DAY_TU='".jsreplace("Sl")."';\r\n";
			$generalCode.="window.TEXT_DAY_WE='".jsreplace("Rb")."';\r\n";
			$generalCode.="window.TEXT_DAY_TH='".jsreplace("Km")."';\r\n";
			$generalCode.="window.TEXT_DAY_FR='".jsreplace("Jm")."';\r\n";
			$generalCode.="window.TEXT_DAY_SA='".jsreplace("Sb")."';\r\n";
			$generalCode.="window.TEXT_TODAY='".jsreplace("today")."';\r\n";
			$generalCode.="window.TEXT_SELECT_DATE = '".jsreplace("Select Date")."';\r\n";
			$generalCode.="window.TEXT_INVALID_CAPTCHA_CODE='".jsreplace("Invalid security code.")."';\r\n";
		}
		
		
		if($this->pageType == PAGE_EDIT || $this->pageType == PAGE_ADD || $this->pageType == PAGE_SEARCH || $this->pageType == PAGE_REGISTER)
		{
			$generalCode.="\r\nwindow['tName".$this->id."'] = '".jsreplace($this->tName)."';\r\n";
			$generalCode.="window.TEXT_INLINE_FIELD_REQUIRED='".jsreplace("Membutuhkan Kolom")."';\r\n";
			$generalCode.="window.TEXT_INLINE_FIELD_ZIPCODE='".jsreplace("Kolom harus Kode Pos yang benar")."';\r\n";
			$generalCode.="window.TEXT_INLINE_FIELD_EMAIL='".jsreplace("Kolom harus E-mail yang benar")."';\r\n";
			$generalCode.="window.TEXT_INLINE_FIELD_NUMBER='".jsreplace("Kolom harus nomor")."';\r\n";
			$generalCode.="window.TEXT_INLINE_FIELD_CURRENCY='".jsreplace("Kolom harus mata uang")."';\r\n";
			$generalCode.="window.TEXT_INLINE_FIELD_PHONE='".jsreplace("Kolom harus Nomor Telepon")."';\r\n";
			$generalCode.="window.TEXT_INLINE_FIELD_PASSWORD1='".jsreplace("Kolom tidak untuk \"password\"")."';\r\n";
			$generalCode.="window.TEXT_INLINE_FIELD_PASSWORD2='".jsreplace("Kolom harus sepanjang dari 4 karakter")."';\r\n";
			$generalCode.="window.TEXT_INLINE_FIELD_STATE='".jsreplace("Kolom harus Nama Negara")."';\r\n";
			$generalCode.="window.TEXT_INLINE_FIELD_SSN='".jsreplace("Kolom harus Nomor Sosial Security")."';\r\n";
			$generalCode.="window.TEXT_INLINE_FIELD_DATE='".jsreplace("Kolom harus tanggal yang benar")."';\r\n";
			$generalCode.="window.TEXT_INLINE_FIELD_TIME='".jsreplace("Kolom harus waktu yang benar dalam format 24 jam")."';\r\n";
			$generalCode.="window.TEXT_INLINE_FIELD_CC='".jsreplace("Kolom harus Nomor Kartu Kredit yang berlaku")."';\r\n";
			$generalCode.="window.TEXT_INLINE_FIELD_SSN='".jsreplace("Kolom harus Nomor Sosial Security")."';\r\n";			
		}

		$generalCode.="\nwindow.TEXT_PLEASE_SELECT='".jsreplace("Silahkan pilih")."';";
		
		$generalCode.="\nwindow.current_language='".mlang_getcurrentlang()."';\r\n";
		
		$generalCode.="\nwindow.locale_dateformat = '".$this->locale_info["LOCALE_IDATE"]."';".
		"\nwindow.locale_datedelimiter = '".$this->locale_info["LOCALE_SDATE"]."';".
		"\nwindow.bLoading=false;\r\n";
		
		$generalCode.="\nwindow.TEXT_CTRL_CLICK = \""."CTRL + click for multiple sorting"."\";".
		"\nwindow.TEXT_SAVE='".jsreplace("Simpan")."';".
		"\nwindow.TEXT_CANCEL='".jsreplace("Batal")."';".
		"\nwindow.TEXT_INLINE_ERROR='".jsreplace("Terjadi kesalahan")."';".
		"\nwindow.TEXT_PREVIEW='".jsreplace("preview")."';".
		"\nwindow.TEXT_HIDE='".jsreplace("hide")."';".
		"\nwindow.TEXT_LOADING='".jsreplace("loading")."';";
				
		return $generalCode;	
	}
	/**
	  * Add general js or css files for pages
	  */
	function addCommonJs() 
	{
		$this->AddJSFile("json");
		$this->AddJSFile("cookies");
		
		if ($this->debugJSMode === true)
		{
			$this->AddJSFile("runnerJS/IEHelper");
			$this->AddJSFile("runnerJS/RunnerEvent", "runnerJS/IEHelper");
			$this->AddJSFile("runnerJS/Validate","runnerJS/RunnerEvent");
			$this->AddJSFile('runnerJS/ControlManager','runnerJS/Validate');		
			$this->AddJSFile("runnerJS/SearchForm", "runnerJS/ControlManager");
			$this->AddJSFile("runnerJS/SearchFormWithUI", "runnerJS/SearchForm");
			$this->AddJSFile("runnerJS/SearchController", "runnerJS/SearchFormWithUI");		
			$this->AddJSFile("runnerJS/Control", "runnerJS/ControlManager");
			$this->AddJSFile("runnerJS/TextAreaControl", "runnerJS/Control");
			$this->AddJSFile("runnerJS/TextFieldControl", "runnerJS/Control");
			$this->AddJSFile("runnerJS/TimeFieldControl", "runnerJS/Control");
			$this->AddJSFile("runnerJS/RteControl", "runnerJS/Control");
			$this->AddJSFile("runnerJS/FileControl", "runnerJS/Control");
			$this->AddJSFile("runnerJS/DateFieldControl", "runnerJS/Control");
			$this->AddJSFile("runnerJS/RadioControl", "runnerJS/Control");
			$this->AddJSFile("runnerJS/LookupWizard", "runnerJS/Control");
			$this->AddJSFile("runnerJS/DropDown", "runnerJS/LookupWizard");
			$this->AddJSFile("runnerJS/CheckBox", "runnerJS/LookupWizard");
			$this->AddJSFile("runnerJS/TextFieldLookup", "runnerJS/LookupWizard");
			$this->AddJSFile("runnerJS/EditBoxLookup", "runnerJS/TextFieldLookup");
			$this->AddJSFile("runnerJS/ListPageLookup", "runnerJS/TextFieldLookup");
			$this->AddJSFile("runnerJS/ControlsEventHandler", "runnerJS/Control");			
			//$this->AddJSFile("runnerJS/RunnerAll");
		}
		else 	
		{			
			$this->AddJSFile("runnerJS/RunnerControls");
		}
		
		$this->AddJSCode("
			window.MODE_ADD = 0;
			window.MODE_EDIT = 1;
			window.MODE_SEARCH = 2;
			window.MODE_LIST = 3;
			window.MODE_PRINT = 4;
			window.MODE_VIEW = 5;
			window.MODE_INLINE_ADD = 6;
			window.MODE_INLINE_EDIT = 7;
			window.MODE_EXPORT = 8;
		");
	}
	/**
	  * Prepare js code
	  */
	function PrepareJs()
	{		
		// set new flyId for js
		$this->AddJSCode("if(window.flyid<".($this->flyId + 1).") window.flyid=".($this->flyId + 1).";\r\n");
		$js = "Runner.util.ScriptLoader.addPostLoadStep(function()
			{				
				setButtonBorderStyle();
				".$this->getTextVariables().$this->totalCode.";
				// on page load javascript event
				(function(pageid){
						".$this->onLoadJsEventCode."
					}
				)(".$this->id.");
			}, 
				".$this->id.");";
//		return $js.=$this->LoadJS_CSS($this->id);
		return $js.=$this->LoadJS_CSS();
	}
	/**
	  * Get code for stop Loading indicator
	  */
	function getStopLoading()
	{
		$this->AddJsCode("\nstopLoading(".$this->id.",".$this->mode.");");
	}
	/**
	  * Grab all js code
	  */
	function grabAllJsCode()
	{
		$jscode = $this->totalCode;
		$this->totalCode = "";
		return $jscode;
	}
	/**
	  * Grab all js code
	  */
	function grabAllJsFiles()
	{
		$jsFiles = $this->includes_js;
		$this->includes_js = array();
		return $jsFiles;
	}
	/**
	  * Grab all js code
	  */
	function grabAllCssFiles()
	{
		$cssFiles = $this->includes_css;
		$this->includes_css = array();
		return $cssFiles;
	}
	/**
	  * Prepare code for event "onSubmit" on simple pages add and edit
	  *
	  * @return $onsubmit
	  */	
	function onSubmitForEditingPage($formname)
	{
		$onsubmit = "$('#message_block".$this->id."').html('');".
		"var valRes = checkValidSimplePage('".$formname."','".jsreplace($this->tName)."');";
		if(displayDetailsOn($this->tName,$this->pageType))
		{
			$onsubmit.= "if(valRes){if(!window.dpObj.isSbmMaster)";
			if($this->pageType==PAGE_ADD)
				$onsubmit.= "window.dpObj.prepareForSaveAllDetail();";
			else if($this->pageType==PAGE_EDIT)
				$onsubmit.= "window.dpObj.saveAllDetail();";
			$onsubmit.= "valRes = false;}";
		}	
		$onsubmit.= " return valRes;";
		return $onsubmit;
	}
	
	function addButtonHandlers($handlerFilesArr)
	{	
		if (!count($handlerFilesArr))
		{
			return false;
		}
		
		if ($this->debugJSMode === true)
		{
			$this->AddJSFile("runnerJS/RunnerEvent");	
			$this->AddJSFile("runnerJS/button", "runnerJS/RunnerEvent");
		}
		else 
		{
			$this->AddJSFile("runnerJS/RunnerControls");
			$this->AddJSFile("runnerJS/button", "runnerJS/RunnerControls");
		}
		$this->AddJSFile("json");
		
		foreach ($handlerFilesArr as $handlerFile)
		{
			$this->AddJSFile("handlers/".$handlerFile, "runnerJS/button");	
		}
		
		return true;
	}
	
	
	function addOnLoadJsEvent($code) 
	{
		$this->onLoadJsEventCode .= ";\r\n".$code;
	}
	
	
	function setGoogleMapsParams($fieldsArr) 
	{
		$this->googleMapCfg['isUseMainMaps'] = count(@$this->googleMapCfg['mainMapIds']) > 0;	
		foreach($fieldsArr as $f)
		{
			if ($f['viewFormat'] == FORMAT_MAP)
			{				
				$this->googleMapCfg['isUseFieldsMaps'] = true;
				$this->googleMapCfg['fieldsAsMap'][$f['fName']] = array();
				$fieldMap = GetFieldData($this->tName, $f['fName'], "mapData", array());
				
				$this->googleMapCfg['fieldsAsMap'][$f['fName']]['width'] = $fieldMap['width'] ? $fieldMap['width'] : 0;
				$this->googleMapCfg['fieldsAsMap'][$f['fName']]['height'] = $fieldMap['height'] ? $fieldMap['height'] : 0;
				$this->googleMapCfg['fieldsAsMap'][$f['fName']]['addressField'] = $fieldMap['address'];
				$this->googleMapCfg['fieldsAsMap'][$f['fName']]['latField'] = $fieldMap['lat'];
				$this->googleMapCfg['fieldsAsMap'][$f['fName']]['lngField'] = $fieldMap['lng'];
			}
		}		
		$this->googleMapCfg['isUseGoogleMap'] = $this->googleMapCfg['isUseMainMaps'] || $this->googleMapCfg['isUseFieldsMaps'];
	}
	
	function addBigGoogleMapMarkers(&$data, $viewLink = '') 
	{		
		foreach ($this->googleMapCfg['mainMapIds'] as $mapId)
		{				
			$latF = $this->googleMapCfg['mapsData'][$mapId]['latField'];
			$lngF = $this->googleMapCfg['mapsData'][$mapId]['lngField'];	
			$addressF = $this->googleMapCfg['mapsData'][$mapId]['addressField'];
			$descF = $this->googleMapCfg['mapsData'][$mapId]['descField'];
			
			$markerArr = array();
			$markerArr['lat'] = $data[$latF] ? $data[$latF] : '';
			$markerArr['lng'] = $data[$lngF] ? $data[$lngF] : '';
			$markerArr['address'] = $data[$addressF] ? $data[$addressF] : '';
			$markerArr['desc'] = $data[$descF] ? $data[$descF] : $markerArr['address'];
			$markerArr['link'] = $viewLink;
			$markerArr['recId'] = $this->recId;
			
			$this->googleMapCfg['mapsData'][$mapId]['markers'][] = $markerArr;
		}
	}
	// call addGoogleMapData before call  proccessRecordValue!!!
	function addGoogleMapData($fName, &$data, $viewLink = '') 
	{
		$fieldMap = GetFieldData($this->tName, $fName, "mapData", array());
		
		$mapData['mapFieldValue'] = $data[$fName];
		$address = $data[$fieldMap['address']] ? $data[$fieldMap['address']] : "";
		$lat = $data[$fieldMap['lat']] ? $data[$fieldMap['lat']] : '';
		$lng = $data[$fieldMap['lng']] ? $data[$fieldMap['lng']] : '';
		$desc = $data[$fieldMap['desc']] ? $data[$fieldMap['desc']] : $address;
		$zoom = $fieldMap['zoom'] ? $fieldMap['zoom'] : 13; 
		$mapData['fName'] = $fName;
		$mapData['zoom'] = $zoom;
		$mapData['type'] = 'FIELD_MAP';
		$mapData['markers'][] = array('address'=> $address, 'lat'=>$lat, 'lng'=>$lng, 'link'=>$viewLink, 'desc'=>$desc, 'recId'=>$this->recId);
		
		$this->googleMapCfg['littleMapDefZoom'] = $zoom;
		
		$this->googleMapCfg['mapsData']['littleMap_'.GoodFieldName($fName).'_'.$this->recId] = $mapData;
		$this->googleMapCfg['fieldMapsIds'][] = 'littleMap_'.GoodFieldName($fName).'_'.$this->recId;
		
		return $this->googleMapCfg['mapsData']['littleMap_'.GoodFieldName($fName).'_'.$this->recId];
	}
	
	function initGmaps()
	{
		if ($this->googleMapCfg['isUseGoogleMap'])
		{			
			foreach ($this->googleMapCfg['mainMapIds'] as $mapId)
			{
				if ($this->googleMapCfg['mapsData'][$mapId]['showCenterLink'] === 1)
				{
					$this->googleMapCfg['centerLinkText'] = $this->googleMapCfg['mapsData'][$mapId]['centerLinkText'];
					break;
				}
			}
			$this->googleMapCfg['id'] = $this->id;
			$this->AddJSFile("json");
			$this->AddJSFile("runnerJS/gmap");
			if (!$this->googleMapCfg['APIcode'])
			{
				$this->googleMapCfg['APIcode'] = '';	
			}			
			$this->addJSCode(($this->mode!=LIST_AJAX ? "window.MapManager = new Runner.controls.MapManager('".my_json_encode($this->googleMapCfg)."');" : "")." Runner.controls.MapManager.init();");
		}
	}
	
	function addCenterLink(&$value, $fName)
	{
		if ($this->googleMapCfg['isUseMainMaps'])
		{
			foreach ($this->googleMapCfg['mainMapIds'] as $mapId)
			{
				// if no center link than continue;
				if ($this->googleMapCfg['mapsData'][$mapId]['addressField'] != $fName || !$this->googleMapCfg['mapsData'][$mapId]['showCenterLink'])
				{
					continue;
				}
				// if use user defined link if prop = 1 or use value if prop = 2				
				if($this->googleMapCfg['mapsData'][$mapId]['showCenterLink'] === 1)
				{
					$value = $this->googleMapCfg['mapsData'][$mapId]['centerLinkText'];					
				}
				return '<a href="#" type="centerOnMarker'.$this->id.'" recId="'.$this->recId.'">'.$value.'</a>';				
			}			
		}	
		return $value;	
	}
	
	function createOldMenu() 
	{		
		$allowedTablesCount = 0;
		$redirect_menu = '';
		
		for($i = 0; $i < count($this->menuTablesArr); $i++) 
		{			
			if($this->permis[$this->menuTablesArr[$i]['dataSourceTName']]['add']|| $this->permis[$this->menuTablesArr[$i]['dataSourceTName']]['search'])
			{				
				$this->xt->assign($this->menuTablesArr[$i]['dataSourceTName']."_tablelink", true);
				$page = "";
				
				if($this->permis[$this->menuTablesArr[$i]['dataSourceTName']]['search'] && ($this->menuTablesArr[$i]['nType'] == titTABLE || $this->menuTablesArr[$i]['nType'] == titVIEW)) 
				{
					$page = "list";
					if($this->permis[$this->menuTablesArr[$i]['dataSourceTName']]['add'])
						$strPerm = GetUserPermissions($this->menuTablesArr[$i]['strDataSourceTable']);
					if(isset($strPerm) && strpos($strPerm, "A") !== false && strpos($strPerm, "S") === false)
						$page = "add";					
				}elseif($this->permis[$this->menuTablesArr[$i]['dataSourceTName']]['add'] && ($this->menuTablesArr[$i]['nType'] == titTABLE || $this->menuTablesArr[$i]['nType'] == titVIEW)){
					$page = "add";
				}elseif($this->menuTablesArr[$i]['nType'] == titREPORT){
					$page = "report";
				}elseif($this->menuTablesArr[$i]['nType'] == titCHART){
					$page = "chart";
				}
				$this->xt->assign($this->menuTablesArr[$i]."_tablelink_attrs", "href=\"".$this->menuTablesArr[$i]."_".$page.".php\"");
				$this->xt->assign("".$this->menuTablesArr[$i]."_optionattrs", "value=\"".$this->menuTablesArr[$i]."_".$page.".php\"");
				$redirect_menu = $this->menuTablesArr[$i]['shortTName'].'_'.$page.".php";
				$allowedTablesCount++;
			}
		}		
		return array('menuTablesCount'=>$allowedTablesCount, 'urlForRedirect'=>$redirect_menu);
	}
	/**
	 * Get permissions for pages
	 */
	function getPermissions($tName = "") 
	{
		$resArr = array();
		
		if(!$this->isGroupSecurity) 
		{
			$resArr["add"]= true;
			$resArr["delete"]= true;
			$resArr["edit"]= true;
			$resArr["search"]= true;
			$resArr["export"]= true;
			$resArr["import"]= true;
		}
		else
		{
			if(!$tName)
				$tName = $this->tName;
			$strPerm = GetUserPermissions($tName);
			
			$resArr["add"]=(strpos($strPerm, "A") !== false);
			$resArr["delete"]=(strpos($strPerm, "D") !== false);
			$resArr["edit"]=(strpos($strPerm, "E") !== false);
			$resArr["search"]=(strpos($strPerm, "S") !== false);
			$resArr["export"]=(strpos($strPerm, "P") !== false);
			$resArr["import"]=(strpos($strPerm, "I") !== false);
		}
		return $resArr;
	}
	/**
	 * Check is need to create menu
	 *
	 */
	function isCreateMenu()
	{
		foreach($this->menuTablesArr as $menuTable) 
		{				
			if($this->permis[$menuTable['dataSourceTName']]['add'] || $this->permis[$menuTable['dataSourceTName']]['search'])
				return true;
		}
		return false;
	}
	
	function addRunLoading() {
		
	}

	function createCaptcha($params)
	{	
		
		$captchaHTML = '<div class="captcha_block">
			<object width="210" height="65" data="securitycode.swf?ext=php" type="application/x-shockwave-flash">
				<param value="securitycode.swf?ext=php" name="movie"/>
				<param value="opaque" name="wmode"/>
				<a href="http://www.macromedia.com/go/getflashplayer"><img alt="Download Flash" src=""/></a>
			</object>
				<div style="white-space: nowrap;">'."Type the code you see above".':</div>
			<span id="edit1_captcha_0">
				<input type="text" value="" name="value_captcha_'.$this->id.'" style="" id="value_captcha_'.$this->id.'"/>
				<font color="red">*</font>
			</span>';
		
		global $isCaptchaOk;
		
		if (isset($isCaptchaOk) && !$isCaptchaOk)
		{
			$captchaHTML .= '<div class="error">'."Invalid security code.".'</div>';
		}
		
		echo $captchaHTML.'</div>';
	}
}

?>