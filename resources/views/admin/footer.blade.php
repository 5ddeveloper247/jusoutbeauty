@include('admin.admin-header');
<style>
    .facebook {
        content: "\f39e";
        /* padding: 12px; */
        /* background: blue; */
        font-size: 26px;
        color: blue;
        padding: 12px;
        border-radius: 50%;
    }

    .twitter {
        content: "\f39e";
        /* padding: 12px; */
        /* background: blue; */
        font-size: 26px;
        color: #399ec6;
        padding: 12px;
        border-radius: 50%;
    }

    .linkedn {
        content: "\f39e";
        /* padding: 12px; */
        /* background: blue; */
        font-size: 26px;
        color: #2377c9;
        padding: 12px;
        border-radius: 50%;
    }

    .instagram {
        content: "\f39e";
        /* padding: 12px; */
        /* background: blue; */
        font-size: 26px;
        color: #ffa604;
        padding: 12px;
        border-radius: 50%;
    }

    .youtube {
        content: "\f39e";
        /* padding: 12px; */
        /* background: blue; */
        font-size: 26px;
        color: red;
        padding: 12px;
        border-radius: 50%;
    }
	.fa-tiktok:before {
		content: "\e07b";
	}
</style>
<link rel="stylesheet" href="{{ url('/assets-web') }}/vendors/fontawesome-pro-5/css/all.css">
<script>
    var userId = '<?php echo session('userId'); ?>';
    var site = '<?php echo session('site'); ?>';
    var baseurl = "<?php echo url('/assets-admin'); ?>";
</script>
<div ng-app="project1">
    <!--**********************************
            Content body start
        ***********************************-->
    <div class="content-body" ng-controller="projectinfo1">
        <div class="container-fluid">
            <div class="page-titles">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Footer</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Add</a></li>
                </ol>
            </div>
            <!-- row -->
            <div class="row">
                <div class="col-xl-12 col-xxl-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Footer Information</h4>
                        </div>
                        <div class="card-body">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" role="tablist">
                                <!--
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#website_logo">
                                            <span>
                                                Menu Items
                                            </span>
                                        </a>
                                    </li>
