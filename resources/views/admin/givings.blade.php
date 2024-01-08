@include('admin.admin-header')
<script>
var userId = '<?php echo session('userId');?>';
var site = '<?php echo session('site');?>';
var baseurl = "<?php echo url('/assets-admin');?>";
</script>
<style>
	table.dataTable thead .sorting {
    background-position: center right 0px;
}
</style>
	<div  ng-app="project1">
        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body" ng-controller="projectinfo1">
            <div class="container-fluid"  ng-show="editView == '0'">
                <div class="page-titles">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="javascript:void(0)">Givings</a></li>
					</ol>
                </div>
                <!-- row -->

                <div class="row" >
					<div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Givings</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="givingsTable" class="display min-w850">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
<!--                                                 <th>User ID</th> -->
                                                <th>User Name</th>
                                                <th>Email</th>
                                                <th>Amount</th>
												<th>Payment Date</th>
                                                <th>Payment Type</th>
                                                <th>Transaction ID</th>
                                                <th>Payment Status</th>
                                                {{-- <th>Action</th> --}}
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr ng-repeat="row in displayCollectionGivings">
                                                <td>@{{row.seqNo}}</td>
<!--                                                 <td>@{{row.USER_ID}}</td> -->
                                                <td>@{{row.USERNAME}}</td>
                                                <td>@{{row.USER_EMAIL}}</td>
                                                <td>$@{{row.AMOUNT}}</td>
                                                <td>@{{row.PAYMENT_DATE}}</td>
                                                <td>@{{row.PAYMENT_TYPE}}</td>
                                                <td>@{{row.TRANSACTION_ID}}</td>
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
                                                
                                                {{-- // <td>
												// 	<div class="dropdown ml-auto text-right">
												// 		<div class="btn-link" data-toggle="dropdown">
												// 			<svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg>
												// 		</div>
												// 		<div class="dropdown-menu dropdown-menu-right">
												// 			<a class="dropdown-item" href="javascript:;" ng-click="viewSpecificAdminGivingDetail(@{{row.GIVING_ID}});">View</a>
												// 		</div>
												// 	</div>
												// </td>												 --}}
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
						<li class="breadcrumb-item" ng-click="backToListing();"><i class="fa fa-arrow-left p-1"></i> &nbsp;<a href="javascript:void(0)">Givings</a></li>
						<li class="breadcrumb-item active"><a href="javascript:void(0)">Detail</a></li>
					</ol>
                </div>
                <!-- row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Giving Information</h4>
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
													<label class="col-form-label" for="order_number"><b>Email</b></label> 
                                                    <p>@{{userEmail}}</p>
												</div>
											</div>
										</div>
										
										<div class="row">
											<div class="col-sm-6">
												<div class="form-group">
													<label class="col-form-label" for="amount"><b>Phone #</b></label>
													<p>@{{userPhone}}</p>
												</div>
											</div>
											<div class="col-sm-6">
												<div class="form-group">
													<label class="col-form-label" for="amount"><b>Amount</b></label>
													<p>$@{{amount}}</p>
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
													<label class="col-form-label" for="status"><b>Payment Type</b></label>
													<p>@{{paymentType}}</p>
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
													<label class="col-form-label" for=""><b>Payment Status</b></label>
													<p>@{{paymentStatus}}</p>
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
    
    <script src="{{ url('/assets-admin') }}/customjs/script_admingivings.js?v={{time()}}"></script>