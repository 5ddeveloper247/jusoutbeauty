@include('admin.admin-header');
<script>
var userId = <?php echo session('userId');?>;
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
					<div class="col-10">
						<div class="page-titles pt-0 pb-0 mb-0">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="javascript:void(0)">Routine Types</a></li>
								<li class="breadcrumb-item active"><a href="javascript:void(0)">View All</a></li>
							</ol>
		                </div>
					</div>
					<div class="col-2">
						<button type="button" class="btn btn-rounded btn-warning admin-view-add mb-3" ng-click="addNewType()">Add Routine</button>
					</div>
				</div>
				<div class="row">
                    
					<div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Routine Categories</h4>
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
                                                <th>ID</th>
                                                <th>Routine name</th>
												<th>Routine Category</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr ng-repeat="row in displayCollectionCategory">
                                                <td>@{{row.seqNo}}</td>
                                                <td>@{{row.NAME}}</td>
												<td ng-if="row.IDENTIFY == '1'">Routine by needs</td>
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
															<svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"> <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"> <rect x="0" y="0" width="24" height="24"></rect> <circle fill="#000000" cx="5" cy="12" r="2"></circle> <circle fill="#000000" cx="12" cy="12" r="2"></circle> <circle fill="#000000" cx="19" cy="12" r="2"></circle> </g> </svg>
														</div>
														<div class="dropdown-menu dropdown-menu-right">
															<a class="dropdown-item" href="javascript:;" ng-click="statusChange(@{{row.seqNo}});" ng-if="row.STATUS != 'active'">Active</a>
															<a class="dropdown-item" href="javascript:;" ng-click="statusChange(@{{row.seqNo}});" ng-if="row.STATUS == 'active'">InActive</a>
															<a class="dropdown-item" href="javascript:;" ng-click="continouRecord(@{{row.seqNo}});">Edit</a>
															<a class="dropdown-item" href="javascript:;" ng-click="deleteRoutineTypeRecord(@{{row.seqNo}});">Delete</a>
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
			
            <div class="modal fade" id="typemodal">
				<div class="modal-dialog modal-dialog-centered" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">Routine</h5>
							<button type="button" class="close" data-dismiss="modal">
								<span>&times;</span>
							</button>
						</div>
						<div class="modal-body">
						<form class="" id="uploadattch" method="POST"  enctype="multipart/form-data">

						{{ csrf_field() }}

						     <div class="row">
							   <div class="col-12">
							     <label><b>Enter Name<span class="required-field">*</span></b></label>
							     <input name="name" id="name" class="form-control" ng-model="category['C_1']" placeholder="Enter Name...">
							   </div>
							</div>
                              
							             <div class="row">
                                            <div class="col-sm-12">
                                               <label class="col-form-label" for="short_description"><b>Short Description</b></label>
                                               <textarea class="form-control" id="short_description" rows="8" ng-model="category['C_3']" name="short_description" placeholder="Enter Short Description..."></textarea>
                                            </div>
                                         </div>
								
										 <h5 class="mb-4"><i class="fa fa-paperclip"></i>Attatchment</h5>
                                        
                                        <div class="col-sm-12 col-12 register-new-product-picture-para-box">
											<div class="row register-new-product-picture-para">
												<div class="col-sm-6 image-overlay upload-photo-box" id="imageAttach-btn" onclick="form1();" style="">
													<img src="{{ url('/assets-admin') }}/images/admin/upload.svg" alt="" width="50">
													<p>Upload Photo</p>
												</div>
												<div class="col-sm-4">
													<div class="row" id="p_att">
													     <div class="col-2 image-overlay margin-r1" id="img_file_">
								                         </div>
													</div>
												</div>
												    <input type="hidden" id="type_id" name="type_id" value="">

           											<input type="hidden" id="userId" name="userId" value="<?php echo session('userId');?>">
													<input type="file" id="uploadattl" name="uploadattl" class="file-input" style="display: none;">
											</div>
										</div>		 

							<div class="row">
							   <div class="col-12">
								    <label><b>Routine Category<span class="required-field">*</span></b></label>
								    <select class="form-control" id="routine_category" ng-model="category['C_4']"  name="routine_category">
			                        	<option value=""selected>---Choose Routine Category---</option>
                                        <option value="1">Routine by needs</option>
			                        	<option value="2">Routine by age</option>

			                        </select>
							   </div>
							</div>
							</form>

						
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-danger light" data-dismiss="modal">Close</button>
							<button type="button" class="btn btn-warning" id="formsubmit" >Save changes</button>
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
			
        </div>
		
		<!--**********************************
            Content body end
        ***********************************-->

    </div>
    <!--**********************************
            Footer start
        ***********************************-->
        
	@include('admin.admin-footer');
	
	<script src="{{ url('/assets-admin') }}/customjs/script_adminroutinetype.js?v={{time()}}"></script>
	
	<script type="text/javascript">


			$(document).on('click','#formsubmit',function(e){


			var formData = new FormData($('#uploadattch')[0]);

			$.ajax({
			url: '{{ url("/routine_type_add") }}',
			type: 'POST',
			data: formData,
			contentType: false,
			processData: false,
			success: function(response) {
				console.log(response.done);
				if(response.done == 'true'){
					$('#typemodal').modal('show');
					toastr.success(response.msg, '', {timeOut: 3000})

				}else{
				     toastr.error(response.msg, '', {timeOut: 3000});
				}
			  console.log(response);
			},
			error: function(error) {
			  console.log(error);
			}
		  });
		})


		$('#uploadattl').on('change', function() {
			var selectedFile = $('#uploadattl')[0].files[0];
			var reader = new FileReader();
			$('.image-box').remove();

                   reader.onload = function(event) {
	               var img = $('<img class="image-box">').attr('src', event.target.result);
	$('#img_file_').append(img);

};

reader.readAsDataURL(selectedFile);
});

function form1(){
    	$("#uploadattl").click();
    }
		 function form1(){
    	$("#uploadattl").click();
    }
    	function addSubCategory(){
          	$('#exampleModalCenter').modal("show");
            
       	}
       	function addCategory(){
          	$('#exampleModalCenter2').modal("show");
       	}

//        	var table = $('#categoryTable').DataTable();
     
    </script>