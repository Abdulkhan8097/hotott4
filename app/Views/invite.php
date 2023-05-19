
<?php $session = session(); ?>
<!doctype html>
<html lang="en" dir="ltr">
  <head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">

		<meta name="msapplication-TileColor" content="#ff685c">
		<meta name="theme-color" content="#32cafe">
		<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent"/>
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="mobile-web-app-capable" content="yes">
		<meta name="HandheldFriendly" content="True">
		<meta name="MobileOptimized" content="320">
		
		

		<!-- Title -->
		<?php include_title(); ?>
        <?php include_metas(); ?>

		<!-- App favicon -->
        <link rel="shortcut icon" href="<?php echo base_url('admin/images/logo.jpeg'); ?>">

        <!-- Lightbox css -->
        <link href="<?php echo base_url('admin/libs/magnific-popup/magnific-popup.css'); ?>" rel="stylesheet" type="text/css" />

        <!-- Bootstrap Css -->
        <link href="<?php echo base_url('admin/css/bootstrap.min.css'); ?>" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="<?php echo base_url('admin/css/icons.min.css'); ?>" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="<?php echo base_url('admin/css/app.min.css'); ?>" id="app-style" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('admin/css/app.css'); ?>" id="app-style" rel="stylesheet" type="text/css" />

        <!-- Sweet Alert-->
        <link href="<?php echo base_url('admin/libs/sweetalert2/sweetalert2.min.css'); ?>" rel="stylesheet" type="text/css" />

         <!-- Summernote css -->
        <link href="<?php echo base_url('admin/libs/summernote/summernote-bs4.min.css'); ?>" rel="stylesheet" type="text/css" />

		<script src="<?php echo base_url('/js/jquery.min.js'); ?>"></script>
    <script src="<?php echo base_url('/js/popper.min.js'); ?>"></script>
    <script src="<?php echo base_url('/js/bootstrap.min.js'); ?>"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

 <script src="https://pbutcher.uk/flipdown/js/flipdown/flipdown.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('admin/css/flipdown.css');?>">
    <style type="text/css">
  .modal-header .close {
  
    margin: 0rem 0rem 0rem 0rem;
}
</style>

  </head>
  
  
      
		<body data-sidebar="dark">
		
			
	      
   <script src="<?php echo base_url('/js/jquery.min.js'); ?>"></script>
    <script src="<?php echo base_url('/js/popper.min.js'); ?>"></script>
    <script src="<?php echo base_url('/js/bootstrap.min.js'); ?>"></script>

    <div class="page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                             <?php if (isset($_COOKIE['flashdata'])): ?>
    <div class="alert alert-danger alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><?php echo $_COOKIE['flashdata']; ?></div>
    <?php setcookie('flashdata', '', time() - 3600); // clear the cookie ?>
