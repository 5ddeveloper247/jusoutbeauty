@include('web.web-header')
<?php $userId = session('userId');
?>
<script>

var site = '<?php echo session('site');?>';
</script>
<style>
	.product-right-side img {
		width: 140px;
		height: 140px;
	}
	@media screen and (min-width: 0px) and (max-width: 514px) {
		.yes-lastscreen{
			margin-top:unset !important;
		}
		.insta-section-image img {
			object-fit: cover;
			height: 300px;
			width: 100%;
			display: inline-block;
			padding: 0px !important;
			margin: 0px !important;
		}
		.row.yestabs{
			max-width: 100% !important;
    		margin-left: 0% !important;
		}
		#last-tab{
			width: 100% !important;
		}
		.col-8.offset-2.card.shadee.border-0.bg-transparent{
			margin-left: -8% !important
		}
	}
    /* Hide elements with ng-cloak attribute */
[ng-cloak], [ng\:cloak], [data-ng-cloak], [x-ng-cloak], .ng-cloak, .x-ng-cloak {
  display: none !important;
}

</style>
<main id="content" ng-app="project1">
<div class="container container-customshadefinder container-xxl mb-2" ng-cloak ng-controller="projectinfo1" id="details-header">

	<div class="row justify-content-center mt-5 mt-md-5 mt-xl-10">
		<div class="col-11 col-sm-9 col-md-7 col-lg-6 col-xl-12 text-center p-0 mt-5 mb-2 quiz-fomewhole" >
			<div class="backto-previousstep second-step-previous" ng-click="backToPrevious();" ng-show="viewFlag == 'Y2' || viewFlag == 'Y3' || viewFlag == 'Y4'">
				<span><i class="fa fa-arrow-left"></i></span><br> <span>Back</span>
			</div>

			<div class="start-fromscratch back-to-shadefinderpage">
				<a href="{{session('site')}}/user-shade-finder"> <span class="">X</span><br>
					<span>Start From Scratch</span>
				</a>
			</div>
			<div class="card shadee px-0 pt-2 pb-0 mt-8 mb-3">

				<form id="">
					<h2 class="mb-3">Take A Quiz</h2>
					<!-- progressbar -->

					<div class="progress progbar">
						<div class="progress-bar-shade-find progress-bar-striped progress-bar-animated" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
					</div>
					<br>
					<!-- fieldsets -->
					<fieldset class="first-step"  ng-show="viewFlag == 'Y1'">
						<div class="form-card-shade-find">
							<div class="row">
								<div class="col-12">
									<h2 class="fs-title-shade-find text-center rose">Do you know your shade?</h2>
								</div>

							</div>
							<div class="container">
								<div class="row">
									<div class="col-6 yesno" ng-repeat="row in displayCollectionOptions" id="ifyes">

										<h2 class="fs-title-shade-find cursor-pointer quizoptions"  ng-click="chooseOption(@{{row.OPTION_ID}}, '@{{row.TITLE}}')">@{{row.CAPTION}}</h2>

									</div>
								</div>
							</div>
						</div>
						<!--<input type="button" name="next" class="next action-button" value="Next"/>-->
					</fieldset>

					<fieldset class="second-step" ng-show="viewFlag == 'Y2'">
						<div class="form-card-shade-find">
							<div class="row">
								<div class="col-12">
									<h2 class="fs-title-shade-find text-center">@{{levelOneQuestionTitle}}</h2>
								</div>
							</div>
							<section class="pb-11 pb-lg-0">
								<div class="container container-custom border-bottom pb-2 pb-lg-1 pl-0 pr-0">
									<div class="collapse-tabs">

										<ul class="nav nav-pills d-md-flex border-bottom" id="pills-tab">

											<li class="nav-item quiz_nav_links mb-4" >
												<a class="nav-link cursor-pointer yeslevelonetabs active show font-weight-600 px-0 pb-3 mr-md-6 mr-4 text-active-primary border-active-primary bg-transparent rounded-0 lh-14375"
												id="yes_level_one_all" ng-click="levelOneTabsSwitch('all');">All 100-498</a>
											</li>
											<li class="nav-item quiz_nav_links mb-4" ng-repeat="row in displayCollectionLevelOneTypesOptions">
												<a class="nav-link yeslevelonetabs cursor-pointer show font-weight-600 px-0 pb-3 mr-md-6 mr-4 text-active-primary border-active-primary bg-transparent rounded-0 lh-14375"
												id="yes_level_one_@{{row.LEVEL_ONE_TYPE_ID}}" ng-click="levelOneTabsSwitch(@{{row.LEVEL_ONE_TYPE_ID}})">@{{row.TITLE}}</a>
											</li>

										</ul>

										<div class="bg-white-md shadow-none pt-md-6 pt-lg-1 px-0 mt-4">

											<div id="">
												<div class="yestabs" id="yes_tab_all">
													<div class="card shadee border-0 bg-transparent">

														<section class="py-6 py-lg-0 insta_section firsttabb">
															<div class="container container-custom-slider container-xl">

																<div class="slick-slider1 shadefinder">

																	<div class="px-1 div-boxx shade" ng-repeat="row in displayCollectionLevelOneTypes" ng-click="chooseOptionLevelTwo(@{{row.LEVEL_ONE_TYPE_ID}});">
																		<p class="text-center mb-0 text-white hoverimages-text p-2 rose">@{{row.TITLE}}</p>

																		<a href="javascript:;" ng-repeat="image in row.images" class="card shadee border-0 hover-change-content insta-secc insta-section-image submit-btn">
																			<img src="@{{image.downPath}}" alt="alt" class="card-img" width="445" height="411">
																			{{-- <img src="http://www.jusoutbeauty.com/site/public/uploads/shadefinder/46.jpg" alt="alt" class="card-img" width="445" height="411"> --}}
																		</a>

																		<p class="text-center mb-0 text-white hoverimages-text p-2">@{{row.DESCRIPTION | limitTo:60}}</p>
																	</div>

																</div>
															</div>
														</section>

													</div>

												</div>

												<!-- <div class="tab-pane tab-pane-parent yestabs" ng-repeat="row in displayCollectionLevelOneTypes" id="yes_tab_@{{row.LEVEL_ONE_TYPE_ID}}" style="display: none;">
													<div class="card shadee border-0 bg-transparent">


														<section class="py-6 py-lg-0 insta_section" >
															<div class="container">


																<div class="slick-slider3 shadefinder" >

																	<div class="px-1 div-boxx shade single-tabss" ng-click="chooseOptionLevelTwo(@{{row.LEVEL_ONE_TYPE_ID}});">
																		<p class="text-center mb-0 text-white hoverimages-text p-2">@{{row.TITLE}}</p>
																		<a href="javascript:;" class="card shadee border-0 hover-change-content insta-secc insta-section-image next-ifno" ng-repeat="img in row.images">
																			<img src="@{{img.downPath}}" alt="Instagram" class="card-img afternosliderhide">
																		</a>

																		<p class="text-center mb-0 text-white hoverimages-text p-2">@{{row.DESCRIPTION}}</p>
																	</div>
																</div>

															</div>
														</section>


													</div>

												</div> -->


												<div class="row yestabs" ng-repeat="row in displayCollectionLevelOneTypes" id="yes_tab_@{{row.LEVEL_ONE_TYPE_ID}}" style="display: none; max-width: 84%; margin-left: 8%;">
													<div class="col-12 col-md-8 offset-md-2 card shadee border-0 bg-transparent p-0">

														<section class="py-6 py-lg-0 insta_section" id="last-tab" style="">
															<div class="container p-0">

																<div class=" shadefinder" >

																	<div class="px-1 div-boxx shade single-tabss shade-type" ng-click="chooseOptionLevelTwo(@{{row.LEVEL_ONE_TYPE_ID}});">
																		<p class="text-center mb-0 text-white hoverimages-text p-2">@{{row.TITLE}}</p>

																		<a href="javascript:;" ng-repeat="img in row.images" class="card shadee border-0 hover-change-content insta-secc insta_section_shade_finder insta-section-image submit-btn">
																			<img src="@{{img.downPath}}" alt="alt" class="card-img objectfit-cover">
																			{{-- <img src="http://www.jusoutbeauty.com/site/public/uploads/shadefinder/46.jpg" alt="alt" class="card-img objectfit-cover"> --}}
																		</a>

																		<p class="text-center mb-0 text-white hoverimages-text p-2">@{{row.DESCRIPTION | limitTo:60}}</p>
																	</div>
																</div>

															</div>
														</section>
													</div>
												</div>


											</div>
										</div>
									</div>
								</div>
							</section>
						</div>
					</fieldset>

					<fieldset class="nofirst-step" ng-show="viewFlag == 'Y3'">
						<div class="form-card-shade-find">
							<div class="row">
								<div class="col-12">
									<h2 class="fs-title-shade-find text-center">@{{levelTwoQuestionTitle}}</h2>
								</div>

							</div>
							<div class="container">
								<div class="row">
									<div class="col-3 noboxes nofour-boxes" ng-repeat="row in displayCollectionLevelTwoTypesOptions" ng-click="chooseOptionLevelThree(@{{row.LEVEL_TWO_TYPE_ID}});">

										<h2 class="fs-title-shade-find">@{{row.TITLE}}</h2>

									</div>

								</div>
							</div>
						</div>

					</fieldset>
					<fieldset class="nosecond-step" ng-show="viewFlag == 'Y4'">
						<div class="form-card-shade-find">
							<div class="row">
								<div class="col-12">
									<h2 class="fs-title-shade-find text-center">@{{levelThreeQuestionTitle}}</h2>
								</div>
							</div>
							<div class="container">
								<div class="row">
									<div class="col-4 noboxes if-nolaststp" ng-repeat="row in displayCollectionLevelThreeTypesOptions" ng-click="chooseOptionLevelLast(@{{row.LEVEL_THREE_TYPE_ID}});">
										<h2 class="fs-title-shade-find">@{{row.TITLE}}</h2>
									</div>
								</div>
							</div>
						</div>
					</fieldset>
				</form>

				<div class="yes-lastscreen" ng-show="viewFlag == 'YL'"  style="margin-top: -64px;">
					<section class="pt-10 pt-lg-4">
						<div class="text-center align-items-center">
							<h4>Meet Your Match</h4>
							<p>The best shade, based your answer</p>
						</div>
					</section>
					<section class="pt-6 pt-lg-5">
						<div class="row">
							<div class="col-lg-6" style="height: 100vh;">
								<img id="take_a_q" src="@{{levelOneLatestImg}}" style="height: 37rem">
							</div>
							<div class="col-md-6" >
								<div class="text-center">
									<h2>Liquid Foundation Iconic Edition</h2>
									<p>Invisible Touch Liquid Foundation. Foundation color suitable
										for medium, neutral olive undertones</p>
								</div>
								<div class="row d-flex" style="height: 60vh; overflow:scroll;">
									<div class="col-lg-6 mb-0 fadeInUp animated" ng-repeat="row in displayCollectionPrimaryProducts">
										<div class="box shade py-2 fadeInUp animated"
											data-animate="fadeInUp">
											<div class="card shadee border-0 product-right-side productdetail"
                                            data-id="@{{row.PRODUCT_ID}}"
                                            data-category="@{{ row.CATEGORY_SLUG }}"
                                            data-subCategory="@{{ row.SUB_CATEGORY_SLUG }}"
                                            data-name="@{{ row.SLUG }}" data-type="@{{catFlag}}"
                                            >
												<div class="position-relative hover-zoom-in">
													<a href="javascript:;" class="d-block overflow-hidden">
													<img src="@{{row.primaryImage}}" alt="@{{row.NAME}}" class="card-img-top img-h30">

													</a>
												</div>
											</div>
											<div class="card-body pt-4 px-0 pb-0">

												<h3 class="card-title fs-16 font-weight-500 mb-1 lh-14375 productdetail" data-id="@{{row.PRODUCT_ID}}" data-type="@{{row.CATEGORY_NAME}}">
													<a href="javascript:;">@{{row.NAME}}</a>
												</h3>

												<a href="javascript:;" class="btn btn-primary mt-2 addto-cart" data-type="single" data-id="@{{row.PRODUCT_ID}}" data-quantity='1'>Add To Bag</a>

											</div>

										</div>

									</div>
								</div>
								<div class="row mt-2 mb-2 pt-2 pb-2"
									style="background-color: #F89880; color: black;">
									<div class="col-lg-6" style="align-self: center;">
										<h5>Compact & Contrast</h5>
										<p class="mb-0">Not Satisfied with your match?</p>
									</div>
									<div class="col-lg-6" style="align-self: center;">
										<a href="{{session('site')}}/user-shade-finder" class="btn btn-primary">Back to shade finder</a>
									</div>
								</div>
							</div>
						</div>

					</section>

					<section class="pt-10 pt-lg-8 pb-8">
						<div class="container container-xl">
							<h2 class="text-center pb-3">Other Products To Complete The Look</h2>

							<div class="slick-slider2 shadefinder"
							data-slick-options='{"slidesToShow": 1,"dots":true,"autoplay":true,"arrows":true,"centerMode":false,"centerPadding":"450px","infinite":true,"responsive":[{"breakpoint": 1450,"settings": {"slidesToShow": 2,"centerMode":false,"arrows":true}},{"breakpoint": 2199,"settings": {"slidesToShow": 3,"centerMode":false,"arrows":true}},{"breakpoint": 1200,"settings": {"centerMode":false,"arrows":true}},{"breakpoint": 992,"settings": {"centerMode":false,"arrows":true}}]}'>

								<div class="box shade product py-2"  ng-repeat="row in displayCollectionRecommandedProducts"><!-- data-animate="fadeInUp" -->
									<div class="card shadee border-0>
										<h3 class="card-title fs-16 font-weight-500 mb-1 lh-14375 mb-2">
											<a href="javascript:;">@{{row.SUB_CATEGORY_NAME ? row.SUB_CATEGORY_NAME : '&nbsp;&nbsp;'}}</a>
										</h3>
										<div class="position-relative hover-zoom-in">

											<a href="javascript:;" class="d-block overflow-hidden  productdetail"
                                            data-id="@{{row.PRODUCT_ID}}"
                                            data-category="@{{ row.CATEGORY_SLUG }}"
                                            data-subCategory="@{{ row.SUB_CATEGORY_SLUG }}"
                                            data-name="@{{ row.SLUG }}" data-type="@{{catFlag}}">
												<img src="@{{row.primaryImage}}" alt="@{{row.NAME}}" class="card-img-top image-active">
												<img src="@{{row.secondaryImage}}" alt="@{{row.NAME}}" class="card-img-top image-hover">
											</a>
											<div
												class="position-absolute pos-fixed-top-right d-inline-flex p-4 flex-column z-index-10">
												<div
													class="content-change-vertical d-flex flex-column ml-auto">
													<a href="javascript:;" data-toggle="tooltip"
														data-placement="left" title="Add to wish list"
														class="add-to-wishlist d-flex align-items-center justify-content-center text-primary bg-white hover-white bg-hover-primary w-45px h-45px rounded-circle mb-2 addto-wishlist"
														data-productId='@{{row.PRODUCT_ID}}' data-type='single'>
														<i class="fas fa-star wish_@{{row.PRODUCT_ID}} @{{row.wishlistFlag == '1' ? 'activeWish' : ''}}" ></i>
													</a>
													{{-- <a href="javascript:;" data-toggle="tooltip" data-placement="left" title="Quick view" ng-click="quickViewProductDetails(@{{row.PRODUCT_ID}})" class="preview d-flex align-items-center justify-content-center text-primary bg-white hover-white bg-hover-primary w-45px h-45px rounded-circle">
														// <span data-toggle="modal" data-target="#productQuickView">
														<i class="icon fal fa-eye"></i>
														// </span>
													</a> --}}

												</div>
											</div>
											<div class="position-absolute pos-fixed-bottom pb-4 px-4 w-100">
												<a href="javascript:;" ng-if="row.INV_QUANTITY_FLAG == 'shade'" class="btn btn-white btn-block bg-hover-primary border-hover-primary hover-white @if(isset($userId)) productdetail @else addtocart addto-cart @endif "
													id="qckad" data-type="single" data-id="@{{row.PRODUCT_ID}}" data-category="@{{row.CATEGORY_SLUG}}"
                                                    		data-subcategory="@{{row.SUB_CATEGORY_SLUG}}"
                                                    		data-name="@{{row.SLUG}}" data-type="" data-quickAdd="{{ session('userId') }}" data-quantity='1'>+ Quick Add</a>
                                                <a href="javascript:;" ng-if="row.INV_QUANTITY_FLAG == 'inv' && row.INV_QUANTITY > '0'" class="btn btn-white btn-block bg-hover-primary border-hover-primary hover-white  addtocart addto-cart"
                                                    id="qckad" data-type="single" data-id="@{{row.PRODUCT_ID}}" data-category="@{{row.CATEGORY_SLUG}}"
                                                        data-subcategory="@{{row.SUB_CATEGORY_SLUG}}"
                                                        data-name="@{{row.SLUG}}" data-type="" data-quickAdd="{{ session('userId') }}" data-quantity='1'>+ Quick Add</a>
                                                <a href="javascript:;" ng-if="row.INV_QUANTITY_FLAG == 'inv' && row.INV_QUANTITY <= '0'" class="btn btn-white btn-block bg-hover-primary border-hover-primary hover-white disabled"
                                                    >Out Of Stock</a>
											</div>
										</div>
										<div class="card-body pt-4 px-0 pb-0 text-left">
											<a href="store.html"
												class="text-muted fs-12 font-weight-500 text-uppercase mb-1 card-title lh-14 hover-primary">
												@{{row.SUB_CATEGORY_NAME ? row.SUB_CATEGORY_NAME : '&nbsp;&nbsp;'}}</a>

											<h3 class="card-title fs-16 font-weight-500 mb-1 lh-14375">
												<a class="productdetail"
                                                data-id="@{{row.PRODUCT_ID}}"
                                                data-category="@{{ row.CATEGORY_SLUG }}"
                                                data-subCategory="@{{ row.SUB_CATEGORY_SLUG }}"
                                                data-name="@{{ row.SLUG }}" data-type="@{{catFlag}}">@{{row.NAME}}</a>
											</h3>
											<p class="text-primary mb-0 card-title lh-14375">@{{row.SUB_TITLE_TXT}}</p>
											<div class="row">
												<div class="col-6">
													<p class="text-primary mb-0 card-title lh-14375">
														<span>$@{{row.UNIT_PRICE}}</span>
													</p>
												</div>
												<div class="col-6">
													<p class="text-primary mb-0 card-title text-right lh-14375">@{{row.UNIT | limitTo:8}}</p>
												</div>
											</div>



										</div>
									</div>
								</div>


							</div>

						</div>
					</section>

					<!-- <section class="pt-10 pt-lg-8 pb-8">
						<div class="container container-xl">
							<h3 class="text-center pb-3">OTHER PRODUCTS TO COMPLETE THE LOOK</h3>

							<div class="slick-slider2 shadefinder" data-slick-options='{}'>

								<div class="box shade product py-2"  ng-repeat="row in displayCollectionRecommandedProducts">
									<div class="card shadee border-0">
										<h3 class="card-title fs-16 font-weight-500 mb-1 lh-14375 mb-2">
											<a href="javascript:;">@{{row.CATEGORY_NAME}}</a>
										</h3>
										<div class="position-relative hover-zoom-in">

											<a href="javascript:;" class="d-block overflow-hidden">
												<img src="@{{row.primaryImage}}" alt="@{{row.NAME}}" class="card-img-top image-active">
												<img src="@{{row.primaryImage}}" alt="@{{row.NAME}}" class="card-img-top image-hover">
											</a>
											<div class="position-absolute pos-fixed-top-right d-inline-flex p-4 flex-column z-index-10">
												<div class="content-change-vertical d-flex flex-column ml-auto">
													<a href="javascript:;" data-toggle="tooltip" data-placement="left" title="Add to wish list"
														class="add-to-wishlist d-flex align-items-center justify-content-center text-primary bg-white hover-white bg-hover-primary w-45px h-45px rounded-circle mb-2">
														<i class="fas fa-star"></i>
													</a>
												</div>
											</div>
											<div class="position-absolute pos-fixed-bottom pb-4 px-4 w-100">
												<a href="javascript:;" class="btn btn-white btn-block bg-hover-primary border-hover-primary hover-white addtocart"
													id="qckad">+ Quick Add</a>
											</div>
										</div>
										<div class="card-body pt-4 px-0 pb-0 text-left">
											<a href="javascript:;"
												class="text-muted fs-12 font-weight-500 text-uppercase mb-1 card-title lh-14 hover-primary">
												@{{row.SUB_CATEGORY_NAME}}</a>

											<h3 class="card-title fs-16 font-weight-500 mb-1 lh-14375">
												<a href="javascript:;">@{{row.NAME}}</a>
											</h3>
											<p class="text-primary mb-0 card-title lh-14375">@{{row.SUB_TITLE}}</p>
											<p class="text-primary mb-0 card-title lh-14375">
												<span>@{{row.UNIT_PRICE}}</span>
											</p>
											<p class="text-primary mb-0 card-title lh-14375">Size: @{{row.UNIT}}</p>

										</div>
									</div>
								</div>

							</div>

						</div>
					</section> -->


				</div>
			</div>
		</div>
	</div>
	<div class="modal fade quick-view" id="productQuickView" tabindex="-1" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content p-0">
				<div class="modal-body p-0">
					<button type="button" class="close fs-32 position-absolute pos-fixed-top-right pr-3 pt-2 z-index-10" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true" class="fs-20">
							<i class="fal fa-times"></i>
						</span>
					</button>
					<div class="row no-gutters" id="quick_view_product_details">
						<div class="col-sm-6">

							<div id="carouselExampleControls" class="carousel slide" data-ride="carousel" data-interval="2000">
								<div class="carousel-inner" ng-show="productImagesLoop != ''">
									<div class="carousel-item @{{$first == '1' ? 'active' : ''}}" ng-repeat="row in productImagesLoop">
										<img class="d-block w-100" style="height:35rem" src="@{{row.downPath}}" alt="First slide">
									</div>
								</div>
								<div class="carousel-inner" ng-show="productImagesBundle != ''">
									<div class="carousel-item active" >
										<img class="d-block w-100" style="height:35rem" src="@{{productImagesBundle}}" alt="First slide">
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
							<div class="primary-summary-inner" style="max-height: 31rem;overflow: scroll;">
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

								<div style="margin-bottom: 0px;" ng-if="displayCollectionProductShadesQuickView != ''">
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
													<button type="button" class="close fs-32 position-absolute pos-fixed-top-right pr-3 pt-2 z-index-10 close_learnmore_pop">
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

