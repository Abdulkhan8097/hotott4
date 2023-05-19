
<style type="text/css">
  .modal-header .close {
  
    margin: 0rem 0rem 0rem 0rem;
}
</style>
   <script src="<?php echo base_url('/js/jquery.min.js'); ?>"></script>
    <script src="<?php echo base_url('/js/popper.min.js'); ?>"></script>
    <script src="<?php echo base_url('/js/bootstrap.min.js'); ?>"></script>
<?php 
$session = session();
$user_id = $session->get('username');
$name = $session->get('name');



 ?>
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                             <?php echo view('admin/_topmessage'); ?>
                             
                          <div class="row">
                            <div class="col-lg-3"> 
                               <h4 class="card-title">ADD MEMBER FOR JOIN US</h4>     
                          </div>                        
                    </div>
                  <hr>
                 <form class="custom-validation"  method='post' action="<?php echo site_url('CustomerController/newUserSave'); ?>" >                              
                              <div class="for-mobile-laptop">
                                 <div class="row">
                                <div class="col-md-10">
                                  <div class="form-group row">
                                    <label for="inputPassword" class="col-sm-2 ml-4 col-form-label">Sponsor ID :<span class="mandatory">*</span></label>
                                    <div class="col-sm-6">
                                     <input type="text" class="form-control" placeholder="Enter Sponsor ID" value="<?php echo (isset($user_id) && !empty($user_id)) ? $user_id: ''; ?>" name="sponsor_id" id="sponsor_id" onchange="getname();" />
                                   </div>
                                  </div>
                               </div>                             
                           </div>

                             <div class="row">
                                <div class="col-md-10">
                                  <div class="form-group row">
                                    <label for="inputPassword" class="col-sm-2 ml-4 col-form-label">Name<span class="mandatory">*</span></label>
                                    <div class="col-sm-6">
                                     <input type="text" class="form-control"  value="<?php echo (isset($name) && !empty($name)) ? $name: ''; ?>"  id="sponsor_name" name="sponsor_name" placeholder="Sponsor Name" readonly />
                                   </div>
                                  </div>
                               </div>                             
                           </div>
                        
                    
                              
                              <div class="row">
                                <div class="col-md-10">
                                  <div class="form-group row">
                                    <label for="inputPassword" class="col-sm-2 ml-4 col-form-label">Full Name<span class="mandatory">*</span></label>
                                    <div class="col-sm-6">
                                     <input type="text" class="form-control" placeholder="Enter Full Name" name="name" required value="<?php echo (isset($edit) && !empty($edit)) ? $edit->name : ''; ?>"/>
                                   </div>
                                  </div>
                               </div>                             
                           </div>
                            <div class="row">
                                <div class="col-md-10">
                                  <div class="form-group row">
                                   <label for="inputPassword" class="col-sm-2 ml-4 col-form-label">Position<span class="mandatory">*</span></label>
                                    <div class="col-sm-6">
                                      <?php if ($edit){?>
                                        <select class="form-control" name="side" required disabled>
                                      <?php }else{ ?>
                                     <select class="form-control" name="side" required>
                                     <?php } ?>
                                        <option value="">- Please Select -</option>
                                        <?php if($position) { 
                                          foreach ($position as $position) { ?>
                                        <option value="<?php echo $position; ?>" <?php echo (isset($edit) && !empty($edit) && $edit->side==$position) ? 'selected' : ''; ?>> <?php echo $position; ?> </option>
                                        <?php } } ?>
                                  </select>
                                    </div>
                                 </div> 
                                </div>
                              </div>

                                <div class="row">
                                <div class="col-md-10">
                                  <div class="form-group row">
                                    <label for="inputPassword" class="col-sm-2 ml-4 col-form-label">Add PIN :<span class="mandatory">*</span></label>
                                    <div class="col-sm-6">

                                       <select class="form-control" name="pin" required>
                                    
                                        <option value="">- Please Select -</option>
                                        <?php if($pindata) { 
                                          foreach ($pindata as $value) { ?>
                                        <option value="<?php echo $value['id']; ?>">
                                         <?php echo $value['pin']; ?> </option>
                                        <?php }}  ?>
                                  </select>
                                    <!--  <input type="text" class="form-control" placeholder="Enter PIN" name="pin" required value="<?php //echo (isset($edit) && !empty($edit)) ? $edit->pin : ''; ?>" /> -->
                                   </div>
                                  </div>
                               </div>                             
                           </div>
             


                            <div class="row">
                               <div class="col-md-10">
                                  <div class="form-group row">                                               
                                    <label for="inputPassword" class="col-sm-2 ml-4 col-form-label">E-Mail<span class="mandatory">*</span></label>
                                     <div class="col-sm-6">
                                        <input type="email" class="form-control" 
                                                parsley-type="email" placeholder="Enter a valid e-mail" name="email" id="useremail" required value="<?php echo (isset($edit) && !empty($edit)) ? $edit->email : ''; ?>" required/>
                                    </div>
                                    <div class="text-danger" id="email-exist-error-msg">
                                    </div>
                                </div> 
                              </div>
                            </div>

                              <div class="row">
                              <div class="col-md-10">
                                  <div class="form-group row">
                                    <label for="inputPassword" class="col-sm-2 ml-4 col-form-label">Mobile Number<span class="mandatory">*</span></label>
                                    <div class="col-sm-6">
                                        <input data-parsley-type="digits" type="text"
                                                class="form-control" required
                                                placeholder="Enter only digits" maxlength="10" name="mobile" value="<?php echo (isset($edit) && !empty($edit)) ? $edit->mobile : ''; ?>"/>
                                    </div>
                                </div> 
                              </div>
                            </div>

                              <div class="row">
                                <div class="col-md-10">
                                  <div class="form-group row">
                                   <label for="inputPassword" class="col-sm-2 ml-4 col-form-label">Gender</label>
                                    <div class="col-sm-6">
                                     <select class="form-control" name="gender" >
                                        <option value="">- Please Select -</option>
                                        <?php if($genderarb) { foreach ($genderarb as $gender) { ?>
                                        <option value="<?php echo $gender; ?>" <?php echo (isset($edit) && !empty($edit) && $edit->gender==$gender) ? 'selected' : ''; ?>> <?php echo $gender; ?> </option>
                                        <?php } } ?>
                                  </select>
                                    </div>
                                 </div> 
                                </div>
                              </div>

                            <div class="row">
                              <div class="col-md-10">
                                  <div class="form-group row">
                                   <label for="inputPassword" class="col-sm-2 ml-4 col-form-label">Date Of Birth</label>
                                    <div class="col-sm-6">
                                         <input type="date" class="form-control" name="date_of_birth" value="<?php echo (isset($edit) && !empty($edit)) ? $edit->date_of_birth : ''; ?>"/> <span>
                                    </div>
                                 </div> 
                                </div> 
                              </div>
                             <h4> Nomine Details</h4>

                               <div class="row">
                                <div class="col-md-10">
                                  <div class="form-group row">
                                    <label for="inputPassword" class="col-sm-2 ml-4 col-form-label">Nomine Full Name</label>
                                    <div class="col-sm-6">
                                     <input type="text" class="form-control" placeholder="Enter Full Name" name="nomine_name" value="<?php echo (isset($edit) && !empty($edit)) ? $edit->nomine_name : ''; ?>"/>
                                   </div>
                                  </div>
                               </div>                             
                           </div>
                            <div class="row">
                                <div class="col-md-10">
                                  <div class="form-group row">
                                    <label for="inputPassword" class="col-sm-2 ml-4 col-form-label">Nomine Relation</label>
                                    <div class="col-sm-6">
                                     <input type="text" class="form-control" placeholder="Enter Nomine Relation" name="nomine_relation" value="<?php echo (isset($edit) && !empty($edit)) ? $edit->nomine_relation : ''; ?>"/>
                                   </div>
                                  </div>
                               </div>                             
                           </div>

                          <h4> Address</h4>

                            <div class="row">
                                <div class="col-md-10">
                                  <div class="form-group row">
                                    <label for="inputPassword" class="col-sm-2 ml-4 col-form-label">Address 1:</label>
                                    <div class="col-sm-6">
                                     <input type="text" class="form-control" placeholder="Enter Address 1" name="address_line1" value="<?php echo (isset($edit) && !empty($edit)) ? $edit->address_line1 : ''; ?>"/>
                                   </div>
                                  </div>
                               </div>                             
                           </div>
                            <div class="row">
                                <div class="col-md-10">
                                  <div class="form-group row">
                                    <label for="inputPassword" class="col-sm-2 ml-4 col-form-label">Address 2 :</label>
                                    <div class="col-sm-6">
                                     <input type="text" class="form-control" placeholder="Enter Address 2" name="address_line2" value="<?php echo (isset($edit) && !empty($edit)) ? $edit->address_line2 : ''; ?>"/>
                                   </div>
                                  </div>
                               </div>                             
                           </div>
                            <div class="row">
                                <div class="col-md-10">
                                  <div class="form-group row">
                                    <label for="inputPassword" class="col-sm-2 ml-4 col-form-label">Country</label>
                                    <div class="col-sm-6">
                                      <select name="country" id="country" class="form-control">
                                        <option value="">--Select Country--</option>
                              
                                  
   <?php if(isset($country) && !empty($country)){
                              foreach ($country as $key => $value) {
                                  ?>
                           <option value="<?php echo $value['id']; ?>"<?php echo (isset($edit) && !empty($edit) && $edit->country==$value['id']) ? 'selected' : ''; ?> >
                              <?php echo $value['name']; ?>
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
                                    <label for="inputPassword" class="col-sm-2 ml-4 col-form-label">State</label>
                                    <div class="col-sm-6">
                                    <select name="state" id="state" class="form-control"> 
                              <option value="">--Select State--</option>
                               <?php if(isset($edit) && !empty($edit)){?>
                            
                           <option value="<?php echo $edit->state; ?>"<?php echo (isset($edit) && !empty($edit) && $edit->state==$edit->state) ? 'selected' : ''; ?> >
                              <?php echo $edit->statename; ?>
                           </option>
                           <?php 
                              } ?>  
                            </select>
                                   </div>
                                  </div>
                               </div>                             
                           </div>
                             <div class="row">
                                <div class="col-md-10">
                                  <div class="form-group row">
                                    <label for="inputPassword" class="col-sm-2 ml-4 col-form-label">City</label>
                                    <div class="col-sm-6">
                                     <select name="city" id="city" class="form-control "> 
                              <option value="">--Select City--</option>
                               <?php if(isset($edit) && !empty($edit)){?>
                            
                           <option value="<?php echo $edit->city; ?>"<?php echo (isset($edit) && !empty($edit) && $edit->city==$edit->city) ? 'selected' : ''; ?> >
                              <?php echo $edit->cityname; ?>
                           </option>
                           <?php 
                              } ?>  
                            </select>
                                   </div>
                                  </div>
                               </div>                             
                           </div>
                           <div class="row">
                                <div class="col-md-10">
                                  <div class="form-group row">
                                    <label for="" class="col-sm-2 ml-4 col-form-label">Pin Code</label>
                                    <div class="col-sm-6">
                                     <input type="text" class="form-control" id="zip_code" name="zip_code" placeholder="Zip Code" value="<?php echo (isset($edit) && !empty($edit)) ? $edit->zip_code : ''; ?>">
                                   </div>
                                  </div>
                               </div>                             
                           </div>
                           <h4>Account Details</h4>
                               <div class="row">
                                <div class="col-md-10">
                                  <div class="form-group row">
                                    <label for="" class="col-sm-2 ml-4 col-form-label">Bank Name</label>
                                    <div class="col-sm-6">
                                     <input type="text" class="form-control" name="bank_name" placeholder="Bank Name" value="<?php echo (isset($edit) && !empty($edit)) ? $edit->bank_name : ''; ?>">
                                   </div>
                                  </div>
                               </div>                             
                           </div>
                            <div class="row">
                                <div class="col-md-10">
                                  <div class="form-group row">
                                    <label for="" class="col-sm-2 ml-4 col-form-label">Branch Name</label>
                                    <div class="col-sm-6">
                                     <input type="text" class="form-control" name="bank_country" placeholder="Branch Name" value="<?php echo (isset($edit) && !empty($edit)) ? $edit->bank_country : ''; ?>">
                                   </div>
                                  </div>
                               </div>                             
                           </div>
                               <div class="row">
                                <div class="col-md-10">
                                  <div class="form-group row">
                                    <label for="" class="col-sm-2 ml-4 col-form-label">Account Holder Name</label>
                                    <div class="col-sm-6">
                                     <input type="text" class="form-control" name="acc_holder_name" placeholder="Account Holder Name" value="<?php echo (isset($edit) && !empty($edit)) ? $edit->acc_holder_name : ''; ?>">
                                   </div>
                                  </div>
                               </div>                             
                           </div>
                            <div class="row">
                                <div class="col-md-10">
                                  <div class="form-group row">
                                    <label for="" class="col-sm-2 ml-4 col-form-label">Account Number</label>
                                    <div class="col-sm-6">
                                     <input  class="form-control" type="text" name="account_no" placeholder="Account Number" value="<?php echo (isset($edit) && !empty($edit)) ? $edit->account_no : ''; ?>">
                                   </div>
                                  </div>
                               </div>                             
                           </div>
                                <div class="row">
                                <div class="col-md-10">
                                  <div class="form-group row">
                                    <label for="" class="col-sm-2 ml-4 col-form-label">IFSC Code</label>
                                    <div class="col-sm-6">
                                     <input  class="form-control" type="text" name="ifsc_code" placeholder="IFSC Code" value="<?php echo (isset($edit) && !empty($edit)) ? $edit->ifsc_code : ''; ?>">
                                   </div>
                                  </div>
                               </div>                             
                           </div>

                            <div class="row">
                                <div class="col-md-10">
                                  <div class="form-group row">
                                    <label for="" class="col-sm-2 ml-4 col-form-label"></label>
                                    <div class="col-sm-6">
                                    <input type="checkbox" name="terms" value="1" checked required>&nbsp;&nbsp;I accept the Terms & Conditions and Privacy Policy. <a href="" data-toggle="modal" data-target="#myModal">Click Here</a>
                                  </div>
                               </div>                             
                           </div>
                         </div>
                                <div class="form-group row mb-0">
                                 <label for="inputPassword" class="col-sm-2 ml-4 col-form-label"></label>

                                 
                                    <div class="col-sm-6">
                                      <input type="hidden" name="id" value="<?php echo (isset($edit) && !empty($edit)) ? $edit->id : ''; ?>">
                                        <button type="submit" class="btn btn-primary waves-effect waves-light mr-1" id="owner-submit-btn">
                                            Submit
                                        </button>
                                        <a onclick="history.back()"class="btn btn-secondary waves-effect waves-light" href="javascript:void(0)">
                                            <i class="ion ion ion-md-arrow-back"></i>Back
                                        </a>
                                    </div>
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

        <!-- The Modal -->
              <div class="modal" id="myModal">
                <div class="modal-dialog">
                  <div class="modal-content" style="width:800px;">
                  
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title">Terms & Conditions</h4>
                      
                    </div>
                    
                    <!-- Modal body -->
                    <div class="modal-body">
                        
                           <p style="font-size:14px;">
                                TERMS AND CONDITIONS FOR DIRECT SELLER
These terms and conditions are construed in accordance with of model guidelines on direct selling issued by the
Govt. of India, Ministry of Consumer Affairs, Food & Public Distribution, Department of Consumer Affairs vide F.No.
21/18/2014-IT (Vol-II) dated 9th Sept., 2016 and supersedes any prior terms and conditions, discussions or
agreements between Company and direct seller. The applicant intending to become direct seller shall go through
these terms and conditions and if he/she agrees and accept these, he/she shall sign a agreement. Choosing the
sponsoring and consent to join the group is exclusive decision of applicant. There is no role or any suggestion of the
company in taking such decision by the applicant. Further there is no any charge for becoming a direct seller of the
company. The company exclusively uses its website to display the details of the products, marketing method/plan,
sales incentives and business monitoring etc. DEFINITIONS As used herein, the following terms shall have the
meanings set forth below: I. “Net Work of Direct Selling” shall means any system of distribution or marketing adopted
by direct selling entity to undertake direct selling business and shall include the multi level marketing method of
distribution of goods and services. II. “Direct selling entity” means an entity which sells or offers to sell goods or
services through a direct seller. The company M/s INSTANT ALL WIN SUCCESS PVT LTD is the direct selling entity.
In case “ALL WIN ” word is used at company’s website, in any publication, literature, marketing plan etc. of the
company then meaning of “ALL WIN” word shall be interpreted as M/s INSTANT ALL WIN SUCCESS PVT LTD. III.
“Direct seller” means a person (Individual Indian Citizen only) appointed or authorized, directly or indirectly, by a
direct selling entity to undertake direct selling business on principal to principal basis. IV. “Direct selling” means
marketing, distribution and sale of goods or providing of services as a part of network of direct selling. V. “Unique ID"
Means unique identification number issued by the company to the direct seller as token of acceptance of his/her
application for direct selling of the goods/service of the company. No communication will be entertained without
unique ID and password. Direct Seller shall preserve the Unique ID and Password properly as it is “must” for logging
on to website. VI. “Cooling-Off Period” The duration of time counted from the date when the direct seller and the
direct selling entity enter into an agreement and ending with the date on which the contract is to be performed and
within which direct seller may repudiate the agreement without being subject to penalty for breach of contract. VII.
"Website” means the official website of the company i.e. www.allwinsure.com or any other website, which the
company may notify time to time. THE APPOINTMENT AND UNDERSTANDING 1. The Company upon scrutiny and
verification of the Application may register the Applicant as “Direct Seller” for selling the goods/ products of the
Company. The Company shall be at liberty to accept or reject the application at its discretion without assigning any
reason whatsoever. Allotment of password and Unique ID by the company shall be construed as the registration of
direct seller. The applicant hereby covenants as under: a. That he has clearly understood the marketing
methods/plan, the incentive plan, its limitations and terms & conditions. He/she agrees that he/she is not relying upon
any misrepresentation/s or fraudulent inducement or assurance or commitment that is not set out in the terms and
conditions/marketing plan/incentive plan or any other officially printed or published materials of the Company. b.
Relation between the Company and the Direct Seller shall be governed, in addition to these terms & conditions, by
the rules and procedure mentioned in the marketing plan, available on website or provided by the company in any
manner. The Direct Seller further confirms that he/she has read and understood the terms & conditions carefully and
agrees to be bound by them. c. Direct Seller is an independent contractor, and nothing contained in these terms &
conditions shall be construed to (i) Give any party the power to direct and control the day-to-day activities of the
other. (ii) Constitute the parties as partners, joint ventures, co-owners or otherwise, or (iii) Allow Direct Seller to create
or assume any obligation on behalf of Company for any purpose whatsoever. d. Direct Seller is not an employee of
Company and shall not be entitled to any employee’s benefits. Direct Seller shall be responsible for paying all taxes
whether direct or indirect including but not limited to Income Tax, VAT, Service tax and other taxes chargeable to
Direct Seller on amounts earned hereunder. All Legal, Statutory, financial and other obligations associated with Direct
Seller’s business shall be the sole responsibility of Direct Seller. e. It is made and understood in very clear terms that
Direct Seller is not an Agent, Employee nor an authorized representative of the Company or its service providers. He
is not authorized to receive/accept any amount/payment for and behalf of the Company and any payment received by
him/her from any party shall not be deemed to be received by the Company. f. Direct Seller, hereby declare that all
the information furnished by him/her are true and correct. Company shall be at liberty to take any action against the
Direct Seller in case it is discovered at any stage that the Direct Seller has furnished any wrong/false/misleading
information to the Company or other direct sellers. g. If any relative as defined under the provisions of Income Tax
Act, 1961 or defined under the provisions of Companies Act, 2013 of existing direct seller desire to become direct
seller then he/she shall disclose the relationship with existing direct seller to the company. It is company’s sole
discretion to accept or reject the application of such relative. 2. The Direct Seller shall enjoy the following privileges:-
i. Incentive for effecting sale of goods /products of the Company as per marketing plan. ii. No territorial restriction to
sale the goods/products in India. iii. Search and inspect his/her account on website of the Company through the
Unique ID and password awarded by the Company. iv. Incentive of the Direct Seller shall be in proportion to the
volume of performance by the Direct Seller either by his personal efforts or through team as stipulated in the
marketing plan of the Company. v. The direct seller shall be entitled to a cooling off period of 45 days from the date of
acceptance of this terms & conditions without any punishable clause. vi. The Direct seller shall have the option to
return the currently marketable goods purchased by him/her within 30 days from the date of the purchase. Such
return shall be governed by the return policy published on the website of the company. OTHER GENERAL TERMS
AND CONDITIONS I. Application of Direct Seller. 1) The applicant should have completed minimum 18 years of age
and shall be competent to enter into contract as provided in the 'Indian Contract Act'. 2) Any partner, proprietor or
limited company when applying for Direct Seller shall be registered under a duly appointed representative. 3) The
applicant must personally and completely fill up and sign the prescribed Application form clearly and legibly in BLOCK
letters to signify his/her acceptance of all the terms of the rules and regulations of the company. 4) Multiple Direct
Seller is not allowed in the same name. 5) The Company has not authorized any Direct Seller of the company to
receive any amount either in cash or by cheque/demand draft on behalf of the company towards Direct Seller fee or
purchase of products. All such purchases should take place only in the company approved stockiest or in the
Company branches. 6) The Direct Seller will be eligible for incentives or commission only as per the volume of
business done by him/her as stipulated in the business plan. The company does not assure any incentive or income
to the Direct Seller on merely account of his/her joining in the company. 7) The company always reserves the right to
reject any Direct Seller/ Direct Seller application at its own discretion. 8) The Company reserves all rights to terminate
a Direct Seller. Once a Direct Seller is terminated, he/she cannot enter any of the company premises/meeting
locations and his/her incentives / commission will be stopped immediately. 9) The Direct Seller / applicant shall
ensure that all the information furnished in the Direct Seller application form is correct and properly entered. Any
request for correction of information after registration of the Direct Seller with the company will not be strictly
entertained. 10) The company will not be answerable for any promise, assurance given with by any Direct Seller to
any person, unless it is in accordance with the approved business plans and terms of the company. Hence, the
applicant should go through the company website: www.allwinsure.com or business brochures and notices issued by
the company before entering into Direct Seller. II. Direct Seller Duties & Responsibilities: 1) A Direct Seller is an
independent business entity. Hence, he/she is not an Employee, agent or representative of the company. 2) A Direct
Seller shall not use company name, logo, slogan, trademarks, and trade names without the company's consent. 3)
Direct Seller shall not engage or participate in any other networking or directselling companies. If found, such Direct
Seller (Direct Seller) will be terminated with immediate effect, without notice. 4) No Direct Seller or leader shall
conduct unauthorized seminars, meetings or assembly that is not in line with the business ethics of the company. Any
leader or Direct Seller found to have been engaged in discriminating or including others to complain against the
company's procedures, rules and regulations will be terminated with immediate effect without notice. III. Transfer of
Direct Seller: 1) Application for change of sponsor or for the transfer of personal/group sales is prohibited. 2)
Application for change of Name can be entertained provided the applicant shall abide the following Name Transfer
Clause: 3) The Direct Seller's name is not transferrable under any circumstances. IV. Termination of Direct Seller: All
Direct Seller's, stockiest should abide by the Rules & Regulations and Code of Ethics of the Company & if anyone is
found guilty of not observing the same, then he/she will be terminated from the company with immediate effect. V.
Death & Inheritance: The legal heir/s shall submit a certified copy of legal heir certificate to the company stating their
request to replace the deceased Direct Seller (Direct Seller). The Company has the right to approve/disapprove the
request upon proper evaluation. 5 VI. Prohibited business practices: 1) Under-cutting: Selling the company products

