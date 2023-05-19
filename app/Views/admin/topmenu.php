<?php $session = session(); 
   
?>


<header id="page-topbar">
                <div class="navbar-header" style="background:#07133D;">
                    <div class="d-flex">
                        <!-- LOGO -->
                        <div class="navbar-brand-box">
                            <a href="<?php echo site_url('dashboard'); ?>" class="logo logo-dark">
                                <span class="logo-sm">
                                    <img src="<?php echo base_url('admin/images/logo.jpeg'); ?>" alt="" height="22">
                                </span>
                                <span class="logo-lg">
                                    <img src="<?php echo base_url('admin/images/logo.jpeg'); ?>" alt="" height="17">
                                    <!-- Chiusouk -->
                                </span>
                            </a>

                            <a href="<?php echo site_url('dashboard'); ?>" class="logo logo-light">
                                <span class="logo-sm text-white">
                                    <img src="<?php echo base_url('admin/images/logo.jpeg'); ?>" alt="" height="30">
                                    <!-- Chiusouk -->
                                </span>
                                <span class="logo-lg text-white">
                                    <img src="<?php echo base_url('admin/images/logo.jpeg'); ?>" alt="" height="80">
                                    <!-- Chiusouk -->
                                </span>
                            </a>
                        </div>

                        <button type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect" id="vertical-menu-btn">
                            <i class="mdi mdi-menu"></i>
                        </button>
                        <?php if ($session->get('user_id')) { ?>
<?php 
$UserWalletModel = new \App\Models\UserWalletModel();
$username=$session->get('username');
$UserWallet=$UserWalletModel->where('username',$username)->first();
$current_amount=$UserWallet['current_amount'];
 ?>
                          <div class="d-none d-sm-block">
                            <div class="dropdown pt-3 d-inline-block">
                                <a class="btn btn-secondary" href="withdrawpoint" role="button" >
                                       HOTOTT BANK :

                                        <?php
                                         if ($current_amount) {
                                           echo $current_amount; 
                                        }

                                         ?><?php if (!$current_amount) {
                                           echo 0; 
                                        }  ?> Points
                                    </a>

                                
                            </div>
                        </div>

                    <?php } ?>
                       
                    </div>

<?php if ($session->get('user_id')) { ?>
                      <div class="d-flex">
                   

                        <button type="button" class=" invisible btn btn-sm px-3 font-size-24 header-item waves-effect" id="vertical-menu-btn">
                            <i class="mdi mdi-menu"></i>
                        </button>
<?php 
$ActiveUserModel = new \App\Models\ActiveUserModel();
$username=$session->get('username');
$checkStatus=$ActiveUserModel->where('username',$username)->first();
$status=$checkStatus['status'];
$created_on=$checkStatus['created_on'];

$starting_date = $created_on; // Set the starting date
$future_date = date('Y-m-d', strtotime('+30 days', strtotime($starting_date)));

$days_left = ceil((strtotime($future_date) - time()) / (60 * 60 * 24)); // Calculate the number of days left



if ($status=='Active') {
 


 ?>
                          <div class="d-none d-sm-block">
                            <div class="dropdown pt-3 d-inline-block">
                                <a class="btn btn-secondary" style="color: #ffffff!important;background-color: #5ccf2f!important;" href="#" role="button" >
                                       STATUS :

                                        <?php
                                         if ($status) {
                                            ?>
                                            <span >
                                            <?php echo $status ?>
                                            </span>

                                         
                                      <?php } ?>

                                     
                                    </a>
                                    &nbsp;
                                    &nbsp;
                                    &nbsp;

                                     <a class="btn btn-secondary" style="color: #ffffff!important;background-color: #0f528d!important;" href="#" role="button" >
                                       LEFT :

                                        <?php
                                         if ($status) {
                                            ?>
                                            <span >
                                            <?php echo $days_left ?>  Days
                                            </span>

                                         
                                      <?php } ?>

                                     
                                    </a>

                                
                            </div>
                        </div>

                    <?php }else{?>

                        <div class="d-none d-sm-block">
                            <div class="dropdown pt-3 d-inline-block">
                                <a class="btn btn-secondary" style="color: #ffffff!important;background-color:#b30000!important;" href="#" role="button" >
                                       STATUS :

                                        <?php
                                         if ($status) {
                                            ?>
                                            <span >
                                            <?php echo $status ?>
                                            </span>

                                         
                                      <?php } ?>

                                     
                                    </a>

                                
                            </div>
                        </div>



                   <?php } ?>
                       
                    </div>
                <?php } ?>


                    <div class="d-flex">
                          <!-- App Search-->
                      <!--     <form class="app-search d-none d-lg-block">
                            <div class="position-relative">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="fa fa-search"></span>
                            </div>
                        </form> -->
