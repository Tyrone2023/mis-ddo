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
                                        <!-- <a class="btn sm btn-success" target="_blank" href="<?= base_url(); ?>Pages/car_rqa/<?= $this->input->get('jobID'); ?>">Printable View</a> -->
                                                
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
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body table-responsive">
                                    <h4 class="header-title mb-4">Personnel List<br/></h4><br />
                                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                            <tr>
                                                <th style="text-align: center;">Last Name</th>
												<th style="text-align: center;">First Name</th>
												<th style="text-align: center;">Middle Name</th>
                                                <th style="text-align: center;">Employee No.</th>
                                                <th style="text-align: center;">Position</th>
                                                <th style="text-align: center;">Department</th>
                                                <th style="text-align: center;">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                               <?php
										  $i=1;
										  foreach($data as $row)
										  {
										  echo "<tr>";
										  echo "<td>".$row->LastName."</td>";
										  echo "<td>".$row->FirstName."</td>";
										  echo "<td>".$row->MiddleName."</td>";
										  echo "<td>".$row->IDNumber."</td>";
										  echo "<td>".$row->empPosition."</td>";
										  echo "<td>".$row->Department."</td>";
                                          ?>
                                          <td>
                                            <a href="<?= base_url(); ?>Page/printServiceRecord?id=<?= $row->IDNumber; ?>" target="_blank" class="text-success"><i class="mdi mdi-printer"></i>Preview</a>
                                          </td>
										 
										  <?php echo "</tr>";
									  
										  }
										   ?>
                                        </tbody>
                                        
                                    </table>

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

       
       
 