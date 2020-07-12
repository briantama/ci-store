<div class="main-grid" ng-controller="mainAppProfile">
      <div class="agile-grids"> 
      
      <div class="banner">
          <h2>
            <a href="#page-profile"><?php echo $title; ?></a>
           <!--  <i class="fa fa-angle-right"></i>
            <span>Blank</span> -->
          </h2>
        </div>


        <div class="agile-tables">
          <div class="w3l-table-info">
              <div class="table-responsive">
              <table class="table table-bordered table-striped">
                <tbody ng-repeat="detailprofile in details">
                  <tr>
                  <td style="text-align: center;" rowspan="0" width="30%">

                    <!-- if else -->
                    <div ng-if="detailprofile.AdminImage === ''">
                    <img ng-src="<?= base_url(); ?>upload/user/default.jpeg" class="img-respinsive rounded-circle" width="280px" height="280px">
                    </div>

                    <div ng-if="detailprofile.AdminImage">
                    <img ng-src="<?= base_url(); ?>upload/user/{{detailprofile.AdminImage}}" class="img-respinsive rounded-circle" width="280px" height="280px">
                    </div>
                    <!--end-->

                    <form name="listprofile" id="groupForm" method="POST">
                      <br><br>
                      <input class="form-control btn-primary" id="photo" type="file" name="photo" 
                      ng-model="profileInfo.photo" accept="image/*" onchange="angular.element(this).scope().uploadprofile(this.files)" ng-required="true"/>

                    <!--   <input type="file" id="photo" name="photo" ng-model="itemInfo.photo" accept="image/*"
                       onchange="angular.element(this).scope().uploadedFileInput(this)"> -->

                      <p style="text-align: center;"><font color="red"><i style="font-size: 10px;">*max. upload 1MB forrmat .jpg or .png </i></font></p>
                      <img id="output1" class="img-responsive">
                    </form>
                  </td>
                  <td>Name</td>
                  <td>: {{detailprofile.AdminName}} </td>
                </tr>
                <tr>
                  <td>UserName</td>
                  <td>: {{detailprofile.UserName}} </td>
                </tr>
                <tr>
                  <td>Email</td>
                  <td>: {{detailprofile.email}}</td>
                </tr>
                <tr>
                  <td>Date Of Birth</td>
                  <td>: {{detailprofile.DateOfBirth}} </td>
                </tr>
                <tr>
                  <td>Super User</td>
                  <td>: {{detailprofile.SuperUser}}</td>
                </tr>
                </tbody>
              </table>
           </div>
          

        </div>
        <!-- //tables -->
      </div>
    </div>



<!-- notif alert success or not -->
<div class="shownotifmsg" ng-show="show_Msg">
  <div class="alert alert-info">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
      <span class="fa fa-info"></span>&nbsp;&nbsp;{{notifikasiMsg}}
  </div>
</div>


</div> <!-- mainpp controller-->

















