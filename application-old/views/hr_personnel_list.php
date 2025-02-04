<?php include('templates/head.php'); ?>

<!-- <?php include('templates/header.php'); ?> -->

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
            <?php endif; ?>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body table-responsive">
                            <h4 class="header-title mb-4">Personnel List<br /></h4><br />
                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th style="text-align: center;">Last Name</th>
                                        <th style="text-align: center;">First Name</th>
                                        <th style="text-align: center;">Middle Name</th>
                                        <th style="text-align: center;">Employee No.</th>
                                        <th style="text-align: center;">Position</th>
                                        <th style="text-align: center;">Salary Grade</th>
                                        <th style="text-align: center;">Step</th>
                                        <th style="text-align: center;">Item No.</th>
                                        <th style="text-align: center;">Department</th>
                                        <th style="text-align: center;">Eligibility</th>
                                        <th style="text-align: center;">TIN</th>
                                        <th style="text-align: center;">Date Hired</th>
                                        <th style="text-align: center;">Last Appointment</th>
                                        <th style="text-align: center;">Expected Retirement Year</th>
                                        <th style="text-align: center;">Lenght of Service</th>
                                        <th style="text-align: center;">Civil Status</th>
                                        <th style="text-align: center;">Birth Date</th>
                                        <th style="text-align: center;">Age</th>
                                        <th style="text-align: center;">Action</th>
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
                                        echo "<td>" . $row->IDNumber . "</td>";
                                        echo "<td>" . $row->empPosition . "</td>";
                                        echo "<td>" . $row->sgNo . "</td>";
                                        echo "<td>" . $row->stepNo . "</td>";
                                        echo "<td>" . $row->itemNo . "</td>";
                                        echo "<td>" . $row->Department . "</td>";
                                        echo "<td>" . $row->csEligibility . "</td>";
                                        echo "<td>" . $row->tinNo . "</td>";
                                        echo "<td>" . $row->dateHired . "</td>";
                                        echo "<td>" . $row->lastAppointmentDate . "</td>";
                                        echo "<td>" . $row->retYear . "</td>";
                                        echo "<td>" . $row->serviceLenght . "</td>";
                                        echo "<td>" . $row->MaritalStatus . "</td>";
                                        echo "<td>" . $row->BirthDate . "</td>";
                                        echo "<td>" . $row->age . "</td>";
                                    ?>
                                        <td><a href="<?= base_url(); ?>personnel_profile/<?= $row->IDNumber; ?>" class="text-success"><i class="mdi mdi-file-document-box-check-outline"></i>View
                                                Details</a>&nbsp;&nbsp;&nbsp;&nbsp;

                                            <a data-toggle="modal" data-id="<?= $row->IDNumber; ?>" class="open-AddBookDialog text-info" href="#change_pass"><i class="fas fa-user-alt"></i><span> Reset Password </span></a>
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
            </div>
            <!-- end row -->



        </div>
        <!-- end container-fluid -->

    </div>
    <!-- end content -->

    <?php include('templates/footer.php'); ?>