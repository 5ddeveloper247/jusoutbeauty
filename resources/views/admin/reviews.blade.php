@include('admin.admin-header');
<script>
var userId = <?php echo session('userId');?>;
var site = '<?php echo session('site');?>';
</script>

	<div ng-app="project1">
        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body" ng-controller="projectinfo1">
            <div class="container-fluid pt-0" ng-show="editView == '0'">
                <div class="page-titles mb-0">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="javascript:void(0)">Reviews</a></li>
					</ol>
                </div>
                <!-- row -->

                <div class="row">
					<div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Reviews</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="reviewsTable" class="display min-w850">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Title</th>
                                                <th>Review By</th>
                                                <th>Email Reviewer</th>
                                                <th>Date</th>
                                                <th>Status</th>
                                                <th>On Site</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr ng-repeat="row in displayCollectionReviews">
                                                <td>@{{row.seqNo}}</td>
                                                <td>@{{row.TITLE}}</td>
                                                <td>@{{row.USERNAME}}</td>
                                                <td>@{{row.EMAIL}}</td>
                                                <td>@{{row.DATE}}</td>
												<td>
													<span class="badge light badge-danger" ng-if="row.STATUS == '0'">
														<i class="fa fa-circle text-danger mr-1"></i> Hide
													</span>
													<span class="badge light badge-success" ng-if="row.STATUS == '1'">
														<i class="fa fa-circle text-success mr-1"></i> Show
													</span>
												</td>
												<td>
													<span class="badge light badge-danger" ng-if="row.ON_SITE_ENABLE == '0'">
														<i class="fa fa-circle text-danger mr-1"></i> Disable
													</span>
													<span class="badge light badge-success" ng-if="row.ON_SITE_ENABLE == '1'">
														<i class="fa fa-circle text-success mr-1"></i> Enable
													</span>
												</td>
                                                
                                                <td>
													<div class="dropdown ml-auto text-right">
														<div class="btn-link" data-toggle="dropdown">
															<svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg>
														</div>
														<div class="dropdown-menu dropdown-menu-right">
														
															<a class="dropdown-item" href="javascript:;" ng-click="updateReviewOnSiteStatus(row.REVIEW_ID);" ng-show="row.STATUS == '1' && row.ON_SITE_ENABLE == '0'">On Site Enable</a>
															<a class="dropdown-item" href="javascript:;" ng-click="updateReviewOnSiteStatus(row.REVIEW_ID);" ng-show="row.STATUS == '1' && row.ON_SITE_ENABLE == '1'">On Site Disable</a>
															
															<a class="dropdown-item" href="javascript:;" ng-click="updateReviewStatus(row.REVIEW_ID);" ng-show="row.STATUS == '1'">Hide</a>
															<a class="dropdown-item" href="javascript:;" ng-click="updateReviewStatus(row.REVIEW_ID);" ng-show="row.STATUS == '0'">Show</a>
															
															
															
															<a class="dropdown-item" href="javascript:;" ng-click="viewReviewDetails(row.REVIEW_ID);">View</a><!-- /view-review -->
															<a class="dropdown-item" href="javascript:;" ng-click="deleteReviewDetails(row.REVIEW_ID);">Delete</a>
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
            
            <div class="container-fluid pt-0" ng-show="editView == '1'">
                <div class="page-titles mb-0">
					<ol class="breadcrumb">
						<li class="breadcrumb-item" ng-click="backToListing();"><i class="fa fa-arrow-left p-1"></i> &nbsp;<a href="javascript:void(0)">Reviews</a></li>
						<li class="breadcrumb-item"><a href="javascript:void(0)">Details</a></li>
					</ol>
                </div>
                <!-- row -->

                <div class="row">
					<div class="col-12">
<!--                         <form class="form-valide" action="#" method="post"> -->
							<div class="row">
								<div class="col-sm-4">
									<div class="form-group">
										<label class="col-form-label"><b>Username</b></label> 
										<p>@{{username}}</p>
									</div>
								</div>
								<div class="col-sm-4">
									<div class="form-group">
										<label class="col-form-label"><b>Email</b></label> 
										<p>@{{email}}</p>
									</div>
								</div>
								<div class="col-sm-4">
									<div class="form-group">
										<label class="col-form-label"><b>Title</b></label> 
										<p>@{{title}}</p>
									</div>
								</div>
								<div class="col-sm-4">
									<div class="form-group">
										<label class="col-form-label"><b>Start Rating</b></label> 
										<p>@{{starRating}}</p>
									</div>
								</div>
								<div class="col-sm-4">
									<div class="form-group">
										<label class="col-form-label"><b>Skin Concerns</b></label> 
										<p>@{{skinConcerns}}</p>
									</div>
								</div>
								<div class="col-sm-4">
									<div class="form-group">
										<label class="col-form-label"><b>Climate</b></label> 
										<p>@{{climate}}</p>
									</div>
								</div>
								<div class="col-sm-4">
									<div class="form-group">
										<label class="col-form-label"><b>Age Range</b></label> 
										<p>@{{ageRange}}</p>
									</div>
								</div>
								<div class="col-sm-4">
									<div class="form-group">
										<label class="col-form-label"><b>Recommanded JusOut Beauty</b></label> 
										<p>@{{recommandMurad}}</p>
									</div>
								</div>
								<div class="col-sm-4">
									<div class="form-group">
										<label class="col-form-label"><b>Skini Type</b></label> 
										<p>@{{skinType1}}</p>
									</div>
								</div>
								<div class="col-sm-4">
									<div class="form-group">
										<label class="col-form-label"><b>Post Date</b></label> 
										<p>@{{date}}</p>
									</div>
								</div>
								<div class="col-sm-4">
									<div class="form-group">
										<label class="col-form-label"><b>Status</b></label> 
										<p>@{{status}}</p>
									</div>
								</div>
								
							</div>
							<div class="row">
								<div class="col-sm-12">
									<div class="form-group">
										<label class="col-form-label"><b>Description</b></label> 
										<p>@{{description}}</p>
									</div>
								</div>
							</div>

							


<!-- 						</form> -->
                    </div>
				</div>
            </div>
           
        </div>
		
        <!--**********************************
            Content body end
        ***********************************-->

    </div>
    @include('admin.admin-footer');
    
    <script src="{{ url('/assets-admin') }}/customjs/script_adminreviews.js?v={{time()}}"></script>