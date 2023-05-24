@include('admin.admin-header');
 <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <div class="container-fluid">
                <div class="page-titles">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="javascript:void(0)">API</a></li>
						<li class="breadcrumb-item active"><a href="javascript:void(0)">View</a></li>
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

													<label class="col-form-label" for="name"><b>Name</b> <span
														class="text-danger">*</span>
													</label>
													<p>Paypal</p>

												</div>
											  </div>
											  <div class="col-sm-6">
												<div class="form-group">

													<label class="col-form-label" for="secret_key"><b>Secret Key<span class="text-danger">*</span></b>
													</label>
													<p>justoutj121</p>
												</div>
											  </div>
											
											
										</div>
										
										<div class="row">
											<div class="col-sm-6">
												<div class="form-group">

													<label class="col-form-label" for="publishable_key"><b>Publishable Key</b>
													</label>
													
													<p>justoutj121211</p>
												</div>
											  </div>
											<div class="col-sm-6">
												<div class="form-group">

													<label class="col-form-label" for="merchent_website"><b>Merchant Website<span class="text-danger">*</span></b>
													</label>
													
													<p>http://www.jusoutbeauty.com/</p>
												</div>
											</div>
											
										</div>
										<div class="row">
											<div class="col-sm-6">
												<div class="form-group">

													<label class="col-form-label" for="phone"><b>Phone<span class="text-danger">*</span></b></label>
													
													<p>+912 1212171</p>
												</div>
											  </div>
											<div class="col-sm-6">
												<div class="form-group">

													<label class="col-form-label" for="currency"><b>Currency</b>
													</label> 
													<p>USD</p>
												</div>
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