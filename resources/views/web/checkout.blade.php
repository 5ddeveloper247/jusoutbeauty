@include('web.web-header')
<style>
.height-40{
	height:40px;
}
.mt-50 {
    margin-top: 0.16rem!important;
    margin-left: 5px;
}
</style>
{{-- <script>
	$(window).on("load", function(){
		$('[data-toggle="tooltip"]').tooltip().mouseover();
		setTimeout(function(){ $('[data-toggle="tooltip"]').tooltip('hide'); }, 3000);
	});
</script> --}}
<main id="content" ng-app="project1">
	<div class="mt-15" ng-controller="projectinfo1" id="details-header">
		<section class=" py-2 bg-gray-2">
			<div class="container">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb breadcrumb-site py-0 d-flex justify-content-center">
						<li class="breadcrumb-item"><a class="text-decoration-none text-body" href="index.html">Home</a></li>
						<li class="breadcrumb-item active pl-0 d-flex align-items-center" aria-current="page">Check Out</li>
					</ol>
				</nav>
			</div>
		</section>
		<section class="pb-lg-13 pb-11">
			<div class="container">
				<h2 class="text-center my-9">Check Out</h2>
<!-- 				<form> -->
					<div class="row">
						<div class="col-lg-4 pb-lg-0 pb-11 order-lg-last">
							<div class="card " style="box-shadow: 0 0 10px 0 rgba(0, 0, 0, 0.1)">
								<div class="card-header px-0 mx-6 bg-transparent py-5">
									<h2 class="mb-5">Order Summary</h2>
									<div class="media w-100 mb-4" ng-repeat="row in displayCollectionCart">
										<div class="w-60px mr-3" >
											<img src="@{{row.primaryImage}}" alt="Natural Coconut Cleansing Oi" style="height:4.5rem">
										</div>
										<div class="media-body d-flex">
											<div class="cart-price pr-6">
												<a href="#" class="text-primary">@{{row.productName}}<span class="text-primary"> x@{{row.QUANTITY}}</span></a>
												<p class="fs-14 text-primary mb-0 mt-1"> Size:<span class="text-primary"> @{{row.productUnit}}</span> </p>
											</div>
											<div class="ml-auto">
												<p class="fs-14 d-flex text-primary mb-0 font-weight-500 cursor-pointer">$@{{row.lineTotalAmount}}<i class="fa fa-info-circle mt-50" ng-click="viewProductShadesCheckout(@{{row.CART_LINE_ID}});" data-toggle="tooltip" title="View Product Shades" data-placement="top"></i></p>

											</div>
										</div>

									</div>
								</div>

								<div class="card-body px-6 pt-5">
									<div class="d-flex align-items-center mb-2">
										<span>Subtotal:</span>
										<span class="d-block ml-auto font-weight-500 text-primary">$@{{subTotal}}</span>
									</div>
									<div class="d-flex align-items-center mb-2">
										<span>Tax Amount:</span>
										<span class="d-block ml-auto font-weight-500 text-primary">$@{{totalTax}}</span>
									</div>
									<div class="d-flex align-items-center mb-2">
										<span>Total Inc. Tax:</span>
										<span class="d-block ml-auto font-weight-500 text-primary">$@{{totalIncVat}}</span>
									</div>
									<div class="d-flex align-items-center">
										<span>Discount:</span>
										<span class="d-block ml-auto text-primary font-weight-500">$@{{totalDiscount}}</span>
									</div>
								</div>
								<div class="card-footer bg-transparent px-0 pb-1 mx-6">
									<div class="d-flex align-items-center mb-3">
										<span>Total price:</span>
										<span class="d-block ml-auto fs-24 font-weight-500 text-primary">$@{{grandTotal}}</span>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-8 pr-xl-15 order-lg-first form-control-01">

							<div class=""  ng-show="formstep == '1'">
								<!-- <p class="mb-2"> Returning customer? <a href="javascript:;">Click here to login</a> </p> -->
								{{-- <p> Have a coupon?
									<a data-toggle="collapse" href="#collapsecoupon" role="button" aria-expanded="false" aria-controls="collapsecoupon">Click here to enter your code </a>
								</p>
								<div class="card collapse mw-460 " id="collapsecoupon">
									<div class="card-body pt-6 px-5 pb-7 my-6 border">
										<p class="card-text mb-5">If you have a coupon code, please apply it below.</p>
										<div class="input-group">
											<input type="email" name="coupon_code" class="form-control" placeholder="Your Email*">
											<div class="input-group-append">
												<button class="btn btn-primary px-3 " type="submit" name="apply_coupon" value="Apply coupon">Apply Coupon</button>
											</div>
										</div>
									</div>
								</div> --}}
								<h2 class="pt-1 mb-4">Shipping Infomation</h2>
								<div class="mb-3">
									<label class="mb-2 fs-13 letter-spacing-01 font-weight-600 text-uppercase">name</label>
									<div class="row">
										<div class="col-md-6 mb-md-0 mb-4">
											<input type="text" class="form-control" id="s1" ng-model="shipping['S_1']" placeholder="First Name" >
										</div>
										<div class="col-md-6">
											<input type="text" class="form-control" id="s2" ng-model="shipping['S_2']" placeholder="Last Name" >
										</div>
									</div>
								</div>
								<div class="mb-3">
									<div class="row">
										<div class="col-md-8 mb-md-0 mb-4">
											<label for="street-address" class="mb-2 fs-13 letter-spacing-01 font-weight-600 text-uppercase">Street Address</label>
											<input type="text" class="form-control" id="s3" ng-model="shipping['S_3']">
										</div>
										<div class="col-md-4">
											<label for="apt" class="mb-2 fs-13 letter-spacing-01 font-weight-600 text-uppercase">APT/Suite</label>
											<input type="text" class="form-control" id="s4" ng-model="shipping['S_4']" >
										</div>
									</div>
								</div>
								<div class="mb-3">
									<div class="row">
										<div class="col-md-4 mb-md-0 mb-4">
											<label for="city" class="mb-2 fs-13 letter-spacing-01 font-weight-600 text-uppercase">City</label>
											<input type="text" class="form-control" id="s5" ng-model="shipping['S_5']" >
										</div>
										<div class="col-md-4 mb-md-0 mb-4">
											<label for="state" class="mb-2 fs-13 letter-spacing-01 font-weight-600 text-uppercase">State</label>
											<input type="text" class="form-control" id="s6" ng-model="shipping['S_6']" >
										</div>
										<div class="col-md-4">
											<label for="zip-code" class="mb-2 fs-13 letter-spacing-01 font-weight-600 text-uppercase">zip code</label>
											<input type="text" class="form-control" id="s7" ng-model="shipping['S_7']">
										</div>
									</div>
								</div>
								<div class="mb-3">
									<div class="row">
										<div class="col-md-12 mb-md-0 mb-4">
											<label class="mb-2 fs-13 letter-spacing-01 font-weight-600 text-uppercase">Country</label>
											<select class="form-control" id="s8" ng-model="shipping['S_8']"
													ng-options="item as item.name for item in countryLov track by item.id">
					                        	<option value="">Choose Country</option>
					                        </select>
										</div>
									</div>
								</div>

								<div class="mb-3">
									<label class="mb-2 fs-13 letter-spacing-01 font-weight-600 text-uppercase">info</label>
									<div class="row">
										<div class="col-md-6 mb-md-0 mb-4">
											<input type="email" class="form-control" id="s9" ng-model="shipping['S_9']" placeholder="Email">
										</div>
										<div class="col-md-6">
											<input type="number" class="form-control" id="s10" ng-model="shipping['S_10']" placeholder="Phone number">
										</div>
									</div>
								</div>
								<div class="custom-control custom-checkbox mt-6 mb-5">
									<input type="checkbox" class="custom-control-input" id="s11" ng-model="shipping['S_11']" checked>
									<label class="custom-control-label custom-control-label-secondary text-body" for="s11">
										<span class="text-body">Billing address is the same as shipping</span>
									</label>
								</div>

								<button type="button" class="btn btn-primary px-7 mt-6" ng-click="saveShippingInformation();">Proceed</button>

							</div>

							<div ng-show="formstep == '2'">
								<div class="mb-3 mb-5">
									<h6 class=""><i class="fa fa-arrow-left p-1"></i>&nbsp;Back</h6>
									<h2 class="mb-5 payment">Payment Infomation</h2>
									<!-- <a class="btn bg-gray-2 btn-payment payment-paylay px-8 py-3 mr-4" href="javascript:;" data-var="paypal" ng-click="paymentoption('1');">
										<svg class="icon icon-paylay fs-32 text-body hover-primary"> <use xlink:href="#icon-paylay"></use> </svg>
										<span class="ml-2 text-body font-weight-600 fs-16">Paypal</span>
									</a>
									<a class="btn bg-gray-2 btn-payment payment-card px-7 py-3 active my-sm-0 my-3" href="javascript:;" data-var="credit-card" ng-click="paymentoption('2');">
										<svg class="icon icon-card fs-32 text-body hover-primary"> <use xlink:href="#icon-card"></use> </svg>
										<span class="ml-2 text-body font-weight-600 fs-16">Credit card</span>
									</a> -->
								</div>

								<input type="hidden" name="id" id="accesskey" value="{{$pakmskey}}">

								<div class="container" >
								    <form action="makePayment" method="post" id="payment-form">
								        @csrf
								        <input type="hidden" name="userId" value="{{session('userId')}}">
								        <input type="hidden" name="cartId" value="@{{cartId}}">
								        <input type="hidden" name="paymentType" value="checkout">

								        <input type="hidden" name="S_1" value="@{{shipping.S_1}}">
								        <input type="hidden" name="S_2" value="@{{shipping.S_2}}">
								        <input type="hidden" name="S_3" value="@{{shipping.S_3}}">
								        <input type="hidden" name="S_4" value="@{{shipping.S_4}}">
								        <input type="hidden" name="S_5" value="@{{shipping.S_5}}">
								        <input type="hidden" name="S_6" value="@{{shipping.S_6}}">
								        <input type="hidden" name="S_7" value="@{{shipping.S_7}}">
								        <input type="hidden" name="S_8" value="@{{shipping.S_8.id}}">
								        <input type="hidden" name="S_9" value="@{{shipping.S_9}}">
								        <input type="hidden" name="S_10" value="@{{shipping.S_10}}">
								        <input type="hidden" name="S_11" value="@{{shipping.S_11}}">


								        <div class="form-row top-row">
								            <div id="amount" class="field card-number">
								                <input type="hidden" name="amount" value="@{{cloverPaymentgrandTotal1}}" placeholder="Amount">
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





							<!-- <div class="card-box payment-box">
								<div class="mb-3">
									<label class="mb-2 fs-13 letter-spacing-01 font-weight-600 text-uppercase">CREDIT CARD NUMBER</label>
									<div class="row align-items-center">
										<div class="col-md-6 mb-md-0 mb-4">
											<input type="text" class="form-control creditCardText" id="p1" ng-model="payment['P_1']" placeholder="**** **** **** ****" />
										</div>
										<div class="col-md-6">
											<img src="{{ url('/assets-web') }}/images/Paypal.jpg" alt="Paypal">
										</div>
									</div>
								</div>
								<div class="mb-3 mb-0">
									<div class="row">
										<div class="col-md-4 mb-md-0 mb-4">
											<label class="mb-2 fs-13 letter-spacing-01 font-weight-600 text-uppercase">EXPIRATION DATE</label>
											<select name="inputMonth" id="p2" class="form-control px-3" ng-model="payment['P_2']">
												<option value="">Choose Month</option>
												<option value="1">January</option>
												<option value="2">February</option>
												<option value="3">March</option>
												<option value="4">April</option>
												<option value="5">May</option>
												<option value="6">June</option>
												<option value="7">July</option>
												<option value="8">August</option>
												<option value="9">September</option>
												<option value="10">October</option>
												<option value="11">November</option>
												<option value="12">December</option>
											</select>
										</div>
										<div class="col-md-4 mb-md-0 mb-4">
											<label class="mb-2 fs-13 letter-spacing-01 font-weight-600 text-uppercase opacity-0 d-md-block d-none">Year</label>
											<select name="inputYaer" id="p3" class="form-control px-3" ng-model="payment['P_3']">
												<option value="">Choose Year</option>
												<?php
												//$year = date('Y');
												//for($i=0; $i<6; $i++){?>
													<option value="<?php //echo $year;?>"><?php //echo $year;?></option>
												<?php //$year ++;}?>
											</select>
										</div>
										<div class="col-md-4">
											<label class="mb-2 fs-13 letter-spacing-01 font-weight-600 text-uppercase">SECURITY CODE</label>
											<input type="text" class="form-control" id="p4" ng-model="payment['P_4']">
										</div>
									</div>
								</div>
							</div> -->

