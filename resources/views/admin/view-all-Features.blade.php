@include('admin.admin-header');
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
								<li class="breadcrumb-item"><a href="javascript:void(0)">Features</a></li>
								<li class="breadcrumb-item active"><a href="javascript:void(0)">View All</a></li>
							</ol>
		                </div>
					</div>
				 <div class="col-2">
						<a type="button" class="btn btn-rounded btn-warning admin-view-add mb-3" ng-click="addNew();" href="javascript:void(0)">Add new</a>
				 </div>
			 </div>
				<div class="row">
                    
					<div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Features</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="featuresTable" class="display min-w850">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Feature Name</th>
                                                <th>Feature Description</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr ng-repeat="row in displayCollection">
                                                <td>@{{row.seqNo}}</td>
                                                <td>@{{row.TITLE}}</td>
                                                <td>@{{row.DESCRIPTION_TEXT}}</td>
												<td>
													<span class="badge light badge-success" ng-if="row.STATUS == 'active'">
														<i class="fa fa-circle text-success mr-1"></i>
														Active
													</span>
													<span class="badge light badge-danger" ng-if="row.STATUS != 'active'"> 
														<i class="fa fa-circle text-danger mr-1"></i>
														InActive
													</span>
												</td>
                                                <td>
													<div class="dropdown ml-auto text-right">
														<div class="btn-link" data-toggle="dropdown">
															<svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg>
														</div>
														<div class="dropdown-menu dropdown-menu-right">
															<a class="dropdown-item" href="javascript:;" ng-click="statusChange(@{{row.FEATURE_ID}});" ng-if="row.STATUS != 'active'">Active</a>
															<a class="dropdown-item" href="javascript:;" ng-click="statusChange(@{{row.FEATURE_ID}});" ng-if="row.STATUS == 'active'">InActive</a>
															<a class="dropdown-item" href="javascript:;" ng-click="continouRecord(@{{row.FEATURE_ID}});">Edit</a>
															<a class="dropdown-item" href="javascript:;" ng-click="openAlertModel(@{{row.FEATURE_ID}})">Delete</a>
															 {{-- <a class="dropdown-item" href="javascript:;" ng-click="deleteFeature(@{{row.FEATURE_ID}})">Delete</a> --}}