<!-- 
                        <div class="dropdown d-inline-block d-lg-none ml-2">
                            <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-search-dropdown"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="mdi mdi-magnify"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-0"
                                aria-labelledby="page-header-search-dropdown">
                    
                                <form class="p-3">
                                    <div class="form-group m-0">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Search ..." aria-label="Recipient's username">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary" type="submit"><i class="mdi mdi-magnify"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div> -->

                     <!--    <div class="dropdown d-none d-md-block ml-2">
                            <button type="button" class="btn header-item waves-effect"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img class="mr-2" src="<?php echo base_url('admin/images/flags/us_flag.jpg'); ?>" alt="Header Language" height="16"> English <span class="mdi mdi-chevron-down"></span>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                    
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <img src="<?php echo base_url('admin/images/flags/germany_flag.jpg'); ?>" alt="user-image" class="mr-1" height="12"> <span class="align-middle"> German </span>
                                </a>

                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <img src="<?php echo base_url('admin/images/flags/italy_flag.jpg'); ?>" alt="user-image" class="mr-1" height="12"> <span class="align-middle"> Italian </span>
                                </a>

                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <img src="<?php echo base_url('admin/images/flags/french_flag.jpg'); ?>" alt="user-image" class="mr-1" height="12"> <span class="align-middle"> French </span>
                                </a>

                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <img src="<?php echo base_url('admin/images/flags/spain_flag.jpg'); ?>" alt="user-image" class="mr-1" height="12"> <span class="align-middle"> Spanish </span>
                                </a>

                                 <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <img src="<?php echo base_url('admin/images/flags/russia_flag.jpg'); ?>" alt="user-image" class="mr-1" height="12"> <span class="align-middle"> Russian </span>
                                </a>
                            </div>
                        </div> -->

                        
                <!-- Start Transaction >= 500 Details-->
              
                        <div class="dropdown d-inline-block">
                            <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-notifications-dropdown"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="mdi mdi-bell-outline"></i>
                                <span class="badge badge-danger badge-pill">
                                    1
                                </span>
                            </button>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-0"
                                aria-labelledby="page-header-notifications-dropdown">
                                <div class="p-3">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <h5 class="m-0 font-size-16"> Notifications (1) </h5>
                                        </div>
                                    </div>
                                </div>
                                <div data-simplebar style="max-height: 230px;">

                                  <!--   <a href="javascript:void(0);" class="text-reset notification-item">
                                        <div class="media">
                                            <div class="avatar-xs mr-3">
                                                <span class="avatar-title bg-primary rounded-circle font-size-16">
                                                    <i class="mdi mdi-cart-outline"></i>
                                                </span>
                                            </div>
                                            <div class="media-body">
                                                <h6 class="mt-0 mb-1">Total Purchase Today</h6>
                                                <div class="font-size-12 text-muted">
                                                    <p class="mb-1"><?php echo floatval($todayTrasactionCost); ?> Rails</p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>

                                    <a href="" class="text-reset notification-item">
                                        <div class="media">
                                            <div class="avatar-xs mr-3">
                                                <span class="avatar-title bg-success rounded-circle font-size-16">
                                                    <i class="mdi mdi-cart-outline"></i>
                                                </span>
                                            </div>
                                            <div class="media-body">
                                                <h6 class="mt-0 mb-1">Your order is placed</h6>
                                                <div class="font-size-12 text-muted">
                                                    <p class="mb-1">Dummy text of the printing and typesetting industry.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </a> -->
                        
                                    <a href="" class="text-reset notification-item">
                                        <div class="media">
                                            <div class="avatar-xs mr-3">
                                                <span class="avatar-title bg-warning rounded-circle font-size-16">
                                                    <i class="mdi mdi-message-text-outline"></i>
                                                </span>
                                            </div>
                                            <div class="media-body">
                                                <h6 class="mt-0 mb-1">New Message received</h6>
                                                <div class="font-size-12 text-muted">
                                                    <p class="mb-1">You have 87 unread messages</p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>

                               <!--      <a href="" class="text-reset notification-item">
                                        <div class="media">
                                            <div class="avatar-xs mr-3">
                                                <span class="avatar-title bg-info rounded-circle font-size-16">
                                                    <i class="mdi mdi-glass-cocktail"></i>
                                                </span>
                                            </div>
                                            <div class="media-body">
                                                <h6 class="mt-0 mb-1">Your item is shipped</h6>
                                                <div class="font-size-12 text-muted">
                                                    <p class="mb-1">It is a long established fact that a reader will</p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>


                                    <a href="" class="text-reset notification-item">
                                        <div class="media">
                                            <div class="avatar-xs mr-3">
                                                <span class="avatar-title bg-danger rounded-circle font-size-16">
                                                    <i class="mdi mdi-message-text-outline"></i>
                                                </span>
                                            </div>
                                            <div class="media-body">
                                                <h6 class="mt-0 mb-1">New Message received</h6>
                                                <div class="font-size-12 text-muted">
                                                    <p class="mb-1">You have 87 unread messages</p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div> -->
                                <!--div class="p-2 border-top">
                                    <a class="btn btn-sm btn-link font-size-14 btn-block text-center" href="javascript:void(0)">
                                        View all
                                    </a>
                                </div-->
                            </div>
                        </div> 
                          


                        <!-- END Transaction Deatisl-->



                        <div class="dropdown d-inline-block">
