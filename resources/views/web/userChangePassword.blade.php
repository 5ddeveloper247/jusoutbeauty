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
						<li class="breadcrumb-item"><a href="javascript:void(0)">Change Password</a></li>
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
													<label class="col-form-label" for="current_password"><b>Current Password</b> <span class="text-danger">*</span> </label> 
													<input type="text" class="form-control" id="current_password" ng-model="user1['A_1']" placeholder="Current Password">
												</div>
											</div>
											<div class="col-sm-6">
												
											</div>
										</div>
										<div class="row">
											<div class="col-sm-6">
												<div class="form-group">
													<label class="col-form-label" for="new_pass"><b>New Password<span class="text-danger">*</span></b> </label> 
													<input type="text" class="form-control" id="new_pass" ng-model="user1['A_2']" placeholder="New Password">
												</div>
											</div>
											<div class="col-sm-6">
												<div class="form-group">
													<label class="col-form-label" for=""confirm_new_pass""><b>Confirm New Password<span class="text-danger">*</span></b> </label> 
													<input type="text" class="form-control" id="confirm_new_pass" ng-model="user1['A_3']" placeholder="Confirm New Password">
												</div>
											</div>
										</div>
										
										<div class="save-admin-center mt-3">
										   <button type="button" class="btn btn-rounded btn-success mobile-save-btn" ng-click="updateUserPassword();" style="width:16%;">Update Password</button>
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