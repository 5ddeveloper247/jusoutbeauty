 <?php //print_r('<pre>');
	// print_r($categoryName);
	// exit();
    // dd('ehllo');
    $userId = session('userId');
	?>
     {{-- @dd('Working') --}}
 @include('web.web-header')
 <script>


 	var site = '<?php echo session('site'); ?>';
 	//var sourceId = "<?php //echo isset($sourceId) ? $sourceId : ''; ?>";
 	//var flag = "<?php //echo isset($flag) ? $flag : ''; ?>";
 	//var categoryName = "<?php //echo isset($categoryName['NAME']) ? $categoryName['NAME'] : 'Store'; ?>"
 	//var subCategoryName = "<?php //echo isset($subCategoryName['NAME']) ? $subCategoryName['NAME'] : ''; ?>
 </script>
 <style>
 	.filter-sidebarr {
 		-webkit-transition: all 0.5s ease;
 		-moz-transition: all 0.5s ease;
 		-o-transition: all 0.5s ease;
 		transition: all 0.5s ease;
 	}

 	.quick_view_product_image {
 		width: 250px;
 		height: 250px;
 		margin: 0px auto;
 		display: flex;
 	}

 	.image_hide {
 		display: none !important;
 	}

 	/* body.modal-open {
 		overflow: hidden;
 		position: fixed;
 	} */

 	/* .shade-active{ */
 	/* 	border: 1px solid black; */
 	/*     padding-bottom: 2vw; */
 	/* } */
 	/* .widget-color .item:before { */
 	/*     content: ''; */
 	/*     width: 29px; */
 	/*     height: 27px; */
 	/*     display: block; */
 	/*     position: absolute; */
 	/* /*     left: -4px; */
 	*/
 	/* /*     top: -4px; */
 	*/
 	/*     border-radius: 50%; */
 	/*     opacity: 0; */
 	/*     -webkit-transform: scale(1.2); */
 	/*     transform: scale(1.2); */
 	/*     transition: all .3s linear; */
 	/*     border: 1px solid #000; */
 	/* } */
 	/* .shade-active{ */
 	/* /* 	border: 1px solid black; */
 	*/
 	/* /*     padding-bottom: 2vw; */
 	*/
 	/*     content: ''; */
 	/*     width: 28px !important; */
 	/*     height: 28px !important; */
 	/*     display: block; */
 	/*     position: absolute; */
 	/* /*     left: -4px; */
 	*/
 	/* /*     top: -4px; */
 	*/
 	/*     border-radius: 50%; */
 	/* /*     opacity: 0; */
 	*/
 	/*     -webkit-transform: scale(1.2); */
 	/*     transform: scale(1.2); */
 	/*     transition: all .3s linear; */
 	/*     border: 1px solid #000; */
 	/* } */

 	.widget-color .item:before {
 		content: '';
 		/* width: 29px; */
 		/* height: 27px; */
 		display: block;
 		position: absolute;
 		left: -1px;
 		top: -1px;
 		border-radius: 50%;
 		opacity: 0;
 		-webkit-transform: scale(1.2);
 		transform: scale(1.2);
 		transition: all .3s linear;
 		border: 1px solid #000;
 		padding: 11px !important;
 	}

 	.shade-active:before {
 		left: -1px !important;
 		top: -1px !important;
 	}

 	.shade-active {
 		padding: 2px;
 		/* border: 1px solid black; */
 		/* padding-bottom: 2vw; */
 		content: '';
 		width: 32px !important;
 		height: 32px !important;
 		display: block;
 		position: absolute;
 		/* left: -4px; */
 		/* top: -4px; */
 		border-radius: 50%;
 		/* opacity: 0; */
 		-webkit-transform: scale(1.2);
 		transform: scale(1.2);
 		transition: all .3s linear;
 		border: 1px solid #000;
 	}

 	.shop-subtitle {
 		height: 3rem
 	}

 	.all-products {
 		height: 22rem
 	}

 	@media screen and (min-width: 0px) and (max-width: 614px) {
 		.w-45px {
 			width: 35px !important
 		}

 		.h-45px {
 			height: 35px !important;
 		}

 		#qckad {
 			font-size: .8rem;
 		}

 		.shop-subtitle {
 			height: unset
 		}

 		.all-products {
 			height: 12rem
 		}

 		.hero-section {
 			margin-top: 5.5rem !important
 		}

 		.product-heading {
 			white-space: nowrap;
 			overflow: hidden;
 			text-overflow: ellipsis;
 		}

 		.product-subtitle {
 			height: 50px;
 			/* white-space: nowrap; */
 			overflow: hidden;
 			text-overflow: ellipsis;
 		}
 	}
 </style>
 {{-- @dd('after style tag') --}}
 <main ng-app="project1">
 	<section class="py-10 mt-15 bg-gray-1 hero-section">
 		<div class="container">
 			<h2 class="mb-2 text-center" data-animate= "fadeInRight" style="color: white; font-size: 100px"><?php echo isset($categoryName['NAME']) ? $categoryName['NAME'] : 'Store'; ?></h2>
 			<nav aria-label="breadcrumb">
 				<ol class="breadcrumb breadcrumb-site py-0 d-flex justify-content-center fs-15 mb-3">
 					<li class="breadcrumb-item"><a class="text-decoration-none" href="{{session('site')}}/home" style="color: white; font-size: 30px">Home</a></li>
 					<li class="breadcrumb-item d-flex align-items-center"><a class="text-decoration-none" style="color: white; font-size: 30px">Shop All</a>
 					</li>
 				</ol>
 			</nav>
 		</div>
 	</section>

 	<section class="pb-6 pr-4 pl-4 inc_sec" ng-controller="projectinfo1">
 		<div class="container container-custom p-0">
 			<div class="row no-gutters shop-listing-page-filter">
 				<div class="col-xl-3 pr-md-3 pr-lg-9 primary-sidebar sidebar-sticky filter-sidebarr" id="sidebar" style="display: none">
 					<div class="primary-sidebar-inner">
 						<h2 class="fs-34 mb-6">Filter</h2>

 						<div class="card border-0 mb-7">
 							<div class="card-header bg-transparent border-0 p-0">
 								<h3 class="card-title fs-18 font-weight-500 mb-0">Categories</h3>
 							</div>
 							<div class="card-body px-0 pt-2 pb-0">
 								<ul class="list-unstyled mb-0">

 									<li class="mb-1 d-flex" id="categoryFilter_@{{row.SUB_SUB_CATEGORY_ID}}" ng-repeat="row in displayCollectionSubCategoryFilter">
 										<input type="checkbox" class="category-filter mr-1" id="categoryFilterInput_@{{row.SUB_SUB_CATEGORY_ID}}" value="@{{row.SUB_SUB_CATEGORY_ID}}" ng-click="filter();">
 										<label for="categoryFilterInput_@{{row.SUB_SUB_CATEGORY_ID}}" data-toggle="tooltip" data-placement="top" title="@{{row.CATEGORY_NAME}}/@{{row.SUB_CATEGORY_NAME}}/@{{row.NAME}}" style="white-space: nowrap;overflow: hidden;text-overflow: ellipsis;margin-top: 6px;"> @{{row.CATEGORY_NAME}}/@{{row.NAME}}</label>
 									</li>

 									<li class="mb-1 text-center" id="" ng-click="loadMoreSubCategoriesFilter();" ng-show="hideLoadMore == '0'">
 										<label style="white-space: nowrap;overflow: hidden;text-overflow: ellipsis;margin-top: 6px;"> Load More...</label>
 									</li>

 								</ul>
 							</div>
 						</div>
 						<div class="card border-0 widget-color mb-7" ng-if="catFlag != 'Bundle'">
 							<div class="card-header bg-transparent border-0 p-0">
 								<h3 class="card-title fs-20 mb-0">Color Shade</h3>
 							</div>
 							<div class="card-body px-0 pt-4 pb-0">
 								<ul class="list-inline mb-0">
 									<li class="list-inline-item mr-2 mt-2" ng-repeat="row in displayCollectionShadeFilter" title="@{{row.TITLE}}">
 										<a href="javascript:;" class="d-block item shade_filter" ng-click="shadeFilter(@{{row.SHADE_ID}});">
 											<img class="item shop-shade" src="@{{row.primaryImage}}" alt="alt">
 										</a>
 									</li>
 									<!-- <li class="list-inline-item"><a href="#" class="d-block item"
									style="background-color: #68412d;"></a></li> -->
 								</ul>
 							</div>
 						</div>
 						<div class="card border-0 mb-7">
 							<div class="card-header bg-transparent border-0 p-0">
 								<h3 class="card-title fs-18 font-weight-500 mb-0">Price</h3>
 							</div>
 							<div class="card-body px-0 pt-2 pb-0">
 								<ul class="list-unstyled mb-0">
 									<li class="mb-1">
 										<input type="radio" id="allPricing" name="price" value="all" ng-click="filter();" checked>
 										<label for="allPricing"> All</label>
 									</li>

 									<li class="mb-1">
 										<input type="radio" id="price1" name="price" value="10-100" ng-click="filter();">
 										<label for="price1"> $10 - $100</label>
 									</li>

 									<li class="mb-1">
 										<input type="radio" id="price2" name="price" value="101-200" ng-click="filter();">
 										<label for="price2"> $101 - $200</label>
 									</li>

 									<li class="mb-1">
 										<input type="radio" id="price3" name="price" value="201-300" ng-click="filter();">
 										<label for="price3"> $201 - $300</label>
 									</li>
 									<li class="mb-1">
 										<input type="radio" id="price4" name="price" value="301-500" ng-click="filter();">
 										<label for="price4"> $301 - $500</label>
 									</li>
 									<li class="mb-1">
 										<input type="radio" id="price5" name="price" value="501-1000" ng-click="filter();">
 										<label for="price5"> $501 - $1000</label>
 									</li>

 								</ul>
 							</div>
 						</div>
 						<div class="col-12 pl-0">
 							<a type="button" class="btn btn-white btn-block bg-hover-primary border-hover-primary hover-white" ng-click="resetFilter();">Reset Filter</a>
 						</div>
 					</div>
 				</div>
                {{-- @dd('Working'); --}}
 				<div class="col-xl-12 shop-listing-right-portion">
 					<div class="row">
 						<div class="col-sm-12 mb-4 mb-sm-0 pb-3 sort_inc_shop">
 							<div class="d-flex align-items-center d-xl-none text-primary font-weight-500 mr-6" data-canvas="true" data-canvas-options='{"container":".filter-canvas"}'>
 								Filter
 								<span class="d-inline-block ml-1">
 									<i class="fal fa-angle-down"></i>
 								</span>
 							</div>
 							<div class="dropdown filter-textt">
 								<a href="#" class="font-weight-500" id="filtersiderbar-leftn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
 									Show Filter
 									<svg width="22" height="16" viewBox="0 0 22 16" xmlns="http://www.w3.org/2000/svg">
 										<g id="icon-filter" fill-rule="nonzero" fill="none">
 											<rect fill="#D8D8D8" y="2" width="22" height="2" rx="1"></rect>
 											<rect fill="#D8D8D8" y="12" width="22" height="2" rx="1"></rect>
 											<circle fill="#373737" cx="15.5" cy="13" r="2.5"></circle>
 											<circle fill="#373737" cx="6.5" cy="3" r="2.5"></circle>
 										</g>
 									</svg>
 								</a>
 								<a href="#" class="font-weight-500" id="filtersiderbar-close" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="display: none;">
 									Hide Filter
 									<svg width="22" height="16" viewBox="0 0 22 16" xmlns="http://www.w3.org/2000/svg">
 										<g id="icon-filter" fill-rule="nonzero" fill="none">
 											<rect fill="#D8D8D8" y="2" width="22" height="2" rx="1"></rect>
 											<rect fill="#D8D8D8" y="12" width="22" height="2" rx="1"></rect>
 											<circle fill="#373737" cx="15.5" cy="13" r="2.5"></circle>
 											<circle fill="#373737" cx="6.5" cy="3" r="2.5"></circle>
 										</g>
 									</svg>
 								</a>

 							</div>
 							&nbsp;&nbsp;&nbsp;
 							<div class="dropdown">
 								<a href="#" class="dropdown-toggle font-weight-500" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Default Sorting </a>
 								<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton" style="">
 									<a class="dropdown-item text-primary fs-14" href="javascript:;" ng-click="sortingFilter(1);">Price high to low</a>
 									<a class="dropdown-item text-primary fs-14" href="javascript:;" ng-click="sortingFilter(2);">Price low to high</a>
 									<a class="dropdown-item text-primary fs-14" href="javascript:;" ng-click="sortingFilter(3);">Random</a>
 								</div>
 							</div>
 						</div>
 					</div>
 					<div class="row">
                        <div ng-init="productsToShow = 8"></div>
                        <div class="col-6 col-lg-3 product productshop-listing mb-8" ng-repeat="row in displayCollectionProducts.slice(0, productsToShow)">
                            <div class="card border-0">
 								<div class="position-relative hover-zoom-in">
 									<a href="javascript:;" class="d-block overflow-hidden productdetail" data-id="@{{row.PRODUCT_ID}}" data-category="@{{ row.CATEGORY_SLUG }}" data-subCategory="@{{ row.SUB_CATEGORY_SLUG }}" data-name="@{{ row.SLUG }}" data-type="@{{catFlag}}">
 										<img src="@{{row.primaryImage}}" alt="@{{ row.NAME }}" class="card-img-top all-products img-h60 img-h30-m image-active">
 										<img src="@{{row.primaryImage}}" alt="@{{ row.NAME }}" class="card-img-top all-products img-h60 image-hover">
 									</a>
 									<div class="position-absolute pos-fixed-top-right d-inline-flex p-4 flex-column z-index-10 "><!-- productdetail data-id="@{{row.PRODUCT_ID}}"-->
 										<div class="content-change-vertical d-flex flex-column ml-auto">

 											<a href="javascript:;" data-toggle="tooltip" data-placement="left" title="Add to wish list" class="add-to-wishlist d-flex align-items-center justify-content-center bgiconcolor w-45px h-45px rounded-circle mb-2 addto-wishlist" data-productId='@{{row.PRODUCT_ID}}' data-type='@{{productType}}'>
 												<i class="icon fas fa-star wish_@{{row.PRODUCT_ID}} @{{row.wishlistFlag == '1' ? 'activeWish' : ''}}"></i>
 											</a>
 											<a href="javascript:;" data-toggle="tooltip" data-placement="left" title="Quick view" ng-click="quickViewProductDetails(@{{row.PRODUCT_ID}})" class="preview d-flex align-items-center justify-content-center bgiconcolor w-45px h-45px rounded-circle">
 												<i class="icon fal fa-eye"></i>
 											</a>
 										</div>
 									</div>
 									<div class="position-absolute pos-fixed-bottom pb-4 px-4 w-100">
 										<a href="javascript:;" class="btn btn-white btn-block bg-hover-primary border-hover-primary hover-white @if(isset($userId)) productdetail @else addto-cart1 @endif" id="qckad" data-id="@{{row.PRODUCT_ID}}" data-category="@{{ row.CATEGORY_SLUG }}" data-subCategory="@{{ row.SUB_CATEGORY_SLUG }}" data-name="@{{ row.SLUG }}" data-type="@{{catFlag}}" ng-if="row.INV_QUANTITY_FLAG == 'shade' || row.INV_QUANTITY_FLAG == 'bundle'">+ Quick Add</a>
 										<a href="javascript:;" class="btn btn-white btn-block bg-hover-primary border-hover-primary hover-white addto-cart1" id="qckad" data-type="@{{productType}}" data-id="@{{row.PRODUCT_ID}}" data-quantity='1' ng-if="row.INV_QUANTITY_FLAG == 'inv' && row.INV_QUANTITY > '0'">+ Quick Add</a>
 										<a href="javascript:;" class="btn btn-white btn-block bg-hover-primary border-hover-primary hover-white" id="qckad" ng-if="row.INV_QUANTITY_FLAG == 'inv' && row.INV_QUANTITY <= '0'" disabled>+ Out of Stock</a>
 									</div>
 								</div>
 								<div class="card-body pt-4 px-0 pb-0">
 									<a href="javascript:;" class="text-muted fs-12 font-weight-500 text-uppercase mb-1 card-title lh-14 hover-primary" data-id="@{{ row.CATEGORY_ID }}" data-type="CATEGORY" data-categoryslug="@{{row.CATEGORY_SLUG}}"> @{{row.CATEGORY_NAME}} </a>

 									<h3 class="card-title fs-16 font-weight-500 mb-1 lh-14375 product-heading">
 										<a href="javascript:;" class="productdetail" data-id="@{{row.PRODUCT_ID}}" data-category="@{{row.CATEGORY_SLUG}}" data-subCategory="@{{row.SUB_CATEGORY_SLUG}}" data-name="@{{row.SLUG}}" data-type="@{{catFlag}}">@{{row.NAME}}</a>
 									</h3>
 									<p class="text-primary mb-0 shop-subtitle card-title lh-14375 product-subtitle">@{{row.SUB_TITLE_TXT}}</p>

 									<div class="row">
 										<div class="col-sm-6 col-7">
 											<p class="text-primary mb-0 card-title lh-14375"> <span>$@{{row.UNIT_PRICE}}</span> </p>
 										</div>
 										<div class="col-sm-6 col-5">
 											<p class="text-primary mb-0 card-title lh-14375 text-right text-right-sm ellipsis">@{{row.UNIT}}</p>
 										</div>
 									</div>
 								</div>
 							</div>
 						</div>
 						<div class="col-12 col-lg-12" ng-if="displayCollectionProducts.length == 0 || displayCollectionProducts.length == undefined">
 							<p class="text-center">No record found...</p>
 						</div>
                         <div class="col-12 col-lg-12 text-center mt-4" ng-show="displayCollectionProducts.length > productsToShow">
                            <button class="btn btn-primary btn-sm" ng-click="loadMoreProducts()">Load More</button>
                          </div>
 						{{-- <div class="col-6 col-lg-3 product productshop-listing mb-8" ng-repeat="row in displayCollectionProducts">
 							<div class="card border-0">
 								<div class="position-relative hover-zoom-in">
 									<a href="javascript:;" class="d-block overflow-hidden productdetail" data-id="@{{row.PRODUCT_ID}}" data-type="@{{catFlag}}">
 										<img src="@{{row.primaryImage}}" alt="Product 01" class="card-img-top all-products img-h60 img-h30-m image-active">
 										<img src="@{{row.secondaryImage}}" alt="Product 01" class="card-img-top all-products img-h60 image-hover">
 									</a>
 									<div class="position-absolute pos-fixed-top-right d-inline-flex p-4 flex-column z-index-10 "><!-- productdetail data-id="@{{row.PRODUCT_ID}}"-->
 										<div class="content-change-vertical d-flex flex-column ml-auto">

 											<a href="javascript:;" data-toggle="tooltip" data-placement="left" title="Add to wish list" class="add-to-wishlist d-flex align-items-center justify-content-center text-primary bg-white hover-white bg-hover-primary w-45px h-45px rounded-circle mb-2 addto-wishlist" data-productId='@{{row.PRODUCT_ID}}' data-type='@{{productType}}'>
 												<i class="fas fa-star wish_@{{row.PRODUCT_ID}} @{{row.wishlistFlag == '1' ? 'activeWish' : ''}}"></i>
 											</a>
 											<a href="javascript:;" data-toggle="tooltip" data-placement="left" title="Quick view" ng-click="quickViewProductDetails(@{{row.PRODUCT_ID}})" class="preview d-flex align-items-center justify-content-center text-primary bg-white hover-white bg-hover-primary w-45px h-45px rounded-circle">
 												<i class="fal fa-eye"></i>
 											</a>
 										</div>
 									</div>
 									<div class="position-absolute pos-fixed-bottom pb-4 px-4 w-100">
										<a href="javascript:;" class="btn btn-white btn-block bg-hover-primary border-hover-primary hover-white productdetail" id="qckad" data-id="@{{row.PRODUCT_ID}}" data-type="@{{catFlag}}" ng-if="row.INV_QUANTITY_FLAG == 'shade' || row.INV_QUANTITY_FLAG == 'bundle'">+ Quick Add</a>
 										<a href="javascript:;" class="btn btn-white btn-block bg-hover-primary border-hover-primary hover-white addto-cart1" id="qckad" data-type="@{{productType}}" data-id="@{{row.PRODUCT_ID}}" data-quantity='1' ng-if="row.INV_QUANTITY_FLAG == 'inv' && row.INV_QUANTITY > '0'">+ Quick Add</a>
										<a href="javascript:;" class="btn btn-white btn-block bg-hover-primary border-hover-primary hover-white" id="qckad" ng-if="row.INV_QUANTITY_FLAG == 'inv' && row.INV_QUANTITY <= '0'" disabled>+ Out of Stock</a>
 									</div>
 								</div>
 								<div class="card-body pt-4 px-0 pb-0 productdetail" data-id="@{{row.PRODUCT_ID}}" data-type="@{{catFlag}}">
 									<a href="javascript:;" class="text-muted fs-12 font-weight-500 text-uppercase mb-1 card-title lh-14 hover-primary"> @{{row.CATEGORY_NAME}} </a>

 									<h3 class="card-title fs-16 font-weight-500 mb-1 lh-14375 product-heading">
 										<a href="javascript:;">@{{row.NAME}}</a>
 									</h3>
 									<p class="text-primary mb-0 shop-subtitle card-title lh-14375 product-subtitle">@{{row.SUB_TITLE_TXT}}</p>

 									<div class="row">
 										<div class="col-sm-6 col-7">
 											<p class="text-primary mb-0 card-title lh-14375"> <span>$@{{row.UNIT_PRICE}}</span> </p>
 										</div>
 										<div class="col-sm-6 col-5">
 											<p class="text-primary mb-0 card-title lh-14375 text-right text-right-sm ellipsis">@{{row.UNIT}}</p>
 										</div>
 									</div>
 								</div>
 							</div>
 						</div>
 						<div class="col-12 col-lg-12" ng-if="displayCollectionProducts.length == 0 || displayCollectionProducts.length == undefined">
 							<p class="text-center">No record found...</p>
 						</div> --}}

 						<div class="modal fade quick-view " id="productQuickView" tabindex="-1" aria-hidden="true">
 							<div class="modal-dialog quick_view_mbl modal-dialog-scrollable">
 								<div class="modal-content p-0 quick_view_mbl_carousel_modal">
 									<div class="modal-body p-0">
 										<button type="button" class="close fs-32 position-absolute pos-fixed-top-right z-index-10" data-dismiss="modal" aria-label="Close">
 											<span aria-hidden="true" class="fs-20">
 												<i class="fal fa-times text-dark"></i>
 											</span>
 										</button>
 										<div class="row no-gutters" id="quick_view_product_details">
 											<div class="col-sm-6">

 												<div id="carouselExampleControls" class="carousel slide quick_view_mbl_carousel" data-ride="carousel" data-interval="2000">
 													<div class="carousel-inner" ng-show="productImagesLoop != ''">
 														<div class="carousel-item @{{$first == '1' ? 'active' : ''}}" ng-repeat="row in productImagesLoop">
 															<img class="d-block w-100 quick_view_mbl_carousel_img" style="height:35rem" src="@{{row.downPath}}" alt="First slide">
 														</div>
 													</div>
 													<div class="carousel-inner" ng-show="productImagesBundle != ''">
 														<div class="carousel-item active" >
 															<img class="d-block w-100 quick_view_mbl_carousel_img" style="height:35rem" src="@{{productImagesBundle}}" alt="First slide">
 														</div>
 													</div>
 													<a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
 														<span class="carousel-control-prev-icon" aria-hidden="true"></span>
 														<span class="sr-only">Previous</span>
 													</a>
 													<a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
 														<span class="carousel-control-next-icon" aria-hidden="true"></span>
 														<span class="sr-only">Next</span>
 													</a>
 												</div>

 											</div>
 											<div class="col-sm-6 col-md-6 primary-summary " style="padding: 15px;">
 												<div class="d-flex align-items-center">
 													<h2 class="fs-24 mb-0">@{{ QuickView_name }}</h2>
 												</div>
 												<div class="primary-summary-inner" style="max-height: 31rem;overflow: scroll;padding-bottom: 25px;">
 													<p class="text-muted fs-11 font-weight-500 letter-spacing-05px text-uppercase mb-0 pt-1 pb-1" ng-show="category_name != ''">
 														@{{ category_name }}, @{{ subCategory_name }}</p>
 													<p class="text-muted fs-11 font-weight-500 letter-spacing-05px text-uppercase mb-0 pt-1 pb-1" ng-show="bundleProductNames != ''">
 														@{{ bundleProductNames }}</p>
 													<div class="row">
 														<div class="col-lg-8">
 															<p class="mb-0 fs">$@{{ unit_price }}</p>
 														</div>
 														<!-- <div class="col-lg-4">
																<div class="d-flex align-items-center flex-wrap">
																	<ul
																		class="list-inline d-flex justify-content-sm-end justify-content-center mb-0 rating-result">
																		<li class="list-inline-item"><span
																			class="text-primary fs-12 lh-2"><i
																				class="fas fa-star star_col"></i></span></li>
																		<li class="list-inline-item"><span
																			class="text-primary fs-12 lh-2"><i
																				class="fas fa-star star_col"></i></span></li>
																		<li class="list-inline-item"><span
																			class="text-primary fs-12 lh-2"><i
																				class="fas fa-star star_col"></i></span></li>
																		<li class="list-inline-item"><span
																			class="text-primary fs-12 lh-2"><i
																				class="fas fa-star star_col"></i></span></li>
																		<li class="list-inline-item"><span
																			class="text-primary fs-12 lh-2"><i
																				class="fas fa-star star_col"></i></span></li>
																	</ul>
																</div>
															</div> -->
 													</div>
 													<p class="mb-3" style="max-height:150px;overflow:auto">@{{ short_description }}</p>

 													<div style="margin-bottom: 0px;" ng-if="displayCollectionProductShadesQuickView.length != null || displayCollectionProductShadesQuickView.length != undefined">
 														<button class="accordion_inc shadeAccord-btn" data-id="1">1. Choose Shade</button>
 														<div class="panel_inc" id="chooseShade_container_1">
 															<div class="form-group shop-swatch-color shop-swatch-color-02 mb-1">
 																<!-- </label> -->
 																<img src="@{{selectedShadeImg_p}}" alt="Product Image" class="var text-capitalize quick_view_product_image " ng-show="selectedShadeImg_p != ''">
 																<br>
 																<label class="mb-2"><span class="font-weight-500 text-primary mr-2">Color:</span>
 																	<span class="var text-capitalize btn-shade">@{{ selectedShadeName }}</span></label>
 																<ul class="list-inline d-flex justify-content-start mb-0">
						                                            <li class="list-inline-item" ng-repeat="row in displayCollectionProductShadesQuickView"
						                                            ng-click="chooseProdShade(row.PRODUCT_SHADE_ID, row.SHADE_ID, row.PRODUCT_ID, row.SHADE_NAME, row.prodShadeImag_p, row.prodShadeImag_s)"
						                                            title="@{{ row.SHADE_NAME }}">
						                                                <a href="javascript:;" class="d-block swatches-item" style="background-image: url('@{{ row.shadeprimaryImage }}'); background-repeat:no-repeat;background-position: center;"> </a>
						                                            </li>

						                                       	</ul>

 																<input type="hidden" id="shadeId" value="">
						                                        <input type="hidden" id="prodShadeId" value="">
						                                        <input type="hidden" id="shadeName" value="">
						                                        <input type="hidden" id="productId" value="">
						                                        <input type="hidden" id="shadeExistChk" value="@{{(displayCollectionProductShadesQuickView.length == 0 || displayCollectionProductShadesQuickView.length == undefined) ? 'false' : 'true'}}">


 															</div>
 															<a href="javascript:;" class="btn btn-primary" ng-click="confirmProductShade();">Continue</a>
 														</div>
 													</div>

 													<div class="chooseShade-container" style="margin-bottom: 30px;" ng-if="displayCollectionBundleProductShadesQuickView != ''">
														<div id="shadeBundlechooser_container_@{{row.BUNDLE_LINE_ID}}" ng-repeat="row in displayCollectionBundleProductShadesQuickView">
															<button class="accordion_inc_prod_detail shadeAccord-btn" data-id="@{{row.BUNDLE_LINE_ID}}">@{{row.seqNo}}. Choose Shade Product @{{row.productName}}</button><!-- chooseShadeBtn -->
															<div class="panel_inc_prod_detail" id="chooseShade_container_@{{row.BUNDLE_LINE_ID}}">
																<div class="form-group shop-swatch-color shop-swatch-color-02 mb-6 widget-color">

																	<img src="" alt="Product Image" class="var text-capitalize quick_view_product_image bundleLineShadeImg" id="bundleLineShadeImg_@{{row.BUNDLE_LINE_ID}}" style="display:none;">
																	<br>

																	<label class="mb-2">
																		<span class="font-weight-500 text-primary mr-2">Color:</span>
																		<span class="var text-capitalize" id="shadeName1_@{{row.BUNDLE_LINE_ID}}"></span>
																	</label>
																	<ul class="list-inline d-flex justify-content-start mb-0">
																		<li class="list-inline-item" class="list-inline-item" ng-repeat="list in row.productShades"
																		ng-click="chooseBundleProdShade(row.BUNDLE_LINE_ID, list.PRODUCT_SHADE_ID, list.SHADE_ID, list.PRODUCT_ID, list.SHADE_NAME, list.prodShadeImag_p, list.prodShadeImag_s)"
																		title="@{{list.SHADE_NAME}}">
																			<a href="javascript:;" class="d-block swatches-item shade_chooser@{{row.BUNDLE_LINE_ID}}" id="shadeAnchor_@{{list.PRODUCT_SHADE_ID}}" style="background-image: url('@{{list.shadeprimaryImage}}'); background-repeat:no-repeat;background-position: center;"> </a>
																		</li>

																	</ul>

																	<input type="hidden" id="shadeId_@{{row.BUNDLE_LINE_ID}}" value="">
																	<input type="hidden" id="prodShadeId_@{{row.BUNDLE_LINE_ID}}" value="">
																	<input type="hidden" id="shadeName_@{{row.BUNDLE_LINE_ID}}" value="">
																	<input type="hidden" id="productId_@{{row.BUNDLE_LINE_ID}}" value="">
																	<input type="hidden" id="shadeExistChk_@{{row.BUNDLE_LINE_ID}}" value="@{{(row.productShades.length == 0 || row.productShades.length == undefined) ? 'false' : 'true'}}">
																</div>
																<a href="javascript:;" class="btn btn-primary" ng-click="confirmBundleProductShade(@{{row.BUNDLE_LINE_ID}});">Continue</a>
															</div>
														</div>
													</div>

 												<form>

													<input type="radio" id="single-sub" name="subscriptioncheck" value="One-Time Purchase"
														checked>
													<label for="single-sub" class="cursor-pointer">One-Time Purchase</label><br>

													<input type="radio" id="multiple-sub" name="subscriptioncheck" value="subscription">
													<label for="multiple-sub" class="cursor-pointer">Subscription</label><br>
												</form>
 												<div class=" form-group mb-0 sub-form" style="display: none;">
 													<div class="d-flex align-items-center mb-1">
 														<label class="text-primary fs-16 font-weight-bold mb-0" for="size">Subcription Option: </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
 														<a href="#" data-toggle="tooltip" data-placement="left" title="Click to see more Ingredients" class="text-right"> <span data-toggle="modal" data-target="#learnmore_pop">Learn More </span>
 														</a>

 														<div class="modal fade quick-view" id="learnmore_pop" tabindex="-1" aria-hidden="true">
 															<div class="modal-dialog" style="max-width: 631px !important;">
 																<div class="modal-content p-0">
 																	<div class="modal-body p-0">
 																		<button type="button" class="close fs-32 position-absolute pos-fixed-top-right z-index-10 close_learnmore_pop">
 																			<span aria-hidden="true" class="fs-20"><i class="fal fa-times"></i></span>
 																		</button>
 																		<div class="pop_content">

 																			<div class="row">

 																				<p class="col-lg-12">@{{ subscriptionDetails }}</p>
 																			</div>
 																		</div>
 																	</div>
 																</div>
 															</div>
 														</div>
 													</div>
													<select class="form-control w-100 cursor-pointer" id="subsOption" ng-model="subs_id" ng-change="fetchSubscriptionDetail();">
														<option value="" class="cursor-pointer">Choose an option</option>
														<option value="@{{row.ID}}" class="select-subsoptn" ng-repeat="row in subscriptionLov">@{{row.TITLE}}</option>
													</select>
 												</div>
 												<form class="cart-roww">
 													<div class="row align-items-end no-gutters mx-n2 mb-1">
 														<div class="col-sm-3 form-group px-2 mb-0">
 															<label class="text-primary fs-16 font-weight-bold mb-1" for="number">Quantity: </label>

 															<div class="input-group position-relative w-100">
					                                            <a href="javascript:;"
					                                                class="down position-absolute pos-fixed-left-center pl-2 z-index-2 addsubquantity">
					                                                <i class="far fa-minus"></i>
					                                            </a>

					                                            <input name="number" type="number" id="quantity"
					                                                class="form-control w-100 px-6 text-center input-quality bg-transparent text-primary quantityinput"
					                                                value="1">

					                                            <a href="javascript:;"
					                                                class="up position-absolute pos-fixed-right-center pr-2 z-index-2 addsubquantity">
					                                                <i class="far fa-plus"></i>
					                                            </a>
					                                        </div>

 														</div>
 														<div class="col-sm-8 mb-0 px-2">

															<a href="javascript:;" class="btn btn-white btn-block bg-hover-primary border-hover-primary hover-white @if(isset($userId)) productdetail @else addto-cart1 @endif" id="qckad" data-id="@{{row.PRODUCT_ID}}" data-type="@{{productType}}" ng-if="productInventry == 'shade' || productInventry == 'bundle'">+ Quick Add</a>
															<a href="javascript:;" class="btn btn-white btn-block bg-hover-primary border-hover-primary hover-white addto-cart1" id="qckad" data-type="@{{productType}}" data-id="@{{row.PRODUCT_ID}}" data-quantity='1' ng-if="productInventry == 'inv' && productInventryQuantity > '0'">+ Quick Add</a>
															<a href="javascript:;" class="btn btn-white btn-block bg-hover-primary border-hover-primary hover-white" id="qckad" ng-if="productInventry == 'inv' && productInventryQuantity <= '0'" disabled>+ Out of Stock</a>

 															{{-- <button type="button"
					                                            class="btn btn-primary btn-block text-capitalize quick-addto-cart"
					                                            data-type="@{{productType}}"
					                                            data-id="@{{QuickView_productId}}"
					                                            data-quantity='1' data-subs='1'>Add to cart</button> --}}
 														</div>
 													</div>
 												</form>
 												<p class="text-primary lh-14375 mb-0 sub-line" style="display: none;">@{{ subscriptionNote1 }}</p>
 												<p class="text-primary lh-14375 mb-0 sub-below-line" style="display: none;">@{{ subscriptionNote2 }}</p>

 											</div>
 										</div>
 									</div>
 								</div>

 							</div>
 						</div>
 					</div>

 					<div class="modal fade quick-view" id="bundleQuickView" tabindex="-1" aria-hidden="true">
 							<div class="modal-dialog">
 								<div class="modal-content p-0">
 									<div class="modal-body p-0">
 										<button type="button" class="close fs-32 position-absolute pos-fixed-top-right z-index-10" data-dismiss="modal" aria-label="Close">
 											<span aria-hidden="true" class="fs-20">
 												<i class="fal fa-times text-dark"></i>
 											</span>
 										</button>
 										<div class="row no-gutters" id="quick_view_product_details">
 											<div class="col-sm-6">

 												<div id="carouselExampleControls" class="carousel slide" data-ride="carousel" data-interval="2000">
 													<div class="carousel-inner">
 														<div class="carousel-item active">
 															<img class="d-block w-100" style="height:35rem" src="@{{bundleImage}}" alt="First slide">
 														</div>
 													</div>
 													<a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
 														<span class="carousel-control-prev-icon" aria-hidden="true"></span>
 														<span class="sr-only">Previous</span>
 													</a>
 													<a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
 														<span class="carousel-control-next-icon" aria-hidden="true"></span>
 														<span class="sr-only">Next</span>
 													</a>
 												</div>

 											</div>
 											<div class="col-sm-6 col-md-6 primary-summary " style="padding: 20px;">
 												<div class="d-flex align-items-center">
 													<h2 class="fs-24 mb-0">@{{ QuickView_name }}</h2>
 												</div>
 												<div class="primary-summary-inner">
 													<p class="text-muted fs-11 font-weight-500 letter-spacing-05px text-uppercase mb-0 pt-1 pb-1">Petit
 														@{{ category_name }}, @{{ subCategory_name }}</p>
 													<div class="row">
 														<div class="col-lg-8">
 															<p class="mb-0 fs">$@{{ unit_price }}</p>
 														</div>
 														<!-- <div class="col-lg-4">
																<div class="d-flex align-items-center flex-wrap">
																	<ul
																		class="list-inline d-flex justify-content-sm-end justify-content-center mb-0 rating-result">
																		<li class="list-inline-item"><span
																			class="text-primary fs-12 lh-2"><i
																				class="fas fa-star star_col"></i></span></li>
																		<li class="list-inline-item"><span
																			class="text-primary fs-12 lh-2"><i
																				class="fas fa-star star_col"></i></span></li>
																		<li class="list-inline-item"><span
																			class="text-primary fs-12 lh-2"><i
																				class="fas fa-star star_col"></i></span></li>
																		<li class="list-inline-item"><span
																			class="text-primary fs-12 lh-2"><i
																				class="fas fa-star star_col"></i></span></li>
																		<li class="list-inline-item"><span
																			class="text-primary fs-12 lh-2"><i
																				class="fas fa-star star_col"></i></span></li>
																	</ul>
																</div>
															</div> -->
 													</div>
 													<p class="mb-3" style="max-height:150px;overflow:auto">@{{ short_description }}</p>

 													<div style="margin-bottom: 0px;" ng-if="displayCollectionProductShadesQuickView.length != null || displayCollectionProductShadesQuickView.length != undefined">
 														<button class="accordion_inc shadeAccord-btn" data-id="1">1. Choose Shade</button>
 														<div class="panel_inc" id="chooseShade_container_1">
 															<div class="form-group shop-swatch-color shop-swatch-color-02 mb-1">
 																<!-- </label> -->
 																<img src="@{{selectedShadeImg_p}}" alt="Product Image" class="var text-capitalize quick_view_product_image " ng-show="selectedShadeImg_p != ''">
 																<br>
 																<label class="mb-2"><span class="font-weight-500 text-primary mr-2">Color:</span>
 																	<span class="var text-capitalize btn-shade">@{{ selectedShadeName }}</span></label>
 																<ul class="list-inline d-flex justify-content-start mb-0">
						                                            <li class="list-inline-item" ng-repeat="row in displayCollectionProductShadesQuickView"
						                                            ng-click="chooseProdShade(row.PRODUCT_SHADE_ID, row.SHADE_ID, row.PRODUCT_ID, row.SHADE_NAME, row.prodShadeImag_p, row.prodShadeImag_s)"
						                                            title="@{{ row.SHADE_NAME }}">
						                                                <a href="javascript:;" class="d-block swatches-item" style="background-image: url('@{{ row.shadeprimaryImage }}'); background-repeat:no-repeat;background-position: center;"> </a>
						                                            </li>

						                                       	</ul>

 																<input type="hidden" id="shadeId" value="">
						                                        <input type="hidden" id="prodShadeId" value="">
						                                        <input type="hidden" id="shadeName" value="">
						                                        <input type="hidden" id="productId" value="">
						                                        <input type="hidden" id="shadeExistChk" value="@{{(displayCollectionProductShadesQuickView.length == 0 || displayCollectionProductShadesQuickView.length == undefined) ? 'false' : 'true'}}">


 															</div>
 															<a href="javascript:;" class="btn btn-primary" ng-click="confirmProductShade();">Continue</a>
 														</div>

 														<!-- <button class="accordion_inc">2. Blow Gel - Choose Shade</button>
															<div class="panel_inc">
																<img src="{{ url('/assets-web') }}/images/glamorpic.webp" style="width: 250px;"><br>
 														<div class="form-group shop-swatch-color shop-swatch-color-02 mb-0">
 															<label class="mb-2">
 																<span class="font-weight-500 text-primary mr-2">Color:</span>
 																<span class="var text-capitalize">Gray Blue</span></label>
 															<ul class="list-inline d-flex justify-content-start mb-1">
 																<li class="list-inline-item selected">
 																	<a href="#" class="d-block swatches-item" data-var="gray blue" style="background-color: #A0ADBC;"> </a>
 																</li>
 																<li class="list-inline-item"><a href="#" class="d-block swatches-item" data-var="black" style="background-color: #000;"></a></li>
 																<li class="list-inline-item"><a href="#" class="d-block swatches-item" data-var="gray blue" style="background-color: #A0ADBC;"> </a></li>
 																<li class="list-inline-item"><a href="#" class="d-block swatches-item" data-var="black" style="background-color: #000;"></a></li>
 															</ul>
 															<input type="hidden" name="swatches-color" class="swatches-select" value="purple">
 														</div>
 														<a href="store.html" class="btn btn-primary">Continue</a>
 													</div> -->
 												</div>

 												<form>

												<input type="radio" id="single-sub" name="subscriptioncheck" value="One-Time Purchase"
													checked>
												<label for="single-sub" class="cursor-pointer">One-Time Purchase</label><br>

												<input type="radio" id="multiple-sub" name="subscriptioncheck" value="subscription">
												<label for="multiple-sub" class="cursor-pointer">Subscription</label><br>
											</form>
 												<div class=" form-group mb-0 sub-form" style="display: none;">
 													<div class="d-flex align-items-center mb-1">
 														<label class="text-primary fs-16 font-weight-bold mb-0" for="size">Subcription Option: </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
 														<a href="#" data-toggle="tooltip" data-placement="left" title="Click to see more Ingredients" class="text-right"> <span data-toggle="modal" data-target="#learnmore_pop">Learn More </span>
 														</a>

 														<div class="modal fade quick-view" id="learnmore_pop" tabindex="-1" aria-hidden="true">
 															<div class="modal-dialog" style="max-width: 631px !important;">
 																<div class="modal-content p-0">
 																	<div class="modal-body p-0">
 																		<button type="button" class="close fs-32 position-absolute pos-fixed-top-right z-index-10 close_learnmore_pop">
 																			<span aria-hidden="true" class="fs-20"><i class="fal fa-times"></i></span>
 																		</button>
 																		<div class="pop_content">

 																			<div class="row">

 																				<p class="col-lg-12">@{{ subscriptionDetails }}</p>
 																			</div>
 																		</div>
 																	</div>
 																</div>
 															</div>
 														</div>
 													</div>
													<select class="form-control w-100 cursor-pointer" id="subsOption" ng-model="subs_id" ng-change="fetchSubscriptionDetail();">
														<option value="" class="cursor-pointer">Choose an option</option>
														<option value="@{{row.ID}}" class="select-subsoptn" ng-repeat="row in subscriptionLov">@{{row.TITLE}}</option>
													</select>
 												</div>
 												<form class="cart-roww">
 													<div class="row align-items-end no-gutters mx-n2 mb-1">
 														<div class="col-sm-3 form-group px-2 mb-0">
 															<label class="text-primary fs-16 font-weight-bold mb-1" for="number">Quantity: </label>

 															<div class="input-group position-relative w-100">
					                                            <a href="javascript:;"
					                                                class="down position-absolute pos-fixed-left-center pl-2 z-index-2 addsubquantity">
					                                                <i class="far fa-minus"></i>
					                                            </a>

					                                            <input name="number" type="number" id="quantity"
					                                                class="form-control w-100 px-6 text-center input-quality bg-transparent text-primary quantityinput"
					                                                value="1">

					                                            <a href="javascript:;"
					                                                class="up position-absolute pos-fixed-right-center pr-2 z-index-2 addsubquantity">
					                                                <i class="far fa-plus"></i>
					                                            </a>
					                                        </div>

 														</div>
 														<div class="col-sm-8 mb-0 px-2">
 															<button type="button"
					                                            class="btn btn-primary btn-block text-capitalize quick-addto-cart"
					                                            data-type="@{{productType}}"
					                                            data-id="@{{QuickView_productId}}"
					                                            data-quantity='1' data-subs='1'>Add to cart</button>
 														</div>
 													</div>
 												</form>
 												<p class="text-primary lh-14375 mb-0 sub-line" style="display: none;">@{{ subscriptionNote1 }}</p>
 												<p class="text-primary lh-14375 mb-0 sub-below-line" style="display: none;">@{{ subscriptionNote2 }}</p>

 											</div>
 										</div>
 									</div>
 								</div>

 							</div>
 						</div>
 					</div>
 				</div>
 				<!-- 				</div> -->
 			</div>
 		</div>
 		</div>

 		<div class="canvas-sidebar filter-canvas">
 			<div class="canvas-overlay"></div>
 			<div class="card border-0 px-6 overflow-y-auto bg-white h-100 pb-6">
 				<div class="card-header bg-transparent py-0 border-0">
 					<div class="text-right pb-7">
 						<span class="canvas-close d-inline-block text-right fs-24 pt-2 mr-n6 text-body"><i class="fal fa-times"></i></span>
 					</div>
 					<h4 class="fs-34 mb-0">Filter</h4>
 				</div>
 				<div class="card-body">
 					<div class="card border-0 mb-7">
 						<div class="card-header bg-transparent border-0 p-0">
 							<h4 class="card-title fs-18 font-weight-500 mb-3">Size</h4>
 						</div>
 						<div class="card-body p-0">
 							<ul class="list-inline">
 								<?php if (isset($categoryFilter) && !empty($categoryFilter)) { ?>
 									<?php foreach ($categoryFilter as $filter) { ?>

 										<li class="mb-1" id="categoryFilter_{{$filter['SUB_SUB_CATEGORY_ID']}}">
 											<input type="checkbox" class="category-filter" id="categoryFilterInput_{{$filter['SUB_SUB_CATEGORY_ID']}}" value="{{$filter['SUB_SUB_CATEGORY_ID']}}" ng-click="filter();">
 											<label for="categoryFilterInput_{{$filter['SUB_SUB_CATEGORY_ID']}}"> {{$filter['SUB_CATEGORY_NAME']}}/{{$filter['NAME']}}</label>
 										</li>

 									<?php } ?>
 								<?php } ?>
 							</ul>
 						</div>
 					</div>
 					<div class="card border-0 widget-color mb-7">
 						<div class="card-header bg-transparent border-0 p-0">
 							<h3 class="card-title fs-20 mb-0">Colors</h3>
 						</div>
 						<div class="card-body px-0 pt-4 pb-0">
 							<ul class="list-inline mb-0">
 								<li class="list-inline-item mr-2 mt-2" ng-repeat="row in displayCollectionShadeFilter" title="@{{row.TITLE}}">
 									<a href="javascript:;" class="d-block item shade_filter" ng-click="shadeFilter(@{{row.SHADE_ID}});">
 										<img class="item" src="@{{row.primaryImage}}" alt="alt">
 									</a>
 								</li>

 							</ul>
 						</div>
 					</div>

 					<div class="card border-0 mb-7">
 						<div class="card-header bg-transparent border-0 p-0">
 							<h3 class="card-title fs-18 font-weight-500 mb-0">Price</h3>
 						</div>

 						<div class="card-body px-0 pt-2 pb-0">
 							<ul class="list-unstyled mb-0">
 								<li class="mb-1">
 									<input type="radio" id="allPricing" name="price" value="all" ng-click="filter();" checked>
 									<label for="allPricing"> All</label>
 								</li>

 								<li class="mb-1">
 									<input type="radio" id="price1" name="price" value="10-100" ng-click="filter();">
 									<label for="price1"> $10 - $100</label>
 								</li>

 								<li class="mb-1">
 									<input type="radio" id="price2" name="price" value="101-200" ng-click="filter();">
 									<label for="price2"> $101 - $200</label>
 								</li>

 								<li class="mb-1">
 									<input type="radio" id="price3" name="price" value="201-300" ng-click="filter();">
 									<label for="price3"> $201 - $300</label>
 								</li>

 							</ul>
 						</div>
 						<div class="col-12 pl-0">
 							<a type="button" class="btn btn-white btn-block bg-hover-primary border-hover-primary hover-white" ng-click="resetFilter();">Reset Filter</a>
 						</div>
 					</div>

 				</div>
 			</div>
 		</div>
 	</section>
 	<section class="pb-6 pr-4 pl-4">
 		<div class="container">
 			<div class="row no-gutters">
 				<div class="col-xl-2"></div>
 				<div class="col-xl-8 text-center">
 					<h2 class="mb-5">Trending items</h2>
 					<p class="text-primary fs-18 mb-5 ">Made using clean, non-toxic
 						ingredients, our products are designed for everyone. Made using
 						clean, non-toxic ingredients, our products are designed for
 						everyone. Made using clean, non-toxic ingredients, our products are
 						designed for everyone. Made using clean, non-toxic ingredients, our
 						products are designed for everyone.</p>
 				</div>
 				<div class="col-xl-2"></div>
 			</div>
 		</div>
 	</section>
 </main>

 @include('web.web-footer')
 <script src="{{ url('/assets-web') }}/customjs/script_userstorelistingall.js?v={{time()}}"></script>


 <script>
 	$(document).ready(function() {

 		$("#filtersiderbar-leftn").click(function() {
 			//$(".filter-sidebarr").toggle();
 			$(".shop-listing-right-portion").removeClass("col-xl-12");
 			$(".shop-listing-right-portion").addClass("col-xl-9", );
 			$(".productshop-listing").removeClass("col-xl-3");
 			$(".productshop-listing").addClass("col-xl-4");
 			$(".filter-sidebarr").toggle(1000);
 			$(this).hide();
 			$("#filtersiderbar-close").show();
 		});
 		$("#filtersiderbar-close").click(function() {
 			//$(".filter-sidebarr").toggle();
 			$(".filter-sidebarr").toggle();
 			$(".shop-listing-right-portion").removeClass("col-xl-9");
 			$(".shop-listing-right-portion").addClass("col-xl-12");
 			$(".productshop-listing").removeClass("col-xl-4");
 			$(".productshop-listing").addClass("col-xl-3");

 			$(this).hide();
 			$("#filtersiderbar-leftn").show();
 		});

 		$(".close_learnmore_pop").click(function() {
 	 		$("#learnmore_pop").modal('hide');
 		});

 	});
 </script>

 <script>
 	function close_topbar() {

 		$("#topbar").removeClass('d-xl-flex');
 		$(".hero-section").removeClass('mt-15');
 		$(".hero-section").addClass('mt-10');
 		$('.hero-section').css({
					'padding-bottom' : '350px',
					'padding-top' : '350px',
					});


 	}
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

 </script>
