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
                            
                                <h2 class="mb-4"><?php echo $title ?></h2>
                                <h2 class="" style="float: right;"> <a class="btn btn-secondary waves-effect waves-light" onclick="window.history.back();">
                            <i class="ion ion-md-arrow-back"></i> Back
                        </a></h2>
                               
                           
                          
                              
                        
                            
                            <table class="table table-striped table-bordered m-top20">
                     <tbody>
                         <tr>
                            <th>Durations</th>
                           <td><?php echo $preview[0]->duration . ' Months';?></td>
                        </tr>
                         <tr>
                           <th>PIN</th>
                           <td><?php echo $preview[0]->a_pin;?></td>
                        </tr>
                          <tr>
                           <th>Award Name</th>
                           <td><?php echo $preview[0]->a_name;?></td>
                        </tr>
                        <tr>
                           <th>Title</th>
                           <td><?php echo $preview[0]->title;?></td>
                        </tr>
                        <tr>
                           <th>Description</th>
                           <td><?php echo $preview[0]->description;?></td>
                        </tr>
                         <tr>
                           <th>PIN</th>
                           <td><?php echo $preview[0]->a_pin;?></td>
                        </tr>
                        
                     
                          <tr>
                           <th>Prize</th>
                           <td><?php echo $preview[0]->price;?></td>
                        </tr>

                        
                         <tr>
                           <th>Date/Time</th>
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
