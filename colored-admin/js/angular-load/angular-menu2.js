//load page 
var mainAngular = angular.module('mainApp',['ngRoute', 'ngAnimate', 'datatables', 'ngSanitize']);
var base_url    = window.location.origin;

mainAngular.config(function ($routeProvider, $locationProvider) {
    $routeProvider
        .when('/dasbor',{
            templateUrl: base_url+'/ci-store/dasbor/dasbor_page'
        })
        .when('/page2',{
            templateUrl: base_url+'/ci-store/mastergroup/pagesecond'
        })
        .when('/page3',{
            templateUrl: base_url+'/ci-store/mastergroup/pagethird'
        })
        .when('/page-group',{
            templateUrl: base_url+'/ci-store/mastergroup/viewMastergroup'
        })
        .when('/page-supplier',{
            templateUrl: base_url+'/ci-store/mastersupplier/viewMastersupplier'
        })
         .when('/page-item',{
            templateUrl: base_url+'/ci-store/masteritem/viewMasteritem'
        })
        .when('/page-purchaseorder',{
            templateUrl: base_url+'/ci-store/purchaseorder/viewPurchaseOrder'
        })
        .when('/page-sale',{
            templateUrl: base_url+'/ci-store/sale/viewSale'
        })
        .when('/page-profile',{
            templateUrl: base_url+'/ci-store/profile/viewProfile'
        })
        .when('/page-user',{
            templateUrl: base_url+'/ci-store/user/viewUser'
        })
        .when('/page-reportpurchase',{
            templateUrl: base_url+'/ci-store/reportpurchase/viewReportPurchase'
        })
        .when('/page-reportsale',{
            templateUrl: base_url+'/ci-store/reportsale/viewReportSale'
        })
        .otherwise({
            redirectTo: '/dasbor'
        });

    $locationProvider.hashPrefix('');

});

// load datatable data group
//var ProdiApp = angular.module('MasterGroupApp', ['datatables']);
// mainAngular.controller("mainAppController", function($scope,$http){
//     $scope.details=[]; 
//     $http({
//             method: 'GET',
//             url: base_url+"/ci-store/mastergroup/viewMastergroup/view-ang"
//         }).then(function(response){
//                     console.log(response);
//                     $scope.details = response.data;
//                 });
  
// //enable form data group
//     $scope.show_form = true;

  
// });

// controller data group
mainAngular.controller("mainAppController",['$scope','$http', function($scope,$http){

    // ** Prodi ** /
    // Function untuk menampilkan data prodi dari database
    getGroup();
    function getGroup(){

        $scope.details=[]; 
        $http({
                method: 'GET',
                url: base_url+"/ci-store/mastergroup/viewMastergroup/view-ang"
            }).then(function(response){
                        console.log(response);
                        $scope.details = response.data;
                    });
 
    }
    
    // Mengaktifkan form input prodi
    $scope.show_form = true;
    $scope.testxxx  = "angular-runing";

    // Function untuk input data prodi dari database
    // $scope.info=[]; 
    // $scope.insertgroupitem = function(info){
    //     console.log("aaaaaaa");
    //     // Melakukan permintaan data prodi melalui inputProdi.php 
    //     $http.post(base_url+'/ci-store/mastergroup/viewMastergroup/save',{"group_code":info.group_code,"group_name":info.group_name,"desc":info.desc}).success(function(data){
            
    //         if (data == true) {
    //             getGroup();             
    //             $("#getmodalgroup").modal('hide');
    //         }
    //         location.reload();
    //     });
    // }

    //INSERT group data
    $scope.groupInfo = {};
     $scope.insertgroupitem = function(){
      $http({
       method:"POST",
       url: base_url+"/ci-store/mastergroup/viewMastergroup/save",
       data:$scope.groupInfo,
      }).then(function(response){
        console.log(response);
            if (response.data.status == "ok") {
                getGroup();             
                $("#getmodalgroup").modal('hide');

                //aktifkan notif alert
                //$scope.show_Msg  = true;
                //console.log(response.data.notif);
                $scope.notifikasiMsg = response.data.notif;
                $scope.show_Msg = true;
                setTimeout(function () 
                {
                    $scope.$apply(function()
                    {
                       $scope.show_Msg = false;
                    });
                }, 5000);
                //end alert

            }
            else{
                console.log(response);
            }
            //location.reload();
      });
    }


    //delete group data
    $scope.deletegroupitem = function(param){
        console.log(param);
        // var codeid = this.groupInfo.group_code;
        // // Melakukan delete data prodi melalui deleteProdi.php
        $http({
           method:"POST",
           url: base_url+"/ci-store/mastergroup/viewMastergroup/delete/"+param,
           data:$scope.groupInfo,
          }).then(function(response){
            console.log(response);
                if (response.data.status == "ok") {
                    getGroup();             

                    //aktifkan notif alert
                    //$scope.show_Msg  = true;
                    $scope.notifikasiMsg = response.data.caption;
                    $scope.show_Msg = true;
                    setTimeout(function () 
                    {
                     $scope.$apply(function()
                     {
                       $scope.show_Msg = false;
                     });
                    }, 5000);
                    //end alert

                }
                else{
                    console.log(response);
                }
          });
    }



    // Memanggil data group yang akan diedit
    
    $scope.editgroupitem = function(info){
        console.log(info);
        $scope.currgroupInfo = info;  
        $scope.currgroupInfo.group_code = info.CodeGroupID;
        $scope.currgroupInfo.group_name = info.GroupName;
        $scope.currgroupInfo.desc       = info.Description;  
        //console.log(info.CodeGroupID);
           //$scope.lastname = last_name;  
           //$scope.btnName = "Update";    
        //$('#editProdi').modal(hide);
    }

    //Update data group
    //$scope.updategroupInfo = {};
    $scope.currgroupInfo = {};
    $scope.updategroupitem = function(){
        // Melakukan update data group 
       $http({
           method:"POST",
           url: base_url+"/ci-store/mastergroup/viewMastergroup/save",
           data:$scope.currgroupInfo,
          }).then(function(response){
            console.log(response);
                if (response.data.status == "ok") {
                    getGroup();//reload table group             
                    $("#geteditmodalgroup").modal('hide');//close popup

                    //aktifkan notif alert
                    //$scope.show_Msg  = true;
                    $scope.notifikasiMsg = response.data.notif;
                    $scope.show_Msg = true;
                    setTimeout(function () 
                    {
                     $scope.$apply(function()
                     {
                       $scope.show_Msg = false;
                     });
                    }, 5000);
                    //end alert


                }
                else{
                    console.log(response);
                }
                //location.reload();
        });

       
    }

    //getnumbering data group
    $scope.numberinggroup=[]; 
        $http({
                method: 'GET',
                url: base_url+"/ci-store/mastergroup/viewMastergroup/getnumber"
            }).then(function(response){
                        console.log(response);
                        $scope.numberinggroup       = response.data.GetID;
                        $scope.groupInfo.group_code = response.data.GetID;
                    });


    $scope.popupPrintGroup = function(param) {
        window.open(base_url+param,'_blank');
    }


}]);
// end controller data group




