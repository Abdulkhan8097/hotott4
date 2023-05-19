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
                           <th>UserID</th>
                           <td><?php echo $preview[0]->username;?></td>
                        </tr>
                        <tr>
                           <th>Feedback Title</th>
                           <td><?php echo $preview[0]->feedback_title;?></td>
                        </tr>
                          <tr>
                           <th>Feedback</th>
                           <td><?php echo $preview[0]->feedback;?></td>
                        </tr>
                        <tr>
                           <th>Status</th>
                           <td><?php echo $preview[0]->feedback_status;?></td>
                        </tr>
                         <tr>
                           <th>Date</th>
                           <td><?php echo date('d F Y', strtotime($preview[0]->created_on));?></td>
                        </tr>
                        
           
                          
                     </tbody>
                  </table>
                   
                    </div>
                    <div class="col-sm-8">
                <div class="float-right d-none d-md-block">
                    <div class="dropdown">

                        <a class="btn btn-secondary waves-effect waves-light" onclick="window.history.back();">
                            <i class="ion ion-md-arrow-back"></i> Back
                        </a>

                    </div>
                </div>
            </div>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
</div> <!-- container-fluid -->
</div>
<!-- End Page-content -->
