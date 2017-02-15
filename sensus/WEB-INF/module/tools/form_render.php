<?php
class form_render{
	
	/**
	 * 
	 * Render Tabel di default page
	 * @param object json $json
	 */
	public static function render_json($json) {
		$data = json_decode($json, true);
		$table = "<table id=\"rounded-corner\"> \n";
		$table = $table . "<thead><tr> \n";
		foreach ($data['header'] as $key=>$value) {
			$clazz = "rounded";
			if ($key == 0)
				$table = $table . "<th scope=\"col\" class=\"rounded-company\"></th> \n";
			if ($key == (count($data['header']) - 1))
				$clazz = "rounded-q4";

			$table = $table . "<th scope=\"col\" class=\"$clazz\">" . $value . "</th> \n";
		}
		$table = $table . "</tr></thead> \n";

		$table = $table . "<tfoot><tr> \n";
		if (count($data['header']) > 1) {
			$table = $table . "<td colspan=\"" . count($data['header']) . "\" class=\"rounded-foot-left\"><em>" . $data["footer"] . "</em></td> \n";
			$table = $table . "<td class=\"rounded-foot-right\">&nbsp;</td> \n";
		} else {
			$table = $table . "<td class=\"rounded-foot-left\">&nbsp;</td> \n";
			$table = $table . "<td colspan=\"" . count($data['header']) . "\" class=\"rounded-foot-right\"><em>" . $data["footer"] . "</em></td> \n";
		}
		$table = $table . "</tr></tfoot> \n";

		$table = $table . "<tbody> \n";
		foreach ($data['rows'] as $key=>$value) {
			if (isset($value['ID']))
				$table = $table . "<tr><td><input type=\"checkbox\" value=\"" . $value['ID'] . "\" /></td>";
			else if  (isset($value['index']))
				$table = $table . "<tr><td>" . $value['index'] . "</td>";
			
			foreach ($data['header'] as $key_h=>$value_h) {
				$table = $table . "<td>" .$value[$value_h]. "</td>";
			}
			$table = $table . "</tr>\n";
		}
		$table = $table . "</tbody></table>";

		return $table;
	}
	
	/**
	 * 
	 * Render Tabel di default page
	 * @param object json $json
	 */
	public static function render_print_report($json) {
		$data = json_decode($json, true);
		$table = "<table border=\"1\" cellspacing=\"1\" cellpadding=\"1\"><thead><tr bgcolor=\"#CCCCCC\">";
		foreach ($data['header'] as $key=>$value) {
			if ($key == 0)
				$table = $table . "<th>No</th>";

			$table = $table . "<th>" . $value . "</th>";
		}
		$table = $table . "</tr></thead>";

		$table = $table . "<tbody>";
		foreach ($data['rows'] as $key=>$value) {
			$table = $table . "<tr><td>" . $value['index'] . "</td>";
			
			foreach ($data['header'] as $key_h=>$value_h) {
				$table = $table . "<td style=\"mso-number-format:\@\">" .$value[$value_h]. "</td>";
			}
			$table = $table . "</tr>";
		}
		$table = $table . "</tbody>";

		$table = $table . "<tfoot><tr>";
		$table = $table . "<td>&nbsp;</td>";
		$table = $table . "<td colspan=\"" . count($data['header']) . "\"><em>" . $data["footer"] . "</em></td>";
		$table = $table . "</tr></tfoot>";
		$table = $table . "</table>";

		return $table;
	}

