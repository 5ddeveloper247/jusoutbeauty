@include('admin.admin-header');
  <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <div class="container-fluid">
                <div class="page-titles">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="javascript:void(0)">Question</a></li>
						<li class="breadcrumb-item active"><a href="javascript:void(0)">Add</a></li>
					</ol>
                </div>
                <!-- row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Question</h4>
                            </div>
                            <div class="card-body">
                                <div class="form-validation">
									<form class="form-valide" action="#" method="post">
										<div class="row">
											<div class="col-sm-12">
												<div class="form-group">

													<label class="col-form-label" for="question"><b>Question</b> <span
														class="text-danger">*</span>
													</label>
													 <input type="text" class="form-control" id="question"
														name="question" placeholder="Enter a Question">

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
            
            
            
            
            
            <div class="row">
                <div class="col-xl-12 col-xxl-12">
                    <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Options</h4>
                            </div>
                            <div class="card-body">
								<div class="pt-4">
		                        <div class="row">
								   <div class="col-sm-4">
									</div>
									<div class="col-sm-4">
									</div>
									<div class="col-sm-4 align-center-verticle mb-3" >
									        <button class="btn btn-rounded btn-warning cmbm-6vw mt-2" style="width:100%;" data-toggle="modal" data-target=".add_option">Add</button>
									</div>
									
								</div>
								<div class="table-responsive">
                                    <table id="example5" class="display min-w850">
                                        <thead>
                                            <tr>
                                                <th>Seq</th>
                                                <th>Option</th>
                                                <th>Statue</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>Light Fair</td>
                                                <td>Enabled</td>
												
                                                <td>
													<div class="dropdown ml-auto text-right">
														<div class="btn-link" data-toggle="dropdown">
															<svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg>
														</div>
														<div class="dropdown-menu dropdown-menu-right">
															<a class="dropdown-item" href="#">Enable/Disable</a>
															<a class="dropdown-item" href="#">Remove</a>
														</div>
													</div>
												</td>												
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>Medium</td>
                                                <td>Enable</td>
                                                <td>
													<div class="dropdown ml-auto text-right">
														<div class="btn-link" data-toggle="dropdown">
															<svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg>
														</div>
														<div class="dropdown-menu dropdown-menu-right">
															<a class="dropdown-item" href="#">Enable/Disable</a>
															<a class="dropdown-item" href="#">Remove</a>
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
          
            <!-- --------------- ADD Created for you Product Image -->
                 <div class="modal fade add_option" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Add Option</h5>
                                                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                                    </button>
                                                </div>
						<div class="modal-body">
						    <div class="form-group">
						       <label>Option Title</label>
						       <input type="text" name="option" id="option" class="form-control">
						    </div>
							<div id="lightgallery" class="row">
								<a href="images/big/img1.jpg"
									data-exthumbimage="images/big/img1.jpg"
									data-src="images/big/img1.jpg" class="col-lg-3 col-md-6 mb-4">
									<img
									src="http://www.jusoutbeauty.com/themes/images/admin/big/img1.jpg"
									style="width: 100%;" />
								</a>
								<a href="images/big/img1.jpg"
									data-exthumbimage="images/big/img1.jpg"
									data-src="images/big/img1.jpg" class="col-lg-3 col-md-6 mb-4">
									<img
									src="http://www.jusoutbeauty.com/themes/images/admin/big/img1.jpg"
									style="width: 100%;" />
								</a>
							</div>
							<div>
								<div class="input-group">
									<div class="custom-file">
										<input type="cfupimg" class="custom-file-input"> <label
											class="custom-file-label">Choose file</label>
									</div>
								</div>
							</div>
						</div>
						<div class="modal-footer">
                                                    <button type="button" class="btn btn-danger light" data-dismiss="modal">Close</button>
                                                    <button type="button" class="btn btn-primary">Save changes</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    
                 <!-- ------------------------------------------------ -->
          
            
        </div>
        <!--**********************************
            Content body end
        ***********************************-->



       

    </div>
    @include('admin.admin-footer');