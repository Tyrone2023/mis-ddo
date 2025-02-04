
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
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body table-responsive">
                                    <h4 class="header-title mb-4">List of Applicants Query<br />
                                    </h4><br />
                                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <!-- <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;"> -->
                                        <thead>
                                            <tr>
                                                <th>Last Name</th>
												<th>First Name</th>
                                                <th>Middle Name</th>
                                                <th>Applicant No.</th>
                                                <th>Date of Query</th>
                                                <th style="text-align:center">Action</th>
                                                <th style="text-align:center">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                foreach($data as $row){ 
                                                $dc = $this->Common->one_cond_count_row('hris_application_inquiry','application_id',$row->application_id);
                                                $application = $this->Common->one_cond_row('hris_applications','appID',$row->application_id);
                                                $job = $this->Common->one_cond_row('hris_jobvacancy', 'jobID',$row->job_id);

                                                
                                                if(isset($application->empEmail)){
                                                
                                                    $b = $this->Common->one_cond_row('hris_applicant', 'id', $row->applicant_id);
                                                    if(!empty($b)){
                                                        $applicant = $this->Common->one_cond_row('hris_applicant', 'id', $row->applicant_id);
                                                        $id=$applicant->id;
                                                        $record=$applicant->record_no;
                                                    }else{
                                                        $applicant = $this->Common->one_cond_row('hris_staff', 'IDNumber', $row->applicant_id);
                                                        $record=$applicant->IDNumber;
                                                        $id=$applicant->IDNumber;
                                                    }

                                                //if($dc->num_rows() <= 1){
                                            ?>
                                            
                                            <tr>
                                                
                                                <td><?= strtoupper($applicant->LastName); ?> </td>
                                                <td><?= strtoupper($applicant->FirstName); ?></td>
                                                <td><?= strtoupper($applicant->MiddleName); ?></td>
                                                <td><?= $row->applicant_id; ?></td>
                                                <!-- <td><?= strtoupper($record); ?></td> -->
                                                <td><?= $row->idate; ?></td>
                                                <td class="text-center">
                                                <?php if($job->position == 1){ ?>
                                                    <a class="btn btn-success btn-sm" target="_blank" href="<?= base_url(); ?>Pages/inquiry/<?= $id; ?>/<?= $application->jobID; ?>/<?= $application->pre_school; ?>/<?= $application->appID; ?>"><i class="mdi mdi-notebook-multiple tooltips text-white"></i></a>
                                                <?php }else{ ?>
                                                    <a class="btn btn-success btn-sm" target="_blank" href="<?= base_url(); ?>Pages/inquiry_non/<?= $id; ?>/<?= $application->jobID; ?>/<?= $application->pre_school; ?>/<?= $application->appID; ?>"><i class="mdi mdi-notebook-multiple tooltips text-white"></i></a>
                                                <?php } ?>
                                                </td>
                                                <td class="text-center"><a href="<?= base_url(); ?>Pages/aq/<?= $row->application_id; ?>" onclick="return confirm('are you sure?');" class="btn btn-purple btn-sm">Final</a></td>
                                            </tr>
                                            <?php }}?>
                                        </tbody>

                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->

                        






                                                    </div>
                                                </div>
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>
                                        <!-- /.modal -->


                        


                        


                    </div>
                    <!-- end container-fluid -->

                </div>
                <!-- end content -->

                <script>
                $(document).on("click", ".passingID", function () {
                    $(this).attr('data-id');
                $(".modal-body").val( ids );
                });
            </script>

             
                                      

