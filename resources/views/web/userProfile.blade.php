@include('web.web-header-userprofile')
<script>
	var site = '<?php echo session('site');?>';
</script>
	<div ng-app="project1">
 <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body" ng-controller="projectinfo1">
            <div class="container-fluid pt-0">
                <div class="page-titles mb-0 pt-0" style="margin-top: 0px;">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="javascript:void(0)">Update Profile</a></li>
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
													<input type="text" class="form-control" id="email" ng-model="user['A_3']" placeholder="Enter Email">
												</div>
											</div>
											<div class="col-sm-6">
												<div class="form-group">
													<label class="col-form-label" for="phone_number"><b>Phone Number<span class="text-danger">*</span></b> </label>
													<input type="number" class="form-control" id="phone_number" ng-model="user['A_4']" placeholder="Phone Number without dahses">
												</div>
											</div>

										</div>

										<div class="save-admin-center mt-3">
										   <button type="button" class="btn btn-rounded btn-success mobile-save-btn" ng-click="updateUserProfile();">Update Profile</button>
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

    <script src="{{ url('/assets-web') }}/customjs/script_userprofile.js?v={{time()}}"></script>
