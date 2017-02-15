<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $title?></title>
<link rel="stylesheet" media="screen" href="<?php echo base_url()?>public/css/user/style.css" />
<link rel="stylesheet" media="screen" href="<?php echo base_url()?>public/css/user/element.css" />
<link href="<?php echo base_url()?>public/images/ksc.ico" rel="shortcut icon" type="image/x-icon" /><!-- custom favicon -->
<meta http-equiv="imagetoolbar" content="no" /><!-- disable IE's image toolbar -->
<script src="<?php echo base_url()?>public/js/jquery-1.8.1.min.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>public/js/jquery.cycle.all.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo base_url()?>public/js/pesan.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>public/js/animate.js"></script>
</head>
<body>
    <div id="back-body"></div>
<div id="daddy">
	<div id="header">
		<div id="logo">
                    <a href="<?php echo base_url()?>">
                        <img src="<?php echo base_url()?>public/images/user/ksc.png" alt="Komputasi dan Sistem Cerdas" height="85" />
                    </a>
                    <span id="logo-text">
                        Komputasi dan <br/>Sistem Cerdas
                    </span>
                </div><!-- logo -->
		<?php echo $this->load->view("content/user/navigation");?>
                <!-- menu -->
                <!-- ticker -->
                <!-- <div class="wrapped"> -->
                    <!-- icons -->
<!--                     <img src="<?php echo base_url()?>public/images/user/banner1.jpg">
                            <div id="slogan">Laboratorium Komputasi dan Sistem Cerdas</div> -->
                <!-- </div> -->
		<!-- headerimage -->
	</div>
	<!-- header -->
	<div id="content">
		<?php $this->load->view("content/user/left_bar");?>
            <!-- cA -->
		<div id="cB">
			<div class="Ctopright"></div>
			<?php echo $content;?>
                        <!-- cB1 -->
			<?php 
			$url = $this->uri->segment(2);
			if($url != "responsi")
			{
				$this->load->view("content/user/right_bar");
			}
			?>
                        <!-- cB2 -->
		</div>
            <!-- cB -->
		<div class="Cpad">
			<br class="clear" /><div class="Cbottomleft"></div><div class="Cbottom"></div><div class="Cbottomright"></div>
		</div><!-- Cpad -->
	</div>
	<!-- content -->
	<div id="properspace"></div><!-- properspace -->
</div><!-- daddy -->
<div id="footer">
	<div id="foot">
                <div id="foot1"></div>
		<div id="foot2">
                        Laboratorium KSC UII © 2012.  <!-- <span> Script by <b>Imam S Rifkan</b> </span>Designed by <strong>SymiSun</strong><span class="star"></span> -->
		</div><!-- foot1 -->
	</div><!-- foot -->
</div><!-- footer -->
</body>
</html>
