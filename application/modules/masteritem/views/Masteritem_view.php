<div class="main-grid" ng-controller="mainAppItem">
      <h3><?php echo $title; ?></h3><br>
      <div class="agile-grids"> 
        <!-- tables -->
        
      <!--   <div class="table-heading">
          <h3><?php echo $title; ?></h3><br>
        </div> -->
        <div class="agile-tables">
          <div class="w3l-table-info">

            <h3>
              <a data-toggle="modal" data-target="#getmodalitem" class="btn btn-primary"><i class="fa fa-plus" ng-show="show_form"></i> Add</a>
              <a ng-click="popupPrintItem('/ci-store/masteritem/viewMasteritem/print')" class="btn btn-danger"><i class="fa fa-print"></i> Print</a>
              <a ng-click="popupExportItem('/ci-store/masteritem/viewMasteritem/export')" class="btn btn-success"><i class="fa fa-file-excel-o"></i> Excel</a>
            </h3>
              <div class="table-responsive" style="height:400px;">
              <table datatable="ng" dt-options="vm.dtOptions" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Action</th>
                  <th>ItemID</th>
                  <th>ItemName</th>
                  <th>GroupID</th>
                  <th>ShortName</th>
                  <th>PurchasePrice</th>
                  <th>SellingPrice</th>
                  <th>Stock</th>
                  <th>ItemImage</th>
                  <th>IsActive</th>
                  <th>EntryDate</th>
                  <th>EntryBy</th>
                  <th>LastUpdateDate</th>
                  <th>LastUpdateBy</th>
                </tr>
                </thead>
                <tbody>

              

                <tr ng-repeat="detailitem in details">
                  <td nowrap> 
                    <a data-toggle="modal" data-target="#geteditmodalitem" ng-click="edititem(detailitem)" class="btn btn-warning" title="Edit"><i class="fa fa-edit"></i> </a> 
                    <a ng-click="deleteitem(detailitem.ItemID)" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?');" class="btn btn-danger" title="Delete"><i class="fa fa-trash"></td>
                  <td>{{detailitem.ItemID}}</td>
                  <td>{{detailitem.ItemName}}</td>
                  <td>{{detailitem.GroupID}}</td>
                  <td>{{detailitem.ShortItem}}</td>
                  <td style="text-align: right;">{{detailitem.PurchasePrice | currency : "" : 0}}</td>
                  <td style="text-align: right;">{{detailitem.SellingPrice | currency : "" : 0}}</td>
                  <td style="text-align: right;">{{detailitem.Stock}}</td>
                  <td>{{detailitem.ItemImage}}</td>
                  <td>{{detailitem.IsActive}}</td>
                  <td>{{detailitem.EntryDate}}</td>
                  <td>{{detailitem.EntryBy}}</td>
                  <td>{{detailitem.LastUpdateDate}}</td>
                  <td>{{detailitem.LastUpdateBy}}</td>
                </tr>

            
                
                </tbody>
                <tfoot>
                <tr>
                  <th>Action</th>
                  <th>ItemID</th>
                  <th>Item Name</th>
                  <th>GroupID</th>
                  <th>ShortName</th>
                  <th>PurchasePrice</th>
                  <th>SellingPrice</th>
                  <th>Stock</th>
                  <th>ItemImage</th>
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


