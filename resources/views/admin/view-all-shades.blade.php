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

                <div class="row">
                	<div class="col-10">
                		<div class="page-titles pt-0 pb-0 mb-0 mt-1">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="javascript:void(0)">Shades</a></li>
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
                                <h4 class="card-title">Shades</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="shadesTable" class="display min-w850">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Shade Name</th>
                                                <th>Description</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tablecontents">
                                            <tr class="row1" data-seq="@{{row.SEQ_NUM}}" data-id="@{{row.SHADE_ID}}" ng-repeat="row in displayCollection">
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
															<a class="dropdown-item" href="javascript:;" ng-click="statusChange(@{{row.SHADE_ID}});" ng-if="row.STATUS != 'active'">Active</a>
															<a class="dropdown-item" href="javascript:;" ng-click="statusChange(@{{row.SHADE_ID}});" ng-if="row.STATUS == 'active'">InActive</a>
															<a class="dropdown-item" href="javascript:;" ng-click="continouRecord(@{{row.SHADE_ID}});">Edit</a>
															<a class="dropdown-item" href="javascript:;" ng-click="openAlertModel(@{{row.SHADE_ID}})">Delete</a>
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
						<li class="breadcrumb-item" ng-click="backToListing();"><i class="fa fa-arrow-left p-1"></i> &nbsp;<a href="javascript:void(0)">Shade</a></li>
						<!-- <li class="breadcrumb-item active"><a href="javascript:void(0)">Process</a></li> -->
					</ol>
                </div>
                <!-- row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Shade</h4>
                            </div>
                            <div class="card-body">
                                <div class="form-validation">
									<form class="form-valide">
										<div class="row">
											<div class="col-sm-5">
												<div class="form-group">

													<label class="col-form-label" for="Title"><b>Shade Name</b> <span class="text-danger">*</span> </label>
													<input type="text" class="form-control" id="title" ng-model="shades['P_1']" placeholder="Enter a Shade Name...">

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
														<p>Min : 24 X 24</p>
													</div>
													<div class="col-sm-9">
														<div class="row" id="p_att">

														</div>
													</div>
													<form class="" id="uploadattch" method="POST" action="uploadShadesAttachment" enctype="multipart/form-data">
														<input type="hidden" name="_method" value="POST">
	           											{{ csrf_field() }}
	           											<input type="hidden" id="userId" name="userId" value="<?php echo session('userId');?>">
														<input type="hidden" id="sourceId" name="sourceId" value="@{{shades.ID}}">
														<input type="hidden" id="sourceCode" name="sourceCode" value="SHADES_IMG">
														<input type="file" id="uploadattl" name="uploadattl" class="file-input" style="display: none;">
													</form>

												</div>
											</div>

	                                    </div>
	                                    <div class="text-left mt-4 mb-2">
	                                        <button class="btn btn-primary btn-sl-sm mr-2" type="button" ng-click="saveShade();"><span class="mr-2"><i class="fa fa-paper-plane"></i></span>Save</button>
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
			<div class="modal fade" id="alertShadeDel">
			<div class="modal-dialog" role="document">
				<div class="modal-content ">
					<div class="modal-header justify-content-center" >
						<h2 class="modal-title font-weight-bold ">Warning</h2>
					</div>
					<div class="modal-body">
						<div class="alert alert-danger" role="alert">
							<p class="m-0 text-center">This Shade will be deleted from product as well</p>
						  </div>

					  <h4 class="font-weight-bold text-center">Are you Sure you want to delete?</h4>
					</div>
					<div class="modal-footer" >
						<button type="button" class="btn btn-secondary light" ng-click="closealertDeleteModal();">Close</button>
						<button type="button" class="btn btn-danger light" ng-click="deleteShade();">Delete</button>
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
	<script type="text/javascript" src="https://cdn.datatables.net/rowreorder/1.3.3/js/dataTables.rowReorder.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>

    <script src="{{ url('/assets-admin') }}/customjs/script_adminshades.js?v={{time()}}"></script>

    <script>

    function form1(){
    	$("#uploadattl").click();
    }


    </script>
