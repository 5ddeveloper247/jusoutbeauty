@include('admin.admin-header');
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
            <div class="container-fluid pt-0" ng-show="editView == '0'">
                
                <!-- row -->

                <div class="row">
                	<div class="col-10">
	               		<div class="page-titles mb-0">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="javascript:void(0)">Subscription</a></li>
							</ol>
		                </div>
	                </div>
                   	<div class="col-2">
                    	<a type="button" class="btn btn-rounded btn-warning admin-view-add mb-3" ng-click="addNew();">Add new</a><!-- /add-allsub -->
                   	</div>
                </div>
                <div class="row">
					<div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Subscription</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="subscriptionTable" class="display min-w850">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Title</th>
<!--                                                 <th>Price</th> -->
                                                <th>Start Date</th>
                                                <th>End Date</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr ng-repeat="row in displayCollectionSubscription">
                                                <td>@{{row.seqNo}}</td>
                                                <td>@{{row.TITLE}}</td>
<!--                                                 <td>$@{{row.PRICE}}</td> -->
                                                <td>@{{row.EFF_START_DATE}}</td>
                                                <td>@{{row.EFF_END_DATE}}</td>
												<td>
													<span class="badge light badge-success" ng-if="row.STATUS == 'active'">
														<i class="fa fa-circle text-success mr-1"></i>
														Active
													</span>
													<span class="badge light badge-danger" ng-if="row.STATUS == 'inactive'">
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
															<a class="dropdown-item" href="javascript:;" ng-click="changeStatusSubscription(row.SUBSCRIPTION_ID);" ng-if="row.STATUS == 'active'">InActive</a>
															<a class="dropdown-item" href="javascript:;" ng-click="changeStatusSubscription(row.SUBSCRIPTION_ID);" ng-if="row.STATUS == 'inactive'">Active</a>
															<a class="dropdown-item" href="javascript:;" ng-click="continouRecord(row.SUBSCRIPTION_ID);">Edit</a>
															<a class="dropdown-item" href="javascript:;" ng-click="deleteRecord(row.SUBSCRIPTION_ID);">Delete</a>
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
                <div class="page-titles mb-0">
					<ol class="breadcrumb">
					
						<li class="breadcrumb-item" ng-click="backToListing();"><i class="fa fa-arrow-left p-1"></i> &nbsp;<a href="javascript:void(0)" ng-click="backToListing()">Subscription</a></li>
						<li class="breadcrumb-item active"><a href="javascript:void(0)">Add</a></li>
						
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
									<form class="form-valide">
										<div class="row">
											<div class="col-sm-6">
												<div class="form-group">
													<label class="col-form-label" for="s1"><b>Title</b> <span class="text-danger">*</span> </label>
													<input type="text" class="form-control" id="s1" ng-model="subscription['S_1']" placeholder="Enter Subscription Title">
												</div>
											  </div>
											  <!-- <div class="col-sm-6">
												<div class="form-group" >
													<label class="col-form-label" for="s2"><b>Price</b> <span class="text-danger">*</span> </label>
													<input type="number" class="form-control" id="s2" ng-model="subscription['S_2']" placeholder="Enter Price...">
												</div>
											  </div> -->
										</div>
										
										<div class="row">
											<div class="col-sm-6">
												<div class="form-group">
													<label class="col-form-label" for="s3"><b>Effective Start date</b> <span class="text-danger">*</span> </label>
													<input type="date" class="form-control" id="s3" ng-model="subscription['S_3']">
												</div>
											  </div>
											  <div class="col-sm-6">
												<div class="form-group">
													<label class="col-form-label" for="s4"><b>Effective End date</b> <span class="text-danger">*</span> </label>
													<input type="date" class="form-control" id="s4" ng-model="subscription['S_4']">
												</div>
											  </div>
										</div>
										
										<div class="row">
											<div class="col-sm-6">
												<div class="form-group">
													<label class="col-form-label" for="s5"><b>Subscription Note 1</b> <span class="text-danger">*</span> </label>
													<input type="text" class="form-control" id="s5" ng-model="subscription['S_5']">
												</div>
											  </div>
											  <div class="col-sm-6">
												<div class="form-group">
													<label class="col-form-label" for="s6"><b>Subscription Note 2</b> <span class="text-danger">*</span> </label>
													<input type="text" class="form-control" id="s6" ng-model="subscription['S_6']">
												</div>
											  </div>
										</div>
										
										<div class="row">
											<div class="col-sm-6">
												<div class="form-group">
													<label class="col-form-label" for="s7"><b>Duration (Months)</b> <span class="text-danger">*</span> </label>
													<input type="number" class="form-control" id="s7" ng-model="subscription['S_7']">
												</div>
											  </div>
											  <div class="col-sm-6">
												<div class="form-group">
													<label class="col-form-label" for="s8"><b>Discount</b> <span class="text-danger">*</span> </label>
													<input type="number" class="form-control" id="s8" ng-model="subscription['S_8']">
												</div>
											  </div>
										</div>
										
										<!-- <div class="row">
											  <div class="col-sm-6">
												<div class="form-group">
													<label class="col-form-label" for="s9"><b>Validity Days</b> <span class="text-danger">*</span> </label>
													<input type="number" class="form-control" id="s9" ng-model="subscription['S_9']">
												</div>
											  </div>
										</div> -->
										
										<div class="row">
										    <div class="col-sm-12">
										      <div class="form-group">
													<label class="col-form-label" for="s10"><b>Detail</b> <span class="text-danger">*</span> </label>
													<textarea class="form-control" id="s10" rows="8" ng-model="subscription['S_10']" placeholder="Enter Detail..."></textarea>
												</div>
										    </div>
										</div>
										
										<div class="save-admin-center mt-3">
										   <button type="button" class="btn btn-rounded btn-success" ng-click="saveSubscription();">Save</button>
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
    
    <script src="{{ url('/assets-admin') }}/customjs/script_adminsubscription.js?v={{time()}}"></script>