//controller data supplier
mainAngular.controller("mainAppSupplier",['$scope','$http', function($scope,$http){

    // ** supplier ** /
    // Function untuk menampilkan data supplier dari database
    getSupplier();
    function getSupplier(){

        $scope.details=[]; 
        $http({
                method: 'GET',
                url: base_url+"/ci-store/mastersupplier/viewMastersupplier/view-ang"
            }).then(function(response){
                        console.log(response);
                        $scope.details = response.data;
                    });
 
    }
    
    // Mengaktifkan form input SUPPLIER
    $scope.show_form = true;
    $scope.testxxx  = "angular-runing";


    //INSERT supplier data
    $scope.supplierInfo = {};
     $scope.insertsupplier = function(){
      $http({
       method:"POST",
       url: base_url+"/ci-store/mastersupplier/viewMastersupplier/save",
       data:$scope.supplierInfo,
      }).then(function(response){
        //console.log(response);
            if (response.data.status == "ok") {
                getSupplier();             
                $("#getmodalsupplier").modal('hide');

                //aktifkan notif alert
                //$scope.show_Msg  = true;
                $scope.notifikasiMsg = response.data.notif;
                $scope.show_Msg = true;
                setTimeout(function () 
                {
                    $scope.$apply(function()
                    {
                       $scope.show_Msg = false;
                    });
                }, 5000);
                //end alert

            }
            else{
                console.log(response);
            }
            //location.reload();
      });
    }

    //getnumbering data supplier
    $scope.numberinggroup=[]; 
        $http({
                method: 'GET',
                url: base_url+"/ci-store/mastersupplier/viewMastersupplier/getnumber"
            }).then(function(response){
                        console.log(response);
                        $scope.numberingsupplier        = response.data.GetID;
                        $scope.supplierInfo.supplier_id = response.data.GetID;
                    });


    //delete group data
    $scope.deletesupplier = function(param){
        console.log(param);
        //Melakukan delete data memlalui paramater param
        $http({
           method:"POST",
           url: base_url+"/ci-store/mastersupplier/viewMastersupplier/delete/"+param,
           data:$scope.supplierInfo,
          }).then(function(response){
            console.log(response);
                if (response.data.status == "ok") {
                    getSupplier();             

                    //aktifkan notif alert
                    //$scope.show_Msg  = true;
                    $scope.notifikasiMsg = response.data.caption;
                    $scope.show_Msg = true;
                    setTimeout(function () 
                    {
                     $scope.$apply(function()
                     {
                       $scope.show_Msg = false;
                     });
                    }, 5000);
                    //end alert

                }
                else{
                    console.log(response);
                }
          });
    }



    // Memanggil data supplier yang akan diedit
    $scope.editsupplier = function(info){
        console.log(info);
        $scope.currsupplierInfo               = info;  
        $scope.currsupplierInfo.supplier_id   = info.SupplierID;
        $scope.currsupplierInfo.supplier_name = info.SupplierName;
        $scope.currsupplierInfo.desc          = info.Description;  
    }


    //update data 
    $scope.currsupplierInfo = {};
    $scope.updatesupplier   = function(){
        // Melakukan update data group 
       $http({
           method:"POST",
           url: base_url+"/ci-store/mastersupplier/viewMastersupplier/save",
           data:$scope.currsupplierInfo,
          }).then(function(response){
            console.log(response);
                if (response.data.status == "ok") {
                    getSupplier();//reload table supplier             
                    $("#geteditmodalsupplier").modal('hide');//close popup

                    //aktifkan notif alert
                    //$scope.show_Msg  = true;
                    $scope.notifikasiMsg = response.data.notif;
                    $scope.show_Msg = true;
                    setTimeout(function () 
                    {
                     $scope.$apply(function()
                     {
                       $scope.show_Msg = false;
                     });
                    }, 5000);
                    //end alert


                }
                else{
                    console.log(response);
                }
                //location.reload();
        });

    }


     $scope.popupPrintSupplier = function(param) {
        window.open(base_url+param,'_blank');
    }


}]);
//end controller data supplier





//controller data item
mainAngular.controller("mainAppItem",['$scope','$http', function($scope,$http){

    // ** item ** /
    // Function untuk menampilkan data item dari database
    getItem();
    function getItem(){

        $scope.details=[]; 
        $http({
                method : 'GET',
                url    : base_url+"/ci-store/masteritem/viewMasteritem/view-ang"
            }).then(function(response){
                        console.log(response);
                        $scope.details = response.data;
                    });
 
    }
    
    // Mengaktifkan form input item
    $scope.show_form = true;
    $scope.testxxx   = "angular-runing";


    //getnumbering data item
    $scope.itemInfo ={};
    $scope.numberinggroup=[]; 
        $http({
                method: 'GET',
                url: base_url+"/ci-store/masteritem/viewMasteritem/getnumber"
            }).then(function(response){
                        console.log(response);
                        $scope.numberingitem            = response.data.GetID;
                        $scope.itemInfo.item_id         = response.data.GetID;
                    });


    // Insert Data and Upload Image
    $scope.listitem =[];
    $scope.files    =[];
    $scope.insertitem=function(info){
        $scope.photo=$scope.files[0];       
        
        // Melakukan input data item 
        $http({
                method      :'POST',
                url         :base_url+"/ci-store/masteritem/viewMasteritem/save",
                processData :false,
                transformRequest:function(data){
                    var formData=new FormData();
                    
                    formData.append("itemid", info.item_id);
                    formData.append("itemname", info.item_name);
                    formData.append("groupid", info.group_id);
                    formData.append("shortitem", info.short_item);
                    formData.append("pulprice", info.pur_price);    
                    formData.append("selprice", info.sel_price);   
                    formData.append("stock", info.stock);
                    formData.append("desc", info.desc);                                                
                    formData.append("photo", $scope.photo);

                return formData;
                //return $scope.item_id;
                                            
              },  
              data : $scope.listitem,
              headers: {
                     'Content-Type': undefined
              }
        }).then(function(response){
            $scope.show_form = true;
            console.log(response);
            if (response.data.status == "ok") {
                getItem();
                $("#getmodalitem").modal('hide');

                //aktifkan notif alert
                $scope.notifikasiMsg = response.data.notif;
                $scope.show_Msg = true;
                setTimeout(function () 
                {
                    $scope.$apply(function()
                {
                    $scope.show_Msg = false;
                });
                }, 5000);
                //end alert

            }
            else if (response.data.status == "failed") {
                //console.log("Failed Upload");
                //console.log(response);
                //getItem();
                //$("#getmodalitem").modal('hide');

                //aktifkan notif alert
                $scope.show_uploadMsg      = true;
                $scope.notifikasiuploadMsg = response.data.msg;
            
                setTimeout(function () 
                {
                    $scope.$apply(function()
                {
                    $scope.show_uploadMsg = false;
                });
                }, 5000);
                //end alert

                //set focus
                var element = angular.element("#"+response.data.focus);
                element.focus()

            }
            else{
                console.log(response);
            }
            //location.reload();    
        });
           
    }
    
    // Menampilkan data gambar baru dan meng-upload kedalam server  
    $scope.uploadedFileInput=function(element){
        $scope.currentFile = element.files[0];
        var reader = new FileReader();

        reader.onload = function(event) {
            var output = document.getElementById('output1');
                output.src = URL.createObjectURL(element.files[0]);
    
            $scope.image_source = event.target.result
            $scope.$apply(function($scope) {
                $scope.files = element.files;
            });
        }
        
        reader.readAsDataURL(element.files[0]);
    }



    // Insert Data and Upload Image
    $scope.elistitem =[];
    $scope.files    =[];
    $scope.updateitem=function(info){
        $scope.photo=$scope.files[0];       
        
        // Melakukan input data item 
        $http({
                method      :'POST',
                url         :base_url+"/ci-store/masteritem/viewMasteritem/save",
                processData :false,
                transformRequest:function(data){
                    var formData=new FormData();
                    
                    formData.append("itemid", info.item_id);
                    formData.append("itemname", info.item_name);
                    formData.append("groupid", info.group_id);
                    formData.append("shortitem", info.short_item);
                    formData.append("pulprice", info.pur_price);    
                    formData.append("selprice", info.sel_price);   
                    formData.append("stock", info.stock);
                    formData.append("desc", info.desc);                                                
                    formData.append("photo", $scope.photo);

                return formData;
                //return $scope.item_id;
                                            
              },  
              data : $scope.listitem,
              headers: {
                     'Content-Type': undefined
              }
        }).then(function(response){
            $scope.show_form = true;
            console.log(response);
            if (response.data.status == "ok") {
                getItem();
                $("#geteditmodalitem").modal('hide');

                //aktifkan notif alert
                $scope.notifikasiMsg = response.data.notif;
                $scope.show_Msg = true;
                setTimeout(function () 
                {
                    $scope.$apply(function()
                {
                    $scope.show_Msg = false;
                });
                }, 5000);
                //end alert

            }
            else{
                console.log(response);
            }
            //ocation.reload();    
        });
           
    }



    // Memanggil data yang akan diedit
    $scope.edititem = function(info){
        console.log(info);
        $scope.show_statusdata           = false;
        $scope.curitemInfo               = info;  
        $scope.curitemInfo.item_id       = info.ItemID;
        $scope.curitemInfo.item_name     = info.ItemName;
        $scope.curitemInfo.group_id      = info.GroupID;
        $scope.curitemInfo.short_item    = info.ShortItem;
        $scope.curitemInfo.pur_price     = parseInt(info.PurchasePrice);
        $scope.curitemInfo.sel_price     = parseInt(info.SellingPrice);
        $scope.curitemInfo.stock         = parseInt(info.Stock);
        $scope.curitemInfo.desc          = info.Description;
        $scope.curitemInfo.photo         = info.ItemImage;

        if(info.IsActive == "N"){
            $scope.show_statusdata = true;
            $scope.statusdata      = "*Record Is Deleted";
        }
        else{
            $scope.statusdata = "";
        }  
    }



    // Menampilkan data gambar baru dan meng-upload kedalam server
    $scope.uploadedFile=function(element){
        $scope.currentFile = element.files[0];
        var reader = new FileReader();

        reader.onload = function(event) {
            var output = document.getElementById('output2');
                output.src = URL.createObjectURL(element.files[0]);
    
            $scope.image_source = event.target.result
            $scope.$apply(function($scope) {
            $scope.files = element.files;
            });
        }
        reader.readAsDataURL(element.files[0]);
    }




    //delete group data
    $scope.deleteitem = function(param){
        console.log(param);
        //Melakukan delete data memlalui paramater param
        $http({
           method:"POST",
           url: base_url+"/ci-store/masteritem/viewMasteritem/delete/"+param,
           data:{"itemid" : param},
          }).then(function(response){
            console.log(response);
                if (response.data.status == "ok") {
                    getItem();             

                    //aktifkan notif alert
                    //$scope.show_Msg  = true;
                    $scope.notifikasiMsg = response.data.caption;
                    $scope.show_Msg = true;
                    setTimeout(function () 
                    {
                     $scope.$apply(function()
                     {
                       $scope.show_Msg = false;
                     });
                    }, 5000);
                    //end alert

                }
                else{
                    console.log(response);
                }
          });
    }


    // Fetch report item
    $scope.fetchGroup = function(){
        
        if($scope.itemInfo.group_id){        
            var searchText_len = $scope.itemInfo.group_id.trim().length;
            //alert(searchText_len);

            // Check search text length
            if(searchText_len > 0)
            {
                $http({
                        method: 'post',
                        url: base_url+"/ci-store/masteritem/viewMasteritem/searchgroup",
                        data: {searchText:$scope.itemInfo.group_id}
                    }).then(function successCallback(response) {
                            console.log(response);
                            $scope.searchResult = response.data;
                        });
            }
            else
            {
                $scope.searchResult       = {};
                $scope.itemInfo.group_id  = "";
                var element = angular.element("#group_id");
                element.focus()
            }
        }
        else
        {
            $scope.searchResult       = {};
            $scope.itemInfo.group_id  = "";
        }     
    }

    // Set value to search box
    $scope.setValueGroup = function(index,$event){
        $scope.itemInfo.group_id      = $scope.searchResult[index].keygroup;
        $scope.searchResult           = {};
        $event.stopPropagation();
        var element = angular.element("#shortitem");
        element.focus()
    }

    $scope.searchboxGroup = function($event){
        $event.stopPropagation();
    }


     $scope.popupPrintItem = function(param) {
        window.open(base_url+param,'_blank');
    }


}]);
//end controller data item





