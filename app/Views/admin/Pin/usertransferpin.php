
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
                               <h4 class="card-title">TRANSFER PIN TO USER</h4>     
                          </div>                        
                    </div>
                  <hr>
                 <form class="custom-validation"  method='post' action="<?php echo site_url('PinController/pinTranferSave'); ?>" >                              
                              <div class="for-mobile-laptop">
                              	   <div class="row">
                                <div class="col-md-10">
                                  <div class="form-group row">
                                    <label for="inputPassword" class="col-sm-2 ml-4 col-form-label">User ID :<span class="mandatory">*</span></label>
                                    <div class="col-sm-6">
                                     <input type="text" class="form-control" placeholder="Enter your friend User ID" value="" name="user_id" id="sponsor_id" onchange="getname();" />
                                   </div>
                                  </div>
                               </div>                             
                           </div>
                            <div class="row">
                                <div class="col-md-10">
                                  <div class="form-group row">
                                    <label for="inputPassword" class="col-sm-2 ml-4 col-form-label">Name<span class="mandatory">*</span></label>
                                    <div class="col-sm-6">
                                     <input type="text" class="form-control"  value=""  id="sponsor_name" name="sponsor_name" placeholder="Name" readonly required />
                                   </div>
                                  </div>
                               </div>                             
                           </div>

                               <div class="row">
                                <div class="col-md-10">
                                  <div class="form-group row">
                                    <label for="inputPassword" class="col-sm-2 ml-4 col-form-label">Types OF PIN<span class="mandatory">*</span></label>
                                    <div class="col-sm-6">
                                    <select name="pin_type" class="form-control" required>
                              <option selected disabled><--Select--></option>
                              <option value="1" >Referral PIN</option>
                              <option value="2" >Renewal PIN</option>
                      
                              </select>
                                   </div>
                                  </div>
                               </div>                             
                           </div>
                             
                              <div class="row">
                                <div class="col-md-10">
                                  <div class="form-group row">
                                    <label for="inputPassword" class="col-sm-2 ml-4 col-form-label">Number Of Pin<span class="mandatory">*</span></label>
                                    <div class="col-sm-6">
                                     <input type="text" class="form-control"  min="1" max="100" placeholder="Enter Number Of Pin" name="qty" required />
                                   </div>
                                     <span style="color:#e17878;font-size: unset;"> One Time maximum 100 PIN transfer</span>
                                  </div>
                               </div>                             
                           </div>
                              <div class="row">
                                <div class="col-md-10">
                                  <div class="form-group row">
                                    <label for="inputPassword" class="col-sm-2 ml-4 col-form-label">Transaction Password<span class="mandatory">*</span></label>
                                    <div class="col-sm-6">
                                      <input type="text" class="form-control"  name="pass" placeholder="Enter Your Transaction Password"  required>
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
function numericFilter(txb) {
   txb.value = txb.value.replace(/[^\0-9]/ig, "");
}
</script>

<script type="text/javascript">
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

