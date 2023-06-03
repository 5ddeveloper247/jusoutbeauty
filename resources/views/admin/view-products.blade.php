@include('admin.admin-header')
<script>
var userId = '<?php echo session('userId');?>';
var site = '<?php echo session('site');?>';
var baseurl = "<?php echo url('/assets-admin');?>";
</script>
	<div ng-app="project1">
        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body" ng-controller="projectinfo1">
            <div class="container-fluid pt-0" ng-show="editView == '0'">
                <!-- row -->
				<div class="row mt-4">
                	<div class="col-6 ">
                		<div class="page-titles pt-0 pb-0 mb-0">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="javascript:void(0)">Products</a></li>
								<li class="breadcrumb-item active"><a href="javascript:void(0)">View All</a></li>
							</ol>
		                </div>
                	</div>
					<div class="col-3">
						<a type="button" class="btn btn-rounded btn-warning admin-view-add mb-3" href="javascript:void(0)" ng-click="quickAddProduct();">Quick Add Product</a>
					</div>
                   	<div class="col-3">
                       <a type="button" class="btn btn-rounded btn-warning admin-view-add mb-3 float-left" href="javascript:void(0)" ng-click="addNew();">Add new Product</a>
                   	</div>
                </div>
				

                <div class="row">
					<div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Product</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="productsTable" class="display min-w850">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Product Name</th>
                                                <th>Price</th>
                                                <th>Category</th>
                                                <th>Sub Category.</th>
                                                <th>Stock Status</th>
                                                <th>Product Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tablecontents">
											
                                            <tr class="row1" data-id="@{{row.PRODUCT_ID}}" ng-repeat="row in displayCollection">
												
                                                <td>@{{row.PRODUCT_ID}}</td>
                                                <td>@{{row.NAME}}</td>
                                                <td>$@{{row.UNIT_PRICE}}</td>
                                                <td>@{{row.CATEGORY_NAME}}</td>
                                                <td>@{{row.SUB_CATEGORY_NAME}}</td>
                                                
												
                                                <td>
													<span class="badge light badge-success">
														<i class="fa fa-circle text-success mr-1"></i>
														Available
													</span>
												</td>
												<td>
													<span class="badge light badge-danger" ng-if="row.STATUS == 'inactive'">
														<i class="fa fa-circle text-danger mr-1"></i>
														InActive
													</span>
													<span class="badge light badge-success" ng-if="row.STATUS == 'active'">
														<i class="fa fa-circle text-success mr-1"></i>
														Active
													</span>
												</td>
                                                <td>
													<div class="dropdown ml-auto text-right">
														<div class="btn-link" data-toggle="dropdown">
															<svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg>
														</div>
														<div class="dropdown-menu dropdown-menu-right">
															<a class="dropdown-item" href="javascript:;" ng-click="changeStatusProduct(@{{row.PRODUCT_ID}});" ng-show="row.STATUS != 'active'">Active</a>
															<a class="dropdown-item" href="javascript:;" ng-click="changeStatusProduct(@{{row.PRODUCT_ID}});" ng-show="row.STATUS == 'active'">InActive</a>
															<a class="dropdown-item" href="javascript:;" ng-click="continouRecord(@{{row.PRODUCT_ID}});">Edit</a>
															<a class="dropdown-item" href="javascript:;" ng-click="quickEditProduct(@{{row.PRODUCT_ID}});">Quick Edit</a>
															<a class="dropdown-item" href="javascript:;" ng-click="deleteProduct(@{{row.PRODUCT_ID}});">Delete</a>
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
            
            
            <!-- ==================== ADD PRODUCT HTML ================= -->

			<div class="container-fluid pt-0" ng-show="editView == '1'">
				<div class="page-titles pt-0 mb-0">
					<ol class="breadcrumb">
						
						<li class="breadcrumb-item" ng-click="backToListing();"><i class="fa fa-arrow-left p-1"></i> &nbsp;<a href="javascript:void(0)">Product</a></li>
						<!-- <li class="breadcrumb-item active"><a href="javascript:void(0)">Process</a></li> -->
					</ol>
				</div>
				<!-- row -->
				<div class="row">
					<div class="col-xl-12 col-xxl-12">
						<div class="card">
							<div class="card-header">
								<h4 class="card-title">Basic Information</h4>
							</div>
							<div class="card-body">
								<!-- Nav tabs -->
								<ul class="nav nav-tabs" role="tablist">
									<li class="nav-item"><a class="nav-link active"
										data-toggle="tab" href="#basic_info"> <span> Basic Info </span>
									</a></li>
									<li class="nav-item"><a class="nav-link" data-toggle="tab"
										href="#description"> <span> Section Two Information </span>
									</a></li>
								</ul>
								<!-- Tab panes -->
								<div class="tab-content tabcontent-border">
									<div class="tab-pane fade show active" id="basic_info" role="tabpanel">
										<div class="pt-4">
											<div class="form-validation">
												<form class="form-valide" action="#" method="post">
													<div class="row">
														<div class="col-sm-6">
															<div class="form-group">
	
																<label class="col-form-label" for="name"><b>Product Name</b>  <span class="text-danger">*</span>  </label> 
																<input type="text" class="form-control" id="title" ng-model="product['P_1']" placeholder="Enter a Product Name">
	
															</div>
														</div>
														<div class="col-sm-6">
															<div class="form-group">
	
																<label class="col-form-label" for="sub_title"><b>Sub Title</b> </label> 
																<input type="text" class="form-control" id="sub_title" ng-model="product['P_2']" placeholder="Enter Sub title">
	
															</div>
														</div>
	
													</div>
	
													<div class="row">
														<div class="col-sm-6">
															<div class="form-group">
	
																<label class="col-form-label" for="unit"><b>Unit Size</b> </label>
																<input type="text" class="form-control" id="unit" ng-model="product['P_3']" placeholder="Unit">
	
															</div>
														</div>
														<div class="col-sm-6">
															<div class="form-group">
	
																<label class="col-form-label" for="brand"><b>Minimum Purchase Qty</b> <span class="text-danger">*</span> </label>
																<input type="number" class="form-control" id="p4" ng-model="product['P_4']" placeholder="Enter Minimum Purchase Quantity">
	
															</div>
														</div>
	
													</div>
													<div class="row">
														<div class="col-sm-6">
															<div class="form-group">
	
																<label class="col-form-label" for="tags"><b>Tags</b> <span class="text-danger">*</span> </label> 
																<input type="text" class="form-control" id="tags" ng-model="product['P_5']" placeholder="Tags"> 
																<small>This is used for search.Customer Search by these Tags.</small>
	
															</div>
														</div>
														<div class="col-sm-6">
															<div class="form-group">
	
																<label class="col-form-label" for="barcode"><b>Barcode</b> </label> 
																<input type="text" class="form-control" id="barcode" ng-model="product['P_6']" placeholder="Enter Barcode">
	
															</div>
														</div>
	
													</div>
	
													<div class="row">
														<div class="col-sm-4 col-6">
															<div class="custom-control custom-checkbox mb-3 checkbox-warning">
																<input type="checkbox" class="custom-control-input" id="refundable" ng-model="product['P_7']"> 
																<label class="custom-control-label" for="refundable">Refundable</label>
															</div>
														</div>
													</div>
													<div class="row">
														<div class="col-sm-6">
															<div class="form-group">
																<label class="col-form-label" for="tags"><b>Porduct Category</b> <span class="text-danger">*</span></label> 
																<select class="form-control" id="p8" ng-model="product['P_8']"
																	ng-change="getSubCategoriesWrtCategory();"
																	ng-options="item as item.name for item in categoryLov track by item.id">
										                        	<option value="">---SELECT---</option>
										                        </select>
															</div>
														</div>
														<div class="col-sm-6">
															<div class="form-group">
	
																<label class="col-form-label" for="sub_category"><b>Product Sub Category</b> <span class="text-danger">*</span> </label>
																<select class="form-control" id="p9" ng-model="product['P_9']"
																	ng-change="getSubSubCategoriesWrtSubCategory();"
																	ng-options="item as item.name for item in subCategoryLov track by item.id">
										                        	<option value="">---SELECT---</option>
										                        </select>
															</div>
														</div>
													</div>
	
													<div class="row">
														<div class="col-sm-6">
															<div class="form-group">
	
																<label class="col-form-label" for="slug"><b>Slug</b> <span class="text-danger">*</span> </label>
																<input type="text" class="form-control" id="slug" ng-model="product['P_10']" placeholder="Slug">
	
															</div>
														</div>
														<div class="col-sm-6">
															<div class="form-group">
																<label class="col-form-label" for="sub_sub_category"><b>Product Sub Sub Category</b> <span class="text-danger">*</span> </label>
																<select class="form-control" id="p44" ng-model="product['P_44']"
																	ng-options="item as item.name for item in subSubCategoryLov track by item.id">
										                        	<option value="">---SELECT---</option>
										                        </select>
															</div>
														</div>
													</div>
													<div class="row">
							                              <div class="col-12">
							                                  <label><b>Product Features<span class="required-field">*</span></b></label>
							                             <select class="default-placeholder select2-hidden-accessible" id="p45" multiple='multiple' ng-model="product['P_45']"
										                        ng-options="item as item.name for item in featurelov track by item.id"> 
									                              <option value="">---SELECT---</option>
								                         </select>
							                           </div>
							                        </div>
													<br>
													<br>

													<div class="row">
							                              <div class="col-12">
							                                  <label><b>Complete your Jus o Glow<span class="required-field">*</span></b></label>
							                             <select class="default-placeholder select2-hidden-accessible" id="p46" multiple='multiple' ng-model="product['P_46']"
										                        ng-options="item as item.name for item in recommended track by item.id"> 
									                              <option value="">---SELECT---</option>
								                         </select>
							                           </div>
							                        </div>
                                                     <br>
													<br>
													<div class="row">
							                              <div class="col-12">
							                                  <label><b>Your Daily Hand Picked<span class="required-field">*</span></b></label>
							                             <select class="default-placeholder select2-hidden-accessible" id="p47" multiple='multiple' ng-model="product['P_47']"
										                        ng-options="item as item.name for item in handpickedlov track by item.id"> 
									                              <option value="">---SELECT---</option>
								                         </select>
							                           </div>
							                        </div>
													<br>
													<br>

													<div class="row">
														<div class="col-sm-12">
															<label class="col-form-label" for="short_description"><b>Short Description</b></label>
															<textarea class="form-control" id="short_description" rows="8" ng-model="product['P_11']" placeholder="Enter Short Description..."></textarea>
														</div>
													</div>
												</form>
											</div>
										</div>
									</div>
									<div class="tab-pane fade" id="description" role="tabpanel">
										<div class="pt-4">
											<div class="form-group">
												<label id="desc_title">Description Title</label> 
												<input type="text" id="desc_title" class="form-control" ng-model="product['P_12']">
											</div>
											<div class="summernote" id="basicInfo_description"></div>
										</div>
									</div>
								</div>
								<div class="row">
                	               	<div class="col-12 pt-4">
				                       <a type="button" class="btn btn-rounded btn-warning admin-view-add mb-3" ng-click="saveProductBasic();">Save Basic Info</a>
				                   	</div>
		                		</div>
							</div>
	
	
						</div>
	
	
					</div>
				</div>
				<div class="row">
					<div class="col-xl-12 col-xxl-12">
						<div class="card">
							<div class="card-header">
								<h4 class="card-title">Product Media</h4>
							</div>
							<div class="card-body">
								<!-- Nav tabs -->
								<ul class="nav nav-tabs" role="tablist">
									<li class="nav-item">
										<a class="nav-link active" data-toggle="tab" href="#images"> <span> Image </span> </a>
									</li>
									<li class="nav-item">
										<a class="nav-link" data-toggle="tab" href="#video"> <span> Video </span> </a>
									</li>
								</ul>
								<!-- Tab panes -->
								<div class="tab-content tabcontent-border">
									<div class="tab-pane fade show active" id="images" role="tabpanel">
										<div class="pt-4">
											
											<div class=" ml-0 ml-sm-12 ml-sm-0 mt-3">
	
												<div class="compose-content mb-3">
													<form></form>
													<h5 class="mb-4">
														<i class="fa fa-paperclip"></i> Image
													</h5>
													<div class="col-sm-12 col-12 register-new-product-picture-para-box">
														<div class="row register-new-product-picture-para">
															<div class="col-sm-2 image-overlay upload-photo-box" id="imageAttach-btn" onclick="form1();" style="">
																<img src="{{ url('/assets-admin') }}/images/admin/upload.svg" alt="" width="50">
																<p>270 X 370</p>
															</div>
															<div class="col-sm-9">
																<div class="row" id="p_att">
																	
																</div>
															</div>
															<form class="" id="uploadattch" method="POST" action="uploadProductImageAttachment" enctype="multipart/form-data">
																 <input type="hidden" name="_method" value="POST">
			           											
																 {{ csrf_field() }}
			
																<input type="hidden" id="userId" name="userId" value="<?php echo session('userId');?>">
																<input type="hidden" id="sourceId" name="sourceId" value="@{{product.ID}}">
																<input type="hidden" id="sourceCode" name="sourceCode" value="PRODUCT_IMG"> 
																<input type="file" id="uploadattl" name="uploadattl" class="file-input" style="display: none;">

															</form>
					
														</div>
													</div>
													<!-- <form action="#" class="dropzone">
														<div class="fallback">
															<input name="imagefile" type="file" accept="image/*" />
														</div>
													</form> -->
												</div>
											</div>
										</div>
									</div>
									<div class="tab-pane fade" id="video" role="tabpanel">
										<div class="pt-4">
											<div class="row">
												<div class="col-sm-6">
													<div class="form-group">
	
														<label class="col-form-label" for="title"><b>Title</b> </label>
														<input type="text" class="form-control" ng-model="video['V_1']" placeholder="Video Title">
	
													</div>
												</div>
												<div class="col-sm-12 mb-2">
													<label class="col-form-label"><b>Description</b> </label>
	
													<div class="summernote" id="video_description"></div>
												</div>
											</div>
											<div id="lightgallery1" class="row">
												<a class="col-lg-3 col-md-6 mb-4"  ng-show="video.V_3 != ''"> 
