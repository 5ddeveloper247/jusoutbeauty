var myApp = angular.module('project1',["smart-table"], function(){});
myApp.controller('projectinfo1',function($scope,$compile,$rootScope,$timeout,$http,$window,$filter,$q,$routeParams) {

//	$(document).on('click','.addNew',function(){
//	    $('#addCity_modal').modal('show');return false;
//	});

//	$(document).on('click','.modalClose',function(){
//	    $('#addCity_modal').modal('hide');return false;
//	});

	$scope.blogs={};
	$scope.blogs.ID = "";
	$scope.blogs.P_1 = "";
	$scope.blogs.P_2 = "";

	$scope.editView = 0;
//
	$scope.tokenHash = $("#csrf").val();

	$scope.getAllAdminBlogslov = function(){

		var data = {};
	    data.userId = userId;
	    var temp = $.param({details: data});

		$http({
			data: temp+"&"+$scope.tokenHash,
			url : site+'/getAllAdminBloglov',
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {

			var ourBlog = data.ourBlog;

			if(ourBlog != ''){
				$scope.single_blog.S_1 = ourBlog['NAME'];

				$("#p_att_sin").html('');

				if(ourBlog['image'] != ''){
					var html = '<div class="col-2 image-overlay margin-r1" id="img_file1_1">'+
								   '<img src="'+ourBlog["image"]+'" alt="" class="image-box">'+
								   '<div class="overlay">'+
									   '<div class="text">'+
										   '<img class="fa-trash-alt" src="'+baseurl+'/images/admin/trash.svg" alt="" width="18" ng-click="deletePic(1)" title="Delete Image">'+
										   '<div class="arrow-icon-move-box">'+
											   '<img class="arrow-center" src="'+baseurl+'/images/admin/feather-move.svg" alt="">'+
										   '</div>'+
									   '</div>'+
								   '</div>'+
							   '</div>';
					  $("#p_att_sin").append($compile(angular.element(html))($scope));
				}
			}

			if ($.fn.DataTable.isDataTable("#shadesTable")) {
				$('#shadesTable').DataTable().clear().destroy();
			}
			$scope.displayCollection = data.list;

			setTimeout(function(){
				$("#shadesTable").DataTable({
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
	$scope.getAllAdminBlogslov();
	$scope.reset = function(){
		$scope.blogs={};
		$scope.blogs.ID = "";
		$scope.blogs.P_1 = "";
		$scope.blogs.P_2 = "";
		$("#p_att").html('');
		$(".summernote").summernote("code", '');
	}

	$scope.addNew = function(){
		$scope.blogs={};
		$scope.blogs.ID = "";
		$scope.blogs.P_1 = "";
		$scope.blogs.P_2 = "";
		// $scope.blogs.P_3 = "";
		$("#p_att").html('');
		$(".summernote").summernote("code", '');

		$scope.editView = 1;
	}
	$scope.backToListing = function(){
		$scope.getAllAdminBlogslov();
		$scope.editView = 0;
		console
	}

		$scope.single_blog={};
		$scope.single_blog.S_1 = "";


	$scope.saveSingleBlog = function(){

		var data = {};
	    data.blogs = $scope.single_blog;

    	var temp = $.param({details: data});

		$http({
			data: temp+"&"+$scope.tokenHash,
			url : site+"/saveSingleAdminBlog",
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {

			if(data.done == true || data.done == 'true'){

				toastr.success(data.msg, '', {timeOut: 3000})


			}else{
				toastr.error(data.msg, '', {timeOut: 3000})
			}
		})
		.error(function(data, status, headers, config) {
		});
	}

		$scope.blogs={};
		$scope.blogs.ID = "";
		$scope.blogs.P_1 = "";
		$scope.blogs.P_2 = "";

	$scope.saveBlog = function(){

		if ($('.summernote').summernote('isEmpty')) {
			$scope.blogs.P_2 = '';
		}else{
			$scope.blogs.P_2 = $('#summernote').summernote('code');
		}

		var data = {};
	    data.blogs = $scope.blogs;
	    data.userId = userId;

    	var temp = $.param({details: data});

		$http({
			data: temp+"&"+$scope.tokenHash,
			url : site+"/saveAdminBlogs",
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {

			if(data.done == true || data.done == 'true'){

				toastr.success(data.msg, '', {timeOut: 3000})
				$scope.blogs.ID = data.ID;
				// $scope.editView = 0;
				$scope.getAllAdminBlogslov();


			}else{
				toastr.error(data.msg, '', {timeOut: 3000})
			}
		})
		.error(function(data, status, headers, config) {
		});
	}

	$scope.continouRecord = function(id){

		var data = {};
	    data.recordId = id;
	    data.userId = userId;
    	var temp = $.param({details: data});

		$http({
			data: temp+"&"+$scope.tokenHash,
			url : site+"/editAdminBlog",
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {
			var details = data.details;
			var image = details['image'];
			var detailImage = details['detailImage'];

			$("#p_att").html('');
            $("#p_att1").html('');
			if(details != '' && details != null){
				$scope.editView = 1;
				$scope.blogs.ID = details['BLOG_ID'];
				$scope.blogs.P_1 = details['TITLE'];
				$scope.blogs.P_2 = details['DESCRIPTION'];
				setTimeout(function(){
					$(".summernote").summernote("code", $scope.blogs.P_2);
				}, 500);
			}

			if(image != ''){

				var html = '<div class="col-2 image-overlay margin-r1" id="img_file_'+details["BLOG_ID"]+'">'+
								'<img src="'+image+'" alt="" class="image-box">'+
								'<div class="overlay">'+
									'<div class="text">'+
										'<img class="fa-trash-alt" src="'+baseurl+'/images/admin/trash.svg" alt="" width="18" ng-click="deletePicBlog('+details["BLOG_ID"]+')" title="Delete Image">';

									html += '<div class="arrow-icon-move-box">'+
											'<img class="arrow-center" src="'+baseurl+'/images/admin/feather-move.svg" alt="">'+
										'</div>'+
									'</div>'+
								'</div>'+
							'</div>';

						$("#p_att").append($compile(angular.element(html))($scope));
			}
			if(detailImage != ''){

				var html = '<div class="col-2 image-overlay margin-r1" id="img_file_'+details["BLOG_ID"]+'">'+
								'<img src="'+detailImage+'" alt="" class="image-box">'+
								'<div class="overlay">'+
									'<div class="text">'+
										'<img class="fa-trash-alt" src="'+baseurl+'/images/admin/trash.svg" alt="" width="18" ng-click="deletePicBlogDetail('+details["BLOG_ID"]+')" title="Delete Image">';

									html += '<div class="arrow-icon-move-box">'+
											'<img class="arrow-center" src="'+baseurl+'/images/admin/feather-move.svg" alt="">'+
										'</div>'+
									'</div>'+
								'</div>'+
							'</div>';

						$("#p_att1").append($compile(angular.element(html))($scope));
			}

		})
		.error(function(data, status, headers, config) {
		});
	}

	$scope.deletePicBlog = function(id){

		var data = {};
	    data.recordId = id;
	    data.userId = userId;
    	var temp = $.param({details: data});

		$http({
			data: temp+"&"+$scope.tokenHash,
			url : site+"/deleteBlogAttachment",
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {

			toastr.success(data.msg, '', {timeOut: 3000})

			$("#p_att").html('');

		})
		.error(function(data, status, headers, config) {
		});
	}
$scope.deletePicBlogDetail = function(id){

		var data = {};
	    data.recordId = id;
	    data.userId = userId;
    	var temp = $.param({details: data});

		$http({
			data: temp+"&"+$scope.tokenHash,
			url : site+"/deletePicBlogDetail",
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {

			toastr.success(data.msg, '', {timeOut: 3000})

			$("#p_att1").html('');

		})
		.error(function(data, status, headers, config) {
		});
	}
	$scope.deletePicOurBlog = function(id){

		var data = {};
	    data.recordId = id;
	    data.userId = userId;
    	var temp = $.param({details: data});

		$http({
			data: temp+"&"+$scope.tokenHash,
			url : site+"/deletePicOurBlog",
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {

			toastr.success(data.msg, '', {timeOut: 3000})

			$("#p_att_sin").html('');

		})
		.error(function(data, status, headers, config) {
		});
	}

	$scope.statusChange = function(id){
        console.log(id);
		var data = {};
	    data.recordId = id;
	    data.userId = userId;
        console.log(id);
    	var temp = $.param({details: data});

		$http({
			data: temp+"&"+$scope.tokenHash,
			url : site+"/changeStatusBlogs",
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {

			toastr.success(data.msg, '', {timeOut: 3000})
			$scope.backToListing();

		})
		.error(function(data, status, headers, config) {
		});
	}
	$scope.deleteBlog = function(id){
		var data = {};
	    data.recordId = id;
	    data.userId = userId;
    	var temp = $.param({details: data});
		$http({
			data: temp+"&"+$scope.tokenHash,
			url : site+"/deleteBlog",
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {

			toastr.success(data.msg, '', {timeOut: 3000})
			$scope.getAllAdminBlogslov();

		})
		.error(function(data, status, headers, config) {
		});
	}

	$('#uploadattch').fileupload({

 		add: function (e, data) {


 			if($scope.blogs.ID == ""){

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

 	      	}else if(xhr.responseText[0] == 04){

 	      		toastr.error("Error : Image dimensions must be minimum 390 X 150", '', {timeOut: 3000});

 	      	}else{

 		  		toastr.success("Image Upload Successfully", '', {timeOut: 3000});

 		  		$("#p_att").html('');

 		  		var html = '<div class="col-2 image-overlay margin-r1" id="img_file_'+xhr.responseText[1]+'">'+
								'<img src="'+xhr.responseText[2]+'" alt="" class="image-box">'+
								'<div class="overlay">'+
									'<div class="text">'+
										'<img class="fa-trash-alt" src="'+baseurl+'/images/admin/trash.svg" alt="" width="18" ng-click="deletePicBlog('+xhr.responseText[1]+')" title="Delete Image">'+
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
	$('#uploadattch1').fileupload({

	 		add: function (e, data) {


	 			if($scope.blogs.ID == ""){

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

	 	      	}else if(xhr.responseText[0] == 04){

	 	      		toastr.error("Error : Image dimensions must be minimum 620 X 620", '', {timeOut: 3000});

	 	      	}else{

	 		  		toastr.success("Image Upload Successfully", '', {timeOut: 3000});

	 		  		$("#p_att1").html('');

	 		  		var html = '<div class="col-2 image-overlay margin-r1" id="img_file_'+xhr.responseText[1]+'">'+
									'<img src="'+xhr.responseText[2]+'" alt="" class="image-box">'+
									'<div class="overlay">'+
										'<div class="text">'+
											'<img class="fa-trash-alt" src="'+baseurl+'/images/admin/trash.svg" alt="" width="18" ng-click="deletePicBlogDetail('+xhr.responseText[1]+')" title="Delete Image">'+
											'<div class="arrow-icon-move-box">'+
												'<img class="arrow-center" src="'+baseurl+'/images/admin/feather-move.svg" alt="">'+

											'</div>'+
										'</div>'+
									'</div>'+
								'</div>';
	 		  		$("#p_att1").append($compile(angular.element(html))($scope));
	 	      	}
	 	   	}
	 	});
	 $('#uploadattch2').fileupload({

		add: function (e, data) {

			$.LoadingOverlay("show");

			var jqXHR = data.submit();

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

				  toastr.error("Error : Save record first, then upload Images...", '', {timeOut: 3000});

			  }else if(xhr.responseText[0] == 04){

				  toastr.error("Error : Image dimensions must be minimum 400 X 650", '', {timeOut: 3000});

			  }else{

				  toastr.success("Image Upload Successfully", '', {timeOut: 3000});

				  $("#p_att_sin").html('');

				  var html = '<div class="col-2 image-overlay margin-r1" id="img_file1_1">'+
							   '<img src="'+xhr.responseText[2]+'" alt="" class="image-box">'+
							   '<div class="overlay">'+
								   '<div class="text">'+
									   '<img class="fa-trash-alt" src="'+baseurl+'/images/admin/trash.svg" alt="" width="18" ng-click="deletePicOurBlog(1)" title="Delete Image">'+
									   '<div class="arrow-icon-move-box">'+
										   '<img class="arrow-center" src="'+baseurl+'/images/admin/feather-move.svg" alt="">'+
									   '</div>'+
								   '</div>'+
							   '</div>'+
						   '</div>';
				  $("#p_att_sin").append($compile(angular.element(html))($scope));
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