</main>

@include('web.web-footer')

<script src="{{ url('/assets-web') }}/customjs/script_usershadefinderquiz.js?v={{time()}}"></script>
{{-- <script src="{{ url('/assets-web') }}/customjs/script_quick_view.js?v={{time()}}"></script> --}}

<script>
function close_topbar(){
	$("#topbar").removeClass('d-xl-flex');
	// $("#details-header").removeClass('mt-15');
	// $("#details-header").addClass('mt-10');
}
// $(document).ready(function(){




// var current_fs, next_fs, previous_fs; //fieldsets
// var opacity;
// var current = 1;
// var steps = $("fieldset").length;




// setProgressBar(current);

// $(".next").click(function(){

//     var yes =  $("#ifyes").attr('data-checked');
//      var no =  $("#ifno").attr('data-checked');
//      //alert(yes);
//     if(yes === "1")
//     {
//         current_fs = $(this).parent();
//         next_fs = $(this).parent().nextAll().eq(0);


//     } else if(no === "1")
//     {
//         current_fs = $(this).parent();
//         next_fs = $(this).parent().nextAll().eq(1);


//     }else{
//     current_fs = $(this).parent();
//     next_fs = $(this).parent().next();

//     }


//      //alert(yes);




//     //Add Class Active
//     $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