<!-- modal popup form data item-->
<div class="modal fade" id="getmodalitem" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
          <h4 id="myModalLabel" style="text-align: left;">Form Item</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body" style="height: 400px !important; overflow:auto;">

            <form name="listitem" id="groupForm" ng-submit="insertitem(itemInfo)" method="POST">

            <!-- notif alert success or not -->
             <div class="alert alert-info" ng-show="show_uploadMsg">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                <span class="fa fa-info"></span>&nbsp;&nbsp;{{notifikasiuploadMsg}}
            </div>

              <div id="notif-datagroup"></div>
              <div class="table-responsive">
              <table class="table table-form">
                <tr>
                  <td style="width: 25%">Item ID *</td><td style="width: 25%"><input class="form-control" id="itemid" name="item_id" ng-model="itemInfo.item_id" maxlength="10" type="text" value="{{numberinggroup}}" readonly="readonly" required />
                   <div class="form-group">
                      <p class="text-danger" ng-show="listitem.item_id.$invalid && listitem.item_id.$dirty"><font color="red"><i style="font-size: 10px;">*Please Insert Item ID..!!!</i></font> </p>

                    </div>
                  </td>
                  <td style="width: 25%">Item Name *</td><td style="width: 25%"><input class="form-control" id="itemname" name="item_name" ng-model="itemInfo.item_name" type="text" value="" required />

                   <div class="form-group">
                      <p class="text-danger" ng-show="listitem.item_name.$invalid && listitem.item_name.$dirty"><font color="red"><i style="font-size: 10px;">*Please Insert Item Name..!!!</i></font></p>
                   </div>

                  </td>
                </tr>
                <tr>
                  <td style="width: 25%">Group ID*</td><td style="width: 25%"><input class="form-control" id="groupid" name="group_id" ng-keyup='fetchGroup()' ng-click='searchboxGroup($event);' ng-model="itemInfo.group_id" type="text" value="" required autocomplete="off" />
                   <div class="form-group">
                      <p class="text-danger" ng-show="listitem.group_id.$invalid && listitem.group_id.$dirty"><font color="red"><i style="font-size: 10px;">*Please Insert GroupID..!!!</i></font></p>
                   </div>

                     <!-- load data autocomplete-->
                    <ul id='searchResult' >
                        <li ng-click='setValueGroup($index,$event)' ng-repeat="result in searchResult" >
                          {{ result.group }}
                        </li>
                    </ul> 
                    <!-- end load data-->

                  </td>
                  <td style="width: 25%">Short Item*</td><td style="width: 25%"><input class="form-control" id="shortitem" name="short_item" ng-model="itemInfo.short_item" type="text" value="" required />
                   <div class="form-group">
                      <p class="text-danger" ng-show="listitem.short_item.$invalid && listitem.short_item.$dirty"><font color="red"><i style="font-size: 10px;">*Please Insert Short Item Name..!!!</i></font></p>
                   </div>
                  </td>
                </tr>
                <tr>
                  <td style="width: 25%">Purchase Price*</td><td style="width: 25%"><input class="form-control" id="purprice" name="pur_price" ng-model="itemInfo.pur_price" type="number" value="" required />
                   <div class="form-group">
                      <p class="text-danger" ng-show="listitem.pur_price.$invalid && listitem.pur_price.$dirty"><font color="red"><i style="font-size: 10px;">*Please Insert Purchase Price..!!!</i></font></p>
                   </div>
                  </td>
                  <td style="width: 25%">Selling Price*</td><td style="width: 25%"><input class="form-control" id="selprice" name="sel_price" ng-model="itemInfo.sel_price" type="number" value="" required />
                   <div class="form-group">
                      <p class="text-danger" ng-show="listitem.sel_price.$invalid && listitem.sel_price.$dirty"><font color="red"><i style="font-size: 10px;">*Please Insert Selling Price..!!!</i></font></p>
                   </div>
                  </td>
                </tr>
                <tr>
                  <td style="width: 25%">Stock *</td><td style="width: 25%"><input class="form-control" id="stock" name="stock" ng-model="itemInfo.stock" type="number" value="" readonly="readonly" required />
                   <div class="form-group">
                      <p class="text-danger" ng-show="listitem.stock.$invalid && listitem.stock.$dirty"><font color="red"><i style="font-size: 10px;">*Please Insert Stock..!!!</i></font> </p>
                   </div>
                  </td>
                  <td style="width: 25%">Description </td><td style="width: 25%">
                    <textarea class="form-control" id="desc" name="desc" ng-model="itemInfo.desc"></textarea>
                  </td>
                </tr>
                <tr>
                    <td colspan="2" style="width: 25%">Image Item *</td><td colspan="2" style="width: 75%">
                      <input type="file" id="photo" name="photo" ng-model="itemInfo.photo" accept="image/*" onchange="angular.element(this).scope().uploadedFileInput(this)">                            
                      <p class="help-block">Photo berukuran 500px x 500px.</p>                                                        
                        <img id="output1" class="img-responsive">
                    </td>
                </tr>
                </table>
              </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-success" type="submit" ng-disabled="listitem.$invalid" ng-click="insertitem(itemInfo)"><i class="fa fa-save"></i> Save</button>
        <button class="btn btn-danger" data-dismiss="modal" aria-hidden="true"><i class="fa fa-sign-times"></i> Close</button>
      </div>
        </form>


    </div>
  </div>
</div>



