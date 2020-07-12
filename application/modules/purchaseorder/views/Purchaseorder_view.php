<div class="main-grid" ng-controller="mainAppPurchaseOrder">
  <h3><?php echo $title; ?></h3><br>
      <div class="agile-grids"> 
        <!-- tables -->
        
        <!-- <div class="table-heading">
          <h2>Basic Tables</h2>
        </div> -->
        <div class="agile-tables">
          <div class="w3l-table-info">
            <h3>
              <a ng-click="showPopupPO()" class="btn btn-primary"><i class="fa fa-plus" ng-show="show_form"></i> Add</a>
              <a ng-click="popupPrintPO('/ci-store/purchaseorder/viewPurchaseOrder/print')" class="btn btn-danger"><i class="fa fa-print"></i> Print</a>
              <a ng-click="popupPrintPO('/ci-store/purchaseorder/viewPurchaseOrder/export')" class="btn btn-success"><i class="fa fa-file-excel-o"></i> Excel</a>
            </h3>
              <div class="table-responsive" style="height:400px;">
              <table datatable="ng" dt-options="vm.dtOptions" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Action</th>
                  <th>PurchaseOrderID</th>
                  <th>PurchaseDate</th>
                  <th>SupplierID</th>
                  <th>TotalPurchase</th>
                  <th>Status</th>
                  <th>IsActive</th>
                  <th>EntryDate</th>
                  <th>EntryBy</th>
                  <th>LastUpdateDate</th>
                  <th>LastUpdateBy</th>
                </tr>
                </thead>
                <tbody>


                <tr ng-repeat="detailpurchase in details">
                  <td nowrap> 
                    <a data-toggle="modal" data-target="#getmodalpurchase" ng-click="editPurchaseOrder(detailpurchase)" class="btn btn-warning" title="Edit"><i class="fa fa-edit"></i> </a> 
                    <a ng-click="deletePurchaseOrder(detailpurchase.PurchaseOrderID)" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?');" class="btn btn-danger" title="Delete"><i class="fa fa-trash"></i> </a> 
                    <a ng-if="detailpurchase.Status === '0'" ng-click="postPurchaseOrder(detailpurchase.PurchaseOrderID)" class="btn btn-info" title="Post"><i class="fa fa-share-square"></i> </a> 
                      <a ng-if="detailpurchase.Status === '5'" ng-click="popupPrintInvoice('/ci-store/purchaseorder/viewPurchaseOrder/printinvoice/', detailpurchase.PurchaseOrderID)" class="btn btn-success" title="Print Invoice"><i class="fa fa-print"></i> </a> 

                    </td>
                  <td>{{detailpurchase.PurchaseOrderID}}</td>
                  <td>{{detailpurchase.PurchaseDate}}</td>
                  <td>{{detailpurchase.SupplierID}}</td>
                  <td style='text-align:right;'>{{detailpurchase.TotalPurchase | currency : "" : 0}}</td>
                  <td>
                    <div ng-if="detailpurchase.Status === '5'" class="bg-success" style="text-align: center;">Finish</div> 
                    <div ng-if="detailpurchase.Status === '0'" class="bg-alert" style="text-align: center;">On Going</div> 
                    <div ng-if="detailpurchase.Status === '9'" class="bg-danger" style="text-align: center;">Delete</div>
                  </td>
                  <td>{{detailpurchase.IsActive}}</td>
                  <td>{{detailpurchase.EntryDate}}</td>
                  <td>{{detailpurchase.EntryBy}}</td>
                  <td>{{detailpurchase.LastUpdateDate}}</td>
                  <td>{{detailpurchase.LastUpdateBy}}</td>
                </tr>

            
                
                </tbody>
                <tfoot>
                <tr>
                  <th>Action</th>
                  <th>PurchaseOrderID</th>
                  <th>PurchaseDate</th>
                  <th>SupplierID</th>
                  <th>TotalPurchase</th>
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


