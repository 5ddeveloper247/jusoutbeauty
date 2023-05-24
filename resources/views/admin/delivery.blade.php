@include('admin.admin-header');

        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <div class="container-fluid">
                <div class="page-titles">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="javascript:void(0)">Delivery</a></li>
					</ol>
                </div>
                <!-- row -->

                <div class="row">
					<div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Delivery</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example5" class="display min-w850">
                                        <thead>
                                            <tr>
                                                <th>Seq</th>
                                                <th>Order Code</th>
                                                <th>Customer</th>
                                                <th>Amount</th>
                                                <th>Date</th>
                                                <th>Tracking Number</th>
                                                <th>Delivery Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>Order#1</td>
                                                <td>Tariq Pervaiz</td>
                                                <td>$90</td>
                                                <td>17 Oct 2022</td>
                                                <td>delivery-tp90-12-9000</td>
												<td>
													<span class="badge light badge-danger">
														<i class="fa fa-circle text-danger mr-1"></i>
														Placed
													</span>
												</td>
                                                
                                                <td>
													<div class="dropdown ml-auto text-right">
														<div class="btn-link" data-toggle="dropdown">
															<svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg>
														</div>
														<div class="dropdown-menu dropdown-menu-right">
															<a class="dropdown-item" href="/view-delivery">View</a>
														</div>
													</div>
												</td>												
                                            </tr>
                                            
                                            
                                            <tr>
                                                <td>2</td>
                                                <td>Order#2</td>
                                                <td>Javed Ali</td>
                                                <td>$100</td>
                                                <td>17 Oct 2022</td>
                                                <td>nakil-ja-1022</td>
												<td>
													<span class="badge light badge-success">
														<i class="fa fa-circle text-success mr-1"></i>
														Shipped
													</span>
												</td>
                                                
                                                <td>
													<div class="dropdown ml-auto text-right">
														<div class="btn-link" data-toggle="dropdown">
															<svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg>
														</div>
														<div class="dropdown-menu dropdown-menu-right">
															<a class="dropdown-item" href="/view-delivery">View</a>
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
        @include('admin.admin-footer');