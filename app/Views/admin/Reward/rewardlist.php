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

                        <a href="addreward" class="btn btn-primary waves-effect waves-light">
                            <i class="ion ion-md-add-circle-outline"></i> Add Reward
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
                        <input class="form-control" name="txtsearch" type="text" value="<?php echo $txtsearch; ?>" placeholder="Search" >
                    </div>

              

                    <div class="col-lg-1">
                        <button type="submit" class="btn btn-primary waves-effect waves-light mr-1">
                            Submit
                        </button>
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
                                        <th class="text-center"  data-sortable="true">Start Date</th>
                                        <th class="text-center"  data-sortable="true">End Date</th>
                                        <th class="text-center" data-sortable="true">Reward Name</th>
                                     
                                        <th class="text-center" data-sortable="true">price</th>
                                         <th class="text-center" data-sortable="true">Reward Status</th>
                                  
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <?php 
                                        $i=0;
                                        foreach ($list as $kdata) {
                                            $i++;
                                            ?>
                                        <th class="text-center"><?php echo $i; ?></th>
                                        <td class="text-center"><?php echo $kdata->start_date; ?></td>
                                        <td class="text-center"><?php echo $kdata->end_date; ?></td>
                                        <td class="text-center"><?php echo $kdata->r_name; ?></td>
                                        <td class="text-center"><?php echo $kdata->price; ?></td>
                                         <td class="text-center">

                                            <?php if($kdata->r_status=='1')
                                              {?>
                                           <span class="badge rounded-pill bg-success">Active</span>
                                           <?php }else{  ?>
                                           <span class="badge rounded-pill bg-danger">Expire</span>
                                           <?php } ?> 
                                            </td>

                                            <td class="text-center">
                                                
                                                <?php if($kdata->r_status=='0')
                                                    {?>


                                                      <a href="javascript:void(0);" onclick="statusChange('<?php echo $kdata->r_id; ?>','1','<?php echo base_url('Reward/updatestatus'); ?>');"
                                        class="btn btn-success" title="Active"><i class="fa fa-toggle-on"  style="padding-right: 0;"></i></a>
                                                <?php } else
                                                    {?>
                                                        <a href="javascript:void(0);" onclick="statusChange('<?php echo $kdata->r_id; ?>','0','<?php echo base_url('Reward/updatestatus'); ?>');"
                                        class="btn btn-danger" title="Inactive"><i class="fa fa-toggle-off"  style="padding-right: 0;"></i></a>
                                                <?php } ?> 


                                                 <a href="<?php echo site_url('Reward/preview?id='.$kdata->r_id); ?>"class="btn btn-primary" title="view" ><i class="fa fa-eye" style="padding-right: 0;"></i></a>
                                                 <a title="edit" class="btn btn-success waves-effect waves-light" href="<?php echo site_url('addreward?id='.$kdata->r_id); ?>">
                                                    <i class="fas fa-edit"></i>
                                                </a> 

                                                  <a href="<?php echo base_url('Reward/delete?id='.$kdata->r_id); ?>"
                                        onclick="return confirm('Are you sure to Delete?');"
                                        class="btn btn-danger"><i class="fa fa-trash"
                                            style="padding-right: 0;"></i></a>
                                         
                                           
												
					
                                            </td>                                            
                                        </tr>
                            <?php } ?>


                                </tbody>
                            </table>
<?php if ($pagination['haveToPaginate']) { ?>
                                <br>
    <?php echo view('admin/_paging', array('paginate' => $pagination, 'siteurl' =>$action, 'varExtra' => $searchArray)); ?>

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

  <script type="text/javascript">
                     function statusChange(id,status)
                    {
                      $.ajax({
                          type: "POST",
                          url: "<?php echo base_url('Reward/updatestatus'); ?>",
                          data: {id:id,status:status},
                          cache: false,
                          success:function(responseData)
                          {            
                             location.reload();
                          }   
                      });
                    }
</script>

  

