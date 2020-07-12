<div class="main-grid" ng-controller="mainAppSupplier">
  <h3><?php echo $title; ?></h3><br>
      <div class="agile-grids"> 
        <!-- tables -->
        
        <!-- <div class="table-heading">
          <h2>Basic Tables</h2>
        </div> -->
        <div class="agile-tables">
          <div class="w3l-table-info">
            <h3>
              <a ng-click="getPopupSupplier('getmodalsupplier')" class="btn btn-primary"><i class="fa fa-plus" ng-show="show_form"></i> Add</a>
              <a ng-click="popupPrintSupplier('/ci-store/mastersupplier/viewMastersupplier/print')" class="btn btn-danger"><i class="fa fa-print"></i> Print</a>
              <a ng-click="popupExportSupplier('/ci-store/mastersupplier/viewMastersupplier/export')" class="btn btn-success"><i class="fa fa-file-excel-o"></i> Excel</a>
            </h3>
              <div class="table-responsive" style="height:400px;">
              <table datatable="ng" dt-options="vm.dtOptions" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Action</th>
                  <th>SupplierID</th>
                  <th>Supplier Name</th>
                  <th>Description</th>
                  <th>IsActive</th>
                  <th>EntryDate</th>
                  <th>EntryBy</th>
                  <th>LastUpdateDate</th>
                  <th>LastUpdateBy</th>
                </tr>
                </thead>
                <tbody>

              

                <tr ng-repeat="detailsupplier in details">
                  <td nowrap> 
                    <a data-toggle="modal" data-target="#geteditmodalsupplier" ng-click="editsupplier(detailsupplier)" class="btn btn-warning" title="Edit"><i class="fa fa-edit"></i> </a> 
                    <a ng-click="deletesupplier(detailsupplier.SupplierID)" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?');" class="btn btn-danger" title="Delete"><i class="fa fa-trash"></td>
                  <td>{{detailsupplier.SupplierID}}</td>
                  <td>{{detailsupplier.SupplierName}}</td>
                  <td>{{detailsupplier.Description}}</td>
                  <td>{{detailsupplier.IsActive}}</td>
                  <td>{{detailsupplier.EntryDate}}</td>
                  <td>{{detailsupplier.EntryBy}}</td>
                  <td>{{detailsupplier.LastUpdateDate}}</td>
                  <td>{{detailsupplier.LastUpdateBy}}</td>
                </tr>

            
                
                </tbody>
                <tfoot>
                <tr>
                  <th>Action</th>
                  <th>SupplierID</th>
                  <th>Supplier Name</th>
                  <th>Description</th>
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


<!-- modal popup form data group-->
<div class="modal fade" id="getmodalsupplier" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
          <h4 id="myModalLabel" style="text-align: left;">Form Item Supplier</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body" style="height: 400px !important; overflow:auto;">

            <form name="listsupplier" id="supplierForm" ng-submit="insertsupplier()" method="POST">
              <div id="notif-datagroup"></div>
              <div class="table-responsive">
              <table class="table table-form">
                <tr>
                  <td style="width: 25%">Supplier ID *</td><td style="width: 75%"><input class="form-control" id="supplierid" name="supplier_id" ng-model="supplierInfo.supplier_id" maxlength="10" type="text" value="{{numberinggroup}}" readonly="readonly" required />

                   <div class="form-group">
                      <p class="text-danger" ng-show="listsupplier.supplier_id.$invalid && listsupplier.supplier_id.$dirty">Please Insert SupplierID..!!!</p>
                    </div>

                  </td>
                </tr>
                <tr>
                  <td style="width: 25%">Supplier Name *</td><td style="width: 75%"><input class="form-control" id="suppliername" name="supplier_name" ng-model="supplierInfo.supplier_name" type="text" value="" required />

                   <div class="form-group">
                      <p class="text-danger" ng-show="listsupplier.supplier_name.$invalid && listsupplier.supplier_name.$dirty">Please Insert Supplier Name..!!!</p>
                   </div>

                  </td>
                </tr>
                <tr>
                  <td style="width: 25%">Description </td><td style="width: 75%"><textarea class="form-control" id="desc" name="desc" ng-model="supplierInfo.desc"></textarea></td>
                </tr>
                </table>
              </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-success" type="submit" ng-disabled="listsupplier.$invalid" ng-click="insertsupplier()"><i class="fa fa-save"></i> Save</button>
        <button class="btn btn-danger" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i> Close</button>
      </div>
        </form>


    </div>
  </div>
</div>



<!--edit data SUPPLIER-->
<div class="modal fade" id="geteditmodalsupplier" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display:none;">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
          <h4 id="myModalLabel" style="text-align: left;">Form Edit Item Supplier</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body" style="height: 400px !important; overflow:auto;">

            <form name="elistsupplier" id="supplierForm" ng-submit="updatesupplier(currsupplierInfo)" method="POST">
              <div id="notif-datagroup"></div>
              <div class="table-responsive">
              <table class="table table-form">
                <tr>
                  <td style="width: 25%">Group ID *</td><td style="width: 75%"><input class="form-control" id="supplieid" name="supplier_id" ng-model="currsupplierInfo.supplier_id" maxlength="10" type="text" readonly="readonly" required />

                   <div class="form-group">
                      <p class="text-danger" ng-show="elistsupplier.supplier_id.$invalid && elistsupplier.supplier_id.$dirty">Please Insert Supplier ID..!!!</p>
                    </div>

                  </td>
                </tr>
                <tr>
                  <td style="width: 25%">Group Name *</td><td style="width: 75%"><input class="form-control" id="suppliername" name="supplier_name" ng-model="currsupplierInfo.supplier_name" type="text" value="{{currsupplierInfo.SupplierName}}" required />

                   <div class="form-group">
                      <p class="text-danger" ng-show="elistsupplier.supplier_name.$invalid && elistsupplier.supplier_name.$dirty">Please Insert Supplier Name..!!!</p>
                   </div>

                  </td>
                </tr>
                <tr>
                  <td style="width: 25%">Description </td><td style="width: 75%"><textarea class="form-control" id="desc" name="desc" ng-model="currsupplierInfo.desc">{{currsupplierInfo.Description}}</textarea></td>
                </tr>
                </table>
              </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-success" type="submit" ng-disabled="elistsupplier.$invalid" ng-click="updatesupplier(currsupplierInfo)"><i class="fa fa-save"></i> Save</button>
        <button class="btn btn-danger" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i> Close</button>
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












