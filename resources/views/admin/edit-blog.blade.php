
    @include('admin.admin-header');
		
		
        
         <!--**********************************
                    Content body start
                ***********************************-->
                <div class="content-body">
                    <div class="container-fluid">
                        <div class="page-titles">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Post</a></li>
                                <li class="breadcrumb-item active"><a href="javascript:void(0)">Process</a></li>
                            </ol>
                        </div>
                        <!-- row -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Post</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-validation">
                                            <form class="form-valide" action="#" method="post">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
        
                                                            <label class="col-form-label" for="title"><b>Title</b> <span
                                                                class="text-danger">*</span>
                                                            </label>
                                                             <input type="text" class="form-control" id="title"
                                                                name="title" placeholder="Enter a Title">
        
                                                        </div>
                                                      </div>
                                                      <div class="col-sm-6">
                                                        <div class="form-group">
        
                                                            <label class="col-form-label" for="category"><b>Category<span class="text-danger">*</span></b>
                                                            </label>
                                                            <select class="default-placeholder" id="category" name="category">
                                                               <option value="">---SELECT---</option>
                                                               <option value="">Skin Care</option>
                                                            
                                                            </select>
                                                            
                                                        </div>
                                                      </div>
                                                    
                                                    
                                                </div>
                                                
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
        
                                                            <label class="col-form-label" for="slug"><b>Slug<span class="text-danger">*</span></b>
                                                            </label>
                                                             <input type="text" class="form-control" id="slug"
                                                                name="slug" placeholder="Enter Slug">
        
                                                        </div>
                                                      </div>
                                                    
                                                    
                                                </div>
                                                <div class="row">
                                                   <div class="col-sm-12">
                                                   <label class="col-form-label" for="slug"><b>Short Description</b></label>
                                                     <textarea id="short_description" name="short_description" class="form-control"></textarea>
                                                   </div>
                                                </div>
                                                <div class="row">
                                                   <div class="col-sm-12">
                                                       <label class="col-form-label" for="description"><b>Description</b></label>
                                                       <div class="summernote"></div>
                                                   </div>
                                                </div>
                                                
                                            <div id="lightgallery" class="row mt-3">
                                                <a href="images/big/img1.jpg" data-exthumbimage="images/big/img1.jpg" data-src="images/big/img1.jpg" class="col-lg-3 col-md-6 mb-4">
                                                    <img src="http://www.jusoutbeauty.com/site/themes/images/admin/big/img1.jpg" style="width:100%;"/>
                                                </a>
                                                
                                          </div>
                                         <div class=" ml-0 ml-sm-12 ml-sm-0 mt-3">
                                            
                                            <div class="compose-content">
                                                <form action="#">
                                                  
                                                </form>
                                                <h5 class="mb-4"><i class="fa fa-paperclip"></i> Banner</h5>
                                                <form action="#" class="dropzone">
                                                    <div class="fallback">
                                                        <input name="bannerfile" type="file" />
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="text-left mt-4 mb-2">
                                                <button class="btn btn-primary btn-sl-sm mr-2" type="button"><span class="mr-2"><i class="fa fa-paper-plane"></i></span>Send</button>
                                                <button class="btn btn-danger light btn-sl-sm" type="button"><span class="mr-2"><i class="fa fa-times" aria-hidden="true"></i></span>Discard</button>
                                            </div>
                                        </div>
                                                
                                                
                                                <div class="save-admin-center mt-3">
                                                   <button class="btn btn-rounded btn-success mobile-save-btn">Save Post</button>
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