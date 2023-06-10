@include('web.web-header')
<style type="text/css">
    .error-msg {
        color: red;
        text-align: center;
        font-size: 1rem;
    }
	.input:focus {
		border: 3px solid #ffb800;
	}
	input[type="number"]::-webkit-outer-spin-button,
	input[type="number"]::-webkit-inner-spin-button {
		-webkit-appearance: none;
		margin: 0;
	}

	.inputfield {
		width: 100%;
		display: flex;
		justify-content: space-around;
	}
	.input {
		height: 3em;
		width: 3em;
		border: 2px solid #dad9df;
		outline: none;
		text-align: center;
		font-size: 1.5em;
		border-radius: 0.3em;
		background-color: #ffffff;
		outline: none;
		/*Hide number field arrows*/
		-moz-appearance: textfield;
	}
	.show {
		display: block;
	}
	.hide {
		display: none;
	}
	.input:disabled {
		color: #89888b;
	}
</style>
<main id="content" ng-app="project1">
    <div ng-controller="projectinfo1">
        <section class="pb-1 pt-5" style="display: none;">
            <div class="container">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-site py-0 d-flex fs-15 mb-3 account-page">
                        <li class="breadcrumb-item"><a class="text-decoration-none"
                                href="{{ session('site') }}/home">Home</a></li>
                        <li class="breadcrumb-item pl-0"><a class="text-decoration-none" href="store.html">Shop</a></li>
                        <li class="breadcrumb-item pl-0"><a class="text-decoration-none ">All</a> </li>
                    </ol>
                </nav>
            </div>
        </section>

        <section class="pb-6 pr-4 pl-4 pt-4" id="details-header">
            <div class="container container-custom  mt-5 mt-md-0 mt-xl-5 mt-xxl-5">
                <div class="row no-gutters">

                    <div class="col-lg-12 text-left">
                        <h2 class="mb-5" style="padding-top: 89px">Account</h2>
                    </div>
                </div>
            </div>
        </section>

        <section class="pb-6 pr-4 pl-4">
            <div class="container container-custom">
                <div class="row">
                    <div class="col-lg-4 d-flex align-items-stretch">
                        <div class="row">

                            <div class="box_sec pt-6 pb-6 pl-6 pr-6">
                                <h2 class="mb-5">RETURNING CUSTOMER, TROUBLE LOGGING IN?</h2>
                                <p class="text-primary fs-12 mb-5 "> We updated our shopping experience. If you haven't
                                    logged in recently and are very trouble . Please reset your password to login. </p>
                                <a href="javascript:;" class="btn btn-outline-primary w-100"
                                    ng-click="resetPass();">Reset Password</a>
                            </div>
                            <div class="box_sec pt-6 pb-6 pl-6 pr-6">
                                <h2 class="mb-5">CHECK ORDER STATUS</h2>
                                <p class="text-primary fs-12 mb-5 ">To check your order status.
                                    You may SIGN IN, CREATE ACCOUNT, or click the links found in
                                    your order confirmation or shipping notification emails.</p>
                            </div>
                        </div>
                        <div class="modal fade quick-view reset-pass" id="resetPassword_modal" tabindex="-1"
                            style="display: none;" aria-hidden="true">
                            <div class="modal-dialog login_modal" style="opacity: 1;">
                                <div class="modal-content p-0">
                                    <div class="modal-body">
                                        <button type="button"
                                            class="close fs-32 position-absolute pos-fixed-top-right pr-3 pt-2 z-index-10"
                                            data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true" class="fs-20"><i class="fal fa-times"></i></span>
                                        </button>
                                        <div class="row" id="reset_email">
                                            {{-- <div class="col-lg-1 mb-8 mb-lg-0 pr-xl-2"></div> --}}
                                            <div class="col-lg-12 mb-8 mb-lg-8 mt-lg-8 pr-xl-2">
                                                <h3 class="fs-24 mb-6">Reset Password</h3>
                                                <form action="" method="POST">
                                                    <div class="form-group mb-4">
                                                        <label for="exampleInputEmail1" class="sr-only">Email
                                                            address</label>
															<input ng-model="reset['R_3']" type="email" id="reset_email"
															class="form-control mb-3" id="reset_user_pass" placeholder="Your email">
                                                    </div>

                                                    <button type="submit" ng-click="resetPassFunction()"
                                                        class="btn btn-primary btn-block mb-3">Submit</button>

                                                </form>
                                            </div>
                                            {{-- <div class="col-lg-1 mb-8 mb-lg-0 pr-xl-2"></div> --}}
                                        </div>

										{{-- for OTP --}}
										<div class="row no-gutters" id="otp_num" style="display:none">
                                            <div class="col-lg-1 mb-8 mb-lg-0 pr-xl-2"></div>
                                            <div class="col-lg-10 mb-8 mb-lg-8 mt-lg-8 pr-xl-2">
                                                <h3 class="fs-24 mb-6">Enter OTP</h3>
                                                <form action="" method="POST" class="digital-group">
													<input type="hidden" ng-model="votp['V_7']" name="" id="user_otp" >
													<div class="inputfield">

														<input type="number" ng-model="votp['V_1']" maxlength="1" class="input otp-model-mbl"  />
														<input type="number" ng-model="votp['V_2']" maxlength="1" class="input otp-model-mbl" disabled />
														<input type="number" ng-model="votp['V_3']" maxlength="1" class="input otp-model-mbl" disabled />
														<input type="number" ng-model="votp['V_4']" maxlength="1" class="input otp-model-mbl" disabled />
														<input type="number" ng-model="votp['V_5']" maxlength="1" class="input otp-model-mbl" disabled />
														<input type="number" ng-model="votp['V_6']" maxlength="1" class="input otp-model-mbl" disabled />
													</div>
													  <button type="submit" id="submit" ng-click="validateOTP()"
                                                        class="btn btn-primary btn-block mb-3 mt-5 hide">Submit</button>
												</form>
											</div>



                                            <div class="col-lg-1 mb-8 mb-lg-0 pr-xl-2"></div>
                                        </div>

										{{-- for confirm password --}}
										<div class="row no-gutters" id="reset_pass_form" style="display:none;">
                                            <div class="col-lg-1 mb-8 mb-lg-0 pr-xl-2"></div>
                                            <div class="col-lg-10 mb-8 mb-lg-8 mt-lg-8 pr-xl-2">
                                                <h3 class="fs-24 mb-6">Enter New Password</h3>
                                                <form action="" method="POST" class="digital-group">
													<input type="hidden" ng-model="cpass['C_1']" name="" id="user_con_id" >

														<div class="form-group mb-3">
															<label for="exampleInputPassword1" class="sr-only">Password</label>
															<input type="password" ng-model="cpass['C_2']" id="password_reset" name="password" class="form-control" placeholder="Password">
														</div>

														<div class="form-group mb-3">
															<label for="exampleInputPassword1" class="sr-only">Confirm Password</label>
															<input type="password" ng-model="cpass['C_3']" id="con_password_reset" name="" class="form-control" placeholder="Confirm Password">
														</div>


													  <button type="submit"  ng-click="validatePassword()"
                                                        class="btn btn-primary btn-block mb-3 mt-5">Submit</button>
												</form>
											</div>



                                            <div class="col-lg-1 mb-8 mb-lg-0 pr-xl-2"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="row mt-4">

                        </div> --}}

                    </div>
                    <div class="col-lg-4 d-flex align-items-stretch">
                        <div class="row">
                            <div class="box_sec pt-6 pb-6 pl-6 pr-6">
                                <h2 class="mb-6">SIGN IN</h2>
                                <p class=" mb-6">Sign in to your account to add or edit your
                                    addresses and email Preference, save your Pro filter to your
                                    profile and more.</p>
                                <form action="userLoginAuth" method="POST">

                                    <input type="hidden" name="_method" value="POST">
                                    <input type="hidden" name="_token" id="csrf" value="{{ csrf_token() }}">

                                    <div class="form-group mb-4">
                                        <label for="exampleInputEmail1" class="sr-only">Email</label>
                                        <input type="email" name="email" class="form-control"
                                            placeholder="Email Address">
                                        @error('email')
                                            <span class="error-msg">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="exampleInputPassword1" class="sr-only">Password</label>
                                        <input type="password" name="password" class="form-control"
                                            placeholder="Password">
                                        @error('password')
                                            <span class="error-msg">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <a href="javascript:;"
                                        class="d-inline-block fs-15 border-bottom border-2x lh-12 mb-5 border-primary" ng-click="resetPass();">
                                        Forgot your password?
                                    </a>
                                    <div class="text-center">
                                        <span class="error-msg" style="margin-top:1vw;">{{ session('error') }}</span>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-block mb-3">Submit</button>
                                </form>

                            </div>
                        </div>
                    </div>
                    <div class="modal fade quick-view reset-pass" id="product-03-1" tabindex="-1"
                        aria-hidden="true">
                        <div class="modal-dialog login_modal">
                            <div class="modal-content p-0">
                                <div class="modal-body p-0">
                                    <button type="button"
                                        class="close fs-32 position-absolute pos-fixed-top-right pr-3 pt-2 z-index-10"
                                        data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true" class="fs-20"><i class="fal fa-times"></i></span>
                                    </button>
                                    <div class="row no-gutters">
                                        <div class="col-lg-1 mb-8 mb-lg-0 pr-xl-2"></div>
                                        <div class="col-lg-10 mb-8 mb-lg-8 mt-lg-8 pr-xl-2">
                                            <h3 class="fs-24 mb-6">Reset Password</h3>
                                            <form>
                                                <div class="form-group mb-4">
                                                    <label for="exampleInputEmail1" class="sr-only">Email
                                                        address</label> <input type="email" class="form-control"
                                                        id="exampleInputEmail1" name="email"
                                                        placeholder="Email Address">
                                                </div>


                                                <button type="submit"
                                                    class="btn btn-primary btn-block mb-3">Submit</button>


                                            </form>
                                        </div>
                                        <div class="col-lg-1 mb-8 mb-lg-0 pr-xl-2"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- mujtaba -->
                    <div class="col-lg-4 p-0 d-flex align-items-stretch">
                        <div class="box_sec pt-6 pb-6 pl-6 pr-6">
                            <h2 class="mb-5">CREATE ACCOUNT</h2>
                            <h6 class="">GET YOUR FAVES FASTER</h6>
                            <p class="text-primary fs-12 mb-5 ">Save your order information to make checkout a breeze.
                            </p>
                            <h6 class="">EXCLUSIVE OFFERS + INFO</h6>
                            <p class="text-primary fs-12 mb-5 ">
                                Sign up to stay posted on
                                hyper-limited offers, online-only product drops, in store events,
                                and-as true fenty beauty + fenty skin family-personal beauty tips
                                from Rihhana herself.
                            </p>
                            <h6 class="">ORDER DETAIL</h6>
                            <p class="text-primary fs-12 mb-5 ">
                                Recieve important updates
                                about your order, and track it every step of the way.
                            </p>
                            <a href="javascript:;" class="btn btn-outline-primary w-100" data-toggle="modal"
                                data-target="#product-03-3">Create Account</a>
                        </div>

                    </div>
                    <div class="modal fade quick-view reset-pass" id="product-03-3" tabindex="-1"
                        aria-hidden="true">
                        <div class="modal-dialog login_modal">
                            <div class="modal-content create_account">
                                <div class="modal-body ">
                                    <button type="button"
                                        class="close fs-32 position-absolute pos-fixed-top-right pr-3 pt-2 z-index-10"
                                        data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true" class="fs-20"><i class="fal fa-times"></i></span>
                                    </button>
                                    <div class="row">
                                        {{-- <div class="col-lg-1 mb-8 mb-lg-0 pr-xl-2"></div> --}}
                                        <div class="col-lg-12 mb-8 mb-lg-8 mt-lg-8 pr-xl-2">
                                            <h2 class=" mb-6">Create New Account</h2>
                                            <form>
                                                <input ng-model="store['A_1']" type="text"
                                                    class="form-control mb-3" placeholder="First name" required>
                                                <input ng-model="store['A_2']" type="text"
                                                    class="form-control mb-3" placeholder="Last name" required>
                                                <input ng-model="store['A_3']" type="email"
                                                    class="form-control mb-3" placeholder="Your email" required>
                                                <input ng-model="store['A_4']" type="phone"
                                                    class="form-control  mb-3" placeholder="Phone Number" required>
                                                <input ng-model="store['A_5']" type="password"
                                                    class="form-control mb-3" placeholder="Password" required>
                                                <input ng-model="store['A_6']" type="password"
                                                    class="form-control mb-3" placeholder="Confirm Password" required>
                                                <div class="custom-control custom-checkbox mt-4 mb-5 mr-xl-6">

                                                    <input type="checkbox" id="termsOfUse1"
                                                        class="custom-control-input">
                                                    <label class="custom-control-label  text-primary"
                                                        for="termsOfUse1"> Yes, I agree with Grace
                                                        <a href="#" class="text-decoration-underline">Privacy
                                                            Policy</a> and
                                                        <a href="#" class="text-decoration-underline">Terms of
                                                            Use</a>
                                                    </label>
                                                </div>
                                                <button type="button" ng-click="zakana()" value="Login"
                                                    class="btn btn-primary btn-block">Sign Up</button>
                                                <div class="border-bottom mt-6"></div>
                                            </form>
                                        </div>
                                        {{-- <div class="col-lg-1 mb-8 mb-lg-0 pr-xl-2"></div> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>
    </div>
</main>

@include('web.web-footer')
<script src="{{ url('/assets-web') }}/customjs/script_login.js?v={{time()}}"></script>
<script>
const input = document.querySelectorAll(".input");
const inputField = document.querySelector(".inputfield");
const submitButton = document.getElementById("submit");
let inputCount = 0,
  finalInput = "";

//Update input
const updateInputConfig = (element, disabledStatus) => {
  element.disabled = disabledStatus;
  if (!disabledStatus) {
    element.focus();
  } else {
    element.blur();
  }
};

input.forEach((element) => {
  element.addEventListener("keyup", (e) => {
    e.target.value = e.target.value.replace(/[^0-9]/g, "");
    let { value } = e.target;

    if (value.length == 1) {
      updateInputConfig(e.target, true);
      if (inputCount <= 5 && e.key != "Backspace") {
        finalInput += value;
        if (inputCount < 5) {
          updateInputConfig(e.target.nextElementSibling, false);
        }
      }
      inputCount += 1;
    } else if (value.length == 0 && e.key == "Backspace") {
      finalInput = finalInput.substring(0, finalInput.length - 1);
      if (inputCount == 0) {
        updateInputConfig(e.target, false);
        return false;
      }
      updateInputConfig(e.target, true);
      e.target.previousElementSibling.value = "";
      updateInputConfig(e.target.previousElementSibling, false);
      inputCount -= 1;
    } else if (value.length > 1) {
      e.target.value = value.split("")[0];
    }
    submitButton.classList.add("hide");
  });
});

window.addEventListener("keyup", (e) => {
  if (inputCount > 5) {
    submitButton.classList.remove("hide");
    submitButton.classList.add("show");
    if (e.key == "Backspace") {
      finalInput = finalInput.substring(0, finalInput.length - 1);
      updateInputConfig(inputField.lastElementChild, false);
      inputField.lastElementChild.value = "";
      inputCount -= 1;
      submitButton.classList.add("hide");
    }
  }
});

// const validateOTP = () => {
//   alert("Success");
// };

//Start
const startInput = () => {
  inputCount = 0;
  finalInput = "";
  input.forEach((element) => {
    element.value = "";
  });
  updateInputConfig(inputField.firstElementChild, false);
};

window.onload = startInput();

</script>
<script>
	function close_topbar(){
        $("#topbar").removeClass('d-xl-flex');
        $("#content").css('padding-top','77px');
        // $("#details-header").removeClass('mt-15');
        // $("#details-header").addClass('mt-11');

    }
</script>
