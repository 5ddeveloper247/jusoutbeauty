@include('admin.admin-header');
 <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <div class="container-fluid">
                <div class="page-titles">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="javascript:void(0)">Shade</a></li>
						<li class="breadcrumb-item active"><a href="javascript:void(0)">Process</a></li>
					</ol>
                </div>
                <!-- row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Shade</h4>
                            </div>
                            <div class="card-body">
                                <div class="form-validation">
									<form class="form-valide" action="#" method="post">
										<div class="row">
											<div class="col-sm-6">
												<div class="form-group">

													<label class="col-form-label" for="Title"><b>Title</b> <span
														class="text-danger">*</span>
													</label> <input type="text" class="form-control" id="title"
														name="title" placeholder="Enter a Title...">

												</div>
											</div>
											
										</div>
										<div class="row">
										   <div class="col-sm-12">
										      
										   <label class="col-form-label" for="quantity_in_stock"><b>Description</b> <span class="text-danger">*</span></label>
                                           <div class="summernote"></div>
										   </div>
										</div>
										<div id="lightgallery" class="row mt-3">
									<a href="images/big/img1.jpg" data-exthumbimage="images/big/img1.jpg" data-src="images/big/img1.jpg" class="col-lg-3 col-md-6 mb-4">
										<img src="http://www.jusoutbeauty.com/themes/images/admin/big/img1.jpg" style="width:100%;"/>
									</a>
									<a href="images/big/img2.jpg" data-exthumbimage="images/big/img2.jpg" data-src="images/big/img2.jpg" class="col-lg-3 col-md-6 mb-4">
										<img src="http://www.jusoutbeauty.com/themes/images/admin/big/img2.jpg" style="width:100%;" />
									</a>
									<a href="images/big/img3.jpg" data-exthumbimage="images/big/img3.jpg" data-src="images/big/img3.jpg" class="col-lg-3 col-md-6 mb-4">
										<img src="http://www.jusoutbeauty.com/themes/images/admin/big/img3.jpg" style="width:100%;" />
									</a>
									<a href="images/big/img4.jpg" data-exthumbimage="images/big/img4.jpg" data-src="images/big/img4.jpg" class="col-lg-3 col-md-6 mb-4">
										<img src="http://www.jusoutbeauty.com/themes/images/admin/big/img4.jpg" style="width:100%;" />
									</a>
									<a href="images/big/img5.jpg" data-exthumbimage="images/big/img5.jpg" data-src="images/big/img5.jpg" class="col-lg-3 col-md-6 mb-4">
										<img src="http://www.jusoutbeauty.com/themes/images/admin/big/img5.jpg" style="width:100%;"/>
									</a>
									<a href="images/big/img6.jpg" data-exthumbimage="images/big/img6.jpg" data-src="images/big/img6.jpg" class="col-lg-3 col-md-6 mb-4">
										<img src="http://www.jusoutbeauty.com/themes/images/admin/big/img6.jpg" style="width:100%;" />
									</a>
									<a href="images/big/img7.jpg" data-exthumbimage="images/big/img7.jpg" data-src="images/big/img7.jpg" class="col-lg-3 col-md-6 mb-4">
										<img src="http://www.jusoutbeauty.com/themes/images/admin/big/img7.jpg" style="width:100%;" />
									</a>
									<a href="images/big/img8.jpg" data-exthumbimage="images/big/img8.jpg" data-src="images/big/img8.jpg" class="col-lg-3 col-md-6 mb-4">
										<img src="http://www.jusoutbeauty.com/themes/images/admin/big/img8.jpg" style="width:100%;" />
									</a>
								</div>
                                 <div class=" ml-0 ml-sm-12 ml-sm-0 mt-3">
                                    
                                    <div class="compose-content">
                                        <form action="#">
                                          
                                        </form>
                                        <h5 class="mb-4"><i class="fa fa-paperclip"></i> Attatchment</h5>
										<form action="#" class="dropzone">
											<div class="fallback">
												<input name="file" type="file" multiple />
											</div>
										</form>
                                    </div>
                                    <div class="text-left mt-4 mb-2">
                                        <button class="btn btn-primary btn-sl-sm mr-2" type="button"><span class="mr-2"><i class="fa fa-paper-plane"></i></span>Send</button>
                                        <button class="btn btn-danger light btn-sl-sm" type="button"><span class="mr-2"><i class="fa fa-times" aria-hidden="true"></i></span>Discard</button>
                                    </div>
                                </div>
									</form>
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