@include('admin.admin-header');
 <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <div class="container-fluid">
                <div class="page-titles">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="javascript:void(0)">Admin User Account</a></li>
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
													</label> <input type="text" class="form-control" id="last_name"
														name="last_name" placeholder="Last Name">

												</div>
											  </div>
											
											
										</div>
										
										<div class="row">
											<div class="col-sm-6">
												<div class="form-group">

													<label class="col-form-label" for="email"><b>Email<span class="text-danger">*</span></b>
													</label> <input type="text" class="form-control" id="email"
														name="email" placeholder="Enter Email">

												</div>
											  </div>
											<div class="col-sm-6">
												<div class="form-group">

													<label class="col-form-label" for="confirm_email"><b>Confirm Email<span class="text-danger">*</span></b>
													</label>
													 <input type="number" class="form-control" id="confirm_email"
														name="confirm_email" placeholder="ReEnter Email">

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
											<div class="col-sm-12">
											<label class="col-form-label" for="country_of_permanent_residence"><b>User Roles<span class="text-danger">*</span></b> </label>
                                                <select class="multi-select-placeholder js-states" multiple="multiple">
                                                    <option value="Products">Products</option>
                                                    <option value="Website Users">Website Users</option>
                                                    <option value="Categories">Categories</option>
                                                </select>
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