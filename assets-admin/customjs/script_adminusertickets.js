var myApp = angular.module('project1',["smart-table"], function(){});
myApp.controller('projectinfo1',function($scope,$compile,$rootScope,$timeout,$http,$window,$filter,$q,$routeParams) {

//	$(document).on('click','.addNew',function(){
//	    $('#addCity_modal').modal('show');return false;
//	});
//
//	$(document).on('click','.modalClose',function(){
//	    $('#addCity_modal').modal('hide');return false;
//	});


	$scope.ticket = {};
	$scope.ticket.ID = '';
	$scope.ticket.T_1 = '';
	$scope.ticket.T_2 = '';
	$scope.ticket.T_3 = '';
	$scope.ticket.T_4 = '';
	$scope.ticket.T_5 = '';
	$scope.ticket.T_6 = '';
	$scope.ticket.T_7 = '';

	$scope.ticketReply = '';


	$scope.editView = 0;

	$scope.tokenHash = $("#csrf").val();

	$scope.getAllAdminUserTicketslov = function(){

		var data = {};
	    data.userId = userId;
	    var temp = $.param({details: data});

		$http({
			data: temp+"&"+$scope.tokenHash,
			url : site+'/getAllAdminUserTicketslov',
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {

			if ($.fn.DataTable.isDataTable("#ticketListing_table")) {
				$('#ticketListing_table').DataTable().clear().destroy();
			}

			$scope.displayCollectionTickets = data.list;
			$scope.orderList = data.orders;

			setTimeout(function(){
				$("#ticketListing_table").DataTable({
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
	$scope.getAllAdminUserTicketslov();

	$scope.backToListing = function(){

		$scope.ticketId = '';
		$scope.tktNumber = '';
		$scope.tktType = '';
		$scope.tktDocNum = '';
		$scope.tktUsername = '';
		$scope.tktEmail = '';
		$scope.tktPhoneNum = '';
		$scope.tktSubject = '';
		$scope.tktDes = '';
		$scope.tktStatus = '';
		$scope.tktDate = '';
		$scope.tktPriority = '';

		$scope.ticketReply = '';

		$scope.editView = 0;

		$scope.getAllAdminUserTicketslov();
	}
	$scope.addNew = function(){

		$scope.ticket = {};
		$scope.ticket.ID = '';
		$scope.ticket.T_1 = '';
		$scope.ticket.T_2 = '';
		$scope.ticket.T_3 = '';
		$scope.ticket.T_4 = '';
		$scope.ticket.T_5 = '';
		$scope.ticket.T_6 = '';
		$scope.ticket.T_7 = '';
		$scope.ticket.T_8 = '';

		$('#t5').val($scope.ticket.T_5);

		$scope.editView = 1;
	}

	$scope.saveTicket = function(){

		var data = {};
	    data.userId = userId;
	    data.ticket = $scope.ticket;

	    var temp = $.param({details: data});

		$http({
			data: temp+"&"+$scope.tokenHash,
			url : site+'/saveAdminTicketDetails',
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {


			if(data.done == true || data.done == 'true'){

				if ($.fn.DataTable.isDataTable("#ticketListing_table")) {
					$('#ticketListing_table').DataTable().clear().destroy();
				}

				$scope.displayCollectionTickets = data.list;

				setTimeout(function(){
					$("#ticketListing_table").DataTable();
				}, 500);

				toastr.success(data.msg, '', {timeOut: 3000})

				$scope.ticket.ID = data.ID;

//				$scope.editView = 0;

			}else{
				toastr.error(data.msg, '', {timeOut: 3000})
			}

		})
		.error(function(data, status, headers, config) {
		});
	}

	$scope.changeStatusOpenClose = function(ticketId, flag){

		var data = {};
	    data.userId = userId;
	    data.ticketId = ticketId;
	    data.flag = flag;

	    var temp = $.param({details: data});

		$http({
			data: temp+"&"+$scope.tokenHash,
			url : site+'/changeAdminTicketStatus',
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {


			if(data.done == true || data.done == 'true'){

				if ($.fn.DataTable.isDataTable("#ticketListing_table")) {
					$('#ticketListing_table').DataTable().clear().destroy();
				}

				// $scope.displayCollectionTickets = data.list;
				$scope.getAllAdminUserTicketslov();

				setTimeout(function(){
					$("#ticketListing_table").DataTable();
				}, 100);

			}else{
				toastr.error(data.msg, '', {timeOut: 3000})
			}

		})
		.error(function(data, status, headers, config) {
		});
	}

	$scope.ticketId = '';
	$scope.tktNumber = '';
	$scope.tktType = '';
	$scope.tktDocNum = '';
	$scope.tktUsername = '';
	$scope.tktEmail = '';
	$scope.tktPhoneNum = '';
	$scope.tktSubject = '';
	$scope.tktDes = '';
	$scope.tktStatus = '';
	$scope.tktDate = '';
	$scope.tktPriority = '';

	$scope.viewTicketDetails = function(ticketId){

		var data = {};
	    data.userId = userId;
	    data.ticketId = ticketId;
	    var temp = $.param({details: data});

		$http({
			data: temp+"&"+$scope.tokenHash,
			url : site+'/getSpecificAdminTicketDetails',
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {

			$scope.editView = 2;
			var detail = data.details;

			$scope.displayCollectionTicketReplies = data.replies;
			$scope.displayCollectionTicketImg = data.images;

			$scope.ticketId = detail['TICKET_ID'];
			$scope.tktNumber = detail['TICKET_NUMBER'];
			$scope.tktType = detail['TICKET_TYPE'];
			$scope.tktDocNum = detail['DOCUMENT_NUMBER'];
			$scope.tktUsername = detail['USER_NAME'];
			$scope.tktEmail = detail['EMAIL'];
			$scope.tktPhoneNum = detail['PHONE_NUMBER'];
			$scope.tktSubject = detail['SUBJECT'];
			$scope.tktDes = detail['DESCRIPTION'];
			$scope.tktStatus = detail['STATUS'];
			$scope.tktDate = detail['DATE'];
			$scope.tktPriority = detail['PRIORITY'];

		})
		.error(function(data, status, headers, config) {
		});
	}


	$scope.saveTicketReply = function(){

		var data = {};
	    data.userId = userId;
	    data.ticketId = $scope.ticketId;
	    data.ticketReply = $scope.ticketReply;

	    var temp = $.param({details: data});

		$http({
			data: temp+"&"+$scope.tokenHash,
			url : site+'/saveAdminTicketReplyDetail',
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {


			if(data.done == true || data.done == 'true'){

				$scope.displayCollectionTicketReplies = data.replies;

				$scope.ticketReply = '';

				$scope.editView = 2;

			}else{
				toastr.error(data.msg, '', {timeOut: 3000})
			}

		})
		.error(function(data, status, headers, config) {
		});
	}

	$scope.deletePic = function(id){

		var data = {};
	    data.recordId = id;
	    data.ticketId = $scope.ticket.ID;
	    data.userId = userId;
    	var temp = $.param({details: data});

		$http({
			data: temp+"&"+$scope.tokenHash,
			url : site+"/deleteTicketAttachment",
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {

			toastr.success(data.msg, '', {timeOut: 3000})

			$('#img_file_'+id).remove();

		})
		.error(function(data, status, headers, config) {
		});
	}

	// For delete Ticket
	$scope.deleteTicketDetails = function(id){

		var data = {};
	    data.recordId = id;

    	var temp = $.param({details: data});

		$http({
			data: temp+"&"+$scope.tokenHash,
			url : site+"/deleteTicketDetails",
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {
			toastr.success(data.msg, '', {timeOut: 3000})
			$scope.editView = 0;
			$scope.getAllAdminUserTicketslov();

		})
		.error(function(data, status, headers, config) {
		});
	}
$('#uploadattch').fileupload({

 		add: function (e, data) {


 			if($scope.ticket.ID == ""){

 				toastr.error('Save record first, then upload Images...', '', {timeOut: 3000})
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
			$scope.$apply(() => {
				$scope.getAllAdminUserTicketslov();
				$scope.editView = 0;
			});
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

 	      		toastr.error("Error : Save record first, then upload Images...", '', {timeOut: 3000});

 	      	}else{

 		  		toastr.success("Image Upload Successfully", '', {timeOut: 3000});

 		  		var html = '<div class="col-2 image-overlay margin-r1" id="img_file_'+xhr.responseText[1]+'">'+
								'<img src="'+xhr.responseText[2]+'" alt="" class="image-box">'+
								'<div class="overlay">'+
									'<div class="text">'+
										'<img class="fa-trash-alt" src="'+baseurl+'/images/admin/trash.svg" alt="" width="18" ng-click="deletePic('+xhr.responseText[1]+')" title="Delete Image">'+
										'<div class="arrow-icon-move-box">'+
											'<img class="arrow-center" src="'+baseurl+'/images/admin/feather-move.svg" alt="">'+

										'</div>'+
									'</div>'+
								'</div>'+
							'</div>';
 		  		$("#p_att").append($compile(angular.element(html))($scope));


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







