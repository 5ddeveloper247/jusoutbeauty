@include('admin.admin-header')
<script>
    var userId = '<?php echo session('userId'); ?>';
    var site = '<?php echo session('site'); ?>';
    var baseurl = "<?php echo url('/assets-admin'); ?>";
</script>
	<div ng-app="project1">

        <div class="content-body" ng-controller="projectinfo1">
        	<div class="container-fluid" ng-show="editView == '0'">
                <div class="page-titles">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="javascript:void(0)">Email Settings</a></li>
					</ol>
                </div>
                <!-- row -->

                <div class="row">
					<div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Email Settings</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="emailConfigTable" class="display min-w850">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Type</th>
                                                <th>Title</th>
                                                <th>Message</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                            <tr ng-repeat="row in displayCollectionEmailConfig">
                                                <td>@{{row.seqNo}}</td>
                                                <td>@{{row.MODULE_CODE}}</td>
                                                <td>@{{row.TITLE}}</td>
                                                <td>@{{row.MESSAGE_TRIM}}</td>
                                                 
                                                <td>
													<div class="dropdown ml-auto text-right">
														<div class="btn-link" data-toggle="dropdown">
															<svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg>
														</div>
														<div class="dropdown-menu dropdown-menu-right">
															<a class="dropdown-item"  href="javascript:;" ng-click="continueRecord(@{{row.EMAIL_CONFIG_ID}});">Edit</a>
<!-- 															<a class="dropdown-item"  href="#"  data-toggle="modal" data-target=".send_repy">Reply</a> -->
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
            
            <div class="container-fluid" ng-show="editView == '1'">
               <div class="row">
					<div class="col-xl-3 col-xxl-4">
						<div class="row">
							<div class="col-xl-12 col-lg-6">
								<div class="card  flex-lg-column flex-md-row ">
									<div class="card-body card-body  text-center border-bottom profile-bx" onclick="form();">
										<div class="profile-image mb-4" style="background-image:unset;">
											<img src="@{{email.downpath}}" class="" alt=""><!-- rounded-circle -->
										</div>
										<h4 class="fs-22 text-black mb-1">Email Logo</h4>
										<p class="fs-12" style="color:#c7c7c7;">170 X 70</p>										
									</div>
									
									<form class="" id="uploadattch" method="POST" action="uploadEmailConfigLogo" enctype="multipart/form-data">
										<input type="hidden" name="_method" value="POST">
           								{{ csrf_field() }}
           								<input type="hidden" id="userId" name="userId" value="<?php echo session('userId');?>">
										<input type="hidden" id="sourceId" name="sourceId" value="@{{email.ID}}">
										<input type="hidden" id="sourceCode" name="sourceCode" value="EMAIL_LOGO"> 
										<input type="file" id="uploadattl" name="uploadattl" class="file-input" style="display: none;">
									</form>
								</div>
							</div>
							
						</div>
					</div>
					<div class="col-xl-9 col-xxl-8">
						<div class="row">
							<div class="col-xl-12">
								<div class="card profile-card">
									<div class="card-header flex-wrap border-0 pb-0">
										<h3 class="fs-24 text-black font-w600 mr-auto mb-2 pr-3">Email Settings</h3>
										<div class="d-sm-flex d-block">
											
											<a  class="btn btn-dark light rounded mr-3 mb-2" href="javascript:;" ng-click="backToListing();">Cancel</a>
											<a class="btn btn-primary rounded mb-2" href="javascript:;" ng-click="saveEmailConfigurations();">Save Changes</a>
										</div>
									</div>
									<div class="card-body">
										<form>
											<div class="mb-sm-5 mb-2">
												<div class="row">
													<div class="col-xl-12 col-sm-12">
														<div class="form-group">
															<label>Title</label>
															<input type="text" class="form-control" ng-model="email['A_1']" placeholder="Enter Title">
														</div>
													</div>
													<div class="col-xl-12 col-sm-12">
														<div class="form-group">
															<label>Email Subject</label>
															<input type="text" class="form-control" ng-model="email['A_2']" placeholder="Type Subject">
														</div>
													</div>
													<div class="col-xl-12 col-sm-12">
														<div class="form-group">
															<label>Email From</label>
															<input type="text" class="form-control" ng-model="email['A_3']" placeholder="Type Email">
														</div>
													</div>
													
													<div class="col-xl-12 col-sm-12">
														<div class="pt-4">
															<div class="form-group mb-0">
																<label id="desc_title">Message</label> 
															</div>
															<div class="summernote" id="message_description"></div>
														</div>
<!-- 														<div class="form-group"> -->
<!-- 															<label>Message</label> -->
<!-- 															<textarea class="form-control" rows="10" ng-model="email['A_4']" name="message" id="message" placeholder="Enter Message"></textarea> -->
<!-- 														</div> -->
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
           
        </div>
        <!--**********************************
            Content body end
        ***********************************-->

       

    </div>
    @include('admin.admin-footer')
    
    <script src="{{ url('/assets-admin') }}/customjs/script_adminemailconfig.js?v={{time()}}"></script>
    
    <script>

    function form(){
    	$("#uploadattl").click();
    }
    </script>