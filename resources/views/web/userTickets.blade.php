@include('web.web-header-userprofile')
<script>
var site = '<?php echo session('site');?>';
var userName = '<?php echo session('userName');?>';
var baseurl = "<?php echo url('/assets-admin');?>";
</script>
	<div ng-app="project1">
        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body" ng-controller="projectinfo1">
            
            <div class="container-fluid" ng-show="editView == '0'">
                <div class="row">
                	<div class="col-10">
                		<div class="page-titles pt-0 pb-0 mb-0">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="javascript:void(0)">Tickets</a></li>
								<li class="breadcrumb-item active"><a href="javascript:void(0)">View All</a></li>
							</ol>
		                </div>
                	</div>
                   	<div class="col-2">
                       <a type="button" class="btn btn-rounded btn-warning admin-view-add mb-3" href="javascript:void(0)" ng-click="addNew();">Add new</a>
                   	</div>
                </div>
                
                <!-- row -->

                <div class="row">
					<div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Tickets</h4>
                            </div>
                            <div class="card-body">
                            	
                                <div class="table-responsive">
                                    <table id="ticketListing_table" class="display min-w850">
                                        <thead>
                                            <tr>
                                            	<th>Ticket#</th>
                                                <th>Username</th>
                                                <th>Type</th>
                                                <th>Subject</th>
                                                <th>Priority</th>
                                                <th>Ticket Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr ng-repeat="row in displayCollectionTickets">
                                                <td>@{{row.TICKET_NUMBER}}</td>
                                                <td>@{{row.USER_NAME}}</td>
                                                <td>@{{row.TICKET_TYPE}}</td>
                                                <td>@{{row.SUBJECT}}</td>
                                                <td>@{{row.PRIORITY}}</td>
                                                <td>
													<span class="badge light badge-danger" ng-if="row.STATUS == 'CLOSE'">
														<i class="fa fa-circle text-danger mr-1"></i>
														@{{row.STATUS}}
													</span>
													<span class="badge light badge-success" ng-if="row.STATUS != 'CLOSE'">
														<i class="fa fa-circle text-success mr-1"></i>
														@{{row.STATUS}}
													</span>
												</td>
                                                
                                                <td>
													<div class="dropdown ml-auto text-right">
														<div class="btn-link" data-toggle="dropdown">
															<svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg>
														</div>
														<div class="dropdown-menu dropdown-menu-right">
															<a class="dropdown-item" href="javascript:;" ng-click="viewTicketDetails(row.TICKET_ID);">View Details</a>
<!-- 															<a class="dropdown-item" href="javascript:;" ng-click="changeStatusOpenClose(row.TICKET_ID, 1);" ng-if="row.STATUS == 'CLOSE'">Open</a> -->
<!-- 															<a class="dropdown-item" href="javascript:;" ng-click="changeStatusOpenClose(row.TICKET_ID, 0);" ng-if="row.STATUS == 'OPEN'">Close</a> -->
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
            
            <div class="container-fluid" ng-show="editView == '1'">
                <div class="page-titles">
					<ol class="breadcrumb">
						<li class="breadcrumb-item" ng-click="backToListing();"><i class="fa fa-arrow-left p-1"></i> &nbsp;<a href="javascript:void(0)">Tickets</a></li>
						<li class="breadcrumb-item active"><a href="javascript:void(0)">Detail</a></li>
					</ol>
                </div>
                <div class="row">
                    <div class="col-lg-12">

                        <div class="card">
                            <div class="card-header row">  
                            	<div class="col-6">Tickets Details</div>
                            </div>
                            <div class="card-body">
                                <div class="form-validation">
