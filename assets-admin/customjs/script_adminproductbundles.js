var myApp = angular.module('project1',["smart-table"], function(){});
myApp.controller('projectinfo1',function($scope,$compile,$rootScope,$timeout,$http,$window,$filter,$q,$routeParams) {

//	$(document).on('click','.addNew',function(){
//	    $('#addCity_modal').modal('show');return false;
//	});

//	$(document).on('click','.modalClose',function(){
//	    $('#addCity_modal').modal('hide');return false;
//	});

	$scope.bundle={};
	$scope.bundle.ID = "";
	$scope.bundle.P_1 = "";		//Name
	$scope.bundle.P_2 = "";		//Sub Title
	$scope.bundle.P_3 = "";		//Unit
	$scope.bundle.P_4 = "";		//Minimum Purchase Qty
	$scope.bundle.P_5 = "";		//Tags
	$scope.bundle.P_6 = "";		//Barcode
	$scope.bundle.P_7 = true;	//Refundable
	$scope.bundle.P_8 = "";		//Category
	$scope.bundle.P_9 = "";		//Sub Category
	$scope.bundle.P_10 = "";	//Slug
	$scope.bundle.P_11 = "";	//Sub Sub Category
	$scope.bundle.P_12 = "";	//VAT Rate
	$scope.bundle.P_13 = "";	//Total Amount
	$scope.bundle.P_14 = "";	//Short Description
	$scope.bundle.P_15 = "";	//Discounted Amount
	$scope.bundle.P_16 = "";	//Inv. Quantity
	$scope.bundle.image = '';	//bundle image

	$scope.editView = 0;

	$scope.tokenHash = $("#csrf").val();

	$scope.getAllAdminProductBundlelov = function(){

		var data = {};
	    data.userId = userId;
	    var temp = $.param({details: data});

		$http({
			data: temp+"&"+$scope.tokenHash,
			url : site+'/getAllAdminProductBundlelov',
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {

			$scope.categoryLov = data.list1;
			$scope.productsLov = data.list2;
			$scope.subCategoryLov = {};
			if ($.fn.DataTable.isDataTable("#bundlesTable")) {
				$('#bundlesTable').DataTable().clear().destroy();
			}

			$scope.displayCollection = data.list;

			setTimeout(function(){
				$('#bundlesTable').DataTable( {
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
		        } );
			}, 500);

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
	$scope.getAllAdminProductBundlelov();

	$scope.sendOrderToServer = function(){

		var order = [];

		// var token = $('meta[name="csrf-token"]').attr('content');
		var page_length = parseInt($('select[name="bundlesTable_length"]').val());
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
			url : site+'/updateBundleOrder',
			// dataType: "json",
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {
			toastr.success(data.msg, '', {timeOut: 3000})
			$scope.getAllAdminProductBundlelov();

		})
		.error(function(data, status, headers, config) {
		});

	  }

	$scope.reset = function(){
		$scope.bundle={};
		$scope.bundle.ID = "";
		$scope.bundle.P_1 = "";		//Name
		$scope.bundle.P_2 = "";		//Sub Title
		$scope.bundle.P_3 = "";		//Unit
		$scope.bundle.P_4 = "";		//Minimum Purchase Qty
		$scope.bundle.P_5 = "";		//Tags
		$scope.bundle.P_6 = "";		//Barcode
		$scope.bundle.P_7 = true;	//Refundable
		$scope.bundle.P_8 = "";		//Category
		$scope.bundle.P_9 = "";		//Sub Category
		$scope.bundle.P_10 = "";	//Slug
		$scope.bundle.P_11 = "";	//Sub Sub Category
		$scope.bundle.P_12 = "";	//VAT Rate
		$scope.bundle.P_13 = "";	//Total Amount
		$scope.bundle.P_14 = "";	//Short Description
		$scope.bundle.P_15 = "";	//Discounted Amount
		$scope.bundle.P_16 = "";	//Inv. Quantity
		$scope.bundle.image = '';	//bundle image

		$("#p4").val('').trigger('change');
		$("#p8").val('').trigger('change');
		$("#p9").val('').trigger('change');
		$("#p11").val('').trigger('change');
	}

	$scope.addNew = function(){

		$scope.bundle={};
		$scope.bundle.ID = "";
		$scope.bundle.P_1 = "";		//Name
		$scope.bundle.P_2 = "";		//Sub Title
		$scope.bundle.P_3 = "";		//Unit
		$scope.bundle.P_4 = "";		//Minimum Purchase Qty
		$scope.bundle.P_5 = "";		//Tags
		$scope.bundle.P_6 = "";		//Barcode
		$scope.bundle.P_7 = true;	//Refundable
		$scope.bundle.P_8 = "";		//Category
		$scope.bundle.P_9 = "";		//Sub Category
		$scope.bundle.P_10 = "";	//Slug
		$scope.bundle.P_11 = "";	//Sub Sub Category
		$scope.bundle.P_12 = "";	//VAT Rate
		$scope.bundle.P_13 = "";	//Total Amount
		$scope.bundle.P_14 = "";	//Short Description
		$scope.bundle.P_15 = "";	//Discounted Amount
		$scope.bundle.P_16 = "";	//Inv. Quantity
		$scope.bundle.image = '';	//bundle image

		$("#p4").val('').trigger('change');
//		$("#p8").val('').trigger('change');
//		$("#p9").val('').trigger('change');
//		$("#p11").val('').trigger('change');

//		$scope.product = {};
		$scope.subCategoryLov = {};
		$scope.subSubCategoryLov = {};

		$scope.editView = 1;
	}
	$scope.backToListing = function(){
		$scope.getAllAdminProductBundlelov();
		$scope.editView = 0;
	}
	$scope.saveProductBundleBasic = function(){

		var data = {};
	    data.bundle = $scope.bundle;
	    data.userId = userId;

    	var temp = $.param({details: data});

		$http({
			data: temp+"&"+$scope.tokenHash,
			url : site+"/saveAdminBundleProductBasicInfo",
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {

			if(data.done == true || data.done == 'true'){

				toastr.success(data.msg, '', {timeOut: 3000})
				$scope.bundle.ID = data.ID;

			}else{
				toastr.error(data.msg, '', {timeOut: 3000})
			}
		})
		.error(function(data, status, headers, config) {
		});
	}

	$scope.continouRecord = function(id){

		var data = {};
	    data.bundleId = id;
	    data.userId = userId;
    	var temp = $.param({details: data});

		$http({
			data: temp+"&"+$scope.tokenHash,
			url : site+"/editAdminBundleProduct",
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {

			if(data.details != '' && data.details != null){
                console.log(data);

				if ($.fn.DataTable.isDataTable("#productsTable")) {
					$('#productsTable').DataTable().clear().destroy();
				}

				$scope.editView = 1;
				$scope.bundle = data.details;
				$scope.subCategoryLov = data.subCategory;
				$scope.subSubCategoryLov = data.subSubCategory;

				$scope.displayCollectionProducts = data.bundleLines;
                console.log(data.details.images);
                $scope.makeImageAttachment(data.details.images);
				setTimeout(function(){
					$("#productsTable").DataTable({
						order: [],
			            aLengthMenu: [
			                          [10, 25, 50, 100, 200, -1],
			                          [10, 25, 50, 100, 200, "All"]
			                      ]
					});
				}, 500);

				setTimeout(function(){
					$("#p4").val($scope.bundle.P_4).trigger('change');
					$("#p8").val($scope.bundle.P_8).trigger('change');
					$("#p9").val($scope.bundle.P_9).trigger('change');
					$("#p11").val($scope.bundle.P_11).trigger('change');
				}, 500);
			}
		})
		.error(function(data, status, headers, config) {
		});
	}

	$scope.deleteBundleImage = function(id){

		var data = {};
	    data.bundleId = $scope.bundle.ID;
	    data.userId = userId;
    	var temp = $.param({details: data});

		$http({
			data: temp+"&"+$scope.tokenHash,
			url : site+"/deleteBundleProductImage",
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {

			toastr.success(data.msg, '', {timeOut: 3000})

			$scope.bundle.image = '';

		})
		.error(function(data, status, headers, config) {
		});
	}
	$scope.product = {};
	$scope.product.ID = '';
	$scope.product.P_1 = '';

	$scope.addProduct = function(){

		if($scope.bundle.ID != ''){

			$scope.product = {};
			$scope.product.ID = '';
			$scope.product.P_1 = '';

			$("#bp1").val($scope.product.P_1).trigger('change');
			$("#productsModal").modal('show');

		}else{
			toastr.error('Save Basic Info first, then upload Images...', '', {timeOut: 3000})
		}
	}
	$scope.closeProductModal = function(){

		$scope.product = {};
		$scope.product.ID = '';
		$scope.product.P_1 = '';
		$("#bp1").val($scope.product.P_1).trigger('change');
		$('#productsModal').modal('hide');
	}

	$scope.saveBundleProductLine = function(){

		if($scope.bundle.ID == ''){
			toastr.error('Save Basic Info first, then upload Images...', '', {timeOut: 3000})
			return;
		}

		var data = {};
	    data.bundleId = $scope.bundle.ID;
	    data.product = $scope.product;
	    data.userId = userId;

    	var temp = $.param({details: data});

		$http({
			data: temp+"&"+$scope.tokenHash,
			url : site+"/saveAdminBundleProductLine",
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {

			if(data.done == true || data.done == 'true'){

				toastr.success(data.msg, '', {timeOut: 3000})

				$scope.closeProductModal();
				$scope.continouRecord($scope.bundle.ID);

				// if ($.fn.DataTable.isDataTable("#productsTable")) {
				// 	$('#productsTable').DataTable().clear().destroy();
				// }

				$scope.getAllAdminProductBundlelov();

				// $scope.displayCollectionProducts = data.bundleLines;

				// setTimeout(function(){
				// 	$("#productsTable").DataTable({
				// 		order: [],
			    //         aLengthMenu: [
			    //                       [10, 25, 50, 100, 200, -1],
			    //                       [10, 25, 50, 100, 200, "All"]
			    //                   ]
				// 	});
				// }, 500);

			}else{
				toastr.error(data.msg, '', {timeOut: 3000})
			}
		})
		.error(function(data, status, headers, config) {
		});
	}

	$scope.deleteBundleLine = function(id){

		var data = {};
	    data.bundleId = $scope.bundle.ID;
	    data.bundleLineId = id;
	    data.userId = userId;
    	var temp = $.param({details: data});

		$http({
			data: temp+"&"+$scope.tokenHash,
			url : site+"/deleteBundleProductLine",
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {

			if(data.done == true || data.done == 'true'){

				toastr.success(data.msg, '', {timeOut: 3000})
				$scope.continouRecord($scope.bundle.ID);

			}else{

				$scope.alertDeleteMsg = data.msg;
				$("#alertDel").modal('show');
			}


		})
		.error(function(data, status, headers, config) {
		});
	}


$scope.getSubCategoriesWrtCategory = function(){
		console.log($scope.bundle.P_8);
		if($scope.bundle.P_8 != null){
			var data = {};
		    data.category = $scope.bundle.P_8;
		    data.userId = userId;

	    	var temp = $.param({details: data});

			$http({
				data: temp+"&"+$scope.tokenHash,
				url : site+"/getSubCategoriesWrtCategory1",
				method: "POST",
				async: false,
				headers: {'Content-Type': 'application/x-www-form-urlencoded'}

			}).success(function(data, status, headers, config) {

				$scope.subCategoryLov = data.subCategory;

			})
			.error(function(data, status, headers, config) {
			});
		}else{
			$scope.subCategoryLov = {};
		}
	}
	$scope.getSubSubCategoriesWrtSubCategory = function(){

		if($scope.bundle.P_9 != null){
			var data = {};
		    data.subcategory = $scope.bundle.P_9;
		    data.userId = userId;

	    	var temp = $.param({details: data});

			$http({
				data: temp+"&"+$scope.tokenHash,
				url : site+"/getSubSubCategoriesWrtSubCategory",
				method: "POST",
				async: false,
				headers: {'Content-Type': 'application/x-www-form-urlencoded'}

			}).success(function(data, status, headers, config) {

				$scope.subSubCategoryLov = data.subSubCategory;

			})
			.error(function(data, status, headers, config) {
			});
		}else{
			$scope.subSubCategoryLov = {};
		}
	}

	$scope.changeStatusBundle = function(id){

		var data = {};
	    data.recordId = id;
	    data.userId = userId;

    	var temp = $.param({details: data});

		$http({
			data: temp+"&"+$scope.tokenHash,
			url : site+"/changeStatusBundle",
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {

			if(data.done == true || data.done == 'true'){
				toastr.success(data.msg, '', {timeOut: 3000})
				$scope.getAllAdminProductBundlelov();

			}else{
				toastr.error(data.msg, '', {timeOut: 3000});
			}
		})
		.error(function(data, status, headers, config) {


		});
	}

	$scope.alertDeleteMsg = '';
	$scope.BundleModelId = '';

	$scope.openAlertModel = function(id){

		$scope.BundleModelId = id;
		$("#alertBundleDel").modal('show');

	}

	$scope.closeBundleDeleteModal = function(id){
		$("#alertBundleDel").modal('hide');
		$scope.alertDeleteMsg = '';
		$scope.BundleModelId = '';

	}

	$scope.deleteBundle = function(id){

		var data = {};
	    data.recordId = $scope.BundleModelId;
	    data.userId = userId;

    	var temp = $.param({details: data});

		$http({
			data: temp+"&"+$scope.tokenHash,
			url : site+"/deleteSpecificBundle",
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {

			if(data.done == true || data.done == 'true'){

				$("#alertBundleDel").modal('hide');
				$scope.BundleModelId = '';

				toastr.success(data.msg, '', {timeOut: 3000})
				$scope.getAllAdminProductBundlelov();

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

	$('#uploadattch').fileupload({

 		add: function (e, data) {

 			if($scope.bundle.ID == ""){

 				toastr.error('Save Basic Info first, then upload Images...', '', {timeOut: 3000})
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

 	      		toastr.error("Error : Save Basic Info first, then upload Images...", '', {timeOut: 3000});

 	      	}else if(xhr.responseText[0] == 05){

 	      		toastr.error("Error : Image dimension must be minimum 270 X 370", '', {timeOut: 3000});

 	      	}else{

 		  		toastr.success("Image Uploaded Successfully", '', {timeOut: 3000});
                titletxt = '';
                // if(xhr.responseText[4])
                console.log(xhr.responseText);
                //    $scope.makeImageAttachment()
                var html = '<div class="col-2 image-overlay margin-r1" title="'+titletxt+'" id="img_file_'+xhr.responseText[1]+'">'+
                '<img src="'+xhr.responseText[2]+'" alt="" class="image-box">'+
                '<div class="overlay">'+
                    '<div class="text">'+
                        '<img class="fa-trash-alt" src="'+baseurl+'/images/admin/trash.svg" alt="" width="18" ng-click="deleteBundleProductImage('+xhr.responseText[1]+')" title="Delete Image">';

                        html += '<img class="fa-pencil-alt" src="'+baseurl+'/images/admin/pencil-solid.svg" alt="" width="18" ng-click="markProdImagePriSec('+xhr.responseText[1]+')" title="Mark Primary">';

                    html +=
                    '</div>'+
                '</div>'+
            '</div>';
 // console.log(html);

            $("#p_att").append($compile(angular.element(html))($scope));

 		  		$scope.$apply(function() {
 		  			$scope.bundle.image = xhr.responseText[2];
 		  		});
 		  	}
 	   	}
 	});

    $scope.makeImageAttachment = function(images){

        $("#p_att").html('');

                   if(images != '' && images != null){
                    // console.log(images);

                       for(var i=0; i<images.length; i++){
                            // console.log(images[i]['DOWN_PATH']);
                           var titletxt = '';

                           switch (true) {
                               case images[i]["PRIMARY_FLAG"] == 1:
                                   // console.log('Primary');
                                   titletxt = 'Primary';
                                   break;
                               case images[i]["SECONDARY_FLAG"] == 1:
                                   // console.log('Secondary');
                                   titletxt = 'Secondary';
                                   break;
                               default:
                                   // console.log('none');
                                   titletxt = '';
                                   break;
                           }

                           var html = '<div class="col-2 image-overlay margin-r1" title="'+titletxt+'" id="img_file_'+images[i]["IMAGE_ID"]+'">'+
                                           '<img src="'+images[i]["DOWN_PATH"]+'" alt="" class="image-box">'+
                                           '<div class="overlay">'+
                                               '<div class="text">'+
                                                   '<img class="fa-trash-alt" src="'+baseurl+'/images/admin/trash.svg" alt="" width="18" ng-click="deleteBundleProductImage('+images[i]["IMAGE_ID"]+')" title="Delete Image">';

                                                   html += '<img class="fa-pencil-alt" src="'+baseurl+'/images/admin/pencil-solid.svg" alt="" width="18" ng-click="markProdImagePriSec('+images[i]["IMAGE_ID"]+')" title="Mark Primary">';

                                               html +=
                                               '</div>'+
                                           '</div>'+
                                       '</div>';
                            // console.log(html);

                               $("#p_att").append($compile(angular.element(html))($scope));
                       }
                   }
    }

    $scope.tempProId = '';
	$scope.markProdImagePriSec = function(id){

		$scope.tempProId = id;
		// $("#shadesModal").modal('hide');
		$("#confirmBundleProdImageModal").modal('show');
	}
	$scope.closeProdImageModal = function(id){
		$scope.tempProId = '';
		// $("#shadesModal").modal('show');
		$("#confirmBundleProdImageModal").modal('hide');
	}


	$scope.markBundleProductDetailImageFlag = function(flag){

		var data = {};
	    data.imageId = $scope.tempProId;
		data.flag = flag;
	    data.productId = $scope.bundle.ID;
	    data.userId = userId;
    	var temp = $.param({details: data});

		$http({
			data: temp+"&"+$scope.tokenHash,
			url : site+"/markPrimaryBundleProdImage",
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {
            console.log(data.done);
            console.log(data.images);

			if(data.done == true || data.done == 'true'){
				$scope.tempProId = '';
				toastr.success(data.msg, '', {timeOut: 3000});
				$scope.makeImageAttachment(data.images);
				$("#confirmBundleProdImageModal").modal('hide');

			}else{
				$scope.tempProId = '';
				toastr.error(data.msg, '', {timeOut: 3000})
				$("#confirmBundleProdImageModal").modal('hide');

			}


		})
		.error(function(data, status, headers, config) {
		});
	}

    $scope.deleteBundleProductImage = function(id){

		var data = {};
		data.imageId = id;
	    data.productId = $scope.bundle.ID;
	    data.userId = userId;
    	var temp = $.param({details: data});

		$http({
			data: temp+"&"+$scope.tokenHash,
			url : site+"/deleteBundleProductImage",
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {

            if(data.done == 'true' ||data.done == true){

                toastr.success(data.msg, '', {timeOut: 3000})

                $scope.makeImageAttachment(data.images);
            }else{
                toastr.error(data.msg, '', {timeOut: 3000})
            }


		})
		.error(function(data, status, headers, config) {
		});
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







