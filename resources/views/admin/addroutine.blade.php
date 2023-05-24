@include('admin.admin-header');
  <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <div class="container-fluid">
                <div class="page-titles">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="javascript:void(0)">Routine</a></li>
						<li class="breadcrumb-item active"><a href="javascript:void(0)">Process</a></li>
					</ol>
                </div>
                <!-- row -->
                <div class="row">
                    <div class="col-xl-12 col-xxl-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Routines Add</h4>
                            </div>
                            <div class="card-body">
								 <!-- Nav tabs -->
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#routine_needs">
                                            <span>
                                                Routine By needs
                                            </span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#description">
                                            <span>
                                               Routine By Age 
                                            </span>
                                        </a>
                                    </li>
                                </ul>
                                <!-- Tab panes -->
                                <div class="tab-content tabcontent-border">
                                     <div class="tab-pane fade show active" id="routine_needs" role="tabpanel">
	                                      <div class="pt-4">
		                                      <div class="form-validation">
									<form class="form-valide" action="#" method="post">
										<div class="row">
											<div class="col-sm-6">
												<div class="form-group">

													<label class="col-form-label" for="name"><b>Name</b> <span
														class="text-danger">*</span>
													</label> <input type="text" class="form-control" id="title"
														name="title" placeholder="Enter a Routine Name">

												</div>
											  </div>
											  
										</div>

										<div class="row">
                                            <div class="col-sm-12">
                                               <label class="col-form-label" for="short_description"><b>Short Description</b></label>
                                               <textarea class="form-control" id="short_description" rows="8" name="short_description" placeholder="Enter Short Description..."></textarea>
                                            </div>
                                         </div>

                                        <h5 class="mb-4"><i class="fa fa-paperclip"></i> Attatchment</h5>
                                        
                                        <div class="col-sm-12 col-12 register-new-product-picture-para-box">
											<div class="row register-new-product-picture-para">
												<div class="col-sm-2 image-overlay upload-photo-box" id="imageAttach-btn" onclick="form1();" style="">
													<img src="{{ url('/assets-admin') }}/images/admin/upload.svg" alt="" width="50">
													<p>Upload Photo</p>
												</div>
												<div class="col-sm-9">
													<div class="row" id="p_att">
													</div>
												</div>
												<form class="" id="uploadattch" method="POST" action="importData" enctype="multipart/form-data">
													<input type="hidden" name="_method" value="POST">
           											{{ csrf_field() }}
           											<input type="hidden" id="userId" name="userId" value="<?php echo session('userId');?>">
													<input type="hidden" id="sourceId" name="sourceId" value="@{{ingredient.ID}}">
													<input type="hidden" id="sourceCode" name="sourceCode" value="INGREDIENT_IMG"> 
													<input type="file" id="uploadattl" name="uploadattl" class="file-input" style="display: none;">
												</form>
											</div>
										</div>

										
										<div class="row">
											<div class="col-sm-6">
												<div class="form-group">
													<label class="col-form-label" for="tags"><b>Select Routine Type</b> <span
														class="text-danger">*</span>
													</label>
													<select class="form-control" name="category" id="category">
													  <option vlaue="">---SELECT---</option>
													  <option vlaue="1">Skin Care</option>
													</select>
												</div>
											  </div>
										</div>
									</form>
								</div>
	</div>
</div>
                      <div class="tab-pane fade" id="description" role="tabpanel">
	                    
