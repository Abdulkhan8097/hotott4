<style>
label.error{
   color:red;
}
@media (min-width: 768px){
.mt-md-5, .my-md-5 {
    margin-top: 5rem!important;
}}
.card-footer {
    padding: 0.75rem 1.25rem;
    background-color: #ffffff!important; 
    border-top: 0 solid #ffffff;
}
.box {
  box-shadow: 0px 5px 10px 0px rgba(50, 0, 25, 0.5);
  transition: transform ease 0.5s, box-shadow ease 0.5s;
}
.box:hover {
      transform: translateX(200px);
  box-shadow: 0px 10px 20px 2px rgba(10, 0, 50, 0.25);
}
</style>
<?php  $session = session();
$admin_id = $session->get('admin_id');
$user_id = $session->get('user_id');

 ?>
<div class="app-content bg-img my-3 my-md-5">
    <div class="side-app">
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title text-center" >Update Password</div>
                    </div>

                    <div class="card-body col-lg-8 box" >
                        <?php echo view('admin/_topmessage'); ?>
                            <form method='post' action="<?php echo site_url('Admin/update_password'); ?>" enctype='multipart/form-data'>
                                <div class="card-body">
                                    <div class="row">                                        
                                        <div class="col-sm-6 col-md-8">
                                            <div class="form-group">
                                                <label class="form-label">Old Password</label>
                                                <input type="password" name="old_password" id="old_password" placeholder="Old Password" class="form-control" required>
                                            </div>
                                        </div>

                                        <div class="col-sm-6 col-md-8">
                                            <div class="form-group">
                                                <label class="form-label">New Password</label>
                                                <input type="password" name="new_password" id="new_password" placeholder="New Password" class="form-control" required>
                                            </div>
                                        </div>

                                        <div class="col-sm-6 col-md-8">
                                            <div class="form-group">
                                                <label class="form-label">Confirm Password</label>
                                                <input type="password" name="confirm_password" placeholder="Confirm Password" class="form-control" required>
                                            </div>
                                        </div>

                                  </div>
                               </div>
                               <div class="card-footer">
                                 
                                  <button type="submit" class="btn btn-success pull-left">Submit</button>
                                  <a href="<?php echo site_url('dashboard'); ?>"> <button type="button" class="btn btn-danger pull-left" style="margin-left: 5px;">Cancel</button></a>
                               </div>
                            </form>
                        
                    </div>
                    <br>
                    <br>


<?php if ($user_id): ?>
    

                    <div class="card-header">
                        <div class="card-title text-center">Update Transaction Password</div>
                    </div>

                        <div class="card-body col-lg-8 box" >
                        
                            <form class="card" id='add_member_form' method='post' action="<?php echo site_url('Admin/tranupdate_password'); ?>" enctype='multipart/form-data'>
                                <div class="card-body">
                                    <div class="row">                                        
                                        <div class="col-sm-6 col-md-8">
                                            <div class="form-group">
                                                <label class="form-label">Old Transaction Password</label>
                                                <input type="password" name="told_password" id="told_password" minlength="4" maxlength="4" placeholder="Old Password" class="form-control" required>
                                            </div>
                                        </div>

                                        <div class="col-sm-6 col-md-8">
                                            <div class="form-group">
                                                <label class="form-label">New Transaction Password</label>
                                                <input type="password" name="tnew_password" id="tnew_password" minlength="4" maxlength="4" placeholder="New Password" class="form-control" required>
                                            </div>
                                        </div>

                                        <div class="col-sm-6 col-md-8">
                                            <div class="form-group">
                                                <label class="form-label">Confirm Transaction Password</label>
                                                <input type="password" name="tcnf_new_password" minlength="4" maxlength="4" placeholder="Confirm Password" class="form-control" required>
                                            </div>
                                        </div>

                                  </div>
                               </div>
                               <div class="card-footer">
                                 
                                  <button type="submit" class="btn btn-success pull-left">Submit</button>
                                  <a href="<?php echo site_url('dashboard'); ?>"> <button type="button" class="btn btn-danger pull-left" style="margin-left: 5px;">Cancel</button></a>
                               </div>
                            </form>
                        
                    </div>
                    <?php endif ?>


                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#password-form').submit(function(event) {
            event.preventDefault();

            var old_password = $('#old_password').val();
            var new_password = $('#new_password').val();
            var confirm_password = $('#confirm_password').val();

            $.ajax({
                url: '<?php echo site_url('update_password'); ?>',
                method: 'POST',
                data: {
                    old_password: old_password,
                    new_password: new_password,
                    confirm_password: confirm_password
                },
                 dataType: 'json',
                success: function(response) {
                    if (response.result === false) {
                        alert(response.message);
                    } else {
                        alert(response.message);
                    }
                }
            });
        });
    });
</script>