//controller data Purchase Order
mainAngular.controller("mainAppPurchaseOrder",['$scope','$http', function($scope,$http){

    // ** item ** /
    // Function untuk menampilkan data user dari database
    getPurchaseOrder();
    function getPurchaseOrder(){

        $scope.details=[]; 
        $http({
                method : 'GET',
                url    : base_url+"/ci-store/purchaseorder/viewPurchaseOrder/view-ang"
            }).then(function(response){
                        console.log(response);
                        $scope.details = response.data;
                    });
 
    }


    // Mengaktifkan form input item
    $scope.show_form = true;
    $scope.testxxx   = "angular-runing";



    //getnumbering data purchase
    //$scope.purchaseInfo     ={};
    $scope.numberingpurchase=[]; 
        $http({
                method: 'GET',
                url: base_url+"/ci-store/purchaseorder/viewPurchaseOrder/getnumber"
            }).then(function(response){
                        console.log(response);
                        $scope.numberingpurchase          = response.data.GetID;
                        $scope.purchaseInfo.purorder      = response.data.GetID;
                    });

    //get detail po detail
    function getPurchaseOrderDetail(param){
        //console.log(param);
        //console.log("oke");
        $scope.detailspo=[]; 
        $http({
                method : 'GET',
                url    : base_url+"/ci-store/purchaseorder/viewPurchaseOrder/view-detail/"+param
            }).then(function(response){
                        console.log(response);
                        $scope.detailspo = response.data;
                    });
 
    }


   //show popup purchase order
   $scope.showPopupPO=function(){
    $scope.show_form = true;
    $("#getmodalpurchase").modal('show');
    var idx = angular.element(document.querySelector('#purorder')).val();//mengambil id nominal
    $scope.totalnew = 0; //kembalikan default nilai tottal detail po
    //console.log(idx)
    getPurchaseOrderDetail(idx);
   }


   //INSERT purchaseorder detail
    $scope.purchaseInfo = {};
     $scope.insertPurchaseDetail = function(){
      $http({
       method:"POST",
       url: base_url+"/ci-store/purchaseorder/viewPurchaseOrder/save-detail",
       data:$scope.purchaseInfo,
      }).then(function(response){
        //console.log(response);
            if (response.data.status == "ok") {
                var idx = angular.element(document.querySelector('#purorder')).val();//mengambil id nominal
                getPurchaseOrderDetail(idx);  
                getPurchaseOrder();           
                $scope.totalnew   = 0; //kembalikan default nilai tottal detail po

                //aktifkan notif alert
                $scope.notifikasiPOMsg = response.data.notif;
                $scope.show_POMsg = true;
                setTimeout(function () 
                {
                    $scope.$apply(function()
                    {
                       $scope.show_POMsg = false;
                    });
                }, 5000);
                //end alert

            }
            else if (response.data.status == "failed") {       
                
                //aktifkan notif alert
                $scope.notifikasiPOMsg = response.data.notif;
                $scope.show_POMsg = true;
                setTimeout(function () 
                {
                    $scope.$apply(function()
                    {
                       $scope.show_POMsg = false;
                    });
                }, 5000);
                //end alert

            }
            else{
                console.log(response);
            }
            //location.reload();
      });
    }



    //INSERT purchaseorder edit from PO
    $scope.purchaseInfo = {};
     $scope.insertPurchase = function(){
      $http({
       method:"POST",
       url: base_url+"/ci-store/purchaseorder/viewPurchaseOrder/save",
       data:$scope.purchaseInfo,
      }).then(function(response){
        //console.log(response);
            if (response.data.status == "ok") {
                var idx = angular.element(document.querySelector('#purorder')).val();//mengambil id nominal
                getPurchaseOrder();  
                 $("#getmodalpurchase").modal('hide');         
                $scope.totalnew   = 0; //kembalikan default nilai tottal detail po

                //aktifkan notif alert
                $scope.notifikasiMsg = response.data.notif;
                $scope.show_Msg = true;
                setTimeout(function () 
                {
                    $scope.$apply(function()
                    {
                       $scope.show_Msg = false;
                    });
                }, 5000);
                //end alert

            }
            else if (response.data.status == "failed") {       
                
                //aktifkan notif alert
                $scope.notifikasiPOMsg = response.data.notif;
                $scope.show_POMsg = true;
                setTimeout(function () 
                {
                    $scope.$apply(function()
                    {
                       $scope.show_POMsg = false;
                    });
                }, 5000);
                //end alert

            }
            else{
                console.log(response);
            }
            //location.reload();
      });
    }



    // Memanggil data yang akan diedit
    $scope.editPurchaseOrder = function(info){
        console.log(info);
        //$scope.show_statusdata           = false;
        $scope.totaledit                     = 0; //kembalikan default nilai tottal detail po
        $scope.curpurchaseInfo               = info;  
        $scope.curpurchaseInfo.purorder      = info.PurchaseOrderID
        $scope.curpurchaseInfo.purchasedate  = info.PurchaseDate
        $scope.curpurchaseInfo.supplierid    = info.SupplierID
        getPurchaseOrderDetail($scope.curpurchaseInfo.purorder);

        // if(info.IsActive == "N"){
        //     $scope.show_statusdata = true;
        //     $scope.statusdata      = "*Record Is Deleted";
        // }
        // else{
        //     $scope.statusdata = "";
        // }  
    }

    //INSERT purchaseorder edit from PO
    $scope.curpurchaseInfo = {};
     $scope.insertPurchaseEdit = function(){
      $http({
       method:"POST",
       url: base_url+"/ci-store/purchaseorder/viewPurchaseOrder/save",
       data:$scope.curpurchaseInfo,
      }).then(function(response){
        //console.log(response);
            if (response.data.status == "ok") {
                var idx = angular.element(document.querySelector('#purorder')).val();//mengambil id nominal
                getPurchaseOrder();  
                 $("#geteditmodalpurchase").modal('hide');         
                $scope.totalnew   = 0; //kembalikan default nilai tottal detail po

                //aktifkan notif alert
                $scope.notifikasiMsg = response.data.notif;
                $scope.show_Msg = true;
                setTimeout(function () 
                {
                    $scope.$apply(function()
                    {
                       $scope.show_Msg = false;
                    });
                }, 5000);
                //end alert

            }
            else if (response.data.status == "failed") {       
                
                //aktifkan notif alert
                $scope.notifikasiPOMsg = response.data.notif;
                $scope.show_POMsg = true;
                setTimeout(function () 
                {
                    $scope.$apply(function()
                    {
                       $scope.show_POMsg = false;
                    });
                }, 5000);
                //end alert

            }
            else{
                console.log(response);
            }
            //location.reload();
      });
    }


    //INSERT purchaseorder detail
    $scope.curpurchaseInfo = {};
     $scope.updatePurchaseDetail = function(){
      $http({
       method:"POST",
       url: base_url+"/ci-store/purchaseorder/viewPurchaseOrder/save-detail",
       data:$scope.curpurchaseInfo,
      }).then(function(response){
        //console.log(response);
            if (response.data.status == "ok") {
                var idx = $scope.curpurchaseInfo.purorder;//mengambil id nominal
                getPurchaseOrderDetail(idx);  
                getPurchaseOrder(); 
                $scope.totaledit  = 0; //kembalikan default nilai tottal detail po          
                
                //aktifkan notif alert
                $scope.notifikasiPOMsg = response.data.notif;
                $scope.show_POMsg = true;
                setTimeout(function () 
                {
                    $scope.$apply(function()
                    {
                       $scope.show_POMsg = false;
                    });
                }, 5000);
                //end alert

            }
            else if (response.data.status == "failed") {       
                
                //aktifkan notif alert
                $scope.notifikasiPOMsg = response.data.notif;
                $scope.show_POMsg = true;
                setTimeout(function () 
                {
                    $scope.$apply(function()
                    {
                       $scope.show_POMsg = false;
                    });
                }, 5000);
                //end alert

            }
            else{
                console.log(response);
            }
            //location.reload();
      });
    }



    //delete DETAIL PO data
    $scope.deletedetailPO = function(param, itemx){
        //console.log(param);
        //Melakukan delete data memlalui paramater param
        $http({
           method:"POST",
           url: base_url+"/ci-store/purchaseorder/viewPurchaseOrder/delete-detail/"+param+"/"+itemx,
           data:{"purchaseorder" : param, "itemid" : itemx},
          }).then(function(response){
            console.log(response);
                if (response.data.status == "ok") {
                    getPurchaseOrderDetail(param); 
                    $scope.totaledit  = 0; //kembalikan default nilai tottal detail po       
                    $scope.totalnew   = 0; //kembalikan default nilai tottal detail po                    

                    //aktifkan notif alert
                    //$scope.show_Msg  = true;
                    $scope.notifikasiPOMsg = response.data.caption;
                    $scope.show_POMsg = true;
                    setTimeout(function () 
                    {
                     $scope.$apply(function()
                     {
                       $scope.show_POMsg = false;
                     });
                    }, 5000);
                    //end alert

                }
                else if (response.data.status == "failed") {
                    //aktifkan notif alert
                    //$scope.show_Msg  = true;
                    $scope.notifikasiPOMsg = response.data.caption;
                    $scope.show_POMsg = true;
                    setTimeout(function () 
                    {
                     $scope.$apply(function()
                     {
                       $scope.show_POMsg = false;
                     });
                    }, 5000);
                    //end alert

                }
                else{
                    console.log(response);
                }
          });
    }

    //penjumlahan form edit PO
    $scope.calcFormEditPO = function() {
        
        if(!$scope.curpurchaseInfo.purchaseprice){
             //alert
            $scope.notifikasiPOMsg    = "Please Insert Purchase Price !!!";
                    $scope.show_POMsg = true;
                    setTimeout(function () 
                    {
                     $scope.$apply(function()
                     {
                       $scope.show_POMsg = false;
                     });
                    }, 5000);

             //set focus
             $scope.curpurchaseInfo.amount = 0;
             var element = angular.element("#purchaseprice");
             element.focus()
        }
        else if($scope.curpurchaseInfo.amount < 0){
            //alert
            $scope.notifikasiPOMsg    = "Amount Less Than Zero !!!";
                    $scope.show_POMsg = true;
                    setTimeout(function () 
                    {
                     $scope.$apply(function()
                     {
                       $scope.show_POMsg = false;
                     });
                    }, 5000);

             //set focus
             $scope.curpurchaseInfo.amount = 0;
             var element = angular.element("#amount");
             element.focus()
        }
        else{
            $scope.curpurchaseInfo.total = $scope.curpurchaseInfo.purchaseprice * $scope.curpurchaseInfo.amount;
            console.log($scope.curpurchaseInfo.total);
        }

    }

    $scope.calcFormPO = function() {
        
        if(!$scope.purchaseInfo.purchaseprice){
             //alert
            $scope.notifikasiPOMsg    = "Please Insert Purchase Price !!!";
                    $scope.show_POMsg = true;
                    setTimeout(function () 
                    {
                     $scope.$apply(function()
                     {
                       $scope.show_POMsg = false;
                     });
                    }, 5000);

             //set focus
             $scope.purchaseInfo.amount = 0;
             var element = angular.element("#purchaseprice");
             element.focus()
        }
        else if($scope.purchaseInfo.amount < 0){
            //alert
            $scope.notifikasiPOMsg    = "Amount Less Than Zero !!!";
                    $scope.show_POMsg = true;
                    setTimeout(function () 
                    {
                     $scope.$apply(function()
                     {
                       $scope.show_POMsg = false;
                     });
                    }, 5000);

             //set focus
             $scope.purchaseInfo.amount = 0;
             var element = angular.element("#amount");
             element.focus()
        }
        else{
            $scope.purchaseInfo.total = $scope.purchaseInfo.purchaseprice * $scope.purchaseInfo.amount;
            console.log($scope.purchaseInfo.total);
        }

    }


    //autocomplete purchase order
    // Fetch data item
    $scope.fetchItemPO = function(){
                
        var searchText_len = $scope.purchaseInfo.itemid.trim().length;
        //alert(searchText_len);

        // Check search text length
        if(searchText_len > 0)
        {
            $http({
                    method: 'post',
                    url: base_url+"/ci-store/purchaseorder/viewPurchaseOrder/searchitem",
                    data: {searchText:$scope.purchaseInfo.itemid}
                }).then(function successCallback(response) {
                        console.log(response);
                        $scope.searchResult = response.data;
                    });
        }
        else
        {
            $scope.searchResult               = {};
            $scope.purchaseInfo.itemid        = "";
            $scope.purchaseInfo.itemname      = "";
            $scope.purchaseInfo.purchaseprice = "";
            $scope.purchaseInfo.amount        = "";
            $scope.purchaseInfo.total         = "";
            var element = angular.element("#itemid");
            element.focus()
        }
                
    }

    // Set value to search box
    $scope.setValueItemPO = function(index,$event){
        $scope.purchaseInfo.itemid        = $scope.searchResult[index].keyitem;
        $scope.purchaseInfo.itemname      = $scope.searchResult[index].itemname;
        $scope.purchaseInfo.purchaseprice = $scope.searchResult[index].purprice;
        $scope.searchResult               = {};
        $event.stopPropagation();
        var element = angular.element("#amount");
        element.focus()
    }

    $scope.searchboxItemPO = function($event){
        $event.stopPropagation();
    }

    //edit data item PO
    $scope.fetchEditItemPO = function(){
        
        if($scope.curpurchaseInfo.itemid){         
            var searchText_len = $scope.curpurchaseInfo.itemid.trim().length;
            //alert(searchText_len);

            // Check search text length
            if(searchText_len > 0)
            {
                $http({
                        method: 'post',
                        url: base_url+"/ci-store/purchaseorder/viewPurchaseOrder/searchitem",
                        data: {searchText:$scope.curpurchaseInfo.itemid}
                    }).then(function successCallback(response) {
                            console.log(response);
                            $scope.searchResult = response.data;
                        });
            }
            else
            {
                $scope.searchResult                  = {};
                $scope.curpurchaseInfo.itemid        = "";
                $scope.curpurchaseInfo.itemname      = "";
                $scope.curpurchaseInfo.purchaseprice = "";
                $scope.curpurchaseInfo.amount        = "";
                $scope.curpurchaseInfo.total         = "";
                var element = angular.element("#itemid");
                element.focus()
            }
        }
        else
        {
            $scope.searchResult                  = {};
            $scope.curpurchaseInfo.itemid        = "";
            $scope.curpurchaseInfo.itemname      = "";
            $scope.curpurchaseInfo.purchaseprice = "";
            $scope.curpurchaseInfo.amount        = "";
            $scope.curpurchaseInfo.total         = "";
        }
                
    }

    // Set value to search box
    $scope.setValueEditItemPO = function(index,$event){
        $scope.curpurchaseInfo.itemid        = $scope.searchResult[index].keyitem;
        $scope.curpurchaseInfo.itemname      = $scope.searchResult[index].itemname;
        $scope.curpurchaseInfo.purchaseprice = $scope.searchResult[index].purprice;
        $scope.searchResult               = {};
        $event.stopPropagation();
        var element = angular.element("#amount");
        element.focus()
    }




    // Fetch data supplier
    $scope.fetchSupplierPO = function(){
        
        if($scope.purchaseInfo.supplierid){        
            var searchText_len = $scope.purchaseInfo.supplierid.trim().length;
            //alert(searchText_len);

            // Check search text length
            if(searchText_len > 0)
            {
                $http({
                        method: 'post',
                        url: base_url+"/ci-store/purchaseorder/viewPurchaseOrder/searchsupplier",
                        data: {searchText:$scope.purchaseInfo.supplierid}
                    }).then(function successCallback(response) {
                            console.log(response);
                            $scope.searchResultsup = response.data;
                        });
            }
            else
            {
                $scope.searchResultsup            = {};
                $scope.purchaseInfo.supplierid    = "";
        
            }
        }
        else{
            $scope.searchResultsup            = {};
        }   
    }

    // Set value to search box
    $scope.setValueSupplierPO = function(index,$event){
        $scope.purchaseInfo.supplierid    = $scope.searchResultsup[index].keysupplier;
        $scope.searchResultsup            = {};
        $event.stopPropagation();
        var element = angular.element("#itemid");
        element.focus()
    }

    $scope.searchboxSupplierPO = function($event){
        $event.stopPropagation();
    }


    //edit data supplier
    $scope.fetchEditSupplierPO = function(){
        
        if($scope.curpurchaseInfo.supplierid){        
            var searchText_len = $scope.curpurchaseInfo.supplierid.trim().length;
            //alert(searchText_len);

            // Check search text length
            if(searchText_len > 0)
            {
                $http({
                        method: 'post',
                        url: base_url+"/ci-store/purchaseorder/viewPurchaseOrder/searchsupplier",
                        data: {searchText:$scope.curpurchaseInfo.supplierid}
                    }).then(function successCallback(response) {
                            console.log(response);
                            $scope.searchResultsup = response.data;
                        });
            }
            else
            {
                $scope.searchResultsup               = {};
                $scope.curpurchaseInfo.supplierid    = "";
        
            }
        }
        else{
            $scope.searchResultsup            = {};
        }   
    }

    // Set value to search box
    $scope.setValueEditSupplierPO = function(index,$event){
        $scope.curpurchaseInfo.supplierid = $scope.searchResultsup[index].keysupplier;
        $scope.searchResultsup            = {};
        $event.stopPropagation();
        var element = angular.element("#itemid");
        element.focus()
    }

    //end autocomplete


     $scope.popupPrintPO= function(param) {
        window.open(base_url+param,'_blank');
    }
    


}]);
//end controller data purchase order



