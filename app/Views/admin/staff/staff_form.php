
<style type="text/css">
  .modal-header .close {
  
    margin: 0rem 0rem 0rem 0rem;
}
</style>
   <script src="<?php echo base_url('/js/jquery.min.js'); ?>"></script>
    <script src="<?php echo base_url('/js/popper.min.js'); ?>"></script>
    <script src="<?php echo base_url('/js/bootstrap.min.js'); ?>"></script>
<?php 
$session = session();
$user_id = $session->get('username');
$name = $session->get('name');



 ?>
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                             <?php echo view('admin/_topmessage'); ?>
                             
                          <div class="row">
                            <div class="col-lg-3"> 
                               <h4 class="card-title"><?php echo $title; ?> </h4>     
                          </div>                        
                    </div>
                  <hr>
                 <form class="custom-validation"  method='post' action="<?php echo site_url('StaffController/Save'); ?>" >                              
                              <div class="for-mobile-laptop">
                             
                              <div class="row">
                                <div class="col-md-10">
                                  <div class="form-group row">
                                    <label for="inputPassword" class="col-sm-2 ml-4 col-form-label">Full Name<span class="mandatory">*</span></label>
                                    <div class="col-sm-6">
                                     <input type="text" class="form-control" placeholder="Enter Full Name" name="name" required value="<?php echo (isset($edit) && !empty($edit)) ? $edit['name'] : ''; ?>"/>
                                   </div>
                                  </div>
                               </div>                             
                           </div>
                            <div class="row">
                                <div class="col-md-10">
                                  <div class="form-group row">
                                   <label for="inputPassword" class="col-sm-2 ml-4 col-form-label">Position<span class="mandatory">*</span></label>
                                    <div class="col-sm-6">
                                  
                                        
                              
                                     <select class="form-control" name="admin_type" required>
                                    
                                        <option value="">- Please Select -</option>
                                        <?php if($staff) { 
                                          foreach ($staff as $staff) { ?>
                                        <option value="<?php echo $staff; ?>" <?php echo (isset($edit) && !empty($edit) && $edit['admin_type']==$staff) ? 'selected' : ''; ?>> <?php echo $staff; ?> </option>
                                        <?php }  }?>
                                  </select>
                                    </div>
                                 </div> 
                                </div>
                              </div>

                                    <div class="row">
                              <div class="col-md-10">
                                  <div class="form-group row">
                                    <label for="inputPassword" class="col-sm-2 ml-4 col-form-label">Mobile Number<span class="mandatory">*</span></label>
                                    <div class="col-sm-6">
                              <input data-parsley-type="digits" type="text" class="form-control" required placeholder="Enter only digits" maxlength="10" name="phone" value="<?php echo (isset($edit) && !empty($edit)) ? $edit['phone'] : ''; ?>"/>
                                    </div>
                                </div> 
                              </div>
                            </div>

                            <div class="row">
                               <div class="col-md-10">
                                  <div class="form-group row">                                               
                                    <label for="inputPassword" class="col-sm-2 ml-4 col-form-label">E-Mail<span class="mandatory">*</span></label>
                                     <div class="col-sm-6">
                                        <input type="email" class="form-control" 
                                                parsley-type="email" placeholder="Enter a valid e-mail" name="email" required value="<?php echo (isset($edit) && !empty($edit)) ? $edit['email'] : ''; ?>" required/>
                                    </div>
                                   
                                    </div>
                                </div> 
                              </div>
                            </div>

                              <div class="row">
                               <div class="col-md-10">
                                  <div class="form-group row">                                               
                                    <label for="inputPassword" class="col-sm-2 ml-4 col-form-label">Password<span class="mandatory">*</span></label>
                                     <div class="col-sm-6">
                                        <input type="password" class="form-control" 
                                                parsley-type="password" placeholder="Enter PassWord" name="password" required value="<?php echo (isset($edit) && !empty($edit)) ? $edit['password'] : ''; ?>" required/>
                                    </div>
                                    
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

  
    $(function() {
      $('#password').password()
      .password('focus')
      .on('show.bs.password', function(e) {
        $('#eventLog').text('On show event');
        $('#methods').prop('checked', true);
      }).on('hide.bs.password', function(e) {
        $('#eventLog').text('On hide event');
        $('#methods').prop('checked', false);
      });
      $('#methods').click(function() {
        $('#password').password('toggle');
      });
    });
  </script> 
    
    
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
   <script type="text/javascript">
    $(document).ready(function() {
  
    
    $("#sponsor_id").select2();
      $("#place_under_id").select2();
    $("#position").select2();
    $("#city").select2();
    $("#state").select2();
    $("#country").select2();

  
    });
    </script> 
     <!-- end js include path -->

<script>
function numericFilter(txb) {
   txb.value = txb.value.replace(/[^\0-9]/ig, "");
}
</script>

