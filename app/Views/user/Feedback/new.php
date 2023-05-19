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
                                <h4 class="card-title">Add New Feedback</h4>     
                            </div>
                        </div>
                        <hr>

                        <form class="custom-validation"  method='post' action="FeedbackController/saveNewFeedback" enctype='multipart/form-data'>

                            <div class="for-mobile-laptop">                      

                                <div class="row mt-4">
                                    <div class="col-md-10">
                                        <div class="form-group row">
                                            <label for="inputPassword" class="col-sm-2 ml-4 col-form-label">Full name<span class="mandatory">*</span></label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" placeholder="Enter Full name" name="full_name" required/>
                                            </div> 
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-4">
                                    <div class="col-md-10">
                                        <div class="form-group row">
                                            <label for="inputPassword" class="col-sm-2 ml-4 col-form-label">Feedback Title<span class="mandatory">*</span></label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" placeholder="Enter Feedback title" name="feedback_title" id="feedback_title" required/>
                                            </div> 
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-4">
                                    <div class="col-md-10">
                                        <div class="form-group row">
                                            <label for="inputPassword" class="col-sm-2 ml-4 col-form-label">Feedback<span class="mandatory">*</span></label>
                                            <div class="col-sm-6">
                                                <textarea class="form-control" id="feedback" name="feedback"></textarea>
                                            </div> 
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row mb-0"><label for="inputPassword" class="col-sm-2 col-form-label"></label>
                                    <div class="col-sm-6">
                                        <button type="submit" class="btn btn-primary waves-effect waves-light mr-1" id="owner-submit-btn">
                                            Add
                                        </button>
                                        <a class="btn btn-secondary waves-effect waves-light" href="<?php echo site_url('Customers'); ?>">
                                            <i class="ion ion ion-md-arrow-back"></i> Back
                                        </a>
                                    </div>
                                </div> 
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>        