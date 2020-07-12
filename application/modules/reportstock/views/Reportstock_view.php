<div class="main-grid" ng-controller="mainAppRptStock">
  
      <div class="agile-grids"> 
        <div class="banner">
          <h2>
            <a href="#page-profile"><?php echo $title; ?></a>
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
              <form name="reportstock" id="rptSKForm" method="POST">
              <table class="table table-sm table-form" style="overflow:auto;">
               <!--  <tr>
                  <td colspan="4"><h4><?php echo $title; ?><h4></td>
                </tr> -->
                 <tr>
                  <td style="width: 15%">Purchase Order ID </td>
                  <td style="width: 35%"><input class="form-control" id="purchase" name="purchase" ng-model="reportSKInfo.purchase"  type="text" /></td>
                  <td style="width: 15%">Sale ID </td>
                  <td style="width: 35%"><input class="form-control" id="sale" name="sale" ng-model="reportSKInfo.sale"  type="text" /></td>
                </tr>
                 <tr>
                  <td style="width: 15%">Start Date *</td>
                  <td style="width: 35%"><input class="form-control" id="startdate" name="startdate" ng-model="reportSKInfo.startdate" ui-date="dateOptions" ng-model-options="{timezone: 'UTC'}"  type="text" />
                  </td>
                  <td style="width: 15%">End Date *</td>
                  <td style="width: 35%"><input class="form-control" id="enddate" name="enddate" ng-model="reportSKInfo.enddate" ui-date="dateOptions" type="text" />
                  </td>
                </tr>
                <tr>
                  <td style="width: 15%">Item ID </td>
                  <td style="width: 35%"><input class="form-control" id="itemid" name="itemid" ng-keyup='fetchReportItemSK()' ng-click='searchboxReportItemSK($event);' ng-model="reportSKInfo.itemid" type="text" autocomplete="off"/>
                    <!-- load data autocomplete-->
                    <ul id='searchResult' >
                        <li ng-click='setValueReportItemSK($index,$event)' ng-repeat="result in searchResult" >
                          {{ result.item }}
                        </li>
                    </ul> 
                    <!-- end load data-->
                  </td>
                 <td style="width: 15%">Report Type </td>
                  <td style="width: 35%">
                     <select name="reporttype" id="reporttype" class="form-control" ng-model="reportSKInfo.reporttype">
                            <option value="HI">History Item</option>
                            <option value="TI">Total Item</option>
                        </select>
                  </td>
                </tr>
               <tr>
                  <td colspan="4" align="left"> 
                     <button class="btn btn-warning" type="submit" ng-click="searchReportStock(reportSKInfo)"><i class="fa fa-search"></i> Search</button>
                     <button class="btn btn-primary" type="submit" ng-click="resetReportStock(reportSKInfo)"><i class="fa fa-eraser"></i>  Reset</button>
                  </td>
                </tr>
              </table>
            </form>

             <!--load content-->
            <div ng-show="show_ContentSK">
              <p ng-bind-html="RptContentSK"></p><!--data content-->
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