//controller data Purchase Order
mainAngular.controller("mainAppSale",['$scope','$http', function($scope,$http){

    // ** item ** /
    // Function untuk menampilkan data user dari database
    getSale();
    function getSale(){

        $scope.details=[]; 
        $http({
                method : 'GET',
                url    : base_url+"/ci-store/sale/viewSale/view-ang"
            }).then(function(response){
                        console.log(response);
                        $scope.details = response.data;
                    });
 
    }


    // Mengaktifkan form input item
    $scope.show_form = true;
    $scope.testxxx   = "angular-runing";



    //getnumbering data sale
    $scope.numberingsale=[]; 
        $http({
                method: 'GET',
                url: base_url+"/ci-store/sale/viewSale/getnumber"
            }).then(function(response){
                        console.log(response);
                        $scope.numberingsale          = response.data.GetID;
                        $scope.saleInfo.sale          = response.data.GetID;
                    });

    //get detail po detail
    function getSaleDetail(param){
        //console.log(param);
        //console.log("oke");
        $scope.detailssl=[]; 
        $http({
                method : 'GET',
                url    : base_url+"/ci-store/sale/viewSale/view-detail/"+param
            }).then(function(response){
                        console.log(response);
                        $scope.detailssl = response.data;
                    });
 
    }


   //show popup purchase order
   $scope.showPopupSL=function(){
    $scope.show_form = true;
    $("#getmodalsale").modal('show');
    var idx = angular.element(document.querySelector('#sale')).val();//mengambil id nominal
    $scope.totalnew = 0; //kembalikan default nilai tottal detail sale
    //console.log(idx)
    getSaleDetail(idx);
   }


   //INSERT sale detail
    $scope.saleInfo = {};
     $scope.insertSaleDetail = function(){
      $http({
       method:"POST",
       url: base_url+"/ci-store/sale/viewSale/save-detail",
       data:$scope.saleInfo,
      }).then(function(response){
        //console.log(response);
            if (response.data.status == "ok") {
                var idx = angular.element(document.querySelector('#sale')).val();//mengambil id nominal
                getSaleDetail(idx);  
                getSale();           
                $scope.totalnew   = 0; //kembalikan default nilai tottal detail po

                //aktifkan notif alert
                $scope.notifikasiSLMsg = response.data.notif;
                $scope.show_SLMsg = true;
                setTimeout(function () 
                {
                    $scope.$apply(function()
                    {
                       $scope.show_SLMsg = false;
                    });
                }, 5000);
                //end alert

            }
            else if (response.data.status == "failed") {       
                
                //aktifkan notif alert
                $scope.notifikasiSLMsg = response.data.notif;
                $scope.show_SLMsg = true;
                setTimeout(function () 
                {
                    $scope.$apply(function()
                    {
                       $scope.show_SLMsg = false;
                    });
                }, 5000);
                //end alert

            }
            else{
                console.log(response);
            }
            //location.reload();
      });
    }



    //INSERT sale edit from sale
    $scope.saleInfo = {};
     $scope.insertSale = function(){
      $http({
       method:"POST",
       url: base_url+"/ci-store/sale/viewSale/save",
       data:$scope.saleInfo,
      }).then(function(response){
        //console.log(response);
            if (response.data.status == "ok") {
                var idx = angular.element(document.querySelector('#sale')).val();//mengambil id nominal
                getSale();  
                 $("#getmodalsale").modal('hide');         
                $scope.totalnew   = 0; //kembalikan default nilai tottal detail po

                //aktifkan notif alert
                $scope.notifikasiMsg = response.data.notif;
                $scope.show_Msg = true;
                setTimeout(function () 
                {
                    $scope.$apply(function()
                    {
                       $scope.show_Msg = false;
                    });
                }, 5000);
                //end alert

            }
            else if (response.data.status == "failed") {       
                
                //aktifkan notif alert
                $scope.notifikasiSLMsg = response.data.notif;
                $scope.show_SLMsg = true;
                setTimeout(function () 
                {
                    $scope.$apply(function()
                    {
                       $scope.show_SLMsg = false;
                    });
                }, 5000);
                //end alert

            }
            else{
                console.log(response);
            }
            //location.reload();
      });
    }



    // Memanggil data yang akan diedit
    $scope.editSale = function(info){
        console.log(info);
        //$scope.show_statusdata           = false;
        $scope.totaledit                 = 0; //kembalikan default nilai tottal detail sale
        $scope.cursaleInfo               = info;  
        $scope.cursaleInfo.sale          = info.SaleID
        $scope.cursaleInfo.saledate      = info.SaleDate
        getSaleDetail($scope.cursaleInfo.sale);
    }



    //INSERT purchaseorder edit from PO
    $scope.cursaleInfo = {};
     $scope.insertSaleEdit = function(){
      $http({
       method:"POST",
       url: base_url+"/ci-store/sale/viewSale/save",
       data:$scope.cursaleInfo,
      }).then(function(response){
        //console.log(response);
            if (response.data.status == "ok") {
                var idx = angular.element(document.querySelector('#purorder')).val();//mengambil id nominal
                getSale();  
                 $("#geteditmodalsale").modal('hide');         
                $scope.totalnew   = 0; //kembalikan default nilai tottal detail po

                //aktifkan notif alert
                $scope.notifikasiMsg = response.data.notif;
                $scope.show_Msg = true;
                setTimeout(function () 
                {
                    $scope.$apply(function()
                    {
                       $scope.show_Msg = false;
                    });
                }, 5000);
                //end alert

            }
            else if (response.data.status == "failed") {       
                
                //aktifkan notif alert
                $scope.notifikasiSLMsg = response.data.notif;
                $scope.show_SLMsg = true;
                setTimeout(function () 
                {
                    $scope.$apply(function()
                    {
                       $scope.show_SLMsg = false;
                    });
                }, 5000);
                //end alert

            }
            else{
                console.log(response);
            }
            //location.reload();
      });
    }


    //INSERT sale detail
    $scope.cursaleInfo = {};
     $scope.updateSaleDetail = function(){
      $http({
       method:"POST",
       url: base_url+"/ci-store/sale/viewSale/save-detail",
       data:$scope.cursaleInfo,
      }).then(function(response){
        //console.log(response);
            if (response.data.status == "ok") {
                var idx = $scope.cursaleInfo.sale;//mengambil id nominal
                getSaleDetail(idx);  
                getSale(); 
                $scope.totaledit  = 0; //kembalikan default nilai tottal detail SALE          
                
                //aktifkan notif alert
                $scope.notifikasiSLMsg = response.data.notif;
                $scope.show_SLMsg = true;
                setTimeout(function () 
                {
                    $scope.$apply(function()
                    {
                       $scope.show_SLMsg = false;
                    });
                }, 5000);
                //end alert

            }
            else if (response.data.status == "failed") {       
                
                //aktifkan notif alert
                $scope.notifikasiSLMsg = response.data.notif;
                $scope.show_SLMsg = true;
                setTimeout(function () 
                {
                    $scope.$apply(function()
                    {
                       $scope.show_SLMsg = false;
                    });
                }, 5000);
                //end alert

            }
            else{
                console.log(response);
            }
            //location.reload();
      });
    }



    //delete DETAIL PO data
    $scope.deletedetailsl = function(param, itemx){
        //console.log(param);
        //Melakukan delete data memlalui paramater param
        $http({
           method:"POST",
           url: base_url+"/ci-store/sale/viewSale/delete-detail/"+param+"/"+itemx,
           data:{"sale" : param, "itemid" : itemx},
          }).then(function(response){
            console.log(response);
                if (response.data.status == "ok") {
                    getSaleDetail(param); 
                    $scope.totaledit  = 0; //kembalikan default nilai tottal detail po       
                    $scope.totalnew   = 0; //kembalikan default nilai tottal detail po                    

                    //aktifkan notif alert
                    //$scope.show_Msg  = true;
                    $scope.notifikasiSLMsg = response.data.caption;
                    $scope.show_SLMsg = true;
                    setTimeout(function () 
                    {
                     $scope.$apply(function()
                     {
                       $scope.show_SLMsg = false;
                     });
                    }, 5000);
                    //end alert

                }
                else if (response.data.status == "failed") {
                    //aktifkan notif alert
                    //$scope.show_Msg  = true;
                    $scope.notifikasiPOMsg = response.data.caption;
                    $scope.show_POMsg = true;
                    setTimeout(function () 
                    {
                     $scope.$apply(function()
                     {
                       $scope.show_POMsg = false;
                     });
                    }, 5000);
                    //end alert

                }
                else{
                    console.log(response);
                }
          });
    }

    //penjumlahan form edit PO
    $scope.calcFormEditSL = function() {
        
        if(!$scope.cursaleInfo.sellingprice){
             //alert
            $scope.notifikasiSLMsg    = "Please Insert Purchase Price !!!";
                    $scope.show_SLMsg = true;
                    setTimeout(function () 
                    {
                     $scope.$apply(function()
                     {
                       $scope.show_SLMsg = false;
                     });
                    }, 5000);

             //set focus
             $scope.cursaleInfo.amount = 0;
             var element = angular.element("#sellingprice");
             element.focus()
        }
        else if($scope.cursaleInfo.amount < 0){
            //alert
            $scope.notifikasiSLMsg    = "Amount Less Than Zero !!!";
                    $scope.show_SLMsg = true;
                    setTimeout(function () 
                    {
                     $scope.$apply(function()
                     {
                       $scope.show_SLMsg = false;
                     });
                    }, 5000);

             //set focus
             $scope.cursaleInfo.amount = 0;
             var element = angular.element("#amount");
             element.focus()
        }
        else{
            $scope.cursaleInfo.total = $scope.cursaleInfo.sellingprice * $scope.cursaleInfo.amount;
            console.log($scope.cursaleInfo.total);
        }

    }

    $scope.calcFormSL = function() {
        
        if(!$scope.saleInfo.sellingprice){
             //alert
            $scope.notifikasiSLMsg    = "Please Insert Purchase Price !!!";
                    $scope.show_SLMsg = true;
                    setTimeout(function () 
                    {
                     $scope.$apply(function()
                     {
                       $scope.show_SLMsg = false;
                     });
                    }, 5000);

             //set focus
             $scope.saleInfo.amount = 0;
             var element = angular.element("#sellingprice");
             element.focus()
        }
        else if($scope.saleInfo.amount < 0){
            //alert
            $scope.notifikasiSLMsg    = "Amount Less Than Zero !!!";
                    $scope.show_SLMsg = true;
                    setTimeout(function () 
                    {
                     $scope.$apply(function()
                     {
                       $scope.show_SLMsg = false;
                     });
                    }, 5000);

             //set focus
             $scope.saleInfo.amount = 0;
             var element = angular.element("#amount");
             element.focus()
        }
        else{
            $scope.saleInfo.total = $scope.saleInfo.sellingprice * $scope.saleInfo.amount;
            console.log($scope.saleInfo.total);
        }

    }

    

    // Fetch data item
    $scope.fetchItemSL = function(){
        
        if($scope.saleInfo.itemid){        
            var searchText_len = $scope.saleInfo.itemid.trim().length;
            //alert(searchText_len);

            // Check search text length
            if(searchText_len > 0)
            {
                $http({
                        method: 'post',
                        url: base_url+"/ci-store/sale/viewSale/searchitem",
                        data: {searchText:$scope.saleInfo.itemid}
                    }).then(function successCallback(response) {
                            console.log(response);
                            $scope.searchResult = response.data;
                        });
            }
            else
            {
                $scope.searchResult           = {};
                $scope.saleInfo.itemid        = "";
                $scope.saleInfo.itemname      = "";
                $scope.saleInfo.sellingprice  = "";
                $scope.saleInfo.amount        = "";
                $scope.saleInfo.total         = "";
                var element = angular.element("#itemid");
                element.focus()
            }
        }
        else
        {
            $scope.searchResult           = {};
            $scope.saleInfo.itemid        = "";
            $scope.saleInfo.itemname      = "";
            $scope.saleInfo.sellingprice  = "";
            $scope.saleInfo.amount        = "";
            $scope.saleInfo.total         = "";
        }     
    }

    // Set value to search box
    $scope.setValueItemSL = function(index,$event){
        $scope.saleInfo.itemid        = $scope.searchResult[index].keyitem;
        $scope.saleInfo.itemname      = $scope.searchResult[index].itemname;
        $scope.saleInfo.sellingprice  = $scope.searchResult[index].selprice;
        $scope.searchResult           = {};
        $event.stopPropagation();
        var element = angular.element("#amount");
        element.focus()
    }

    $scope.searchboxItemSL = function($event){
        $event.stopPropagation();
    }

    // Fetch edit data item
    $scope.fetchEditItemSL = function(){
        
        if($scope.cursaleInfo.itemid){        
            var searchText_len = $scope.cursaleInfo.itemid.trim().length;
            //alert(searchText_len);

            // Check search text length
            if(searchText_len > 0)
            {
                $http({
                        method: 'post',
                        url: base_url+"/ci-store/sale/viewSale/searchitem",
                        data: {searchText:$scope.cursaleInfo.itemid}
                    }).then(function successCallback(response) {
                            console.log(response);
                            $scope.searchResult = response.data;
                        });
            }
            else
            {
                $scope.searchResult              = {};
                $scope.cursaleInfo.itemid        = "";
                $scope.cursaleInfo.itemname      = "";
                $scope.cursaleInfo.sellingprice  = "";
                $scope.cursaleInfo.amount        = "";
                $scope.cursaleInfo.total         = "";
                var element = angular.element("#itemid");
                element.focus()
            }
        }
        else
        {
            $scope.searchResult              = {};
            $scope.cursaleInfo.itemid        = "";
            $scope.cursaleInfo.itemname      = "";
            $scope.cursaleInfo.sellingprice  = "";
            $scope.cursaleInfo.amount        = "";
            $scope.cursaleInfo.total         = "";
        }     
    }

    // Set value to search box
    $scope.setValueEditItemSL = function(index,$event){
        $scope.cursaleInfo.itemid        = $scope.searchResult[index].keyitem;
        $scope.cursaleInfo.itemname      = $scope.searchResult[index].itemname;
        $scope.cursaleInfo.sellingprice  = $scope.searchResult[index].selprice;
        $scope.searchResult              = {};
        $event.stopPropagation();
        var element = angular.element("#amount");
        element.focus()
    }


    $scope.popupPrintSL = function(param) {
        window.open(base_url+param,'_blank');
    }

}]);
//end controller data sale




