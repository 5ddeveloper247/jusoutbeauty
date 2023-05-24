var myApp = angular.module('project1',["smart-table"], function(){});
myApp.controller('projectinfo1',function($scope,$compile,$rootScope,$timeout,$http,$window,$filter,$q,$routeParams) {

	
//	$(document).on('click','.addNew',function(){
//	    $('#addCity_modal').modal('show');return false; 
//	});

//	$(document).on('click','.modalClose',function(){
//	    $('#addCity_modal').modal('hide');return false; 
//	});
	
	$scope.social={};
	$scope.social.ID = "";
	$scope.social.S_1 = "";
	$scope.social.S_2 = false;
	$scope.social.S_3 = "";
	$scope.social.S_4 = false;
	$scope.social.S_5 = "";
	$scope.social.S_6 = false;
	$scope.social.S_7 = "";
	$scope.social.S_8 = false;
	$scope.social.S_9 = "";
	$scope.social.S_10 = false;

	$scope.editView = 0;
//
	$scope.tokenHash = $("#csrf").val();
	
	$scope.getAllAdminHomefooterlov = function(){
		
		var data = {};
	    data.userId = userId;
	    var temp = $.param({details: data});
    	
		$http({
			data: temp+"&"+$scope.tokenHash,
			url : site+'/get-Admin-Footer-Details',
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {

			var details = data.footerdetails;
			$scope.social.ID = details['CONTROL_ID'];
			$scope.social.S_1 = details['FACEBOOK_ICON_LINK'];
			$scope.social.S_2 = details['FACEBOOK_ICON_ENABLE'] == '1' ? true : false;
			$scope.social.S_3 = details['INSTAGRAM_ICON_LINK'];
			$scope.social.S_4 = details['INSTAGRAM_ICON_ENABLE'] == '1' ? true : false;
			$scope.social.S_5 = details['TWITTER_ICON_LINK'];
			$scope.social.S_6 = details['TWITTER_ICON_ENABLE'] == '1' ? true : false;
			$scope.social.S_7 = details['LINKEDIN_ICON_LINK'];
			$scope.social.S_8 = details['LINKEDIN_ICON_ENABLE'] == '1' ? true : false;
			$scope.social.S_9 = details['YOUTUBE_ICON_LINK'];
			$scope.social.S_10 = details['YOUTUBE_ICON_ENABLE'] == '1' ? true : false;
			
		})
	
	}

	$scope.getAllAdminHomefooterlov();

	$scope.saveSocialicons = function(){
	
		var isFacebookUrl = /((http|https):\/\/)?(www\.)?(facebook\.com)(\/)?([a-zA-Z0-9\-\.]+)\/?/.test($scope.social.S_1);
	    if(!isFacebookUrl) {
	      toastr.error('Enter valid facebook url',"", {timeOut: 1500,});return false;
	    }
	    var isInstagramUrl = /((http|https):\/\/)?(www\.)?(instagram\.com)(\/)?([a-zA-Z0-9\-\.]+)\/?/.test($scope.social.S_3);
	    if(!isInstagramUrl) {
	      toastr.error('Enter valid instagram url',"", {timeOut: 1500,});return false;
	    }
	    var isTwittweUrl = /((http|https):\/\/)?(www\.)?(tiktok\.com)(\/)?([a-zA-Z0-9\-\.]+)\/?/.test($scope.social.S_5);
	    if(!isTwittweUrl) {
	      toastr.error('Enter valid twitter url',"", {timeOut: 1500,});return false;
	    }
//	    var isLinkedinUrl = /((http|https):\/\/)?(www\.)?(twitter\.com)(\/)?([a-zA-Z0-9\-\.]+)\/?/.test($scope.social.S_7);
//	    if(!isLinkedinUrl) {
//	      toastr.error('Enter valid linkedin url',"", {timeOut: 1500,});return false;
//	    }
	    
	    var isYoutubeUrl = /((http|https):\/\/)?(www\.)?(youtube\.com)(\/)?([a-zA-Z0-9\-\.]+)\/?/.test($scope.social.S_9);
	    if(!isYoutubeUrl) {
	      toastr.error('Enter valid youtube url',"", {timeOut: 1500,});return false;
	    }
	    
		var data = {};
	    data.userId = userId;
		data.social = $scope.social;
	    var temp = $.param({details: data});
    	
		$http({
			data: temp+"&"+$scope.tokenHash,
			url : site+'/add-social-icons',
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {
//			$scope.social.ID = data['CONTROL_ID'];
	
			toastr.success(data.msg, '', {timeOut: 1000});
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




		
		
		