//     //show the next fieldset
//     next_fs.show();
//     //hide the current fieldset with style
//     current_fs.animate({opacity: 0}, {
//         step: function(now) {
//             // for making fielset appear animation
//             opacity = 1 - now;

//             current_fs.css({
//                 'display': 'none',
//                 'position': 'relative'
//             });
//             next_fs.css({'opacity': opacity});
//         },
//         duration: 500
//     });
//     setProgressBar(++current);
// });

// $(".previous").click(function(){

//     var yes =  $("#ifyes").attr('data-checked');
//     var no =  $("#ifno").attr('data-checked');
//      //alert(yes);
//     if(yes === "1")
//     {
//         current_fs = $(this).parent();
//         previous_fs = $(this).parent().prevAll().eq(0);

//     }
//     else if(no === "1")
//     {
//         current_fs = $(this).parent();
//         previous_fs = $(this).parent().prevAll().eq(1);

//     }else{
//     current_fs = $(this).parent();
//     previous_fs = $(this).parent().prev();
//     }


//     //Remove class active
//     $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

//     //show the previous fieldset
//     previous_fs.show();

//     //hide the current fieldset with style
//     current_fs.animate({opacity: 0}, {
//         step: function(now) {
//             // for making fielset appear animation
//             opacity = 1 - now;

