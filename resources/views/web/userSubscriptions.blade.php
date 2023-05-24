@include('web.web-header-userprofile')
<script>
var site = '<?php echo session('site');?>';
var baseurl = "<?php echo url('/assets-admin');?>";
</script>
<style>
.height-40{
	height:40px;
}
</style>
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
                                    <div class="col-lg-8 col-sm-7">
                                    	<div ng-show="paymentStatus == 'PENDING' && subsStatus == 'ACTIVE'">
                                    		<div class="mb-3 mb-5">
												<h4 class="fs-24 mb-5 payment">Payment Infomation</h4>
											</div>
											
											<input type="hidden" name="id" id="accesskey" value="{{$pakmskey}}">
											
											<div class="container" >
											    <form action="makePayment" method="post" id="payment-form">
											        @csrf
											        <input type="hidden" name="userId" value="{{session('userId')}}">
											        <input type="hidden" name="subsId" value="@{{subsId}}">
											        <input type="hidden" name="paymentType" value="subscription">
											        
											        <div class="form-row top-row">
											            <div id="amount" class="field card-number">
											                <input type="hidden" name="amount" value="@{{cloverGrandTotal}}" placeholder="Amount">
											            </div>
											        </div>
													
													<div class="row">
														<label class="ml-2 fs-13 letter-spacing-01 font-weight-600 text-uppercase">CREDIT CARD NUMBER</label>
													</div>
													<div class="row">
														<div class="col-sm-6 form-row top-row card-number border border-bottom border-dark pt-2 pl-2 rounded mb-2 ml-2" style="height: 40px;">
												            <div id="card-number" class="field height-40"></div>
												            <div class="input-errors" id="card-number-errors" role="alert"></div>
												        </div>
													</div>
											        
													
													<div class="row">
													    <div class="col-sm-4" style="height: 40px;" >
												            <label class="fs-13 letter-spacing-01 font-weight-600 text-uppercase">MONTH/YEAR</label>
												        </div>
												        <div class="col-sm-4" style="height: 40px;">
												            <label class="fs-13 letter-spacing-01 font-weight-600 text-uppercase">CVV</label>
												        </div>
												        <div class="col-sm-3 ml-2" style="height: 40px;">
												            <label class="fs-13 letter-spacing-01 font-weight-600 text-uppercase">ZIP</label>
												        </div>
											        </div>
											        
													<div class="row">
													    <div class="col-sm-4 form-row border border-bottom border-dark pt-2 pl-2 rounded mb-2 ml-2" style="height: 40px;" >
												            <div id="card-date" class="field third-width height-40"></div>
												            <div class="input-errors" id="card-date-errors" role="alert"></div>
												        </div>
												        <div class="col-sm-4 form-row border border-bottom border-dark pt-2 pl-2 rounded mb-2 ml-2" style="height: 40px;">
												            <div id="card-cvv" class="field third-width height-40"></div>
												            <div class="input-errors" id="card-cvv-errors" role="alert"></div>
												        </div>
												        <div class="col-sm-3 form-row border border-bottom border-dark pt-2 pl-2 rounded mb-2 ml-2" style="height: 40px;">
												            <div id="card-postal-code" class="field third-width height-40"></div>
												            <div class="input-errors" id="card-postal-code-errors" role="alert"></div>
												        </div>
											        </div>
											
											        <div id="card-response" role="alert"></div>
											
											        <div class="button-container mr-4 mt-3 " style="z-index:99;">
											            <button class="btn btn-secondary h6">Pay Now</button>
											        </div>
											
											    </form>
											</div>
                                    	</div>
									</div>
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
    
    <script src="{{ url('/assets-web') }}/customjs/script_usersubscriptions.js?v={{time()}}"></script>
    
    
	<script src="https://checkout.sandbox.dev.clover.com/sdk.js"></script>

	<script>
	
	    const accesskey = document.getElementById('accesskey').value;
	
	    const clover = new Clover(accesskey);
	    const elements = clover.elements();
	
	    let styles = "";
	    const form = document.getElementById('payment-form');
	    const cardNumber = elements.create('CARD_NUMBER', styles);
	    const cardDate = elements.create('CARD_DATE', styles);
	    const cardCvv = elements.create('CARD_CVV', styles);
	    const cardPostalCode = elements.create('CARD_POSTAL_CODE', styles);
	
	    cardNumber.mount('#card-number');
	    cardDate.mount('#card-date');
	    cardCvv.mount('#card-cvv');
	    cardPostalCode.mount('#card-postal-code');
	
	    const cardResponse = document.getElementById('card-response');
	    const displayCardNumberError = document.getElementById('card-number-errors');
	    const displayCardDateError = document.getElementById('card-date-errors');
	    const displayCardCvvError = document.getElementById('card-cvv-errors');
	    const displayCardPostalCodeError = document.getElementById('card-postal-code-errors');
	
	    // Handle real-time validation errors from the card element
	    cardNumber.addEventListener('change', function(event) {
	        console.log(`cardNumber changed ${JSON.stringify(event)}`);
	    });
	
	    cardNumber.addEventListener('blur', function(event) {
	        console.log(`cardNumber blur ${JSON.stringify(event)}`);
	    });
	
	    cardDate.addEventListener('change', function(event) {
	        console.log(`cardDate changed ${JSON.stringify(event)}`);
	    });
	
	    cardDate.addEventListener('blur', function(event) {
	        console.log(`cardDate blur ${JSON.stringify(event)}`);
	    });
	
	    cardCvv.addEventListener('change', function(event) {
	        console.log(`cardCvv changed ${JSON.stringify(event)}`);
	    });
	
	    cardCvv.addEventListener('blur', function(event) {
	        console.log(`cardCvv blur ${JSON.stringify(event)}`);
	    });
	
	    cardPostalCode.addEventListener('change', function(event) {
	        console.log(`cardPostalCode changed ${JSON.stringify(event)}`);
	    });
	
	    cardPostalCode.addEventListener('blur', function(event) {
	        console.log(`cardPostalCode blur ${JSON.stringify(event)}`);
	    });
	
	
	    window.onload=function(){
	    	form.addEventListener('submit', function(event) {
	            event.preventDefault();
	            // Use the iframe's tokenization method with the user-entered card details
	            clover.createToken()
	                .then(function(result) {
	                    if (result.errors) {
	                        Object.values(result.errors).forEach(function (value) {
	                            //displayError.textContent = value;
	                            toastr.error(value, '', {timeOut: 3000});
	//                          alert(value);
	                        });
	                    } else {
	
	                        cloverTokenHandler(result.token);
	                    }
	                });
	        });
	    	}
		
	    // Listen for form submission
	    
	
	
	    function cloverTokenHandler(token) {
	        // Insert the token ID into the form so it gets submitted to the server
	        var form = document.getElementById('payment-form');
	        var hiddenInput = document.createElement('input');
	        hiddenInput.setAttribute('type', 'hidden');
	        hiddenInput.setAttribute('name', 'cloverToken');
	        hiddenInput.setAttribute('value', token);
	        form.appendChild(hiddenInput);
	        console.log(hiddenInput);
	        form.submit();
	    }
	
	
	
	</script>