in the market at a discounted price below the prescribed price rate is strictly prohibited. 2) Cross Sponsoring: Re-
registration under other sponsor/up line in the same name or in name of blood relation (Wife, Children, Father,

Mother, and Brother) is strictly prohibited. 3) Pirating: Convincing, enticing or inviting co-Direct Seller to join other
MLM/direct selling company is strictly prohibited. 4) Dummies/False Representative(s): Registration of dummies or
false representative(s) is strictly prohibited. The Company reserves the right to terminate such Direct Seller found
guilty for committing above such prohibited business practices with immediate effect without any notice. The
company reserves the right to suspend/cancel any commission or incentive(s) generated through the use of
dummies/false representative(s). VII. Commission (Incentives) & Payout: 1) Commission (Incentives) are based on
the performance of the Direct Seller as per the compensation plan. 2) If the Direct Seller could not provide complete
and correct bank details, the accrued commissions (incentive) will not be transferred and it will be on hold with the
company. Any such commissions held by the company for more than Three months will be forfeited automatically. No
Direct Seller can claim after such forfeiture. 3) Commission statements are system generated & it can be downloaded
or printed from the Direct Seller login of the company website. 4) The company always reserves the right to hold and
cancel the Direct Seller /stockiest/ commission (incentives) against any receivable from such Direct Seller/stockiest/
to the company. VIII. Legal & Taxations: 1) The rules & regulations mentioned above shall be governed in
accordance with the Law in force in the territories of India. Disputes, if any arise, shall be subject to the exclusive
jurisdiction of the Court of Mumbai. 2) If any dispute or difference arises between the parties regarding business or
interpretation of any terms and conditions or incentives, Income etc. relating to the business of the company, the
same shall be referred to arbitration and the arbitration shall be governed by the 'Arbitration and Conciliation Act,
1996'. 3) The company reserves the right to modify/change the business plan without prior notice. Its effect will reflect
on website: www.allinoneindia.in / and it will be binding on all the Direct Sellers of the company. 4) TDS will be
deducted as per the Income Tax Act. All Direct Seller's should update their PAN details with application / website. If
any Direct Seller has not given such details, the company will not be responsible for such TDS beyond one calendar
year please note. 5) Know Your Customer ((KYC) form is mandatory for all Direct sellers. IX. CODE OF EHTICS: As
a Direct Seller of INSTANT ALL WIN SUCCESS PVT LTD he/she shall agree to conduct company business
according to the following ethical guidelines: 1) He/she shall endeavour to be professional in dealing with co-Direct
Sellers. 2) He/she shall respect and follow the Code of Ethics and Rules & Regulations, observing it as a guide to the
business. 3) He/she shall present the company product and business to all the clients, contacts and prospective
Direct Seller's with honesty and integrity by using only approved company publications and presentations. 4) He/she
shall conduct business activities in a manner that will reflect the highest standard of integrity, frankness and
responsibility. 5) He/she shall accept and carry out the responsibility as a company Direct Seller & maintain ethical
business practice. 6) He/she shall take responsibility to teach and to help their groups by teaching the principles and
guidelines of the company code of ethics, rules & regulations, product presentation, and compensation plan as a tool
to start their way to success. 7) He/she shall take initiative to motivate their groups to take necessary Trainings and
seminars to help them realize their potential business as their own. X. DECLARATION: I, the undersigned, hereby
confirm that I have completed 18 yrs of my age. I agree to adhere to and abide by the conditions mentioned
hereunder. I shall become as a Direct Seller, on Purchase of various products which will make me eligible for a
relation as Direct Seller with the Company. My Direct Seller relation cannot be transferred sold, assigned to any
person without the prior written consent of the company. I am responsible to pay all my applicable taxes from time to
time and the Company will not be held liable for the same. I have no objection and I agree to the Company deducting
tax at source from my weekly/monthly actual cheque as per rates prescribed under the Income Tax Act 1961 or pay
the same as prescribed under any other law for the time being in force or any modification thereof. I solemnly confirm
that the information set forth is accurate to the best of my knowledge and belief and have read, understood and
hereby agree to the terms and conditions given in the reverse side of this form and those prevalent/updated on the
company's website, a copy of which has been made available to me by my sponsor. I also confirm and agree to abide
by such terms and conditions modified or amended by the said company from time to time. IN WITNESS WHEREOF
THIS AGREEMENT IS SIGNED BY THE PARTIES HERETO THE DAY, MONTH AND YEAR FIRST ABOVE WRITTEN.
                           
                           </p>


                      
                    </div>
                    
                    <!-- Modal footer -->
                    <div class="modal-footer">
                      <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                       </div>
                </div>
              </div>
         
        </div>

