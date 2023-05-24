@include('admin.admin-header')
<script>
var userId = <?php echo session('userId');?>;
var site = '<?php echo session('site');?>';
var baseurl = "<?php echo url('/assets-admin');?>";
</script>
<div ng-app="project1">

	<div class="content-body" ng-controller="projectinfo1">
            <div class="container-fluid" ng-show="editView == '0'">
                <div class="page-titles">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="javascript:void(0)">Website Users</a></li>
						<li class="breadcrumb-item active"><a href="javascript:void(0)">View All</a></li>
					</ol>
                </div>
                <!-- row -->


                
                <div class="row">
                    
					<div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Website Users</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="usersTable" class="display min-w850">
                                        <thead>
                                            <tr>
                                               
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr ng-repeat="row in displayCollectionUsers">
                                                <td>@{{row.seqNo}}</td>
                                                <td>@{{row.firstName}} @{{row.lastName}}</td>
                                                <td>@{{row.email}}</td>
                                                <td>@{{row.phoneNumber}}</td>
                                               	<td>
													<span class="badge light badge-success" ng-if="row.status == 'active'">
														<i class="fa fa-circle text-success mr-1"></i>
														Active
													</span>
													<span class="badge light badge-danger" ng-if="row.status != 'active'">
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
    													    <a class="dropdown-item" href="javascript:;" ng-click="changeStatusWebsiteUser(@{{row.userId}});" ng-show="row.status != 'active'">Active</a>
															<a class="dropdown-item" href="javascript:;" ng-click="changeStatusWebsiteUser(@{{row.userId}});" ng-show="row.status == 'active'">InActive</a>
    													    <a class="dropdown-item" href="javascript:;" ng-click="viewWebsiteUserDetail(@{{row.userId}});">View Details</a>
    													</div>
													</div>
												</td>												
                                            </tr>
                                             <!-- <tr>
                                                <td>2</td>
                                                <td>Mohsin Ali</td>
                                                <td>mohsin@yomail.com</td>
                                                <td>+92 321 6767251</td>
                                                
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
    													    <a class="dropdown-item" href="javascript:;">Active</a>
															<a class="dropdown-item" href="javascript:;">InActive</a>
    													    <a class="dropdown-item" href="http://www.jusoutbeauty.com/site/app/admin/view_website_user">View Details</a>
    													</div>
													</div>
												</td>												
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>Johnson Smith</td>
                                                <td>johnsonsmith@yomail.com</td>
                                                <td>+92 547 6767251</td>
                                                
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
    													    <a class="dropdown-item" href="javascript:;">Active</a>
															<a class="dropdown-item" href="javascript:;">InActive</a>
    													    <a class="dropdown-item" href="http://www.jusoutbeauty.com/site/app/admin/view_website_user">View Details</a>
    													</div>
													</div>
												</td>
                                            </tr> -->
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
				</div>
            </div>
            
            <div class="container-fluid" ng-show="editView == '1'">
                <div class="page-titles">
					<ol class="breadcrumb">
						<li class="breadcrumb-item" ng-click="backToListing();"><i class="fa fa-arrow-left p-1"></i> &nbsp;<a href="javascript:void(0)">Website User</a></li>
						<li class="breadcrumb-item active"><a href="javascript:void(0)">Detail</a></li>
					</ol>
                </div>
                <!-- row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">User Information</h4>
                            </div>
                            <div class="card-body">
                                <div class="form-validation">
									<form class="form-valide" action="#" method="post">
										<div class="row">
											<div class="col-sm-6">
												<div class="form-group">
													<label class="col-form-label" for="order_number"><b>First Name</b></label> 
                                                    <p>@{{firstName}}</p>
												</div>
											</div>
											<div class="col-sm-6">
												<div class="form-group">
													<label class="col-form-label" for="order_number"><b>Last Name</b></label> 
                                                    <p>@{{lastName}}</p>
												</div>
											</div>
											  
											
											
										</div>
										
										<div class="row">
											<div class="col-sm-6">
												<div class="form-group">
													<label class="col-form-label" for="amount"><b>Email</b></label>
													<p>@{{email}}</p>
												</div>
											</div>
											<div class="col-sm-6">
												<div class="form-group">
													<label class="col-form-label" for="amount"><b>Phone Number</b></label>
													<p>@{{phoneNumber}}</p>
												</div>
											  </div>
											
										</div>
										<div class="row">
											
											<div class="col-sm-6">
												<div class="form-group">
													<label class="col-form-label" for="payment_date"><b>Registration Date</b></label>
													<p>@{{registrationDate}}</p>
												</div>
											</div>
											<div class="col-sm-6">
												<div class="form-group">
													<label class="col-form-label" for="status"><b>Status</b></label>
													<p>@{{status}}</p>
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
    @include('admin.admin-footer')
    
    <script src="{{ url('/assets-admin') }}/customjs/script_adminwebsiteusers.js?v={{time()}}"></script>