<div class="main-grid" ng-controller="mainAppSetupPrint">
      <div class="agile-grids"> 
      
      <div class="banner">
          <h2>
            <a href="#page-profile"><?php echo $title; ?></a>
           <!--  <i class="fa fa-angle-right"></i>
            <span>Blank</span> -->
          </h2>
        </div>

        <!-- notif alert success or not -->
        <div class="shownotifmsg" ng-show="show_Msg">
          <div class="alert alert-info">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
              <span class="fa fa-info"></span>&nbsp;&nbsp;{{notifikasiMsg}}
          </div>
        </div>



        <div class="agile-tables">
          <div class="w3l-table-info">
              <div class="table-responsive">

              <form name="liststpprint" id="groupstpprint" method="POST">
              <table class="table table-bordered table-striped">
                <tbody>
                  <tr>
                  <td style="text-align: center;" rowspan="0" width="30%">

                    <!-- if else -->
                    
                    <img id="output1" ng-src="{{showUrlImage}}" class="img-respinsive rounded-circle" width="280px" height="280px">
                   


                      <br><br>
                      <input class="form-control btn-primary" id="photo" type="file" name="photo" 
                      ng-model="stptInfo.photo" accept="image/*" onchange="angular.element(this).scope().uploadedFileInput(this)" />

                    

                      <p style="text-align: center;"><font color="red"><i style="font-size: 10px;">*max. upload 1MB forrmat .jpg or .png </i></font></p>
                     <!--  <img  class="img-responsive"> -->
                  </td>
                  <td>Setup Header</td>
                  <td>
                    <input class="form-control" style="display: none;" id="stpidx" name="stpidx" ng-model="stptInfo.stpidx" type="text"  required />
                    <textarea class="form-control" id="stpheader" name="stpheader" ng-model="stptInfo.stpheader" type="text"  required ></textarea> 
                    <div class="form-group">
                      <p class="text-danger" ng-show="liststpprint.stpheader.$invalid && liststpprint.stpheader.$dirty"><font color="red"><i style="font-size: 10px;">*Please Insert Setup Header..!!!</i></font> </p>
                    </div>

                  </td>
                </tr>
                <tr>
                  <td>Setup Footer</td>
                  <td>
                    
                     <textarea class="form-control" id="stpfooter" name="stpfooter" ng-model="stptInfo.stpfooter"  type="text"  required ></textarea>
                    <div class="form-group">
                      <p class="text-danger" ng-show="liststpprint.stpfooter.$invalid && liststpprint.stpfooter.$dirty"><font color="red"><i style="font-size: 10px;">*Please Insert Setup Footer..!!!</i></font> </p>
                    </div>

                  </td>
                </tr>
                <tr>
                  <td>Setup Image Show</td>
                  <td>
                    
                    <select name="stpshow" id="stpshow" ng-model="stptInfo.stpshow" class="form-control">
                            <option value="N">No</option>
                            <option value="Y">Yes</option>
                    </select>


                  </td>
                </tr>
                <tr>

                  <td colspan="2">
                    <button class="btn btn-success" type="submit" ng-disabled="liststpprint.$invalid" ng-click="insertstpprofile(stptInfo)"><i class="fa fa-save"></i> Save</button>
                    <a ng-click="testPrint('/ci-store/setupprint/viewSetupPrint/printtest')" class="btn btn-info"><i class="fa fa-print"></i> Test Print</a>
                  </td>
                </tr>
                </tbody>
              </table>
            </form>

           </div>
          

        </div>
        <!-- //tables -->
      </div>
    </div>




</div> <!-- mainpp controller-->

















