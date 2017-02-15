<?php if( !defined('BASEPATH')) exit('No direct script access allowed');

class Library_mine {


	/**
	* @author imamsrifkan
	* @param  Array $data['header']		field_name 		Name of columns in table
	* @param  Array $data['header']		display_as		Alias name of column in table
	* @param  Array $data['list']						Record data from table		
	*/

	public function web_to_excel($data)
	{
		$string_to_export = '';
		foreach($data['columns'] as $column)
		{
			$string_to_export .= $column['display_as']."\t";
		}
		$string_to_export .= "\n";
		if(@$data['list'])
		{
			foreach($data['list'] as $list)
			{
				foreach($data['columns'] as $column)
				{
					$string_to_export .= $this->_trim_string($list[$column['field_name']])."\t";
				}
				$string_to_export .= "\n";
			}			
		}

		// Convert to UTF-16LE and Prepend BOM
		$string_to_export = "\xFF\xFE" .mb_convert_encoding($string_to_export, 'UTF-16LE', 'UTF-8');

		$filename = "export-".date("Y-m-d_H:i:s").".xls";
		
		header('Content-type: application/vnd.ms-excel;charset=UTF-16LE');
		header('Content-Disposition: attachment; filename='.$filename);		
		header("Cache-Control: no-cache");
		echo $string_to_export;
		die();
	}

	public function web_to_print($data)
	{
		$string_to_print = "<meta charset=\"utf-8\" /><style type=\"text/css\" >
		#print-table{ color: #000; background: #fff; font-family: Verdana,Tahoma,Helvetica,sans-serif; font-size: 13px;}
		#print-table table tr td, #print-table table tr th{ border: 1px solid black; border-bottom: none; border-right: none; padding: 4px 8px 4px 4px}
		#print-table table{ border-bottom: 1px solid black; border-right: 1px solid black}
		#print-table table tr th{text-align: left;background: #ddd}
		#print-table table tr:nth-child(odd){background: #eee}
		</style>";
		$string_to_print .= "<div id='print-table'>";
		
		$string_to_print .= '<table width="100%" cellpadding="0" cellspacing="0" ><tr>';
		foreach($data['columns'] as $column){
			$string_to_print .= "<th>".$column['display_as']."</th>";
		}
		$string_to_print .= "</tr>";
	
		if(@$data['list'])
		{
			foreach($data['list'] as $num_row => $row)
			{
				$string_to_print .= "<tr>";
				foreach($data['columns'] as $column){
					$string_to_print .= "<td>".$this->_trim_print_string($row[$column['field_name']])."</td>";
				}
				$string_to_print .= "</tr>";
			}
		}
		
		$string_to_print .= "</table></div>";
		
		echo $string_to_print;
		die();
	}

	protected function _trim_string($value)
	{
		$value = str_replace(array("&nbsp;","&amp;","&gt;","&lt;"),array(" ","&",">","<"),$value);
		return  strip_tags(str_replace(array("\t","\n","\r"),"",$value));
	}

	protected function _trim_print_string($value)
	{
		$value = str_replace(array("&nbsp;","&amp;","&gt;","&lt;"),array(" ","&",">","<"),$value);
		
		//If the value has only spaces and nothing more then add the whitespace html character 
		if(str_replace(" ","",$value) == "")
			$value = "&nbsp;";
		
		return strip_tags($value);
	}
}

/* End of file library_mine.php */
/* Location: ./application/libraries/library_mine.php */

