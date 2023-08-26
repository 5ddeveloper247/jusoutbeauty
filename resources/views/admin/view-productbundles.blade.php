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
				<div class="row">
                	<div class="col-10">
                		<div class="page-titles pt-0 pb-0 mb-0">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="javascript:void(0)">Bundles</a></li>
								<li class="breadcrumb-item active"><a href="javascript:void(0)">View All</a></li>
							</ol>
		                </div>
                	</div>
                   	<div class="col-2">
                       <a type="button" class="btn btn-rounded btn-warning admin-view-add mb-3" href="javascript:void(0)" ng-click="addNew();">Add new</a>
                   	</div>
                </div>


                <div class="row">
					<div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Bundles</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="bundlesTable" class="display min-w850">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Bundle Name</th>
                                                <th>Total Amount</th>
                                                <th>Discount Amount</th>
                                                <th>Category</th>
<!--                                                 <th>Sub.cate.</th>
                                                <th>Stock Status</th> -->
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tablecontents">
                                            <tr class="row1" data-seq="@{{row.SEQ_NUM}}" data-id="@{{row.BUNDLE_ID}}" ng-repeat="row in displayCollection">
                                                <td>@{{row.seqNo}}</td>
                                                <td>@{{row.NAME}}</td>
                                                <td>$@{{row.TOTAL_AMOUNT}}</td>
                                                <td>$@{{row.DISCOUNTED_AMOUNT}}</td>
                                                <td>@{{row.CATEGORY_NAME}}</td>
