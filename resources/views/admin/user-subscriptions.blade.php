@include('admin.admin-header');
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
            <div class="container-fluid" ng-show="editView == '0'">
                <div class="page-titles">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="javascript:void(0)">Subscriptions</a></li>
						<li class="breadcrumb-item active"><a href="javascript:void(0)">View All</a></li>
					</ol>
                </div>
                <!-- row -->

                <div class="row">
					<div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Subscriptions</h4>
                            </div>
                            <div class="card-body">
                            	
                                <div class="table-responsive">
                                    <table id="subscriptionListing_table" class="display min-w850">
                                        <thead>
                                            <tr>
                                                <th>Code</th>
                                                <th>Subscription Name</th>
                                                <th>Username</th>
                                                <th>Product Name</th>
                                                <th>Quantity</th>
                                                <th>Total Amount</th>
												<th>Date</th>
												<th>Next Payment Date</th>
                                                <th>Payment</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr ng-repeat="row in displayCollectionSubsc">
                                               
                                                <td>@{{row.subscriptionNum}}</td>
                                                <td>@{{row.subsName}}</td>
                                                <td>@{{row.userFirstName}} @{{row.userLastName}}</td>
                                                <td>@{{row.productName}}</td>
                                                <td>@{{row.QUANTITY}}</td>
                                                <td>$@{{row.TOTAL_AMOUNT}}</td>
                                                <td>@{{row.SUBSCRIPTION_DATE}}</td>
                                                <td>@{{row.NEXT_PAYMENT_DATE}}</td>
                                                <td>@{{row.PAYMENT_STATUS}}</td>
												<td>
													<span class="badge light badge-danger" ng-if="row.SUBSCRIPTION_STATUS != 'ACTIVE'">
														<i class="fa fa-circle text-danger mr-1"></i>
														@{{row.SUBSCRIPTION_STATUS}}
													</span>
													<span class="badge light badge-success" ng-if="row.SUBSCRIPTION_STATUS == 'ACTIVE'">
														<i class="fa fa-circle text-success mr-1"></i>
														@{{row.SUBSCRIPTION_STATUS}}
													</span>
												</td>
                                                
                                                <td>
													<div class="dropdown ml-auto text-right">
														<div class="btn-link" data-toggle="dropdown">
															<svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg>
														</div>
														<div class="dropdown-menu dropdown-menu-right">
															<a class="dropdown-item" href="javascript:;" ng-click="viewSubscriptionDetail(@{{row.USER_SUBSCRIPTION_ID}})">Detail</a>
														</div>
													</div>											
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
                <div class="page-titles">
					<ol class="breadcrumb">
						<li class="breadcrumb-item" ng-click="backToListing();"><i class="fa fa-arrow-left p-1"></i> &nbsp;<a href="javascript:void(0)">Subscriptions</a></li>
						<li class="breadcrumb-item active"><a href="javascript:void(0)">Detail</a></li>
					</ol>
                </div>
                <div class="row">
                    <div class="col-lg-12">

                        <div class="card">
                            <div class="card-header row">  
                            	<div class="col-6">Subscription Details</div>
                                <div class="col-6">
                                    <button type="button" class="btn btn-rounded btn-warning admin-view-add mb-3 float-right" ng-click="updateSubcriptionStatusmy()" ng-if="subsStatus == 'ACTIVE'">Cancel Subcription</button>
                                </div>
                            	<!-- <div class="col-6">
                            		<a type="button" class="btn btn-rounded btn-warning admin-view-add" ng-click="shipmentStatusUpdate(1);" ng-if="shipment.ID != '' && shipment.S_2 == 'Pending'">picked up</a>
                                    <a type="button" class="btn btn-rounded btn-warning admin-view-add" ng-click="shipmentStatusUpdate(2);" ng-if="shipment.ID != '' && shipment.S_2 == 'Picked Up'">In-Transit</a>
                                    <a type="button" class="btn btn-rounded btn-warning admin-view-add" ng-click="shipmentStatusUpdate(3);" ng-if="shipment.ID != '' && shipment.S_2 == 'In-Transit'">Delivered up</a>
                            	</div> -->
                            </div>
                            <div class="card-body">
                                
                                
                                <div class="row mb-5">
                                    <div class="mt-4 col-xl-6 col-lg-6 col-md-6 col-sm-12"> </div>
                                    <div class="mt-4 col-xl-6 col-lg-6 col-md-12 col-sm-12 d-flex justify-content-lg-end justify-content-md-center justify-content-xs-start">
										<div class="align-items-center">
											<table>
												<tbody>
													<tr>
														<td class="text-main text-bold">Subscription #</td>
														<td class="text-right"> @{{subsNumber}}</td>
													</tr>
													<tr>
														<td class="text-main text-bold">Name</td>
														<td class="text-right"> @{{subsName}}</td>
													</tr>
													<tr>
														<td class="text-main text-bold">Username</td>
														<td class="text-right"> @{{subsUsername}}</td>
													</tr>
													<tr>
														<td class="text-main text-bold">Status</td>
														<td class="text-right">@{{subsStatus}}</td>
													</tr>
													<tr>
														<td class="text-main text-bold">Payment Status</td>
														<td class="text-right">@{{paymentStatus}}</td>
													</tr>
													<tr>
														<td class="text-main text-bold">Subscription date</td>
														<td class="text-right">@{{subsDate}}</td>
													</tr>
													<tr>
														<td class="text-main text-bold">Next Payment Date</td>
														<td class="text-right">@{{nextPayDate}}</td>
													</tr>
													
												</tbody>
											</table>
										</div>
									</div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th class="center">#</th>
                                                <th>Item</th>
                                                <th>Photo</th>
                                                <th>Description</th>
                                                <th class="right">Unit Cost</th>
                                                <th class="center">Qty</th>
                                                <th class="right">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="center">1</td>
                                                <td class="left strong">@{{productName}}</td>
                                                <td class=""><img class="round-product-img" src="@{{productPrimaryImage}}"></td>
                                                <td class="left">@{{productDesc}}</td>
                                                <td class="right">$@{{productUnitPrice}}</td>
                                                <td class="center">@{{productQuantity}}</td>
                                                <td class="right">$@{{productTotalAmount}}</td>
                                            </tr>
                                            
                                        </tbody>
                                    </table>
                                </div>
                                <div class="row">
                                    <div class="col-lg-8 col-sm-7"> </div>
                                    <div class="col-lg-4 col-sm-5 ml-auto">
                                        <table class="table table-clear">
                                            <tbody>
                                                <tr>
                                                    <td class="left"><strong>Subtotal</strong></td>
                                                    <td class="right">$@{{subsSubTotal}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="left"><strong>Tax Amount</strong></td>
                                                    <td class="right">$@{{subsTaxAmount}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="left"><strong>Total Inc. Tax:</strong></td>
                                                    <td class="right">$@{{subsTotalIncTax}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="left"><strong>Subscription Discount:</strong></td>
                                                    <td class="right">$@{{subsDiscount}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="left"><strong>Total</strong></td>
                                                    <td class="right"><strong>$@{{grandTotalAmount}}</strong></td>
                                                </tr>
                                            </tbody>
                                        </table>
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
    @include('admin.admin-footer');
    
    <script src="{{ url('/assets-admin') }}/customjs/script_adminusersubscriptions.js?v={{time()}}"></script>