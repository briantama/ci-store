<!--A Design by W3layouts
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<head>
<title>Bryn Store</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Colored Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- bootstrap-css -->
<link rel="stylesheet" href="<?= base_url(); ?>colored-admin/css/bootstrap.css">
<!-- //bootstrap-css -->
<!-- Custom CSS -->
<link href="<?= base_url(); ?>colored-admin/css/style.css" rel='stylesheet' type='text/css' />
<!-- font CSS -->
<link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
<!-- font-awesome icons -->
<link rel="stylesheet" href="<?= base_url(); ?>colored-admin/css/font.css" type="text/css"/>
<link href="<?= base_url(); ?>colored-admin/css/font-awesome.css" rel="stylesheet"> 
<!-- //font-awesome icons -->

<script src="<?php echo base_url(); ?>colored-admin/js/angular-table/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>colored-admin/js/angular/angular.min.js"></script>
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


</head>
<body class="dashboard-page">
  <script>
          var theme = $.cookie('protonTheme') || 'default';
          $('body').removeClass (function (index, css) {
              return (css.match (/\btheme-\S+/g) || []).join(' ');
          });
          if (theme !== 'default') $('body').addClass(theme);
        </script>



  <nav class="main-menu">
    <ul>
      <li>
        <a href="<?php echo base_url()."dasbor";?>">
          <i class="fa fa-home nav_icon"></i>
          <span class="nav-text">
          Dashboard
          </span>
        </a>
      </li>
      <li class="has-subnav">
        <a href="javascript:;">
        <i class="fa fa-cogs" aria-hidden="true"></i>
        <span class="nav-text">
          Master Data
        </span>
        <i class="icon-angle-right"></i><i class="icon-angle-down"></i>
        </a>
        <ul>
          <li>
          <a onclick="callpage('mastergroup/viewMastergroup', '', '')" class="subnav-text" href="#">
          Data Kelompok
          </a>
          </li>
          <li>
          <a class="subnav-text" href="grids.html">
          Data Pemasok
          </a>
          </li>
          <li>
          <a class="subnav-text" href="grids.html">
          Data Barang
          </a>
          </li>
        </ul>
      </li>
      <li class="has-subnav">
        <a href="javascript:;">
        <i class="fa fa-check-square-o nav_icon"></i>
        <span class="nav-text">
        Transaction
        </span>
        <i class="icon-angle-right"></i><i class="icon-angle-down"></i>
        </a>
        <ul>
          <li>
            <a class="subnav-text" href="inputs.html">Pembelian</a>
          </li>
          <li>
            <a class="subnav-text" href="validation.html">Pejualan</a>
          </li>
        </ul>
      </li>
      <li class="has-subnav">
        <a href="javascript:;">
          <i class="fa fa-file-text-o nav_icon"></i>
            <span class="nav-text">Report</span>
          <i class="icon-angle-right"></i><i class="icon-angle-down"></i>
        </a>
        <ul>
          <li>
            <a class="subnav-text" href="gallery.html">
              Image Gallery
            </a>
          </li>
          <li>
            <a class="subnav-text" href="calendar.html">
              Calendar
            </a>
          </li>
          <li>
            <a class="subnav-text" href="signup.html">
              Sign Up Page
            </a>
          </li>
          <li>
            <a class="subnav-text" href="login.html">
              Login Page
            </a>
          </li>
        </ul>
      </li>
  
    </ul>
    <ul class="logout">
      <li>
      <a href="<?php echo base_url('login/logout'); ?>">
      <i class="icon-off nav-icon"></i>
      <span class="nav-text">
      Logout
      </span>
      </a>
      </li>
    </ul>
  </nav>


<!-- head -->

  <section class="wrapper scrollable">
    <nav class="user-menu">
      <a href="javascript:;" class="main-menu-access">
      <i class="icon-proton-logo"></i>
      <i class="icon-reorder"></i>
      </a>
    </nav>
    <section class="title-bar">
      <div class="logo">
        <h1><a href="index.html"><img src="<?= base_url(); ?>colored-admin/images/logo.png" alt="" />B STORE</a></h1>
      </div>
      <div class="full-screen">
        <section class="full-top">
          <button id="toggle"><i class="fa fa-arrows-alt" aria-hidden="true"></i></button>  
        </section>
      </div>
      <div class="w3l_search">
        <form action="#" method="post">
          <input type="text" name="search" value="Search" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Search';}" required="">
          <button class="btn btn-default" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
        </form>
      </div>
      <div class="header-right">
        <div class="profile_details_left">
          <div class="header-right-left">
            <!--notifications of menu start -->
            
          </div>  
          <div class="profile_details">   
            <ul>
              <li class="dropdown profile_details_drop">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                  <div class="profile_img"> 
                    <span class="prfil-img"><i class="fa fa-user" aria-hidden="true"></i></span> 
                    <div class="clearfix"></div>  
                  </div>  
                </a>
                <ul class="dropdown-menu drp-mnu">
                  <li> <a href="#"><i class="fa fa-cog"></i> Settings</a> </li> 
                  <li> <a href="#"><i class="fa fa-user"></i> Profile</a> </li> 
                  <li> <a href="<?php echo base_url('login/logout'); ?>"><i class="fa fa-sign-out"></i> Logout</a> </li>
                </ul>
              </li>
            </ul>
          </div>
          <div class="clearfix"> </div>
        </div>
      </div>
      <div class="clearfix"> </div>
    </section>




