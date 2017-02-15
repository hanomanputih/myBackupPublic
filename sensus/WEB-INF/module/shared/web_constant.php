<?php 
class web_constant{
	public static  $ORDER_DESC = "DESC";
	public static  $ORDER_ASC = "ASC";
	public static $DEFAULT_PAGINATED_SIZE = 20;
	
	public static $LOGIN_MESSAGE_WRONG = "<dl><dt></dt><dd><label style='color:red'>Username/Password Salah!</label></dd></dl>";
	public static $LOGIN_MESSAGE_TIMEOUT = "<dl><dt></dt><dd><label style='color:red'>Waktu session Anda habis, silahkan login kembali!</label></dd></dl>";
	
	public static $AUTORITY_ADD_SHORTCUT = "<a class='menuitem_green' id='add_new_item' href='#'>Add new item</a>";
	public static $AUTORITY_ADD = "<a id='add_new' href='#' class='bt_green'><span class='bt_green_lft'></span><strong>Add new item</strong><span class='bt_green_r'></span></a>";
	public static $AUTORITY_DEL = "<a id='delete' href='#' class='bt_red'><span class='bt_red_lft'></span><strong>Delete items</strong><span class='bt_red_r'></span></a>";
}