<?php endif; ?>

                             
                          <div class="row">
                            <div class="col-lg-3"> 
                               <h4 class="card-title">JOIN US HOTOTT</h4>     
                          </div>                        
                    </div>
                  <hr>
                 <form class="custom-validation"  method='post' action="<?php echo site_url('Invite/newUserSave'); ?>" >                              
                              <div class="for-mobile-laptop">
                              	 <div class="row d-none">
                                <div class="col-md-10">
                                  <div class="form-group row">
                                    <label for="inputPassword" class="col-sm-2 ml-4 col-form-label">PIN :<span class="mandatory">*</span></label>
                                    <div class="col-sm-6">

                                     <input type="text" class="form-control" placeholder="Enter PIN" name="pin" required value="<?php echo (isset($pin) && !empty($pin)) ? $pin : ''; ?>"  readonly/>
                                   </div>
                                  </div>
                               </div>                             
                           </div>
                              <div class="row">
                                <div class="col-md-10">
                                  <div class="form-group row">
                                    <label for="inputPassword" class="col-sm-2 ml-4 col-form-label">Full Name<span class="mandatory">*</span></label>
                                    <div class="col-sm-6">
                                     <input type="text" class="form-control" placeholder="Enter Full Name" name="name" required value="<?php echo (isset($edit) && !empty($edit)) ? $edit->name : ''; ?>"/>
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
                                                parsley-type="email" placeholder="Enter a valid e-mail" name="email" required value="<?php echo (isset($edit) && !empty($edit)) ? $edit->email : ''; ?>" required/>
                                    </div>
                                    <div class="text-danger" id="email-exist-error-msg">
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
                                                class="form-control" required
                                                placeholder="Enter only digits" maxlength="10" name="mobile" value="<?php echo (isset($edit) && !empty($edit)) ? $edit->mobile : ''; ?>"/>
                                    </div>
                                </div> 
                              </div>
                            </div>

                              <div class="row">
                                <div class="col-md-10">
                                  <div class="form-group row">
                                   <label for="inputPassword" class="col-sm-2 ml-4 col-form-label">Gender</label>
                                    <div class="col-sm-6">
                                     <select class="form-control" name="gender" >
                                        <option value="">- Please Select -</option>
                                        <?php if($genderarb) { foreach ($genderarb as $gender) { ?>
                                        <option value="<?php echo $gender; ?>" <?php echo (isset($edit) && !empty($edit) && $edit->gender==$gender) ? 'selected' : ''; ?>> <?php echo $gender; ?> </option>
                                        <?php } } ?>
                                  </select>
                                    </div>
                                 </div> 
                                </div>
                              </div>

                            <div class="row">
                              <div class="col-md-10">
                                  <div class="form-group row">
                                   <label for="inputPassword" class="col-sm-2 ml-4 col-form-label">Date Of Birth</label>
                                    <div class="col-sm-6">
                                         <input type="date" class="form-control" name="date_of_birth" value="<?php echo (isset($edit) && !empty($edit)) ? $edit->date_of_birth : ''; ?>"/> <span>
                                    </div>
                                 </div> 
                                </div> 
                              </div>
                             <h4> Nomine Details</h4>

                               <div class="row">
                                <div class="col-md-10">
                                  <div class="form-group row">
                                    <label for="inputPassword" class="col-sm-2 ml-4 col-form-label">Nomine Full Name</label>
                                    <div class="col-sm-6">
                                     <input type="text" class="form-control" placeholder="Enter Full Name" name="nomine_name" value="<?php echo (isset($edit) && !empty($edit)) ? $edit->nomine_name : ''; ?>"/>
                                   </div>
                                  </div>
                               </div>                             
                           </div>
                            <div class="row">
                                <div class="col-md-10">
                                  <div class="form-group row">
                                    <label for="inputPassword" class="col-sm-2 ml-4 col-form-label">Nomine Relation</label>
                                    <div class="col-sm-6">
                                     <input type="text" class="form-control" placeholder="Enter Nomine Relation" name="nomine_relation" value="<?php echo (isset($edit) && !empty($edit)) ? $edit->nomine_relation : ''; ?>"/>
                                   </div>
                                  </div>
                               </div>                             
                           </div>

                          <h4> Address</h4>

                            <div class="row">
                                <div class="col-md-10">
                                  <div class="form-group row">
                                    <label for="inputPassword" class="col-sm-2 ml-4 col-form-label">Address 1:</label>
                                    <div class="col-sm-6">
                                     <input type="text" class="form-control" placeholder="Enter Address 1" name="address_line1" value="<?php echo (isset($edit) && !empty($edit)) ? $edit->address_line1 : ''; ?>"/>
                                   </div>
                                  </div>
                               </div>                             
                           </div>
                            <div class="row">
                                <div class="col-md-10">
                                  <div class="form-group row">
                                    <label for="inputPassword" class="col-sm-2 ml-4 col-form-label">Address 2 :</label>
                                    <div class="col-sm-6">
                                     <input type="text" class="form-control" placeholder="Enter Address 2" name="address_line2" value="<?php echo (isset($edit) && !empty($edit)) ? $edit->address_line2 : ''; ?>"/>
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
                                     <input type="text" class="form-control" id="zip_code" name="zip_code" placeholder="Zip Code" value="<?php echo (isset($edit) && !empty($edit)) ? $edit->zip_code : ''; ?>">
                                   </div>
                                  </div>
                               </div>                             
                           </div>
                           <h4>Account Details</h4>
                               <div class="row">
                                <div class="col-md-10">
                                  <div class="form-group row">
                                    <label for="" class="col-sm-2 ml-4 col-form-label">Bank Name</label>
                                    <div class="col-sm-6">
                                     <input type="text" class="form-control" name="bank_name" placeholder="Bank Name" value="<?php echo (isset($edit) && !empty($edit)) ? $edit->bank_name : ''; ?>">
                                   </div>
                                  </div>
                               </div>                             
                           </div>
                            <div class="row">
                                <div class="col-md-10">
                                  <div class="form-group row">
                                    <label for="" class="col-sm-2 ml-4 col-form-label">Branch Name</label>
                                    <div class="col-sm-6">
                                     <input type="text" class="form-control" name="bank_country" placeholder="Branch Name" value="<?php echo (isset($edit) && !empty($edit)) ? $edit->bank_country : ''; ?>">
                                   </div>
                                  </div>
                               </div>                             
                           </div>
                               <div class="row">
                                <div class="col-md-10">
                                  <div class="form-group row">
                                    <label for="" class="col-sm-2 ml-4 col-form-label">Account Holder Name</label>
                                    <div class="col-sm-6">
                                     <input type="text" class="form-control" name="acc_holder_name" placeholder="Account Holder Name" value="<?php echo (isset($edit) && !empty($edit)) ? $edit->acc_holder_name : ''; ?>">
                                   </div>
                                  </div>
                               </div>                             
                           </div>
                            <div class="row">
                                <div class="col-md-10">
                                  <div class="form-group row">
                                    <label for="" class="col-sm-2 ml-4 col-form-label">Account Number</label>
                                    <div class="col-sm-6">
                                     <input  class="form-control" type="text" name="account_no" placeholder="Account Number" value="<?php echo (isset($edit) && !empty($edit)) ? $edit->account_no : ''; ?>">
                                   </div>
                                  </div>
                               </div>                             
                           </div>
                                <div class="row">
                                <div class="col-md-10">
                                  <div class="form-group row">
                                    <label for="" class="col-sm-2 ml-4 col-form-label">IFSC Code</label>
                                    <div class="col-sm-6">
                                     <input  class="form-control" type="text" name="ifsc_code" placeholder="IFSC Code" value="<?php echo (isset($edit) && !empty($edit)) ? $edit->ifsc_code : ''; ?>">
                                   </div>
                                  </div>
                               </div>                             
                           </div>

                            <div class="row">
                                <div class="col-md-10">
                                  <div class="form-group row">
                                    <label for="" class="col-sm-2 ml-4 col-form-label"></label>
                                    <div class="col-sm-6">
                                    <input type="checkbox" name="terms" value="1" checked required>&nbsp;&nbsp;I accept the Terms & Conditions and Privacy Policy.
                                  </div>
                               </div>                             
                           </div>
                         </div>
                                <div class="form-group row mb-0">
                                 <label for="inputPassword" class="col-sm-2 ml-4 col-form-label"></label>

                                 
                                    <div class="col-sm-6">
                                      <input type="hidden" name="id" value="<?php echo (isset($edit) && !empty($edit)) ? $edit->id : ''; ?>">
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

    

	            </body>
	            </html>

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

