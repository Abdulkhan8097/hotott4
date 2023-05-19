<?php $session = session(); ?>


<div class="page-content">
    


        <div class="row align-items-center">
            <div class="col-sm-6">
                <div class="page-title-box">
                    <h4 class="font-size-20">Reports</h4>
                </div>
            </div>
        </div>



        <div class="container">
            <?php echo view('admin/report/_searchform'); ?>
            <!-- Tab panes -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <?php echo view('admin/_topmessage'); ?>
                        <div class="tab-content">
                            <div id="home" class="container tab-pane active">
                                <div class="card-body">
                                     <?php if($pagination["getNbResults"] >0 ){ ?>

                                    <div class="table-responsive">
                                        
                                            <table data-toggle="table" data-striped="true" class="table table-striped table-centered table-nowrap mb-1">
                                                <thead>
                                                    <tr>
                                                       <th  data-sortable="true">SI. No.</th>
                                                       <th  data-sortable="true">User ID</th>
                                                        <th  data-sortable="true">User Name</th>
                                                        <th  data-sortable="true" >Package Name</th>
                                                        <th  data-sortable="true">Amount</th>
                                                        <th  data-sortable="true">Date & Time</th>
                                                      
                                                        
                                                        <th scope="col" width="10%">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $i=0;
                                                    foreach ($transactionreport as $kdata) { $i++ ?>
                                                        <tr>
                                                            <td scope="row"><?php echo $i; ?></td>
                                                            <td><?php echo $kdata->username; ?></td>
                                                            <td><?php echo $kdata->name; ?></td>
                                                            <td><?php echo $kdata->package_name; ?>(<?php echo $kdata->packageamount; ?>)</td>
                                                            <td><?php echo $kdata->amount; ?></td>
                                                            <td><?php echo $kdata->created; ?></td>
                                                           
                                                            
                                                            <td> <a class="btn btn-primary waves-effect waves-light" target="_blank" href="<?php echo site_url('CustomerDetails?id=' . $kdata->id); ?>">
                                                                    <i class="ion ion-md-add-circle-outline"></i>
                                                                </a> </td>
                                                        </tr>
                                            <?php } ?>
                                                </tbody>
                                            </table>
                                            <?php if (!empty($pagination['haveToPaginate'])) { ?><br>
                                                <?php echo view('admin/_paging', array('paginate' => $pagination, 'siteurl' => $pageurl, 'varExtra' => $searchArray)); ?>
                                            <?php }
                                         ?>
                                    </div>
                                    <?php }else{ ?>
                                    <?php echo view('admin/_noresult',array('noResult'=>array("description"=>"Please change search criteria and submit again"))); ?>
                                <?php } ?>
                                </div>
                            </div>						
                           
                            

                        </div>
                    </div>
                </div>
            </div> 
        </div> 


</div>
