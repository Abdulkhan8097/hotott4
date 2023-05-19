<!-- ========== Left Sidebar Start ========== -->
<?php $session = session(); ?>
<style>
    .menu-title{
        font-size:14px;
    }

    
</style>
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->                      

                     
            <?php if ($session->get('admin_id')) { ?>

            <ul class="metismenu list-unstyled " id="side-menu">
                           
                            <li  style="border-bottom: 1px solid #5f6369">
                                <a href="<?php echo site_url('Dashboard'); ?>" class="waves-effect ">
                                    <img src="<?php echo base_url('home_dashboard.jpg'); ?>" height="30px">
                                    <span class="menu-title">Dashboard</span>
                                </a>
                            </li>

                         


                             <li class="" style="border-bottom: 1px solid #5f6369">
                                <a href="javascript: void(0);" class="has-arrow waves-effect " aria-expanded="false">
                                <img src="<?php echo base_url('customer.jpg'); ?>" height="30px">
                                    <span class="menu-title">Staff Management</span>
                                </a>
                                <ul class="sub-menu mm-collapse " aria-expanded="false" style="">
                                <li style="border-bottom: 1px solid #5f6369">
                                    <a href="<?php echo site_url('liststaff'); ?>">View Staff</a>
                                    </li>
                                    <li style="border-bottom: 1px solid #5f6369;">
                                    <a href="<?php echo site_url('addstaff'); ?>" >Add Staff</a></li>
                                </ul>
                            </li>
                         
                            
                            <li class="" style="border-bottom: 1px solid #5f6369">
                                <a href="javascript: void(0);" class="has-arrow waves-effect " aria-expanded="false">
                                <img src="<?php echo base_url('customer.jpg'); ?>" height="30px">
                                    <span class="menu-title">User Management</span>
                                </a>
                                <ul class="sub-menu mm-collapse " aria-expanded="false" style="">
                                <li style="border-bottom: 1px solid #5f6369">
                                    <a href="<?php echo site_url('Customers'); ?>">View Users</a>
                                    </li>
                                    <li style="border-bottom: 1px solid #5f6369;">
                                    <a href="<?php echo site_url('AddCustomer'); ?>" >Add Users</a></li>
                                </ul>
                            </li>
                               <li class="" style="border-bottom: 1px solid #5f6369">
                                <a href="javascript: void(0);" class="has-arrow waves-effect " aria-expanded="false">
                                <img src="<?php echo base_url('customer.jpg'); ?>" height="30px">
                                    <span class="menu-title">KYC</span>
                                </a>
                                <ul class="sub-menu mm-collapse " aria-expanded="false" style="">
                          
                                    <li style="border-bottom: 1px solid #5f6369;">
                                    <a href="<?php echo site_url('kyclist'); ?>" > Users KYC</a></li>
                                </ul>
                            </li>
                           
                            <li class="" style="border-bottom: 1px solid #5f6369">
                                <a href="javascript: void(0);" class="has-arrow waves-effect " aria-expanded="false">
                                <img src="<?php echo base_url('customer.jpg'); ?>" height="30px">
                                    <span class="menu-title">Referral PIN</span>
                                </a>
                                <ul class="sub-menu mm-collapse " aria-expanded="false" style="">
                                <li style="border-bottom: 1px solid #5f6369">
                                    <a href="<?php echo site_url('pinlist'); ?>">View PIN</a>
                                    </li>
                                    <li style="border-bottom: 1px solid #5f6369;">
                                    <a href="<?php echo site_url('genratepin'); ?>" >Generate PIN</a></li>
                                </ul>
                            </li>
                              <li class="" style="border-bottom: 1px solid #5f6369">
                                <a href="javascript: void(0);" class="has-arrow waves-effect " aria-expanded="false">
                                <img src="<?php echo base_url('customer.jpg'); ?>" height="30px">
                                    <span class="menu-title">Renewal PIN</span>
                                </a>
                                <ul class="sub-menu mm-collapse " aria-expanded="false" style="">
                                <li style="border-bottom: 1px solid #5f6369">
                                    <a href="<?php echo site_url('listpurchaserenewalpin'); ?>">View PIN</a>

                                    </li>
                                    <li style="border-bottom: 1px solid #5f6369;">
                                    <a href="javascript:void(0)" >Add PIN</a></li>
                                </ul>
                            </li>

                             <li class="" style="border-bottom: 1px solid #5f6369">
                                <a href="javascript: void(0);" class="has-arrow waves-effect " aria-expanded="false">
                                <img src="<?php echo base_url('transaction icon.png'); ?>" height="30px">
                                    <span class="menu-title">Transfer PIN</span>
                                </a>
                                <ul class="sub-menu mm-collapse " aria-expanded="false" style="">
                     
                                    <li style="border-bottom: 1px solid #5f6369">
                                    <a href="<?php echo site_url('adminpintransfertouser'); ?>">Transfer PIN To user</a>
                                    </li>
                                      <li style="border-bottom: 1px solid #5f6369">
                                    <a href="<?php echo site_url('adminlistpintransfertouser'); ?>">List Transfer PIN</a>
                                    </li>
                                    
                                </ul>
                            </li>
                            
                            <li class="" style="border-bottom: 1px solid #5f6369">
                                <a href="javascript: void(0);" class="has-arrow waves-effect " aria-expanded="false">
                                <img src="<?php echo base_url('transaction icon.png'); ?>" height="30px">
                                    <span class="menu-title">Share points</span>
                                </a>
                                <ul class="sub-menu mm-collapse " aria-expanded="false" style="">
                     
                                    <li style="border-bottom: 1px solid #5f6369">
                                    <a href="<?php echo site_url('adminpointshere'); ?>">Share points</a>
                                    </li>
                                      <li style="border-bottom: 1px solid #5f6369">
                                    <a href="<?php echo site_url('adminpointsherelist'); ?>">List Share points</a>
                                    </li>
                                    
                                </ul>
                            </li>
                            
                           
                         <li class="" style="border-bottom: 1px solid #5f6369">
                                <a href="javascript: void(0);" class="has-arrow waves-effect " aria-expanded="false">
                                <img src="<?php echo base_url('customer.jpg'); ?>" height="30px">
                                    <span class="menu-title">Account</span>
                                </a>
                                <ul class="sub-menu mm-collapse " aria-expanded="false" style="">
                                <li style="border-bottom: 1px solid #5f6369">
                                    <a href="<?php echo site_url('wallethistory'); ?>">user Account History</a>
                                    </li>
                                 
                                 
                                </ul>
                            </li>
 
                            
                            <!-- <li class="" style="border-bottom: 1px solid #5f6369">
                                <a href="javascript: void(0);" class="has-arrow waves-effect " aria-expanded="false">
                                <img src="<?php //echo base_url('report.jpg'); ?>" height="30px">
                                    <span class="menu-title">Reports</span>
                                </a>
                                <ul class="sub-menu mm-collapse " aria-expanded="false" style="">
                                    <li style="border-bottom: 1px solid #5f6369"><a href="<?php //echo site_url('reports'); ?>">View Report</a> </li>
                                    
                                   
                                </ul>
                            </li> -->
                             <li class="" style="border-bottom: 1px solid #5f6369">
                                <a href="javascript: void(0);" class="has-arrow waves-effect " aria-expanded="false">
                                <img src="<?php echo base_url('transaction icon.png'); ?>" height="30px">
                                    <span class="menu-title">Transaction</span>
                                </a>
                                <ul class="sub-menu mm-collapse " aria-expanded="false" style="">
                             <!--    <li style="border-bottom: 1px solid #5f6369">
                                    <a href="<?php echo site_url('addtransaction'); ?>">Add Transaction</a>
                                    </li> -->
                                    <li style="border-bottom: 1px solid #5f6369">
                                    <a href="<?php echo site_url('viewtransaction'); ?>">View Transaction</a>
                                    </li>
                                    
                                </ul>
                            </li>
                                   <li class="" style="border-bottom: 1px solid #5f6369">
                                <a href="javascript: void(0);" class="has-arrow waves-effect " aria-expanded="false">
                                <img src="<?php echo base_url('customer.jpg'); ?>" height="30px">
                                    <span class="menu-title">Tax & Invoice</span>
                                </a>
                                <ul class="sub-menu mm-collapse " aria-expanded="false" style="">
                                <li style="border-bottom: 1px solid #5f6369">
                                    <a href="<?php echo site_url('GST'); ?>">GST</a>
                                    </li>
                                    <li style="border-bottom: 1px solid #5f6369;">
                                    <a href="<?php echo site_url('TDS'); ?>" >TDS</a></li>
                                    <li style="border-bottom: 1px solid #5f6369;">
                                    <a href="<?php echo site_url('invoice'); ?>" >Invoice</a></li>
                                </ul>
                            </li>
                             <li class="" style="border-bottom: 1px solid #5f6369">
                                <a href="javascript: void(0);" class="has-arrow waves-effect " aria-expanded="false">
                                <img src="<?php echo base_url('customer.jpg'); ?>" height="30px">
                                    <span class="menu-title">Offers</span>
                                </a>
                                <ul class="sub-menu mm-collapse " aria-expanded="false" style="">
                                <li style="border-bottom: 1px solid #5f6369">
                                    <a href="<?php echo site_url('rewardlist'); ?>">Reward</a>
                                    </li>
                                    <li style="border-bottom: 1px solid #5f6369;">
                                    <a href="<?php echo site_url('awardlist'); ?>" >Award</a></li>
                                    <li style="border-bottom: 1px solid #5f6369;">
                                    <a href="<?php echo site_url('awardrewardclaimlist'); ?>" >Award/Reward Claim</a></li>
                                 
                                </ul>
                            </li>
<!-- 
                               <li class="" style="border-bottom: 1px solid #5f6369">
                                <a href="javascript: void(0);" class="has-arrow waves-effect " aria-expanded="false">
                                <img src="<?php //echo base_url('customer.jpg'); ?>" height="30px">
                                    <span class="menu-title">Wallet System</span>
                                </a>
                                <ul class="sub-menu mm-collapse " aria-expanded="false" style="">
                                <li style="border-bottom: 1px solid #5f6369">
                                    <a href="javascript:void(0)">Report User</a>
                                    </li>
                                    <li style="border-bottom: 1px solid #5f6369;">
                                    <a href="javascript:void(0)" >History</a></li>
                                   
                                </ul>
                            </li> -->
                            <li class="" style="border-bottom: 1px solid #5f6369">
                                <a href="javascript: void(0);" class="has-arrow waves-effect " aria-expanded="false">
                                <img src="<?php echo base_url('customer.jpg'); ?>" height="30px">
                                    <span class="menu-title">Social media</span>
                                </a>
                                <ul class="sub-menu mm-collapse " aria-expanded="false" style="">
                                <li style="border-bottom: 1px solid #5f6369">
                                    <a href="javascript:void(0)">Support</a>
                                    </li>
                                    <li style="border-bottom: 1px solid #5f6369;">
                                    <a href="<?php echo site_url('admin_brochure'); ?>" >Brochure</a></li>
                                    <li style="border-bottom: 1px solid #5f6369;">
                                    <a href="<?php echo site_url('admin_pamphlet'); ?>" >Pamphlet</a></li>
                                    <li style="border-bottom: 1px solid #5f6369;">
                                    <a href="<?php echo site_url('admin_booklet'); ?>" >Booklet</a></li>
                                    <li style="border-bottom: 1px solid #5f6369;">
                                    <a href="javascript:void(0)" >Social Link</a></li>
                                   
                                </ul>
                            </li>
                            <li  style="border-bottom: 1px solid #5f6369">
                                <a href="<?php echo site_url('adminfeedbacklists'); ?>" class="waves-effect ">
                                    <img src="<?php echo base_url('customer.jpg'); ?>" height="30px">
                                    <span class="menu-title">Feedback</span>
                                </a>
                            </li>
                             <li class="" style="border-bottom: 1px solid #5f6369">
                                <a href="javascript: void(0);" class="has-arrow waves-effect " aria-expanded="false">
                                <img src="<?php echo base_url('customer.jpg'); ?>" height="30px">
                                    <span class="menu-title">Others</span>
                                </a>
                                <ul class="sub-menu mm-collapse " aria-expanded="false" style="">
                                    <li style="border-bottom: 1px solid #5f6369;">
                                    <a href="javascript:void(0)" >About Us</a></li>
                                      <li style="border-bottom: 1px solid #5f6369;">
                                    <a href="javascript:void(0)" >Contact Us </a></li>
                                    <li style="border-bottom: 1px solid #5f6369;">
                                    <a href="javascript:void(0)" >Notification</a></li>
                                    <li style="border-bottom: 1px solid #5f6369;">
                                    <a href="javascript:void(0)" >Term Condition</a></li>
                                     <li style="border-bottom: 1px solid #5f6369;">
                                    <a href="javascript:void(0)" >privacy Policy</a></li>
                                    <li style="border-bottom: 1px solid #5f6369;">
                                    <a href="javascript:void(0)" >Return Policy</a></li>
                                     <li style="border-bottom: 1px solid #5f6369;">
                                    <a href="javascript:void(0)" >Cancellation Policy</a></li>
                                   
                                </ul>
                            </li>
                              <li class="" style="border-bottom: 1px solid #5f6369">
                                <a href="javascript: void(0);" class="has-arrow waves-effect " aria-expanded="false">
                                <img src="<?php echo base_url('customer.jpg'); ?>" height="30px">
                                    <span class="menu-title">identity card</span>
                                </a>
                                <ul class="sub-menu mm-collapse " aria-expanded="false" style="">
                                <li style="border-bottom: 1px solid #5f6369">
                                    <a href="<?php echo site_url('card_list'); ?>">View</a>
                                    </li>
                                    <li style="border-bottom: 1px solid #5f6369;">
                                    <a href="<?php echo site_url('addform'); ?>" >Add</a></li>
                                   
                                </ul>
                            </li>
                              <li class="" style="border-bottom: 1px solid #5f6369">
                                <a href="javascript: void(0);" class="has-arrow waves-effect " aria-expanded="false">
                                <img src="<?php echo base_url('customer.jpg'); ?>" height="30px">
                                    <span class="menu-title">settings</span>
                                </a>
                                <ul class="sub-menu mm-collapse " aria-expanded="false" style="">
                                <li style="border-bottom: 1px solid #5f6369">
                                    <a href="<?php echo site_url('package'); ?>">package</a>
                                    </li>

                                    <li style="border-bottom: 1px solid #5f6369">
                                    <a href="<?php echo site_url('bounce'); ?>">Bonus</a>
                                    </li>
                                     <li style="border-bottom: 1px solid #5f6369">
                                    <a href="<?php echo site_url('pointsharecharges'); ?>">Admin Charges</a>
                                    </li>
                                   
                                </ul>
                            </li>
                            
                            
                            
                          
                       
                            
                         
                         <!--    
                            <li  style="border-bottom: 1px solid #5f6369">
                                <a href="<?php echo site_url('ContactUs'); ?>" class="waves-effect ">
                                    <img src="<?php echo base_url('contact_us.jpg'); ?>" height="30px">
                                    <span class="menu-title">Contact Us</span>
                                </a>
                            </li> -->
                            
                        
                         
                         
                         

                           
            </ul> 
   
            <?php } ?>

            <?php $user_type=$session->get('user_type');

            if ($user_type=='Social_media') { ?>

              

                <ul class="metismenu list-unstyled " id="side-menu">
                         <li class="" style="border-bottom: 1px solid #5f6369">
                                <a href="javascript: void(0);" class="has-arrow waves-effect " aria-expanded="false">
                                <img src="<?php echo base_url('customer.jpg'); ?>" height="30px">
                                    <span class="menu-title">Profile</span>
                                </a>
                                <ul class="sub-menu mm-collapse " aria-expanded="false" style="">
                                <li style="border-bottom: 1px solid #5f6369">
                                    <a href="<?php echo site_url('Profile'); ?>">Profile</a>
                                    </li>
                                   
                                </ul>
                            </li>

                  <li  style="border-bottom: 1px solid #5f6369">
                                <a href="javascript: void(0);" class="has-arrow waves-effect " aria-expanded="false">
                                <img src="<?php echo base_url('customer.jpg'); ?>" height="30px">
                                    <span class="menu-title">Social Media</span>
                                </a>
                                <ul class="sub-menu mm-collapse " aria-expanded="false" style="">
                                <li style="border-bottom: 1px solid #5f6369">
                                    <a href="<?php echo site_url('linkslist'); ?>">Social Media Link</a>
                                    </li>
                                    <li style="border-bottom: 1px solid #5f6369;">
                                    <a href="<?php echo site_url('user_brochure'); ?>" >Brochure</a></li>
                                    <li style="border-bottom: 1px solid #5f6369;">
                                    <a href="<?php echo site_url('user_pamphlet'); ?>" >Pamphlet</a></li>
                                    <li style="border-bottom: 1px solid #5f6369;">
                                    <a href="<?php echo site_url('user_booklet'); ?>" >Booklet</a></li>
                                   
                                </ul>
                            </li>
                        </ul>

            <?php } ?>


             <?php $user_type=$session->get('user_type');

            if ($user_type=='Account') { ?>

              

                <ul class="metismenu list-unstyled " id="side-menu">
                         <li class="" style="border-bottom: 1px solid #5f6369">
                                <a href="javascript: void(0);" class="has-arrow waves-effect " aria-expanded="false">
                                <img src="<?php echo base_url('customer.jpg'); ?>" height="30px">
                                    <span class="menu-title">Profile</span>
                                </a>
                                <ul class="sub-menu mm-collapse " aria-expanded="false" style="">
                                <li style="border-bottom: 1px solid #5f6369">
                                    <a href="<?php echo site_url('Profile'); ?>">Profile</a>
                                    </li>
                                   
                                </ul>
                            </li>

                  <li class="" style="border-bottom: 1px solid #5f6369">
                                <a href="javascript: void(0);" class="has-arrow waves-effect " aria-expanded="false">
                                <img src="<?php echo base_url('transaction icon.png'); ?>" height="30px">
                                    <span class="menu-title">Transaction</span>
                                </a>
                                <ul class="sub-menu mm-collapse " aria-expanded="false" style="">
                             <!--    <li style="border-bottom: 1px solid #5f6369">
                                    <a href="<?php echo site_url('addtransaction'); ?>">Add Transaction</a>
                                    </li> -->
                                    <li style="border-bottom: 1px solid #5f6369">
                                    <a href="<?php echo site_url('viewtransaction'); ?>">View Transaction</a>
                                    </li>
                                    
                                </ul>
                            </li>
                        </ul>

            <?php } ?>

            <?php $user_type=$session->get('user_type');

            if ($user_type=='HR') { ?>

              

                <ul class="metismenu list-unstyled " id="side-menu">
                         <li class="" style="border-bottom: 1px solid #5f6369">
                                <a href="javascript: void(0);" class="has-arrow waves-effect " aria-expanded="false">
                                <img src="<?php echo base_url('customer.jpg'); ?>" height="30px">
                                    <span class="menu-title">Profile</span>
                                </a>
                                <ul class="sub-menu mm-collapse " aria-expanded="false" style="">
                                <li style="border-bottom: 1px solid #5f6369">
                                    <a href="<?php echo site_url('Profile'); ?>">Profile</a>
                                    </li>
                                   
                                </ul>
                            </li>

                    <li class="" style="border-bottom: 1px solid #5f6369">
                                <a href="javascript: void(0);" class="has-arrow waves-effect " aria-expanded="false">
                                <img src="<?php echo base_url('customer.jpg'); ?>" height="30px">
                                    <span class="menu-title">identity card</span>
                                </a>
                                <ul class="sub-menu mm-collapse " aria-expanded="false" style="">
                                <li style="border-bottom: 1px solid #5f6369">
                                    <a href="<?php echo site_url('card_list'); ?>">View</a>
                                    </li>
                                    <li style="border-bottom: 1px solid #5f6369;">
                                    <a href="<?php echo site_url('addform'); ?>" >Add</a></li>
                                   
                                </ul>
                            </li>

                              <li class="" style="border-bottom: 1px solid #5f6369">
                                <a href="javascript: void(0);" class="has-arrow waves-effect " aria-expanded="false">
                                <img src="<?php echo base_url('customer.jpg'); ?>" height="30px">
                                    <span class="menu-title">Offers</span>
                                </a>
                                <ul class="sub-menu mm-collapse " aria-expanded="false" style="">
                                <li style="border-bottom: 1px solid #5f6369">
                                    <a href="<?php echo site_url('rewardlist'); ?>">Reward</a>
                                    </li>
                                    <li style="border-bottom: 1px solid #5f6369;">
                                    <a href="<?php echo site_url('awardlist'); ?>" >Award</a></li>
                                    <li style="border-bottom: 1px solid #5f6369;">
                                    <a href="<?php echo site_url('awardrewardclaimlist'); ?>" >Award/Reward Claim</a></li>
                                 
                                </ul>
                            </li>
                        </ul>

            <?php } ?>



            <?php if ($session->get('user_id')) { ?>

            <ul class="metismenu list-unstyled " id="side-menu">
                           
                            <li  style="border-bottom: 1px solid #5f6369">
                                <a href="<?php echo site_url('Dashboard'); ?>" class="waves-effect ">
                                    <img src="<?php echo base_url('home_dashboard.jpg'); ?>" height="30px">
                                    <span class="menu-title">Dashboard</span>
                                </a>
                            </li>

                            <li class="" style="border-bottom: 1px solid #5f6369">
                                <a href="javascript: void(0);" class="has-arrow waves-effect " aria-expanded="false">
                                <img src="<?php echo base_url('customer.jpg'); ?>" height="30px">
                                    <span class="menu-title">Profile</span>
                                </a>
                                <ul class="sub-menu mm-collapse " aria-expanded="false" style="">
                                <li style="border-bottom: 1px solid #5f6369">
                                    <a href="<?php echo site_url('Profile'); ?>">Profile</a>
                                    </li>
                                    <li style="border-bottom: 1px solid #5f6369;">
                                    <a href="<?php echo site_url('userkyc'); ?>" >KYC</a></li>
                                </ul>
                            </li>
                         
                            
                            <li class="" style="border-bottom: 1px solid #5f6369">
                                <a href="javascript: void(0);" class="has-arrow waves-effect " aria-expanded="false">
                                <img src="<?php echo base_url('customer.jpg'); ?>" height="30px">
                                    <span class="menu-title">User Management</span>
                                </a>
                                <ul class="sub-menu mm-collapse " aria-expanded="false" style="">
                                <li style="border-bottom: 1px solid #5f6369">
                                    <a href="<?php echo site_url('Customers'); ?>">View Member</a>
                                    </li>
                                    <li style="border-bottom: 1px solid #5f6369;">
                                    <a href="<?php echo site_url('AddCustomer'); ?>" >Join Member</a></li>


                                    <li style="border-bottom: 1px solid #5f6369;">
                                    <a href="<?php echo site_url('activeteam'); ?>" >Team Status</a></li>

                                </ul>
                            </li>
                             <li class="" style="border-bottom: 1px solid #5f6369">
                                <a href="javascript: void(0);" class="has-arrow waves-effect " aria-expanded="false">
                                <img src="<?php echo base_url('customer.jpg'); ?>" height="30px">
                                    <span class="menu-title">My Pin</span>
                                </a>
                                <ul class="sub-menu mm-collapse " aria-expanded="false" style="">
                                <li style="border-bottom: 1px solid #5f6369">
                                    <a href="<?php echo site_url('listpurchasepin'); ?>">My Referral PIN</a>
                                    </li>
                                     <li style="border-bottom: 1px solid #5f6369">
                                    <a href="<?php echo site_url('listpurchaserenewalpin'); ?>">My Renewal PIN</a>
                                    </li>

                                     <!--   <li style="border-bottom: 1px solid #5f6369">
                                    <a href="<?php echo site_url('linkslist'); ?>">Generate links</a>
                                    </li> -->

                                    <!--  <li style="border-bottom: 1px solid #5f6369">
                                    <a href="<?php //echo site_url('pintransfertouser'); ?>">Transfer PIN</a>
                                    </li> -->


                                    
                                 
                                </ul>
                            </li>

                               <li class="" style="border-bottom: 1px solid #5f6369">
                                <a href="javascript: void(0);" class="has-arrow waves-effect " aria-expanded="false">
                                <img src="<?php echo base_url('transaction icon.png'); ?>" height="30px">
                                    <span class="menu-title">Transfer PIN</span>
                                </a>
                                <ul class="sub-menu mm-collapse " aria-expanded="false" style="">
                     
                                    <li style="border-bottom: 1px solid #5f6369">
                                    <a href="<?php echo site_url('pintransfertouser'); ?>">Transfer PIN To user</a>
                                    </li>
                                      <li style="border-bottom: 1px solid #5f6369">
                                    <a href="<?php echo site_url('listpintransfertouser'); ?>">List Transfer PIN</a>
                                    </li>
                                    
                                </ul>
                            </li>

                             <li class="" style="border-bottom: 1px solid #5f6369">
                                <a href="javascript: void(0);" class="has-arrow waves-effect " aria-expanded="false">
                                <img src="<?php echo base_url('transaction icon.png'); ?>" height="30px">
                                    <span class="menu-title">Share points</span>
                                </a>
                                <ul class="sub-menu mm-collapse " aria-expanded="false" style="">
                     
                                    <li style="border-bottom: 1px solid #5f6369">
                                    <a href="<?php echo site_url('pointshere'); ?>">Share points</a>
                                    </li>
                                      <li style="border-bottom: 1px solid #5f6369">
                                    <a href="<?php echo site_url('pointsherelist'); ?>">List Share points</a>
                                    </li>
                                    
                                </ul>
                            </li>


                             <li  style="border-bottom: 1px solid #5f6369">
                                <a href="javascript: void(0);" class="has-arrow waves-effect " aria-expanded="false">
                                <img src="<?php echo base_url('customer.jpg'); ?>" height="30px">
                                    <span class="menu-title">Social Media</span>
                                </a>
                                <ul class="sub-menu mm-collapse " aria-expanded="false" style="">
                                <li style="border-bottom: 1px solid #5f6369">
                                    <a href="<?php echo site_url('linkslist'); ?>">Social Media Link</a>
                                    </li>
                                    <li style="border-bottom: 1px solid #5f6369;">
                                    <a href="<?php echo site_url('user_brochure'); ?>" >Brochure</a></li>
                                    <li style="border-bottom: 1px solid #5f6369;">
                                    <a href="<?php echo site_url('user_pamphlet'); ?>" >Pamphlet</a></li>
                                    <li style="border-bottom: 1px solid #5f6369;">
                                    <a href="<?php echo site_url('user_booklet'); ?>" >Booklet</a></li>
                                   
                                </ul>
                            </li>

                              <li  style="border-bottom: 1px solid #5f6369">
                                <a href="<?php echo site_url('referralfTeam'); ?>" class="waves-effect ">
                                    <img src="<?php echo base_url('customer.jpg'); ?>" height="30px">
                                    <span class="menu-title">My Social Media Team</span>
                                </a>
                            </li>
                               <li class="" style="border-bottom: 1px solid #5f6369">
                                <a href="javascript: void(0);" class="has-arrow waves-effect " aria-expanded="false">
                               <i class="mdi mdi-wallet font-size-17 align-middle mr-1"></i>
                                    <span class="menu-title">My Account</span>
                                </a>
                                <ul class="sub-menu mm-collapse " aria-expanded="false" style="">
                                <li style="border-bottom: 1px solid #5f6369">
                                    <a href="<?php echo site_url('wallethistory'); ?>">Account History</a>
                                    </li>
                                 
                                 
                                </ul>
                            </li>
                              <li class="" style="border-bottom: 1px solid #5f6369">
                                <a href="javascript: void(0);" class="has-arrow waves-effect " aria-expanded="false">
                                <img src="<?php echo base_url('transaction icon.png'); ?>" height="30px">
                                    <span class="menu-title">Transaction</span>
                                </a>
                                <ul class="sub-menu mm-collapse " aria-expanded="false" style="">
                     
                                    <li style="border-bottom: 1px solid #5f6369">
                                    <a href="<?php echo site_url('viewtransaction'); ?>">My Transaction</a>
                                    </li>
                                    
                                </ul>
                            </li>

                                 <li class="" style="border-bottom: 1px solid #5f6369">
                                <a href="javascript: void(0);" class="has-arrow waves-effect " aria-expanded="false">
                                <img src="<?php echo base_url('customer.jpg'); ?>" height="30px">
                                    <span class="menu-title">identity card</span>
                                </a>
                                <ul class="sub-menu mm-collapse " aria-expanded="false" style="">
                                <li style="border-bottom: 1px solid #5f6369">
                                    <a href="<?php echo site_url('card_list'); ?>">My Identity card</a>
                                    </li>
                                  
                                   
                                </ul>
                            </li>
                            <li class="" style="border-bottom: 1px solid #5f6369">
                                <a href="javascript: void(0);" class="has-arrow waves-effect " aria-expanded="false">
                                <img src="<?php echo base_url('customer.jpg'); ?>" height="30px">
                                    <span class="menu-title">Offers</span>
                                </a>
                                <ul class="sub-menu mm-collapse " aria-expanded="false" style="">
                                <li style="border-bottom: 1px solid #5f6369">
                                    <a href="<?php echo site_url('userrewardlist'); ?>">Reward</a>
                                    </li>
                                    <li style="border-bottom: 1px solid #5f6369;">
                                    <a href="<?php echo site_url('userawardlist'); ?>" >Award</a></li>
                                    <a href="<?php echo site_url('userawardrewardclaimlist'); ?>" >Award/Reward Claim</a></li>
                                    <li style="border-bottom: 1px solid #5f6369;">
                                </ul>
                            </li>
                            
                            <li  style="border-bottom: 1px solid #5f6369">
                                <a href="<?php echo site_url('userfeedbacklist'); ?>" class="waves-effect ">
                                    <img src="<?php echo base_url('customer.jpg'); ?>" height="30px">
                                    <span class="menu-title">Feedback</span>
                                </a>
                            </li>
                            <!-- <li class="" style="border-bottom: 1px solid #5f6369">
                                <a href="javascript: void(0);" class="has-arrow waves-effect " aria-expanded="false">
                                <img src="<?php //echo base_url('report.jpg'); ?>" height="30px">
                                    <span class="menu-title">Reports</span>
                                </a>
                                <ul class="sub-menu mm-collapse " aria-expanded="false" style="">
                                    <li style="border-bottom: 1px solid #5f6369"><a href="<?php //echo site_url('reports'); ?>">View Report</a> </li>
                                    
                                   
                                </ul>
                            </li> -->
                           
                            
                          
                       
                            
                         
                         <!--    
                            <li  style="border-bottom: 1px solid #5f6369">
                                <a href="<?php echo site_url('ContactUs'); ?>" class="waves-effect ">
                                    <img src="<?php echo base_url('contact_us.jpg'); ?>" height="30px">
                                    <span class="menu-title">Contact Us</span>
                                </a>
                            </li> -->
                            
                        
                         
                         
                         

                           
            </ul> 
   
            <?php } ?>
         
         

        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->