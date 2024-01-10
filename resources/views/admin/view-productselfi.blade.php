@include('admin.admin-header')
<script>
    var site = '<?php echo session('site'); ?>';
    var baseurl = "<?php echo url('/assets-admin'); ?>";
</script>
<style>
    .cursor-pointer{
        cursor: pointer;
    }
    .image-box {
        display: block;
        width: 14vw;
        height: 9vw;
    }

    div.show-image {
        position: relative;
        float: left;
        margin: 5px;
    }

    div.show-image:hover img {
        opacity: 0.5;
    }

    div.show-image:hover video {
        opacity: 0.5;
    }

    div.show-image:hover i {
        display: block;
    }

    div.show-image i {
        position: absolute;
        display: none;
    }

    div.show-image i.delete {
        top: .5rem;
        left: 88%;
    }
</style>
<div ng-app="project1">
    <!--**********************************
            Content body start
        ***********************************-->
    <div class="content-body" ng-controller="projectinfo1">
        <div class="container-fluid" ng-show="editView == '0'">
            <div class="page-titles mb-0">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Snap Selfie</a></li>
                </ol>
            </div>
            <!-- row -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Snap Selfie</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="snapselfieTable" class="display min-w850">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            {{-- <th>Selfie</th> --}}
                                            <th>Username</th>
                                            <th>Product Name</th>
                                            <th>Email</th>
                                            <th>Total Selfies</th>
                                            <th>Status</th>

                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr ng-repeat="row in displayCollectionSnapselfie">
                                            <td>@{{ row.seqNo }}</td>
                                            {{-- <td class="">@{{ row.DOWN_PATH }}<a href="@{{ row.DOWN_PATH }}" target="_blank"><img class="round-product-img" src="@{{ row.DOWN_PATH }}"></a></td> --}}
                                            <td>@{{ row.NAME }}</td>
                                            <td>@{{ row.PRODUCT_NAME }}</td>
                                            <td>@{{ row.EMAIL }}</td>
                                            <td>@{{ row.NUMBER_OF_SELFIES }}</td>
                                            <td>
                                                <span class="badge light badge-success" ng-if="row.STATUS == '1'">
                                                    <i class="fa fa-circle text-success mr-1"></i>
                                                    Active
                                                </span>
                                                <span class="badge light badge-danger" ng-if="row.STATUS != '1'">
                                                    <i class="fa fa-circle text-danger mr-1"></i>
                                                    InActive
                                                </span>
                                            </td>
                                            <td>
                                                <div class="dropdown ml-auto text-right">
                                                    <div class="btn-link" data-toggle="dropdown">
                                                        <svg width="24px" height="24px" viewBox="0 0 24 24"
                                                            version="1.1">
                                                            <g stroke="none" stroke-width="1" fill="none"
                                                                fill-rule="evenodd">
                                                                <rect x="0" y="0" width="24"
                                                                    height="24"></rect>
                                                                <circle fill="#000000" cx="5" cy="12"
                                                                    r="2"></circle>
                                                                <circle fill="#000000" cx="12" cy="12"
                                                                    r="2"></circle>
                                                                <circle fill="#000000" cx="19" cy="12"
                                                                    r="2"></circle>
                                                            </g>
                                                        </svg>
                                                    </div>

                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" style="cursor:pointer;"
                                                            ng-click="getspecifiselfie(@{{ row.SELFIE_ID }});">View</a>
                                                        <a class="dropdown-item" href="javascript:;"
                                                            ng-click="changeStatus(@{{ row.SELFIE_ID }});"
                                                            ng-if="row.STATUS == '0'">Active</a>
                                                        <a class="dropdown-item" href="javascript:;"
                                                            ng-click="changeStatus(@{{ row.SELFIE_ID }});"
                                                            ng-if="row.STATUS != '0'">Inactive</a>
                                                        <a class="dropdown-item" style="cursor:pointer;"
                                                            ng-click="deleteselfiemodal(@{{ row.SELFIE_ID }});">Delete</a>
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

        <div class="modal fade" id="selfiemodal">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Selfies</h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" style="margin-left: auto;margin-right: auto;">

                        <!-- <div class="row" id="img_file" > -->

                        <div class="col-2 m-2 " ng-repeat="row in selfies">
                            <div class="show-image img_remove_@{{ row.id }}">
                                <img ng-if="row.FILE_TYPE != 'mp4'" src="@{{ row.DOWNPATH }}" width="200"
                                    height="200" class="image-box" style="margin-bottom:10px !important;">

                                <video ng-if="row.FILE_TYPE == 'mp4'" width="200" controls>
                                    <source src="@{{ row.DOWNPATH }}" type="video/mp4">
                                    <source src="@{{ row.DOWNPATH }}" type="video/ogg">

                                </video>

                               <a class="cursor-pointer" ng-click="deleteSelectedSelfi(@{{ row.id }});"><i class="fa fa-trash text-danger delete" style="font-size:20px"></i></a> 
                            </div>
                        </div>

                        <!-- </div> -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger light" data-dismiss="modal">Close</button>
                        <!-- <button type="button" class="btn btn-warning" ng-click="saveTypename()">Save changes</button> -->
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
                    <input type="hidden" id="selfieid">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger light" data-dismiss="modal">No</button>
                        <button type="button" class="btn btn-primary" ng-click="deletespecificselfie()">Yes</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--**********************************
            Content body end
        ***********************************-->

</div>
@include('admin.admin-footer')

<script src="{{ url('/assets-admin') }}/customjs/script_adminproductsnapselfie.js?v={{ time() }}"></script>
