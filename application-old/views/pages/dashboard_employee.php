

            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-page">
                <div class="content">


                    <!-- Start Content-->
                    <div class="container-fluid">
                        <!-- <br />
                    <img src="<?=base_url(); ?>assets/images/dashboard.jpg" width="100%"> -->
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <h4 class="page-title"></h4>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
                       

                        <div class="row">
                            <div class="col-xl-3 col-sm-6">
                                <div class="card bg-success">
                                        <div class="card-body widget-style-2">
                                            <div class="text-white media">
                                                <div class="media-body align-self-center">
                                                    <a href="<?=base_url(); ?>Page/trainingNeeds"><h2 class="my-0 text-white"><span data-plugin="counterup"><?= $data1->num_rows(); ?></span></h2></a>
                                                    <p class="mb-0 text-white">Training Needs</p>
                                                </div>
                                                <i class="ion ion-ios-checkbox-outline"></i>
                                            </div>
                                        </div>
                                    </div>
                            </div>

                            <div class="col-xl-3 col-sm-6">
                                <div class="card bg-purple">
                                    <div class="card-body widget-style-2">
                                        <div class="text-white media">
                                            <div class="media-body align-self-center">
                                            <a href="<?=base_url(); ?>Page/individualDevelopment"><h2 class="my-0 text-white"><span data-plugin="counterup"><?= $data2->num_rows(); ?></span></h2></a>
                                                <p class="mb-0">Development Plans</p>
                                            </div>
                                            <i class="ion ion-ios-filing"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-3 col-sm-6">
                                <div class="card bg-info">
                                    <div class="card-body widget-style-2">
                                        <div class="text-white media">
                                            <div class="media-body align-self-center">
                                                <h2 class="my-0 text-white"><span data-plugin="counterup"><?php if(!$data3) { echo "0"; } else{ echo $data3[0]->vlTotal; } ?></span></h2>
                                                <p class="mb-0">Vacation Leave</p>
                                            </div>
                                            <i class="ion ion-md-folder "></i>
                                        </div>
                                    </div>
                                </div>
                            </div> 

                            <div class="col-xl-3 col-sm-6">
                                <div class="card bg-primary">
                                    <div class="card-body widget-style-2">
                                        <div class="text-white media">
                                            <div class="media-body align-self-center">
                                                <h2 class="my-0 text-white"><a href="#" class="text-white"><span data-plugin="counterup"><?php if(!$data3) { echo "0"; } else{ echo $data3[0]->slTotal; } ?></span></a></h2>
                                                <p class="mb-0">Sick Leave</p>
                                            </div>
                                            <i class="ion ion-md-folder-open "></i>
                                        </div>
                                    </div>
                                </div>
                            </div> 
                        </div>
                        <!-- End row -->

                        
                    

                </div>
                <!-- end content -->

                

                