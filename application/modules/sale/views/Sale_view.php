<div class="main-grid" ng-controller="mainAppSale">
  <h3><?php echo $title; ?></h3><br>
      <div class="agile-grids"> 
        <!-- tables -->
        
        <!-- <div class="table-heading">
          <h2>Basic Tables</h2>
        </div> -->
        <div class="agile-tables">
          <div class="w3l-table-info">
            <h3>
              <a ng-click="showPopupSL()" class="btn btn-primary"><i class="fa fa-plus" ng-show="show_form"></i> Add</a>
              <a ng-click="popupPrintSL('/ci-store/sale/viewSale/print')" class="btn btn-danger"><i class="fa fa-print"></i> Print</a>
              <a ng-click="popupPrintSL('/ci-store/sale/viewSale/export')" class="btn btn-success"><i class="fa fa-file-excel-o"></i> Excel</a>
            </h3>
              <div class="table-responsive" style="height:400px;">
              <table datatable="ng" dt-options="vm.dtOptions" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Action</th>
                  <th>SaleID</th>
                  <th>SaleDate</th>
                  <th>TotalSale</th>
                  <th>Status</th>
                  <th>IsActive</th>
                  <th>EntryDate</th>
                  <th>EntryBy</th>
                  <th>LastUpdateDate</th>
                  <th>LastUpdateBy</th>
                </tr>
                </thead>
                <tbody>


                <tr ng-repeat="detailsale in details">
                  <td nowrap> 
                    <a data-toggle="modal" data-target="#getmodalsale" ng-click="editSale(detailsale)" class="btn btn-warning" title="Edit"><i class="fa fa-edit"></i> </a> 
                    <a ng-click="deletesale(detailsale.SaleID)" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?');" class="btn btn-danger" title="Delete"><i class="fa fa-trash"></i></a>
                    <a ng-if="detailsale.Status === '0'" ng-click="postSale(detailsale.SaleID)" class="btn btn-info" title="Post"><i class="fa fa-share-square"></i>
                    <a ng-if="detailsale.Status === '5'" ng-click="printBill('/ci-store/sale/viewSale/printbill/', detailsale.SaleID)" class="btn btn-success" title="Post"><i class="fa fa-print"></i>
                  </td>
                  <td>{{detailsale.SaleID}}</td>
                  <td>{{detailsale.SaleDate}}</td>
                  <td style='text-align:right;'>{{detailsale.TotalSale | currency : "" : 0}}</td>
                  <td>
                    <div ng-if="detailsale.Status === '5'" class="bg-success" style="text-align: center;">Finish</div> 
                    <div ng-if="detailsale.Status === '0'" class="bg-alert" style="text-align: center;">On Going</div> 
                    <div ng-if="detailsale.Status === '9'" class="bg-danger" style="text-align: center;">Delete</div>
                  </td>
                  <td>{{detailsale.IsActive}}</td>
                  <td>{{detailsale.EntryDate}}</td>
                  <td>{{detailsale.EntryBy}}</td>
                  <td>{{detailsale.LastUpdateDate}}</td>
                  <td>{{detailsale.LastUpdateBy}}</td>
                </tr>

            
                
                </tbody>
                <tfoot>
                <tr>
                  <th>Action</th>
                  <th>SaleID</th>
                  <th>SaleDate</th>
                  <th>TotalSale</th>
                  <th>Status</th>
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


