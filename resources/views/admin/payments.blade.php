@include('admin.admin-header')
<script>
var userId = <?php echo session('userId');?>;
var site = '<?php echo session('site');?>';
var baseurl = "<?php echo url('/assets-admin');?>";
</script>

	<div  ng-app="project1">
        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body" ng-controller="projectinfo1">
            <div class="container-fluid"  ng-show="editView == '0'">
                <div class="page-titles mb-0">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="javascript:void(0)">Payments</a></li>
					</ol>
                </div>
                <!-- row -->

                <div class="row" >
					<div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Payments</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="paymentsTable" class="display min-w850">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Order Code</th>
                                                <th>Customer</th>
                                                <th>Amount</th>
                                                <th>Payment Date</th>
                                                <th>Transaction ID</th>
                                                <th>Payment Method</th>
                                                <th>Payment Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr ng-repeat="row in displayCollectionPayments">
                                                <td>@{{row.seqNo}}</td>
                                                <td>@{{row.ORDER_NUMBER}}</td>
                                                <td>@{{row.USERNAME}}</td>
                                                <td>$@{{row.totalOrderAmount}}</td>
                                                <td>@{{row.PAYMENT_DATE}}</td>
                                                <td>@{{row.TRANSACTION_ID}}</td>
                                                <td>@{{row.PAYMENT_TYPE}}</td>
												<td>
													<span class="badge light badge-danger" ng-if="row.PAYMENT_STATUS != 'PAID'">
														<i class="fa fa-circle text-danger mr-1"></i>
														@{{row.PAYMENT_STATUS}}
													</span>
													<span class="badge light badge-success" ng-if="row.PAYMENT_STATUS == 'PAID'">
														<i class="fa fa-circle text-success mr-1"></i>
														@{{row.PAYMENT_STATUS}}
													</span>
												</td>
                                                
                                                <td>
													<div class="dropdown ml-auto text-right">
														<div class="btn-link" data-toggle="dropdown">
															<svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg>
														</div>
														<div class="dropdown-menu dropdown-menu-right">
															<a class="dropdown-item" href="javascript:;" ng-click="viewPaymentDetails(@{{row.PAYMENT_ID}});">View</a>
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
                <div class="page-titles">
					<ol class="breadcrumb">
						<li class="breadcrumb-item" ng-click="backToListing();"><i class="fa fa-arrow-left p-1"></i> &nbsp;<a href="javascript:void(0)">Payments</a></li>
						<li class="breadcrumb-item active"><a href="javascript:void(0)">Detail</a></li>
					</ol>
                </div>
                <!-- row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Payment Information</h4>
                            </div>
                            <div class="card-body">
                                <div class="form-validation">
									<form class="form-valide" action="#" method="post">
										<div class="row">
											<div class="col-sm-6">
												<div class="form-group">
													<label class="col-form-label" for="order_number"><b>Customer Name</b></label> 
                                                    <p>@{{customerName}}</p>
												</div>
											</div>
											<div class="col-sm-6">
												<div class="form-group">
													<label class="col-form-label" for="order_number"><b>Order Number</b></label> 
                                                    <p>@{{orderNumber}}</p>
												</div>
											</div>
											  
											
											
										</div>
										
										<div class="row">
											<div class="col-sm-6">
												<div class="form-group">
													<label class="col-form-label" for="amount"><b>Amount (Inc. Tax)</b></label>
													<p>$@{{totalAmount}}</p>
												</div>
											</div>
											<div class="col-sm-6">
												<div class="form-group">
													<label class="col-form-label" for="amount"><b>Tax Amount</b></label>
													<p>$@{{taxAmount}}</p>
												</div>
											  </div>
											
										</div>
										<div class="row">
											
											<div class="col-sm-6">
												<div class="form-group">
													<label class="col-form-label" for="payment_date"><b>Payment Date</b></label>
													<p>@{{paymentDate}}</p>
												</div>
											</div>
											<div class="col-sm-6">
												<div class="form-group">
													<label class="col-form-label" for="status"><b>Status</b></label>
													<p>@{{paymentStatus}}</p>
												</div>
											  </div>
										</div>
										<div class="row">
											<div class="col-sm-6">
												<div class="form-group">
													<label class="col-form-label" for="transaction_id"><b>Transaction ID</b></label>
													<p>@{{transactionId}}</p>
												</div>
											</div>
											<div class="col-sm-6">
												<div class="form-group">
													<label class="col-form-label" for=""><b>Payment Method</b></label>
													<p>@{{paymentMethod}}</p>
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
					<div class="modal-content">
						
						<div class="modal-body">
                           <h4 style="text-align: center;">Are Your sure to delete this ?</h4>
                        </div>
						<div class="modal-footer">
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
    
    <script src="{{ url('/assets-admin') }}/customjs/script_adminpayments.js?v={{time()}}"></script>