<?php if($session->get('admin_id')){  ?>
                            <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <!--<img class="rounded-circle header-profile-user" src="<?php echo base_url('admin/images/users/user-4.jpg'); ?>"
                                    alt="Header Avatar">--> SuperAdmin
                            </button>
<?php } else if ($session->get('user_id')){	?>

                            <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <!--<img class="rounded-circle header-profile-user" src="<?php echo base_url('admin/images/users/user-4.jpg'); ?>"
                                    alt="Header Avatar">-->  <?php echo ($session->get('username')); ?>
                            </button>



<?php } else if ($session->get('staff_id')){ ?>

                            <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <!--<img class="rounded-circle header-profile-user" src="<?php echo base_url('admin/images/users/user-4.jpg'); ?>"
                                    alt="Header Avatar">-->  <?php echo ($session->get('name')); ?>
                            </button>



<?php } ?>


                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="Profile"><i class="mdi mdi-account-circle font-size-17 align-middle mr-1"></i> Profile</a>
                                <a class="dropdown-item" href=""><i class="mdi mdi-wallet font-size-17 align-middle mr-1"></i> My Wallet</a>
                            <!--     <a class="dropdown-item d-block" href="#"><span class="badge badge-success float-right">11</span><i class="mdi mdi-settings font-size-17 align-middle mr-1"></i> Settings</a> -->
                               <!--  <a class="dropdown-item" href="#"><i class="mdi mdi-lock-open-outline font-size-17 align-middle mr-1"></i> Lock screen</a> -->
                             <!--    <div class="dropdown-divider"></div> -->
                                <a class="dropdown-item text-danger" href="<?php echo site_url('admin/edit_password'); ?>"><i class="bx bx-power-off font-size-17 align-middle mr-1 text-danger"></i> Change Password</a>
                                <a class="dropdown-item text-danger" href="<?php echo site_url('logout'); ?>"><i class="bx bx-power-off font-size-17 align-middle mr-1 text-danger"></i> Logout</a>
                            </div>
                        </div>

                    
            
                    </div>
                </div>
            </header>