<!-- 									<form class="form-valide"> -->
										<div class="row">
											<div class="col-sm-6">
												<div class="form-group">
													<label class="col-form-label" for="t1"><b>Ticket Type</b> <span class="text-danger">*</span> </label> 
													<select class="form-control" id="t1" ng-model="ticket['T_1']" >
							                        	<option value="">---SELECT---</option>
							                        	<option value="order">Order</option>
							                        	<option value="other">Other</option>
							                        </select>
												</div>
											</div>
											<div class="col-sm-6">
												<div class="form-group order_lov" ng-show="ticket.T_1 == 'order'" >
													<label class="col-form-label" for="t2"><b>Order Number<span class="text-danger">*</span></b> </label> 
													{{-- <input type="text" class="form-control" id="t2" ng-model="ticket['T_2']" placeholder="Document Number"> --}}
													<select class="default-placeholder" id="t2" ng-model="ticket['T_2']"
														ng-options="item as item.name for item in orderList track by item.id">
														<option value="" selected>Select</option>
													</select>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-sm-6">
												<div class="form-group">
													<label class="col-form-label" for="t3"><b>Username<span class="text-danger">*</span></b> </label> 
													<input type="text" class="form-control bg-dark text-light" id="t3" ng-model="ticket['T_3']" placeholder="Username" value="" disabled>
												</div>
											</div>
											<div class="col-sm-6">
												<div class="form-group">
													<label class="col-form-label" for="t4"><b>Email<span class="text-danger">*</span></b> </label>
													<input type="text" class="form-control" id="t4" ng-model="ticket['T_4']" placeholder="Email">
												</div>
											</div>
											<div class="col-sm-6">
												<div class="form-group">
													<label class="col-form-label" for="t5"><b>Phone Number<span class="text-danger">*</span></b> </label>
													<input type="number" class="form-control" id="t5" ng-model="ticket['T_5']" placeholder="Phone Number">
												</div>
											</div>
											<div class="col-sm-6">
												<div class="form-group">
													<label class="col-form-label" for="t1"><b>Priority</b> <span class="text-danger">*</span> </label> 
													<select class="form-control" id="t1" ng-model="ticket['T_8']" >
							                        	<option value="">---SELECT---</option>
							                        	<option value="low">Low</option>
							                        	<option value="medium">Medium</option>
							                        	<option value="High">High</option>
							                        </select>
												</div>
											</div>
											<div class="col-sm-12">
												<div class="form-group">
													<label class="col-form-label" for="t6"><b>Subject<span class="text-danger">*</span></b> </label>
													<input type="text" class="form-control" id="t6" ng-model="ticket['T_6']" placeholder="Subject">
												</div>
											</div>
											
											<div class="col-sm-12">
												<div class="form-group">
													<label class="col-form-label" for="t7"><b>Detail<span class="text-danger">*</span></b> </label>
													<textarea class="form-control" id="t7" rows="8" ng-model="ticket['T_7']" placeholder="Enter Details..."></textarea>
												</div>
											</div>
											
										</div>
										
										<div class=" ml-0 ml-sm-12 ml-sm-0 mt-3">

                                        	<div class="compose-content">
                                                    
                                        		<h5 class="mb-4"><i class="fa fa-paperclip"></i>Images </h5>

                                               	<div class="col-sm-12 col-12 register-new-product-picture-para-box">
                                                  	<div class="row register-new-product-picture-para">
                                                      	<div class="col-sm-2 image-overlay upload-photo-box" id="imageAttach-btn" onclick="form();" >
                                                           	<img src="{{ url('/assets-admin') }}/images/admin/upload.svg" alt="" width="50">
                                                         	<p>Upload</p>
                                                       	</div>
                                                       	<div class="col-sm-9">
                                                           	<div class="row" id="p_att"> </div>
                                                       	</div>

                                                     	<form class="" id="uploadattch" method="POST" action="uploadTicketAttachment" enctype="multipart/form-data">
                                                          	<input type="hidden" name="_method" value="POST">
                                                           	{{ csrf_field() }}
                                                           	<input type="hidden" id="userId" name="userId" value="<?php echo session('userId'); ?>">
                                                           	<input type="hidden" id="sourceId" name="sourceId" value="@{{ ticket.ID }}">
                                                           	<input type="hidden" id="sourceCode" name="sourceCode" value="TICKET_IMG">
                                                           	<input type="file" id="uploadatt1" name="uploadattl" class="file-input" style="display: none;">
                                                      	</form>

                                                   	</div>
                                               	</div>

                                        	</div>
                                                
                                       	</div>
                                            
										<div class="save-admin-center mt-3">
										   <button type="button" class="btn btn-rounded btn-success mobile-save-btn" ng-click="saveTicket();" style="width: 12rem;">Submit Ticket</button>
										</div>
										
										
                                   
