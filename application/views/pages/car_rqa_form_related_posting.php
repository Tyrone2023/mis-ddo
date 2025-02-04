
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Responsive bootstrap 4 admin template" name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="<?= base_url(); ?>assets/images/hris.ico">
    <link href="<?= base_url(); ?>assets/css/renren_style.css" rel="stylesheet" type="text/css" />
    <link href="https://db.onlinewebfonts.com/a/0nH393RJctHgt1f2YvZvyruY" rel="stylesheet" type="text/css"/>
    <title><?= $title; ?></title>
</head>
<body>
<?php 
        $jobTypes = [
            1 => '- Elementary',
            2 => '- Secondary',
            3 => '- Junior High School',
            4 => '- Senior High School'
        ];
    ?>
    <div class="hwrap">
    <img class="logo" src="<?= base_url(); ?>assets/images/ke.png" alt="">
        <p class="textwrap">
        <span class="rp">Republic of the Philippines</span>
            <span class="de">Department of Education</span>
            <span class="r">Region XI</span>
            <span class="r">Schools Division of Davao Oriental</span>
        </p>
</div>
<div class="blocker"></div>
  <div class="wrap">
    <div class="inner">
        <h5>Annex I</h5>
        <h1 style="font-size:20px"><?= $title; ?></h1>

        <table class="toptable">
            <tr>
                <td>Position</td>
                <td class="wb"><?= $job->jobTitle; ?> <?= $jobTypes[$job->job_type] ?? ''; ?></td>
                <td class="ren"></td>
                <td>Plantilla Item Number:</td>
                <td class="wb"></td>
            </tr>
            <tr>
                <td>Office/Bureau/Service/Unit where the vacancy exists</td>
                <td class="wb">Division of Davao Oriental</td>
                <td class="ren"></td>
                <td>Date of Final Deliberation:</td>
                <td class="wb"><?= $sign->pdate; ?></td>
            </tr>
        </table>

        <table class="data">
            <tr>
                <th rowspan="2">No.</th>
                <th rowspan="2">Application Code</th>
                <th rowspan="2">Address</th>
                <th colspan="9">COMPARATIVE ASSESSMENT RESULTS</th>
                <th rowspan="2">Remarks</th>
                <th colspan="2">For Background<br />Investigation<br />(Y/N)</th>
                <th rowspan="2">For<br />Appointment<br /><i>(To filled-out by the<br />Appointing<br />Officer/Authority,<br />Please sign opposite<br />the name of the applicant)</th>
                <th rowspan="2">For<br />Appointment<br/><i>Please identify period of<br /> Probation (6 months or 1<br /> year) in accordance with<br /> Section F of<br /> DO 019,s.2022</i></th>
            </tr>
            <tr>
                <th>Education <br />(10 pts)</th>
                <th>Training <br />(10 pts)</th>
                <th>Experience <br /> (10 pts)</th>
                <th>Performance<br /> (20 pts)</th>
                <th>Outstanding<br/>Accomplishments<br /> (5 pts)</th>
                <th>Application of <br />Education<br /> (15 pts)</th>
                <th>Application of <br />L&D <br /> (10 pts)</th>
                <th>Potential<br /> (20 pts)</th>
                <th>Total<br />(100 pts)</th>
                <th>Yes</th>
                <th>No</th>
            </tr>
            <?php 
            //$data = array("CRODUA, IRENEO O JR.","AMIGO, EDGARDO V.","JANNDEL BUOT","EDONG, JOSELITO");
            $no = 1;
            foreach($car as $row){
                $b = $this->Common->one_cond_row('hris_applicant', 'record_no', $row->record_no);
                if(!empty($b)){
                    $ap = $this->Common->one_cond_row('hris_applicant', 'record_no', $row->record_no);
                }else{
                    $ap = $this->Common->one_cond_row('hris_staff', 'IDNumber', $row->record_no);
                }
                if(!empty($ap)){
            ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $row->record_no; ?> </td>
                <td><?= $ap->resBarangay; ?></td>
                <td><?= ($row->educ != 0.00001) ? $row->educ : ""; ?></td>
                <td><?= ($row->trainings != 0.00001) ? $row->trainings : ""; ?></td>
                <td><?= ($row->experience != 0.00001) ? $row->experience : ""; ?></td>
                <td><?= ($row->performance != 0.00001) ? number_format($row->performance, 2) : ""; ?></td>
                <td><?= ($row->oa != 0.00001) ? $row->oa : ""; ?></td>
                <td><?= ($row->ae != 0.00001) ? $row->ae : ""; ?></td>
                <td><?= ($row->ald != 0.00001) ? $row->ald : ""; ?></td>
                <td><?= number_format($row->interview+$row->written+$row->skills, 2); ?></td>
                <td><?= number_format(($row->total_points != 0.00001) ? $row->total_points : "", 3); ?></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <?php }} ?>
        </table>
        
        <p class="prep">Prepared by the HRMPSB <span>Appointment conferred by:</span><br />(All members should affix signature) </p>

        <?php if($job->jobID == 22){ ?>
            <table class="sign">
            <tr>
                <td><span>On leaved</span><?php if($this->uri->segment(4) == 1){?><img class="isig" src="<?= base_url(); ?>assets/isig/chona.png" alt=""><?php } ?><br /><span><?= strtoupper($sign->m1n); ?></span><br /><?= $sign->m1p; ?><br />Member</td>
                <td><?php if($this->uri->segment(4) == 1){?><img class="isig" src="<?= base_url(); ?>assets/isig/ruin.png" alt=""><?php } ?><br /><span><?= strtoupper($sign->m5n); ?></span><br /><?= $sign->m5p; ?><br />Member</td>                
                <td><?php if($this->uri->segment(4) == 1){?><img src="<?= base_url(); ?>assets/isig/emma.png" alt=""><?php } ?><br /><span><?= strtoupper($sign->m2n); ?></span><br /><?= $sign->m2p; ?><br />Member</td>
                <td><?php if($this->uri->segment(4) == 1){?><img class="isig" src="<?= base_url(); ?>assets/isig/fadul.png" alt=""><?php } ?><br /><span><?= strtoupper($sign->sdsn); ?></span><br /><?= $sign->sdsp; ?><br /><br /></td>
            </tr>
            <tr>
                <td><?php if($this->uri->segment(4) == 1){?><img class="isig" src="<?= base_url(); ?>assets/isig/suma.png" alt=""><?php } ?><br /><span><?= $sign->m4n; ?></span><br /><?= $sign->m4p; ?><br />Member</td>
                <td><?php if($this->uri->segment(4) == 1){?><img src="<?= base_url(); ?>assets/isig/sango.png" alt=""><?php } ?><br /><span><?= strtoupper($sign->asdsn); ?></span><br /><?= $sign->asdsp; ?><br />Chairperson</td>
                
            </tr>
        </table>
        <?php }else{  ?>

        <table class="sign">
            <tr>
                <td><span class="ol">on leave</span><?php if($this->uri->segment(4) == 3){?><img class="isig isig3" src="<?= base_url(); ?>assets/isig/chona.png" alt=""><?php } ?><br /><span><?= strtoupper($sign->m1n); ?></span><br /><?= $sign->m1p; ?><br />Member</td>
                <td><?php if($this->uri->segment(4) == 1){?><img src="<?= base_url(); ?>assets/isig/emma.png" alt=""><?php } ?><br /><span><?= strtoupper($sign->m2n); ?></span><br /><?= $sign->m2p; ?><br />Member</td>
                <td><?php if($this->uri->segment(4) == 1){?><img class="isig isig2" src="<?= base_url(); ?>assets/isig/anton.png" alt=""><?php } ?><br /><span><?= strtoupper($sign->m5n); ?></span><br /><?= $sign->m5p; ?><br />Member</td>
                <td><?php if($this->uri->segment(4) == 1){?><img class="isig" src="<?= base_url(); ?>assets/isig/fadul.png" alt=""><?php } ?><br /><span><?= strtoupper($sign->sdsn); ?></span><br /><?= $sign->sdsp; ?><br /><br /></td>
            </tr>
            <tr>
                <td><?php if($this->uri->segment(4) == 1){?><img src="<?= base_url(); ?>assets/isig/ernest.png" alt=""><?php } ?><br /><span><?= strtoupper($sign->m3n); ?></span><br /><?= $sign->m3p; ?><br />Member</td>
                <td><?php if($this->uri->segment(4) == 1){?><img class="isig isig2" src="<?= base_url(); ?>assets/isig/suma.png" alt=""><?php } ?><br /><span><?= $sign->m4n; ?></span><br /><?= $sign->m4p; ?><br />Member</td>
                <td><?php if($this->uri->segment(4) == 1){?><img src="<?= base_url(); ?>assets/isig/sango.png" alt=""><?php } ?><br /><span><?= strtoupper($sign->asdsn); ?></span><br /><?= $sign->asdsp; ?><br />Chairperson</td>
                
            </tr>
        </table>
        <?php } ?>

        

    </div>
  </div>

  
    <!-- <p class="down aa"><b>Notes and Instruction for the HRMO:</b></p>
    <p class="down">A)For the purpose of posting the CAR, column C(Name of the applicant) and columns L to P (Remarks to probation status) shall be concealed in accordance with RA no. 10163 (Data Privacy Act.)</p>
    <p class="down">The only information that shall be made public are the Application Code, Comparative Assessment Results(Component from Education to PPST NCOIs) and the total scores of the applicants.</p>
    <p class="down">b)If the information does not apply to the applicant, please put N/A</p>
    <p class="down dd">C) Applicants who failed to appear in any phase of the Open Ranking process and other evaluative assessments, and/or have withdrawn their application shall be provided with a notation beside the application code(e.g., withdrawn application, etc.)</p>

 -->


    
</body>
</html>