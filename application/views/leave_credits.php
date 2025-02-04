<?php include('templates/head.php'); ?>
<?php include('templates/header.php'); ?>

<div class="content-page">
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">

            <!-- Page Title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body table-responsive">
                            <h4 class="header-title mb-4">COC Credits</h4>

                            <?php if ($this->session->flashdata('success')) : ?>
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <?= $this->session->flashdata('success'); ?>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            <?php endif; ?>

                            <?php if ($this->session->flashdata('danger')) : ?>
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <?= $this->session->flashdata('danger'); ?>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            <?php endif; ?>

                            <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#addCOCModal">Add COC Credit</button>

                            <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Last Name</th>
                                        <th>First Name</th>
                                        <th>Middle Name</th>
                                        <th>Activity Date</th>
                                        <th style='text-align:center'>Number of Days</th>
                                        <th style='text-align:center'>File Attachment</th>
                                
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                                $i = 1;
                                                foreach ($data as $row) {
                                                    echo "<tr>";
                                                    echo "<td>" . $row->LastName . "</td>";
                                                    echo "<td>" . $row->FirstName . "</td>";
                                                    echo "<td>" . $row->MiddleName . "</td>";
                                                    echo "<td>" . $row->act_date . "</td>";
                                                    echo "<td style='text-align:center'>" . $row->noDays . "</td>";
                                                    echo "<td style='text-align:center'>" . $row->fileAttach . "</td>";
                                                    echo "</tr>";
                                                }
                                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="modal fade" id="addCOCModal" tabindex="-1" role="dialog" aria-labelledby="addCOCModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="<?= base_url('Page/addCOC') ?>" method="POST" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCOCModalLabel">Add COC Credit</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <!-- Select2 for IDNumber -->
                        <div class="col-md-12 form-group">
                            <label for="IDNumber">Employee</label>
                            <select class="form-control select2" name="IDNumber" id="IDNumber" data-toggle="select2" required>
                                <option value="">Select Employee</option>
                                <?php foreach ($data1 as $employee) : ?>
                                    <option value="<?= $employee->IDNumber; ?>">
                                        <?= $employee->LastName . ', ' . $employee->FirstName . ' ' . $employee->MiddleName; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>

                        
                        </div>
                    </div>

                    <div class="row">
                        <!-- Activity Attendance -->
                        <div class="col-md-8 form-group">
                            <label for="act_attend">Activity Attended</label>
                            <input type="text" class="form-control" name="act_attend" id="act_attend" required>
                        </div>
                   
                        <!-- Activity Date -->
                        <div class="col-md-4form-group">
                            <label for="act_date">Activity Date</label>
                            <input type="date" class="form-control" name="act_date" id="act_date" required>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Number of Days -->
                        <div class="col-md-4 form-group">
                            <label for="noDays">Number of Days</label>
                            <input type="number" class="form-control" name="noDays" id="noDays">
                        </div>

                        <!-- File Attachment -->
                        <div class="col-md-8 form-group">
                            <label for="fileAttach">Attachment</label>
                            <input type="file" class="form-control" name="fileAttach" id="fileAttach" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png" required>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>


<link href="<?= base_url(); ?>assets/libs/select2/select2.min.css" rel="stylesheet" />
<script src="<?= base_url(); ?>assets/libs/select2/select2.min.js"></script>


<script>
  $(document).ready(function () {
    // Initialize Select2
    $('#IDNumber').select2({
        placeholder: "Select an employee",
        width: '100%'
    });
});
</script>

    <?php include('templates/footer.php'); ?>
</div>