<!-- 					     
					     <div class="pt-4">
	                          <div class="form-group">
	                             <label id="desc_title">Description Title</label>
	                              <input type="text" name="desc_title" id="desc_title" class="form-control">
	                         </div>
		                             <div class="summernote"></div>
	                     </div> -->

						 <div class="tab-pane fade show active" id="routine_needs" role="tabpanel">
	                                      <div class="pt-4">
		                                      <div class="form-validation">
									<form class="form-valide" action="#" method="post">
										<div class="row">
											<div class="col-sm-6">
												<div class="form-group">

													<label class="col-form-label" for="name"><b>Name</b> <span
														class="text-danger">*</span>
													</label> <input type="text" class="form-control" id="title"
														name="title" placeholder="Enter a Routine Name">

												</div>
											  </div>
											  
										</div>

										<div class="row">
                                            <div class="col-sm-12">
                                               <label class="col-form-label" for="short_description"><b>Short Description</b></label>
                                               <textarea class="form-control" id="short_description" rows="8" name="short_description" placeholder="Enter Short Description..."></textarea>
                                            </div>
                                         </div>

                                        <h5 class="mb-4"><i class="fa fa-paperclip"></i> Attatchment</h5>
                                        
                                        <div class="col-sm-12 col-12 register-new-product-picture-para-box">
											<div class="row register-new-product-picture-para">
												<div class="col-sm-2 image-overlay upload-photo-box" id="imageAttach-btn" onclick="form1();" style="">
													<img src="{{ url('/assets-admin') }}/images/admin/upload.svg" alt="" width="50">
													<p>Upload Photo</p>
												</div>
												<div class="col-sm-9">
													<div class="row" id="p_att">
													</div>
												</div>
												<form class="" id="uploadattch" method="POST" action="importData" enctype="multipart/form-data">
													<input type="hidden" name="_method" value="POST">
           											{{ csrf_field() }}
           											<input type="hidden" id="userId" name="userId" value="<?php echo session('userId');?>">
													<input type="hidden" id="sourceId" name="sourceId" value="@{{ingredient.ID}}">
													<input type="hidden" id="sourceCode" name="sourceCode" value="INGREDIENT_IMG"> 
													<input type="file" id="uploadattl" name="uploadattl" class="file-input" style="display: none;">
												</form>
		
											</div>
										</div>

										
										<div class="row">
											<div class="col-sm-6">
												<div class="form-group">
													<label class="col-form-label" for="tags"><b>Select Routine Type</b> <span
														class="text-danger">*</span>
													</label>
													<select class="form-control" name="category" id="category">
													  <option vlaue="">---SELECT---</option>
													  <option vlaue="1">Skin Care</option>
													</select>
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
                    
                    
                </div>
            </div>
        
            
            <div class="row">
                <div class="col-xl-12 col-xxl-12">
                    <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Pricing & VAT</h4>
                            </div>
                            <div class="card-body">
								 <!-- Nav tabs -->
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#pricing">
                                            <span>
                                                Pricing
                                            </span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#VAT">
                                            <span>
                                               VAT
                                            </span>
                                        </a>
                                    </li>
                                </ul>
                                <!-- Tab panes -->
                                <div class="tab-content tabcontent-border">
                                     <div class="tab-pane fade show active" id="pricing" role="tabpanel">
	<div class="pt-4">
			<div class="row">
    			<div class="col-sm-6">
    				<div class="form-group">
    					<label class="col-form-label" for="unit_price"><b>Unit Price<span
    							class="text-danger">*</span></b> </label> <input type="number"
    						class="form-control" id="unit_price" name="unit_price">
    
    				</div>
    			</div>
			<div class="col-sm-6">
				<div class="form-group">
					<label class="col-form-label" for="discount_date_range"><b>Discount
							date range</b> </label> <input type="text"
						name="discount_date_range" id="discount_date_range"
						class="form-control input-daterange-datepicker"
						value="01/01/2015 - 01/31/2015">
				</div>
			</div>
		</div>
										
		<div class="row">
			<div class="col-sm-6">
				<div class="form-group">
					<label class="col-form-label" for="discount"><b>Discount<span
							class="text-danger">*</span></b> </label>

					<div class="row">
						<div class="col-sm-6">
							<input type="number" class="form-control" id="discount"
								name="discount" min="0">
						</div>
						<div class="col-sm-6">
							<select class="form-control">
								<option value="">Flat</option>
								<option value="">Percent</option>
							</select>
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="form-group">

					<label class="col-form-label" for="earn_point"><b>Set Point</b> </label>
					<input type="number" min="0" value="0" step="1" placeholder=""
						name="earn_point" class="form-control">

				</div>
			</div>							
		</div>
		
		
	  <div class="row">
			<div class="col-sm-6">
				<div class="form-group">
					<label class="col-form-label" for="quantity"><b>Quantity<span
							class="text-danger">*</span></b> </label> <input type="number"
						min="0" value="0" step="1" placeholder="Quantity" name="quantity"
						class="form-control">

				</div>
			</div>
			<div class="col-sm-6">
				<label class="col-form-label" for="sku"><b>SKU</b> </label> <input
					type="text" placeholder="SKU" id="sku" name="sku"
					class="form-control">

			</div>
											
		</div>
										
		<div class="row">
        	<div class="col-sm-6">
				<div class="form-group">
					<label class="col-form-label" for="external_link"><b>External Link</b> </label>
					<input type="text" placeholder="External Link" id="external_link" name="external_link" class="form-control">
					<small>Leave it blank if you do not use external site link</small>
				</div>
			</div>
			<div class="col-sm-6">
				   <label class="col-form-label" for="external_link_btn_txt"><b>External link button text</b> </label>
				   <input type="text" placeholder="External link button text" id="external_link_btn_txt" name="external_link_btn_txt" class="form-control">
				   <small>Leave it blank if you do not use external site link</small>
			</div>
		</div>
		
										
                                    				
	</div>
