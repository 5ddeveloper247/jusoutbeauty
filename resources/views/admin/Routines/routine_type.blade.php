@include('admin.admin-header');
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
            <div class="row">
                <div class="col-xl-12 col-xxl-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Routine Type</h4>
                            <button class="btn btn-rounded btn-warning cmbm-6vw mb-3 text-light w-25"
                                         ng-click="addtype();">Add</button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="type_table" class="display min-w850">
                                    <thead>
                                        <tr>
                                            <th>Seq</th>
                                            <th>Routine Type</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 0; ?>
                                        <tr ng-repeat="row in getAllRoutineTypes">
                                            <td>@{{ row.ROUTINETYPE_ID }}</td>
                                            <td>@{{ row.TYPE_NAME }}</td>
                                            <td>
                                                <span class="badge light badge-success" ng-if="row.STATUS == 'active'">
                                                    <i class="fa fa-circle text-success mr-1"></i>
                                                    Active
                                                </span>
                                                <span class="badge light badge-danger" ng-if="row.STATUS != 'active'">
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
                                                        <a class="dropdown-item"
                                                            ng-click="removetypenamemodal(@{{ row.ROUTINETYPE_ID }});">Remove</a>
                                                        <a class="dropdown-item"
                                                            ng-click="continuetypename(@{{ row.ROUTINETYPE_ID }});">Edit</a>
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

        <div class="modal fade" id="RoutineTypeModal">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Routine Type</h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- <div class="row">
                           <div class="col-12">
                                <label><b>Parent /Sub<span class="required-field">*</span></b></label>
                                <select class="form-control" id="input_subcategory" ng-model="subSubCategory['C_1']"
                                ng-options="item as item.name for item in subcategoryLov track by item.id">
                                    <option value="">---SELECT---</option>
                                </select>
                           </div>
                        </div> -->
                        <div class="row">
                           <div class="col-12">
                           <input type='hidden' name="routinetypeid" id="type_name_id" class="form-control" ng-model="routinetype['ID']" placeholder="Enter Name...">
                             <label><b>Enter Routine Type Name<span class="required-field">*</span></b></label>
                             <input  name="name" id="name" class="form-control" ng-model="routinetype['C_1']" placeholder="Enter Name...">
                           </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger light" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-warning" ng-click="saveTypename()">Save changes</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="alertroutinetypemodal">
            <div class="modal-dialog" role="document">
                <div class="modal-content align-center-verticle">
                    <div class="modal-header" style="border:unset;">
                        <h3 class="modal-title">Alert</h3>
                    </div>
                    <input type="hidden" id="routine_type_remove_id" >
                    <div class="modal-body">
                       <h4 style="text-align: center;">Are you Sure you want to delete this routine type with all of its Steps</h4>
                    </div>
                    <div class="modal-footer" style="border-top: unset !important;">
                        <button type="button" class="btn btn-danger light" style="cursor:pointer;" ng-click="closealertDeleteModal('alertroutinetypemodal')">Close</button>
                        <button type="button" class="btn btn-primary" style="cursor:pointer;" ng-click="remove_routine_type_name()">Yes</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@include('admin.admin-footer');
<script src="{{ url('/assets-admin') }}/customjs/script_adminroutine_type.js?v={{time()}}"></script>
