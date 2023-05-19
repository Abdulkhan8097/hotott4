<?php $session = session();
$joindate=$session->get('created');
$current=date("Y-m-d");
 $exp_date=date('Y-m-d h:m:s',strtotime('+30 days',strtotime(str_replace('/', '-', $joindate)))) . PHP_EOL;

 ?>

<style>
.col-sm{
background:#07133D; 
margin-right:34px;
}


.col-sm-4{
background:#07133D; 
margin-right:30px;
}


.pull-right{
padding: 10px 0 ;
}

.tile-heading{
font-size:20px;
font-weight:500;
margin-bottom:14px;
}
.tile-footer {
    padding: 5px 8px;
    background-color:#B30008 !important;
}

.tile-footer a{
     color: #ffffff !important;
}

.tile-heading a{
     color: #ffffff !important;
}

.fa-arrow-right{
float:right !important;
margin:0;
}

</style>

<style>


.datetime{

  color: #000;
  background: #fff;
  font-family: "Segoe UI", sans-serif;
  width: 400px;
  padding: 15px 10px;
  /*border: 1px solid #F6D000;*/
  border-radius: 5px;
 /* -webkit-box-reflect: below 1px linear-gradient(transparent, rgba(255, 255, 255, 0.1));*/
  transition: 0.5s;
  transition-property: background, box-shadow;



margin-top: -74px;
    margin-bottom: 20px;
margin-left:20px;
}

.datetime:hover{
  background: #fff;
  box-shadow: 0 0 30px #fff;
}

.date{
  font-size: 20px;
  font-weight: 600;
  text-align: center;
  letter-spacing: 3px;
}

.time{
  font-size: 40px;
  display: flex;
  justify-content: center;
  align-items: center;
}

.time span:not(:last-child){
  position: relative;
  margin: 0 6px;
  font-weight: 500;
  text-align: center;

}

.time span:last-child{
  background: #fff;
  font-size: 30px;
  font-weight: 600;
  text-transform: uppercase;
  margin-top: 10px;
  padding: 0 5px;
  border-radius: 3px;
}
.right-sidebar{

  color: #000;
  background: #fff;
  font-family: "Segoe UI", sans-serif;
  width: 500px;
  
  padding: 15px 10px;
  /*border: 1px solid #F6D000;*/
  border-radius: 5px;
  -webkit-box-reflect: below 1px linear-gradient(transparent, rgba(255, 255, 255, 0.1));
  transition: 0.5s;
  transition-property: background, box-shadow;

margin-top: -74px;
margin-bottom: 20px;
margin-right:10px !important;
}

.col-sm-2{
  display: inline;

}

.list_all li {
 display: inline;
margin:0 3em 0 4em;
}

.pull-right img{
float:right !important; 
border-radius: 50%;
height:56x; 
width:56px;
}

.pull-right{
color: #fff;
}
.blink {
  animation: blink-animation 1s infinite;
}

@keyframes blink-animation {
  0% {
    opacity: 1;
  }
  50% {
    opacity: 0;
  }
  100% {
    opacity: 1;
  }
}

</style>
<style type="text/css">
    .flipdown.flipdown__theme-dark .rotor, .flipdown.flipdown__theme-dark .rotor-top, .flipdown.flipdown__theme-dark .rotor-leaf-front{
        color: #FFFFFF;
    background-color: #081647!important;
    }
    .flipdown.flipdown__theme-dark .rotor-bottom, .flipdown.flipdown__theme-dark .rotor-leaf-rear {
    color: #EFEFEF;
    background-color: #081647!important;
  }
  .flipdown.flipdown__theme-dark .rotor-group:nth-child(n+2):nth-child(-n+3):before, .flipdown.flipdown__theme-dark .rotor-group:nth-child(n+2):nth-child(-n+3):after {
    background-color: #081647!important;
  }
</style>

