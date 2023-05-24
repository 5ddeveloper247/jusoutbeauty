@include('admin.admin-header')
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
						<li class="breadcrumb-item"><a href="javascript:void(0)">Sent Email</a></li>
					</ol>
                </div>
                <!-- row -->

                <div class="row">
					<div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Sent Email</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="emailTable" class="display min-w850">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>To</th>
                                                <th>From</th>
                                                <th>Module</th>
                                                <th>Subject</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                            <tr ng-repeat="row in displayCollectionEmail">
                                                <td>@{{row.seqNo}}</td>
                                                <td>@{{row.TO_USER_EMAIL}}</td>
                                                <td>@{{row.FROM_USER_EMAIL}}</td>
                                                <td>@{{row.TITLE}}</td>
                                                <td>@{{row.SUBJECT}}</td>
                                               <td>
													<span class="badge light badge-success"> <!-- badge-danger -->
														<i class="fa fa-circle text-success mr-1"></i>
														@{{row.EMAIL_STATUS}}
													</span>
												</td>
                                                
                                                <td>
													<div class="dropdown ml-auto text-right">
														<div class="btn-link" data-toggle="dropdown">
															<svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg>
														</div>
														<div class="dropdown-menu dropdown-menu-right">
															<a class="dropdown-item" href="javascript:;" ng-click="deleteSentEmail(row.EMAIL_ID);">Delete</a>
<!-- 															<a class="dropdown-item"  href="#"  data-toggle="modal" data-target=".view_email">View</a> -->
<!-- 															<a class="dropdown-item"  href="#"  data-toggle="modal" data-target=".send_repy">Reply</a> -->
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

			<div class="modal fade view_email" tabindex="-1"
				role="dialog" aria-hidden="true">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">Email Detail</h5>
							<button type="button" class="close" data-dismiss="modal">
								<span>&times;</span>
							</button>
						</div>
						<div class="modal-body">
						     <div class="form_row row">
                                
									<div class="col-sm-12">
                                  <div id="complete_email">
          <div style="background-color:rgb(244,244,244);margin:0px!important;padding:0px!important">
          <table border="0" cellpadding="0" cellspacing="0" width="100%">
	     
        <tbody>
          <tr>
            <td bgcolor="#FFA73B" align="center" style="background:#05568c">
                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:600px">
                    <tbody><tr>
                        <td align="center" valign="top" style="padding:40px 10px 40px 10px"> </td>
                    </tr>
                </tbody></table>
            </td>
        </tr>
        <tr>
            <td bgcolor="#FFA73B" align="center" style="padding:0px 10px 0px 10px;background:#05568c">
                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:600px">
                    <tbody><tr>
                        <td style="background: transparent;color: white;" align="center" valign="top">
                            <h1 style="font-size:48px;font-weight:400;margin:2">Signin OTP!</h1>
                            <img src="http://vokausa.com/site/application/modules/app/views/attachment/email/logo/6_2022-05-16_03:18:13_AM.jpg" width="200" height="190" style="display:block;border:0px" class="CToWUd" jslog="138226; u014N:xr6bB; 53:W2ZhbHNlXQ..">
                        </td>
                    </tr>
                </tbody></table>
            </td>
        </tr>
        <tr>
            <td bgcolor="#f4f4f4" align="center" style="padding:0px 10px 0px 10px">
                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                    <tbody><tr>
                        <td bgcolor="#ffffff" align="left" style="padding: 20px 30px 40px 30px; color: #666666; font-family: " lato",="" helvetica,="" arial,="" sans-serif;="" font-size:="" 18px;="" font-weight:="" 400;="" line-height:="" 25px;"="">
                            <p style="margin: 0;">Hi hamzawaheed195@gmail.com, <br>Have a great Sun! We have sent you an OTP to your registered mobile number with us Please use it to proceed with your transaction</p>
                        </td>
                    </tr>
                    <tr>
                        <td bgcolor="#ffffff" align="left" style="padding: 20px 30px 20px 30px; color: #666666; font-family: " lato",="" helvetica,="" arial,="" sans-serif;="" font-size:="" 18px;="" font-weight:="" 400;="" line-height:="" 25px;"="">
                            <p style="margin: 0;display:none;"><a href="#" target="_blank" style="color: #FFA73B;">Dear hamzawaheed195@gmail.com, PIN for "Login" is</a></p>
							<p style="margin: 0;"><a href="#" target="_blank" style="color: #FFA73B;">Use this OTP code to verify this email address</a></p>
                        </td>
                    </tr>
                                
