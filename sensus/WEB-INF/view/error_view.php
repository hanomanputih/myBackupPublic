<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
		<link rel="stylesheet" href="<?php echo getScriptUrl();?>style/style.css" type="text/css" />
		<script type="text/javascript" src="<?php echo getScriptUrl();?>js/jquery-1.7.1.min.js"></script>
		<script type="text/javascript" src="<?php echo getScriptUrl();?>js/sessionJs.js"></script>
		<title>Page Not Found</title>
		<script type="text/javascript">
			$(function(){
				window.top.resizeIframe(560);
			});
		</script>
	</head>
<body>
	<div class="warning_box">The page you requested was not found.<br/><ul><li><a onclick="javascript:top.window.jsSession('<?php echo getScriptUrl();?>index.html')" href="#">Return home</a></li></ul></div>
</body>
</html>