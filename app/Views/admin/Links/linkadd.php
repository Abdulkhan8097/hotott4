
<style type="text/css">
  .modal-header .close {
  
    margin: 0rem 0rem 0rem 0rem;
}
</style>

    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                             <?php echo view('admin/_topmessage'); ?>
                             
                          <div class="row">
                            <div class="col-lg-3"> 
                               <h4 class="card-title"><?php echo $pagetitle; ?></h4>     
                          </div>                        
                    </div>
                  <hr>
                 <form class="custom-validation"  method='post' action="PinController/urlGenerate" >                              
                              <div class="for-mobile-laptop">
                             
                        
                      
                              
                      
                       
                            <div class="row">
                                <div class="col-md-10">
                                  <div class="form-group row">
                                    <label for="inputPassword" class="col-sm-2 ml-4 col-form-label">No.of Url<span class="mandatory">*</span></label>
                                    <div class="col-sm-6">
                                     <input type="text" name="nourl" class="form-control" placeholder="Enter No.of Url Generate like 2,3" value="<?php echo (isset($edit) && !empty($edit)) ? $edit['nourl'] : ''; ?>"required>
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

