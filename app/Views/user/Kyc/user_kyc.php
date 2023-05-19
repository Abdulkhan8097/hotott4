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
                               <h4 class="card-title">KYC</h4>     
                          </div>                        
                    </div>
                  <hr>
                 <form class="custom-validation"  method='post' action="<?php echo site_url('KycController/savekyc'); ?>" enctype="multipart/form-data">                        
                              <div class="for-mobile-laptop">
                              	   <div class="row">
                                <div class="col-md-10">
                                  <div class="form-group row">
                                  <input type="hidden" name="kycid" id="kycid" value="<?php echo is_array($user_details) ? $user_details['id'] : ""; ?>" />
                                  <input type="hidden" name="userid" id="userid" value="<?php echo $userid; ?>" />
                                  </div>
                               </div>                             
                           </div>
                              <div class="row">
                                <div class="col-md-10">
                                  <div class="form-group row">
                                    <label for="inputPassword" class="col-sm-2 ml-4 col-form-label">Aadhar Card(Front)</label>
                                    <div class="col-sm-6">
                                    <input type="file" name="aadhardoc_front" id="aadhardoc_front" class="form-control">
                                    <?php if(!empty($user_details)) { ?>
                                    <div id="previewIcon">
                                        <img src="<?php echo base_url('admin/images/kyc/aadhar_front/'.$user_details['aadhar_card_front']); ?>" alt="Aadhar Card(Front) Side" width="100" height="100">
                                    </div>
                                    <?php } ?>
                                   </div>
                                   
                                  </div>
                               </div>                             
                           </div>
                           <div class="row">
                                <div class="col-md-10">
                                  <div class="form-group row">
                                    <label for="inputPassword" class="col-sm-2 ml-4 col-form-label">Aadhar Card(Back)</label>
                                    <div class="col-sm-6">
                                    <input type="file" name="aadhardoc_back" id="aadhardoc_back" class="form-control">
                                    <?php if(!empty($user_details)) { ?>
                                        <?php if($user_details['aadhar_card_back'] !== '') { ?>
                                    <div id="previewIcon">
                                        <img src="<?php echo base_url('admin/images/kyc/aadhar_back/'.$user_details['aadhar_card_back']); ?>" alt="Aadhar Card(Back) Side" width="100" height="100">
                                    </div>
                                    <?php } ?>
                                    <?php } ?>
                                   </div>
                                   
                                  </div>
                               </div>                             
                           </div>
                           <div class="row">
                                <div class="col-md-10">
                                  <div class="form-group row">
                                    <label for="inputPassword" class="col-sm-2 ml-4 col-form-label">PAN Card Photo</label>
                                    <div class="col-sm-6">
                                    <input type="file" name="pandoc" id="pandoc" class="form-control">
                                    <?php if(!empty($user_details)) { ?>
                                        <?php if($user_details['pan'] !== NULL) { ?>
                                            <div id="previewIcon">
                                                <img src="<?php echo base_url('admin/images/kyc/pan/'.$user_details['pan']); ?>" alt="PAN Card" width="100" height="100">
                                            </div>
                                        <?php } ?>
                                    <?php } ?>
                                   </div>
                                   
                                  </div>
                               </div>                             
                           </div>

                           <div class="row">
                                <div class="col-md-10">
                                  <div class="form-group row">
                                    <label for="inputPassword" class="col-sm-2 ml-4 col-form-label">Driving License Photo</label>
                                    <div class="col-sm-6">
                                    <input type="file" name="drivingdoc" id="drivingdoc" class="form-control">
                                    <?php if(!empty($user_details)) { ?>
                                        <?php if($user_details['driving_license'] !== NULL) { ?>
                                            <div id="previewIcon">
                                                <img src="<?php echo base_url('admin/images/kyc/driving_license/'.$user_details['driving_license']); ?>" alt="Driving License" width="100" height="100">
                                            </div>
                                        <?php } ?>
                                    <?php } ?>
                                   </div>
                                   
                                  </div>
                               </div>                             
                           </div>

                           <div class="row">
                                <div class="col-md-10">
                                  <div class="form-group row">
                                    <label for="inputPassword" class="col-sm-2 ml-4 col-form-label">Voter Card Photo</label>
                                    <div class="col-sm-6">
                                    <input type="file" name="voterdoc" id="voterdoc" class="form-control">
                                    <?php if(!empty($user_details)) { ?>
                                        <?php if($user_details['voter_card'] !== NULL) { ?>
                                            <div id="previewIcon">
                                                <img src="<?php echo base_url('admin/images/kyc/voter/'.$user_details['voter_card']); ?>" alt="Voter ID Card" width="100" height="100">
                                            </div>
                                        <?php } ?>
                                    <?php } ?>
                                   </div>
                                   
                                  </div>
                               </div>                             
                           </div>

                           <div class="row">
                                <div class="col-md-10">
                                  <div class="form-group row">
                                    <label for="inputPassword" class="col-sm-2 ml-4 col-form-label">Electric Bill</label>
                                    <div class="col-sm-6">
                                    <input type="file" name="elecdoc" id="elecdoc" class="form-control">
                                    <?php if(!empty($user_details)) { ?>
                                        <?php if($user_details['electric_bill'] !== NULL) { ?>
                                            <div id="previewIcon">
                                                <img src="<?php echo base_url('admin/images/kyc/electric_bill/'.$user_details['electric_bill']); ?>" alt="Electricity Bill" width="100" height="100">
                                            </div>
                                        <?php } ?>
                                    <?php } ?>
                                   </div>
                                   
                                  </div>
                               </div>                             
                           </div>

                           <div class="row">
                                <div class="col-md-10">
                                  <div class="form-group row">
                                    <label for="inputPassword" class="col-sm-2 ml-4 col-form-label">Passport Photo</label>
                                    <div class="col-sm-6">
                                    <input type="file" name="passportdoc" id="passportdoc" class="form-control">
                                    <?php if(!empty($user_details)) { ?>
                                        <?php if($user_details['passport'] !== NULL) { ?>
                                            <div id="previewIcon">
                                                <img src="<?php echo base_url('admin/images/kyc/passport/'.$user_details['passport']); ?>" alt="Passport" width="100" height="100">
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