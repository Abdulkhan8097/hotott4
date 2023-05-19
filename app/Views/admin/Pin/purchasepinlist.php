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



// Only necessary change from a UX perspective
.shareUrl-input {
/*  cursor: pointer;*/
}

/* Stylistic Changes
=================== */
// fonts
$font-sans: -apple-system,BlinkMacSystemFont,"Roboto","Oxygen","Ubuntu","Cantarell","Open Sans","Helvetica Neue",sans-serif;
$font-code: Menlo, Monaco, "Courier New", Courier, monospace;
// colors
$background: linear-gradient(to bottom right, RGBA(8,81,119,1), RGBA(118,199,196,1)), rgba(8,81,119,1);
$highlight-color: rgba(116,201,71,.8);
$transparent: rgba(0,0,0,0);
$white: #fff;
$body-color: #fff;

html {
  height: 100%;
  box-sizing: border-box;

  *, *:before, *:after {
    box-sizing: inherit;
  }
}

body {
  max-width: 100%;
  overflow-x: hidden;
  font-family: $font-sans;
  letter-spacing: 0;
  font-weight: 400;
  font-style: normal;
  text-rendering: optimizeLegibility;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  -moz-font-feature-settings: "liga" on;
  background: $background;
  color: $body-color;
    
  ::selection {
    background: $highlight-color;
    color: $white;
  }
}
.wrapper {
  background: $background;
}
p {
  line-height: 1.3;
}

// Share URL Component
.shareUrl {
  width: 100%;
  padding: 40px 20px;
  text-align: center;
}
.shareUrl-header {
  margin-bottom: 40px;
}
.shareUrl-headerText {
  margin-top: 0;
  margin-bottom: 10px;
  font-size: 22px;
}
.shareUrl-subtext {
  margin-top: 10px;
  font-size: 14px;
}
.shareUrl-body {
  margin-bottom: 70px;
}
.shareUrl-input {
  width: 100%;
  padding: 10px 0;
  border: 2px solid rgba(0,0,0,.09);
  text-align: center;
  font-size: 10px;
  font-weight: bold;
  color: rgb(241 25 55 / 90%);
  background: $transparent;
  border-radius: 3px;
  transition: all 300ms ease;

  &:hover,
  &:focus,
  &:active {
    border-color: rgba(0,0,0,.3);
    background: rgba(255,255,255,.1);
  }
}

// Media Queries
@media (min-width: 568px) {
  .shareUrl {
    padding: 70px 20px;
  }
  .shareUrl-input {
    max-width: 100%;
    font-size: 56px;
  }
  .shareUrl-headerText {
    font-size: 32px;
  }
}

// Helpers
.u-verticalGrid {
  display: flex;
  flex-flow: column wrap;
}
.u-flexCenter {
 /* display: flex;*/
  align-items: center !important;
}
.u-flexCenterHorizontal {
  display: flex;
  justify-content: center !important;
}

.u-size1040 {
  max-width: 1040px;
}
.u-marginAuto {
  margin: 0 auto;
}