// controller report purchase order
mainAngular.controller("mainAppRptPurchaseOrder",['$scope','$http','$sce', function($scope,$http,$sce){

//set focus 
var element = angular.element("#purchase");
element.focus();



// Fetch report item
    $scope.fetchReportItemPO = function(){
        
        if($scope.reportPOInfo.itemid){        
            var searchText_len = $scope.reportPOInfo.itemid.trim().length;
            //alert(searchText_len);

            // Check search text length
            if(searchText_len > 0)
            {
                $http({
                        method: 'post',
                        url: base_url+"/ci-store/reportpurchase/viewReportPurchase/searchitem",
                        data: {searchText:$scope.reportPOInfo.itemid}
                    }).then(function successCallback(response) {
                            console.log(response);
                            $scope.searchResult = response.data;
                        });
            }
            else
            {
                $scope.searchResult           = {};
                $scope.reportPOInfo.itemid    = "";
                var element = angular.element("#itemid");
                element.focus()
            }
        }
        else
        {
            $scope.searchResult           = {};
            $scope.reportPOInfo.itemid    = "";
        }     
    }

    // Set value to search box
    $scope.setValueReportItemPO = function(index,$event){
        $scope.reportPOInfo.itemid    = $scope.searchResult[index].keyitem;
        $scope.searchResult           = {};
        $event.stopPropagation();
        var element = angular.element("#statuspo");
        element.focus()
    }

    $scope.searchboxReportItemPO = function($event){
        $event.stopPropagation();
    }


    // Fetch report supplier
    $scope.fetchReportSupplierPO = function(){
        
        if($scope.reportPOInfo.supplierid){        
            var searchText_len = $scope.reportPOInfo.supplierid.trim().length;
            //alert(searchText_len);

            // Check search text length
            if(searchText_len > 0)
            {
                $http({
                        method: 'post',
                        url: base_url+"/ci-store/reportpurchase/viewReportPurchase/searchsupplier",
                        data: {searchText:$scope.reportPOInfo.supplierid}
                    }).then(function successCallback(response) {
                            console.log(response);
                            $scope.searchResultsup = response.data;
                        });
            }
            else
            {
                $scope.searchResultsup            = {};
                $scope.reportPOInfo.supplierid    = "";
        
            }
        }
        else{
            $scope.searchResultsup            = {};
        }   
    }

    // Set value to search box
    $scope.setValueReportSupplierPO = function(index,$event){
        $scope.reportPOInfo.supplierid    = $scope.searchResultsup[index].keysupplier;
        $scope.searchResultsup            = {};
        $event.stopPropagation();
        var element = angular.element("#startdate");
        element.focus()
    }

    $scope.searchboxReportSupplierPO = function($event){
        $event.stopPropagation();
    }


    //search data PO
    $scope.reportPOInfo = {};
    $scope.reportPOInfo.statuspo = "0";
     $scope.searchReportPurchase = function(){
      $http({
       method:"POST",
       url: base_url+"/ci-store/reportpurchase/viewReportPurchase/search",
       data:$scope.reportPOInfo,
      }).then(function(response){
        //console.log(response);
            if (response.data.status == "ok") {
                
                //aktifkan notif alert
                
                $scope.RptContentPO    = $sce.trustAsHtml(response.data.content);
                $scope.show_ContentPO  = true;
               
            }
            else  if (response.data.status == "failed") {

                //aktifkan notif alert
                $scope.show_ContentPO   = false;
                $scope.notifikasiMsg    = response.data.msg;
                $scope.show_Msg         = true;
                setTimeout(function () 
                {
                    $scope.$apply(function()
                {
                    $scope.show_Msg = false;
                });
                }, 5000);
                //end alert

            }
            else{
                console.log(response);
            }
      });
    }


    $scope.resetReportPurchase = function(){
        $scope.reportPOInfo.purchase   = "";
        $scope.reportPOInfo.supplierid = "";
        $scope.reportPOInfo.itemid     = "";
        $scope.reportPOInfo.statuspo   = "0";
        $scope.show_ContentPO          = false;
    }




}]);
//end controller report purchase