//             current_fs.css({
//                 'display': 'none',
//                 'position': 'relative'
//             });
//             previous_fs.css({'opacity': opacity});
//         },
//         duration: 500
//     });
//     setProgressBar(--current);
// });

// function setProgressBar(curStep){
//     var percent = parseFloat(100 / steps) * curStep;
//     percent = percent.toFixed();
//     $(".progress-bar-shade-find")
//       .css("width",percent+"%")
// }

// $(".submit").click(function(){
//     return false;
// })

// });

// $("#ifyes").click(function(){

//   var yes =  $("#ifyes").data('checked');
//    $("#ifyes").attr("data-checked", "1");

//   $("#ifyes h2").css("background-color", "#F89880");
//   $("#ifyes h2").css("color", "#fff");
//    $("#ifno h2").css("background-color", "#FFF5EE");
//   $("#ifno h2").css("color", "#F89880");
//   $("#ifno").attr("data-checked", "0");

// });
// $("#ifno").click(function(){

//     $("#ifyes").attr("data-checked", "0");
//     var no =  $("#ifno").data('checked');
//    $("#ifno").attr("data-checked", "1");
//   $("#ifno h2").css("background-color", "#F89880");
//   $("#ifno h2").css("color", "#fff");
//    $("#ifyes h2").css("background-color", "#FFF5EE");
//   $("#ifyes h2").css("color", "#F89880");