<!-- modal popup form data PO-->
<div class="modal fade" id="getmodalpurchase" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
          <h4 id="myModalLabel" style="text-align: left;">Form Purchase Order</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body" style="height: 400px !important; overflow:auto;">

            <form name="listpurchase" id="purchaseForm"  method="POST">

               <!-- notif alert success or not -->
             <div class="alert alert-info" ng-show="show_POMsg">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                <span class="fa fa-info"></span>&nbsp;&nbsp;{{notifikasiPOMsg}}
            </div>

              <div id="notif-datagroup"></div>
              <div class="table-responsive">
              <table class="table table-form">
                <tr>
                  <td style="width: 25%">Purchase Order ID *</td><td style="width: 25%"><input class="form-control" id="purorder" name="purorder" ng-model="purchaseInfo.purorder" maxlength="20" type="text" value="{{numberingpurchase}}" readonly="readonly" required />

                   <div class="form-group">
                      <p class="text-danger" ng-show="listpurchase.purorder.$invalid && listpurchase.purorder.$dirty"><font color="red"><i style="font-size: 10px;">* Please Insert Purchase OrderID..!!!</i></font></p>
                    </div>

                  </td>
                   <td style="width: 25%">Purchase Date *</td><td style="width: 25%"><input class="form-control" id="purchasedate" name="purchasedate" ng-model="purchaseInfo.purchasedate" ui-date="dateOptions" type="text" required />

                   <div class="form-group">
                      <p class="text-danger" ng-show="listpurchase.purchasedate.$invalid && listpurchase.purchasedate.$dirty"><font color="red"><i style="font-size: 10px;">*Please Insert Purchase Date ..!!!</i></font> </p>
                    </div>

                  </td>
                </tr>
                <tr>
                  <td style="width: 25%">Supplier ID *</td><td style="width: 25%"><input class="form-control" id="supplierid" name="supplierid" ng-keyup='fetchSupplierPO()' ng-click='searchboxSupplierPO($event);' ng-model="purchaseInfo.supplierid" type="text" required autocomplete="off"/>

                   <div class="form-group">
                      <p class="text-danger" ng-show="listpurchase.supplierid.$invalid && listpurchase.supplierid.$dirty"><font color="red"><i style="font-size: 10px;">*Please Insert Supplier ID..!!!</i></font> </p>
                   </div>


                   <!-- load data autocomplete-->
                    <ul id='searchResult' >
                        <li ng-click='setValueSupplierPO($index,$event)' ng-repeat="result in searchResultsup" >
                          {{ result.supplier }}
                        </li>
                    </ul> 
                    <!-- end load data-->

                  </td>
                  <td style="width: 25%">ItemID *</td><td style="width: 25%"><input class="form-control" id="itemid" name="itemid" ng-keyup='fetchItemPO()' ng-click='searchboxItemPO($event);' ng-model="purchaseInfo.itemid" type="text" autocomplete="off"/>
                   <div class="form-group">
                      <p class="text-danger" ng-show="listpurchase.itemid.$invalid && listpurchase.itemid.$dirty"><font color="red"><i style="font-size: 10px;">*Please Insert Item ID..!!!</i></font></p>
                   </div>

                    <!-- load data autocomplete-->
                    <ul id='searchResult' >
                        <li ng-click='setValueItemPO($index,$event)' ng-repeat="result in searchResult" >
                          {{ result.item }}
                        </li>
                    </ul> 
                    <!-- end load data-->

                  </td>
                </tr>
                 <tr>
                   <td style="width: 25%">Item Name *</td><td style="width: 25%"><input class="form-control" id="itemname" name="itemname" ng-model="purchaseInfo.itemname" readonly="readonly" type="text" value="" readonly="readonly" required />

                   <div class="form-group">
                      <p class="text-danger" ng-show="listpurchase.itemname.$invalid && listpurchase.itemname.$dirty"><font color="red"><i style="font-size: 10px;">*Please Insert Item Name ..!!!</i></font></p>
                   </div>

                  

                  <td style="width: 25%">Purchase Price *</td><td style="width: 25%"><input class="form-control" id="purchaseprice" name="purchaseprice" ng-model="purchaseInfo.purchaseprice" readonly="readonly" type="text" value="" readonly="readonly" required />

                   <div class="form-group">
                      <p class="text-danger" ng-show="listpurchase.purchaseprice.$invalid && listpurchase.purchaseprice.$dirty"><font color="red"><i style="font-size: 10px;">*Please Insert Purchase Price..!!!</i></font> </p>
                   </div>

                  </td>
                  </td>
                </tr>
                 <tr>
                  <td style="width: 25%">Jumlah *</td><td style="width: 25%"><input class="form-control" id="amount" name="amount" ng-model="purchaseInfo.amount" ng-change="calcFormPO()" type="number" value="" required />

                   <div class="form-group">
                      <p class="text-danger" ng-show="listpurchase.amount.$invalid && listpurchase.amount.$dirty"><font color="red"><i style="font-size: 10px;">*Please Insert Amount ..!!!</i></font>  </p>
                   </div>

                     <!-- show stock -->
                    <div class="form-group">
                      <p class="text-danger" ng-show="showstock"><font color="red"><i style="font-size: 10px;">{{TotalStock}} Stock Item</i></font></p>
                   </div>
                   <!-- end stock -->


                  </td>
                    <td style="width: 25%">Amount Total *</td><td style="width: 25%"><input class="form-control" id="total" name="total" ng-model="purchaseInfo.total" type="text" value="" readonly="readonly" required />

                   <div class="form-group">
                      <p class="text-danger" ng-show="listpurchase.total.$invalid && listpurchase.total.$dirty"><font color="red"><i style="font-size: 10px;">*Please Insert Amount total..!!!</i></font> </p>
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
                      <tr ng-repeat="detailpo in detailspo" > 
                        <td>
                          <a ng-click="deletedetailPO(detailpo.PurchaseOrderID, detailpo.ItemID)" class="btn btn-primary" title="Delete Detail Purchase Order"><i class="fa fa-trash"></td>
                        </td>
                        <td>{{$index + 1}}</td>
                        <td>{{detailpo.ItemID}}</td>
                        <td>{{detailpo.ItemName}}</td>
                        <td style="text-align:right;">{{detailpo.PurchasePrice | currency: "" : 0}}</td>
                        <td style="text-align:right;">{{detailpo.Amount}}</td>
                        <td style="text-align:right;" ng-init="$parent.totalnew = $parent.totalnew + (+detailpo.Total)">{{detailpo.Total | currency: "" : 0}}</td>
                      </tr>
                      <tr>
                        <td colspan="6" style="text-align:center;">Total</td>
                        <td style="text-align:right;">{{ totalnew | currency: "" : 0}}</td>
                      </tr>
                </table>
              </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-success" type="submit" ng-disabled="listpurchase.$invalid" ng-click="insertPurchaseDetail()"><i class="fa fa-save"></i> Add</button>
        <button class="btn btn-success" type="submit" ng-disabled="!detailspo" ng-click="insertPurchase()"><i class="fa fa-paper-plane"></i> Save & Post</button>
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


<!-- <style type="text/css">
  
table {
  /* Not required only for visualizing */
  border-collapse: collapse;
  width: 100%;
}

table thead {
  /* Important */
  position: sticky;
  z-index: 100;
  top: 0;
}

</style> -->










