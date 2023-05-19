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
                    <h4 class="font-size-20"><?php echo $title; ?></h4>
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

                        <a href="AddCustomer" class="btn btn-primary waves-effect waves-light">
                            <i class="ion ion-md-add-circle-outline"></i> Add New Member
                        </a>

                        <a class="btn btn-secondary waves-effect waves-light" onclick="window.history.back();">
                            <i class="ion ion-md-arrow-back"></i> Back
                        </a>

                    </div>
                </div>
            </div>
        </div>

        <!-------------------------------- search --------------------------->
        
            <div class="col-xl-12">
             <form action="">
                <div class="row">                   
                    <div class="col-lg-5">
                        <input class="form-control" name="txtsearch" type="text" value="<?php echo $txtsearch; ?>" placeholder="Search User ID Mobile no" >
                    </div>

              

                    <div class="col-lg-1">
                        <button type="submit" class="btn btn-primary waves-effect waves-light mr-1">
                            Submit
                        </button>
                    </div>
                       <div class="col-lg-1">
                        <a href="Customers" class="btn btn-primary waves-effect waves-light mr-1">
                            Reset
                        </a>
                    </div>
                   </form>
		  <div class="col-lg-3">

                   
                       
                    </div>
                </div>
            </div>
        
        <br>	 

        <div class="row">
            <div class="col-xl-12">
                <div class="card">
<?php echo view('admin/_topmessage'); ?>
                    <div class="card-body">
					   <?php if($pagination["getNbResults"] >0 ){ ?>
                        <div class="table-responsive">
                           <table  data-toggle="table" data-striped="true" class="table table-hover table-centered table-nowrap mb-0">
                                <thead>
                                    <tr>
                                      
                                       <th class="text-center"  data-sortable="true">Sl. No.</th>
							            <th class="text-center"  data-sortable="true">Name</th>
							            <th class="text-center"  data-sortable="true">User ID</th>
							            <th class="text-center"  data-sortable="true">Email</th>
							            <th class="text-center"  data-sortable="true">Mobile no</th>
							            <th class="text-center"  data-sortable="true">Position</th>
							            <th class="text-center"  data-sortable="true">Sponsor Name</th>
							            <th class="text-center">Action</th>
           
          <!--   <th>Path</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                	 <tr>
                                	<?php  $i=0;
                                        foreach ($customers as $kdata) {
                                            $i++;
                                            ?>
      
                                             <th class="text-center"><?php echo $i; ?></th>
                                          <td class="text-center"><?php echo $kdata->name; ?></td>
                                          <td class="text-center"><?php echo $kdata->username; ?></td>
                                          <td class="text-center"><?php echo $kdata->email; ?></td>
                                          <td class="text-center"><?php echo $kdata->mobile; ?></td>
                                          <td class="text-center"><?php echo $kdata->side; ?></td>
                                          <td class="text-center"><?php echo $kdata->sponsor_name; ?></td>
                                          <td class="text-center">
                                          	 <a href="<?php echo base_url('CustomerController/customerdetails?id='. $kdata->id) ?>"
                              class="btn btn-info" title="Product List" id="first"><i class="fas fa-eye" style="padding-right: 0;"></i></a>

                                          </td>
         

           
           

      
                    </tr>
           
       <?php }
        ?>


                                </tbody>
                            </table>
                            <?php if ($pagination['haveToPaginate']) { ?>
                                <br>
    <?php echo view('admin/_paging', array('paginate' => $pagination, 'siteurl' => 'Customers', 'varExtra' => $searchArray)); ?>

<?php } ?>

                        </div>
						 <?php }else{ ?>
                            <?php echo view('admin/_noresult'); ?>
                        <?php } ?>
						 
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->
    </div> <!-- container-fluid -->

</div>
<!-- End Page-content -->  

<!------------ Modal ------------------->

<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h2 style="color:#000 !important;"> Company Name </h2>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <form class="custom-validation" id ="edit_model" method='post' action="CompanyController/add_vip" enctype='multipart/form-data'>		 
                <input type="hidden" id="id" name="id" >

                <div class="modal-body" id="divListvip">
                    
                </div> <!-- end modal body-->
                
                <center><button type="submit" class="btn btn-primary waves-effect waves-light mr-1" id="owner-submit-btn">
                        Submit
                    </button></center> <br>
            </form>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div><!-- end modal content-->    
    </div><!-- modal-dialog -->
</div><!-- modal fade -->



