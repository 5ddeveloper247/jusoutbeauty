var myApp = angular.module('project1',["smart-table"], function(){});
myApp.controller('projectinfo1',function($scope,$rootScope,$timeout,$http,$window,$filter,$q,$routeParams) {

//	$(document).on('click','.addNew',function(){
//	    $('#addCity_modal').modal('show');return false;
//	});
//
//	$(document).on('click','.modalClose',function(){
//	    $('#addCity_modal').modal('hide');return false;
//	});
$( document ).ready(function() {
    // $(".slider").not('.instafeed_slider').slick();

	fetch('https://graph.instagram.com/me/media?fields=media_count,media_type,permalink,media_url&&access_token=IGQVJWcUdGSXZARM2ZAGN3pmU3hZARmVmTGJKTXdpOGxCRjM5RktFMUtBNzNuR0pHTGt6RTJ2ZAG5xN1IwbjNFbHR4b0pYMjAtT25vRG0taUxBcmtqY09fUlZAiVmE1UEFfUWFoU2xYODVfZAGxsa2hXZATl4bwZDZD')
    .then((res)=> res.json())
    .then((data) =>{
    	console.log(data);
        instagram_feed = data.data;
		$scope.$apply(function () {
			$scope.selfi_instastory();
		});


			// if(details.length > 0){
			// 	$(".instafeed_slider").html('');
			// 	var html = '';
			// 	for(var i=0; i<details.length; i++){
			// 		console.log(details[i]);
    //                 html += ` <div class="slick-prev slick-arrow slick-disabled" aria-label="Previous" aria-disabled="true" style="">
    //     <i class="fal fa-arrow-left"></i>
    // </div>
    // <div class="slick-list draggable" style="height: 291.531px;">
    //     <div class="slick-track" style="opacity: 1; width: 2700px; transform: translate3d(0px, 0px, 0px); display: unset">

    //         <div class="box px-1 slick-slide fadeInUp animated" data-animate="fadeInUp" style="width: 369px;"
    //             data-slick-index="6" aria-hidden="true" tabindex="-1">

    //             <a href="`+details[i]['permalink']+`" class="card hover-zoom-in d-block border-0 hover-change-content insta-secc-home"
    //                 tabindex="-1">
    //                 <img src="`+details[i]['media_url']+`" alt="Instagram" class="card-img">
    //                 <div class="card-img-overlay d-flex align-items-center justify-content-center content-change">
    //                     <span
    //                         class="d-inline-flex align-items-center justify-content-center w-50px h-50px bg-white text-primary rounded-circle fs-24 content-change"
    //                         style="position: absolute; top:43%;">
    //                        <i class="fab fa-instagram"></i>

    //                     </span>

    //                 </div>
    //             </a>
    //         </div>


    //     </div>
    // </div>
    // <div class="slick-next slick-arrow" aria-label="Next" style="" aria-disabled="false"><i
    //         class="fal fa-arrow-right"></i>
    // </div>`;


	// 				// html+= '<div class="box px-1" >'+
	// 				// 				'<a href="" class="card hover-zoom-in d-block border-0 hover-change-content insta-secslidesToShowc-home">'+
	// 				// 					'<img src="'+details[i]['media_url']+'" alt="Instagram" class="card-img">'+
	// 				// 					'<div class="card-img-overlay d-flex align-items-center justify-content-center content-change">'+
	// 				// 						'<span class="d-inline-flex align-items-center justify-content-center w-50px h-50px bg-white text-primary rounded-circle fs-24 content-change" style="position: absolute; top: 25%;">'+
	// 				// 							'<a href="'+details[i]['permalink']+'"><i class="fab fa-instagram"></i></a>'+
	// 				// 						'</span>'+
	// 				// 					'</div>'+
	// 				// 				'</a>'+
	// 				// 			'</div>';
				//}
	// 			$(".instafeed_slider").html(html);

			//}
	// 		setTimeout(function(){

	// 			$('.instafeed_slider').not('.slick-initialized').slick({
	// 				slidesToShow: 4,
	// 				"infinite":false,
	// 				"autoplay":false,
	// 				"dots":false,
	// 				"arrows":true,
	// 				"responsive":[{
	// 					"breakpoint": 1366,"settings": {"slidesToShow":1}},
	// 						{"breakpoint": 768,"settings": {"slidesToShow": 3}},
	// 						{"breakpoint": 576,"settings": {"slidesToShow": 2}
	// 						}]

	// 				});
	// 		}, 1000);
		//}


     })

 });
	$(document).on("click", ".shadeAccord-btn", function () {
		var i = $(this).attr('data-id');
		$("#chooseShade_container_"+i).slideToggle('slow');

	});

	$(document).on('click','.shade_filter',function(){
		$(".shade_filter").removeClass('shade-active');
    	$(this).addClass('shade-active');
	});



//	$scope.sourceId = sourceId;
//	$scope.flag = flag;

//	if(categoryName == 'Bundles' || categoryName == 'Bundle'){
//		$scope.catFlag = 'Bundle';
//		$scope.productType = 'bundle';
//	}else{
//		$scope.catFlag = '';
//		$scope.productType = 'single';
//	}
	$scope.instagram_feed = instagram_feed;
	$scope.selfi_instastory = function(){
		var data = {};

	    var temp = $.param({details: data});

		$http({
			data: temp,
			url : site+'/getAllSelfies',
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {

			var selfi_data = data.list;

			if(instagram_feed.length > 0){
				var selfi_data_both = instagram_feed;

			}else{

				selfi_data_both = '';
			}

			$(".instafeed_slider").html('');

			var html = '';

			if(selfi_data_both != null && selfi_data_both != ''){

				for(var i=0; i<selfi_data_both.length; i++){

					if(selfi_data_both[i].TYPE != "undefined" && selfi_data_both[i].TYPE == "selfi"){

						html += `<div class="box px-1 slick-slide fadeInUp animated" data-animate="fadeInUp" style="width: 369px;"
									data-slick-index="6" aria-hidden="true" tabindex="-1">

									<a target="_blank" href="`+selfi_data_both[i]['DOWNPATH']+`" class="card hover-zoom-in d-block border-0 hover-change-content insta-secc-home"
										tabindex="-1">
										<img src="`+selfi_data_both[i]['DOWNPATH']+`" alt="Instagram" class="card-img insta-secc-home">

									</a>
								</div>`;

					}
					else{
						html += `<div class="box px-1 slick-slide fadeInUp animated" data-animate="fadeInUp" style="width: 369px;"
										data-slick-index="6" aria-hidden="true" tabindex="-1">

										<a target="_blank" href="`+selfi_data_both[i]['permalink']+`" class="card hover-zoom-in d-block border-0 hover-change-content insta-secc-home"
											tabindex="-1">
											<img src="`+selfi_data_both[i]['media_url']+`" alt="Instagram" class="card-img insta-secc-home">
											<div class="card-img-overlay d-flex align-items-center justify-content-center content-change">
												<span
													class="d-inline-flex align-items-center justify-content-center w-50px h-50px bg-white text-primary rounded-circle fs-24 content-change"
													style="position: absolute; top:43%;">
												<i class="fab fa-instagram"></i>

												</span>

											</div>
										</a>
									</div>`;

					}
					$(".instafeed_slider").html(html);
					}

				}
				if ($('.instafeed_slider').hasClass('slick-initialized')) {
				    $('.instafeed_slider').slick('destroy');
				}
			setTimeout(function(){
				$('.instafeed_slider').slick({
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

		})
		.error(function(data, status, headers, config) {
		});
	}


	$scope.catFlag = '';
	$scope.productType = 'single';

	$scope.tokenHash = $("#csrf").val();

	$scope.quickView_name = '';
	$scope.category_name = '' ;
	$scope.subCategory_name = '' ;
	$scope.unit_price = '' ;
	$scope.short_description = '' ;
	$scope.productImagesLoop = '';
	$scope.displayCollectionProductShadesQuickView = '';
	$scope.ProductShadesNameQuickView = '';

	$scope.resetQuickviewPopup = function(){
		$scope.prodShadeId = '';
        $scope.shadeId = '';
        $scope.productId = '';
        $scope.selectedShadeName = '';
        $scope.selectedShadeImg_p = '';
        $scope.selectedShadeImg_s = '';

        $scope.subs_id = '';

        $("#prodShadeId").val('');
    	$("#shadeId").val('');
    	$("#shadeName").val('');
    	$("#productId").val('');

    	$("#chooseShade_container_1").slideUp('slow');

        $("#single-sub").click();
	}

	$scope.quickViewProductDetails = function(productId){

		var data = {};
	    data.productId = productId;

	    data.productType = $scope.productType;

	    var temp = $.param({details: data});

		$http({
			data: temp+"&"+$scope.tokenHash,
			url : site+'/getQuickViewProductDetails',
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {

			$scope.subscriptionLov = data.subscriptions;
			var product_details = data.productDetails;
			var product_shades_details = data.shades;

			if(product_details != null && product_details != ''){

				$scope.QuickView_productId = product_details['PRODUCT_ID'];
				$scope.QuickView_name = product_details['NAME'];
				$scope.category_name = product_details['CATEGORY_NAME'];
				$scope.subCategory_name = product_details['SUB_CATEGORY_NAME'];
				$scope.unit_price = product_details['UNIT_PRICE'];
				$scope.short_description = product_details['SHORT_DESCRIPTION'] ;
				$scope.productImagesLoop = product_details['images'];
//				$scope.ProductShadesNameQuickView = product_shades_details['SHADE_NAME'];

				$scope.displayCollectionProductShadesQuickView = product_shades_details;
			}



			setTimeout(function(){
                $scope.resetQuickviewPopup();

			$("#productQuickView").modal('show');
				$.LoadingOverlay("hide");
			}, 500);

		})
		.error(function(data, status, headers, config) {
		});
	}

	$scope.chooseProdShade = function(prodShadeId, shadeId, productId, shadeName, primaryImg, secondaryImg){

    	$scope.prodShadeId = prodShadeId;
        $scope.shadeId = shadeId;
        $scope.productId = productId;
        $scope.selectedShadeName = shadeName;
        $scope.selectedShadeImg_p = primaryImg;
        $scope.selectedShadeImg_s = secondaryImg;

	}

	$scope.confirmProductShade = function(){

    	if($scope.prodShadeId != ''){
    		$("#prodShadeId").val($scope.prodShadeId);
        	$("#shadeId").val($scope.shadeId);
        	$("#shadeName").val($scope.selectedShadeName);
        	$("#productId").val($scope.productId);

        	$("#chooseShade_container_1").slideUp('slow');

    	}else{
    		toastr.error('Please choose shade first...', '', {timeOut: 3000})
    	}
    }

    $scope.subs_id = '';

	$(document).on("click", "#single-sub", function () {

		$scope.$apply(function () {
			$scope.subs_id = '';
			$scope.subscriptionDetails = '';
			$scope.subscriptionNote1 = '';
			$scope.subscriptionNote2 = '';
		});
	});

	$scope.showSubscrptionDetailModal = function(){
		if($scope.subscriptionDetails != '' && $("#subsOption").val() != ''){
			$('#learnmore_pop').modal('show');
		}else{
			toastr.error('.Choose subscription first....', '', {timeOut: 3000})
		}
	}
	$scope.hideSubscrptionDetailModal = function(){
		$('#learnmore_pop').modal('hide');
	}
    $scope.fetchSubscriptionDetail = function(){

		var subscriptionId = $("#subsOption").val();

		var data = {};
	    data.userId = userId;
	    data.subscriptionId = subscriptionId;

	    var temp = $.param({details: data});

		$http({
			data: temp+"&"+$scope.tokenHash,
			url : site+'/getSpecificSubscriptionDetail',
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {

			var detail = data.details;

			if(detail != '' && detail != null){

				$scope.subscriptionDetails = detail['S_10'];
				$scope.subscriptionNote1 = detail['S_5'];
				$scope.subscriptionNote2 = detail['S_6'];

			}else{
				$scope.subscriptionDetails = '';
				$scope.subscriptionNote1 = '';
				$scope.subscriptionNote2 = '';
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







