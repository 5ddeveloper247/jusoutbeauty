@include('admin.admin-header');
<script>
var userId = <?php echo session('userId');?>;
var site = '<?php echo session('site');?>';
var baseurl = "<?php echo url('/assets-admin');?>";
</script>
<div ng-app="project1">
<!--**********************************
            Content body start
        ***********************************-->
<div class="content-body" ng-controller="projectinfo1">
	<div class="container-fluid">
		<div class="page-titles mb-0">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="javascript:void(0)">Home Page
						Settings</a></li>
				<li class="breadcrumb-item active"><a href="javascript:void(0)">Update</a></li>
			</ol>
		</div>
		<!-- row -->
		<div class="row">
			<div class="col-xl-12 col-xxl-12">
				<div class="card">
					<div class="card-header">
						<h4 class="card-title">Home Banners</h4>
					</div>
					<div class="card-body">
						<!-- Nav tabs -->
						<ul class="nav nav-tabs" role="tablist">
							<li class="nav-item"><a class="nav-link active" data-toggle="tab"
								href="#banner_1"> <span> Banner 1 </span>
							</a></li>
							<li class="nav-item"><a class="nav-link" data-toggle="tab"
								href="#banner_2"> <span> Banner 2 </span>
							</a></li>
							<li class="nav-item"><a class="nav-link" data-toggle="tab"
								href="#banner_3"> <span> Banner 3 </span>
							</a></li>
							<li class="nav-item"><a class="nav-link" data-toggle="tab"
								href="#banner_4"> <span> Banner 4 </span>
							</a></li>
							<li class="nav-item"><a class="nav-link" data-toggle="tab"
								href="#banner_5"> <span> Banner 5 </span>
							</a></li>
						</ul>
						<!-- Tab panes -->
						<form class="" id="uploadattch" method="POST" action="uploadBannerImage" enctype="multipart/form-data">
							<input type="hidden" name="_method" value="POST">
		           			{{ csrf_field() }}
           					<input type="hidden" id="userId" name="userId" value="<?php echo session('userId');?>">
							<input type="hidden" id="sourceId" name="sourceId" value="">
							<input type="hidden" id="sourceCode" name="sourceCode" value="BANNER_IMG">
							<input type="file" id="uploadattl" name="uploadattl" class="file-input" style="display: none;">
						</form>

						<div class="tab-content tabcontent-border">
							<div class="tab-pane fade show active" id="banner_1" role="tabpanel">
								<div class="pt-4">
									<div class="form-validation">
										<form class="form-valide" >
											<div class="row">
												<div class="col-sm-6">
													<div class="form-group">
														<label class="col-form-label" for="b_title_1"><b>Title</b><span class="text-danger">*</span> </label>
														<input type="text" class="form-control" id="b_title_1" placeholder="Enter a title">
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-sm-6">
													<div class="form-group">
														<label class="col-form-label" for="b_btntext_1"><b>Button Text</b><span class="text-danger">*</span> </label>
														<input type="text" class="form-control" id="b_btntext_1" placeholder="Button Text">
													</div>
												</div>
												<div class="col-sm-6">
													<div class="form-group">
														<label class="col-form-label" for="b_btnlink_1"><b>Button Link</b> </label>
														<input type="text" class="form-control" id="b_btnlink_1" placeholder="Button Link">
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-sm-12">
													<div class="form-group">
														<label class="col-form-label" for="b_description_1"><b>Short Description</b> <span class="text-danger">*</span> </label>
														<textarea class="form-control" rows="8" id="b_description_1" placegolder="Please enter Short Description..."></textarea>
													</div>
												</div>
											</div>
											<div class="row ml-1">
												<div class="col-sm-12 col-12 register-new-product-picture-para-box">
													<div class="row register-new-product-picture-para">
														<div class="col-sm-2 image-overlay upload-photo-box" id="imageAttach-btn" onclick="form1(1);" style="">
															<img src="{{ url('/assets-admin') }}/images/admin/upload.svg" alt="" width="50">
															<p>Min : 1170 X 880</p>
														</div>
														<div class="col-sm-9">
															<input type="hidden" id="b_imageDownPath_1" value="">
															<input type="hidden" id="b_imagePath_1" value="">
															<div class="row" id="p_att_1">

															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="save-admin-center mt-3">
												<button type="button" class="btn btn-rounded btn-success" ng-click="saveHeadertabsData(1);">Save</button>
											</div>
										</form>
									</div>
								</div>
							</div>
							<div class="tab-pane fade" id="banner_2" role="tabpanel">
								<div class="pt-4">
									<div class="form-validation">
										<form class="form-valide" >
											<div class="row">
												<div class="col-sm-6">
													<div class="form-group">
														<label class="col-form-label" for="b_title_2"><b>Title</b><span class="text-danger">*</span> </label>
														<input type="text" class="form-control" id="b_title_2" placeholder="Enter a title">
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-sm-6">
													<div class="form-group">
														<label class="col-form-label" for="b_btntext_2"><b>Button Text</b><span class="text-danger">*</span> </label>
														<input type="text" class="form-control" id="b_btntext_2" name="btntext1" placeholder="Button Text">
													</div>
												</div>
												<div class="col-sm-6">
													<div class="form-group">
														<label class="col-form-label" for="b_btnlink_2"><b>Button Link</b> </label>
														<input type="text" class="form-control" id="b_btnlink_2" placeholder="Button Link">
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-sm-12">
													<div class="form-group">
														<label class="col-form-label" for="b_description_2"><b>Short Description</b> <span class="text-danger">*</span> </label>
														<textarea class="form-control" rows="8" id="b_description_2" placegolder="Please enter Short Description..."></textarea>
													</div>
												</div>
											</div>
											<div class="row ml-1">
												<div class="col-sm-12 col-12 register-new-product-picture-para-box">
													<div class="row register-new-product-picture-para">
														<div class="col-sm-2 image-overlay upload-photo-box" id="imageAttach-btn" onclick="form1(2);" style="">
															<img src="{{ url('/assets-admin') }}/images/admin/upload.svg" alt="" width="50">
															<p>Min : 1170 X 880</p>
														</div>
														<div class="col-sm-9">
															<input type="hidden" id="b_imageDownPath_2" value="">
															<input type="hidden" id="b_imagePath_2" value="">
															<div class="row" id="p_att_2">

															</div>
														</div>


													</div>
												</div>
											</div>

											<div class="save-admin-center mt-3">
												<button type="button" class="btn btn-rounded btn-success" ng-click="saveHeadertabsData(2);">Save</button>
											</div>
										</form>
									</div>
								</div>
							</div>
							<div class="tab-pane fade" id="banner_3" role="tabpanel">
								<div class="pt-4">
									<div class="form-validation">
										<form class="form-valide" >
											<div class="row">
												<div class="col-sm-6">
													<div class="form-group">
														<label class="col-form-label" for="b_title_3"><b>Title</b><span class="text-danger">*</span> </label>
														<input type="text" class="form-control" id="b_title_3" placeholder="Enter a title">
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-sm-6">
													<div class="form-group">
														<label class="col-form-label" for="b_btntext_3"><b>Button Text</b><span class="text-danger">*</span> </label>
														<input type="text" class="form-control" id="b_btntext_3" placeholder="Button Text">
													</div>
												</div>
												<div class="col-sm-6">
													<div class="form-group">
														<label class="col-form-label" for="b_btnlink_3"><b>Button Link</b> </label>
														<input type="text" class="form-control" id="b_btnlink_3" placeholder="Button Link">
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-sm-12">
													<div class="form-group">
														<label class="col-form-label" for="b_description_3"><b>Short Description</b> <span class="text-danger">*</span> </label>
														<textarea class="form-control" rows="8" id="b_description_3" placegolder="Please enter Short Description..."></textarea>
													</div>
												</div>
											</div>
											<div class="row ml-1">
												<div class="col-sm-12 col-12 register-new-product-picture-para-box">
													<div class="row register-new-product-picture-para">
														<div class="col-sm-2 image-overlay upload-photo-box" id="imageAttach-btn" onclick="form1(3);" style="">
															<img src="{{ url('/assets-admin') }}/images/admin/upload.svg" alt="" width="50">
															<p>Min : 1170 X 880</p>
														</div>
														<div class="col-sm-9">
															<input type="hidden" id="b_imageDownPath_3" value="">
															<input type="hidden" id="b_imagePath_3" value="">
															<div class="row" id="p_att_3">

															</div>
														</div>


													</div>
												</div>
											</div>

											<div class="save-admin-center mt-3">
												<button type="button" class="btn btn-rounded btn-success" ng-click="saveHeadertabsData(3);">Save</button>
											</div>
										</form>
									</div>
								</div>
							</div>
							<div class="tab-pane fade" id="banner_4" role="tabpanel">
								<div class="pt-4">
									<div class="form-validation">
										<form class="form-valide" >
											<div class="row">
												<div class="col-sm-6">
													<div class="form-group">
														<label class="col-form-label" for="b_title_4"><b>Title</b><span class="text-danger">*</span> </label>
														<input type="text" class="form-control" id="b_title_4" placeholder="Enter a title">
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-sm-6">
													<div class="form-group">
														<label class="col-form-label" for="b_btntext_4"><b>Button Text</b><span class="text-danger">*</span> </label>
														<input type="text" class="form-control" id="b_btntext_4" placeholder="Button Text">
													</div>
												</div>
												<div class="col-sm-6">
													<div class="form-group">
														<label class="col-form-label" for="b_btnlink_4"><b>Button Link</b> </label>
														<input type="text" class="form-control" id="b_btnlink_4" placeholder="Button Link">
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-sm-12">
													<div class="form-group">
														<label class="col-form-label" for="b_description_4"><b>Short Description</b> <span class="text-danger">*</span> </label>
														<textarea class="form-control" rows="8" id="b_description_4" placegolder="Please enter Short Description..."></textarea>
													</div>
												</div>
											</div>
											<div class="row ml-1">
												<div class="col-sm-12 col-12 register-new-product-picture-para-box">
													<div class="row register-new-product-picture-para">
														<div class="col-sm-2 image-overlay upload-photo-box" id="imageAttach-btn" onclick="form1(4);" style="">
															<img src="{{ url('/assets-admin') }}/images/admin/upload.svg" alt="" width="50">
															<p>Min : 1170 X 880</p>
														</div>
														<div class="col-sm-9">
															<input type="hidden" id="b_imageDownPath_4" value="">
															<input type="hidden" id="b_imagePath_4" value="">
															<div class="row" id="p_att_4">

															</div>
														</div>


													</div>
												</div>
											</div>

											<div class="save-admin-center mt-3">
												<button type="button" class="btn btn-rounded btn-success" ng-click="saveHeadertabsData(4);">Save</button>
											</div>
										</form>
									</div>
								</div>
							</div>
							<div class="tab-pane fade" id="banner_5" role="tabpanel">
								<div class="pt-4">
									<div class="form-validation">
										<form class="form-valide" >
											<div class="row">
												<div class="col-sm-6">
													<div class="form-group">
														<label class="col-form-label" for="b_title_5"><b>Title</b><span class="text-danger">*</span> </label>
														<input type="text" class="form-control" id="b_title_5" placeholder="Enter a title">
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-sm-6">
													<div class="form-group">
														<label class="col-form-label" for="b_btntext_5"><b>Button Text</b><span class="text-danger">*</span> </label>
														<input type="text" class="form-control" id="b_btntext_5" placeholder="Button Text">
													</div>
												</div>
												<div class="col-sm-6">
													<div class="form-group">
														<label class="col-form-label" for="b_btnlink_5"><b>Button Link</b> </label>
														<input type="text" class="form-control" id="b_btnlink_5" placeholder="Button Link">
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-sm-12">
													<div class="form-group">
														<label class="col-form-label" for="b_description_5"><b>Short Description</b> <span class="text-danger">*</span> </label>
														<textarea class="form-control" rows="8" id="b_description_5" placegolder="Please enter Short Description..."></textarea>
													</div>
												</div>
											</div>
											<div class="row ml-1">
												<div class="col-sm-12 col-12 register-new-product-picture-para-box">
													<div class="row register-new-product-picture-para">
														<div class="col-sm-2 image-overlay upload-photo-box" id="imageAttach-btn" onclick="form1(5);" style="">
															<img src="{{ url('/assets-admin') }}/images/admin/upload.svg" alt="" width="50">
															<p>Min : 1170 X 880</p>
														</div>
														<div class="col-sm-9">
															<input type="hidden" id="b_imageDownPath_5" value="">
															<input type="hidden" id="b_imagePath_5" value="">
															<div class="row" id="p_att_5">

															</div>
														</div>


													</div>
												</div>
											</div>

											<div class="save-admin-center mt-3">
												<button type="button" class="btn btn-rounded btn-success" ng-click="saveHeadertabsData(5);">Save</button>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

		</div>

		<!-- row -->
		<form class="" id="uploadattch1" method="POST" action="uploadBestSellerImage" enctype="multipart/form-data">
			<input type="hidden" name="_method" value="POST">
		    {{ csrf_field() }}
           	<input type="hidden" id="userId" name="userId" value="<?php echo session('userId');?>">
			<input type="hidden" id="sourceId1" name="sourceId" value="">
			<input type="hidden" id="sourceCode1" name="sourceCode" value="BEST_SELLER">
			<input type="file" id="uploadatt11" name="uploadattl" class="file-input" style="display: none;">
		</form>

		<div class="row">
			<div class="col-xl-12 col-xxl-12">
				<div class="card">
					<div class="card-header">
						<h4 class="card-title">Best Seller</h4>
					</div>
					<div class="card-body">
						<div class="form-validation">
							<form class="form-valide" >
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<label class="col-form-label" for="text"><b>Title</b> <span class="text-danger">*</span> </label>
											<input type="text" class="form-control" id="bs_title_1" placeholder="Enter a text">
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label class="col-form-label" for="snl"><b>Heading</b> <span class="text-danger">*</span> </label>
											<input type="text" class="form-control" id="bs_heading_1" placeholder="Enter a Shop now link">
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-sm-6">
										<label for="product">Product</label>
										<select class="form-control" id="bs_product_1" >
											<option value="">--SELECT--</option>
											<option ng-repeat="row in productLov" value="@{{row.id}}">@{{row.name}}</option>
										</select>
									</div>
								</div>
								<div class="row ml-1 mt-4">
									<div class="col-sm-12 col-12 register-new-product-picture-para-box">
										<div class="row register-new-product-picture-para">
											<div class="col-sm-2 image-overlay upload-photo-box" id="" onclick="form2(1);" style="">
												<img src="{{ url('/assets-admin') }}/images/admin/upload.svg" alt="" width="50">
												<p>Min : 630 X 580</p>
											</div>
											<div class="col-sm-9">
												<input type="hidden" id="bs_imageDownPath_1" value="">
												<input type="hidden" id="bs_imagePath_1" value="">
												<div class="row" id="p_att_bs_1">

												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="save-admin-center mt-3">
									<button type="button" class="btn btn-rounded btn-success mobile-save-btn" ng-click="saveBestSellerExclusiveDetail(1);">Save</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>

		</div>
		<!-- -------- -->
		<!-- row -->
		<div class="row">
			<div class="col-xl-12 col-xxl-12">
				<div class="card">
					<div class="card-header">
						<h4 class="card-title">Online exclusive</h4>
					</div>
					<div class="card-body">
						<div class="form-validation">
							<form class="form-valide" >
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<label class="col-form-label" for="bs_title_2"><b>Title</b> <span class="text-danger">*</span> </label>
											<input type="text" class="form-control" id="bs_title_2" placeholder="Enter a text">
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label class="col-form-label" for="bs_heading_2"><b>Heading</b> <span class="text-danger">*</span> </label>
											<input type="text" class="form-control" id="bs_heading_2" placeholder="Enter a Shop now link">
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-sm-6">
										<label for="product">Product</label>
										<select class="form-control" id="bs_product_2" >
											<option value="">--SELECT--</option>
											<option ng-repeat="row in productLov" value="@{{row.id}}">@{{row.name}}</option>
										</select>
									</div>
								</div>
								<div class="row ml-1 mt-4">
									<div class="col-sm-12 col-12 register-new-product-picture-para-box">
										<div class="row register-new-product-picture-para">
											<div class="col-sm-2 image-overlay upload-photo-box" id="" onclick="form2(2);" style="">
												<img src="{{ url('/assets-admin') }}/images/admin/upload.svg" alt="" width="50">
												<p>Min : 630 X 580</p>
											</div>
											<div class="col-sm-9">
												<input type="hidden" id="bs_imageDownPath_2" value="">
												<input type="hidden" id="bs_imagePath_2" value="">
												<div class="row" id="p_att_bs_2">

												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="save-admin-center mt-3">
									<button type="button" class="btn btn-rounded btn-success mobile-save-btn" ng-click="saveBestSellerExclusiveDetail(2);">Save</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>

		</div>
		<!-- -------------- -->

		<!-- ------ Trending Products -->
		<div class="row">
			<div class="col-xl-12 col-xxl-12">
				<div class="card">
					<div class="card-header">
						<h4 class="card-title">Trending Products</h4>
					</div>
					<div class="card-body">
						<div class="form-validation">
							<div class="row">
								<div class="col-sm-4">
									<div class="form-group">
										<label for="t1"> Product Category </label>
										<select class="form-control" id="t1" ng-model="trending['T_1']"
												ng-options="item as item.name for item in categoryLov track by item.id"
												ng-change="getproductsfromcategory();">
											<option value="">--SELECT--</option>
										</select>
									</div>
								</div>
								<div class="col-sm-4">
									<div class="form-group">
										<label for="t2"> Product </label>
										<select class="form-control" id="t2" ng-model="trending['T_2']"
												ng-options="item as item.name for item in categoryProductLov track by item.id">
											<option value="">--SELECT--</option>
										</select>
									</div>
								</div>
								<div class="col-sm-4 align-center-verticle">
									<button type="button" class="btn btn-rounded btn-warning mt-2  cmbm-6vw" type="button" style="width: 100%;" ng-click="saveTrendingProduct();">Add</button>
								</div>
							</div>


							<div class="table-responsive">
								<table id="trendingTable" class="display min-w850">
									<thead>
										<tr>
											<th>Seq</th>
											<th>Name</th>
											<th>Category</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<tr ng-repeat="row in displayCollectionTrendingList">
											<td>@{{row.seqNo}}</td>
											<td>@{{row.PRODUCT_NAME}}</td>
											<td>@{{row.CATEGORY_NAME}}</td>

											<td>
												<div class="dropdown ml-auto text-right">
													<div class="btn-link" data-toggle="dropdown">
														<svg width="24px" height="24px" viewBox="0 0 24 24"
															version="1.1">
															<g stroke="none" stroke-width="1" fill="none"
																fill-rule="evenodd">
															<rect x="0" y="0" width="24" height="24"></rect>
															<circle fill="#000000" cx="5" cy="12" r="2"></circle>
															<circle fill="#000000" cx="12" cy="12" r="2"></circle>
															<circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg>
													</div>
													<div class="dropdown-menu dropdown-menu-right">
														<a class="dropdown-item" href="javascript:;" ng-click="removeSectionRecord(row.SECTION_ID);">Remove</a>
													</div>
												</div>
											</td>
										</tr>
									</tbody>
								</table>
							</div>

						</div>
					</div>
				</div>
			</div>

		</div>
		<!-- -------------------------- -->
		<!-- ------ Today Offer -->
		<div class="row">
			<div class="col-xl-12 col-xxl-12">
				<div class="card">
					<div class="card-header">
						<h4 class="card-title">Today Offer</h4>
					</div>
					<div class="card-body">
						<div class="form-validation">
							<div class="row">
								<div class="col-sm-4">
									<div class="form-group">
										<label for="product_category"> Title </label>
										<input type="text" class="form-control" id="to1" ng-model="offer['T_1']">
									</div>
								</div>
								<div class="col-sm-4">
									<div class="form-group">
										<label for="t1"> Product Category </label>
										<select class="form-control" id="to2" ng-model="offer['T_2']"
												ng-options="item as item.name for item in categoryLov track by item.id"
												ng-change="getproductsfromcategory2();">
											<option value="">--SELECT--</option>
										</select>
									</div>
								</div>
								<div class="col-sm-4">
									<div class="form-group">
										<label for="t2"> Product </label>
										<select class="form-control" id="to3" ng-model="offer['T_3']"
												ng-options="item as item.name for item in categoryProductOfferLov track by item.id">
											<option value="">--SELECT--</option>
										</select>
									</div>
								</div>
								<div class="col-sm-4">
									<div class="form-group">
										<label for="offer_duration"> Offer End Time </label>
										<input type="datetime-local" class="form-control" id="to4" ng-model="offer['T_4']">

									</div>
								</div>
								<div class="col-sm-4">
									<div class="form-group">
										<label for="product_category"> Description </label>
										<input type="text" class="form-control" id="to5" ng-model="offer['T_5']">
									</div>
								</div>
								<div class="col-sm-2 align-center-verticle">
									<button class="btn btn-rounded btn-warning mt-2  cmbm-6vw" type="button" ng-click="saveTodayofferDetails();"style="width: 100%;">Add</button>
								</div>
								<div class="col-sm-2 align-center-verticle">
									<button class="btn btn-rounded btn-warning mt-2  cmbm-6vw" type="button" ng-click="resetOfferForm();"style="width: 100%;">Reset</button>
								</div>
							</div>


							<div class="table-responsive">
								<table id="todayofferTable" class="display min-w850">
									<thead>
										<tr>
											<th>Seq</th>
											<th>Title</th>
											<th>End Time</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<tr ng-repeat="row in displayCollectionOffersList">
											<td>@{{row.seqNo}}</td>
											<td>@{{row.OFFER_TITLE}}</td>
											<td>@{{row.OFFER_END_DATE}}</td>

											<td>
												<div class="dropdown ml-auto text-right">
													<div class="btn-link" data-toggle="dropdown">
														<svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
															<g stroke="none" stroke-width="1" fill="none"
																fill-rule="evenodd">
															<rect x="0" y="0" width="24" height="24"></rect>
															<circle fill="#000000" cx="5" cy="12" r="2"></circle>
															<circle fill="#000000" cx="12" cy="12" r="2"></circle>
															<circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg>
													</div>
													<div class="dropdown-menu dropdown-menu-right">
														<a class="dropdown-item" href="javascript:;" ng-click="editOffer(@{{row.OFFER_ID}});">Edit</a>
														<a class="dropdown-item" href="javascript:;" ng-click="removeOffer(@{{row.OFFER_ID}});">Remove</a>
													</div>
												</div>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>

		</div>
		<!-- -------------------------- -->

		<!-- ------ Created For You -->
		<div class="row">
			<div class="col-xl-12 col-xxl-12">
				<div class="card">
					<div class="card-header">
						<h4 class="card-title">Created For You</h4>
					</div>
					<div class="card-body">
						<div class="form-validation">
							<div class="row">
								<div class="col-sm-4">
									<div class="form-group">
										<label for="t1"> Product Category </label>
										<select class="form-control" id="t11" ng-model="trending1['T_1']"
												ng-options="item as item.name for item in categoryLov track by item.id"
												ng-change="getproductsfromcategory1();">
											<option value="">--SELECT--</option>
										</select>
									</div>
								</div>
								<div class="col-sm-4">
									<div class="form-group">
										<label for="t2"> Product </label>
										<select class="form-control" id="t12" ng-model="trending1['T_2']"
												ng-options="item as item.name for item in categoryProductfyLov track by item.id">
											<option value="">--SELECT--</option>
										</select>
									</div>
								</div>
								<div class="col-sm-4 align-center-verticle">
									<button type="button" class="btn btn-rounded btn-warning mt-2  cmbm-6vw" type="button" style="width: 100%;" ng-click="saveForyouProduct();">Add</button>
								</div>
							</div>


							<div class="table-responsive">
								<table id="foryouTable" class="display min-w850">
									<thead>
										<tr>
											<th>Seq</th>
											<th>Name</th>
											<th>Category</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<tr ng-repeat="row in displayCollectionForyouList">
											<td>@{{row.seqNo}}</td>
											<td>@{{row.PRODUCT_NAME}}</td>
											<td>@{{row.CATEGORY_NAME}}</td>

											<td>
												<div class="dropdown ml-auto text-right">
													<div class="btn-link" data-toggle="dropdown">
														<svg width="24px" height="24px" viewBox="0 0 24 24"
															version="1.1">
															<g stroke="none" stroke-width="1" fill="none"
																fill-rule="evenodd">
															<rect x="0" y="0" width="24" height="24"></rect>
															<circle fill="#000000" cx="5" cy="12" r="2"></circle>
															<circle fill="#000000" cx="12" cy="12" r="2"></circle>
															<circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg>
													</div>
													<div class="dropdown-menu dropdown-menu-right">
														<a class="dropdown-item" href="javascript:;" ng-click="removeSectionRecord(row.SECTION_ID);">Remove</a>
													</div>
												</div>
											</td>
										</tr>
									</tbody>
								</table>
							</div>

						</div>
					</div>
				</div>
			</div>

		</div>
		<!-- -------------------------- -->

	</div>




	<!-- --------------- ADD Created for you Product Image -->
	<div class="modal fade add_for_you_image" tabindex="-1" role="dialog"
		aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Add Image(Created for you product)</h5>
					<button type="button" class="close" data-dismiss="modal">
						<span>&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div id="lightgallery" class="row">
						<a href="images/big/img1.jpg"
							data-exthumbimage="images/big/img1.jpg"
							data-src="images/big/img1.jpg" class="col-lg-3 col-md-6 mb-4"> <img
							src="http://www.jusoutbeauty.com/site/themes/images/admin/big/img1.jpg"
							style="width: 100%;" />
						</a>
					</div>
					<div>
						<div class="input-group">
							<div class="custom-file">
								<input type="cfupimg" class="custom-file-input"> <label
									class="custom-file-label">Choose file</label>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger light"
						data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary">Save changes</button>
				</div>
			</div>
		</div>
	</div>


	<!-- ------------------------------------------------ -->
	<!-------------- Add Offer Product --------------->
	<div class="modal fade add-offer-product" tabindex="-1" role="dialog"
		aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Add Product to offer</h5>
					<button type="button" class="close" data-dismiss="modal">
						<span>&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-sm-4">
							<div class="form-group">
								<label for="product_category"> Product Category </label> <select
									class="form-control" id="product_category"
									name="product_category">
									<option value="">--SELECT--</option>
									<option value="">Lips Beauty</option>
								</select>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="form-group">
								<label for="product_category"> Product </label> <select
									class="form-control" id="product" name="product">
									<option value="">--SELECT--</option>
									<option value="">Red Lipstick</option>
									<option value="">Blue Lipstick</option>
								</select>
							</div>
						</div>

						<div class="col-sm-4 align-center-verticle">
							<button class="btn btn-rounded btn-warning mt-2" tyupe="button"
								style="width: 100%;">Add</button>
						</div>
					</div>


					<div class="table-responsive">
						<table id="example5" class="display min-w850">
							<thead>
								<tr>
									<th>Seq</th>
									<th>Name</th>
									<th>Category</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>1</td>
									<td>Red Lipstick</td>
									<td>Lips Beauty</td>

									<td>
										<div class="dropdown ml-auto text-right">
											<div class="btn-link" data-toggle="dropdown">
												<svg width="24px" height="24px" viewBox="0 0 24 24"
													version="1.1">
													<g stroke="none" stroke-width="1" fill="none"
														fill-rule="evenodd">
													<rect x="0" y="0" width="24" height="24"></rect>
													<circle fill="#000000" cx="5" cy="12" r="2"></circle>
													<circle fill="#000000" cx="12" cy="12" r="2"></circle>
													<circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg>
											</div>
											<div class="dropdown-menu dropdown-menu-right">
												<a class="dropdown-item" href="javascript:;" ng-click="removeSectionRecord(row.SECTION_ID);">Remove</a>
											</div>
										</div>
									</td>
								</tr>


							</tbody>
						</table>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger light"
						data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
	<!-- ------------------------------ -->
	<!-- ----------------------- Update Offer---------------------- -->
	<div class="modal fade updateoffer" tabindex="-1" role="dialog"
		aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Update offer</h5>
					<button type="button" class="close" data-dismiss="modal">
						<span>&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label for="product_category"> Title </label> <input type="text"
									class="form-control" name="offer_title" id="offer_title">
							</div>
						</div>

						<div class="col-sm-6">
							<div class="form-group">
								<label for="offer_duration"> Offer End Time </label> <input
									type="datetime-local" name="offer_duration" id="offer_duration"
									class="form-control">

							</div>
						</div>
					</div>
					<div class="col-sm-4 align-center-verticle"></div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger light"
						data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary">Save changes</button>
				</div>
			</div>
		</div>
	</div>
	<!-- --------------------------------------- -->
</div>
<!--**********************************
            Content body end
        ***********************************-->



</div>
@include('admin.admin-footer');

<script src="{{ url('/assets-admin') }}/customjs/script_adminhomeuser.js?v={{time()}}"></script>

<script>

	    function form1(flag){
		    $("#sourceId").val(flag);
	    	$("#uploadattl").click();
	    }
	    function form2(flag){
		    $("#sourceId1").val(flag);
	    	$("#uploadatt11").click();
	    }

   	</script>