// controller report sale
mainAngular.controller("mainAppRptSale",['$scope','$http','$sce', function($scope,$http, $sce){

//set focus
var element = angular.element("#itemid");
element.focus();

// Fetch report item
    $scope.fetchReportItemSL = function(){
        
        if($scope.reportSLInfo.itemid){        
            var searchText_len = $scope.reportSLInfo.itemid.trim().length;
            //alert(searchText_len);

            // Check search text length
            if(searchText_len > 0)
            {
                $http({
                        method: 'post',
                        url: base_url+"/ci-store/reportsale/viewReportSale/searchitem",
                        data: {searchText:$scope.reportSLInfo.itemid}
                    }).then(function successCallback(response) {
                            console.log(response);
                            $scope.searchResult = response.data;
                        });
            }
            else
            {
                $scope.searchResult           = {};
                $scope.reportSLInfo.itemid    = "";
                $scope.reportSLInfo.itemname  = "";
                var element = angular.element("#itemid");
                element.focus()
            }
        }
        else
        {
            $scope.searchResult           = {};
            $scope.reportSLInfo.itemid    = "";
            $scope.reportSLInfo.itemname  = "";
        }     
    }

    // Set value to search box
    $scope.setValueReportItemSL = function(index,$event){
        $scope.reportSLInfo.itemid    = $scope.searchResult[index].keyitem;
        $scope.reportSLInfo.itemname  = $scope.searchResult[index].itemname;
        $scope.searchResult           = {};
        $event.stopPropagation();
        var element = angular.element("#startdate");
        element.focus()
    }

    $scope.searchboxReportItemSL = function($event){
        $event.stopPropagation();
    }


    //search data sale
    $scope.reportSLInfo          = {};
    $scope.reportSLInfo.statussl = "0";
     $scope.searchreportsale = function(){
      $http({
       method:"POST",
       url: base_url+"/ci-store/reportsale/viewReportSale/search",
       data:$scope.reportSLInfo,
      }).then(function(response){
        //console.log(response);
            if (response.data.status == "ok") {
                
                //aktifkan notif alert
                
                $scope.RptContentSL    = $sce.trustAsHtml(response.data.content);
                $scope.show_ContentSL  = true;
               
            }
            else  if (response.data.status == "failed") {

                //aktifkan notif alert
                $scope.show_ContentSL   = false;
                $scope.notifikasiMsg    = response.data.msg;
                $scope.show_Msg         = true;
                setTimeout(function () 
                {
                    $scope.$apply(function()
                {
                    $scope.show_Msg = false;
                });
                }, 5000);
                //end alert

            }
            else{
                console.log(response);
            }
      });
    }


    //reset data
    $scope.resetreportsale = function(){
        $scope.reportSLInfo.itemid     = "";
        $scope.reportSLInfo.itemname   = "";
        $scope.reportSLInfo.saleid     = "";
        $scope.reportSLInfo.statussl   = "0";
        $scope.show_ContentSL          = false;
    }



   

}]);
// end report sale


