// });
// $("#ifmedium").click(function(){


//   $("#ifmedium h2").css("background-color", "#F89880");
//   $("#ifmedium h2").css("color", "#fff");
//    $("#ifsheer h2").css("background-color", "#FFF5EE");
//   $("#ifsheer h2").css("color", "#F89880");
//   $("#iffull h2").css("background-color", "#FFF5EE");
//   $("#iffull h2").css("color", "#F89880");
//      $("#ifpreference h2").css("background-color", "#FFF5EE");
//   $("#ifpreference h2").css("color", "#F89880");
// });
// $("#ifsheer").click(function(){


//   $("#ifsheer h2").css("background-color", "#F89880");
//   $("#ifsheer h2").css("color", "#fff");
//    $("#ifmedium h2").css("background-color", "#FFF5EE");
//   $("#ifmedium h2").css("color", "#F89880");
//    $("#ifpreference h2").css("background-color", "#FFF5EE");
//   $("#ifpreference h2").css("color", "#F89880");
//    $("#iffull h2").css("background-color", "#FFF5EE");
//   $("#iffull h2").css("color", "#F89880");
// });
// $("#iffull").click(function(){


//   $("#iffull h2").css("background-color", "#F89880");
//   $("#iffull h2").css("color", "#fff");
//    $("#ifpreference h2").css("background-color", "#FFF5EE");
//   $("#ifpreference h2").css("color", "#F89880");
//      $("#ifmedium h2").css("background-color", "#FFF5EE");
//   $("#ifmedium h2").css("color", "#F89880");
//    $("#ifsheer h2").css("background-color", "#FFF5EE");
//   $("#ifsheer h2").css("color", "#F89880");
// });
// $("#ifpreference").click(function(){


