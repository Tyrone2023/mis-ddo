
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

                        <?php if ($this->session->flashdata('success')) : ?>

                            <?= '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>'
                                . $this->session->flashdata('success') .
                                '</div>';
                            ?>
                        <?php endif; ?>

                        <?php if ($this->session->flashdata('danger')) : ?>
                            <?= '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>'
                                . $this->session->flashdata('danger') .
                                '</div>';
                            ?>
                        <?php endif;  ?>

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body table-responsive">
                                        <h4 class="header-title mb-4">Update Fund Allocation</h4>
                                        <?php $att = array('class' => 'parsley-examples'); ?>
                                        <?= form_open('Page/school_new',$att); ?>
                                        
                                        
                                        
                                        


                                            <div class="form-row">

                                                <div class="form-group col-md-3">
                                                    <label for="inputAddress" class="col-form-label" name="q1">January</label>
                                                    <input type="text" required class="form-control" name="mo_jan" value="<?= $data->mo_jan; ?>">
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label for="inputAddress" class="col-form-label" name="q1">February</label>
                                                    <input type="text" required class="form-control" name="mo_jan" value="<?= $data->mo_jan; ?>">
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label for="inputAddress" class="col-form-label" name="q1">March</label>
                                                    <input type="text" required class="form-control" name="mo_jan" value="<?= $data->mo_jan; ?>">
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label for="inputAddress" class="col-form-label" name="q1">April</label>
                                                    <input type="text" required class="form-control" name="mo_jan" value="<?= $data->mo_jan; ?>">
                                                </div>
                                                

                                            </div>
                                            
                                            <div class="form-row">

                                                
                                                <div class="form-group col-md-3">
                                                    <label for="inputAddress" class="col-form-label" name="q1">May</label>
                                                    <input type="text" required class="form-control" name="mo_jan" value="<?= $data->mo_jan; ?>">
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label for="inputAddress" class="col-form-label" name="q1">June</label>
                                                    <input type="text" required class="form-control" name="mo_jan" value="<?= $data->mo_jan; ?>">
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label for="inputAddress" class="col-form-label" name="q1">July</label>
                                                    <input type="text" required class="form-control" name="mo_jan" value="<?= $data->mo_jan; ?>">
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label for="inputAddress" class="col-form-label" name="q1">August</label>
                                                    <input type="text" required class="form-control" name="mo_jan" value="<?= $data->mo_jan; ?>">
                                                </div>
                                                

                                            </div>



                                            <div class="form-row">
                                                <div class="form-group col-md-3">
                                                    <label for="inputAddress" class="col-form-label" name="q1">September</label>
                                                    <input type="text" required class="form-control" name="mo_jan" value="<?= $data->mo_jan; ?>">
                                                </div>

                                                <div class="form-group col-md-3">
                                                    <label for="inputAddress" class="col-form-label" name="q1">October</label>
                                                    <input type="text" required class="form-control" name="mo_jan" value="<?= $data->mo_jan; ?>">
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label for="inputAddress" class="col-form-label" name="q1">November</label>
                                                    <input type="text" required class="form-control" name="mo_jan" value="<?= $data->mo_jan; ?>">
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label for="inputAddress" class="col-form-label" name="q1">December</label>
                                                    <input type="text" required class="form-control" name="mo_jan" value="<?= $data->mo_jan; ?>">
                                                </div>
                                                

                                            </div>

                                            


                                            <input type="submit" name="submit" value="Add New" class="btn btn-primary">
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->



            </div>
            <!-- end container-fluid -->

            </div>
            <!-- end content -->
