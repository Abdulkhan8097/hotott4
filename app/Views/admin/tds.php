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
                    <h4 class="font-size-20">TDS</h4>
                </div>
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

        <!-------------------------------- search --------------------------->
        
        
            </div>
        
        <br>	 

        <div class="row">
            <div class="col-xl-12">
                <div class="card">
<?php echo view('admin/_topmessage'); ?>
                    <div class="card-body">
					  
                        <div class="table-responsive">
                           <table  data-toggle="table" data-striped="true" class="table table-hover table-centered table-nowrap mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-center"  data-sortable="true">Sl. No.</th>
                                        <th class="text-center" data-sortable="true">TDS</th>
                                       
                                       
                                        <th class="text-center" data-sortable="true">created</th>
                                         <th class="text-center" data-sortable="true">update on</th>
                                        
                                  
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
                                        <td class="text-center"><?php echo $kdata['tds']; ?></td>
                                       
                                
                                        <td class="text-center"><?php echo $kdata['created_on']; ?></td>
                                         <td class="text-center"><?php echo $kdata['edited_on']; ?></td>
                                     
                                    
					


                                            <td class="text-center">
                                                <a title="edit" class="btn btn-success waves-effect waves-light" href="<?php echo site_url('editTDS?id='.$kdata['id']); ?>">
                                                    <i class="fas fa-edit"></i>
                                                </a> 

                                              
                                           
												
					
                                            </td> <?php //} ?>                                            
                                        </tr>
                            <?php } ?>


                                </tbody>
                            </table>

                        </div>
						
						
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->
    </div> <!-- container-fluid -->

</div>
<!-- End Page-content -->  






