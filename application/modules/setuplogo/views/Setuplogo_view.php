<div class="main-grid" ng-controller="mainAppSetupLogo">
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

              <div ng-if="details">
              <form name="liststplogo" id="groupForm" method="POST">
              <table class="table table-bordered table-striped">
                <tbody ng-repeat="detaillogo in details">
                  <tr>
                  <td style="text-align: center;" rowspan="0" width="100%">

                    <!-- if else -->
                    <div ng-if="detaillogo.SetupImageLogo === ''">
                    <img ng-src="<?= base_url(); ?>upload/logo/default.jpeg" class="img-respinsive rounded-circle" width="380px" height="380px">
                    </div>

                    <div ng-if="detaillogo.SetupImageLogo">
                    <img ng-src="<?= base_url(); ?>upload/logo/{{detaillogo.SetupImageLogo}}" class="img-respinsive rounded-circle" width="380px" height="380px">
                    </div>
                    <!--end-->

                    
                      <br><br>
                      <input class="form-control btn-primary" id="photo" type="file" name="photo" 
                      ng-model="stplInfo.photo" accept="image/*" onchange="angular.element(this).scope().uploadlogo(this.files)" ng-required="true"/>

                    <!--   <input type="file" id="photo" name="photo" ng-model="itemInfo.photo" accept="image/*"
                       onchange="angular.element(this).scope().uploadedFileInput(this)"> -->

                      <p style="text-align: center;"><font color="red"><i style="font-size: 10px;">*max. upload 1MB forrmat .jpg or .png </i></font></p>
                      <img id="output1" class="img-responsive">
                    
                      <input class="form-control" style="display: none;" id="stpidx" name="stpidx" ng-model="stplInfo.stpidx" type="text" value="" required readonly="readonly" />
                  </td>
                </tr>
                </tbody>
              </table>
              </form>
            </div>

            <div ng-if="!details">
              <form name="liststplogo" id="groupForm" method="POST">
              <table class="table table-bordered table-striped">
                <tbody>
                  <tr>
                  <td style="text-align: center;" rowspan="0" width="100%">

                    
                    <img ng-src="<?= base_url(); ?>upload/logo/default.jpeg" class="img-respinsive rounded-circle" width="380px" height="380px">
                    
                    
                      <br><br>
                      <input class="form-control btn-primary" id="photo" type="file" name="photo" 
                      ng-model="stplInfo.photo" accept="image/*" onchange="angular.element(this).scope().uploadlogo(this.files)" ng-required="true"/>

                    <!--   <input type="file" id="photo" name="photo" ng-model="itemInfo.photo" accept="image/*"
                       onchange="angular.element(this).scope().uploadedFileInput(this)"> -->

                      <p style="text-align: center;"><font color="red"><i style="font-size: 10px;">*max. upload 1MB forrmat .jpg or .png </i></font></p>
                      <img id="output1" class="img-responsive">
                    
                      <input class="form-control" style="display: none;" id="stpidx" name="stpidx" ng-model="stplInfo.stpidx" type="text" value="" required readonly="readonly" />
                  </td>
                </tr>
                </tbody>
              </table>
              </form>
            </div>


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

















