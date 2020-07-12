//load page 
var mainAngular = angular.module('mainApp',['ngRoute', 'ngAnimate', 'datatables', 'ngSanitize', 'ui.date']);
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
        .when('/page-reportstock',{
            templateUrl: base_url+'/ci-store/reportstock/viewReportStock'
        })
        .when('/page-reportpurchase',{
            templateUrl: base_url+'/ci-store/reportpurchase/viewReportPurchase'
        })
        .when('/page-reportsale',{
            templateUrl: base_url+'/ci-store/reportsale/viewReportSale'
        })
        .when('/page-setupprofile',{
            templateUrl: base_url+'/ci-store/setupprofile/viewSetupProfile'
        })
        .when('/page-setuplogo',{
            templateUrl: base_url+'/ci-store/setuplogo/viewSetupLogo'
        })
        .when('/page-setupprint',{
            templateUrl: base_url+'/ci-store/setupprint/viewSetupPrint'
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

        //$scope.details=[]; 
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
    function getNumberGroup() {
        $scope.numberinggroup=[]; 
            $http({
                    method: 'GET',
                    url: base_url+"/ci-store/mastergroup/viewMastergroup/getnumber"
                }).then(function(response){
                            console.log(response);
                            $scope.numberinggroup       = response.data.GetID;
                            $scope.groupInfo.group_code = response.data.GetID;
                        });
    }

     //show popup group
    $scope.getPopupGroup = function(param){
        $("#"+param).modal('show');
        $scope.groupInfo = {}; //reset form group
        getNumberGroup();// memanggil id number group
    }


    $scope.popupPrintGroup = function(param) {
        window.open(base_url+param,'_blank');
    }

    $scope.popupExportGroup = function(param) {
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

        //$scope.details=[]; 
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
    function getNumberSupplier(){
        $scope.numberinggroup=[]; 
        $http({
                method: 'GET',
                url: base_url+"/ci-store/mastersupplier/viewMastersupplier/getnumber"
            }).then(function(response){
                        console.log(response);
                        $scope.numberingsupplier        = response.data.GetID;
                        $scope.supplierInfo.supplier_id = response.data.GetID;
                    });
    }


    //show popup supplier
    $scope.getPopupSupplier = function(param){
        $("#"+param).modal('show');
        $scope.supplierInfo = {}; //reset form supplier
        getNumberSupplier();// memanggil id number supplier
    }



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

     // print data
     $scope.popupPrintSupplier = function(param) {
        window.open(base_url+param,'_blank');
    }

    // print data
     $scope.popupExportSupplier = function(param) {
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

        //$scope.details=[]; 
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
    $scope.itemInfo.stock = parseInt(0);
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
        $scope.itemInfo.stock            = parseInt(0);
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


    //edit
    // Fetch report item
    $scope.efetchGroup = function(){
        
        if($scope.curitemInfo.group_id){        
            var searchText_len = $scope.curitemInfo.group_id.trim().length;
            //alert(searchText_len);

            // Check search text length
            if(searchText_len > 0)
            {
                $http({
                        method: 'post',
                        url: base_url+"/ci-store/masteritem/viewMasteritem/searchgroup",
                        data: {searchText:$scope.curitemInfo.group_id}
                    }).then(function successCallback(response) {
                            console.log(response);
                            $scope.searchResult = response.data;
                        });
            }
            else
            {
                $scope.searchResult       = {};
                $scope.curitemInfo.group_id  = "";
                var element = angular.element("#group_id");
                element.focus()
            }
        }
        else
        {
            $scope.searchResult       = {};
            $scope.curitemInfo.group_id  = "";
        }     
    }


    // Set value to search box
    $scope.setEValueGroup = function(index,$event){
        $scope.curitemInfo.group_id      = $scope.searchResult[index].keygroup;
        $scope.searchResult           = {};
        $event.stopPropagation();
        var element = angular.element("#shortitem");
        element.focus()
    }



    $scope.popupPrintItem = function(param) {
        window.open(base_url+param,'_blank');
    }


    $scope.popupExportItem = function(param) {
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

        //$scope.details=[]; 
        $http({
                method : 'GET',
                url    : base_url+"/ci-store/purchaseorder/viewPurchaseOrder/view-ang"
            }).then(function(response){
                        console.log(response);
                        $scope.details = response.data;
                    });
 
    }


    //show date
    $scope.dateOptions = {
        changeYear: true,
        changeMonth: true,
        yearRange: '1900:-0', 
        dateFormat: 'yy-mm-dd',
          //onClose: (value, picker, $element) => {
            //alert(value);
          //}
    }


    // Mengaktifkan form input item
    $scope.show_form = true;
    $scope.testxxx   = "angular-runing";



    //getnumbering data purchase
    //$scope.purchaseInfo     ={};
    function NumberingPurchase(){
    $scope.numberingpurchase=[]; 
        $http({
                method: 'GET',
                url: base_url+"/ci-store/purchaseorder/viewPurchaseOrder/getnumber"
            }).then(function(response){
                        console.log(response);
                        $scope.numberingpurchase          = response.data.GetID;
                        $scope.purchaseInfo.purorder      = response.data.GetID;
                    });
    }

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

 
  
   //INSERT purchaseorder detail
   var today   = new Date();
   var date    = today.getDate();
   var month   = today.getMonth() + 1;
   var year    = today.getFullYear();
   var months  = (month.length > 1) ? month :  '0'+month;


   //show popup purchase order
   $scope.showPopupPO=function(){
    NumberingPurchase();
    $scope.show_form = true;
    $("#getmodalpurchase").modal('show');
    //var idx = angular.element(document.querySelector('#purorder')).val();//mengambil id nominal
    $scope.totalnew                   = 0; //kembalikan default nilai tottal detail po
    $scope.TotalStock                 = 0;
    $scope.showstock                  = false;
    $scope.purchaseInfo.purchasedate  = year+"-"+months+"-"+date;; 
    $scope.purchaseInfo.supplierid    = ''; 
    $scope.purchaseInfo.itemid        = ""; //kembalikan default
    $scope.purchaseInfo.itemname      = ""; //kembalikan default 
    $scope.purchaseInfo.purchaseprice = ""; //kembalikan default 
    $scope.purchaseInfo.amount        = ""; //kembalikan default 
    $scope.purchaseInfo.total         = ""; //kembalikan default 
    //console.log(idx)
    getPurchaseOrderDetail(NumberingPurchase());
   }




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
                $scope.totalnew                     = 0; //kembalikan default nilai tottal detail po
                $scope.TotalStock                   = 0;
                $scope.showstock                    = false;
                $scope.purchaseInfo.itemid          = ""; //kembalikan default
                $scope.purchaseInfo.itemname        = ""; //kembalikan default 
                $scope.purchaseInfo.purchaseprice   = ""; //kembalikan default 
                $scope.purchaseInfo.amount          = ""; //kembalikan default 
                $scope.purchaseInfo.total           = ""; //kembalikan default 

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
    //$scope.StatusData  = 0; // data post or not
    //$scope.purchaseInfo.purchasedate = year+"-"+months+"-"+date;
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
        $scope.totalnew                      = 0; //kembalikan default nilai tottal detail po
        $scope.StatusData                    = 0;
        $scope.TotalStock                    = 0;
        $scope.showstock                     = false;
        $scope.purchaseInfo                  = info;  
        $scope.purchaseInfo.purorder         = info.PurchaseOrderID
        $scope.purchaseInfo.purchasedate     = info.PurchaseDate
        $scope.purchaseInfo.supplierid       = info.SupplierID
        getPurchaseOrderDetail($scope.purchaseInfo.purorder);

        // if(info.IsActive == "N"){
        //     $scope.show_statusdata = true;
        //     $scope.statusdata      = "*Record Is Deleted";
        // }
        // else{
        //     $scope.statusdata = "";
        // }  
    }

    

    //delete post data
    $scope.postPurchaseOrder = function(param){
        //console.log(param);
        //Melakukan delete data memlalui paramater param
        $http({
           method:"POST",
           url: base_url+"/ci-store/purchaseorder/viewPurchaseOrder/post/"+param,
           data:{"purchaseorder" : param},
          }).then(function(response){
            console.log(response);
                if (response.data.status == "ok") {
                    getPurchaseOrder();

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
                else if (response.data.status == "failed") {
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




    //delete DETAIL PO data
    $scope.deletePurchaseOrder = function(param){
        //console.log(param);
        //Melakukan delete data memlalui paramater param
        $http({
           method:"POST",
           url: base_url+"/ci-store/purchaseorder/viewPurchaseOrder/delete/"+param,
           data:{"purchaseorder" : param},
          }).then(function(response){
            console.log(response);
                if (response.data.status == "ok") {
                    getPurchaseOrderDetail(param); 
                    $scope.totaledit  = 0; //kembalikan default nilai tottal detail po       
                    $scope.totalnew   = 0; //kembalikan default nilai tottal detail po                    

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
                else if (response.data.status == "failed") {
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
        $scope.TotalStock                 = $scope.searchResult[index].stock;
        $scope.showstock                  = true;
        $scope.searchResult               = {};
        $event.stopPropagation();
        var element = angular.element("#amount");
        element.focus()
    }

    $scope.searchboxItemPO = function($event){
        $event.stopPropagation();
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
    

     $scope.popupPrintPO= function(param) {
        window.open(base_url+param,'_blank');
    }

    $scope.popupPrintInvoice= function(url, param) {
        window.open(base_url+url+param,'_blank');
    }
    


}]);
//end controller data purchase order



//controller data Purchase Order
mainAngular.controller("mainAppSale",['$scope','$http', function($scope,$http){

    // ** item ** /
    // Function untuk menampilkan data user dari database
    getSale();
    function getSale(){

        //$scope.details=[]; 
        $http({
                method : 'GET',
                url    : base_url+"/ci-store/sale/viewSale/view-ang"
            }).then(function(response){
                        console.log(response);
                        $scope.details = response.data;
                    });
 
    }


     //show date
    $scope.dateOptions = {
        changeYear: true,
        changeMonth: true,
        yearRange: '1900:-0', 
        dateFormat: 'yy-mm-dd',
          //onClose: (value, picker, $element) => {
            //alert(value);
          //}
    }


    // Mengaktifkan form input item
    $scope.show_form = true;
    $scope.testxxx   = "angular-runing";



    //getnumbering data sale
    function NumberingSale(){
    $scope.numberingsale=[]; 
        $http({
                method: 'GET',
                url: base_url+"/ci-store/sale/viewSale/getnumber"
            }).then(function(response){
                        console.log(response);
                        $scope.numberingsale          = response.data.GetID;
                        $scope.saleInfo.sale          = response.data.GetID;
                    });
    }

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


   var today   = new Date();
   var date    = today.getDate();
   var month   = today.getMonth() + 1;
   var year    = today.getFullYear();
   var months  = (month.length > 1) ? month :  '0'+month;


   //show popup purchase order
   $scope.showPopupSL=function(){
    NumberingSale();
    $scope.show_form = true;
    $("#getmodalsale").modal('show');
    //var idx = angular.element(document.querySelector('#sale')).val();//mengambil id nominal
    $scope.totalnew              = 0; //kembalikan default nilai tottal detail sale
    $scope.saleInfo.saledate     = year+"-"+months+"-"+date;
    $scope.saleInfo.itemid       = "";
    $scope.saleInfo.itemname     = "";
    $scope.saleInfo.sellingprice = "";
    $scope.saleInfo.amount       = "";
    $scope.saleInfo.total        = "";
    $scope.TotalStock            = 0;
    $scope.showstock             = false;
    //console.log(idx)
    getSaleDetail(NumberingSale());
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
                $scope.totalnew             = 0; //kembalikan default nilai tottal detail po
                $scope.saleInfo.itemid      = "";
                $scope.saleInfo.itemname    = "";
                $scope.saleInfo.sellingprice= "";
                $scope.saleInfo.amount      = "";
                $scope.saleInfo.total       = "";
                $scope.TotalStock           = 0;
                $scope.showstock            = false;

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
        $scope.totaledit              = 0; //kembalikan default nilai tottal detail sale
        $scope.totalnew               = 0;
        $scope.saleInfo               = info;  
        $scope.saleInfo.sale          = info.SaleID
        $scope.saleInfo.saledate      = info.SaleDate
        getSaleDetail($scope.saleInfo.sale);
    }



    //delete DETAIL sale data
    $scope.deletesale = function(param){
        //console.log(param);
        //Melakukan delete data memlalui paramater param
        $http({
           method:"POST",
           url: base_url+"/ci-store/sale/viewSale/delete/"+param,
           data:{"sale" : param},
          }).then(function(response){
            console.log(response);
                if (response.data.status == "ok") {
                    getSale();
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
                else if (response.data.status == "failed") {
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


    //delete DETAIL sale data
    $scope.postSale = function(param){
        //console.log(param);
        //Melakukan delete data memlalui paramater param
        $http({
           method:"POST",
           url: base_url+"/ci-store/sale/viewSale/post/"+param,
           data:{"sale" : param},
          }).then(function(response){
            console.log(response);
                if (response.data.status == "ok") {
                    getSale();
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
                else if (response.data.status == "failed") {
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




    //delete DETAIL sale data
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
                else{
                    console.log(response);
                }
          });
    }

    

    $scope.calcFormSL = function() {
        var totostock = angular.element(document.querySelector('#totalstockitem')).val();
        
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
        else if($scope.saleInfo.amount > totostock){
            //alert
            $scope.notifikasiSLMsg    = "Amount More Than Stock Item !!!";
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
             $scope.saleInfo.total  = 0;
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
        $scope.TotalStock             = $scope.searchResult[index].stock;
        $scope.showstock              = true;
        $scope.searchResult           = {};
        $event.stopPropagation();
        var element = angular.element("#amount");
        element.focus()
    }

    $scope.searchboxItemSL = function($event){
        $event.stopPropagation();
    }

    

    $scope.popupPrintSL = function(param) {
        window.open(base_url+param,'_blank');
    }

     $scope.printBill = function(url, param) {
        window.open(base_url+url+param,'_blank', 'width=300');
    }


}]);
//end controller data sale



// controller report purchase order
mainAngular.controller("mainAppRptStock",['$scope','$http','$sce', function($scope,$http,$sce){

//set focus 
var element = angular.element("#purchase");
element.focus();

//show date
$scope.dateOptions = {
    changeYear: true,
    changeMonth: true,
    yearRange: '1900:-0', 
    dateFormat: 'yy-mm-dd',
      //onClose: (value, picker, $element) => {
        //alert(value);
      //}
}


// Fetch report item
    $scope.fetchReportItemSK = function(){
        
        if($scope.reportSKInfo.itemid){        
            var searchText_len = $scope.reportSKInfo.itemid.trim().length;
            //alert(searchText_len);

            // Check search text length
            if(searchText_len > 0)
            {
                $http({
                        method: 'post',
                        url: base_url+"/ci-store/reportstock/viewReportStock/searchitem",
                        data: {searchText:$scope.reportSKInfo.itemid}
                    }).then(function successCallback(response) {
                            console.log(response);
                            $scope.searchResult = response.data;
                        });
            }
            else
            {
                $scope.searchResult           = {};
                $scope.reportSKInfo.itemid    = "";
                var element = angular.element("#itemid");
                element.focus()
            }
        }
        else
        {
            $scope.searchResult           = {};
            $scope.reportSKInfo.itemid    = "";
        }     
    }

    // Set value to search box
    $scope.setValueReportItemSK = function(index,$event){
        $scope.reportSKInfo.itemid    = $scope.searchResult[index].keyitem;
        $scope.searchResult           = {};
        $event.stopPropagation();
        //var element = angular.element("#statuspo");
        //element.focus()
    }

    $scope.searchboxReportItemSK = function($event){
        $event.stopPropagation();
    }


    // Fetch report supplier
    $scope.fetchReportSupplierSK = function(){
        
        if($scope.reportSKInfo.supplierid){        
            var searchText_len = $scope.reportSKInfo.supplierid.trim().length;
            //alert(searchText_len);

            // Check search text length
            if(searchText_len > 0)
            {
                $http({
                        method: 'post',
                        url: base_url+"/ci-store/reportstock/viewReportStock/searchsupplier",
                        data: {searchText:$scope.reportSKInfo.supplierid}
                    }).then(function successCallback(response) {
                            console.log(response);
                            $scope.searchResultsup = response.data;
                        });
            }
            else
            {
                $scope.searchResultsup            = {};
                $scope.reportSKInfo.supplierid    = "";
        
            }
        }
        else{
            $scope.searchResultsup            = {};
        }   
    }

    // Set value to search box
    $scope.setValueReportSupplierSK = function(index,$event){
        $scope.reportSKInfo.supplierid    = $scope.searchResultsup[index].keysupplier;
        $scope.searchResultsup            = {};
        $event.stopPropagation();
        var element = angular.element("#startdate");
        element.focus()
    }

    $scope.searchboxReportSupplierSK = function($event){
        $event.stopPropagation();
    }


    //search data PO
    $scope.reportSKInfo = {};
    $scope.reportSKInfo.reporttype = "HI";
     $scope.searchReportStock = function(){
      $http({
       method:"POST",
       url: base_url+"/ci-store/reportstock/viewReportStock/search",
       data:$scope.reportSKInfo,
      }).then(function(response){
        //console.log(response);
            if (response.data.status == "ok") {
                
                //aktifkan notif alert
                
                $scope.RptContentSK    = $sce.trustAsHtml(response.data.content);
                $scope.show_ContentSK  = true;
               
            }
            else  if (response.data.status == "failed") {

                //aktifkan notif alert
                $scope.show_ContentSK   = false;
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


    $scope.resetReportStock = function(){
        $scope.reportSKInfo.purchase   = "";
        $scope.reportSKInfo.supplierid = "";
        $scope.reportSKInfo.itemid     = "";
        $scope.reportSKInfo.reporttype = "HI";
        $scope.show_ContentSK          = false;
    }




}]);
//end controller report stock








// controller report purchase order
mainAngular.controller("mainAppRptPurchaseOrder",['$scope','$http','$sce', function($scope,$http,$sce){

//set focus 
var element = angular.element("#purchase");
element.focus();

//show date
$scope.dateOptions = {
    changeYear: true,
    changeMonth: true,
    yearRange: '1900:-0', 
    dateFormat: 'yy-mm-dd',
      //onClose: (value, picker, $element) => {
        //alert(value);
      //}
}


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


   var today   = new Date();
   var date    = today.getDate();
   var month   = today.getMonth() + 1;
   var year    = today.getFullYear();
   var months  = (month.length > 1) ? month :  '0'+month;


    //search data PO
    $scope.reportPOInfo = {};
    $scope.reportPOInfo.statuspo = "0";
    $scope.reportPOInfo.startdate = year+"-"+months+"-"+date;
    $scope.reportPOInfo.enddate   = year+"-"+months+"-"+date;
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

//show date
$scope.dateOptions = {
    dateFormat: 'yy-mm-dd',
    changeYear: true,
    changeMonth: true,
    yearRange: '1900:-0', 
      //onClose: (value, picker, $element) => {
        //alert(value);
      //}
}

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


   var today   = new Date();
   var date    = today.getDate();
   var month   = today.getMonth() + 1;
   var year    = today.getFullYear();
   var months  = (month.length > 1) ? month :  '0'+month;

    //search data sale
    $scope.reportSLInfo          = {};
    $scope.reportSLInfo.statussl = "0";
    $scope.reportSLInfo.startdate = year+"-"+months+"-"+date;
    $scope.reportSLInfo.enddate   = year+"-"+months+"-"+date;
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


















mainAngular.controller("mainAppUser",['$scope','$http', '$route', function($scope,$http, $route){

    // ** Prodi ** /
    // Function untuk menampilkan user admin dari database
    getUserAdmin();
    function getUserAdmin(){

        //$scope.details=[]; 
        $http({
                method: 'GET',
                url: base_url+"/ci-store/user/viewUser/view-ang"
            }).then(function(response){
                        console.log(response);
                        $scope.details = response.data;
                    });
 
    }


    //show date
    $scope.dateOptions = {
        dateFormat: 'yy-mm-dd',
        changeYear: true,
        changeMonth: true,
        yearRange: '1900:-0', 
          //onClose: (value, picker, $element) => {
            //alert(value);
          //}
    }

    
    // Mengaktifkan form input prodi
    $scope.show_form = true;
    $scope.testxxx  = "angular-runing";


    var today   = new Date();
    var date    = today.getDate();
    var month   = today.getMonth() + 1;
    var year    = today.getFullYear();
    var months  = (month.length > 1) ? month :  '0'+month;
    var _someDate;

    //INSERT user data

    $scope.userInfo = {};
    $scope.userInfo.idadmin     = 0;
    $scope.userInfo.supuser     = "N";
    $scope.userInfo.date_of     = year+"-"+months+"-"+date;

     $scope.insertUserAdmin = function(){
        // if($scope.userInfo.password == "" || $scope.userInfo.repassword == ""){

        //     //aktifkan notif alert
        //     $scope.show_userMsg        = true;
        //     $scope.notifikasiuserMsg   = "Please Insert Password Or Re Password !!!";
                    
        //     setTimeout(function () 
        //     {
        //         $scope.$apply(function()
        //         {
        //             $scope.show_userMsg = false;
        //         });
        //     }, 5000);
        //     //end alert

        //     //set focus
        //     var element = angular.element("#password");
        //     element.focus();

        // }
        // else{

          $http({
           method:"POST",
           url: base_url+"/ci-store/user/viewUser/save",
           data:$scope.userInfo,
          }).then(function(response){
            console.log(response);
                if (response.data.status == "ok") {
                    getUserAdmin();   
                    //$route.reload();          
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

        //}

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
    $scope.showFormAdmin = function(){
        // console.log("okwwwww");
        // alert("OKEEE");
        $scope.userInfo = {};
        $scope.readuser = "";
        $scope.userInfo.date_of = year+"-"+months+"-"+date;
        $scope.userInfo.supuser = "N";

    }

    // Memanggil data user yang akan diedit
    $scope.editUserAdmin = function(info){
        console.log(info);
        //$scope.userInfo            = info;  
        $scope.userInfo.idadmin    = info.AdminID;
        $scope.userInfo.admin_name = info.AdminName;
        $scope.userInfo.date_of    = info.DateOfBirth;
        $scope.userInfo.username   = info.UserName;
        $scope.userInfo.email      = info.email;
        $scope.userInfo.supuser    = info.SuperUser;

        //readonly 
        $scope.readuser            = 'readonly';

        //console.log(info.CodeGroupID);
           //$scope.lastname = last_name;  
           //$scope.btnName = "Update";    
        //$('#editProdi').modal(hide);
    }

    




}]);
// end controller data user








//controller data user
mainAngular.controller("mainAppProfile",['$scope','$http', function($scope,$http){

    // ** item ** /
    // Function untuk menampilkan data user dari database
    getUser();
    function getUser(){

        //$scope.details=[]; 
        $http({
                method : 'GET',
                url    : base_url+"/ci-store/profile/viewProfile/view-ang"
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
                getUser();
                
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




//profile setting
mainAngular.controller("mainAppSetupProfile",['$scope','$http', function($scope,$http){

    // ** item ** /
    // Function untuk menampilkan data user dari database
    getSetupProfile();
    function getSetupProfile(){

        //$scope.details=[]; 
        $http({
                method : 'GET',
                url    : base_url+"/ci-store/setupprofile/viewSetupProfile/view-ang"
            }).then(function(response){
                        console.log(response);
                        $scope.details = response.data;

                        if(response.data){
                            var obj = response.data;
                            for (var key in obj) {
                                var idxadmin = obj[key].SetupprofileID;
                                var idxtitle = obj[key].SetupTitle;
                                var idxname  = obj[key].SetupName;
                                var idxdesc  = obj[key].SetupDescription;
                                var idxstpd  = obj[key].SetupImageDasbor;
                            }

                            //set value form
                            $scope.stpInfo.stpidx   = idxadmin;
                            $scope.stpInfo.stptitle = idxtitle;
                            $scope.stpInfo.stpname  = idxname;
                            $scope.stpInfo.stpdesc  = idxdesc;
                            $scope.stpInfo.stpimg   = idxstpd;
                        }

                    });
 
    }
    
    $scope.stpInfo        = {};
    $scope.stpInfo.stpidx = "0";
    $scope.stpInfo.stpimg = "N";
    $scope.liststpprofile =[];
    $scope.files          =[];
    $scope.insertstpprofile=function(info){
        $scope.photo=$scope.files[0];       
        
        // Melakukan input data item 
        $http({
                method      :'POST',
                url         :base_url+"/ci-store/setupprofile/viewSetupProfile/save",
                processData :false,
                transformRequest:function(data){
                    var formData=new FormData();

                    formData.append("stpidx", info.stpidx);
                    formData.append("stptitle", info.stptitle);
                    formData.append("stpname", info.stpname);
                    formData.append("stpdesc", info.stpdesc);
                    formData.append("stpimg", info.stpimg);
                    formData.append("photo", $scope.photo);

                return formData;
                //return $scope.item_id;
                                            
              },  
              data : $scope.liststpprofile,
              headers: {
                     'Content-Type': undefined
              }
        }).then(function(response){
            $scope.show_form = true;
            console.log(response);
            if (response.data.status == "ok") {
                getSetupProfile();

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





}]);



//controller data logo
mainAngular.controller("mainAppSetupLogo",['$scope','$http', function($scope,$http){

    // ** item ** /
    // Function untuk menampilkan data user dari database
    getSetupLogo();
    function getSetupLogo(){

        //$scope.details=[]; 
        $http({
                method : 'GET',
                url    : base_url+"/ci-store/setuplogo/viewSetupLogo/view-ang"
            }).then(function(response){
                        console.log(response);
                        $scope.details = response.data;

                        if(response.data){
                            var obj = response.data;
                            for (var key in obj) {
                                var idxadmin = obj[key].SetupprofileID;    
                            }

                            //set value form
                            $scope.stplInfo.stpidx   = idxadmin;
                        }


                    });
 
    }
    



    $scope.stplInfo        = {};
    $scope.stplInfo.stpidx = "0";
    //$scope.liststplogo     =[];
    //$scope.files           =[];
    // Insert Data and Upload Image
    $scope.uploadlogo = function(files) {
    var idx = $scope.stplInfo.stpidx;
    var fd  = new FormData();
    //Take the first selected file
    fd.append("file", files[0]);
    fd.append("stpidx", idx);

    $http.post(base_url+"/ci-store/setuplogo/viewSetupLogo/save", fd, {
        withCredentials: true,
        headers: {'Content-Type': undefined },
        transformRequest: angular.identity
    }).then(function(response){
            if (response.data.status == "ok") {
                getSetupLogo();
                
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
//end controller data logo




//controller setup print
mainAngular.controller("mainAppSetupPrint",['$scope','$http', function($scope,$http){

    // ** stp print ** /
    // Function untuk menampilkan data item dari database
    getstpPrint();
    function getstpPrint(){

        $http({
                method : 'GET',
                url    : base_url+"/ci-store/setupprint/viewSetupPrint/view-ang"
            }).then(function(response){
                        console.log(response);
                        $scope.details = response.data;

                        var obj = response.data;
                        if(obj){

                          for (var key in obj) {
                            //if(obj[key].AdminImage == "AdminImage"){
                              var imageurl   = obj[key].SetupImage;
                              var idxprintid = obj[key].SettupprintID;
                              var idxheader  = obj[key].SetupHeader;
                              var idxfooter  = obj[key].SetupFooter;
                              var idxshow    = obj[key].SetupImageShow;
                            //}
                          }

                            //check file image exist
                            var http   = new XMLHttpRequest();
                            var cekimg = (imageurl != "") ? imageurl : "default.jpeg";
                            http.open('HEAD', base_url+'/ci-store/upload/print/'+cekimg, false);
                            http.send();
                           
                            console.log(imageurl);

                          if(http.status != 404){
                            $scope.showUrlImage        = base_url+'/ci-store/upload/print/'+cekimg;
                            $scope.stptInfo.stpidx     = idxprintid;
                            $scope.stptInfo.stpheader  = idxheader; 
                            $scope.stptInfo.stpfooter  = idxfooter;
                            $scope.stptInfo.stpshow    = idxshow;  
                          }
                          else{
                            $scope.showUrlImage        = base_url+'/ci-store/upload/print/'+cekimg;
                            $scope.stptInfo.stpidx     = idxprintid;
                            $scope.stptInfo.stpheader  = idxheader; 
                            $scope.stptInfo.stpfooter  = idxfooter;
                            $scope.stptInfo.stpshow    = idxshow;  
                          }

                        }




                    });
 
    }
    
    $scope.testxxx   = "angular-runing";


    // Insert Data and Upload Image
    $scope.stptInfo         = [];
    $scope.stptInfo.stpidx  = "0";
    $scope.stptInfo.stpshow = "N";
    $scope.showUrlImage     = base_url+'/ci-store/upload/print/default.jpeg';
    $scope.files            = [];
    $scope.insertstpprofile=function(info){
        $scope.photo=$scope.files[0];       
        
        // Melakukan input data item 
        $http({
                method      :'POST',
                url         :base_url+"/ci-store/setupprint/viewSetupPrint/save",
                processData :false,
                transformRequest:function(data){
                    var formData=new FormData();
                    
                    formData.append("stpidx", info.stpidx);
                    formData.append("stpheader", info.stpheader);
                    formData.append("stpfooter", info.stpfooter);
                    formData.append("stpshow", info.stpshow);
                                                           
                    formData.append("photo", $scope.photo);

                return formData;
                //return $scope.item_id;
                                            
              },  
              data : $scope.liststpprint,
              headers: {
                     'Content-Type': undefined
              }
        }).then(function(response){
            console.log(response);
            if (response.data.status == "ok") {
                $scope.stptInfo.photo = null;
                getstpPrint();
                
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
                $scope.show_Msg      = true;
                $scope.notifikasiMsg = response.data.msg;
            
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



     $scope.testPrint = function(url) {
        window.open(base_url+url,'_blank', 'width=300');
    }


}]);
//end controller data stp print
