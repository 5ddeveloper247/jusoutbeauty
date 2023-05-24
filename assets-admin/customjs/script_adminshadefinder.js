var myApp = angular.module('project1',["smart-table"], function(){});
myApp.controller('projectinfo1',function($scope,$compile,$rootScope,$timeout,$http,$window,$filter,$q,$routeParams) {

//	$(document).on('click','.addNew',function(){
//	    $('#addCity_modal').modal('show');return false; 
//	});

//	$(document).on('click','.modalClose',function(){
//	    $('#addCity_modal').modal('hide');return false; 
//	});
	
	$scope.option={};
	$scope.option.ID = optionId;
	$scope.option.P_1 = "";
	$scope.option.P_2 = "";
	
	$scope.level1={};
	$scope.level1.ID = "";
	$scope.level1.L_1 = "";
	$scope.level1.L_2 = "";
	
//	$scope.ingredientId = ingredientId;

//	$scope.editView = 0;

	$scope.tokenHash = $("#csrf").val();
	
	$scope.getAllAdminShadeFinderlov = function(){
		
		var data = {};
	    data.userId = userId;
	    data.optionId = $scope.option.ID;
	    var temp = $.param({details: data});
    	
		$http({
			data: temp+"&"+$scope.tokenHash,
			url : site+'/getAllAdminShadeFinderlov',
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {
			
			$scope.productsLov = data.list1;
			
			$scope.option = data.optionDetail;
			
			if(data.level1Detail != null){
				$scope.level1 = data.level1Detail;
			}
			
			if(data.level2Detail != null){
				$scope.level2 = data.level2Detail;
			}
			if(data.level3Detail != null){
				$scope.level3 = data.level3Detail;
			}
			
			if ($.fn.DataTable.isDataTable("#levelOneTypesTable")) {
				$('#levelOneTypesTable').DataTable().clear().destroy();
			}
			if ($.fn.DataTable.isDataTable("#levelTwoTypesTable")) {
				$('#levelTwoTypesTable').DataTable().clear().destroy();
			}
			if ($.fn.DataTable.isDataTable("#levelThreeTypesTable")) {
				$('#levelThreeTypesTable').DataTable().clear().destroy();
			}
			
			$scope.displayCollection = data.level1TypeListing;
			$scope.displayCollectionLevelTwoType = data.level2TypeListing;
			$scope.displayCollectionLevelThreeType = data.level3TypeListing;
			
			setTimeout(function(){
				$("#levelOneTypesTable").DataTable();
				$("#levelTwoTypesTable").DataTable();
				$("#levelThreeTypesTable").DataTable();
			}, 500);
			
		})
		.error(function(data, status, headers, config) {
		});
	}
	$scope.getAllAdminShadeFinderlov();
		
	
	$scope.saveOptionInfo = function(){
		
		var data = {};
	    data.option = $scope.option;
	    data.userId = userId;
    	var temp = $.param({details: data});
    	
		$http({
			data: temp+"&"+$scope.tokenHash, 
			url : site+"/saveAdminShadeFinderOptionInfo",
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {
				
			if(data.done == true || data.done == 'true'){
				
				toastr.success(data.msg, '', {timeOut: 3000})
				
			}else{
				toastr.error(data.msg, '', {timeOut: 3000})
			}
		})
		.error(function(data, status, headers, config) {
		});
	}
	
	$scope.saveShadeFinderLevel1Info = function(){
		
		var data = {};
		data.option = $scope.option;
	    data.level1 = $scope.level1;
	    data.userId = userId;
    	var temp = $.param({details: data});
    	
		$http({
			data: temp+"&"+$scope.tokenHash, 
			url : site+"/saveAdminShadeFinderLevel1Info",
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {
				
			if(data.done == true || data.done == 'true'){
				
				toastr.success(data.msg, '', {timeOut: 3000})
				$scope.level1.ID = data.ID;
				
			}else{
				toastr.error(data.msg, '', {timeOut: 3000})
			}
		})
		.error(function(data, status, headers, config) {
		});
	}

	$scope.level1Type={};
	$scope.level1Type.ID = "";
	$scope.level1Type.LT_1 = "";
	$scope.level1Type.LT_2 = "";
	$scope.level1Type.LT_3 = "";
	$scope.level1Type.LT_4 = "";
	
	$scope.addNewLevel1Type = function(){
	
		if($scope.level1.ID == ''){
			toastr.error('Save Level One info first, then proceed.', '', {timeOut: 3000});
			return;
		}else{
			
			$scope.level1Type={};
			$scope.level1Type.ID = "";
			$scope.level1Type.LT_1 = "";
			$scope.level1Type.LT_2 = "";
			$scope.level1Type.LT_3 = "";
			$scope.level1Type.LT_4 = "";
			
			$("#p_att").html('');
			
			setTimeout(function(){
				$("#LT2").val('').trigger('change');
				$("#LT3").val('').trigger('change');
				$("#levelType_description").summernote("code", '');
			}, 500);
			
			$("#addLevelOneLines_container").slideToggle("slow");
			$("#addLevelTwoLines_container").slideUp("slow");
			$("#addLevelThreeLines_container").slideUp("slow");
		}
	}
	$scope.closeAddNewLevel1Type = function(){
		$("#addLevelOneLines_container").slideUp("slow");
	}
	$scope.saveShadeFinderLevel1TypeInfo = function(){
		
		if($scope.level1.ID == ''){
			toastr.error('Save Level One info first, then proceed.', '', {timeOut: 3000});
			return;
		}
		if ($('#levelType_description').summernote('isEmpty')) {
			$scope.level1Type.LT_4 = '';
		}else{
			$scope.level1Type.LT_4 = $('#levelType_description').summernote('code');
		}
		
		var data = {};
		data.option = $scope.option;
		data.level1 = $scope.level1;
		data.level1Type = $scope.level1Type;
	    data.userId = userId;
	   
    	var temp = $.param({details: data});
    	
		$http({
			data: temp+"&"+$scope.tokenHash, 
			url : site+"/saveAdminShadeFinderLevel1TypeInfo",
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {
				
			if(data.done == true || data.done == 'true'){
				
				toastr.success(data.msg, '', {timeOut: 3000})
				$scope.level1Type.ID = data.ID;

				if ($.fn.DataTable.isDataTable("#levelOneTypesTable")) {
					$('#levelOneTypesTable').DataTable().clear().destroy();
				}
				
				$scope.displayCollection = data.level1TypeListing;
				
				setTimeout(function(){
					$("#levelOneTypesTable").DataTable();
				}, 500);
				
				$("#addLevelTwoLines_container").slideUp("slow");
				
			}else{
				toastr.error(data.msg, '', {timeOut: 3000})
			}
		})
		.error(function(data, status, headers, config) {
		});
	}
	
	$scope.continueRecordLevel1Type = function(id){
		
		var data = {};
	    data.recordId = id;
	    data.userId = userId;
    	var temp = $.param({details: data});
    	
		$http({
			data: temp+"&"+$scope.tokenHash,
			url : site+"/editAdminShadeFinderLevel1Type",
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {
				
			var details = data.details;
			
			if(details != '' && details != null){
				
				$("#addLevelOneLines_container").slideDown("slow");
				
				$scope.level1Type = details;
				setTimeout(function(){
					$("#LT2").val($scope.level1Type.LT_2).trigger('change');
					$("#LT3").val($scope.level1Type.LT_3).trigger('change');
					$("#levelType_description").summernote("code", $scope.level1Type.LT_4);
				}, 500);
			}

			$scope.makeImageAttachmentHtml(data.images);
			
		})
		.error(function(data, status, headers, config) {
		});
	}
	$scope.makeImageAttachmentHtml = function(images){
		
		$("#p_att").html('');
		
		if(images != '' && images != null){
			
			for(var i=0; i<images.length; i++){
				
				var html = '<div class="col-2 image-overlay margin-r1" id="img_file_'+images[i]["ID"]+'">'+
								'<img src="'+images[i]["downPath"]+'" alt="" class="image-box">'+
								'<div class="overlay">'+
									'<div class="text">'+
										'<img class="fa-trash-alt" src="'+baseurl+'/images/admin/trash.svg" alt="" width="18" ng-click="deleteLevel1TypeImage('+images[i]["ID"]+')" title="Delete Image">'+
										
										'<div class="arrow-icon-move-box">'+
											'<img class="arrow-center" src="'+baseurl+'/images/admin/feather-move.svg" alt="">'+
											'<p>Move Position</p>'+
										'</div>'+
									'</div>'+
								'</div>'+
							'</div>';
					
					$("#p_att").append($compile(angular.element(html))($scope));
			}
		}
	}
	$scope.deleteRecordLevel1Type = function(id){
		
		var data = {};
	    data.recordId = id;
	    data.level1ID = $scope.level1.ID;
	    data.userId = userId;
    	var temp = $.param({details: data});
    	
		$http({
			data: temp+"&"+$scope.tokenHash,
			url : site+"/deleteShadeFinderLevel1Type",
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {
				
			if(data.done == true || data.done == 'true'){
			
				toastr.success(data.msg, '', {timeOut: 3000})
				
				$("#addLevelOneLines_container").slideUp("slow");
				
				if ($.fn.DataTable.isDataTable("#levelOneTypesTable")) {
					$('#levelOneTypesTable').DataTable().clear().destroy();
				}
				
				$scope.displayCollection = data.level1TypeListing;
				
				setTimeout(function(){
					$("#levelOneTypesTable").DataTable();
				}, 500);
				
			}else{
				
				toastr.error(data.msg, '', {timeOut: 3000})
			}
		})
		.error(function(data, status, headers, config) {
		});
	}
	$scope.deleteLevel1TypeImage = function(id){
		
		var data = {};
	    data.imageId = id;
	    data.level1TypeId = $scope.level1Type.ID;
	    data.userId = userId;
    	var temp = $.param({details: data});
    	
		$http({
			data: temp+"&"+$scope.tokenHash,
			url : site+"/deleteLevel1TypeImage",
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {
				
			toastr.success(data.msg, '', {timeOut: 3000})
			
			$scope.makeImageAttachmentHtml(data.images);
			
		})
		.error(function(data, status, headers, config) {
		});
	}
	
	$scope.level2={};
	$scope.level2.ID = "";
	$scope.level2.L_1 = "";
	$scope.level2.L_2 = "";

	$scope.saveShadeFinderLevel2Info = function(){
		
		var data = {};
		data.option = $scope.option;
	    data.level2 = $scope.level2;
	    data.userId = userId;
    	var temp = $.param({details: data});
    	
		$http({
			data: temp+"&"+$scope.tokenHash, 
			url : site+"/saveAdminShadeFinderLevel2Info",
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {
				
			if(data.done == true || data.done == 'true'){
				
				toastr.success(data.msg, '', {timeOut: 3000})
				$scope.level2.ID = data.ID;
				
			}else{
				toastr.error(data.msg, '', {timeOut: 3000})
			}
		})
		.error(function(data, status, headers, config) {
		});
	}
	
	$scope.level2Type={};
	$scope.level2Type.ID = "";
	$scope.level2Type.LT_1 = "";
	$scope.level2Type.LT_2 = "";
	$scope.level2Type.LT_3 = "";
	
	$scope.addNewLevel2Type = function(){
	
		if($scope.level2.ID == ''){
			toastr.error('Save Level Two info first, then proceed.', '', {timeOut: 3000});
			return;
		}else{
			
			$scope.level2Type={};
			$scope.level2Type.ID = "";
			$scope.level2Type.LT_1 = "";
			$scope.level2Type.LT_2 = "";
			$scope.level2Type.LT_3 = "";
			
			setTimeout(function(){
				$("#LT2_2").val('').trigger('change');
				$("#level2Type_description").summernote("code", '');
			}, 500);
			
			$("#addLevelOneLines_container").slideToggle("slow");
			$("#addLevelTwoLines_container").slideToggle("slow");
			$("#addLevelThreeLines_container").slideUp("slow");
			
			var data = {};
			data.option = $scope.option;
		    data.level1Id = $scope.level1.ID;
		    data.userId = userId;
	    	var temp = $.param({details: data});
	    	
			$http({
				data: temp+"&"+$scope.tokenHash, 
				url : site+"/getLevel1TypeLovForLevel2Type",
				method: "POST",
				async: false,
				headers: {'Content-Type': 'application/x-www-form-urlencoded'}

			}).success(function(data, status, headers, config) {
					
				$scope.levelOneTypeLov  = data.level1TypeLov;
				
			})
			.error(function(data, status, headers, config) {
			});
		}
	}
	$scope.closeAddNewLevel2Type = function(){
		$("#addLevelTwoLines_container").slideUp("slow");
	}
	$scope.saveShadeFinderLevel2TypeInfo = function(){
		
		if($scope.level2.ID == ''){
			toastr.error('Save Level Two info first, then proceed.', '', {timeOut: 3000});
			return;
		}
		if ($('#level2Type_description').summernote('isEmpty')) {
			$scope.level2Type.LT_3 = '';
		}else{
			$scope.level2Type.LT_3 = $('#level2Type_description').summernote('code');
		}
		
		var data = {};
		data.option = $scope.option;
		data.level2 = $scope.level2;
		data.level2Type = $scope.level2Type;
	    data.userId = userId;
	   
    	var temp = $.param({details: data});
    	
		$http({
			data: temp+"&"+$scope.tokenHash, 
			url : site+"/saveAdminShadeFinderLevel2TypeInfo",
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {
				
			if(data.done == true || data.done == 'true'){
				
				toastr.success(data.msg, '', {timeOut: 3000})
//				$scope.level2Type.ID = data.ID;

				$scope.level2Type={};
				$scope.level2Type.ID = "";
				$scope.level2Type.LT_1 = "";
				$scope.level2Type.LT_2 = "";
				$scope.level2Type.LT_3 = "";
				
				setTimeout(function(){
					$("#LT2_2").val('').trigger('change');
					$("#level2Type_description").summernote("code", '');
				}, 500);
				
				$("#addLevelTwoLines_container").slideToggle("slow");
			
				if ($.fn.DataTable.isDataTable("#levelTwoTypesTable")) {
					$('#levelTwoTypesTable').DataTable().clear().destroy();
				}
				
				$scope.displayCollectionLevelTwoType = data.level2TypeListing;
				
				setTimeout(function(){
					$("#levelTwoTypesTable").DataTable();
				}, 500);
				
			}else{
				toastr.error(data.msg, '', {timeOut: 3000})
			}
		})
		.error(function(data, status, headers, config) {
		});
	}
	
	$scope.continueRecordLevel2Type = function(id){
		
		var data = {};
	    data.recordId = id;
	    data.level1Id = $scope.level1.ID;
	    data.userId = userId;
    	var temp = $.param({details: data});
    	
		$http({
			data: temp+"&"+$scope.tokenHash,
			url : site+"/editAdminShadeFinderLevel2Type",
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {
				
			var details = data.details;
			
			$scope.levelOneTypeLov = data.level1TypeLov;
			
			if(details != '' && details != null){
				
				$("#addLevelTwoLines_container").slideDown("slow");
				
				$scope.level2Type = details;
				setTimeout(function(){
					$("#LT2_2").val($scope.level2Type.LT_2).trigger('change');
					$("#level2Type_description").summernote("code", $scope.level2Type.LT_3);
				}, 500);
			}
		})
		.error(function(data, status, headers, config) {
		});
	}
	$scope.deleteRecordLevel2Type = function(id){
		
		var data = {};
	    data.recordId = id;
	    data.level2ID = $scope.level2.ID;
	    data.userId = userId;
    	var temp = $.param({details: data});
    	
		$http({
			data: temp+"&"+$scope.tokenHash,
			url : site+"/deleteShadeFinderLevel2Type",
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {
				
			if(data.done == true || data.done == 'true'){
				
				toastr.success(data.msg, '', {timeOut: 3000})
				
				$("#addLevelTwoLines_container").slideUp("slow");
				
				if ($.fn.DataTable.isDataTable("#levelTwoTypesTable")) {
					$('#levelTwoTypesTable').DataTable().clear().destroy();
				}
				
				$scope.displayCollectionLevelTwoType = data.level2TypeListing;
				
				setTimeout(function(){
					$("#levelTwoTypesTable").DataTable();
				}, 500);
			}else{
				
				toastr.error(data.msg, '', {timeOut: 3000})
			}
			
			
		})
		.error(function(data, status, headers, config) {
		});
	}
	
	$scope.level3={};
	$scope.level3.ID = "";
	$scope.level3.L_1 = "";
	$scope.level3.L_2 = "";

	$scope.saveShadeFinderLevel3Info = function(){
		
		var data = {};
		data.option = $scope.option;
	    data.level3 = $scope.level3;
	    data.userId = userId;
    	var temp = $.param({details: data});
    	
		$http({
			data: temp+"&"+$scope.tokenHash, 
			url : site+"/saveAdminShadeFinderLevel3Info",
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {
				
			if(data.done == true || data.done == 'true'){
				
				toastr.success(data.msg, '', {timeOut: 3000})
				$scope.level3.ID = data.ID;
				
			}else{
				toastr.error(data.msg, '', {timeOut: 3000})
			}
		})
		.error(function(data, status, headers, config) {
		});
	}
	
	
	$scope.level3Type={};
	$scope.level3Type.ID = "";
	$scope.level3Type.LT_1 = "";
	$scope.level3Type.LT_2 = "";
	$scope.level3Type.LT_3 = "";
	$scope.level3Type.LT_4 = "";
	$scope.level3Type.LT_5 = "";
	
	$scope.addNewLevel3Type = function(){
	
		if($scope.level3.ID == ''){
			toastr.error('Save Level Three info first, then proceed.', '', {timeOut: 3000});
			return;
		}else{
			
			$scope.level3Type={};
			$scope.level3Type.ID = "";
			$scope.level3Type.LT_1 = "";
			$scope.level3Type.LT_2 = "";
			$scope.level3Type.LT_3 = "";
			$scope.level3Type.LT_4 = "";
			$scope.level3Type.LT_5 = "";
			
			setTimeout(function(){
				$("#LT3_2").val('').trigger('change');
				$("#LT3_3").val('').trigger('change');
				$("#LT3_4").val('').trigger('change');
				$("#level3Type_description").summernote("code", '');
			}, 500);
			
			$("#addLevelOneLines_container").slideUp("slow");
			$("#addLevelTwoLines_container").slideUp("slow");
			$("#addLevelThreeLines_container").slideToggle("slow");
			
			
			var data = {};
			data.option = $scope.option;
		    data.level2Id = $scope.level2.ID;
		    data.userId = userId;
	    	var temp = $.param({details: data});
	    	
			$http({
				data: temp+"&"+$scope.tokenHash, 
				url : site+"/getLevel2TypeLovForLevel3Type",
				method: "POST",
				async: false,
				headers: {'Content-Type': 'application/x-www-form-urlencoded'}

			}).success(function(data, status, headers, config) {
					
				$scope.levelTwoTypeLov  = data.level2TypeLov;
				
			})
			.error(function(data, status, headers, config) {
			});
		}
	}
	$scope.closeAddNewLevel3Type = function(){
		$("#addLevelThreeLines_container").slideUp("slow");
	}
	$scope.saveShadeFinderLevel3TypeInfo = function(){
		
		if($scope.level3.ID == ''){
			toastr.error('Save Leve Three info first, then proceed.', '', {timeOut: 3000});
			return;
		}
		if ($('#level3Type_description').summernote('isEmpty')) {
			$scope.level3Type.LT_5 = '';
		}else{
			$scope.level3Type.LT_5 = $('#level3Type_description').summernote('code');
		}
		
		var data = {};
		data.option = $scope.option;
		data.level3 = $scope.level3;
		data.level3Type = $scope.level3Type;
	    data.userId = userId;
	   
    	var temp = $.param({details: data});
    	
		$http({
			data: temp+"&"+$scope.tokenHash, 
			url : site+"/saveAdminShadeFinderLevel3TypeInfo",
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {
				
			if(data.done == true || data.done == 'true'){
				
				toastr.success(data.msg, '', {timeOut: 3000})
//				$scope.level2Type.ID = data.ID;

				$scope.level3Type={};
				$scope.level3Type.ID = "";
				$scope.level3Type.LT_1 = "";
				$scope.level3Type.LT_2 = "";
				$scope.level3Type.LT_3 = "";
				$scope.level3Type.LT_4 = "";
				$scope.level3Type.LT_5 = "";
				
				setTimeout(function(){
					$("#LT3_2").val('').trigger('change');
					$("#LT3_3").val('').trigger('change');
					$("#LT3_4").val('').trigger('change');
					$("#level3Type_description").summernote("code", '');
				}, 500);
				
				$("#addLevelThreeLines_container").slideToggle("slow");
			
				if ($.fn.DataTable.isDataTable("#levelThreeTypesTable")) {
					$('#levelThreeTypesTable').DataTable().clear().destroy();
				}
				
				$scope.displayCollectionLevelThreeType = data.level3TypeListing;
				
				setTimeout(function(){
					$("#levelThreeTypesTable").DataTable();
				}, 500);
				
			}else{
				toastr.error(data.msg, '', {timeOut: 3000})
			}
		})
		.error(function(data, status, headers, config) {
		});
	}
	
	$scope.continueRecordLevel3Type = function(id){
		
		var data = {};
	    data.recordId = id;
	    data.level2Id = $scope.level2.ID;
	    data.userId = userId;
    	var temp = $.param({details: data});
    	
		$http({
			data: temp+"&"+$scope.tokenHash,
			url : site+"/editAdminShadeFinderLevel3Type",
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {
				
			var details = data.details;
			
			$scope.levelTwoTypeLov = data.level2TypeLov;
			
			if(details != '' && details != null){
				
				$("#addLevelThreeLines_container").slideDown("slow");
				
				$scope.level3Type = details;
				setTimeout(function(){
					$("#LT3_2").val($scope.level3Type.LT_2).trigger('change');
					$("#LT3_3").val($scope.level3Type.LT_3).trigger('change');
					$("#LT3_4").val($scope.level3Type.LT_4).trigger('change');
					$("#level3Type_description").summernote("code", $scope.level2Type.LT_3);
				}, 500);
			}
		})
		.error(function(data, status, headers, config) {
		});
	}
	$scope.deleteRecordLevel3Type = function(id){
		
		var data = {};
	    data.recordId = id;
	    data.level3ID = $scope.level3.ID;
	    data.userId = userId;
    	var temp = $.param({details: data});
    	
		$http({
			data: temp+"&"+$scope.tokenHash,
			url : site+"/deleteShadeFinderLevel3Type",
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {
				
			toastr.success(data.msg, '', {timeOut: 3000})
			
			$("#addLevelThreeLines_container").slideUp("slow");
			
			if ($.fn.DataTable.isDataTable("#levelThreeTypesTable")) {
				$('#levelThreeTypesTable').DataTable().clear().destroy();
			}
			
			$scope.displayCollectionLevelThreeType = data.level3TypeListing;
			
			setTimeout(function(){
				$("#levelThreeTypesTable").DataTable();
			}, 500);
			
		})
		.error(function(data, status, headers, config) {
		});
	}
	
	$('#uploadattch').fileupload({
		
 		add: function (e, data) {
 		    
 			if($scope.level1Type.ID == ""){
 				
 				toastr.error('Save record first, then upload Images...', '', {timeOut: 3000})
 				return false;
 			
 			}else{
 				$.LoadingOverlay("show"); 
 				var jqXHR = data.submit();
 			}
 	    },
 		beforeSend: function() {

 		},
 	    uploadProgress: function(event, position, total, percentComplete) {

 	    },
 	    success: function() {

 	    },
 	    complete: function(xhr) {

 	    	setTimeout(function(){
				$.LoadingOverlay("hide");
			}, 500);
 	    	
 	    	xhr.responseText = jQuery.parseJSON(xhr.responseText);
 	      	
 	    	if(xhr.responseText[0] == 01){
 	        	
 	      		toastr.error("Error: Invalid File Format", '', {timeOut: 3000});

 	      	}else if(xhr.responseText[0] == 02){
 	        	
 	      		toastr.error("Error : Unable To upload", '', {timeOut: 3000});

 	      	}else if(xhr.responseText[0] == 03){
 	        
 	      		toastr.error("Error : Save record first, then upload Images...", '', {timeOut: 3000});

 	      	}else if(xhr.responseText[0] == 04){
 	        
 	      		toastr.error("Error : Only 3 images allowed to upload against each type...", '', {timeOut: 3000});

 	      	}else if(xhr.responseText[0] == 05){
 	        
 	      		toastr.error("Error : Image dimension must be minimum 200 X 300", '', {timeOut: 3000});

 	      	}else{

 		  		toastr.success("Image Upload Successfully", '', {timeOut: 3000});
 			    
 		  		var html = '<div class="col-2 image-overlay margin-r1" id="img_file_'+xhr.responseText[1]+'">'+
								'<img src="'+xhr.responseText[2]+'" alt="" class="image-box">'+
								'<div class="overlay">'+
									'<div class="text">'+
										'<img class="fa-trash-alt" src="'+baseurl+'/images/admin/trash.svg" alt="" width="18" ng-click="deleteLevel1TypeImage('+xhr.responseText[1]+')" title="Delete Image">'+
										'<div class="arrow-icon-move-box">'+
											'<img class="arrow-center" src="'+baseurl+'/images/admin/feather-move.svg" alt="">'+
											'<p>Move Position</p>'+
										'</div>'+
									'</div>'+
								'</div>'+
							'</div>';
 		  		
 		  		$("#p_att").append($compile(angular.element(html))($scope));

 	      	}
 	   	}
 	});
		
	
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




		
		
		