</div>
<div class="tab-pane fade" id="VAT" role="tabpanel">
	<div class="pt-4">
		<div class="row">
        	<div class="col-sm-6">
				<div class="form-group">
					<label class="col-form-label" for="tax"><b>TAX</b> </label>

					<div class="row">
						<div class="col-sm-6">
							<input type="number" class="form-control" id="tax" name="tax"
								min="0" value="0" step="0.01">
						</div>
						<div class="col-sm-6">
							<select class="form-control">
								<option value="">Flat</option>
								<option value="">Percent</option>
							</select>
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="form-group">
					<label class="col-form-label" for="vat"><b>VAT</b> </label>

					<div class="row">
						<div class="col-sm-6">
							<input type="number" class="form-control" id="vat" name="vat"
								min="0" value="0" step="0.01">
						</div>
						<div class="col-sm-6">
							<select class="form-control">
								<option value="">Flat</option>
								<option value="">Percent</option>
							</select>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>                                </div>
                            </div>
                        </div>
                        </div>
            </div>
            
            
            <div class="row">
                <div class="col-xl-12 col-xxl-12">
                    <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Product Ingredients & Shades</h4>
                            </div>
                            <div class="card-body">
								 <!-- Nav tabs -->
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#ingredients">
                                            <span>
                                                Ingredients
                                            </span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#shades">
                                            <span>
                                               Shades
                                            </span>
                                        </a>
                                    </li>
                                </ul>
                                <!-- Tab panes -->
                                <div class="tab-content tabcontent-border">
                                     <div class="tab-pane fade show active" id="ingredients" role="tabpanel">
	<div class="pt-4">
		<div class="row">
								   <div class="col-sm-4">
									    <div class="form-group">

											<label class="col-form-label" for="ing_category"><b>Ingredient Category</b> <span class="text-danger">*</span> </label> <select
												class="form-control" name="ing_category" id="ing_category">
												<option vlaue="">---SELECT---</option>
												<option vlaue="1">Skin Care</option>
											</select>
										</div>
									</div>
									<div class="col-sm-4">
									    <div class="form-group">

											<label class="col-form-label" for="ingredient"><b>Ingredient</b> <span class="text-danger">*</span> </label> <select
												class="form-control" name="ingredient" id="ingredient">
												<option vlaue="">---SELECT---</option>
												<option vlaue="1">Glesrine</option>
											</select>
										</div>
									</div>
									<div class="col-sm-4 align-center-verticle" >
									        <button class="btn btn-rounded btn-warning cmbm-6vw mt-2" style="width:100%;">Add</button>
									</div>
									
								</div>
								<div class="table-responsive">
                                    <table id="example5" class="display min-w850">
                                        <thead>
                                            <tr>
                                                <th>Seq</th>
                                                <th>Name</th>
                                                <th>Category</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>Johnson Baby Lotion</td>
                                                <td>Skin Care</td>
												
                                                <td>
													<div class="dropdown ml-auto text-right">
														<div class="btn-link" data-toggle="dropdown">
															<svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg>
														</div>
														<div class="dropdown-menu dropdown-menu-right">
															<a class="dropdown-item" href="#">Remove</a>
														</div>
													</div>
												</td>												
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>Men Skin Care</td>
                                                <td>Skin Care</td>
                                                <td>
													<div class="dropdown ml-auto text-right">
														<div class="btn-link" data-toggle="dropdown">
															<svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg>
														</div>
														<div class="dropdown-menu dropdown-menu-right">
															<a class="dropdown-item" href="#">Remove</a>
														</div>
													</div>
												</td>
                                            </tr>
                                            
                                        </tbody>
                                    </table>
                                </div>
	</div>
