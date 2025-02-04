
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
                                    <!-- <div class="page-title-right">
                                        <ol class="breadcrumb p-0 m-0">
                                            <li class="breadcrumb-item">SGOD Management System v1.0</li>
                                        </ol>
                                    </div> -->
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->




                        
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">

                                                <?= form_open('page/implementation_plans'); ?>
                                                        <div class="form-group col-md-6">
                                                            <label >Fiscal Year</label>
                                                            <select class="form-control" name="fy" required>
                                                                <option></option>
                                                                <?php 
                                                                    for ($count = date('Y'); $count >= 2020; $count--) 
                                                                    echo '<option value="' . $count . '">' . $count . '</option>';
                                                                ?>
                                                                
                                                            </select>


                                                        </div>
   
                                                        <div class="form-group col-md-6">
                                                            <input type="submit" name="submit" class="btn btn-primary waves-effect waves-light" value="Submit" />
                                                        </div>
                                                    </form>
                                        

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


    </body>
</html>