<!--                                                 <td>@{{row.SUB_CATEGORY_NAME}}</td>


                                                <td>
													<span class="badge light badge-success">
														<i class="fa fa-circle text-success mr-1"></i>
														Available
													</span>
												</td> -->
												<td>
													<span class="badge light badge-danger" ng-if="row.STATUS != 'active'">
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
															<a class="dropdown-item" href="javascript:;" ng-click="changeStatusBundle(@{{row.BUNDLE_ID}});" ng-show="row.STATUS != 'active'">Active</a>
															<a class="dropdown-item" href="javascript:;" ng-click="changeStatusBundle(@{{row.BUNDLE_ID}});" ng-show="row.STATUS == 'active'">InActive</a>
															<a class="dropdown-item" href="javascript:;" ng-click="continouRecord(@{{row.BUNDLE_ID}});">Edit</a>
															<a class="dropdown-item" href="javascript:;" ng-click="openAlertModel(@{{row.BUNDLE_ID}});">Delete</a>
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

						<li class="breadcrumb-item" ng-click="backToListing();"><i class="fa fa-arrow-left p-1"></i> &nbsp;<a href="javascript:void(0)">Bundles</a></li>
						<!-- <li class="breadcrumb-item active"><a href="javascript:void(0)">Process</a></li> -->
					</ol>
				</div>
				<!-- row -->
				<div class="row">
					<div class="col-xl-12 col-xxl-12">
						<div class="card">
							<div class="card-header">
								<h4 class="card-title">Bundle Information</h4>
							</div>
							<div class="card-body">
								<!-- Nav tabs -->
								<ul class="nav nav-tabs" role="tablist">
									<li class="nav-item"><a class="nav-link active"
										data-toggle="tab" href="#basic_info"> <span> Basic Info </span>
									</a></li>
									<li class="nav-item"><a class="nav-link" data-toggle="tab"
										href="#images"> <span> Image </span>
									</a></li>
									<li class="nav-item"><a class="nav-link" data-toggle="tab"
										href="#products"> <span> Products </span>
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
																<label class="col-form-label" for="p1"><b>Bundle Name</b>  <span class="text-danger">*</span>  </label>
																<input type="text" class="form-control" id="p1" ng-model="bundle['P_1']" placeholder="Enter a Bundle Name">
															</div>
														</div>
														<div class="col-sm-6">
															<div class="form-group">
																<label class="col-form-label" for="p2"><b>Sub Title</b> </label>
																<input type="text" class="form-control" id="p2" ng-model="bundle['P_2']" placeholder="Enter Bundle Sub title">
															</div>
														</div>
													</div>
													<div class="row">
														<div class="col-sm-6">
															<div class="form-group">
																<label class="col-form-label" for="p3"><b>Unit</b> </label>
																<input type="text" class="form-control" id="p3" ng-model="bundle['P_3']" placeholder="Unit">
															</div>
														</div>
														{{-- <div class="col-sm-6">
															<div class="form-group">
																<label class="col-form-label" for="p4"><b>Minimum Purchase Qty</b> <span class="text-danger">*</span> </label>
																<input type="number" class="form-control" id="p4" ng-model="bundle['P_4']" placeholder="Enter Minimum Purchase Quantity">
															</div>
														</div> --}}
														{{-- <div class="col-sm-6">
															<div class="form-group">
																<label class="col-form-label" for="p6"><b>Tags</b> <span class="text-danger">*</span> </label>
																<input type="text" class="form-control" id="p5" ng-model="bundle['P_5']" placeholder="Tags">
																<small>This is used for search.Customer Search by these Tags.</small>
															</div>
														</div> --}}
													</div>
													{{-- <div class="row">
														<div class="col-sm-6">
															<div class="form-group">
																<label class="col-form-label" for="p6"><b>Tags</b> <span class="text-danger">*</span> </label>
																<input type="text" class="form-control" id="p5" ng-model="bundle['P_5']" placeholder="Tags">
																<small>This is used for search.Customer Search by these Tags.</small>
															</div>
														</div>
														<div class="col-sm-6">
															<div class="form-group">
																<label class="col-form-label" for="p6"><b>Barcode</b> </label>
																<input type="text" class="form-control" id="p6" ng-model="bundle['P_6']" placeholder="Enter Barcode">
															</div>
														</div>
													</div> --}}

													<!-- <div class="row">
														<div class="col-sm-4 col-6">
															<div class="custom-control custom-checkbox mb-3 checkbox-warning">
																<input type="checkbox" class="custom-control-input" id="p7" ng-model="bundle['P_7']">
																<label class="custom-control-label" for="p7">Refundable</label>
															</div>
														</div>
													</div> -->
													<div class="row">
														<div class="col-sm-6">
															<div class="form-group">
																<label class="col-form-label" for="p8"><b>Product Category</b> <span class="text-danger">*</span></label>
																<select class="form-control" id="p8" ng-model="bundle['P_8']"
																	ng-change="getSubCategoriesWrtCategory();"
																	ng-options="item as item.name for item in categoryLov track by item.id">
										                        	<option value="">---SELECT---</option>
										                        </select>
															</div>
														</div>
														<div class="col-sm-6">
															<div class="form-group">

																<label class="col-form-label" for="p9"><b>Product Sub Category</b></label>
																<select class="form-control" id="p9" ng-model="bundle['P_9']"
																	ng-change="getSubSubCategoriesWrtSubCategory();"
																	ng-options="item as item.name for item in subCategoryLov track by item.id">
										                        	<option value="">---SELECT---</option>
										                        </select>
															</div>
														</div>
													</div>
													<div class="row">
														{{-- <div class="col-sm-6">
															<div class="form-group">
																<label class="col-form-label" for="p10"><b>Slug</b> <span class="text-danger">*</span></label>
																<input type="text" class="form-control" id="p10" ng-model="bundle['P_10']" placeholder="Slug">
															</div>
														</div> --}}
														<div class="col-sm-6 d-none">
															<div class="form-group">
																<label class="col-form-label" for="p11"><b>Product Sub Sub Category</b></label>
																<select class="form-control" id="p11" ng-model="bundle['P_11']"
																	ng-options="item as item.name for item in subSubCategoryLov track by item.id">
										                        	<option value="">---SELECT---</option>
										                        </select>
															</div>
														</div>
														<div class="col-sm-6">
															<div class="form-group">
																<label class="col-form-label"><b>Inv. Quantity</b></label>
																<input type="number" class="form-control" id="p16" ng-model="bundle['P_16']" placeholder="0">
															</div>
														</div>
													</div>
													<div class="row">
														<div class="col-sm-6">
															<div class="form-group">
																<label class="col-form-label" for="p12"><b>VAT Rate</b> </label>
																<input type="number" class="form-control" id="p12" ng-model="bundle['P_12']" placeholder="VAT Rate">
															</div>
														</div>
														<div class="col-sm-6">
															<div class="form-group">
																<label class="col-form-label"><b>Total Amount</b></label>
																<input type="number" class="form-control" id="p13" ng-model="bundle['P_13']" placeholder="0" disabled>
															</div>
														</div>
													</div>
													<div class="row">

														<div class="col-sm-6">
															<div class="form-group">
																<label class="col-form-label"><b>Discounted Amount</b></label>
																<input type="number" class="form-control" id="p15" ng-model="bundle['P_15']" placeholder="0">
															</div>
														</div>

													</div>
													<div class="row">
														<div class="col-sm-12">
															<label class="col-form-label" for="p14"><b>Short Description</b></label>
															<textarea class="form-control" id="p14" rows="8" ng-model="bundle['P_14']" placeholder="Enter Short Description..."></textarea>
														</div>
													</div>
													<div class="row">
					                	               	<div class="col-12 pt-4">
									                       <a type="button" class="btn btn-rounded btn-warning admin-view-add mb-3" ng-click="saveProductBundleBasic();">Save Basic Info</a>
									                   	</div>
							                		</div>
												</form>
											</div>
										</div>
									</div>
									<div class="tab-pane fade" id="images" role="tabpanel">
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
																<p>Min : 270 X 370</p>
															</div>
															<div class="col-sm-9">
																<div class="row" id="p_att">

																	<div class="col-2 image-overlay margin-r1" id="img_file_@{{bumdle.ID}}" ng-show="bundle.image != ''">

																		<img src="@{{bundle.image}}" alt="" class="image-box">

																		<div class="overlay">
																			<div class="text">
																				<img class="fa-trash-alt" src="{{url('/assets-admin')}}/images/admin/trash.svg" alt="" width="18" ng-click="deleteBundleImage()" title="Delete Image">

																				{{-- <div class="arrow-icon-move-box">
																					<img class="arrow-center" src="{{url('/assets-admin')}}/images/admin/feather-move.svg" alt="">
																					<p>Move Position</p>
																				</div> --}}
																			</div>
																		</div>
																	</div>
																</div>
															</div>
															<form class="" id="uploadattch" method="POST" action="uploadBundleProductImage" enctype="multipart/form-data">
																<input type="hidden" name="_method" value="POST">
			           											{{ csrf_field() }}
			           											<input type="hidden" id="userId" name="userId" value="<?php echo session('userId');?>">
																<input type="hidden" id="sourceId" name="sourceId" value="@{{bundle.ID}}">
																<input type="hidden" id="sourceCode" name="sourceCode" value="BUNDLE_IMG">
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

									<div class="tab-pane fade" id="products" role="tabpanel">
										<div class="row">
											<div class="col-12">
						                        <div class="card">
						                        	<div class="row">
						                        		<div class="col-10">
						                        			<div class="card-header">
								                                <h4 class="card-title">Products</h4>
								                            </div>
						                        		</div>
					                	               	<div class="col-2 pt-4">
									                       <a type="button" class="btn btn-rounded btn-warning admin-view-add mb-3" ng-click="addProduct();">Add Product</a>
									                   	</div>
							                		</div>

						                            <div class="card-body">
						                                <div class="table-responsive">
						                                    <table id="productsTable" class="display min-w850">
						                                        <thead>
						                                            <tr>
						                                                <th>ID</th>
						                                                <th>Product Name</th>
						                                                <th>Amount</th>
						                                                <th>Category</th>
						                                                <th>Date</th>
						                                                <th>Action</th>
						                                            </tr>
						                                        </thead>
						                                        <tbody>
						                                            <tr ng-repeat="row in displayCollectionProducts">
						                                                <td>@{{row.seqNo}}</td>
						                                                <td>@{{row.NAME}}</td>
						                                                <td>$@{{row.PRODUCT_PRICE}}</td>
						                                                <td>@{{row.CATEGORY_NAME}}</td>
																		<td>@{{row.LINE_DATE}}</td>
						                                                <td>
																			<div class="dropdown ml-auto text-right">
																				<div class="btn-link" data-toggle="dropdown">
																					<svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg>
																				</div>
																				<div class="dropdown-menu dropdown-menu-right">
																					<a class="dropdown-item" href="javascript:;" ng-click="deleteBundleLine(@{{row.BUNDLE_LINE_ID}});">Delete</a>
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
								</div>

							</div>


						</div>


					</div>
				</div>










			</div>

			<div class="modal fade" id="productsModal">
				<div class="modal-dialog modal-dialog-centered" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">Add Products</h5>
							<button type="button" class="close" ng-click="closeProductModal();"> <!-- data-dismiss="modal" -->
								<span>&times;</span>
							</button>
						</div>
						<div class="modal-body">

							<div class="row">
							   <div class="col-12">
							     <label><b>Products<span class="required-field">*</span></b></label>
							     <select class="form-control" id="bp1" ng-model="product['P_1']"
										ng-options="item as item.name for item in productsLov track by item.id">
									<option value="">---SELECT---</option>
								</select>
							   </div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-danger light" ng-click="closeProductModal();">Close</button>
							<button type="button" class="btn btn-warning" ng-click="saveBundleProductLine();">Save changes</button>
						</div>
					</div>
				</div>
			</div>

			<!-- <div class="modal fade" id="confirmProdShadeModal">
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
			</div> -->
			{{-- <div class="modal fade" id="alertDel">
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
			</div> --}}

			<div class="modal fade" id="alertBundleDel">
				<div class="modal-dialog" role="document">
					<div class="modal-content ">
						<div class="modal-header justify-content-center" >
							<h2 class="modal-title font-weight-bold ">Warning</h2>
						</div>
						<div class="modal-body">
							{{-- <div class="alert alert-danger" role="alert">
								<p class="m-0 text-center">This Bundle will be deleted from product as well</p>
							  </div> --}}

						  <h4 class="font-weight-bold text-center">Are you Sure you want to delete?</h4>
						</div>
						<div class="modal-footer" >
							<button type="button" class="btn btn-secondary light" ng-click="closeBundleDeleteModal();">Close</button>
							<button type="button" class="btn btn-danger light" ng-click="deleteBundle();">Delete</button>
	<!-- 							<button type="button" class="btn btn-primary">Yes</button> -->
						</div>
					</div>
				</div>
			</div>
		</div>
        <!--**********************************
            Content body end
        ***********************************-->

    </div>
    @include('admin.admin-footer')

	<script type="text/javascript" src="https://cdn.datatables.net/rowreorder/1.3.3/js/dataTables.rowReorder.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
    <script src="{{ url('/assets-admin') }}/customjs/script_adminproductbundles.js?v={{time()}}"></script>

    <script>

	    function form1(){
	    	$("#uploadattl").click();
	    }

   	</script>