<tr>
                        <td bgcolor="#ffffff" align="left">
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tbody><tr>
                                    <td bgcolor="#ffffff" align="center" style="padding: 20px 30px 60px 30px;">
                                        <table border="0" cellspacing="0" cellpadding="0">
                                            <tbody><tr>
                                                <td align="center" style="border-radius: 3px;" bgcolor="#46af34"><a href="#" target="_blank" style="font-size: 20px;font-family: Helvetica, Arial, sans-serif;color: #ffffff;text-decoration: none;color: #ffffff;text-decoration: none;padding: 15px 25px;border-radius: 2px;border: 1px solid #46af34;display: inline-block;">12345</a></td>
                                            </tr>
                                        </tbody></table>
                                    </td>
                                </tr>
                            </tbody></table>
                        </td>
                    </tr> <!-- COPY -->
                     <!-- COPY -->
                                                    
                                                    
                    <tr>
                        <td bgcolor="#ffffff" align="left" style="padding: 0px 30px 20px 30px; color: #666666; font-family: " lato",="" helvetica,="" arial,="" sans-serif;="" font-size:="" 18px;="" font-weight:="" 400;="" line-height:="" 25px;"="">
                            <p style="margin: 0;">The PIN is generated on 18-May-2022 07:09:55 This OTP is valid for 10 minutes. <br>Please ignore this email if you have already used the OTP sent to your registered number</p>
                        </td>
                    </tr>
                    <tr>
                        <td bgcolor="#ffffff" align="left" style="padding: 0px 30px 40px 30px; border-radius: 0px 0px 4px 4px; color: #666666; font-family: " lato",="" helvetica,="" arial,="" sans-serif;="" font-size:="" 18px;="" font-weight:="" 400;="" line-height:="" 25px;"="">
                            <p style="margin: 0;">Kind Regards,<br>Jusout Beauty team</p>
                        </td>
                    </tr>
                </tbody>
            </table>
            </td>
        </tr>
        <tr>
            <td bgcolor="#f4f4f4" align="center" style="padding:30px 10px 0px 10px">
                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:600px">
                    <tbody><tr>
                        <td bgcolor="#05568c" align="center">
                            <h2 style="font-size:20px;font-weight:400;color:white;margin:0;display:none">Need more help?</h2>
                            <p style="margin:0"><a style="color:white">JusoutBeauty.</a></p>
                        </td>
                    </tr>
                </tbody></table>
            </td>
        </tr>
        <tr>
            <td bgcolor="#f4f4f4" align="center" style="padding:0px 10px 0px 10px">
                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:600px">
                    <tbody><tr>
                        <td bgcolor="#f4f4f4" align="left"> <br>
                            <p style="margin:0"><a href="#m_2347606435075988245_" style="color:#111111;font-weight:700"></a>.</p>
                        </td>
                    </tr>
                </tbody></table>
            </td>
        </tr>
    </tbody></table>
	     
</div></div>
                                  </div>
                              	</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-danger light"
								data-dismiss="modal">Close</button>
							<button type="button" class="btn btn-primary">Send</button>
						</div>
					</div>
				</div>
			</div>




       <!-- ---------- REPLY -->
       <div class="modal fade send_repy" tabindex="-1"
				role="dialog" aria-hidden="true">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">Reply</h5>
							<button type="button" class="close" data-dismiss="modal">
								<span>&times;</span>
							</button>
						</div>
						<div class="modal-body">
						    
						     <div class="row">
						       <div class="col-sm-12">
						         <label><b>Reply<span style="color:red;">*</span></b></label>
						         
 		                    <div class="summernote"></div>
						       </div>
						     </div>
<!-- 		                    <div class="summernote"></div> -->
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-danger light"
								data-dismiss="modal">Close</button>
							<button type="button" class="btn btn-primary">Send</button>
						</div>
					</div>
				</div>
			</div>
       <!-- --------------------------- -->
		</div>
        <!--**********************************
            Content body end
        ***********************************-->

    </div>
    @include('admin.admin-footer')
    
  	<script src="{{ url('/assets-admin') }}/customjs/script_adminemail.js?v={{time()}}"></script>