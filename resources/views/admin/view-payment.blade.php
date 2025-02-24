@include('admin.admin-header');
 <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <div class="container-fluid">
                <div class="page-titles">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="http://www.jusoutbeauty.com/app/admin/payments">Payment</a></li>
						<li class="breadcrumb-item active"><a href="javascript:void(0)">View</a></li>
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
													<label class="col-form-label" for="order_number"><b>Order Number</b></label> 
                                                    <p>order#1</p>
												</div>
											  </div>
											  <div class="col-sm-6">
												<div class="form-group">
													<label class="col-form-label" for="payment_date"><b>Payment Date</b></label>
													<p>19 Oct 2022</p>
												</div>
											  </div>
											
											
										</div>
										
										<div class="row">
											<div class="col-sm-6">
												<div class="form-group">

													<label class="col-form-label" for="amount"><b>Amount</b></label>
													<p>$20</p>

												</div>
											  </div>
											<div class="col-sm-6">
												<div class="form-group">
													<label class="col-form-label" for="transaction_id"><b>Transaction ID</b></label>
													<p>pay-1200-1291</p>
												</div>
											</div>
											
										</div>
										<div class="row">
											
											<div class="col-sm-6">
												<div class="form-group">
													<label class="col-form-label" for="customer_name"><b>Customer Name</b></label>
													<p>Tariq Pervaiz</p>
												</div>
											</div>
											<div class="col-sm-6">
												<div class="form-group">
													<label class="col-form-label" for="status"><b>Status</b></label>
													<p>Paid</p>
												</div>
											  </div>
										</div>
										<div class="row">
											
											<div class="col-sm-6">
												<div class="form-group">
													<label class="col-form-label" for=""><b>Payment Method</b></label>
													<p>Paypal</p>
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
    @include('admin.admin-footer');