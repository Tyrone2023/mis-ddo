
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
                                <?php if($job->position == 1){ ?>
                                
                                        <a class="btn sm btn-primary" target="_blank" href="<?= base_url(); ?>Pages/car_rqa/<?= $this->input->get('jobID'); ?>">RQA Printable View</a>
                                        <a class="btn sm btn-success" target="_blank" href="<?= base_url(); ?>Pages/car_rqa1/<?= $this->input->get('jobID'); ?>">RQA For Posting</a>
                                        <a class="btn sm btn-info" href="<?= base_url(); ?>Page/rqa_municipality?jobID=<?= $this->input->get('jobID'); ?>&jobTitle=<?= $this->input->get('jobTitle'); ?>">Per Municipality</a>   
                                        <a class="btn sm btn-purple" target="_blank" href="<?= base_url(); ?>Pages/car/<?= $this->input->get('jobID'); ?>">CAR</a>
                                        <?php if($job->job_type == 1){ ?>
                                            <a class="btn sm btn-primary" target="_blank" href="<?= base_url(); ?>Pages/rqa_cluster/<?= $this->input->get('jobID'); ?>">RQA Cluster</a>
                                            <a class="btn sm btn-success" target="_blank" href="<?= base_url(); ?>Pages/rqa_clusterv2/<?= $this->input->get('jobID'); ?>">RQA Cluster Complete</a>
                                        <?php }elseif($job->job_type == 2){ ?>
                                            <a class="btn sm btn-primary" target="_blank" href="<?= base_url(); ?>Pages/rqa_cluster_jhs/<?= $this->input->get('jobID'); ?>">RQA Cluster</a>
                                            <a class="btn sm btn-success" target="_blank" href="<?= base_url(); ?>Pages/rqa_cluster_jhsv2/<?= $this->input->get('jobID'); ?>">RQA Cluster Complete</a>
                                        <?php }else{ ?>
                                            <a class="btn sm btn-primary" target="_blank" href="<?= base_url(); ?>Pages/rqa_cluster_shs/<?= $this->input->get('jobID'); ?>">RQA Cluster</a>
                                            <a class="btn sm btn-success" target="_blank" href="<?= base_url(); ?>Pages/rqa_cluster_shsv2/<?= $this->input->get('jobID'); ?>">RQA Cluster Complete</a>
                                        <?php } ?>
                            <?php }elseif($job->position == 2){ ?>
                                    <a class="btn sm btn-primary" target="_blank" href="<?= base_url(); ?>Pages/car_rqa_administrative/<?= $this->input->get('jobID'); ?>">RQA Printable View</a>
                                    <a class="btn sm btn-success" target="_blank" href="<?= base_url(); ?>Pages/car_rqa_administrative_posting/<?= $this->input->get('jobID'); ?>">RQA For Posting</a>
                                    <a class="btn sm btn-primary" target="_blank" href="<?= base_url(); ?>Pages/car_rqa_administrative/<?= $this->input->get('jobID'); ?>/1">RQA Printable View w/ iSignature</a>
                                    <a class="btn sm btn-success" target="_blank" href="<?= base_url(); ?>Pages/car_rqa_administrative_posting/<?= $this->input->get('jobID'); ?>/1">RQA For Posting w/ iSignature</a>

                            <?php }elseif($job->position == 3){ ?>
                                    <a class="btn sm btn-primary" target="_blank" href="<?= base_url(); ?>Pages/car_rqa_related/<?= $this->input->get('jobID'); ?>">RQA Printable View</a>
                                    <a class="btn sm btn-success" target="_blank" href="<?= base_url(); ?>Pages/car_rqa_related_posting/<?= $this->input->get('jobID'); ?>">RQA For Posting</a>
                                    <a class="btn sm btn-primary" target="_blank" href="<?= base_url(); ?>Pages/car_rqa_related/<?= $this->input->get('jobID'); ?>/1">RQA Printable View w/ iSignature</a>
                                    <a class="btn sm btn-success" target="_blank" href="<?= base_url(); ?>Pages/car_rqa_related_posting/<?= $this->input->get('jobID'); ?>/1">RQA For Posting w/ iSignature</a>
                            <?php }elseif($job->position == 4){ ?>
                                    <a class="btn sm btn-primary" target="_blank" href="<?= base_url(); ?>Pages/car_rqa_administrative/<?= $this->input->get('jobID'); ?>">RQA Printable View</a>
                                    <a class="btn sm btn-success" target="_blank" href="<?= base_url(); ?>Pages/car_rqa_administrative_posting/<?= $this->input->get('jobID'); ?>">RQA For Posting</a>
                                    <a class="btn sm btn-primary" target="_blank" href="<?= base_url(); ?>Pages/car_rqa_administrative/<?= $this->input->get('jobID'); ?>/1">RQA Printable View w/ iSignature</a>
                                    <a class="btn sm btn-success" target="_blank" href="<?= base_url(); ?>Pages/car_rqa_administrative_posting/<?= $this->input->get('jobID'); ?>/1">RQA For Posting w/ iSignature</a>

                            <?php }else{ ?>
                                    <a class="btn sm btn-primary" target="_blank" href="<?= base_url(); ?>Pages/car_rqa_non/<?= $this->input->get('jobID'); ?>">RQA Printable View non-teaching</a>
                                    <a class="btn sm btn-success" target="_blank" href="<?= base_url(); ?>Pages/car_rqa1_none/<?= $this->input->get('jobID'); ?>">RQA For Posting</a>
                                    <a class="btn sm btn-primary" target="_blank" href="<?= base_url(); ?>Pages/car_rqa_non/<?= $this->input->get('jobID'); ?>/1">RQA Printable View non-teaching w/ iSignature</a>
                                    <a class="btn sm btn-success" target="_blank" href="<?= base_url(); ?>Pages/car_rqa1_none/<?= $this->input->get('jobID'); ?>/1">RQA For Posting w/ iSignature</a>
                            <?php } ?>
                            
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
                                    <h4 class="header-title mb-4">Registry of Qualified Applicants<br/><span class="float-left badge badge-primary inline mt-2"><?php echo $_GET['jobTitle']; ?></span></h4><br />
                                       
                                        <!-- <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;"> -->
                                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <?php if($job->position == 1){ ?>
                                        <thead>
                                            <tr>
                                                <th>Applicant Code.</th>
												<th>Education</th>
                                                <th>Training</th>
                                                <th>Experience</th>
                                                <th>LET Rating</th>
                                                <th>Demo</th>
                                                <th>TR</th>
                                                <th>Total</th>
                                                <!-- <th>Action</th> -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                               <?php 
                                                    foreach($data as $row){ 
                                                        $applicant = $this->Common->one_cond_row('hris_applicant','empEmail',$row->empEmail);
                                                        $rating = $this->Common->two_cond_row('hris_applications_rating','record_no',$applicant->record_no,'appID',$row->appID); 
                                                
                                                    if($rating->total_points >= 50){
                                                ?>

                                                <tr>
                                                    <td><?= $record; ?></td>
                                                    <td><?= ($rating->education != 0.00001) ? $rating->education : ''; ?></td>
                                                    <td><?= ($rating->training != 0.00001) ? $rating->training : ''; ?></td>
                                                    <td><?= ($rating->experience != 0.00001) ? $rating->experience : ''; ?></td>
                                                    <td><?= ($rating->let_rating != 0.00001) ? $rating->let_rating : ''; ?></td>
                                                    <td><?= ($rating->demo_rating != 0.00001) ? $rating->demo_rating : ''; ?></td>
                                                    <td><?= ($rating->tr_rating != 0.00001) ? $rating->tr_rating : ''; ?></td>
                                                    <td><?= number_format($rating->total_points, 2); ?></td>
                                                </tr>
                                        
                                          <?php  } }  ?>

                                        </tbody>
                                        <?php }else{ ?>
                                            <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Applicant Code.</th>
												<th>Education</th>
                                                <th>Training</th>
                                                <th>Experience</th>
                                                <th>Performance Rating</th>
                                                <th>Outstanding Accomplishments</th>
                                                <th>Application Of Education</th>
                                                <th>Application Of Learning & Development</th>
                                                <th>Interview</th>
                                                <th>Written</th>
                                                <th>Total</th>
                                                <!-- <th>Action</th> -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                               <?php 
                                                    $count=1;
                                                    foreach($data as $row){ 

                                                        $a = $this->Common->one_cond_row('hris_applicant','empEmail',$row->empEmail);
                                                        
                                                        if(!empty($a)){
                                                            $applicant = $this->Common->one_cond_row('hris_applicant','empEmail',$row->empEmail);
                                                            $rating = $this->Common->two_cond_row('hris_rating_none','record_no',$applicant->record_no,'appID',$row->appID);
                                                           
                                                            $record= $applicant->record_no;
                                                        }else{
                                                            $applicant = $this->Common->one_cond_row('hris_staff','IDNumber',$row->empEmail);
                                                            $rating = $this->Common->two_cond_row('hris_rating_none','record_no',$applicant->IDNumber,'appID',$row->appID); 
                                                            $record= $applicant->IDNumber; 
                                                        }
                                                ?>

                                                <tr>
                                                    <td><?= $count++; ?></td>
                                                    <td><?= $record; ?></td>
                                                    <td><?= ($rating->educ != 0.00001) ? $rating->educ : ''; ?></td>
                                                    <td><?= ($rating->trainings != 0.00001) ? $rating->trainings : ''; ?></td>
                                                    <td><?= ($rating->experience != 0.00001) ? $rating->experience : ''; ?></td>
                                                    <td><?= ($rating->performance != 0.00001) ? $rating->performance : ''; ?></td>
                                                    <td><?= ($rating->oa != 0.00001) ? $rating->oa : ''; ?></td>
                                                    <td><?= ($rating->ae != 0.00001) ? $rating->ae : ''; ?></td>
                                                    <td><?= ($rating->ald != 0.00001) ? $rating->ald : ''; ?></td>
                                                    <td><?= ($rating->interview != 0.00001) ? $rating->interview : ''; ?></td>
                                                    <td><?= ($rating->written != 0.00001) ? $rating->written : ''; ?></td>
                                                    <td><?php if(isset($rating)){echo number_format($rating->total_points, 2);} ?></td>
                                                </tr>
                                        
                                          <?php  }   ?>

                                        </tbody>
                                        <?php } ?>

                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->


                        <?php
                                    $jobTitle = $_GET['jobTitle'];

                                    if ($jobTitle == "Teacher I - Junior High School") { ?>
                                       

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body table-responsive">
                                    <h4 class="header-title mb-4">Summary<br/><span class="float-left badge badge-primary inline mt-2">Per Specialization</span></h4><br />
                                       
                                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>Specialization</th>
												<th style="text-align: center">Counts</th>
                                                <th style="text-align: center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                               <?php
										  foreach($data1 as $row)
										  {
										  echo "<tr>";
										  echo "<td>".$row->specialization."</td>";
										  echo "<td style='text-align: center'>".$row->speCounts."</td>";
                                            ?>
                                          <td style="text-align: center">

                                          
                                            <a href="<?= base_url(); ?>Page/rqa_specialization/?spe=<?= $row->specialization; ?>&jobID=<?= $row->jobID; ?>" class="text-success"><i class="mdi mdi-file-document-box-check-outline"></i>View List</a>&nbsp;&nbsp;&nbsp;&nbsp;
                                            <?php if($row->specialization == ""){?>
                                                <span class="text-primary"><i class="mdi mdi-file-document-box-check-outline"></i>Printable View</span>&nbsp;&nbsp;&nbsp;&nbsp;
                                            <?php }else{ ?>

                                            <a href="<?= base_url(); ?>Pages/rqa_specialization_print?id=<?= $row->jobID; ?>&spec=<?= $row->specialization; ?>" class="text-primary" target="_blank"><i class="mdi mdi-file-document-box-check-outline"></i>RQA Printable View</a>&nbsp;&nbsp;&nbsp;&nbsp;
                                            <a href="<?= base_url(); ?>Pages/rqa_specialization_print1?id=<?= $row->jobID; ?>&spec=<?= $row->specialization; ?>" class="text-success" target="_blank"><i class="mdi mdi-file-document-box-check-outline"></i>RQA For Posting</a>&nbsp;&nbsp;&nbsp;&nbsp;
                                            <a href="<?= base_url(); ?>Page/rqa_municipality_specialization?id=<?= $row->jobID; ?>&spec=<?= $row->specialization; ?>" class="text-info" ><i class="mdi mdi-file-document-box-check-outline"></i>Per Municipality</a>&nbsp;&nbsp;&nbsp;&nbsp;
                                              <?php } ?>        
                                           </td>

                                                    <?php echo "</tr>"; } ?>
                                        </tbody>

                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->
                       
                                  <?php
                                    } elseif ($jobTitle == "Teacher I - Senior High"){ ?>
                                     <!-- senior high -->
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body table-responsive">
                                    <h4 class="header-title mb-4">Summary<br/><span class="float-left badge badge-primary inline mt-2">Per Track/Strand</span></h4><br />
                                       
                                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>Track/Strand</th>
												<th style="text-align: center">Counts</th>
                                                <th style="text-align: center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                               <?php
										  foreach($data3 as $row)
										  {
										  echo "<tr>";
										  echo "<td>".$row->shss."</td>";
										  echo "<td style='text-align: center'>".$row->speCounts."</td>";
                                            ?>
                                          <td style="text-align: center">
                                            <a href="<?= base_url(); ?>Page/rqa_track/?spe=<?= $row->shss; ?>&jobID=<?= $row->jobID; ?>" class="text-success"><i class="mdi mdi-file-document-box-check-outline"></i>View List</a>&nbsp;&nbsp;&nbsp;&nbsp;
                                            <?php if($row->shss == ""){?>
                                                <span class="text-primary"><i class="mdi mdi-file-document-box-check-outline"></i>Printable View</span>&nbsp;&nbsp;&nbsp;&nbsp;
                                            <?php }else{ ?>

                                            <a href="<?= base_url(); ?>Pages/rqa_track_print?id=<?= $row->jobID; ?>&spec=<?= $row->shss; ?>" class="text-primary" target="_blank"><i class="mdi mdi-file-document-box-check-outline"></i>RQA Printable View</a>&nbsp;&nbsp;&nbsp;&nbsp;
                                            <a href="<?= base_url(); ?>Pages/rqa_track_print1?id=<?= $row->jobID; ?>&spec=<?= $row->shss; ?>" class="text-success" target="_blank"><i class="mdi mdi-file-document-box-check-outline"></i>RQA For Posting</a>&nbsp;&nbsp;&nbsp;&nbsp;
                                            <a href="<?= base_url(); ?>Page/rqa_municipality_track?id=<?= $row->jobID; ?>&spec=<?= $row->shss; ?>" class="text-info" ><i class="mdi mdi-file-document-box-check-outline"></i>Per Municipality</a>&nbsp;&nbsp;&nbsp;&nbsp;
                                              <?php } ?>        
                                           </td>

                                                    <?php echo "</tr>"; } ?>
                                        </tbody>

                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->

                        <?php } ?>



                        
                       
                                 



                    </div>
                    <!-- end container-fluid -->

                </div>
                <!-- end content -->

       
       
 