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
                    <h4 class="font-size-20">SHARE POINT LIST</h4>
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
        
            <div class="col-xl-12">
             <form action="">
                <div class="row">                   
                    <div class="col-lg-5">
                        <input class="form-control" name="txtsearch" type="text" value="<?php echo $txtsearch; ?>" placeholder="Search Amount and User ID" >
                    </div>

              

                    <div class="col-lg-1">
                        <button type="submit" class="btn btn-primary waves-effect waves-light mr-1">
                            Submit
                        </button>
                    </div>
                     <div class="col-lg-1">
                        <a href="pointsherelist" class="btn btn-primary waves-effect waves-light mr-1">
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
                                        <th class="text-center" data-sortable="true">Received User ID	</th>
                                        <th class="text-center" data-sortable="true">Amount</th>
                                   
                                         <th class="text-center" data-sortable="true">Created Date</th>
                                  
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <?php 
                                        $i=0;
                                        foreach ($history as $kdata) {
                                            $i++;
                                            ?>
                                        <th class="text-center"><?php echo $i; ?></th>
                                        <td class="text-center"><?php echo $kdata->received_username	; ?></td>
                                        <td class="text-center"><?php echo $kdata->share_amount; ?></td>
                                  
                                        <td class="text-center"><?php echo $kdata->created; ?></td>
                                                            
                                        </tr>
                            <?php } ?>


                                </tbody>
                            </table>
<?php if ($pagination['haveToPaginate']) { ?>
                                <br>
    <?php echo view('admin/_paging', array('paginate' => $pagination, 'siteurl' => 'pointsherelist', 'varExtra' => $searchArray)); ?>

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





