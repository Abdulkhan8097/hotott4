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
                               <h4 class="card-title">Add Address</h4>     
                          </div>                        
                    </div>
                  <hr>
                 <form class="custom-validation"  method='post' action="TransactionController/saveAddressForInvoice" >                              
                              <div class="for-mobile-laptop">
                                <div class="row">
                                <div class="col-md-10">
                                  <div class="form-group row">
                                    <label for="inputPassword" class="col-sm-2 ml-4 col-form-label">Address 1:</label>
                                    <div class="col-sm-6">
                                     <input type="text" class="form-control" placeholder="Enter Address 1" name="address_line1"/>
                                   </div>
                                  </div>
                               </div>                             
                           </div>
                           <div class="row">
                           <div class="col-md-10">
                                  <div class="form-group row">
                                    <label for="inputPassword" class="col-sm-2 ml-4 col-form-label">Address 2 :</label>
                                    <div class="col-sm-6">
                                     <input type="text" class="form-control" placeholder="Enter Address 2" name="address_line2"/>
                                   </div>
                                  </div>
                               </div>                                 
                           </div>
                           <div class="row">
                           <div class="col-md-10">
                                  <div class="form-group row">
                                    <label for="inputPassword" class="col-sm-2 ml-4 col-form-label">Country</label>
                                    <div class="col-sm-6">
                                      <select name="country" id="country" class="form-control">
                                        <option value="">--Select Country--</option>
                              
                                  
   <?php if(isset($country) && !empty($country)){
                              foreach ($country as $key => $value) {
                                  ?>
                           <option value="<?php echo $value['id']; ?>"<?php echo (isset($edit) && !empty($edit) && $edit->country==$value['id']) ? 'selected' : ''; ?> >
                              <?php echo $value['name']; ?>
                           </option>
                           <?php }
                              } ?>  
                            </select>
                                   </div>
                                  </div>
                               </div>                           
                           </div>
                            <div class="row">
                            <div class="col-md-10">
                                  <div class="form-group row">
                                    <label for="inputPassword" class="col-sm-2 ml-4 col-form-label">State</label>
                                    <div class="col-sm-6">
                                    <select name="state" id="state" class="form-control"> 
                              <option value="">--Select State--</option>
                               <?php if(isset($edit) && !empty($edit)){?>
                            
                           <option value="<?php echo $edit->state; ?>"<?php echo (isset($edit) && !empty($edit) && $edit->state==$edit->state) ? 'selected' : ''; ?> >
                              <?php echo $edit->statename; ?>
                           </option>
                           <?php 
                              } ?>  
                            </select>
                                   </div>
                                  </div>
                               </div>                            
                           </div>
                            <div class="row">
                            <div class="col-md-10">
                                  <div class="form-group row">
                                    <label for="inputPassword" class="col-sm-2 ml-4 col-form-label">City</label>
                                    <div class="col-sm-6">
                                     <select name="city" id="city" class="form-control "> 
                              <option value="">--Select City--</option>
                               <?php if(isset($edit) && !empty($edit)){?>
                            
                           <option value="<?php echo $edit->city; ?>"<?php echo (isset($edit) && !empty($edit) && $edit->city==$edit->city) ? 'selected' : ''; ?> >
                              <?php echo $edit->cityname; ?>
                           </option>
                           <?php 
                              } ?>  
                            </select>
                                   </div>
                                  </div>
                               </div>                            
                           </div>
                           <div class="row">
                                <div class="col-md-10">
                                  <div class="form-group row">
                                    <label for="" class="col-sm-2 ml-4 col-form-label">Pin Code</label>
                                    <div class="col-sm-6">
                                     <input type="text" class="form-control" id="zip_code" name="zip_code" placeholder="Zip Code">
                                   </div>
                                  </div>
                               </div>                             
                           </div>
                         
                      
                                <div class="form-group row mb-0">
                                 <label for="inputPassword" class="col-sm-2 ml-4 col-form-label"></label>
                                    <div class="col-sm-6">
                                          <input type="hidden" name="id" value="<?php echo (isset($userid) && !empty($userid)) ? $userid : ''; ?>">
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
    <script type="text/javascript">

    $(document).ready(function(){
        $("#country").change(function()
      {
        //alert('kkk');
        var id=$(this).val();
        var dataString = 'id='+ id;
        $.ajax
        ({
        type: "POST",
        url: "<?php echo base_url();?>/index.php/CustomerController/ajax_state",
        data: dataString,
        cache: false,
        success: function(html)
        {
          //alert(html);
          $("#state").html(html);
        }
        });

      });
      
      $("#state").change(function()
      {
        //alert('kkk');
        var id=$(this).val();
        var dataString = 'id='+ id;
        $.ajax
        ({
        type: "POST",
        url: "<?php echo base_url();?>/index.php/CustomerController/ajax_city",
        data: dataString,
        cache: false,
        success: function(html)
        {
          //alert(html);
          $("#city").html(html);
        }
        });

      });

    });
</script>