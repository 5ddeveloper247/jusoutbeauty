<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>JusoutBeauty - Admin Login</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="./images/favicon.png">
    <link href="{{ url('/assets-admin') }}/css/admin/style.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
</head>
<style type="text/css">
.error-msg{
	color:red;
	text-align:center;
	font-size: 1vw;
}
</style>

<body class="h-100">
    <div class="authincation h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-6">
                    <div class="authincation-content">
                        <div class="row no-gutters">
                            <div class="col-xl-12">
                                <div class="auth-form">
									<div class="text-center mb-3">
										<a href="{{session('site')}}/admin"><img src="{{ url('/assets-admin') }}/images/admin/Logo-01.png" alt="" style="width: 100%;"></a>
									</div>
                                    <h4 class="text-center mb-4 text-white">Sign in your account</h4>

                                    <form action="loginAuth" method="POST">

                                    	<input type="hidden" name="_method" value="POST">
           								<input type="hidden" name="_token" id="csrf" value="{{ csrf_token() }}">

                                        <div class="form-group">
                                            <label class="mb-1 text-white"><strong>Email</strong></label>
                                            <input type="email" class="form-control" name="email" placeholder="hello@example.com">
                                            @error('email')
						            			<span class="error-msg">{{$message}}</span>
						            		@enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="mb-1 text-white"><strong>Password</strong></label>
                                            <input type="password" class="form-control" name="password" placeholder="Password">
                                            @error('password')
						            			<span class="error-msg">{{$message}}</span>
						            		@enderror
                                        </div>



                                        <div class="text-center">
                                           <span class="error-msg" style="margin-top:1vw;">{{session('error')}}</span>
                                        </div>
                                        <!-- <div class="form-row d-flex justify-content-between mt-4 mb-2 ">
                                            <div class="form-group">
                                               <div class="custom-control custom-checkbox ml-1 text-white">
													<input type="checkbox" class="custom-control-input" id="basic_checkbox_1">
													<label class="custom-control-label" for="basic_checkbox_1">Remember my preference</label>
												</div>
                                            </div>
                                            <div class="form-group" >
                                                <a class="text-white" href="{{session('site')}}/admin">Forgot Password?</a>
                                            </div>
                                        </div> -->
                                        <div class="text-center mt-4">
                                            <button type="submit" class="btn bg-white text-primary btn-block">Sign In</button>
                                        </div>
                                    </form>
                                    {{-- <div class="new-account mt-3">
                                        <p class="text-white">Don't have an account? <a class="text-white" href="{{session('site')}}/admin">Sign up</a></p>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
<!--     <script src="./vendor/global/global.min.js"></script> -->
<!-- 	<script src="./vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script> -->
<!--     <script src="./js/custom.min.js"></script> -->
<!--     <script src="./js/deznav-init.js"></script> -->

</body>

</html>
