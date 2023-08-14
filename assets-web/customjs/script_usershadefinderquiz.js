var myApp = angular.module('project1',["smart-table"], function(){});
myApp.controller('projectinfo1',function($scope,$rootScope,$timeout,$http,$window,$filter,$q,$routeParams) {

//	$(document).on('click','.addNew',function(){
//	    $('#addCity_modal').modal('show');return false;
//	});
//
	$(document).on('click','.shadeTypeImg',function(){
	    var typeImage = $(".shadeTypeImg").attr('src');
	    console.log(typeImage);
	});

	$scope.tokenHash = $("#csrf").val();

	$scope.getAllUserShadeFinderQuizLov = function(){

		var data = {};
	    data.userId = userId;
	    var temp = $.param({details: data});

		$http({
			data: temp+"&"+$scope.tokenHash,
			url : site+'/getAllUserShadeFinderQuizLov',
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {

			$scope.displayCollectionOptions = data.options;

		})
		.error(function(data, status, headers, config) {
		});
	}
	$scope.getAllUserShadeFinderQuizLov();

	$scope.optionId = '';
	$scope.optionTitle = '';

	$scope.levelOneQuestionId = '';
	$scope.levelOneQuestionTitle = '';

	$scope.viewFlag = 'Y1';

	$scope.chooseOption = function(optionId, title){


		console.log('as');
		var data = {};
		data.optionId = optionId;
	    data.userId = userId;
	    var temp = $.param({details: data});

		$http({
			data: temp+"&"+$scope.tokenHash,
			url : site+'/getLevelOneDetailsWrtOption',
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {

			if(data.levelOne != ''){

				$scope.optionId = optionId;
				$scope.optionTitle = title;

				$scope.levelOneQuestionId = data.levelOne.LEVEL_ONE_ID;
				$scope.levelOneQuestionTitle = data.levelOne.TITLE;

				$scope.displayCollectionLevelOneTypesOptions = data.levelOneType;
				$scope.displayCollectionLevelOneTypes = data.levelOneType;

				$scope.viewFlag = 'Y2';

				if ($('.slick-slider1').hasClass('slick-initialized')) {
				    $('.slick-slider1').slick('destroy');
				}

//				setTimeout(function(){ 
//
//					$('.slick-slider3').slick({
//						"slidesToShow": 1,"infinite":false,"autoplay":false,"dots":false,"arrows":true,"responsive":[{"breakpoint": 1366,"settings": {"slidesToShow":3}},{"breakpoint": 768,"settings": {"slidesToShow": 3}},{"breakpoint": 576,"settings": {"slidesToShow": 1}}]
//
//						});
////					"slidesToShow": 2,"infinite":true,"autoplay":true,"dots":false,"arrows":true,"responsive":[{"breakpoint": 1366,"settings": {"slidesToShow":3}},{"breakpoint": 768,"settings": {"slidesToShow": 3}},{"breakpoint": 576,"settings": {"slidesToShow": 1}}]
////					"slidesToShow": 1,"infinite":false,"autoplay":false,"dots":false,"arrows":true,"responsive":[{"breakpoint": 1366,"settings": {"slidesToShow":3}},{"breakpoint": 768,"settings": {"slidesToShow": 3}},{"breakpoint": 576,"settings": {"slidesToShow": 1}}]
//				}, 800);

				setTimeout(function(){

					$('.slick-slider1').slick({
                        slidesToShow: 2,
                        autoplaySpeed: 1500,
                        "infinite":true,
                        "autoplay":true,
                        "dots":false,
                        "arrows":true,
                        prevArrow:"<button type='button' class='slick-prev pull-left'><i class='fa fa-arrow-left' aria-hidden='true'></i></button>",
                        nextArrow:"<button type='button' class='slick-next pull-right'><i class='fa fa-arrow-right' aria-hidden='true'></i></button>",
                        "responsive":[

                                    {"breakpoint": 1400,
                                        "settings": {"slidesToShow": 2}},

                                    {"breakpoint": 1366,
                                    "settings": {"slidesToShow": 2}},

                                    {"breakpoint": 1200,
                                        "settings": {"slidesToShow": 2}},

                                    {"breakpoint": 992,
                                        "settings": {"slidesToShow": 2}},

                                    {"breakpoint": 768,
                                        "settings": {"slidesToShow": 2}},

                                    {"breakpoint": 576,
                                        "settings": {"slidesToShow": 1}}
                                    ]


						});
//					"slidesToShow": 2,"infinite":true,"autoplay":true,"dots":false,"arrows":true,"responsive":[{"breakpoint": 1366,"settings": {"slidesToShow":3}},{"breakpoint": 768,"settings": {"slidesToShow": 3}},{"breakpoint": 576,"settings": {"slidesToShow": 1}}]
//					"slidesToShow": 1,"infinite":false,"autoplay":false,"dots":false,"arrows":true,"responsive":[{"breakpoint": 1366,"settings": {"slidesToShow":3}},{"breakpoint": 768,"settings": {"slidesToShow": 3}},{"breakpoint": 576,"settings": {"slidesToShow": 1}}]
					console.log('12');
					$("#yes_tab_all").show();
				}, 800);
			}

		})
		.error(function(data, status, headers, config) {
		});
	}

	$scope.chooseOptionLevelTwo = function(id,typeImage=''){

		var data = {};
		data.recordId = id;
		data.optionId = $scope.optionId;
		data.optionTitle = $scope.optionTitle;
	    data.userId = userId;
	    var temp = $.param({details: data});

		$http({
			data: temp+"&"+$scope.tokenHash,
			url : site+'/getshadeFinderQuizLevelTwoDetails',
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {

			if($scope.optionTitle == 'Yes'){

				$scope.displayCollectionPrimaryProducts = data.primaryProducts;
				$scope.displayCollectionRecommandedProducts = data.recommandedProducts;
                    // Assign products with shades to $scope.displayCollectionProducts
                //     $scope.displayCollectionRecommandedProducts = data.recommandedProducts.map(product => {
                //     // If the product has shades, include them in the product object
                //     if (recommandedProducts.shades && recommandedProducts.shades.length > 0) {
                //         recommandedProducts.hasShades = true; // You can use this flag to conditionally show shades
                //     }
                //     return recommandedProducts;
                // });
                $scope.displayCollectionRecommandedProducts = data.recommandedProducts.map(product => {
                    // If the product has shades, include them in the product object
                    if (product.shades && product.shades.length > 0) {
                        product.hasShades = true; // You can use this flag to conditionally show shades
                    }
                    return product;
                });
               
                $scope.levelOneLatestImg = typeImage != '' ? typeImage : data.levelTypeImage.downPath;

				$scope.viewFlag = 'YL';

				if ($('.slick-slider2456').hasClass('slick-initialized')) {
				    $('.slick-slider2456').slick('destroy');
				}

				setTimeout(function(){
                    // alert('123');
				$('.slick-slider2456').slick({
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
									"settings": {"slidesToShow": 4}},

								{"breakpoint": 1366,
								"settings": {"slidesToShow": 4}},

								{"breakpoint": 1200,
									"settings": {"slidesToShow": 3}},

								{"breakpoint": 992,
									"settings": {"slidesToShow": 3}},

								{"breakpoint": 768,
									"settings": {"slidesToShow": 2}},

								{"breakpoint": 576,
									"settings": {"slidesToShow": 1}}
								]

						});
//					"slidesToShow": 4,"autoplay":true,"dots":false,"arrows":false,"responsive":[{"breakpoint": 992,"settings": {"slidesToShow":4}},{"breakpoint": 768,"settings": {"slidesToShow": 2}},{"breakpoint": 400,"settings": {"slidesToShow": 1}}]
					}, 800);

			}else{

				$scope.levelTwoQuestionId = data.levelTwo.LEVEL_TWO_ID;
				$scope.levelTwoQuestionTitle = data.levelTwo.TITLE;
//				$scope.levelOneLatestImg = data.levelTypeImage.downPath;
				$scope.levelOneLatestImg = typeImage != '' ? typeImage : data.levelTypeImage.downPath;

				$scope.displayCollectionLevelTwoTypesOptions = data.levelTwoType;

				$scope.viewFlag = 'Y3';
			}

		})
		.error(function(data, status, headers, config) {
		});
	}

	$scope.chooseOptionLevelThree = function(id){

		var data = {};
		data.recordId = id;
		data.optionId = $scope.optionId;
	    data.userId = userId;
	    var temp = $.param({details: data});

		$http({
			data: temp+"&"+$scope.tokenHash,
			url : site+'/getshadeFinderQuizLevelThreeDetails',
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {

			$scope.levelThreeQuestionId = data.levelThree.LEVEL_THREE_ID;
			$scope.levelThreeQuestionTitle = data.levelThree.TITLE;

			$scope.displayCollectionLevelThreeTypesOptions = data.levelThreeType;

			$scope.viewFlag = 'Y4';

		})
		.error(function(data, status, headers, config) {
		});
	}

	$scope.chooseOptionLevelLast = function(id){

		var data = {};
		data.recordId = id;
		data.optionId = $scope.optionId;
	    data.userId = userId;
	    var temp = $.param({details: data});

		$http({
			data: temp+"&"+$scope.tokenHash,
			url : site+'/getshadeFinderQuizLevelFourDetails',
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {

			$scope.displayCollectionPrimaryProducts = data.primaryProducts;
			$scope.displayCollectionRecommandedProducts = data.recommandedProducts;

			$scope.viewFlag = 'YL';

			if ($('.slick-slider2456').hasClass('slick-initialized')) {
			    $('.slick-slider2456').slick('destroy');
			}

			setTimeout(function(){

				$('.slick-slider2456').slick({
                    slidesToShow: 4,
					autoplaySpeed: 2000,
					"infinite":true,
					"autoplay":true,
					"dots":false,
					"arrows":true,
					prevArrow:"<button type='button' class='slick-prev pull-left'><i class='fa fa-arrow-left' aria-hidden='true'></i></button>",
					nextArrow:"<button type='button' class='slick-next pull-right'><i class='fa fa-arrow-right' aria-hidden='true'></i></button>",
					"responsive":[

								{"breakpoint": 1400,
									"settings": {"slidesToShow": 4}},

								{"breakpoint": 1366,
								"settings": {"slidesToShow": 4}},

								{"breakpoint": 1200,
									"settings": {"slidesToShow": 3}},

								{"breakpoint": 992,
									"settings": {"slidesToShow": 3}},

								{"breakpoint": 768,
									"settings": {"slidesToShow": 2}},

								{"breakpoint": 576,
									"settings": {"slidesToShow": 1}}
								]

					});
//				"slidesToShow": 4,"autoplay":true,"dots":false,"arrows":false,"responsive":[{"breakpoint": 992,"settings": {"slidesToShow":4}},{"breakpoint": 768,"settings": {"slidesToShow": 2}},{"breakpoint": 400,"settings": {"slidesToShow": 1}}]
				}, 800);

		})
		.error(function(data, status, headers, config) {
		});
	}

	$scope.levelOneTabsSwitch = function(i){

		$(".yeslevelonetabs").removeClass('active');
		$("#yes_level_one_"+i).addClass('active');

		$(".yestabs").hide();
		$("#yes_tab_"+i).show();
	}
	$scope.backToPrevious = function(i){

		if($scope.viewFlag == 'Y2'){

			$scope.viewFlag = 'Y1';

		}else if($scope.viewFlag == 'Y3'){

			$scope.viewFlag = 'Y2';

		}else if($scope.viewFlag == 'Y4'){

			$scope.viewFlag = 'Y3';

		}else{

			$scope.viewFlag = 'Y1';
		}
	}



































	// For Quick View


	$(document).on("click", ".shadeAccord-btn", function () {
		var i = $(this).attr('data-id');
		$("#chooseShade_container_"+i).slideToggle('slow');

	});


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




	$scope.bundleProductNames = '';
	$scope.productImagesBundle = '';
	$scope.displayCollectionBundleProductShadesQuickView = '';

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

			if($scope.productType == 'bundle'){

				var product_details = data.productDetails;
				var bundleLines = data.bundleLines;
				var product_shades_details = data.shades;

				if(product_details != null && product_details != ''){

					console.log(product_details);
					console.log(product_shades_details);

					$scope.QuickView_productId = product_details['BUNDLE_ID'];
					$scope.QuickView_name = product_details['NAME'];
					$scope.unit_price = product_details['DISCOUNTED_AMOUNT'];
					$scope.short_description = product_details['SHORT_DESCRIPTION'] ;
					$scope.productImagesBundle = product_details['primaryImage'];

					if(bundleLines != '' && bundleLines != null){
						for(var i=0; i<bundleLines.length; i++){
							if(i==0){
								$scope.bundleProductNames = bundleLines[i]['NAME'];
							}else{
								$scope.bundleProductNames = $scope.bundleProductNames +' | '+ bundleLines[i]['NAME'];
							}
						}
					}

					$scope.displayCollectionBundleProductShadesQuickView = product_shades_details;
				}

				$scope.resetQuickviewPopup();

				$("#productQuickView").modal('show');

			}else{

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

					$scope.displayCollectionProductShadesQuickView = product_shades_details;
				}

				$scope.resetQuickviewPopup();

				$("#productQuickView").modal('show');
			}
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
			toastr.error('Choose subscription first...', '', {timeOut: 3000})
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







