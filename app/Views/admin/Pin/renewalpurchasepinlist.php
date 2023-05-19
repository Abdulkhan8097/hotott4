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
.badge{
    color: #fff!important;
    font-size: 100%!important;
}

</style>

<div class="page-content">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-sm-4">
                <div class="page-title-box">
                    <h4 class="font-size-20">Purchase Renewal PIN List</h4>
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

                  <!--       <a href="genratepin" class="btn btn-primary waves-effect waves-light">
                            <i class="ion ion-md-add-circle-outline"></i> Add New Pin
                        </a> -->

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
                    <div class="col-lg-3">
                        <input class="form-control" name="txtsearch" type="text" value="<?php echo $txtsearch; ?>" placeholder="Search pin" >
                    </div>
              
                     <div class="col-lg-3">
                         <select name="used_status" class="form-control"  >
                              <option selected disabled>--Select PIN Status--</option>
                              <option value="Active" <?php echo (isset($searchArray) && !empty($searchArray) && $searchArray['used_status']=='Active') ? 'selected' : ''; ?>>used PIN</option>
                              <option value="Inactive" <?php echo (isset($searchArray) && !empty($searchArray) && $searchArray['used_status']=='Inactive') ? 'selected' : ''; ?>>unused PIN</option>
                              
                          </select>
                    </div>


              

                    <div class="col-lg-1">
                        <button type="submit" class="btn btn-primary waves-effect waves-light mr-1">
                            Submit
                        </button>
                    </div>
                    <div class="col-lg-1">
                      <a href="listpurchaserenewalpin" class="btn btn-primary waves-effect waves-light">
                            </i>Reset
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
                                        <th class="text-center" data-sortable="true">Name</th>
                                        <th class="text-center" data-sortable="true">Package Name</th>
                                        <th class="text-center" data-sortable="true">Renewal Pin</th>
                                        
                                         <th class="text-center" data-sortable="true">Used Status</th>
                                         <th class="text-center" data-sortable="true">Used Date</th>
                                         <th class="text-center" data-sortable="true">Action</th>
                                  
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <?php 
                                        $i=0;
                                        foreach ($pin as $kdata) {
                                            $i++;
                                            ?>
                                        <th class="text-center"><?php echo $i; ?></th>
                                        <td class="text-center"><?php echo $kdata->generate_name; ?></td>
                                        <td class="text-center"><?php echo $kdata->package_name; ?>( <?php echo $kdata->amount; ?> )</td>
                                        <td class="text-center"><?php echo $kdata->pin; ?></td>
                                         <td class="text-center">

                                            <?php if($kdata->used_status=='Active')
                                              {?>
                                           <span class="badge rounded-pill bg-success">Active</span>
                                           <?php }elseif ($kdata->used_status=='Expired') {?>
                                              <span class="badge rounded-pill bg-secondary">Expired</span>
                                           <?php }else{  ?>
                                           <span class="badge rounded-pill bg-danger">InActive</span>
                                           <?php } ?> 
                                            </td>
                                                <?php if($kdata->used_status == "Inactive"){?>
                                                       <td><?php echo $kdata->used_date;?></td>
                                                        <td><a href="<?php echo site_url();?>/PinController/activePin?id=<?=$kdata->id;?>"><button class="btn" id="" style="background-color:green;color:white">Renew Now</button></a></td>
                                                      <?php } else { ?>
                                                     
                                                        <td><?php echo $kdata->used_date;?></td>
                                                        <td><button class="btn" id="" style="background-color:red;color:white">Used</button></td>
                                                      <?php } ?>

                                                                             
                                        </tr>
                            <?php } ?>


                                </tbody>
                            </table>
<?php if ($pagination['haveToPaginate']) { ?>
                                <br>
    <?php echo view('admin/_paging', array('paginate' => $pagination, 'siteurl' => 'listpurchaserenewalpin', 'varExtra' => $searchArray)); ?>

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


