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
                             <?php //echo view('admin/_topmessage'); ?>
                             
                          <div class="row">
                            <div class="col-lg-3"> 
                               <h4 class="card-title">Identity Card</h4>     
                          </div>                        
                    </div>
                  <hr>
                 <!-- <form class="custom-validation"  method='post' action="<?php //echo site_url('Admin/savePackage'); ?>" >      -->
                 <?php $validation = \Config\Services::validation(); ?>                      
                 <form class=""  method='post' action="<?php echo site_url('IdentityController/save_data'); ?>" >                              
                              <div class="for-mobile-laptop">
                              <div class="row">
                                <div class="col-md-10">
                                  <div class="form-group row">
                                    <label for="inputPassword" class="col-sm-2 ml-4 col-form-label">Name</label>
                                    <div class="col-sm-6">
                                     <input type="text" class="form-control" placeholder="Enter Name" name="identity_name" value="<?php //echo (isset($edit) && !empty($edit)) ? $edit['package_name'] : ''; ?>"/>
                                     
                                   </div>
                                  </div>
                               </div>                             
                           </div>
                              <div class="row">
                              <div class="col-md-10">
                                <div class="form-group row">
                                 <label for="inputPassword" class="col-sm-2 ml-4 col-form-label">Position Name<span class="mandatory">*</span></label>
                                  <div class="col-sm-6">
                                    <?php $session = session(); ?>
                                   <select class="form-control" name="position_name">
                                      <?php if($session->get('admin_id')) { ?>
                                        <option value="Marketing Parterner">Marketing Parterner</option>
                                        <option value="Accountant">Accountant</option>
                                        <option value="Sub Admin">Sub Admin</option>
                                        <option value="Technical Head">Technical Head</option>
                                        <option value="Hr">Hr</option>
                                        <option value="System Admin">System Admin</option>
                                        <?php } elseif($session->get('user_id')){ ?>
                                        <option value="Marketing Partner">Marketing Partner</option>
                                        <?php } ?>
                                    </select>

                                  </div>
                               </div> 
                              </div>
                            </div>
                            <div class="row">
                                <div class="col-md-10">
                                  <div class="form-group row">
                                    <label for="inputPassword" class="col-sm-2 ml-4 col-form-label">Email</label>
                                    <div class="col-sm-6">
                                     <input type="email" class="form-control" placeholder="Enter Email" name="email" value="<?php //echo (isset($edit) && !empty($edit)) ? $edit['stock'] : ''; ?>"/>

                                     <!-- Error -->
                                    <?php if($validation->getError('email')) {?>
                                      <div class='alert alert-danger mt-2 text-center'>
                                        <?= $error = $validation->getError('email'); ?>
                                      </div>
                                    <?php }?>

                                   </div>
                                  </div>
                               </div>                             
                           </div>
                            <div class="row">
                              <div class="col-md-10">
                                  <div class="form-group row">
                                    <label for="inputPassword" class="col-sm-2 ml-4 col-form-label">Mobile Number<span class="mandatory">*</span></label>
                                    <div class="col-sm-6">
                                        <input data-parsley-type="digits" type="text"
                                                class="form-control"
                                                placeholder="Enter Mobile Number" maxlength="10" name="mobile" value="<?php //echo (isset($edit) && !empty($edit)) ? $edit->mobile : ''; ?>"/>

                                        <!-- Error -->
                                        <?php if($validation->getError('mobile')) {?>
                                          <div class='alert alert-danger mt-2 text-center'>
                                            <?= $error = $validation->getError('mobile'); ?>
                                          </div>
                                        <?php }?>
                                               
                                    </div>
                                </div> 
                              </div>
                            </div>

                            <div class="row">
                              <div class="col-md-10">
                                  <div class="form-group row">
                                   <label for="inputPassword" class="col-sm-2 ml-4 col-form-label">Date Of Birth</label>
                                    <div class="col-sm-6">
                                         <input type="date" class="form-control" name="date_of_birth" value="<?php //echo (isset($edit) && !empty($edit)) ? $edit->date_of_birth : ''; ?>"/>

                                         <span>
                                    </div>
                                 </div> 
                                </div> 
                              </div>

                              <div class="row">
                                <div class="col-md-10">
                                  <div class="form-group row">
                                    <label for="inputPassword" class="col-sm-2 ml-4 col-form-label">Address:</label>
                                    <div class="col-sm-6">
                                     <input type="text" class="form-control" placeholder="Enter Address" name="address" value="<?php //echo (isset($edit) && !empty($edit)) ? $edit->address_line1 : ''; ?>"/>

                                   </div>
                                  </div>
                               </div>                             
                           </div>

                           <div class="row">
                                <div class="col-md-10">
                                  <div class="form-group row">
                                    <label for="inputPassword" class="col-sm-2 ml-4 col-form-label">Profile Image</label>
                                    <div class="col-sm-6">
                                     <input type="file" class="form-control" name="profile_image" value="<?php //echo (isset($edit) && !empty($edit)) ? $edit['package_name'] : ''; ?>"/>

                                  </div>
                                  </div>
                               </div>                             
                           </div>

                                <div class="form-group row mb-0">
                                 <label for="inputPassword" class="col-sm-2 ml-4 col-form-label"></label>

                                 
                                    <div class="col-sm-6">
                                      <input type="hidden" name="id" value="<?php //echo (isset($edit) && !empty($edit)) ? $edit['package_id'] : ''; ?>">
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

   <!-- 
<script>
function numericFilter(txb) {
   // txb.value = txb.value.replace(/[^\0-9]/ig, "");
}
</script>
 -->
