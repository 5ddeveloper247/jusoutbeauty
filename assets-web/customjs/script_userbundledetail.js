var myApp = angular.module('project1',["smart-table"], function(){});
myApp.controller('projectinfo1',function($scope,$compile,$rootScope,$timeout,$http,$window,$filter,$q,$routeParams) {


	$scope.selfi = {};
	$scope.selfi.ID = "";
	$scope.selfi.productId = productId ? productId : bundleId;
	$scope.selfi.name = "";
	$scope.selfi.email = "";
	$scope.selfi.primaryflag = "Bundle";

	$scope.submitProductSelfi = function(){

		var data = {};
	   
	    data.selfi = $scope.selfi;

		var temp = $.param({details: data});
    	
		$http({
			data: temp,
			url : site+'/saveProductSelfie',
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {
			

			if(data.done == true || data.done == 'true'){
				toastr.success('Basic Info Saved, now upload Images...', '', {timeOut: 3000})

				$scope.selfi.ID = data.ID;
			}
			
		})
		.error(function(data, status, headers, config) {
		});
	}


	$(document).on("click", "#chooseShadeBtn", function () {
		
		$("#chooseShade_container").slideToggle('slow');
		
	});
	$(document).on("click", ".shadeAccord-btn", function () {
		var i = $(this).attr('data-id');
		$("#chooseShade_container_"+i).slideToggle('slow');
		
	});
	$(document).on("click", "#chooseShadeBtn2", function () {
		
		$("#chooseShade2_container").slideToggle('slow');
		
	});
	// for bundle view code start
	$(document).on("click", ".spotlightTabBtn", function () {
		
		var i = $(this).attr('data-id');
		$(".ingredientTabBtn"+i).removeClass('active');
		$(".spotlightTabBtn"+i).addClass('active');
		$("#tabbspotlight"+i).show();
		$("#tabbformulated"+i).hide();
		
	});
	$(document).on("click", ".formulatedTabBtn", function () {
		
		var i = $(this).attr('data-id');
		$(".ingredientTabBtn"+i).removeClass('active');
		$(".formulatedTabBtn"+i).addClass('active');
		$("#tabbspotlight"+i).hide();
		$("#tabbformulated"+i).show();
		
	});
	// for bundle view code end
	$(document).on("click", "#spotlightTabBtn", function () {

		$(".ingredientTabBtn").removeClass('active');
		$("#spotlightTabBtn").addClass('active');
		$("#tabbspotlight").show();
		$("#tabbformulated").hide();
		
	});
	$(document).on("click", "#formulatedTabBtn", function () {

		$(".ingredientTabBtn").removeClass('active');
		$("#formulatedTabBtn").addClass('active');
		$("#tabbspotlight").hide();
		$("#tabbformulated").show();
		
	});
	$(document).on("click", "#pillsReviewsTab", function () {

		$(".revque_btn").removeClass('active');
		$("#pillsReviewsTab").addClass('active');
		$("#writeQuestion_container").hide();
		$("#pillsQuestions_container").hide();
		$("#writeReview_container").hide();
		$("#pillsReviews_container").show();
	});
	$(document).on("click", "#pillsQuestionsTab", function () {

		$(".revque_btn").removeClass('active');
		$("#pillsQuestionsTab").addClass('active');
		$("#writeReview_container").hide();
		$("#pillsReviews_container").hide();
		$("#writeQuestion_container").hide();
		$("#pillsQuestions_container").show();
	});
	$(document).on("click", "#writeReview_btn", function () {
		$(".revque_btn").removeClass('active');
		$("#pillsReviewsTab").addClass('active');
		$("#writeQuestion_container").hide();
		$("#pillsQuestions_container").hide();
		$("#pillsReviews_container").show();
		$("#writeReview_container").slideToggle('slow');
		$scope.$apply(function () {
			$scope.resetReview();
			$scope.resetQuestion();
		});
	});
	$(document).on("click", "#writeQuestion_btn", function () {
		$(".revque_btn").removeClass('active');
		$("#pillsQuestionsTab").addClass('active');
		$("#writeReview_container").hide();
		$("#pillsReviews_container").hide();
		$("#pillsQuestions_container").show();
		$("#writeQuestion_container").slideToggle('slow');
		$scope.$apply(function () {
			$scope.resetReview();
			$scope.resetQuestion();
		});
	});
	$scope.resetReview = function(){
		
		$scope.review = {};
		$scope.review.productId = productId;
		$scope.review.bundleId = bundleId;
	    $scope.review.R_1 = '';
	    $scope.review.R_2 = '';
	    $scope.review.R_3 = ''; 
	    $scope.review.R_4 = '';
	    $scope.review.R_5 = '';
	    $scope.review.R_6 = '';
	    $scope.review.R_7 = '';
	    $scope.review.R_8 = '';
	    $scope.review.R_9 = '';
	    $scope.review.R_10 = '';
	    $scope.review.R_11 = '';
	    $('input[name="rate"]').prop('checked', false);
		$('input[name="skin"]').prop('checked', false);
		$('input[name="climate"]').prop('checked', false);
		$('input[name="age"]').prop('checked', false);
		$('input[name="murad"]').prop('checked', false);
		$('input[name="skintype"]').prop('checked', false);
		$('input[name="recommand"]').prop('checked', false);
	}
	
	$scope.review = {};
	$scope.review.productId = productId;
	$scope.review.bundleId = bundleId;
    $scope.review.R_1 = '';
    $scope.review.R_2 = '';
    $scope.review.R_3 = ''; 
    $scope.review.R_4 = '';
    $scope.review.R_5 = '';
    $scope.review.R_6 = '';
    $scope.review.R_7 = '';
    $scope.review.R_8 = '';
    $scope.review.R_9 = '';
    $scope.review.R_10 = '';
    $scope.review.R_11 = '';
   	
    $scope.ratingone = '0';
	$scope.ratingtwo = '0';
	$scope.ratingthree = '0';
	$scope.ratingfour = '0';
	$scope.ratingfive = '0';
	$scope.oneRatingPercent = '0';
	$scope.twoRatingPercent = '0';
	$scope.threeRatingPercent = '0';
	$scope.fourRatingPercent = '0';
	$scope.fiveRatingPercent = '0';
	$scope.totalReviews = '0';
	$scope.allRatingSum = '0';
	$scope.averageRating = '0';
	$scope.averageRatingRound = '0';
	
	$scope.tokenHash = $("#csrf").val();
	
	$scope.getAllProductDetailLov = function(){
		
		var data = {};
	    data.userId = userId;
	    data.productId = productId;
	    data.bundleId = bundleId;
	    
	    var temp = $.param({details: data});
    	
		$http({
			data: temp+"&"+$scope.tokenHash,
			url : site+'/getAllProductDetailLov',
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {
			
			$scope.displayCollectionReviews = data.reviews;
			$scope.displayCollectionQuestions = data.questions;
			$scope.subscriptionLov = data.subscriptions;
			
			$scope.displayCollectionProductShades = data.shades;
			
			var ratings = data.ratings;
			
			$scope.ratingone = ratings['one'];
			$scope.ratingtwo = ratings['two'];
			$scope.ratingthree = ratings['three'];
			$scope.ratingfour = ratings['four'];
			$scope.ratingfive = ratings['five'];
			$scope.oneRatingPercent = ratings['oneRatingPercent'];
			$scope.twoRatingPercent = ratings['twoRatingPercent'];
			$scope.threeRatingPercent = ratings['threeRatingPercent'];
			$scope.fourRatingPercent = ratings['fourRatingPercent'];
			$scope.fiveRatingPercent = ratings['fiveRatingPercent'];
			$scope.totalReviews = ratings['totalReviews'];
			$scope.allRatingSum = ratings['allRatingSum'];
			$scope.averageRating = ratings['averageRating'];
			$scope.averageRatingRound = ratings['averageRatingRound'];

			setTimeout(function(){
			var displayCollectionProductShades = data.shades;

			for(var i = 0; i < displayCollectionProductShades.length; i++) {

				if(displayCollectionProductShades[i].productShades == null){

				 $('#shadeBundlechooser_container_'+displayCollectionProductShades[i].BUNDLE_LINE_ID).hide();
				}
			}
			}, 700);			
		})
		.error(function(data, status, headers, config) {
		});
	}
	$scope.getAllProductDetailLov();

	
	$scope.postReview = function(){
		
		$scope.review.productId = productId;
		$scope.review.bundleId = bundleId;
		$scope.review.R_1 = $('input[name="rate"]:checked').val();
		$scope.review.R_4 = $('input[name="skin"]:checked').val();
		$scope.review.R_5 = $('input[name="climate"]:checked').val();
		$scope.review.R_6 = $('input[name="age"]:checked').val();
		$scope.review.R_7 = $('input[name="murad"]:checked').val();
		$scope.review.R_8 = $('input[name="skintype"]:checked').val();
		$scope.review.R_9 = $('input[name="recommand"]:checked').val();
		
		var data = {};
	    data.userId = userId;
	    data.review = $scope.review;

	    var temp = $.param({details: data});
    	
		$http({
			data: temp+"&"+$scope.tokenHash,
			url : site+'/saveUserReview',
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {
			
			if(data.done == true || data.done == 'true'){
				
				$scope.displayCollectionReviews = data.reviews;
				
				$("#writeReview_container").slideToggle('slow');
				
				toastr.success(data.msg, '', {timeOut: 3000})
				
				$scope.resetReview();
				
			}else{
				toastr.error(data.msg, '', {timeOut: 3000})
			}
			
		})
		.error(function(data, status, headers, config) {
		});
	}
	
	$scope.question = {};
	$scope.question.productId = productId;
	$scope.question.bundleId = bundleId;
    $scope.question.Q_1 = '';
    $scope.question.Q_2 = '';
    $scope.question.Q_3 = ''; 
    
    $scope.resetQuestion = function(){
		
    	$scope.question = {};
    	$scope.question.productId = productId;
    	$scope.question.bundleId = bundleId;
        $scope.question.Q_1 = '';
        $scope.question.Q_2 = '';
        $scope.question.Q_3 = ''; 
	}
    
    $scope.postQuestion = function(){
		
		$scope.question.productId = productId;
		$scope.question.bundleId = bundleId;
		
		var data = {};
	    data.userId = userId;
	    data.question = $scope.question; 
	    
	    var temp = $.param({details: data});
    	
		$http({
			data: temp+"&"+$scope.tokenHash,
			url : site+'/saveUserQuestion',
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {
			
			if(data.done == true || data.done == 'true'){
				
				$scope.displayCollectionQuestions = data.questions;
				
				$("#writeQuestion_container").slideToggle('slow');
				
				toastr.success(data.msg, '', {timeOut: 3000})
				
				$scope.resetQuestion();
				
			}else{
				toastr.error(data.msg, '', {timeOut: 3000})
			}
			
		})
		.error(function(data, status, headers, config) {
		});
	}
	
    $scope.prodShadeId = '';
    $scope.shadeId = '';
    $scope.selectedShadeName = '';
    $scope.selectedShadeImg_p = '';
    $scope.selectedShadeImg_s = '';
    
    $scope.chooseProdShade = function(lineId, prodShadeId, shadeId, productId, shadeName, primaryImg, secondaryImg){
    	
    	$(".shade_chooser"+lineId).removeClass('shade-active');
    	$("#shadeAnchor_"+prodShadeId).addClass('shade-active');
    	
    	$("#shadeId_"+lineId).val(shadeId);
    	$("#prodShadeId_"+lineId).val(prodShadeId);
    	$("#productId_"+lineId).val(productId);
    	$("#shadeName_"+lineId).val(shadeName);
    	$("#shadeName1_"+lineId).val(shadeName);
    	
        $scope.selectedShadeImg_p = primaryImg;
        $scope.selectedShadeImg_s = secondaryImg;
        
    }
    $scope.confirmProductShade = function(lineId){
    	
    	if($("#prodShadeId_"+lineId).val() != ''){
    		
        	$("#chooseShade_container_"+lineId).slideUp('slow');
        	
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

	$('#uploadatt6').fileupload({
		
		add: function (e, data) {
			
			if($scope.selfi.ID == ""){
				
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

			  }else if(xhr.responseText[0] == 04){
			
				  toastr.error("Error : Image dimensions must be minimum 270 X 370", '', {timeOut: 3000});

			  }else{

				 
					var img_extension = xhr.responseText[5].toLowerCase();
					
					if(img_extension == 'jpg' || img_extension == 'png' || img_extension == 'jpeg' || img_extension == 'svg' || img_extension == 'gif' || img_extension == 'webp'){
						toastr.success("Image Upload Successfully", '', {timeOut: 3000});
						var html = '<div class="col-3 image-overlay margin-r1 mt-3" id="img_file_'+xhr.responseText[1]+'">'+
							   '<img src="'+xhr.responseText[2]+'" alt="" class="image-box">'+
							   '<div class="overlay">'+
								   '<div class="text">'+
									   '<img class="fa-trash-alt" src="'+baseurl+'/images/admin/trash.svg" alt="" width="18" ng-click="deleteProductSelfiImage('+xhr.responseText[1]+')" title="Delete Image">'+
								   '</div>'+
							   '</div>'+
						   '</div>';
					}else{
						toastr.success("Video Upload Successfully", '', {timeOut: 3000});
						var html = '<div class="col-3 image-overlay margin-r1 mb-3" id="img_file_'+xhr.responseText[1]+'">'+
							   '<img src="'+baseurl+'/images/video.png" alt="" class="image-box">'+
							   '<div class="overlay">'+
								   '<div class="text">'+
									   '<img class="fa-trash-alt" src="'+baseurl+'/images/admin/trash.svg" alt="" width="18" ng-click="deleteProductSelfiImage('+xhr.responseText[1]+')" title="Delete Video">'+
								   '</div>'+
							   '</div>'+
						   '</div>';
					}
				  
				  
				  $("#p_att").append($compile(angular.element(html))($scope));

			  }
		   }
	});
	$scope.deleteProductSelfiImage = function(id){
		
		var data = {};
		data.imageId = id;
	    
    	var temp = $.param({details: data});
    	
		$http({
			data: temp+"&"+$scope.tokenHash,
			url : site+"/deleteProductSelfiImage",
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {
				
			toastr.success(data.msg, '', {timeOut: 3000})
			$("#img_file_"+data.images_id).remove();
			// $scope.makeImageAttachmentHtml(data.images);
			
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




		
		
		
