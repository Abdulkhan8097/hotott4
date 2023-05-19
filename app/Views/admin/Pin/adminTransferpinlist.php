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
                    <h4 class="font-size-20">Transfer Pin List</h4>
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

                        <a href="adminpintransfertouser" class="btn btn-primary waves-effect waves-light">
                            <i class="ion ion-md-add-circle-outline"></i> Transfer PIN To user
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
                        <input class="form-control" name="txtsearch" type="text" value="<?php echo $txtsearch; ?>" placeholder="Search Transfer to User ID" >
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
                                        <th class="text-center" data-sortable="true">Transfer Date</th>
                                        <th class="text-center" data-sortable="true">Pin Type</th>
                                        <th class="text-center" data-sortable="true">Transfer from User ID</th>
                                        <th class="text-center" data-sortable="true">Transfer to User ID</th>
                                        <th class="text-center" data-sortable="true">Transfer Name</th>
                                        <th class="text-center" data-sortable="true">Pin</th>
                                        <th class="text-center" data-sortable="true">Action</th>
                                        
                                  
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <?php 
                                        $i=0;
                                        foreach ($pin as $kdata) {
                                            $i++;
                                            ?>
                                        <th class="text-center"><?php echo $i; ?></th>
                                        <td class="text-center"><?php echo $kdata->pin_transfer_date; ?></td>
                                        <td class="text-center">
                                        	
                                        	<?php if ($kdata->pin_type=='1') {?>
                                        		Referral Pin
                                        	<?php }else{ ?>
                                        		Renewal Pin
                                        	<?php } ?>

                                        </td>
                                        <td class="text-center"><?php echo $kdata->transfer_form; ?></td>
                                          <td class="text-center"><?php echo $kdata->transfer_to; ?></td>
                                        <td class="text-center"><?php echo $kdata->name; ?></td>
                                        <td class="text-center"><?php echo $kdata->pin; ?></td>
                                        <td class="text-center"> 

                                            <?php if ($kdata->transfer_form=='HOTOTT'){ ?>
                                                
                                           

                                            <a href="<?php echo base_url('PinController/transferpindelete?id='.$kdata->id); ?>"
                                        onclick="return confirm('Are you sure to Delete?');"
                                        class="btn btn-danger"><i class="fa fa-trash"
                                            style="padding-right: 0;"></i></a>
                                             <?php } ?>



                                        </td>

                                                                                  
                                        </tr>
                            <?php } ?>


                                </tbody>
                            </table>
<?php if ($pagination['haveToPaginate']) { ?>
                                <br>
    <?php echo view('admin/_paging', array('paginate' => $pagination, 'siteurl' => 'adminlistpintransfertouser', 'varExtra' => $searchArray)); ?>

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



<script>   
     function getVipList(companyid)
        { 
                     var request = $.ajax( {
                            url : "<?php echo site_url('getvipcompany?companyid='); ?>"+companyid,
                            cache: false,
                            contentType: false,
                            processData: false,
                            async: false,
                            type: 'GET',
                            
                            success: function(res) {
                            
                                $('#divListvip').html(res); 
                              
                            },
                            fail: function(res) {
                                errorFlag = true;
                                console.log(res);
                                
                            },
                            error: function(xhr, status, error) {
                                errorFlag = true;
                                var errorMessage = xhr.status + ': ' + xhr.statusText;
                                console.log('Error - ' + errorMessage);
                                
                            }
                        })

        }
        
        
    function assigncompany(comid)
    {
        $('#companyid').val(comid);
    }
    $(document).ready(function () {
        
        $('#editmodel').on('show.bs.modal', function (e) {
            if (e.namespace === 'bs.modal') {
                var opener = e.relatedTarget;
                var id = $(opener).attr('data-id');


                $('#edit_model').find('[name="id"]').val(id);

            }
        });
    });
</script>


<script type='text/javascript'>
  function getConfirmation(id)
  {
    if (id != '')
    {
        $.ajax({
          url: "<?=site_url('/index.php/CustomerController/vip_plus');?>",
          type: "post",
          data: {'id' : id},
          success: function (response) {
            alert('success');
           location.reload();              
          }
      });
    }

}
</script>

