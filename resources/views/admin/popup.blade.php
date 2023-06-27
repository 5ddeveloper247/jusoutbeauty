@include('admin.admin-header');
<script>
    var userId = <?php echo session('userId'); ?>;
    var site = '<?php echo session('site'); ?>';
    var baseurl = "<?php echo url('/assets-admin'); ?>";
</script>
<div ng-app="project1">
    <div class="content-body" ng-controller="projectinfo1">
        <div class="container-fluid">
            <div class="page-titles">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home Page
                            Popup</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Update</a></li>
                </ol>
            </div>
            <div class="container-fluid pt-0">
                <!-- row -->
                <div class="row">
                    <div class="col-xl-12 col-xxl-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Home Page Popup</h4>
                            </div>
                            <div class="card-body">
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item"><a class="nav-link active" data-toggle="tab"
                                            href="#basic_info"> <span> Basic Info </span>
                                        </a></li>
                                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#description">
                                            <span>Media </span>
                                        </a></li>
                                </ul>
                                <!-- Tab panes -->
                                <div class="tab-content tabcontent-border">
                                    <div class="tab-pane fade show active" id="basic_info" role="tabpanel">
                                        <div class="pt-4">
                                            <div class="form-validation">
                                                <form class="form-valide" action="#" id="popupForm">

                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label class="col-form-label" for="first_title"><b>First
                                                                        Titlte</b> <span class="text-danger">*</span>
                                                                </label>
                                                                <input type="text" class="form-control"
                                                                    id="first_title" ng-model="popup['FIRST_TITLE']"
                                                                    placeholder="Enter First Title" maxlength="50">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label class="col-form-label"
                                                                    for="discount"><b>Discount</b> </label>
                                                                <input type="number" class="form-control"
                                                                    maxlength="2" id="discount"
                                                                    ng-model="popup['DISCOUNT']"
                                                                    placeholder="Enter Discount Percentage" id="discount">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label class="col-form-label"
                                                                    for="second_title"><b>Second
                                                                        Titlte</b> <span class="text-danger">*</span>
                                                                </label>
                                                                <input type="text" class="form-control"
                                                                    id="second_title" ng-model="popup['SECOND_TITLE']"
                                                                    placeholder="Enter Second Title" maxlength="75">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label class="col-form-label"
                                                                    for="color"><b>Background Color</b></label>
                                                                <input type="color" class="form-control"
                                                                    id="color" ng-model="popup['BACKGROUND_COLOR']"
                                                                    placeholder="Enter Second Title">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="pt-4 row">
                                                        <div class="form-group col-sm-6">
                                                            <label id="btn-title">Button Text</label>
                                                            <input type="text" id="btn-title" class="form-control"
                                                                ng-model="popup['BUTTON_TEXT']"
                                                                placeholder="Write Button Text Here...">
                                                        </div>
                                                        <div class="form-group col-sm-6">
                                                            <label id="btn-link">Button Link</label>
                                                            <input type="url" id="btn-link" class="form-control"
                                                                ng-model="popup['BUTTON_LINK']"
                                                                placeholder="Write Button Link Here...">
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <button class="btn btn-warning float-right" ng-click="savePopupData();">Save Basic
                                                            Info</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="description" role="tabpanel">
                                        <div class="col-sm-12 col-12 register-new-product-picture-para-box mt-5">
                                                    <div class="row register-new-product-picture-para">
                                                        <div class="col-sm-2 image-overlay upload-photo-box"
                                                            id="imageAttach-btn" onclick="form1();" style="">
                                                            <img src="{{ url('/assets-admin') }}/images/admin/upload.svg"
                                                                alt="" width="50">
                                                            <p>1200 X 600</p>
                                                        </div>
                                                        <div class="col-sm-9">
                                                            <div class="row" id="p_att">
                                                                <img src="" alt="" ng-model="popup['DOWN_PATH']" id="preview" width="400" height="300">
                                                            </div>
                                                        </div>
                                                        <form class="" id="uploadattch" method="POST"
                                                            action="uploadPopupImage"
                                                            enctype="multipart/form-data">
                                                            <input type="hidden" name="_method" value="POST">

                                                            {{ csrf_field() }}

                                                            <input type="hidden" id="userId" name="userId"
                                                                value="<?php echo session('userId'); ?>">
                                                            <input type="hidden" id="sourceId" name="sourceId"
                                                                value="@{{ popup.ID }}">
                                                            <input type="file" id="uploadattl" name="uploadImage"
                                                                class="file-input" style="display: none;" accept="images/*">

                                                        </form>

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

@include('admin.admin-footer');

<script src="{{ url('/assets-admin') }}/customjs/script_adminpopup.js?v={{ time() }}"></script>

<script>
    function form1() {
        $("#uploadattl").click();
    }
</script>
