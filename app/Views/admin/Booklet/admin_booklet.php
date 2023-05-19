<script src="<?php echo base_url('/js/jquery.min.js'); ?>"></script>
<script src="<?php echo base_url('/js/popper.min.js'); ?>"></script>
<script src="<?php echo base_url('/js/bootstrap.min.js'); ?>"></script>

    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                             <?php echo view('admin/_topmessage'); ?>
                             
                          <div class="row">
                            <div class="col-lg-3"> 
                               <h4 class="card-title">Booklet</h4>     
                          </div>                        
                    </div>
                  <hr>
                 <form class="custom-validation"  method='post' action="<?php echo site_url('BookletController/saveBooklet'); ?>" enctype="multipart/form-data">                        
                              <div class="for-mobile-laptop">
                              	   <div class="row">
                                <div class="col-md-10">
                                  <div class="form-group row">
                                  <input type="hidden" name="booklet_id" id="booklet_id" value="<?php echo is_array($booklet) ? $booklet['id'] : ""; ?>" />
                                  </div>
                               </div>                             
                           </div>
                              <div class="row">
                                <div class="col-md-10">
                                  <div class="form-group row">
                                    <label for="inputPassword" class="col-sm-2 ml-4 col-form-label">Booklet Name</label>
                                    <div class="col-sm-6">
                                    <input type="text" name="booklet_name" id="booklet_name" class="form-control" value="<?php echo is_array($booklet) ? $booklet['booklet_name'] : ""; ?>">
                                   </div>
                                   
                                  </div>
                               </div>                             
                           </div>
                           <div class="row">
                                <div class="col-md-10">
                                  <div class="form-group row">
                                    <label for="inputPassword" class="col-sm-2 ml-4 col-form-label">Booklet</label>
                                    <div class="col-sm-6">
                                    <input type="file" name="booklet" id="booklet" class="form-control" accept="application/pdf">
                                    <?php if(!empty($booklet)) { ?>
                                        <?php if($booklet['file_name'] !== '') { ?>
                                    <div id="previewPdfs">
                                        <iframe src="<?php echo base_url('admin/pdfs/booklet/'.$booklet['file_name']); ?>" width="100%" height="400px">
								        </iframe>
                                    </div>
                                    <?php } ?>
                                    <?php } ?>
                                   </div>
                                   
                                  </div>
                               </div>                             
                           </div>
                      
                                <div class="form-group row mb-0">
                                 <label for="inputPassword" class="col-sm-2 ml-4 col-form-label"></label>
                                    <div class="col-sm-6">
                                        <button type="submit" class="btn btn-primary waves-effect waves-light mr-1" id="owner-submit-btn">
                                            Submit
                                        </button>
                                        <a onclick="history.back()"class="btn btn-secondary waves-effect waves-light" href="javascript:void(0)">
                                            <i class="ion ion ion-md-arrow-back"></i>Back
                                        </a>
                                    </div>
                                </div>
                           </div>
                            </form>

                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->    
        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->