	/**
	 * 
	 * Render table detail action
	 * @param $json
	 * @param array $opt = array("left"=>{0},"right"=>{1})
	 */
	public static function detail_render($json, $opt) {
		$data = json_decode($json, true);
		$table = "<table id=\"rounded-corner\" width='80%'> \n";
		$table = $table . "<tbody>\n";
		foreach ($data['rows'] as $key=>$value) {
			foreach ($data['header'] as $key_h=>$value_h) {
				$table = $table . "<tr>";
				$table = $table . "<td align=\"right\">$value_h</td>\n";
				$table = $table . "<td align=\"center\">:</td>\n";
				if ($value_h == "Foto")
					$table = $table . "<td><img style='cursor: pointer;' onclick=\"javascript:show_foto('" . getScriptUrl() . $value[$value_h] . "')\" src='" . getScriptUrl() . $value[$value_h] . "' width='90' height='60'/></td>\n";
				else if ($value_h == "Web")
					$table = $table . "<td><a href='http://$value[$value_h]' target='_blank'>$value[$value_h]</a></td>\n";
				else if ($value_h == "Email")
					$table = $table . "<td><a href='mailTo:$value[$value_h]' target='_blank'>$value[$value_h]</a></td>\n";
				else if (substr($value_h,0,3) == "URL")
					$table = $table . "<td><a href='$value[$value_h]' target='_blank'>$value[$value_h]</a></td>\n";
				else if ($value_h == "Geo")
					$table = $table . "<td><a href='http://maps.google.com/maps/place?q=$value[$value_h]' target='_blank'>$value[$value_h]</a></td>\n";
				else {
					$table = $table . "<td>$value[$value_h]</td>\n";
				}
	
				$table = $table . "</tr>\n";
			}
		}
		$table = $table . "</tbody>";
		if (count($opt)>0) {
			$table = $table . "<tfoot><tr><td class=\"rounded-foot-left\" align=\"right\" colspan=\"2\">" . $opt['left'] . "</td><td class=\"rounded-foot-right\">" . $opt['right'] . "</td></tr></tfoot>";
		}
		$table = $table . "</table>";
		return $table;
	}
	
	public static function pagination_null_render(){
		$pagination = $pagination . "<span class=\"disabled\"><< prev</span>";
		$pagination = $pagination . "<span class=\"disabled\">next >></span>";
		return $pagination;
	}
	
	/**
	 * Pagination Builder
	 */ 
	public static function pagination_render($pageNow,$rowCount){
		$pageCount = form_render::paged($rowCount);
		$prevPage = $pageNow - 1;
		$nextPage = $pageNow + 1;
			
		$pagination = "";
		if($pageNow == 1)
			$pagination = $pagination . "<span class=\"disabled\"><< first</span>" . "<span class=\"disabled\"><< prev</span>";
		else
			$pagination = $pagination . "<a href=\"#\" onclick=\"javascript:pagination(1)\"><< first</a>" . "<a href=\"#\" onclick=\"javascript:pagination($prevPage)\"><< prev</a>";
			
		$maxPage = 1;
		$minPage = 1;
			
		if ($pageNow >= 8)
		{
			if (($pageNow + 4) <= $pageCount)
				$maxPage = $pageNow + 4;
			else
				$maxPage = $pageCount;

			if (($pageNow - 5) > 0)
			{
				if ($maxPage == $pageCount)
				{
					if (($maxPage - 9) > 0)
						$minPage = $maxPage - 9;
					else
						$minPage = 1;
				}
				else
				{
					$minPage = $pageNow - 5;
				}
			}
			else
			$minPage = 1;
		}
		else
		{
			if ($pageCount >= 10)
			$maxPage = 10;
			else
			$maxPage = $pageCount;
		}
			
		for ($i = $minPage; $i <= $maxPage; $i++) {
			if ($i == $pageNow)
				$pagination = $pagination . "<span class=\"current\">$i</span>";
			else
				$pagination = $pagination . "<a href=\"#\" onclick=\"javascript:pagination($i)\">$i</a>";
		}
			
		if($pageNow == $maxPage)
			$pagination = $pagination . "<span class=\"disabled\">last >></span>" . "<span class=\"disabled\">next >></span>";
		else
			$pagination = $pagination . "<a href=\"#\" onclick=\"javascript:pagination($nextPage)\">next >></a>". "<a href=\"#\" onclick=\"javascript:pagination($pageCount)\">last >></a>";
			
		return $pagination;
	}

