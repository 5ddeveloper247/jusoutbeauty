@include('admin.admin-header');
 <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <div class="container-fluid">
                <div class="page-titles">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="http://www.jusoutbeauty.com/site/app/admin/delivery">Delivery</a></li>
						<li class="breadcrumb-item active"><a href="javascript:void(0)">View</a></li>
					</ol>
                </div>
                <!-- row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Delivery Information</h4>
                            </div>
                            <div class="card-body">
                                <div class="form-validation">
									<form class="form-valide" action="#" method="post">
										<div class="row">
											<div class="col-sm-6">
												<div class="form-group">
													<label class="col-form-label" for="order_number"><b>Order Number</b></label> 
                                                    <input type="text" class="form-control" name="order_number" id="order_number" placeholder="Enter Order Number">
<!--                                                     <p>order#1</p> -->
												</div>
											  </div>
											  <div class="col-sm-6">
												<div class="form-group">
													<label class="col-form-label" for="delivery_date"><b>Delivery Date</b></label>
													<input type="date" class="form-control" name="delivery_date" id="delivery_date">
													
													<!-- <p>19 Oct 2022</p> -->
												</div>
											  </div>
											
											
										</div>
										
										<div class="row">
											<div class="col-sm-6">
												<div class="form-group">
													<label class="col-form-label" for="amount"><b>Amount</b></label>
													<input type="number" class="form-control" name="amount" id="amount" placeholder="Enter delivery amount">
												</div>
											  </div>
											<div class="col-sm-6">
												<div class="form-group">
													<label class="col-form-label" for="tracking_number"><b>Tracking Number</b></label>
													<input type="text" class="form-control" name="tracking_number" id="tracking_number" placeholder="Enter Tracking Number">
												</div>
											</div>
											
										</div>
										<div class="row">
											
											<div class="col-sm-6">
												<div class="form-group">
													<label class="col-form-label" for="customer_name"><b>Customer Name</b></label>
													<input type="text" class="form-control" name="customer_name" id="customer_name" placeholder="Enter Customer Name">
												</div>
											</div>
											<div class="col-sm-6">
												<div class="form-group">
													<label class="col-form-label" for="status"><b>Status</b></label>
													<select class="form-control" id="status" name="status">
													  <option value="">---SELECT---</option>
													  <option value="placed">Placed</option>
													  <option value="shipped">Shipped</option>
													  <option value="intransit">In Transit</option>
													  <option value="delivered">Delivered</option>
													</select>
												</div>
											  </div>
										</div>
										<div class="row">
											
											<div class="col-sm-6">
												<div class="form-group">
													<label class="col-form-label" for=""><b>Courier</b></label>
													<select class="form-control">
													  <option value="">--SELECT--</option>
													  <option value="tcs">TCS</option>
													  <option value="leopard">Leopards</option>
													</select>
												</div>
											</div>
										</div>
									</form>
								</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                
                  <div class="col-xl-6">
                     <div class="card">
                            <div class="card-header border-0 pb-0">
                                <h4 class="card-title">Delivery Timeline</h4>
                            </div>
                            <div class="card-body">
                                <div id="DZ_W_TimeLine" class="widget-timeline dz-scroll height370">
                                    <ul class="timeline">
                                        <li>
                                            <div class="timeline-badge primary"></div>
                                            <a class="timeline-panel text-muted" href="#">
                                                <span>19 Oct 2022</span>
                                                <h6 class="mb-0"><strong class="text-primary">Placed</strong>.</h6>
                                            </a>
                                        </li>
                                        <li>
                                            <div class="timeline-badge info">
                                            </div>
                                            <a class="timeline-panel text-muted" href="#">
                                                <span>19 Oct 2022</span>
                                                <h6 class="mb-0"><strong class="text-info">Shipped</strong>.</h6>
                                            </a>
                                        </li>
                                        <li>
                                            <div class="timeline-badge danger">
                                            </div>
                                            <a class="timeline-panel text-muted" href="#">
                                                <span>19 Oct 2022</span>
                                                <h6 class="mb-0"><strong class="text-danger">In Transit</strong>.</h6>
                                             </a>
                                        </li>
                                        <li>
                                            <div class="timeline-badge success">
                                            </div>
                                            <a class="timeline-panel text-muted" href="#">
                                              <span>19 Oct 2022</span>
                                                <h6 class="mb-0"><strong class="text-success">Delivered</strong>.</h6>
                                             
                                            </a>
                                        </li>
                                        
                                    </ul>
                                </div>
                            </div>
                        </div>
                  </div>
                  <div class="col-xl-6">
                      <div class="card">
                            <div class="card-header border-0 pb-0">
                                <h4 class="card-title">Shippment Tracking</h4>
                            </div>
                            <div class="card-body">
                                <div id="DZ_W_TimeLine11" class="widget-timeline dz-scroll height370">
                                    <ul class="timeline">
                                        <li>
                                            <div class="timeline-badge dark">
                                            </div>
                                            <a class="timeline-panel text-muted" href="#">
                                                <span>19 Oct 2022</span>
                                                <span>In Transit</span>
                                                <h6 class="mb-0">Station: GPO Saddar,RAWALPINDI</h6>
                                            </a>
                                        </li>
                                        <li>
                                            <div class="timeline-badge dark">
                                            </div>
                                            <a class="timeline-panel text-muted" href="#">
                                                <span>19 Oct 2022</span>
                                                <span>In Transit</span>
                                                <h6 class="mb-0">Station: GPO Andrun,LAHORE</h6>
                                            </a>
                                        </li>
                                        <li>
                                            <div class="timeline-badge dark">
                                            </div>
                                            <a class="timeline-panel text-muted" href="#">
                                                <span>19 Oct 2022</span>
                                                <span>In Transit</span>
                                                <h6 class="mb-0">Station: GPO Saddar,HAIDERABAD</h6>
                                            </a>
                                        </li>
                                        <li>
                                            <div class="timeline-badge dark">
                                            </div>
                                            <a class="timeline-panel text-muted" href="#">
                                                <span>19 Oct 2022</span>
                                                <span>Reached</span>
                                                <h6 class="mb-0">Station: GPO Saddar,KARACHI</h6>
                                            </a>
                                        </li>
                                        <li>
                                            <div class="timeline-badge dark">
                                            </div>
                                            <a class="timeline-panel text-muted" href="#">
                                                <span>19 Oct 2022</span>
                                                <span>Reached</span>
                                                <h6 class="mb-0">Station: GPO Saddar,KARACHI</h6>
                                            </a>
                                        </li>
                                    </ul>
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