</div>
<div class="tab-pane fade" id="shades" role="tabpanel">
	<div class="pt-4">
		<div class="row">
								   <div class="col-sm-4">
									    <div class="form-group">

											<label class="col-form-label" for="shade_category"><b>Shade Category</b> <span class="text-danger">*</span> </label> <select
												class="form-control" name="shade_category" id="shade_category">
												<option vlaue="">---SELECT---</option>
												<option vlaue="1">General</option>
											</select>
										</div>
									</div>
									<div class="col-sm-4">
									    <div class="form-group">

											<label class="col-form-label" for="shade"><b>Shade</b> <span class="text-danger">*</span> </label> <select
												class="form-control" name="shade" id="shade">
												<option vlaue="">---SELECT---</option>
												<option vlaue="1">Multi</option>
											</select>
										</div>
									</div>
									<div class="col-sm-4 align-center-verticle" >
									        <button class="btn btn-rounded btn-warning mt-2 cmbm-6vw" style="width:100%;">Add</button>
									</div>
									
								</div>
								<div class="table-responsive">
                                    <table id="example5" class="display min-w850">
                                        <thead>
                                            <tr>
                                                <th>Seq</th>
                                                <th>Name</th>
                                                <th>Category</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>Eye Liner</td>
                                                <td>Eye Beauty</td>
												
                                                <td>
													<div class="dropdown ml-auto text-right">
														<div class="btn-link" data-toggle="dropdown">
															<svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg>
														</div>
														<div class="dropdown-menu dropdown-menu-right">
															<a class="dropdown-item" href="#">Remove</a>
														</div>
													</div>
												</td>												
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>Red Lipstick</td>
                                                <td>Lipstick</td>
                                                <td>
													<div class="dropdown ml-auto text-right">
														<div class="btn-link" data-toggle="dropdown">
															<svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg>
														</div>
														<div class="dropdown-menu dropdown-menu-right">
															<a class="dropdown-item" href="#">Remove</a>
														</div>
													</div>
												</td>
                                            </tr>
                                            
                                        </tbody>
                                    </table>
                                </div>
	</div>
