@include('admin.admin-header');
<script>
var userId = <?php echo session('userId');?>;
var ingredientId = "<?php echo $ingredientId ?>";
var site = '<?php echo session('site');?>';
var baseurl = "<?php echo url('/assets-admin');?>";
</script>
	<div ng-app="project1">
 <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body" ng-controller="projectinfo1">
            <div class="container-fluid">
                <div class="page-titles">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="javascript:void(0)">Ingredients</a></li>
						<li class="breadcrumb-item active"><a href="javascript:void(0)">Process</a></li>
					</ol>
                </div>
                <!-- row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Ingredient</h4>
                            </div>
                            <div class="card-body">
                                <div class="form-validation">
									<form class="form-valide">
										<div class="row">
											<div class="col-sm-5">
												<div class="form-group">

													<label class="col-form-label" for="Title"><b>Title</b> <span class="text-danger">*</span> </label> 
													<input type="text" class="form-control" id="title" ng-model="ingredient['P_1']" placeholder="Enter a Title...">

												</div>
											</div>
											<div class="col-sm-5">
												<div class="form-group">

													<label class="col-form-label" for="quantity_in_stock"><b>Quantity
														In Stock</b> <span class="text-danger">*</span>
													</label><br>
													 <input type="number" class="form-control" ng-model="ingredient['P_2']" id="quantity_in_stock" placeholder="Quantity">

												</div>
											</div>
											<div class="col-sm-5">
												<div class="form-group">
        										    <label class="col-form-label" for="category"><b>Category</b> <span class="text-danger">*</span> </label><br>
        											<select class="form-control" ng-model="ingredient['P_3']">
        												<option value="">Choose</option>
        											   <option value="Formulated">Formulated</option>
        											   <option value="Percent">Percent</option>
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
                                        <h5 class="mb-4"><i class="fa fa-paperclip"></i> Attatchment</h5>
                                        
                                        <div class="col-sm-12 col-12 register-new-product-picture-para-box">
											<div class="row register-new-product-picture-para">
												<div class="col-sm-2 image-overlay upload-photo-box" id="imageAttach-btn" onclick="form1();" style="">
													<img src="{{ url('/assets-admin') }}/images/admin/upload.svg" alt="" width="50">
													<p>Upload Photo</p>
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
                                        <button class="btn btn-primary btn-sl-sm mr-2" type="button" ng-click="saveIngredient();"><span class="mr-2"><i class="fa fa-paper-plane"></i></span>Save</button>
                                        <a href="{{session('site')}}/view-ingredients" class="btn btn-danger light btn-sl-sm"><span class="mr-2"><i class="fa fa-times" aria-hidden="true"></i></span>Discard</a>
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
        <!--**********************************
            Content body end
        ***********************************-->

       

    </div>
    @include('admin.admin-footer');
    
   
		
    <script src="{{ url('/assets-admin') }}/customjs/script_adminingredients.js?v={{time()}}"></script>
    
    <script>

    function form1(){
    	$("#uploadattl").click();
    }
    
	
    </script>
    