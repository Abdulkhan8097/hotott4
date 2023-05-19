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
                    <h4 class="font-size-20"><?php echo $title; ?></h4>
                </div>
            </div>

            <div class="col-sm-8">
                <div class="float-right d-none d-md-block">
                    <div class="dropdown">

                        <a href="addfeedback" class="btn btn-primary waves-effect waves-light">
                            <i class="ion ion-md-add-circle-outline"></i> Add New Feedback
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
                        <input class="form-control" name="txtsearch" type="text" value="<?php echo $txtsearch; ?>" placeholder="Search Feedback Title" >
                    </div>

              

                    <div class="col-lg-1">
                        <button type="submit" class="btn btn-primary waves-effect waves-light mr-1">
                            Submit
                        </button>
                    </div>
                       <div class="col-lg-1">
                        <a href="userfeedbacklist" class="btn btn-primary waves-effect waves-light mr-1">
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
							            <th class="text-center"  data-sortable="true">Feedback Title</th>
							            <th class="text-center"  data-sortable="true">Feedback</th>
							            <th class="text-center">Status</th>
                                        <th class="text-center">Action</th>
           
          <!--   <th>Path</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                	 <tr>
                                	<?php  $i=0;
                                        foreach ($feedbacks as $kdata) {
                                            $i++;
                                            ?>
      
                                             <th class="text-center"><?php echo $i; ?></th>
                                          <td class="text-center"><?php echo $kdata->feedback_title; ?></td>
                                          <td class="text-center"><?php echo $kdata->feedback; ?></td>
                                          <td class="text-center"><?php echo $kdata->feedback_status; ?></td>
                                          <td class="text-center">
                                          	 <a href="<?php echo base_url('FeedbackController/feedbackdetails?id='. $kdata->feedback_id) ?>"
                              class="btn btn-info" title="feedback List" id="first"><i class="fas fa-eye" style="padding-right: 0;"></i></a>

                                          </td>
         

           
           

      
                    </tr>
           
       <?php }
        ?>


                                </tbody>
                            </table>
                            <?php if ($pagination['haveToPaginate']) { ?>
                                <br>
    <?php echo view('admin/_paging', array('paginate' => $pagination, 'siteurl' => '', 'varExtra' => $searchArray)); ?>

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