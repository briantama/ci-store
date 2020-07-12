<!--A Design by W3layouts
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<?php

  $title  = "Store No Name";
  $res    = $this->db->query("
                          SELECT  SetupTitle, SetupImageLogo
                          FROM    M_Setupprofile
                          ");
 	if ($res->num_rows() > 0) {
	    $settl  = $res->row();
	    $title  = $settl->SetupTitle;
	    $img    = (trim($settl->SetupImageLogo) != "") ? $settl->SetupImageLogo : "default.jpeg";

	    if(file_exists("./upload/logo/".$img)){
        	$imgurl = base_url()."upload/logo/".$img;
      	}
      	else{
        	$imgurl = base_url()."upload/logo/default.jpeg";
      	}
    }

?>



<!DOCTYPE html>
<head>
<title><?php echo $title; ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Colored Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<link rel="shortcut icon" href="<?php echo $imgurl; ?>">

<!-- bootstrap-css -->
<link rel="stylesheet" href="<?= base_url(); ?>colored-admin/css/bootstrap.css">
<!-- //bootstrap-css -->
<!-- Custom CSS -->
<link href="<?= base_url(); ?>colored-admin/css/style.css" rel='stylesheet' type='text/css' />
<link href="<?= base_url(); ?>colored-admin/css/mycss.css" rel='stylesheet' type='text/css' />
<!-- font CSS -->
<link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
<!-- font-awesome icons -->
<link rel="stylesheet" href="<?= base_url(); ?>colored-admin/css/font.css" type="text/css"/>
<link href="<?= base_url(); ?>colored-admin/css/font-awesome.css" rel="stylesheet"> 
<!-- //font-awesome icons -->

<!-- datepicker css -->
<link rel="stylesheet" href="<?= base_url(); ?>colored-admin/css/jquery-ui.min.css">

<!-- angular 1.6.6 -->
<script src="<?php echo base_url(); ?>colored-admin/js/angular-table/jquery.min.js"></script>
<!--jquery date-->
<script type="text/javascript" src="<?php echo base_url(); ?>colored-admin/js/jquery1.8.2.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>colored-admin/js/jquery-ui.min1.12.1.js"></script>
<!--end jquery date-->
<script src="<?php echo base_url(); ?>colored-admin/js/angular/angular.min.js"></script>
<script src="<?php echo base_url(); ?>colored-admin/js/angular/angular-route.js"></script>
<script src="<?php echo base_url(); ?>colored-admin/js/angular/angular-animate.js"></script>
<script src="<?php echo base_url(); ?>colored-admin/js/angular/angular-sanitize.js"></script>
<!-- datepicker js-->
<script type="text/javascript" src="<?php echo base_url(); ?>colored-admin/js/angular/angular-ui-date.js"></script>


<script src="<?php echo base_url(); ?>colored-admin/js/angular-table/angular-datatables.min.js"></script>
<script src="<?php echo base_url(); ?>colored-admin/js/angular-table/jquery.dataTables.min.js"></script>
<link href="<?= base_url(); ?>colored-admin/js/angular-table/datatables.bootstrap.css" rel="stylesheet">

<script src="<?= base_url(); ?>colored-admin/js/modernizr.js"></script>
<script src="<?= base_url(); ?>colored-admin/js/jquery.cookie.js"></script>
<script src="<?= base_url(); ?>colored-admin/js/screenfull.js"></script>



		<script>
		$(function () {
			$('#supported').text('Supported/allowed: ' + !!screenfull.enabled);

			if (!screenfull.enabled) {
				return false;
			}

			

			$('#toggle').click(function () {
				screenfull.toggle($('#container')[0]);
			});	
		});
		</script>
<!-- charts -->
<script src="<?= base_url(); ?>colored-admin/js/raphael-min.js"></script>
<script src="<?= base_url(); ?>colored-admin/js/morris.js"></script>
<link rel="stylesheet" href="<?= base_url(); ?>colored-admin/css/morris.css">
<!-- //charts -->
<!--skycons-icons-->
<script src="<?= base_url(); ?>colored-admin/js/skycons.js"></script>
<!--//skycons-icons-->

<!--table css-->
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>colored-admin/css/table-style.css" />
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>colored-admin/css/basictable.css" />
<script type="text/javascript" src="<?= base_url(); ?>colored-admin/js/jquery.basictable.min.js"></script>
<!--load angular menu-->
<script src="<?php echo base_url(); ?>colored-admin/js/angular-load/angular-menu.js"></script>


<style type="text/css">
  .shownotifmsg {
    position:fixed;
    bottom:70%;
    right:2px;
    float:right;
    z-index:103;
  }
</style>


</head>
<body class="dashboard-page" ng-app="mainApp">
	<script>
	        var theme = $.cookie('protonTheme') || 'default';
	        $('body').removeClass (function (index, css) {
	            return (css.match (/\btheme-\S+/g) || []).join(' ');
	        });
	        if (theme !== 'default') $('body').addClass(theme);
        </script>