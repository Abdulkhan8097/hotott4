
<style type="text/css">
  .modal-header .close {
  
    margin: 0rem 0rem 0rem 0rem;
}
.form-group{

width: 144%;
}
.col-md-10{
    flex: 0%!important;
    max-width: 100%!important;
}
.off{
    box-shadow: 8.0px 16.0px 16.0px hsl(0deg 0% 0% / 0.25);
}
</style>
   <script src="<?php echo base_url('/js/jquery.min.js'); ?>"></script>
    <script src="<?php echo base_url('/js/popper.min.js'); ?>"></script>
    <script src="<?php echo base_url('/js/bootstrap.min.js'); ?>"></script>

    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                             <?php echo view('admin/_topmessage'); ?>
                             
                          <div class="row">
                            <div class="col-lg-3"> 
                               <h4 class="card-title">Purchase PIN</h4>     
                          </div>  

                    </div>
                  <hr>
                 <form class="custom-validation"  method='post' action="<?php echo base_url('PinController/purchasepinTransaction'); ?>" > 
                 <div class="d-flex">                           
                              <div class="for-mobile-laptop" style="width: 100%;" >
                              <div class="row">
                               
                                <div class="col-md-10">
                                  <div class="form-group row">
                                    <label for="inputPassword" class="col-sm-2 ml-4 col-form-label">Select Package</label>
                                    <div class="col-sm-6">
                                     <select name="pid" id="pid" class="form-control" onchange="myFunction(this)" required>
                                 <option value=""><--Select Package--></option>
                                 <?php if(isset($package) && !empty($package)){
                                    foreach ($package as $key => $value) {
                                        ?>
                                 <option value="<?php echo $value['package_id']; ?>" >
                                    <?php echo $value['package_name']; ?>  (<?php echo $value['amount']; ?>)
                                 </option>
                                 <?php }
                                    } ?>          
                              </select>
                                   </div>

                                  </div>
                               </div>                             
                           </div>
                            <div class="row">
                                <div class="col-md-10">
                                  <div class="form-group row">
                                    <label for="inputPassword" class="col-sm-2 ml-4 col-form-label">Types OF PIN</label>
                                    <div class="col-sm-6">
                                    <select name="pin_type" class="form-control" id="myid" required>
                              <option selected disabled><--Select--></option>
                              <option value="1" >Referral PIN</option>
                              <option value="2" >Renewal PIN</option>
                      
                              </select>
                                   </div>
                                  </div>
                               </div>                             
                           </div>

                              <div class="row">
                                <div class="col-md-10">
                                  <div class="form-group row">
                                    <label for="inputPassword" class="col-sm-2 ml-4 col-form-label">Number Of Pin</label>
                                    <div class="col-sm-6">
                                      <input type="text" class="form-control" id="pin" name="pin" placeholder="number of pin " required>
                                   </div>
                                  </div>
                               </div>                             
                           </div>
                              <div class="row">
                                <div class="col-md-10">
                                  <div class="form-group row">
                                    <label for="inputPassword" class="col-sm-2 ml-4 col-form-label">Amount</label>
                                    <div class="col-sm-6">
                                      <input type="text" class="form-control"  name="amt" placeholder="Amount " id="amt" readonly required>
                                   </div>
                                  </div>
                               </div>                             
                           </div>
                             <div class="row">
                                <div class="col-md-10">
                                  <div class="form-group row">
                                    <label for="inputPassword" class="col-sm-2 ml-4 col-form-label">Transaction Password</label>
                                    <div class="col-sm-6">
                                      <input type="text" class="form-control"  name="pass" placeholder="Enter Your Transaction Password"  required>
                                   </div>
                                  </div>
                               </div>                             
                           </div>
                      
                      
                         
                      
                                <div class="form-group row mb-0">
                                 <label for="inputPassword" class="col-sm-2 ml-4 col-form-label"></label>
                                    <div class="col-sm-6">
                                        <input type="hidden" name="" value="<?php echo $package[1]['amount'] ?>" id="hamount">
                                        <button type="submit" name="Online" value="Online" class="btn btn-primary waves-effect waves-light mr-1" id="owner-submit-btn">
                                            Pay Online
                                        </button>
                                        <button type="submit" name="Wallet" value="Wallet" class="btn btn-primary waves-effect waves-light mr-1" >
                                            Pay HOTOTT BANK
                                        </button>
                                    </div>
                                </div>
                           </div>
                           <div class="offers">
                                 <img class="off" src="<?php echo site_url('../offer199.jpeg'); ?>" height="80%" width="80%">
                           </div>
                           </div>  
                            </form>

                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->    
        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
    <script type="text/javascript">
        function myFunction(sel) {
        var selected = sel.value;
        if (selected=='2') {
 // this.$('select#myid').append('<option>newvalue</option>');
 $('#myid')
    .find('option')
    .remove()
    .end()
    .append('<option value="1">Referral PIN</option>')
    .val('1');
    var qty =$("#pin").val(3).prop('readonly', true);
    var amt = $("#hamount").val();
    var totalamt=amt*3;
    
    qty =$("#amt").val(totalamt);
       

        }
         if (selected=='1') {
           
        $('#myid')
    .find('option')
    .remove()
    .end()
    .append('<option value="1">Referral PIN</option><option value="2">Renewal PIN</option>');

    $('#pin').val('').prop('readonly', false);
    $("#amt").val('');
           
         }

    }
    </script>
<script type="text/javascript">
            $(document).ready(function(){
                $("#pin").keyup(function(){
                    var r=$(this).val();
                    var uuuid=$("#pid option:selected").val();
                    var varData = "pinno="+r+"&pid="+uuuid;
                    // alert(varData);return;
                    $.ajax({
                      type: "POST",
                      url: "<?php echo base_url('PinController/charges')?>",
                      data: varData,
                      dataType:"",
                      cache: false,
                      success: function(data){
                         // alert(data);
                         if(data=="error"){
                             $(".pidError").val("Please select package");
                         }else if(data=="error1"){
                            $(".pinError").val("Please enter pin no");
                         }else{
                            
                             $("#amt").val(data);
                         }
                        
                        }
                    });
                    
                });
            });
            </script>
   
<script>
function numericFilter(txb) {
   txb.value = txb.value.replace(/[^\0-9]/ig, "");
}
</script>

