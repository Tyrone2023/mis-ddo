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
    <title><?= $title; ?></title>
</head>
<body>
    
  <div class="wrap">
    <div class="inner">
        <h5>Annex 1-1</h5>
        <h1 style="font-size:25px"><?= $title; ?></h1>
        <h1 style="font-size:20px"><?= $st; ?></h1>
        <h1 style="font-size:20px">FOR SCHOOL YEAR <?= date('Y'); ?> - <?= date('Y')+1; ?></h1>

        <table class="toptable">
            <tr>
                <td>Position</td>
                <td class="wb"><?= $job->jobTitle; ?></td>
                <td class="ren"></td>
                <td>Plantilla Item Number:</td>
                <td class="wb"></td>
            </tr>
            <tr>
                <td>Office/Bureau/Service/Unit where the vacancy exists</td>
                <td class="wb">Division of Davao Oriental</td>
                <td class="ren"></td>
                <td>Date of Final Deliberation:</td>
                <td class="wb"></td>
            </tr>
        </table>

        <table class="data">
            <tr>
                <th rowspan="2">No.</th>
                <th rowspan="2">Fullname</th>
                <th rowspan="2">Application Code</th>
                <th rowspan="2">Address</th>
                <th rowspan="2">Contact</th>
                <th colspan="7">COMPARATIVE ASSESSMENT RESULTS</th>
               
                
            </tr>
            <tr>
                <th>Education <br />(10 pts)</th>
                <th>Training <br />(10 pts)</th>
                <th>Experience <br /> (10 pts)</th>
                <th>PBET/LET/<br />LEPT RATING<br />(10 pts)</th>
                <th>PPST COIs<br />(Classroom<br /> Observation)<br />(35 pts)</th>
                <th>PPST NCOIs<br />(Teacher Reflection)<br />(25 pts)</th>
                <th>Total<br />(100 pts)</th>
               
            </tr>
            <?php 
            //$data = array("CRODUA, IRENEO O JR.","AMIGO, EDGARDO V.","JANNDEL BUOT","EDONG, JOSELITO");
            $no = 1;
            foreach($car as $row){
                $ap = $this->Page_model->get_single_row_by_id('hris_applicant', 'record_no', $row->record_no);
                if(!empty($ap)){
            ?>
            <tr>
                <td><?= $no++; ?></td>
                <td class="name"><?= strtoupper($ap->FirstName).' '.strtoupper($ap->MiddleName).' '.strtoupper($ap->LastName).' '.strtoupper($ap->NameExtn); ?></td>
                <td><?= $row->record_no; ?></td>
                <td><?= $ap->resBarangay; ?>, <?= $ap->resCity; ?></td>
                <td><?= $row->contactNo; ?></td>
                <td><?= ($row->education != 0.00001) ? $row->education : ""; ?></td>
                <td><?= ($row->training != 0.00001) ? $row->training : ""; ?></td>
                <td><?= ($row->experience != 0.00001) ? $row->experience : ""; ?></td>
                <td><?= ($row->let_rating != 0.00001) ? $row->let_rating : ""; ?></td>
                <td><?= ($row->demo_rating != 0.00001) ? $row->demo_rating : ""; ?></td>
                <td><?= ($row->tr_rating != 0.00001) ? $row->tr_rating : ""; ?></td>
                <td><?= $row->total_points ? number_format($row->total_points, 2) : ""; ?></td>
                

            </tr>
            <?php }} ?>
        </table>
        
        <p class="prep">Prepared by the HRMPSB <span>Appointment conferred by:</span><br />(All members should affix signature) </p>

        <table class="sign">
        <tr>
                <td><span><?= strtoupper($sign->m1n); ?></span><br /><?= $sign->m1p; ?><br />Member</td>
                <td><span><?= strtoupper($sign->m2n); ?></span><br /><?= $sign->m2p; ?><br />Member</td>
                <td><span><?= strtoupper($sign->m3n); ?></span><br /><?= $sign->m3p; ?><br />Member</td>
                <td><span><?= strtoupper($sign->m4n); ?></span><br /><?= $sign->m4p; ?><br />Member</td>
                <td><span><?= strtoupper($sign->asdsn); ?></span><br /><?= $sign->asdsp; ?><br />Chairperson</td>
                <td><span><?= strtoupper($sign->sdsn); ?></span><br /><?= $sign->sdsp; ?><br /><br /></td>
            </tr>
        </table>

        

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