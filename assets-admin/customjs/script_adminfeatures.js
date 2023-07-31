var myApp = angular.module('project1',["smart-table"], function(){});
myApp.controller('projectinfo1',function($scope,$compile,$rootScope,$timeout,$http,$window,$filter,$q,$routeParams) {



	$scope.ingredient={};
    $scope.feature={};
	$scope.feature.ID = "";
	$scope.feature.P_1 = "";
	$scope.ingredient.P_2 = "";
	$scope.ingredient.P_3 = "";
	$scope.ingredient.P_4 = "";


	$scope.editView = 0;
	$scope.tokenHash = $("#csrf").val();
	$scope.getAllAdminFeatureslov = function(){

		var data = {};
	    data.userId = userId;
	    data.ingredientId = $scope.ingredientId;
	    var temp = $.param({details: data});

		$http({
			data: temp+"&"+$scope.tokenHash,
			url : site+'/getAllAdminFeatureslov',
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {

			if ($.fn.DataTable.isDataTable("#featuresTable")) {
				$('#featuresTable').DataTable().clear().destroy();
			}

			$scope.displayCollection = data.list;

			setTimeout(function(){
				$("#featuresTable").DataTable({
					search: {
						return: true,
					},
					stateSave: true,
					order: [],
					rowReorder: {selector: 'span.reorder'},
					columnDefs: [
						{ orderable: true, className: 'reorder', targets: 0 },
						{ orderable: false, targets: '_all' }
					],
		            aLengthMenu: [
		                          [10, 25, 50, 100, 200, -1],
		                          [10, 25, 50, 100, 200, "All"]
		                      ]
				});
			}, 500);

//			if($scope.ingredientId != '' && data.details != ''){
//				$scope.editFlag = 1;
//				$scope.continouRecord(data.details);
//			}


		$( "#tablecontents" ).sortable({
			items: "tr",
			cursor: 'move',
			opacity: 0.6,
			update: function() {

				$scope.$apply(function () {
					$scope.sendOrderToServer();
				});

			}
		});

		})
		.error(function(data, status, headers, config) {
		});
	}
	$scope.getAllAdminFeatureslov();

	$scope.sendOrderToServer = function(){

		var order = [];

		// var token = $('meta[name="csrf-token"]').attr('content');
		var page_length = parseInt($('select[name="featuresTable_length"]').val());
		var current_page = parseInt($('.paginate_button.current').text());

		var postion_for = (current_page*page_length)-page_length;

		//  console.log(page_length,current_page);
		$('tr.row1').each(function(index,element) {
		  order.push({
			id: $(this).attr('data-id'),
			position_new: postion_for+(index+1),
			position: $(this).attr('data-seq')
			// position:index+1
		  });
		});


		var data = {};
	    data.order = order;
	    var temp = $.param({details: data});
		console.log(data);
		$http({
			data: temp+"&"+$scope.tokenHash,
			url : site+'/updateFeaturesOrder',
			// dataType: "json",
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {
			toastr.success(data.msg, '', {timeOut: 3000})
			$scope.getAllAdminFeatureslov();

		})
		.error(function(data, status, headers, config) {
		});

	  }

	$scope.reset = function(){
		$scope.ingredient={};
		$scope.Feature.ID = "";
		$scope.feature.P_1 = "";
		$scope.ingredient.P_2 = "";
		$scope.ingredient.P_3 = "";
		$scope.ingredient.P_4 = "";

		$("#p_att").html('');

		setTimeout(function(){
			$(".summernote").summernote("code", $scope.ingredient.P_4);
		}, 500);

	}

	$scope.addNew = function(){
		$scope.ingredient={};
		$scope.feature.ID = "";
		$scope.feature.P_1 = "";
		// $scope.ingredient.P_2 = "";
		// $scope.ingredient.P_3 = "";
		$scope.feature.P_4 = "";

		$("#p_att").html('');

		setTimeout(function(){
			$(".summernote").summernote("code", $scope.ingredient.P_4);
		}, 500);

		$scope.editView = 1;
	}
	$scope.backToListing = function(){
		$scope.getAllAdminFeatureslov();
		$('#summernote').summernote('code','');
		$scope.editView = 0;
	}
	$scope.saveFeature = function(){

		if ($('.summernote').summernote('isEmpty')) {
			$scope.feature.P_4 = '';
		}else{
			$scope.feature.P_4 = $('#summernote').summernote('code');
		}


	    	var data = {};
	        data.feature = $scope.feature;
	        data.userId = userId;
    	    var temp = $.param({details: data});

		$http({
			data: temp+"&"+$scope.tokenHash,
			url : site+"/saveAdminFeature",
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {

			if(data.done == true || data.done == 'true'){

				toastr.success(data.msg, '', {timeOut: 3000})
				$scope.feature.ID = data.ID;

				var image_div = $("#p_att").html();

				if(image_div != ''){
					$scope.editView = 0;
                	$scope.getAllAdminFeatureslov();
				}



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
			url : site+"/editAdminFeature",
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {

			var details = data.details;
			var images = data.images;

			$("#p_att").html('');

			if(details != '' && details != null){

				$scope.editView = 1;
				$scope.feature.ID = details['ID'];
				$scope.feature.P_1 = details['TITLE'];
				$scope.feature.P_4 = details['DESCRIPTION'];

				setTimeout(function(){
					$(".summernote").summernote("code", $scope.feature.P_4);
				}, 500);
			}

			if(images != '' && images != null){
				for(var i=0; i<images.length; i++){

					var html = '<div class="col-2 image-overlay margin-r1" id="img_file_'+images[i]["ID"]+'">'+
									'<img src="'+images[i]["downPath"]+'" alt="" class="image-box">'+
									'<div class="overlay">'+
										'<div class="text">'+
											'<img class="fa-trash-alt" src="'+baseurl+'/images/admin/trash.svg" alt="" width="18" ng-click="deletePic('+images[i]["ID"]+')" title="Delete Image">';

											if(images[i]["primFlag"] == '0'){
												html += '<img class="fa-pencil-alt" src="'+baseurl+'/images/admin/pencil-solid.svg" alt="" width="18" ng-click="markPrimary('+images[i]["ID"]+')" title="Mark Primary">';
											}

										html +=
										'</div>'+
									'</div>'+
								'</div>';

						$("#p_att").html($compile(angular.element(html))($scope));
				}
			}

		})
		.error(function(data, status, headers, config) {
		});
	}
$scope.markPrimary = function(id){

		var data = {};
	    data.recordId = id;
	    data.ingredientId = $scope.ingredient.ID;
	    data.userId = userId;
    	var temp = $.param({details: data});

		$http({
			data: temp+"&"+$scope.tokenHash,
			url : site+"/markPrimaryIngredientAttachment",
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {

			toastr.success(data.msg, '', {timeOut: 3000})

			var images = data.images;

			$("#p_att").html('');

			if(images != '' && images != null){
				for(var i=0; i<images.length; i++){

					var html = '<div class="col-2 image-overlay margin-r1" id="img_file_'+images[i]["ID"]+'">'+
									'<img src="'+images[i]["downPath"]+'" alt="" class="image-box">'+
									'<div class="overlay">'+
										'<div class="text">'+
											'<img class="fa-trash-alt" src="'+baseurl+'/images/admin/trash.svg" alt="" width="18" ng-click="deletePic('+images[i]["ID"]+')" title="Delete Image">';

											if(images[i]["primFlag"] == '0'){
												html += '<img class="fa-pencil-alt" src="'+baseurl+'/images/admin/pencil-solid.svg" alt="" width="18" ng-click="markPrimary('+images[i]["ID"]+')" title="Mark Primary">';
											}

									html +=
										'</div>'+
									'</div>'+
								'</div>';

						$("#p_att").append($compile(angular.element(html))($scope));
				}
			}

		})
		.error(function(data, status, headers, config) {
		});
	}
	$scope.deletePic = function(id){

		var data = {};
	    data.recordId = id;
	    data.ingredientId = $scope.ingredient.ID;
	    data.userId = userId;
    	var temp = $.param({details: data});

		$http({
			data: temp+"&"+$scope.tokenHash,
			url : site+"/deleteIngredientAttachment",
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {

			toastr.success(data.msg, '', {timeOut: 3000})

			var images = data.images;

			$("#p_att").html('');

			if(images != '' && images != null){
				for(var i=0; i<images.length; i++){

					var html = '<div class="col-2 image-overlay margin-r1" id="img_file_'+images[i]["ID"]+'">'+
									'<img src="'+images[i]["downPath"]+'" alt="" class="image-box">'+
									'<div class="overlay">'+
										'<div class="text">'+
											'<img class="fa-trash-alt" src="'+baseurl+'/images/admin/trash.svg" alt="" width="18" ng-click="deletePic('+images[i]["ID"]+')" title="Delete Image">';

											if(images[i]["primFlag"] == '0'){
												html += '<img class="fa-pencil-alt" src="'+baseurl+'/images/admin/pencil-solid.svg" alt="" width="18" ng-click="markPrimary('+images[i]["ID"]+')" title="Mark Primary">';
											}

									html +=
										'</div>'+
									'</div>'+
								'</div>';

						$("#p_att").append($compile(angular.element(html))($scope));
				}
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
			url : site+"/changeStatusFeature",
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {

			toastr.success(data.msg, '', {timeOut: 3000})
            $scope.getAllAdminFeatureslov();

		})
		.error(function(data, status, headers, config) {
		});
	}
	$scope.alertDeleteMsg = '';
	$scope.featureId = '';

	$scope.openAlertModel = function(id){

		$scope.featureId = id;
		$("#alertDel").modal('show');

	}

	$scope.deleteFeature = function(){

		var data = {};
	    data.recordId = $scope.featureId;
	    // data.userId = userId;
    	var temp = $.param({details: data});

		$http({
			data: temp+"&"+$scope.tokenHash,
			url : site+"/deleteFeature",
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {

			if(data.done == true || data.done == 'true'){
				$("#alertDel").modal('hide');

				toastr.success(data.msg, '', {timeOut: 3000})
				$scope.getAllAdminFeatureslov();
				$scope.featureId = '';

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
		$scope.featureId = '';

	}

	$('#uploadattch').fileupload({

 		add: function (e, data) {

 			if($scope.ingredient.ID == ""){

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

 	      		toastr.error("Error : Image dimension must be minimum 125 X 125", '', {timeOut: 3000});

 	      	}else{

 		  		toastr.success("Image Upload Successfully", '', {timeOut: 3000});

 		  		var html = '<div class="col-2 image-overlay margin-r1" id="img_file_'+xhr.responseText[1]+'">'+
								'<img src="'+xhr.responseText[2]+'" alt="" class="image-box">'+
								'<div class="overlay">'+
									'<div class="text">'+
										'<img class="fa-trash-alt" src="'+baseurl+'/images/admin/trash.svg" alt="" width="18" ng-click="deletePic('+xhr.responseText[1]+')" title="Delete Image">'+

									'</div>'+
								'</div>'+
							'</div>';

 		  		$("#p_att").html($compile(angular.element(html))($scope));
				$scope.$apply(() => {

					// $scope.editView = 0;
					$scope.getAllAdminFeatureslov();
				});
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