	private static function paged($start) {
		if ($start % web_constant::$DEFAULT_PAGINATED_SIZE == 0)
			return $start / web_constant::$DEFAULT_PAGINATED_SIZE;
		else
			return floor((($start) / web_constant::$DEFAULT_PAGINATED_SIZE)+1);
	}

	public static function action_edit($id){
		return "<a href=\"#\"><img src=\"images/user_edit.png\" alt=\"Edit\" title=\"Edit\" border=\"0\" onclick=\"javascript:edit_form(" . $id . ")\" /></a>";
	}
	
	public static function action_activate($id){
		return "<a href=\"#\"><img src=\"images/user_go_16.png\" alt=\"Edit and Activate\" title=\"Edit and Activate\" border=\"0\" onclick=\"javascript:edit_form(" . $id . ")\" /></a>";
	}
	
	public static function action_detail($title,$id,$controller){
		return "<a href=\"#\"><img src=\"images/icon_view.gif\" alt=\"" . $title . "\" title=\"" . $title . "\" border=\"0\" onclick=\"javascript:detailForm(" . $id . ",'" . $controller . "')\"/></a>";
	}
	
	/**
	 * 
	 * Generate redirect URL
	 * @param String $title : ALT
	 * @param String $url
	 * @param String $label : label untuk <a>, jika null diganti dengan icon detail
	 */
	public static function action_redirect_url($title, $url, $label=""){
		if (!string_tools::is_not_empty_or_null($label))
			return "<a href=\"#\"><img src=\"images/icon_view.gif\" alt=\"" . $title . "\" title=\"" . $title . "\" border=\"0\" onclick=\"javascript:document.location.href ='" . $url ."'\"/></a>";
		else
			return "<a alt=\"" . $title . "\" href=\"#\" onclick=\"javascript:document.location.href ='" . $url ."'\">" . $label . "</a>";
	}
	
	public static function action_detail_form($id,$controller,$label){
		return "<a href=\"#\" onClick=\"javascript:detailForm(" . $id . ",'" . $controller . "')\">" . $label . "</a>";
	}
	
	public static function menu_shortcut_render($json) {
		$data = json_decode($json, true);
		$listMenu = '<ul>' . "\n";
		foreach ($data as $menu) {
			$listMenu .= '<li><a href="' . getScriptUrl() . $menu['url'] . '">' . $menu['nama'] . '</a></li>' . "\n";
		}
		$listMenu .= '</ul>';
		return $listMenu;
	}

	public static function menu_render($json) {
		$data = json_decode($json, true);
		$listMenu = '<ul>' . "\n";
		foreach ($data as $menu) {
			if (count($menu['submenu']) == 0) {
				$listMenu .= '<li><a href="' . getScriptUrl() . $menu['url'] . '" target="_' . $menu['target'] . '" >' . $menu['nama'] . '</a></li>' . "\n";
			} else {
				form_render::menu_child_render($listMenu, $menu, 0);
			}
		}
		$listMenu .= '</ul>' . "\n";
		return $listMenu;
	}
	
	private static function menu_child_render(&$listMenu, $menu, $idx) {
		if (count($menu['submenu']) != 0) {
			$subClass =  $idx == 0 ? '' : 'class=\'sub1\'';
			$listMenu .= '<li><a '. $subClass .' href="' . getScriptUrl() . $menu['url'] . '" target="_' . $menu['target'] . '">' . $menu['nama'] . '<!--[if IE 7]><!--></a><!--<![endif]-->' . "\n";
			$listMenu .= '<!--[if lte IE 6]><table><tr><td><![endif]-->' . "\n";
			$listMenu .= '<ul>' . "\n";
			foreach ($menu['submenu'] as $submenu) {
				form_render::menu_child_render($listMenu, $submenu, ++$idx);
			}
			$listMenu .= '<!--[if lte IE 6]></td></tr></table></a><![endif]-->' . "\n";
			$listMenu .= '</ul>' . "\n";
			$listMenu .= '</li>' . "\n";
		} else {
			$listMenu .= '<li><a href="' . getScriptUrl() . $menu['url'] . '" target="_' . $menu['target'] . '" >' . $menu['nama'] . '</a></li>' . "\n";
		}
	}
	
