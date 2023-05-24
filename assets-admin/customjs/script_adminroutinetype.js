var myApp = angular.module('project1',["smart-table"], function(){});
myApp.controller('projectinfo1',function($scope,$rootScope,$timeout,$http,$window,$filter,$q,$routeParams) {

	$(document).on('click','.addNew',function(){
	    $('#addCity_modal').modal('show');return false; 
	});

	$(document).on('click','.modalClose',function(){
	    $('#addCity_modal').modal('hide');return false; 
	});
	
	$scope.category={};
	$scope.category.ID = "";
	$scope.category.C_1 = "";
    $scope.category.C_2 = "";
	$scope.category.C_3 = "";


//	$scope.editView = 0;
//
	$scope.tokenHash = $("#csrf").val();
//	
	$scope.getAllAdminCategorylov = function(){
		
		var data = {};
	    data.userId = userId;
	    var temp = $.param({details: data});
    	
		$http({
			data: temp+"&"+$scope.tokenHash,
			url : site+'/getAllAdminroutinetype',
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {
			
		
			
			if ($.fn.DataTable.isDataTable("#categoryTable")) {
				$('#categoryTable').DataTable().clear().destroy();
			}
			if ($.fn.DataTable.isDataTable("#subCategoryTable")) {
				$('#subCategoryTable').DataTable().clear().destroy();
			}
			if ($.fn.DataTable.isDataTable("#subSubCategoryTable")) {
				$('#subSubCategoryTable').DataTable().clear().destroy();
			}
			
			$scope.displayCollectionCategory = data.listCat;
			
			
			setTimeout(function(){
				$('#categoryTable').DataTable( {
		            order: [],
		            aLengthMenu: [
		                          [10, 25, 50, 100, 200, -1],
		                          [10, 25, 50, 100, 200, "All"]
		                      ]
		        } );

			}, 500);
			
		})
		.error(function(data, status, headers, config) {
		});
	}
	$scope.getAllAdminCategorylov();
		
	$scope.reset = function(){
		$scope.category={};
		$scope.category.ID = "";
		$scope.category.C_1 = "";
        $scope.category.C_2 = "";

	}
	
	$scope.addNewType = function(){
		$scope.category={};
		$scope.category.ID = "";
		$scope.category.C_1 = "";
        $scope.category.C_2 = "";
		$scope.category.C_3 = "";
        $scope.category.C_4 = "";


		$('.image-box').remove();

		$("#typemodal").modal('show');
	}
	
	
	$scope.saveType = function(){
		

		var formData = new FormData($('#uploadattch')[0]);

		var data = {};

	    data.category = formData;
	    data.userId = userId;
    	var temp = $.param({details: data});

		alert('hello');
    	
		$http({
			data: temp+"&"+$scope.tokenHash, 
			url : site+"/routine_type_add",
			method: "POST",

		}).success(function(data, status, headers, config) {
				
			if(data.done == true || data.done == 'true'){
				
				toastr.success(data.msg, '', {timeOut: 3000})
				// $scope.getAllAdminCategorylov();
				$('#typemodal').modal('hide');
				
			}else{
				toastr.error(data.msg, '', {timeOut: 3000})
			}

		})
		.error(function(data, status, headers, config) {
		});
	}

	$scope.continouRecord = function(id){
		
		var data = {};
	    data.recordId = id;
	    data.userId = userId;
    	var temp = $.param({details: data});
    	
		$http({
			data: temp+"&"+$scope.tokenHash, 
			url : site+"/routine_type_edit",
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {
				
			var detail = data.details;
			if(detail != '' && detail != null){
				
				$scope.category.ID = detail['ID'];
				$scope.category.C_1 = detail['NAME'];
				$scope.category.C_4= detail['IDENTIFY'];
				$scope.category.C_3= detail['DESCRIPTION'];
				$('#type_id').val(detail['ID']);
				$('.image-box').remove();
				var img = $('<img class="image-box">').attr('src', detail['IMAGE_DOWNPATH']);
				$('#img_file_').append(img);
				$('#typemodal').modal('show');
			}
		})
		.error(function(data, status, headers, config) {
		});
	}
	
	$scope.statusChange = function(id){
		
		var data = {};
	    data.recordId = id;
	    data.userId = userId;
    	var temp = $.param({details: data});
    	
		$http({
			data: temp+"&"+$scope.tokenHash,
			url : site+"/changeStatusCategory",
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {
				
			toastr.success(data.msg, '', {timeOut: 3000})
			$scope.getAllAdminCategorylov();
			
		})
		.error(function(data, status, headers, config) {
		});
	}
	
	
	$scope.subCategory={};
	$scope.subCategory.ID = "";
	$scope.subCategory.C_1 = "";
	$scope.subCategory.C_2 = "";
	
	$scope.resetSubCategory = function(){
		$scope.subCategory={};
		$scope.subCategory.ID = "";
		$scope.subCategory.C_1 = "";
		$scope.subCategory.C_2 = "";
		$("#input_category").val('').trigger('change');
	}
	
	$scope.addNewSubCat = function(){
		$scope.subCategory={};
		$scope.subCategory.ID = "";
		$scope.subCategory.C_1 = "";
		$scope.subCategory.C_2 = "";
		$("#subCategoryModal").modal('show');
	}
	
	$scope.saveSubCategory = function(){
		
		var data = {};
	    data.subCategory = $scope.subCategory;
	    data.userId = userId;
    	var temp = $.param({details: data});
    	
		$http({
			data: temp+"&"+$scope.tokenHash, 
			url : site+"/saveAdminSubCategory",
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {
				
			
			if(data.done == true || data.done == 'true'){
				
				toastr.success(data.msg, '', {timeOut: 3000})
				$scope.getAllAdminCategorylov();
				$('#subCategoryModal').modal('hide');
				
			}else{
				toastr.error(data.msg, '', {timeOut: 3000})
			}

		})
		.error(function(data, status, headers, config) {
		});
	}

	$scope.continouRecordSubCate = function(id){
		
		var data = {};
	    data.recordId = id;
	    data.userId = userId;
    	var temp = $.param({details: data});
    	
		$http({
			data: temp+"&"+$scope.tokenHash, 
			url : site+"/editAdminSubCategory",
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {
				
			var detail = data.details;
			if(detail != '' && detail != null){
				
				$scope.subCategory.ID = detail['ID'];
				$scope.subCategory.C_1 = detail['CATEGORY_ID'];
				$scope.subCategory.C_2 = detail['NAME'];
				
				setTimeout(function(){
					$("#input_category").val($scope.subCategory.C_1).trigger('change');
				}, 500);
				
				$('#subCategoryModal').modal('show');
			}
		})
		.error(function(data, status, headers, config) {
		});
	}
	
	$scope.statusChangeSubCat = function(id){
		
		var data = {};
	    data.recordId = id;
	    data.userId = userId;
    	var temp = $.param({details: data});
    	
		$http({
			data: temp+"&"+$scope.tokenHash,
			url : site+"/changeStatusSubCategory",
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {
				
			toastr.success(data.msg, '', {timeOut: 3000})
			$scope.getAllAdminCategorylov();
			
		})
		.error(function(data, status, headers, config) {
		});
	}
	
	
	
	$scope.subSubCategory={};
	$scope.subSubCategory.ID = "";
	$scope.subSubCategory.C_1 = "";
	$scope.subSubCategory.C_2 = "";
	
	$scope.resetSubSubCategory = function(){
		$scope.subSubCategory={};
		$scope.subSubCategory.ID = "";
		$scope.subSubCategory.C_1 = "";
		$scope.subSubCategory.C_2 = "";
		$("#input_subcategory").val('').trigger('change');
	}
	
	$scope.addNewSubSubCat = function(){
		$scope.subSubCategory={};
		$scope.subSubCategory.ID = "";
		$scope.subSubCategory.C_1 = "";
		$scope.subSubCategory.C_2 = "";
		$("#subSubCategoryModal").modal('show');
	}
	
	$scope.saveSubSubCategory = function(){
		
		var data = {};
	    data.subSubCategory = $scope.subSubCategory;
	    data.userId = userId;
    	var temp = $.param({details: data});
    	
		$http({
			data: temp+"&"+$scope.tokenHash, 
			url : site+"/saveAdminSubSubCategory",
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {
				
			
			if(data.done == true || data.done == 'true'){
				
				toastr.success(data.msg, '', {timeOut: 3000})
				$scope.getAllAdminCategorylov();
				$('#subSubCategoryModal').modal('hide');
				
			}else{
				toastr.error(data.msg, '', {timeOut: 3000})
			}

		})
		.error(function(data, status, headers, config) {
		});
	}

	$scope.continouRecordSubSubCate = function(id){
		
		var data = {};
	    data.recordId = id;
	    data.userId = userId;
    	var temp = $.param({details: data});
    	
		$http({
			data: temp+"&"+$scope.tokenHash, 
			url : site+"/editAdminSubSubCategory",
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {
				
			var detail = data.details;
			if(detail != '' && detail != null){
				
				$scope.subSubCategory.ID = detail['ID'];
				$scope.subSubCategory.C_1 = detail['SUB_CATEGORY_ID'];
				$scope.subSubCategory.C_2 = detail['NAME'];
				
				setTimeout(function(){
					$("#input_subcategory").val($scope.subSubCategory.C_1).trigger('change');
				}, 500);
				
				$('#subSubCategoryModal').modal('show');
			}
		})
		.error(function(data, status, headers, config) {
		});
	}
	
	$scope.statusChangeSubSubCat = function(id){
		
		var data = {};
	    data.recordId = id;
	    data.userId = userId;
    	var temp = $.param({details: data});
    	
		$http({
			data: temp+"&"+$scope.tokenHash,
			url : site+"/changeStatusSubSubCategory",
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {
				
			toastr.success(data.msg, '', {timeOut: 3000})
			$scope.getAllAdminCategorylov();
			
		})
		.error(function(data, status, headers, config) {
		});
	}
	
	$scope.alertDeleteMsg = '';
	
	$scope.deleteCategoryRecord = function(id){
		
		var data = {};
	    data.recordId = id;
	    data.userId = userId;
    	var temp = $.param({details: data});
    	
		$http({
			data: temp+"&"+$scope.tokenHash,
			url : site+"/deleteCategoryRecord",
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {
				
			if(data.done == true || data.done == 'true'){
				
				toastr.success(data.msg, '', {timeOut: 3000})
				$scope.getAllAdminCategorylov();
				
			}else{
			
				$scope.alertDeleteMsg = data.msg;
				$("#alertDel").modal('show');
			}
		})
		.error(function(data, status, headers, config) {
		});
	}
	
	$scope.deleteSubCategoryRecord = function(id){
		
		var data = {};
	    data.recordId = id;
	    data.userId = userId;
    	var temp = $.param({details: data});
    	
		$http({
			data: temp+"&"+$scope.tokenHash,
			url : site+"/deleteSubCategoryRecord",
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {
				
			if(data.done == true || data.done == 'true'){
				
				toastr.success(data.msg, '', {timeOut: 3000})
				$scope.getAllAdminCategorylov();
				
			}else{
			
				$scope.alertDeleteMsg = data.msg;
				$("#alertDel").modal('show');
			}
		})
		.error(function(data, status, headers, config) {
		});
	}
	
	$scope.deleteSubSubCategoryRecord = function(id){
		
		var data = {};
	    data.recordId = id;
	    data.userId = userId;
    	var temp = $.param({details: data});
    	
		$http({
			data: temp+"&"+$scope.tokenHash,
			url : site+"/deleteSubSubCategoryRecord",
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {
				
			if(data.done == true || data.done == 'true'){
				
				toastr.success(data.msg, '', {timeOut: 3000})
				$scope.getAllAdminCategorylov();
				
			}else{
			
				$scope.alertDeleteMsg = data.msg;
				$("#alertDel").modal('show');
			}
		})
		.error(function(data, status, headers, config) {
		});
	}
	
	
	$scope.closealertDeleteModal = function(id){
		
		$("#alertDel").modal('hide');
		$scope.alertDeleteMsg = '';
		
	}
	
		
})
.config(function ($httpProvider, $provide) {
	$provide.factory('httpInterceptor', function ($q, $rootScope) {
		return {
			'request': function (config) {
                $.LoadingOverlay("show"); 

				$rootScope.$broadcast('httpRequest', config);
				return config || $q.when(config);
			},
			'response': function (response) {
				setTimeout(function(){
					$.LoadingOverlay("hide");
				}, 500);
				if(typeof response.data != 'object'){ //might have some error

					var temp = response.data.toLowerCase();
					if(temp.indexOf("error") >= 0){  //result may have error
						console.log("Response is not obj and has Error");
						$("div#error").html(response.data);
						jQuery("#errorModal").modal('show');
						return
					}

				}
				$rootScope.$broadcast('httpResponse', response);
				return response || $q.when(response);
			},
			'requestError': function (rejection) {
				console.log("requestError");
                $.LoadingOverlay("hide"); 
				$("div#error").html(rejection.data);
				jQuery("#errorModal").modal('show');
				$rootScope.$broadcast('httpRequestError', rejection);
				return $q.reject(rejection);
			},
			'responseError': function (rejection) {
				setTimeout(function(){
					$.LoadingOverlay("hide");
				}, 500);
				console.log("responseError");
				$("div#error").html(rejection.data);
				jQuery("#errorModal").modal('show');
				$rootScope.$broadcast('httpResponseError', rejection);
				return $q.reject(rejection);
			}
		};
	});
	$httpProvider.interceptors.push('httpInterceptor');
})


// 	$('#searchInListing').on("keyup", function (e)  {     
//            var tr = $('.identify');
//            
//            if ($(this).val().length >= 1) {//character limit in search box.
//                var noElem = true;
//                var val = $.trim(this.value).toLowerCase();
//                el = tr.filter(function() {
//                    return $(this).find('.grid-p-searchby').text().toLowerCase().match(val);
//                });
//                if (el.length >= 1) {
//                    noElem = false;
//                }
//                if(el.length<1) {
////    		            	$('#tabContentNoData').show();
//                } else {
////    		            	$('#tabContentNoData').hide();
////    		            	$('#tabContentData').show();
//                	}
//                tr.not(el).hide();
//                el.fadeIn();
//            } else {
//                tr.fadeIn();
//                if(veiwMoreShowGlobal==true){
//                }
//                else{
//                }
////    	            	$('#tabContentNoData').hide();
//                       
//            }
//        });




		
		
		
