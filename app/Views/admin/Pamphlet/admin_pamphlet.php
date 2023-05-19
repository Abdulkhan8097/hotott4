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
                               <h4 class="card-title">Pamphlet</h4>     
                          </div>                        
                    </div>
                  <hr>
                 <form class="custom-validation"  method='post' action="<?php echo site_url('PamphletController/savePamphlet'); ?>" enctype="multipart/form-data">                        
                              <div class="for-mobile-laptop">
                              	   <div class="row">
                                <div class="col-md-10">
                                  <div class="form-group row">
                                  <input type="hidden" name="pamphlet_id" id="pamphlet_id" value="<?php echo is_array($pamphlet) ? $pamphlet['id'] : ""; ?>" />
                                  </div>
                               </div>                             
                           </div>
                              <div class="row">
                                <div class="col-md-10">
                                  <div class="form-group row">
                                    <label for="inputPassword" class="col-sm-2 ml-4 col-form-label">Pamphlet Name</label>
                                    <div class="col-sm-6">
                                    <input type="text" name="pamphlet_name" id="pamphlet_name" class="form-control" value="<?php echo is_array($pamphlet) ? $pamphlet['pamphlet_name'] : ""; ?>">
                                   </div>
                                   
                                  </div>
                               </div>                             
                           </div>
                           <div class="row">
                                <div class="col-md-10">
                                  <div class="form-group row">
                                    <label for="inputPassword" class="col-sm-2 ml-4 col-form-label">Pamphlet</label>
                                    <div class="col-sm-6">
                                    <input type="file" name="pamphlet" id="pamphlet" class="form-control" accept="application/pdf">
                                    <?php if(!empty($pamphlet)) { ?>
                                        <?php if($pamphlet['Pamphlet_doc'] !== '') { ?>
                                    <div id="previewPdfs">
                                        <iframe src="<?php echo base_url('admin/pdfs/pamphlet/'.$pamphlet['Pamphlet_doc']); ?>" width="100%" height="400px">
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