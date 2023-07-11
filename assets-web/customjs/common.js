toastr.options = {
		timeOut : 0,
		extendedTimeOut : 100,
		tapToDismiss : true,
		debug : false,
		fadeOut: 10,
		positionClass : "toast-top-center"
	};
$(document).on("click", ".refferAfrieend", function () {
	$('html, body').animate({
        scrollTop: $("#bestSelOnlineExc_section").offset().top
    }, 1000);

});
$(document).on("click", ".toShopListing", function () {

	var id = $(this).attr("data-id");
	var type = $(this).attr("data-type");
    var category = $(this).attr("data-categoryslug");
    var subCategory = $(this).attr("data-subcategoryslug");

	$('.sourceId').val(id);
	$('.sourceType').val(type);
    $('.category').val(category);
    $('.subcategory').val(subCategory);
    // alert(subCategory);
    if (category && subCategory !== undefined && subCategory !== '') {
        $('#shoplistingRedirectForm').attr('action', baseUrl + '/Store/' + category + '/' + subCategory);
        // alert(baseUrl + '/' + category + '/' + subCategory);
    } else if (category) {
        $('#shoplistingRedirectForm').attr('action', baseUrl + '/Store/' + category);
        // alert(baseUrl + '/' + category);
    }

	setTimeout(function(){
		$("#shoplistingRedirectForm").submit();
	}, 500);
});

	$(document).on("click", ".productdetail", function () {

		// var id = $(this).attr("data-id");
		// var code = $(this).attr("data-type");
        // var category = $(this).attr('data-category');
        // var subCategory = $(this).attr('data-subcategory');
        // var slug = $(this).attr("data-name");
        // console.log(category,subCategory,slug,code);

		// var type = 'PRODUCT_DETAIL';
		// $('#sourceId1').val(id);
		// $('#sourceType1').val(type);
		// $('#sourceCode1').val(code);
        // if((category != '' || category != null) && (subCategory != '' || subCategory != null) && (slug != '' || slug != null)){
        //     $('#productDetailRedirectForm').attr('action', baseUrl+'/'+category+'/'+subCategory+'/' + slug);
        //     alert(baseUrl+'/'+category+'/'+subCategory+'/' + slug);
        // }else
        // if(subCategory == '' || subCategory == null){
        //     $('#productDetailRedirectForm').attr('action', baseUrl+'/'+category+'/' + slug);
        //     alert(baseUrl+'/'+category+'/' + slug);
        // }

        var id = $(this).attr("data-id");
        var code = $(this).attr("data-type");
        var category = $(this).attr('data-category');
        var subCategory = $(this).attr('data-subcategory');
        var slug = $(this).attr("data-name");
        // console.log(category, subCategory, slug, code);

        var type = 'PRODUCT_DETAIL';
        $('#sourceId1').val(id);
        $('#sourceType1').val(type);
        $('#sourceCode1').val(code);
        $('#category').val(category);
        $('#subcategory').val(subCategory);
        $('#slug').val(slug);

        if (category && subCategory && slug) {
            $('#productDetailRedirectForm').attr('action', baseUrl + '/Products/' + category + '/' + subCategory + '/' + slug);
            // alert(baseUrl + '/' + category + '/' + subCategory + '/' + slug);
        } else if (category && slug) {
            $('#productDetailRedirectForm').attr('action', baseUrl + '/Products/' + category + '/' + slug);
            // alert(baseUrl + '/' + category + '/' + slug);
        }

		setTimeout(function(){
			$("#productDetailRedirectForm").submit();
		}, 500);
	});

	$(document).on("click", ".addsubquantity", function () {
		$(".addto-cart").attr("data-quantity", $("#quantity").val() != '' ? $("#quantity").val() : '0')
		$(".quick-addto-cart").attr("data-quantity", $("#quantity").val() != '' ? $("#quantity").val() : '0')
	});
	$(document).on("keyup", ".quantityinput", function () {
		$(".addto-cart").attr("data-quantity", $("#quantity").val() != '' ? $("#quantity").val() : '0')
		$(".quick-addto-cart").attr("data-quantity", $("#quantity").val() != '' ? $("#quantity").val() : '0')
	});

	function quickAdd(productid){

		var productId = productid;
		var quantity = '1';
		var type = 'product';

		// if(type == 'bundle'){

		// 	// product shades selection code
		// 	var number1 = new Array();
		// 	var number2 = new Array();
		// 	var number3 = new Array();
		// 	var number4 = new Array();
		// 	var number5 = new Array();
		// 	var i =0;
		// 	$('div[id*=shadeBundlechooser_container_]').each(function(){
		// 		number1[i] =  $(this).find("[id*=prodShadeId_]").val();
		// 		number2[i] =  $(this).find("[id*=shadeId_]").val();
		// 		number3[i] =  $(this).find("[id*=shadeName_]").val();
		// 		number4[i] =  $(this).find("[id*=productId_]").val();
		// 		number5[i] =  $(this).find("[id*=shadeExistChk_]").val();
		// 		i++;
		// 	});
		// 	var flag = "0";
		// 	for(var i=0; i<number1.length; i++){
		// 		if(number5[i] == 'true'){
		// 			if(number1[i] == ''){
		// 				flag="1";
		// 			}
		// 		}
		// 	}
		// 	if(flag == '1'){
		// 		toastr.error('Choose all product shades first, then proceed...', '', {timeOut: 3000})
		// 		return;
		// 	}

		// 	var prodshadeIds = number1;
		// 	var shadeIds = number2;
		// 	var shadeNames = number3;
		// 	var productIds = number4;

		// }else{

			// product shades selection code
			// var shadeExistChk = $('#shadeExistChk').val();
			// var prodshadeId = $('#prodShadeId').val();
			// var shadeId = $('#shadeId').val();
			// var shadeName = $('#shadeName').val();
			// var prodId = $('#productId').val();

			// if(shadeExistChk == 'true'){
			// 	if(prodshadeId == ''){
			// 		toastr.error('Choose product shades first...', '', {timeOut: 3000})
			// 		return;
			// 	}
			// }
		//}

		// subscription product code  start
		// var subscriptioncheck = $("input[name=subscriptioncheck]:checked").val();
		// var subscriptionOption = '';

		// if(subscriptioncheck == 'subscription'){
		// 	subscriptionOption = $("#subsOption").val();

		// 	if(subscriptionOption == ''){
		// 		toastr.error('Choose Subscription option first...', '', {timeOut: 3000})
		// 		return;
		// 	}
		// }

	//	console.log(subscriptioncheck);
	//	console.log(subscriptionOption);
	//	return;
		// subscription product code  end

		if(quantity <= 0 || quantity == ''){

			toastr.error('Quantity must be greater then one...', '', {timeOut: 3000})
			return;

		}else{

			$.LoadingOverlay("show");

			var token = $("#csrf").val();

			var form_data = new FormData();
				form_data.append("userId", userId);
				form_data.append("productId", productId);
				form_data.append("quantity", quantity);
				form_data.append("type", type);
				// form_data.append("subscheck", subscriptioncheck);
				// form_data.append("subsOptionId", subscriptionOption);

				// if(type == 'bundle'){
				// 	form_data.append("prodshadeIds", prodshadeIds);
				// 	form_data.append("shadeIds", shadeIds);
				// 	form_data.append("shadeNames", shadeNames);
				// 	form_data.append("productIds", productIds);

				// }else{
				// 	form_data.append("prodshadeId", prodshadeId);
				// 	form_data.append("shadeId", shadeId);
				// 	form_data.append("prodId", prodId);
				// 	form_data.append("shadeName", shadeName);
				// }

				form_data.append("_token", token);
				 $.ajax({
					url: site+"/addToCart",
					type: "POST",
					data: form_data,
					cache: false,
					contentType: false,
					processData: false,
					success: function(data){
						var data = JSON.parse(data);

						if(data.done == true || data.done == 'true'){

							toastr.success(data.msg, '', {timeOut: 3000})


							var cart = data.cart;
							var list = data.cartDetails;
							var html = '';

							$("#cartRightMenuListingHTML").html('');

							if(cart != null && cart != ''){
								$("#itemCounts").text(cart['cartCount']+' Item(s).');
								$("#cartHeaderCount").text(cart['cartCount']);
								$("#cartCount").val(cart['cartCount'])
								$("#cartSubTotal").text('$'+cart['ExtVatTotalAmount']);
							}else{
								$("#itemCounts").text('0 Item(s).');
								$("#cartHeaderCount").text('0');
								$("#cartCount").val('0')
								$("#cartSubTotal").text('$0.00');
							}

							   if(list != null && list != ''){

								   for(var i=0; i<list.length; i++){

											html +='<div class="media w-100 py-2" id="cartItemDiv-'+list[i]['CART_LINE_ID']+'">';
										 html +='<div class="mr-3 w-110px">';
										 html +='<img src="'+list[i]['primaryImage']+'" alt="High Ankle Jeans" class="border">';
										 html +='</div>';
										 html +='<div class="media-body">';
										 html +='<a href="javascript:;" class="card-title font-weight-500">'+list[i]['productName']+'<i class="fa fa-info-circle p-1" onclick="getProductShadesRightSideBar('+list[i]['CART_LINE_ID']+')" data-toggle="tooltip" title="" data-placement="top" data-original-title="View Product Shades"></i></a>';
										 html +='<p class="card-text mb-2 text-primary">$'+list[i]['UNIT_PRICE']+'</p>';
										 html +='<div class="d-flex align-items-center">';
										 html +='<div class="input-group position-relative w-100px bg-input rounded rounded">';
										 //html +='<a href="javascript:;" disabled class="down position-absolute pos-fixed-left-center pl-2 z-index-2">';
										 //html +='<i class="far fa-minus"></i>';
										 //html +='</a>';
										 html +='<input name="number[]" disabled type="number" class="form-control form-control-sm w-100 px-6 fs-16 text-center input-quality bg-transparent h-35px border-0" value="'+list[i]['QUANTITY']+'" required>';
										 //html +='<a href="javascript:;" disabled class="up position-absolute pos-fixed-right-center pr-2 z-index-2">';
										 //html +='<i class="far fa-plus"></i> ';
										 //html +='</a>';
										 html +='</div>';

										 html +='</div>';
	//				    		         	html +='<a href="javascript:;" class="text-decoration-underline fs-14 opacity-8 d-inline-block">Save Item </a>&nbsp;&nbsp;';
										 html +='<a href="javascript:;" class="text-decoration-underline fs-14 opacity-8 d-inline-block removeItemCart" data-id="'+list[i]['CART_LINE_ID']+'" data-cartId="'+list[i]['CART_ID']+'">Remove Item</a>';

										 html +='</div>';
										 html +='</div>';
								   }
							   }

							$("#cartRightMenuListingHTML").html(html);

						}else{
							toastr.error(data.msg, '', {timeOut: 3000});

							// if(data.flag == 0){
							// 	setTimeout(function(){
							// 		window.location.href = data.redirectURL;
							// 	}, 3000);

							// 	localStorage.setItem("productId", productId);

							// }
						}


						setTimeout(function(){
								$.LoadingOverlay("hide");
						}, 500);
					}
				});
		}


	}

	function quickAddWishList(productid){

		var productId = productid;
		var productType = 'product';
		var check_flag_wishlist = '1';

		$.LoadingOverlay("show");

		var token = $("#csrf").val();

		var form_data = new FormData();

		form_data.append("check_flag_wishlist", check_flag_wishlist);
		form_data.append("userId", userId);
		form_data.append("productId", productId);
		form_data.append("productType", productType);

		form_data.append("_token", token);
		$.ajax({
			url: site+"/addProductToWishlist",
			type: "POST",
			data: form_data,
			cache: false,
			contentType: false,
			processData: false,
			success: function(data){
				var data = JSON.parse(data);

				if(data.done == true || data.done == 'true'){

					toastr.success(data.msg, '', {timeOut: 3000})

					var wishlistCount = data.wishlistCount;

					$("#wishlistHeaderCount").text(wishlistCount);
					$("#wishlistHeaderCountMbl").text(wishlistCount);

					if(data.flag == 'add'){
						$('.wish_'+productId).addClass('activeWish');
					}else{
						$('.wish_'+productId).removeClass('activeWish');
					}


				}else{
					toastr.error(data.msg, '', {timeOut: 3000});

					if(data.flag == 0){
						setTimeout(function(){
							//redirect to login
							window.location.href= data.redirectURL;
						}, 3000);

						localStorage.setItem("wishlistproductId", productId);

					}
				}

				setTimeout(function(){
						$.LoadingOverlay("hide");
				}, 500);
			}
		});

	}

