<?php if($this->session->logged_in == false){
redirect(base_url().'log_in');
if($session->position == 'asds'){redirect(base_url());}
} ?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Responsive bootstrap 4 admin template" name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="<?= base_url(); ?>assets/images/hris.ico">

        <!-- Plugins css-->
        <link href="<?= base_url(); ?>assets/css/renren.css" rel="stylesheet" type="text/css" />
        <link href="https://db.onlinewebfonts.com/a/0nH393RJctHgt1f2YvZvyruY" rel="stylesheet" type="text/css"/>
        
        <style>


            .aip_generate  .rrr{
                margin-bottom:20px;
                font-family:"Calibri", sans-serif;
            }
            .aip_generate  .rrr th{
                background-color:#fff;
                color:#000;
            }
            .aip_generate  .rrr td{
                text-align:left;
            }
            .rsign{
                float:left;
                margin-right:30px;
                margin-top:30px;
                position:relative;
            }
            .rsign span{
                display:block;
                line-height:1em;
            }
            .rsign .chona{
                position:absolute;
                left:20px;
                top:30px;
            }
            .rsign .feb{
                position:absolute;
                top:40px;
                width:50px;
            }


            /* Style the modal */
.modal {
    display: none;  /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    background-color: rgba(0, 0, 0, 0.4); /* Black with transparency */
}

/* Modal Content */
.modal-content {
    background-color: #fff;
    margin: 15% auto;
    padding: 20px;
    border: 1px solid #888;
    width: 80%;
    max-width: 500px;
    text-align: center;
}

/* The Close Button */
.close {
    color: #aaa;
    font-size: 28px;
    font-weight: bold;
    position: absolute;
    top: 10px;
    right: 20px;
    cursor: pointer;
}