	public static function permission_render($json) {
		$data = json_decode($json, true);
		$listMenu = '<table border="0">' . "\n";
		foreach ($data as $menu) {
			if (count($menu['submenu']) == 0)
				form_render::permission_child_menu_function_render($listMenu,$menu,'');
			else
				form_render::permission_child_render($listMenu, $menu, 0);
		}
		$listMenu .= '</table>' . "\n";
		return $listMenu;
	}
	
	private static function permission_child_render(&$listMenu, $menu, $idx) {
		if (count($menu['submenu']) != 0) {
			$checked = ($menu['checked'] == 1) ? 'checked="checked"' : '';
			$td_increase = ($idx > 0) ? '<td width="30">' : '';
			$listMenu .= '<table border="0"><tr>' . $td_increase . '<td><a><img onclick="ToggleNode(this)" src="' . getScriptUrl() . 'images/treeview/minus.gif"><input onclick="toggle(this,' . $menu['id'] . ',1);" type="checkbox" ' . $checked . '>' . $menu['nama'] . '</a><div style="display: block">' . "\n";
			foreach ($menu['submenu'] as $submenu) {
				form_render::permission_child_render($listMenu, $submenu, ++$idx);
			}
			$listMenu .= '</div>' . "\n";
			$listMenu .= '</td></tr></table>' . "\n";
		} else {
			$checked = ($menu['checked'] == 1) ? 'checked="checked"' : '';
			form_render::permission_child_menu_function_render($listMenu,$menu);
		}
	}
	
	private static function permission_child_menu_function_render(&$listMenu, $menu, $opt='<td width="30">') {		
		if (count($menu['functions']) == 0) {
			$checked = ($menu['checked'] == 1) ? 'checked="checked"' : '';
			$listMenu .= '<table border="0"><tr><td width="30"></td><td><img src="' . getScriptUrl()  . 'images/treeview/leaf.gif"><input onclick="toggle(this,' . $menu['id'] . ',1);" type="checkbox" ' . $checked . '>' . $menu['nama'] . '<div style="display:none"></div></td></tr></table>' . "\n";
		} else {
			$checked = ($menu['checked'] == 1) ? 'checked="checked"' : '';
			$listMenu .= '<table border="0"><tr>' . $opt . '</td><td><a><img onclick="ToggleNode(this)" src="' . getScriptUrl() . 'images/treeview/plus.gif"><input onclick="toggle(this,' . $menu['id'] . ',1);" type="checkbox" ' . $checked . '>' . $menu['nama'] . '</a><div style="display: none">' . "\n";
			foreach ($menu['functions'] as $function) {
				$functionChecked = ($function['checked'] == 1) ? 'checked="checked"' : '';
				$listMenu .= '<table border="0"><tr><td width="30"></td><td><img src="' . getScriptUrl()  . 'images/treeview/leaf.gif"><input onclick="toggle(this,' . $menu['id'] . ',' . $function['id'] . ');" type="checkbox" ' . $functionChecked . '>' . $function['nama'] . '<div style="display:none"></div></td></tr></table>' . "\n";
			}
			$listMenu .= '</div>' . "\n";
			$listMenu .= '</td></tr></table>' . "\n";
		}
	}
	
	public static function menu_filter_render($menu_filter) {
		$result = "<div class='submenu'><ul>";
		foreach ($menu_filter['input'] as $input) {
			$result .= "<li><input type='checkbox' name='" . $menu_filter['name'] . "' value='" . $input['id'] . "' checked='checked'/>" . $input['label'] . "</li>";
		}
		$result .= "</ul></div>";
		
		return $result;
	}
}
?>