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
         <form class="custom-validation"  method='post' action="">                        
                      <div class="for-mobile-laptop">
                   <div class="row">
                        <div class="col-md-10">
                          <div class="form-group row">
                            <label for="inputPassword" class="col-sm-2 ml-4 col-form-label">Booklet</label>
                            <div class="col-sm-6">
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
                   </div>
                    </form>

                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->    
</div> <!-- container-fluid -->
</div>
<!-- End Page-content -->