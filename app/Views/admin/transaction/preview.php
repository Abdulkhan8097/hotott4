<style type="text/css">
    .card{
        border-radius: 2.75rem!important;
    }
    .table-bordered td, .table-bordered th{
    border: 2px solid #e9ecef !important;
    }
</style>
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="col-12">
                            
                                <h2 class="mb-4">Details</h2>
                           
                          
                              
                        
                            
                            <table class="table table-striped table-bordered m-top20">
                     <tbody>
                         <tr>
                           <th>Transaction ID</th>
                           <td><?php echo $preview[0]->transaction_id;?></td>
                        </tr>
                        <tr>
                           <th>User Name</th>
                           <td><?php echo $preview[0]->username;?></td>
                        </tr>
                         <tr>
                           <th>Package Name</th>
                           <td><?php echo $preview[0]->package_name; ?>( <?php echo $preview[0]->packageamount; ?> )</td>
                        </tr>
                          <tr>
                           <th>User Name</th>
                           <td><?php echo $preview[0]->username;?></td>
                        </tr>
                        <tr>
                           <th>Pay By</th>
                           <td><?php echo $preview[0]->pay_by;?></td>
                        </tr>
                          <tr>
                           <th>No of Pin</th>
                           <td>
                           <?php 



                                                        



                                            $PinModel = new \App\Models\PinModel();

                                            $pinIds = explode(',', $preview[0]->pin_id);

                                                $count = 0; // initialize counter variable

                                              foreach ($pinIds as $pinId) {
                                                    $pin = $PinModel->where('id',$pinId)->first();
                                                      //echo $PinModel->getLastQuery()->getQuery();
                                                     // print_r($pin);
                                                    // exit;


                                                   
                                                        // echo '<option value="'.$pin['pin'].'">'.$pin['pin'].'</option>';
                                                        $count++; // increment counter
                                                   
                                                }
                                                echo ' '.$count;
                                                ?>

                           </td>
                        </tr>
                         <tr>
                           <th>Amount</th>
                           <td><?php echo $preview[0]->amount; ?></td>
                        </tr>
                          <tr>
                           <th>Payment Status</th>
                           <td><?php echo $preview[0]->Payment_status;?></td>
                        </tr>

                       
                         <tr>
                           <th>Date</th>
                           <td><?php echo date('d F Y', strtotime($preview[0]->created));?></td>
                        </tr>
                        
           
                          
                     </tbody>
                  </table>
                   
                    </div>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
</div> <!-- container-fluid -->
</div>
<!-- End Page-content -->
