<?php 
$session = session();
if ($session->get('user_id')) {
$user_id = $session->get('username');
$name = $session->get('name');
}


 ?>
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
                               <h4 class="card-title">Renew PIN</h4>     
                          </div>                        
                    </div>
                  <hr>
                 <form class="custom-validation"  method='post' action="<?php echo site_url('PinController/redeenPinActive'); ?>" >                              
                              <div class="for-mobile-laptop">
                              	 <div class="row">
                                <div class="col-md-10">
                                  <div class="form-group row">
                                    <label for="inputPassword" class="col-sm-2 ml-4 col-form-label"> Pin</label>
                                    <div class="col-sm-6">
                                     <input type="text" class="form-control" placeholder="" name="activePin" value="<?php echo (isset($data) && !empty($data)) ? $data[0]->pin : ''; ?>" required readonly />
                                   </div>
                                  </div>
                               </div>                             
                           </div>
                            <div class="row">
                                <div class="col-md-10">
                                  <div class="form-group row">
                                    <label for="inputPassword" class="col-sm-2 ml-4 col-form-label">Package</label>
                                    <div class="col-sm-6">
                                     <input type="text" class="form-control" placeholder="" name="package" value="<?php echo (isset($data) && !empty($data)) ? $data[0]->amount : ''; ?>" required readonly />
                                   </div>
                                  </div>
                               </div>                             
                           </div>
                      
                                <div class="row">
                                <div class="col-md-10">
                                  <div class="form-group row">
                                    <label for="inputPassword" class="col-sm-2 ml-4 col-form-label">Username<span class="mandatory">*</span></label>
                                    <div class="col-sm-6">
                                     <input type="text" class="form-control" placeholder="Enter Sponsor ID" name="sponsor_id" id="sponsor_id" value="<?php echo (isset($user_id) && !empty($user_id)) ? $user_id: ''; ?>" onchange="getname();" required/>
                                   </div>
                                  </div>
                               </div>                             
                           </div>
                           <div class="row">
                                <div class="col-md-10">
                                  <div class="form-group row">
                                    <label for="inputPassword" class="col-sm-2 ml-4 col-form-label">Name<span class="mandatory">*</span></label>
                                    <div class="col-sm-6">
                                     <input type="text" class="form-control"  id="sponsor_name" name="sponsor_name" placeholder="Sponsor Name"  value="<?php echo (isset($name) && !empty($name)) ? $name: ''; ?>" readonly required/>
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

   

<script>
function getname()
{
  
    var iname=$("#sponsor_id").val();
  //alert(iname);
    $.ajax({
      type:"post",  
        data: { sponsor_id:iname },
      url:"<?php echo base_url();?>/index.php/CustomerController/ajax_sponsor", 
      success:function(response)
      {
     //alert(response);
    
      document.getElementById('sponsor_name').value=response;   
    
      },
  });

}
function getPlaceUnderName()
{
  var iname=$("#place_under_id").val();
  //alert(iname);
    $.ajax({
      type:"post",  
        data: { sponsor_id:iname },
      url:"<?php echo base_url();?>register/ajax_sponsor", 
      success:function(response)
      {
     //alert(response);
    
      document.getElementById('place_under_name').value=response;   
    
      },
  });
}

</script> 

