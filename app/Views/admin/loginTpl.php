 <style>

.btn-primary:hover { 
    background-color: #000066 !important;
    border-color: #4396ff;
}
.btn-primary { 
    background-color: #1281B1 !important;
    border-color: #4396ff;
}
.colr{
    background-color: #07133D !important; 
}
.tw{
    color: white;
}
img{
   
    box-shadow: 0 0 13px 0 rgb(236 236 241 / 44%)
}
.form-control {
    display: block;
    width: 100%;
    height: calc(1.5em + 0.75rem + 2px);
    padding: 0.375rem 0.75rem;
    font-size: .875rem;
    font-weight: 600;
    line-height: 1.5;
    color: #495057;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #ced4da;
    border-radius: 0.25rem;
    -webkit-transition: border-color .15s ease-in-out,-webkit-box-shadow .15s ease-in-out;
    transition: border-color .15s ease-in-out,-webkit-box-shadow .15s ease-in-out;
    transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
    transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out,-webkit-box-shadow .15s ease-in-out;
}
body{
    background-image: url('../login_banner.jpeg');
    background-size: cover;
    background-repeat: no-repeat;
     background-attachment: fixed;
         background-position: center center;
         

   
}
</style>
<section class="banner">
   <div class="account-pages my-5 pt-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card overflow-hidden">
                        <div class="bg-primary">
                            <div class="text-primary text-center mt-3">
                                <h5 class="font-size-20" style="color:white; !important;">Welcome Back !</h5>
                                <p class="50" style="color:white;;" >Sign in to continue to HOTOTT</p>
                            </div>
                        </div>

                        <div class="card-body p-4 colr">

                               <center> <a href="<?php echo site_url("admin");?>" >
                                    <img src="<?php echo base_url('admin/images/logo.jpeg'); ?>" height="200" width="200" alt="logo">
                                </a> </center>

                            <div class="p-3">


                                <form class="form-horizontal mt-4" method="post" role="form" name="loginForm" id="loginForm" action="<?php echo site_url("admin/index");?>" >

                                	<?php echo \Config\Services::validation()->listErrors(); ?>
                                    <?php echo csrf_field() ?>
                                    <?php echo view('admin/_topmessage'); ?>

                                    <div class="form-group">
                                        <label for="username" class="tw">User Name</label>
                                        <input type="text" class="form-control" id="username" name="username" placeholder="Enter User Name" required="">
                                    </div>

                                    <div class="form-group">
                                        <label for="password" class="tw">Password</label>
                                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" required="">
                                    </div>
                               
                                 <!--        <div class="form-group">
                                                <label for="password">OTP</label>
                                        <div class="col-sm-12 row">
                                            <div class="col-sm-9 row">
                                                <input type="password"  class="form-control" id="otp" name="otp" placeholder="Enter OTP" required="">
                                                <input type="hidden"  class="form-control" id="statuslogin" name="statuslogin" placeholder="Enter OTP" value="1">
                                            </div>
                                            <div class="col-sm-1">
                                            </div>
                                            <div class="col-sm-2 row">
                                                <a onclick="generateotp();" class="btn btn-primary form-control w-md waves-effect waves-light" style="color:white;">Generate</a>
                                            </div>
                                        </div>
                                    </div> -->
                               

                                    
                                    <div class="form-group row">
                                     <!--    <div class="col-sm-6">
                                            <div class="custom-control custom-checkbox" style="color:white;">
                                                <input type="checkbox" class="custom-control-input" id="customControlInline">
                                                <label class="custom-control-label" for="customControlInline">Remember me</label>
                                            </div>
                                        </div> -->
                                        <div class="col-sm-6 ">
                                            <button class="btn btn-primary w-md waves-effect waves-light text-center" type="submit" style="color:white;">Log In</button>
                                        </div>
                                    </div>

                                    <!-- <div class="form-group mt-2 mb-0 row">
                                        <div class="col-12 mt-4">
                                            <a href="pages-recoverpw.html"><i class="mdi mdi-lock"></i> Forgot your password?</a>
                                        </div>
                                    </div> -->

                                </form>

                            </div>
                        </div>

                    </div>

                    <div class="mt-5 text-center">
                        <!-- <p>Don't have an account ? <a href="pages-register.html" class="font-weight-medium text-primary"> Signup now </a> </p> -->
                        <p class="mb-0">© <script>document.write(new Date().getFullYear())</script> HOTOTT. All rights reserve.</p>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            
        function generateotp() {

           var email = $('#username').val();
           var pass = $('#password').val();
          // var values = formserielize();
           //alert(pass);
           if (email!='' || pass!='') {
            $.ajax({
                url:'<?php echo site_url('admin/generateotp');?>',
                dataType:'json',
                method:'Post',
                data:$('#loginForm').serialize(),
                success:function(json){
                   if (json==1) {
                    alert("OTP sent at your registered mobile number");
                   }else{
                    alert("Otp Not Sent!");
                   }
                }
            });

           }else{
            alert('Please Enter Data');
            return false;
           }
           
        }

        </script>
    </div>
    </section>
