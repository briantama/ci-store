  <?php

  $title  = "No Name";
  $setrv  = "B";
  $res    = $this->db->query("
                          SELECT  SetupName, SetupImageDasbor, SetupImage
                          FROM    M_Setupprofile
                          ");
  if ($res->num_rows() > 0) {
    $settl  = $res->row();
    $setrv  = substr($settl->SetupName, 0,2);
    
      $title = $settl->SetupName;
 
      if(file_exists("./upload/profile/".$settl->SetupImage)){
        $imgurl = base_url()."upload/profile/".$settl->SetupImage;
      }
      else{
        $imgurl = base_url()."upload/profile/default.jpeg";
      }
    }

  

  ?>

<!--A Design by W3layouts
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<head>
<title>Login Administrator</title>
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

<script src="<?= base_url(); ?>colored-admin/js/angular/angular.min.js"></script>
<!-- //font-awesome icons -->
</head>
<body class="signup-body" ng-app="AngularLogin" ng-controller="AngularLoginController as angLog">
    <div class="agile-signup">  
      
      <div class="content2">
        <div class="grids-heading gallery-heading signup-heading">
          <h2><img src="<?php echo $imgurl; ?>" width="50" height="50" alt="" /> <?php echo $title; ?></h2>
        </div>

        <form class="user" name="login" ng-submit="angLog.loginForm()" class="form-horizontal" method="POST">
        <br>
        <div class="alert alert-danger" ng-show="show_Msg">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <span class="fa fa-lock"></span>&nbsp;&nbsp;{{notifikasiMsg}}
        </div>

          <input type="text" ng-model="angLog.inputData.username" id="username" name="username" value="Username" placeholder="Username : brian">
          <input type="password" ng-model="angLog.inputData.password" id="password" name="password" value="Password" placeholder="Password : brian">
          <input class="register" type="submit" value="login">
        </form>
        <div class="signin-text">
          <div class="text-left">
            <p><a href="#"> Forgot Password? </a></p>
          </div>
          <div class="text-right">
            <!-- <p><a href=""> Create New Account</a></p> -->
          </div>
          <div class="clearfix"> </div>
        </div>
        
      </div>
      
      <!-- footer -->
      <div class="copyright">
        <p>Copyright &copy; Apps Bryn 2016 - <?php echo date('Y'); ?> Template By Colored</p>
      </div>
      <!-- //footer -->
      
    </div>

  <script src="<?= base_url(); ?>colored-admin/js/jquery.min.js"></script>
  <script src="<?= base_url(); ?>colored-admin/js/bootstrap.bundle.min.js"></script>
  <script src="<?= base_url(); ?>colored-admin/js/proton.js"></script>
  

</body>
</html>


<script>
  $("#username").focus();

  angular.module('AngularLogin', []).controller('AngularLoginController', ['$scope', '$http', function($scope, $http) {
    this.loginForm = function() {

      var user_data='username=' +this.inputData.username+'&password='+this.inputData.password;
      
      $http({
        method: 'POST',
        url: '<?= base_URL(); ?>login/getlogin',
        data: user_data,
        headers: {'Content-Type': 'application/x-www-form-urlencoded'}
      })
      .then(function(response) {
        console.log(response);
        if ( response.data.log.status == '1') 
        {
          window.location.assign("<?= base_url(); ?>dasbor/"); 
        } 
        else 
        {
          
          $scope.notifikasiMsg = "Invalid Username and Password";
          $scope.show_Msg = true;
            setTimeout(function () 
            {
              $scope.$apply(function()
              {
                $scope.show_Msg = false;
              });
          }, 5000);

        }
      })
    }

  }]);

  </script>