<div class="page-content">
    <div class="container-fluid">

    	<!-- start page title -->
        <div class="row align-items-center">
            


            <div class="col-sm-6">
                <div class="page-title-box">
                    <?php if ($session->get('user_id')){
                $username=$session->get('username');
                $ActiveUserModel = new \App\Models\ActiveUserModel();
                $checkmsg=$ActiveUserModel->where('username',$username)->where('status','Inactive')->find();
                if ($checkmsg) {
               
             ?>
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item active" style="color:#000;"><h3 class="mandatory"><span class="blink"><span class="mandatory">*</span>Your PIN has expired please  Renew the PIN<span class="mandatory">*</span></span></h3></li>
                    </ol>
                       <?php } }?>
                </div>
            </div>
     

             <div class="col-sm-6">
                <div class="page-title-box" style="float: right;">
                    <?php if ($session->get('user_id')){    ?>
                     <a href="<?php echo base_url('purchasepin'); ?>" class="btn btn-primary waves-effect waves-light">
                            <i class="ion ion-md-add-circle-outline"></i> PIN Purchase 
                        </a>
                    <?php } ?>
                </div>
            </div>
        </div>       
    </div> 
</div>



    <!--digital clock start-->
 <body onLoad="initClock()">
<div class="container">
  <div class="row">
     <div class="col-sm-6" >

    <div class="datetime">
      <div class="date">
        <span id="dayname">Day</span>,
        <span id="month">Month</span>
        <span id="daynum">00</span>,
        <span id="year">Year</span>
      </div>
      <div class="time">
        <span id="hour">00</span>:
        <span id="minutes">00</span>:
        <span id="seconds">00</span>
        <span id="period">AM</span>
      </div>
    </div>
</div>


<div class="col-sm-6" >
    <?php if($session->get('user_id')){  ?>
    <?php if ( $current < $exp_date) {

?>
     <div class="example" style="margin-top: -73px">
  <!-- <h1>FlipDown.js</h1> -->
  <!-- <p>⏰ A lightweight and performant</p> -->
  <div id="flipdown" class="flipdown"></div>
  <div class="buttons">
   <!--  <p>Version: <span id="ver"></span> (&lt;11KB minified)</p>
    <a href="https://github.com/PButcher/flipdown#flipdown" target="_blank" class="button"><i class="fab fa-github"></i> <span>Get started</span></a> -->
  </div>
</div>
<?php 
}} ?>

</div>


</div>
</div>
    <!--digital clock end-->

