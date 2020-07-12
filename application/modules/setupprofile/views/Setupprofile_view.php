<div class="main-grid" ng-controller="mainAppSetupProfile">
      <div class="agile-grids"> 
      
      <div class="banner">
          <h2>
            <a href="#page-setupprofile"><?php echo $title; ?></a>
           <!--  <i class="fa fa-angle-right"></i>
            <span>Blank</span> -->
          </h2>
        </div>


        <div class="agile-tables">
          <div class="w3l-table-info">
              <div class="table-responsive">

                <!-- notif alert success or not -->
             <div class="alert alert-info" ng-show="show_uploadMsg">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                <span class="fa fa-info"></span>&nbsp;&nbsp;{{notifikasiuploadMsg}}
            </div>

              <div ng-if="details">
              <form name="liststpprofile" id="stpprofileForm" method="POST">
              <table class="table table-bordered table-striped">
                <tbody ng-repeat="detailprofile in details">
                  <tr>
                  <td style="text-align: center;" rowspan="0" width="30%">

                    <!-- if else -->
                    <div ng-if="detailprofile.SetupImage === ''">
                    <img id="output1" ng-src="<?= base_url(); ?>upload/profile/default.jpeg" class="img-respinsive rounded-circle" width="280px" height="280px">
                    </div>

                    <div ng-if="detailprofile.SetupImage">
                    <img id="output1" ng-src="<?= base_url(); ?>upload/profile/{{detailprofile.SetupImage}}" class="img-respinsive rounded-circle" width="280px" height="280px">
                    </div>
                    <!--end-->

                      <br><br>
                      <input class="form-control btn-primary" id="photo" type="file" name="photo" 
                      ng-model="stpInfo.photo" accept="image/*" onchange="angular.element(this).scope().uploadedFileInput(this)" />

                    
                      <p style="text-align: center;"><font color="red"><i style="font-size: 10px;">*max. upload 1MB forrmat .jpg or .png </i></font></p>
                      <!-- <img id="output1" class="img-responsive"> -->
                    
                  <td>Title </td>
                  <input class="form-control" style="display: none;" id="stpidx" name="stpidx" ng-model="stpInfo.stpidx" type="text" value="" required />
                  <td> <input class="form-control" id="stptitle" name="stptitle" ng-model="stpInfo.stptitle" type="text" value="" required /> 

                    <div class="form-group">
                      <p class="text-danger" ng-show="liststpprofile.stptitle.$invalid && liststpprofile.stptitle.$dirty"><font color="red"><i style="font-size: 10px;">*Please Insert Title..!!!</i></font></p>
                   </div>

                  </td>
                </tr>
                <tr>
                  <td>Name </td>
                  <td> <input class="form-control" id="stpname" name="stpname" ng-model="stpInfo.stpname" type="text" value="" required /> 

                  <div class="form-group">
                      <p class="text-danger" ng-show="liststpprofile.stpname.$invalid && liststpprofile.stpname.$dirty"><font color="red"><i style="font-size: 10px;">*Please Insert Title Name..!!!</i></font></p>
                   </div>

                  </td>
                </tr>
                <tr>
                  <td>Description</td>
                  <td> <input class="form-control" id="stpdesc" name="stpdesc" ng-model="stpInfo.stpdesc" type="text" value="" required />

                    <div class="form-group">
                      <p class="text-danger" ng-show="liststpprofile.stpdesc.$invalid && liststpprofile.stpdesc.$dirty"><font color="red"><i style="font-size: 10px;">*Please Insert Title Description..!!!</i></font></p>
                   </div>

                  </td>
                </tr>
                <tr>
                  <td>Sateup Image Dasbor</td>
                  <td> 
                    <select class="form-control" id="stpimg" name="stpimg" ng-model="stpInfo.stpimg">
                      <option value="N">No</option>
                      <option value="Y">Yes</option>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td><button class="btn btn-success" type="submit" ng-disabled="liststpprofile.$invalid" ng-click="insertstpprofile(stpInfo)"><i class="fa fa-save"></i> Save</button></td>
                </tr>
                </tbody>
              </table>
            </form>
            </div>


            <div ng-if="!details">
              <form name="liststpprofile" id="stpprofileForm" method="POST">
              <table class="table table-bordered table-striped">
                <tbody>
                  <tr>
                  <td style="text-align: center;" rowspan="0" width="30%">

                   
                    <img id="output1" ng-src="<?= base_url(); ?>upload/profile/default.jpeg" class="img-respinsive rounded-circle" width="280px" height="280px">
                   

                    
                      <br><br>
                      <input class="form-control btn-primary" id="photo" type="file" name="photo" 
                      ng-model="stpInfo.photo" accept="image/*" onchange="angular.element(this).scope().uploadedFileInput(this)"/>

                    <!--   <input type="file" id="photo" name="photo" ng-model="itemInfo.photo" accept="image/*"
                       onchange="angular.element(this).scope().uploadedFileInput(this)"> -->

                      <p style="text-align: center;"><font color="red"><i style="font-size: 10px;">*max. upload 1MB forrmat .jpg or .png </i></font></p>
                     <!--  <img id="output1" class="img-responsive"> -->
                    
                  </td>
                  <td>Title</td>
                  <input class="form-control" id="stpidx" name="stpidx" ng-model="stpInfo.stpidx" type="text" value="0" required />
                  <td> <input class="form-control" id="stptitle" name="stptitle" ng-model="stpInfo.stptitle" type="text" value="" required /> 

                    <div class="form-group">
                      <p class="text-danger" ng-show="liststpprofile.stptitle.$invalid && liststpprofile.stptitle.$dirty"><font color="red"><i style="font-size: 10px;">*Please Insert Title..!!!</i></font></p>
                   </div>

                  </td>
                </tr>
                <tr>
                  <td>Name</td>
                  <td> <input class="form-control" id="stpname" name="stpname" ng-model="stpInfo.stpname" type="text" value="" required /> 

                  <div class="form-group">
                      <p class="text-danger" ng-show="liststpprofile.stpname.$invalid && liststpprofile.stpname.$dirty"><font color="red"><i style="font-size: 10px;">*Please Insert Title Name..!!!</i></font></p>
                   </div>

                  </td>
                </tr>
                <tr>
                  <td>Description</td>
                  <td> <input class="form-control" id="stpdesc" name="stpdesc" ng-model="stpInfo.stpdesc" type="text" value="" required />

                    <div class="form-group">
                      <p class="text-danger" ng-show="liststpprofile.stpdesc.$invalid && liststpprofile.stpdesc.$dirty"><font color="red"><i style="font-size: 10px;">*Please Insert Title Description..!!!</i></font></p>
                   </div>

                  </td>
                </tr>
                <tr>
                  <td>Sateup Image Dasbor</td>
                  <td>
                    <select class="form-control" id="stpimg" name="stpimg" ng-model="stpInfo.stpimg">
                      <option value="N">No</option>
                      <option value="Y">Yes</option>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td><button class="btn btn-success" type="submit" ng-disabled="liststpprofile.$invalid" ng-click="insertstpprofile(stpInfo)"><i class="fa fa-save"></i> Save</button></td>
                </tr>
                </tbody>
              </table>
          </form> 
        </div>
        


     

          </div><!-- table responsive-->
          

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

