</style>
<?php  $user_id = ($session->get('user_id')); ?>
<div class="page-content">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-sm-4">
                <div class="page-title-box">
                    <h4 class="font-size-20">Referral PIN List</h4>
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

                <!--         <a href="genratepin" class="btn btn-primary waves-effect waves-light">
                            <i class="ion ion-md-add-circle-outline"></i> Add New Pin
                        </a> -->

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
                    <div class="col-lg-3">
                        <input class="form-control" name="txtsearch" type="text" value="<?php echo $txtsearch; ?>" placeholder="Search pin" >
                    </div>
                   <!--   <div class="col-lg-3">
                         <select name="pin_type" class="form-control"  >
                              <option selected disabled>--Select PIN Type--</option>
                              <option value="1" <?php echo (isset($searchArray) && !empty($searchArray) && $searchArray['pin_type']=='1') ? 'selected' : ''; ?>>Referral PIN</option>
                              <option value="2" <?php echo (isset($searchArray) && !empty($searchArray) && $searchArray['pin_type']=='2') ? 'selected' : ''; ?>>Renewal PIN</option>
                              
                          </select>
                    </div> -->
                     <div class="col-lg-3">
                         <select name="used_status" class="form-control"  >
                              <option selected disabled>--Select PIN Status--</option>
                              <option value="Active" <?php echo (isset($searchArray) && !empty($searchArray) && $searchArray['used_status']=='Active') ? 'selected' : ''; ?>>used PIN</option>
                              <option value="Inactive" <?php echo (isset($searchArray) && !empty($searchArray) && $searchArray['used_status']=='Inactive') ? 'selected' : ''; ?>>unused PIN</option>
                              
                          </select>
                    </div>


              

                    <div class="col-lg-1">
                        <button type="submit" class="btn btn-primary waves-effect waves-light mr-1">
                            Submit
                        </button>
                    </div>
                    <div class="col-lg-1">
                      <a href="listpurchasepin" class="btn btn-primary waves-effect waves-light">
                            </i>Reset
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
                                        <th class="text-center" data-sortable="true">Name</th>
                                        <th class="text-center" data-sortable="true">Package Name</th>
                                        <th class="text-center" data-sortable="true">Pin</th>
                                         <th class="text-center" data-sortable="true">Used Status</th>
                                  
                                       
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
                                        <td class="text-center"><?php echo $kdata->generate_name; ?></td>
                                        <td class="text-center"><?php echo $kdata->package_name; ?>( <?php echo $kdata->amount; ?> )</td>
                                        <td class="text-center"><?php echo $kdata->pin; ?></td>
                                         <td class="text-center">

                                            <?php if($kdata->used_status=='Active')
                                              {?>
                                           <span class="badge rounded-pill bg-success">Active</span>
                                           <?php }elseif ($kdata->used_status=='Expired') {?>
                                              <span class="badge rounded-pill bg-secondary">Expired</span>
                                           <?php }else{  ?>
                                           <span class="badge rounded-pill bg-danger">InActive</span>
                                           <?php } ?> 
                                           &nbsp;&nbsp;&nbsp;
                                           <?php if($kdata->used_status=='Inactive')
                                              { ?>
                                                 <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#myModal" onclick="getvalue(this);" value="<?php echo $user_id; ?>,<?php echo $kdata->id; ?>,<?php echo $kdata->pin; ?>" >Shere Link </button>
                                              <?php } ?> 
                                            </td>

                                                                             
                                        </tr>
                            <?php } ?>


                                </tbody>
                            </table>
<?php if ($pagination['haveToPaginate']) { ?>
                                <br>
    <?php echo view('admin/_paging', array('paginate' => $pagination, 'siteurl' => 'listpurchasepin', 'varExtra' => $searchArray)); ?>

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

<!------------ Modal ------------------->

<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h2 style="color:#000 !important;">Link </h2>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

           		 
               <div class="wrapper">
  <div class="content u-flexCenter u-sizeViewHeightMin100">
    <div class="shareUrl u-verticalGrid u-marginAuto u-size1040">
      <header class="shareUrl-header">
        <h1 class="shareUrl-headerText">Click to Copy Invite Link</h1>
       
      </header>
      <div class="shareUrl-body">
        <div class="container">
          <!-- COPY INPUT -->
          <input class="shareUrl-input js-shareUrl" type="text" readonly="readonly" />
          <p class="shareUrl-subtext">Click above to copy the link.</p>
        </div>
      </div>
      
    </div>
  </div>
</div>
                
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div><!-- end modal content-->    
    </div><!-- modal-dialog -->
</div><!-- modal fade -->

<?php $ref_url = site_url('./Invite?ref='); ?>


<!--     <script type="text/javascript">
     function getvalue(value) {
    if (typeof value === 'object' && typeof value.getAttribute === 'function') {
        var val = value.getAttribute("value");
        var valArray = val.split(",");
        alert(valArray);
         // var valArray =  $('#redata2').val(valArray);

          var dataElement = document.getElementById("redata2"); // Get the HTML element by its ID
  dataElement.innerHTML = valArray; 
      
        
        var id = valArray[0];
        var pin = valArray[1];
        
        // Do something with the values
        console.log("id:", id);
        console.log("pin:", pin);
    } else {
        console.error("value is not a DOM element");
    }
}

    </script>  -->


<script>

         function getvalue(value) {
    if (typeof value === 'object' && typeof value.getAttribute === 'function') {
       
        // var valArray = val.split(",");
        // alert(valArray);
         // var valArray =  $('#redata2').val(valArray);

      
        
        // var id = valArray[0];
        // var pin = valArray[1];
        
        // Do something with the values
         var val = value.getAttribute("value");
     shareUrl.value = <?=json_encode($ref_url)?> + val;

    } else {
        console.error("value is not a DOM element");
    }
}
  function copy(element) {
    return function() {
      document.execCommand('copy', false, element.select());
    }
  }

  var shareUrl = document.querySelector('.js-shareUrl');
  var copyShareUrl = copy(shareUrl);

  shareUrl.addEventListener('click', copyShareUrl, false);

  // function getValue(btn) {
  //   alert(btn);
  //   var value = btn.value;
  //   var valArray = value.split(",");
  //   var id = valArray[0];
  //   var pin = valArray[1];
  //   shareUrl.value = id + ' ' + pin;
  // }

</script>




