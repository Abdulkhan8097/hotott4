
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
                 <form class="custom-validation"  method='post' action="Award/Save" >                              
                              <div class="for-mobile-laptop">
                              	 <div class="row">
                                <div class="col-md-10">
                                  <div class="form-group row">
                                    <label for="inputPassword" class="col-sm-2 ml-4 col-form-label">Duration<span class="mandatory">*</span></label>
                                    <div class="col-sm-6">
                                    <select name="duration" class="form-control" id="duration">
                                      <option value="">Select</option>
                                      <option value="3" <?php echo ($edit['duration'] == 3) ? 'selected' : '' ?>>03 Months</option>
                                      <option value="6" <?php echo ($edit['duration'] == 6) ? 'selected' : '' ?>>06 Months</option>
                                      <option value="9" <?php echo ($edit['duration'] == 9) ? 'selected' : '' ?>>09 Months</option>
                                      <option value="12" <?php echo ($edit['duration'] == 12) ? 'selected' : '' ?>>12 Months</option>
                                    </select>
                                   </div>
                                  </div>
                               </div>                             
                           </div>
                      
                                <div class="row">
                                <div class="col-md-10">
                                  <div class="form-group row">
                                    <label for="inputPassword" class="col-sm-2 ml-4 col-form-label">Award Name<span class="mandatory">*</span></label>
                                    <div class="col-sm-6">
                                  <input type="text" name="a_name" class="form-control" placeholder="Enter Award Name" value="<?php echo (isset($edit) && !empty($edit)) ? $edit['a_name'] : ''; ?>" required>
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
                                     <input type="text" name="a_pin" class="form-control" placeholder="Enter Award PIN" value="<?php echo (isset($edit) && !empty($edit)) ? $edit['a_pin'] : ''; ?>"required>
                                   </div>
                                  </div>
                               </div>                             
                           </div>
                            <div class="row">
                                <div class="col-md-10">
                                  <div class="form-group row">
                                    <label for="inputPassword" class="col-sm-2 ml-4 col-form-label">Prize<span class="mandatory">*</span></label>
                                    <div class="col-sm-6">
                                    <input type="text" name="price" class="form-control" placeholder="Enter Award Prize" value="<?php echo (isset($edit) && !empty($edit)) ? $edit['price'] : ''; ?>" required>
                                   </div>
                                  </div>
                               </div>                             
                           </div>
                         
                      
                                <div class="form-group row mb-0">
                                 <label for="inputPassword" class="col-sm-2 ml-4 col-form-label"></label>
                                    <div class="col-sm-6">
                                          <input type="hidden" name="id" value="<?php echo (isset($edit) && !empty($edit)) ? $edit['a_id'] : ''; ?>">
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

    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js" defer></script>