</div>                                </div>
                            </div>
                        </div>
                        </div>
            </div>
            <div class="row">
                <div class="col-xl-12 col-xxl-12">
                    <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Uses</h4>
                            </div>
                            <div class="card-body">
								 <!-- Nav tabs -->
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#step_1">
                                            <span>
                                                Step 1
                                            </span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#step_2">
                                            <span>
                                               Step 2
                                            </span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#step_3">
                                            <span>
                                               Step 3
                                            </span>
                                        </a>
                                    </li>
                                    
                                </ul>
                                <!-- Tab panes -->
                                <div class="tab-content tabcontent-border">
                                     <div class="tab-pane fade show active" id="step_1" role="tabpanel">
	<div class="pt-4">
		 <div class="row">
	      <div class="col-sm-6">
				<div class="form-group">
					<label class="col-form-label" for="use_title_1"><b>Title</b>
					</label> <input type="text" class="form-control"
						id="use_title_1" name="use_title_1"
						placeholder="Title">

				</div>
			</div>
	   </div>
	   <div class="row">
	      <div class="col-sm-12">
	          <label class="col-form-label" for="use_image_1"><b>Image</b></label>
				<div class=" ml-0 ml-sm-12 ml-sm-0 mt-3">

					<div class="compose-content mb-3">
						<form action="#"></form>
						<h5 class="mb-4">
							<i class="fa fa-paperclip"></i> Image
						</h5>
						<form action="#" class="dropzone">
							<div class="fallback">
								<input name="use_image_1" type="file" accept="image/*" />
							</div>
						</form>
					</div>
				</div>
			</div>
	   </div>
	</div>
</div>
<div class="tab-pane fade" id="step_2" role="tabpanel">
	<div class="pt-4">
		 <div class="row">
	      <div class="col-sm-6">
				<div class="form-group">
					<label class="col-form-label" for="use_title_2"><b>Title</b>
					</label> <input type="text" class="form-control"
						id="use_title_2" name="use_title_2"
						placeholder="Title">

				</div>
			</div>
	   </div>
	   <div class="row">
	      <div class="col-sm-12">
	          <label class="col-form-label" for="use_image_2"><b>Image</b></label>
				<div class=" ml-0 ml-sm-12 ml-sm-0 mt-3">

					<div class="compose-content mb-3">
						<form action="#"></form>
						<h5 class="mb-4">
							<i class="fa fa-paperclip"></i> Image
						</h5>
						<form action="#" class="dropzone">
							<div class="fallback">
								<input name="use_image_2" type="file" accept="image/*" />
							</div>
						</form>
					</div>
				</div>
			</div>
	   </div>
	</div>

</div>


<div class="tab-pane fade" id="step_3" role="tabpanel">
	<div class="pt-4">
		 <div class="row">
	      <div class="col-sm-6">
				<div class="form-group">
					<label class="col-form-label" for="use_title_3"><b>Title</b>
					</label> <input type="text" class="form-control"
						id="use_title_3" name="use_title_3"
						placeholder="Title">

				</div>
			</div>
	   </div>
	   <div class="row">
	      <div class="col-sm-12">
	          <label class="col-form-label" for="use_image_3"><b>Image</b></label>
				<div class=" ml-0 ml-sm-12 ml-sm-0 mt-3">

					<div class="compose-content mb-3">
						<form action="#"></form>
						<h5 class="mb-4">
							<i class="fa fa-paperclip"></i> Image
						</h5>
						<form action="#" class="dropzone">
							<div class="fallback">
								<input name="use_image_3" type="file" accept="image/*" />
							</div>
						</form>
					</div>
				</div>
			</div>
	   </div>
	</div>