<?php if($session->get('admin_id')){  ?>

<div class="container">
  <div class="row" style="margin:0 20px;">

    <div class="col-sm" >
        <h2 class="pull-right"> <?php echo $leftcount;?><img src="<?php echo base_url('customer.jpg'); ?>"></h2>
         <div class="tile-heading" style="padding:14px 0;"><a href="VipCode">Left Count</div>
         <div class="tile-footer"> More info 
        <i class="fa fa-arrow-right" aria-hidden="true pull-right"></i> </a>
       </div>
    </div> 



    <div class="col-sm" >
        <h2 class="pull-right"><?php echo $Middlecount; ?> <img src="<?php echo base_url('customer.jpg'); ?>"></h2>
        <span class="text-dark font-weight-bold"> <?php echo $active_customer_count; ?></span>
         <div class="tile-heading" style="padding:14px 0;"><a href="Customers">Middle Count</div>
         <div class="tile-footer"> More info 
        <i class="fa fa-arrow-right" aria-hidden="true pull-right"></i> </a>
       </div>
    </div> 

   <div class="col-sm" >
      <h2 class="pull-right"><?php echo $rightcount; ?> <img src="<?php echo base_url('customer.jpg'); ?>"></h2>
      <span class="text-dark font-weight-bold"> <?php echo $active_companycount; ?></span>
      <div class="tile-heading" style="padding:14px 0;"><a href="Company"> Right Count</div>
       <div class="tile-footer"> More info
      <i class="fa fa-arrow-right" aria-hidden="true pull-right"></i>  </a>
     </div>
  </div>
  
      <div class="col-sm" >
       <h2 class="pull-right"><?php echo $totalcount;?> <img src="<?php echo base_url('vip.jpg'); ?>"></h2>
       <div class="tile-heading" style="padding:14px 0;"><a href="Products">Total Team </div>
       <div class="tile-footer"> More info
       <i class="fa fa-arrow-right" aria-hidden="true pull-right"></i></a>
      </div>
    </div>
   
  </div>
</div> 


<?php } ?>
<?php if ($session->get('user_id')){	?>




<div class="container">
  <div class="row" style="margin:30px 20px;">

    <div class="col-sm" >
        <h2 class="pull-right"> <?php echo $leftcount;?><img src="<?php echo base_url('customer.jpg'); ?>"></h2>
         <div class="tile-heading" style="padding:14px 0;"><a href="VipCode">Left Count</div>
         <div class="tile-footer"> More info 
        <i class="fa fa-arrow-right" aria-hidden="true pull-right"></i> </a>
       </div>
    </div> 



    <div class="col-sm" >
        <h2 class="pull-right"><?php echo $Middlecount; ?> <img src="<?php echo base_url('customer.jpg'); ?>"></h2>
        <span class="text-dark font-weight-bold"> <?php echo $active_customer_count; ?></span>
         <div class="tile-heading" style="padding:14px 0;"><a href="Customers">Middle Count</div>
         <div class="tile-footer"> More info 
        <i class="fa fa-arrow-right" aria-hidden="true pull-right"></i> </a>
       </div>
    </div> 

   <div class="col-sm" >
      <h2 class="pull-right"><?php echo $rightcount; ?> <img src="<?php echo base_url('customer.jpg'); ?>"></h2>
      <span class="text-dark font-weight-bold"> <?php echo $active_companycount; ?></span>
      <div class="tile-heading" style="padding:14px 0;"><a href="Company"> Right Count</div>
       <div class="tile-footer"> More info
      <i class="fa fa-arrow-right" aria-hidden="true pull-right"></i>  </a>
     </div>
  </div>
  
      <div class="col-sm" >
       <h2 class="pull-right"><?php echo $totalcount;?> <img src="<?php echo base_url('vip.jpg'); ?>"></h2>
       <div class="tile-heading" style="padding:14px 0;"><a href="Products">Total Team </div>
       <div class="tile-footer"> More info
       <i class="fa fa-arrow-right" aria-hidden="true pull-right"></i></a>
      </div>
    </div>


</div>
</div>

<<!-- div class="container">
  <div class="row" style="margin:30px 20px 90px;">
      <div class="col-sm" >
      <h2 class="pull-right"><?php echo $rightcount; ?> <img src="<?php echo base_url('customer.jpg'); ?>"></h2>
      <span class="text-dark font-weight-bold"> <?php echo $active_companycount; ?></span>
      <div class="tile-heading" style="padding:14px 0;"><a href="Company">Toatal Active Team</div>
       <div class="tile-footer"> More info
      <i class="fa fa-arrow-right" aria-hidden="true pull-right"></i>  </a>
     </div>
  </div>
  
      <div class="col-sm" >
       <h2 class="pull-right"><?php echo $totalcount;?> <img src="<?php echo base_url('vip.jpg'); ?>"></h2>
       <div class="tile-heading" style="padding:14px 0;"><a href="Products">Toatal InActive Team </div>
       <div class="tile-footer"> More info
       <i class="fa fa-arrow-right" aria-hidden="true pull-right"></i></a>
      </div>
    </div>

      <div class="col-sm" >
      <h2 class="pull-right"><?php echo $rightcount; ?> <img src="<?php echo base_url('customer.jpg'); ?>"></h2>
      <span class="text-dark font-weight-bold"> <?php echo $active_companycount; ?></span>
      <div class="tile-heading" style="padding:14px 0;"><a href="Company">Toatal Referral Team</div>
       <div class="tile-footer"> More info
      <i class="fa fa-arrow-right" aria-hidden="true pull-right"></i>  </a>
     </div>
  </div>
  
      <div class="col-sm" >
       <h2 class="pull-right"><?php echo $totalcount;?> <img src="<?php echo base_url('vip.jpg'); ?>"></h2>
       <div class="tile-heading" style="padding:14px 0;"><a href="Products">Total Transfer PIN</div>
       <div class="tile-footer"> More info
       <i class="fa fa-arrow-right" aria-hidden="true pull-right"></i></a>
      </div>
    </div>



    
   


</div>
</div>
 -->


<?php } ?>

<!--------------------------------- employee section ------------------------------------>

