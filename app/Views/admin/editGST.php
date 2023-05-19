
<style type="text/css">
  .modal-header .close {
  
    margin: 0rem 0rem 0rem 0rem;
}
</style>
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
                               <h4 class="card-title">Update GST</h4>     
                          </div>                        
                    </div>
                  <hr>
                 <form class="custom-validation"  method='post' action="<?php echo site_url('Admin/saveGST'); ?>" >                              
                              <div class="for-mobile-laptop">
                              
                              <div class="row">
                                <div class="col-md-10">
                                  <div class="form-group row">
                                    <label for="inputPassword" class="col-sm-2 ml-4 col-form-label">CGST Amount</label>
                                    <div class="col-sm-6">
                                     <input type="text" class="form-control" placeholder="Enter Amount" name="cgst" required value="<?php echo (isset($edit) && !empty($edit)) ? $edit['cgst'] : ''; ?>"/>
                                   </div>
                                   </div>
                                   <div class="form-group row">
                                    <label for="inputPassword" class="col-sm-2 ml-4 col-form-label">SGST Amount</label>
                                   <div class="col-sm-6">
                                     <input type="text" class="form-control" placeholder="Enter Amount" name="sgst" required value="<?php echo (isset($edit) && !empty($edit)) ? $edit['sgst'] : ''; ?>"/>
                                   </div>
                                  </div>
                               </div>                             
                           </div>
                        
                       
                                <div class="form-group row mb-0">
                                 <label for="inputPassword" class="col-sm-2 ml-4 col-form-label"></label>

                                 
                                    <div class="col-sm-6">
                                      <input type="hidden" name="id" value="<?php echo (isset($edit) && !empty($edit)) ? $edit['id'] : ''; ?>">
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

   
<script>
function numericFilter(txb) {
   txb.value = txb.value.replace(/[^\0-9]/ig, "");
}
</script>

