var myApp = angular.module('project1',["smart-table"], function(){});
myApp.controller('projectinfo1',function($scope,$compile,$rootScope,$timeout,$http,$window,$filter,$q,$routeParams) {



    $scope.popup={};
    $scope.popup.ID='';
    $scope.popup.FIRST_IMAGE='';
    $scope.popup.MAIN_TITLE='';
    $scope.popup.SECOND_TIILE='';
    $scope.popup.BACKGROUND_COLOR='';
    $scope.popup.BUTTON_TEXT='';
    $scope.popup.BUTTON_LINK='';
    $scope.popup.FILE='';
    $scope.popup.DOWN_PATH='';

    $scope.tokenHash = $("#csrf").val();

    $scope.getPopupData = function() {
        var data = {};
        data.userId = userId;
        var temp = $.param({details: data});

        $http({
            data: temp+"&"+$scope.tokenHash,
            url: site+'/getPopupData',
            method: "POST",
            async: false,
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).success(function(data, status, headers, config) {
            $scope.popup = data;
            // console.log(data)
            $("#preview").attr('src', $scope.popup.DOWN_PATH);
        }).error(function(data, status, headers, config) {
        });
    }


    $scope.getPopupData();

    $scope.savePopupData = function(){
		var data = {};
	    data.popup = $scope.popup;
        console.log(data)
	    data.userId = userId;

    	var temp = $.param({details: data});

		$http({
			data: temp+"&"+$scope.tokenHash,
			url : site+"/savePopupData",
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {

			if(data.done == true || data.done == 'true'){

				toastr.success(data.msg, '', {timeOut: 3000})
				$scope.popup.ID = data.ID;
                $scope.getPopupData();

			}else{
				toastr.error(data.msg, '', {timeOut: 3000})
			}
		})
		.error(function(data, status, headers, config) {
		});

    }

    function form1() {
        $("#uploadattl").click();
    }

    $('#uploadattch').fileupload({

        add: function (e, data) {

            // if($scope.product.ID == ""){

            //     toastr.error('Save Basic Info first, then upload Images...', '', {timeOut: 3000})
            //     return false;

            // }else{
                $.LoadingOverlay("show");
                var jqXHR = data.submit();
            // }
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

              }else if(xhr.responseText[0] == 04){

                  toastr.error("Error : Image dimensions must be minimum 900 X 1000", '', {timeOut: 3000});

              }else{

                  toastr.success("Image Upload Successfully", '', {timeOut: 3000});
                    $('#preview').attr('src',xhr.responseText[2]).trigger('change');
                    $scope.getPopupData();
                    // $('#preview').attr('src',xhr.responseText[2]).trigger('change');
                    location.reload();
                //   var html = '<div class="col-2 image-overlay margin-r1" id="img_file_'+xhr.responseText[1]+'">'+
                //                '<img src="'+xhr.responseText[2]+'" alt="" class="image-box">'+
                //                '<div class="overlay">'+
                //                    '<div class="text">'+
                //                        '<img class="fa-trash-alt" src="'+baseurl+'/images/admin/trash.svg" alt="" width="18" ng-click="deleteProductImage('+xhr.responseText[1]+')" title="Delete Image">'+
                //                        '<img class="fa-pencil-alt" src="'+baseurl+'/images/admin/pencil-solid.svg" alt="" width="18" ng-click="markProdImagePriSec('+xhr.responseText[1]+')" title="Mark Primary">'+
                //                        '<div class="arrow-icon-move-box">'+
                //                            '<img class="arrow-center" src="'+baseurl+'/images/admin/feather-move.svg" alt="">'+
                //                            '<p>Move Position</p>'+
                //                        '</div>'+
                //                    '</div>'+
                //                '</div>'+
                //            '</div>';

                //   $("#p_att").append($compile(angular.element(html))($scope));

              }
           }
    });

    // $scope.uploadPopupImage = function(){
    //     var data = {};
	//     data.popup = $scope.popup;
    //     console.log(data)
	//     data.userId = userId;

    // 	var temp = $.param({details: data});

	// 	$http({
	// 		data: temp+"&"+$scope.tokenHash,
	// 		url : site+"/uploadPopupImage",
	// 		method: "POST",
	// 		async: false,
	// 		headers: {'Content-Type': 'application/x-www-form-urlencoded'}

	// 	}).success(function(data, status, headers, config) {

	// 		if(data.done == true || data.done == 'true'){

	// 			toastr.success(data.msg, '', {timeOut: 3000})
	// 			$scope.popup.ID = data.ID;
    //             $scope.getPopupData();

	// 		}else{
	// 			toastr.error(data.msg, '', {timeOut: 3000})
	// 		}
	// 	})
	// 	.error(function(data, status, headers, config) {
	// 	});
    // }

});
