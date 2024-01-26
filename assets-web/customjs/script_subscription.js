var myApp = angular.module('project1',["smart-table"], function(){});
myApp.controller('projectinfo1',function($scope,$compile,$rootScope,$timeout,$http,$window,$filter,$q,$routeParams) {


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
    $scope.getAllUserStoreListingAllLov = function(){

		$scope.lowerlimit = 0;
		var data = {};
	    data.userId = userId;
	    data.lowerlimit = $scope.lowerlimit;

	    var temp = $.param({details: data});
		$http({
			data: temp+"&"+$scope.tokenHash,
			url : site+'/getAllUserStoreListingAllLov',
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {
            // console.log(data.products);
			// $scope.displayCollectionProducts = data.products;
                    // Assign products with shades to $scope.displayCollectionProducts
            $scope.displayCollectionProductssss = data.products.map(product => {
            // If the product has shades, include them in the product object
            if (product.shades && product.shades.length > 0) {
                product.hasShades = true; // You can use this flag to conditionally show shades
            }
            // console.log(data.products);
            return product;
        });

			$scope.displayCollectionShadeFilter = data.list1;

			$scope.displayCollectionSubCategoryFilter = data.list2;

			$scope.lowerlimit = $scope.lowerlimit + data.list2.length;

		})
		.error(function(data, status, headers, config) {
		});
	}

    $scope.getAllUserStoreListingAllLov();

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
			toastr.error('...Choose subscription first.....', '', {timeOut: 3000})
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
