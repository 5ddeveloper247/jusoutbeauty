@include('admin.admin-header');
<script>
var userId = '<?php echo session('userId');?>';
var site = '<?php echo session('site');?>';
</script>
    <div ng-app="project1">
        <!--**********************************
            Content body start
        ***********************************-->

        <div class="content-body" ng-controller="projectinfo1">
            <div class="container-fluid pt-0">

                <!-- row -->


				<div class="row">
					<div class="col-md-6">
						<div class="page-titles pt-0 pb-0 mb-0">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="javascript:void(0)">Categories</a></li>
								<li class="breadcrumb-item active"><a href="javascript:void(0)">View All</a></li>
							</ol>
		                </div>
					</div>
					{{-- <div class="col-3 row">
                        <div class="col-12">
                            <button type="button" class="btn btn-rounded btn-warning mb-3 btn-sm-block" ng-click="addNewCat()">Add Product Category</button>
                        </div>
					</div> --}}
                    <div class="col-md-6">
                        <div class="row">
                          <div class="col-12">
                            <button type="button" class="btn btn-rounded btn-warning mb-3 float-right" ng-click="addNewCat()">Add Product Category</button>
                          </div>
                        </div>
                      </div>

				</div>
				<div class="row">

					<div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Product Categories</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="categoryTable" class="display min-w850">
                                        <thead>
                                            <tr>
                                                <!-- <th>
													<div class="custom-control custom-checkbox">
														<input type="checkbox" class="custom-control-input" id="checkAll" required="">
														<label class="custom-control-label" for="checkAll"></label>
													</div>
												</th>-->
                                                <th class="text-center">ID</th>
                                                <th class="text-center">Category Name</th>
                                                <!-- <th>Parent</th> -->
                                                <th class="text-center">Status</th>
                                                <th class="text-right">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tableContents">
                                            <tr ng-repeat="row in displayCollectionCategory" class="row1 text-center" data-seq="@{{row.SEQ_NUM}}" data-id="@{{row.CATEGORY_ID}}">
                                                <td>@{{row.seqNo}}</td>
                                                <td>@{{row.NAME}}</td>
                                                <!-- <td>Category</td> -->
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
															<svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"> <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"> <rect x="0" y="0" width="24" height="24"></rect> <circle fill="#000000" cx="5" cy="12" r="2"></circle> <circle fill="#000000" cx="12" cy="12" r="2"></circle> <circle fill="#000000" cx="19" cy="12" r="2"></circle> </g> </svg>
														</div>
														<div class="dropdown-menu dropdown-menu-right">
															<a class="dropdown-item" href="javascript:;" ng-click="statusChange(@{{row.CATEGORY_ID}});" ng-if="row.STATUS != 'active'">Active</a>
															<a class="dropdown-item" href="javascript:;" ng-click="statusChange(@{{row.CATEGORY_ID}});" ng-if="row.STATUS == 'active'">InActive</a>
															<a class="dropdown-item" href="javascript:;" ng-click="continouRecord(@{{row.CATEGORY_ID}});">Edit</a>
															<a class="dropdown-item" href="javascript:;" ng-click="deleteCategoryModel(@{{row.CATEGORY_ID}});">Delete</a>
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

            <div class="col-12 pt-0">
               	<div class="row">
					<div class="col-12">
						<button type="button" class="btn btn-rounded btn-warning mb-3 float-right" ng-click="addNewSubCat()">Add Product Sub Category</button>
					</div>
				</div>
				<div class="row">

					<div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Product Sub Categories</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="subCategoryTable" class="display min-w850">
                                        <thead>
                                            <tr class="text-center">

                                                <th>ID</th>
                                                <th>Product Sub Category</th>
                                                <th>Product Category</th>
                                                <th>Status</th>
                                                <th class="text-right">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="subCategoryTableContents">

                                            <tr ng-repeat="row in displayCollectionSubCategory" class="row2 text-center" data-seq="@{{row.SEQ_NUM}}" data-id="@{{row.SUB_CATEGORY_ID}}">
                                                <td>@{{row.seqNo}}</td>
                                                <td>@{{row.NAME}}</td>
												<td>@{{ row.CATEGORY_NAME}}</td>
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
															<a class="dropdown-item" href="javascript:;" ng-click="statusChangeSubCat(@{{row.SUB_CATEGORY_ID}});" ng-if="row.STATUS != 'active'">Active</a>
															<a class="dropdown-item" href="javascript:;" ng-click="statusChangeSubCat(@{{row.SUB_CATEGORY_ID}});" ng-if="row.STATUS == 'active'">InActive</a>
															<a class="dropdown-item" href="javascript:;" ng-click="continouRecordSubCate(@{{row.SUB_CATEGORY_ID}});">Edit</a>
															<a class="dropdown-item" href="javascript:;" ng-click="deleteSubSubCategoryModel(@{{row.SUB_CATEGORY_ID}},2);">Delete</a>
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
            <div class="col-12 pt-0">
               	<div class="row">
					<div class="col-12">
						<button type="button" class="btn btn-rounded btn-warning float-right mb-3" ng-click="addNewSubSubCat()">Add Product Sub Sub Category</button>
					</div>
				</div>
				<div class="row">

					<div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Product Sub Sub Categories</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="subSubCategoryTable" class="display min-w850">
                                        <thead>
                                            <tr class="text-center">
                                                <th>ID</th>
                                                <th>Product Sub Sub Category Name</th>
                                                <th>Product Sub Category</th>
                                                <th>Status</th>
                                                <th class="text-right">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="subSubCategoryTableContents">

                                            <tr ng-repeat="row in displayCollectionSubSubCategory" class="row3 text-center" data-seq="@{{row.SEQ_NUM}}" data-id="@{{row.SUB_SUB_CATEGORY_ID}}">
                                                <td>@{{row.seqNo}}</td>
                                                <td>@{{row.NAME}}</td>
												<td>@{{row.SUB_CATEGORY_NAME}}</td>
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
															<a class="dropdown-item" href="javascript:;" ng-click="statusChangeSubSubCat(@{{row.SUB_SUB_CATEGORY_ID}});" ng-if="row.STATUS != 'active'">Active</a>
															<a class="dropdown-item" href="javascript:;" ng-click="statusChangeSubSubCat(@{{row.SUB_SUB_CATEGORY_ID}});" ng-if="row.STATUS == 'active'">InActive</a>
															<a class="dropdown-item" href="javascript:;" ng-click="continouRecordSubSubCate(@{{row.SUB_SUB_CATEGORY_ID}});">Edit</a>
															<a class="dropdown-item" href="javascript:;" ng-click="deleteSubSubCategoryModel(@{{row.SUB_SUB_CATEGORY_ID}},3);">Delete</a>
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

			<div class="modal fade" id="subSubCategoryModal">
				<div class="modal-dialog modal-dialog-centered" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">Product Sub Sub Category</h5>
							<button type="button" class="close" data-dismiss="modal">
								<span>&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<div class="row">
							   <div class="col-12">
								    <label><b>Product SubCategory<span class="required-field">*</span></b></label>
								    <select class="form-control" id="input_subcategory" ng-model="subSubCategory['C_1']"
										ng-options="item as item.name for item in subcategoryLov track by item.id">
			                        	<option value="">---SELECT---</option>
			                        </select>
							   </div>
							</div>
							<div class="row">
							   <div class="col-12">
							     <label><b>Enter Product Sub Sub Category Name<span class="required-field">*</span></b></label>
							     <input name="name" id="name" class="form-control" ng-model="subSubCategory['C_2']" placeholder="Enter Product Sub Sub Category Name...">
							   </div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-danger light" data-dismiss="modal">Close</button>
							<button type="button" class="btn btn-warning" ng-click="saveSubSubCategory();">Save changes</button>
						</div>
					</div>
				</div>
			</div>
            <div class="modal fade" id="subCategoryModal">
				<div class="modal-dialog modal-dialog-centered" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">Product Sub Category</h5>
							<button type="button" class="close" data-dismiss="modal">
								<span>&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<div class="row">
							   <div class="col-12">
								    <label><b>Product Category<span class="required-field">*</span></b></label>
								    <select class="form-control" id="input_category" ng-model="subCategory['C_1']"
										ng-options="item as item.name for item in categoryLov track by item.id">
			                        	<option value="">---SELECT---</option>
			                        </select>
							   </div>
							</div>

							<div class="row">
							   <div class="col-12">
							     <label><b>Enter Product Sub Category Name<span class="required-field">*</span></b></label>
							     <input name="name" id="name" class="form-control" ng-model="subCategory['C_2']" placeholder="Enter Product Sub Category Name...">
							   </div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-danger light" data-dismiss="modal">Close</button>
							<button type="button" class="btn btn-warning" ng-click="saveSubCategory();">Save changes</button>
						</div>
					</div>
				</div>
			</div>

			<div class="modal fade" id="categoryModal">
				<div class="modal-dialog modal-dialog-centered" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">Product Category</h5>
							<button type="button" class="close" data-dismiss="modal">
								<span>&times;</span>
							</button>
						</div>
						<div class="modal-body">

							<div class="row">
							   <div class="col-12">
							     <label><b>Enter Category Name<span class="required-field">*</span></b></label>
							     <input name="name" id="name" class="form-control" ng-model="category['C_1']" placeholder="Enter  Category Name...">
							   </div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-danger light" data-dismiss="modal">Close</button>
							<button type="button" class="btn btn-warning" ng-click="saveCategory()">Save changes</button>
						</div>
					</div>
				</div>
			</div>

			<div class="modal fade" id="alertDel">
				<div class="modal-dialog" role="document">
					<div class="modal-content align-center-verticle">
						<div class="modal-header" style="border:unset;">
							<h3 class="modal-title">Alert</h3>
						</div>
						<div class="modal-body">
                           <h4 style="text-align: center;">@{{alertDeleteMsg}}</h4>
                        </div>
						<div class="modal-footer" style="border-top: unset !important;">
							<button type="button" class="btn btn-danger light" ng-click="closealertDeleteModal();">Close</button>