mainAngular.controller("mainAppUser",['$scope','$http', function($scope,$http){

    // ** Prodi ** /
    // Function untuk menampilkan user admin dari database
    getUserAdmin();
    function getUserAdmin(){

        $scope.details=[]; 
        $http({
                method: 'GET',
                url: base_url+"/ci-store/user/viewUser/view-ang"
            }).then(function(response){
                        console.log(response);
                        $scope.details = response.data;
                    });
 
    }
    
    // Mengaktifkan form input prodi
    $scope.show_form = true;
    $scope.testxxx  = "angular-runing";


    //INSERT user data
    $scope.userInfo             = {};
    $scope.userInfo.idadmin     = 0;
    $scope.userInfo.supuser = "N";

     $scope.insertUserAdmin = function(){
      $http({
       method:"POST",
       url: base_url+"/ci-store/user/viewUser/save",
       data:$scope.userInfo,
      }).then(function(response){
        console.log(response);
            if (response.data.status == "ok") {
                getUserAdmin();             
                $("#getmodaluser").modal('hide');

                //aktifkan notif alert
                //$scope.show_Msg  = true;
                //console.log(response.data.notif);
                $scope.notifikasiMsg = response.data.msg;
                $scope.show_Msg = true;
                setTimeout(function () 
                {
                    $scope.$apply(function()
                    {
                       $scope.show_Msg = false;
                    });
                }, 5000);
                //end alert

            }
            else if (response.data.status == "failed") {
                    
                    //aktifkan notif alert
                    $scope.show_userMsg        = true;
                    $scope.notifikasiuserMsg   = response.data.msg;
                
                    setTimeout(function () 
                    {
                        $scope.$apply(function()
                    {
                        $scope.show_userMsg = false;
                    });
                    }, 5000);
                    //end alert

                    //set focus
                    var element = angular.element("#"+response.data.focus);
                    element.focus()

            }
            else{
                console.log(response);
            }
      });
    }


    //delete user data
    $scope.deleteUserAdmin = function(param){
        console.log(param);
        $http({
           method:"POST",
           url: base_url+"/ci-store/user/viewUser/delete/"+param,
           data:$scope.userInfo,
          }).then(function(response){
            console.log(response);
                if (response.data.status == "ok") {
                    getUserAdmin();             

                    //aktifkan notif alert
                    //$scope.show_Msg  = true;
                    $scope.notifikasiMsg = response.data.caption;
                    $scope.show_Msg = true;
                    setTimeout(function () 
                    {
                     $scope.$apply(function()
                     {
                       $scope.show_Msg = false;
                     });
                    }, 5000);
                    //end alert

                }
          });
    }



    // Memanggil data user yang akan diedit
    $scope.editUserAdmin = function(info){
        console.log(info);
        $scope.curruserInfo            = info;  
        $scope.curruserInfo.idadmin    = info.AdminID;
        $scope.curruserInfo.admin_name = info.AdminName;
        $scope.curruserInfo.date_of    = info.DateOfBirth;
        $scope.curruserInfo.username   = info.UserName;
        $scope.curruserInfo.email      = info.email;
        $scope.curruserInfo.supuser    = info.SuperUser;  
        //console.log(info.CodeGroupID);
           //$scope.lastname = last_name;  
           //$scope.btnName = "Update";    
        //$('#editProdi').modal(hide);
    }

    //Update data group
    //$scope.updategroupInfo = {};
    $scope.curruserInfo   = {};
    $scope.updateUserAdmin = function(){
        // Melakukan update data group 
       $http({
           method:"POST",
           url: base_url+"/ci-store/user/viewUser/save",
           data:$scope.curruserInfo,
          }).then(function(response){
            console.log(response);
            
            if (response.data.status == "ok") {
                getUserAdmin();             
                $("#geteditmodaluser").modal('hide');

                //aktifkan notif alert
                //$scope.show_Msg  = true;
                //console.log(response.data.notif);
                $scope.notifikasiMsg = response.data.msg;
                $scope.show_Msg = true;
                setTimeout(function () 
                {
                    $scope.$apply(function()
                    {
                       $scope.show_Msg = false;
                    });
                }, 5000);
                //end alert

            }
            else if (response.data.status == "failed") {
                    
                    //aktifkan notif alert
                    $scope.show_userMsg        = true;
                    $scope.notifikasiuserMsg   = response.data.msg;
                
                    setTimeout(function () 
                    {
                        $scope.$apply(function()
                    {
                        $scope.show_userMsg = false;
                    });
                    }, 5000);
                    //end alert

                    //set focus
                    var element = angular.element("#"+response.data.focus);
                    element.focus()

            }
        });

       
    }





}]);
// end controller data user