$(document).on("click", ".addto-cart", function () {

	var productId = $(this).attr("data-id");
	var quantity = $(this).attr("data-quantity");
	var type = $(this).attr("data-type");

	if(type == 'bundle'){

		// product shades selection code
		var number1 = new Array();
		var number2 = new Array();
		var number3 = new Array();
		var number4 = new Array();
		var number5 = new Array();
		var i =0;
		$('div[id*=shadeBundlechooser_container_]').each(function(){
			number1[i] =  $(this).find("[id*=prodShadeId_]").val();
			number2[i] =  $(this).find("[id*=shadeId_]").val();
			number3[i] =  $(this).find("[id*=shadeName_]").val();
			number4[i] =  $(this).find("[id*=productId_]").val();
			number5[i] =  $(this).find("[id*=shadeExistChk_]").val();
			i++;
		});
		var flag = "0";
		for(var i=0; i<number1.length; i++){
			if(number5[i] == 'true'){
				if(number1[i] == ''){
					flag="1";
				}
			}
		}
		if(flag == '1'){
			toastr.error('Choose all product shades first, then proceed...', '', {timeOut: 3000})
			return;
		}

		var prodshadeIds = number1;
		var shadeIds = number2;
		var shadeNames = number3;
		var productIds = number4;

	}else{

		// product shades selection code
		var shadeExistChk = $('#shadeExistChk').val();
		var prodshadeId = $('#prodShadeId').val();
		var shadeId = $('#shadeId').val();
		var shadeName = $('#shadeName').val();
		var prodId = $('#productId').val();

		if(shadeExistChk == 'true'){
			if(prodshadeId == ''){
				toastr.error('Choose product shades first...', '', {timeOut: 3000})
				return;
			}
		}
	}

	// subscription product code  start
	var subscriptioncheck = $("input[name=subscriptioncheck]:checked").val();
	var subscriptionOption = '';

	if(subscriptioncheck == 'subscription'){
		subscriptionOption = $("#subsOption").val();

		if(subscriptionOption == ''){
			toastr.error('Choose Subscription option first...', '', {timeOut: 3000})
			return;
		}
	}

//	console.log(subscriptioncheck);
//	console.log(subscriptionOption);
//	return;
	// subscription product code  end

	if(quantity <= 0 || quantity == ''){

		toastr.error('Quantity must be greater then one...', '', {timeOut: 3000})
		return;

	}else{

		$.LoadingOverlay("show");

		var token = $("#csrf").val();

		var form_data = new FormData();
			form_data.append("userId", userId);
			form_data.append("productId", productId);
			form_data.append("quantity", quantity);
			form_data.append("type", type);
			form_data.append("subscheck", subscriptioncheck);
			form_data.append("subsOptionId", subscriptionOption);

			if(type == 'bundle'){
				form_data.append("prodshadeIds", prodshadeIds);
				form_data.append("shadeIds", shadeIds);
				form_data.append("shadeNames", shadeNames);
				form_data.append("productIds", productIds);

			}else{
				form_data.append("prodshadeId", prodshadeId);
				form_data.append("shadeId", shadeId);
				form_data.append("prodId", prodId);
				form_data.append("shadeName", shadeName);
			}

			form_data.append("_token", token);
		 	$.ajax({
		        url: site+"/addToCart",
		        type: "POST",
		        data: form_data,
		        cache: false,
		        contentType: false,
		        processData: false,
		        success: function(data){
		        	var data = JSON.parse(data);

					if(data.done == true || data.done == 'true'){

						toastr.success(data.msg, '', {timeOut: 3000})

						var cart = data.cart;
			        	var list = data.cartDetails;
			        	var html = '';

			        	$("#cartRightMenuListingHTML").html('');

			    		if(cart != null && cart != ''){
			    			$("#itemCounts").text(cart['cartCount']+' Item(s).');
			    			$("#cartHeaderCount").text(cart['cartCount']);
			    			$("#cartCount").val(cart['cartCount'])
			    			$("#cartSubTotal").text('$'+cart['ExtVatTotalAmount']);
			    		}else{
			    			$("#itemCounts").text('0 Item(s).');
			    			$("#cartHeaderCount").text('0');
			    			$("#cartCount").val('0')
			    			$("#cartSubTotal").text('$0.00');
			    		}

			    	   	if(list != null && list != ''){

			    	   		for(var i=0; i<list.length; i++){

			    	   			 	html +='<div class="media w-100 py-2" id="cartItemDiv-'+list[i]['CART_LINE_ID']+'">';
			    		         	html +='<div class="mr-3 w-110px">';
			    		         	html +='<img src="'+list[i]['primaryImage']+'" alt="High Ankle Jeans" class="border">';
			    		         	html +='</div>';
			    		         	html +='<div class="media-body">';
			    		         	html +='<a href="javascript:;" class="card-title font-weight-500">'+list[i]['productName']+'<i class="fa fa-info-circle p-1" onclick="getProductShadesRightSideBar('+list[i]['CART_LINE_ID']+')" data-toggle="tooltip" title="" data-placement="top" data-original-title="View Product Shades"></i></a>';
			    		         	html +='<p class="card-text mb-2 text-primary">$'+list[i]['UNIT_PRICE']+'</p>';
			    		         	html +='<div class="d-flex align-items-center">';
			    		         	html +='<div class="input-group position-relative w-100px bg-input rounded rounded">';
			    		         	//html +='<a href="javascript:;" disabled class="down position-absolute pos-fixed-left-center pl-2 z-index-2">';
			    		         	//html +='<i class="far fa-minus"></i>';
			    		         	//html +='</a>';
			    		         	html +='<input name="number[]" disabled type="number" class="form-control form-control-sm w-100 px-6 fs-16 text-center input-quality bg-transparent h-35px border-0" value="'+list[i]['QUANTITY']+'" required>';
			    		         	//html +='<a href="javascript:;" disabled class="up position-absolute pos-fixed-right-center pr-2 z-index-2">';
			    		         	//html +='<i class="far fa-plus"></i> ';
			    		         	//html +='</a>';
			    		         	html +='</div>';

			    		         	html +='</div>';
//				    		         	html +='<a href="javascript:;" class="text-decoration-underline fs-14 opacity-8 d-inline-block">Save Item </a>&nbsp;&nbsp;';
			    		         	html +='<a href="javascript:;" class="text-decoration-underline fs-14 opacity-8 d-inline-block removeItemCart" data-id="'+list[i]['CART_LINE_ID']+'" data-cartId="'+list[i]['CART_ID']+'">Remove Item</a>';

			    		         	html +='</div>';
			    		         	html +='</div>';
			    	   		}
			    	   	}

			        	$("#cartRightMenuListingHTML").html(html);

					}else{
						toastr.error(data.msg, '', {timeOut: 3000});

						if(data.flag == 0){
							setTimeout(function(){
								window.location.href= data.redirectURL;
							}, 3000);

							localStorage.setItem("productId", productId);

						}
					}


		        	setTimeout(function(){
							$.LoadingOverlay("hide");
					}, 500);
		        }
		    });
	}

	});

