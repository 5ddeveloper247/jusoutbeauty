@include('admin.admin-header');
 <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <div class="container-fluid">
                <div class="page-titles">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="javascript:void(0)">SMS System</a></li>
						<li class="breadcrumb-item active"><a href="javascript:void(0)">Edit Template</a></li>
					</ol>
                </div>
                <!-- row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">OTP Template</h4>
                            </div>
                            <div class="card-body">
                                <div class="form-validation">
									<form class="form-valide" action="#" method="post">
										<div class="row">
											<div class="col-sm-6">
												<div class="form-group">
													<label class="col-form-label" for="template_id"><b>Template ID</b> <span
														class="text-danger">*</span>
													</label>
													<input type="text" class="form-control" id="template_id"
														name="template_id" placeholder="Enter a Template ID...">
												</div>
											  </div>
										</div>
										
										<div class="row">
											<div class="col-sm-12">
												<div class="form-group">

													<label class="col-form-label" for="sms_body"><b>SMS Body<span class="text-danger">*</span></b>
													</label> 
													<textarea id="sms_body" name="sms_body" class="form-control" placeholder="Enter SMS Body..." rows="8"></textarea>

												</div>
											  </div>
											
										</div>
										
										
										
										<div class="save-admin-center mt-3">
										   <button class="btn btn-rounded btn-success">Update Settings</button>
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