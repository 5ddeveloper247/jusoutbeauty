@include('admin.admin-header')
<script>
var userId = <?php echo session('userId');?>;
var site = '<?php echo session('site');?>';
var baseurl = "<?php echo url('/assets-admin');?>";
</script>
	<div ng-app="project1">
 <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body" ng-controller="projectinfo1">
            <div class="container-fluid pt-0">
                <div class="page-titles mb-0 pt-0">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="javascript:void(0)">Update Profile</a></li>
					</ol>
                </div>
                <!-- row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Admin Information</h4>
                            </div>
                            <div class="card-body">
                                <div class="form-validation">
									<form class="form-valide">
										<div class="row">
											<div class="col-sm-6">
												<div class="form-group">
													<label class="col-form-label" for="first_name"><b>First Name</b> <span class="text-danger">*</span> </label>
													<input type="text" class="form-control" id="first_name" ng-model="user['A_1']" placeholder="Enter a First Name">
												</div>
											</div>
											<div class="col-sm-6">
												<div class="form-group">
													<label class="col-form-label" for="last_name"><b>Last Name<span class="text-danger">*</span></b> </label>
													<input type="text" class="form-control" id="last_name" ng-model="user['A_2']" placeholder="Last Name">
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-sm-6">
												<div class="form-group">
													<label class="col-form-label" for="email"><b>Email<span class="text-danger">*</span></b> </label>
													<input type="email" class="form-control" id="email" ng-model="user['A_3']" placeholder="Enter Email">
												</div>
											</div>
											<div class="col-sm-6">
												<div class="form-group">
													<label class="col-form-label" for="phone_number"><b>Phone Number<span class="text-danger">*</span></b> </label>
													<input type="number" class="form-control" id="phone_number" ng-model="user['A_4']" placeholder="Phone Number">
												</div>
											</div>

										</div>
                                        <div class="text-center mt-3">
                                            <div class="row">
                                                <div class="col-12">
                                                <button type="button" class="btn btn-rounded btn-success" ng-click="updateAdminProfile();">Update Profile</button>
                                                </div>
                                            </div>
                                        </div>
									</form>
								</div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Change Password</h4>
                            </div>
                            <div class="card-body">
                                <div class="form-validation">
									<form class="form-valide">
										<div class="row">
											<div class="col-sm-6">
												<div class="form-group">
													<label class="col-form-label" for="currentPassword"><b>Current Password</b> <span class="text-danger">*</span> </label>
													<input type="password" class="form-control" id="currentPassword" ng-model="password['C_1']" placeholder="Current Password">
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-sm-6">
												<div class="form-group">
													<label class="col-form-label" for="newPassword"><b>New Password<span class="text-danger">*</span></b> </label>
													<input type="password" class="form-control" id="newPassword" ng-model="password['C_2']" placeholder="New Password">
												</div>
											</div>
											<div class="col-sm-6">
												<div class="form-group">
													<label class="col-form-label" for="confirmNewPassword"><b>Confirm New Password<span class="text-danger">*</span></b> </label>
													<input type="password" class="form-control" id="confirmNewPassword" ng-model="password['C_3']" placeholder="Confirm New Password">
												</div>
											</div>

										</div>
                                        <div class="text-center mt-3">
                                            <div class="row">
                                                <div class="col-12">
                                                <button type="button" class="btn btn-rounded btn-success " ng-click="updateAdminPassword();">Update Password</button>
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
    @include('admin.admin-footer')

	<script src="{{ url('/assets-admin') }}/customjs/script_adminprofile.js?v={{time()}}"></script>
