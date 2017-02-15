<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Laporan</title>
	<link rel="stylesheet" href="<?php echo getScriptUrl();?>style/style.css" type="text/css" />
	<link rel="stylesheet" href="<?php echo getScriptUrl();?>style/message-box.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="<?php echo getScriptUrl();?>style/bootstrap.css" type="text/css" />
	<link rel="stylesheet" href="<?php echo getScriptUrl();?>style/daterangepicker.css" type="text/css" />
	<link rel="stylesheet" href="<?php echo getScriptUrl();?>style/colorbox.css" type="text/css" />
	<style>
		body{background:url(<?php echo getScriptUrl();?>images/bg.jpg) no-repeat center top #310b28;}}
	</style>
	
	<script type="text/javascript" src="<?php echo getScriptUrl();?>js/jquery-1.7.1.min.js"></script>
	<script type="text/javascript" src="<?php echo getScriptUrl();?>js/jquery.dimensions.js"></script>
	<script type="text/javascript" src="<?php echo getScriptUrl();?>js/clockp.js"></script>
	<script type="text/javascript" src="<?php echo getScriptUrl();?>js/clockh.js"></script> 
	<script type="text/javascript" src="<?php echo getScriptUrl();?>js/ddaccordion.js"></script>
	<script type="text/javascript" src="<?php echo getScriptUrl();?>js/message-box.js"></script> 
	<script type="text/javascript" src="<?php echo getScriptUrl();?>js/date.js"></script>
    	<script type="text/javascript" src="<?php echo getScriptUrl();?>js/daterangepicker.js"></script>
	<script type="text/javascript" src="<?php echo getScriptUrl();?>js/highcharts.js"></script>
	<script type="text/javascript" src="<?php echo getScriptUrl();?>js/modules/exporting.js"></script>
	<script type="text/javascript" src="<?php echo getScriptUrl();?>js/report/template.report.js"></script>
	<script type="text/javascript" src="<?php echo getScriptUrl();?>js/jquery.colorbox.js"></script>
	
	<script type="text/javascript">
		ddaccordion.init({
			headerclass: "submenuheader",contentclass: "submenu",revealtype: "click",mouseoverdelay: 200,
			collapseprev: true,defaultexpanded: [],onemustopen: false,animatedefault: false,
			persiststate: true,toggleclass: ["", ""],togglehtml: ["suffix", "<img src='<?php echo getScriptUrl(); ?>images/plus.gif' class='statusicon' />",
																			"<img src='<?php echo getScriptUrl(); ?>images/minus.gif' class='statusicon' />"],
			animatespeed: "fast",oninit:function(headers, expandedindices){ },
			onopenclose:function(header, index, state, isuseractivated){}
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
				<?php echo $Command->getOption()?>
		    </div> <!-- end of left content-->
			<div class="right_content">
				<?php include getcwd() . '/WEB-INF/view/' . $Command->getControllerName() . '_view.php';?>
			</div><!-- end of right content-->
			</div><!--end of center content -->                 
	    <div class="clear"></div>
    </div> <!--end of main content-->
    <div class="footer">
    	<div class="left_footer">SENSUS | Powered by <a href="http://www.fb.me/herman.whyd" target="blank">HERMAN WAHYUDI</a></div>
    	<div class="right_footer"><a href="http://indeziner.com" target="blank"><img src="<?php echo getScriptUrl(); ?>images/indeziner_logo.gif" border="0" /></a></div>
    </div>
</div>
</body>
</html>