@include('admin.admin-header');
<script>
var userId = '<?php echo session('userId');?>';
var site = '<?php echo session('site');?>';
var baseurl = "<?php echo url('/assets-admin');?>";
</script>

	<div ng-app="project1">
        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body" ng-controller="projectinfo1">

            <div class="container-fluid" ng-show="editView == '0'">
                <div class="page-titles mb-0">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="javascript:void(0)">Orders</a></li>
						<li class="breadcrumb-item active"><a href="javascript:void(0)">View All</a></li>
					</ol>
                </div>
                <!-- row -->

                <div class="row">
					<div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Orders</h4>
                            </div>
                            <div class="card-body">
                            	<div class="row">

                                   	<div class="col-lg-4">
                                   		<div class="form-group">
                                        	<label><b>Order Number</b><span class="text-danger">*</span></label>
                                         	<input type="text" id="search_1" class="form-control" ng-model="search['S_1']">
                                       	</div>
                                   	</div>
                                   	<div class="col-lg-4">
                                     	<div class="form-group">
                                         	<label><b>Order Status</b><span class="text-danger">*</span></label>
                                         	<select class="form-control" id="search_2" ng-model="search['S_2']" >
                                            	<option value="">--SELECT--</option>
                                            	<option value="shipped">Shipped</option>
                                            	<option value="delivered">Delivered</option>
                                         	</select>
                                     	</div>
                                   	</div>
                                   	<div class="col-lg-4">
                                     	<div class="form-group">
                                        	<label><b>Shipping Status</b><span class="text-danger">*</span></label>
                                         	<select class="form-control" id="search_3" ng-model="search['S_3']">
                                            	<option value="">--SELECT--</option>
                                            	<option value="Pending">Pending</option>
                                            	<option value="Picked Up">Picked Up</option>
                                            	<option value="In-Transit">In-Transit</option>
                                            	<option value="Delivered">Delivered</option>
                                         	</select>
                                    	</div>
                                   	</div>

                                   	<div class="col-lg-4">
                                   		<div class="form-group">
                                        	<label><b>Start Date</b><span class="text-danger">*</span></label>
                                         	<input type="date" id="search_4" class="form-control" ng-model="shipment['S_4']">
                                       	</div>
                                   	</div>
                                   	<div class="col-lg-4">
                                   		<div class="form-group">
                                        	<label><b>End Date</b><span class="text-danger">*</span></label>
                                         	<input type="date" id="search_5" class="form-control" ng-model="shipment['S_5']">
                                       	</div>
                                   	</div>
                                   	<div class="col-4">
                                        <a type="button" class="btn btn-rounded btn-warning admin-view-add mt-4" ng-click="searchGlobal();" style="width:10vw;">Search</a>
                                        <a type="button" class="btn btn-rounded btn-warning admin-view-add mt-4" ng-click="resetGlobal();" style="width:10vw;margin-right:10px">Reset</a>
                                	</div>

                                </div>
                                <div class="table-responsive">
                                    <table id="orderListing_table" class="display min-w850">
                                        <thead>
                                            <tr>
                                                <!-- <th>
													<div class="custom-control custom-checkbox">
														<input type="checkbox" class="custom-control-input" id="checkAll" required="">
														<label class="custom-control-label" for="checkAll"></label>
													</div>
												</th> -->
                                                <th>Order Code</th>
                                                <th>Num. of Products</th>
                                                <th>Customer</th>
                                                <th>Amount</th>
                                                <th>Delivery Status</th>
                                                <th>Payment Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr ng-repeat="row in displayCollectionOrders">
                                                <!-- <td>
													<div class="custom-control custom-checkbox">
														<input type="checkbox" class="custom-control-input" id="customCheckBox2" required="">
														<label class="custom-control-label" for="customCheckBox2"></label>
													</div>
												</td> -->
                                                <td>@{{row.ORDER_NUM}}</td>
                                                <td>@{{row.totalOrderLines}}</td>
                                                <td>@{{row.userFirstName}} @{{row.userLastName}}</td>
                                                <td>$@{{row.totalOrderAmount}}</td>
                                                <td>@{{row.ORDER_STATUS}}</td>
												<td>
													<span class="badge light badge-danger" ng-if="row.PAYMENT_STATUS != 'PAID'">
														<i class="fa fa-circle text-danger mr-1"></i>
														@{{row.PAYMENT_STATUS}}
													</span>
													<span class="badge light badge-success" ng-if="row.PAYMENT_STATUS == 'PAID'">
														<i class="fa fa-circle text-success mr-1"></i>
														@{{row.PAYMENT_STATUS}}
													</span>
												</td>

                                                <td>
													<div class="dropdown ml-auto text-right">
														<div class="btn-link" data-toggle="dropdown">
															<svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg>
														</div>
														<div class="dropdown-menu dropdown-menu-right">
															<a class="dropdown-item" href="javascript:;" ng-click="viewOrderDetails(@{{row.ORDER_ID}});">View</a>
