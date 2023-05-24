@include('admin.admin-header');
 <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <div class="container-fluid">
                <div class="page-titles">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="javascript:void(0)">Website User Account</a></li>
						<li class="breadcrumb-item active"><a href="javascript:void(0)">Process</a></li>
					</ol>
                </div>
                <!-- row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">User Information</h4>
                            </div>
                            <div class="card-body">
                                <div class="form-validation">
									<form class="form-valide" action="#" method="post">
										<div class="row">
											<div class="col-sm-6">
												<div class="form-group">

													<label class="col-form-label" for="first_name"><b>First Name</b> <span
														class="text-danger">*</span>
													</label> <input type="text" class="form-control" id=""first_name""
														name="first_name" placeholder="Enter a First Name">

												</div>
											  </div>
											  <div class="col-sm-6">
												<div class="form-group">

													<label class="col-form-label" for="last_name"><b>Last Name<span class="text-danger">*</span></b>
													</label> <input type="text" class="form-control" id="Last Name"
														name="last_name" placeholder="Last Name">

												</div>
											  </div>
											
											
										</div>
										
										<div class="row">
											<div class="col-sm-6">
												<div class="form-group">

													<label class="col-form-label" for="email"><b>Email<span class="text-danger">*</span></b>
													</label> <input type="text" class="form-control" id="unit"
														name="email" placeholder="Enter Email">

												</div>
											  </div>
											<div class="col-sm-6">
												<div class="form-group">

													<label class="col-form-label" for="country_of_permanent_residence"><b>Country/Region<span class="text-danger">*</span></b> 
													</label>
														<select class="form-control">
														  <option value="">---SEECT---</option>
														  <option value="1">Australia</option>
														  <option value="2">Pakistan</option>
														  <option value="3">Japan</option>
														  <option value="4">UAE</option>
														  <option value="5">UK</option>
														  <option value="6">Saudi Arabia</option>
														  <option value="7">France</option>
														  <option value="8">Dubai</option>
														  <option value="8">Punjab(PAK)</option>
														</select>

												</div>
											</div>
											
										</div>
										<div class="row">
											<div class="col-sm-6">
												<div class="form-group">

													<label class="col-form-label" for="confirm_email"><b>Confirm Email<span class="text-danger">*</span></b>
													</label>
													<input type="number" class="form-control" id="confirm_email"
														name="confirm_email" placeholder="ReEnter Email">
                                                    <small>
                                                        <div class="row">
                        									<div class="col-sm-12">
                        										<div class="custom-control custom-checkbox mb-3 checkbox-warning">
                        											<input type="checkbox" class="custom-control-input" checked id="send_privacy" name="send_privacy">
                        											<label class="custom-control-label privacy-text" for="send_privacy">I want in! Send me the latest, straight to my inbox.<a href="#"><b class="text-warning">PRIVACY POLICY</b></a></label>
                        										</div>
                        									</div>
                										</div>
                                                    </small> 
												</div>
											</div>
											<div class="col-sm-6">
												<div class="form-group">

													<label class="col-form-label" for="phone_number"><b>Phone Number<span class="text-danger">*</span></b>
													</label>
													<input type="text" class="form-control" id="phone_number"
														name="phone_number" placeholder="Enter Phone Number">
                                                    <small>
                                                        <div class="row">
                        									<div class="col-sm-12">
                        										<div class="custom-control custom-checkbox mb-3 checkbox-warning">
                        											<input type="checkbox" class="custom-control-input" checked id="enable_mobile_promotion_alerts" name="enable_mobile_promotion_alerts">
                        											<label class="custom-control-label privacy-text" for="enable_mobile_promotion_alerts">All the latest product drops, limited offers, in-store event info-straight to your phone.<a href="#"><b class="text-warning">PRIVACY POLICY</b></a></label>
                        										</div>
                        									</div>
                										</div>
                                                    </small> 
												</div>
											</div>
											
										</div>
										<div class="row">
											<div class="col-sm-6">
												<div class="form-group">

													<label class="col-form-label" for="password"><b>Password<span class="text-danger">*</span></b>
													</label> <input type="password" class="form-control" id="unit"
														name="email" placeholder="Enter Password">

												</div>
											  </div>
											<div class="col-sm-6">
												<div class="form-group">

													<label class="col-form-label" for="confirm_password"><b>Confirm Password<span class="text-danger">*</span></b>
													</label>
													 <input type="password" class="form-control" id="confirm_password"
														name="confirm_password" placeholder="ReEnter Password">

												</div>
											</div>
											
										</div>
										<div class="row">
											<div class="col-sm-6">
												<div class="form-group">

													<label class="col-form-label" for="dob"><b>Date of Birth<span class="text-danger">*</span></b>
													</label> <input type="date" class="form-control" id="dob"
														name="dob">

												</div>
											  </div>
											
											
										</div>
										
										<div class="save-admin-center mt-3">
										   <button class="btn btn-rounded btn-success mobile-save-btn">Create Account</button>
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