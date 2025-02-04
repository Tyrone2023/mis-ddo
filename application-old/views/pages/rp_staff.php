<!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->
             
            
                <?php 
                    $job = $this->Common->one_cond_row('hris_jobvacancy', 'jobID',$this->uri->segment(4));               
                    $history = $this->Common->one_cond('hris_applications','empEmail',$data->empEmail);
                    $aa = $this->Common->three_cond_row('hris_applications','empEmail',$data->empEmail,'jobID',$this->uri->segment(4),'pre_school',$this->uri->segment(5)); 
                    $rating = $this->Common->two_cond_row('hris_applications_rating','record_no',$data->empEmail,'appID',$aa->appID);
                    $inquery = $this->Common->two_cond_count_row('hris_application_inquiry','applicant_id',$this->uri->segment(3),'job_id',$this->uri->segment(4));
                    $open = $this->Page_model->get_single_row_by_id('settings', 'id', 7); 
                    $pt = $this->Common->one_cond_row('hris_positions','title',$job->jobTitle);
               ?>

            

            <div class="content-page">
                <div class="content"> 
                   
                
                    <!-- Start Content-->
                    <div class="container-fluid">
                       

                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <?php if($this->session->position == 'asds'){?>
                                    <a target="_blank" href="<?= base_url(); ?>Pages/request_to_rr/<?= $this->uri->segment(3); ?>/<?= $this->uri->segment(4); ?>/<?= $aa->appID?>" class="btn btn-info">Request to Retain Rating</a>
                                    <?php } ?>

                                    <div class="clearfix"></div>
                                    
                                    <?php if($this->session->position != "reg"){ ?>
                                    <div class="page-title-right">
                                        <ol class="breadcrumb p-0 m-0">
                                            <li class="breadcrumb-item"><a href="<?= base_url(); ?>Pages/evaluator_applicant/<?= $this->uri->segment(4); ?>">List of Applicants</a></li>
                                            <li class="breadcrumb-item active">Applicant Applicantion</li>
                                        </ol>
                                    </div>
                                    <?php } ?>
                                    <!-- <h4 class="page-title">Basic Tables</h4> -->

                                    <?php if($data->empEmail == 'jhunlio@gmail.com' || $data->empEmail == 'joselito.edong@deped.gov.ph'){ ?>
                                    <div class="alert alert-icon alert-danger alert-dismissible fade show" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            <i class="mdi mdi-block-helper mr-2"></i>
                                            <strong>Oh snap!</strong> Developer's test application please don't mind it.
                                        </div>
                                    <?php } ?>

                                   
                                    <div class="clearfix"></div>
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
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
                        <?php 
                            //$app = $this->Common->three_cond('hris_applications', 'empEmail', $data->empEmail,'app_year',date('Y'),'jobID',$this->uri->segment(4)); 
                            
                            $ca = $this->Common->two_cond_count_row('hris_applications', 'empEmail', $data->empEmail,'app_year',date('Y')); 

                            if($ca->num_rows() >= 1){
                        ?>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-striped mb-0">
                                                <thead>
                                                    <tr class="bg-info text-center text-white">
                                                        <th colspan="2">APPLICATION DETAILS &nbsp; &nbsp; &nbsp;
                                                            <a href="<?= base_url(); ?>Pages/application_history/<?= $this->uri->segment(3); ?>/<?= $this->uri->segment(4); ?>/<?= $aa->appID; ?>/<?= $this->uri->segment(5); ?>"><i class="mdi mdi-notebook-multiple tooltips text-white" data-placement="top" data-toggle="tooltip" data-original-title="View Application Status"></i></a> &nbsp; &nbsp;
                                                            
                                                        </th> 
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php if($data->pre_school != ""){?>
                                                    
                                                    <?php } ?>
                                                    <?php
                                                        //$jv = $this->Common->one_cond_row('hris_jobvacancy', 'jobID',$row->jobID);
                                                        //$s = $this->Common->one_cond_row('schools', 'schoolID',$row->pre_school);
                                                        
                                                        $app = $this->Common->three_cond_row('hris_applications','applicant_id',$this->uri->segment(3),'jobID',$this->uri->segment(4),'pre_school',$this->uri->segment(5));
                                           
                                                        $s = $this->Common->one_cond_row('schools', 'schoolID',$this->uri->segment(5));
                                                    
                                                        ?>
                                                    <tr>
                                                        <th width="30%" class="text-right">Position Applied</th>
                                                        <td style="background: #9ddcf4; color:#222"><?= $job->jobTitle; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th class="text-right">District</th>
                                                        <td style="background: #9ddcf4; color:#222"><?php if($job->sy != '2023'){?><?= $s->district; ?><?php } ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th class="text-right">Preferred School</th>
                                                        
                                                        <td style="background: #9ddcf4; color:#222"><?php if($job->sy != '2023'){?><?= $s->schoolName; ?><?php } ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th class="text-right">Status</th>
                                                        <td style="background: #9ddcf4;">
                                                            <span class="badge badge-warning"><?= $aa->appStatus; ?></span>
                                                        </td>
                                                    </tr>
                                                    <?php if(!empty($rating)){ ?>
                                                    <?php //if($open->status == 0){if($this->session->position == "reg" || $this->session->position == "asds"){ ?>
                                                    <?php if($open->status == 0){if($this->session->position == "admin"){ ?>
                                                    <?php //if($this->session->position == "admin"){ ?>
                                                    <?php if($rating->demo_rating != 0.00001){ ?>
                                                    <?php if($rating->tr_rating != 0.00001){ ?>
                                                    <?php if($aa->appStatus == "Rated"){ ?>
                                                    <tr>
                                                        <th class="text-right">Action</th>
                                                        <td style="background: #bbecfe;">
                                                            <p class="text-dark">Click CONFIRM if you agree with the results otherwise click WITH QUERY and input your query in the box provided.<br /> (Note: <i>you can only submit query ONCE therefore make sure to read again before clicking SUBMIT.</i>)</p>
                                                            <a onclick="return confirm('Are you sure?')" class="btn btn-purple btn-sm" href="<?= base_url(); ?>Pages/confirmation/<?= $this->uri->segment(3); ?>/<?= $this->uri->segment(4); ?>/<?= $this->uri->segment(5); ?>/<?= $aa->appID; ?>">CONFIRM</a> &nbsp; &nbsp;
                                                            <!-- <a class="btn btn-success btn-sm" href="<?= base_url(); ?>Pages/inquiry/<?= $this->uri->segment(3); ?>/<?= $this->uri->segment(4); ?>/<?= $this->uri->segment(5); ?>/<?= $aa->appID; ?>"></a> -->
                                                            <?php if($inquery->num_rows() <= 1){ ?>
                                                                <a href="#" class="btn btn-info btn-sm" data-toggle="modal" data-target=".comment">WITH QUERY</a>
                                                            <?php } ?>
                                                            
                                                        </td>
                                                    </tr>
                                                    <?php }}}}}} ?>

                                                    <?php if($inquery->num_rows() >= 1){ ?>
                                                    <tr>
                                                        <th class="text-right"></th>
                                                        <td style="background: #9ddcf4;">
                                                        <a href="<?= base_url(); ?>Pages/inquiry/<?= $data->id; ?>/<?= $job->jobID; ?>/<?= $aa->pre_school; ?>/<?= $aa->appID; ?>" class="btn btn-info btn-sm">QUERY</a>
                                                        </td>
                                                    </tr>
                                                    <?php } ?>

                                                    
                                                    
                                                    
                                                    <tr>
                                                        <td colspan="2"></td>
                                                    </tr>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-striped mb-0">
                                            <thead>
                                                    <tr class="bg-primary text-white">
                                                        <th colspan="2" class="text-center">APPLICANT'S INFORMATION<?php if($data->stat == 0){if($this->session->c_id == $user->user_id){?><a href="#" data-toggle="modal" data-target=".ai"><i class="fas fa-marker btn btn-sm tooltips" data-placement="top" data-toggle="tooltip" data-original-title="Edit"></i></a></a><?php }} ?></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    
                                                    <tr>
                                                        <th class="text-right" rowspan="6"  width="30%">
                                                        <?php if($this->session->c_id == $user->user_id){?><a onMouseOver="this.style.opacity='0.6'" onMouseOut="this.style.opacity='1'" href="<?= base_url()?>Page/changeDP"><?php } ?>
                                                        <img style="width: 2in; height: 2in; padding:0; margin:0" src="<?= base_url(); ?>/uploads/profile/<?php if($user->image != ""){echo $user->image;}else{
                                                            if(isset($user->sex)){if($user->sex == 0){echo "icon/m.jpg";}else{echo "icon/f.jpg";}}
                                                        } ?>" alt="">
                                                        <?php if($this->session->c_id == $user->user_id){?></a><?php } ?>
                                                            
                                                        </th>
                                                        <td class="text-left"><b><h4>
                                                            <?= strtoupper($staff->LastName).' '.strtoupper($staff->NameExtn).', '.strtoupper($staff->FirstName).' '.strtoupper($staff->MiddleName); ?></h4></b>
                                                            <h6 class="text-success">
                                                            <?= strtoupper($staff->IDNumber); ?>
                                                        </h6>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-left"><?= strtoupper($staff->resVillage); ?>, <?= strtoupper($staff->resBarangay); ?>, <?= strtoupper($staff->resCity); ?>, <?= strtoupper($staff->resProvince); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-left"><?= strtoupper($staff->resCity); ?>, <?= strtoupper($staff->resProvince); ?></td>
                                                    </tr>
                                                    <tr id="appen">
                                                        <td class="text-left"><?= $staff->contactNo; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-left"><?php if($staff->Sex == 'M'){echo "Male";}else{echo "Female";} ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-left"><?= $staff->empEmail; ?></td>
                                                    </tr>

                                                    <tr class="bg-success text-white">
                                                        
                                                        <th colspan="2" class="text-center">  APPENDICES <?php //if($data->stat == 0){if($this->session->c_id == $user->user_id){?><a href="#"  data-toggle="modal" data-target=".ept"><!--<i class="fas fa-marker btn btn-sm tooltips" data-placement="top" data-toggle="tooltip" data-original-title="Edit"></i> --></a><?php //}} ?></th>
                                                    </tr>
                                                    <tr>
                                                        <th class="text-right">Omnibus Sworn Statement</th>
                                                        <td class="text-left"  style="background: #90bdf9; color:#464545">
                                                            <?php if($staff->omnibus != ""){?><a href="<?= base_url(); ?>Pages/pdf_staff/<?= $staff->IDNumber; ?>/omnibus/?label=Omnibus Sworn Statement" target="_blank" class="tooltips" data-placement="top" data-toggle="tooltip" data-original-title="View File Attachment"><i  class="fas fa-file-alt btn btn-lg"></i></a><?php } ?>
                                                            <?php if($staff->stat == 0){if($this->session->c_id == $user->user_id){?>
                                                                <a href="#"  data-toggle="modal" data-target=".omni"><i class="fas fa-paperclip fas btn btn-lg tooltips" data-placement="top" data-toggle="tooltip" data-original-title="Attach File"></i></a>
                                                                <?php if($staff->omnibus != ""){ ?><a onclick="return confirm('Are you sure?')" href="<?= base_url(); ?>Pages/remove_attachment_staff/<?= $this->uri->segment(3).'/'. $this->uri->segment(4).'/'. $this->uri->segment(5); ?>/omnibus" class="btn btn-warning"><i class="mdi mdi-block-helper mr-2 text-danger tooltips" data-placement="top" data-toggle="tooltip" data-original-title="Remove Attachment"></i>Remove Attachment</a><?php } ?>
                                                                <?php }} ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th class="text-right">Letter of Intent</th>
                                                        <td class="text-left"  style="background: #90bdf9; color:#464545">
                                                            <?php if($aa->application != ""){?><a href="<?= base_url(); ?>Pages/pdfv2/<?= $aa->appID; ?>/application/?label=Letter of Intent" target="_blank" class="tooltips" data-placement="top" data-toggle="tooltip" data-original-title="View File Attachment"><i  class="fas fa-file-alt btn btn-lg"></i></a><?php } ?>
                                                            <?php if($aa->stat == 0){if($this->session->c_id == $user->user_id){?>
                                                                <a href="#"  data-toggle="modal" data-target=".apfile"><i class="fas fa-paperclip fas btn btn-lg tooltips" data-placement="top" data-toggle="tooltip" data-original-title="Attach File"></i></a>
                                                                <?php if($aa->application != ""){ ?><a onclick="return confirm('Are you sure?')" href="<?= base_url(); ?>Pages/remove_attachment_app_none/<?= $this->uri->segment(3).'/'. $this->uri->segment(4).'/'. $this->uri->segment(5); ?>/application/<?= $aa->appID; ?>" class="btn btn-warning"><i class="mdi mdi-block-helper mr-2 text-danger tooltips" data-placement="top" data-toggle="tooltip" data-original-title="Remove Attachment"></i>Remove Attachment</a><?php } ?>
                                                                
                                                                <?php }} ?>
                                                        </td>
                                                    </tr>
                                                    
                                                    <tr>
                                                        <th class="text-right">Voter's ID/Certificate</th>
                                                        <td class="text-left"  style="background: #90bdf9; color:#464545">
                                                            <?php if($staff->voters != ""){?><a href="<?= base_url(); ?>uploads/regfile/<?= $staff->voters; ?>" target="_blank" class="tooltips" data-placement="top" data-toggle="tooltip" data-original-title="View File Attachment"><i  class="fas fa-file-alt btn btn-lg"></i></a><?php } ?>
                                                            <?php if($staff->stat == 0){if($this->session->c_id == $user->user_id){?>
                                                                <a href="#"  data-toggle="modal" data-target=".voters"><i class="fas fa-paperclip fas btn btn-lg tooltips" data-placement="top" data-toggle="tooltip" data-original-title="Attach File"></i></a>
                                                                <?php if($staff->voters != ""){ ?><a onclick="return confirm('Are you sure?')" href="<?= base_url(); ?>Pages/remove_attachment_staff/<?= $this->uri->segment(3).'/'. $this->uri->segment(4).'/'. $this->uri->segment(5); ?>/voters" class="btn btn-warning"><i class="mdi mdi-block-helper mr-2 text-danger tooltips" data-placement="top" data-toggle="tooltip" data-original-title="Remove Attachment"></i>Remove Attachment</a><?php } ?>
                                                                
                                                            <?php }} ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th class="text-right">Personal Data Sheet</th>
                                                        <td class="text-left"  style="background: #90bdf9; color:#464545">
                                                            <?php if($staff->pdsfile != ""){?><a href="<?= base_url(); ?>Pages/pdf_staff/<?= $staff->IDNumber; ?>/pdsfile/?label=Personal Data Sheet" target="_blank" class="tooltips" data-placement="top" data-toggle="tooltip" data-original-title="View File Attachment"><i  class="fas fa-file-alt btn btn-lg"></i></a><?php } ?>
                                                            <?php if($staff->stat == 0){if($this->session->c_id == $user->user_id){?>
                                                                <a href="#"  data-toggle="modal" data-target=".pdsfile"><i class="fas fa-paperclip fas btn btn-lg tooltips" data-placement="top" data-toggle="tooltip" data-original-title="Attach File"></i></a>
                                                                <?php if($staff->pdsfile != ""){ ?><a onclick="return confirm('Are you sure?')" href="<?= base_url(); ?>Pages/remove_attachment_staff/<?= $this->uri->segment(3).'/'. $this->uri->segment(4).'/'. $this->uri->segment(5); ?>/pdsfile" class="btn btn-warning"><i class="mdi mdi-block-helper mr-2 text-danger tooltips" data-placement="top" data-toggle="tooltip" data-original-title="Remove Attachment"></i>Remove Attachment</a><?php } ?>
                                                                
                                                            <?php }} ?>
                                                        </td>
                                                    </tr>

                                                    <tr id="efile">
                                                        <th class="text-right">Other Appendices</th>
                                                        <td class="text-left"  style="background: #90bdf9; color:#464545">
                                                            <?php if($staff->oafile != ""){?><a href="<?= base_url(); ?>Pages/pdf_staff/<?= $staff->IDNumber; ?>/oafile/?label=Other Appendices" target="_blank" class="tooltips" data-placement="top" data-toggle="tooltip" data-original-title="View File Attachment"><i  class="fas fa-file-alt btn btn-lg"></i></a><?php } ?>
                                                            <?php if($staff->stat == 0){if($this->session->c_id == $user->user_id){?>
                                                                <a href="#" data-toggle="modal" data-target=".oafile"><i class="fas fa-paperclip fas btn btn-lg tooltips" data-placement="top" data-toggle="tooltip" data-original-title="Attach File"></i></a>
                                                                <?php if($staff->oafile != ""){ ?><a onclick="return confirm('Are you sure?')" href="<?= base_url(); ?>Pages/remove_attachment_staff/<?= $this->uri->segment(3).'/'. $this->uri->segment(4).'/'. $this->uri->segment(5); ?>/oafile" class="btn btn-warning"><i class="mdi mdi-block-helper mr-2 text-danger tooltips" data-placement="top" data-toggle="tooltip" data-original-title="Remove Attachment"></i>Remove Attachment</a><?php } ?>
                                                                
                                                            <?php }} ?>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <th class="text-right">IPCRF for Non-Teaching (Attachments)</th>
                                                        <td class="text-left"  style="background: #90bdf9; color:#464545">
                                                            <?php if($staff->ipcrffile != ""){?><a href="<?= base_url(); ?>Pages/pdf_staff/<?= $staff->IDNumber; ?>/ipcrffile/?label=IPCRF for Non-Teaching (Attachments)" target="_blank" class="tooltips" data-placement="top" data-toggle="tooltip" data-original-title="View File Attachment"><i  class="fas fa-file-alt btn btn-lg"></i></a><?php } ?>
                                                            <?php if($staff->stat == 0){if($this->session->c_id == $user->user_id){?>
                                                                <a href="#" data-toggle="modal" data-target=".ipcrffile"><i class="fas fa-paperclip fas btn btn-lg tooltips" data-placement="top" data-toggle="tooltip" data-original-title="Attach File"></i></a>
                                                                <?php if($staff->ipcrffile != ""){ ?><a onclick="return confirm('Are you sure?')" href="<?= base_url(); ?>Pages/remove_attachment_staff/<?= $this->uri->segment(3).'/'. $this->uri->segment(4).'/'. $this->uri->segment(5); ?>/ipcrffile" class="btn btn-warning"><i class="mdi mdi-block-helper mr-2 text-danger tooltips" data-placement="top" data-toggle="tooltip" data-original-title="Remove Attachment"></i>Remove Attachment</a><?php } ?>
                                                                
                                                            <?php }} ?>
                                                        </td>
                                                    </tr>


                                                    <tr class="bg-warning text-white">
                                                        <th colspan="2" class="text-center" id="efile">EDUCATION (10)<?php if($aa->stat == 0){if($this->session->c_id == $user->user_id){?><a href="#" data-toggle="modal" data-target=".educ"><i class="fas fa-marker btn btn-sm tooltips" data-placement="top" data-toggle="tooltip" data-original-title="Edit"></i></a><?php } } ?> <?php if($this->session->position == 'asds'){?><a href="#" data-toggle="modal" data-target=".educ"><i class="fas fa-marker btn btn-sm tooltips" data-placement="top" data-toggle="tooltip" data-original-title="Edit"><?php } ?></th>
                                                    </tr>

                                                    <?php 
                                                        $educ=array(
                                                            "Bachelors Degree"=> $staff->bd,
                                                            "Date Graduated"=>$staff->dg,
                                                            "Degree Units"=>$staff->du,
                                                            "Degree GWA"=>$staff->dgwa, 	
                                                            "Units Earned"=>$staff->ue,
                                                            "GWA Earned"=>$staff->gwae,
                                                            "Post Graduate"=>$staff->pg,
                                                            "Post Graduate Units"=>$staff->pgu,
                                                            "Junior HS Specialization"=>$staff->jhss, 	
                                                            "Senior HS Specialization"=>$staff->shss,
                                                            "Major"=>$staff->specialization
                                                    );

                                                        foreach($educ as $row=>$rv){
                                                    ?>
                                                    <tr>
                                                        <th class="text-right"><?= $row; ?></th>
                                                        <td class="text-left" style="background: #f7e8bc; color:#464545"><?= $rv; ?></td>
                                                    </tr>
                                                    <?php } ?>
                                                    <tr id="tsc">
                                                        <th class="text-right">Education Files</th>
                                                        <td class="text-left" style="background: #f3d57d; color:#464545">
                                                            <?php if($staff->efile != ""){?><a href="<?= base_url(); ?>Pages/pdf_staff/<?= $staff->IDNumber; ?>/efile/?label=Education Files" target="_blank" class="tooltips" data-placement="top" data-toggle="tooltip" data-original-title="View File Attachment"><i  class="fas fa-file-alt btn btn-lg"></i></a><?php } ?>
                                                            <?php if($staff->stat == 0){if($this->session->c_id == $user->user_id){?>
                                                                <a href="#" data-toggle="modal" data-target=".educfile"><i class="fas fa-paperclip btn btn-lg tooltips" data-placement="top" data-toggle="tooltip" data-original-title="Attach File"></i></a>
                                                                <?php if($staff->efile != ""){ ?><a onclick="return confirm('Are you sure?')" href="<?= base_url(); ?>Pages/remove_attachment_staff/<?= $this->uri->segment(3).'/'. $this->uri->segment(4).'/'. $this->uri->segment(5); ?>/efile" class="btn btn-warning"><i class="mdi mdi-block-helper mr-2 text-danger tooltips" data-placement="top" data-toggle="tooltip" data-original-title="Remove Attachment"></i>Remove Attachment</a><?php } ?>
                                                                
                                                            <?php }} ?>
                                                        </td>
                                                    </tr>
                                                    <?php if(!empty($rating)){?>
                                                    <tr>
                                                        <th class="text-right">Rating</th>
                                                        <td class="text-left" style="background: #fde18e; color:#464545">
                                                          
                                                        <?php if($this->session->position == 'Evaluator' || $this->session->position == 'asds'){?>
                                                            <?php if($rating->eval_id1 == 0){ ?>
                                                                                            
                                                            <?php if($rating->education != 0.00001){echo $rating->education; } ?>
                                                            <a href="#" data-toggle="modal" data-target=".educrating"><i class="mdi mdi-notebook-outline btn btn-lg tooltips <?php if($rating->education != 0.00001){echo 'text-success'; } ?>" data-placement="top" data-toggle="tooltip" data-original-title="Rate"></i></a>
                                                            
                                                        <?php }else{ ?>

                                                            <?php if($rating->eval_id1 == $this->session->id || $this->session->position == 'asds'){if($rating->education != 0.00001){echo $rating->education; }  ?>
                                                            <a href="#" data-toggle="modal" data-target=".educrating"><i class="mdi mdi-notebook-outline btn btn-lg tooltips <?php if($rating->education != 0.00001){echo 'text-success'; } ?>" data-placement="top" data-toggle="tooltip" data-original-title="Rate"></i></a>
                                                            <?php } ?>
                                                            
                                                            <?php } ?>
                                                        
                                                            <?php }else{
                                                           if($rating->education != 0.00001){ ?>
                                                                <?php if($open->status == 0){?>
                                                                    <?= $rating->education; ?>
                                                                <?php }else{?> 
                                                                    <span class="badge badge-info noti-icon-badge">Rated</span>
                                                                <?php } ?>
                                                           <?php }else{ ?>
                                                                <span class="badge badge-purple noti-icon-badge">Not Yet Rated</span>
                                                           <?php } ?>
                                                           
                                                        <?php } ?>


                                                        </td>
                                                    </tr>
                                                    <?php } ?>

                                                    <tr class="bg-info text-white">
                                                        <th colspan="2" class="text-center" id="ept">TRAININGS AND SEMINARS (10) <?php if($data->stat == 0){if($this->session->c_id == $user->user_id){?><a href="#" data-toggle="modal" data-target=".cert"><i class="fas fa-marker btn btn-sm tooltips" data-placement="top" data-toggle="tooltip" data-original-title="Edit"></i></a><?php }} ?></th>
                                                    </tr>

                                                    <?php 
                                                        $educ=array(
                                                            "TESDA Certificates"=>$staff->tc
                                                    );
                                                    ?>

                                                    <tr>
                                                        <th class="text-right">Training/Seminar Certificates</th>
                                                        <td class="text-left" style="background: #9ddcf4; color:#464545">
                                                        <?php if($staff->tscfile != ""){?><a href="<?= base_url(); ?>Pages/pdf_staff/<?= $staff->IDNumber; ?>/tscfile/?label=Training/Seminar Certificates" target="_blank" class="tooltips" data-placement="top" data-toggle="tooltip" data-original-title="View File Attachment"><i  class="fas fa-file-alt btn btn-lg"></i></a><?php } ?>
                                                            <?php if($staff->stat == 0){if($this->session->c_id == $user->user_id){?>
                                                                <a href="#" data-toggle="modal" data-target=".tscfile"><i class="fas fa-paperclip fas btn btn-lg tooltips" data-placement="top" data-toggle="tooltip" data-original-title="Attach File"></i></a>
                                                                <?php if($staff->tscfile != ""){ ?><a onclick="return confirm('Are you sure?')" href="<?= base_url(); ?>Pages/remove_attachment_staff/<?= $this->uri->segment(3).'/'. $this->uri->segment(4).'/'. $this->uri->segment(5); ?>/tscfile" class="btn btn-warning"><i class="mdi mdi-block-helper mr-2 text-danger tooltips" data-placement="top" data-toggle="tooltip" data-original-title="Remove Attachment"></i>Remove Attachment</a><?php } ?>
                                                                
                                                            <?php }} ?>
                                                        </td>
                                                    </tr>

                                                    <?php foreach($educ as $row=>$rv){ ?>
                                                    <tr>
                                                        <th class="text-right"><?= $row; ?></th>
                                                        <td class="text-left" style="background: #9ddcf4; color:#464545"><?= $rv; ?></td>
                                                    </tr>
                                                    <?php } ?>

                                                    <tr>
                                                        <th class="text-right">TESDA Certificates</th>
                                                        <td class="text-left" style="background: #9ddcf4; color:#464545">
                                                            <?php if($staff->tcfile != ""){?><a href="<?= base_url(); ?>Pages/pdf_staff/<?= $staff->IDNumber; ?>/tcfile/?label=Training/TESDA Certificates" target="_blank" class="tooltips" data-placement="top" data-toggle="tooltip" data-original-title="View File Attachment"><i  class="fas fa-file-alt btn btn-lg"></i></a><?php } ?>
                                                            <?php if($staff->stat == 0){if($this->session->c_id == $user->user_id){?>
                                                                <a href="#" data-toggle="modal" data-target=".tcfile"><i class="fas fa-paperclip fas btn btn-lg tooltips" data-placement="top" data-toggle="tooltip" data-original-title="Attach File"></i></a>
                                                                <?php if($staff->tcfile != ""){ ?><a onclick="return confirm('Are you sure?')" href="<?= base_url(); ?>Pages/remove_attachment_staff/<?= $this->uri->segment(3).'/'. $this->uri->segment(4).'/'. $this->uri->segment(5); ?>/tcfile" class="btn btn-warning"><i class="mdi mdi-block-helper mr-2 text-danger tooltips" data-placement="top" data-toggle="tooltip" data-original-title="Remove Attachment"></i>Remove Attachment</a><?php } ?>
                                                                
                                                            <?php }} ?>
                                                        </td>
                                                    </tr>
                                                    <?php if(!empty($rating)){?>
                                                    <tr>
                                                        <th class="text-right">Rating</th>
                                                        <td class="text-left" style="background: #fde18e; color:#464545">
                                                        <?php if($this->session->position == 'Evaluator' || $this->session->position == 'asds'){?>
                                                            <?php if($rating->eval_id1 == 0){ ?>
                                                                                            
                                                            <?php if($rating->training != 0.00001){echo $rating->training; } ?>
                                                            <a href="#" data-toggle="modal" data-target=".lrrating"><i class="mdi mdi-notebook-outline btn btn-lg tooltips <?php if($rating->training != 0.00001){echo 'text-success'; } ?>" data-placement="top" data-toggle="tooltip" data-original-title="Rate"></i></a>
                                                            
                                                        <?php }else{ ?>

                                                            <?php if($rating->eval_id1 == $this->session->id || $this->session->position == 'asds'){if($rating->training != 0.00001){echo $rating->training; }  ?>
                                                            <a href="#" data-toggle="modal" data-target=".certrating"><i class="mdi mdi-notebook-outline btn btn-lg tooltips <?php if($rating->training != 0.00001){echo 'text-success'; } ?>" data-placement="top" data-toggle="tooltip" data-original-title="Rate"></i></a>
                                                            <?php } ?>
                                                            
                                                            <?php } ?>
                                                        
                                                            <?php }else{
                                                           if($rating->training != 0.00001){ ?>
                                                                <?php if($open->status == 0){?>
                                                                    <?= $rating->training; ?>
                                                                <?php }else{?> 
                                                                    <span class="badge badge-info noti-icon-badge">Rated</span>
                                                                <?php } ?>
                                                           <?php }else{ ?>
                                                                <span class="badge badge-purple noti-icon-badge">Not Yet Rated</span>
                                                           <?php } ?>
                                                           
                                                        <?php } ?>
                                                        </td>
                                                    </tr>
                                                    <?php } ?>

                                                    <tr class="bg-danger text-white">
                                                        <th colspan="2" class="text-center" id="lr">WORK EXPERIENCE (10)</th>
                                                    </tr>
                                                    <tr>
                                                        <th class="text-right">Work Experiences (Attachments)</th>
                                                        <td class="text-left"  style="background: #fc9494; color:#464545">
                                                            <?php if($staff->wefile != ""){?><a href="<?= base_url(); ?>Pages/pdf_staff/<?= $staff->IDNumber; ?>/wefile/?label=Work Experiences (Attachments)" target="_blank" class="tooltips" data-placement="top" data-toggle="tooltip" data-original-title="View File Attachment"><i  class="fas fa-file-alt btn btn-lg"></i></a><?php } ?>
                                                            <?php if($staff->stat == 0){if($this->session->c_id == $user->user_id){?>
                                                                <a href="#" data-toggle="modal" data-target=".wefile"><i class="fas fa-paperclip fas btn btn-lg tooltips" data-placement="top" data-toggle="tooltip" data-original-title="Attach File"></i></a>
                                                                <?php if($staff->wefile != ""){ ?><a onclick="return confirm('Are you sure?')" href="<?= base_url(); ?>Pages/remove_attachment_staff/<?= $this->uri->segment(3).'/'. $this->uri->segment(4).'/'. $this->uri->segment(5); ?>/wefile" class="btn btn-warning"><i class="mdi mdi-block-helper mr-2 text-danger tooltips" data-placement="top" data-toggle="tooltip" data-original-title="Remove Attachment"></i>Remove Attachment</a><?php } ?>
                                                                
                                                            <?php }} ?>
                                                        </td>
                                                    </tr>

                                                    <?php if(!empty($rating)){?>
                                                    <tr>
                                                        <th class="text-right">Rating</th>
                                                        <td class="text-left" style="background: #fde18e; color:#464545">

                                                          <?php if($this->session->position == 'Evaluator' || $this->session->position == 'asds'){?>
                                                            <?php if($rating->eval_id1 == 0){ ?>
                                                                                            
                                                            <?php if($rating->experience != 0.00001){echo $rating->experience; } ?>
                                                            <a href="#" data-toggle="modal" data-target=".lrrating"><i class="mdi mdi-notebook-outline btn btn-lg tooltips <?php if($rating->experience != 0.00001){echo 'text-success'; } ?>" data-placement="top" data-toggle="tooltip" data-original-title="Rate"></i></a>
                                                            
                                                        <?php }else{ ?>

                                                            <?php if($rating->eval_id1 == $this->session->id || $this->session->position == 'asds'){if($rating->experience != 0.00001){echo $rating->experience; }  ?>
                                                            <a href="#" data-toggle="modal" data-target=".werating"><i class="mdi mdi-notebook-outline btn btn-lg tooltips <?php if($rating->experience != 0.00001){echo 'text-success'; } ?>" data-placement="top" data-toggle="tooltip" data-original-title="Rate"></i></a>
                                                            <?php } ?>
                                                            
                                                            <?php } ?>
                                                        
                                                            <?php }else{
                                                           if($rating->experience != 0.00001){ ?>
                                                                <?php if($open->status == 0){?>
                                                                    <?= $rating->experience; ?>
                                                                <?php }else{?> 
                                                                    <span class="badge badge-info noti-icon-badge">Rated</span>
                                                                <?php } ?>
                                                           <?php }else{ ?>
                                                                <span class="badge badge-purple noti-icon-badge">Not Yet Rated</span>
                                                           <?php } ?>
                                                           
                                                        <?php } ?>
                                                          
                                                        </td>
                                                    </tr>
                                                    <?php } ?>

                                                    <tr class="bg-purple text-white">
                                                        <th colspan="2" class="text-center">LET RATING (10) <?php if($aa->stat == 0){if($this->session->c_id == $user->user_id){?><a href="#" data-toggle="modal" data-target=".lr"><i class="fas fa-marker btn btn-sm tooltips" data-placement="top" data-toggle="tooltip" data-original-title="Edit"></i></a><?php }} ?></th>
                                                    </tr>

                                                    <?php 
                                                        $educ=array(
                                                            "LET Rating"=> $staff->lr        
                                                    );

                                                        foreach($educ as $row=>$rv){
                                                    ?>
                                                    <tr>
                                                        <th class="text-right"><?= $row; ?></th>
                                                        <td class="text-left" style="background: #bbb7eb; color:#464545"><?= $rv; ?></td>
                                                    </tr>
                                                    <?php } ?>
                                                    <tr>
                                                        <th class="text-right">LET (Attachment)</th>
                                                        <td class="text-left" style="background: #bbb7eb; color:#464545">
                                                            <?php if($staff->letfile != ""){?><a href="<?= base_url(); ?>Pages/pdf_staff/<?= $staff->IDNumber; ?>/letfile/?label=LET (Attachment)" target="_blank" class="tooltips" data-placement="top" data-toggle="tooltip" data-original-title="View File Attachment"><i  class="fas fa-file-alt btn btn-lg"></i></a><?php } ?>
                                                            <?php if($staff->stat == 0){if($this->session->c_id == $user->user_id){?>
                                                                <a href="#" data-toggle="modal" data-target=".letfile"><i class="fas fa-paperclip fas btn btn-lg tooltips" data-placement="top" data-toggle="tooltip" data-original-title="Attach File"></i></a>
                                                                <?php if($staff->letfile != ""){ ?><a onclick="return confirm('Are you sure?')" href="<?= base_url(); ?>Pages/remove_attachment_staff/<?= $this->uri->segment(3).'/'. $this->uri->segment(4).'/'. $this->uri->segment(5); ?>/letfile" class="btn btn-warning"><i class="mdi mdi-block-helper mr-2 text-danger tooltips" data-placement="top" data-toggle="tooltip" data-original-title="Remove Attachment"></i>Remove Attachment</a><?php } ?>
                                                                
                                                            <?php }} ?>
                                                        </td>
                                                    </tr>
                                                    <?php if(!empty($rating)){?>
                                                    <tr>
                                                        <th class="text-right">Rating </th>
                                                        <td class="text-left" style="background: #fde18e; color:#464545">
                                                          <?php if($this->session->position == 'Evaluator' || $this->session->position == 'asds'){?>
                                                            <?php if($rating->eval_id1 == 0){ ?>

                                                            <?php if($rating->let_rating != 0.00001){echo $rating->let_rating; } ?>
                                                            <a href="#" data-toggle="modal" data-target=".lrrating"><i class="mdi mdi-notebook-outline btn btn-lg tooltips <?php if($rating->let_rating != 0.00001){echo 'text-success'; } ?>" data-placement="top" data-toggle="tooltip" data-original-title="Rate"></i></a>
                                                            
                                                        <?php }else{ ?>

                                                            <?php if($rating->eval_id1 == $this->session->id || $this->session->position == 'asds'){if($rating->let_rating != 0.00001){echo $rating->let_rating; } ?>
                                                            <a href="#" data-toggle="modal" data-target=".lrrating"><i class="mdi mdi-notebook-outline btn btn-lg tooltips <?php if($rating->let_rating != 0.00001){echo 'text-success'; } ?>" data-placement="top" data-toggle="tooltip" data-original-title="Rate"></i></a>
                                                            <?php } ?>
                                                            
                                                            <?php } ?>
                                                        
                                                        <?php }else{
                                                           if($rating->let_rating != 0.00001){ ?>
                                                                <?php if($open->status == 0){?>
                                                                    <?= $rating->let_rating; ?>
                                                                <?php }else{?> 
                                                                    <span class="badge badge-info noti-icon-badge">Rated</span>
                                                                <?php } ?>
                                                           <?php }else{ ?>
                                                                <span class="badge badge-purple noti-icon-badge">Not Yet Rated</span>
                                                           <?php } ?>
                                                           
                                                        <?php } ?>
                                                        </td>
                                                    </tr>
                                                    <?php } ?>
                         
                                                    <?php if($this->session->position == '0'){?>
                                                    <tr class="bg-warning text-white">
                                                        <th colspan="2" class="text-center" id="history">APPLICATION HISTORY</th>
                                                    </tr>

                                                    <?php
                                                        foreach($history as $row){
                                                        $jv = $this->Common->one_cond_row('hris_jobvacancy', 'jobID',$row->jobID);
                                                        $s = $this->Common->one_cond_row('schools', 'schoolID',$row->pre_school);
                                                    ?>
                                                    <tr>
                                                        <td class="text-right">Position Applied</td>
                                                        <td class="text-left"  style="background: #f7e8bc; color:#464545">
                                                            <span style="display:inline-block; width:70%"><?= $jv->jobTitle; ?> </span>
                                                            <a href="#" class="btn btn-success btn-sm">Status</a>
                                                            <a href="#" class="btn btn-primary btn-sm">Rating</a>
                                                        </td>
                                                      
                                                    </tr>
                                                    <?php } }?>



                                                    <?php if(!empty($rating)){ ?>
                                                    <tr class="bg-info text-white">
                                                        <th colspan="2" class="text-center" id="history">DEMO AND TEACHERS REFLECTION RATINGS</th>
                                                    </tr>

                                                    <tr>
                                                        <th class="text-right">Teachers Reflection</th>
                                                        <td class="text-left" style="background: #9ddcf4; color:#464545">
                                                        <!-- <?php if($this->session->position == 'asds'){ ?><?= ($rating->tr_rating != 0.00001) ? $rating->tr_rating : '' ; ?><?php } ?> -->
                                                        <?php
                                                        if(!empty($rating)){
                                                            if($rating->tr_rating != 0.00001){ ?>
                                                                <?php if($open->status == 0){?>
                                                                    <?= $rating->tr_rating; ?>
                                                                <?php }else{?> 
                                                                    <span class="badge badge-info noti-icon-badge">Rated</span>
                                                                <?php } ?>
                                                        <?php }else{ ?>
                                                                <span class="badge badge-purple noti-icon-badge">Not Yet Rated</span>
                                                        <?php } } ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th class="text-right">DEMO</th>
                                                        <td class="text-left" style="background: #9ddcf4; color:#464545">
                                                        <!-- <?php if($this->session->position == 'asds'){ ?><?= ($rating->demo_rating != 0.00001) ? $rating->demo_rating : '' ; ?><?php } ?> -->
                                                        <?php
                                                            if(!empty($rating)){
                                                            if($rating->demo_rating != 0.00001){ ?>
                                                                <?php if($open->status == 0){?>
                                                                    <?= $rating->demo_rating; ?>
                                                                <?php }else{?> 
                                                                    <span class="badge badge-info noti-icon-badge">Rated</span>
                                                                <?php } ?>
                                                        <?php }else{ ?>
                                                                <span class="badge badge-purple noti-icon-badge">Not Yet Rated</span>
                                                        <?php }} ?>
                                                        </td>
                                                    </tr>
                                                                
                                                  <?php } ?>


                                                    <?php if($this->session->position != "reg"){ ?>

                                                    <tr class="bg-primary text-white">
                                                        <th colspan="2" class="text-center" id="history">ACTION</th>
                                                    </tr>

                                                    <tr>
                                                        <th class="text-right"></th>
                                                        <td style="background: #ceeffb;">
                                                            
                                                                <?php if($this->session->position != "District"){ ?>

                                                                    <?php if($aa->appStatus == "Application Submitted"){ ?>
                                                                        <?php 
                                                                            $settings = $this->Page_model->get_single_row_by_id('settings', 'id', 6);
                                                                            if($settings->status == 0){
                                                                        ?>
                                                                        
                                                                        <a class="btn btn-success btn-sm" href="<?= base_url(); ?>Pages/validated/<?= $this->uri->segment(3); ?>/<?= $this->uri->segment(4); ?>/<?= $data->record_no; ?>/<?= $aa->appID; ?>" onclick="return confirm('By clicking OK button, you certify that you have validated the submitted documents in the system against the documents presented by the applicants.')">Validate</a>
                                                                        
                                                                        <?php } ?>
                                                                        <?php }else{ ?>
                                                                        <?php if($this->session->position == 'School'){?>
                                                                        <a class="btn btn-warning btn-sm" href="<?= base_url(); ?>Pages/undo_validated/<?= $this->uri->segment(3); ?>/<?= $this->uri->segment(4); ?>/<?= $data->record_no; ?>/<?= $aa->appID; ?>" onclick="return confirm('Are you sure?')">Undo Validation</a>
                                                                        <?php } ?>
                                                                    <?php } ?>
                                                                <?php } ?>


                                                                   
                                                                <?php if($this->session->position === 'Human Resource Admin' || $this->session->position === 'HR Staff' || $this->session->position === 'Super Admin' || $this->session->position === 'asds'){?>
                                                                    <!-- <?php if($aa->appStatus == "Validated"){ ?><a class="btn btn-warning btn-sm" href="<?= base_url(); ?>Pages/efr/<?= $this->uri->segment(3); ?>/<?= $this->uri->segment(4); ?>">Endorse for Rating</a><?php } ?> -->
                                                           
                                                                    <?php if($aa->appStatus == "Endorsed for Rating"){ ?><a onclick="return confirm('Are you sure?')" class="btn btn-purple btn-sm" href="<?= base_url(); ?>Pages/rated/<?= $this->uri->segment(3); ?>/<?= $this->uri->segment(4); ?>/<?= $this->uri->segment(5); ?>/<?= $this->uri->segment(6); ?>/<?= $this->uri->segment(2); ?>/<?= $this->uri->segment(2); ?>">Rated</a><?php } ?>
                                                                <?php }elseif($this->session->position === 'Evaluator'){ ?>
                                                                    <?php if($this->session->eg == 1){?>
                                                                    <?php if($aa->appStatus == "Endorsed for Rating"){ ?><a onclick="return confirm('Are you sure?')" class="btn btn-purple btn-sm" href="<?= base_url(); ?>Pages/rated/<?= $this->uri->segment(3); ?>/<?= $this->uri->segment(4); ?>/<?= $this->uri->segment(5); ?>/<?= $this->uri->segment(6); ?>/<?= $this->uri->segment(2); ?>/<?= $this->uri->segment(2); ?>">Rated</a><?php } ?>
                                                                <?php }} ?>

                                                                <?php if($this->session->position==='Human Resource Admin' || $this->session->position==='HR Staff' || $this->session->position==='Super Admin' || $this->session->position==='asds' || $this->session->position==='doceval') { ?>
                                                                <?php if($aa->appStatus == "Validated" && $aa->dq == 0){ ?>
                                                                    <a href="#"  data-toggle="modal" data-target=".dq" class="btn btn-info btn-sm">Remarks</a>
                                                                <?php } } ?>

                                                                <?php if($this->session->position==='asds' || $this->session->username==='Cyanne19') { ?>
                                                                <?php if($aa->dq != 0){ ?>
                                                                    <a href="#"  data-toggle="modal" data-target=".dqedit" class="btn btn-info btn-sm">Edit Remarks</a>
                                                                    <?php 
                                                                        $ren = $this->Common->two_cond_count_row('hris_applications_rating', 'appID', $this->uri->segment(6),'record_no',$data->record_no); 
                                                                        if($ren->num_rows() == 0){
                                                                    ?>
                                                                    <a href="<?= base_url(); ?>pages/ir/<?= $job->job_type; ?>/<?= $job->sy; ?>/<?= $data->record_no; ?>/<?= $this->uri->segment(6); ?>/<?= $this->uri->segment(5); ?>/<?= $aa->jobID; ?>/<?= $this->uri->segment(3); ?>/<?= $this->uri->segment(6); ?>"  class="btn btn-primary btn-sm">Insert Rating</a>
                                                                    <?php } ?>
                                                                <?php } }  ?>


                                                                


                                                                <?php if($this->session->position == "reg"){ ?>
                                                                    <?php if($aa->appStatus == "Rated"){ ?><a class="btn btn-info btn-sm" href="<?= base_url(); ?>Pages/confirmation/<?= $this->uri->segment(3); ?>/<?= $this->uri->segment(4); ?>">Confirmation</a><?php } ?>
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

                            
                        </div>
                        <!--- end row -->


                    </div>
                    <!-- end container-fluid -->

                </div>
                <!-- end content -->


                                        <!--  Modal content for the above example -->
                                        <div class="modal fade educ" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" style="display: none;" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-warning">
                                                        <h5 class="modal-title" id="myLargeModalLabel">Update Education</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                    </div>
                                                    <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="card">
                                                                <div class="card-body">

                                                                    <form class="parsley-examples" action="<?= base_url(); ?>pages/update_educ_staff" method="post">
                                                                    <input type="hidden" name="id" value="<?= $staff->IDNumber; ?>">
                                                                    <input type="hidden" name="empEmail" value="<?= $data->empEmail; ?>">
                                                                    <input type="hidden" name="jobID" value="<?= $this->uri->segment(4); ?>">
                                                                    <input type="hidden" name="school_id" value="<?= $this->uri->segment(5); ?>">
                                                                        
                                                                    <div class="row">
                                                                        <div class="col-lg-8">
                                                                                <div class="form-group">
                                                                                    <label>Bachelors Degree</label>
                                                                                    <input type="text" class="form-control" name="bd"  value="<?= $staff->bd; ?>" >
                                                                                </div>	
                                                                        </div>	
                                                                        <div class="col-lg-4">
                                                                                <div class="form-group">
                                                                                    <label>Date Graduated</label>
                                                                                    <input type="date" class="form-control" name="dg"  value="<?= $staff->dg; ?>" >
                                                                                </div>	
                                                                        </div>
                                                                        
                                                                    </div>	

                                                                    <div class="row">
                                                                        <div class="col-lg-4">
                                                                                <div class="form-group">
                                                                                    <label>Degree Units</label>
                                                                                    <input type="text" class="form-control" name="du"  value="<?= $staff->du; ?>" >
                                                                                </div>	
                                                                        </div>	
                                                                        <div class="col-lg-4">
                                                                                <div class="form-group">
                                                                                    <label>Degree GWA</label>
                                                                                    <input type="text" class="form-control" name="dgwa"  value="<?= $staff->dgwa; ?>" >
                                                                                </div>	
                                                                        </div>
                                                                        <div class="col-lg-4">
                                                                                <div class="form-group">
                                                                                    <label>Units Earned</label>
                                                                                    <input type="text" class="form-control" name="ue"  value="<?= $staff->ue; ?>" >
                                                                                </div>	
                                                                        </div>
                                                                        
                                                                    </div>	

                                                                    <div class="row">
                                                                        	
                                                                        <div class="col-lg-4">
                                                                                <div class="form-group">
                                                                                    <label>GWA Earned</label>
                                                                                    <input type="text" class="form-control" name="gwae"  value="<?= $staff->gwae; ?>" >
                                                                                </div>	
                                                                        </div>
                                                                        <div class="col-lg-4">
                                                                                <div class="form-group">
                                                                                    <label>Post Graduate</label>
                                                                                    <input type="text" class="form-control" name="pg"  value="<?= $staff->pg; ?>" >
                                                                                </div>	
                                                                        </div>
                                                                        <div class="col-lg-4">
                                                                                <div class="form-group">
                                                                                    <label>Major</label>
                                                                                    <input type="text" class="form-control" name="s"  value="<?= $staff->specialization; ?>" >
                                                                                </div>	
                                                                        </div>
                                                                        
                                                                    </div>
                                                                    
                                                                    <div class="row">

                                                                    <div class="col-lg-4">
                                                                                <div class="form-group">
                                                                                    <label>Post Graduate Units</label>
                                                                                    <input type="text" class="form-control" name="pgu"  value="<?= $staff->pgu; ?>" >
                                                                                </div>	
                                                                        </div>
                                                                        	
                                                                        <div class="col-lg-4">
                                                                                <div class="form-group">
                                                                                    <label>Junior HS Specialization</label>
                                                                                    <input type="text" class="form-control" name="jhss"  value="<?= $staff->jhss; ?>" >
                                                                                </div>	
                                                                        </div>
                                                                        <div class="col-lg-4">
                                                                                <div class="form-group">
                                                                                    <label>Senior HS Specialization</label>
                                                                                    <input type="text" class="form-control" name="shss"  value="<?= $staff->shss; ?>" >
                                                                                </div>	
                                                                        </div>
                                                                        
                                                                    </div>
                                                                        
                                                                        
                                                                        

                                                                        <div class="form-group text-right mb-0">
                                                                            <button class="btn btn-warning waves-effect waves-light mr-1" type="submit">
                                                                                Submit
                                                                            </button>
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


                                        <!--  Modal content for the above example -->
                                        <div class="modal fade ai" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" style="display: none;" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-primary">
                                                        <h5 class="modal-title" id="myLargeModalLabel">Update Applicants Information</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                    </div>
                                                    <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="card">
                                                                <div class="card-body">

                                                                    <form class="parsley-examples" action="<?= base_url(); ?>pages/update_ai_staff" method="post">
                                                                    <input type="hidden" name="id" value="<?= $this->uri->segment(3); ?>">
                                                                    <input type="hidden" name="jobID" value="<?= $this->uri->segment(4); ?>">
                                                                    <input type="hidden" name="school_id" value="<?= $this->uri->segment(5); ?>">
                                                                        
                                                                    <div class="row">
                                                                        <div class="col-lg-4">
                                                                                <div class="form-group">
                                                                                    <label>First Name</label>
                                                                                    <input type="text" class="form-control" name="FirstName"  value="<?= $staff->FirstName; ?>" required>
                                                                                </div>	
                                                                        </div>	
                                                                        <div class="col-lg-3">
                                                                                <div class="form-group">
                                                                                    <label>Middle Name</label>
                                                                                    <input type="text" class="form-control" name="MiddleName"  value="<?= $staff->MiddleName; ?>" >
                                                                                </div>	
                                                                        </div>
                                                                        <div class="col-lg-3">
                                                                                <div class="form-group">
                                                                                    <label>Last Name</label>
                                                                                    <input type="text" class="form-control" name="LastName"  value="<?= $staff->LastName; ?>" required>
                                                                                </div>	
                                                                        </div>
                                                                        <div class="col-lg-2">
                                                                                <div class="form-group">
                                                                                    <label>Name Extn.</label>
                                                                                    <input type="text" class="form-control" name="NameExtn"  value="<?= $staff->NameExtn; ?>" >
                                                                                </div>	
                                                                        </div>
                                                                        
                                                                    </div>
                                                                    
                                                                    <div class="row">
                                                                        <div class="col-lg-4">
                                                                                <div class="form-group">
                                                                                    <label>Village</label>
                                                                                    <input type="text" class="form-control" name="resVillage"  value="<?= $staff->resVillage; ?>" >
                                                                                </div>	
                                                                        </div>	
                                                                        <div class="col-lg-4">
                                                                                <div class="form-group">
                                                                                    <label>Barangay</label>
                                                                                    <input type="text" class="form-control" name="resBarangay"  value="<?= $staff->resBarangay ; ?>" >
                                                                                </div>	
                                                                        </div>

                                                                        <div class="col-lg-4">
                                                                                <div class="form-group">
                                                                                    <label>City / Municipality</label>
                                                                                    <input type="text" class="form-control" name="resCity"  value="<?= $staff->resCity; ?>" >
                                                                                </div>	
                                                                        </div>
                                                                        
                                                                    </div>

                                                                    <div class="row">
                                                                        	
                                                                        <div class="col-lg-4">
                                                                                <div class="form-group">
                                                                                    <label>Province</label>
                                                                                    <input type="text" class="form-control" name="resProvince"  value="<?= $staff->resProvince; ?>" >
                                                                                </div>	
                                                                        </div>

                                                                        <div class="col-lg-4">
                                                                                <div class="form-group">
                                                                                    <label>Sex</label>
                                                                                    <select class="form-control" name="Sex" required>
                                                                                    <option <?php if($staff->Sex == "M"){echo "selected";} ?> value="M">Male</option>
                                                                                    <option <?php if($staff->Sex == "F"){echo "selected";} ?> value="F">Female</option>
                                                                                </select>
                                                                                </div>	
                                                                        </div>	
                                                                        <div class="col-lg-4">
                                                                                <div class="form-group">
                                                                                    <label>Contact</label>
                                                                                    <input type="text" class="form-control" name="contactNo"  value="<?= $staff->contactNo; ?>" >
                                                                                </div>	
                                                                        </div>
                                                                        
                                                                    </div>


                              
                                                                    
                                                                        <div class="form-group text-right mb-0">
                                                                            <button class="btn btn-primary waves-effect waves-light mr-1" type="submit">
                                                                                Submit
                                                                            </button>
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

                                        <!--  Modal content for the above example -->
                                        <div id="myModal" class="modal fade lr" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-purple">
                                                        <h5 class="modal-title text-white" id="myLargeModalLabel">Update LET Rating</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                    </div>
                                                    <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="card">
                                                                <div class="card-body">

                                                                    <form class="parsley-examples" action="<?= base_url(); ?>pages/update_lr_staff" method="post">
                                                                    <input type="hidden" name="id" value="<?= $staff->IDNumber; ?>">
                                                                    <input type="hidden" name="empEmail" value="<?= $data->empEmail; ?>">
                                                                    <input type="hidden" name="jobID" value="<?= $this->uri->segment(4); ?>">
                                                                    <input type="hidden" name="school_id" value="<?= $this->uri->segment(5); ?>">
                                                                        
                                                                    <div class="row">
                                                                        <div class="col-lg-12">
                                                                                <div class="form-group">
                                                                                    <label>LET Rating</label>
                                                                                    <input type="text" class="form-control" name="lr"  value="<?= $staff->lr; ?>" >
                                                                                </div>	
                                                                        </div>	
                                                                        
                                                                    </div>
                                                                    

                              
                                                                    
                                                                        <div class="form-group text-right mb-0">
                                                                            <button class="btn btn-purple waves-effect waves-light mr-1" type="submit">
                                                                                Submit
                                                                            </button>
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

                                        <!--  Modal content for the above example -->
                                        <div id="myModal" class="modal fade cert" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-info">
                                                        <h5 class="modal-title" id="myLargeModalLabel">Certificates</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                    </div>
                                                    <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="card">
                                                                <div class="card-body">

                                                                    <form class="parsley-examples" action="<?= base_url(); ?>pages/update_tc_staff" method="post">
                                                                    <input type="hidden" name="id" value="<?= $staff->IDNumber; ?>">
                                                                    <input type="hidden" name="empEmail" value="<?= $data->empEmail; ?>">
                                                                    <input type="hidden" name="jobID" value="<?= $this->uri->segment(4); ?>">
                                                                    <input type="hidden" name="school_id" value="<?= $this->uri->segment(5); ?>">
                                                                        
                                                                    <div class="row">
                                                                        <div class="col-lg-12">
                                                                                <div class="form-group">
                                                                                    <label>TESDA Certificates</label>
                                                                                    <input type="text" class="form-control" name="tc"  value="<?= $staff->tc; ?>" >
                                                                                </div>	
                                                                        </div>	
                                                                        
                                                                    </div>
                                                                    

                              
                                                                    
                                                                        <div class="form-group text-right mb-0">
                                                                            <button class="btn btn-info waves-effect waves-light mr-1" type="submit">
                                                                                Submit
                                                                            </button>
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


                                        <!--  Modal content for the above example -->
                                        <div id="myModal" class="modal fade ept" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-success">
                                                        <h5 class="modal-title" id="myLargeModalLabel">Update EPT and other APPENDICES</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                    </div>
                                                    <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="card">
                                                                <div class="card-body">

                                                                    <form class="parsley-examples" action="<?= base_url(); ?>pages/update_ept" method="post">
                                                                    <input type="hidden" name="id" value="<?= $data->id; ?>">
                                                                    <input type="hidden" name="empEmail" value="<?= $data->empEmail; ?>">
                                                                    <input type="hidden" name="jobID" value="<?= $this->uri->segment(4); ?>">
                                                                    <input type="hidden" name="school_id" value="<?= $this->uri->segment(5); ?>">
                                                                        
                                                                    <div class="row">
                                                                        <div class="col-lg-12">
                                                                                <div class="form-group">
                                                                                    <label>Do you have English Proficiency Test?</label>
                                                                                    <input type="text" class="form-control" name="ept"  value="<?= $data->ept; ?>" >
                                                                                </div>	
                                                                        </div>	
                                                                        
                                                                    </div>

                                                                    <div class="row">
                                                                        <div class="col-lg-12">
                                                                                <div class="form-group">
                                                                                    <label>EPT Rating</label>
                                                                                    <input type="text" class="form-control" name="eptr"  value="<?= $data->eptr; ?>" >
                                                                                </div>	
                                                                        </div>	
                                                                        
                                                                    </div>
                                                                    

                              
                                                                    
                                                                        <div class="form-group text-right mb-0">
                                                                            <button class="btn btn-success waves-effect waves-light mr-1" type="submit">
                                                                                Submit
                                                                            </button>
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


                                        <!--  Modal content for the above example -->
                                        <div id="myModal" class="modal fade educfile" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-warning">
                                                        <h5 class="modal-title text-white" id="myLargeModalLabel">Education Files</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                    </div>
                                                    <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="card">
                                                                <div class="card-body">

                                                                <?php 
                                                                    $attributes = array('class' => 'parsley-examples');
                                                                    echo form_open_multipart('pages/update_efile_staff', $attributes);
                                                                ?>
                                                                    <input type="hidden" name="id" value="<?= $staff->IDNumber; ?>">
                                                                    <input type="hidden" name="empEmail" value="<?= $data->empEmail; ?>">
                                                                    <input type="hidden" name="jobID" value="<?= $this->uri->segment(4); ?>">
                                                                    <input type="hidden" name="school_id" value="<?= $this->uri->segment(5); ?>">
                                                                    
                                                                    
                                                                    <div class="form-group row">
                                                                        <label for="hori-pass1" class="col-md-4 col-form-label">Select PDF File<span class="text-danger">*</span></label>
                                                                        <div class="col-md-7">
                                                                            <input id="myInput" type="file"  name="file"  required class="form-control">
                                                                        </div>
                                                                    </div>

                                                                
                                                                    
                                                                    <div class="form-group row mb-0">
                                                                        <div class="col-md-8 offset-md-4">
                                                                            <button type="submit" class="btn btn-warning waves-effect waves-light mr-1">
                                                                                Submit
                                                                            </button>
                                                                        </div>
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

                                        <!--  Modal content for the above example -->
                                        <div id="myModal" class="modal fade wefile" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-danger">
                                                        <h5 class="modal-title text-white" id="myLargeModalLabel">Work Experiences File</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                    </div>
                                                    <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="card">
                                                                <div class="card-body">

                                                                <?php 
                                                                    $attributes = array('class' => 'parsley-examples');
                                                                    echo form_open_multipart('pages/update_wefile_staff', $attributes);
                                                                ?>
                                                                    <input type="hidden" name="id" value="<?= $staff->IDNumber; ?>">
                                                                    <input type="hidden" name="empEmail" value="<?= $data->empEmail; ?>">
                                                                    <input type="hidden" name="jobID" value="<?= $this->uri->segment(4); ?>">
                                                                    <input type="hidden" name="school_id" value="<?= $this->uri->segment(5); ?>">
                                                                    
                                                                    
                                                                    <div class="form-group row">
                                                                        <label for="hori-pass1" class="col-md-4 col-form-label">Select PDF File<span class="text-danger">*</span></label>
                                                                        <div class="col-md-7">
                                                                            <input id="myInput" type="file"  name="file"  required class="form-control">
                                                                        </div>
                                                                    </div>

                                                                
                                                                    
                                                                    <div class="form-group row mb-0">
                                                                        <div class="col-md-8 offset-md-4">
                                                                            <button type="submit" class="btn btn-danger waves-effect waves-light mr-1">
                                                                                Submit
                                                                            </button>
                                                                        </div>
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

                                        <!--  Modal content for the above example -->
                                        <div id="myModal" class="modal fade letfile" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-purple">
                                                        <h5 class="modal-title text-white" id="myLargeModalLabel">LET (Attachment) File</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                    </div>
                                                    <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="card">
                                                                <div class="card-body">

                                                                <?php 
                                                                    $attributes = array('class' => 'parsley-examples');
                                                                    echo form_open_multipart('pages/update_letfile_staff', $attributes);
                                                                ?>
                                                                    <input type="hidden" name="id" value="<?= $staff->IDNumber; ?>">
                                                                    <input type="hidden" name="empEmail" value="<?= $data->empEmail; ?>">
                                                                    <input type="hidden" name="jobID" value="<?= $this->uri->segment(4); ?>">
                                                                    <input type="hidden" name="school_id" value="<?= $this->uri->segment(5); ?>">
                                                                    
                                                                    
                                                                    <div class="form-group row">
                                                                        <label for="hori-pass1" class="col-md-4 col-form-label">Select PDF File<span class="text-danger">*</span></label>
                                                                        <div class="col-md-7">
                                                                            <input id="myInput" type="file"  name="file"  required class="form-control">
                                                                        </div>
                                                                    </div>

                                                                
                                                                    
                                                                    <div class="form-group row mb-0">
                                                                        <div class="col-md-8 offset-md-4">
                                                                            <button type="submit" class="btn btn-purple waves-effect waves-light mr-1">
                                                                                Submit
                                                                            </button>
                                                                        </div>
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

                                        <!--  Modal content for the above example -->
                                        <div id="myModal" class="modal fade tscfile" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="myLargeModalLabel">Training/Seminar Certificates File</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                    </div>
                                                    <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="card">
                                                                <div class="card-body">

                                                                <?php 
                                                                    $attributes = array('class' => 'parsley-examples');
                                                                    echo form_open_multipart('pages/update_tscfile_staff', $attributes);
                                                                ?>
                                                                    <input type="hidden" name="id" value="<?= $staff->IDNumber; ?>">
                                                                    <input type="hidden" name="empEmail" value="<?= $data->empEmail; ?>">
                                                                    <input type="hidden" name="jobID" value="<?= $this->uri->segment(4); ?>">
                                                                    <input type="hidden" name="school_id" value="<?= $this->uri->segment(5); ?>">
                                                                    
                                                                    
                                                                    <div class="form-group row">
                                                                        <label for="hori-pass1" class="col-md-4 col-form-label">Select PDF File<span class="text-danger">*</span></label>
                                                                        <div class="col-md-7">
                                                                            <input id="myInput" type="file"  name="file"  required class="form-control">
                                                                        </div>
                                                                    </div>

                                                                
                                                                    
                                                                    <div class="form-group row mb-0">
                                                                        <div class="col-md-8 offset-md-4">
                                                                            <button type="submit" class="btn btn-primary waves-effect waves-light mr-1">
                                                                                Submit
                                                                            </button>
                                                                        </div>
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

                                        <!--  Modal content for the above example -->
                                        <div id="myModal" class="modal fade tcfile" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="myLargeModalLabel">Tesda Cert. (Attachments) File</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                    </div>
                                                    <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="card">
                                                                <div class="card-body">

                                                                <?php 
                                                                    $attributes = array('class' => 'parsley-examples');
                                                                    echo form_open_multipart('pages/update_tcfile_staff', $attributes);
                                                                ?>
                                                                    <input type="hidden" name="id" value="<?= $staff->IDNumber; ?>">
                                                                    <input type="hidden" name="empEmail" value="<?= $data->empEmail; ?>">
                                                                    <input type="hidden" name="jobID" value="<?= $this->uri->segment(4); ?>">
                                                                    <input type="hidden" name="school_id" value="<?= $this->uri->segment(5); ?>">
                                                                    
                                                                    
                                                                    <div class="form-group row">
                                                                        <label for="hori-pass1" class="col-md-4 col-form-label">Select PDF File<span class="text-danger">*</span></label>
                                                                        <div class="col-md-7">
                                                                            <input id="myInput" type="file"  name="file"  required class="form-control">
                                                                        </div>
                                                                    </div>

                                                                
                                                                    
                                                                    <div class="form-group row mb-0">
                                                                        <div class="col-md-8 offset-md-4">
                                                                            <button type="submit" class="btn btn-primary waves-effect waves-light mr-1">
                                                                                Submit
                                                                            </button>
                                                                        </div>
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

                                        <!--  Modal content for the above example -->
                                        <div id="myModal" class="modal fade omni" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-success">
                                                        <h5 class="modal-title text-white" id="myLargeModalLabel">OMNIBUS SWORN STATEMENT</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                    </div>
                                                    <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="card">
                                                                <div class="card-body">

                                                                <?php 
                                                                    $attributes = array('class' => 'parsley-examples');
                                                                    echo form_open_multipart('pages/update_omni_staff', $attributes);
                                                                ?>
                                                                    <input type="hidden" name="id" value="<?= $staff->IDNumber; ?>">
                                                                    
                                                                    <input type="hidden" name="empEmail" value="<?= $staff->empEmail; ?>">
                                                                    <input type="hidden" name="jobID" value="<?= $this->uri->segment(4); ?>">
                                                                    <input type="hidden" name="school_id" value="<?= $this->uri->segment(5); ?>">
                                                                    
                                                                    
                                                                    <div class="form-group row">
                                                                        <label for="hori-pass1" class="col-md-4 col-form-label">Select PDF File<span class="text-danger">*</span></label>
                                                                        <div class="col-md-7">
                                                                            <input id="myInput" type="file"  name="file"  required class="form-control">
                                                                        </div>
                                                                    </div>

                                                                
                                                                    
                                                                    <div class="form-group row mb-0">
                                                                        <div class="col-md-8 offset-md-4">
                                                                            <button type="submit" class="btn btn-success waves-effect waves-light mr-1">
                                                                                Submit
                                                                            </button>
                                                                        </div>
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

                                        <!--  Modal content for the above example -->
                                        <div id="myModal" class="modal fade apfile" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-success">
                                                        <h5 class="modal-title text-white" id="myLargeModalLabel">LETTER OF INTENT</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                    </div>
                                                    <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="card">
                                                                <div class="card-body">

                                                                <?php 
                                                                    $attributes = array('class' => 'parsley-examples');
                                                                    echo form_open_multipart('pages/update_apfile_staff', $attributes);
                                                                ?>
                                                                    <input type="hidden" name="id" value="<?= $staff->IDNumber; ?>">
                                                                    <input type="hidden" name="empEmail" value="<?= $data->empEmail; ?>">
                                                                    <input type="hidden" name="jobID" value="<?= $this->uri->segment(4); ?>">
                                                                    <input type="hidden" name="school_id" value="<?= $this->uri->segment(5); ?>">
                                                                    
                                                                    
                                                                    <div class="form-group row">
                                                                        <label for="hori-pass1" class="col-md-4 col-form-label">Select PDF File<span class="text-danger">*</span></label>
                                                                        <div class="col-md-7">
                                                                            <input id="myInput" type="file"  name="file"  required class="form-control">
                                                                        </div>
                                                                    </div>

                                                                
                                                                    
                                                                    <div class="form-group row mb-0">
                                                                        <div class="col-md-8 offset-md-4">
                                                                            <button type="submit" class="btn btn-success waves-effect waves-light mr-1">
                                                                                Submit
                                                                            </button>
                                                                        </div>
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

                                        <!--  Modal content for the above example -->
                                        <div id="myModal" class="modal fade voters" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-success">
                                                        <h5 class="modal-title text-white" id="myLargeModalLabel">VOTER'S ID/CERTIFICATE</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                    </div>
                                                    <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="card">
                                                                <div class="card-body">

                                                                <?php 
                                                                    $attributes = array('class' => 'parsley-examples');
                                                                    echo form_open_multipart('pages/update_voters_staff', $attributes);
                                                                ?>
                                                                    <input type="hidden" name="id" value="<?= $staff->IDNumber; ?>">
                                                                    <input type="hidden" name="empEmail" value="<?= $data->empEmail; ?>">
                                                                    <input type="hidden" name="jobID" value="<?= $this->uri->segment(4); ?>">
                                                                    <input type="hidden" name="school_id" value="<?= $this->uri->segment(5); ?>">
                                                                    
                                                                    
                                                                    <div class="form-group row">
                                                                        <label for="hori-pass1" class="col-md-4 col-form-label">Select PDF File<span class="text-danger">*</span></label>
                                                                        <div class="col-md-7">
                                                                            <input id="myInput" type="file"  name="file"  required class="form-control">
                                                                        </div>
                                                                    </div>

                                                                
                                                                    
                                                                    <div class="form-group row mb-0">
                                                                        <div class="col-md-8 offset-md-4">
                                                                            <button type="submit" class="btn btn-success waves-effect waves-light mr-1">
                                                                                Submit
                                                                            </button>
                                                                        </div>
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

                                        <!--  Modal content for the above example -->
                                        <div id="myModal" class="modal fade pdsfile" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-success">
                                                        <h5 class="modal-title text-white" id="myLargeModalLabel">PERSONAL DATA SHEET</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                    </div>
                                                    <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="card">
                                                                <div class="card-body">

                                                                <?php 
                                                                    $attributes = array('class' => 'parsley-examples');
                                                                    echo form_open_multipart('pages/update_pdsfile_staff', $attributes);
                                                                ?>
                                                                    <input type="hidden" name="id" value="<?= $staff->IDNumber; ?>">
                                                                    <input type="hidden" name="empEmail" value="<?= $data->empEmail; ?>">
                                                                    <input type="hidden" name="jobID" value="<?= $this->uri->segment(4); ?>">
                                                                    <input type="hidden" name="school_id" value="<?= $this->uri->segment(5); ?>">
                                                                    
                                                                    
                                                                    <div class="form-group row">
                                                                        <label for="hori-pass1" class="col-md-4 col-form-label">Select PDF File<span class="text-danger">*</span></label>
                                                                        <div class="col-md-7">
                                                                            <input id="myInput" type="file"  name="file"  required class="form-control">
                                                                        </div>
                                                                    </div>

                                                                
                                                                    
                                                                    <div class="form-group row mb-0">
                                                                        <div class="col-md-8 offset-md-4">
                                                                            <button type="submit" class="btn btn-success waves-effect waves-light mr-1">
                                                                                Submit
                                                                            </button>
                                                                        </div>
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

                                        <!--  Modal content for the above example -->
                                        <div id="myModal" class="modal fade oafile" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-success">
                                                        <h5 class="modal-title text-white" id="myLargeModalLabel">Other Appendices</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                    </div>
                                                    <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="card">
                                                                <div class="card-body">

                                                                <?php 
                                                                    $attributes = array('class' => 'parsley-examples');
                                                                    echo form_open_multipart('pages/update_oafile_staff', $attributes);
                                                                ?>
                                                                    <input type="hidden" name="id" value="<?= $staff->IDNumber; ?>">
                                                                    <input type="hidden" name="empEmail" value="<?= $data->empEmail; ?>">
                                                                    <input type="hidden" name="jobID" value="<?= $this->uri->segment(4); ?>">
                                                                    <input type="hidden" name="school_id" value="<?= $this->uri->segment(5); ?>">
                                                                    
                                                                    
                                                                    <div class="form-group row">
                                                                        <label for="hori-pass1" class="col-md-4 col-form-label">Select PDF File<span class="text-danger">*</span></label>
                                                                        <div class="col-md-7">
                                                                            <input id="myInput" type="file"  name="file"  required class="form-control">
                                                                        </div>
                                                                    </div>

                                                                
                                                                    
                                                                    <div class="form-group row mb-0">
                                                                        <div class="col-md-8 offset-md-4">
                                                                            <button type="submit" class="btn btn-success waves-effect waves-light mr-1">
                                                                                Submit
                                                                            </button>
                                                                        </div>
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

                                        <!--  Modal content for the above example -->
                                        <div id="myModal" class="modal fade ipcrffile" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-success">
                                                        <h5 class="modal-title text-white" id="myLargeModalLabel">IPCRF for Non-Teaching (Attachments) File</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                    </div>
                                                    <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="card">
                                                                <div class="card-body">

                                                                <?php 
                                                                    $attributes = array('class' => 'parsley-examples');
                                                                    echo form_open_multipart('pages/update_ipcrffile_staff', $attributes);
                                                                ?>
                                                                    <input type="hidden" name="id" value="<?= $staff->IDNumber; ?>">
                                                                    <input type="hidden" name="empEmail" value="<?= $data->empEmail; ?>">
                                                                    <input type="hidden" name="jobID" value="<?= $this->uri->segment(4); ?>">
                                                                    <input type="hidden" name="school_id" value="<?= $this->uri->segment(5); ?>">
                                                                    
                                                                    
                                                                    <div class="form-group row">
                                                                        <label for="hori-pass1" class="col-md-4 col-form-label">Select PDF File<span class="text-danger">*</span></label>
                                                                        <div class="col-md-7">
                                                                            <input id="myInput" type="file"  name="file"  required class="form-control">
                                                                        </div>
                                                                    </div>

                                                                
                                                                    
                                                                    <div class="form-group row mb-0">
                                                                        <div class="col-md-8 offset-md-4">
                                                                            <button type="submit" class="btn btn-success waves-effect waves-light mr-1">
                                                                                Submit
                                                                            </button>
                                                                        </div>
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
                                        
                                        <!--  Modal content for the above example -->
                                        <div id="myModal" class="modal fade educrating" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-warning">
                                                        <h5 class="modal-title text-white" id="myLargeModalLabel">EDUCATION RATING</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                    </div>
                                                    <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <p class="text-danger"><i>Note: Maximum allowed value is 10</i></p>
                                                            <div class="card">
                                                                <div class="card-body">

                                                                <form class="parsley-examples" action="<?= base_url(); ?>pages/update_educ_rate/<?= $this->uri->segment(3); ?>/<?= $this->uri->segment(4); ?>/<?= $this->uri->segment(5); ?>/<?= $aa->appID; ?>" method="post">
                                                                    <input type="hidden" name="app_id" value="<?= $aa->appID; ?>">
                                                                    <input type="hidden" name="empEmail" value="<?= $data->empEmail; ?>">
                                                                    <input type="hidden" name="record_no" value="<?= $data->record_no; ?>">
                                                                    <input type="hidden" name="school_id" value="<?= $this->uri->segment(5); ?>">
                                                                        
                                                                    <div class="row">
                                                                        <div class="col-lg-12">
                                                                                <div class="form-group">
                                                                                    <label>Rating</label>
                                                                                    <input  type="text" class="form-control" name="education"  value="<?php if($rating->education != 0.00001){echo $rating->education; } ?>" >
                                                                                </div>	
                                                                        </div>	
                                                                        
                                                                    </div>

                              
                                                                    
                                                                        <div class="form-group text-right mb-0">
                                                                            <button class="btn btn-warning waves-effect waves-light mr-1" type="submit">
                                                                                Submit
                                                                            </button>
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

                                        <!--  Modal content for the above example -->
                                        <div id="myModal" class="modal fade werating" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-danger">
                                                        <h5 class="modal-title text-white" id="myLargeModalLabel">WORK EXPERIENCE RATING</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                    </div>
                                                    <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <p class="text-danger"><i>Note: Maximum allowed value is 10</i></p>
                                                            <div class="card">
                                                                <div class="card-body">

                                                                <form class="parsley-examples" action="<?= base_url(); ?>pages/update_we_rate/<?= $this->uri->segment(3); ?>/<?= $this->uri->segment(4); ?>/0/<?= $aa->appID; ?>" method="post">
                                                                    <input type="hidden" name="app_id" value="<?= $aa->appID; ?>">
                                                                    <input type="hidden" name="empEmail" value="<?= $data->empEmail; ?>">
                                                                    <input type="hidden" name="record_no" value="<?= $data->record_no; ?>">
                                                                    <input type="hidden" name="school_id" value="<?= $this->uri->segment(5); ?>">
                                                                        
                                                                    <div class="row">
                                                                        <div class="col-lg-12">
                                                                                <div class="form-group">
                                                                                    <label>Rating</label>
                                                                                    <input type="text" class="form-control" name="experience"  value="<?php if($rating->experience != 0.00001){echo $rating->experience; } ?>" >
                                                                                </div>	
                                                                        </div>	
                                                                        
                                                                    </div>

                              
                                                                    
                                                                        <div class="form-group text-right mb-0">
                                                                            <button class="btn btn-danger waves-effect waves-light mr-1" type="submit">
                                                                                Submit
                                                                            </button>
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

                                         <!--  Modal content for the above example -->
                                         <div id="myModal" class="modal fade lrrating" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-purple">
                                                        <h5 class="modal-title text-white" id="myLargeModalLabel">LET RATING</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                    </div>
                                                    <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <p class="text-danger"><i>Note: Maximum allowed value is 10</i></p>
                                                            <div class="card">
                                                                <div class="card-body">

                                                                <form class="parsley-examples" action="<?= base_url(); ?>pages/update_let_rate/<?= $this->uri->segment(3); ?>/<?= $this->uri->segment(4); ?>/0/<?= $aa->appID; ?>" method="post">
                                                                    <input type="hidden" name="app_id" value="<?= $aa->appID; ?>">
                                                                    <input type="hidden" name="empEmail" value="<?= $data->empEmail; ?>">
                                                                    <input type="hidden" name="record_no" value="<?= $data->record_no; ?>">
                                                                    <input type="hidden" name="school_id" value="<?= $this->uri->segment(5); ?>">
                                                                        
                                                                    <div class="row">
                                                                        <div class="col-lg-12">
                                                                                <div class="form-group">
                                                                                    <label>Rating</label>
                                                                                    <input type="text"  class="form-control" name="let_rating"  value="<?php if($rating->let_rating != 0.00001){echo $rating->let_rating; } ?>" >
                                                                                </div>	
                                                                        </div>	
                                                                        
                                                                    </div>

                              
                                                                    
                                                                        <div class="form-group text-right mb-0">
                                                                            <button class="btn btn-purple waves-effect waves-light mr-1" type="submit">
                                                                                Submit
                                                                            </button>
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

                                        <!--  Modal content for the above example -->
                                        <div id="myModal" class="modal fade certrating" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-info">
                                                        <h5 class="modal-title text-white" id="myLargeModalLabel">TRAININGS AND SEMINARS RATING</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                    </div>
                                                    <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                        <p class="text-danger"><i>Note: Maximum allowed value is 10</i></p>
                                                            <div class="card">
                                                                <div class="card-body">

                                                                <form class="parsley-examples" action="<?= base_url(); ?>pages/update_training_rate/<?= $this->uri->segment(3); ?>/<?= $this->uri->segment(4); ?>/0/<?= $aa->appID; ?>" method="post">
                                                                    <input type="hidden" name="app_id" value="<?= $aa->appID; ?>">
                                                                    <input type="hidden" name="empEmail" value="<?= $data->empEmail; ?>">
                                                                    <input type="hidden" name="record_no" value="<?= $data->record_no; ?>">
                                                                    <input type="hidden" name="school_id" value="<?= $this->uri->segment(5); ?>">
                                                                        
                                                                    <div class="row">
                                                                        <div class="col-lg-12">
                                                                                <div class="form-group">
                                                                                    <label>Rating</label>
                                                                                    <input type="text"  class="form-control" name="training"  value="<?php if($rating->training != 0.00001){echo $rating->training; } ?>" >
                                                                                </div>	
                                                                        </div>	
                                                                        
                                                                    </div>

                              
                                                                    
                                                                        <div class="form-group text-right mb-0">
                                                                            <button class="btn btn-info waves-effect waves-light mr-1" type="submit">
                                                                                Submit
                                                                            </button>
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

                                        <!--  Modal content for the above example -->
                                        <div class="modal fade dq" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" style="display: none;" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-info">
                                                        <h5 class="modal-title" id="myLargeModalLabel">Remarks</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                    </div>
                                                    <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="card">
                                                                <div class="card-body">

                                                                    <form class="parsley-examples" action="<?= base_url(); ?>pages/Unqualified/<?= $this->uri->segment(3); ?>/<?= $this->uri->segment(4); ?>" method="post">
                                                                    <input type="hidden" name="id" value="<?= $data->id; ?>">
                                                                    <input type="hidden" name="empEmail" value="<?= $data->empEmail; ?>">
                                                                    <input type="hidden" name="jobID" value="<?= $this->uri->segment(4); ?>">
                                                                    <input type="hidden" name="appID" value="<?= $aa->appID; ?>">
                                                                    <input type="hidden" name="job_type" value="<?= $job->job_type; ?>">
                                                                    <input type="hidden" name="dist" value="<?= $aa->district; ?>">

                                                                    <?php if($job->job_type == 2){?>

                                                                    <div class="row">
                                                                        <div class="col-lg-5">
                                                                            <label class="col-form-label">Learning Area</label>
                                                                                <select class="form-control" required name="learn">
                                                                                    <option></option>
                                                                                    <?php $la = array('Filipino','English','Mathematics','Science','Araling Panlipunan',
                                                                                            'Edukasyon sa Pagpapakatao','Music and Arts','Physical Education and Health',
                                                                                            'SPED',
                                                                                            'TLE'
                                                                                        );
                                                                                        foreach($la as $row){
                                                                                    ?>
                                                                                    <option><?= $row; ?></option>
                                                                                    <?php } ?>
                                                                                </select>
                                                                        </div>	

                                                                        <div class="col-lg-7">
                                                                            <label class="col-form-label">Specialized Area</label>
                                                                            <select class="form-control" name="special">
                                                                                    <option></option>
                                                                                    <?php $la = array(
                                                                                            'Mathematics'=>' Algebra, Trigonometry, Geometry, Statistics',
                                                                                            'Science'=>'General Science, Biology, Chemistry, Physics',
                                                                                            'TLE'=>'Agri - Fishery Arts, Home Economics, Information and Communications Technology, Industrial Arts'
                                                                                        );
                                                                                        foreach($la as $row => $key){
                                                                                        $array = explode(', ', $key); 
                                                                                        if($key != ''){
                                                                                    ?>
                                                                                    <optgroup label="<?= $row?>">
                                                                                    <?php foreach($array as $val){ ?>
                                                                                    <option value="<?= $val; ?>"><?= $val; ?></option>
                                                                                    <?php } ?>
                                                                                    </optgroup>
                                                                                    <?php } } ?>
                                                                                    
                                                                                </select>

                                                                                
                                                                        </div>	

                                                                        
                                                                    </div><br />	
                                                                    
                                                                    <?php }elseif($job->job_type == 3){ ?>

                                                                        <div class="row">
                                                                        <div class="col-lg-5">
                                                                            <label class="col-form-label">Group</label>
                                                                                <select class="form-control" required name="group">
                                                                                    <option></option>
                                                                                    <?php $la = array('HUMSS','ABM','STEM','TVL','Sports','Arts and Design');
                                                                                        foreach($la as $row){
                                                                                    ?>
                                                                                    <option><?= $row; ?></option>
                                                                                    <?php } ?>
                                                                                </select>
                                                                        </div>	

                                                                        <div class="col-lg-7">
                                                                            <label class="col-form-label">Strand</label>
                                                                            <select class="form-control" name="strand">
                                                                                    <option></option>
                                                                                    <?php $la = array('HUMMS'=>'I-A, I-B, I-C, I-D',
                                                                                                        'STEM'=>'III-A, III-B',
                                                                                                        'TVL'=>'I-VA, I-VB, I-VC, I-VD'
                                                                                        );
                                                                                        foreach($la as $row => $key){
                                                                                        $array = explode(', ', $key); 
                                                                                        if($key != ''){
                                                                                    ?>
                                                                                    <optgroup label="<?= $row?>">
                                                                                    <?php foreach($array as $val){ ?>
                                                                                    <option value="<?= $val; ?>"><?= $val; ?></option>
                                                                                    <?php } ?>
                                                                                    </optgroup>
                                                                                    <?php } } ?>
                                                                                    
                                                                                </select>

                                                                                
                                                                        </div>	

                                                                        
                                                                    </div><br />


                                                                    <?php } ?>
                                                                    
                                                                    
                                                                    
                                                                    
                                                                    <div class="row">
                                                                        <div class="col-lg-12">	
                                                                                <h4 class="header-title">Mandatory documents presented <span class='text-danger'>*</span></h4>
                                                                                <div class="form-group">
                                                                                <div class="custom-control custom-checkbox">
                                                                                <input type="checkbox" class="custom-control-input" id="customCheck1" name="li" value="1">
                                                                                <label class="custom-control-label text-xs" for="customCheck1">Letter of Intent</label>
                                                                            </div>
                                                                            <div class="custom-control custom-checkbox">
                                                                                <input type="checkbox" class="custom-control-input" id="customCheck2" name="da_pds" value="1">
                                                                                <label class="custom-control-label text-xs" for="customCheck2">Duly Accomplished PDS</label>
                                                                            </div>
                                                                            <div class="custom-control custom-checkbox">
                                                                                <input type="checkbox" class="custom-control-input" id="customCheck3" name="prc" value="1">
                                                                                <label class="custom-control-label text-xs" for="customCheck3">Valid PRC License ( except for SHS which can be applied by non- licensed teachers)</label>
                                                                            </div>
                                                                            <div class="custom-control custom-checkbox">
                                                                                <input type="checkbox" class="custom-control-input" id="customCheck4" name="trbd" value="1">
                                                                                <label class="custom-control-label text-xs" for="customCheck4">Transcript of Records of the Baccalaureate Degree</label>
                                                                            </div>
                                                                            <div class="custom-control custom-checkbox">
                                                                                <input type="checkbox" class="custom-control-input" id="customCheck5" name="omni" value="1">
                                                                                <label class="custom-control-label text-xs" for="customCheck5">Omnibus Sworn Statement</label>
                                                                            </div>
                                                                                    

                                                                                </div>	
                                                                        </div>	
                                                                        
                                                                    </div>

                                                                    <div class="row">
                                                                        <div class="col-lg-12">	
                                                                                <h4 class="header-title">Is the address in the MIS matched with the Voters Certificate/Barangay Certificate? <span class='text-danger'>*</span></h4>
                                                                                <div class="form-group">
                                                                                <div class="custom-control custom-radio">
                                                                                    <input type="radio" id="local1" name="local" required class="custom-control-input" value="0">
                                                                                    <label class="custom-control-label text-xs" for="local1">Yes</label>
                                                                                </div>
                                                                                <div class="custom-control custom-radio">
                                                                                    <input type="radio" id="local2" name="local" required class="custom-control-input" value="1">
                                                                                    <label class="custom-control-label text-xs" for="local2">No</label>
                                                                                </div>         

                                                                                </div>	
                                                                        </div>	
                                                                        
                                                                    </div>

                                                                    <div class="row">
                                                                        <div class="col-lg-12">	
                                                                                <h4 class="header-title">Remarks <span class='text-danger'>*</span></h4>
                                                                                <div class="form-group">
                                                                                <div class="custom-control custom-radio">
                                                                                <input type="radio" id="customRadio1" required name="remarks" class="custom-control-input" value="1">
                                                                                <label class="custom-control-label text-xs" for="customRadio1">Qualified</label>
                                                                            </div>
                                                                            <div class="custom-control custom-radio">
                                                                                <input type="radio" id="customRadio2" required name="remarks" class="custom-control-input" value="2">
                                                                                <label class="custom-control-label text-xs" for="customRadio2">Disqualified</label>
                                                                            </div>
                                                                                                                    

                                                                                </div>	
                                                                        </div>	
                                                                        
                                                                    </div>

                                                                        
                                                                    <div class="row">
                                                                        <div class="col-lg-12">
                                                                                <div class="form-group">
                                                                                    <label>If disqualified, state the reasons here. </label>
                                                                                    <textarea class="form-control" rows="5" name="reason" id="example-textarea"></textarea>
                                                                                </div>	
                                                                        </div>	
                                                                        
                                                                    </div>	

                                                                    
                                                                        
                                                                        

                                                                        <div class="form-group text-right mb-0">
                                                                            <button class="btn btn-info waves-effect waves-light mr-1" type="submit">
                                                                                Submit
                                                                            </button>
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
                                        
                                        <?php $dq = $this->Common->one_cond_row('hris_app_dq','AppID',$aa->appID); ?>
                                        <?php if(!empty($dq)){ ?>

                                        <!--  Modal content for the above example -->
                                        <div class="modal fade dqedit" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" style="display: none;" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-info">
                                                        <h5 class="modal-title" id="myLargeModalLabel">Remarks</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                    </div>
                                                    <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    

                                                                    <form class="parsley-examples" action="<?= base_url(); ?>pages/Unqualifiededit/<?= $this->uri->segment(3); ?>/<?= $this->uri->segment(4); ?>" method="post">
                                                                    <input type="hidden" name="id" value="<?= $data->id; ?>">
                                                                    <input type="hidden" name="empEmail" value="<?= $data->empEmail; ?>">
                                                                    <input type="hidden" name="jobID" value="<?= $this->uri->segment(4); ?>">
                                                                    <input type="hidden" name="appID" value="<?= $aa->appID; ?>">
                                                                    <input type="hidden" name="job_type" value="<?= $job->job_type; ?>">
                                                                    <input type="hidden" name="dq_id" value="<?= $dq->id; ?>">

                                                                    
                                                                    
                                                                    
                                                                    
                                                                    
                                                                    <div class="row">
                                                                        <div class="col-lg-12">	
                                                                                <h4 class="header-title">Mandatory documents presented <span class='text-danger'>*</span></h4>
                                                                                <div class="form-group">
                                                                                <div class="custom-control custom-checkbox">
                                                                                <input type="checkbox" class="custom-control-input" id="customCheck11" <?php if($dq->li == 1){echo "checked";} ?> name="li" value="1">
                                                                                <label class="custom-control-label text-xs" for="customCheck11">Letter of Intent</label>
                                                                            </div>
                                                                            <div class="custom-control custom-checkbox">
                                                                                <input type="checkbox" class="custom-control-input" id="customCheck22" <?php if($dq->da_pds == 1){echo "checked";} ?> name="da_pds" value="1">
                                                                                <label class="custom-control-label text-xs" for="customCheck22">Duly Accomplished PDS</label>
                                                                            </div>
                                                                            <div class="custom-control custom-checkbox">
                                                                                <input type="checkbox" class="custom-control-input" id="customCheck33" <?php if($dq->prc == 1){echo "checked";} ?> name="prc" value="1">
                                                                                <label class="custom-control-label text-xs" for="customCheck33">Valid PRC License ( except for SHS which can be applied by non- licensed teachers)</label>
                                                                            </div>
                                                                            <div class="custom-control custom-checkbox">
                                                                                <input type="checkbox" class="custom-control-input" id="customCheck44" <?php if($dq->trbd == 1){echo "checked";} ?> name="trbd" value="1">
                                                                                <label class="custom-control-label text-xs" for="customCheck44">Transcript of Records of the Baccalaureate Degree</label>
                                                                            </div>
                                                                            <div class="custom-control custom-checkbox">
                                                                                <input type="checkbox" class="custom-control-input" id="customCheck55" <?php if($dq->omni == 1){echo "checked";} ?> name="omni" value="1">
                                                                                <label class="custom-control-label text-xs" for="customCheck55">Omnibus Sworn Statement</label>
                                                                            </div>
                                                                                    

                                                                                </div>	
                                                                        </div>	
                                                                        
                                                                    </div>

                                                                    <div class="row">
                                                                        <div class="col-lg-12">	
                                                                                <h4 class="header-title">Is the address in the MIS matched with the Voters Certificate/Barangay Certificate? <span class='text-danger'>*</span></h4>
                                                                                <div class="form-group">
                                                                                <div class="custom-control custom-radio">
                                                                                    <input type="radio" id="local11" name="local" <?php if($dq->local == 0){echo "checked";} ?> required class="custom-control-input" value="0">
                                                                                    <label class="custom-control-label text-xs" for="local11">Yes</label>
                                                                                </div>
                                                                                <div class="custom-control custom-radio">
                                                                                    <input type="radio" id="local22" name="local" <?php if($dq->local == 1){echo "checked";} ?> required class="custom-control-input" value="1">
                                                                                    <label class="custom-control-label text-xs" for="local22">No</label>
                                                                                </div>         

                                                                                </div>	
                                                                        </div>	
                                                                        
                                                                    </div>

                                                                    <div class="row">
                                                                        <div class="col-lg-12">	
                                                                                <h4 class="header-title">Remarks <span class='text-danger'>*</span></h4>
                                                                                <div class="form-group">
                                                                                <div class="custom-control custom-radio">
                                                                                <input type="radio" id="customRadio11" required name="remarks" <?php if($dq->remarks == 1){echo "checked";} ?> class="custom-control-input" value="1">
                                                                                <label class="custom-control-label text-xs" for="customRadio11">Qualified</label>
                                                                            </div>
                                                                            <div class="custom-control custom-radio">
                                                                                <input type="radio" id="customRadio22" required name="remarks" <?php if($dq->remarks == 2){echo "checked";} ?> class="custom-control-input" value="2">
                                                                                <label class="custom-control-label text-xs" for="customRadio22">Disqualified</label>
                                                                            </div>
                                                                                                                    

                                                                                </div>	
                                                                        </div>	
                                                                        
                                                                    </div>

                                                                        
                                                                    <div class="row">
                                                                        <div class="col-lg-12">
                                                                                <div class="form-group">
                                                                                    <label>If disqualified, state the reasons here. </label>
                                                                                    <textarea class="form-control" rows="5" name="reason" id="example-textarea"><?= $dq->reason; ?></textarea>
                                                                                </div>	
                                                                        </div>	
                                                                        
                                                                    </div>	

                                                                    
                                                                        
                                                                        

                                                                        <div class="form-group text-right mb-0">
                                                                            <button class="btn btn-info waves-effect waves-light mr-1" type="submit">
                                                                                Submit
                                                                            </button>
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
                                        <?php } ?>



                                        <!--  Modal content for the above example -->
                                        <div id="myModal" class="modal fade comment" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-info">
                                                        <h5 class="modal-title text-white" id="myLargeModalLabel">QUERY</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                    </div>
                                                    <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="card bg-in">
                                                                <div class="card-body">

                                                                <form class="parsley-examples" action="<?= base_url(); ?>pages/appinquiry/<?= $this->uri->segment(3); ?>/<?= $this->uri->segment(4); ?>/<?= $this->uri->segment(5); ?>/<?= $aa->appID; ?>" method="post">
                                                            
                                                                        
                                                                    <div class="form-group row">
                                                                        <label class="col-lg-12 col-form-label" for="example-textarea"></label>
                                                                        <div class="col-lg-12">
                                                                            <textarea class="form-control" rows="5" name="comment" id="example-textarea"></textarea>
                                                                        </div>
                                                                    </div>
                                                                    <input type="hidden" value="<?= $app->appID; ?>" name="app_id">
                                                                        
                              
                                                                    
                                                                        <div class="form-group text-right mb-0">
                                                                            <button onclick="return confirm('Are you sure?')" class="btn btn-info waves-effect waves-light mr-1" type="submit">
                                                                                Submit
                                                                            </button>
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



                                    
                                       

                                         


                                        



