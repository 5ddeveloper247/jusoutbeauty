var myApp = angular.module('project1', ["smart-table"], function () { });
myApp.controller('projectinfo1', function ($scope,$compile, $rootScope, $timeout, $http, $window, $filter, $q, $routeParams) {


    $scope.basicEditView = 0;
    $scope.VideoEditView = 0;
    $scope.SecondSectionEdit = 0; 
    $scope.clinicalNoteSection = 0;

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
    $scope.QuickProduct.P_19 = "";
    $scope.QuickProduct.P_20 = "";
    $scope.QuickProduct.P_31 = "";
    $scope.QuickProduct.P_31.id = "";
    
    $scope.QuickProduct.P_46 = "";
    $scope.QuickProduct.P_46.id = "";
    $scope.QuickProduct.P_55 = '';
    $scope.QuickProduct.P_56 = '';


    $scope.recommended = {};
    $scope.handPick = {};


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

    $scope.shade={};
    $scope.shade.ID = "";
    $scope.shade.S_1 = "";
    $scope.shade.S_2 = "";
    $scope.shade.S_3 = "";

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
            $scope.shadesLov = data.list2;
            $scope.video = data.videoPro;
            var recommandedProducts = data.recommandedProducts;
            var displayCollectionProdUses = data.productuses;
            $scope.categoryLov = data.list1;

            $category_value=data.productDetails['CATEGORY_ID'];
            $scope.QuickProduct.P_31.id = $category_value;
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

                var getSelectedShades = data.shades;

                var htmlshade = '';
                if ($('.shades_slider').hasClass('slick-initialized')) {
                    $('.shades_slider').slick('destroy');
                } 
                $(".shades_slider").html('');
                
                if(getSelectedShades != null && getSelectedShades != ''){
                    for (let i = 0; i < getSelectedShades.length; i++) {
    
                        htmlshade += `<div class="box px-1">
                                <div class="ag-courses_item">
                                <span class="shade-edit-icon cursor-pointer" ng-click="editProductShade(`+getSelectedShades[i]['PRODUCT_SHADE_ID']+`)"><i class="fa fa-pencil-square-o cursor-pointer" aria-hidden="true"></i></span>
                                <span class="shade-close-icon cursor-pointer" ng-click="deleteProductShade(`+getSelectedShades[i]['PRODUCT_SHADE_ID']+`)"><i class="fa fa-times" aria-hidden="true"></i></span>
                                    <a href="#!" class="ag-courses-item_link">
                                        <div class="ag-courses-item_bg"></div>
    
                                        <div class="ag-courses-item_title">
                                            <li class="product-hero__icons__item d-flex aic">
                                                <div class="product-hero__icons__image relative">
                                                    <div class="img fit-contain is-loaded pos-center">
    
                                                        <div class="skeleton"></div>
                                                        <img width="70" height="70"
                                                            src="`+getSelectedShades[i]['SHADE_IMAGE']+`"
                                                            srcset="`+getSelectedShades[i]['SHADE_IMAGE']+`"
                                                            alt="Clean" title="Clean" data-fit="contain"
                                                            class="img__el">
                                                    </div>
                                                </div>
                                                <span class="product-hero__icons__text">`+getSelectedShades[i]['SHADE_NAME']+`</span>
                                            </li>
                                        </div>
                                    </a>
                                </div>
                            </div>`;
                            
                    }	
                    $(".shades_slider").html($compile(angular.element(htmlshade))($scope));
                }
                if ($('.shades_slider').hasClass('slick-initialized')) {
                        $('.shades_slider').slick('destroy');
                    }   
                setTimeout(function(){
                    $('.shades_slider').slick({
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
                $('#clinicalNoteSectionView').summernote('code',$scope.QuickProduct.P_19);
				$('#p19').html($scope.QuickProduct.P_19).trigger('change');
                $("#p31").val($scope.QuickProduct.P_31).trigger('change');
                // $("#p13").val($scope.QuickProduct.P_13).trigger('change');
                
            }, 500);

            var html3 = '';
            var html4 = '';
            var displayCollectionProdIngredients = data.ingredients;

                $('#spotlight_data').html('');
                $('#formulated_data').html('');

                if(displayCollectionProdIngredients != null && displayCollectionProdIngredients != ''){
                    for (let i = 0; i < displayCollectionProdIngredients.length; i++) {
                        
                        if(displayCollectionProdIngredients[i]['INGREDIENT_CATEGORY'] == 'Formulated'){
                        
                            html3 += ` <div class="col-sm-6 col-lg-3 mb-6 mb-lg-0 ing_sec_inc_prod_detail pt-5 pb-5 spot-section" id="remove_ing_`+displayCollectionProdIngredients[i]['PRODUCT_INGREDIENT_ID']+`"
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

                            html4 += ` <div class="col-sm-6 col-lg-3 mb-6 mb-lg-0 ing_sec_inc_prod_detail pt-5 pb-5 spot-section" id="remove_ing_`+displayCollectionProdIngredients[i]['PRODUCT_INGREDIENT_ID']+`"
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
                }
                $('#formulated_data').html($compile(angular.element(html3))($scope));
                $('#spotlight_data').html($compile(angular.element(html4))($scope));
                var html2 ="";

                if(displayCollectionProdUses != null && displayCollectionProdUses != ''){
                    for (let i = 0; i < displayCollectionProdUses.length; i++) {
                    
                        html2 += `<div class="col-md-4 mb-6 mb-md-0 ">
                                <div class="card border-0">
                                <span class="edit-icon cursor-pointer" ng-click="editProductUses(`+displayCollectionProdUses[i]['PRODUCT_USES_ID']+`)"><i class="fa fa-pencil-square-o cursor-pointer" aria-hidden="true"></i></span>
                                <span class="close-icon cursor-pointer" ng-click="deleteProductUses(`+displayCollectionProdUses[i]['PRODUCT_USES_ID']+`)"><i class="fa fa-times" aria-hidden="true"></i></span>
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
                }else{
                    html2 += `<div class="col-md-12 text-center ">
                                <p class="text-light">No Steps Added....</p>
                            </div>`;
                }
               
                $('#steps_users').html($compile(angular.element(html2))($scope));

               var rechtml = '';
               if ($('.completeYourGlow_slider').hasClass('slick-initialized')) {
                $('.completeYourGlow_slider').slick('destroy');
            }   
                if(recommandedProducts != null && recommandedProducts != ''){
                    for (let i = 0; i < recommandedProducts.length; i++) {
    
                        rechtml += `<div class="box px-1">
                                <div class="card border-0 product px-2">
                                    <div class="position-relative">
                                        <a href="javascript:;" class="d-block overflow-hidden ">
                                            <img src="`+recommandedProducts[i]['primaryImage']+`" alt="Product 01" class="card-img-top all-products img-h60 img-h30-m image-active">
                                            <img src="`+recommandedProducts[i]['secondaryImage']+`" alt="Product 01" class="card-img-top all-products img-h60 image-hover">
                                        </a>
                                    </div>
                                    <div class="card-body pt-4 px-0 pb-0">
                                        <div class="d-flex align-items-center mb-2 " >
                                            <h3 class="card-title fs-16 font-weight-500 mb-0 lh-14375 ellipsis">
                                                <a href="javascript:;" tabindex="0">`+recommandedProducts[i]['NAME']+`</a>
                                            </h3>
                                            <p class="fs-15 text-primary mb-0 ml-auto">
                                                <span class="text-line-through text-body mr-1"></span>$`+recommandedProducts[i]['UNIT_PRICE']+`</p>
                                        </div>
                                    </div>
                                </div>
                            </div>`;
                            
                    }	
                    $(".completeYourGlow_slider").html(rechtml);
                }
               
            setTimeout(function(){
                $('.completeYourGlow_slider').slick({
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
            var handpickProducts = data.handpickProducts;
                console.log( handpickProducts);
                $('#addDailyHandPickedModal').modal('hide');
                if ($('.Handpicked_slider').hasClass('slick-initialized')) {
                    $('.Handpicked_slider').slick('destroy');
                }   
                var rechtml = '';
                if(handpickProducts != null && handpickProducts != ''){
                    for (let i = 0; i < handpickProducts.length; i++) {
    
                        rechtml += `<div class="box px-1">
                                <div class="card border-0 product px-2">
                                    <div class="position-relative">
                                            <a href="javascript:;" class="d-block overflow-hidden ">
                                                <img src="`+handpickProducts[i]['primaryImage']+`" alt="Product 01" class="card-img-top all-products img-h60 img-h30-m image-active">
                                                <img src="`+handpickProducts[i]['secondaryImage']+`" alt="Product 01" class="card-img-top all-products img-h60 image-hover">
                                            </a>
                                    </div>
                                    <div class="card-body pt-4 px-0 pb-0">
                                        <div class="d-flex align-items-center mb-2 " >
                                            <h3 class="card-title fs-16 font-weight-500 mb-0 lh-14375 ellipsis">
                                                <a href="javascript:;" tabindex="0">`+handpickProducts[i]['NAME']+`</a>
                                            </h3>
                                            <p class="fs-15 text-primary mb-0 ml-auto">
                                                <span class="text-line-through text-body mr-1"></span>$`+handpickProducts[i]['UNIT_PRICE']+`</p>
                                        </div>
                                    </div>
                                </div>

                            </div>`;
                            
                    }	
                    $(".Handpicked_slider").html(rechtml);
                }
               
            setTimeout(function(){
                $('.Handpicked_slider').slick({
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
        })
            .error(function (data, status, headers, config) {
            });
    }

    $scope.editProductShade = function(id){
		
		var data = {};
	    data.shadeId = id;
	    data.userId = userId;
    	var temp = $.param({details: data});
    	
		$http({
			data: temp+"&"+$scope.tokenHash,
			url : site+"/editProductShade",
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {
				
			if(data.details != '' && data.details != null){
				
				$scope.shade = data.details;
				$("#shadesModal").modal('show');
				setTimeout(function(){
					$("#s1").val($scope.shade.S_1).trigger('change');
					
				}, 500);
			}
			
			$scope.makeProductShadeImageHtml(data.images);
			
		})
		.error(function(data, status, headers, config) {
		});
	}
    $scope.makeProductShadeImageHtml = function(images){
		
		$("#pss_att").html('');
		
		if(images != '' && images != null){
			
			for(var i=0; i<images.length; i++){
				
				var html = '<div class="col-3 image-overlay margin-r1" id="img_file_'+images[i]["ID"]+'">'+
								'<img src="'+images[i]["downPath"]+'" alt="" class="image-box">'+
								'<div class="overlay">'+
									'<div class="text" title="'+images[i]['titleText']+'">'+
										'<img class="fa-trash-alt" src="'+baseurl+'/images/admin/trash.svg" alt="" width="18" ng-click="deleteProductShadeImage('+images[i]["ID"]+')" title="Delete Image">';
										
										
									html += '<img class="fa-pencil-alt" src="'+baseurl+'/images/admin/pencil-solid.svg" alt="" width="18" ng-click="markProdShadeImage('+images[i]["ID"]+')" title="Mark Image">';	
										
										
									html += '<div class="arrow-icon-move-box">'+
											'<img class="arrow-center" src="'+baseurl+'/images/admin/feather-move.svg" alt="">'+
											'<p>Move Position</p>'+
										'</div>'+
									'</div>'+
								'</div>'+
							'</div>';
					
					$("#pss_att").append($compile(angular.element(html))($scope));
			}
		}
	}

    $scope.deleteProductShadeImage = function(id){
		
		var data = {};
		data.imageId = id;
	    data.productId = $scope.QuickProduct.PRODUCT_ID;
	    data.productShadeId = $scope.shade.ID;
	    data.userId = userId;
    	var temp = $.param({details: data});
    	
		$http({
			data: temp+"&"+$scope.tokenHash,
			url : site+"/deleteProductShadeImage",
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {
				
			toastr.success(data.msg, '', {timeOut: 3000})
			
			$scope.makeProductShadeImageHtml(data.images);
			
		})
		.error(function(data, status, headers, config) {
		});
	}

    $scope.tempId = '';
	$scope.markProdShadeImage = function(id){
		$scope.tempId = id;
		$("#shadesModal").modal('hide');
		$("#confirmProdShadeModal").modal('show');
	}
    $scope.markProductShadeImageFlag = function(flag){
		
		var data = {};
		data.flag = flag;
	    data.imageId = $scope.tempId;
	    data.productId = $scope.QuickProduct.PRODUCT_ID;
	    data.shadeId = $scope.shade.ID;
	    data.userId = userId;
    	var temp = $.param({details: data});
    	
		$http({
			data: temp+"&"+$scope.tokenHash,
			url : site+"/markProductShadeImage",
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {
				
			toastr.success(data.msg, '', {timeOut: 3000})
			
			$("#shadesModal").modal('show');
			$("#confirmProdShadeModal").modal('hide');
			
			$scope.makeProductShadeImageHtml(data.images);
			
		})
		.error(function(data, status, headers, config) {
		});
	}

    $scope.deleteProductShade = function(id){
		
		var data = {};
	    data.productId = $scope.QuickProduct.PRODUCT_ID;
	    data.productShadeId = id;
	    data.userId = userId;
    	var temp = $.param({details: data});
    	
		$http({
			data: temp+"&"+$scope.tokenHash,
			url : site+"/deleteProductShade",
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {
				
			toastr.success(data.msg, '', {timeOut: 3000})
			
            var getSelectedShades = data.shades;

            var htmlshade = '';
            if ($('.shades_slider').hasClass('slick-initialized')) {
                $('.shades_slider').slick('destroy');
            } 
            $(".shades_slider").html('');
            
            if(getSelectedShades != null && getSelectedShades != ''){
                for (let i = 0; i < getSelectedShades.length; i++) {

                    htmlshade += `<div class="box px-1">
                            <div class="ag-courses_item">
                            <span class="shade-edit-icon cursor-pointer" ng-click="editProductShade(`+getSelectedShades[i]['PRODUCT_SHADE_ID']+`)"><i class="fa fa-pencil-square-o cursor-pointer" aria-hidden="true"></i></span>
                            <span class="shade-close-icon cursor-pointer" ng-click="deleteProductShade(`+getSelectedShades[i]['PRODUCT_SHADE_ID']+`)"><i class="fa fa-times" aria-hidden="true"></i></span>
                                <a href="#!" class="ag-courses-item_link">
                                    <div class="ag-courses-item_bg"></div>

                                    <div class="ag-courses-item_title">
                                        <li class="product-hero__icons__item d-flex aic">
                                            <div class="product-hero__icons__image relative">
                                                <div class="img fit-contain is-loaded pos-center">

                                                    <div class="skeleton"></div>
                                                    <img width="70" height="70"
                                                        src="`+getSelectedShades[i]['SHADE_IMAGE']+`"
                                                        srcset="`+getSelectedShades[i]['SHADE_IMAGE']+`"
                                                        alt="Clean" title="Clean" data-fit="contain"
                                                        class="img__el">
                                                </div>
                                            </div>
                                            <span class="product-hero__icons__text">`+getSelectedShades[i]['SHADE_NAME']+`</span>
                                        </li>
                                    </div>
                                </a>
                            </div>
                        </div>`;
                        
                }	
                $(".shades_slider").html($compile(angular.element(htmlshade))($scope));
            }
            if ($('.shades_slider').hasClass('slick-initialized')) {
                    $('.shades_slider').slick('destroy');
                }   
            setTimeout(function(){
                $('.shades_slider').slick({
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
			
			
			
		})
		.error(function(data, status, headers, config) {
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
        console.log($scope.QuickProduct.P_5);
        if($scope.QuickProduct.P_1 == '' || $scope.QuickProduct.P_2 == '' 
            || $scope.QuickProduct.P_3 == '' || $scope.QuickProduct.P_4 == '' 
            || $scope.QuickProduct.P_5 == '' || $scope.QuickProduct.P_6 == ''){

            toastr.error('Fields can`t be empty', '', {timeOut: 3000})
            return
        }

        
        var temp = $.param({ details: data });

        $http({
            data: temp + "&" + $scope.tokenHash,
            url: site + "/updateAdminQuickProductBasicInfo",
            method: "POST",
            async: false,
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' }

        }).success(function (data, status, headers, config) {

            if (data.done == true || data.done == 'true') {
                
                // console.log($scope.QuickProduct.P_1,'1213');
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

    $scope.addShadesModal = function(){
        $("#shadesModal").modal('show');
    }

    $scope.saveProductShade = function(){
		
		if($scope.QuickProduct.PRODUCT_ID == ''){
			toastr.error("Save Product Info first, then proceed...", '', {timeOut: 3000})
			return;
		}
		
		var data = {};
	    data.product = $scope.QuickProduct.PRODUCT_ID;
	    data.shade = $scope.shade;
	    data.userId = userId;
	    
    	var temp = $.param({details: data});
    	
		$http({
			data: temp+"&"+$scope.tokenHash, 
			url : site+"/saveAdminQuickProductShade",
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {
				
			if(data.done == true || data.done == 'true'){
				
				toastr.success(data.msg, '', {timeOut: 3000})
				var getSelectedShades = data.shades;

				$scope.shade.ID = data.ID;
				

                var html = '';
                if ($('.shades_slider').hasClass('slick-initialized')) {
                    $('.shades_slider').slick('destroy');
                } 
                $(".shades_slider").html('').trigger('change');
                
                if(getSelectedShades != null && getSelectedShades != ''){
                    for (let i = 0; i < getSelectedShades.length; i++) {
    
                        html += `<div class="box px-1">
                                <div class="ag-courses_item">
                                <span class="shade-edit-icon cursor-pointer" ng-click="editProductShade(`+getSelectedShades[i]['PRODUCT_SHADE_ID']+`)"><i class="fa fa-pencil-square-o cursor-pointer" aria-hidden="true"></i></span>
                                <span class="shade-close-icon cursor-pointer" ng-click="deleteProductShade(`+getSelectedShades[i]['PRODUCT_SHADE_ID']+`)"><i class="fa fa-times" aria-hidden="true"></i></span>
                                    <a href="#!" class="ag-courses-item_link">
                                        <div class="ag-courses-item_bg"></div>
    
                                        <div class="ag-courses-item_title">
                                            <li class="product-hero__icons__item d-flex aic">
                                                <div class="product-hero__icons__image relative">
                                                    <div class="img fit-contain is-loaded pos-center">
    
                                                        <div class="skeleton"></div>
                                                        <img width="70" height="70"
                                                            src="`+getSelectedShades[i]['SHADE_IMAGE']+`"
                                                            srcset="`+getSelectedShades[i]['SHADE_IMAGE']+`"
                                                            alt="Clean" title="Clean" data-fit="contain"
                                                            class="img__el">
                                                    </div>
                                                </div>
                                                <span class="product-hero__icons__text">`+getSelectedShades[i]['SHADE_NAME']+`</span>
                                            </li>
                                        </div>
                                    </a>
                                </div>
                            </div>`;
                            
                    }	
                    $(".shades_slider").html($compile(angular.element(html))($scope));
                }
                // if ($('.shades_slider').hasClass('slick-initialized')) {
                //         $('.shades_slider').slick('destroy');
                //     }   
                setTimeout(function(){
                    $('.shades_slider').slick({
                        slidesToShow: 4,
                        autoplaySpeed: 1500,
                        "infinite":false,
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
                
                // $("#shadesModal").modal('hide');
				// if ($.fn.DataTable.isDataTable("#productShadesTable")) {
				// 	$('#productShadesTable').DataTable().clear().destroy();
				// }
				
				// $scope.displayCollectionProdShades = data.shades;
			
				// setTimeout(function(){
				// 	$("#productShadesTable").DataTable();
				// }, 500);
				
			}else{
				toastr.error(data.msg, '', {timeOut: 3000})
			}
		})
		.error(function(data, status, headers, config) {
		});
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
		
		// if($scope.QuickProduct.PRODUCT_ID == ''){
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
				// console.log(data.ingredients);
                var html = '';
                var html1 = '';
				var displayCollectionProdIngredients = data.ingredients;

                $('#spotlight_data').html('');
                $('#formulated_data').html('');

                for (let i = 0; i < displayCollectionProdIngredients.length; i++) {
                    
                    if(displayCollectionProdIngredients[i]['INGREDIENT_CATEGORY'] == 'Formulated'){
                    //    console.log('formulated');
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
                        // console.log('spot');

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

        if($scope.QuickProduct.P_18 == '' || $scope.QuickProduct.P_17 == ''){
            toastr.error('Fields can`t be empty', '', {timeOut: 3000})
            return
        }

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
       
        if($scope.video.V_2 == '' || $scope.video.V_1 == ''){
            toastr.error('Fields can`t be empty', '', {timeOut: 3000})
            return
        }
        

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
                            <span class="edit-icon cursor-pointer" ng-click="editProductUses(`+displayCollectionProdUses[i]['PRODUCT_USES_ID']+`)"><i class="fa fa-pencil-square-o cursor-pointer" aria-hidden="true"></i></span>
                            <span class="close-icon cursor-pointer" ng-click="deleteProductUses(`+displayCollectionProdUses[i]['PRODUCT_USES_ID']+`)"><i class="fa fa-times" aria-hidden="true"></i></span>

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
                $('#steps_users').html($compile(angular.element(html))($scope));
				
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
    $scope.editProductUses = function(id){
		
		var data = {};
	    data.productUsesId = id;
	    data.userId = userId;
    	var temp = $.param({details: data});
    	
		$http({
			data: temp+"&"+$scope.tokenHash,
			url : site+"/editProductUses",
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {
				
			if(data.details != '' && data.details != null){
				
				$scope.uses = data.details;
				$("#usesStepsModal").modal('show');
				setTimeout(function(){
					$("#u1").val($scope.uses.U_1).trigger('change');
				}, 500);
			}
			
		})
		.error(function(data, status, headers, config) {
		});
	}

    $scope.deleteProductUses = function(id){
		
		var data = {};
	    data.productId = $scope.QuickProduct.PRODUCT_ID;
	    data.productUsesId = id;
	    data.userId = userId;
    	var temp = $.param({details: data});
    	
		$http({
			data: temp+"&"+$scope.tokenHash,
			url : site+"/deleteProductUses",
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {
				
			var displayCollectionProdUses = data.productuses;
				toastr.success(data.msg, '', {timeOut: 3000})
				var html = '';
				$scope.uses.ID = data.ID;

                if(displayCollectionProdUses != null && displayCollectionProdUses != ''){
                    for (let i = 0; i < displayCollectionProdUses.length; i++) {
                    
                        html += `<div class="col-md-4 mb-6 mb-md-0 ">
                                <div class="card border-0">
                                <span class="edit-icon cursor-pointer" ng-click="editProductUses(`+displayCollectionProdUses[i]['PRODUCT_USES_ID']+`)"><i class="fa fa-pencil-square-o cursor-pointer" aria-hidden="true"></i></span>
                                <span class="close-icon cursor-pointer" ng-click="deleteProductUses(`+displayCollectionProdUses[i]['PRODUCT_USES_ID']+`)"><i class="fa fa-times" aria-hidden="true"></i></span>
    
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
                }else{
                    html += `<div class="col-md-12 text-center ">
                                <p class="text-light">No Steps Added....</p>
                            </div>`;
                }
               
                $('#steps_users').html($compile(angular.element(html))($scope));
			
			
			
		})
		.error(function(data, status, headers, config) {
		});
	}

    //Clinical Note

    $scope.EditclinicalNoteSection = function(){
        
        $scope.clinicalNoteSection = 1;
    }
    $scope.cancelClinicalNoteSection = function(){
        
        $scope.clinicalNoteSection = 0;
    }

    $scope.updateClinicalInfo = function(){

        
        var data = {};
	    data.productId = $scope.QuickProduct.PRODUCT_ID;
        $scope.QuickProduct.P_18 = $('#clinicalNoteSectionView').summernote('code');
        
        if($scope.QuickProduct.P_18 == ''){
            toastr.error('Field can`t be empty', '', {timeOut: 3000})
            return
        }
        data.updateClinicalInfo = $scope.QuickProduct.P_18;
	    
    	var temp = $.param({details: data});
        $http({
			data: temp+"&"+$scope.tokenHash,
			url : site+"/updateClinicalInfo",
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {

            toastr.success(data.msg, '', {timeOut: 3000})

            $scope.QuickProduct.P_19 = data.clinicalNote['P_19'];
            setTimeout(function(){
                $('#clinicalNoteSectionView').summernote('code',$scope.QuickProduct.P_19);
				$('#p19').html($scope.QuickProduct.P_19).trigger('change');
			}, 500);
            
            $scope.clinicalNoteSection = 0;
			
		})
		.error(function(data, status, headers, config) {
		});
    }

    $('#uploadattch').fileupload({
		
        add: function (e, data) {
            
            // if($scope.QuickProduct.PRODUCT_ID == ""){
                
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
        
        // if($scope.QuickProduct.PRODUCT_ID == ""){
            
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

    $('#uploadattch3').fileupload({
		
        add: function (e, data) {
            
            if($scope.QuickProduct.PRODUCT_ID == ""){
                
                toastr.error('Save Product Basic Info first, then upload Images...', '', {timeOut: 3000})
                return false;
            
            }else if($scope.shade.ID == ""){
                
                toastr.error('Save Shade Info first, then upload Images...', '', {timeOut: 3000})
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
            
                  toastr.error("Error : Image dimension must be minimum 270 X 370", '', {timeOut: 3000});

              }else{

                  toastr.success("Image Upload Successfully", '', {timeOut: 3000});
                  
                  var html = '<div class="col-3 image-overlay margin-r1" id="img_file_'+xhr.responseText[1]+'">'+
                               '<img src="'+xhr.responseText[2]+'" alt="" class="image-box">'+
                           '</div>';
                   
                   $("#pss_att").append($compile(angular.element(html))($scope));
                    location.reload();
                //    $scope.$apply(function () {

                //     $scope.shade.ID = xhr.responseText[1];
                //     $scope.shade.S_3 = xhr.responseText[2];

                // });
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

    $('#uploadattch5').fileupload({
		
        add: function (e, data) {
            
            if($scope.QuickProduct.PRODUCT_ID == ""){
                
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
            
                  toastr.error("Error : Image dimensions must be 270 X 370", '', {timeOut: 3000});

              }else{

                  toastr.success("Image Upload Successfully", '', {timeOut: 3000});
                
                //   var html = '<div class="col-2 image-overlay margin-r1" id="img_file_'+xhr.responseText[1]+'">'+
                //                '<img src="'+xhr.responseText[2]+'" alt="" class="image-box">'+
                //                '<div class="overlay">'+
                //                    '<div class="text">'+
                //                        '<img class="fa-trash-alt" src="'+baseurl+'/images/admin/trash.svg" alt="" width="18" ng-click="deleteClinicalNoteImage('+xhr.responseText[1]+')" title="Delete Image">'+
                //                        '<img class="fa-pencil-alt" src="'+baseurl+'/images/admin/pencil-solid.svg" alt="" width="18" ng-click="markPrimaryClinicalNoteImage('+xhr.responseText[1]+')" title="Mark Primary">'+	
                //                        '<div class="arrow-icon-move-box">'+
                //                            '<img class="arrow-center" src="'+baseurl+'/images/admin/feather-move.svg" alt="">'+
                //                            '<p>Move Position</p>'+
                //                        '</div>'+
                //                    '</div>'+
                //                '</div>'+
                //            '</div>';
                  
                //   $("#cn_att").append($compile(angular.element(html))($scope));
                $scope.$apply(function () {

                    $scope.QuickProduct.P_20 = xhr.responseText[2];

                });

              }
           }
    });

//atif
    $scope.showAllProductsOfCategory= function () {

        var data = {};
        data.categoryid =  $scope.QuickProduct.P_31.id ;
        data.productId =  $scope.QuickProduct.PRODUCT_ID ;

        var temp = $.param({details: data});

        $http({
            data: temp+"&"+$scope.tokenHash,
            url : site+"/getAllProductsOfCategory",
            method: "POST",
            async: false,
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}

        }).success(function(data, status, headers, config) {
                // console.log(data.selectRecomended_lov);
                $scope.recommended = data.product;
                $scope.handPick = data.product
                $scope.QuickProduct.P_46 = data.selectRecomended_lov;
                $scope.QuickProduct.P_56 = data.selectHandPick_lov;
            setTimeout(function(){
                $("#p46").val($scope.QuickProduct.P_46).trigger('change');
                $("#p56").val($scope.QuickProduct.P_56).trigger('change');
               

            }, 500);
            // $scope.QuickProduct.P_46.id =data.selectRecomended_lov;

        })
        .error(function(data, status, headers, config) {
        });
        
    };

    $scope.addJusOFlowModal = function () {
        $scope.showAllProductsOfCategory();
        $("#addJusOFlowModal").modal('show');
    }

    $scope.closeJusOFlowModal = function () {
        $("#addJusOFlowModal").modal('hide');
    }

    $scope.addDailyHandPickedModal = function () {
        
        $scope.showAllProductsOfCategory();
        $("#addDailyHandPickedModal").modal('show');
    }

    $scope.closeDailyHandPickedModal = function () {
        $("#addDailyHandPickedModal").modal('hide');
    }
    
    // $scope.updateDailyHandPickedModal = function(){
    //     alert('123');
    // }


    $scope.getSubCategoriesWrtCategory = function(e){
		// e.preventDefault();
        
		if($scope.QuickProduct.P_31 != null){
			var data = {};
		    data.category = $scope.QuickProduct.P_31;
            data.productId = $scope.QuickProduct.PRODUCT_ID;
		    data.userId = userId;            
		    
	    	var temp = $.param({details: data});
		   
			$scope.recommended={};
			// $scope.handpickedlov={};
	    	
			$http({
				data: temp+"&"+$scope.tokenHash,
				url : site+"/UpdateCategories",
				method: "POST",
				async: false,
				headers: {'Content-Type': 'application/x-www-form-urlencoded'}

			}).success(function(data, status, headers, config) {

                // console.log(data);
					
				// $scope.subCategoryLov = data.subCategory;
	        	
				$scope.recommended=data.product;

				// setTimeout(function(){
				// 	$("#p46").val($scope.product.P_46).trigger('change');
				// 	$("#p47").val($scope.product.P_47).trigger('change');

				// }, 500);


				// $('#p46').val($scope.handpickedlo['id']).trigger('change');
				// $('#p47').val($scope.recommended['id']).trigger('change');
				
			})
			.error(function(data, status, headers, config) {
			});
		}else{
			$scope.subCategoryLov = {};
		}
	}

    $scope.saveJusOFlowProduct = function(){

        // if ($('#basicInfo_description').summernote('isEmpty')) {
        //     $scope.product.P_13 = '';
        // }else{
        //     $scope.product.P_13 = $('#basicInfo_description').summernote('code');
        // }
        
        var data = {};
        if($scope.QuickProduct.P_46 == ''){
            toastr.error('Please Select atleast one', '', {timeOut: 3000})
            return
        }
        
        data.recomended = $scope.QuickProduct.P_46;
        data.productId = $scope.QuickProduct.PRODUCT_ID;
        data.userId = userId;
        
        var temp = $.param({details: data});
        
        $http({
            data: temp+"&"+$scope.tokenHash, 
            url : site+"/saveAdminProductsaveJusOFlow",
            method: "POST",
            async: false,
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}

        }).success(function(data, status, headers, config) {
                
            if(data.done == true || data.done == 'true'){
                
                toastr.success(data.msg, '', {timeOut: 3000})
                // $scope.product.ID = data.ID;
                var recommandedProducts = data.recommandedProducts;
                $('#addJusOFlowModal').modal('hide');
                if ($('.completeYourGlow_slider').hasClass('slick-initialized')) {
                    $('.completeYourGlow_slider').slick('destroy');
                }  
                var rechtml = '';
                if(recommandedProducts != null && recommandedProducts != ''){
                    for (let i = 0; i < recommandedProducts.length; i++) {
    
                        rechtml += `<div class="box px-1">
                                <div class="card border-0 product px-2">
                                    <div class="position-relative">
                                            <a href="javascript:;" class="d-block overflow-hidden ">
                                                <img src="`+recommandedProducts[i]['primaryImage']+`" alt="Product 01" class="card-img-top all-products img-h60 img-h30-m image-active">
                                                <img src="`+recommandedProducts[i]['secondaryImage']+`" alt="Product 01" class="card-img-top all-products img-h60 image-hover">
                                            </a>
                                    </div>
                                    <div class="card-body pt-4 px-0 pb-0">
                                        <div class="d-flex align-items-center mb-2 " >
                                            <h3 class="card-title fs-16 font-weight-500 mb-0 lh-14375 ellipsis">
                                                <a href="javascript:;" tabindex="0">`+recommandedProducts[i]['NAME']+`</a>
                                            </h3>
                                            <p class="fs-15 text-primary mb-0 ml-auto">
                                                <span class="text-line-through text-body mr-1"></span>$`+recommandedProducts[i]['UNIT_PRICE']+`</p>
                                        </div>
                                    </div>
                                </div>
                            </div>`;
                            
                    }	
                    $(".completeYourGlow_slider").html(rechtml);
                }
                
            setTimeout(function(){
                $('.completeYourGlow_slider').slick({
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
                
            }else{
                toastr.error(data.msg, '', {timeOut: 3000})
            }
        })
        .error(function(data, status, headers, config) {
        });
    }
    $scope.saveDailyhandPickProduct = function(){

        // if ($('#basicInfo_description').summernote('isEmpty')) {
        //     $scope.product.P_13 = '';
        // }else{
        //     $scope.product.P_13 = $('#basicInfo_description').summernote('code');
        // }
        if($scope.QuickProduct.P_56 == ''){
            toastr.error('Please Select atleast one', '', {timeOut: 3000})
            return
        }
        var data = {};
        data.handPick = $scope.QuickProduct.P_56;

        data.productId = $scope.QuickProduct.PRODUCT_ID;
        data.userId = userId;
        
        var temp = $.param({details: data});
        
        $http({
            data: temp+"&"+$scope.tokenHash, 
            url : site+"/saveDailyhandPickProduct",
            method: "POST",
            async: false,
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}

        }).success(function(data, status, headers, config) {
                
            if(data.done == true || data.done == 'true'){
                
                toastr.success(data.msg, '', {timeOut: 3000})

                var handpickProducts = data.handpickProducts;
                
                $('#addDailyHandPickedModal').modal('hide');
                if ($('.Handpicked_slider').hasClass('slick-initialized')) {
                    $('.Handpicked_slider').slick('destroy');
                }  
                var rechtml = '';
                if(handpickProducts != null && handpickProducts != ''){
                    for (let i = 0; i < handpickProducts.length; i++) {
    
                        rechtml += `<div class="box px-1">
                                <div class="card border-0 product px-2">
                                    <div class="position-relative">
                                            <a href="javascript:;" class="d-block overflow-hidden ">
                                                <img src="`+handpickProducts[i]['primaryImage']+`" alt="Product 01" class="card-img-top all-products img-h60 img-h30-m image-active">
                                                <img src="`+handpickProducts[i]['secondaryImage']+`" alt="Product 01" class="card-img-top all-products img-h60 image-hover">
                                            </a>
                                    </div>
                                    <div class="card-body pt-4 px-0 pb-0">
                                        <div class="d-flex align-items-center mb-2 " >
                                            <h3 class="card-title fs-16 font-weight-500 mb-0 lh-14375 ellipsis">
                                                <a href="javascript:;" tabindex="0">`+handpickProducts[i]['NAME']+`</a>
                                            </h3>
                                            <p class="fs-15 text-primary mb-0 ml-auto">
                                                <span class="text-line-through text-body mr-1"></span>$`+handpickProducts[i]['UNIT_PRICE']+`</p>
                                        </div>
                                    </div>
                                </div>

                            </div>`;
                            
                    }	
                    $(".Handpicked_slider").html(rechtml);
                }
               
            setTimeout(function(){
                $('.Handpicked_slider').slick({
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
                
            }else{
                toastr.error(data.msg, '', {timeOut: 3000})
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