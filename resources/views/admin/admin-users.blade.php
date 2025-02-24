@include('admin.admin-header')
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
                <!-- row -->
				<div class="row mt-4">
                	<div class="col-6 ">
                		<div class="page-titles pt-0 pb-0 mb-0 mt-1">
							<ol class="breadcrumb">
								<li class="breadcrumb-item active"><a href="javascript:void(0)">Admin Users</a></li>
							</ol>
		                </div>
                	</div>
					<div class="col-3">

                    </div>
                   	<div class="col-3">
                       <a type="button" class="btn btn-rounded btn-warning admin-view-add mb-3" href="javascript:void(0)" ng-click="addNew();">Add new Admin</a>
                   	</div>
                </div>


                <div class="row">
					<div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Admins</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="AdminTable" class="display min-w850">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <tr ng-repeat="row in allAdminUsers">
                                                <td>@{{row.FIRST_NAME}} @{{row.LAST_NAME}}</td>
                                                <td>@{{row.EMAIL}}</td>
												<td>
													<span class="badge light badge-danger" ng-if="row.USER_STATUS == 'inactive'">
														<i class="fa fa-circle text-danger mr-1"></i>
														InActive
													</span>
													<span class="badge light badge-success" ng-if="row.USER_STATUS == 'active'">
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
															<a class="dropdown-item" href="javascript:;" ng-click="changeStatusAdmin(@{{row.USER_ID}});" ng-show="row.USER_STATUS != 'active'">Active</a>
															<a class="dropdown-item" href="javascript:;" ng-click="changeStatusAdmin(@{{row.USER_ID}});" ng-show="row.USER_STATUS == 'active'">Inactive</a>
															<a class="dropdown-item" href="javascript:;" ng-click="editAdmin(@{{row.USER_ID}});">Edit</a>
															<a class="dropdown-item" href="javascript:;" ng-click="deleteAdmin(@{{row.USER_ID}});" ng-if="row.USER_ID!=1">Delete</a>
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


            <!-- ==================== ADD ADMIN ================= -->

			<div class="container-fluid pt-0" ng-show="editView == '1'">
				<div class="page-titles pt-0 mb-0">
					<ol class="breadcrumb">

						<li class="breadcrumb-item" ng-click="backToListing();"><i class="fa fa-arrow-left p-1"></i> &nbsp;<a href="javascript:void(0)">Back</a></li>
						<!-- <li class="breadcrumb-item active"><a href="javascript:void(0)">Process</a></li> -->
					</ol>
				</div>
				<!-- row -->
				<div class="row">
					<div class="col-xl-12 col-xxl-12">
						<div class="card">
							<div class="card-header">
								<h4 class="card-title">Create Admin User</h4>
							</div>
							<div class="card-body">
								<!-- Nav tabs -->
								<ul class="nav nav-tabs" role="tablist">
									<li class="nav-item"><a class="nav-link active"
										data-toggle="tab" href="#basic_info"> <span> Information </span>
									</a></li>
								</ul>
								<!-- Tab panes -->
								<div class="tab-content tabcontent-border">
									<div class="tab-pane fade show active" id="basic_info" role="tabpanel">
										<div class="pt-4">
											{{-- <div class="form-validation"> --}}
												<form class="form-valide" action="#" method="post" autocomplete="off">

													<div class="row">
														<div class="col-sm-6">
															<div class="form-group">

																<label class="col-form-label" for="firstname"><b>First Name</b>  <span class="text-danger">*</span>  </label>
																<input type="text" class="form-control" id="firstname" ng-model="user['FirstName']" placeholder="Enter First Name">

															</div>
														</div>
														<div class="col-sm-6">
															<div class="form-group">

																<label class="col-form-label" for="lastname"><b>Last Name</b>  <span class="text-danger">*</span>  </label>
																<input type="tel" class="form-control" id="lastname" ng-model="user['LastName']" placeholder="Enter Last Name">

															</div>
														</div>
													</div>

													<div class="row">
														<div class="col-sm-6">
															<div class="form-group">

																<label class="col-form-label" for="userrole"><b>User Role</b>  <span class="text-danger">*</span>  </label>
																<input type="text" class="form-control" id="userrole" ng-model="user['UserRole']" placeholder="Enter User Role" role="presentation"  autocomplete="off">

															</div>
														</div>
														<div class="col-sm-6">
															<div class="form-group">

																<label class="col-form-label" for="phonenumber"><b>Phone Number</b>  <span class="text-danger">*</span>  </label>
																<!-- Country names and Phone Code -->
                                                                <input type="number" class="form-control" id="phonenumber" ng-model="user['PhoneNumber']" placeholder="Enter Phone Number without dashes ">

															</div>
														</div>
													</div>

													<div class="row">
														<div class="col-6">
															<div class="form-group">

																<label class="col-form-label" for="name"><b>Email</b>  <span class="text-danger">*</span>  </label>
																<input type="email" class="form-control" id="email" ng-model="user['EmailAddress']" placeholder="Enter Email Address" role="presentation"  autocomplete="off">

															</div>
														</div>
													</div>

													<div class="row">
														<div class="col">
															<div class="form-group">

																<label class="col-form-label" for="unit"><b>Password</b> <span class="text-danger">*</span>   </label>
																<input type="password" name="new-password" class="form-control" id="password" ng-model="user['Password']" placeholder="Enter Password" autocomplete="new-password">
															</div>
														</div>
														<div class="col-sm-6">
															<div class="form-group">

																<label class="col-form-label" for="brand"><b>Confirm Password</b> <span class="text-danger">*</span> </label>
																<input type="password" class="form-control" id="confirmpassword" ng-model="user['ConfirmPassword']" placeholder="Confirm Password">

															</div>
														</div>
													</div>

													<div class="row">
														<div class="col">
															<div class="form-group">
																<input type="checkbox" id="enable" name="enable"  ng-model="user['Enable']" class="m-1">
																<label for="enable"><b> Enable </b> </label><br>
															</div>
														</div>
													</div>

												</form>
											{{-- </div> --}}
										</div>
									</div>

								</div>
								<div class="row">
                	               	<div class="col-12 pt-4">
				                       <a type="button" class="btn btn-rounded btn-warning admin-view-add mb-3" ng-click="saveAdminUser();">Save</a>
				                   	</div>
		                		</div>
							</div>


						</div>


					</div>
				</div>

				<!-- row -->
				<div class="row" ng-if="user.ID!=1" >
					<div class="col-xl-12 col-xxl-12">
						<div class="card">
							<div class="card-header">
								<h4 class="card-title">Sub User Menu Control :</h4>
							</div>
							<div class="card-body">
								<!-- Tab panes -->
								<div class="tab-content tabcontent-border">
									<div class="tab-pane fade show active" id="basic_info" role="tabpanel">
										<div class="pt-4">
											<!-- Setting Permissions To User -->
											<div class="form-validation">

												<form class="form-valide" action="#" method="post">
													<div class="row">
														<div class="col-4" ng-repeat="row in allNavLinks" id="menu_list_@{{row.MENU_ID}}" >
															<div class="form-group">
																<input type="checkbox" id="menu_@{{row.MENU_ID}}" class="m-1 menu_check" value=@{{row.MENU_ID}}>
																<label for="menu_@{{row.MENU_ID}}"><b> @{{row.MENU_NAME}} </b> </label><br>
															</div>
														</div>
													</div>
												</form>
											</div>
										</div>
									</div>
								</div>
                                <hr>
                                <!-- Tab panes -->
								<div class="tab-content tabcontent-border">
									<div class="tab-pane fade show active" id="basic_info" role="tabpanel">
										<div class="pt-4">
											<!-- Setting Permissions To User -->
											<div class="form-validation">

												<form class="form-valide" action="#" method="post">
													<div class="row">
														<div class="col-4" ng-repeat="row in getDashboardNavLinks" id="menu_list_@{{row.MENU_ID}}" >
															<div class="form-group">
																<input type="checkbox" id="menu_@{{row.MENU_ID}}" class="m-1 menu_check" value=@{{row.MENU_ID}}>
																<label for="menu_@{{row.MENU_ID}}"><b> @{{row.MENU_NAME}} </b> </label><br>
															</div>
														</div>
													</div>
												</form>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
                	               	<div class="col-12 pt-4">
				                       <a type="button" class="btn btn-rounded btn-warning admin-view-add mb-3" ng-click="saveAdminUserMenuControls();">Save</a>
				                   	</div>
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
			<div class="modal fade" id="confirmProdImageModal">
				<div class="modal-dialog modal-dialog-centered" role="document">
					<div class="modal-content">
						<div class="modal-header">
					<!-- 	<h5 class="modal-title">Change State</h5> -->
							<button type="button" class="close" data-dismiss="modal">
								<span>&times;</span>
							</button>
						</div>
						<div class="modal-body">

							<div class="row">
							   <div class="col-12">
							     <label><b>Selected Image mark as primary or secondary!!!</b></label>
							   </div>
							</div>

						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-danger light" ng-click="closeProdImageModal();">Close</button>
							<button type="button" class="btn btn-warning" ng-click="markProductDetailImageFlag(1);">Mark Primary</button>
							<button type="button" class="btn btn-warning" ng-click="markProductDetailImageFlag(2);">Mark Secondary</button>
						</div>
					</div>
				</div>
			</div>
		</div>


    </div>

    @include('admin.admin-footer')

    <!--**********************************
            Content body end
        ***********************************-->

    <script>
		// $('input[name="address"]').attr('autocomplete','none');
	</script>
	<script src="{{ url('/assets-admin') }}/customjs/script_adminusercontrol.js?v={{time()}}"></script>

