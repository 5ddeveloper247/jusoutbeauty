@include('admin.admin-header');
<script>
var userId = <?php echo session('userId');?>;
var site = '<?php echo session('site');?>';
var baseurl = "<?php echo url('/assets-admin');?>";
var optionId = '2';
</script>
	<div ng-app="project1">
        <!--**********************************
            Content body start
        ***********************************-->

        <div class="content-body" ng-controller="projectinfo1">
            <div class="container-fluid pt-0" >
                <!-- row -->
                <div class="row mb-3">
                   <div class="col-10">
                		<div class="page-titles pt-0 pb-0 mb-0">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="javascript:void(0)">Shade Finder Quiz</a></li>
							</ol>
		                </div>
                	</div>
                </div>

				<div class="row">
					<div class="col-xl-12 col-xxl-12">
						<div class="card">
							<div class="card-header">
								<h4 class="card-title">Options Info</h4>
							</div>
							<div class="card-body">

								<div class="form-validation">
									<form class="form-valide">
										<div class="row">
											<div class="col-sm-5">
												<div class="form-group">

													<label class="col-form-label" for="title"><b>Title</b>  <span class="text-danger">*</span>  </label>
													<input type="text" class="form-control" id="title" ng-model="option['P_1']" disabled>

												</div>
											</div>
											<div class="col-sm-5">
												<div class="form-group">

													<label class="col-form-label" for="caption"><b>Caption</b> </label>
													<input type="text" class="form-control" id="caption" ng-model="option['P_2']" placeholder="Enter Caption">

												</div>
											</div>
											<div class="col-sm-2 pt-4">
						                       <a type="button" class="btn btn-rounded btn-warning admin-view-add mt-2" ng-click="saveOptionInfo();">Save Option</a>
						                   	</div>
										</div>

									</form>

								</div>

							</div>
							<div class="card mt-4">
								<div class="card-header">
									<h4 class="card-title">Level One Info</h4>
								</div>
								<div class="card-body">
									<div class="form-validation">
										<div class="row">
											<div class="col-sm-10">
												<div class="form-group">
													<label class="col-form-label" for="title"><b>Title Question</b>  <span class="text-danger">*</span>  </label>
													<input type="text" class="form-control" id="L1_1" ng-model="level1['L_1']" placeholder="Enter Title">
												</div>
											</div>
											<div class="col-sm-2 pt-4">
						                       <a type="button" class="btn btn-rounded btn-warning admin-view-add mt-2" ng-click="saveShadeFinderLevel1Info();">Save Level Info</a>
						                   	</div>
										</div>

									</div>

								</div>
								<div class="card mb-0">
									<div class="card-body">
			                            <div class="row">
											<div class="col-sm-12">
					                      	 	<a type="button" class="btn btn-rounded btn-warning admin-view-add mb-4" ng-click="addNewLevel1Type();">Add New Level 1 Type</a>
						                   	</div>
										</div>
										<div class="form-validation" id="addLevelOneLines_container" style="display:none;">
											<div class="row">
												<div class="col-sm-12">
													<div class="form-group">
														<label class="col-form-label" for="title"><b>Title</b>  <span class="text-danger">*</span>  </label>
														<input type="text" class="form-control" id="L1_1" ng-model="level1Type['LT_1']" placeholder="Enter Title">
													</div>
												</div>
												<div class="col-sm-6 d-none">
                                                	<div class="form-group">
                                                    	<label class="col-form-label" for="category"><b>Primary Product<span class="text-danger">*</span></b> </label>
                                                      	<select class="default-placeholder" id="LT2"  multiple ng-model="level1Type['LT_2']"
															ng-options="item as item.name for item in productsLov track by item.id">
                                                        </select>
                                                    </div>
                                              	</div>
                                              	<div class="col-sm-6 d-none">
                                                	<div class="form-group">
                                                    	<label class="col-form-label" for="category"><b>Recommanded Product<span class="text-danger">*</span></b> </label>
                                                      	<select class="default-placeholder" id="LT3"  multiple ng-model="level1Type['LT_3']"
															ng-options="item as item.name for item in productsLov track by item.id">
                                                        </select>
                                                    </div>
                                              	</div>
												<div class="col-sm-12">
													<div class="summernote" id="levelType_description"></div>
												</div>


												<div class="col-sm-12 col-12 register-new-product-picture-para-box ml-3">
													<div class="row register-new-product-picture-para">
														<div class="col-sm-2 image-overlay upload-photo-box" id="imageAttach-btn" onclick="form1();" style="">
															<img src="{{ url('/assets-admin') }}/images/admin/upload.svg" alt="" width="50">
															<p>Min : 200 X 300</p>
														</div>
														<div class="col-sm-9">
															<div class="row" id="p_att">

															</div>
														</div>
														<form class="" id="uploadattch" method="POST" action="uploadshadeFinderTypeImage" enctype="multipart/form-data">
															<input type="hidden" name="_method" value="POST">
		           											{{ csrf_field() }}
		           											<input type="hidden" id="userId" name="userId" value="<?php echo session('userId');?>">
															<input type="hidden" id="sourceId" name="sourceId" value="@{{level1Type.ID}}">
															<input type="hidden" id="sourceCode" name="sourceCode" value="SHADE_FINDER_TYPE_IMAGE">
															<input type="file" id="uploadattl" name="uploadattl" class="file-input"  style="display: none;"  multiple accept="images/*"><!-- accept="image/*" -->
														</form>

													</div>
												</div>
												<div class="col-sm-12 text-right mb-4 mb-2">
			                                        <button class="btn btn-primary btn-sl-sm mr-2" type="button" ng-click="saveShadeFinderLevel1TypeInfo();"><span class="mr-2"><i class="fa fa-paper-plane"></i></span>Save</button>
			                                        <a href="javascript:;" class="btn btn-danger light btn-sl-sm" ng-click="closeAddNewLevel1Type();"><span class="mr-2"><i class="fa fa-times" aria-hidden="true"></i></span>Close</a>
			                                    </div>

											</div>
										</div>
		                                <div class="table-responsive">
		                                    <table id="levelOneTypesTable" class="display min-w850">
		                                        <thead>
		                                            <tr>
		                                                <th>Seq</th>
		                                                <th>Title</th>
		                                                <th>Description</th>
		                                                <th>Action</th>
		                                            </tr>
		                                        </thead>
		                                        <tbody>
		                                            <tr ng-repeat="row in displayCollection">
		                                                <td>@{{row.seqNo}}</td>
		                                                <td>@{{row.TITLE}}</td>
		                                                <td>@{{row.DESCRIPTION_TEXT}}</td>
		                                                <td>
															<div class="dropdown ml-auto text-right">
																<div class="btn-link" data-toggle="dropdown">
																	<svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg>
																</div>
																<div class="dropdown-menu dropdown-menu-right">
																	<a class="dropdown-item"  href="javascript:;" ng-click="continueRecordLevel1Type(@{{row.LEVEL_ONE_TYPE_ID}});">Edit</a>
																	<a class="dropdown-item"  href="javascript:;" ng-click="confirmDeleteLevel1TypeForNo(@{{row.LEVEL_ONE_TYPE_ID}});">Delete</a>
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

							<div class="card mb-0 mt-0">
								<div class="card-header">
									<h4 class="card-title">Level Two Info</h4>
								</div>
								<div class="card-body">
									<div class="form-validation">
										<div class="row">
											<div class="col-sm-10">
												<div class="form-group">
													<label class="col-form-label" for="title"><b>Title Question</b>  <span class="text-danger">*</span>  </label>
													<input type="text" class="form-control" id="L2_1" ng-model="level2['L_1']" placeholder="Enter Title">
												</div>
											</div>
											<div class="col-sm-2 pt-4">
						                       <a type="button" class="btn btn-rounded btn-warning admin-view-add mt-2" ng-click="saveShadeFinderLevel2Info();">Save Level Info</a>
						                   	</div>
										</div>

									</div>

								</div>
								<div class="card">
									<div class="card-body">
			                            <div class="row">
											<div class="col-sm-12">
					                      	 	<a type="button" class="btn btn-rounded btn-warning admin-view-add mb-4" ng-click="addNewLevel2Type();">Add New Level 2 Type</a>
						                   	</div>
										</div>
										<div class="form-validation" id="addLevelTwoLines_container" style="display:none;">
											<div class="row">

												<div class="col-sm-6">
													<div class="form-group">
														<label class="col-form-label" for="title"><b>Title</b>  <span class="text-danger">*</span>  </label>
														<input type="text" class="form-control" id="LT2_1" ng-model="level2Type['LT_1']" placeholder="Enter Title">
													</div>
												</div>
												<div class="col-sm-6">
                                                	<div class="form-group">
                                                    	<label class="col-form-label" for="L2_2"><b>Level One Type<span class="text-danger">*</span></b> </label>
                                                      	<select class="default-placeholder" id="LT2_2" ng-model="level2Type['LT_2']"
															ng-options="item as item.name for item in levelOneTypeLov track by item.id">
															<option value="">Choose</option>
                                                        </select>
                                                    </div>
                                              	</div>
												<div class="col-sm-12">
													<div class="summernote" id="level2Type_description"></div>
												</div>



												<div class="col-sm-12 text-right mb-4 mb-2">
			                                        <button class="btn btn-primary btn-sl-sm mr-2" type="button" ng-click="saveShadeFinderLevel2TypeInfo();"><span class="mr-2"><i class="fa fa-paper-plane"></i></span>Save</button>
			                                        <a href="javascript:;" class="btn btn-danger light btn-sl-sm" ng-click="closeAddNewLevel2Type();"><span class="mr-2"><i class="fa fa-times" aria-hidden="true"></i></span>Close</a>
			                                    </div>

											</div>
										</div>
		                                <div class="table-responsive">
		                                    <table id="levelTwoTypesTable" class="display min-w850">
		                                        <thead>
		                                            <tr>
		                                                <th>Seq</th>
		                                                <th>Title</th>
		                                                <th>Level One Type</th>
		                                                <th>Action</th>
		                                            </tr>
		                                        </thead>
		                                        <tbody>
		                                            <tr ng-repeat="row in displayCollectionLevelTwoType">
		                                                <td>@{{row.seqNo}}</td>
		                                                <td>@{{row.TITLE}}</td>
		                                                <td>@{{row.LEVEL_ONE_TYPE_TITLE}}</td>
		                                                <td>
															<div class="dropdown ml-auto text-right">
																<div class="btn-link" data-toggle="dropdown">
																	<svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg>
																</div>
																<div class="dropdown-menu dropdown-menu-right">
																	<a class="dropdown-item"  href="javascript:;" ng-click="continueRecordLevel2Type(@{{row.LEVEL_TWO_TYPE_ID}});">Edit</a>
																	<a class="dropdown-item"  href="javascript:;" ng-click="confirmdeleteRecordLevel2Type(@{{row.LEVEL_TWO_TYPE_ID}});">Delete</a>
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

							<div class="card mb-0 mt-0">
								<div class="card-header">
									<h4 class="card-title">Level Three Info</h4>
								</div>
								<div class="card-body">
									<div class="form-validation">
										<div class="row">
											<div class="col-sm-10">
												<div class="form-group">
													<label class="col-form-label" for="title"><b>Title Question</b>  <span class="text-danger">*</span>  </label>
													<input type="text" class="form-control" id="L3_1" ng-model="level3['L_1']" placeholder="Enter Title">
												</div>
											</div>
											<div class="col-sm-2 pt-4">
						                       <a type="button" class="btn btn-rounded btn-warning admin-view-add mt-2" ng-click="saveShadeFinderLevel3Info();">Save Level Info</a>
						                   	</div>
										</div>

									</div>

								</div>
								<div class="card">
									<div class="card-body">
			                            <div class="row">
											<div class="col-sm-12">
					                      	 	<a type="button" class="btn btn-rounded btn-warning admin-view-add mb-4" ng-click="addNewLevel3Type();">Add New Level 3 Type</a>
						                   	</div>
										</div>
										<div class="form-validation" id="addLevelThreeLines_container" style="display:none;">
											<div class="row">

												<div class="col-sm-6">
													<div class="form-group">
														<label class="col-form-label" for="title"><b>Title</b>  <span class="text-danger">*</span>  </label>
														<input type="text" class="form-control" id="LT3_1" ng-model="level3Type['LT_1']" placeholder="Enter Title">
													</div>
												</div>
												<div class="col-sm-6">
                                                	<div class="form-group">
                                                    	<label class="col-form-label" for="L2_2"><b>Level Two Type<span class="text-danger">*</span></b> </label>
                                                      	<select class="default-placeholder" id="LT3_2" ng-model="level3Type['LT_2']"
															ng-options="item as item.name for item in levelTwoTypeLov track by item.id">
															<option value="">Choose</option>
                                                        </select>
                                                    </div>
                                              	</div>
                                              	<div class="col-sm-6">
                                                	<div class="form-group">
                                                    	<label class="col-form-label" for="category"><b>Primary Product<span class="text-danger">*</span></b> </label>
                                                      	<select class="default-placeholder" id="LT3_3"  multiple ng-model="level3Type['LT_3']"
															ng-options="item as item.name for item in productsLov track by item.id">
                                                        </select>
                                                    </div>
                                              	</div>
                                              	<div class="col-sm-6">
                                                	<div class="form-group">
                                                    	<label class="col-form-label" for="category"><b>Recommanded Product<span class="text-danger">*</span></b> </label>
                                                      	<select class="default-placeholder" id="LT3_4"  multiple ng-model="level3Type['LT_4']"
															ng-options="item as item.name for item in productsLov track by item.id">
                                                        </select>
                                                    </div>
                                              	</div>

												<div class="col-sm-12">
													<div class="summernote" id="level3Type_description"></div>
												</div>



												<div class="col-sm-12 text-right mb-4 mb-2">
			                                        <button class="btn btn-primary btn-sl-sm mr-2" type="button" ng-click="saveShadeFinderLevel3TypeInfo();"><span class="mr-2"><i class="fa fa-paper-plane"></i></span>Save</button>
			                                        <a href="javascript:;" class="btn btn-danger light btn-sl-sm" ng-click="closeAddNewLevel3Type();"><span class="mr-2"><i class="fa fa-times" aria-hidden="true"></i></span>Close</a>
			                                    </div>

											</div>
										</div>
		                                <div class="table-responsive">
		                                    <table id="levelThreeTypesTable" class="display min-w850">
		                                        <thead>
		                                            <tr>
		                                                <th>Seq</th>
		                                                <th>Title</th>
		                                                <th>Level Two Type</th>
		                                                <th>Action</th>
		                                            </tr>
		                                        </thead>
		                                        <tbody>
		                                            <tr ng-repeat="row in displayCollectionLevelThreeType">
		                                                <td>@{{row.seqNo}}</td>
		                                                <td>@{{row.TITLE}}</td>
		                                                <td>@{{row.LEVEL_TWO_TYPE_TITLE}}</td>
		                                                <td>
															<div class="dropdown ml-auto text-right">
																<div class="btn-link" data-toggle="dropdown">
																	<svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg>
																</div>
																<div class="dropdown-menu dropdown-menu-right">
																	<a class="dropdown-item"  href="javascript:;" ng-click="continueRecordLevel3Type(@{{row.LEVEL_THREE_TYPE_ID}});">Edit</a>
																	<a class="dropdown-item"  href="javascript:;" ng-click="confirmdeleteRecordLevel3Type(@{{row.LEVEL_THREE_TYPE_ID}});">Delete</a>
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

            <div class="modal fade" id="alertDelLevel1Record">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">

                        <div class="modal-body">
                           <h4 style="text-align: center;">Are Your sure to delete ?</h4>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger light"
                                data-dismiss="modal" ng-click='closeDeleteConfirmModal()'>No</button>
                            <button type="button" class="btn btn-primary" ng-click="deleteRecordLevel1Type()">Yes</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="alertDelLevel2Record">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">

                        <div class="modal-body">
                           <h4 style="text-align: center;">Are Your sure to delete ?</h4>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger light"
                                data-dismiss="modal" ng-click='closeDeleteConfirmModal()'>No</button>
                            <button type="button" class="btn btn-primary" ng-click="deleteRecordLevel2Type()">Yes</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="alertDelLevel3Record">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">

                        <div class="modal-body">
                           <h4 style="text-align: center;">Are Your sure to delete This?</h4>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger light"
                                data-dismiss="modal" ng-click='closeDeleteConfirmModal()'>No</button>
                            <button type="button" class="btn btn-primary" ng-click="deleteRecordLevel3Type()">Yes</button>
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

    <script src="{{ url('/assets-admin') }}/customjs/script_adminshadefinder.js?v={{time()}}"></script>

    <script>

	    function form1(){
	    	$("#uploadattl").click();
	    }
	</script>