<script>

  
    $(function() {
      $('#password').password()
      .password('focus')
      .on('show.bs.password', function(e) {
        $('#eventLog').text('On show event');
        $('#methods').prop('checked', true);
      }).on('hide.bs.password', function(e) {
        $('#eventLog').text('On hide event');
        $('#methods').prop('checked', false);
      });
      $('#methods').click(function() {
        $('#password').password('toggle');
      });
    });
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
        url: "<?php echo base_url();?>/index.php/CustomerController/ajax_state",
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
        url: "<?php echo base_url();?>/index.php/CustomerController/ajax_city",
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

<script type="text/javascript">
function getname()
{
  
    var iname=$("#sponsor_id").val();
  //alert(iname);
    $.ajax({
      type:"post",  
        data: { sponsor_id:iname },
      url:"<?php echo base_url();?>/index.php/CustomerController/ajax_sponsor", 
      success:function(response)
      {
     //alert(response);
    
      document.getElementById('sponsor_name').value=response;   
    
      },
  });

}
function getPlaceUnderName()
{
  var iname=$("#place_under_id").val();
  //alert(iname);
    $.ajax({
      type:"post",  
        data: { sponsor_id:iname },
      url:"<?php echo base_url();?>register/ajax_sponsor", 
      success:function(response)
      {
     //alert(response);
    
      document.getElementById('place_under_name').value=response;   
    
      },
  });
}

</script> 
   <script type="text/javascript">
    $(document).ready(function() {
  
    
    $("#sponsor_id").select2();
      $("#place_under_id").select2();
    $("#position").select2();
    $("#city").select2();
    $("#state").select2();
    $("#country").select2();

  
    });
    </script> 
     <!-- end js include path -->

<script>
function numericFilter(txb) {
   txb.value = txb.value.replace(/[^\0-9]/ig, "");
}
</script>

