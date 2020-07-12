<div class="main-grid" ng-controller="mainAppController">
  <h3><?php echo $title; ?></h3><br>
      <div class="agile-grids"> 
        <!-- tables -->
        
        <!-- <div class="table-heading">
          <h2>Basic Tables</h2>
        </div> -->
        <div class="agile-tables">
          <div class="w3l-table-info">
            <h3>
              <a ng-click="getPopupGroup('getmodalgroup')" class="btn btn-primary"><i class="fa fa-plus" ng-show="show_form"></i> Add</a>
              <a ng-click="popupPrintGroup('/ci-store/mastergroup/viewMastergroup/print')" class="btn btn-danger"><i class="fa fa-print"></i> Print</a>
              <a ng-click="popupExportGroup('/ci-store/mastergroup/viewMastergroup/export')" class="btn btn-success"><i class="fa fa-file-excel-o"></i> Export</a>
            </h3>
              <div class="table-responsive" style="height:400px;">
              <table datatable="ng" dt-options="vm.dtOptions" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Action</th>
                  <th>GroupID</th>
                  <th>Group Name</th>
                  <th>Description</th>
                  <th>IsActive</th>
                  <th>EntryDate</th>
                  <th>EntryBy</th>
                  <th>LastUpdateDate</th>
                  <th>LastUpdateBy</th>
                </tr>
                </thead>
                <tbody>

              

                <tr ng-repeat="detailgroup in details">
                  <td nowrap> 
                    <a data-toggle="modal" data-target="#geteditmodalgroup" ng-click="editgroupitem(detailgroup)" class="btn btn-warning" title="Edit"><i class="fa fa-edit"></i> </a> 
                    <a ng-click="deletegroupitem(detailgroup.CodeGroupID)" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?');" class="btn btn-danger" title="Delete"><i class="fa fa-trash"></td>
                  <td>{{detailgroup.CodeGroupID}}</td>
                  <td>{{detailgroup.GroupName}}</td>
                  <td>{{detailgroup.Description}}</td>
                  <td>{{detailgroup.IsActive}}</td>
                  <td>{{detailgroup.EntryDate}}</td>
                  <td>{{detailgroup.EntryBy}}</td>
                  <td>{{detailgroup.LastUpdateDate}}</td>
                  <td>{{detailgroup.LastUpdateBy}}</td>
                </tr>

            
                
                </tbody>
                <tfoot>
                <tr>
                  <th>Action</th>
                  <th>GroupID</th>
                  <th>Group Name</th>
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
<div class="modal fade" id="getmodalgroup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
          <h4 id="myModalLabel" style="text-align: left;">Form Item Group</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body" style="height: 400px !important; overflow:auto;">

            <form name="listgroupitem" id="groupForm" ng-submit="insertgroupitem()" method="POST">
              <div id="notif-datagroup"></div>
              <div class="table-responsive">
              <table class="table table-form">
                <tr>
                  <td style="width: 25%">Group ID *</td><td style="width: 75%"><input class="form-control" id="groupcode" name="group_code" ng-model="groupInfo.group_code" maxlength="10" type="text" value="{{numberinggroup}}" readonly="readonly" required />

                   <div class="form-group">
                      <p class="text-danger" ng-show="listgroupitem.group_code.$invalid && listgroupitem.group_code.$dirty">Please Insert GroupID..!!!</p>
                    </div>

                  </td>
                </tr>
                <tr>
                  <td style="width: 25%">Group Name *</td><td style="width: 75%"><input class="form-control" id="groupname" name="group_name" ng-model="groupInfo.group_name" type="text" value="" required />

                   <div class="form-group">
                      <p class="text-danger" ng-show="listgroupitem.group_name.$invalid && listgroupitem.group_name.$dirty">Please Insert GroupName..!!!</p>
                   </div>

                  </td>
                </tr>
                <tr>
                  <td style="width: 25%">Description </td><td style="width: 75%"><textarea class="form-control" id="desc" name="desc" ng-model="groupInfo.desc"></textarea></td>
                </tr>
                </table>
              </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-success" type="submit" ng-disabled="listgroupitem.$invalid" ng-click="insertgroupitem()"><i class="fa fa-save"></i> Save</button>
        <button class="btn btn-danger" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i> Close</button>
      </div>
        </form>


    </div>
  </div>
</div>



<!--edit data item group-->
<!-- modal popup form data group-->
<div class="modal fade" id="geteditmodalgroup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display:none;">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
          <h4 id="myModalLabel" style="text-align: left;">Form Edit Item Group</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body" style="height: 400px !important; overflow:auto;">

            <form name="elistgroupitem" id="groupForm" ng-submit="updategroupitem(currgroupInfo)" method="POST">
              <div id="notif-datagroup"></div>
              <div class="table-responsive">
              <table class="table table-form">
                <tr>
                  <td style="width: 25%">Group ID *</td><td style="width: 75%"><input class="form-control" id="groupcode" name="group_code" ng-model="currgroupInfo.group_code" maxlength="10" type="text" readonly="readonly" required />

                   <div class="form-group">
                      <p class="text-danger" ng-show="elistgroupitem.group_code.$invalid && elistgroupitem.group_code.$dirty">Please Insert GroupID..!!!</p>
                    </div>

                  </td>
                </tr>
                <tr>
                  <td style="width: 25%">Group Name *</td><td style="width: 75%"><input class="form-control" id="groupname" name="group_name" ng-model="currgroupInfo.group_name" type="text" value="{{currgroupInfo.GroupName}}" required />

                   <div class="form-group">
                      <p class="text-danger" ng-show="elistgroupitem.group_name.$invalid && elistgroupitem.group_name.$dirty">Please Insert GroupID..!!!</p>
                   </div>

                  </td>
                </tr>
                <tr>
                  <td style="width: 25%">Description </td><td style="width: 75%"><textarea class="form-control" id="desc" name="desc" ng-model="currgroupInfo.desc">{{currgroupInfo.Description}}</textarea></td>
                </tr>
                </table>
              </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-success" type="submit" ng-disabled="elistgroupitem.$invalid" ng-click="updategroupitem(currgroupInfo)"><i class="fa fa-save"></i> Save</button>
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