<!-- modal popup form data sale-->
<div class="modal fade" id="getmodalsale" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
          <h4 id="myModalLabel" style="text-align: left;">Form Sale</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body" style="height: 400px !important; overflow:auto;">

            <form name="listsale" id="saleForm"  method="POST">

               <!-- notif alert success or not -->
             <div class="alert alert-info" ng-show="show_SLMsg">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                <span class="fa fa-info"></span>&nbsp;&nbsp;{{notifikasiSLMsg}}
            </div>

              <div id="notif-datagroup"></div>
              <div class="table-responsive">
              <table class="table table-form">
                <tr>
                  <td style="width: 25%">Sale ID *</td><td style="width: 25%"><input class="form-control" id="sale" name="sale" ng-model="saleInfo.sale" maxlength="20" type="text" value="{{numberingsale}}" readonly="readonly" required />

                   <div class="form-group">
                      <p class="text-danger" ng-show="listsale.sale.$invalid && listsale.sale.$dirty"><font color="red"><i style="font-size: 10px;">* Please Insert SaleID..!!!</i></font></p>
                    </div>

                  </td>
                   <td style="width: 25%">Sale Date *</td><td style="width: 25%"><input class="form-control" id="saledate" name="saledate" ng-model="saleInfo.saledate" ui-date="dateOptions" type="text" required />

                   <div class="form-group">
                      <p class="text-danger" ng-show="listsale.saledate.$invalid && listsale.saledate.$dirty"><font color="red"><i style="font-size: 10px;">*Please Insert Sale Date ..!!!</i></font> </p>
                    </div>

                  </td>
                </tr>
                <tr>
                  <td style="width: 25%">ItemID *</td><td style="width: 25%"><input class="form-control" id="itemid" name="itemid" ng-model="saleInfo.itemid" type="text" ng-keyup='fetchItemSL()' ng-click='searchboxItemSL($event);' required autocomplete="off" />

                   <div class="form-group">
                      <p class="text-danger" ng-show="listsale.itemid.$invalid && listsale.itemid.$dirty"><font color="red"><i style="font-size: 10px;">*Please Insert Item ID..!!!</i></font></p>
                   </div>

                    <!-- load data autocomplete-->
                    <ul id='searchResult' >
                        <li ng-click='setValueItemSL($index,$event)' ng-repeat="result in searchResult" >
                          {{ result.item }}
                        </li>
                    </ul> 
                    <!-- end load data-->

                  </td>

                   <td style="width: 25%">Item Name *</td><td style="width: 25%"><input class="form-control" id="itemname" name="itemname" ng-model="saleInfo.itemname" type="text" value="" readonly="readonly" required />

                   <div class="form-group">
                      <p class="text-danger" ng-show="listsale.itemname.$invalid && listsale.itemname.$dirty"><font color="red"><i style="font-size: 10px;">*Please Insert Item Name ..!!!</i></font></p>
                   </div>
                   </td>
                   
                </tr>
                 <tr>
                  <td style="width: 25%">Selling Price *</td><td style="width: 25%"><input class="form-control" id="sellingprice" name="sellingprice" ng-model="saleInfo.sellingprice" type="text" value="" readonly="readonly" required />
                   <div class="form-group">
                      <p class="text-danger" ng-show="listsale.sellingprice.$invalid && listsale.sellingprice.$dirty"><font color="red"><i style="font-size: 10px;">*Please Insert Selling Price..!!!</i></font> </p>
                   </div>
                  </td>

                  <td style="width: 25%">Jumlah *</td><td style="width: 25%"><input class="form-control" id="amount" name="amount" ng-model="saleInfo.amount" ng-change="calcFormSL()" type="number" value="" required />
                   <div class="form-group">
                      <p class="text-danger" ng-show="listsale.amount.$invalid && listsale.amount.$dirty"><font color="red"><i style="font-size: 10px;">*Please Insert Amount ..!!!</i></font>  </p>
                   </div>

                    <!-- show stock -->
                    <input style="display: none;" type="text" name="totalstockitem" id="totalstockitem" ng-model="totalstockitem" value={{TotalStock}}>
                    <div class="form-group">
                      <p class="text-danger" ng-show="showstock"><font color="red"><i style="font-size: 10px;">{{TotalStock}} Stock Item</i></font></p>
                   </div>
                   <!-- end stock -->


                  </td>
                </tr>
                 <tr>
                    <td colspan="2">&nbsp;</td>
                    <td style="width: 25%">Amount Total *</td><td style="width: 25%"><input class="form-control" id="stotal" name="total" ng-model="saleInfo.total" type="text" value="" readonly="readonly" required />

                   <div class="form-group">
                      <p class="text-danger" ng-show="listsale.total.$invalid && listsale.total.$dirty"><font color="red"><i style="font-size: 10px;">*Please Insert Amount total..!!!</i></font> </p>
                   </div>

                  </td>
                </tr>
                </table>
                <table class="table table-form">
                      <tr>
                        <td>Action</td>
                        <td>No.</td>
                        <td>Item ID</td>
                        <td>Item Name</td>
                        <td>Purchase Price</td>
                        <td>Amount</td>
                        <td>Total</td>
                      </tr>
                      <tr ng-repeat="detailsl in detailssl" > 
                        <td>
                          <a ng-click="deletedetailsl(detailsl.SaleID, detailsl.ItemID)" class="btn btn-primary" title="Delete Detail Sale"><i class="fa fa-trash"></td>
                        </td>
                        <td>{{$index + 1}}</td>
                        <td>{{detailsl.ItemID}}</td>
                        <td>{{detailsl.ItemName}}</td>
                        <td style="text-align:right;">{{detailsl.SellingPrice | currency: "" : 0}}</td>
                        <td style="text-align:right;">{{detailsl.Amount}}</td>
                        <td style="text-align:right;" ng-init="$parent.totalnew = $parent.totalnew + (+detailsl.Total)">{{detailsl.Total | currency: "" : 0}}</td>
                      </tr>
                      <tr>
                        <td colspan="6" style="text-align:center;">Total</td>
                        <td style="text-align:right;">{{ totalnew | currency: "" : 0}}</td>
                      </tr>
                </table>
              </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-success" type="submit" ng-disabled="listsale.$invalid" ng-click="insertSaleDetail()"><i class="fa fa-save"></i> Add</button>
        <button class="btn btn-success" type="submit" ng-disabled="!detailssl" ng-click="insertSale()"><i class="fa fa-paper-plane"></i> Save & Post</button>
        <button class="btn btn-danger" data-dismiss="modal" aria-hidden="true"><i class="fa fa-sign-out"></i> Close</button>
      </div>
        </form>


    </div>
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












