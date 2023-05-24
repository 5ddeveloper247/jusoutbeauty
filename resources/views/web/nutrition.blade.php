<?php 
// print_r('<pre>');
// print_r($subCategoriesList);
// exit();
?>
@include('web.web-header')
<script>
	//var userId = <?php //echo '1';?>;
	var site = '<?php echo session('site');?>';
	var sourceId = "<?php echo isset($sourceId) ? $sourceId : '';?>";
	var flag = "<?php echo isset($flag) ? $flag : '';?>";
</script>
<style>
	.pro-col{
		color: #F89880
	}
	.sit-col{
		background-color:white
	}
	.nut-img-2{
		height: 33.6rem;
    	
	}
	.product_image{
		margin-top: 10px;
	} 
	.opacity-active{
		opacity: 0.7;
	}
	@media screen and (min-width: 0px) and (max-width: 514px) {
		.nut-img-2{
			height: 20rem;
		}
	}
	/* @media only screen and (min-width: 1749px){
		.nut-img-2{
			height: 53rem;
		}    
		.product_image{
			margin-top: 28px;
		} 
	} */
	.cursor-pointer{
      cursor: pointer;
    }
</style>
<main id="content" ng-app="project1">
	<div class="" ng-controller="projectinfo1">
	
		<section class="pt-10 pt-lg-10 py-10 mob_sec">
			<div class="container">
				<div class="text-center mw-750 mx-auto">
					<h2 class="text-center font-weight-600 mb-3" style="font-size: 55px;">
						JUSOUTBEAUTY</h2>
					<p>SUPPLEMENTS</p>
					<p>A COLLECTION OF SCIENCE-DRIVEN SUPPLEMENTS TO SUPPORT SKIN HEALTH
						FROM THE INSIDE OUT</p>
				</div>
			</div>
		</section>
		
		<section class="pt-10 pt-lg-13 pt-10 pt-lg-13 pt-11 pt-lg-12 py-8 site_color">
			<div class="text-center mw-730 mx-auto">
				<img src="{{url('/assets-web')}}/images/supplement.png" alt=""><br>
				<br>
				<h1 class="text-white text-center mb-0 nu-cate">Nutrition Categories</h1>
			</div>
		
			<div class="pt-5 pt-lg-3">
				<div class="container container-custom nutrition-section cursor-pointer" >
		
					<div class="row">
					<?php if(isset($subCategoriesList) && !empty($subCategoriesList)){?>
						<?php foreach($subCategoriesList as $filter){?>
								<?php
									$activeClass = 'opacity-active';
									if($flag == 'SUB_CATEGORY' && $filter['SUB_CATEGORY_ID'] != $sourceId){
										$activeClass = 'opacity-active';
									}else if($flag == 'CATEGORY'){
										$activeClass = 'opacity-active';
									}else{
										$activeClass = '';
									}
									?>
								<div class="col-md-3 col-4 mb-6 mb-md-0 <?= $activeClass ?> filter-click" ng-click="filter(<?= $filter['SUB_CATEGORY_ID'];?>);">
									<div class="card border-0 hover-zoom-in" id="skin_health_col">
										<img src="<?= $filter['image'];?>" alt="alt" class="card-img inr-img">
									</div>
									<p class="nut_para"><?= $filter['NAME'];?></p>
								</div>
							<?php }?>
						<?php }?>
						
					</div>
				</div>
			</div>
		</section>
		
		<section class="pt-5 pt-lg-5 py-8 sit-col" id="nutrition-section-id">
			
			<div class="pt-0 pt-lg-0">
				<div class="container container-custom nutrition-section" >
					<div class="text-center mw-730 mx-auto">
						<img src="{{url('/assets-web')}}/images/pro-gif.png" alt="" style="height
						70;width:70px;"><br>
						
						<h1 class="pro-col text-center mb-6 nu-cate" style="color:#57813a ">Products</h1>
					</div>
					
					<div class="row">
						<div class="col-sm-6 mb-0 mb-sm-0 prod_card_inc" ng-repeat="row in displayCollectionProducts" style="@{{row.styleBgColor}}">
							<div class="card border-0 hover-zoom-in" style="background-color: unset !important;">
								<div class="overflow-hidden">
									<img src="@{{row.primaryImage}}" alt="The new - season shoes edit" class="card-img-top productdetail cursor-pointer nut-img-2" data-id="@{{row.PRODUCT_ID}}" style="margin-top:15px"><br>
									<h3 class="text-center productdetail cursor-pointer product_image"  data-id="@{{row.PRODUCT_ID}}">@{{row.NAME}}</h3>
									<p class="text-center productdetail cursor-pointer" data-id="@{{row.PRODUCT_ID}}">@{{row.CATEGORY_NAME}}</p>
									<h3 class="text-center productdetail cursor-pointer" data-id="@{{row.PRODUCT_ID}}">@{{row.SUB_TITLE}}</h3>
									<a href="javascript:;" class="btn btn-primary nut_btn addto-cart" data-id="@{{row.PRODUCT_ID}}" data-quantity="1" style="display: block; margin: 0 auto; width: 33%;">Shop Now</a>
									<br>
								</div>
							</div>
						</div>
						
					</div>
				</div>
			</div>
		</section>
		{{-- <section class="pt-0 pt-lg-0 py-0" id="skin_health_img">
			<div class="container-fluid product_inc">
				<div class="row">
					<div class="col-sm-6 mb-0 mb-sm-0 prod_card_inc" ng-repeat="row in displayCollectionProducts" style="@{{row.styleBgColor}}">
						<div class="card border-0 hover-zoom-in" style="background-color: unset !important;">
							<div class="overflow-hidden">
								<img src="@{{row.primaryImage}}" alt="The new - season shoes edit" class="card-img-top productdetail nut-img-2" data-id="@{{row.PRODUCT_ID}}"><br>
								<h3 class="text-center productdetail product_image"  data-id="@{{row.PRODUCT_ID}}">@{{row.NAME}}</h3>
								<p class="text-center productdetail" data-id="@{{row.PRODUCT_ID}}">@{{row.CATEGORY_NAME}}</p>
								<h3 class="text-center productdetail" data-id="@{{row.PRODUCT_ID}}">@{{row.SUB_TITLE}}</h3>
								<a href="javascript:;" class="btn btn-primary nut_btn addto-cart" data-id="@{{row.PRODUCT_ID}}" data-quantity="1" style="display: block; margin: 0 auto; width: 33%;">Shop Now</a>
								<br>
							</div>
						</div>
					</div>
					<div class="col-sm-12 col-12" ng-if="displayCollectionProducts.length == 0 || displayCollectionProducts.length == undefined">
						<p class="text-center">No record found...</p>
					</div>
					<!-- <div class="col-sm-6 mb-0 mb-sm-0 prod_card_inc" style="background-color: #0FA353 !important;">
						<div class="card border-0 hover-zoom-in"
							style="background-color: unset !important;">
							<div class="overflow-hidden">
								<img src="{{ url('/assets-web') }}/images/sisgrid1.webp"
									alt="trending now" class="card-img-top"><br>
								<h3 class="text-center">SKIN RECOVERY</h3>
								<p class="text-center">PREVIOUSLY REPAIR FOOD</p>
								<h3 class="text-center">FOR SKIN NUTRITION & RESTORATION</h3>
								<a href="/store" class="btn btn-primary nut_btn_2"
									style="display: block; margin: 0 auto; width: 33%;">Shop Now</a>
							</div>
						</div>
					</div> -->
				</div>
				
			</div>
		</section> --}}
		<!-- <section class="pt-0 pt-lg-0 py-0" id="gut_health_img" style="display: none">
			<div class="container-fluid product_inc">
				<div class="row">
					<div class="col-sm-6 mb-0 mb-sm-0 prod_card_inc"
						data-animate="fadeInUp"
						style="background-color: #AFCFDF !important;">
						<div class="card border-0 hover-zoom-in"
							style="background-color: unset !important;">
							<div class="overflow-hidden">
								<img src="{{ url('/assets-web') }}/images/sisgrid2.webp"
									alt="The new - season shoes edit" class="card-img-top"><br>
								<h3 class="text-center">SKIN RECOVERY</h3>
								<p class="text-center">PREVIOUSLY REPAIR FOOD</p>
								<h3 class="text-center">FOR SKIN NUTRITION & RESTORATION</h3>
								<a href="store" class="btn btn-primary nut_btn"
									style="display: block; margin: 0 auto; width: 33%;">Shop Now</a>
								<br>
							</div>
						</div>
					</div>
					<div class="col-sm-6 mb-0 mb-sm-0 prod_card_inc"
						data-animate="fadeInUp"
						style="background-color: #013062 !important;">
						<div class="card border-0 hover-zoom-in"
							style="background-color: unset !important;">
							<div class="overflow-hidden">
								<img src="{{ url('/assets-web') }}/images/sisgrid13.webp"
									alt="trending now" class="card-img-top"><br>
								<h3 class="text-center">SKIN RECOVERY</h3>
								<p class="text-center">PREVIOUSLY REPAIR FOOD</p>
								<h3 class="text-center">FOR SKIN NUTRITION & RESTORATION</h3>
								<a href="store" class="btn btn-primary nut_btn_2"
									style="display: block; margin: 0 auto; width: 33%;">Shop Now</a>
								<br>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6 mb-0 mb-sm-0 prod_card_inc"
						data-animate="fadeInUp"
						style="background-color: #C0DAB8 !important;">
						<div class="card border-0 hover-zoom-in"
							style="background-color: unset !important;">
							<div class="overflow-hidden">
								<img src="{{ url('/assets-web') }}/images/sisgrid.webp"
									alt="The new - season shoes edit" class="card-img-top"><br>
								<h3 class="text-center">SKIN RECOVERY</h3>
								<p class="text-center">PREVIOUSLY REPAIR FOOD</p>
								<h3 class="text-center">FOR SKIN NUTRITION & RESTORATION</h3>
								<a href="store" class="btn btn-primary nut_btn"
									style="display: block; margin: 0 auto; width: 33%;">Shop Now</a>
								<br>
							</div>
						</div>
					</div>
					<div class="col-sm-6 mb-0 mb-sm-0 prod_card_inc"
						data-animate="fadeInUp"
						style="background-color: #0FA353 !important;">
						<div class="card border-0 hover-zoom-in"
							style="background-color: unset !important;">
							<div class="overflow-hidden">
								<img src="{{ url('/assets-web') }}/images/sisgrid1.webp"
									alt="trending now" class="card-img-top"><br>
								<h3 class="text-center">SKIN RECOVERY</h3>
								<p class="text-center">PREVIOUSLY REPAIR FOOD</p>
								<h3 class="text-center">FOR SKIN NUTRITION & RESTORATION</h3>
								<a href="store" class="btn btn-primary nut_btn"
									style="display: block; margin: 0 auto; width: 33%;">Shop Now</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		
		<section class="pt-0 pt-lg-0 py-0" id="mood_img" style="display: none">
			<div class="container-fluid product_inc">
				<div class="row">
					<div class="col-sm-6 mb-0 mb-sm-0 prod_card_inc"
						data-animate="fadeInUp"
						style="background-color: #C0DAB8 !important;">
						<div class="card border-0 hover-zoom-in"
							style="background-color: unset !important;">
							<div class="overflow-hidden">
								<img src="{{ url('/assets-web') }}/images/sisgrid.webp"
									alt="The new - season shoes edit" class="card-img-top"><br>
								<h3 class="text-center">SKIN RECOVERY</h3>
								<p class="text-center">PREVIOUSLY REPAIR FOOD</p>
								<h3 class="text-center">FOR SKIN NUTRITION & RESTORATION</h3>
								<a href="store" class="btn btn-primary nut_btn"
									style="display: block; margin: 0 auto; width: 33%;">Shop Now</a>
								<br>
							</div>
						</div>
					</div>
					<div class="col-sm-6 mb-0 mb-sm-0 prod_card_inc"
						data-animate="fadeInUp"
						style="background-color: #0FA353 !important;">
						<div class="card border-0 hover-zoom-in"
							style="background-color: unset !important;">
							<div class="overflow-hidden">
								<img src="{{ url('/assets-web') }}/images/sisgrid1.webp"
									alt="trending now" class="card-img-top"><br>
								<h3 class="text-center">SKIN RECOVERY</h3>
								<p class="text-center">PREVIOUSLY REPAIR FOOD</p>
								<h3 class="text-center">FOR SKIN NUTRITION & RESTORATION</h3>
								<a href="store" class="btn btn-primary nut_btn_2"
									style="display: block; margin: 0 auto; width: 33%;">Shop Now</a>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6 mb-0 mb-sm-0 prod_card_inc"
						data-animate="fadeInUp"
						style="background-color: #AFCFDF !important;">
						<div class="card border-0 hover-zoom-in"
							style="background-color: unset !important;">
							<div class="overflow-hidden">
								<img src="{{ url('/assets-web') }}/images/sisgrid2.webp"
									alt="The new - season shoes edit" class="card-img-top"><br>
								<h3 class="text-center">SKIN RECOVERY</h3>
								<p class="text-center">PREVIOUSLY REPAIR FOOD</p>
								<h3 class="text-center">FOR SKIN NUTRITION & RESTORATION</h3>
								<a href="store" class="btn btn-primary nut_btn"
									style="display: block; margin: 0 auto; width: 33%;">Shop Now</a>
								<br>
							</div>
						</div>
					</div>
					<div class="col-sm-6 mb-0 mb-sm-0 prod_card_inc"
						data-animate="fadeInUp"
						style="background-color: #013062 !important;">
						<div class="card border-0 hover-zoom-in"
							style="background-color: unset !important;">
							<div class="overflow-hidden">
								<img src="{{ url('/assets-web') }}/images/sisgrid13.webp"
									alt="trending now" class="card-img-top"><br>
								<h3 class="text-center">SKIN RECOVERY</h3>
								<p class="text-center">PREVIOUSLY REPAIR FOOD</p>
								<h3 class="text-center">FOR SKIN NUTRITION & RESTORATION</h3>
								<a href="store" class="btn btn-primary nut_btn"
									style="display: block; margin: 0 auto; width: 33%;">Shop Now</a>
								<br>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		
		<section class="pt-0 pt-lg-0 py-0" id="powder_img" style="display: none">
			<div class="container-fluid product_inc">
				<div class="row">
					<div class="col-sm-6 mb-0 mb-sm-0 prod_card_inc"
						data-animate="fadeInUp"
						style="background-color: #AFCFDF !important;">
						<div class="card border-0 hover-zoom-in"
							style="background-color: unset !important;">
							<div class="overflow-hidden">
								<img src="{{ url('/assets-web') }}/images/sisgrid2.webp"
									alt="The new - season shoes edit" class="card-img-top"><br>
								<h3 class="text-center">SKIN RECOVERY</h3>
								<p class="text-center">PREVIOUSLY REPAIR FOOD</p>
								<h3 class="text-center">FOR SKIN NUTRITION & RESTORATION</h3>
								<a href="store" class="btn btn-primary nut_btn"
									style="display: block; margin: 0 auto; width: 33%;">Shop Now</a>
								<br>
							</div>
						</div>
					</div>
					<div class="col-sm-6 mb-0 mb-sm-0 prod_card_inc"
						data-animate="fadeInUp"
						style="background-color: #013062 !important;">
						<div class="card border-0 hover-zoom-in"
							style="background-color: unset !important;">
							<div class="overflow-hidden">
								<img src="{{ url('/assets-web') }}/images/sisgrid13.webp"
									alt="trending now" class="card-img-top"><br>
								<h3 class="text-center">SKIN RECOVERY</h3>
								<p class="text-center">PREVIOUSLY REPAIR FOOD</p>
								<h3 class="text-center">FOR SKIN NUTRITION & RESTORATION</h3>
								<a href="store" class="btn btn-primary nut_btn_2"
									style="display: block; margin: 0 auto; width: 33%;">Shop Now</a>
								<br>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6 mb-0 mb-sm-0 prod_card_inc"
						data-animate="fadeInUp"
						style="background-color: #C0DAB8 !important;">
						<div class="card border-0 hover-zoom-in"
							style="background-color: unset !important;">
							<div class="overflow-hidden">
								<img src="{{ url('/assets-web') }}/images/sisgrid.webp"
									alt="The new - season shoes edit" class="card-img-top"><br>
								<h3 class="text-center">SKIN RECOVERY</h3>
								<p class="text-center">PREVIOUSLY REPAIR FOOD</p>
								<h3 class="text-center">FOR SKIN NUTRITION & RESTORATION</h3>
								<a href="store" class="btn btn-primary nut_btn"
									style="display: block; margin: 0 auto; width: 33%;">Shop Now</a>
								<br>
							</div>
						</div>
					</div>
					<div class="col-sm-6 mb-0 mb-sm-0 prod_card_inc"
						data-animate="fadeInUp"
						style="background-color: #0FA353 !important;">
						<div class="card border-0 hover-zoom-in"
							style="background-color: unset !important;">
							<div class="overflow-hidden">
								<img src="{{ url('/assets-web') }}/images/sisgrid1.webp"
									alt="trending now" class="card-img-top"><br>
								<h3 class="text-center">SKIN RECOVERY</h3>
								<p class="text-center">PREVIOUSLY REPAIR FOOD</p>
								<h3 class="text-center">FOR SKIN NUTRITION & RESTORATION</h3>
								<a href="store" class="btn btn-primary nut_btn"
									style="display: block; margin: 0 auto; width: 33%;">Shop Now</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section> -->
	</div>
</main>
@include('web.web-footer')
<script>
	function close_topbar(){
        $("#topbar").removeClass('d-xl-flex');

    }
	$(document).on('click', '.filter-click', function() {
		
		$(".filter-click").addClass('opacity-active');
		$(this).removeClass('opacity-active');
	});

	$( document ).ready(function() {
    	setTimeout(function() { 
			if(flag == 'SUB_CATEGORY'){
				$([document.documentElement, document.body]).animate({
					scrollTop: $("#nutrition-section-id").offset().top
				}, 2000);
				// $('html, body').animate({
                //         scrollTop: $("#nutrition-section-id").offset().top
                //     }, 1500);
			}
    	}, 1000);
	});
	
</script>
<script src="{{ url('/assets-web') }}/customjs/script_userstorelistingnutrition.js?v={{time()}}"></script>
