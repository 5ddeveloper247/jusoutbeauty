@include('admin.admin-header');
        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <div class="container-fluid">
                <div class="page-titles">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="javascript:void(0)">Partners</a></li>
						<li class="breadcrumb-item active"><a href="javascript:void(0)">View All</a></li>
					</ol>
                </div>
                <!-- row -->


                <div class="row">
                   <div class="col-12">
                       <a type="button" class="btn btn-rounded btn-warning admin-view-add mb-3" href="javascript:;">Add new</a><!-- {{session('site')}}/add-partner -->
                   </div>
                </div>
                <div class="row">
                    
					<div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Partners</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example5" class="display min-w850">
                                        <thead>
                                            <tr>
                                                <!-- <th>
													<div class="custom-control custom-checkbox">
														<input type="checkbox" class="custom-control-input" id="checkAll" required="">
														<label class="custom-control-label" for="checkAll"></label>
													</div>
												</th>-->
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>Country</th>
                                                <th>Total Orders</th>
                                                <th>Role</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Usama Qadeer</td>
                                                <td>usamaqadeer@yomail.com</td>
                                                <td>+92 321 6789090</td>
                                                <td>Pakistan</td>
                                                <td>0</td>
                                                <td>Instagramer</td>
												<td>
													<span class="badge light badge-success">
														<i class="fa fa-circle text-success mr-1"></i>
														Active
													</span>
												</td>
                                                <td>
													<div class="dropdown ml-auto text-right">
														<div class="btn-link" data-toggle="dropdown">
															<svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg>
														</div>
														<div class="dropdown-menu dropdown-menu-right">
															<a class="dropdown-item" href="#">Activate/InActivate</a>
															<a class="dropdown-item" href="http://www.jusoutbeauty.com/app/admin/partners/edit">Edit</a>
															<a class="dropdown-item" href="#" data-toggle="modal" data-target="#alertDel">Delete</a>
															<a class="dropdown-item" href="http://www.jusoutbeauty.com/app/admin/partners/view">View Details</a>
															<a class="dropdown-item" href="#">Email Agreement</a>
														</div>
													</div>
												</td>												
                                            </tr>
                                             <tr>
                                                <td>Mohsin Ali</td>
                                                <td>mohsin@yomail.com</td>
                                                <td>+92 321 6767251</td>
                                                <td>Pakistan</td>
                                                <td>10</td>
                                                <td>Influencer</td>
												<td>
													<span class="badge light badge-warning">
														<i class="fa fa-circle text-warning mr-1"></i>
														InActive
													</span>
												</td>
                                                <td>
													<div class="dropdown ml-auto text-right">
														<div class="btn-link" data-toggle="dropdown">
															<svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg>
														</div>
														<div class="dropdown-menu dropdown-menu-right">
															<a class="dropdown-item" href="#">Activate/InActivate</a>
															<a class="dropdown-item" href="http://www.jusoutbeauty.com/app/admin/partners/edit">Edit</a>
															<a class="dropdown-item" href="#" data-toggle="modal" data-target="#alertDel">Delete</a>
															<a class="dropdown-item" href="http://www.jusoutbeauty.com/app/admin/partners/view">View Details</a>
															<a class="dropdown-item" href="#">Email Agreement</a>
														</div>
													</div>
												</td>												
                                            </tr>
                                            <tr>
                                                <td>Johnson Smith</td>
                                                <td>johnsonsmith@yomail.com</td>
                                                <td>+92 547 6767251</td>
                                                <td>Australia</td>
                                                <td>6</td>
                                                <td>Instagramer</td>
                                                <td>
													<span class="badge light badge-danger">
														<i class="fa fa-circle text-danger mr-1"></i>
														Suspended
													</span>
												</td>
												<td>
													<div class="dropdown ml-auto text-right">
    													<div class="btn-link" data-toggle="dropdown">
    													   <svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg>
    													</div>
    													<div class="dropdown-menu dropdown-menu-right">
															<a class="dropdown-item" href="#">Activate/InActivate</a>
															<a class="dropdown-item" href="http://www.jusoutbeauty.com/app/admin/partners/edit">Edit</a>
															<a class="dropdown-item" href="#" data-toggle="modal" data-target="#alertDel">Delete</a>
															<a class="dropdown-item" href="http://www.jusoutbeauty.com/app/admin/partners/view">View Details</a>
															<a class="dropdown-item" href="#">Email Agreement</a>
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
            
			<div class="modal fade" id="alertDel">
				<div class="modal-dialog" role="document">
					<div class="modal-content align-center-verticle">
						
						<div class="modal-body">
                           <h4 style="text-align: center;">Are Your sure to delete this ?</h4>
                        </div>
						<div class="modal-footer" style="border-top: unset !important;">
							<button type="button" class="btn btn-danger light"
								data-dismiss="modal">No</button>
							<button type="button" class="btn btn-primary">Yes</button>
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