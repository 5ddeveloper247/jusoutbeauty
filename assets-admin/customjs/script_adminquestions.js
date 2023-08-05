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
			url : site+'/getAllAdminQuestionslov',
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {


			if ($.fn.DataTable.isDataTable("#questionsTable")) {
				$('#questionsTable').DataTable().clear().destroy();
			}

			$scope.displayCollectionQuestions = data.questions;

			setTimeout(function(){
				$("#questionsTable").DataTable({
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

	// For delete Question
	$scope.deleteQuestionReply = function(id){

		var data = {};
	    data.recordId = id;

    	var temp = $.param({details: data});

		$http({
			data: temp+"&"+$scope.tokenHash,
			url : site+"/deleteQuestionReply",
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

	$scope.getAllAdminReviewslov();

	$scope.backToListing = function(){
		$scope.editView = 0;
	}

	$scope.updateQuestionStatus = function(id){

		var data = {};
	    data.recordId = id;
	    data.userId = userId;
    	var temp = $.param({details: data});

		$http({
			data: temp+"&"+$scope.tokenHash,
			url : site+"/updateQuestionStatus",
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {


			if ($.fn.DataTable.isDataTable("#questionsTable")) {
				$('#questionsTable').DataTable().clear().destroy();
			}
				$scope.getAllAdminReviewslov();

			// $scope.displayCollectionQuestions = data.questions;

			setTimeout(function(){
				$("#questionsTable").DataTable({
					order: [],
		            aLengthMenu: [
		                          [10, 25, 50, 100, 200, -1],
		                          [10, 25, 50, 100, 200, "All"]
		                      ]
				});
			}, 100);

			toastr.success(data.msg, '', {timeOut: 3000});
		})
		.error(function(data, status, headers, config) {
		});
	}

	$scope.head = {};
	$scope.head.questionId = '';
	$scope.head.question = '';
	$scope.head.answer = '';

	$scope.sendQuestionReply = function(id, question, answer){

		$scope.head.questionId = id;
		$scope.head.question = question;
		$scope.head.answer = answer;

		$("#send_repy_modal").modal('show');
	}
	$scope.closeAnswerModal = function(){

		$scope.head.questionId = '';
		$scope.head.question = '';
		$scope.head.answer = '';

		$("#send_repy_modal").modal('hide');
	}

	$scope.sendQuestionAnswer = function(id){

		var data = {};
	    data.record = $scope.head;
	    data.userId = userId;
    	var temp = $.param({details: data});

		$http({
			data: temp+"&"+$scope.tokenHash,
			url : site+"/saveQuestionAnswer",
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {

			if(data.done == true || data.done == 'true'){

				if ($.fn.DataTable.isDataTable("#questionsTable")) {
					$('#questionsTable').DataTable().clear().destroy();
				}

				$scope.displayCollectionQuestions = data.questions;

				setTimeout(function(){
					$("#questionsTable").DataTable({
						order: [],
			            aLengthMenu: [
			                          [10, 25, 50, 100, 200, -1],
			                          [10, 25, 50, 100, 200, "All"]
			                      ]
					});
				}, 500);

				$("#send_repy_modal").modal('hide');

				toastr.success(data.msg, '', {timeOut: 3000});
			}else{
				toastr.error(data.msg, '', {timeOut: 3000});
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