<!-- 							<button type="button" class="btn btn-primary px-7 mt-6" ng-click="postOrderCheckout();">Place Order</button> -->
						</div>
					</div>
<!-- 				</form> -->
			</div>




		</section>
		<div class="modal fade" id="show_shade_modal_checkout">
			<div class="modal-dialog" role="document">
				<div class="modal-content">

					<div class="modal-body">
						<div class="table-responsive">
							<table class="table table-striped">
								<thead>
									<tr>
										<th class="center">Product Name</th>
										<th class="center">Shade Name</th>
									</tr>
								</thead>
								<tbody >
									<tr ng-repeat="row in displayCollectionCheckoutShadeName">
										<td class="center">@{{row.PRODUCT_NAME}}</td>
										<td class="center">@{{row.SHADE_NAME}}</td>
									</tr>
									<tr ng-show="displayCollectionCheckoutShadeName.length <= 0 || displayCollectionCheckoutShadeName.length == undefined">
										<td class="mt-1">No Shade Found...</td>
										<td class="mt-1"></td>
									</tr>
								</tbody>

							</table>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-danger light"
							data-dismiss="modal">Close</button>

					</div>
				</div>
			</div>
		</div>
	</div>

</main>

@include('web.web-footer')

<script src="{{ url('/assets-web') }}/customjs/script_usercheckout.js?v={{time()}}"></script>

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
    	$.LoadingOverlay("show");
        // Insert the token ID into the form so it gets submitted to the server
        var form = document.getElementById('payment-form');
        var hiddenInput = document.createElement('input');
        hiddenInput.setAttribute('type', 'hidden');
        hiddenInput.setAttribute('name', 'cloverToken');
        hiddenInput.setAttribute('value', token);
        form.appendChild(hiddenInput);

        form.submit();
    }



</script>
<script>
	function close_topbar(){
	$("#topbar").removeClass('d-xl-flex');
	$("#details-header").removeClass('mt-15');
	$("#details-header").addClass('mt-10');
}
</script>