<!-- 															<a class="dropdown-item" href="javascript:;">Delete</a> -->
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
						<li class="breadcrumb-item" ng-click="backToListing();"><i class="fa fa-arrow-left p-1"></i> &nbsp;<a href="javascript:void(0)">Order</a></li>
						<li class="breadcrumb-item active"><a href="javascript:void(0)">Detail</a></li>
					</ol>
                </div>
                <div class="row">
                    <div class="col-lg-12">

                        <div class="card">
                            <div class="card-header row">
                            	<div class="col-6">Order Details</div>
                            	<div class="col-6">
                            		<a type="button" class="btn btn-rounded btn-warning admin-view-add" ng-click="shipmentStatusUpdate(1);" ng-if="shipment.ID != '' && shipment.S_2 == 'Pending'">picked up</a>
                                       <a type="button" class="btn btn-rounded btn-warning admin-view-add" ng-click="shipmentStatusUpdate(2);" ng-if="shipment.ID != '' && shipment.S_2 == 'Picked Up'">In-Transit</a>
                                       <a type="button" class="btn btn-rounded btn-warning admin-view-add" ng-click="shipmentStatusUpdate(3);" ng-if="shipment.ID != '' && shipment.S_2 == 'In-Transit'">Delivered up</a>
                            	</div>
                            </div>
                            <div class="card-body">

                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th class="center">#</th>
                                                <th>Tracking Number</th>
                                                <th>Status</th>
                                                <th>Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr ng-repeat="row in displayCollectionOrderTracking">
                                                <td class="center">@{{row.seqNo}}</td>
                                                <td class="left strong">@{{shipment.S_3}}</td>
                                                <td class="left">@{{row.STATUS}}</td>
                                                <td class="right">@{{row.DATE}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <hr>

                                <div class="row">
                                   <div class="col-lg-3">
                                       <div class="form-group">
                                         <label><b>Shipping company name</b><span class="text-danger">*</span></label>
                                         <select class="form-control" id="s1" ng-model="shipment['S_1']" ng-show="shipment.ID == ''">
                                            <option value="">--SELECT--</option>
                                            <option value="TCS">TCS</option>
                                            <option value="Leopard Courier">Leopard Courier</option>
                                         </select>
                                         <p ng-show="shipment.ID != ''">@{{shipment.S_1}}</p>
                                       </div>
                                   </div>
                                   <div class="col-lg-3">
                                     <div class="form-group">
                                         <label><b>Delivery Status</b><span class="text-danger">*</span></label>
                                         <select class="form-control" id="s2" ng-model="shipment['S_2']" ng-show="shipment.ID == ''">
                                            <option value="">--SELECT--</option>
                                            <option value="Pending">Pending</option>
<!--                                             <option value="Picked Up">Picked Up</option> -->
<!--                                             <option value="In-Transit">In-Transit</option> -->
<!--                                             <option value="Delivered">Delivered</option> -->
                                         </select>
                                         <p ng-show="shipment.ID != ''">@{{shipment.S_2}}</p>
                                     </div>
                                   </div>
                                   <div class="col-lg-3">
                                       <div class="form-group">
                                         <label for="tracking_number"><b>Tracking Number</b><span class="text-danger">*</span></label>
                                         <input type="text" id="s3" class="form-control" ng-model="shipment['S_3']" ng-show="shipment.ID == ''">
                                         <p ng-show="shipment.ID != ''">@{{shipment.S_3}}</p>
                                       </div>
                                   </div>
                                   <div class="col-lg-3">
                                       <div class="form-group">
                                         <label for="tracking_number"><b>Expected delivery date</b><span class="text-danger">*</span></label>
                                         <input type="date" id="s4" class="form-control" ng-model="shipment['S_4']" ng-show="shipment.ID == ''">
                                         <p ng-show="shipment.ID != ''">@{{shipment.S_4}}</p>
                                       </div>
                                   </div>
                                   <div class="col-3 offset-9">
                                       <a type="button" class="btn btn-rounded btn-warning admin-view-add" href="javascript:void(0)" ng-click="addShipmentInfo();" ng-show="shipment.ID == ''">Confirm</a>

                                   </div>

                                </div>
                                <!-- <div class="row">
                                    <img src="{{url('assets-admin')}}/images/admin/qr.png" class="img-fluid width110">
                                </div> -->
                                <div class="row mb-5">
                                    <div class="mt-4 col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                        <div> <strong>@{{orderShipName}}</strong> </div>
                                        <div>@{{orderShipEmail}}</div>
                                        <div>@{{orderShipPhone}}</div>
                                        <div>@{{orderShipAdres}}</div>
                                        <div>@{{orderShipCountry}}</div>
                                    </div>
                                    <div class="mt-4 col-xl-6 col-lg-6 col-md-12 col-sm-12 d-flex justify-content-lg-end justify-content-md-center justify-content-xs-start">
										<div class="align-items-center">
											<table>
												<tbody>
													<tr>
														<td class="text-main text-bold">Order #</td>
														<td class="text-right text-info text-bold"> @{{orderNumber}}</td>
													</tr>
													<tr>
														<td class="text-main text-bold">Order status</td>
														<td class="text-right"><span class="badge badge-inline badge-info">@{{orderStatus}}</span></td>
													</tr>
													<tr>
														<td class="text-main text-bold">Order date</td>
														<td class="text-right">@{{orderDate}}</td>
													</tr>
													<tr>
														<td class="text-main text-bold">Total amount</td>
														<td class="text-right">$@{{orderTotalAmount}}</td>
													</tr>
													<tr>
														<td class="text-main text-bold">Payment method</td>
														<td class="text-right">@{{orderPayType}}</td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th class="center">#</th>
                                                <th>Item</th>
                                                <th>Photo</th>
                                                <th>Description</th>
                                                <th>Delivery Type</th>
                                                <th class="right">Unit Cost</th>
                                                <th class="center">Qty</th>
                                                <th class="right">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr ng-repeat="row in displayCollectionOrderLines">
                                                <td class="center">@{{row.seqNo}}</td>
                                                <td class="left strong">@{{row.productName}}</td>
                                                <td class=""><img class="round-product-img" src="@{{row.primaryImage}}"></td>
                                                <td class="left">@{{row.productDesc}}</td>
                                                <td>Home Delivery</td>
                                                <td class="right">$@{{row.UNIT_PRICE}}</td>
                                                <td class="center">@{{row.QUANTITY}}</td>
                                                <td class="right">$@{{row.TOTAL_AMOUNT}}</td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4 col-sm-5"> </div>
                                    <div class="col-lg-4 col-sm-5 ml-auto">
                                        <table class="table table-clear">
                                            <tbody>
                                                <tr>
                                                    <td class="left"><strong>Subtotal</strong></td>
                                                    <td class="right">$@{{ordersubTotal}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="left"><strong>Tax Amount</strong></td>
                                                    <td class="right">$@{{orderTaxAmount}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="left"><strong>Total Inc. Tax:</strong></td>
                                                    <td class="right">$@{{orderTotalIncTax}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="left"><strong>Discount:</strong></td>
                                                    <td class="right">$@{{orderDiscount}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="left"><strong>Total</strong></td>
                                                    <td class="right"><strong>$@{{orderTotalAmount}}</strong></td>
<!--                                                         <br><strong>0.15050000 BTC</strong> -->
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
    @include('admin.admin-footer');

    <script src="{{ url('/assets-admin') }}/customjs/script_adminshippedorders.js?v={{time()}}"></script>
