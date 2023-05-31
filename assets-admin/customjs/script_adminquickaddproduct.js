var myApp = angular.module('project1', ["smart-table"], function () { });
myApp.controller('projectinfo1', function ($scope,$compile, $rootScope, $timeout, $http, $window, $filter, $q, $routeParams) {


    $scope.basicEditView = 0;
    $scope.VideoEditView = 0;
    $scope.SecondSectionEdit = 0; 

    $scope.QuickProduct = {};
    $scope.QuickProduct.ID = productId;
    $scope.QuickProduct.PRODUCT_ID ="";
    $scope.QuickProduct.P_1 = "";
    $scope.QuickProduct.P_2 = "";
    $scope.QuickProduct.P_3 = "";
    $scope.QuickProduct.P_4 = "";
    $scope.QuickProduct.P_5 = "";
    $scope.QuickProduct.P_6 = "";
    $scope.QuickProduct.P_13 = "";
    $scope.QuickProduct.P_14 = "";
    $scope.QuickProduct.P_15 = "";
    $scope.QuickProduct.P_16 = "";
    $scope.QuickProduct.P_17 = "";
    $scope.QuickProduct.P_18 = "";


    $scope.ingredient={};
    $scope.ingredient.ID = "";
    $scope.ingredient.I_1 = "";
    $scope.ingredient.I_2 = "";

    $scope.video={};
    $scope.video.ID = "";
    $scope.video.V_1 = "";
    $scope.video.V_2 = "";
    $scope.video.V_3 = "";
    $scope.video.V_4 = "";

    $scope.SecondSection = {};
    $scope.SecondSection.SS_1 = "";
    $scope.SecondSection.SS_2 = "";

    $scope.uses={};
    $scope.uses.ID = "";
    $scope.uses.U_1 = "";
    $scope.uses.U_2 = "";
    $scope.uses.U_3 = "";
    $scope.uses.U_4 = "";

    $scope.featurelov={};
    $scope.featurelov.S_1="";
    
    $scope.getQuickAddAdminProduct = function () {
        var data = {};
        data.userId = userId;
        data.productId = $scope.QuickProduct.ID;

        var temp = $.param({ details: data });

        $http({
            data: temp ,
            url: site + "/getQuickAddAdminProduct",
            method: "POST",
            async: false,
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' }

        }).success(function (data, status, headers, config) {
            var images=data.productDetails['DOWN_PATH'];
            
            $scope.displayImagesLov = images;
            $scope.featurelov = data.features;
            $scope.QuickProduct = data.productDetails;
            $scope.video = data.videoPro;
            
            // $scope.video.V_3 = data.videoPro['V_3'];
            // $scope.video.V_2 = data.videoPro['V_2'];
            // $scope.video.V_1 = data.videoPro['V_1'];

            $("#VideoSummerView").summernote("code", data.videoPro['V_2']); 
            $("#SecondSectionSummerNote").summernote("code", data.productDetails['P_18']); 

            // $scope.displayFeaturesSlider = data.productDetails['QUICK_ADD_FEATURES'];

            var getSelectedFeatures = data.productDetails['QUICK_ADD_FEATURES'];
            var html = '';

            $(".features_slider").html('');
            
            if(getSelectedFeatures != null && getSelectedFeatures != ''){
                for (let i = 0; i < getSelectedFeatures.length; i++) {

                    html += `<div class="box px-1">
                            <div class="ag-courses_item">
                                <a href="#!" class="ag-courses-item_link">
                                    <div class="ag-courses-item_bg"></div>

                                    <div class="ag-courses-item_title">
                                        <li class="product-hero__icons__item d-flex aic">
                                            <div class="product-hero__icons__image relative">
                                                <div class="img fit-contain is-loaded pos-center">

                                                    <div class="skeleton"></div>
                                                    <img width="70" height="70"
                                                        src="`+getSelectedFeatures[i]['IMAGE_DOWN_PATH']+`"
                                                        srcset="`+getSelectedFeatures[i]['IMAGE_DOWN_PATH']+`"
                                                        alt="Clean" title="Clean" data-fit="contain"
                                                        class="img__el">
                                                </div>
                                            </div>
                                            <span class="product-hero__icons__text">`+getSelectedFeatures[i]['FEATURE_NAME']+`</span>
                                        </li>
                                    </div>
                                </a>
                            </div>
                        </div>`;
                        
                }	
                $(".features_slider").html(html);
            }
            if ($('.features_slider').hasClass('slick-initialized')) {
				    $('.features_slider').slick('destroy');
				}   
			setTimeout(function(){
				$('.features_slider').slick({
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
									"settings": {"slidesToShow": 6}},

								{"breakpoint": 1366,
								"settings": {"slidesToShow": 3}},

								{"breakpoint": 1200,
									"settings": {"slidesToShow": 3}},

								{"breakpoint": 992,
									"settings": {"slidesToShow": 2}},

								{"breakpoint": 768,
									"settings": {"slidesToShow": 1}},

								{"breakpoint": 576,
									"settings": {"slidesToShow": 1}}
								]
					
					});
				$.LoadingOverlay("hide");
			}, 500);
           
            // console.log($scope.QuickProduct, 'asd');
            setTimeout(function () {
                $("#p1").val($scope.QuickProduct.P_1).trigger('change');
                $("#p2").val($scope.QuickProduct.P_2).trigger('change');
                $("#p3").val($scope.QuickProduct.P_3).trigger('change');
                $("#p4").val($scope.QuickProduct.P_4).trigger('change');
                $("#p5").val($scope.QuickProduct.P_5).trigger('change');
                $("#p6").val($scope.QuickProduct.P_6).trigger('change');
                $("#p13").val($scope.QuickProduct.P_13).trigger('change');
                $("#p15").attr("src", $scope.QuickProduct.P_15);
                $("#p16").attr("src", $scope.QuickProduct.P_16);
                $("#p17").html($scope.QuickProduct.P_17);
                $("#p18").html($scope.QuickProduct.P_18);
                $("#video_heading").html($scope.video.V_1).trigger('change');
                $("#video_desc").html($scope.video.V_2).trigger('change');
                // $("#p13").val($scope.QuickProduct.P_13).trigger('change');
                
            }, 500);
            var html = '';
            var html1 = '';
            var displayCollectionProdIngredients = data.ingredients;

                $('#spotlight_data').html('');
                $('#formulated_data').html('');

                for (let i = 0; i < displayCollectionProdIngredients.length; i++) {
                    
                    if(displayCollectionProdIngredients[i]['INGREDIENT_CATEGORY'] == 'Formulated'){
                       console.log('formulated');
                        html += ` <div class="col-sm-6 col-lg-3 mb-6 mb-lg-0 ing_sec_inc_prod_detail pt-5 pb-5 spot-section" id="remove_ing_`+displayCollectionProdIngredients[i]['PRODUCT_INGREDIENT_ID']+`"
                                    style="background-color:#57813a96">
                                    <span class="close-icon cursor-pointer" ng-click="deleteIngredientQuickAdd(`+displayCollectionProdIngredients[i]['PRODUCT_INGREDIENT_ID']+`)"><i class="fa fa-times" aria-hidden="true"></i></span>
                                    <img class="spot-section-img"
                                        src="https://jusoutbeauty.com/site/assets-web/images/cannabis-ingredient.webp">
                                    <p class="text-primary font-weight-500 lh-14375 mb-3 pt-4 ">
                                        `+displayCollectionProdIngredients[i]['INGREDIENT_NAME']+`</p>
                                    <p>
                                    `+displayCollectionProdIngredients[i]['INGREDIENT_DESCRIPTION']+`
                                    </p>

                                </div>`;

                       
                    }else if(displayCollectionProdIngredients[i]['INGREDIENT_CATEGORY'] == 'Spotlight'){
                        console.log('spot');

                        html1 += ` <div class="col-sm-6 col-lg-3 mb-6 mb-lg-0 ing_sec_inc_prod_detail pt-5 pb-5 spot-section" id="remove_ing_`+displayCollectionProdIngredients[i]['PRODUCT_INGREDIENT_ID']+`"
                                    style="background-color:#57813a96">
                                    <span class="close-icon cursor-pointer" ng-click="deleteIngredientQuickAdd(`+displayCollectionProdIngredients[i]['PRODUCT_INGREDIENT_ID']+`)"><i class="fa fa-times" aria-hidden="true"></i></span>
                                    <img class="spot-section-img"
                                        src="https://jusoutbeauty.com/site/assets-web/images/cannabis-ingredient.webp">
                                    <p class="text-primary font-weight-500 lh-14375 mb-3 pt-4 ">
                                        `+displayCollectionProdIngredients[i]['INGREDIENT_NAME']+`</p>
                                    <p>
                                    `+displayCollectionProdIngredients[i]['INGREDIENT_DESCRIPTION']+`
                                    </p>

                                </div>`;
                    }
                   
                }
                $('#formulated_data').html($compile(angular.element(html))($scope));
                $('#spotlight_data').html($compile(angular.element(html1))($scope));
        })
            .error(function (data, status, headers, config) {
            });
    }

   

    $scope.getQuickAddAdminProduct();
    $scope.editBasicInfo = function () {
       
        setTimeout(function () {
            $("#p1").val($scope.QuickProduct.P_1).trigger('change');
            $("#p2").val($scope.QuickProduct.P_2).trigger('change');
            $("#p3").val($scope.QuickProduct.P_3).trigger('change');
            $("#p4").val($scope.QuickProduct.P_4).trigger('change');
            $("#p5").val($scope.QuickProduct.P_5).trigger('change');
            $("#p6").val($scope.QuickProduct.P_6).trigger('change');

        }, 500);
        $scope.basicEditView = 1;

        
    }

    $scope.cancelBasicInfo = function () {
        $scope.basicEditView = 0;
    }

    $scope.updateBasicInfo = function () {

        var data = {};
        data.userId = userId;
        data.record = $scope.QuickProduct;
        
        var temp = $.param({ details: data });

        $http({
            data: temp + "&" + $scope.tokenHash,
            url: site + "/updateAdminQuickProductBasicInfo",
            method: "POST",
            async: false,
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' }

        }).success(function (data, status, headers, config) {

            if (data.done == true || data.done == 'true') {
                
                console.log($scope.QuickProduct.P_1,'1213');
                setTimeout(function () {
                    $("#p7").html($scope.QuickProduct.P_1).trigger('change');
                    $("#p8").html($scope.QuickProduct.P_2).trigger('change');
                    $("#p9").html($scope.QuickProduct.P_3).trigger('change');
                    $("#p10").html($scope.QuickProduct.P_4).trigger('change');
                    $("#p11").html($scope.QuickProduct.P_5).trigger('change');
                    $("#p12").html($scope.QuickProduct.P_6).trigger('change');
                    
                }, 500);
                $scope.basicEditView = 0;
                toastr.success(data.msg, '', { timeOut: 3000 })

            } else {
                toastr.error(data.msg, '', { timeOut: 3000 })
            }
        })
        .error(function (data, status, headers, config) {
        });


    }
    $scope.updateFeaturesModal = function(){

        var data = {};
		
	    data.featuresArr = $scope.QuickProduct.P_13;
        data.productId = $scope.QuickProduct.PRODUCT_ID;

    	var temp = $.param({details: data});
    	
		$http({
			data: temp+"&"+$scope.tokenHash,
			url : site+"/updateFeatures",
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {
            toastr.success(data.msg, '', {timeOut: 3000})
			var getSelectedFeatures = data.getSelectedFeatures;
            var html = '';
            $(".features_slider").html('');
            
            if(getSelectedFeatures != null && getSelectedFeatures != ''){
                for (let i = 0; i < getSelectedFeatures.length; i++) {

                    html += `<div class="box px-1">
                            <div class="ag-courses_item">
                                <a href="#!" class="ag-courses-item_link">
                                    <div class="ag-courses-item_bg"></div>

                                    <div class="ag-courses-item_title">
                                        <li class="product-hero__icons__item d-flex aic">
                                            <div class="product-hero__icons__image relative">
                                                <div class="img fit-contain is-loaded pos-center">

                                                    <div class="skeleton"></div>
                                                    <img width="70" height="70"
                                                        src="`+getSelectedFeatures[i]['IMAGE_DOWN_PATH']+`"
                                                        srcset="`+getSelectedFeatures[i]['IMAGE_DOWN_PATH']+`"
                                                        alt="Clean" title="Clean" data-fit="contain"
                                                        class="img__el">
                                                </div>
                                            </div>
                                            <span class="product-hero__icons__text">`+getSelectedFeatures[i]['FEATURE_NAME']+`</span>
                                        </li>
                                    </div>
                                </a>
                            </div>
                        </div>`;
                        
                }	
                $(".features_slider").html(html);
            }
            if ($('.features_slider').hasClass('slick-initialized')) {
				    $('.features_slider').slick('destroy');
				}   
			setTimeout(function(){
				$('.features_slider').slick({
					slidesToShow: 4,
					autoplaySpeed: 1500,
					"infinite":true,
					"autoplay":true,
					"dots":false,
					"arrows":false,
					prevArrow:"<button type='button' class='slick-prev pull-left'><i class='fa fa-arrow-left' aria-hidden='true'></i></button>",
					nextArrow:"<button type='button' class='slick-next pull-right'><i class='fa fa-arrow-right' aria-hidden='true'></i></button>",
					"responsive":[
								
								{"breakpoint": 1400,
									"settings": {"slidesToShow": 6}},

								{"breakpoint": 1366,
								"settings": {"slidesToShow": 4}},

								{"breakpoint": 1200,
									"settings": {"slidesToShow": 4}},

								{"breakpoint": 992,
									"settings": {"slidesToShow": 2}},

								{"breakpoint": 768,
									"settings": {"slidesToShow": 1}},

								{"breakpoint": 576,
									"settings": {"slidesToShow": 1}}
								]
					
					});
				$.LoadingOverlay("hide");
			}, 500);
			
			$("#addFeaturesModal").modal('hide');
			// $scope.makeImageAttachmentHtml(data.images);
            // location.reload();
			
		})
		.error(function(data, status, headers, config) {
		});
    }
    $scope.tempProId = '';
	$scope.markProdImagePriSec = function(id){
		
		$scope.tempProId = id;
		// $("#shadesModal").modal('hide');
		$("#confirmProdImageModal").modal('show');
	}

    $scope.addFeaturesModal = function(id){
		
		$scope.tempProId = id;
		// $("#shadesModal").modal('hide');
		$("#addFeaturesModal").modal('show');
	}
    $scope.closeFeaturesModal = function(){
		

		// $("#shadesModal").modal('hide');
		$("#addFeaturesModal").modal('hide');
	}

    $scope.addSpotForModal = function(){
        $("#addSpotForModal").modal('show');
    }

    $scope.getIngredientsWrtCategory = function(id){
		
		
			var data = {};
		    data.category = $scope.ingredient.I_1;
		    data.userId = userId;
		    
	    	var temp = $.param({details: data});
	    	
			$http({
				data: temp+"&"+$scope.tokenHash,
				url : site+"/getIngredientsWrtCategory",
				method: "POST",
				async: false,
				headers: {'Content-Type': 'application/x-www-form-urlencoded'}

			}).success(function(data, status, headers, config) {
					
				$scope.ingredientsLov = data.ingredients;
				
			})
			.error(function(data, status, headers, config) {
			});
		
	}

    $scope.saveProductIngredient = function(){
		
		// if($scope.product.ID == ''){
		// 	toastr.error("Save Product Info first, then proceed...", '', {timeOut: 3000})
		// 	return;
		// }
		
		var data = {};
	    data.product = $scope.QuickProduct;
	    data.ingredient = $scope.ingredient;
	    data.userId = userId;
	    
    	var temp = $.param({details: data});
    	
		$http({
			data: temp+"&"+$scope.tokenHash, 
			url : site+"/saveAdminQuickProductIngredient",
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {
				
			if(data.done == true || data.done == 'true'){
				
				toastr.success(data.msg, '', {timeOut: 3000})
				
				// if ($.fn.DataTable.isDataTable("#productIngredientsTable")) {
				// 	$('#productIngredientsTable').DataTable().clear().destroy();
				// }
				console.log(data.ingredients);
                var html = '';
                var html1 = '';
				var displayCollectionProdIngredients = data.ingredients;

                $('#spotlight_data').html('');
                $('#formulated_data').html('');

                for (let i = 0; i < displayCollectionProdIngredients.length; i++) {
                    
                    if(displayCollectionProdIngredients[i]['INGREDIENT_CATEGORY'] == 'Formulated'){
                       console.log('formulated');
                        html += ` <div class="col-sm-6 col-lg-3 mb-6 mb-lg-0 ing_sec_inc_prod_detail pt-5 pb-5 spot-section" id="remove_ing_`+displayCollectionProdIngredients[i]['PRODUCT_INGREDIENT_ID']+`"
                                    style="background-color:#57813a96">
                                    <span class="close-icon cursor-pointer" ng-click="deleteIngredientQuickAdd(`+displayCollectionProdIngredients[i]['PRODUCT_INGREDIENT_ID']+`)"><i class="fa fa-times" aria-hidden="true"></i></span>
                                    <img class="spot-section-img"
                                        src="https://jusoutbeauty.com/site/assets-web/images/cannabis-ingredient.webp">
                                    <p class="text-primary font-weight-500 lh-14375 mb-3 pt-4 ">
                                        `+displayCollectionProdIngredients[i]['INGREDIENT_NAME']+`</p>
                                    <p>
                                    `+displayCollectionProdIngredients[i]['INGREDIENT_DESCRIPTION']+`
                                    </p>

                                </div>`;

                       
                    }else if(displayCollectionProdIngredients[i]['INGREDIENT_CATEGORY'] == 'Spotlight'){
                        console.log('spot');

                        html1 += ` <div class="col-sm-6 col-lg-3 mb-6 mb-lg-0 ing_sec_inc_prod_detail pt-5 pb-5 spot-section" id="remove_ing_`+displayCollectionProdIngredients[i]['PRODUCT_INGREDIENT_ID']+`"
                                    style="background-color:#57813a96">
                                    <span class="close-icon cursor-pointer" ng-click="deleteIngredientQuickAdd(`+displayCollectionProdIngredients[i]['PRODUCT_INGREDIENT_ID']+`)"><i class="fa fa-times" aria-hidden="true"></i></span>
                                    <img class="spot-section-img"
                                        src="https://jusoutbeauty.com/site/assets-web/images/cannabis-ingredient.webp">
                                    <p class="text-primary font-weight-500 lh-14375 mb-3 pt-4 ">
                                        `+displayCollectionProdIngredients[i]['INGREDIENT_NAME']+`</p>
                                    <p>
                                    `+displayCollectionProdIngredients[i]['INGREDIENT_DESCRIPTION']+`
                                    </p>

                                </div>`;
                    }
                   
                }
                $('#formulated_data').html($compile(angular.element(html))($scope));
                $('#spotlight_data').html($compile(angular.element(html1))($scope));
				// setTimeout(function(){
				// 	$("#productIngredientsTable").DataTable();
				// }, 500);
                $("#addSpotForModal").modal('hide');
	
				$scope.ingredient.ID = "";
				$scope.ingredient.I_1 = "";
				$scope.ingredient.I_2 = "";
				
				setTimeout(function(){
					$("#i2").val('').trigger('change');
				}, 500);
				
			}else{
				toastr.error(data.msg, '', {timeOut: 3000})
			}
		})
		.error(function(data, status, headers, config) {
		});
	}

    $scope.deleteIngredientQuickAdd = function(id){

        var data = {};
	    data.ingredientId = id;
	    data.userId = userId;
    	var temp = $.param({details: data});

        $http({
			data: temp+"&"+$scope.tokenHash,
			url : site+"/deleteIngredientQuickAdd",
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {

            var ing_id =data.id;
			$('#remove_ing_'+ing_id).remove();	
			toastr.success(data.msg, '', {timeOut: 3000})

			// $scope.getQuickAddAdminProduct()
			// $scope.makeImageAttachmentHtml(data.images);
            
			
		})
		.error(function(data, status, headers, config) {
		});
    }

	$scope.closeProdImageModal = function(id){
		$scope.tempProId = '';
		// $("#shadesModal").modal('show');
		$("#confirmProdImageModal").modal('hide');
	}
    $scope.EditSecondSection = function(){
        $scope.SecondSectionEdit = 1; 
    }
    $scope.CloseSecondSection = function(){
        $scope.SecondSectionEdit = 0; 
    }
    $scope.UpdateSecondSection = function(){
        var data = {};
		data.quickSection = $scope.QuickProduct;
        $scope.QuickProduct.P_18 = $('#SecondSectionSummerNote').summernote('code');
	    data.productId = $scope.QuickProduct.PRODUCT_ID;
	    data.userId = userId;
    	var temp = $.param({details: data});

        $http({
			data: temp+"&"+$scope.tokenHash,
			url : site+"/UpdateSecondSection",
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {
				
			toastr.success(data.msg, '', {timeOut: 3000})
          

            setTimeout(function () {

                $("#p17").html($scope.QuickProduct.P_17).trigger('change');
                $("#p18").html($scope.QuickProduct.P_18).trigger('change');
                
            }, 500);
            $scope.SecondSectionEdit = 0;

			// $scope.getQuickAddAdminProduct()
			// $scope.makeImageAttachmentHtml(data.images);
            
			
		})
		.error(function(data, status, headers, config) {
		});
    }
    $scope.deleteProductImage = function(id){
		
		var data = {};
		data.imageId = id;
	    data.productId = $scope.QuickProduct.PRODUCT_ID;
	    data.userId = userId;
    	var temp = $.param({details: data});
    	
		$http({
			data: temp+"&"+$scope.tokenHash,
			url : site+"/deleteProductImage",
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {
				
			toastr.success(data.msg, '', {timeOut: 3000})
			
			// $scope.makeImageAttachmentHtml(data.images);
            location.reload();
			
		})
		.error(function(data, status, headers, config) {
		});
	}

    $scope.showVideoInfo = function(){
        $scope.VideoEditView = 1;
    }

    $scope.cancelVideoInfo = function(){
        $scope.VideoEditView = 0;
    }

    $scope.updateVideoInfo = function(){
        // alert($scope.video.ID);
        $scope.video.V_2 = $('#VideoSummerView').summernote('code');
        var data = {};
        data.videoDetails = $scope.video;

        data.userId = userId;
    	var temp = $.param({details: data});
        $http({
			data: temp+"&"+$scope.tokenHash,
			url : site+"/updateVideoInfo",
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {

			if(data.done == true || data.done == 'true'){
				// $scope.tempProId = '';
				toastr.success(data.msg, '', {timeOut: 3000})
                $scope.VideoEditView = 0;
                $("#video_heading").html($scope.video.V_1).trigger('change');
                $("#video_desc").html($scope.video.V_2).trigger('change');

				// $scope.makeImageAttachmentHtml(data.images);
                // location.reload();
				// $("#confirmProdImageModal").modal('hide');
            }
			// }else{
			// 	$scope.tempProId = '';
			// 	toastr.error(data.msg, '', {timeOut: 3000})
			// 	$("#confirmProdImageModal").modal('hide');
				
			// }

			
		})
		.error(function(data, status, headers, config) {
		});
        
    }
    $scope.markProductDetailImageFlag = function(flag){
		
		var data = {};
	    data.imageId = $scope.tempProId;
		data.flag = flag;
	    data.productId = $scope.QuickProduct.PRODUCT_ID;
	    data.userId = userId;
    	var temp = $.param({details: data});
    	
		$http({
			data: temp+"&"+$scope.tokenHash,
			url : site+"/markPrimaryProdImage",
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {

			if(data.done == true || data.done == 'true'){
				$scope.tempProId = '';
				toastr.success(data.msg, '', {timeOut: 3000})
				// $scope.makeImageAttachmentHtml(data.images);
                location.reload();
				$("#confirmProdImageModal").modal('hide');

			}else{
				$scope.tempProId = '';
				toastr.error(data.msg, '', {timeOut: 3000})
				$("#confirmProdImageModal").modal('hide');
				
			}

			
		})
		.error(function(data, status, headers, config) {
		});
	}
    // $scope.makeImageAttachmentHtml = function(images){
		
	// 	$("#p_att").html('');
		
	// 	if(images != '' && images != null){
			
	// 		for(var i=0; i<images.length; i++){
	// 			var titletxt = images[i]["primFlag"] == 0 ? 'secondary' : 'primary';
	// 			// var html = '<div class="col-2 image-overlay margin-r1" title="'+titletxt+'" id="img_file_'+images[i]["ID"]+'">'+
	// 			// 				'<img src="'+images[i]["downPath"]+'" alt="" class="image-box">'+
	// 			// 				'<div class="overlay">'+
	// 			// 					'<div class="text">'+
	// 			// 						'<img class="fa-trash-alt" src="'+baseurl+'/images/admin/trash.svg" alt="" width="18" ng-click="deleteProductImage('+images[i]["ID"]+')" title="Delete Image">';
										
	// 			// 							html += '<img class="fa-pencil-alt" src="'+baseurl+'/images/admin/pencil-solid.svg" alt="" width="18" ng-click="markProdImagePriSec('+images[i]["ID"]+')" title="Mark Primary">';	
										
	// 			// 					html += '<div class="arrow-icon-move-box">'+
	// 			// 							'<img class="arrow-center" src="'+baseurl+'/images/admin/feather-move.svg" alt="">'+
	// 			// 							'<p>Move Position</p>'+
	// 			// 						'</div>'+
	// 			// 					'</div>'+
	// 			// 				'</div>'+
	// 			// 			'</div>';

    //             var html = `<div class="col-md-6 px-1 pb-1" title="`+titletxt+`" id="img_file_`+images[i]["ID"]+`">
    //                         <div class="show-image">

    //                             <img src="`+images[i]["downPath"]+`" alt="Image"
    //                                 class="prod_img_detail img-w35 img-product-gall">

    //                             <button class="btn btn-danger btn-sm delete" ng-click="deleteProductImage(`+images[i]["ID"]+`)">DELETE</button>
    //                             <button class="btn btn-info btn-sm markprimary" ng-click="markProdImagePriSec(`+images[i]["ID"]+`)">Mark Image</button>
    //                         </div>
                            
    //                     </div>`;
					
	// 				$("#p_att").append($compile(angular.element(html))($scope));
    //                 location.reload();
	// 		}
	// 	}
	// }

    $scope.addNewUses = function(){
		
		$scope.uses={};
		$scope.uses.ID = "";
		$scope.uses.U_1 = "";
		$scope.uses.U_2 = "";
		$scope.uses.U_3 = "";
		$scope.uses.U_4 = "";
		$("#u1").val($scope.uses.U_1).trigger('change');
		
		$("#usesStepsModal").modal("show");
	}

    $scope.saveProductUses = function(){
       
		if($scope.QuickProduct.PRODUCT_ID == ''){
			toastr.error("Save Product Info first, then proceed...", '', {timeOut: 3000})
			return;
		}
		
		var data = {};
	    // data.product = $scope.product;
	     data.product = $scope.QuickProduct.PRODUCT_ID;
	    data.uses = $scope.uses;
	    data.userId = userId;
	    
    	var temp = $.param({details: data});
    	
		$http({
			data: temp+"&"+$scope.tokenHash, 
			url : site+"/saveAdminQuickProductUses",
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {
				
			if(data.done == true || data.done == 'true'){
				var displayCollectionProdUses = data.productuses;
				toastr.success(data.msg, '', {timeOut: 3000})
				var html = '';
				$scope.uses.ID = data.ID;
                
                for (let i = 0; i < displayCollectionProdUses.length; i++) {
                    
                    html += `<div class="col-md-4 mb-6 mb-md-0 ">
                            <div class="card border-0">
                                <img src="`+ displayCollectionProdUses[i]['DOWN_PATH'] +`"
                                    alt="Image"
                                    class="card-img h_to_use_img">
                                <div
                                    class="card-body pt-6 px-0 pb-0 text-center">
                                    <a href="#"
                                        class="fs-18 font-weight-500 lh-1444">`+ displayCollectionProdUses[i]['USES_TITLE'] +`</a>
                                    <p class="mb-6">
                                    `+ displayCollectionProdUses[i]['USES_DESCRIPTION'] +`</p>
                                </div>
                            </div>
                        </div>`;

                }
                $('#steps_users').html(html);
				
				// if ($.fn.DataTable.isDataTable("#productUsesTable")) {
				// 	$('#productUsesTable').DataTable().clear().destroy();
				// }
				
				// $scope.displayCollectionProdUses = data.productuses;
			
				// setTimeout(function(){
				// 	$("#productUsesTable").DataTable();
				// }, 500);
				
			}else{
				toastr.error(data.msg, '', {timeOut: 3000})
			}
		})
		.error(function(data, status, headers, config) {
		});
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

              }else if(xhr.responseText[0] == 03){
            
                  toastr.error("Error : Save Basic Info first, then upload Images...", '', {timeOut: 3000});

              }else if(xhr.responseText[0] == 04){
            
                  toastr.error("Error : Image dimensions must be minimum 270 X 370", '', {timeOut: 3000});

              }else{

                  toastr.success("Image Upload Successfully", '', {timeOut: 3000});
                
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

                    var html = `<div class="col-md-6 px-1 pb-1" id="img_file_`+xhr.responseText[1]+`">
                                    <div class="show-image">

                                        <img src="`+xhr.responseText[2]+`" alt="Image"
                                            class="prod_img_detail img-w35 img-product-gall">

                                        <button class="btn btn-danger btn-sm delete" ng-click="deleteProductImage(`+xhr.responseText[1]+`)">DELETE</button>
                                        <button class="btn btn-info btn-sm markprimary" ng-click="markProdImagePriSec(`+xhr.responseText[1]+`)">Mark Image</button>
                                    </div>
                                    
                                </div>`;
                  
                  $("#p_att").append($compile(angular.element(html))($scope));
                  location.reload();

              }
           }
    });

$('#uploadattch2').fileupload({
		
 		add: function (e, data) {
 		    
 			// if($scope.product.ID == ""){
 				
 			// 	toastr.error('Save Basic Info first, then upload Images...', '', {timeOut: 3000})
 			// 	return false;
 			
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

 	      	}else if(xhr.responseText[0] == 03){
 	        
 	      		toastr.error("Error : Save Basic Info first, then upload Images...", '', {timeOut: 3000});

 	      	}else{

 		  		toastr.success("Video Upload Successfully", '', {timeOut: 3000});
 		  		$scope.$apply(function () {

 		  			$scope.video.ID = xhr.responseText[1];
 		  			$scope.video.V_4 = xhr.responseText[2];
                    location.reload();

 		  		});
 		  		
 	      	}
 	   	}
 	});


     $('#uploadattch4').fileupload({
		
        add: function (e, data) {
            
            if($scope.QuickProduct.PRODUCT_ID == ""){
                
                toastr.error('Save Product Basic Info first, then upload Images...', '', {timeOut: 3000})
                return false;
            
            }else if($scope.uses.ID == ""){
                
                toastr.error('Save Product Uses Info first, then upload Images...', '', {timeOut: 3000})
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
            
                  toastr.error("Error : Save Shade Info first, then upload Images...", '', {timeOut: 3000});

              }else if(xhr.responseText[0] == 04){
            
                  toastr.error("Error : Image dimension must be minimum 360 X 450", '', {timeOut: 3000});

              }else{

                  toastr.success("Image Upload Successfully", '', {timeOut: 3000});
                  
                  $scope.$apply(function () {

                      $scope.uses.ID = xhr.responseText[1];
                      $scope.uses.U_3 = xhr.responseText[2];

                  });
                  
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
                    setTimeout(function () {
                        $.LoadingOverlay("hide");
                    }, 500);
                    if (typeof response.data != 'object') { //might have some error

                        var temp = response.data.toLowerCase();
                        if (temp.indexOf("error") >= 0) {  //result may have error
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
                    setTimeout(function () {
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