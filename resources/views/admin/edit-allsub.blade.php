@include('admin.admin-header');
 <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <div class="container-fluid">
                <div class="page-titles">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="javascript:void(0)">Subscription</a></li>
						<li class="breadcrumb-item active"><a href="javascript:void(0)">Edit</a></li>
					</ol>
                </div>
                <!-- row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Subscription Information</h4>
                            </div>
                            <div class="card-body">
                                <div class="form-validation">
									<form class="form-valide" action="#" method="post">
										<div class="row">
											<div class="col-sm-6">
												<div class="form-group">
													<label class="col-form-label" for="title"><b>Title</b> <span
														class="text-danger">*</span>
													</label>
													<input type="text" class="form-control" id="title"
														name="title" placeholder="Enter Subscription Title">
												</div>
											  </div>
											  <div class="col-sm-6">
												<div class="form-group">
													<label class="col-form-label" for="price"><b>Price</b> <span
														class="text-danger">*</span>
													</label>
													<input type="number" class="form-control" id="price"
														name="price" placeholder="Enter Price...">
												</div>
											  </div>
										</div>
										
										<div class="row">
											<div class="col-sm-6">
												<div class="form-group">
													<label class="col-form-label" for="start_date"><b>Effective Start date</b> <span
														class="text-danger">*</span>
													</label>
													<input type="date" class="form-control" id="start_date"
														name="start_date">
												</div>
											  </div>
											  <div class="col-sm-6">
												<div class="form-group">
													<label class="col-form-label" for="end_date"><b>Effective End date</b> <span
														class="text-danger">*</span>
													</label>
													<input type="date" class="form-control" id="end_date"
														name="end_date">
												</div>
											  </div>
											
										</div>
										
										
										<div class="row">
											<div class="col-sm-6">
												<div class="form-group">
													<label class="col-form-label" for="total_subscriptions"><b>Total Subscriptions Allowed</b> <span
														class="text-danger">*</span>
													</label>
													<input type="number" class="form-control" id="total_subscriptions"
														name="total_subscriptions">
												</div>
											  </div>
											  <div class="col-sm-6">
												<div class="form-group">
													<label class="col-form-label" for="end_date"><b>Discount</b> <span
														class="text-danger">*</span>
													</label>
													<input type="number" class="form-control" id="discount"
														name="discount">
												</div>
											  </div>
											
										</div>
										<div class="row">
											
											  <div class="col-sm-6">
												<div class="form-group">
													<label class="col-form-label" for="validity_days"><b>Validity Days</b> <span
														class="text-danger">*</span>
													</label>
													<input type="number" class="form-control" id="validity_days"
														name="validity_days">
												</div>
											  </div>
											
										</div>
										<div class="row">
										    <div class="col-sm-12">
										      <div class="form-group">
													<label class="col-form-label" for="detail"><b>Detail</b> <span
														class="text-danger">*</span>
													</label>
													<textarea class="form-control" name="detail" id="detail" rows="8" placeholder="Enter Detail..."></textarea>
													
												</div>
										    </div>


											<div class="col-sm-12">
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
															<input type="banner1" class="custom-file-input"> <label
																class="custom-file-label">Choose file</label>
														</div>
													</div>
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