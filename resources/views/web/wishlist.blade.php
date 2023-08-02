@include('web.web-header')
<script>
	var site = '<?php echo session('site');?>';
</script>
<main id="content" ng-app="project1">
	<div ng-controller="projectinfo1">
		<section class="py-2 bg-gray-2 mt-15" id="details-header">
			<div class="container">
				<nav aria-label="breadcrumb">
					<ol
						class="breadcrumb breadcrumb-site py-0 d-flex justify-content-center">
						<li class="breadcrumb-item"><a
							class="text-decoration-none text-body" href="{{session('site')}}/home">Home</a></li>
						<li class="breadcrumb-item active pl-0 d-flex align-items-center"
							aria-current="page">Wishlist</li>
					</ol>
				</nav>
			</div>
		</section>
		<section>
			<div class="container">
				<h2 class="text-center mt-9 mb-8">Wishlist</h2>
				<form class="table-responsive-md pb-8 pb-lg-10">
					<table class="table border-right border-left border-bottom mb-6">
						<tbody>
							<tr class="position-relative ng-cloak" ng-repeat="row in displayCollectionWishlist">
								<td class="pl-xl-6 py-4 d-flex align-items-center">
									<a href="javascript:;" class="d-block" ng-click="removeWishlist(row.WISHLIST_ID);"><i class="fal fa-times"></i></a>

									<div class="media align-items-center productdetail"
                                    data-id="@{{row.PRODUCT_ID}}" data-category="@{{ row.CATEGORY_SLUG }}"
                                    data-subCategory="@{{ row.SUB_CATEGORY_SLUG }}"
                                    data-name="@{{ row.SLUG }}" data-type="@{{catFlag}}" >
										<a href="javascript:;" class="ml-3 mr-4 d-block" >
											<img src="@{{row.primaryImage}}" alt="Image" class="mw-75px">
										</a>
										<div class="media-body mw-210">
											<a href="javascript:;" class="font-weight-500 text-primary mb-2 lh-13 productdetail"
                                            data-id="@{{row.PRODUCT_ID}}" data-category="@{{ row.CATEGORY_SLUG }}"
                                            data-subCategory="@{{ row.SUB_CATEGORY_SLUG }}"
                                            data-name="@{{ row.SLUG }}" data-type="@{{catFlag}}"
                                            >@{{row.productName}}</a>
											<p class="card-text fs-14 mb-1 text-primary">
												<span>$@{{row.unitPrice}}</span>
											</p>
											<p class="fs-12 mb-0">@{{row.DATE}}</p>
										</div>
									</div>
								</td>
								<td class="align-middle text-right pr-6">
									<span class="mr-4">In stock</span>
									
									<a href="javascript:;" class="btn btn-outline-primary py-1 w-150px px-0 my-3 productdetail" 
										data-id="@{{row.PRODUCT_ID}}" data-type="@{{row.flag == 'bundle' ? 'bundle' : 'single'}}"
										data-category="@{{ row.CATEGORY_SLUG }}" data-subCategory="@{{ row.SUB_CATEGORY_SLUG }}" data-name="@{{ row.SLUG }}"
										ng-if="row.INV_QUANTITY_FLAG == 'shade' || row.INV_QUANTITY_FLAG == 'bundle'">Add To Cart</a>
										
 									<a href="javascript:;" class="btn btn-outline-primary py-1 w-150px px-0 my-3 addto-cart1" 
 										data-id="@{{row.PRODUCT_ID}}" data-type="@{{row.flag == 'bundle' ? 'bundle' : 'single'}}"
 										data-quantity='1' ng-if="row.INV_QUANTITY_FLAG == 'inv' && row.INV_QUANTITY > '0'">Add To Cart</a>
									<a href="javascript:;" class="btn btn-outline-primary py-1 w-150px px-0 my-3" 
										ng-if="row.INV_QUANTITY_FLAG == 'inv' && row.INV_QUANTITY <= '0'" disabled>Out of Stock</a>
									
									<!-- <a href="javascript:;" class="btn btn-outline-primary py-1 w-150px px-0 my-3 addto-cart"
										data-type="@{{row.flag == 'bundle' ? 'bundle' : 'single'}}" data-id="@{{row.PRODUCT_ID}}"
										data-quantity='1'>Add To Cart</a> -->
								</td>
							</tr>
							<!-- <tr class="position-relative">
								<td class="pl-xl-6 py-4 d-flex align-items-center"><a href="#"
									class="d-block"><i class="fal fa-times"></i></a>
									<div class="media align-items-center">
										<a href="product-detail" class="ml-3 mr-4 d-block"> <img
											src="{{ url('/assets-web') }}/images/product.jpg"
											alt="Striped cotton-blend sweatshirt" class="mw-75px">
										</a>
										<div class="media-body mw-210">
											<a href="product-detail-01"
												class="font-weight-500 text-primary mb-2 lh-13">Striped
												cotton-blend sweatshirt</a>
											<p class="card-text fs-14 mb-1 text-primary">
												<span class="fs-13 text-decoration-through text-primary pr-1">$39.00</span>
												<span>$29.00</span>
											</p>
											<p class="fs-12 mb-0">August 14, 2021</p>
										</div>
									</div></td>
								<td class="align-middle text-right pr-6"><span class="mr-4">In
										stock</span> <a href="#"
									class="btn btn-outline-primary py-1 w-150px px-0 my-3">Select
										Options</a></td>
							</tr>
							<tr class="position-relative">
								<td class="pl-xl-6 py-4 d-flex align-items-center"><a href="#"
									class="d-block"><i class="fal fa-times"></i></a>
									<div class="media align-items-center">
										<a href="product-detail" class="ml-3 mr-4 d-block"> <img
											src="{{ url('/assets-web') }}/images/product.jpg"
											alt="Oversize cotton sweatshirt" class="mw-75px">
										</a>
										<div class="media-body mw-210">
											<a href="product-detail-01"
												class="font-weight-500 text-primary mb-2 lh-13">Oversize
												cotton sweatshirt</a>
											<p class="card-text fs-14 mb-1 text-primary">
												<span class="fs-13 text-decoration-through text-primary pr-1">$39.00</span>
												<span>$29.00</span>
											</p>
											<p class="fs-12 mb-0">August 14, 2021</p>
										</div>
									</div></td>
								<td class="align-middle text-right pr-6"><span class="mr-4">In
										stock</span> <a href="#"
									class="btn btn-outline-primary py-1 w-150px px-0 my-3">Add To
										Cart</a></td>
							</tr> -->

						</tbody>
					</table>
					<div class="row">
						<div class="col-sm-6 mb-3 mb-sm-0">
							<a href="{{session('site')}}/home" class="btn btn-outline-primary"> Countinue
								Shopping </a>
						</div>
						<!-- <div class="text-sm-right col-sm-6">
							<button type="submit" value="Update Cart" class="btn btn-primary">Update
								Cart</button>
						</div> -->
					</div>
				</form>
			</div>
		</section>
	</div>
</main>
@include('web.web-footer')

<script src="{{ url('/assets-web') }}/customjs/script_userwishlist.js?v={{time()}}"></script>
<script>
	function close_topbar(){
	$("#topbar").removeClass('d-xl-flex');
	$("#details-header").removeClass('mt-15');
	$("#details-header").addClass('mt-10');
}
</script>
