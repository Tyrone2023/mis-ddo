            <?php include('templates/head.php'); ?> 
            <link href="<?= base_url(); ?>assets/libs/custombox/custombox.min.css" rel="stylesheet" type="text/css">
            <?php include('templates/header.php'); ?>          

            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-page">
                <div class="content">

                    <!-- Start Content-->
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                      
                                                
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <?php if($this->session->flashdata('success')) : ?>

                            <?= '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>'
                                    .$this->session->flashdata('success'). 
                                '</div>'; 
                            ?>
                            <?php endif; ?>

                            <?php if($this->session->flashdata('danger')) : ?>
                            <?= '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>'
                                    .$this->session->flashdata('danger'). 
                                '</div>'; 
                            ?>
                            <?php endif;  ?>

                        
                            <div class="row">
							 <div class="col-md-12">
                            
                             
                             <div class="card">
                                <div class="card-header bg-purple  py-3 text-white">
                                        <div class="card-widgets">
                                            <!-- <a href="javascript:;" data-toggle="reload"><i class="mdi mdi-refresh"></i></a> -->
                                            <!-- <a data-toggle="collapse" href="#cardCollpase1" role="button" aria-expanded="false" aria-controls="cardCollpase1"><i class="mdi mdi-minus"></i></a> -->
                                            <!-- <a href="#" data-toggle="remove"><i class="mdi mdi-close"></i></a> -->
                                        </div>
                                        <h5 class="card-title mb-0 text-white">MANDATORY MONTHLY DEDUCTIONS</h5>
                                       
										<!-- <span class="badge badge-primary mb-3">EMPLOYEE STATUS HERE</span> -->
                                    </div>


						<div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body table-responsive">
                                        <!-- <h4 class="m-t-0 header-title mb-4"><?php echo $_GET['payGroup']. ' - '.$_GET['payMonth']. ', '.$_GET['payYear']; ?></h4> -->
										
										<table class="table table-striped table-bordered dt-responsive nowrap">
										<thead>
                                            <tr>
                                              <td>GSIS</td>
                                              <td><?php echo number_format($data[0]->dedGSIS,2); ?></td>
											</tr>
                                            <tr>
                                              <td>PhilHealth</td>
                                              <td><?php echo number_format($data[0]->dedPHealth,2); ?></td>
											</tr>
                                            <tr>
                                              <td>Pagibig</td>
                                              <td><?php echo number_format($data[0]->dedPagibig,2); ?></td>
											</tr>
                                            <tr>
                                              <td>Tax</td>
                                              <td><?php echo number_format($data[0]->dedTax,2); ?></td>
											</tr>
                                        </thead>

                                    </table>

						</div>
						</div>
						</div>
						</div>

                        <!--- end row -->   
                            





                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->

                    </div>
                    <!-- end container-fluid -->

                </div>
                <!-- end content -->

                <?php include('templates/footer.php'); ?>  

 