<div class="main-grid" ng-controller="mainAppRptPurchaseOrder">
  
      <div class="agile-grids"> 
        <div class="banner">
          <h2>
            <a href="#page-reportpurchase"><?php echo $title; ?></a>
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
              <form name="reportpurchase" id="rptPOForm" method="POST">
              <table class="table table-sm table-form" style="overflow:auto;">
               <!--  <tr>
                  <td colspan="4"><h4><?php echo $title; ?><h4></td>
                </tr> -->
                 <tr>
                  <td style="width: 15%">Purchase Order ID </td>
                  <td style="width: 35%"><input class="form-control" id="purchase" name="purchase" ng-model="reportPOInfo.purchase"  type="text" /></td>
                  <td style="width: 15%">Supplier ID </td>
                  <td style="width: 35%"><input class="form-control" id="supplierid" name="supplierid" ng-keyup='fetchReportSupplierPO()' ng-click='searchboxReportSupplierPO($event);' ng-model="reportPOInfo.supplierid" type="text" autocomplete="off"/>
                     <!-- load data autocomplete-->
                    <ul id='searchResult' >
                        <li ng-click='setValueReportSupplierPO($index,$event)' ng-repeat="result in searchResultsup" >
                          {{ result.supplier }}
                        </li>
                    </ul> 
                    <!-- end load data-->
                  </td>
                </tr>
                 <tr>
                  <td style="width: 15%">Start Date *</td>
                  <td style="width: 35%"><input class="form-control" id="startdate" name="startdate" ng-model="reportPOInfo.startdate" ui-date="dateOptions" ng-model-options="{timezone: 'UTC'}"  type="text" required />
                    <div class="form-group">
                      <p class="text-danger" ng-show="reportpurchase.startdate.$invalid && reportpurchase.startdate.$dirty"><font color="red"><i style="font-size: 10px;">*Please Insert Start Date..!!!</i></font> </p>

                    </div>
                  </td>
                  <td style="width: 15%">End Date *</td>
                  <td style="width: 35%"><input class="form-control" id="enddate" name="enddate" ng-model="reportPOInfo.enddate" ui-date="dateOptions" type="text" required />
                    <div class="form-group">
                      <p class="text-danger" ng-show="reportpurchase.enddate.$invalid && reportpurchase.enddate.$dirty"><font color="red"><i style="font-size: 10px;">*Please Insert End Date..!!!</i></font> </p>

                    </div>
                  </td>
                </tr>
                <tr>
                  <td style="width: 15%">Item ID </td>
                  <td style="width: 35%"><input class="form-control" id="itemid" name="itemid" ng-keyup='fetchReportItemPO()' ng-click='searchboxReportItemPO($event);' ng-model="reportPOInfo.itemid" type="text" autocomplete="off"/>
                    <!-- load data autocomplete-->
                    <ul id='searchResult' >
                        <li ng-click='setValueReportItemPO($index,$event)' ng-repeat="result in searchResult" >
                          {{ result.item }}
                        </li>
                    </ul> 
                    <!-- end load data-->
                  </td>
                  <td style="width: 15%">Status </td>
                  <td style="width: 35%">
                     <select name="statuspo" id="statuspo" class="form-control" ng-model="reportPOInfo.statuspo">
                            <option value="0">All Status</option>
                            <option value="5">Active</option>
                            <option value="7">Posted</option>
                        </select>
                  </td>
                </tr>
               <tr>
                  <td colspan="4" align="left">
                     <button class="btn btn-warning" type="submit" ng-disabled="reportpurchase.$invalid" ng-click="searchReportPurchase(reportPOInfo)"><i class="fa fa-search"></i> Search</button>
                     <button class="btn btn-primary" type="submit" ng-disabled="reportpurchase.$invalid" ng-click="resetReportPurchase(reportPOInfo)"><i class="fa fa-eraser"></i> Reset</button>
                  </td>
                </tr>
              </table>
            </form>

            <hr>
             <!--load content-->
            <div ng-show="show_ContentPO">
              <p ng-bind-html="RptContentPO"></p><!--data content-->
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





