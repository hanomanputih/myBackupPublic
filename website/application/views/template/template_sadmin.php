<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8"/>
	<title>Dashboard Super Admin</title>
	<link href="<?php echo base_url()?>public/images/ksc.ico" rel="shortcut icon" type="image/x-icon" />
        <link rel="stylesheet" href="<?php echo base_url()?>public/css/layout.css" type="text/css" media="screen" />
        <link rel="stylesheet" href="<?php echo base_url()?>public/css/element.css" type="text/css" media="screen"/>

	<!--[if lt IE 9]>
	<link rel="stylesheet" href="css/ie.css" type="text/css" media="screen" />
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	<script src="<?php echo base_url()?>public/js/jquery-1.8.1.min.js" type="text/javascript"></script>
	<script src="<?php echo base_url()?>public/js/hideshow.js" type="text/javascript"></script>
	<script src="<?php echo base_url()?>public/js/jquery.tablesorter.min.js" type="text/javascript"></script>
	<script type="text/javascript" src="<?php echo base_url()?>public/js/jquery.equalHeight.js"></script>
    <script type="text/javascript" src="<?php echo base_url()?>public/js/proses.js"></script>
	<script type="text/javascript">
	$(document).ready(function() 
    	{ 
      	  $(".tablesorter").tablesorter(); 
   	 } 
	);
	$(document).ready(function() {

	//When page loads...
	$(".tab_content").hide(); //Hide all content
	$("ul.tabs li:first").addClass("active").show(); //Activate first tab
	$(".tab_content:first").show(); //Show first tab content

	//On Click Event
	$("ul.tabs li").click(function() {

		$("ul.tabs li").removeClass("active"); //Remove any "active" class
		$(this).addClass("active"); //Add "active" class to selected tab
		$(".tab_content").hide(); //Hide all tab content

		var activeTab = $(this).find("a").attr("href"); //Find the href attribute value to identify the active tab + content
		$(activeTab).fadeIn(); //Fade in the active ID content
		return false;
	});

});
    </script>
    <script type="text/javascript">
    $(function(){
        $('.column').equalHeight();
    });
</script>

</head>


<body>

	<header id="header">
		<hgroup>
			<h1 class="site_title"><a href="./home">KSC Management System</a></h1>
			<h2 class="section_title">Dashboard</h2><div class="btn_view_site"><a href="<?php echo base_url()?>" target="_blank">View Site</a></div>
		</hgroup>
	</header> <!-- end of header bar -->
	
	<!-- start of secondary bar -->
        <?php
        $this->load->view("content/sadmin/little_navigation");
        ?>
        <!-- end of secondary bar -->
	
	<!-- start of sidebar -->
        <?php
        if($this->session->userdata("ta_status") == "active")
        {
        	$this->load->view("content/sadmin/navigation_active");
        }
        else if($this->session->userdata("ta_status") == "inactive")
        {
        	$this->load->view("content/sadmin/navigation_inactive");
        }
        else
        {
        	$this->load->view("content/sadmin/tahun_akademik");	
        }
        
        ?>
        <!-- end of sidebar -->
	
	<?php
        echo $content;
        ?>


</body>

</html>