<?php if ($session->get('employee_id')){	?>

<div class="container">
  <div class="row" style="margin:0 20px;">

    <div class="col-sm" >
        <h2 class="pull-right"><?php echo $customer_count; ?> <img src="<?php echo base_url('customer.jpg'); ?>"></h2>
         <div class="tile-heading"><a href="Customers">Customers</div>
         <div class="tile-footer"> More info 
        <i class="fa fa-arrow-right" aria-hidden="true pull-right"></i> </a>
       </div>
    </div> 

   <div class="col-sm" >
      <h2 class="pull-right"><?php echo $companycount; ?> <img src="<?php echo base_url('company.jpg'); ?>"></h2>
      <div class="tile-heading"><a href="Company"> Company </div>
       <div class="tile-footer"> More info
      <i class="fa fa-arrow-right" aria-hidden="true pull-right"></i>  </a>
     </div>
  </div>
  
      <div class="col-sm" >
       <h2 class="pull-right"><?php echo $productCount;?> <img src="<?php echo base_url('product.jpg'); ?>"></h2>
       <div class="tile-heading"><a href="Products">Products </div>
       <div class="tile-footer"> More info
       <i class="fa fa-arrow-right" aria-hidden="true pull-right"></i></a>
      </div>
    </div>


   
  </div>
</div> 





<div class="container">
  <div class="row" style="margin:30px 20px 90px;">

 <div class="col-sm" >
       <h2 class="pull-right"><?php echo $redeemCount;?> <img src="<?php echo base_url('redeem.jpg'); ?>"></h2>
       <div class="tile-heading"><a href="Redeem_Products">Redeem Products </div>
       <div class="tile-footer"> More info
       <i class="fa fa-arrow-right" aria-hidden="true pull-right"></i></a>
      </div>
    </div>


   <div class="col-sm" >
       <h2 class="pull-right"> <img src="<?php echo base_url('report.jpg'); ?>"></h2>
       <div class="tile-heading" style="padding-top:32px;"><a href="Reports">Reports </div>
       <div class="tile-footer"> More info
       <i class="fa fa-arrow-right" aria-hidden="true pull-right"></i></a>
      </div>
    </div>
	
	<div class="col-lg-4" >      
        </div> 


</div>
</div>

<?php } ?>




    <script type="text/javascript">
    function updateClock(){
      var now = new Date();
      var dname = now.getDay(),
          mo = now.getMonth(),
          dnum = now.getDate(),
          yr = now.getFullYear(),
          hou = now.getHours(),
          min = now.getMinutes(),
          sec = now.getSeconds(),
          pe = "AM";

          if(hou >= 12){
            pe = "PM";
          }
          if(hou == 0){
            hou = 12;
          }
          if(hou > 12){
            hou = hou - 12;
          }

          Number.prototype.pad = function(digits){
            for(var n = this.toString(); n.length < digits; n = 0 + n);
            return n;
          }

          var months = ["January", "February", "March", "April", "May", "June", "July", "Augest", "September", "October", "November", "December"];
          var week = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
          var ids = ["dayname", "month", "daynum", "year", "hour", "minutes", "seconds", "period"];
          var values = [week[dname], months[mo], dnum.pad(2), yr, hou.pad(2), min.pad(2), sec.pad(2), pe];
          for(var i = 0; i < ids.length; i++)
          document.getElementById(ids[i]).firstChild.nodeValue = values[i];
    }

    function initClock(){
      updateClock();
      window.setInterval("updateClock()", 1);
    }
    </script>

    <script type="text/javascript" src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/kineticjs/5.2.0/kinetic.min.js"></script>
<script type="text/javascript" src="<?php echo base_url('admin/js/jquery.final-countdown.js');?>"></script>

<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', () => {

  // Unix timestamp (in seconds) to count down to
   
  var twoDaysFromNow = (new Date(<?=json_encode ($joindate)?>).getTime() / 1000) + (86400 * 30) + 1;

  // Set up FlipDown
  var flipdown = new FlipDown(twoDaysFromNow)

    // Start the countdown
    .start()

    // Do something when the countdown ends
    .ifEnded(() => {
      console.log('The countdown has ended!');
    });


  
  var ver = document.getElementById('ver');
  ver.innerHTML = flipdown.version;
});

</script>





