<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>SENSUS | LOGIN</title>
	<link rel="stylesheet" type="text/css" href="<?php echo getScriptUrl(); ?>style/style.css" />
	<link rel="stylesheet" type="text/css" media="all" href="<?php echo getScriptUrl(); ?>form/uniform.default.css" />
	<style>
		body {background: url(images/bg.jpg) no-repeat center top #310b28;}
	</style>
	<script language="javascript" type="text/javascript" src="<?php echo getScriptUrl(); ?>js/jquery-1.7.1.min.js"></script>
	<script language="javascript" type="text/javascript" src="<?php echo getScriptUrl(); ?>form/jquery.uniform.js"></script>
	<script language="javascript" type="text/javascript" >
		$(document).ready(function(){
			$("input, textarea, button, select").uniform();
		});
	</script>
</head>
<body>
	<div id="main_container">
		<div class="header_login">
			<div class="logo">
				<a href="#"><img src="<?php echo getScriptUrl(); ?>images/logo.gif" alt="" title="" border="0" /></a>
			</div>
		</div>

		<div class="login_form">
			<h3>Sensus - Login</h3>
			<form id="myForm" action="<?php echo getScriptUrl(); ?>login/do_login.html" enctype="application/x-www-form-urlencoded" method="post">
				<input type="hidden" id="redirect_url" name="redirect_url" value="<?php if (isset($_GET['redirect_url'])) echo $_GET['redirect_url'];?>" />
				<fieldset>
					<dl>
						<dt>
							<label for="password">Username:</label>
						</dt>
						<dd>
							<input type="text" name="password" id="password" size="25" />
						</dd>
					</dl>
					<dl>
						<dt>
							<label for="username">Password:</label>
						</dt>
						<dd>
							<input type="password" name="username" id="username" size="25" />
						</dd>
					</dl>
					<?php echo $message?>
					<dl>
						<dt></dt>
						<dd>
							<input type="submit" name="submit" id="submit" value="Login" />
						</dd>
					</dl>
				</fieldset>
			</form>
		</div>
		<div class="footer_login">
			<div class="left_footer_login">
				SENSUS | Powered by <a href="http://www.fb.me/herman.whyd" target="blank">HERMAN WAHYUDI</a>
			</div>
			<div class="right_footer_login">
				<a href="http://indeziner.com" target="_blank"><img src="<?php echo getScriptUrl(); ?>images/indeziner_logo.gif" alt="" title="" border="0" /></a>
			</div>
		</div>
	</div>
</body>
</html>