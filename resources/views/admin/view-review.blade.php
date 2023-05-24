@include('admin.admin-header');
 <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <div class="container-fluid">
                <div class="page-titles">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="http://www.jusoutbeauty.com/site/app/admin/reviews">Reviews</a></li>
						<li class="breadcrumb-item active"><a href="javascript:void(0)">View</a></li>
					</ol>
                </div>
                <!-- row -->
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-header d-block">
                                <h4 class="card-title">Reviews</h4>
                            </div>
                            <div class="card-body">
                                <div id="accordion-three" class="accordion accordion-no-gutter accordion-header-bg">
                                    <div class="accordion__item">
                                        <div class="accordion__header" data-toggle="collapse" data-target="#no-gutter_collapseOne">
                                            <span class="accordion__header--text">Please low the price(Lucia)
                                            <div class="comment-review star-rating">
                                                <ul>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star-half-empty"></i></li>
                                                    <li><i class="fa fa-star-half-empty"></i></li>
                                                </ul>
                                            </div>
                                            </span>
                                            <span class="accordion__header--indicator"></span>
                                        </div>
                                        <div id="no-gutter_collapseOne" class="collapse accordion__body show" data-parent="#accordion-three">
                                            <div class="accordion__body--text">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                       <label><b>Title</b></label>
                                                       <p>Please low the price</p>
                                                    </div>
                                                    <div class="col-sm-6">
                                                       <label><b>Username</b></label>
                                                       <p>Tariq Pervaiz</p>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                       <label><b>Email</b></label>
                                                       <p>tariqpervaiz@gmail.com</p>
                                                    </div>
                                                    <div class="col-sm-6">
                                                       <label><b>Product</b></label>
                                                       <p>Lucia</p>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                  <div class="col-sm-12">
                                                  <label><b>Review</b></label>
                                                  <p>Please low the price</p>
                                                </div>
                                                </div>
                                                
                                                <div class="row">
                                                <div class="col-sm-6">
													<div style="float:left;"
														class="custom-control custom-switch toggle-switch text-right mr-3 mb-2">
														<input type="checkbox" class="custom-control-input"
															id="customSwitch1"> <label class="custom-control-label"
															for="customSwitch1">Show</label>
													</div>
												</div>
                                                </div>
                                                <div class="row" style="margin-top:1vw;">
                                                   <div class="col-sm-4">
                                                      <div class="form-group m-lb-unset row">
                                                          
                                                         <label><b>Skin Concern:&nbsp;</b></label>
                                                         <p>Oilness</p>
                                                      </div>
                                                      <div class="form-group m-lb-unset row">
                                                         <label><b>Climate:&nbsp;</b></label>
                                                         <p>Humid</p>
                                                      </div>
                                                      <div class="form-group m-lb-unset row">
                                                         <label><b>Age:&nbsp;</b></label>
                                                         <p>20 to 24</p>
                                                      </div>
                                                      <div class="form-group m-lb-unset row">
                                                         <label><b>Murad Recommendation:&nbsp;</b></label>
                                                         <p>10</p>
                                                      </div>
                                                      <div class="form-group m-lb-unset row">
                                                         <label><b>Skin Type:&nbsp;</b></label>
                                                         <p>Combination</p>
                                                      </div>
                                                      <div class="form-group m-lb-unset row">
                                                         <label><b>Recommends this product:&nbsp;</b></label>
                                                         <p>Yes</p>
                                                      </div>
                                                   </div>
                                                   <div class="col-sm-7">
                                                      <div class="form-group">
                                                        <b>Please low the price</b>
                                                      </div>
                                                      <div class="form-group">
                                                        <p>In global market,global commodities are low now but impact is not in your sales so Please low the price</p>
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
                </div>
                
                
                
            </div>
        </div>
        <!--**********************************
            Content body end
        ***********************************-->

       

    </div>
    @include('admin.admin-footer');