<!-- 									</form> -->
								</div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid" ng-show="editView == '2'">
                <div class="page-titles">
					<ol class="breadcrumb">
						<li class="breadcrumb-item" ng-click="backToListing();"><i class="fa fa-arrow-left p-1"></i> &nbsp;<a href="javascript:void(0)">Ticket</a></li>
						<li class="breadcrumb-item active"><a href="javascript:void(0)">Detail</a></li>
					</ol>
                </div>
                <div class="row">
                    <div class="col-lg-12">

                        <div class="card">
                            <div class="card-header row">  
                            	<div class="col-6">Ticket Details</div>
                            </div>
                            <div class="card-body">
                                <div class="form-validation">
									<form class="form-valide">
										
										<div class="row">
											<div class="col-sm-4">
												<div class="form-group">
													<label class="col-form-label" for="t1"><b>Ticket Number</b></label> 
													<p>@{{tktNumber}}</p>
												</div>
											</div>
											<div class="col-sm-4">
												<div class="form-group">
													<label class="col-form-label" for="t1"><b>Ticket Type</b></label> 
													<p>@{{tktType}}</p>
												</div>
											</div>
											<div class="col-sm-4">
												<div class="form-group">
													<label class="col-form-label" for="t2"><b>Document Number</b></label> 
													<p>@{{tktDocNum}}</p>
												</div>
											</div>
											<div class="col-sm-4">
												<div class="form-group">
													<label class="col-form-label" for="t3"><b>Username</b></label> 
													<p>@{{tktUsername}}</p>
												</div>
											</div>
											<div class="col-sm-4">
												<div class="form-group">
													<label class="col-form-label" for="t4"><b>Email</b></label>
													<p>@{{tktEmail}}</p>
												</div>
											</div>
											<div class="col-sm-4">
												<div class="form-group">
													<label class="col-form-label" for="t5"><b>Phone Number</b></label>
													<p>@{{tktPhoneNum}}</p>
												</div>
											</div>
											<div class="col-sm-4">
												<div class="form-group">
													<label class="col-form-label" for="t5"><b>Status</b></label>
													<p>@{{tktStatus}}</p>
												</div>
											</div>
											<div class="col-sm-4">
												<div class="form-group">
													<label class="col-form-label" for="t5"><b>Date</b></label>
													<p>@{{tktDate}}</p>
												</div>
											</div>
											<div class="col-sm-4">
												<div class="form-group">
													<label class="col-form-label" for="t5"><b>Priority</b></label>
													<p>@{{tktPriority}}</p>
												</div>
											</div>
											<div class="col-sm-12">
												<div class="form-group">
													<label class="col-form-label" for="t6"><b>Subject</b> </label>
													<p>@{{tktSubject}}</p>
												</div>
											</div>
											<div class="col-sm-12">
												<div class="form-group">
													<label class="col-form-label" for="t7"><b>Detail</b> </label>
													<p>@{{tktDes}}</p>
												</div>
											</div>
											<div class=" ml-0 col-sm-12 mt-3">

	                                        	<div class="compose-content">
	                                                    
	                                        		<h5 class="mb-4"><i class="fa fa-paperclip"></i>Images </h5>
	
	                                               	<div class="col-sm-12 col-12 register-new-product-picture-para-box">
	                                                  	<div class="row register-new-product-picture-para">
	                                                       	<div class="col-sm-9">
	                                                           	<div class="row" id="p_att1">
	                                                           		<div class="col-sm-2 image-overlay margin-r1" id="img_file_@{{row.ID}}" ng-repeat="row in displayCollectionTicketImg">
																		<img src="@{{row.downPath}}" alt="" class="image-box">
																		<div class="overlay">
																			<div class="text">
																				<div class="arrow-icon-move-box">
																					<img class="arrow-center" src="{{url('/assets-admin')}}/images/admin/feather-move.svg" alt="">
																				</div>
																			</div>
																		</div>
																	</div>
 		  		
	                                                           	</div>
	                                                       	</div>
	                                                   	</div>
	                                               	</div>
	
	                                        	</div>
	                                                
	                                       	</div>
											<div class="col-sm-12">
												<div class="form-group">
													<label class="col-form-label" for="t7"><b>Replies:</b> </label>
												</div>
												<div class="border-bottom pb-7 mb-7 " ng-repeat="row in displayCollectionTicketReplies">
													
													<div class="row mt-3 mb-3" ng-if="row.USER_TYPE == 'user'">
														<div class="w-70px d-block mr-6 col-sm-1">
															<img src="{{url('assets-web')}}/images/user-avatar.png" alt="Dean. D" style="width:5vw; border-radius:50%;">
														</div>
														<div class="media-body col-sm-10">
															<div class="row no-gutters mb-2 align-items-center rating-result">
																<div class="col-sm-6 text-sm-left">
																	<span class="fs-16 text-primary" style="color: #44B2F7 !important;">@{{tktUsername}} </span>
																	<span class="fs-14 text-primary"> User</span>
																</div>
															</div>
															<p>@{{row.REPLY_DESCRIPTION}}</p>
																
														</div>
													</div>
													<div class="row mt-3 mb-3" ng-if="row.USER_TYPE == 'admin'">
														<div class="col-1">
															<div class="w-70px d-block mr-6">
																<i class="fa fa-user" style="min-width: 4rem; min-height: 4rem; max-width: 6rem; color: white !important; max-height: 4rem; background-color: rgb(68, 178, 247); display: flex; justify-content: center; align-items: center; border-radius: 50%; font-size: 22px;"> </i>
															</div>
														</div>
														<div class="col-10">
															<div class="row no-gutters mb-2 align-items-center rating-result">
																<div class="col-sm-6 text-sm-left">
																	<span class="fs-16 text-primary" style="color: #44B2F7 !important;">JUSOUTBeauty </span>
																</div>
															</div>
															<strong>@{{row.REPLY_DESCRIPTION}}</strong>
															
														</div>
													</div>
													
													
													
					
												</div>
											</div>
											<div class="col-sm-12" ng-show="tktStatus == 'OPEN'">
												<div class="form-group">
													<label class="col-form-label" for="ticketReply"><b>Reply<span class="text-danger">*</span></b> </label>
													<textarea class="form-control" id="ticketReply" rows="8" ng-model="ticketReply" placeholder="Enter Reply..."></textarea>
												</div>
											</div>
										</div>
										<div class="" ng-show="tktStatus == 'OPEN'">
										   <button type="button" class="btn btn-rounded btn-success mobile-save-btn" ng-click="saveTicketReply();">Submit Reply</button>
										</div>
									</form>
								</div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- <div class="modal fade" id="alertDel">
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
			</div> -->
        </div>
        <!--**********************************
            Content body end
        ***********************************-->

    </div>
    @include('admin.admin-footer')
    
    <script src="{{ url('/assets-web') }}/customjs/script_usertickets.js?v={{time()}}"></script>
    
    <script>
    function form() {
        $("#uploadatt1").click();
    }
	
    </script>