//   $("#ifpreference h2").css("background-color", "#F89880");
//   $("#ifpreference h2").css("color", "#fff");
//    $("#iffull h2").css("background-color", "#FFF5EE");
//   $("#iffull h2").css("color", "#F89880");
//      $("#ifmedium h2").css("background-color", "#FFF5EE");
//   $("#ifmedium h2").css("color", "#F89880");
//    $("#ifsheer h2").css("background-color", "#FFF5EE");
//   $("#ifsheer h2").css("color", "#F89880");
// });
// $("#ifnext-medium").click(function(){


//   $("#ifnext-medium h2").css("background-color", "#F89880");
//   $("#ifnext-medium h2").css("color", "#fff");
//    $("#ifnext-full h2").css("background-color", "#FFF5EE");
//   $("#ifnext-full h2").css("color", "#F89880");
//    $("#ifnext-sheer h2").css("background-color", "#FFF5EE");
//   $("#ifnext-sheer h2").css("color", "#F89880");
// });
// $("#ifnext-full").click(function(){


//   $("#ifnext-full h2").css("background-color", "#F89880");
//   $("#ifnext-full h2").css("color", "#fff");
//    $("#ifnext-medium h2").css("background-color", "#FFF5EE");
//   $("#ifnext-medium h2").css("color", "#F89880");
//    $("#ifnext-sheer h2").css("background-color", "#FFF5EE");
//   $("#ifnext-sheer h2").css("color", "#F89880");
// });
// $("#ifnext-sheer").click(function(){


//   $("#ifnext-sheer h2").css("background-color", "#F89880");
//   $("#ifnext-sheer h2").css("color", "#fff");
//    $("#ifnext-medium h2").css("background-color", "#FFF5EE");
//   $("#ifnext-medium h2").css("color", "#F89880");
//    $("#ifnext-full h2").css("background-color", "#FFF5EE");
//   $("#ifnext-full h2").css("color", "#F89880");
// });
$("#yes_level_one_all").click(function(){
  $(".slick-slider").slick('refresh');

});
// $(".submit-btn").click(function(){
//   $(".yes-lastscreen").css("display", "block");
//  $("#msform").css("display", "none");
//   $("#previous-foryes").css("display", "none");
//   $(".back-to-shadefinderpage").css("display", "none");
// });

