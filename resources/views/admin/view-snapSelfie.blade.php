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
                <div class="page-titles mb-0">
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
                                                <th>Created On</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr ng-repeat="row in displayCollectionSnapselfie">
                                                <td>@{{row.seqNo}}</td>
                                                {{-- <td class=""><a href="@{{row.DOWNPATH}}" target="_blank"><img class="round-product-img" src="@{{row.DOWNPATH}}"></a></td> --}}
                                                <td>@{{row.USERNAME}}</td>
                                                <td>@{{row.USER_EMAIL}}</td>
                                                <td>@{{row.CREATED_ON | date: 'dd-MM-YYYY HH:mm'}}</td>

                                                <td>
													<div class="dropdown ml-auto text-right">
														<div class="btn-link" data-toggle="dropdown">
															<svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg>
														</div>
														<div class="dropdown-menu dropdown-menu-right">
                                                            <a class="dropdown-item" href="javascript:;" ng-click="showSelfieDetail(@{{row.SELFIE_ID}})">View</a>
															<a class="dropdown-item" href="javascript:;" ng-click="openConfirmDeleteModalForSelfie(@{{ row.SELFIE_ID }});">Delete</a>
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

            <div class="container-fluid " ng-show="snapDetail == '0'">
                <div class="page-titles">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="javascript:void(0)">Snaps</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Snap Detail</a></li>
					</ol>
                </div>
                <div class="card p-3">
                    <div class="card-header">
                        <span ng-click="backToSnaps()" style="cursor: pointer">
                            <i class="fa fa-arrow-left text-dark" aria-hidden="true"></i>
                            Back To Snaps</span>
                        <h4 class="card-title">Snap Details</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-sm-4">
                                <label for="name">Name</label>
                                <input type="text" readonly value="" name="" id="snapUserName" ng-model="UserDetail['USERNAME']" class="form-control">
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="email">Email</label>
                                <input type="email" readonly value="" name="" id="snapUserEmail" ng-model="UserDetail['USER_EMAIL']" class="form-control">
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="date">Date</label>
                                <input type="text" readonly value="" name="" id="snapUserDate" ng-model="UserDetail['DATE']" class="form-control">
                            </div>
                            <div class="form-group col-12">
                                {{-- <label for="snapSelfie" class="col-12">Selfie</label> --}}
                                <img src="@{{ UserDetail.DOWNPATH }}" alt="No Image Found" id="snapUserImage" class="img-fluid" style="height: 70vh; width: 70vw;">
                            </div>
                            <div class="col-12">
                                <form action="" method="post">
                                    @csrf
                                    <div class="form-group col-12">
                                        <h3 ng-show="checkId == 1">Reply Has Already Been Sent</h3>
                                        <h3 ng-show="checkId == 0">Write Your Reply</h3>
                                        <label for="comment">Comment/Suggestion</label>
                                        {{-- <p ng-show="Reply['R_1'] !== ''" >@{{ Reply.R_1 }}</p> --}}
                                        <textarea name="comment" id="comment" ng-model="Reply['R_1']" cols="30" rows="5"  class="form-control border border-primary rounded p-3" placeholder="Write Your Comment(s) here..." ng-disabled="checkId == 1"></textarea>
                                        <input type="hidden" ng-model="Reply['SenderId']" data-userId="{{ '<?php echo session('userId');?>' }}" value="{{ '<?php echo session('userId');?>' }}">
                                    </div>
                                    <div class="form-group col-12">
                                        <label for="products" ng-show="checkId == 0">Select Product(s)</label>
                                        <label for="products" ng-show="checkId == 1">Selected Product(s)</label>
                                        <select class="default-placeholder select2-hidden-accessible form-select border border-primary rounded p-3"
                                            id="products" multiple='multiple'
                                            ng-model="Reply['Products']"
                                            ng-options="item as item.NAME for item in productlov track by item.PRODUCT_ID" ng-disabled="checkId == 1">
                                            <option value="">---SELECT---</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-12">
                                        <button ng-click="sendSelfieReply()" class="btn btn-primary float-right" ng-disabled="checkId == 1">Send</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="alertDelSelfie">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">

                        <div class="modal-body">
                           <h4 style="text-align: center;">Are Your sure to delete?</h4>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger light"
                                data-dismiss="modal" ng-click='closeDeleteConfirmModal()'>No</button>
                            <button type="button" class="btn btn-primary" ng-click="deleteSelfieConfirmed()">Yes</button>
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
    {{-- <script>
        // Check if R_1 has a value
        if (angular.isDefined(Reply['R_1']) && Reply['R_1'] !== '') {
            alert('disabled');
          // Select all products by default
          Reply['Products'] = angular.copy(productlov);
          // Disable the select field
          angular.element(document.querySelector('#products')).attr('disabled', 'disabled');
        }
      </script> --}}