.close:hover,
.close:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
}


            .text-center{text-align:center !important}
            @page {
            size: A4;
            margin: 50px 0;
            }
            @media print {
            html, body {
                width: 210mm;
                height: 297mm;
                font-size:14px !important;
            }

            .aip_generate .hr{
                margin:20px 0;
                width:100%;
            }

            .cert{
                width:90%;
                padding-top:1px;
            }
            .aip_generate .dra_aip th, 
            .aip_generate .dra_aip td {
                padding:10px 0;
            }

            .footer {
                position: fixed;
                margin: 0 auto; /* Only centers horizontally not vertically! */
                bottom: 0;
                width:86%;
            }
            #btnExport{
                visibility: hidden;
            }
            
           
            }
        </style>
    
    </head>

    <iframe id="txtArea1" style="display:none"></iframe>
    <button id="btnExport" onclick="fnExcelReport();"> EXPORT TO EXCEL</button>



    <body class="aip_generate" id="printTable">

        <div class="cert">
            <img class="logo" src="<?= base_url(); ?>assets/images/report/ke.png" alt="">
            <p style="margin-bottom:0;">
            <span class="rp">Republic of the Philippines</span><br />
                <span class="de">Department of Education</span><br />
                <span class="r">Region XI</span><br />
                <span class="r">Schools Division of Davao Oriental</span>
            </p>

            <div class="hr" style="margin:10px 0"></div>
            <h4 style="margin:40px 0">List of Qualified Applicants</h4>
            <?php 
                $jobTypes = [
                    1 => '- Elementary',
                    2 => '- Secondary',
                    3 => '- Junior High School',
                    4 => '- Senior High School'
                                                         
                    ];    
            ?>

            <table class="rrr" id='myTable'>
                <?php
                    $c=1;
                     
                    foreach($job as $jrow){
                        $application = $this->Common->two_cond_row('hris_applications', 'jobID', $jrow->jobID,'dq',1);
                        

                        if(!empty($application)){
                ?>
                <tr>
                    <td style="text-align:center; background-color:#fafcb8;" colspan="17"><b><?= $jrow->jobTitle; ?> <?= $jobTypes[$jrow->job_type] ?? '';?></b></td>
                </tr>
                <tr style="background-color:#BFECFF;">
                    <td class="text-center">NO.</td>
                    <td class="text-center">Application No.</td>
                    <td class="text-center">Fullname</td>
                    <td class="text-center">Address</td>
                    <td class="text-center">Education</td>
                    <td class="text-center">Trainings And Seminars</td>
                    <td class="text-center">Work Experience</td>
                    <td class="text-center">Performance Rating</td>
                    <td class="text-center">Outstanding<br /> Accomplishments</td>
                    <td class="text-center">Application <br />Of Education</td>
                    <td class="text-center">Application<br /> Of Learning & <br />Development</td>
                    <td>Rater</td>
                    <td class="text-center">Interview</td>
                    <td class="text-center">Written</td>
                    <td class="text-center">Skills</td>
                    <td class="text-center">Status</td>
                    
                </tr>
                <?php 
                $applications = $this->Common->two_cond('hris_applications', 'jobID', $jrow->jobID,'dq',1);
                $count=1;
                foreach($applications as $row){ 
                    $b = $this->Common->one_cond_row('hris_applicant','empEmail',$row->empEmail);
                    if(!empty($b)){
                        $a = $this->Common->one_cond_row('hris_applicant','empEmail',$row->empEmail);
                        $rn = $a->record_no;
                        $rating = $this->Common->one_cond_row('hris_rating_none','appID',$row->appID,'record_no',$a->record_no);
                    }else{
                        $a = $this->Common->one_cond_row('hris_staff','IDNumber',$row->empEmail);
                        $rn = $a->IDNumber;
                        $rating = $this->Common->one_cond_row('hris_rating_none','appID',$row->appID,'record_no',$a->IDNumber);
                    }
                    $user1 = $this->Common->one_cond_row('users','id',$rating->eval_id1);
                    $user2 = $this->Common->one_cond_row('users','id',$rating->eval_id2);
                    $user3 = $this->Common->one_cond_row('users','id',$rating->eval_id3);
                    
                    

                    
                ?>
                <tr>
                    <td><?= $count++; ?></td>
                    <td><?= $rn; ?></td>
                    <td><a style="text-decoration:none; color:#222" target="_blank" href="<?= base_url(); ?>pages/<?php echo !empty($b) ? 'ma' : 'ma_staff'; ?>/<?php echo !empty($b) ? $a->id : $a->IDNumber; ?>/<?= $row->jobID; ?>/<?= $row->pre_school; ?>/<?= $row->appID; ?>/<?php echo !empty($b) ? $a->record_no : $a->IDNumber; ?>/" class="text-success tooltips" data-placement="top" data-toggle="tooltip" data-original-title="View Applicant Information"><?= $a->LastName.', '. $a->MiddleName.' '.$a->FirstName; ?></a></td>
                    <td><?= $a->perBarangay; ?> <?= $a->perCity; ?></td>
                    <td class="text-center"><?= ($rating->educ == 0.00001) ? '' : $rating->educ; ?></td>
                    <td class="text-center"><?= ($rating->trainings == 0.00001) ? '' : $rating->trainings; ?></td>
                    <td class="text-center"><?= ($rating->experience == 0.00001) ? '' : $rating->experience; ?></td>
                    <td class="text-center"><?= ($rating->performance == 0.00001) ? '' : $rating->performance; ?></td>
                    <td class="text-center"><?= ($rating->oa == 0.00001) ? '' : $rating->oa; ?></td>
                    <td class="text-center"><?= ($rating->ae == 0.00001) ? '' : $rating->ae; ?></td>
                    <td class="text-center"><?= ($rating->ald == 0.00001) ? '' : $rating->ald; ?></td>
                    <td style="background-color:#BFECFF;"><?php if($rating->eval_id1 !=0 ){echo $user1->username; } ?></td>
                    <td class="text-center"><?= ($rating->interview == 0.00001) ? '' : $rating->interview; ?></td>
                    <td class="text-center"><?= ($rating->written == 0.00001) ? '' : $rating->written; ?></td>
                    <td class="text-center"><?= ($rating->skills == 0.00001) ? '' : $rating->skills; ?></td>
                    <td style="text-align:center"><span style="background-color:<?php if($row->appStatus == 'Rated'){echo "#08C2FF";}else{echo "#FCF596";}?>; padding:3px 10px; ">
                        <?= $row->appStatus;?></span>
                    </td>
                </tr>
                <?php } ?>
               
                
                <?php  }} ?>
            </table>

         
        
        
        </div>

            <!-- The Modal -->
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close" id="closeModalBtn">&times;</span>
            <h2>Modal Heading</h2>
            <p>This is a simple modal window. You can put any content here!</p>
        </div>
    </div>


      


        
    </body>
</html>


<script>
    function fnExcelReport() {
    var tab_text = "<table border='2px'><tr bgcolor='#87AFC6'>";
    var j = 0;
    var tab = document.getElementById('myTable'); // id of table

    for (j = 0; j < tab.rows.length; j++) {
        tab_text = tab_text + tab.rows[j].innerHTML + "</tr>";
        //tab_text=tab_text+"</tr>";
    }

    tab_text = tab_text + "</table>";
    tab_text = tab_text.replace(/<A[^>]*>|<\/A>/g, "");//remove if u want links in your table
    tab_text = tab_text.replace(/<img[^>]*>/gi, ""); // remove if u want images in your table
    tab_text = tab_text.replace(/<input[^>]*>|<\/input>/gi, ""); // reomves input params

    var msie = window.navigator.userAgent.indexOf("MSIE ");

    // If Internet Explorer
    if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./)) {
        txtArea1.document.open("txt/html", "replace");
        txtArea1.document.write(tab_text);
        txtArea1.document.close();
        txtArea1.focus();

        sa = txtArea1.document.execCommand("SaveAs", true, "Say Thanks to Sumit.xls");
    } else {
        // other browser not tested on IE 11
        sa = window.open('data:application/vnd.ms-excel,' + encodeURIComponent(tab_text));
    }

    return sa;
}




</script>