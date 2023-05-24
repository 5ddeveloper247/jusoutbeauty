@include('admin.admin-header')
<script>
var userId = '<?php echo session('userId');?>';
var site = '<?php echo session('site');?>';
var baseurl = "<?php echo url('/assets-admin');?>";
</script>
	<div  ng-app="project1">
        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body" ng-controller="projectinfo1">
            <div class="container-fluid"  ng-show="editView == '0'">
                <div class="page-titles">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="javascript:void(0)">Snap Selfie</a></li>
					</ol>
                </div>
                <!-- row -->

                <div class="row" >
					<div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Snap Selfie</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="snapselfieTable" class="display min-w850">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                {{-- <th>Selfie</th> --}}
                                                <th>Username</th>
                                                <th>Email</th>
                                                
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr ng-repeat="row in displayCollectionSnapselfie">
                                                <td>@{{row.seqNo}}</td>
                                                {{-- <td class=""><a href="@{{row.DOWNPATH}}" target="_blank"><img class="round-product-img" src="@{{row.DOWNPATH}}"></a></td> --}}
                                                <td>@{{row.USERNAME}}</td>
                                                <td>@{{row.USER_EMAIL}}</td>
                                                <td>
													<div class="dropdown ml-auto text-right">
														<div class="btn-link" data-toggle="dropdown">
															<svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg>
														</div>
														<div class="dropdown-menu dropdown-menu-right">
															<a class="dropdown-item" href="javascript:;" ng-click="deleteSelfieDetails(@{{row.SELFIE_ID}});">Delete</a>
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
            
            
            
            
            <div class="modal fade" id="alertDel">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						
						<div class="modal-body">
                           <h4 style="text-align: center;">Are Your sure to delete this ?</h4>
                        </div>
						<div class="modal-footer">
							<button type="button" class="btn btn-danger light"
								data-dismiss="modal">No</button>
							<button type="button" class="btn btn-primary">Yes</button>
						</div>
					</div>
				</div>
			</div>
        </div>
        <!--**********************************
            Content body end
        ***********************************-->

    </div>
    @include('admin.admin-footer')
    
    <script src="{{ url('/assets-admin') }}/customjs/script_adminsnapselfie.js?v={{time()}}"></script>