</div>                                </div>
                            </div>
                        </div>
                        </div>
            </div>
            
            
            <!-- <div class="row">
                <div class="col-xl-12 col-xxl-12">
                    <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Others</h4>
                            </div>
                            <div class="card-body">
								 <!-- Nav tabs -->
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#shipping_conf">
                                            <span>
                                                Shipping Configurations
                                            </span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#stock_visibility_state">
                                            <span>
                                               Stock Visibility State
                                            </span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#deal_setting">
                                            <span>
                                               Deal Setting
                                            </span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#flash_deal">
                                            <span>
                                               Flash Deal
                                            </span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#clinical_note">
                                            <span>
                                               Clinical Note
                                            </span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#setting">
                                            <span>
                                               Settings
                                            </span>
                                        </a>
                                    </li>
                                </ul>
                                <!-- Tab panes -->
                                <div class="tab-content tabcontent-border">
                                     <div class="tab-pane fade show active" id="shipping_conf" role="tabpanel">
	<div class="pt-4">
	    <div class="row">
			<div class="col-sm-6">
				<div class="form-group">
					<div class="custom-control custom-checkbox mb-3 checkbox-warning">
						<input type="checkbox" class="custom-control-input" checked
							id="free_shipping" name="free_shipping"> <label
							class="custom-control-label pl-4" for="free_shipping">Free
							Shipping</label>
					</div>
				</div>
			</div>

			<div class="col-sm-6">
				<div class="form-group">
					<div class="custom-control custom-checkbox mb-3 checkbox-warning">
						<input type="checkbox" class="custom-control-input" checked
							id="is_product_quantity_multiple"
							name="is_product_quantity_multiple" required> <label
							class="custom-control-label pl-4"
							for="is_product_quantity_multiple">Is Product Quantity Mulitiply</label>
					</div>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="form-group">
					<div class="custom-control custom-checkbox mb-3 checkbox-warning">
						<input type="checkbox" class="custom-control-input" id="flat_rate"
							name="flat_rate"> <label class="custom-control-label pl-4"
							for="flat_rate">Flat Rate</label>
					</div>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="form-group" id="shipping_cost_div" style="display:none;">
										<label class="col-form-label" for="shipping_cost"><b>Shipping
												Cost<span class="text-danger">*</span></b> </label>
												 <input type="number" class="form-control"
											id="shipping_cost" name="shipping_cost">

				</div>
			</div>
			
		</div>
	</div>
</div>
<div class="tab-pane fade" id="stock_visibility_state" role="tabpanel">
	<div class="pt-4">
	     <div class="row">
	       <div class="col-sm-6">
				<div class="form-group">
					<div class="custom-control custom-checkbox mb-3 checkbox-warning">
						<input type="checkbox" class="custom-control-input"
							id="show_stock_quantity" name="stock_visibility_state"
							onchange="stockVisibilityChange()"> <label
							class="custom-control-label pl-4" for="show_stock_quantity">Show
							Stock Quantity</label>
					</div>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="form-group">
					<div class="custom-control custom-checkbox mb-3 checkbox-warning">
						<input type="checkbox" class="custom-control-input"
							id="show_stock_with_text" name="stock_visibility_state"
							onchange="stockVisibilityChange()"> <label
							class="custom-control-label pl-4" for="show_stock_with_text">Show
							Stock with Text Only</label>
					</div>
				</div>
			</div>
	     </div>
	     
	     <div class="row">
	       <div class="col-sm-6">
				<div class="form-group">
					<div class="custom-control custom-checkbox mb-3 checkbox-warning">
						<input type="checkbox" class="custom-control-input"
							id="hide_stock" name="stock_visibility_state"
							onchange="stockVisibilityChange()"> <label
							class="custom-control-label pl-4" for="hide_stock">Hide Stock</label>
					</div>
				</div>
			</div>
	     </div>
	     
	</div>
</div>

<div class="tab-pane fade" id="deal_setting" role="tabpanel">
	<div class="pt-4">
	
	   <div class="row">
	      <div class="col-sm-6">
				<div class="form-group">
					<label class="col-form-label" for="shipping_days"><b>Shipping Days</b>
					</label> <input type="number" class="form-control"
						id="shipping_days" name="shipping_days"
						placeholder="Shipping Days">

				</div>
			</div>
	      <div class="col-sm-6 align-center-verticle pt-5">
				<div class="form-group">
					<div class="custom-control custom-checkbox mb-3 checkbox-warning">
						<input type="checkbox" class="custom-control-input"
							id="today_deal" name="today_deal"> <label
							class="custom-control-label pl-4" for="today_deal">Today Deal</label>
					</div>
				</div>
			</div>
			
			
	   </div>
	</div>