// $(".if-nolaststp").click(function(){
//   $(".yes-lastscreen").css("display", "block");
//   $(".after-nooption").css("display", "block");
//  $("#msform").css("display", "none");
//   $("#previous-fornolaststep").css("display", "none");
//   $(".back-to-shadefinderpage").css("display", "none");
// });
// $(".submit-btn").click(function(){
//   $(".slick-slider").slick('refresh');

// });
// $(".if-nolaststp").click(function(){
//   $(".slick-slider").slick('refresh');

// });
// $(".previous").click(function(){
//   $(".slick-slider").slick('refresh');

// });

// $(".action-button").click(function(){
//   $(".slick-slider").slick('refresh');

// });
// $("#pills-description-tab").click(function(){
//   $(".firsttabb").css("display", "block");
//   $(".second-tab").css("display", "none");
//   $(".third-tab").css("display", "none");
//   $(".forth-tab").css("display", "none");
//   $(".fifth-tab").css("display", "none");
//   $(".sixth-tab").css("display", "none");
//   $(".seventh-tab").css("display", "none");

// });
// $("#pills-infomation-tab").click(function(){
//   $(".firsttabb").css("display", "none");
//   $(".second-tab").css("display", "block");
//   $(".third-tab").css("display", "none");
//   $(".forth-tab").css("display", "none");
//   $(".fifth-tab").css("display", "none");
//   $(".sixth-tab").css("display", "none");
//   $(".seventh-tab").css("display", "none");

// });
// $("#pills-reviews-tab").click(function(){
//  $(".firsttabb").css("display", "none");
//   $(".second-tab").css("display", "none");
//   $(".third-tab").css("display", "block");
//   $(".forth-tab").css("display", "none");
//   $(".fifth-tab").css("display", "none");
//   $(".sixth-tab").css("display", "none");
//   $(".seventh-tab").css("display", "none");
// });
// $("#pills-medium-tab").click(function(){
//   $(".firsttabb").css("display", "none");
//   $(".second-tab").css("display", "none");
//   $(".third-tab").css("display", "none");
//   $(".forth-tab").css("display", "block");
//   $(".fifth-tab").css("display", "none");
//   $(".sixth-tab").css("display", "none");
//   $(".seventh-tab").css("display", "none");

// });
// $("#pills-medium-deep-tab").click(function(){
//   $(".firsttabb").css("display", "none");
//   $(".second-tab").css("display", "none");
//   $(".third-tab").css("display", "none");
//   $(".forth-tab").css("display", "none");
//   $(".fifth-tab").css("display", "block");
//   $(".sixth-tab").css("display", "none");
//   $(".seventh-tab").css("display", "none");

// });
// $("#pills-deep-tab").click(function(){
//   $(".firsttabb").css("display", "none");
//   $(".second-tab").css("display", "none");
//   $(".third-tab").css("display", "none");
//   $(".forth-tab").css("display", "none");
//   $(".fifth-tab").css("display", "none");
//   $(".sixth-tab").css("display", "block");
//     $(".seventh-tab").css("display", "none");

// });
// $("#pills-tan-tab").click(function(){
//   $(".firsttabb").css("display", "none");
//   $(".second-tab").css("display", "none");
//   $(".third-tab").css("display", "none");
//   $(".forth-tab").css("display", "none");
//   $(".fifth-tab").css("display", "none");
//    $(".sixth-tab").css("display", "none");
//   $(".seventh-tab").css("display", "block");

// });
//  $(".next-ifno").click(function(){
//   $(".noslider-section").css("display", "none");
//   $(".nofirst-step").css("display", "block");


// });
// $(".next-ifnoafterslider").click(function(){
//   $(".nofirst-step").css("display", "none");
//   $(".nosecond-step").css("display", "block");


// });
// $(".previous-ifnoafterslider").click(function(){
//   $(".nofirst-step").css("display", "none");
//   $(".noslider-section").css("display", "block");


// });
// $(".previous-ifnobeforesubmitscreen").click(function(){
//   $(".nosecond-step").css("display", "none");
//   $(".nofirst-step").css("display", "block");


// });
// $("#hide-recomendsection").click(function(){
//   $(".after-nooption").css("display", "block");



// });



// $("#pills-description-tabno").click(function(){
//   $(".firsttabb").css("display", "block");
//   $(".second-tab").css("display", "none");
//   $(".third-tab").css("display", "none");
//   $(".forth-tab").css("display", "none");
//   $(".fifth-tab").css("display", "none");
//   $(".sixth-tab").css("display", "none");
//   $(".seventh-tab").css("display", "none");

// });
// $("#pills-infomation-tabno").click(function(){
//   $(".firsttabb").css("display", "none");
//   $(".second-tab").css("display", "block");
//   $(".third-tab").css("display", "none");
//   $(".forth-tab").css("display", "none");
//   $(".fifth-tab").css("display", "none");
//   $(".sixth-tab").css("display", "none");
//   $(".seventh-tab").css("display", "none");

