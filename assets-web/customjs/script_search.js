var myApp = angular.module('project1',["smart-table"], function(){});
myApp.controller('projectinfo1',function($scope,$rootScope,$timeout,$http,$window,$filter,$q,$routeParams) {


	$scope.getAllUserStoreListingAllLov = function(){

		$scope.lowerlimit = 0;
		var data = {};
	    data.userId = userId;
	    data.lowerlimit = $scope.lowerlimit;
        data.searchProduct=searchProduct;
	    var temp = $.param({details: data});
		$http({
			data: temp+"&"+$scope.tokenHash,
			url : site+'/get-search-all',
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {
            console.log(data.products);
			// $scope.displayCollectionProducts = data.products;
                    // Assign products with shades to $scope.displayCollectionProducts
            $scope.displayCollectionProducts = data.products.map(product => {
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


    $scope.getAllUserStoreListingAllLov()


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
            console.log(data.products);
			// $scope.displayCollectionProducts = data.products;
                    // Assign products with shades to $scope.displayCollectionProducts
            $scope.displayCollectionProducts = data.products.map(product => {
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



    //side bar


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
