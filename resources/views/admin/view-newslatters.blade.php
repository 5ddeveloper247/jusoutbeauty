@include('admin.admin-header')
<script>
var userId = <?php echo session('userId');?>;
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
						<li class="breadcrumb-item"><a href="javascript:void(0)">News Latters</a></li>
					</ol>
                </div>
                <!-- row -->

                <div class="row" >
					<div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">News Latters</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="newslatterTable" class="display min-w850">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Email</th>
                                                <th>Phone Number</th>
                                                <th>Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr ng-repeat="row in displayCollectionNewslatter">
                                                <td>@{{row.seqNo}}</td>
                                                <td>@{{row.EMAIL}}</td>
                                                <td>@{{row.PHONE_NUMBER}}</td>
                                                <td>@{{row.DATE}}</td>
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
    
    <script src="{{ url('/assets-admin') }}/customjs/script_adminnewslatters.js?v={{time()}}"></script>