<!-- 							<button type="button" class="btn btn-primary">Yes</button> -->
						</div>
					</div>
				</div>
			</div>

			<div class="modal fade" id="alertDelSubSubCate">
				<div class="modal-dialog" role="document">
					<div class="modal-content">

						<div class="modal-body">
                           <h4 style="text-align: center;">Are Your sure to delete this ?</h4>
                        </div>
						<div class="modal-footer">
							<button type="button" class="btn btn-danger light"
								data-dismiss="modal">No</button>
							<button type="button" class="btn btn-primary" ng-click="deleteSubSubCategoryRecord()">Yes</button>
						</div>
					</div>
				</div>
			</div>

			<div class="modal fade" id="alertDelCate">
				<div class="modal-dialog" role="document">
					<div class="modal-content">

						<div class="modal-body">
                           <h4 style="text-align: center;">Are Your sure to delete this ?</h4>
                        </div>
						<div class="modal-footer">
							<button type="button" class="btn btn-danger light"
								data-dismiss="modal">No</button>
							<button type="button" class="btn btn-primary" ng-click="deleteCategoryRecord()">Yes</button>
						</div>
					</div>
				</div>
			</div>

			<div class="modal fade" id="alertDelSubCate">
				<div class="modal-dialog" role="document">
					<div class="modal-content">

						<div class="modal-body">
                           <h4 style="text-align: center;">Are Your sure to delete this ?</h4>
                        </div>
						<div class="modal-footer">
							<button type="button" class="btn btn-danger light"
								data-dismiss="modal">No</button>
							<button type="button" class="btn btn-primary" ng-click="deleteSubSubCategoryRecord()">Yes</button>
						</div>
					</div>
				</div>
			</div>

			<div class="modal fade" id="alertDelWithproductName">
				<div class="modal-dialog" role="document">
					<div class="modal-content">

						<div class="modal-body">
                           <h4 style="text-align: center;">This Category Has Products </h4>
						   <p style="text-align: center;"> <a style="color: #8743DF;" href="" ng-click= "clickToSee()">Click Here</a> to See Product Name</p>

						   <div class="row" id="show_products" style="display:none">
							{{-- <ol type="1">
								<li ng-repeat="row in displayCollectionProductsName track by $index">@{{ row }}</li>
							</ol> --}}
							<table border = "1">
								<tr ng-repeat="row in displayCollectionProductsName track by $index">
								   <td style="padding: 10px;">@{{ row }}</td>
								</tr>


							 </table>

						   </div>
                        </div>
						<div class="modal-footer">
							<button type="button" class="btn btn-danger light"
								data-dismiss="modal">Close</button>
							{{-- <button type="button" class="btn btn-primary" ng-click="deleteSubSubCategoryRecord()">Yes</button> --}}
						</div>
					</div>
				</div>
			</div>

        </div>

		<!--**********************************
            Content body end
        ***********************************-->

    </div>
    <!--**********************************
            Footer start
        ***********************************-->

	@include('admin.admin-footer');

	<script type="text/javascript" src="https://cdn.datatables.net/rowreorder/1.3.3/js/dataTables.rowReorder.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
	<script src="{{ url('/assets-admin') }}/customjs/script_admincategory.js?v={{time()}}"></script>

	<script type="text/javascript">
    	function addSubCategory(){
          	$('#exampleModalCenter').modal("show");

       	}
       	function addCategory(){
          	$('#exampleModalCenter2').modal("show");
       	}

//        	var table = $('#categoryTable').DataTable();

    </script>