<!--edit data item-->
<!-- modal popup form data item-->
<div class="modal fade" id="geteditmodalitem" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
          <h4 id="myModalLabel" style="text-align: left;">Form Item</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body" style="height: 400px !important; overflow:auto;">

            <form name="elistitem" id="groupForm" ng-submit="updateitem(curitemInfo)" method="POST">
              <div id="notif-datagroup"></div>
              <div class="table-responsive">
              <table class="table table-form">
                <tr>
                  <td style="width: 25%">Item ID *</td><td style="width: 25%"><input class="form-control" id="itemid" name="item_id" ng-model="curitemInfo.item_id" maxlength="10" type="text" value="{{numberinggroup}}" readonly="readonly" required />
                   <div class="form-group">
                      <p class="text-danger" ng-show="elistitem.item_id.$invalid && elistitem.item_id.$dirty"><font color="red"><i style="font-size: 10px;">*Please Insert Item ID..!!!</i></font> </p>
                      <!-- alert active or not active-->
                      <div ng-show="show_statusdata"><font color="red"><i style="font-size: 10px;">{{statusdata}}</i></font></div>
                    </div>
                  </td>
                  <td style="width: 25%">Item Name *</td><td style="width: 25%"><input class="form-control" id="itemname" name="item_name" ng-model="curitemInfo.item_name" type="text" value="" required />

                   <div class="form-group">
                      <p class="text-danger" ng-show="elistitem.item_name.$invalid && elistitem.item_name.$dirty"><font color="red"><i style="font-size: 10px;">*Please Insert Item Name..!!!</i></font></p>
                   </div>

                  </td>
                </tr>
                <tr>
                  <td style="width: 25%">Group ID*</td><td style="width: 25%"><input class="form-control" id="groupid" name="group_id" ng-model="curitemInfo.group_id" type="text" value="" ng-keyup='efetchGroup()' ng-click='searchboxGroup($event);' required autocomplete="off"/>
                   <div class="form-group">
                      <p class="text-danger" ng-show="elistitem.group_id.$invalid && elistitem.group_id.$dirty"><font color="red"><i style="font-size: 10px;">*Please Insert GroupID..!!!</i></font></p>
                   </div>

                    <!-- load data autocomplete-->
                    <ul id='searchResult' >
                        <li ng-click='setEValueGroup($index,$event)' ng-repeat="result in searchResult" >
                          {{ result.group }}
                        </li>
                    </ul> 
                    <!-- end load data-->

                  </td>
                  <td style="width: 25%">Short Name*</td><td style="width: 25%"><input class="form-control" id="shortitem" name="short_item" ng-model="curitemInfo.short_item" type="text" value="" required />
                   <div class="form-group">
                      <p class="text-danger" ng-show="elistitem.short_item.$invalid && elistitem.short_item.$dirty"><font color="red"><i style="font-size: 10px;">*Please Insert Short Name Item..!!!</i></font></p>
                   </div>
                  </td>
                </tr>
                <tr>
                  <td style="width: 25%">Purchase Price*</td><td style="width: 25%"><input class="form-control" id="purprice" name="pur_price" ng-model="curitemInfo.pur_price" type="number" value="" required />
                   <div class="form-group">
                      <p class="text-danger" ng-show="elistitem.pur_price.$invalid && elistitem.pur_price.$dirty"><font color="red"><i style="font-size: 10px;">*Please Insert Purchase Price..!!!</i></font></p>
                   </div>
                  </td>
                  <td style="width: 25%">Selling Price*</td><td style="width: 25%"><input class="form-control" id="selprice" name="sel_price" ng-model="curitemInfo.sel_price" type="number" value="" required />
                   <div class="form-group">
                      <p class="text-danger" ng-show="elistitem.sel_price.$invalid && elistitem.sel_price.$dirty"><font color="red"><i style="font-size: 10px;">*Please Insert Selling Price..!!!</i></font></p>
                   </div>
                  </td>
                </tr>
                <tr>
                  <td style="width: 25%">Stock *</td><td style="width: 25%"><input class="form-control" id="stock" name="stock" ng-model="curitemInfo.stock" type="number" value="" readonly="readonly" required />
                   <div class="form-group">
                      <p class="text-danger" ng-show="elistitem.stock.$invalid && elistitem.stock.$dirty"><font color="red"><i style="font-size: 10px;">*Please Insert Stock..!!!</i></font> </p>
                   </div>
                  </td>
                  <td style="width: 25%">Description </td><td style="width: 25%">
                    <textarea class="form-control" id="desc" name="desc" ng-model="curitemInfo.desc"></textarea>
                  </td>
                </tr>
                <tr>
                    <td colspan="2" style="width: 25%">Image Item *</td><td colspan="2" style="width: 75%">
                      <input type="file" name="photo" id="photo" ng-model="curitemInfo.photo" accept="photo" onchange="angular.element(this).scope().uploadedFile(this)" ng-required="true">                            
                            <p class="help-block">Photo berukuran 500px x 500px.</p>                                                        
                        <img ng-src="<?= base_url(); ?>upload/item/{{curitemInfo.photo}}" width="99%" alt="Description" />
                        <img id="output2" class="img-responsive">
                    </td>
                </tr>
                </table>
              </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-success" type="submit" ng-click="updateitem(curitemInfo)"><i class="fa fa-save"></i> Save</button>
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
















