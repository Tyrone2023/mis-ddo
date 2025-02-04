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
                                    <?php if($st->type == 1){ ?>
                                <a data-toggle="modal"  class="open-AddBookDialog btn btn-primary waves-effect waves-light" href="#add">Add New</a>
                                    <?php } ?>
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


                        <!-- sample modal content -->
                        <div id="add" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">

                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="myModalLabel">Change Allocation</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                    </div>
                                                    
                                                    <div class="modal-body">
                                                    <?= form_open('Page/fund_add'); ?>

                                                        <input type="hidden" required value="<?= $this->session->username ?>" name="schoolID" class="form-control"> 
                                                       

                                                        <div class="form-group col-md-12">
                                                            <label>Fund Allocation Amount</label>
                                                            <input type="text" required value="<?= set_value('alloc_amount'); ?>" name="alloc_amount" class="form-control"> 
                                                        </div>

                                                        <div class="form-group col-md-12">
                                                            <input type="hidden" required value="<?= $last->alloc_batch+1; ?>" name="bcode" class="form-control"> 
                                                        </div>

                                                        <div class="form-group col-md-12">
                                                            <label>Fascal Year</label>
                                                            <select class="form-control" name="fy" required>
                                                                <option></option>
                                                            <?php 
                                                            $firstYear = (int)date('Y');
                                                            $lastYear = $firstYear + 5;
                                                            for($i=$firstYear;$i<=$lastYear;$i++){ echo '<option value='.$i.'>'.$i.'</option>';}
                                                            ?>
                                                            </select>
                                                        </div>

                                                        
                                                        <div class="form-group col-md-12">
                                                            <label>Group</label>
                                                            <select class="form-control" name="group" required>
                                                                <option></option>
                                                                <?php 
                                                                $g = array('Senior HS','Junior HS','Elementary');
                                                                  foreach($g as $row){
                                                                ?>
                                                                <option value="<?= $row; ?>"><?= $row; ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>

                                                        
                                                        <div class="form-group col-md-12">
                                                            <label>Allocation Type</label>
                                                            <select class="form-control" name="type" required>
                                                                <option></option>
                                                                <?php 
                                                                  foreach($bs as $row){
                                                                ?>
                                                                <option value="<?= $row->description; ?>"><?= $row->description; ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    
                                                        <div class="modal-footer">
                                                            <button type="submit" name="submit" class="btn btn-primary waves-effect waves-light">Submit</button>
                                                        </div>
                                                </form>
                                                </div>
                                                </div>
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>
                                        <!-- /.modal -->



                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body table-responsive">
                                        <h4 class="header-title mb-4">SCHOOL ALLOCATION</h4><br />

                                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <!-- <table class="table mb-0"> -->
                                            <thead>
                                                <tr>
                                                    <th>Year</th>
                                                    <th>Total Allocation</th>
                                                    <th>Jan</th>
                                                    <th>Feb</th>
                                                    <th>Mar</th>
                                                    <th>Apr</th>
                                                    <th>May</th>
                                                    <th>Jun</th>
                                                    <th>Jul</th>
                                                    <th>Aug</th>
                                                    <th>Sep</th>
                                                    <th>Oct</th>
                                                    <th>Nov</th>
                                                    <th>Dec</th>
                                                    <th>Batch Code</th>
                                                    <th>Allocation Type</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php foreach ($data as $row) { ?>
                                                    <tr>
                                                        <td><?= $row->alloc_year?></td>
                                                        <td class="text-align:right"><?= number_format("$row->alloc_amount", 2); ?></td>
                                                        <td class="text-align:right"><?= number_format("$row->mo_jan", 2); ?></td>
                                                        <td class="text-align:right"><?= number_format("$row->mo_feb", 2); ?></td>
                                                        <td class="text-align:right"><?= number_format("$row->mo_mar", 2); ?></td>
                                                        <td class="text-align:right"><?= number_format("$row->mo_apr", 2); ?></td>
                                                        <td class="text-align:right"><?= number_format("$row->mo_may", 2); ?></td>
                                                        <td class="text-align:right"><?= number_format("$row->mo_jun", 2); ?></td>
                                                        <td class="text-align:right"><?= number_format("$row->mo_jul", 2); ?></td>
                                                        <td class="text-align:right"><?= number_format("$row->mo_aug", 2); ?></td>
                                                        <td class="text-align:right"><?= number_format("$row->mo_sep", 2); ?></td>
                                                        <td class="text-align:right"><?= number_format("$row->mo_oct", 2); ?></td>
                                                        <td class="text-align:right"><?= number_format("$row->mo_nov", 2); ?></td>
                                                        <td class="text-align:right"><?= number_format("$row->mo_dec", 2); ?></td>
                                                        <td><?= $row->alloc_batch . ' - ' . $row->alloc_group; ?></td>
                                                        <td><?= $row->alloc_type; ?></td>
                                                        <td>
                                                            <?php if($st->type == 1){ ?>
                                                                <!-- <a data-toggle="modal" data-id="<?= $row->id; ?>" data-item="<?= $row->alloc_amount; ?>" class="open-AddBookDialog text text-success w-lg" href="#alloc"><i class="mdi mdi-file-document-box-check-outline"></i>Edit</a> -->
                                                                <a class="text-success" href="<?= base_url(); ?>Page/school_allocation_edit/<?= $row->id; ?>">Edit</a>
                                                            <?php } ?>
                                                        </td>
                                                    </tr>
                                                        <?php } ?>
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




                                                                            
                                        <!-- sample modal content -->
                                        <div id="alloc" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">

                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="myModalLabel">Change Allocation</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                    </div>
                                                    
                                                    <div class="modal-body">
                                                    <?= form_open('Page/fund_update'); ?>
                                                        <div class="form-group col-md-12">
                                                            <label>Fund Allocation</label>
                                                            <input type="text" required value="<?= set_value('pass'); ?>" id="item" name="alloc_amount" class="form-control"> 
                                                        </div>
                                                        <input type="hidden" name="id" id="id" value="">

                                                        <div class="form-group col-md-12">
                                                            <label>Fascal Year</label>
                                                            <select class="form-control" name="fy" required>
                                                                <option></option>
                                                            <?php 
                                                            $firstYear = (int)date('Y');
                                                            $lastYear = $firstYear + 5;
                                                            for($i=$firstYear;$i<=$lastYear;$i++){ echo '<option value='.$i.'>'.$i.'</option>';}
                                                            ?>
                                                            </select>
                                                        </div>

                                                        
                                                        <div class="form-group col-md-12">
                                                            <label>Group</label>
                                                            <select class="form-control" name="group" required>
                                                                <option></option>
                                                                <?php 
                                                                $g = array('Senior HS','Junior HS','Elementary');
                                                                  foreach($g as $row){
                                                                ?>
                                                                <option value="<?= $row; ?>"><?= $row; ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>

                                                        
                                                        <div class="form-group col-md-12">
                                                            <label>Allocation Type</label>
                                                            <select class="form-control" name="type" required>
                                                                <option></option>
                                                                <?php 
                                                                  foreach($bs as $row){
                                                                ?>
                                                                <option value="<?= $row->description; ?>"><?= $row->description; ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    
                                                        <div class="modal-footer">
                                                            <button type="submit" name="submit" class="btn btn-primary waves-effect waves-light">Update</button>
                                                        </div>
                                                </form>
                                            </div>
                                                </div>
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>
                                        <!-- /.modal -->

            <?php include('templates/footer.php'); ?>