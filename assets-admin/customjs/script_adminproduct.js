var myApp = angular.module('project1',["smart-table"], function(){});
myApp.controller('projectinfo1',function($scope,$compile,$rootScope,$timeout,$http,$window,$filter,$q,$routeParams) {

//	$(document).on('click','.addNew',function(){
//	    $('#addCity_modal').modal('show');return false;
//	});

//	$(document).on('click','.modalClose',function(){
//	    $('#addCity_modal').modal('hide');return false;
//	});

	$scope.product={};
	$scope.product.ID = "";
	$scope.product.P_1 = "";
	$scope.product.P_2 = "";
	$scope.product.P_3 = "";
	$scope.product.P_4 = "";
	$scope.product.P_5 = "";
	$scope.product.P_6 = "";
	$scope.product.P_7 = true;
	$scope.product.P_8 = "";
	$scope.product.P_9 = "";
	$scope.product.P_10 = "";
	$scope.product.P_11 = "";
	$scope.product.P_12 = "";
	$scope.product.P_13 = "";
	$scope.product.P_14 = "";
	$scope.product.P_15 = "";
	$scope.product.P_16 = "";
	$scope.product.P_17 = "";
	$scope.product.P_18 = "Flat";
	$scope.product.P_19 = "0";
	$scope.product.P_20 = "";
	$scope.product.P_21 = "";
	$scope.product.P_22 = "";
	$scope.product.P_23 = "";
	$scope.product.P_24 = "0";
	$scope.product.P_25 = "Flat";
	$scope.product.P_26 = "0";
	  $scope.product.P_27 = "Flat";
	  $scope.product.P_28 = false;
	  $scope.product.P_29 = false;
	  $scope.product.P_30 = false;
	  $scope.product.P_31 = false;
	  $scope.product.P_32 = false;
	  $scope.product.P_33 = false;
	  $scope.product.P_34 = '';
	  $scope.product.P_35 = false;
	  $scope.product.P_36 = '';
	  $scope.product.P_37 = '';
	  $scope.product.P_38 = '';
	  $scope.product.P_39 = false;
	  $scope.product.P_40 = false;
	  $scope.product.P_41 = false;
	  $scope.product.P_42 = "";
	  $scope.product.P_43 = "";
	  $scope.product.P_44="";
      $scope.product.P_45="";
      $scope.product.P_46="";
      $scope.product.P_47="";

	  $scope.video={};
	  $scope.video.ID = "";
	  $scope.video.V_1 = "";
	  $scope.video.V_2 = "";
	  $scope.video.V_3 = "";

	  $scope.ingredient={};
	  $scope.ingredient.ID = "";
	  $scope.ingredient.I_1 = "";
	  $scope.ingredient.I_2 = "";

	  $scope.shade={};
	  $scope.shade.ID = "";
	  $scope.shade.S_1 = "";
	  $scope.shade.S_2 = "";

	  $scope.uses={};
	  $scope.uses.ID = "";
	  $scope.uses.U_1 = "";
	  $scope.uses.U_2 = "";
	  $scope.uses.U_3 = "";
      $scope.uses.U_4 = "";

	  $scope.editView = 0;
	  $scope.featurelov={};
	  $scope.featurelov.S_1="";

	  $scope.handpickedlov={};
	  $scope.recommended={};

	  $scope.tokenHash = $("#csrf").val();

      $scope.getAllAdminProductlov = function(){

		var data = {};
	    data.userId = userId;
	    var temp = $.param({details: data});

		$http({
			data: temp+"&"+$scope.tokenHash,
			url : site+'/getAllAdminProductlov',
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {

			$scope.categoryLov = data.list1;
			$scope.shadesLov = data.list2;
			$scope.featurelov=data.features;
			$scope.subCategoryLov = {};
			if ($.fn.DataTable.isDataTable("#productsTable")) {
				$('#productsTable').DataTable().clear().destroy();
			}

			$scope.displayCollection = data.list;

			setTimeout(function(){
				var featured_category_display_order_table = $('#productsTable').DataTable( {
					search: {
						return: true,
					},
					stateSave: true,
					order: [],
						rowReorder: {selector: 'span.reorder'},
						columnDefs: [
							{ orderable: true, className: 'reorder', targets: 0 },
							{ orderable: false, targets: '_all' }
					],

					// aLengthMenu: [
					// 	[ -1],
					// 	[ "All"]
					// ]
		            aLengthMenu: [
		                          [10, 25, 50, 100, 200, -1],
		                          [10, 25, 50, 100, 200, "All"]
		                      ]
		        } );
			}, 500);

			$( "#tablecontents" ).sortable({
				items: "tr",
				cursor: 'move',
				opacity: 0.6,
				update: function() {

					$scope.$apply(function () {
						$scope.sendOrderToServer();
					});

				}
			  });
		})
		.error(function(data, status, headers, config) {
		});
	}


	$scope.getAllAdminProductlov();


	$scope.sendOrderToServer = function(){

		var order = [];

		// var token = $('meta[name="csrf-token"]').attr('content');
		var page_length = parseInt($('select[name="productsTable_length"]').val());
		var current_page = parseInt($('.paginate_button.current').text());
        // console.log(page_length,current_page); return;
		var postion_for = (current_page*page_length)-page_length;

		//  console.log(page_length,current_page);
		$('tr.row1').each(function(index,element) {
		  order.push({
			id: $(this).attr('data-id'),
			position_new: postion_for+(index+1),
			position: $(this).attr('data-seq')
			// position:index+1
		  });
		});
		// console.log(order);return;

		var data = {};
	    data.order = order;
	    var temp = $.param({details: data});
		// console.log(data);
		$http({
			data: temp+"&"+$scope.tokenHash,
			url : site+'/updateProductOrder',
			// dataType: "json",
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {
			toastr.success(data.msg, '', {timeOut: 3000})
			$scope.getAllAdminProductlov();

		})
		.error(function(data, status, headers, config) {
		});
		// $.ajax({
		//   type: "POST",
		//   dataType: "json",
		//   url: "{{ url('updateProductOrder') }}",
		// 	  data: {
		// 	order: order,
		// 	_token: token
		//   },
		//   success: function(response) {
		// 	  if (response.status == "success") {
		// 		console.log(response);
		// 	  } else {
		// 		console.log(response);
		// 	  }
		//   }
		// });
	  }

	$scope.reset = function(){
		$scope.product={};
		$scope.product.ID = "";
		$scope.product.P_1 = "";
		$scope.product.P_2 = "";
		$scope.product.P_3 = "";
		$scope.product.P_4 = "";
		$scope.product.P_5 = "";
		$scope.product.P_6 = "";
		$scope.product.P_7 = true;
		$scope.product.P_8 = "";
		$scope.product.P_9 = "";
		$scope.product.P_10 = "";
		$scope.product.P_11 = "";
		$scope.product.P_12 = "";
		$scope.product.P_13 = "";
		$scope.product.P_14 = "";
		$scope.product.P_15 = "";
		$scope.product.P_16 = "";
		$scope.product.P_17 = "";
		$scope.product.P_18 = "Flat";
		$scope.product.P_19 = "0";
		$scope.product.P_20 = "";
		$scope.product.P_21 = "";
		$scope.product.P_22 = "";
		$scope.product.P_23 = "";
		$scope.product.P_24 = "0";
		$scope.product.P_25 = "Flat";
		$scope.product.P_26 = "0";
		$scope.product.P_27 = "Flat";
		$scope.product.P_28 = false;
		$scope.product.P_29 = false;
		$scope.product.P_30 = false;
		$scope.product.P_31 = false;
		$scope.product.P_32 = false;
		$scope.product.P_33 = false;
		$scope.product.P_34 = '';
		$scope.product.P_35 = false;
		$scope.product.P_36 = '';
		$scope.product.P_37 = '';
		$scope.product.P_38 = '';
		$scope.product.P_39 = false;
		$scope.product.P_40 = false;
		$scope.product.P_41 = false;
		$scope.product.P_42 = "";
		$scope.product.P_43 = "";
		$scope.product.P_44 = "";
		$scope.product.P_45="";
		$scope.product.P_46="";
		$scope.product.P_47="";

		$scope.shade.S_1 = "";
		$scope.shade.S_2 = "";


		$scope.video={};
		$scope.video.ID = "";
		$scope.video.V_1 = "";
		$scope.video.V_2 = "";
		$scope.video.V_3 = "";

		$scope.ingredient={};
		$scope.ingredient.ID = "";
		$scope.ingredient.I_1 = "";
		$scope.ingredient.I_2 = "";

		$scope.shade={};
		$scope.shade.ID = "";
		$scope.shade.S_1 = "";
		$scope.shade.S_2 = "";

		$scope.uses={};
		$scope.uses.ID = "";
		$scope.uses.U_1 = "";
		$scope.uses.U_2 = "";
		$scope.uses.U_3 = "";
		$scope.uses.U_4 = "";

		$scope.handpickedlov={};
		$scope.recommended={};


		$("#p4").val('').trigger('change');
		$("#p8").val('').trigger('change');
		$("#p9").val('').trigger('change');
		$("#p44").val('').trigger('change');

		$("#p14").val('').trigger('change');
		$("#p15").val('').trigger('change');
		$("#p16").val('').trigger('change');
		$("#p17").val('').trigger('change');
		$("#p19").val('').trigger('change');
		$("#p20").val('').trigger('change');
		$("#p24").val('').trigger('change');
		$("#p26").val('').trigger('change');
		$("#p34").val('').trigger('change');
		$("#p37").val('').trigger('change');
		$("#p42").val('').trigger('change');
		$("#p45").val('').trigger('change');


		$("#basicInfo_description").summernote("code", "");
		$("#video_description").summernote("code", "");
	}

	$scope.quickAddProduct = function(){
		var data = {};
	    data.userId = userId;

    	var temp = $.param({details: data});

		$http({
			data: temp+"&"+$scope.tokenHash,
			url : site+"/saveAdminQuickProductBasicInfo",
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {

			if(data.done == true || data.done == 'true'){

				toastr.success(data.msg, '', {timeOut: 3000})
				$('#productID').val(data.id);

				setTimeout(function(){
					$('#quickProductdetilsForm').submit();
				}, 500);



			}else{
				toastr.error(data.msg, '', {timeOut: 3000})
			}
		})
		.error(function(data, status, headers, config) {
		});
	}

	$scope.quickEditProduct = function(id){

		$('#productID').val(id);

		setTimeout(function(){
			$('#quickProductdetilsForm').submit();
		}, 500);


	}
	$scope.addNew = function(){

		$scope.product={};
		$scope.product.ID = "";
		$scope.product.P_1 = "";
		$scope.product.P_2 = "";
		$scope.product.P_3 = "";
		$scope.product.P_4 = "";
		$scope.product.P_5 = "";
		$scope.product.P_6 = "";
		$scope.product.P_7 = true;
		$scope.product.P_8 = "";
		$scope.product.P_9 = "";
		$scope.product.P_10 = "";
		$scope.product.P_11 = "";
		$scope.product.P_12 = "";
		$scope.product.P_13 = "";
		$scope.product.P_14 = "";
		$scope.product.P_15 = "";
		$scope.product.P_16 = "";
		$scope.product.P_17 = "";
		$scope.product.P_18 = "Flat";
		$scope.product.P_19 = "0";
		$scope.product.P_20 = "";
		$scope.product.P_21 = "";
		$scope.product.P_22 = "";
		$scope.product.P_23 = "";
		$scope.product.P_24 = "0";
		$scope.product.P_25 = "Flat";
		$scope.product.P_26 = "0";
		$scope.product.P_27 = "Flat";
		$scope.product.P_28 = false;
		$scope.product.P_29 = false;
		$scope.product.P_30 = false;
		$scope.product.P_31 = false;
		$scope.product.P_32 = false;
		$scope.product.P_33 = false;
		$scope.product.P_34 = "";
		$scope.product.P_35 = false;
		$scope.product.P_36 = "";
		$scope.product.P_37 = "";
		$scope.product.P_38 = "";
		$scope.product.P_39 = false;
		$scope.product.P_40 = false;
		$scope.product.P_41 = false;
		$scope.product.P_42 = "";
		$scope.product.P_43 = "";
		$scope.product.P_44 = "";
		$scope.product.P_45="";
		$scope.product.P_46="";
		$scope.product.P_47="";


		$scope.video={};
		$scope.video.ID = "";
		$scope.video.V_1 = "";
		$scope.video.V_2 = "";
		$scope.video.V_3 = "";

		$scope.ingredient={};
		$scope.ingredient.ID = "";
		$scope.ingredient.I_1 = "";
		$scope.ingredient.I_2 = "";

		$scope.shade={};
		$scope.shade.ID = "";
		$scope.shade.S_1 = "";
		$scope.shade.S_2 = "";

		$scope.uses={};
		$scope.uses.ID = "";
		$scope.uses.U_1 = "";
		$scope.uses.U_2 = "";
		$scope.uses.U_3 = "";
		$scope.uses.U_4 = "";

		$scope.handpickedlov={};
		$scope.recommended={};


		$("#p_att").html('');
		$("#cn_att").html('');

		$("#p4").val('').trigger('change');
		$("#p8").val('').trigger('change');
		$("#p9").val('').trigger('change');
		$("#p44").val('').trigger('change');

		$("#p14").val('').trigger('change');
		$("#p15").val('').trigger('change');
		$("#p16").val('').trigger('change');
		$("#p17").val('').trigger('change');
		$("#p19").val('').trigger('change');
		$("#p20").val('').trigger('change');
		$("#p24").val('').trigger('change');
		$("#p26").val('').trigger('change');
		$("#p34").val('').trigger('change');
		$("#p37").val('').trigger('change');
		$("#p42").val('').trigger('change');
		$("#p43").val('').trigger('change');
		$("#p45").val('').trigger('change');

		$("#basicInfo_description").summernote("code", "");
		$("#video_description").summernote("code", "");
		$("#p43").summernote("code", "");

		if ($.fn.DataTable.isDataTable("#productIngredientsTable")) {
			$('#productIngredientsTable').DataTable().clear().destroy();
		}
		if ($.fn.DataTable.isDataTable("#productShadesTable")) {
			$('#productShadesTable').DataTable().clear().destroy();
		}
		if ($.fn.DataTable.isDataTable("#productUsesTable")) {
			$('#productUsesTable').DataTable().clear().destroy();
		}

//		$scope.product = {};
		$scope.subCategoryLov = {};
		$scope.subSubCategoryLov = {};
		$scope.displayCollectionProdIngredients = {};
		$scope.displayCollectionProdShades = {};
		$scope.displayCollectionProdUses = {};

		setTimeout(function(){
			$("#productIngredientsTable").DataTable();
			$("#productShadesTable").DataTable();
			$("#productUsesTable").DataTable();
		}, 500);

		$scope.subCategoryLov = {};

		$scope.editView = 1;

	}
	$scope.backToListing = function(){
		$scope.getAllAdminProductlov();
		$scope.editView = 0;
	}
	$scope.saveProductBasic = function(){

		if ($('#basicInfo_description').summernote('isEmpty')) {
			$scope.product.P_13 = '';
		}else{
			$scope.product.P_13 = $('#basicInfo_description').summernote('code');
		}

		var data = {};
	    data.product = $scope.product;
	    data.userId = userId;

    	var temp = $.param({details: data});

		$http({
			data: temp+"&"+$scope.tokenHash,
			url : site+"/saveAdminProductBasicInfo",
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {

			if(data.done == true || data.done == 'true'){

				toastr.success(data.msg, '', {timeOut: 3000})
				$scope.product.ID = data.ID;

			}else{
				toastr.error(data.msg, '', {timeOut: 3000})
			}
		})
		.error(function(data, status, headers, config) {
		});
	}

	$scope.saveProductVideo = function(){

		if($scope.product.ID == ''){
			toastr.error("Save Product Info first, then proceed...", '', {timeOut: 3000})
			return;
		}

		if ($('#video_description').summernote('isEmpty')) {
			$scope.video.V_2 = '';
		}else{
			$scope.video.V_2 = $('#video_description').summernote('code');
		}

		var data = {};
	    data.product = $scope.product;
	    data.video = $scope.video;
	    data.userId = userId;

    	var temp = $.param({details: data});

		$http({
			data: temp+"&"+$scope.tokenHash,
			url : site+"/saveAdminProductVideoDetails",
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {

			if(data.done == true || data.done == 'true'){

				toastr.success(data.msg, '', {timeOut: 3000})
				$scope.video.ID = data.ID;

			}else{
				toastr.error(data.msg, '', {timeOut: 3000})
			}
		})
		.error(function(data, status, headers, config) {
		});
	}
	$scope.saveProductPricing = function(){

		if($scope.product.ID == ''){
			toastr.error("Save Product Info first, then proceed...", '', {timeOut: 3000})
			return;
		}

		var data = {};
	    data.product = $scope.product;
	    data.userId = userId;

    	var temp = $.param({details: data});

		$http({
			data: temp+"&"+$scope.tokenHash,
			url : site+"/saveAdminProductPricingVat",
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
	$scope.saveProductIngredient = function(){

		if($scope.product.ID == ''){
			toastr.error("Save Product Info first, then proceed...", '', {timeOut: 3000})
			return;
		}

		var data = {};
	    data.product = $scope.product;
	    data.ingredient = $scope.ingredient;
	    data.userId = userId;

    	var temp = $.param({details: data});

		$http({
			data: temp+"&"+$scope.tokenHash,
			url : site+"/saveAdminProductIngredient",
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {

			if(data.done == true || data.done == 'true'){

				toastr.success(data.msg, '', {timeOut: 3000})

				if ($.fn.DataTable.isDataTable("#productIngredientsTable")) {
					$('#productIngredientsTable').DataTable().clear().destroy();
				}

				$scope.displayCollectionProdIngredients = data.ingredients;

				setTimeout(function(){
					$("#productIngredientsTable").DataTable();
				}, 500);

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


	$scope.addProductShade = function(){
		$scope.shade={};
		$scope.shade.ID = "";
		$scope.shade.S_1 = "";
		$scope.shade.S_2 = "";

		$("#ps_att").html('');

		setTimeout(function(){
			$("#s1").val('').trigger('change');
		}, 500);

		$("#shadesModal").modal('show');
	}


	$scope.saveProductShade = function(){

		if($scope.product.ID == ''){
			toastr.error("Save Product Info first, then proceed...", '', {timeOut: 3000})
			return;
		}

		var data = {};
	    data.product = $scope.product;
	    data.shade = $scope.shade;
	    data.userId = userId;

    	var temp = $.param({details: data});

		$http({
			data: temp+"&"+$scope.tokenHash,
			url : site+"/saveAdminProductShade",
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {

			if(data.done == true || data.done == 'true'){

				toastr.success(data.msg, '', {timeOut: 3000})

				$scope.shade.ID = data.ID;

				if ($.fn.DataTable.isDataTable("#productShadesTable")) {
					$('#productShadesTable').DataTable().clear().destroy();
				}

				$scope.displayCollectionProdShades = data.shades;

				setTimeout(function(){
					$("#productShadesTable").DataTable();
				}, 500);

			}else{
				toastr.error(data.msg, '', {timeOut: 3000})
			}
		})
		.error(function(data, status, headers, config) {
		});
	}

	$scope.deleteProductingredient = function(id){

		var data = {};
	    data.ingredientId = id;
	    data.productId = $scope.product.ID;
	    data.userId = userId;
    	var temp = $.param({details: data});

		$http({
			data: temp+"&"+$scope.tokenHash,
			url : site+"/deleteProductingredient",
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {

			toastr.success(data.msg, '', {timeOut: 3000})

			if ($.fn.DataTable.isDataTable("#productIngredientsTable")) {
				$('#productIngredientsTable').DataTable().clear().destroy();
			}

			$scope.displayCollectionProdIngredients = data.ingredients;

			setTimeout(function(){
				$("#productIngredientsTable").DataTable();
			}, 500);

		})
		.error(function(data, status, headers, config) {
		});
	}

	$scope.getSubCategoriesWrtCategory = function(){
		
		if($scope.recallSubCatFunctionFlag == 0){
			$scope.recallSubCatFunctionFlag = 1;
			return;
		}
		if($scope.product.P_8 != null){
            if($scope.product.P_8['name'] === 'Nutrition' || $scope.product.P_8['name'] === 'Nutritions' || 
            		$scope.product.P_8['name'] === 'MakeUp' || $scope.product.P_8['name'] === 'Make Up'){
                $('#imageBox').addClass('d-none');
            }else{
                $('#imageBox').removeClass('d-none');
            }
            
            var data = {};
		    data.category = $scope.product.P_8;
		    data.userId = userId;

	    	var temp = $.param({details: data});

			$scope.recommended={};
			$scope.handpickedlov={};


			$http({
				data: temp+"&"+$scope.tokenHash,
				url : site+"/getSubCategoriesWrtCategory",
				method: "POST",
				async: false,
				headers: {'Content-Type': 'application/x-www-form-urlencoded'}

			}).success(function(data, status, headers, config) {

				$scope.subCategoryLov = data.subCategory;
				
				$scope.product.P_9 = '';
				$scope.product.P_44 = '';

				$scope.recommended=data.product;

				$scope.handpickedlov=data.product;

				setTimeout(function(){
					$("#p46").val($scope.product.P_46).trigger('change');
					$("#p47").val($scope.product.P_47).trigger('change');

				}, 500);


				// $('#p46').val($scope.handpickedlo['id']).trigger('change');
				// $('#p47').val($scope.recommended['id']).trigger('change');

			})
			.error(function(data, status, headers, config) {
			});
		}else{
			$scope.subCategoryLov = {};
		}
	}
	$scope.getSubSubCategoriesWrtSubCategory = function(){
		
		if($scope.recallSubCatFunctionFlag == 0){
			$scope.recallSubCatFunctionFlag = 1;
			return;
		}
		if($scope.product.P_9 != null){
			var data = {};
		    data.subcategory = $scope.product.P_9;
		    data.userId = userId;

	    	var temp = $.param({details: data});

			$http({
				data: temp+"&"+$scope.tokenHash,
				url : site+"/getSubSubCategoriesWrtSubCategory",
				method: "POST",
				async: false,
				headers: {'Content-Type': 'application/x-www-form-urlencoded'}

			}).success(function(data, status, headers, config) {

				$scope.subSubCategoryLov = data.subSubCategory;

				$scope.product.P_44 = '';
			})
			.error(function(data, status, headers, config) {
			});
		}else{
			$scope.subSubCategoryLov = {};
		}
	}
	$scope.getIngredientsWrtCategory = function(id){

		if($scope.product.P_8 != null){
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
		}else{
			$scope.subCategoryLov = {};
		}
	}

	$scope.recallSubCatFunctionFlag = 1;
	$scope.continouRecord = function(id){

		var data = {};
	    data.productId = id;
	    data.userId = userId;
    	var temp = $.param({details: data});

		$http({
			data: temp+"&"+$scope.tokenHash,
			url : site+"/editAdminProduct",
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {

			if(data.details != '' && data.details != null){

				if ($.fn.DataTable.isDataTable("#productIngredientsTable")) {
					$('#productIngredientsTable').DataTable().clear().destroy();
				}
				if ($.fn.DataTable.isDataTable("#productShadesTable")) {
					$('#productShadesTable').DataTable().clear().destroy();
				}
				if ($.fn.DataTable.isDataTable("#productUsesTable")) {
					$('#productUsesTable').DataTable().clear().destroy();
				}


				$scope.editView = 1;
				$scope.product = data.details;
				$scope.subCategoryLov = data.subCategory;
				$scope.subSubCategoryLov = data.subSubCategory;
				$scope.displayCollectionProdIngredients = data.ingredients;
				$scope.displayCollectionProdShades = data.shades;
				$scope.displayCollectionProdUses = data.productUses;

				setTimeout(function(){
					$("#productIngredientsTable").DataTable();
					$("#productShadesTable").DataTable();
					$("#productUsesTable").DataTable();
				}, 500);

				if(data.video != null){
					$scope.video = data.video;
					setTimeout(function(){
						$("#video_description").summernote("code", $scope.video.V_2);
					}, 500);
				}
				$scope.recallSubCatFunctionFlag = 0;
				setTimeout(function(){
					$("#p4").val($scope.product.P_4).trigger('change');
					$("#p8").val($scope.product.P_8).trigger('change');
					$("#p9").val($scope.product.P_9).trigger('change');
					$("#p44").val($scope.product.P_44).trigger('change');

					$("#p14").val($scope.product.P_14).trigger('change');
					$("#p15").val($scope.product.P_15).trigger('change');
					$("#p16").val($scope.product.P_16).trigger('change');
					$("#p17").val($scope.product.P_17).trigger('change');
					$("#p19").val($scope.product.P_19).trigger('change');
					$("#p20").val($scope.product.P_20).trigger('change');
					$("#p24").val($scope.product.P_24).trigger('change');
					$("#p26").val($scope.product.P_26).trigger('change');
					$("#p34").val($scope.product.P_34).trigger('change');
					$("#p37").val($scope.product.P_37).trigger('change');
					$("#p42").val($scope.product.P_42).trigger('change');
					$("#p45").val($scope.product.P_45).trigger('change');



					$("#p43").summernote("code", $scope.product.P_43);
					$("#basicInfo_description").summernote("code", $scope.product.P_13);

				}, 500);
			}

			$scope.makeImageAttachmentHtml(data.images);
			$scope.makeClinicalImageAttachmentHtml(data.clinicalNoteImages);

		})
		.error(function(data, status, headers, config) {
		});
	}
	$scope.makeImageAttachmentHtml = function(images){

		$("#p_att").html('');
		var primary="Primary";
		var secondary= "Secondary";

		if(images != '' && images != null){

			for(var i=0; i<images.length; i++){
				var titletxt = images[i]["primFlag"] == 0 ? 'secondary' : 'primary';
				var html = '<div class="col-2 image-overlay margin-r1" title="'+titletxt+'" id="img_file_'+images[i]["ID"]+'">'+
								'<img src="'+images[i]["downPath"]+'" alt="" class="image-box">'+
								'<div class="overlay">'+
									'<div class="text">'+
										'<img class="fa-trash-alt" src="'+baseurl+'/images/admin/trash.svg" alt="" width="18" ng-click="deleteProductImage('+images[i]["ID"]+')" title="Delete Image">';

											html += '<img class="fa-pencil-alt" src="'+baseurl+'/images/admin/pencil-solid.svg" alt="" width="18" ng-click="markProdImagePriSec('+images[i]["ID"]+')" title="Mark Primary">';

									html +=
									'</div>'+
								'</div>'+
							'</div>';

					$("#p_att").append($compile(angular.element(html))($scope));
			}
		}
	}
	$scope.makeClinicalImageAttachmentHtml = function(images){

		$("#cn_att").html('');

		if(images != '' && images != null){

			for(var i=0; i<images.length; i++){

				var html = '<div class="col-2 image-overlay margin-r1" id="img_file_'+images[i]["ID"]+'">'+
								'<img src="'+images[i]["downPath"]+'" alt="" class="image-box">'+
								'<div class="overlay">'+
									'<div class="text">'+
										'<img class="fa-trash-alt" src="'+baseurl+'/images/admin/trash.svg" alt="" width="18" ng-click="deleteClinicalNoteImage('+images[i]["ID"]+')" title="Delete Image">';

										if(images[i]["primFlag"] == '0'){
											html += '<img class="fa-pencil-alt" src="'+baseurl+'/images/admin/pencil-solid.svg" alt="" width="18" ng-click="markPrimaryClinicalNoteImage('+images[i]["ID"]+')" title="Mark Primary">';
										}

									html +=
									'</div>'+
								'</div>'+
							'</div>';

					$("#cn_att").append($compile(angular.element(html))($scope));
			}
		}
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

		$("#ps_att").html('');

		if(images != '' && images != null){

			for(var i=0; i<images.length; i++){

				var html = '<div class="col-3 image-overlay margin-r1" id="img_file_'+images[i]["ID"]+'">'+
								'<img src="'+images[i]["downPath"]+'" alt="" class="image-box">'+
								'<div class="overlay">'+
									'<div class="text" title="'+images[i]['titleText']+'">'+
										'<img class="fa-trash-alt" src="'+baseurl+'/images/admin/trash.svg" alt="" width="18" ng-click="deleteProductShadeImage('+images[i]["ID"]+')" title="Delete Image">';


									html += '<img class="fa-pencil-alt" src="'+baseurl+'/images/admin/pencil-solid.svg" alt="" width="18" ng-click="markProdShadeImage('+images[i]["ID"]+')" title="Mark Image">';


									html +=
									'</div>'+
								'</div>'+
							'</div>';

					$("#ps_att").append($compile(angular.element(html))($scope));
			}
		}
	}
	$scope.tempId = '';
	$scope.markProdShadeImage = function(id){
		$scope.tempId = id;
		$("#shadesModal").modal('hide');
		$("#confirmProdShadeModal").modal('show');
	}
	$scope.closeProdShadeModal = function(id){
		$scope.tempId = '';
		$("#shadesModal").modal('show');
		$("#confirmProdShadeModal").modal('hide');
	}
	$scope.markProductShadeImageFlag = function(flag){

		var data = {};
		data.flag = flag;
	    data.imageId = $scope.tempId;
	    data.productId = $scope.product.ID;
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
	$scope.deleteProductShadeImage = function(id){

		var data = {};
		data.imageId = id;
	    data.productId = $scope.product.ID;
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

	$scope.tempProId = '';
	$scope.markProdImagePriSec = function(id){

		$scope.tempProId = id;
		// $("#shadesModal").modal('hide');
		$("#confirmProdImageModal").modal('show');
	}
	$scope.closeProdImageModal = function(id){
		$scope.tempProId = '';
		// $("#shadesModal").modal('show');
		$("#confirmProdImageModal").modal('hide');
	}


	$scope.markProductDetailImageFlag = function(flag){

		var data = {};
	    data.imageId = $scope.tempProId;
		data.flag = flag;
	    data.productId = $scope.product.ID;
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
				$scope.makeImageAttachmentHtml(data.images);
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
	$scope.markPrimaryClinicalNoteImage = function(id){

		var data = {};
	    data.imageId = id;
	    data.productId = $scope.product.ID;
	    data.userId = userId;
    	var temp = $.param({details: data});

		$http({
			data: temp+"&"+$scope.tokenHash,
			url : site+"/markPrimaryClinicalNoteImage",
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {

			toastr.success(data.msg, '', {timeOut: 3000})

			$scope.makeClinicalImageAttachmentHtml(data.images);

		})
		.error(function(data, status, headers, config) {
		});
	}

	$scope.deleteProductImage = function(id){

		var data = {};
		data.imageId = id;
	    data.productId = $scope.product.ID;
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

			$scope.makeImageAttachmentHtml(data.images);

		})
		.error(function(data, status, headers, config) {
		});
	}
	$scope.deleteClinicalNoteImage = function(id){

		var data = {};
		data.imageId = id;
	    data.productId = $scope.product.ID;
	    data.userId = userId;
    	var temp = $.param({details: data});

		$http({
			data: temp+"&"+$scope.tokenHash,
			url : site+"/deleteClinicalNoteImage",
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {

			toastr.success(data.msg, '', {timeOut: 3000})

			$scope.makeClinicalImageAttachmentHtml(data.images);

		})
		.error(function(data, status, headers, config) {
		});
	}

	$scope.deleteProductShade = function(id){

		var data = {};
	    data.productId = $scope.product.ID;
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

			if ($.fn.DataTable.isDataTable("#productShadesTable")) {
				$('#productShadesTable').DataTable().clear().destroy();
			}

			$scope.displayCollectionProdShades = data.shades;

			setTimeout(function(){
				$("#productShadesTable").DataTable();
			}, 500);



		})
		.error(function(data, status, headers, config) {
		});
	}
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

		if($scope.product.ID == ''){
			toastr.error("Save Product Info first, then proceed...", '', {timeOut: 3000})
			return;
		}

		var data = {};
	    data.product = $scope.product;
	    data.uses = $scope.uses;
	    data.userId = userId;

    	var temp = $.param({details: data});

		$http({
			data: temp+"&"+$scope.tokenHash,
			url : site+"/saveAdminProductUses",
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {

			if(data.done == true || data.done == 'true'){

				toastr.success(data.msg, '', {timeOut: 3000})

				$scope.uses.ID = data.ID;

				if ($.fn.DataTable.isDataTable("#productUsesTable")) {
					$('#productUsesTable').DataTable().clear().destroy();
				}

				$scope.displayCollectionProdUses = data.productuses;

				setTimeout(function(){
                    $('#usesStepsModal').modal('hide');
					$("#productUsesTable").DataTable();
				}, 500);

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
	    data.productId = $scope.product.ID;
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

			toastr.success(data.msg, '', {timeOut: 3000})

			if ($.fn.DataTable.isDataTable("#productUsesTable")) {
				$('#productUsesTable').DataTable().clear().destroy();
			}

			$scope.displayCollectionProdUses = data.productuses;

			setTimeout(function(){
				$("#productUsesTable").DataTable();
			}, 500);



		})
		.error(function(data, status, headers, config) {
		});
	}
	$scope.deleteProductUsesImage = function(id){

		var data = {};
	    data.productId = $scope.product.ID;
	    data.productUsesId = id;
	    data.userId = userId;
    	var temp = $.param({details: data});

		$http({
			data: temp+"&"+$scope.tokenHash,
			url : site+"/deleteProductUsesImage",
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {

			toastr.success(data.msg, '', {timeOut: 3000})

			$scope.uses.U_3 = '';

		})
		.error(function(data, status, headers, config) {
		});
	}


	$scope.saveProductOtherInfo = function(){

		if($scope.product.ID == ''){
			toastr.error("Save Product Info first, then proceed...", '', {timeOut: 3000})
			return;
		}

		if ($('#p43').summernote('isEmpty')) {
			$scope.product.P_43 = '';
		}else{
			$scope.product.P_43 = $('#p43').summernote('code');
		}

		var data = {};
	    data.product = $scope.product;
	    data.userId = userId;

    	var temp = $.param({details: data});

		$http({
			data: temp+"&"+$scope.tokenHash,
			url : site+"/saveAdminProductOtherInfo",
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

	$scope.changeStatusProduct = function(id){

		var data = {};
	    data.recordId = id;
	    data.userId = userId;

    	var temp = $.param({details: data});

		$http({
			data: temp+"&"+$scope.tokenHash,
			url : site+"/changeStatusProduct",
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {

			toastr.success(data.msg, '', {timeOut: 3000})
			$scope.getAllAdminProductlov();

		})
		.error(function(data, status, headers, config) {
		});
	}

	$scope.alertDeleteMsg = '';
    $scope.productIdToDelete = '';
      // Function to open the modal and set the productId to delete
  $scope.openDeleteConfirmModal = function(productId) {
    $scope.productIdToDelete = productId;
    $('#alertDelProduct').modal('show'); // Show the modal
  };
  $scope.closeDeleteConfirmModal = function(productId) {
    $scope.productIdToDelete = productId;
    $('#alertDelProduct').modal('hide'); // Show the modal
    $scope.productIdToDelete = '';
  };
	$scope.deleteProductConfirmed = function(){

		var data = {};
	    data.recordId =  $scope.productIdToDelete;
	    data.userId = userId;

    	var temp = $.param({details: data});

		$http({
			data: temp+"&"+$scope.tokenHash,
			url : site+"/deleteSpecificProduct",
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {

			if(data.done == true || data.done == 'true'){


                $scope.productIdToDelete = '';
                $('#alertDelProduct').modal('hide');
                toastr.success(data.msg, '', {timeOut: 3000})
				$scope.getAllAdminProductlov();

			}else{

				$scope.alertDeleteMsg = data.msg;
				$("#alertDelProduct").modal('show');
			}


		})
		.error(function(data, status, headers, config) {
		});
	}

	$scope.closealertDeleteModal = function(id){

		$("#alertDel").modal('hide');
		$scope.alertDeleteMsg = '';

	}

	$('#uploadattch').fileupload({

 		add: function (e, data) {

 			if($scope.product.ID == ""){

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

 		  		toastr.success("Image Upload Successfully", '', {timeOut: 3000});

 		  		var html = '<div class="col-2 image-overlay margin-r1" id="img_file_'+xhr.responseText[1]+'">'+
								'<img src="'+xhr.responseText[2]+'" alt="" class="image-box">'+
								'<div class="overlay">'+
									'<div class="text">'+
										'<img class="fa-trash-alt" src="'+baseurl+'/images/admin/trash.svg" alt="" width="18" ng-click="deleteProductImage('+xhr.responseText[1]+')" title="Delete Image">'+
										'<img class="fa-pencil-alt" src="'+baseurl+'/images/admin/pencil-solid.svg" alt="" width="18" ng-click="markProdImagePriSec('+xhr.responseText[1]+')" title="Mark Primary">'+
									'</div>'+
								'</div>'+
							'</div>';

 		  		$("#p_att").append($compile(angular.element(html))($scope));

 	      	}
 	   	}
 	});

	$('#uploadattch2').fileupload({

 		add: function (e, data) {

 			if($scope.product.ID == ""){

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

 	      	}else{

 		  		toastr.success("Video Upload Successfully", '', {timeOut: 3000});
 		  		$scope.$apply(function () {

 		  			$scope.video.ID = xhr.responseText[1];
 		  			$scope.video.V_3 = xhr.responseText[2];

 		  		});

 	      	}
 	   	}
 	});

	$('#uploadattch3').fileupload({

 		add: function (e, data) {

 			if($scope.product.ID == ""){

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
								'<div class="overlay">'+
									'<div class="text">'+
										'<img class="fa-trash-alt" src="'+baseurl+'/images/admin/trash.svg" alt="" width="18" ng-click="deleteProductShadeImage('+xhr.responseText[1]+')" title="Delete Image">'+
										'<img class="fa-pencil-alt" src="'+baseurl+'/images/admin/pencil-solid.svg" alt="" width="18" ng-click="markProdShadeImage('+xhr.responseText[1]+')" title="Mark Primary">'+
									'</div>'+
								'</div>'+
							'</div>';

					$("#ps_att").append($compile(angular.element(html))($scope));
 	      	}
 	   	}
 	});

	$('#uploadattch4').fileupload({

 		add: function (e, data) {

 			if($scope.product.ID == ""){

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

 			if($scope.product.ID == ""){

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

 		  		var html = '<div class="col-2 image-overlay margin-r1" id="img_file_'+xhr.responseText[1]+'">'+
								'<img src="'+xhr.responseText[2]+'" alt="" class="image-box">'+
								'<div class="overlay">'+
									'<div class="text">'+
										'<img class="fa-trash-alt" src="'+baseurl+'/images/admin/trash.svg" alt="" width="18" ng-click="deleteClinicalNoteImage('+xhr.responseText[1]+')" title="Delete Image">'+
										'<img class="fa-pencil-alt" src="'+baseurl+'/images/admin/pencil-solid.svg" alt="" width="18" ng-click="markPrimaryClinicalNoteImage('+xhr.responseText[1]+')" title="Mark Primary">'+
									'</div>'+
								'</div>'+
							'</div>';

 		  		$("#cn_att").append($compile(angular.element(html))($scope));

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