</div>
<div class="tab-pane fade" id="flash_deal" role="tabpanel">
	<div class="pt-4">
	   <div class="row">
	      <div class="col-sm-6">
				<div class="form-group">
					<label class="col-form-label" for="add_to_flash"><b>Add to Flash </b>
					</label> <select
						class="default-placeholder select2-hidden-accessible"
						id="add_to_flash" name="add_to_flash">
						<option value="">Choose Flash</option>
						<option value="">Winter Sell</option>
						<option value="">Flash Sale</option>
						<option value="">Electronic</option>
						<option value="">Flash Deal</option>
					</select>

				</div>
			</div>
	      <div class="col-sm-6">
				<div class="form-group">
					<label class="col-form-label" for="discount"><b>Discount </b> </label>
					<input type="number" id="discount" name="discount"
						class="form-control">

				</div>
			</div>
	    </div>
	    <div class="row">
	       <div class="col-sm-6">
				<div class="form-group">
					<label class="col-form-label" for="discount_type"><b>Discount Type</b>
					</label> <select class="form-control" id="discount_type"
						name="discount_type">
						<option value="">Choose Discount Type</option>
						<option value="">Flat</option>
						<option value="">Persent</option>
					</select>

				</div>
			</div>
	    </div>
	</div>
</div>
<div class="tab-pane fade" id="setting" role="tabpanel">
	<div class="pt-4">
	    <div class="row">
	       <div class="col-sm-6">
	          <div class="form-group">
									<div class="custom-control custom-checkbox mb-3 checkbox-warning">
        								<input type="checkbox" class="custom-control-input" checked id="cod" name="cod">
        								<label class="custom-control-label pl-4" for="cod">Cash On Delivery</label>
									</div>
								</div>
	       </div>
	       <div class="col-sm-6">
	          <div class="form-group">
									<div class="custom-control custom-checkbox mb-3 checkbox-warning">
        								<input type="checkbox" class="custom-control-input" id="featured" name="featured">
        								<label class="custom-control-label pl-4" for="featured">Featured</label>
									</div>
								</div>
	       </div>
	    </div>
	    <div class="row">
			<div class="col-sm-6">
				<div class="form-group">
					<div class="custom-control custom-checkbox mb-3 checkbox-warning">
						<input type="checkbox" class="custom-control-input" checked
							id="todays_deal" name="todays_deal" required> <label
							class="custom-control-label pl-4" for="todays_deal">Todays Deal</label>
					</div>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="form-group">
					<label class="col-form-label" for="lqw"><b>Low Quantity Warning<span
							class="text-danger">*</span></b> </label> <input type="number"
						class="form-control" id="lqw" name="lqw">

				</div>
			</div>

		</div>
	</div>
</div>



<div class="tab-pane fade" id="clinical_note" role="tabpanel">
	<div class="pt-4">
	   <div class="row">
			
			<div class="col-sm-12 mb-2">
				<label class="col-form-label"><b>Description</b> </label>

				<div class="summernote"></div>
			</div>
		</div>
		<div id="lightgallery" class="row">
									<a href="images/big/img1.jpg" data-exthumbimage="images/big/img1.jpg" data-src="images/big/img1.jpg" class="col-lg-3 col-md-6 mb-4">
										<img src="http://www.jusoutbeauty.com/site/themes/images/admin/big/img1.jpg" style="width:100%;"/>
									</a>
									
								</div>


		<div class=" ml-0 ml-sm-12 ml-sm-0 mt-3">

			<div class="compose-content mb-3">
				<form action="#"></form>
				<h5 class="mb-4">
					<i class="fa fa-paperclip"></i> Picture
				</h5>
				<form action="#" class="dropzone">
					<div class="fallback">
						<input name="clinicalfile" type="file" accept="video/*" />
					</div>
				</form>
			</div>
		</div>
	</div>
</div>                                </div>
                            </div>
                        </div>
                        </div>
            </div> -->
            
        </div>
        <!--**********************************
            Content body end
        ***********************************-->



       

    </div>
	<script>  
  function form1(){
    	$("#uploadattl").click();
    }

</script>
    @include('admin.admin-footer');