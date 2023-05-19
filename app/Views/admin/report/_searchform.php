
 <style>

    .nav-link{
        background-color:#fff !important;  
        color: #000 !important;
        font-size: 18px;
    }

    a.active{
        background-color:#F6D000 !important;  
        font-size: 18px;  
    }

</style>   
<?php

$router = service('router');
$method = $router->methodName();
?>
 

    <div class="row" style="margin-right: 0px!important;">
        <form action="" id="adminsearch">
            <div class="col-xl-12" >
                <div class="card">                  
                    <div class="card-body">                           
                        <!-- Search  row -->

                        <div class="row ">	                           
                            <div class="col-lg-3 ">
                                <div class="row">
                                    <label> Start Date </label>
                                    <div class="col-md-12">
                                        <input class="form-control" name="start_date" type="date" value="<?php  echo isset($searchArray['start_date']) ? $searchArray['start_date'] : "" ?>" placeholder="Search by start date" >
                                    </div>
                                </div>       
                            </div>								

                            <div class="col-lg-3 ">
                                <div class="row">
                                    <label> End Date </label>
                                    <div class="col-md-12">
                                        <input class="form-control" name="end_date" type="date" value="<?php echo isset($searchArray['end_date']) ? $searchArray['end_date'] :''; ?>" placeholder="Search by end date" >
                                    </div>
                                </div>       
                            </div>

                            <div class="col-lg-3 ">
                                <div class="row">
                                    <label>User ID</label>
                                    <div class="col-md-12">
                                       <input class="form-control" name="username" type="text" value="<?php echo isset($searchArray['username']) ? $searchArray['username'] :''; ?>" placeholder="Search by end ID" > 
                                    </div>
                                </div>       
                            </div>
                            
                            <div class="col-lg-3 ">
                                <div class="row">
                                    <label>Country</label>
                                   <select name="country" id="country" class="form-control">
                                        <option value="">--Select Country--</option>
                              
                                  
                         <?php if(isset($country) && !empty($country)){
                              foreach ($country as $key => $value) {
                                  ?>
                           <option value="<?php echo $value['id']; ?>"<?php echo (isset($searchArray) && !empty($searchArray) && $searchArray['country']==$value['id']) ? 'selected' : ''; ?> >
                              <?php echo $value['name']; ?>
                           </option>
                           <?php }
                              } ?>  
                            </select>
                                </div>       
                            </div>
                            
                        </div><!-- first row end here--> <br />

                        <div class="row ">
                            <div class="col-lg-3 ">
                                <div class="row">
                                    <label>State</label>
                                    <div class="col-md-12">
                                      <select name="state" id="state" class="form-control"> 
                              <option value="">--Select State--</option>
                             <?php if(isset($state) && !empty($state)){
                              foreach ($state as $key => $value) {
                                  ?>
                            
                           <option value="<?php echo $value['id']; ?>" <?php echo (isset($searchArray) && !empty($searchArray) && $searchArray['state']==$value['id']) ? 'selected' : ''; ?> >
                            <?php echo $value['name']; ?>
                             
                           </option>
                         <?php }
                              } ?>  
                            </select>
                                    </div>
                                </div>       
                            </div>

                            <div class="col-lg-3 ">
                                <div class="row">
                                    <label>City</label>
                                    <div class="col-md-12">
                                        <select name="city" id="city" class="form-control "> 
                              <option value="">--Select City--</option>
                               <?php if(isset($city) && !empty($city)){
                              foreach ($city as $key => $value) {
                                  ?>
                            
                           <option value="<?php echo $value['id']; ?>" <?php echo (isset($searchArray) && !empty($searchArray) && $searchArray['city']==$value['id']) ? 'selected' : ''; ?> >
                            <?php echo $value['name']; ?>
                           </option>
                           <?php 
                              } } ?>  
                            </select>
                                    </div>
                                </div>       
                            </div>
 <div class="col-lg-3 ">
                                <div class="row">
                                    <label> User Mobile no.</label>
                                    <div class="col-md-12">
                                        <input class="form-control" name="mobile" type="text" value="<?php echo !empty($searchArray['mobile']) ?   $searchArray['mobile'] : ""; ?>" placeholder="Search by User mobile" >
                                    </div>
                                </div>       
                            </div>

                            <div class="col-lg-3 ">
                                <div class="row">
                                    <label>Pin Type</label>
                                    <div class="col-md-12">
                                        <select class="form-control" name="pin_type" >
                                            <option value="">- All -</option>
                                            <option value="city" <?php echo   (isset($searchArray['coupon_type']) &&  $searchArray['coupon_type'] =='city') ? "Selected" : ""; ?>> Referral PIN</option>
                                            <option value="vip" <?php echo   (isset($searchArray['coupon_type']) &&  $searchArray['coupon_type'] =='vip') ? "Selected" : ""; ?>>Renewal PIN </option>
                                            
                                        </select>                                    
                                    </div>
                                </div>       
                            </div>											                               
                        </div> <!-- second row end here--> <br />	

                        <div class="row ">
                            <div class="col-lg-3 ">
                                <div class="row">
                                    <label> Position </label>
                                    <div class="col-md-12">
                                        <select class="form-control" name="side" >
                                            <option value="">- All -</option>
                                            <option value="city" <?php echo   (isset($searchArray['side']) &&  $searchArray['side'] =='city') ? "Selected" : ""; ?>>Left</option>
                                            <option value="vip" <?php echo   (isset($searchArray['side']) &&  $searchArray['side'] =='vip') ? "Selected" : ""; ?>>Middle</option>
                                             <option value="vip" <?php echo   (isset($searchArray['side']) &&  $searchArray['side'] =='vip') ? "Selected" : ""; ?>>Right</option>
                                            
                                        </select>   
                                    </div>
                                </div>       
                            </div>								

                            <div class="col-lg-3 ">
                                <div class="row">
                                    <label> Amount </label>
                                    <div class="col-md-12">
                                      <input class="form-control" name="amount" type="text" value="<?php echo !empty($searchArray['amount']) ?   $searchArray['amount'] : ""; ?>" placeholder="Search by Amount" >
                                    </div>
                                </div>       
                            </div>
                            <div class="col-lg-3 ">
                                <div class="row">
                                    <label>PIN </label>
                                    <div class="col-md-12">
                                      <input class="form-control" name="pin" type="text" value="<?php echo !empty($searchArray['pin']) ?   $searchArray['pin'] : ""; ?>" placeholder="Search by PIN" >
                                    </div>
                                </div>       
                            </div>


                            <!-- third row end here-->

                           

                            <div class="col-lg-1">
                                <div class="row">
                                </div><br />
                                <div class="col-md-2 text-right">
                                    <button type="submit" class="btn btn-primary waves-effect waves-light mr-1">
                                        Submit
                                    </button>
                                </div>
                            </div>


                            <div class="col-lg-2">
                                <div class="row">
                                </div><br />
                                <div class="col-md-2">
                                    <a href="<?php echo site_url($pageurl); ?>">
                                        <button type="button" class="btn btn-primary waves-effect waves-light mr-1">
                                            Refresh
                                        </button></a>
                                </div>
                            </div>

                        </div>								
                    </div> <!-- end row --> 
                    
                    <!-- end row -->
                </div>
            </div><!-- end card -->
        </form> 
    </div>

<ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link <?php if($method == 'index'){ echo "active"; }?>" onclick="customersearch()" href="javascript::void(0);">Subscriber</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link  <?php if($method == 'adminCompanyReport'){ echo "active"; }?>" onclick="companysearch()"   href="javascript::void(0);">Team</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link  <?php if($method == 'adminOfferReport'){ echo "active"; }?>" onclick="offersearch()"  href="javascript::void(0);">Reward</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link  <?php if($method == 'adminOfferReport'){ echo "active"; }?>" onclick="offersearch()"  href="javascript::void(0);">Award</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link  <?php if($method == 'adminOfferReport'){ echo "active"; }?>" onclick="offersearch()"  href="javascript::void(0);">Point</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if($method == 'transactionreport'){ echo "active"; }?>" onclick="transactionsearch()"  href="javascript::void(0);">Transaction</a>
                </li>
            </ul>



<script>
    
    function customersearch()
    {
        $('#adminsearch').attr('action', "<?php echo site_url('reports');?>");
         $("#adminsearch").submit();
    }
    
    function companysearch()
    { 
        $('#adminsearch').attr('action', "<?php echo site_url('acomapnyreports');?>");
         $("#adminsearch").submit();
    }
    
    function offersearch()
    {
        $('#adminsearch').attr('action', "<?php echo site_url('aofferreports');?>");
         $("#adminsearch").submit();
    }
    
    function transactionsearch()
    {
        $('#adminsearch').attr('action', "<?php echo site_url('transactionreport');?>");
         $("#adminsearch").submit();
    }
    
    function showhideSearch()
    {
        //alert($('#extrasearch').css("display"));

        if ($('#extrasearch').css("display") == "none") {
            $('#searchupdownicon').removeClass("fas fa-angle-down");
            $('#searchupdownicon').addClass("fas fa-angle-up");

        } else {

            $('#searchupdownicon').removeClass("fas fa-angle-up");
            $('#searchupdownicon').addClass("fas fa-angle-down");
        }
        $('#extrasearch').toggle(1000);
    }
</script>

  <script type="text/javascript">

    $(document).ready(function(){
        $("#country").change(function()
      {
        //alert('kkk');
        var id=$(this).val();
        var dataString = 'id='+ id;
        $.ajax
        ({
        type: "POST",
        url: "<?php echo base_url();?>/index.php/ReportController/ajax_state",
        data: dataString,
        cache: false,
        success: function(html)
        {
          //alert(html);
          $("#state").html(html);
        }
        });

      });
      
      $("#state").change(function()
      {
        //alert('kkk');
        var id=$(this).val();
        var dataString = 'id='+ id;
        $.ajax
        ({
        type: "POST",
        url: "<?php echo base_url();?>/index.php/ReportController/ajax_city",
        data: dataString,
        cache: false,
        success: function(html)
        {
          //alert(html);
          $("#city").html(html);
        }
        });

      });

    });
</script>
