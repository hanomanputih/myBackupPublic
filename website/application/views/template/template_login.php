<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<title><?php echo $title?></title>
<link rel="stylesheet" href="<?php echo base_url()?>public/css/screen.css" type="text/css" media="screen" title="default" />
<link href="<?php echo base_url()?>public/images/ksc.ico" rel="shortcut icon" type="image/x-icon" />
<script type="text/javascript" src="<?php echo base_url()?>public/js/jquery-1.8.1.min.js"></script>
<script src="<?php echo base_url()?>public/js/proses.js" type="text/javascript"></script>


</head>
<body id="login-bg"> 
 
<!-- Start: login-holder -->
<div id="login-holder">
	<!-- start logo -->
	<div id="logo-login">
	</div>
	<!-- end logo -->
	
	<div class="clear"></div>
	
	<!--  start loginbox ................................................................................. -->
	<div id="loginbox">
	
	<!--  start login-inner -->
	<div id="login-inner">
            
		<?php
                echo $content;
                ?>
	</div>
 	<!--  end login-inner -->
	<div class="clear"></div>
 </div>
 <!--  end loginbox -->
 

</div>
<!-- End: login-holder -->
</body>
</html>