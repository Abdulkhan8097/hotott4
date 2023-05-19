
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
                               <h4 class="card-title"><?php echo $title; ?></h4>     
                          </div>                        
                    </div>
                  <hr>
                 <form class="custom-validation"  method='post' action="Reward/Save" >                              
                              <div class="for-mobile-laptop">
                              	 <div class="row">
                                <div class="col-md-10">
                                  <div class="form-group row">
                                    <label for="inputPassword" class="col-sm-2 ml-4 col-form-label">Start Date<span class="mandatory">*</span></label>
                                    <div class="col-sm-6">
                                     <input type="date" name="start_date" class="form-control"  value="<?php echo (isset($edit) && !empty($edit)) ? $edit['start_date'] : ''; ?>" required>
                                   </div>
                                  </div>
                               </div>                             
                           </div>
                            <div class="row">
                                <div class="col-md-10">
                                  <div class="form-group row">
                                    <label for="inputPassword" class="col-sm-2 ml-4 col-form-label">End Date<span class="mandatory">*</span></label>
                                    <div class="col-sm-6">
                                     <input type="date" name="end_date" class="form-control"  value="<?php echo (isset($edit) && !empty($edit)) ? $edit['end_date'] : ''; ?>" required>
                                   </div>
                                  </div>
                               </div>                             
                           </div>
                      
                                <div class="row">
                                <div class="col-md-10">
                                  <div class="form-group row">
                                    <label for="inputPassword" class="col-sm-2 ml-4 col-form-label">Reward Name<span class="mandatory">*</span></label>
                                    <div class="col-sm-6">
                                  <input type="text" name="r_name" class="form-control" placeholder="Enter Reward Name" value="<?php echo (isset($edit) && !empty($edit)) ? $edit['r_name'] : ''; ?>" required>
                                   </div>
                                  </div>
                               </div>                             
                           </div>
                           <div class="row">
                                <div class="col-md-10">
                                  <div class="form-group row">
                                    <label for="inputPassword" class="col-sm-2 ml-4 col-form-label">Title<span class="mandatory">*</span></label>
                                    <div class="col-sm-6">
                                    <input type="text" name="title" class="form-control" placeholder="Enter title" value="<?php echo (isset($edit) && !empty($edit)) ? $edit['title'] : ''; ?>" required>

                                   </div>
                                  </div>
                               </div>                             
                           </div>
                           <div class="row">
                                <div class="col-md-10">
                                  <div class="form-group row">
                                    <label for="inputPassword" class="col-sm-2 ml-4 col-form-label">Description<span class="mandatory">*</span></label>
                                    <div class="col-sm-6">
                                      <textarea  class="form-control" name="description" placeholder="Enter Description"><?php echo (isset($edit) && !empty($edit)) ? $edit['description'] : ''; ?></textarea>

                                   </div>
                                  </div>
                               </div>                             
                           </div>
                            <div class="row">
                                <div class="col-md-10">
                                  <div class="form-group row">
                                    <label for="inputPassword" class="col-sm-2 ml-4 col-form-label">PIN<span class="mandatory">*</span></label>
                                    <div class="col-sm-6">
                                     <input type="text" name="r_pin" class="form-control" placeholder="Enter Reward PIN" value="<?php echo (isset($edit) && !empty($edit)) ? $edit['r_pin'] : ''; ?>"required>
                                   </div>
                                  </div>
                               </div>                             
                           </div>
                            <div class="row">
                                <div class="col-md-10">
                                  <div class="form-group row">
                                    <label for="inputPassword" class="col-sm-2 ml-4 col-form-label">Prize<span class="mandatory">*</span></label>
                                    <div class="col-sm-6">
                                    <input type="text" name="price" class="form-control" placeholder="Enter Reward Prize" value="<?php echo (isset($edit) && !empty($edit)) ? $edit['price'] : ''; ?>" required>
                                   </div>
                                  </div>
                               </div>                             
                           </div>
                         
                      
                                <div class="form-group row mb-0">
                                 <label for="inputPassword" class="col-sm-2 ml-4 col-form-label"></label>
                                    <div class="col-sm-6">
                                          <input type="hidden" name="id" value="<?php echo (isset($edit) && !empty($edit)) ? $edit['r_id'] : ''; ?>">
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

