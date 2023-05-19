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
                           <th>Sponsor Name</th>
                           <td><?php echo $preview->sponsor_name;?></td>
                        </tr>
                        <tr>
                           <th>Position</th>
                           <td><?php echo $preview->side;?></td>
                        </tr>
                         <tr>
                           <th>PIN</th>
                           <td><?php echo $preview->pin;?></td>
                        </tr>
                          <tr>
                           <th>User Name</th>
                           <td><?php echo $preview->name;?></td>
                        </tr>
                        <tr>
                           <th>Username</th>
                           <td><?php echo $preview->username;?></td>
                        </tr>
                        <tr>
                           <th>Password</th>
                           <td><?php echo $preview->password;?></td>
                        </tr>
                         <tr>
                           <th>Treansaction Password</th>
                           <td><?php echo $preview->transaction_password;?></td>
                        </tr>
                        
                     
                          <tr>
                           <th>Email</th>
                           <td><?php echo $preview->email;?></td>
                        </tr>

                         <tr>
                           <th>Mobile</th>
                           <td><?php echo $preview->mobile;?></span></td>
                        </tr>
                         <tr>
                           <th>Gender</th>
                           <td><?php echo $preview->gender;?></span></td>
                        </tr>
                        <tr>
                           <th>date of Birth</th>
                           <td><?php echo $preview->date_of_birth;?></span></td>
                        </tr>



                      <tr>
                           <th>country</th>
                           <td><?php echo $preview->countriess_name;?></td>
                        </tr>  
                      
                          <tr>
                           <th>State</th>
                           <td><?php echo $preview->statename;?></td>
                        </tr>
                          <tr>
                           <th>City</th>
                           <td><?php echo $preview->cityname;?></td>
                        </tr>
                         <tr>
                           <th>Address_line1</th>
                           <td><?php echo $preview->address_line1;?></td>
                        </tr>
                         <tr>
                           <th>Address_line2</th>
                           <td><?php echo $preview->address_line2;?></td>
                        </tr>
                         <tr>
                           <th>Nomine Name</th>
                           <td><?php echo $preview->nomine_name;?></td>
                        </tr>
                         <tr>
                           <th>Nomine Relation</th>
                           <td><?php echo $preview->nomine_relation;?></td>
                        </tr>
                         <tr>
                           <th>Bank Name</th>
                           <td><?php echo $preview->bank_name;?></td>
                        </tr>
                         <tr>
                           <th>Bank Branch</th>
                           <td><?php echo $preview->bank_country;?></td>
                        </tr>
                         <tr>
                           <th>Account Holder Name</th>
                           <td><?php echo $preview->acc_holder_name;?></td>
                        </tr>
                         <tr>
                           <th>IFSC Code</th>
                           <td><?php echo $preview->ifsc_code;?></td>
                        </tr>
                         <tr>
                           <th>Date</th>
                           <td><?php echo date('d F Y', strtotime($preview->created));?></td>
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
