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
            <div class="container-fluid">
                <div class="page-titles mb-0">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="javascript:void(0)">Question</a></li>
					</ol>
                </div>
                <!-- row -->

                <div class="row">
					<div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Question</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="questionsTable" class="display min-w850">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr ng-repeat="row in displayCollectionQuestions">
                                                <td>@{{row.seqNo}}</td>
                                                <td>@{{row.USERNAME}}</td>
                                                <td>@{{row.EMAIL}}</td>
												<td>
													<span class="badge light badge-danger" ng-if="row.STATUS_FLAG == '0'">
														<i class="fa fa-circle text-danger mr-1"></i> Hide
													</span>
													<span class="badge light badge-success" ng-if="row.STATUS_FLAG == '1'">
														<i class="fa fa-circle text-success mr-1"></i> Show
													</span>
												</td>
                                                
                                                <td>
													<div class="dropdown ml-auto text-right">
														<div class="btn-link" data-toggle="dropdown">
															<svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg>
														</div>
														<div class="dropdown-menu dropdown-menu-right">
															<a class="dropdown-item" href="javascript:;" ng-click="updateQuestionStatus(row.QUESTION_ID);" ng-show="row.STATUS_FLAG == '1'">Hide</a>
															<a class="dropdown-item" href="javascript:;" ng-click="updateQuestionStatus(row.QUESTION_ID);" ng-show="row.STATUS_FLAG == '0'">Show</a>
															<a class="dropdown-item" href="javascript:;" ng-click="sendQuestionReply(row.QUESTION_ID, row.QUESTION, row.ANSWER);">View</a>
															<a class="dropdown-item" href="javascript:;" ng-click="deleteQuestionReply(row.QUESTION_ID);">Delete</a>
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

			<div class="modal fade " id="send_repy_modal" tabindex="-1" role="dialog" aria-hidden="true">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">Answer</h5>
							<button type="button" class="close" data-dismiss="modal">
								<span>&times;</span>
							</button>
						</div>
						<div class="modal-body">
						     <div class="row">
						       <div class="col-sm-12">
						         <label><b>Question</b></label>
						         <p>@{{head.question}}</p>
						       </div>
						     </div>
						     <div class="row">
						       <div class="col-sm-12">
						         <label><b>Answer<span style="color:red;">*</span></b></label>
						         <textarea class="form-control" id="answer_qtn" ng-model="head['answer']" placeholder="Enter Answer..."></textarea>
						       </div>
						     </div>
<!-- 		                    <div class="summernote"></div> -->
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-danger light" ng-click="closeAnswerModal();">Close</button>
							<button type="button" class="btn btn-primary" ng-click="sendQuestionAnswer();">Send</button>
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
    
    <script src="{{ url('/assets-admin') }}/customjs/script_adminquestions.js?v={{time()}}"></script>