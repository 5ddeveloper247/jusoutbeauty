@include('admin.admin-header');
 <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <div class="container-fluid">
                <div class="page-titles">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="javascript:void(0)">SMS API</a></li>
						<li class="breadcrumb-item active"><a href="javascript:void(0)">Edit API</a></li>
					</ol>
                </div>
                <!-- row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">API Information</h4>
                            </div>
                            <div class="card-body">
                                <div class="form-validation">
									<form class="form-valide" action="#" method="post">
										<div class="row">
											<div class="col-sm-6">
												<div class="form-group">
													<label class="col-form-label" for="sid"><b>Template ID</b> <span
														class="text-danger">*</span>
													</label>
													<input type="text" class="form-control" id="sid"
														name="sid" placeholder="Enter a SID...">
												</div>
											  </div>
											  <div class="col-sm-6">
												<div class="form-group">
													<label class="col-form-label" for="auth_token"><b>Auth Token</b> <span
														class="text-danger">*</span>
													</label>
													<input type="text" class="form-control" id="auth_token"
														name="auth_token" placeholder="Enter a Auth Token...">
												</div>
											  </div>
										</div>
										
										<div class="row">
											<div class="col-sm-6">
												<div class="form-group">
													<label class="col-form-label" for="valid_number"><b>Valid Number</b> <span
														class="text-danger">*</span>
													</label>
													<input type="text" class="form-control" id="valid_number"
														name="valid_number" placeholder="Enter a Valid Number...">
												</div>
											  </div>
											
										</div>
										
										
										
										<div class="save-admin-center mt-3">
										   <button class="btn btn-rounded btn-success">Update</button>
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