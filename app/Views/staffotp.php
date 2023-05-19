<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Two Factor Auth</title>

    <link rel="stylesheet" href="<?php echo base_url('admin/css/otp.css'); ?>">
    <script src="<?php echo base_url('/js/jquery.min.js'); ?>"></script>
      <script src="<?php echo base_url('/js/bootstrap.min.js'); ?>"></script>
      <style type="text/css">
           .error {
    color: red;
    animation: shake 0.2s ease-in-out 0s 2;
    box-shadow: 0 0 0.6rem #ff0000;
    padding: 10px;
    margin: 17px;}
          .success{
            color: green;
             animation: shake 0.2s ease-in-out 0s 2;
    box-shadow: 0 0 0.6rem green;
    padding: 10px;
    margin: 17px;
          }
      </style>

</head>
<body>

    <!-- main section -->
    <section id="main-site">
        <div class="glass text-center">

            <!-- title -->
            <div class="title">
                <h1 class="font-poppins ">HOTOTT Verification</h1>
                <img src="<?php echo base_url('2FA.png');?>" class="img-fluid" alt="">

                <p class="font-poppins ">We've sent a varification code to</p>
                <p class="font-poppins "><?php echo $phone;?></p>
            </div>

            <!-- form -->
            <form id="otp-form" class="formotp" method="post" class="py-2">
            <!-- <form method="post" action="<?php //echo site_url('Admin/logincheck');?>" class="py-2"> -->
                <h4 class="font-poppins ">Enter your OTP Code Here:</h4>

                <div class="col py-1">
                    <input type="text"  name="nu1" value="1" maxlength="1" onKeyUp="numericFilter(this);" required class="form-control in1">
                    <input type="text"  name="nu2" value="2" maxlength="1" onKeyUp="numericFilter(this);" required class="form-control in1">
                    <input type="text"  name="nu3" value="3" maxlength="1" onKeyUp="numericFilter(this);" required class="form-control in1">
                    <input type="text"  name="nu4" value="4" maxlength="1" onKeyUp="numericFilter(this);" required class="form-control in1">
                </div>
                <div id="otp-message"></div>

                <div class="col">
                     <input type="hidden" name="username" value="<?php echo $username;?>" class="form-control">
                     <input type="hidden" name="password" value="<?php echo $password;?>" class="form-control">
                    
                    <button type="submit" class="btn clik">Verify</button>
                </div>

                <div class="py-1">
                    <p class="font-poppins ">Not received your code?</p>
                    <p class="font-poppins text-light"><a href="#" onClick="document.location.reload(true)" class="link">Resend</a></p>
                </div>
            </form>
        </div>
    </section>
     <script src="<?php echo base_url('/js/jquery.min.js'); ?>"></script>
<script>
   function numericFilter(txb) {
       txb.value = txb.value.replace(/[^\0-9]/ig, "");
   }
</script>


<script>
$(document).ready(function() {
  $('#otp-form').submit(function(event) {
    event.preventDefault(); // Prevent form submission

    var formData = $(this).serialize(); // Get form data
    var url = '<?php echo site_url("Admin/staffverifyOTP"); ?>';

    $.ajax({
      url: url,
      type: 'POST',
      data: formData,
      success: function(response) {
        if (response == '<p class="error">Invalid OTP!</p>') {
          $('#otp-message').html(response);
        } if(response == '<p class="success">OTP verified successfully!</p>'){
            // Remove the submit event handler after the first form submission
          $('#otp-form').off('submit');
          $('#otp-message').html(response);

          $('.formotp').removeAttr('id');
          $('.formotp').attr('id', 'new');
          $(".formotp").attr('action', '<?php echo site_url("Admin/Stafflogincheck");?>');
          $('#new').submit();

          
        }
      }
    });
  });
});

</script>

    
</body>
</html>