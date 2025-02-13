<?php include('templates/head.php'); ?>
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
                                    <!-- <h4 class="page-title">Sections</h4> -->
                                    <!-- <a href="#" class="btn btn-info"> + Add New Section</a> -->
                                    <button type="button" class="btn btn-info waves-effect waves-light" data-toggle="modal" data-target=".bs-example-modal-lg">+ Add New Section</button>
                                    <!-- <a target="_blank" href="sec_filter/1/1" class="btn btn-primary">Quarterly Report</a>
                                    <a target="_blank" href="sec_filter/2/1" class="btn btn-secondary">Weekly Report</a> -->

                                    <a target="_blank" href="sec_filterv2/1/1" class="btn btn-success">Quarterly Report</a>
                                    <a target="_blank" href="sec_filterv2/2/1" class="btn btn-primary">Weekly Report</a>
                                    <a target="_blank" href="sfy/1" class="btn btn-success">Yearly Report</a>
                                    <button type="button" class="btn btn-warning waves-effect waves-light" data-toggle="modal" data-target=".sc">Submission Checking</button>

                                    

                                    <div class="page-title-right">
                                        <ol class="breadcrumb p-0 m-0">
                                            <!-- <li class="breadcrumb-item">SGOD Management System v1.0</li> -->
                                        </ol>
                                    </div>
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
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="header-title mb-4">
                                            Accomplishment Submission Summary<br />
                                            <span class="badge badge-danger"><?= $quarter; ?> Quarter</span>
                                            <span class="badge badge-primary">Week <?= $week; ?></span>
                                            <span class="badge badge-info">Year <?= $year; ?></span>
                                            <span class="badge badge-success"><?= $month; ?></span>
                                        </h4>
                                        
                                        <div class="table-responsive">
                                            <table class="table mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>Section</th>
                                                        <th class="text-center">Accomplishments</th>
                                                        <th class="text-center">Updates</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                     <?php foreach($data as $row) { ?>
                                                        <tr>
                                                            <td><?= $row->sectionName; ?></td>
                                                            <td class="text-center">
                                                                <?php 
                                                                if($this->input->post('submit')){
                                                                $quarter = $this->input->post('quarter');
                                                                $year = $this->input->post('year');
                                                                $week = $this->input->post('weekAcc');
                                                                $month = $this->input->post('month');
                                                                $sec = $row->sectionName;

                                                                $sec =$this->SGODModel->checking($quarter,$year,$week,$month,$sec,'Accomplishment');
                                                                }else{
                                                                ?>
                                                                <?php } 
                                                                if(!empty($sec)){
                                                                    echo '<i class="mdi mdi-check text-success"></i>';
                                                                }else{
                                                                    echo '<i class="mdi mdi-close text-danger"></i>';
                                                                }
                                                                
                                                                ?>
                                                            </td>
                                                            <td class="text-center">
                                                            <?php 
                                                                if($this->input->post('submit')){
                                                                $quarter = $this->input->post('quarter');
                                                                $year = $this->input->post('year');
                                                                $week = $this->input->post('weekAcc');
                                                                $month = $this->input->post('month');
                                                                $sec = $row->sectionName;

                                                                $sec =$this->SGODModel->checking($quarter,$year,$week,$month,$sec,'Updates');
                                                                }else{
                                                                ?>
                                                                <?php } 
                                                                if(!empty($sec)){
                                                                    echo '<i class="mdi mdi-check text-success"></i>';
                                                                }else{
                                                                    echo '<i class="mdi mdi-close text-danger"></i>';
                                                                }
                                                                
                                                                ?>    
                                                            </td>
                                                        </tr>
                                                        
                                                    <?php }  ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                        <!--- end row -->

                    </div>
                    <!-- end container-fluid -->

                </div>
                <!-- end content -->


            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->
             <!-- Footer Start -->
             <?php include('includes/footer.php'); ?>
                <!-- end Footer -->                                        
        </div>
        <!-- END wrapper -->

        
        <!-- Vendor js -->
        <script src="<?= base_url(); ?>assets/js/vendor.min.js"></script>

        <!-- App js -->
        <script src="<?= base_url(); ?>assets/js/app.min.js"></script>


  <!--  Modal for Adding New Section -->
  <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="myLargeModalLabel">Add New Section</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                               
                               </div>
                             
                               <?php if($this->session->flashdata('success')) : ?>

                                        <?= '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>'
                                                .$this->session->flashdata('success'). 
                                            '</div>'; 
                                        ?>
                                        <?php endif; ?>

                               <div class="modal-body">
                               <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <form class="parsley-examples" method="post" >
                                            
                                            <div class="form-group">
                                                <label >Section<span class="text-danger">*</span></label>
                                                <input type="text" name="sectionName" required class="form-control" >
                                            </div>
                                            <div class="form-group">
                                                <label >Section Head<span class="text-danger">*</span></label>
                                                <input type="text" required class="form-control" name="sectionHead">
                                            </div>
                                           

                                            <div class="form-group">
                                                <label >Position <span class="text-danger">*</span></label>
                                                <input type="text" required  class="form-control" name="sectionHeadPosition" >
                                            </div>

                                           
                                            <div class="form-group text-right mb-0">
                                               <input type="submit" name="submit" value="Submit" class="btn btn-primary waves-effect waves-light mr-1">
                                                
                                               
                                            </div>

                                        </form>
                                    </div>
                                </div>
                                <!-- end card -->
                            </div>
                            <!-- end col -->
                           </div>   
                            <!-- end row -->

                           </div>
                        </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
             <!-- /.modal -->


             <!--  Modal for filter New accomplishment and updates -->
  <div class="modal fade sc" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="myLargeModalLabel">Filter</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                               
                               </div>
                          

                               <div class="modal-body">
                               <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <form class="parsley-examples" action="submission" method="post" >
                                            
                                            <div class="form-group">
                                                <label >Quarter <span class="text-danger">*</span></label>
                                                <select class="form-control" name="quarter" required>
                                                    <?php $quater = array("1st", "2nd", "3rd", "4th"); ?>
                                                    <option></option>
                                                    <?php 
                                                    foreach($quater as $row){
                                                            echo '<option value="'.$row.'">'.$row.' Quarter</option>';
                                                    }
                                                    ?>
                                                    
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label >Year <span class="text-danger">*</span></label>
                                                <input type="text" required class="form-control" name="year">
                                            </div>

                                            <div class="form-group">
                                                <label >Month <span class="text-danger">*</span></label>
                                                <select class="form-control" name="month" required>
                                                    <option></option>
                                                    <?php
                                                        for($m=1; $m<=12; ++$m){  ?>
                                                        <option value="<?= date('F', mktime(0, 0, 0, $m, 1)); ?>"><?= date('F', mktime(0, 0, 0, $m, 1)); ?></option>
                                                        <?php  } ?>
                                                </select>
                                            </div>
                                           

                                            <div class="form-group">
                                                <label >Week <span class="text-danger">*</span></label>
                                                <select class="form-control" name="weekAcc" required>
                                                    <option></option>
                                                    <?php 
                                                    for ($x = 1; $x <=5; $x++){
                                                        echo '<option value="'.$x.'"> Week '. $x.'</option>';
                                                }
                                                ?>
                                                </select>
                                            </div>

                                           
                                            <div class="form-group text-right mb-0">
                                               <input type="submit" name="submit" value="Submit" class="btn btn-primary waves-effect waves-light mr-1">
                                                
                                               
                                            </div>

                                        </form>
                                    </div>
                                </div>
                                <!-- end card -->
                            </div>
                            <!-- end col -->
                           </div>   
                            <!-- end row -->

                           </div>
                        </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
             <!-- /.modal -->


     <script src="<?= base_url(); ?>assets/libs/custombox/custombox.min.js"></script>
     <script type="text/javascript">
                $(document).on("click", ".open-AddBookDialog", function () {
                    var myBookId = $(this).data('id');
                    $(".modal-body #id").val( myBookId );

                    var fieldId = $(this).data('field');
                    $(".modal-body #field").val( fieldId );
                });
            </script>

    </body>
</html>