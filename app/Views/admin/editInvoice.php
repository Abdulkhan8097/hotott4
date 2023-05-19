
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
                               <h4 class="card-title">Update Invoice Details</h4>     
                          </div>                        
                    </div>
                  <hr>
                 <form class="custom-validation"  method='post' action="<?php echo site_url('InvoiceController/saveInvoice'); ?>" enctype="multipart/form-data">                              
                              <div class="for-mobile-laptop">
                              
                              <div class="row">
                                <div class="col-md-10">
                                  <div class="form-group row">
                                    <label for="inputPassword" class="col-sm-2 ml-4 col-form-label">GST Number</label>
                                    <div class="col-sm-6">
                                     <input type="text" class="form-control" placeholder="Enter GST" name="gst" id="gst" required value="<?php echo (isset($invoice_details) && !empty($invoice_details)) ? $invoice_details[0]['gst'] : ''; ?>"/>
                                   </div>
                                   </div>
                                   <div class="form-group row">
                                    <label for="inputPassword" class="col-sm-2 ml-4 col-form-label">PAN Number</label>
                                   <div class="col-sm-6">
                                     <input type="text" class="form-control" placeholder="Enter PAN" name="pan" id="pan" required value="<?php echo (isset($invoice_details) && !empty($invoice_details)) ? $invoice_details[0]['pan'] : ''; ?>"/>
                                   </div>
                                  </div>
                                  
                                  <div class="form-group row">
                                    <label for="inputPassword" class="col-sm-2 ml-4 col-form-label">Company Logo</label>
                                    <div class="col-sm-6">
                                    <input type="file" name="comp_logo" id="comp_logo" class="form-control">
                                    <?php if(!empty($invoice_details)) { ?>
                                        <?php if(!empty($invoice_details[0]['logo'] !== '')) { ?>
                                            <div id="previewIcon">
                                                <img src="<?php echo base_url('admin/images/'.$invoice_details[0]['logo']); ?>" alt="Company Logo" width="100" height="100">
                                            </div>
                                        <?php } ?>
                                    <?php } ?>
                                   </div>
                                   
                                  </div>
                                  
                                  <div class="form-group row">
                                    <label for="inputPassword" class="col-sm-2 ml-4 col-form-label">Company Address</label>
                                   <div class="col-sm-6">
                                     <textarea name="address" id="address" class="form-control"><?php echo (isset($invoice_details) && !empty($invoice_details)) ? $invoice_details[0]['company_address'] : ''; ?></textarea>
                                   </div>
                                  </div>
                                  
                                  <div class="form-group row">
                                    <label for="inputPassword" class="col-sm-2 ml-4 col-form-label">More Description</label>
                                   <div class="col-sm-6">
                                     <input type="text" class="form-control" placeholder="Enter More Description" name="more_desc" id="more_desc" required value="<?php echo (isset($invoice_details) && !empty($invoice_details)) ? $invoice_details[0]['add_more_description'] : ''; ?>"/>
                                   </div>
                                  </div>
                               </div>                             
                           </div>
                       
                                <div class="form-group row mb-0">
                                 <label for="inputPassword" class="col-sm-2 ml-4 col-form-label"></label>

                                 
                                    <div class="col-sm-6">
                                      <input type="hidden" name="invoice_id" id="invoice_id" value="<?php echo (isset($invoice_details) && !empty($invoice_details)) ? $invoice_details[0]['i_id'] : ''; ?>">
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