<!-- 															<a class="dropdown-item" href="#">View Details</a> -->
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
            
            <div class="container-fluid pt-0" ng-show="editView == '1'">
                <div class="page-titles pt-0 pb-0 mb-0">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"ng-click="backToListing();"><i class="fa fa-arrow-left p-1"></i> &nbsp;<a href="javascript:void(0)">Feature</a></li>
						<!-- <li class="breadcrumb-item active"><a href="javascript:void(0)">Process</a></li> -->
					</ol>
                </div>
                <!-- row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Feature</h4>
                            </div>
                            <div class="card-body">
                                <div class="form-validation">
									<form class="form-valide">
										<div class="row">
											<div class="col-sm-5">
												<div class="form-group">

													<label class="col-form-label" for="Title"><b>Feature Name</b> <span class="text-danger">*</span> </label> 
													<input type="text" class="form-control" id="title" ng-model="feature['P_1']" placeholder="Enter a Feature Name...">

												</div>
											</div>
											<!-- <div class="col-sm-5">
												<div class="form-group">

													<label class="col-form-label" for="quantity_in_stock"><b>Quantity
														In Stock</b> <span class="text-danger">*</span>
													</label><br>
													 <input type="number" class="form-control" ng-model="ingredient['P_2']" id="quantity_in_stock" placeholder="Quantity">

												</div>
											</div> -->
											<!-- <div class="col-sm-5">
												<div class="form-group">
        										    <label class="col-form-label" for="category"><b>Category</b> <span class="text-danger">*</span> </label><br>
        											<select class="form-control" ng-model="ingredient['P_3']">
        												<option value="">Choose</option>
        											   <option value="Formulated">Formulated</option>
        											   <option value="Spotlight">Spotlight</option>
        											</select>
    											</div>
    										</div> -->
										</div>

									<div class="row">
										<div class="col-sm-12">
											<label class="col-form-label" for="Description"><b>Description</b>
												<span class="text-danger">*</span></label>
											<div class="summernote" id="summernote"></div>
										</div>
									</div>


									<div class=" ml-0 ml-sm-12 ml-sm-0 mt-3">
                                    
                                    <div class="compose-content">
                                        <form action="#">
                                          
                                        </form>
                                        <h5 class="mb-4"><i class="fa fa-paperclip"></i> Attachment</h5>
                                        
                                        <div class="col-sm-12 col-12 register-new-product-picture-para-box">
											<div class="row register-new-product-picture-para">
												<div class="col-sm-2 image-overlay upload-photo-box" id="imageAttach-btn" onclick="form1();" style="">
													<img src="{{ url('/assets-admin') }}/images/admin/upload.svg" alt="" width="50">
													<p>125 X 125</p>
												</div>
												<div class="col-sm-9">
													<div class="row" id="p_att">
														<!-- <div class="col-2 image-overlay margin-r1" id="profuct_img_file_351">
															<img src="http://jasad5d.5dsurf.com/themes/jasad18122020/65/product/94/banner01.jpg" alt="" class="image-box">
															<div class="overlay">
																<div class="text">
																	<img class="fa-trash-alt" src="{{ url('/assets-admin') }}/images/admin/trash.svg" alt="" width="18">
																	<div class="arrow-icon-move-box">
																		<img class="arrow-center" src="{{ url('/assets-admin') }}/images/admin/feather-move.svg" alt="">
																		<p>Move Position</p>
																	</div>
																</div>
															</div>
														</div> -->
													</div>
												</div>
												<form class="" id="uploadattch" method="POST" action="uploadFeatureAttachment" enctype="multipart/form-data">
													<input type="hidden" name="_method" value="POST">
           											{{ csrf_field() }}
           											<input type="hidden" id="userId" name="userId" value="<?php echo session('userId');?>">
													<input type="hidden" id="sourceId" name="sourceId" value="@{{feature.ID}}">
													<input type="hidden" id="sourceCode" name="sourceCode" value="INGREDIENT_IMG"> 
													<input type="file" id="uploadattl" name="uploadattl" class="file-input" style="display: none;">
												</form>
		
											</div>
										</div>
										
                                        <!-- <form id="uploadfile" method="POST" action="importData" class="dropzone" id="myDropzone">
											<input type="hidden" name="_method" value="POST">
           									{{ csrf_field() }}
											<input type="hidden" name="form_code" value="INGREDIENT_IMG">
											<input type="hidden" name="recordId" required>
											
											<div class="fallback">
												<input name="file" type="file" multiple accept="image/*"/>
											</div>
										</form> -->

                                    </div>
                                    <div class="text-left mt-4 mb-2">
                                        <button class="btn btn-primary btn-sl-sm mr-2" type="button" ng-click="saveFeature();"><span class="mr-2"><i class="fa fa-paper-plane"></i></span>Save</button>
                                        <a href="javascript:;" class="btn btn-danger light btn-sl-sm" ng-click="backToListing();"><span class="mr-2"><i class="fa fa-times" aria-hidden="true"></i></span>Discard</a>
                                    </div>
                                   </div>
									</form>
								</div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
            
            
            <div class="modal fade" id="alertDel">
				<div class="modal-dialog" role="document">
					<div class="modal-content ">
						<div class="modal-header justify-content-center" >
							<h2 class="modal-title font-weight-bold ">Warning</h2>
						</div>
						<div class="modal-body">
							<div class="alert alert-danger" role="alert">
								<p class="m-0 text-center">This feature will be deleted from product as well</p>
							  </div>
						  
                          <h4 class="font-weight-bold text-center">Are you Sure you want to delete?</h4>
                        </div>
						<div class="modal-footer" >
							<button type="button" class="btn btn-secondary light" ng-click="closealertDeleteModal();">Close</button>
							<button type="button" class="btn btn-danger light" ng-click="deleteFeature();">Delete</button>
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
    @include('admin.admin-footer');
    
    <script src="{{ url('/assets-admin') }}/customjs/script_adminfeatures.js?v={{time()}}"></script>
    
	<script>

    function form1(){
    	$("#uploadattl").click();
    }
    
	
    </script>