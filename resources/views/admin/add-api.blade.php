@include('admin.admin-header');
 <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <div class="container-fluid">
                <div class="page-titles">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="javascript:void(0)">API</a></li>
						<li class="breadcrumb-item active"><a href="javascript:void(0)">Add</a></li>
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
													</label> <input type="text" class="form-control" id="name"
														name="name" placeholder="Enter a name">

												</div>
											  </div>
											  <div class="col-sm-6">
												<div class="form-group">

													<label class="col-form-label" for="secret_key"><b>Secret Key<span class="text-danger">*</span></b>
													</label> <input type="text" class="form-control" id="secret_key"
														name="secret_key" placeholder="Enter Secret key">

												</div>
											  </div>
											
											
										</div>
										
										<div class="row">
											<div class="col-sm-6">
												<div class="form-group">

													<label class="col-form-label" for="publishable_key"><b>Publishable Key</b>
													</label> <input type="text" class="form-control" id="publishable_key"
														name="publishable_key" placeholder="Enter Publishable Key">

												</div>
											  </div>
											<div class="col-sm-6">
												<div class="form-group">

													<label class="col-form-label" for="merchent_website"><b>Merchant Website<span class="text-danger">*</span></b>
													</label>
													 <input type="number" class="form-control" id="merchent_website"
														name="merchent_website" placeholder="Enter Merchent Website">

												</div>
											</div>
											
										</div>
										<div class="row">
											<div class="col-sm-6">
												<div class="form-group">

													<label class="col-form-label" for="phone"><b>Phone<span class="text-danger">*</span></b></label>
													<input type="text" class="form-control" id="phone" name="phone" placeholder="Enter phone">

												</div>
											  </div>
											<div class="col-sm-6">
												<div class="form-group">

													<label class="col-form-label" for="currency"><b>Currency</b>
													</label> <input type="text" class="form-control" id="currency"
														name="currency" placeholder="Enter currecny code">

												</div>
											</div>
											
										</div>

										<div id="lightgallery" class="row">
											<a href="images/big/img1.jpg"
												data-exthumbimage="images/big/img1.jpg"
												data-src="images/big/img1.jpg"
												class="col-lg-3 col-md-6 mb-4"> <img
												src="http://www.jusoutbeauty.com/site/themes/images/admin/big/img1.jpg"
												style="width: 100%;" />
											</a>
										</div>
										<div>
										   <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input">
                                                <label class="custom-file-label">Choose file</label>
                                            </div>
                                           </div>
										</div>

										<div class="save-admin-center mt-3">
										   <button class="btn btn-rounded btn-success mobile-save-btn">Save</button>
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
        