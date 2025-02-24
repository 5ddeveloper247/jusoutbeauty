@include('admin.admin-header');        
         <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <div class="container-fluid">
                <div class="page-titles">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="javascript:void(0)">Order</a></li>
						<li class="breadcrumb-item active"><a href="javascript:void(0)">Detail</a></li>
					</ol>
                </div>
                <div class="row">
                    <div class="col-lg-12">

                        <div class="card">
                            <div class="card-header"> Order Details </div>
                            <div class="card-body">
                                <div class="row">
                                   <div class="col-lg-4">
                                       <div class="form-group">
                                         <label for="payment_status">Payment Status</label>
                                         <select class="form-control" id="payment_status">
                                            <option value="">--SELECT--</option>
                                            <option value="unpaid">Unpaid</option>
                                            <option value="paid">Paid</option>
                                         </select>
                                       </div>
                                   </div>
                                   <div class="col-lg-4">
                                     <div class="form-group">
                                         <label for="delivery_status">Delivery Status</label>
                                         <select class="form-control" id="delivery_status">
                                            <option value="">--SELECT--</option>
                                            <option value="pending">Pending</option>
                                            <option value="confirm">Confirm</option>
                                            <option value="picked_up">Picked Up</option>
                                            <option value="on_the_way">On the way</option>
                                            <option value="delivered">Delivered</option>
                                         </select>
                                     </div>
                                   </div>
                                   <div class="col-lg-4">
                                       <div class="form-group">
                                         <label for="tracking_number">Tracking Number</label>
                                         <input type="text" name="tracking_number" id="tracking_number" class="form-control">
                                       </div>
                                   </div>
                                </div>
                                <div class="row">
                                    <img src="http://www.jusoutbeauty.com/themes/images/admin/qr.png" class="img-fluid width110">
                                </div>
                                <div class="row mb-5">
                                    <div class="mt-4 col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                        <div> <strong>Johnson</strong> </div>
                                        <div>johnson@gmail.com</div>
                                        <div>71-101-121-211</div>
                                        <div>Main Road,GT Road</div>
                                        <div>Srilanka</div>
                                    </div>
                                    <div class="mt-4 col-xl-6 col-lg-6 col-md-12 col-sm-12 d-flex justify-content-lg-end justify-content-md-center justify-content-xs-start">
										<div class="align-items-center">
											<table>
												<tbody>
													<tr>
														<td class="text-main text-bold">Order #</td>
														<td class="text-right text-info text-bold">
															1</td>
													</tr>
													<tr>
														<td class="text-main text-bold">Order status</td>
														<td class="text-right"><span
															class="badge badge-inline badge-info">Pending</span></td>
													</tr>
													<tr>
														<td class="text-main text-bold">Order date</td>
														<td class="text-right">28-04-2022 05:26 AM</td>
													</tr>
													<tr>
														<td class="text-main text-bold">Total amount</td>
														<td class="text-right">$68.400</td>
													</tr>
													<tr>
														<td class="text-main text-bold">Payment method</td>
														<td class="text-right">Cash On Delivery</td>
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
                                            <tr>
                                                <td class="center">1</td>
                                                <td class="left strong">Origin License</td>
                                                <td class=""><img class="round-product-img" src="http://www.jusoutbeauty.com/themes/images/admin/qr.png"></td>
                                                <td class="left">Extended License</td>
                                                <td>Home Delivery</td>
                                                <td class="right">$999,00</td>
                                                <td class="center">1</td>
                                                <td class="right">$999,00</td>
                                            </tr>
                                            <tr>
                                                <td class="center">2</td>
                                                <td class="left">Custom Services</td>
                                                <td class=""><img class="round-product-img" src="http://www.jusoutbeauty.com/themes/images/admin/qr.png"></td>
                                                <td class="left">Instalation and Customization (cost per hour)</td>
                                                <td>Home Delivery</td>
                                                <td class="right">$150,00</td>
                                                <td class="center">20</td>
                                                <td class="right">$3.000,00</td>
                                            </tr>
                                            <tr>
                                                <td class="center">3</td>
                                                <td class="left">Hosting</td>
                                                <td class=""><img class="round-product-img" src="http://www.jusoutbeauty.com/themes/images/admin/qr.png"></td>
                                                <td class="left">1 year subcription</td>
                                                <td>Home Delivery</td>
                                                <td class="right">$499,00</td>
                                                <td class="center">1</td>
                                                <td class="right">$499,00</td>
                                            </tr>
                                            <tr>
                                                <td class="center">4</td>
                                                <td class="left">Platinum Support</td>
                                                <td class=""><img class="round-product-img" src="http://www.jusoutbeauty.com/themes/images/admin/qr.png"></td>
                                                <td class="left">1 year subcription 24/7</td>
                                                <td>Home Delivery</td>
                                                <td class="right">$3.999,00</td>
                                                <td class="center">1</td>
                                                <td class="right">$3.999,00</td>
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
                                                    <td class="right">$8.497,00</td>
                                                </tr>
                                                <tr>
                                                    <td class="left"><strong>Discount (20%)</strong></td>
                                                    <td class="right">$1,699,40</td>
                                                </tr>
                                                <tr>
                                                    <td class="left"><strong>VAT (10%)</strong></td>
                                                    <td class="right">$679,76</td>
                                                </tr>
                                                <tr>
                                                    <td class="left"><strong>Total</strong></td>
                                                    <td class="right"><strong>$7.477,36</strong><br>
                                                        <strong>0.15050000 BTC</strong></td>
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
        </div>
        <!--**********************************
            Content body end
        ***********************************-->
        
    </div>
    @include('admin.admin-footer');