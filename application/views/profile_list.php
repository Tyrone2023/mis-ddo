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
    <div class="col-md-12">
        <div class="page-title-box">
            <h4 class="page-title">
                

                    <a href="<?= base_url(); ?>Enrollment/profileEntry">
                        <button type="button" class="btn btn-info waves-effect waves-light"> <i class=" fas fa-user-plus mr-1"></i> <span>Add New</span> </button>
                    </a>
                    <a href="<?= base_url(); ?>FileUploader">
                        <button type="button" class="btn btn-success waves-effect waves-light"> <i class=" fas fa-user-plus mr-1"></i> <span>Bulk Upload</span> </button>
                    </a>

                    <a href="<?= base_url(); ?>resources/StudentProfile.xlsx">
                        <button type="button" class="btn btn-secondary waves-effect waves-light"> <i class=" fas fa-cloud-download-alt  mr-1"></i> <span>Download Template</span> </button>
                    </a>


            </h4>
            <div class="page-title-right">
                <ol class="breadcrumb p-0 m-0">
                    <!-- <li class="breadcrumb-item"><a href="#"><span class="badge badge-purple mb-3">Currently login to <b>SY <?php echo $this->session->userdata('sy'); ?> <?php echo $this->session->userdata('semester'); ?></span></b></a></li> -->
                </ol>
            </div>
            <div class="clearfix"></div>

        </div>
    </div>
</div>
<!-- end page title -->

<div class="row">
    <div class="col-lg-12 col-sm-6 ">
        <!-- Portlet card -->
        <div class="card">
            <div class="card-header bg-info py-3 text-white">
                <div class="card-widgets">
                    <a href="javascript:;" data-toggle="reload"><i class="mdi mdi-refresh"></i></a>
                    <a data-toggle="collapse" href="#cardCollpase3" role="button" aria-expanded="false" aria-controls="cardCollpase2"><i class="mdi mdi-minus"></i></a>
                    <!-- <a href="#" data-toggle="remove"><i class="mdi mdi-close"></i></a> -->
                </div>
                <!-- <h5 class="card-title mb-0 text-white">Profile List</h5> -->
            </div>
            <div id="cardCollpase3" class="collapse show">
                <div class="card-body">
                    <?php echo $this->session->flashdata('msg'); ?>
                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th>Student Name</th>
                                <th>Student No.</th>
                                <th>Sex</th>
                                <th style="width:110px">B-Date</th>
                                <th>Birth Place</th>
                                <th>Religion</th>
                                <th style="text-align:center; width:240px">Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            foreach ($data as $row) {
                                echo "<tr>";
                                echo "<td>" . $row->LastName . ', ' . $row->FirstName . ' ' . $row->MiddleName . "</td>";
                                echo "<td>" . $row->StudentNumber . "</td>";
                                echo "<td>" . $row->Sex . "</td>";
                                echo "<td>" . $row->BirthDate . "</td>";
                                echo "<td>" . $row->BirthPlace . "</td>";
                                echo "<td>" . $row->Religion . "</td>";
                            ?>

                                <td style="text-align:center">
                                    <?php if ($this->session->userdata('level') === 'Accounting') : ?>
                                        <!-- <button type="button" class="btn btn-warning btn-xs">View Profile</button>
                                    <button type="button" class="btn btn-danger btn-xs">Delete</button> -->
                                    <?php elseif ($this->session->userdata('level') === 'Admin') : ?>
                                        <a href="<?= base_url(); ?>page/studentsprofile?id=<?php echo $row->StudentNumber; ?>" class="text-info"><i class="mdi mdi-file-document-box-check-outline"></i>View Profile</a>
                                        <a href="<?= base_url(); ?>page/deleteProfile?id=<?php echo $row->StudentNumber; ?>" class="text-danger" onclick="return confirm('Are you sure you want to delete this record?')"><i class="mdi mdi-file-document-box-check-outline"></i>Delete</a>


                                    <?php elseif ($this->session->userdata('level') === 'Registrar') : ?>
                                        <a href="<?= base_url(); ?>page/studentsprofile?id=<?php echo $row->StudentNumber; ?>" class="text-info"><i class="mdi mdi-file-document-box-check-outline"></i>View Profile</a>
                                        <a href="<?= base_url(); ?>page/deleteProfile?id=<?php echo $row->StudentNumber; ?>" class="text-danger" onclick="return confirm('Are you sure you want to delete this record?')"><i class="mdi mdi-file-document-box-check-outline"></i>Delete</a>
                                    <?php endif; ?>

                                </td>
                            <?php
                                echo "</tr>";
                            }
                            ?>
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
        <!-- end card-->

    </div>
    <!-- end col -->
</div>



</div>
<!-- end container-fluid -->

                </div>
                <!-- end content -->

                <?php include('templates/footer.php'); ?>       

             
 