-->
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#menu_items">
                                        <span>
                                            Social Icons
                                        </span>
                                    </a>
                                </li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content tabcontent-border">
                                <div class="tab-pane fade " id="website_logo" role="tabpanel">
                                    <!-- <div class="pt-4">
 <div class="card-body">
 <div class="row">
 <div class="col-sm-6">
 <div class="form-group">
            <label for="home">Your Account</label>
            <input type="text" id="your_acc" name="your_acc" class="form-control font-w500">
            </div>
 </div>
 <div class="col-sm-3">
 <div class="custom-control custom-checkbox mb-3 checkbox-warning">
                        <input type="checkbox" class="custom-control-input" checked id="your_accactive" name="your_accactive">
                        <label class="custom-control-label" for="your_accactive">Active</label>
                        </div>
 </div>
 <div class="col-sm-3">
 <button class="btn btn-rounded btn-warning cmbm-2vw" style="width:100%;">Save</button>
 </div>
 </div>
 <div class="row">
 <div class="col-sm-6">
 <div class="form-group">
            <label for="products">Track your order</label>
            <input type="text" id="tco" name="tco" class="form-control font-w500">
            </div>
 </div>
 <div class="col-sm-3">
 <div class="custom-control custom-checkbox mb-3 checkbox-warning">
                        <input type="checkbox" class="custom-control-input" checked id="tcoactive" name="tcoactive">
                        <label class="custom-control-label" for="tcoactive">Active</label>
                        </div>
 </div>
 <div class="col-sm-3">
 <button class="btn btn-rounded btn-warning cmbm-2vw" style="width:100%;">Save</button>
 </div>
 </div>
 
 <div class="row">
 <div class="col-sm-6">
 <div class="form-group">
            <label for="contactus">Contact</label>
            <input type="text" id="contact" name="contact" class="form-control font-w500">
            </div>
 </div>
 <div class="col-sm-3">
 <div class="custom-control custom-checkbox mb-3 checkbox-warning">
                        <input type="checkbox" class="custom-control-input" checked id="contactactive" name="contactactive">
                        <label class="custom-control-label" for="contactactive">Active</label>
                        </div>
 </div>
 <div class="col-sm-3">
 <button class="btn btn-rounded btn-warning cmbm-2vw" style="width:100%;">Save</button>
 </div>
 </div>
 
 <div class="row">
 <div class="col-sm-6">
 <div class="form-group">
            <label for="contactus">FAQs</label>
            <input type="text" id="faqs" name="faqs" class="form-control font-w500">
            </div>
 </div>
 <div class="col-sm-3">
 <div class="custom-control custom-checkbox mb-3 checkbox-warning">
                        <input type="checkbox" class="custom-control-input" checked id="faqsactive" name="faqsactive">
                        <label class="custom-control-label" for="faqsactive">Active</label>
                        </div>
 </div>
 <div class="col-sm-3">
 <button class="btn btn-rounded btn-warning cmbm-2vw" style="width:100%;">Save</button>
 </div>
 </div>
 
 <div class="row">
 <div class="col-sm-6">
 <div class="form-group">
            <label for="giving">Shipping & Returns</label>
            <input type="text" id="giving" name="giving" class="form-control font-w500">
            </div>
 </div>
 <div class="col-sm-3">
 <div class="custom-control custom-checkbox mb-3 checkbox-warning">
                        <input type="checkbox" class="custom-control-input" checked id="shippingreturns_active" name="shippingreturns_active">
                        <label class="custom-control-label" for="shippingreturns_active">Active</label>
                        </div>
 </div>
 <div class="col-sm-3">
 <button class="btn btn-rounded btn-warning cmbm-2vw" style="width:100%;">Save</button>
 </div>
 </div>
    
 
    
    
    
    
         </div>
 </div> -->
                                </div>
                                <!-- Mujtaba -->
                                <div class="tab-pane fade show active" id="menu_items" role="tabpanel">
                                    <div class="pt-4">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-sm-10">
                                                    <div class="d-flex mb-3 align-items-center bg-light rounded">
                                                        <i class="fab fa-facebook-f facebook"></i>

                                                        <input type="text" class=" form-control font-w500"
                                                            ng-model="social['S_1']" value="">
                                                    </div>
                                                </div>
                                                <div class="col-sm-2 mt-3">
                                                    <div class="custom-control custom-checkbox mb-3 checkbox-warning">
                                                        <input type="checkbox" class="custom-control-input" checked
                                                            id="fbactive" name="fbactive" ng-model="social['S_2']">
                                                        <label class="custom-control-label"
                                                            for="fbactive">Active</label>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="row">
                                                <div class="col-sm-10">
                                                    <div class="d-flex mb-3 align-items-center bg-light rounded">
                                                        <i class="fab fa-instagram instagram"></i>

                                                        <input type="text" class=" form-control font-w500"
                                                            ng-model="social['S_3']" value="">
                                                    </div>
                                                </div>
                                                <div class="col-sm-2 mt-3 ">

                                                    <div class="custom-control custom-checkbox mb-3 checkbox-warning">
                                                        <input type="checkbox" class="custom-control-input" checked
                                                            id="instactive" name="youtubeactive"
                                                            ng-model="social['S_4']">
                                                        <label class="custom-control-label"
                                                            for="instactive">Active</label>
                                                    </div>
                                                </div>


                                            </div>


                                            <div class="row">
                                                {{-- <div class="col-sm-10">
                                                    <div class="d-flex mb-3 align-items-center bg-light rounded">
                                                        <i class="fab fa-twitter twitter"></i>
                                                        <input type="text" class=" form-control font-w500"
                                                            ng-model="social['S_5']">

                                                    </div>
                                                </div> --}}
												<div class="col-sm-10">
                                                    <div class="d-flex mb-3 align-items-center bg-light rounded">
														<img  style="width:48px;padding:10px" src="{{ url('/assets-admin') }}/images/admin/tictok.png" class="rounded-circle user_img" alt=""/>

                                                        <input type="text" class=" form-control font-w500"
                                                            ng-model="social['S_5']">

                                                    </div>
                                                </div>
                                                <div class="col-sm-2 mt-3">
                                                    <div class="custom-control custom-checkbox mb-3 checkbox-warning">
                                                        <input type="checkbox" class="custom-control-input" checked
                                                            id="twactive" name="twactive" ng-model="social['S_6']"
                                                            value="">
                                                        <label class="custom-control-label"
                                                            for="twactive">Active</label>
                                                    </div>
                                                </div>


                                            </div>
                                            <div class="row">
                                                <div class="col-sm-10 ">
                                                    <div class="d-flex mb-3 align-items-center bg-light rounded">
                                                        <i class="fab fa-linkedin linkedn"></i>
                                                        <input type="text" class=" form-control font-w500"
                                                            ng-model="social['S_7']">
                                                    </div>
                                                </div>

                                                <div class="col-sm-2 mt-3">
                                                    <div class="custom-control custom-checkbox mb-3 checkbox-warning">

                                                        <input type="checkbox" class="custom-control-input" checked
                                                            id="linkedinactive" name="linkedinactive"
                                                            ng-model="social['S_8']">
                                                        <label class="custom-control-label"
                                                            for="linkedinactive">Active</label>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="row">
                                                <div class="col-sm-10">
                                                    <div class="d-flex mb-3 align-items-center bg-light rounded">
                                                        <i class="fab fa-youtube youtube"></i>
                                                        <input type="text" class=" form-control font-w500"
                                                            ng-model="social['S_9']">
                                                    </div>
                                                </div>
                                                <div class="col-sm-2 mt-3 ">

                                                    <div class="custom-control custom-checkbox mb-3 checkbox-warning">
                                                        <input type="checkbox" class="custom-control-input" checked
                                                            id="youtubeactive" name="youtubeactive"
                                                            ng-model="social['S_10']">
                                                        <label class="custom-control-label"
                                                            for="youtubeactive">Active</label>
                                                    </div>
                                                </div>


                                            </div>


                                            <div class="row mt-3" style="padding-top:15px;">
                                                <div class="col-sm-3 mt-5 m-auto text-center">
                                                    <button class="btn btn-rounded btn-warning cmbm-2vw"
                                                        style="width:100%;"
                                                        ng-click="saveSocialicons(); ">Save</button>
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

<script src="{{ url('/assets-admin') }}/customjs/script_adminWebsite_footer.js?v={{ time() }}"></script>
