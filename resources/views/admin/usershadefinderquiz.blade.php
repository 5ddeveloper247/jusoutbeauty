@include('web.web-header');
<script>

var site = '<?php echo session('site');?>';
</script>
<main id="content" ng-app="project1"> <!--<section class="py-lg-8 py-14 bg-img-cover-center" style="background-image: url('images/shadeimg.webp');background-color: #F2F2F2">-->
<!--<div class="container container-xxl">--> <!--<p class="text-primary fs-18 font-weight-600 mb-4 lh-1444" data-animate="fadeInUp"></p>-->
<!--<h1 class="fs-30 fs-lg-40" data-animate="fadeInUp">Let's Find Your Shade</h1>-->

<!--<div><h3 class="fs-32 mb-2">Send Us a Selfie</h3>--> <!--<p class="mb-2">One of our pro makeup artists will <br>personally provide shade recommendations.-->
<!--</p>--> <!--<div class="">--> <!--<a href="#" class="btn btn-primary" id="selfie-btn">Snap A Selfie</a>-->
<!--</div></div><br>--> <!--<div>--> <!--<h3 class="fs-32 mb-2">Send Us a Selfie</h3>-->
<!--<p>One of our pro makeup artists will <br>personally provide shade recommendations.-->
<!--</p>--> <!--<div class="">--> <!--<a href="#" class="btn btn-primary">Take A Quiz</a>-->
<!--</div>--> <!--</div>--> <!--</div>--> <!--</section>-->
<div class="container container-xxl mb-2" ng-controller="projectinfo1">
	
	<div class="row justify-content-center">
		<div class="col-11 col-sm-9 col-md-7 col-lg-6 col-xl-12 text-center p-0 mt-3 mb-2 quiz-fomewhole">
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
					<h2>Take A Quiz</h2>
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
									<h2 class="fs-title-shade-find text-center">Do you know your shade?</h2>
								</div>

							</div>
							<div class="container">
								<div class="row">
									<div class="col-6 yesno" ng-repeat="row in displayCollectionOptions" id="ifyes">

										<h2 class="fs-title-shade-find" ng-click="chooseOption(@{{row.OPTION_ID}}, '@{{row.TITLE}}')">@{{row.CAPTION}}</h2>

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
								<div class="container border-bottom pb-2 pb-lg-1">
									<div class="collapse-tabs">
										
										<ul class="nav nav-pills d-md-flex border-bottom" id="pills-tab">
											
											<li class="nav-item">
												<a class="nav-link yeslevelonetabs active show font-weight-600 px-0 pb-3 mr-md-6 mr-4 text-active-primary border-active-primary bg-transparent rounded-0 lh-14375"
												id="yes_level_one_all" ng-click="levelOneTabsSwitch('all');">All 100-498</a>
											</li>
											<li class="nav-item" ng-repeat="row in displayCollectionLevelOneTypesOptions">
												<a class="nav-link yeslevelonetabs show font-weight-600 px-0 pb-3 mr-md-6 mr-4 text-active-primary border-active-primary bg-transparent rounded-0 lh-14375"
												id="yes_level_one_@{{row.LEVEL_ONE_TYPE_ID}}" ng-click="levelOneTabsSwitch(@{{row.LEVEL_ONE_TYPE_ID}})">@{{row.TITLE}}</a>
											</li>
											
										</ul>
										
										<div class="bg-white-md shadow-none pt-md-6 pt-lg-1 px-0 mt-4">
										
											<div id="">
												<div class="yestabs" id="yes_tab_all">
													<div class="card shadee border-0 bg-transparent">
														
														<section class="py-6 py-lg-0 insta_section firsttabb">
															<div class="container container-xl">

																<div class="slick-slider1 shadefinder" >
																	
																	<div class="px-1 div-boxx shade" ng-repeat="row in displayCollectionLevelOneTypes" ng-click="chooseOptionLevelTwo(@{{row.LEVEL_ONE_TYPE_ID}});">
																		<p class="text-center mb-0 text-white hoverimages-text p-2">@{{row.TITLE}}</p>
																		
																		<a href="javascript:;" ng-repeat="image in row.images" class="card shadee border-0 hover-change-content insta-secc insta-section-image submit-btn">
																			<img src="@{{image.downPath}}" alt="alt" class="card-img">
																		</a> 
																	
																		<p class="text-center mb-0 text-white hoverimages-text p-2">@{{row.DESCRIPTION}}</p>
																	</div>
																
																</div>
															</div>
														</section>

													</div>

												</div>
												<div class="row yestabs" ng-repeat="row in displayCollectionLevelOneTypes" id="yes_tab_@{{row.LEVEL_ONE_TYPE_ID}}" style="display: none;">
													<div class="col-8 offset-2 card shadee border-0 bg-transparent">
														
														<section class="py-6 py-lg-0 insta_section" style="">
															<div class="container">

																<div class=" shadefinder" ><!-- slick-slider2 -->

																	<div class="px-1 div-boxx shade single-tabss" ng-click="chooseOptionLevelTwo(@{{row.LEVEL_ONE_TYPE_ID}});">
																		<p class="text-center mb-0 text-white hoverimages-text p-2">@{{row.TITLE}}</p>
																		
																		<a href="javascript:;" ng-repeat="img in row.images" class="card shadee border-0 hover-change-content insta-secc insta-section-image submit-btn">
																			<img src="@{{img.downPath}}" alt="alt" class="card-img">
																		</a> 
																		
																		<p class="text-center mb-0 text-white hoverimages-text p-2">@{{row.DESCRIPTION}}</p>
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
						<div class="row align-items-center">
							<div class="col-lg-6">
								<img src="@{{levelOneLatestImg}}" style="width: 100%; height: 90%;">
							</div>
							<div class="col-md-6">
								<div class="text-center align-items-center">
									<h4>Liquid Foundation Iconic Edition</h4>
									<p>Invisible Touch Liquid Foundation. Foundation color suitable
										for medium, neutral olive undertones</p>
								</div>
								<div class="row d-flex">
									<div class="col-lg-6 mb-0" ng-repeat="row in displayCollectionPrimaryProducts"><!-- data-animate="fadeInUp" -->
										<div class="box shade py-2"><!-- data-animate="fadeInUp" -->
											<div class="card shadee border-0 product-right-side">
												<div class="position-relative hover-zoom-in">
													<a href="javascript:;" class="d-block overflow-hidden"> 
														<img src="@{{row.primaryImage}}" alt="@{{row.NAME}}" class="card-img-top">
													</a>
												</div>
											</div>
											<div class="card-body pt-4 px-0 pb-0">

												<h3 class="card-title fs-16 font-weight-500 mb-1 lh-14375">
													<a href="javascript:;">@{{row.NAME}}</a>
												</h3>

												<a href="javascript:;" class="btn btn-primary mt-2">Add To Bag</a>
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
										<a href="{{session('site')}}/user-shade-finder" class="btn btn-primary" style="background-color: #fff; color: #000;">Back to shade finder</a>
									</div>
								</div>
							</div>
						</div>

					</section>

					<section class="pt-10 pt-lg-8 pb-8">
						<div class="container container-xl">
							<h3 class="text-center pb-3">OTHER PRODUCTS TO COMPLETE THE LOOK</h3>

							<div class="slick-slider2 shadefinder" data-slick-options='{}'>
								
								<div class="box shade product py-2"  ng-repeat="row in displayCollectionRecommandedProducts"><!-- data-animate="fadeInUp" -->
									<div class="card shadee border-0">
										<h3
											class="card-title fs-16 font-weight-500 mb-1 lh-14375 mb-2">
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
					</section>

					
				</div>
			</div>
		</div>
	</div>
</div>
</main>

@include('web.web-footer');

<script src="{{ url('/assets-web') }}/customjs/script_usershadefinderquiz.js"></script>

<script>

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
// $(".next").click(function(){
//   $(".slick-slider").slick('refresh');

// });
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