<div ng-app="MasterGroupApp" ng-controller="MasterGroupController">

<div class="main-grid">
      <div class="agile-grids"> 
        <!-- tables -->
        
        <!-- <div class="table-heading">
          <h2>Basic Tables</h2>
        </div> -->
        <div class="agile-tables">
          <div class="w3l-table-info">
            <h3>
              <a href="#" onclick="return getMerk(0);" class="btn btn-primary"><i class="fa fa-plus"></i> Add</a>
              <a href="<?php echo base_url('merk/viewMerk/print'); ?>" target="_BLANK" class="btn btn-success"><i class="fa fa-print"></i> Print</a>
            </h3>
              <table datatable="ng" dt-options="vm.dtOptions" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Action</th>
                  <th>GroupID</th>
                  <th>Group Name</th>
                  <th>Description</th>
                  <th>IsActive</th>
                  <th>EntryDate</th>
                  <th>EntryBy</th>
                  <th>LastUpdateDate</th>
                  <th>LastUpdateBy</th>
                </tr>
                </thead>
                <tbody>

              

                <tr ng-repeat="detailgroup in details">
                  <td nowrap> 
                    <a href="#" class="btn btn-warning" title="Edit"><i class="fa fa-edit"></i> </a> 
                    <a href="#" class="btn btn-danger" title="Delete"><i class="fa fa-trash"></td>
                  <td>{{detailgroup.CodeGroupID}}</td>
                  <td>{{detailgroup.GroupName}}</td>
                  <td>{{detailgroup.Description}}</td>
                  <td>{{detailgroup.IsActive}}</td>
                  <td>{{detailgroup.EntryDate}}</td>
                  <td>{{detailgroup.EntryBy}}</td>
                  <td>{{detailgroup.LastUpdateDate}}</td>
                  <td>{{detailgroup.LastUpdateBy}}</td>
                </tr>

            
                
                </tbody>
                <tfoot>
                <tr>
                  <th>Action</th>
                  <th>GroupID</th>
                  <th>Group Name</th>
                  <th>Description</th>
                  <th>IsActive</th>
                  <th>EntryDate</th>
                  <th>EntryBy</th>
                  <th>LastUpdateDate</th>
                  <th>LastUpdateBy</th>
                </tr>
                </tfoot>
              </table>
          </div>
          

        </div>
        <!-- //tables -->
      </div>
    </div>

</div> <!-- MasterGroupApp-->


<script type="text/javascript">
// Application module
var base_url = window.location.origin;
var ProdiApp = angular.module('MasterGroupApp', ['datatables']);
ProdiApp.controller("MasterGroupController", function($scope,$http){
    $scope.details=[]; 
    $http.get(base_url+"/ci-store/mastergroup/viewMastergroup/view-ang").success(function(data){
    console.log(data);
    $scope.details = data;
    });
  
  // Mengaktifkan form input prodi
  //$scope.show_form = true;

    
  
});

</script>




    
    <!-- footer -->
    <div class="footer">
      <p>© 2016 <?php echo date('Y'); ?> . All Rights Reserved . Design by <a href="http://w3layouts.com/">W3layouts</a></p>
    </div>
    <!-- //footer -->
  </section>

  <!-- jQuery -->
  <script src="<?php echo base_url(); ?>colored-admin/js/angular-table/jquery.min.js"></script>
  <script src="<?php echo base_url(); ?>colored-admin/js/ajaxFileUpload.js"></script> 
  <script src="<?php echo base_url(); ?>colored-admin/js/script.js"></script>
  <script src="<?php echo base_url(); ?>colored-admin/js/jquery.autocomplete.min.js"></script>
  <script src="<?php echo base_url(); ?>colored-admin/js/bootstrap-datepicker.min.js"></script>
  <script src="<?php echo base_url(); ?>colored-admin/js/jquery.blockUI.js"></script>

  
  <script src="<?= base_url(); ?>colored-admin/js/bootstrap.js"></script>
  <script src="<?= base_url(); ?>colored-admin/js/bootstrap.bundle.min.js"></script>
  <script src="<?= base_url(); ?>colored-admin/js/proton.js"></script>
</body>
</html>
