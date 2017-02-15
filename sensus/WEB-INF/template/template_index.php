<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SENSUS</title>
<link rel="stylesheet" type="text/css" href="<?php echo getScriptUrl(); ?>style/style.css" />

<style>
	body{background:url(<?php echo getScriptUrl(); ?>images/bg.jpg) no-repeat center top #310b28;}
</style>

<script type="text/javascript" src="<?php echo getScriptUrl(); ?>js/clockp.js"></script>
<script type="text/javascript" src="<?php echo getScriptUrl(); ?>js/clockh.js"></script> 
<script type="text/javascript" src="<?php echo getScriptUrl(); ?>js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="<?php echo getScriptUrl(); ?>js/ddaccordion.js"></script>
<script type="text/javascript" src="<?php echo getScriptUrl(); ?>js/iframe.js"></script>

<script type="text/javascript">
	ddaccordion.init({
		headerclass: "submenuheader",contentclass: "submenu",revealtype: "click",mouseoverdelay: 200,
		collapseprev: true,defaultexpanded: [],onemustopen: false,animatedefault: false,
		persiststate: true,toggleclass: ["", ""],togglehtml: ["suffix", "<img src='<?php echo getScriptUrl(); ?>images/plus.gif' class='statusicon' />",
																		"<img src='<?php echo getScriptUrl(); ?>images/minus.gif' class='statusicon' />"],
		animatespeed: "fast",oninit:function(headers, expandedindices){ },
		onopenclose:function(header, index, state, isuseractivated){}
	});
	
	function load_todoList(){
		$.ajax({
			url : '<?php echo getScriptUrl(); ?>todo/getListTodoList.html',
			dataType : 'html',
			success : function(data){
				$('#todoList').html(data);
			}
		});
	};

	function load_notice(){
		$.ajax({
			url : '<?php echo getScriptUrl(); ?>notice/getListNotice.html',
			dataType : 'html',
			success : function(data){
				$('#noticelist').html(data);
			}
		});
	};

	function getSearchKeyword(){
		return ($('.search_input').val()!= 'pencarian') ? $('.search_input').val() : '';
	};
	
	$(document).ready(function() {
		$('.search_submit').live("click", function() {
			if ($('#keyword').val() == $('#keyword').attr('title'))
				$('#keyword').val('');

			document.getElementById('hwFrame').contentWindow.load_table($('.search_input').val(),1);
			if ($('#keyword').val() == '')
				$('#keyword').val($('#keyword').attr('title'));
		});
		
		$('#keyword').keyup(function (e) {
			if (e.keyCode == 13) {
				$('.search_submit').click();
			    return false;
			  }
		});
		$("#keyword").focus(function() {
			if (($("#keyword")).attr('class') == "search_input_water") {
				$("#keyword").val("");
				$("#keyword").removeClass("search_input_water");
				$("#keyword").addClass("search_input");
			}
		});
		$("#keyword").blur(function() {
			if ($.trim($("#keyword").val()) == "") {
				$("#keyword").val(this.title);
				$("#keyword").removeClass("search_input");
				$("#keyword").addClass("search_input_water");
			}
		});

		$('#add_new_item').click(function() {
			document.getElementById('hwFrame').contentWindow.add_new_item();
		});
	});	
</script>

</head>
<body>
<div id="main_container">
	<div class="header">
	    <div class="logo"><a href="<?php echo getScriptUrl(); ?>index.html"><img src="<?php echo getScriptUrl(); ?>images/logo.gif" alt="" title="" border="0" /></a></div>
	    <div class="right_header">Welcome <?php echo Auth::getCurrentUser()->get_nama_lengkap();?> | <a href="<?php echo getScriptUrl(); ?>login/logout.html" class="logout">Logout</a></div>
	    <div id="clock_a"></div>
    </div>
    <div class="main_content">
	    <div class="menu"><?php echo $menu['menu']; ?></div> 
	    <div class="center_content">
		    <div class="left_content"> 
	    		<div class="sidebar_search">
		            <input type="text" name="keyword" id="keyword" class="search_input_water" value="Pencarian" title="Pencarian" />
		            <input type="image" class="search_submit" src="<?php echo getScriptUrl(); ?>images/search.png" alt="Cari" title="Cari" />
	            </div>
	            <div class="sidebarmenu">
	                <a class="menuitem submenuheader" href="">Shortcut</a>
	                <div class="submenu"><?php echo $menu['shortcut']; ?></div> 
	                <?php echo $menu_aksi->user_authority('shortcut');?>
	            </div>
	            <div id="notice" class="sidebar_box">
	                <div class="sidebar_box_top"></div>
	                <div class="sidebar_box_content">
	                	<a href="<?php echo getScriptUrl(); ?>notice/list.html"><h4><u>Catatan Penting</u></h4></a>
	                	<a href="#notice"><img border="none" src="<?php echo getScriptUrl(); ?>images/notice.png" alt="Refresh Notice" title="Refresh Notice" onclick="javascript:load_notice()" class="sidebar_icon_right" /></a>
	                	<ul id="noticelist"><?php $notice_aksi->getListNotice(); ?></ul>                
	                	</div>
	                <div class="sidebar_box_bottom"></div>
	            </div>
	            <div id="todo" class="sidebar_box">
	                <div class="sidebar_box_top"></div>
	                <div class="sidebar_box_content">
	                <h4><a href="<?php echo getScriptUrl(); ?>todo/list.html"><u>Todo List</u></a></h4>
	                <a href="#todo"><img border="none" src="<?php echo getScriptUrl(); ?>images/info.png" alt="Refresh Todo List" title="Refresh Todo List" onclick="javascript:load_todoList()" class="sidebar_icon_right" /></a>
	                <ul id="todoList"><?php $todo_aksi->getListTodoList(); ?></ul>                
	                </div>
	                <div class="sidebar_box_bottom"></div>
	            </div>
		    </div> <!-- end of left content-->
			<div class="right_content">
				<iframe id="hwFrame" name="hwFrame" src="<?php echo getScriptUrl() . $Command->getControllerName();?>" scrolling="no" width="100%" frameBorder="0" style="border:none"></iframe>
			</div><!-- end of right content-->
		</div>   <!--end of center content -->                 
	    <div class="clear"></div>
    </div> <!--end of main content-->
    <div class="footer">
    	<div class="left_footer">SENSUS | Powered by <a href="http://www.fb.me/herman.whyd" target="blank">HERMAN WAHYUDI</a></div>
    	<div class="right_footer"><a href="http://indeziner.com" target="blank"><img src="<?php echo getScriptUrl(); ?>images/indeziner_logo.gif" border="0" /></a></div>
    </div>
</div>
</body>
</html>