var myApp = angular.module('project1', ["smart-table"], function () { });
myApp.controller('projectinfo1', function ($scope,$compile, $rootScope, $timeout, $http, $window, $filter, $q, $routeParams) {


    $scope.basicEditView = 0;

    $scope.QuickProduct = {};
    $scope.QuickProduct.ID = productId;
    $scope.QuickProduct.PRODUCT_ID ="";
    $scope.QuickProduct.P_1 = "";
    $scope.QuickProduct.P_2 = "";
    $scope.QuickProduct.P_3 = "";
    $scope.QuickProduct.P_4 = "";
    $scope.QuickProduct.P_5 = "";
    $scope.QuickProduct.P_6 = "";
    $scope.QuickProduct.P_13 = "";
    $scope.QuickProduct.P_14 = "";

    $scope.featurelov={};
    $scope.featurelov.S_1="";

    $scope.getQuickAddAdminProduct = function () {
        var data = {};
        data.userId = userId;
        data.productId = $scope.QuickProduct.ID;

        var temp = $.param({ details: data });

        $http({
            data: temp ,
            url: site + "/getQuickAddAdminProduct",
            method: "POST",
            async: false,
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' }

        }).success(function (data, status, headers, config) {
            var images=data.productDetails['DOWN_PATH'];

            $scope.displayImagesLov = images;
            $scope.featurelov = data.features;
            $scope.QuickProduct = data.productDetails;
            // $scope.displayFeaturesSlider = data.productDetails['QUICK_ADD_FEATURES'];


            var getSelectedFeatures = data.productDetails['QUICK_ADD_FEATURES'];
            var html = '';
            $(".features_slider").html('');
            
            if(getSelectedFeatures != null && getSelectedFeatures != ''){
                for (let i = 0; i < getSelectedFeatures.length; i++) {

                    html += `<div class="box px-1">
                            <div class="ag-courses_item">
                                <a href="#!" class="ag-courses-item_link">
                                    <div class="ag-courses-item_bg"></div>

                                    <div class="ag-courses-item_title">
                                        <li class="product-hero__icons__item d-flex aic">
                                            <div class="product-hero__icons__image relative">
                                                <div class="img fit-contain is-loaded pos-center">

                                                    <div class="skeleton"></div>
                                                    <img width="70" height="70"
                                                        src="`+getSelectedFeatures[i]['IMAGE_DOWN_PATH']+`"
                                                        srcset="`+getSelectedFeatures[i]['IMAGE_DOWN_PATH']+`"
                                                        alt="Clean" title="Clean" data-fit="contain"
                                                        class="img__el">
                                                </div>
                                            </div>
                                            <span class="product-hero__icons__text">`+getSelectedFeatures[i]['FEATURE_NAME']+`</span>
                                        </li>
                                    </div>
                                </a>
                            </div>
                        </div>`;
                        
                }	
                $(".features_slider").html(html);
            }
            if ($('.features_slider').hasClass('slick-initialized')) {
				    $('.features_slider').slick('destroy');
				}   
			setTimeout(function(){
				$('.features_slider').slick({
					slidesToShow: 4,
					autoplaySpeed: 1500,
					"infinite":true,
					"autoplay":true,
					"dots":false,
					"arrows":true,
					prevArrow:"<button type='button' class='slick-prev pull-left'><i class='fa fa-arrow-left' aria-hidden='true'></i></button>",
					nextArrow:"<button type='button' class='slick-next pull-right'><i class='fa fa-arrow-right' aria-hidden='true'></i></button>",
					"responsive":[
								
								{"breakpoint": 1400,
									"settings": {"slidesToShow": 6}},

								{"breakpoint": 1366,
								"settings": {"slidesToShow": 3}},

								{"breakpoint": 1200,
									"settings": {"slidesToShow": 3}},

								{"breakpoint": 992,
									"settings": {"slidesToShow": 2}},

								{"breakpoint": 768,
									"settings": {"slidesToShow": 1}},

								{"breakpoint": 576,
									"settings": {"slidesToShow": 1}}
								]
					
					});
				$.LoadingOverlay("hide");
			}, 500);
           
            // console.log($scope.QuickProduct, 'asd');
            setTimeout(function () {
                $("#p1").val($scope.QuickProduct.P_1).trigger('change');
                $("#p2").val($scope.QuickProduct.P_2).trigger('change');
                $("#p3").val($scope.QuickProduct.P_3).trigger('change');
                $("#p4").val($scope.QuickProduct.P_4).trigger('change');
                $("#p5").val($scope.QuickProduct.P_5).trigger('change');
                $("#p6").val($scope.QuickProduct.P_6).trigger('change');
                $("#p13").val($scope.QuickProduct.P_13).trigger('change');
                // $("#p13").val($scope.QuickProduct.P_13).trigger('change');
                
            }, 500);
        })
            .error(function (data, status, headers, config) {
            });
    }
    $scope.getQuickAddAdminProduct();
    $scope.editBasicInfo = function () {
       
        setTimeout(function () {
            $("#p1").val($scope.QuickProduct.P_1).trigger('change');
            $("#p2").val($scope.QuickProduct.P_2).trigger('change');
            $("#p3").val($scope.QuickProduct.P_3).trigger('change');
            $("#p4").val($scope.QuickProduct.P_4).trigger('change');
            $("#p5").val($scope.QuickProduct.P_5).trigger('change');
            $("#p6").val($scope.QuickProduct.P_6).trigger('change');

        }, 500);
        $scope.basicEditView = 1;

        
    }

    $scope.cancelBasicInfo = function () {
        $scope.basicEditView = 0;
    }

    $scope.updateBasicInfo = function () {

        var data = {};
        data.userId = userId;
        data.record = $scope.QuickProduct;
        
        var temp = $.param({ details: data });

        $http({
            data: temp + "&" + $scope.tokenHash,
            url: site + "/updateAdminQuickProductBasicInfo",
            method: "POST",
            async: false,
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' }

        }).success(function (data, status, headers, config) {

            if (data.done == true || data.done == 'true') {
                
                console.log($scope.QuickProduct.P_1,'1213');
                setTimeout(function () {
                    $("#p7").html($scope.QuickProduct.P_1).trigger('change');
                    $("#p8").html($scope.QuickProduct.P_2).trigger('change');
                    $("#p9").html($scope.QuickProduct.P_3).trigger('change');
                    $("#p10").html($scope.QuickProduct.P_4).trigger('change');
                    $("#p11").html($scope.QuickProduct.P_5).trigger('change');
                    $("#p12").html($scope.QuickProduct.P_6).trigger('change');
                    
                }, 500);
                $scope.basicEditView = 0;
                toastr.success(data.msg, '', { timeOut: 3000 })

            } else {
                toastr.error(data.msg, '', { timeOut: 3000 })
            }
        })
        .error(function (data, status, headers, config) {
        });


    }
    $scope.updateFeaturesModal = function(){

        var data = {};
		
	    data.featuresArr = $scope.QuickProduct.P_13;
        data.productId = $scope.QuickProduct.PRODUCT_ID;

    	var temp = $.param({details: data});
    	
		$http({
			data: temp+"&"+$scope.tokenHash,
			url : site+"/updateFeatures",
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {
            toastr.success(data.msg, '', {timeOut: 3000})
			var getSelectedFeatures = data.getSelectedFeatures;
            var html = '';
            $(".features_slider").html('');
            
            if(getSelectedFeatures != null && getSelectedFeatures != ''){
                for (let i = 0; i < getSelectedFeatures.length; i++) {

                    html += `<div class="box px-1">
                            <div class="ag-courses_item">
                                <a href="#!" class="ag-courses-item_link">
                                    <div class="ag-courses-item_bg"></div>

                                    <div class="ag-courses-item_title">
                                        <li class="product-hero__icons__item d-flex aic">
                                            <div class="product-hero__icons__image relative">
                                                <div class="img fit-contain is-loaded pos-center">

                                                    <div class="skeleton"></div>
                                                    <img width="70" height="70"
                                                        src="`+getSelectedFeatures[i]['IMAGE_DOWN_PATH']+`"
                                                        srcset="`+getSelectedFeatures[i]['IMAGE_DOWN_PATH']+`"
                                                        alt="Clean" title="Clean" data-fit="contain"
                                                        class="img__el">
                                                </div>
                                            </div>
                                            <span class="product-hero__icons__text">`+getSelectedFeatures[i]['FEATURE_NAME']+`</span>
                                        </li>
                                    </div>
                                </a>
                            </div>
                        </div>`;
                        
                }	
                $(".features_slider").html(html);
            }
            if ($('.features_slider').hasClass('slick-initialized')) {
				    $('.features_slider').slick('destroy');
				}   
			setTimeout(function(){
				$('.features_slider').slick({
					slidesToShow: 4,
					autoplaySpeed: 1500,
					"infinite":true,
					"autoplay":true,
					"dots":false,
					"arrows":true,
					prevArrow:"<button type='button' class='slick-prev pull-left'><i class='fa fa-arrow-left' aria-hidden='true'></i></button>",
					nextArrow:"<button type='button' class='slick-next pull-right'><i class='fa fa-arrow-right' aria-hidden='true'></i></button>",
					"responsive":[
								
								{"breakpoint": 1400,
									"settings": {"slidesToShow": 6}},

								{"breakpoint": 1366,
								"settings": {"slidesToShow": 3}},

								{"breakpoint": 1200,
									"settings": {"slidesToShow": 3}},

								{"breakpoint": 992,
									"settings": {"slidesToShow": 2}},

								{"breakpoint": 768,
									"settings": {"slidesToShow": 1}},

								{"breakpoint": 576,
									"settings": {"slidesToShow": 1}}
								]
					
					});
				$.LoadingOverlay("hide");
			}, 500);
			
			$("#addFeaturesModal").modal('hide');
			// $scope.makeImageAttachmentHtml(data.images);
            // location.reload();
			
		})
		.error(function(data, status, headers, config) {
		});
    }
    $scope.tempProId = '';
	$scope.markProdImagePriSec = function(id){
		
		$scope.tempProId = id;
		// $("#shadesModal").modal('hide');
		$("#confirmProdImageModal").modal('show');
	}

    $scope.addFeaturesModal = function(id){
		
		$scope.tempProId = id;
		// $("#shadesModal").modal('hide');
		$("#addFeaturesModal").modal('show');
	}
    $scope.closeFeaturesModal = function(){
		

		// $("#shadesModal").modal('hide');
		$("#addFeaturesModal").modal('hide');
	}

	$scope.closeProdImageModal = function(id){
		$scope.tempProId = '';
		// $("#shadesModal").modal('show');
		$("#confirmProdImageModal").modal('hide');
	}

    $scope.deleteProductImage = function(id){
		
		var data = {};
		data.imageId = id;
	    data.productId = $scope.QuickProduct.PRODUCT_ID;
	    data.userId = userId;
    	var temp = $.param({details: data});
    	
		$http({
			data: temp+"&"+$scope.tokenHash,
			url : site+"/deleteProductImage",
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {
				
			toastr.success(data.msg, '', {timeOut: 3000})
			
			// $scope.makeImageAttachmentHtml(data.images);
            location.reload();
			
		})
		.error(function(data, status, headers, config) {
		});
	}
    $scope.markProductDetailImageFlag = function(flag){
		
		var data = {};
	    data.imageId = $scope.tempProId;
		data.flag = flag;
	    data.productId = $scope.QuickProduct.PRODUCT_ID;
	    data.userId = userId;
    	var temp = $.param({details: data});
    	
		$http({
			data: temp+"&"+$scope.tokenHash,
			url : site+"/markPrimaryProdImage",
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {

			if(data.done == true || data.done == 'true'){
				$scope.tempProId = '';
				toastr.success(data.msg, '', {timeOut: 3000})
				// $scope.makeImageAttachmentHtml(data.images);
                location.reload();
				$("#confirmProdImageModal").modal('hide');

			}else{
				$scope.tempProId = '';
				toastr.error(data.msg, '', {timeOut: 3000})
				$("#confirmProdImageModal").modal('hide');
				
			}

			
		})
		.error(function(data, status, headers, config) {
		});
	}
    // $scope.makeImageAttachmentHtml = function(images){
		
	// 	$("#p_att").html('');
		
	// 	if(images != '' && images != null){
			
	// 		for(var i=0; i<images.length; i++){
	// 			var titletxt = images[i]["primFlag"] == 0 ? 'secondary' : 'primary';
	// 			// var html = '<div class="col-2 image-overlay margin-r1" title="'+titletxt+'" id="img_file_'+images[i]["ID"]+'">'+
	// 			// 				'<img src="'+images[i]["downPath"]+'" alt="" class="image-box">'+
	// 			// 				'<div class="overlay">'+
	// 			// 					'<div class="text">'+
	// 			// 						'<img class="fa-trash-alt" src="'+baseurl+'/images/admin/trash.svg" alt="" width="18" ng-click="deleteProductImage('+images[i]["ID"]+')" title="Delete Image">';
										
	// 			// 							html += '<img class="fa-pencil-alt" src="'+baseurl+'/images/admin/pencil-solid.svg" alt="" width="18" ng-click="markProdImagePriSec('+images[i]["ID"]+')" title="Mark Primary">';	
										
	// 			// 					html += '<div class="arrow-icon-move-box">'+
	// 			// 							'<img class="arrow-center" src="'+baseurl+'/images/admin/feather-move.svg" alt="">'+
	// 			// 							'<p>Move Position</p>'+
	// 			// 						'</div>'+
	// 			// 					'</div>'+
	// 			// 				'</div>'+
	// 			// 			'</div>';

    //             var html = `<div class="col-md-6 px-1 pb-1" title="`+titletxt+`" id="img_file_`+images[i]["ID"]+`">
    //                         <div class="show-image">

    //                             <img src="`+images[i]["downPath"]+`" alt="Image"
    //                                 class="prod_img_detail img-w35 img-product-gall">

    //                             <button class="btn btn-danger btn-sm delete" ng-click="deleteProductImage(`+images[i]["ID"]+`)">DELETE</button>
    //                             <button class="btn btn-info btn-sm markprimary" ng-click="markProdImagePriSec(`+images[i]["ID"]+`)">Mark Image</button>
    //                         </div>
                            
    //                     </div>`;
					
	// 				$("#p_att").append($compile(angular.element(html))($scope));
    //                 location.reload();
	// 		}
	// 	}
	// }

    $('#uploadattch').fileupload({
		
        add: function (e, data) {
            
            // if($scope.product.ID == ""){
                
            //     toastr.error('Save Basic Info first, then upload Images...', '', {timeOut: 3000})
            //     return false;
            
            // }else{
                $.LoadingOverlay("show"); 
                var jqXHR = data.submit();
            // }
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

              }else if(xhr.responseText[0] == 04){
            
                  toastr.error("Error : Image dimensions must be minimum 270 X 370", '', {timeOut: 3000});

              }else{

                  toastr.success("Image Upload Successfully", '', {timeOut: 3000});
                
                //   var html = '<div class="col-2 image-overlay margin-r1" id="img_file_'+xhr.responseText[1]+'">'+
                //                '<img src="'+xhr.responseText[2]+'" alt="" class="image-box">'+
                //                '<div class="overlay">'+
                //                    '<div class="text">'+
                //                        '<img class="fa-trash-alt" src="'+baseurl+'/images/admin/trash.svg" alt="" width="18" ng-click="deleteProductImage('+xhr.responseText[1]+')" title="Delete Image">'+
                //                        '<img class="fa-pencil-alt" src="'+baseurl+'/images/admin/pencil-solid.svg" alt="" width="18" ng-click="markProdImagePriSec('+xhr.responseText[1]+')" title="Mark Primary">'+	
                //                        '<div class="arrow-icon-move-box">'+
                //                            '<img class="arrow-center" src="'+baseurl+'/images/admin/feather-move.svg" alt="">'+
                //                            '<p>Move Position</p>'+
                //                        '</div>'+
                //                    '</div>'+
                //                '</div>'+
                //            '</div>';

                    var html = `<div class="col-md-6 px-1 pb-1" id="img_file_`+xhr.responseText[1]+`">
                                    <div class="show-image">

                                        <img src="`+xhr.responseText[2]+`" alt="Image"
                                            class="prod_img_detail img-w35 img-product-gall">

                                        <button class="btn btn-danger btn-sm delete" ng-click="deleteProductImage(`+xhr.responseText[1]+`)">DELETE</button>
                                        <button class="btn btn-info btn-sm markprimary" ng-click="markProdImagePriSec(`+xhr.responseText[1]+`)">Mark Image</button>
                                    </div>
                                    
                                </div>`;
                  
                  $("#p_att").append($compile(angular.element(html))($scope));
                  location.reload();

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
                    setTimeout(function () {
                        $.LoadingOverlay("hide");
                    }, 500);
                    if (typeof response.data != 'object') { //might have some error

                        var temp = response.data.toLowerCase();
                        if (temp.indexOf("error") >= 0) {  //result may have error
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
                    setTimeout(function () {
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