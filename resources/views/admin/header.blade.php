@include('admin.admin-header');
 <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <div class="container-fluid">
                <div class="page-titles">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="javascript:void(0)">Header</a></li>
						<li class="breadcrumb-item active"><a href="javascript:void(0)">Add</a></li>
					</ol>
                </div>
                <!-- row -->
                <div class="row">
                <div class="col-xl-12 col-xxl-12">
                    <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Header Information</h4>
                            </div>
                            <div class="card-body">
								 <!-- Nav tabs -->
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#website_logo">
                                            <span>
                                                Website Logo
                                            </span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#menu_items">
                                            <span>
                                               Menu Items
                                            </span>
                                        </a>
                                    </li>
                                </ul>
                                <!-- Tab panes -->
                                <div class="tab-content tabcontent-border">
                                     <div class="tab-pane fade show active" id="website_logo" role="tabpanel">
	                                    <div class="pt-4">
	                                        <div id="lightgallery" class="row">
											<a href="images/big/img1.jpg"
												data-exthumbimage="images/big/img1.jpg"
												data-src="images/big/img1.jpg"
												class="col-lg-3 col-md-6 mb-4"> <img
												src="http://www.jusoutbeauty.com/themes/images/admin/big/img1.jpg"
												style="width: 100%;" />
											</a>
    										</div>
    										<div>
    										   <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="logofile" class="custom-file-input">
                                                    <label class="custom-file-label">Choose file</label>
                                                </div>
                                               </div>
    										</div>
											<div class="save-admin-center mt-3">
												<button class="btn btn-rounded btn-success mobile-save-btn">Save</button>
											</div>

										</div>
	                                  </div>
	                                  <div class="tab-pane" id="menu_items" role="tabpanel">
	                                    <div class="pt-4">
	                                      <div class="card-body">
	                                         <div class="row">
	                                            <div class="col-sm-6">
	                                                <div class="form-group">
            											<label for="home">Home</label>
            											<input type="text" id="home" name="home" class="form-control font-w500">
            										</div>
	                                            </div>
	                                            <div class="col-sm-3">
	                                                <div class="custom-control custom-checkbox mb-3 checkbox-warning">
                        								<input type="checkbox" class="custom-control-input" checked id="fbactive" name="fbactive">
                        								<label class="custom-control-label" for="fbactive">Active</label>
                        							</div>
	                                            </div>
	                                            <div class="col-sm-3">
	                                                <button class="btn btn-rounded btn-warning" style="width:100%;">Save</button>
	                                            </div>
	                                         </div>
	                                         <div class="row">
	                                            <div class="col-sm-6">
	                                                <div class="form-group">
            											<label for="products">Products</label>
            											<input type="text" id="products" name="products" class="form-control font-w500">
            										</div>
	                                            </div>
	                                            <div class="col-sm-3">
	                                                <div class="custom-control custom-checkbox mb-3 checkbox-warning">
                        								<input type="checkbox" class="custom-control-input" checked id="productactive" name="productactive">
                        								<label class="custom-control-label" for="productactive">Active</label>
                        							</div>
	                                            </div>
	                                            <div class="col-sm-3">
	                                                <button class="btn btn-rounded btn-warning" style="width:100%;">Save</button>
	                                            </div>
	                                         </div>
	                                         
	                                         <div class="row">
	                                            <div class="col-sm-6">
	                                                <div class="form-group">
            											<label for="contactus">Contact US</label>
            											<input type="text" id="contact_us" name="contact_us" class="form-control font-w500">
            										</div>
	                                            </div>
	                                            <div class="col-sm-3">
	                                                <div class="custom-control custom-checkbox mb-3 checkbox-warning">
                        								<input type="checkbox" class="custom-control-input" checked id="contact_usactive" name="contact_usactive">
                        								<label class="custom-control-label" for="contact_usactive">Active</label>
                        							</div>
	                                            </div>
	                                            <div class="col-sm-3">
	                                                <button class="btn btn-rounded btn-warning" style="width:100%;">Save</button>
	                                            </div>
	                                         </div>
	                                         
	                                          <div class="row">
	                                            <div class="col-sm-6">
	                                                <div class="form-group">
            											<label for="contactus">Discover</label>
            											<input type="text" id="discover" name="discover" class="form-control font-w500">
            										</div>
	                                            </div>
	                                            <div class="col-sm-3">
	                                                <div class="custom-control custom-checkbox mb-3 checkbox-warning">
                        								<input type="checkbox" class="custom-control-input" checked id="discoveractive" name="discoveractive">
                        								<label class="custom-control-label" for="discoveractive">Active</label>
                        							</div>
	                                            </div>
	                                            <div class="col-sm-3">
	                                                <button class="btn btn-rounded btn-warning" style="width:100%;">Save</button>
	                                            </div>
	                                         </div>
	                                         
	                                          <div class="row">
	                                            <div class="col-sm-6">
	                                                <div class="form-group">
            											<label for="giving">Giving</label>
            											<input type="text" id="giving" name="giving" class="form-control font-w500">
            										</div>
	                                            </div>
	                                            <div class="col-sm-3">
	                                                <div class="custom-control custom-checkbox mb-3 checkbox-warning">
                        								<input type="checkbox" class="custom-control-input" checked id="givingactive" name="givingactive">
                        								<label class="custom-control-label" for="givingactive">Active</label>
                        							</div>
	                                            </div>
	                                            <div class="col-sm-3">
	                                                <button class="btn btn-rounded btn-warning mobile-save-btn" style="width:100%;">Save</button>
	                                            </div>
	                                         </div>
    										
	                                         
    										
    										
    											
    										
									      </div>
	                                       <div>
	                                    </div>
	                                  </div>
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