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
            <div class="container-fluid pt-0" ng-show="editView == '0'">
                
                <div class="row">
                	<div class="col-10">
                		<div class="page-titles pt-0 pb-0 mb-0">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="javascript:void(0)">Blogs</a></li>
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
                                <h4 class="card-title">Blogs</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="shadesTable" class="display min-w850">
                                        <thead>
                                            <tr>
                                                <th>Seq</th>
												
                                                <th>Name</th>
                                                <th>Description</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr ng-repeat="row in displayCollection">
                                                <td>@{{row.seqNo}}</td>
												<td>@{{row.BLOG_ID}}</td>
                                                <td>@{{row.TITLE}}</td>
                                                <td>@{{row.DESCRIPTION}}</td>
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
															<a class="dropdown-item" href="javascript:;" ng-click="statusChange(@{{row.BLOG_ID}});" ng-if="row.STATUS != 'active'">Active</a>
															<a class="dropdown-item" href="javascript:;" ng-click="statusChange(@{{row.BLOG_ID}});" ng-if="row.STATUS == 'active'">InActive</a>
															<a class="dropdown-item" href="javascript:;" ng-click="continouRecord(row.BLOG_ID);">Edit</a>
															<a class="dropdown-item" href="javascript:;" ng-click="deleteBlog(@{{row.BLOG_ID}})">Delete</a>

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
						<li class="breadcrumb-item"><a href="javascript:void(0)">Blog</a></li>
						<li class="breadcrumb-item active"><a href="javascript:void(0)">Process</a></li>
					</ol>
                </div>
                <!-- row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Blog</h4>
                            </div>
                            <div class="card-body">
                                <div class="form-validation">
									<form class="form-valide">
										<div class="row">
											<div class="col-sm-5">
												<div class="form-group">

													<label class="col-form-label" for="Title"><b>Title</b> <span class="text-danger">*</span> </label> 
													<input type="text" class="form-control" id="title" ng-model="blogs['P_1']" placeholder="Enter a Title...">

												</div>
											</div>
											
										</div>

									<div class="row">
										<div class="col-sm-12">
											<label class="col-form-label"><b>Description</b>
												<span class="text-danger">*</span></label>
											<div class="summernote" id="summernote"></div>
										</div>
									</div>


									<div class=" ml-0 ml-sm-12 ml-sm-0 mt-3">
                                    
	                                    <div class="compose-content">
	                                        <form action="#">
	                                          
	                                        </form>
	                                        <h5 class="mb-4"><i class="fa fa-paperclip"></i> Attatchment</h5>
	                                        
	                                        <div class="col-sm-12 col-12 register-new-product-picture-para-box">
												<div class="row register-new-product-picture-para">
													<div class="col-sm-2 image-overlay upload-photo-box" id="imageAttach-btn" onclick="form1();" style="">
														<img src="{{ url('/assets-admin') }}/images/admin/upload.svg" alt="" width="50">
														<p>Upload Photo</p>
													</div>
													<div class="col-sm-9">
														<div class="row" id="p_att">
															
														</div>
													</div>
													<form class="" id="uploadattch" method="POST" action="uploadBlogAttachment" enctype="multipart/form-data">
														<input type="hidden" name="_method" value="POST">
	           											{{ csrf_field() }}
	           											<input type="hidden" id="userId" name="userId" value="<?php echo session('userId');?>">
														<input type="hidden" id="sourceId" name="sourceId" value="@{{blogs.ID}}">
														<input type="hidden" id="sourceCode" name="sourceCode" value="BLOGS_IMG"> 
														<input type="file" id="uploadattl" name="uploadattl" class="file-input" style="display: none;">
													</form>
			
												</div>
											</div>
											
	                                    </div>
	                                    <div class="text-left mt-4 mb-2">
	                                        <button class="btn btn-primary btn-sl-sm mr-2" type="button" ng-click="saveBlog();"><span class="mr-2"><i class="fa fa-paper-plane"></i></span>Save</button>
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
        </div>
		
		
		
		<!--**********************************
            Content body end
        ***********************************-->

    </div>
    @include('admin.admin-footer');
    
    <script src="{{ url('/assets-admin') }}/customjs/script_adminblogs.js?v={{time()}}"></script>
    
    <script>

    function form1(){
		alert('hello');
    	$("#uploadattl").click();
		
    }
    
	
    </script>