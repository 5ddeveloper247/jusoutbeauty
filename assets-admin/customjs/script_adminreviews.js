var myApp = angular.module('project1',["smart-table"], function(){});
myApp.controller('projectinfo1',function($scope,$rootScope,$timeout,$http,$window,$filter,$q,$routeParams) {

	$(document).on('click','.addNew',function(){
	    $('#addCity_modal').modal('show');return false; 
	});

	$(document).on('click','.modalClose',function(){
	    $('#addCity_modal').modal('hide');return false; 
	});
	
	$scope.editView = 0;

	$scope.tokenHash = $("#csrf").val();
	
	$scope.getAllAdminReviewslov = function(){
		
		var data = {};
	    data.userId = userId;
	    var temp = $.param({details: data});
    	
		$http({
			data: temp+"&"+$scope.tokenHash,
			url : site+'/getAllAdminReviewslov',
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {
			
			
			if ($.fn.DataTable.isDataTable("#reviewsTable")) {
				$('#reviewsTable').DataTable().clear().destroy();
			}
			
			$scope.displayCollectionReviews = data.reviews;
			
			setTimeout(function(){
				$("#reviewsTable").DataTable({
					order: [],
		            aLengthMenu: [
		                          [10, 25, 50, 100, 200, -1],
		                          [10, 25, 50, 100, 200, "All"]
		                      ]
				});
			}, 500);
			
		})
		.error(function(data, status, headers, config) {
		});
	}
	$scope.getAllAdminReviewslov();

	// For delete Review
	$scope.deleteReviewDetails = function(id){

		var data = {};
	    data.recordId = id;

    	var temp = $.param({details: data});
    	
		$http({
			data: temp+"&"+$scope.tokenHash, 
			url : site+"/deleteReviewDetails",
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {
			toastr.success(data.msg, '', {timeOut: 3000})
			$scope.getAllAdminReviewslov();	
			
		})
		.error(function(data, status, headers, config) {
		});
	}	
		
	$scope.backToListing = function(){
		$scope.editView = 0;
	}
	
	$scope.updateReviewStatus = function(id){
		
		var data = {};
	    data.recordId = id;
	    data.userId = userId;
    	var temp = $.param({details: data});
    	
		$http({
			data: temp+"&"+$scope.tokenHash, 
			url : site+"/updateReviewStatus",
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {
				
			
			if ($.fn.DataTable.isDataTable("#reviewsTable")) {
				$('#reviewsTable').DataTable().clear().destroy();
			}
			
			$scope.displayCollectionReviews = data.reviews;
			// $scope.getAllAdminReviewslov();
			
			setTimeout(function(){
				$("#reviewsTable").DataTable({
					order: [],
		            aLengthMenu: [
		                          [10, 25, 50, 100, 200, -1],
		                          [10, 25, 50, 100, 200, "All"]
		                      ]
				});
			}, 500);
			
			toastr.success(data.msg, '', {timeOut: 3000});
		})
		.error(function(data, status, headers, config) {
		});
	}
	
	$scope.reviewId = '';
	$scope.productId = '';
	$scope.title = '';
	$scope.description = '';
	$scope.username = '';
	$scope.email = '';
	$scope.starRating = '';
	$scope.skinType = '';
	$scope.climate = '';
	$scope.ageRange = '';
	$scope.recommandMurad = '';
	$scope.skinType1 = '';
	$scope.recommandProduct = '';
	$scope.date = '';
	$scope.status = '';
	
	$scope.viewReviewDetails = function(id){
		
		var data = {};
	    data.recordId = id;
	    data.userId = userId;
    	var temp = $.param({details: data});
    	
		$http({
			data: temp+"&"+$scope.tokenHash, 
			url : site+"/getSpecificReviewDetails",
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {
				
			var details = data.details;
			
			if(details != '' && details != null){
				
				$scope.reviewId = details['REVIEW_ID'];
				$scope.productId = details['PRODUCT_ID'];
				$scope.title = details['TITLE'];
				$scope.description = details['REVIEW_DESCRIPTION'];
				$scope.username = details['USERNAME'];
				$scope.email = details['EMAIL'];
				$scope.starRating = details['STAR_RATING'];
				$scope.skinConcerns = details['SKIN_TYPE'];
				$scope.climate = details['CLIMATE'];
				$scope.ageRange = details['AGE_RANGE'];
				$scope.recommandMurad = details['RECOMMAND_MURAD'];
				$scope.skinType1 = details['SKIN_TYPE1'];
				$scope.recommandProduct = details['RECOMMAND_PRODUCT'];
				$scope.date = details['DATE'];
				$scope.status = details['STATUS'];
				
				$scope.editView = 1;
			}
		})
		.error(function(data, status, headers, config) {
		});
	}
	$scope.updateReviewOnSiteStatus = function(id){
		
		var data = {};
	    data.recordId = id;
	    data.userId = userId;
    	var temp = $.param({details: data});
    	
		$http({
			data: temp+"&"+$scope.tokenHash, 
			url : site+"/updateReviewOnSiteStatus",
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {
				
			
			if ($.fn.DataTable.isDataTable("#reviewsTable")) {
				$('#reviewsTable').DataTable().clear().destroy();
			}
			
			$scope.displayCollectionReviews = data.reviews;
			
			setTimeout(function(){
				$("#reviewsTable").DataTable({
					order: [],
		            aLengthMenu: [
		                          [10, 25, 50, 100, 200, -1],
		                          [10, 25, 50, 100, 200, "All"]
		                      ]
				});
			}, 500);
			
			toastr.success(data.msg, '', {timeOut: 3000});
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




		
		
		
