<div class="main-grid" ng-controller="mainAppRptSale">
  
      <div class="agile-grids"> 
        <div class="banner">
          <h2>
            <a href="#page-reportsale"><?php echo $title; ?></a>
           <!--  <i class="fa fa-angle-right"></i>
            <span>Blank</span> -->
          </h2>
        </div>
        <!-- tables -->
        
        <!-- <div class="table-heading">
          <h2>Basic Tables</h2>
        </div> -->
        <div class="agile-tables">
          <div class="w3l-table-info">
           
              <div class="table-responsive" style="height:600px;">
              <form name="reportsale" id="rptSLForm" method="POST">
              <table class="table table-sm table-form" style="overflow:auto;">
               <!--  <tr>
                  <td colspan="4"><h4><?php echo $title; ?><h4></td>
                </tr> -->
                 <tr>
                  <td style="width: 15%">Item ID *</td>
                  <td style="width: 35%"><input class="form-control" id="itemid" name="itemid" ng-keyup='fetchReportItemSL()' ng-click='searchboxReportItemSL($event);' ng-model="reportSLInfo.itemid" type="text" autocomplete="off" />
                    <!-- load data autocomplete-->
                    <ul id='searchResult' >
                        <li ng-click='setValueReportItemSL($index,$event)' ng-repeat="result in searchResult" >
                          {{ result.item }}
                        </li>
                    </ul> 
                    <!-- end load data-->
                  </td>
                  <td style="width: 15%">Item Name *</td>
                  <td style="width: 35%"><input class="form-control" id="itemname" name="itemname" ng-model="reportSLInfo.itemname"  type="text" readonly="readonly" /></td>
                </tr>
                 <tr>
                  <td style="width: 15%">Start Date *</td>
                  <td style="width: 35%"><input class="form-control" id="startdate" name="startdate" ng-model="reportSLInfo.startdate" type="text" ui-date="dateOptions" required />
                    <div class="form-group">
                      <p class="text-danger" ng-show="reportsale.startdate.$invalid && reportsale.startdate.$dirty"><font color="red"><i style="font-size: 10px;">*Please Insert Start Date..!!!</i></font> </p>

                    </div>
                  </td>
                  <td style="width: 15%">End Date * </td>
                  <td style="width: 35%"><input class="form-control" id="enddate" name="enddate" ng-model="reportSLInfo.enddate" type="text" ui-date="dateOptions" required />
                    <div class="form-group">
                      <p class="text-danger" ng-show="reportsale.enddate.$invalid && reportsale.enddate.$dirty"><font color="red"><i style="font-size: 10px;">*Please Insert End Date..!!!</i></font> </p>

                    </div>
                  </td>
                </tr>
                <tr>
                  <td style="width: 15%">Sale ID </td>
                  <td style="width: 35%"><input class="form-control" id="saleid" name="saleid" ng-model="reportSLInfo.saleid"  type="text" /></td>
                  <td style="width: 15%">Status </td>
                  <td style="width: 35%">
                     <select name="statussl" id="statussl" class="form-control" ng-model="reportSLInfo.statussl">
                            <option value="0">All Status</option>
                            <option value="5">Active</option>
                            <option value="7">Posted</option>
                        </select>
                  </td>
                </tr>
               <tr>
                  <td colspan="4" align="left">
                     <button class="btn btn-warning" type="submit" ng-disabled="reportsale.$invalid" ng-click="searchreportsale(reportSLInfo)"><i class="fa fa-search"></i> Search</button>
                     <button class="btn btn-primary" type="submit" ng-disabled="reportsale.$invalid" ng-click="resetreportsale(reportSLInfo)"><i class="fa fa-eraser"></i> Reset</button>
                  </td>
                </tr>
              </table>
            </form>

            <hr>
             <!--load content-->
            <div ng-show="show_ContentSL">
              <p ng-bind-html="RptContentSL"></p><!--data content-->
            </diV>

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



</div>






