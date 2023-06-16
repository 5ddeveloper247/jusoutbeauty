@include('admin.admin-header');
<script>
var userId = '<?php echo session('userId');?>';
var site = '<?php echo session('site');?>';
var baseurl = "<?php echo url('/assets-admin');?>";
</script>
<!-- <style> 
a[type="button"] {
      color:white !important;
}
button{
	color:white !important;
}
</style> -->
	<div ng-app="project1">
        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body" ng-controller="projectinfo1">
            <div class="container-fluid pt-0" ng-show="editView == '0'">
                
                <!-- row -->
				<div class="row">
					<div class="col-10">
						<div class="page-titles pt-0 pb-0 mb-0">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="javascript:void(0)">Routine Names</a></li>
								<li class="breadcrumb-item active"><a href="javascript:void(0)">View All</a></li>
							</ol>
		                </div>
					</div>
					<div class="col-2">
						<a type="button" class="btn btn-rounded btn-warning admin-view-add mb-3" style="color:white;" ng-click="addNew();" href="javascript:void(0)">Add new</a>
					</div>
				</div>
				<div class="row">
                    
					<div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Routines</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="ingredientTable" class="display min-w850">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Routine Name</th>
                                                <th>Routine Category</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr ng-repeat="row in displayCollection">
                                                <td>@{{row.seqNo}}</td>
                                                <td>@{{row.NAME}}</td>
                                                <td ng-if="row.IDENTIFY == '1'">Routine by Needs</td>
                                                <td ng-if="row.IDENTIFY == '2'">Routine by age</td>
												<td>
													<span class="badge light badge-success" ng-if="row.STATUS == 'active'">
														<i class="fa fa-circle text-success mr-1"></i>
														Active
													</span>
													<span class="badge light badge-danger" ng-if="row.STATUS != 'active'"> 
														<i class="fa fa-circle text-danger mr-1"></i>
														InActive
													</span>
												</td>
                                                <td>
													<div class="dropdown ml-auto text-right">
														<div class="btn-link" data-toggle="dropdown">
															<svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg>
														</div>
														<div class="dropdown-menu dropdown-menu-right">
															<a class="dropdown-item" href="javascript:;" ng-click="statusChange(@{{row.seqNo}});" ng-if="row.STATUS != 'active'">Active</a>
															<a class="dropdown-item" href="javascript:;" ng-click="statusChange(@{{row.seqNo}});" ng-if="row.STATUS == 'active'">InActive</a>
															<a class="dropdown-item" href="javascript:;" ng-click="continouRecord(@{{row.seqNo}});">Edit</a>
															<a class="dropdown-item" href="javascript:;" ng-click="removeroutinemodal(@{{row.seqNo}})">Delete</a>