$(document).on("click", ".addto-cart1", function () {

	var productId = $(this).attr("data-id");
	var quantity = $(this).attr("data-quantity");
	var type = $(this).attr("data-type");

	if(type == 'bundle'){

		// product shades selection code
		var number1 = new Array();
		var number2 = new Array();
		var number3 = new Array();
		var number4 = new Array();
		var i =0;
		$('div[id*=shadeBundlechooser_container_]').each(function(){
			number1[i] =  $(this).find("[id*=prodShadeId_]").val();
			number2[i] =  $(this).find("[id*=shadeId_]").val();
			number3[i] =  $(this).find("[id*=shadeName_]").val();
			number4[i] =  $(this).find("[id*=productId_]").val();
			i++;
		});
		// var flag = "0";
//		for(var i=0; i<number1.length; i++){
//			if(number1[i] == ''){
//				flag="1";
//			}
//		}
//		if(flag == '1'){
//			toastr.error('Choose all product shades first, then proceed...', '', {timeOut: 3000})
//			return;
//		}

		var prodshadeIds = number1;
		var shadeIds = number2;
		var shadeNames = number3;
		var productIds = number4;

	}else{

		// product shades selection code
		var prodshadeId = $('#prodShadeId').val();
		var shadeId = $('#shadeId').val();
		var shadeName = $('#shadeName').val();
		var prodId = $('#productId').val();

//		if(prodshadeId == ''){
//			toastr.error('Choose product shades first...', '', {timeOut: 3000})
//			return;
//		}
	}

	// subscription product code  start
	var subscriptioncheck = $("input[name=subscriptioncheck]:checked").val();
	var subscriptionOption = '';

	if(subscriptioncheck == 'subscription'){
		subscriptionOption = $("#subsOption").val();

		if(subscriptionOption == ''){
			toastr.error('Choose Subscription option first...', '', {timeOut: 3000})
			return;
		}
	}

//	console.log(subscriptioncheck);
//	console.log(subscriptionOption);
//	return;
	// subscription product code  end

	if(quantity <= 0 || quantity == ''){

		toastr.error('Quantity must be greater then one...', '', {timeOut: 3000})
		return;

	}else{

		$.LoadingOverlay("show");

		var token = $("#csrf").val();

		var form_data = new FormData();
			form_data.append("userId", userId);
			form_data.append("productId", productId);
			form_data.append("quantity", quantity);
			form_data.append("type", type);
			form_data.append("subscheck", subscriptioncheck);
			form_data.append("subsOptionId", subscriptionOption);

			if(type == 'bundle'){
				form_data.append("prodshadeIds", prodshadeIds);
				form_data.append("shadeIds", shadeIds);
				form_data.append("shadeNames", shadeNames);
				form_data.append("productIds", productIds);

			}else{
				form_data.append("prodshadeId", prodshadeId);
				form_data.append("shadeId", shadeId);
				form_data.append("prodId", prodId);
				form_data.append("shadeName", shadeName);
			}

			form_data.append("_token", token);
		 	$.ajax({
		        url: site+"/addToCart",
		        type: "POST",
		        data: form_data,
		        cache: false,
		        contentType: false,
		        processData: false,
		        success: function(data){
		        	var data = JSON.parse(data);

					if(data.done == true || data.done == 'true'){

						toastr.success(data.msg, '', {timeOut: 3000})
						var cart = data.cart;
			        	var list = data.cartDetails;
			        	var html = '';

			        	$("#cartRightMenuListingHTML").html('');

			    		if(cart != null && cart != ''){
			    			$("#itemCounts").text(cart['cartCount']+' Item(s).');
			    			$("#cartHeaderCount").text(cart['cartCount']);
			    			$("#cartHeaderCountMbl").text(cart['cartCount']);
			    			$("#cartCount").val(cart['cartCount'])
			    			$("#cartSubTotal").text('$'+cart['ExtVatTotalAmount']);
			    		}else{
			    			$("#itemCounts").text('0 Item(s).');
			    			$("#cartHeaderCount").text('0');
			    			$("#cartHeaderCountMbl").text('0');
			    			$("#cartCount").val('0')
			    			$("#cartSubTotal").text('$0.00');
			    		}

			    	   	if(list != null && list != ''){

			    	   		for(var i=0; i<list.length; i++){

			    	   			 	html +='<div class="media w-100 py-2" id="cartItemDiv-'+list[i]['CART_LINE_ID']+'">';
			    		         	html +='<div class="mr-3 w-110px">';
			    		         	html +='<img src="'+list[i]['primaryImage']+'" alt="High Ankle Jeans" class="border">';
			    		         	html +='</div>';
			    		         	html +='<div class="media-body">';
			    		         	html +='<a href="javascript:;" class="card-title font-weight-500">'+list[i]['productName']+'<i class="fa fa-info-circle p-1" onclick="getProductShadesRightSideBar('+list[i]['CART_LINE_ID']+')" data-toggle="tooltip" title="" data-placement="top" data-original-title="View Product Shades"></i></a>';
			    		         	html +='<p class="card-text mb-2 text-primary">$'+list[i]['UNIT_PRICE']+'</p>';
			    		         	html +='<div class="d-flex align-items-center">';
			    		         	html +='<div class="input-group position-relative w-100px bg-input rounded rounded">';
			    		         	html +='<a href="javascript:;" disabled class="down position-absolute pos-fixed-left-center pl-2 z-index-2">';
			    		         	html +='<i class="far fa-minus"></i>';
			    		         	html +='</a>';
			    		         	html +='<input name="number[]" disabled type="number" class="form-control form-control-sm w-100 px-6 fs-16 text-center input-quality bg-transparent h-35px border-0" value="'+list[i]['QUANTITY']+'" required>';
			    		         	html +='<a href="javascript:;" disabled class="up position-absolute pos-fixed-right-center pr-2 z-index-2">';
			    		         	html +='<i class="far fa-plus"></i> ';
			    		         	html +='</a>';
			    		         	html +='</div>';

			    		         	html +='</div>';
//				    		         	html +='<a href="javascript:;" class="text-decoration-underline fs-14 opacity-8 d-inline-block">Save Item </a>&nbsp;&nbsp;';
			    		         	html +='<a href="javascript:;" class="text-decoration-underline fs-14 opacity-8 d-inline-block removeItemCart" data-id="'+list[i]['CART_LINE_ID']+'" data-cartId="'+list[i]['CART_ID']+'">Remove Item</a>';

			    		         	html +='</div>';
			    		         	html +='</div>';
			    	   		}
			    	   	}

			        	$("#cartRightMenuListingHTML").html(html);

					}else{
						toastr.error(data.msg, '', {timeOut: 3000});

						if(data.flag == 0){
							setTimeout(function(){
								window.location.href = data.redirectURL;
							}, 3000);

							localStorage.setItem("productId", productId);


						}
					}


		        	setTimeout(function(){
							$.LoadingOverlay("hide");
					}, 500);
		        }
		    });
	}

	});

