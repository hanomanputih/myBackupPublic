<?php

/**
 * Search control builder class for advanced search
 *
 */
class AdvancedSearchControl extends SearchControl 
{
	function AdvancedSearchControl($id, $tName='', &$searchClauseObj, &$pageObj) {
		parent::SearchControl($id, $tName, $searchClauseObj, $pageObj);
		$this->getSrchPanelAttrs['ctrlTypeComboStatus'] = true;
	}
	
	// if no searchSuggest, only form submit on enter
	function createNoSuggestJs() 
	{
		return "
			window.OnKeyDown = function (e)
			{
				if(!e)
					e = window.event; 
				if (e.keyCode == 13){
					e.cancel = true; 
					document.forms[0].submit();
				}
			};
		";		
	}
}


?>