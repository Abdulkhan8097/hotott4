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
                        <input class="form-control" name="txtsearch" type="text" value="<?php echo $txtsearch; ?>" placeholder="Search User Name" >
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
                                        <th class="text-center"  data-sortable="true">User Name</th>
                                        <th class="text-center"  data-sortable="true">Aadhar Card(Front)</th>
                                        <th class="text-center"  data-sortable="true">Aadhar Card(Back)</th>
                                        <th class="text-center" data-sortable="true">Pan Card</th>
                                        <th class="text-center" data-sortable="true">Driving License</th>
                                        <th class="text-center" data-sortable="true">Voter Card</th>
                                        <th class="text-center" data-sortable="true">Electric Bill</th>
                                        <th class="text-center" data-sortable="true">Passport</th>
                                        <th class="text-center" data-sortable="true">Created At</th>
                                        <th>Action</th>
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

                                        <td class="text-center"><?php echo $kdata->username; ?>

                                         <?php if($kdata->aadhar_card_front !== NULL) { ?>
                                            <td class="text-center"><a href="<?php echo base_url('/admin/images/kyc/aadhar_front/'.$kdata->aadhar_card_front); ?>" target="_blank"><img src="<?php echo base_url('/admin/images/kyc/aadhar_front/'.$kdata->aadhar_card_front); ?>" alt="Aadhar Card(Front)" width="64" height="64"></a></td>
                                        <?php } else { ?>
                                            <td></td>
                                            <?php } ?>

                                        <?php if($kdata->aadhar_card_back !== NULL) { ?>
                                            <td class="text-center"><a href="<?php echo base_url('/admin/images/kyc/aadhar_back/'.$kdata->aadhar_card_back); ?>" target="_blank"><img src="<?php echo base_url('/admin/images/kyc/aadhar_back/'.$kdata->aadhar_card_back); ?>" alt="Aadhar Card(Back)" width="64" height="64"></a></td>
                                        <?php } else { ?>
                                            <td></td>
                                            <?php } ?>

                                         <?php if($kdata->pan !== NULL) { ?>
                                            <td class="text-center"><a href="<?php echo base_url('/admin/images/kyc/pan/'.$kdata->pan); ?>" target="_blank"><img src="<?php echo base_url('/admin/images/kyc/pan/'.$kdata->pan); ?>" alt="PAN Card" width="64" height="64"></a></td>
                                        <?php } else { ?>
                                            <td></td>
                                            <?php } ?>

                                         <?php if($kdata->driving_license !== NULL) { ?>
                                            <td class="text-center"><a href="<?php echo base_url('/admin/images/kyc/driving_license/'.$kdata->driving_license); ?>" target="_blank"><img src="<?php echo base_url('/admin/images/kyc/driving_license/'.$kdata->driving_license); ?>" alt="Driving License" width="64" height="64"></a></td>
                                        <?php } else { ?>
                                            <td></td>
                                            <?php } ?>

                                         <?php if($kdata->voter_card !== NULL) { ?>
                                            <td class="text-center"><a href="<?php echo base_url('/admin/images/kyc/voter/'.$kdata->voter_card); ?>" target="_blank"><img src="<?php echo base_url('/admin/images/kyc/voter/'.$kdata->voter_card); ?>" alt="Voter Card" width="64" height="64"></a></td>
                                        <?php } else { ?>
                                            <td></td>
                                            <?php } ?>

                                         <?php if($kdata->electric_bill !== NULL) { ?>
                                            <td class="text-center"><a href="<?php echo base_url('/admin/images/kyc/electric_bill/'.$kdata->electric_bill); ?>" target="_blank"><img src="<?php echo base_url('/admin/images/kyc/electric_bill/'.$kdata->electric_bill); ?>" alt="Electricity Bill" width="64" height="64"></a></td>
                                        <?php } else { ?>
                                            <td></td>
                                            <?php } ?>

                                        <?php if($kdata->passport !== NULL) { ?>
                                            <td class="text-center"><a href="<?php echo base_url('/admin/images/kyc/passport/'.$kdata->passport); ?>" target="_blank"><img src="<?php echo base_url('/admin/images/kyc/passport/'.$kdata->passport); ?>" alt="Passport" width="64" height="64"></a></td>
                                        <?php } else { ?>
                                            <td></td>
                                            <?php } ?>  
                                            <td><?php echo $kdata->created_on; ?></td>  
                                            <td><a href="<?php echo site_url('delkyc?id=' . $kdata->id) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</a></td>
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