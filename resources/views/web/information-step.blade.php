@include('web.web-header')
<body>
	  <section class="">
	  	 <div class="row">
	  	 	<div class="col-lg-7 left_side_inf">
	 <div class="text-center mw-730 mx-auto" style="margin-top:80px;">
<br>
<p>Cart > Information > Shipping > Payment</p>
</div>
          <p class="text-center">Express checkout</p>
          <div class="btn_box_inf_step">
          	 <a href="store.html" class="btn btn-primary payp_btn_inf_step"><img src="images/paypal.svg" style="width: 20px;"> <img src="images/paypal2.svg" style="width: 60px;"> </a>
             <a href="store.html" class="btn btn-primary payp_btn_inf_step"><img src="images/paypal.svg" style="width: 20px;"> <img src="images/paypal2.svg" style="width: 60px;"> </a>
             <a href="store.html" class="btn btn-primary payp_btn_inf_step"><img src="images/paypal.svg" style="width: 20px;"> <img src="images/paypal2.svg" style="width: 60px;"> </a>
         </div>
          <div class="inc_form_pay_inf_step">
          <form>
	 <div class="text-center mw-730 mx-auto">
<h2 class="fs-24 fs-sm-36 text-center mb-8">Shipping Information</h2></div>
<div class="mb-3">
<label class="mb-2 fs-13 letter-spacing-01 font-weight-600 text-uppercase">name</label>
<div class="row">
<div class="col-md-6 mb-md-0 mb-4">
<input type="text" class="form-control" id="first-name" name="firstname" placeholder="First Name" required="">
</div>
<div class="col-md-6">
<input type="text" class="form-control" id="last-name" name="lasttname" placeholder="Last Name" required="">
</div>
</div>
</div>
<div class="mb-3">
<div class="row">
<div class="col-md-8 mb-md-0 mb-4">
<label for="street-address" class="mb-2 fs-13 letter-spacing-01 font-weight-600 text-uppercase">Street
Address</label>
<input type="text" class="form-control" id="street-address" name="streetaddress" required="">
</div>
<div class="col-md-4">
<label for="apt" class="mb-2 fs-13 letter-spacing-01 font-weight-600 text-uppercase">APT/Suite</label>
<input type="text" class="form-control" id="apt" name="apt" required="">
</div>
</div>
</div>
<div class="mb-3">
<div class="row">
<div class="col-md-4 mb-md-0 mb-4">
<label for="city" class="mb-2 fs-13 letter-spacing-01 font-weight-600 text-uppercase">City</label>
<input type="text" class="form-control" id="city" name="city" required="">
</div>
<div class="col-md-4 mb-md-0 mb-4">
<label for="state" class="mb-2 fs-13 letter-spacing-01 font-weight-600 text-uppercase">State</label>
<input type="text" class="form-control" id="state" name="state" required="">
</div>
<div class="col-md-4">
<label for="zip-code" class="mb-2 fs-13 letter-spacing-01 font-weight-600 text-uppercase">zip
code</label>
<input type="text" class="form-control" id="zip-code" name="zip" required="">
</div>
</div>
</div>
<div class="mb-3">
<label class="mb-2 fs-13 letter-spacing-01 font-weight-600 text-uppercase">Country</label>
<div class="dropdown show lh-1 rounded mb-4" style="background-color:#f5f5f5">
<a href="#" class="dropdown-toggle custom-dropdown-toggle text-decoration-none text-body p-3 position-relative d-block" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
Viet Nam
</a>
<div class="dropdown-menu custom-dropdown-item" aria-labelledby="dropdownMenuButton">
<a class="dropdown-item" href="#">Andorra</a>
<a class="dropdown-item" href="#">San Marino</a>
<a class="dropdown-item" href="#">Tunisia</a>
<a class="dropdown-item" href="#">Micronesia</a>
<a class="dropdown-item" href="#">Solomon Islands</a>
<a class="dropdown-item" href="#">Macedonia</a>
</div>
</div>
</div>
<div class="mb-3">
<label class="mb-2 fs-13 letter-spacing-01 font-weight-600 text-uppercase">info</label>
<div class="row">
<div class="col-md-6 mb-md-0 mb-4">
<input type="email" class="form-control" id="email" name="email" placeholder="Email" required="">
</div>
<div class="col-md-6">
<input type="number" class="form-control" id="phone" name="phone" placeholder="Phone number" required="">
</div>
</div>
</div>
<div class="custom-control custom-checkbox mt-6 mb-5">
<input type="checkbox" class="custom-control-input" name="customCheck6" checked="" id="customCheck5">
<label class="custom-control-label custom-control-label-secondary text-body" for="customCheck5">
<span class="text-body">Billing address is the same as shipping</span>
</label>
</div>
    <a href="shipping-step.html" class="btn btn-primary right_btn_inf_step">Continue Shipping</a>
</div>
                <div>
                	
                </div>
	  	 	
	  </section>

</body>
<script>
    function close_topbar(){
        $("#topbar").removeClass('d-xl-flex');
        // $("#content").css('padding-top','77px');
    
    }
</script>
    @include('web.web-footer')