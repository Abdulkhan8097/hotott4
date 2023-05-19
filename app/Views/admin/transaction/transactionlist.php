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
                    <h4 class="font-size-20">Transaction List</h4>
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
                    <div class="mt-2 col-lg-3">
                        <input class="form-control" name="txtsearch" type="text" value="<?php echo $txtsearch; ?>" placeholder="Search username transaction id" >
                    </div>
                    
                    <div class="mt-2 col-lg-3">
                        <input type="date" name="start_date" class="form-control">
                    </div>
                    
                    <div class="mt-2 col-lg-3">
                        <input type="date" name="end_date" class="form-control">
                    </div>
               
                     <div class="mt-2 col-lg-3">
                         <select name="Payment_status" class="form-control"  >
                              <option selected disabled>--Select Payment Status--</option>
                              <option value="Success" <?php echo (isset($searchArray) && !empty($searchArray) && $searchArray['Payment_status']=='Success') ? 'selected' : ''; ?>>Success</option>
                              <option value="Failure" <?php echo (isset($searchArray) && !empty($searchArray) && $searchArray['Payment_status']=='Failure') ? 'selected' : ''; ?>>Failure</option>
                              
                          </select>
                    </div>
                    <div class="mt-2 col-lg-3">
                         <select name="pay_by" class="form-control"  >
                              <option value="" >--Select Transaction Method--</option>
                              <option value="Online" <?php echo (isset($searchArray) && !empty($searchArray) && $searchArray['pay_by']=='Online') ? 'selected' : ''; ?>>Online</option>
                              <option value="Wallet" <?php echo (isset($searchArray) && !empty($searchArray) && $searchArray['pay_by']=='Wallet') ? 'selected' : ''; ?>>Wallet</option>
                              
                          </select>
                    </div>


              

                    <div class="mt-2 col-lg-1">
                        <button type="submit" class="btn btn-primary waves-effect waves-light mr-1">
                            Submit
                        </button>
                    </div>
                    <div class="mt-2 col-lg-1">
                      <a href="viewtransaction" class="btn btn-primary waves-effect waves-light">
                            </i>Reset
                        </a>
                    </div>
                   </form>
		  <div class="mt-2 col-lg-3">

                   
                       
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
                                        <th class="text-center" data-sortable="true">Transaction ID</th>
                                        <th class="text-center" data-sortable="true">UserID</th>
                                        <th class="text-center" data-sortable="true">Package Name</th>
                                        <th class="text-center" data-sortable="true">No of Pin</th>
                                        <th class="text-center" data-sortable="true">Amount</th>
                                         <th class="text-center" data-sortable="true">Payment Status</th>
                                         <th class="text-center" data-sortable="true">Action</th>
                                  
                                       
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
                                        <td class="text-center"><?php echo $kdata->transaction_id; ?></td>
                                        <td class="text-center"><?php echo $kdata->username; ?></td>
                                        <td class="text-center"><?php echo $kdata->package_name; ?>( <?php echo $kdata->packageamount; ?> )</td>
                                        <td class="text-center">

                                        	<?php 



    													



                                            $PinModel = new \App\Models\PinModel();

                                            $pinIds = explode(',', $kdata->pin_id);

                                                $count = 0; // initialize counter variable
                                                
                                                $totalCount = 0;

                                              foreach ($pinIds as $pinId) {
                                                    $pin = $PinModel->where('id',$pinId)->first();
                                                    //   echo $PinModel->getLastQuery()->getQuery();
                                                    //   print_r($pin);
                                                    // exit;
                                                    
                                                        // echo '<option value="'.$pin['pin'].'">'.$pin['pin'].'</option>';
                                                        $pin = $count++; // increment counter
                                                        $totalCount += $pin;
                                                }
                                                echo ' '.$count;


            //                             	foreach ($pin as $key => $value) {

            //                             		$conn=mysqli_connect("localhost","genie",'Genie@20',"ott_mlm");
												// $query="Select pin from pin where id= $value";
												//     $result = mysqli_query($conn,$query);
												//     while ($row = mysqli_fetch_object($result)) {
    								// 					   echo '<option value="'.$row->id.'">'.$row->pin.'</option>';
    								// 					}
                                        	// }


                                        	


                                        	?>
                                        	</td>
                                        	<td class="text-center"><?php echo $kdata->amount; ?></td>
                                         <td class="text-center">

                                            <?php if($kdata->Payment_status=='Success')
                                              {?>
                                           <span class="badge rounded-pill bg-success">Success</span>
                                           <?php }else{  ?>
                                           <span class="badge rounded-pill bg-danger">Failure</span>
                                           <?php } ?> 
                                            </td>
                                             <td class="text-center">

                                         <a title="preview" class="btn btn-warning waves-effect waves-light" href="<?php echo site_url('previewtransaction?id='.$kdata->tr_id); ?>">
                                                   <i class="fa fa-eye" aria-hidden="true"></i>
                                                </a>
                                                <a title="invoice" class="btn btn-success waves-effect waves-light" href="<?php echo site_url('invoicetransaction?id='.$kdata->tr_id.'&username='.$kdata->username); ?>">
                                                   <i class="fa fa-eye" aria-hidden="true"></i>
                                                </a>
                                                
                                                <a title="invoice" class="btn btn-success waves-effect waves-light" href="<?php echo site_url('invoicetransactionpdf?id='.$kdata->tr_id.'&username='.$kdata->username); ?>">
                                                   <i class="fa fa-download" aria-hidden="true"></i>
                                                </a>
                                            </td>

                                                                             
                                        </tr>
                            <?php } ?>


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
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="row">
                        <div class="col-md-10">
                            <div class="form-group row">
                                <label for="inputPassword" class="col-sm-2 ml-4 col-form-label">Total Transaction Amount</label>
                                    <div class="col-sm-6">
                                        <label class="col-sm-2 ml-4 col-form-label"><?php echo $totalAmt; ?></label>
                                   </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword" class="col-sm-2 ml-4 col-form-label">Total No. of Pin</label>
                                   <div class="col-sm-6">
                                    <label class="col-sm-2 ml-4 col-form-label"><?php echo $totalCount; ?></label>
                                   </div>
                                  </div>
                               </div>                             
                           </div>
                          </div>
                          </div>
                          </div>
    </div> <!-- container-fluid -->

</div>
<!-- End Page-content -->  



