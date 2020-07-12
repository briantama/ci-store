<div class="main-grid" ng-controller="mainAppUser">
    <h3><?php echo $title; ?></h3><br>
      <div class="agile-grids"> 
        <!-- tables -->
        
        <!-- <div class="table-heading">
          <h2>Basic Tables</h2>
        </div> -->
        <div class="agile-tables">
          <div class="w3l-table-info">
            <h3>
              <?php 
                  if($this->session->userdata('supuser') == "Y"){
              ?>
              <a data-toggle="modal" data-target="#getmodaluser" ng-click="showFormAdmin()" class="btn btn-primary"><i class="fa fa-plus" ng-show="show_form"></i> Add</a>
              <!-- <a href="<?php echo base_url('merk/viewMerk/print'); ?>" target="_BLANK" class="btn btn-success"><i class="fa fa-print"></i> Print</a> -->
              <?php
                }
              ?>

            </h3>
              <div class="table-responsive" style="height:400px;">
              <table datatable="ng" dt-options="vm.dtOptions" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Edit</th>
                  <th>AdminID</th>
                  <th>AdminName</th>
                  <th>DateOfBirth</th>
                  <th>UserName</th>
                  <th>email</th>
                  <th>SuperUser</th>
                  <th>IsActive</th>
                  <th>EntryDate</th>
                  <th>EntryBy</th>
                  <th>LastUpdateDate</th>
                  <th>LastUpdateBy</th>
                </tr>
                </thead>
                <tbody>

              

                <tr ng-repeat="detailuser in details">
                  <td nowrap> 
                    <a data-toggle="modal" data-target="#getmodaluser" ng-click="editUserAdmin(detailuser)" class="btn btn-warning" title="Edit"><i class="fa fa-edit"></i> </a> 
                    <a ng-click="deleteUserAdmin(detailuser.AdminID)" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?');" class="btn btn-danger" title="Delete"><i class="fa fa-trash"></td>
                  <td>{{detailuser.AdminID}}</td>
                  <td>{{detailuser.AdminName}}</td>
                  <td>{{detailuser.DateOfBirth}}</td>
                  <td>{{detailuser.UserName}}</td>
                  <td>{{detailuser.email}}</td>
                  <td>{{detailuser.SuperUser}}</td>
                  <td>{{detailuser.IsActive}}</td>
                  <td>{{detailuser.EntryDate}}</td>
                  <td>{{detailuser.EntryBy}}</td>
                  <td>{{detailuser.LastUpdateDate}}</td>
                  <td>{{detailuser.LastUpdateBy}}</td>
                </tr>

            
                
                </tbody>
                <tfoot>
                <tr>
                  <th>Edit</th>
                  <th>AdminID</th>
                  <th>AdminName</th>
                  <th>DateOfBirth</th>
                  <th>UserName</th>
                  <th>email</th>
                  <th>SuperUser</th>
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


<!-- modal popup form data user-->
<div class="modal fade" id="getmodaluser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
          <h4 id="myModalLabel" style="text-align: left;">Form User </h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body" style="height: 400px !important; overflow:auto;">


            <form name="listuser" id="groupForm" ng-submit="insertUserAdmin()" method="POST">

              <!-- notif alert success or not -->
               <div class="alert alert-info" ng-show="show_userMsg">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                  <span class="fa fa-info"></span>&nbsp;&nbsp;{{notifikasiuserMsg}}
              </div>

              <input id="idadmin" style="display: none;" name="idadmin" maxlength="10" type="text" ng-model="userInfo.idadmin"/>
              <div id="notif-datagroup"></div>
              <div class="table-responsive">
              <table class="table table-form">
                <tr>
                  <td style="width: 25%">Admin Name *</td><td style="width: 75%"><input class="form-control" id="adminname" name="admin_name" ng-model="userInfo.admin_name" maxlength="100" type="text" required />

                   <div class="form-group">
                      <p class="text-danger" ng-show="listuser.admin_name.$invalid && listuser.admin_name.$dirty">Please Insert Name..!!!</p>
                    </div>

                  </td>
                </tr>
                <tr>
                  <td style="width: 25%">Email *</td><td style="width: 75%"><input class="form-control" id="email" name="email" ng-model="userInfo.email" type="email" value="" required />

                   <div class="form-group">
                      <p class="text-danger" ng-show="listuser.email.$invalid && listuser.email.$dirty">Please Insert Email..!!!</p>
                   </div>

                  </td>
                </tr>
                <tr>
                  <td style="width: 25%">DateOfBirth *</td><td style="width: 75%"><input class="form-control" id="dateof" name="date_of" ui-date="dateOptions" ng-model="userInfo.date_of" type="text"  required />

                   <div class="form-group">
                      <p class="text-danger" ng-show="listuser.date_of.$invalid && listuser.date_of.$dirty">Please Insert Date Of Birth..!!!</p>
                   </div>

                  </td>
                </tr>
                <tr>
                  <td style="width: 25%">UserName {{readuser}}*</td><td style="width: 75%">
                    <div ng-if="readuser">
                      <input class="form-control" id="username" name="username" ng-model="userInfo.username" readonly="readonly" type="text" value="" required />
                    </div>
                    <div ng-if="!readuser">
                      <input class="form-control" id="username" name="username" ng-model="userInfo.username" type="text" value="" required />
                    </div>

                   <div class="form-group">
                      <p class="text-danger" ng-show="listuser.username.$invalid && listuser.username.$dirty">Please Insert UserName..!!!</p>
                   </div>

                  </td>
                </tr>
                <tr>
                  <td style="width: 25%">Password *</td><td style="width: 75%"><input class="form-control" id="password" name="password" ng-model="userInfo.password" type="password" value="" />

                   <!-- <div class="form-group">
                      <p class="text-danger" ng-show="listuser.password.$invalid && listuser.password.$dirty">Please Insert Password..!!!</p>
                   </div> -->

                  </td>
                </tr>
                <tr>
                  <td style="width: 25%">Re-Password *</td><td style="width: 75%"><input class="form-control" id="repassword" name="repassword" ng-model="userInfo.repassword" type="password" value="" />

                   <!-- <div class="form-group">
                      <p class="text-danger" ng-show="listuser.repassword.$invalid && listuser.repassword.$dirty">Please Insert Re-Password..!!!</p>
                   </div> -->

                  </td>
                </tr>
                <tr>
                  <td style="width: 25%">SuperUser *</td>
                  <td style="width: 75%">

                     <select name="supuser" id="supuser" ng-model="userInfo.supuser" class="form-control">
                            <option value="N">No</option>
                             <?php 
                                if($this->session->userdata('supuser') == "Y"){
                            ?>
                            <option value="Y">Yes</option>
                            <?php
                            }
                            ?>

                        </select>

                  </td>
                </tr>
                
                </table>
              </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-success" type="submit" ng-disabled="listuser.$invalid" ng-click="insertUserAdmin()"><i class="fa fa-save"></i> Save</button>
        <button class="btn btn-danger" data-dismiss="modal" aria-hidden="true"><i class="fa fa-sign-out-alt"></i> Close</button>
      </div>
        </form>


    </div>
  </div>
</div>


<!--  -->



<!-- notif alert success or not -->
<div class="shownotifmsg" ng-show="show_Msg">
  <div class="alert alert-info">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
      <span class="fa fa-info"></span>&nbsp;&nbsp;{{notifikasiMsg}}
  </div>
</div>


</div> <!-- mainpp controller-->