<!-- 															<a class="dropdown-item" href="#">View Details</a> -->
														</div>
													</div>
												</td>												
                                            </tr>
                                            
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
				</div>
				

            </div>
            
            <div class="container-fluid pt-0" ng-show="editView == '1'">
                <div class="page-titles pt-0 pb-0 mb-0">
					<ol class="breadcrumb">
						<li class="breadcrumb-item" ng-click="backToListing();"><i class="fa fa-arrow-left p-1"></i> &nbsp;<a href="javascript:void(0)">Routines</a></li>
						<li class="breadcrumb-item active"><a href="javascript:void(0)">Process</a></li>
					</ol>
                </div>
                <!-- row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Routine</h4>
                            </div>
                            <div class="card-body">
                                <div class="form-validation">
									<form class="form-valide">
										<div class="row">
											<div class="col-sm-5">
												<div class="form-group">

													<label class="col-form-label" for="Title"><b>Title</b> <span class="text-danger">*</span> </label> 
													<input type="text" class="form-control" id="title" ng-model="routinename['P_1']" placeholder="Enter a Title...">

												</div>
											</div>
											<!-- <div class="col-sm-5">
												<div class="form-group">

													<label class="col-form-label" for="quantity_in_stock"><b>Quantity
														In Stock</b> <span class="text-danger">*</span>
													</label><br>
													 <input type="number" class="form-control" ng-model="ingredient['P_2']" id="quantity_in_stock" placeholder="Quantity">

												</div>
											</div> -->
											<div class="col-sm-5">
												<div class="form-group">
        										    <label class="col-form-label" for="category"><b>Category</b> <span class="text-danger">*</span> </label><br>
        											<select class="form-control" ng-model="routinename['P_3']">
        												<option value="">Choose</option>
        											   <option value="1">Routine By needs</option>
        											   <option value="2">Routine By age</option>
        											</select>
    											</div>
    										</div>
										</div>

									<div class="row">
										<div class="col-sm-12">
											<label class="col-form-label" for="quantity_in_stock"><b>Description</b>
												<span class="text-danger">*</span></label>
											<div class="summernote" id="summernote"></div>
										</div>
									</div>


									<div class=" ml-0 ml-sm-12 ml-sm-0 mt-3">
                                    
                                    <div class="compose-content">
                                        <form action="#">
                                          
                                        </form>
                                        <h5 class="mb-4"><i class="fa fa-paperclip"></i> Attachment</h5>
                                        
                                        <div class="col-sm-12 col-12 register-new-product-picture-para-box">
											<div class="row register-new-product-picture-para">
												<div class="col-sm-2 image-overlay upload-photo-box" id="imageAttach-btn" onclick="form1();" style="">
													<img src="{{ url('/assets-admin') }}/images/admin/upload.svg" alt="" width="50">
													<p>125 X 125</p>
												</div>
												<div class="col-sm-9">
													<div class="row" id="p_att">
													
													   <!-- <div class="col-2 image-overlay margin-r1" id="profuct_img_file_351">
															<img src="http://jasad5d.5dsurf.com/themes/jasad18122020/65/product/94/banner01.jpg" alt="" class="image-box">
															<div class="overlay">
																<div class="text">
																	<img class="fa-trash-alt" src="{{ url('/assets-admin') }}/images/admin/trash.svg" alt="" width="18">
																	<div class="arrow-icon-move-box">
																		<img class="arrow-center" src="{{ url('/assets-admin') }}/images/admin/feather-move.svg" alt="">
																		<p>Move Position</p>
																	</div>
																</div>
															</div>
														</div> -->

													</div>
												</div>
												<form class="" id="uploadattch" method="POST" action="uploadRoutineAttachment" enctype="multipart/form-data">
													<input type="hidden" name="_method" value="POST">
           											{{ csrf_field() }}
           											<input type="hidden" id="userId" name="userId" value="<?php echo session('userId');?>">
													<input type="hidden" id="sourceId" name="sourceId" value="@{{routinename.ID}}">
													<input type="hidden" id="sourceCode" name="sourceCode" value="INGREDIENT_IMG"> 
													<input type="file" id="uploadattl" name="uploadattl" class="file-input" style="display: none;">
												</form>
		
											</div>
										</div>
										<!-- <form id="uploadfile" method="POST" action="importData" class="dropzone" id="myDropzone">
											<input type="hidden" name="_method" value="POST">
           									{{ csrf_field() }}
											<input type="hidden" name="form_code" value="INGREDIENT_IMG">
											<input type="hidden" name="recordId" required>
											
											<div class="fallback">
												<input name="file" type="file" multiple accept="image/*"/>
											</div>
		
										</form> -->
                                    </div>
                                    <div class="text-left mt-4 mb-2">
                                        <button class="btn btn-primary btn-sl-sm mr-2" type="button" ng-click="saveRoutinename();"><span class="mr-2"><i class="fa fa-paper-plane"></i></span>Save</button>
                                        <a href="javascript:;" class="btn btn-danger light btn-sl-sm" ng-click="backToListing();"><span class="mr-2"><i class="fa fa-times" aria-hidden="true"></i></span>Discard</a>
                                    </div>
                                   </div>
									</form>
								</div>
                            </div>
                        </div>
                    </div>
                    
                </div>
                        
				<div class="row" >
					<div class="col-xl-12 col-xxl-12">
						<div class="card">
								<div class="card-header">
									<h4 class="card-title">Product Routine & Types</h4>
								</div>
								<div class="card-body">
									<!-- Nav tabs -->
									<ul class="nav nav-tabs" role="tablist">
										{{-- <li class="nav-item">
											<a class="nav-link active" data-toggle="tab" href="#ingredients">
												<span>
													Routine Type
												</span>
											</a>
										</li> --}}
										<li class="nav-item">
											<a class="nav-link active" data-toggle="tab" href="#shades">
												<span>
												Steps
												</span>
											</a>
										</li>
									</ul>
									<!-- Tab panes -->
									<div class="tab-content tabcontent-border">
										<div class="tab-pane fade " id="ingredients" role="tabpanel">
											<div class="pt-4">
												<div class="row justify-content-end">
									<!-- <div class="col-sm-4">
											<div class="form-group">

												<label class="col-form-label" for="ing_category"><b>Ingredient Category</b> <span class="text-danger">*</span> </label> <select
													class="form-control" name="ing_category" id="ing_category">
													<option vlaue="">---SELECT---</option>
													<option vlaue="1">Skin Care</option>
												</select>
											</div>
										</div> -->
										<!-- <div class="col-sm-4">
											<div class="form-group">

												<label class="col-form-label" for="ingredient"><b>Ingredient</b> <span class="text-danger">*</span> </label> <select
													class="form-control" name="ingredient" id="ingredient">
													<option vlaue="">---SELECT---</option>
													<option vlaue="1">Glesrine</option>
												</select>
											</div>
										</div> -->
										<div class="col-sm-4 align-center-verticle" >
												<button class="btn btn-rounded btn-warning cmbm-6vw mb-3" style="color:white;width:100%;" ng-click="addtype();" style="width:100%;">Add</button>
										</div>
										
									</div>
									<div class="table-responsive">
										<table id="type_table" class="display min-w850">
											<thead>
												<tr>
													<th>Seq</th>
													<th>Routine Type</th>
													<th>Status</th>
													<th>Action</th>
												</tr>
											</thead>
											<tbody >
												<?php $i=0; ?>
												<tr ng-repeat="row in getAllRoutineTypes">
													<td>@{{row.NAME_ID}}</td>
													<td>@{{row.TYPE_NAME}}</td>
													<td>
														<span class="badge light badge-success" ng-if="row.STATUS == 'active'">
															<i class="fa fa-circle text-success mr-1"></i>
															Active
														</span>
														<span class="badge light badge-danger" ng-if="row.STATUS != 'active'"> 
															<i class="fa fa-circle text-danger mr-1"></i>
															InActive
														</span>
													</td>									
													<td>
														<div class="dropdown ml-auto text-right">
															<div class="btn-link" data-toggle="dropdown">
																<svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg>
															</div>
															<div class="dropdown-menu dropdown-menu-right">
																<a class="dropdown-item" ng-click="removetypenamemodal(@{{row.NAME_ID}});">Remove</a>
																<a class="dropdown-item" ng-click="continuetypename(@{{row.NAME_ID}});">Edit</a> 
															</div>
														</div>
													</td>												
												</tr>

												{{-- <tr ng-repeat="row in routinetypedata">
													<td>@{{row.id}}</td>
													<td>@{{row.name}}</td>	
													<td>@{{row.created_at}}</td>											
													<td>
														<div class="dropdown ml-auto text-right">
															<div class="btn-link" data-toggle="dropdown">
																<svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg>
															</div>
															<div class="dropdown-menu dropdown-menu-right">
																<a class="dropdown-item" ng-click="removetypenamemodal(@{{row.id}});">Remove</a>
																<a class="dropdown-item" ng-click="continuetypename(@{{row.id}});">edit</a>

															</div>
														</div>
													</td>												
												</tr> --}}
										
											</tbody>
										</table>
									</div>
								</div>
							</div>
							<div class="tab-pane fade show active" id="shades" role="tabpanel">
										<div class="pt-4">
											<div class="d-flex justify-content-end">
										<!-- <div class="col-sm-4">
											<div class="form-group">

												<label class="col-form-label" for="shade_category"><b>Shade Category</b> <span class="text-danger">*</span> </label> <select
													class="form-control" name="shade_category" id="shade_category">
													<option vlaue="">---SELECT---</option>
													<option vlaue="1">General</option>
												</select>
											</div>
										</div> -->
								<!-- <div class="col-sm-4">
											<div class="form-group">
												<label class="col-form-label" for="shade"><b>Shade</b> <span class="text-danger">*</span> </label> <select
													class="form-control" name="shade" id="shade">
													<option vlaue="">---SELECT---</option>
													<option vlaue="1">Multi</option>
												</select>
											</div>
										</div> -->
										<div class="col-sm-4 align-center-verticle" >
												<button class="btn btn-rounded btn-warning mb-3 cmbm-6vw" style="color:white;width:100%;" ng-click="addstepsmodal()"  style="width:100%;">Add</button>
										</div>		
									</div>

									<div class="table-responsive">
										<table id="steps_table" class="display min-w850">
											<thead>
												<tr>
													<th>Seq</th>
													<th>Type Name</th>
													<th>Step no</th>
													<th>Product Name</th>
													<th>Description</th>
													<th>Action</th>
												</tr>
											</thead>
											<tbody>
												<?php $k=0; ?>
											
											<tr ng-repeat="row in Steps">
													<td>@{{row.seqNo}}</td>
													<td>@{{row.TYPE_NAME}}</td>
													<td>@{{row.STEP_NO}}</td>
													<td>@{{row.PRODUCT_NAME}}</td>
													<td>@{{row.DESCRIPTION}}</td>
													<td>
														<div class="dropdown ml-auto text-right">
															<div class="btn-link" data-toggle="dropdown">
																<svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg>
															</div>
															<div class="dropdown-menu dropdown-menu-right">
																<a class="dropdown-item" ng-click="removestepmodal(@{{row.seqNo}})">Remove</a>
															</div>
														</div>
													</td>												
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
         		</div>
     </div>

			<div class="modal fade" id="RoutineTypeModal">
				<div class="modal-dialog modal-dialog-centered" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">Routine Type</h5>
							<button type="button" class="close" data-dismiss="modal">
								<span>&times;</span>
							</button>
						</div>
						<div class="modal-body">
						    <!-- <div class="row">
							   <div class="col-12">
								    <label><b>Parent /Sub<span class="required-field">*</span></b></label>
								    <select class="form-control" id="input_subcategory" ng-model="subSubCategory['C_1']"
									ng-options="item as item.name for item in subcategoryLov track by item.id">
			                        	<option value="">---SELECT---</option>
			                        </select>
							   </div>
							</div> -->
							<div class="row">
							   <div class="col-12">
							   <input type='hidden' name="routinetypeid" id="type_name_id" class="form-control" ng-model="routinetype['ID']" placeholder="Enter Name...">
							     <label><b>Enter Routine Type Name<span class="required-field">*</span></b></label>
							     <input  name="name" id="name" class="form-control" ng-model="routinetype['C_1']" placeholder="Enter Name...">
							   </div>
							</div>

						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-danger light" data-dismiss="modal">Close</button>
							<button type="button" class="btn btn-warning" ng-click="saveTypename()">Save changes</button>
						</div>
					</div>
				</div>
			</div>


			<div class="modal fade" id="RoutineTypeStepsModal">
				<div class="modal-dialog modal-dialog-centered" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">Routine Steps</h5>
							<button type="button" class="close" data-dismiss="modal">
								<span>&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<div class="row">
							   <div class="col-12">
								    <label><b>Choose Routine Type<span class="required-field">*</span></b></label>
								    <select class="form-control" id="input_subcategory" ng-model="product['P_7']"
									             ng-change="checksteps();"
									             ng-options="item as item.name for item in RoutineTypelov track by item.id">
			                        	<option value="">---SELECT---</option>
			                        </select>
							   </div>
							</div>

                             <div class="step_show" style="padding:15px;">
							 <h3 id="step_no" >Step#</h3>
                             </div>

							<div class="row step_show">
							   <div class="col-12">
								    <label><b>Choose Category <span class="required-field">*</span></b></label>
								    <select class="form-control" id="input_subcategory" ng-model="product['P_8']"
         									ng-change="getSubCategoriesWrtCategory();"
									         ng-options="item as item.name for item in categoryLov track by item.id">
			                        	<option value="">---SELECT---</option>
			                        </select>
							   </div>
							</div>

							<div class="row step_show">
							   <div class="col-12">
								    <label><b>Choose sub category<span class="required-field">*</span></b></label>
								    <select class="form-control" id="input_subcategory" ng-model="product['P_9']"
									ng-change="getSubSubCategoriesWrtCategory();"
									ng-options="item as item.name for item in subcategorylov track by item.id">
			                        	<option value="">---SELECT---</option>
			                        </select>
							   </div>
							</div>

                           <div class="row step_show">
							<div class="col-sm-12">
							<input type="hidden" name="step_no" id="name" class="form-control" ng-model="product['P_13']" placeholder="Enter description...">

								 <div class="form-group">
									 <label class="col-form-label" for="sub_sub_category"><b>Sub Sub Category</b> <span class="text-danger">*</span> </label>
										 <select class="form-control" id="p10" ng-model="product['P_10']"
										 ng-change="getproductswrtsubcategory();"
											 ng-options="item as item.name for item in subsubcategorylov track by item.id">
										        <option value="">---SELECT---</option>
										                        </select>
															</div>
														</div>
                                                     </div>
							<div class="row step_show">
							   <div class="col-12">
								    <label><b>Choose Product<span class="required-field">*</span></b></label>
								    <select class="form-control" id="input_subcategory" ng-model="product['P_11']"
									ng-options="item as item.name for item in productlov track by item.id">
			                        	<option value="">---SELECT---</option>
			                        </select>
							   </div>
							</div>


							<div class="row step_show">
							   <div class="col-12">
							     <label><b>Enter steps description<span class="required-field">*</span></b></label>
							     <input name="steps_description" id="name" class="form-control" ng-model="product['P_12']" placeholder="Enter description...">
							   </div>
							</div>

						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-danger light" data-dismiss="modal">Close</button>
							<button type="button" class="btn btn-warning" ng-click="addstep()">Save changes</button>
						</div>
					</div>
				</div>
			</div>

		
            
            <div class="modal fade" id="alertsteps">
				<div class="modal-dialog" role="document">
					<div class="modal-content align-center-verticle">
						<div class="modal-header" style="border:unset;">
							<h3 class="modal-title">Alert</h3>
						</div>
						<div class="modal-body">
                           <h4 style="text-align: center;">Are you Sure you want to delete this step</h4>
                        </div>
						<input type="hidden" id="step_remove_id" >
						<div class="modal-footer" style="border-top: unset !important;">
							<button type="button" class="btn btn-danger light" style="cursor:pointer;" ng-click="closealertDeleteModal('alertsteps')">Close</button>
							<button type="button" class="btn btn-primary" style="cursor:pointer;" ng-click="removestep()">Yes</button>
						</div>
					</div>
				</div>
			</div>
                 
			<div class="modal fade" id="alertroutinetypemodal">
				<div class="modal-dialog" role="document">
					<div class="modal-content align-center-verticle">
						<div class="modal-header" style="border:unset;">
							<h3 class="modal-title">Alert</h3>
						</div>
						<input type="hidden" id="routine_type_remove_id" >
						<div class="modal-body">
                           <h4 style="text-align: center;">Are you Sure you want to delete this routine type with all of its Steps</h4>
                        </div>
						<div class="modal-footer" style="border-top: unset !important;">
							<button type="button" class="btn btn-danger light" style="cursor:pointer;" ng-click="closealertDeleteModal('alertroutinetypemodal')">Close</button>
							<button type="button" class="btn btn-primary" style="cursor:pointer;" ng-click="remove_routine_type_name()">Yes</button>
						</div>
					</div>
				</div>
			</div>

		<div class="modal fade" id="alertroutinemodal">
				<div class="modal-dialog" role="document">
					<div class="modal-content align-center-verticle">
						<div class="modal-header" style="border:unset;">
							<h3 class="modal-title">Alert</h3>
						</div>
						<input type="hidden" id="routine_remove_id" >
						<div class="modal-body">
                           <h4 style="text-align: center;">Are you Sure you want to delete all the routine Contents</h4>
                        </div>
						<div class="modal-footer" style="border-top: unset !important;">
							<button type="button" class="btn btn-danger light" style="cursor:pointer;" ng-click="closealertDeleteModal('alertroutinemodal')">Close</button>
							<button type="button" class="btn btn-primary" style="cursor:pointer;" ng-click="remove_routine()">Yes</button>
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
    
    <script src="{{ url('/assets-admin') }}/customjs/script_adminroutine_new.js?v={{time()}}"></script>
    
	<script>

    function form1(){
    	$("#uploadattl").click();
    }
    
	
    </script>