$(document).on("click", ".quick-addto-cart", function () {

	var productId = $(this).attr("data-id");
	var quantity = $(this).attr("data-quantity");
	var type = $(this).attr("data-type");

	if(type == 'bundle'){

		// product shades selection code
		var number1 = new Array();
		var number2 = new Array();
		var number3 = new Array();
		var number4 = new Array();
		var number5 = new Array();
		var i =0;
		$('div[id*=shadeBundlechooser_container_]').each(function(){
			number1[i] =  $(this).find("[id*=prodShadeId_]").val();
			number2[i] =  $(this).find("[id*=shadeId_]").val();
			number3[i] =  $(this).find("[id*=shadeName_]").val();
			number4[i] =  $(this).find("[id*=productId_]").val();
			number5[i] =  $(this).find("[id*=shadeExistChk_]").val();
			i++;
		});
		var flag = "0";
		for(var i=0; i<number1.length; i++){
			if(number5[i] == 'true'){
				if(number1[i] == ''){
					flag="1";
				}
			}
		}
		if(flag == '1'){
			toastr.error('Choose all product shades first, then proceed...', '', {timeOut: 3000})
			return;
		}

		var prodshadeIds = number1;
		var shadeIds = number2;
		var shadeNames = number3;
		var productIds = number4;

	}else{

		// product shades selection code
		var shadeExistChk = $('#shadeExistChk').val();
		var prodshadeId = $('#prodShadeId').val();
		var shadeId = $('#shadeId').val();
		var shadeName = $('#shadeName').val();
		var prodId = $('#productId').val();

		if(shadeExistChk == 'true'){
			if(prodshadeId == ''){
				toastr.error('Choose product shades first...', '', {timeOut: 3000})
				return;
			}
		}
	}

	// subscription product code  start
	var subscriptioncheck = $("input[name=subscriptioncheck]:checked").val();
	var subscriptionOption = '';

	if(subscriptioncheck == 'subscription'){
		subscriptionOption = $("#subsOption").val();

		if(subscriptionOption == ''){
			toastr.error('Choose Subscription option first...', '', {timeOut: 3000})
			return;
		}
	}

//	console.log(subscriptioncheck);
//	console.log(subscriptionOption);
//	return;
	// subscription product code  end

	if(quantity <= 0 || quantity == ''){

		toastr.error('Quantity must be greater then one...', '', {timeOut: 3000})
		return;

	}else{

//		$.LoadingOverlay("show");

		var token = $("#csrf").val();

		var form_data = new FormData();
			form_data.append("userId", userId);
			form_data.append("productId", productId);
			form_data.append("quantity", quantity);
			form_data.append("type", type);
			form_data.append("subscheck", subscriptioncheck);
			form_data.append("subsOptionId", subscriptionOption);

			if(type == 'bundle'){
				form_data.append("prodshadeIds", prodshadeIds);
				form_data.append("shadeIds", shadeIds);
				form_data.append("shadeNames", shadeNames);
				form_data.append("productIds", productIds);

			}else{
				form_data.append("prodshadeId", prodshadeId);
				form_data.append("shadeId", shadeId);
				form_data.append("prodId", prodId);
				form_data.append("shadeName", shadeName);
			}

			form_data.append("_token", token);
		 	$.ajax({
		        url: site+"/addToCart",
		        type: "POST",
		        data: form_data,
		        cache: false,
		        contentType: false,
		        processData: false,
		        success: function(data){
		        	var data = JSON.parse(data);

					if(data.done == true || data.done == 'true'){

						toastr.success(data.msg, '', {timeOut: 3000})

						var cart = data.cart;
			        	var list = data.cartDetails;
			        	var html = '';

			        	$("#cartRightMenuListingHTML").html('');

			    		if(cart != null && cart != ''){
			    			$("#itemCounts").text(cart['cartCount']+' Item(s).');
			    			$("#cartHeaderCount").text(cart['cartCount']);
			    			$("#cartCount").val(cart['cartCount'])
			    			$("#cartSubTotal").text('$'+cart['ExtVatTotalAmount']);
			    		}else{
			    			$("#itemCounts").text('0 Item(s).');
			    			$("#cartHeaderCount").text('0');
			    			$("#cartCount").val('0')
			    			$("#cartSubTotal").text('$0.00');
			    		}

			    	   	if(list != null && list != ''){

			    	   		for(var i=0; i<list.length; i++){

			    	   			 	html +='<div class="media w-100 py-2" id="cartItemDiv-'+list[i]['CART_LINE_ID']+'">';
			    		         	html +='<div class="mr-3 w-110px">';
			    		         	html +='<img src="'+list[i]['primaryImage']+'" alt="High Ankle Jeans" class="border">';
			    		         	html +='</div>';
			    		         	html +='<div class="media-body">';
			    		         	html +='<a href="javascript:;" class="card-title font-weight-500">'+list[i]['productName']+'<i class="fa fa-info-circle p-1" onclick="getProductShadesRightSideBar('+list[i]['CART_LINE_ID']+')" data-toggle="tooltip" title="" data-placement="top" data-original-title="View Product Shades"></i></a>';
			    		         	html +='<p class="card-text mb-2 text-primary">$'+list[i]['UNIT_PRICE']+'</p>';
			    		         	html +='<div class="d-flex align-items-center">';
			    		         	html +='<div class="input-group position-relative w-100px bg-input rounded rounded">';
			    		         	//html +='<a href="javascript:;" disabled class="down position-absolute pos-fixed-left-center pl-2 z-index-2">';
			    		         	//html +='<i class="far fa-minus"></i>';
			    		         	//html +='</a>';
			    		         	html +='<input name="number[]" disabled type="number" class="form-control form-control-sm w-100 px-6 fs-16 text-center input-quality bg-transparent h-35px border-0" value="'+list[i]['QUANTITY']+'" required>';
			    		         	//html +='<a href="javascript:;" disabled class="up position-absolute pos-fixed-right-center pr-2 z-index-2">';
			    		         	//html +='<i class="far fa-plus"></i> ';
			    		         	//html +='</a>';
			    		         	html +='</div>';

			    		         	html +='</div>';
//				    		         	html +='<a href="javascript:;" class="text-decoration-underline fs-14 opacity-8 d-inline-block">Save Item </a>&nbsp;&nbsp;';
			    		         	html +='<a href="javascript:;" class="text-decoration-underline fs-14 opacity-8 d-inline-block removeItemCart" data-id="'+list[i]['CART_LINE_ID']+'" data-cartId="'+list[i]['CART_ID']+'">Remove Item</a>';

			    		         	html +='</div>';
			    		         	html +='</div>';
			    	   		}
			    	   	}

			        	$("#cartRightMenuListingHTML").html(html);

					}else{
						toastr.error(data.msg, '', {timeOut: 3000});

						if(data.flag == 0){
							setTimeout(function(){
								window.location.href= data.redirectURL;
							}, 3000);

							localStorage.setItem("productId", productId);

						}
					}


		        	setTimeout(function(){
							$.LoadingOverlay("hide");
					}, 500);
		        }
		    });
	}

	});

	$(document).on("click", ".removeItemCart", function () {

	var cartLineId = $(this).attr("data-id");
	var cartId = $(this).attr("data-cartId");
	$.LoadingOverlay("show");

	var token = $("#csrf").val();

	var form_data = new FormData();
		form_data.append("userId", userId);
		form_data.append("cartId", cartId);
		form_data.append("cartLineId", cartLineId);

		form_data.append("_token", token);
	 	$.ajax({
	        url: site+"/removeCartItem",
	        type: "POST",
	        data: form_data,
	        cache: false,
	        contentType: false,
	        processData: false,
	        success: function(data){
	        	var data = JSON.parse(data);

	        	var cart = data.cart;
	        	var list = data.cartDetails;
	        	var html = '';

	        	$("#cartRightMenuListingHTML").html('');

	    		if(cart != null && cart != ''){
	    			$("#itemCounts").text(cart['cartCount']+' Item(s).');
	    			$("#cartHeaderCount").text(cart['cartCount']);
	    			$("#cartCount").val(cart['cartCount'])
	    			$("#cartSubTotal").text('$'+cart['ExtVatTotalAmount']);
	    		}else{
	    			$("#itemCounts").text('0 Item(s).');
	    			$("#cartHeaderCount").text('0');
	    			$("#cartCount").val('0')
	    			$("#cartSubTotal").text('$0.00');
	    		}

	    	   	if(list != null && list != ''){
	    	   		for(var i=0; i<list.length; i++){

		   			 	html +='<div class="media w-100 py-2" id="cartItemDiv-'+list[i]['CART_LINE_ID']+'">';
			         	html +='<div class="mr-3 w-110px">';
			         	html +='<img src="'+list[i]['primaryImage']+'" alt="High Ankle Jeans" class="border">';
			         	html +='</div>';
			         	html +='<div class="media-body">';
			         	html +='<a href="javascript:;" class="card-title font-weight-500">'+list[i]['productName']+'<i class="fa fa-info-circle p-1" onclick="getProductShadesRightSideBar('+list[i]['CART_LINE_ID']+')" data-toggle="tooltip" title="" data-placement="top" data-original-title="View Product Shades"></i></a>';
			         	html +='<p class="card-text mb-2 text-primary">$'+list[i]['UNIT_PRICE']+'</p>';
			         	html +='<div class="d-flex align-items-center">';
			         	html +='<div class="input-group position-relative w-100px bg-input rounded rounded">';
			         	//html +='<a href="javascript:;" disabled class="down position-absolute pos-fixed-left-center pl-2 z-index-2">';
			         	//html +='<i class="far fa-minus"></i>';
			         	//html +='</a>';
			         	html +='<input name="number[]" disabled type="number" class="form-control form-control-sm w-100 px-6 fs-16 text-center input-quality bg-transparent h-35px border-0" value="'+list[i]['QUANTITY']+'" required>';
			         	//html +='<a href="javascript:;" disabled class="up position-absolute pos-fixed-right-center pr-2 z-index-2">';
			         	//html +='<i class="far fa-plus"></i> ';
			         	//html +='</a>';
			         	html +='</div>';

			         	html +='</div>';
//	    		         	html +='<a href="javascript:;" class="text-decoration-underline fs-14 opacity-8 d-inline-block">Save Item </a>&nbsp;&nbsp;';
			         	html +='<a href="javascript:;" class="text-decoration-underline fs-14 opacity-8 d-inline-block removeItemCart" data-id="'+list[i]['CART_LINE_ID']+'" data-cartId="'+list[i]['CART_ID']+'">Remove Item</a>';

			         	html +='</div>';
			         	html +='</div>';
	    	   		}
	    	   	}
	        	$("#cartRightMenuListingHTML").html(html);

	        	setTimeout(function(){
						$.LoadingOverlay("hide");
				}, 500);
	        }
	    });


	});

	function loadCart(){

	var token = $("#csrf").val();

	var form_data = new FormData();
		form_data.append("userId", userId);
		form_data.append("cartId", cartId);

		form_data.append("_token", token);
	 	$.ajax({
	        url: site+"/loadCart",
	        type: "POST",
	        data: form_data,
	        cache: false,
	        contentType: false,
	        processData: false,
	        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
	        success: function(data){
	        	var data = JSON.parse(data);

	        	var cart = data.cart;
	        	var list = data.cartDetails;
	        	var wishlistCount = data.wishlistCount;

	        	$("#wishlistHeaderCount").text(wishlistCount);
	        	$("#wishlistHeaderCountMbl").text(wishlistCount);

	        	var html = '';

	        	$("#cartRightMenuListingHTML").html('');

	    		if(cart != null && cart != ''){
	    			$("#itemCounts").text(cart['cartCount']+' Item(s).');
	    			$("#cartHeaderCount").text(cart['cartCount']);
	    			$("#cartCount").val(cart['cartCount'])
	    			$("#cartSubTotal").text('$'+cart['ExtVatTotalAmount']);
	    		}else{
	    			$("#itemCounts").text('0 Item(s).');
	    			$("#cartHeaderCount").text('0');
	    			$("#cartCount").val('0')
	    			$("#cartSubTotal").text('$0.00');
	    		}

	    	   	if(list != null && list != ''){

	    	   		for(var i=0; i<list.length; i++){

		   			 	html +='<div class="media w-100 py-2" id="cartItemDiv-'+list[i]['CART_LINE_ID']+'">';
			         	html +='<div class="mr-3 w-110px">';
			         	html +='<img src="'+list[i]['primaryImage']+'" style="height:100px" alt="High Ankle Jeans" class="border">';
			         	html +='</div>';
			         	html +='<div class="media-body">';
			         	html +='<a href="javascript:;" class="card-title font-weight-500">'+list[i]['productName']+'<i class="fa fa-info-circle p-1" onclick="getProductShadesRightSideBar('+list[i]['CART_LINE_ID']+')" data-toggle="tooltip" title="" data-placement="top" data-original-title="View Product Shades"></i></a>';
			         	html +='<p class="card-text mb-2 text-primary">$'+list[i]['UNIT_PRICE']+'</p>';
			         	html +='<div class="d-flex align-items-center">';
			         	html +='<div class="input-group position-relative w-100px bg-input rounded rounded">';
			         	//html +='<a href="javascript:;" disabled class="down position-absolute pos-fixed-left-center pl-2 z-index-2">';
			         	//html +='<i class="far fa-minus"></i>';
			         	//html +='</a>';
			         	html +='<input name="number[]" disabled type="number" class="form-control form-control-sm w-100 px-6 fs-16 text-center input-quality bg-transparent h-35px border-0" value="'+list[i]['QUANTITY']+'" required>';
			         	//html +='<a href="javascript:;" disabled class="up position-absolute pos-fixed-right-center pr-2 z-index-2">';
			         	//html +='<i class="far fa-plus"></i> ';
			         	//html +='</a>';
			         	html +='</div>';

			         	html +='</div>';
//	    		         	html +='<a href="javascript:;" class="text-decoration-underline fs-14 opacity-8 d-inline-block">Save Item </a>&nbsp;&nbsp;';
			         	html +='<a href="javascript:;" class="text-decoration-underline fs-14 opacity-8 d-inline-block removeItemCart" data-id="'+list[i]['CART_LINE_ID']+'" data-cartId="'+list[i]['CART_ID']+'">Remove Item</a>';

			         	html +='</div>';
			         	html +='</div>';
	    	   		}
	    	   	}
	        	$("#cartRightMenuListingHTML").html(html);
	        }
	    });
	}
	loadCart();

	function getProductShadesRightSideBar(cartLineId){
		$.LoadingOverlay("show");
		var token = $("#csrf").val();

		var form_data = new FormData();

		form_data.append("cartLineId", cartLineId);
		form_data.append("_token", token);

		$.ajax({
	        url: site+"/getProductShadesRightSideBar",
	        type: "POST",
	        data: form_data,
	        cache: false,
	        contentType: false,
	        processData: false,
	        success: function(data){
	        	var data = JSON.parse(data);
				console.log(data);
	        	var list = data.shadename;
				var html = '';

	    	   	if(list != null && list != ''){

	    	   		for(var i=0; i<list.length; i++){
	    	   			html+=`<tr>
									<td class="center">`+list[i]['PRODUCT_NAME']+`</td>
									<td class="center">`+list[i]['SHADE_NAME']+`</td>
						   		</tr>`;

	    	   		}
	    	   	}else{
					html+=`<tr>
							<td class="mt-1">No Shade Found...</td>
							<td class="mt-1"></td>
						   </tr>`;
				}

	        	$("#showShadeName").html(html);
				$("#show_shade_modal_sidebar").modal('show');
				$(".cart-canvas").removeClass('show');
				setTimeout(function(){
					$.LoadingOverlay("hide");
				}, 500);

	        }
	    });

	}
	function closeSideBarShadeModal(){
		$("#show_shade_modal_sidebar").modal('hide');
		$(".cart-canvas").addClass('show');
	}

	$(document).on("click", ".checkout-btn", function () {

	if($("#cartCount").val() > 0){
		window.location = checkoutUrl;
	}else{
		toastr.error('First add product then go to cart...', '', {timeOut: 3000})
	}
	});

	$(document).on("click", ".addto-wishlist", function () {

	var productId = $(this).attr("data-productId");
	var productType = $(this).attr("data-type");

	$.LoadingOverlay("show");

	var token = $("#csrf").val();

	var form_data = new FormData();
		form_data.append("userId", userId);
		form_data.append("productId", productId);
		form_data.append("productType", productType);

		form_data.append("_token", token);
	 	$.ajax({
	        url: site+"/addProductToWishlist",
	        type: "POST",
	        data: form_data,
	        cache: false,
	        contentType: false,
	        processData: false,
	        success: function(data){
	        	var data = JSON.parse(data);

	        	if(data.done == true || data.done == 'true'){

					toastr.success(data.msg, '', {timeOut: 3000})

					var wishlistCount = data.wishlistCount;

					$("#wishlistHeaderCount").text(wishlistCount);
					$("#wishlistHeaderCountMbl").text(wishlistCount);

					if(data.flag == 'add'){
						$('.wish_'+productId).addClass('activeWish');
					}else{
						$('.wish_'+productId).removeClass('activeWish');
					}


				}else{
					toastr.error(data.msg, '', {timeOut: 3000});

					if(data.flag == 0){
						setTimeout(function(){
							//redirect to login
							window.location.href= data.redirectURL;
						}, 3000);

						localStorage.setItem("wishlistproductId", productId);

					}
				}

	        	setTimeout(function(){
						$.LoadingOverlay("hide");
				}, 500);
	        }
	    });


	});


	function footerEmailSubscription(){

		var email = $("#footerEmailSubs").val();
		var phone = $("#footerPhoneSubs").val();


		if(email == ''){
			toastr.error("Email is required", '', {timeOut: 3000}); return;
		}
        var isValidEmail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email);
		if (!isValidEmail) {
			toastr.error("Enter valid email address.", '', {timeOut: 3000}); return;
		}
		if(phone == ''){
			toastr.error("Phone Number is required", '', {timeOut: 3000}); return;
		}
        var phoneNumber = phone;
        if (phoneNumber.length < 11 || phoneNumber.length > 14) {
            toastr.error('Phone number should be between 11 and 14 digits.', '', {timeOut: 3000});
            return; // Exit the function if phone number is invalid
        }



		$.LoadingOverlay("show");

		var token = $("#csrf").val();

		var form_data = new FormData();
			form_data.append("userId", userId);
			form_data.append("email", email);
			form_data.append("phone", phone);

			form_data.append("_token", token);
		 	$.ajax({
		        url: site+"/addFooterEmailSubscription",
		        type: "POST",
		        data: form_data,
		        cache: false,
		        contentType: false,
		        processData: false,
		        success: function(data){
		        	var data = JSON.parse(data);

		        	if(data.done == true || data.done == 'true'){

						toastr.success(data.msg, '', {timeOut: 3000})

						$("#footerEmailSubs").val('');
						$("#footerPhoneSubs").val('');

					}else{
						toastr.error(data.msg, '', {timeOut: 3000})
					}

		        	setTimeout(function(){
							$.LoadingOverlay("hide");
					}, 500);
		        }
		    });


			$( document ).ready(function() {
				// for product counter
				$('.down').on('click', function(e) {
					console.log('down')
					e.preventDefault();
					var $parent = $(this).parent('.input-group');
					var $input = $parent.find('input');
					var $value = parseInt($input.val());
					if ($value > 0) {
						$value -= 1;
						$input.val($value);
					}
				});
				$('.up').on('click', function(e) {
					console.log('up')

					e.preventDefault();
					var $parent = $(this).parent('.input-group');
					var $input = $parent.find('input');
					var $value = $input.val();
					if ($value !== '') {
						$value = parseInt($value);
						$value += 1;
						$input.val($value);
					} else {
						$input.val(1);
					}
				});
			});
	}

	var onLoginPage = (window.location.href.indexOf("user-login") > -1);

	if (!onLoginPage && userId != '') {

		var productid = localStorage.getItem("productId");

		if(productid != '' && productid != null){

			quickAdd(productid);
			productid = localStorage.setItem("productId","");

		}

		var wishlistproductId = localStorage.getItem("wishlistproductId");

		if(wishlistproductId != '' && wishlistproductId != null){

			quickAddWishList(wishlistproductId);
			wishlistproductId = localStorage.setItem("wishlistproductId","");

		}
	}


