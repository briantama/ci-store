// Application module
var ProdiApp = angular.module('MasterGroupApp',[]);
ProdiApp.controller("MasterGroupController",['$scope','$http', function($scope,$http){

	// ** group ** /
	// Function untuk menampilkan data group dari database
	getMasterGroup();
	function getMasterGroup(){
		// Menampilkan data prodi melalui detailProdi.php
		var base_url  = window.location.origin; 
		$http.post(base_url()+'/mastergroup/viewMastergroup/view-ang').success(function(data){
		
		// Menampilkan database melalui scope 
		$scope.details = data;
		});
	}
	
	// Mengaktifkan form input prodi
	$scope.show_form = true;

		
	
}]);