// });
// $("#pills-reviews-tabno").click(function(){
//  $(".firsttabb").css("display", "none");
//   $(".second-tab").css("display", "none");
//   $(".third-tab").css("display", "block");
//   $(".forth-tab").css("display", "none");
//   $(".fifth-tab").css("display", "none");
//   $(".sixth-tab").css("display", "none");
//   $(".seventh-tab").css("display", "none");
// });
// $("#pills-medium-tabno").click(function(){
//   $(".firsttabb").css("display", "none");
//   $(".second-tab").css("display", "none");
//   $(".third-tab").css("display", "none");
//   $(".forth-tab").css("display", "block");
//   $(".fifth-tab").css("display", "none");
//   $(".sixth-tab").css("display", "none");
//   $(".seventh-tab").css("display", "none");

// });
// $("#pills-medium-deep-tabno").click(function(){
//   $(".firsttabb").css("display", "none");
//   $(".second-tab").css("display", "none");
//   $(".third-tab").css("display", "none");
//   $(".forth-tab").css("display", "none");
//   $(".fifth-tab").css("display", "block");
//   $(".sixth-tab").css("display", "none");
//   $(".seventh-tab").css("display", "none");

// });
// $("#pills-deep-tabno").click(function(){
//   $(".firsttabb").css("display", "none");
//   $(".second-tab").css("display", "none");
//   $(".third-tab").css("display", "none");
//   $(".forth-tab").css("display", "none");
//   $(".fifth-tab").css("display", "none");
//   $(".sixth-tab").css("display", "block");
//   $(".seventh-tab").css("display", "none");

// });
// $("#pills-tan-tabno").click(function(){
//   $(".firsttabb").css("display", "none");
//   $(".second-tab").css("display", "none");
//   $(".third-tab").css("display", "none");
//   $(".forth-tab").css("display", "none");
//   $(".fifth-tab").css("display", "none");
//   $(".sixth-tab").css("display", "none");
//   $(".seventh-tab").css("display", "block");

// });
// //  $('.start-fromscratch').click(function() {
// //       window.location.href='https://checkdev.xyz/jusout/shade-finder.html';
// // });

// $("#ifyes").click(function(){
//   $(".first-step").css("display", "none");
//   $(".second-step").css("display", "block");

//   $("#previous-foryes").css("display", "block");

// });
// $("#ifno").click(function(){
//   $(".first-step").css("display", "none");
//   $(".noslider-section").css("display", "block");
// $("#previous-forno").css("display", "block");
// $("#previous-fornoafterslider").css("display", "none");


// });
// $(".afternosliderhide").click(function(){
//   $(".nofirst-step").css("display", "block");
//   $(".noslider-section").css("display", "none");
// $("#previous-forno").css("display", "none");
// $("#previous-fornoafterslider").css("display", "block");
// });
// $(".nofour-boxes").click(function(){
//   $(".nofirst-step").css("display", "none");
//   $(".nosecond-step").css("display", "block");
// $("#previous-fornoafterslider").css("display", "none");
// $("#previous-fornolaststep").css("display", "block");
// });


// $("#previous-foryes").click(function(){
//   $(".first-step").css("display", "block");

//   $(".second-step").css("display", "none");
//   $(this).css("display", "none");
//   $("#previous-forno").css("display", "none");
// });
// $("#previous-forno").click(function(){
//   $(".noslider-section").css("display", "none");
//   $(".first-step").css("display", "block");

//   $(this).css("display", "none");
//   $("#previous-foryes").css("display", "none");
// });
// $("#previous-fornoafterslider").click(function(){
//   $(".noslider-section").css("display", "block");
//   $(".nofirst-step").css("display", "none");

//   $(this).css("display", "none");
//   $("#previous-forno").css("display", "block");

// });
// $("#previous-fornolaststep").click(function(){
//   $(".nosecond-step").css("display", "none");
//   $(".nofirst-step").css("display", "block");

//   $(this).css("display", "none");
//   $("#previous-fornoafterslider").css("display", "block");

// });


// // $(".submit-btn").click(function(){
// //   $(".nosecond-step").css("display", "none");
// //   $(".nofirst-step").css("display", "block");

// //   $(this).css("display", "none");
// //   $("#previous-fornoafterslider").css("display", "block");

// // });

// $("#ifyes").click(function(){
//   $(".slick-slider").slick('refresh');

// });
// $("#ifno").click(function(){
//   $(".slick-slider").slick('refresh');

// });
// $(".firsttabb").click(function(){
//   $(".slick-slider").slick('refresh');
// });
// $(".second-tab").click(function(){
//   $(".slick-slider").slick('refresh');
// });
// $(".third-tab").click(function(){
//   $(".slick-slider").slick('refresh');
// });
// $(".forth-tab").click(function(){
//   $(".slick-slider").slick('refresh');
// });
// $(".fifth-tab").click(function(){
//   $(".slick-slider").slick('refresh');
// });
// $(".sixth-tab").click(function(){
//   $(".slick-slider").slick('refresh');
// });


</script>
<script type="text/javascript">
	$(window).on('load', function() {
		$('.slick-slider2').not('.slick-initialized').slick({
			slidesToShow: 4,
			"infinite":true,
			"autoplay":true,
            "autoplaySpeed": 5000,
			"dots":true,
			"arrows":true,
			"responsive":[{
				"breakpoint": 1366,"settings": {"slidesToShow":1}},
					{"breakpoint": 768,"settings": {"slidesToShow": 3}},
					{"breakpoint": 576,"settings": {"slidesToShow": 2}
					}]

			});
	});
  </script>
