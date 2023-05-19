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
.rounded-pill {
    border-radius: 50rem!important;
    font-size: 17px;
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

                  

                        <a class="btn btn-secondary waves-effect waves-light" onclick="window.history.back();">
                            <i class="ion ion-md-arrow-back"></i> Back
                        </a>

                    </div>
                </div>
            </div>
        </div>

        <!-------------------------------- search --------------------------->
        
            <div class="col-xl-12">
         
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
                                       <!--  <th>Tree</th> -->
            <th class='text-center'>Name</th>
            <th class='text-center'>Username</th>
            <th class='text-center'>Position</th>
            <th class='text-center'>Sponsor Name</th>
            <th class='text-center'>Level</th>
            <th class='text-center'>Status</th>
          <!--   <th>Path</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
        foreach ($tree as $key => $value) {
        	
        	// $ActiveUserModel = new \App\Models\ActiveUserModel();
         //   $getdata=$ActiveUserModel->where('username',$value['username'])->first();
         //   $status=$getdata['status'];
     

         

           
            echo "<tr>";
            // echo "<td>$key</td>";
            echo "<td class='text-center' class='text-center'>{$value['name']}</td>";
            echo "<td class='text-center'>{$value['username']}</td>";
            echo "<td class='text-center'>{$value['side']}</td>";
            echo "<td class='text-center'>{$value['sponsor_name']}</td>";
            echo "<td class='text-center'>{$value['level']}</td>";
            
              echo "<td class='text-center' style='
    font-size: 23px;
'>{$value['status']}</td>";

  



                                              	
            
           
            // echo "<td class='text-center'>{$value['path']}</td>";
            echo "</tr>";

      

            if (isset($value['children'])) {
                foreach ($value['children'] as $child_key => $child_value) {

              
                    echo "<tr>";
                    // echo "<td class='text-center'>$child_key</td>";
                    echo "<td class='text-center'>{$child_value['name']}</td>";
                    echo "<td class='text-center'>{$child_value['username']}</td>";
                    echo "<td class='text-center'>{$child_value['side']}</td>";
                    echo "<td class='text-center'>{$child_value['sponsor_name']}</td>";
                    echo "<td class='text-center'>{$child_value['level']}</td>";
                    echo "<td class='text-center' style='font-size: 23px;'>{$child_value['status']}</td>";
                      

            
                                          
                    // echo "<td class='text-center'>{$child_value['path']}</td>";
                    echo "</tr>";
                }
            }
        }
        ?>


                                </tbody>
                            </table>
                            <?php if ($pagination['haveToPaginate']) { ?>
                                <br>
    <?php echo view('admin/_paging', array('paginate' => $pagination, 'siteurl' => 'activeteam', 'varExtra' => $searchArray)); ?>

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



