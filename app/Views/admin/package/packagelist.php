<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<?php $session = session(); ?>
<style>
   

    .font-size-20 {
        color: #000;
    }

 

#side-bar img{
float:right !important; 
height:35x; 
width:35px;

}

.btn-primary-btn{
background:#FFFFFF;
border:none;
padding:1px;
}
.change_userlevel{
display:inline !important;}


</style>

<div class="page-content">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-sm-4">
                <div class="page-title-box">
                    <h4 class="font-size-20">Package Details</h4>
                </div>
            </div>

            <div class="col-sm-8">
                <div class="float-right d-none d-md-block">
                    <div class="dropdown">

<!--                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                            Customer List
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="Customers">All Customer List</a>
                            <a class="dropdown-item" href="Customer_List">Customer List</a>
                            <a class="dropdown-item" href="VipCustomers">V.I.P Customer List</a>
                        </div>-->

                        

                        <a class="btn btn-secondary waves-effect waves-light" onclick="window.history.back();">
                            <i class="ion ion-md-arrow-back"></i> Back
                        </a>

                    </div>
                </div>
            </div>
        </div>

        <!-------------------------------- search --------------------------->
        
        
            </div>
        
        <br>	 

        <div class="row">
            <div class="col-xl-12">
                <div class="card">
<?php echo view('admin/_topmessage'); ?>
                    <div class="card-body">
					  
                        <div class="table-responsive">
                           <table  data-toggle="table" data-striped="true" class="table table-hover table-centered table-nowrap mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-center"  data-sortable="true">Sl. No.</th>
                                        <th class="text-center" data-sortable="true">Package Name</th>
                                        <th class="text-center" data-sortable="true">Amount</th>
                                        <th class="text-center" data-sortable="true">stack</th>
                                        <th class="text-center" data-sortable="true">created</th>
                                         <th class="text-center" data-sortable="true">update on</th>
                                         <th class="text-center" data-sortable="true">Capping</th>
                                  
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <?php 
                                        $i=0;
                                        foreach ($package as $kdata) {
                                            $i++;
                                            ?>
                                        <th class="text-center"><?php echo $i; ?></th>
                                        <td class="text-center"><?php echo $kdata['package_name']; ?></td>
                                        <td class="text-center"><?php echo $kdata['amount']; ?></td>
                                        <td class="text-center"><?php echo $kdata['stock']; ?></td>
                                        <td class="text-center"><?php echo $kdata['entry_datetime']; ?></td>
                                         <td class="text-center"><?php echo $kdata['update_datetime']; ?></td>
                                         <td class="text-center"><?php echo $kdata['capping']; ?></td>
                                    
					
				
<!-- 
                                           <?php //if($session->get('user_id')) { ?>
					     <td class="text-center">   
						 <a class="btn btn-primary waves-effect waves-light" href="<?php //echo site_url('CustomerDetails?id=' . $kdata->id); ?>">
                                                    <i class="ion ion-md-add-circle-outline"></i>
                                                </a>  
					   </td> <?php //} else { ?>  -->

                                            <td class="text-center">
                                                <a title="edit" class="btn btn-success waves-effect waves-light" href="<?php echo site_url('editpackage?id=' . $kdata['package_id']); ?>">
                                                    <i class="fas fa-edit"></i>
                                                </a> 

                                              
                                           
												
					
                                            </td> <?php //} ?>                                            
                                        </tr>
                            <?php } ?>


                                </tbody>
                            </table>

                        </div>
						
						
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->
    </div> <!-- container-fluid -->

</div>
<!-- End Page-content -->  