//controller data user
mainAngular.controller("mainAppProfile",['$scope','$http', function($scope,$http){

    // ** item ** /
    // Function untuk menampilkan data user dari database
    getUser();
    function getUser(){

        $scope.details=[]; 
        $http({
                method : 'GET',
                url    : base_url+"/ci-store/user/viewUser/view-ang"
            }).then(function(response){
                        console.log(response);
                        $scope.details = response.data;
                    });
 
    }
    



    // Insert Data and Upload Image
    $scope.uploadprofile = function(files) {
    var fd = new FormData();
    //Take the first selected file
    fd.append("file", files[0]);

    $http.post(base_url+"/ci-store/profile/viewProfile/save", fd, {
        withCredentials: true,
        headers: {'Content-Type': undefined },
        transformRequest: angular.identity
    }).then(function(response){
            if (response.data.status == "ok") {
                getProfile();
                
                //aktifkan notif alert
                $scope.notifikasiMsg = response.data.msg;
                $scope.show_Msg = true;
                setTimeout(function () 
                {
                    $scope.$apply(function()
                {
                    $scope.show_Msg = false;
                });
                }, 5000);
                //end alert

            }
            else if (response.data.status == "failed") {
                
                //aktifkan notif alert
                $scope.notifikasiMsg = response.data.msg;
                $scope.show_Msg = true;
                setTimeout(function () 
                {
                    $scope.$apply(function()
                {
                    $scope.show_Msg = false;
                });
                }, 5000);
                //end alert

                //set focus
                var element = angular.element("#"+response.data.focus);
                element.focus()

            }
            else{
                console.log(response);
            }
        });

    };


}]);
//end controller data profile