<!-- 													<iframe src="https://ak.picdn.net/shutterstock/videos/1066964725/preview/stock-footage-happy-s-middle-aged-mature-woman-touching-facial-skin-looking-at-camera-pampering-in-mirror-old.webm" title="Beauty Product Video"></iframe> -->
													<iframe src="@{{video.V_3}}" title="Beauty Product Video"></iframe>
												</a>
	
											</div>
	
											<div class="col-sm-12 col-12 register-new-product-picture-para-box">
												<div class="row register-new-product-picture-para">
													<div class="col-sm-2 image-overlay upload-photo-box" id="imageAttach-btn" onclick="form2();" style="">
														<img src="{{ url('/assets-admin') }}/images/admin/upload.svg" alt="" width="50">
														<p>Upload Video</p>
													</div>
													<!-- <div class="col-sm-9">
														<div class="row" id="p_att">
															
														</div>
													</div> -->
													<form class="" id="uploadattch2" method="POST" action="uploadProductVideoAttachment" enctype="multipart/form-data">
														<input type="hidden" name="_method" value="POST">
	           											{{ csrf_field() }}
	           											<input type="hidden" id="userId" name="userId" value="<?php echo session('userId');?>">
														<input type="hidden" id="sourceId" name="sourceId" value="@{{product.ID}}">
														<input type="hidden" id="videoId" name="videoId" value="@{{video.ID}}">
														<input type="hidden" id="sourceCode" name="sourceCode" value="PRODUCT_VIDEO"> 
														<input type="file" id="uploadatt2" name="uploadattl" class="file-input" style="display: none;">
													</form>
			
												</div>
											</div>
											
											<div class="row">
			                	               	<div class="col-12 pt-4">
							                       <a type="button" class="btn btn-rounded btn-warning admin-view-add mb-3" ng-click="saveProductVideo();">Save Video</a>
							                   	</div>
					                		</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
	
				<div class="row">
					<div class="col-xl-12 col-xxl-12">
						<div class="card">
							<div class="card-header">
								<h4 class="card-title">Pricing & VAT</h4>
							</div>
							<div class="card-body">
								<!-- Nav tabs -->
								<ul class="nav nav-tabs" role="tablist">
									<li class="nav-item">
										<a class="nav-link active" data-toggle="tab" href="#pricing"> <span> Pricing </span> </a>
									</li>
									<li class="nav-item">
										<a class="nav-link" data-toggle="tab" href="#VAT"> <span> VAT </span> </a>
									</li>
								</ul>
								<!-- Tab panes -->
								<div class="tab-content tabcontent-border">
									<div class="tab-pane fade show active" id="pricing"
										role="tabpanel">
										<div class="pt-4">
											<div class="row">
												<div class="col-sm-6">
													<div class="form-group">
														<label class="col-form-label" for="unit_price"><b>Unit Price<span class="text-danger">*</span></b></label> 
														<input type="number" class="form-control" id="p14"  ng-model="product['P_14']" min="0">
													</div>
												</div>
												<!-- <div class="col-sm-6">
													<div class="form-group">
														<label class="col-form-label" for="discount"><b>Discount date range</b> </label>
	
														<div class="row">
															<div class="col-sm-6">
																<input type="text" class="form-control" id="p15"  ng-model="product['P_15']" placeholder="Start Date" onfocus="(this.type='date')" >
															</div>
															<div class="col-sm-6">
																<input type="text" class="form-control" id="p16" ng-model="product['P_16']" placeholder="End Date" onfocus="(this.type='date')" >
															</div>
														</div>
													</div>
												</div> -->
											</div>
	
											<div class="row">
												<div class="col-sm-6">
													<div class="form-group">
														<label class="col-form-label" for="discount"><b>Discount<span class="text-danger">*</span></b> </label>
	
														<div class="row">
															<div class="col-sm-6">
																<input type="number" class="form-control" id="p17" ng-model="product['P_17']" min="0">
															</div>
															<div class="col-sm-6">
																<select class="form-control" ng-model="product['P_18']">
																	<option value="">-- select --</option>
																	<option value="Flat">Flat</option>
																	<option value="Percent">Percent</option>
																</select>
															</div>
														</div>
													</div>
												</div>
												<div class="col-sm-6">
													<div class="form-group">
	
														<label class="col-form-label" for="earn_point"><b>Set Point</b> </label> 
														<input type="number" min="0" step="1" id="p19" ng-model="product['P_19']" class="form-control">
	
													</div>
												</div>
											</div>
	
	
											<div class="row">
												<div class="col-sm-6">
													<div class="form-group">
														<label class="col-form-label" for="quantity"><b>Quantity<span class="text-danger">*</span></b> </label> 
														<input type="number" min="0" step="1" id="p20" ng-model="product['P_20']" placeholder="Quantity"class="form-control">
	
													</div>
												</div>
												<div class="col-sm-6">
													<label class="col-form-label" for="sku"><b>SKU</b> </label>
													<input type="text" placeholder="SKU" id="sku" ng-model="product['P_21']" class="form-control">
	
												</div>
	
											</div>
	
											<!-- <div class="row">
												<div class="col-sm-6">
													<div class="form-group">
														<label class="col-form-label" for="external_link"><b>External Link</b> </label> 
														<input type="text" placeholder="External Link" ng-model="product['P_22']" class="form-control"> 
														<small>Leave it blank if you do not use external site link</small>
													</div>
												</div>
												<div class="col-sm-6">
													<label class="col-form-label" for="external_link_btn_txt"><b>External link button text</b> </label> 
													<input type="text" placeholder="External link button text" ng-model="product['P_23']" class="form-control"> 
													<small>Leave it blank if you do not use external site link</small>
												</div>
											</div> -->
										</div>
									</div>
									<div class="tab-pane fade" id="VAT" role="tabpanel">
										<div class="pt-4">
											<div class="row">
												<div class="col-sm-6">
													<div class="form-group">
														<label class="col-form-label" for="tax"><b>TAX</b> </label>
	
														<div class="row">
															<div class="col-sm-6">
																<input type="number" class="form-control" id="p24" ng-model="product['P_24']" min="0" step="0.01">
															</div>
															<div class="col-sm-6">
																<select class="form-control" ng-model="product['P_25']">
																	<option value="">-- select --</option>
																	<option value="Flat">Flat</option>
																	<option value="Percent">Percent</option>
																</select>
															</div>
														</div>
													</div>
												</div>
												<div class="col-sm-6">
													<div class="form-group">
														<label class="col-form-label" for="vat"><b>VAT</b> </label>
	
														<div class="row">
															<div class="col-sm-6">
																<input type="number" class="form-control" id="p26" ng-model="product['P_26']" min="0" step="0.01">
															</div>
															<div class="col-sm-6">
																<select class="form-control" ng-model="product['P_27']">
																	<option value="">-- select --</option>
																	<option value="Flat">Flat</option>
																	<option value="Percent">Percent</option>
																</select>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
	                	               	<div class="col-12 pt-4">
					                       <a type="button" class="btn btn-rounded btn-warning admin-view-add mb-3" ng-click="saveProductPricing();">Save Pricing / VAT</a>
					                   	</div>
			                		</div>
								</div>
							</div>
						</div>
					</div>
				</div>
	
	
				<div class="row">
					<div class="col-xl-12 col-xxl-12">
						<div class="card">
							<div class="card-header">
								<h4 class="card-title">Product Ingredients & Shades</h4>
							</div>
							<div class="card-body">
								<!-- Nav tabs -->
								<ul class="nav nav-tabs" role="tablist">
									<li class="nav-item"><a class="nav-link active"
										data-toggle="tab" href="#ingredients"> <span> Ingredients </span>
									</a></li>
									<li class="nav-item"><a class="nav-link" data-toggle="tab"
										href="#shades"> <span> Shades </span>
									</a></li>
								</ul>
								<!-- Tab panes -->
								<div class="tab-content tabcontent-border">
									<div class="tab-pane fade show active" id="ingredients"
										role="tabpanel">
										<div class="pt-4">
											<div class="row">
												<div class="col-sm-4">
													<div class="form-group">
	
														<label class="col-form-label" for="ing_category"><b>Ingredient Category</b> <span class="text-danger">*</span> </label>
														<select class="form-control" ng-model="ingredient['I_1']" ng-change="getIngredientsWrtCategory();">
															<option value="">---SELECT---</option>
															<option value="Formulated">Formulated</option>
															<option value="Spotlight">Spotlight</option>
														</select>
													</div>
												</div>
												<div class="col-sm-4">
													<div class="form-group">
	
														<label class="col-form-label" for="ingredient"><b>Ingredient</b> <span class="text-danger">*</span> </label> 
														<select class="form-control" id="i2" ng-model="ingredient['I_2']"
																ng-options="item as item.name for item in ingredientsLov track by item.id">
															<option value="">---SELECT---</option>
														</select>
													</div>
												</div>
												<div class="col-sm-4 align-center-verticle">
													<button class="btn btn-rounded btn-warning cmbm-6vw mt-2" ng-click="saveProductIngredient();" style="width: 100%;">Add</button>
												</div>
	
											</div>
											<div class="table-responsive">
												<table id="productIngredientsTable" class="display min-w850">
													<thead>
														<tr>
															<th>Seq</th>
															<th>Ingredient Name</th>
															<th>Ingredient Category</th>
															<th>Action</th>
														</tr>
													</thead>
													<tbody>
														<tr ng-repeat="row in displayCollectionProdIngredients">
															<td>@{{row.seqNo}}</td>
															<td>@{{row.INGREDIENT_NAME}}</td>
															<td>@{{row.INGREDIENT_CATEGORY}}</td>
															<td>
																<div class="dropdown ml-auto text-right">
																	<div class="btn-link" data-toggle="dropdown">
																		<svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"> <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"> <rect x="0" y="0" width="24" height="24"></rect> <circle fill="#000000" cx="5" cy="12" r="2"></circle> <circle fill="#000000" cx="12" cy="12" r="2"></circle> <circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg>
																	</div>
																	<div class="dropdown-menu dropdown-menu-right">
																		<a class="dropdown-item" href="javascript:;" ng-click="deleteProductingredient(@{{row.PRODUCT_INGREDIENT_ID}});">Remove</a>
																	</div>
																</div>
															</td>
														</tr>
														
	
													</tbody>
												</table>
											</div>
										</div>
									</div>
									<div class="tab-pane fade" id="shades" role="tabpanel">
										<div class="pt-4">
											<div class="row">
												<!-- <div class="col-sm-4">
													<div class="form-group">
	
														<label class="col-form-label" for="shade_category"><b>Shade
																Category</b> <span class="text-danger">*</span> </label>
														<select class="form-control" name="shade_category"
															id="shade_category">
															<option vlaue="">---SELECT---</option>
															<option vlaue="1">General</option>
														</select>
													</div>
												</div>
												<div class="col-sm-4">
													<div class="form-group">
	
														<label class="col-form-label" for="shade"><b>Shade</b> <span
															class="text-danger">*</span> </label> <select
															class="form-control" name="shade" id="shade">
															<option vlaue="">---SELECT---</option>
															<option vlaue="1">Multi</option>
														</select>
													</div>
												</div> -->
												<div class="col-sm-4 mb-4"><!-- align-center-verticle -->
													<button class="btn btn-rounded btn-warning mt-2 cmbm-6vw" ng-click="addProductShade();">Add New</button>
												</div>
	
											</div>
											<div class="table-responsive">
												<table id="productShadesTable" class="display min-w850">
													<thead>
														<tr>
															<th>Seq</th>
															<th>Shades Name</th>
															<th>Action</th>
														</tr>
													</thead>
													<tbody>
														<tr ng-repeat="row in displayCollectionProdShades">
															<td>@{{row.seqNo}}</td>
															<td>@{{row.SHADE_NAME}}</td>
															
															<td>
																<div class="dropdown ml-auto text-right">
																	<div class="btn-link" data-toggle="dropdown">
																		<svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"> <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"> <rect x="0" y="0" width="24" height="24"></rect> <circle fill="#000000" cx="5" cy="12" r="2"></circle> <circle fill="#000000" cx="12" cy="12" r="2"></circle> <circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg>
																	</div>
																	<div class="dropdown-menu dropdown-menu-right">
																		<a class="dropdown-item" href="javascript:;" ng-click="editProductShade(@{{row.PRODUCT_SHADE_ID}});">Edit</a>
																		<a class="dropdown-item" href="javascript:;" ng-click="deleteProductShade(@{{row.PRODUCT_SHADE_ID}});">Remove</a>
																	</div>
																</div>
															</td>
														</tr>
														<!-- <tr>
															<td>2</td>
															<td>Red Lipstick</td>
															<td>Lipstick</td>
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
																		<a class="dropdown-item" href="#">Remove</a>
																	</div>
																</div>
															</td>
														</tr> -->
	
													</tbody>
												</table>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xl-12 col-xxl-12">
						<div class="card">
							<div class="card-header">
								<h4 class="card-title">Product Uses</h4>
							</div>
							<div class="card-body">
								<!-- Nav tabs -->
								<ul class="nav nav-tabs" role="tablist">
									<li class="nav-item"><a class="nav-link active"
										data-toggle="tab" href="#step_1"> <span> Steps </span>
									</a></li>
									<!-- <li class="nav-item"><a class="nav-link" data-toggle="tab"
										href="#step_2"> <span> Step 2 </span>
									</a></li>
									<li class="nav-item"><a class="nav-link" data-toggle="tab"
										href="#step_3"> <span> Step 3 </span>
									</a></li> -->
	
								</ul>
								<!-- Tab panes -->
								<div class="tab-content tabcontent-border">
									<div class="tab-pane fade show active" id="step_1" role="tabpanel">
										<div class="pt-4">
											<div class="row">
												
												<div class="col-sm-4 mb-4"><!-- align-center-verticle -->
													<button class="btn btn-rounded btn-warning mt-2 cmbm-6vw" ng-click="addNewUses();">Add New</button>
												</div>
	
											</div>
											<div class="table-responsive">
												<table id="productUsesTable" class="display min-w850">
													<thead>
														<tr>
															<th>Seq</th>
															<th>Title</th>
															<th>Action</th>
														</tr>
													</thead>
													<tbody>
														<tr ng-repeat="row in displayCollectionProdUses">
															<td>@{{row.SEQUENCE_NUM}}</td>
															<td>@{{row.USES_TITLE}}</td>
															
															<td>
																<div class="dropdown ml-auto text-right">
																	<div class="btn-link" data-toggle="dropdown">
																		<svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"> <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"> <rect x="0" y="0" width="24" height="24"></rect> <circle fill="#000000" cx="5" cy="12" r="2"></circle> <circle fill="#000000" cx="12" cy="12" r="2"></circle> <circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg>
																	</div>
																	<div class="dropdown-menu dropdown-menu-right">
																		<a class="dropdown-item" href="javascript:;" ng-click="editProductUses(@{{row.PRODUCT_USES_ID}});">Edit</a>
																		<a class="dropdown-item" href="javascript:;" ng-click="deleteProductUses(@{{row.PRODUCT_USES_ID}});">Remove</a>
																	</div>
																</div>
															</td>
														</tr>
														<!-- <tr>
															<td>2</td>
															<td>Red Lipstick</td>
															<td>Lipstick</td>
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
																		<a class="dropdown-item" href="#">Remove</a>
																	</div>
																</div>
															</td>
														</tr> -->
	
													</tbody>
												</table>
											</div>
										</div>
									</div>
									<!-- <div class="tab-pane fade" id="step_2" role="tabpanel">
										<div class="pt-4">
											<div class="row">
												<div class="col-sm-6">
													<div class="form-group">
														<label class="col-form-label" for="use_title_2"><b>Title</b>
														</label> <input type="text" class="form-control"
															id="use_title_2" name="use_title_2" placeholder="Title">
	
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-sm-12">
													<label class="col-form-label" for="use_image_2"><b>Image</b></label>
													<div class=" ml-0 ml-sm-12 ml-sm-0 mt-3">
	
														<div class="compose-content mb-3">
															<form action="#"></form>
															<h5 class="mb-4">
																<i class="fa fa-paperclip"></i> Image
															</h5>
															<form action="#" class="dropzone">
																<div class="fallback">
																	<input name="use_image_2" type="file" accept="image/*" />
																</div>
															</form>
														</div>
													</div>
												</div>
											</div>
										</div>
	
									</div>
	
	
									<div class="tab-pane fade" id="step_3" role="tabpanel">
										<div class="pt-4">
											<div class="row">
												<div class="col-sm-6">
													<div class="form-group">
														<label class="col-form-label" for="use_title_3"><b>Title</b>
														</label> <input type="text" class="form-control"
															id="use_title_3" name="use_title_3" placeholder="Title">
	
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-sm-12">
													<label class="col-form-label" for="use_image_3"><b>Image</b></label>
													<div class=" ml-0 ml-sm-12 ml-sm-0 mt-3">
	
														<div class="compose-content mb-3">
															<form action="#"></form>
															<h5 class="mb-4">
																<i class="fa fa-paperclip"></i> Image
															</h5>
															<form action="#" class="dropzone">
																<div class="fallback">
																	<input name="use_image_3" type="file" accept="image/*" />
																</div>
															</form>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div> -->
								</div>
							</div>
						</div>
					</div>
				</div>
	
	
				<div class="row">
					<div class="col-xl-12 col-xxl-12">
						<div class="card">
							<div class="card-header">
								<h4 class="card-title">Others</h4>
							</div>
							<div class="card-body">
								<!-- Nav tabs -->
								<ul class="nav nav-tabs" role="tablist">
								<li class="nav-item"><a class="nav-link active" id="clinical_note_new" data-toggle="tab"
										href="#clinical_note"> <span> Clinical Note </span>
									</a></li>	
								<li class="nav-item"><a class="nav-link "
										data-toggle="tab" href="#shipping_conf"> <span> Shipping
												Configurations </span>
									</a></li>
									<li class="nav-item"><a class="nav-link" data-toggle="tab"
										href="#stock_visibility_state"> <span> Stock Visibility State </span>
									</a></li>
									<li class="nav-item"><a class="nav-link" data-toggle="tab"
										href="#deal_setting"> <span> Deal Setting </span>
									</a></li>
									<li class="nav-item"><a class="nav-link" data-toggle="tab"
										href="#flash_deal"> <span> Flash Deal </span>
									</a></li>
									
									<li class="nav-item"><a class="nav-link" data-toggle="tab"
										href="#setting"> <span> Settings </span>
									</a></li>
								</ul>
								<!-- Tab panes -->
								<div class="tab-content tabcontent-border">
									
								<div class="tab-pane fade" id="shipping_conf"
										role="tabpanel">
										<div class="pt-4">
											<div class="row">
												<div class="col-sm-6">
													<div class="form-group">
														<div
															class="custom-control custom-checkbox mb-3 checkbox-warning">
															<input type="checkbox" class="custom-control-input" id="p28" ng-model="product['P_28']"> 
															<label class="custom-control-label pl-4" for="p28">Free Shipping</label>
														</div>
													</div>
												</div>
	
												<div class="col-sm-6">
													<div class="form-group">
														<div
															class="custom-control custom-checkbox mb-3 checkbox-warning">
															<input type="checkbox" class="custom-control-input" id="p29" ng-model="product['P_29']"> 
															<label class="custom-control-label pl-4" for="p29">Is Product Quantity Mulitiply</label>
														</div>
													</div>
												</div>
												<div class="col-sm-6">
													<div class="form-group">
														<div
															class="custom-control custom-checkbox mb-3 checkbox-warning">
															<input type="checkbox" class="custom-control-input" id="p30" ng-model="product['P_30']"> 
															<label class="custom-control-label pl-4" for="p30">Flat Rate</label>
														</div>
													</div>
												</div>
												
	
											</div>
										</div>
									</div>
									<div class="tab-pane fade" id="stock_visibility_state"
										role="tabpanel">
										<div class="pt-4">
											<div class="row">
												<div class="col-sm-6">
													<div class="form-group">
														<div class="custom-control custom-checkbox mb-3 checkbox-warning">
															<input type="checkbox" class="custom-control-input" id="p31" ng-model="product['P_31']"> 
															<label class="custom-control-label pl-4" for="p31">Show Stock Quantity</label>
														</div>
													</div>
												</div>
												<div class="col-sm-6">
													<div class="form-group">
														<div class="custom-control custom-checkbox mb-3 checkbox-warning">
															<input type="checkbox" class="custom-control-input" id="p32" ng-model="product['P_32']"> 
															<label class="custom-control-label pl-4" for="p32">Show Stock with Text Only</label>
														</div>
													</div>
												</div>
											</div>
	
											<div class="row">
												<div class="col-sm-6">
													<div class="form-group">
														<div
															class="custom-control custom-checkbox mb-3 checkbox-warning">
															<input type="checkbox" class="custom-control-input" id="p33" ng-model="product['P_33']"> 
															<label class="custom-control-label pl-4" for="p33">Hide Stock</label>
														</div>
													</div>
												</div>
											</div>
	
										</div>
									</div>
	
									<div class="tab-pane fade" id="deal_setting" role="tabpanel">
										<div class="pt-4">
	
											<div class="row">
												<div class="col-sm-6">
													<div class="form-group">
														<label class="col-form-label" for="p34"><b>Shipping Days</b> </label>
														<input type="number" class="form-control" id="p34" ng-model="product['P_34']" placeholder="Shipping Days">
	
													</div>
												</div>
												<div class="col-sm-6 align-center-verticle pt-5">
													<div class="form-group">
														<div
															class="custom-control custom-checkbox mb-3 checkbox-warning">
															<input type="checkbox" class="custom-control-input" id="p35" ng-model="product['P_35']"> 
															<label class="custom-control-label pl-4" for="p35">Today Deal</label>
														</div>
													</div>
												</div>
	
	
											</div>
										</div>
									</div>
									<div class="tab-pane fade" id="flash_deal" role="tabpanel">
										<div class="pt-4">
											<div class="row">
												<div class="col-sm-6">
													<div class="form-group">
														<label class="col-form-label" for="add_to_flash"><b>Add to Flash </b> </label> 
														<select class="default-placeholder select2-hidden-accessible" id="p36" ng-model="product['P_36']">
															<option value="">Choose Flash</option>
															<option value="Winter Sale">Winter Sale</option>
															<option value="Flash Sale">Flash Sale</option>
															<option value="Electronic">Electronic</option>
															<option value="Flash Deal">Flash Deal</option>
														</select>
	
													</div>
												</div>
												<div class="col-sm-6">
													<div class="form-group">
														<label class="col-form-label" for="discount"><b>Discount </b> </label> 
														<input type="number" id="p37" ng-model="product['P_37']" class="form-control">
	
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-sm-6">
													<div class="form-group">
														<label class="col-form-label" for="discount_type"><b>Discount Type</b> </label> 
														<select class="form-control" id="p38" ng-model="product['P_38']">
															<option value="">Choose Discount Type</option>
															<option value="Flat">Flat</option>
															<option value="Percent">Percent</option>
														</select>
	
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="tab-pane fade" id="setting" role="tabpanel">
										<div class="pt-4">
											<div class="row">
												<div class="col-sm-6">
													<div class="form-group">
														<div class="custom-control custom-checkbox mb-3 checkbox-warning">
															<input type="checkbox" class="custom-control-input" id="p39" ng-model="product['P_39']"> 
															<label class="custom-control-label pl-4" for="p39">Cash On Delivery</label>
														</div>
													</div>
												</div>
												<div class="col-sm-6">
													<div class="form-group">
														<div
															class="custom-control custom-checkbox mb-3 checkbox-warning">
															<input type="checkbox" class="custom-control-input" id="p40" ng-model="product['P_40']"> 
															<label class="custom-control-label pl-4" for="p40">Featured</label>
														</div>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-sm-6">
													<div class="form-group">
														<div class="custom-control custom-checkbox mb-3 checkbox-warning">
															<input type="checkbox" class="custom-control-input" id="p41" ng-model="product['P_41']"> 
															<label class="custom-control-label pl-4" for="p41">Todays Deal</label>
														</div>
													</div>
												</div>
												<div class="col-sm-6">
													<div class="form-group">
														<label class="col-form-label" for="p42"><b>Low Quantity Warning </b> </label> 
														<input type="number" class="form-control" id="p42" ng-model="product['P_42']">
	
													</div>
												</div>
	
											</div>
										</div>
									</div>
	
	
	
									<div class="tab-pane fade show active" id="clinical_note" role="tabpanel">
										<div class="pt-4">
											<div class="row">
	
												<div class="col-sm-12 mb-2">
													<label class="col-form-label"><b>Description</b> </label>
	
													<div class="summernote" id="p43"></div>
												</div>
											</div>
											
											<div class="col-sm-12 col-12 register-new-product-picture-para-box">
												<div class="row register-new-product-picture-para">
													<div class="col-sm-2 image-overlay upload-photo-box" id="imageAttach-btn" onclick="form5();" style="">
														<img src="{{ url('/assets-admin') }}/images/admin/upload.svg" alt="" width="50">
														<p>270 X 370</p>
													</div>
													<div class="col-sm-9">
														<div class="row" id="cn_att">
															
														</div>
													</div>
													<form class="" id="uploadattch5" method="POST" action="uploadProductImageAttachment" enctype="multipart/form-data">
														<input type="hidden" name="_method" value="POST">
	           											{{ csrf_field() }}
	           											<input type="hidden" id="userId" name="userId" value="<?php echo session('userId');?>">
														<input type="hidden" id="sourceId" name="sourceId" value="@{{product.ID}}">
														<input type="hidden" id="sourceCode" name="sourceCode" value="CLINICAL_NOTE"> 
														<input type="file" id="uploadatt5" name="uploadattl" class="file-input" style="display: none;">
													</form>
			
												</div>
											</div>
	
											<div class=" ml-0 ml-sm-12 ml-sm-0 mt-3">
	
												<!-- <div class="compose-content mb-3">
													<form action="#"></form>
													<h5 class="mb-4">
														<i class="fa fa-paperclip"></i> Picture
													</h5>
													<form action="#" class="dropzone">
														<div class="fallback">
															<input name="clinicalfile" type="file" accept="video/*" />
														</div>
													</form>
												</div> -->
											</div>
										</div>
									</div>
									<div class="row">
	                	               	<div class="col-12 pt-4">
					                       <a type="button" class="btn btn-rounded btn-warning admin-view-add mb-3" ng-click="saveProductOtherInfo();">Save Other Info</a>
					                   	</div>
			                		</div>
								</div>
							</div>
						</div>
					</div>
				</div>
	
			</div>
			
			<div class="modal fade" id="shadesModal">
				<div class="modal-dialog modal-dialog-centered" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">Shades</h5>
							<button type="button" class="close" data-dismiss="modal">
								<span>&times;</span>
							</button>
						</div>
						<div class="modal-body">
							
							<div class="row">
							   <div class="col-12">
							     <label><b>Shades<span class="required-field">*</span></b></label>
							     <select class="form-control" id="s1" ng-model="shade['S_1']"
										ng-options="item as item.name for item in shadesLov track by item.id">
									<option value="">---SELECT---</option>
								</select>
							   </div>
							   <div class="col-12">
							     	<label><b>Inv. Quantity<span class="required-field">*</span></b></label>
							    	<input type="text" class="form-control" id="s2" ng-model="shade['S_2']">
							   </div>
								
								
							</div>
							<div class="col-sm-12 col-12 register-new-product-picture-para-box mt-4">
								<div class="row register-new-product-picture-para">
									<div class="col-sm-4 image-overlay upload-photo-box" id="imageAttach-btn" onclick="form3();" style="">
										<img src="{{ url('/assets-admin') }}/images/admin/upload.svg" alt="" width="50">
										<p>270 X 370</p>
									</div>
									<div class="col-sm-12">
										<div class="row" id="pss_att">
											
										</div>
									</div>
									<form class="" id="uploadattch3" method="POST" action="uploadProductShadeImage" enctype="multipart/form-data">
										<input type="hidden" name="_method" value="POST">
           								{{ csrf_field() }}
           								<input type="hidden" id="userId" name="userId" value="<?php echo session('userId');?>">
										<input type="hidden" id="sourceId" name="sourceId" value="@{{shade.ID}}">
										<input type="hidden" id="sourceCode" name="sourceCode" value="PRODUCT_SHADE_IMG"> 
										<input type="file" id="uploadatt3" name="uploadattl" class="file-input" style="display: none;">
									</form>

								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-danger light" data-dismiss="modal">Close</button>
							<button type="button" class="btn btn-warning" ng-click="saveProductShade();">Save changes</button>
						</div>
					</div>
				</div>
			</div>
			<div class="modal fade" id="confirmProdShadeModal">
				<div class="modal-dialog modal-dialog-centered" role="document">
					<div class="modal-content">
						<div class="modal-header">
				<!-- 							<h5 class="modal-title">Shades</h5> -->
							<button type="button" class="close" data-dismiss="modal">
								<span>&times;</span>
							</button>
						</div>
						<div class="modal-body">
							
							<div class="row">
							   <div class="col-12">
							     <label><b>Selected Image mark as primary or secondary!!!</b></label>
							   </div>
							</div>
							
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-danger light" ng-click="closeProdShadeModal();">Close</button>
							<button type="button" class="btn btn-warning" ng-click="markProductShadeImageFlag(1);">Mark Primary</button>
							<button type="button" class="btn btn-warning" ng-click="markProductShadeImageFlag(2);">Mark Secondary</button>
						</div>
					</div>
				</div>
			</div>
			<div class="modal fade" id="usesStepsModal">
				<div class="modal-dialog modal-dialog-centered" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">Add Step</h5>
							<button type="button" class="close" data-dismiss="modal">
								<span>&times;</span>
							</button>
						</div>
						<div class="modal-body">
							
							<div class="row">
							   <div class="col-6">
							     <label><b>Sequence Number<span class="required-field">*</span></b></label>
							     <input type="number" class="form-control" id="u1" ng-model="uses['U_1']">
							   </div>
							</div>
							<div class="row mt-4">
							   <div class="col-12">
							     <label><b>Title<span class="required-field">*</span></b></label>
							     <input type="text" class="form-control" id="u2" ng-model="uses['U_2']">
							   </div>
							</div>
							<div class="row mt-4">
								<div class="col-sm-12">
									<label><b>Short Description<span class="required-field">*</span></b></label>
									<textarea class="form-control" id="u4" rows="4" ng-model="uses['U_4']" placeholder="Enter Short Description..."></textarea>
								</div>
							</div>
							<div class="col-sm-12 col-12 register-new-product-picture-para-box mt-4">
								<div class="row register-new-product-picture-para">
									<div class="col-sm-4 image-overlay upload-photo-box" id="imageAttach-btn" onclick="form4();" style="">
										<img src="{{ url('/assets-admin') }}/images/admin/upload.svg" alt="" width="50">
										<p>360 X 450</p>
									</div>
									<div class="col-sm-7">
										<div class="row" id="ps_att">
											<div class="col-3 image-overlay margin-r1" id="img_file" ng-show="uses.U_3 != ''">
												<img src="@{{uses.U_3}}" alt="" class="image-box">
												<div class="overlay">
													<div class="text">
														<img class="fa-trash-alt" src="{{url('/assets-admin')}}/images/admin/trash.svg" alt="" width="18" ng-click="deleteProductUsesImage(@{{uses.ID}})" title="Delete Image">
														<div class="arrow-icon-move-box">
															<img class="arrow-center" src="{{url('/assets-admin')}}/images/admin/feather-move.svg" alt="">
															<p>Move Position</p>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<form class="" id="uploadattch4" method="POST" action="uploadProductUsesImage" enctype="multipart/form-data">
										<input type="hidden" name="_method" value="POST">
           								{{ csrf_field() }}
           								<input type="hidden" id="userId" name="userId" value="<?php echo session('userId');?>">
										<input type="hidden" id="sourceId" name="sourceId" value="@{{product.ID}}">
										<input type="hidden" id="usesId" name="usesId" value="@{{uses.ID}}">
										<input type="hidden" id="sourceCode" name="sourceCode" value="PRODUCT_USES_IMG"> 
										<input type="file" id="uploadatt4" name="uploadattl" class="file-input" style="display: none;">
									</form>

								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-danger light" data-dismiss="modal">Close</button>
							<button type="button" class="btn btn-warning" ng-click="saveProductUses();">Save changes</button>
						</div>
					</div>
				</div>
			</div>
			
			<div class="modal fade" id="alertDel">
				<div class="modal-dialog" role="document">
					<div class="modal-content align-center-verticle">
						<div class="modal-header" style="border:unset;">
							<h3 class="modal-title">Alert</h3>
						</div>
						<div class="modal-body">
                           <h4 style="text-align: center;">@{{alertDeleteMsg}}</h4>
                        </div>
						<div class="modal-footer" style="border-top: unset !important;">
							<button type="button" class="btn btn-danger light" ng-click="closealertDeleteModal();">Close</button>
							<!-- 							<button type="button" class="btn btn-primary">Yes</button> -->
						</div>
					</div>
				</div>
			</div>
			<div class="modal fade" id="confirmProdImageModal">
				<div class="modal-dialog modal-dialog-centered" role="document">
					<div class="modal-content">
						<div class="modal-header">
					<!-- 	<h5 class="modal-title">Change State</h5> -->
							<button type="button" class="close" data-dismiss="modal">
								<span>&times;</span>
							</button>
						</div>
						<div class="modal-body">
							
							<div class="row">
							   <div class="col-12">
							     <label><b>Selected Image mark as primary or secondary!!!</b></label>
							   </div>
							</div>
							
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-danger light" ng-click="closeProdImageModal();">Close</button>
							<button type="button" class="btn btn-warning" ng-click="markProductDetailImageFlag(1);">Mark Primary</button>
							<button type="button" class="btn btn-warning" ng-click="markProductDetailImageFlag(2);">Mark Secondary</button>
						</div>
					</div>
				</div>
			</div>
		</div>
        <!--**********************************
            Content body end
        ***********************************-->

    </div>
	<form class="" id="quickProductdetilsForm" method="POST" action="{{ url('/productQuickAdd') }}"
		enctype="multipart/form-data" style="display:none;">
		<input type="hidden" name="_method" value="POST">
		{{ csrf_field() }}
		<input type="hidden" class="productID" id="productID" name="productID" value="">
	</form>

	
    @include('admin.admin-footer')
	
	<script type="text/javascript" src="https://cdn.datatables.net/rowreorder/1.3.3/js/dataTables.rowReorder.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
    <script src="{{ url('/assets-admin') }}/customjs/script_adminproduct.js?v={{time()}}"></script>
    
    <script>
	
	    function form1(){
	    	$("#uploadattl").click();
	    }
	    function form2(){
	    	$("#uploadatt2").click();
	    }
	    function form3(){
	    	$("#uploadatt3").click();
	    }
	    function form4(){
	    	$("#uploadatt4").click();
	    }
	    function form5(){
	    	$("#uploadatt5").click();
	    }
   	</script>