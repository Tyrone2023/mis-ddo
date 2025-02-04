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
            
           
            }
        </style>
    
    </head>



    <body class="aip_generate" id="printTable">

        <div class="cert">
            <img class="logo" src="<?= base_url(); ?>assets/images/report/ke.png" alt="">
            <p style="margin-bottom:0;">
            <span class="rp">Republic of the Philippines</span><br />
                <span class="de">Department of Education</span><br />
                <span class="r">Region XI</span><br />
                <span class="r">Schools Division of Davao De Oro</span>
            </p>

            <div class="hr" style="margin:10px 0"></div>
            <h4 style="margin:40px 0">SSC Validation Status Report</h4>

            <table class="rrr" id='myTable'>
                <tr>
                    <th>No.</th>
                    <th>Name of School</th>
                    <th>Total Applicants</th>
                    <th>Total Validated</th>
                    <th>Validation Percentage (%)</th>
                </tr>
                <?php 
                    $c=1;
                    $y = date('Y');
                    foreach($data as $row){
                     $school = $this->Common->one_cond_row('schools', 'schoolID', $row->pre_school);
                     $app = $this->Common->two_cond_count_row('hris_applications', 'pre_school', $row->pre_school,'app_year',$y);
                     $validated = $this->Common->three_cond_not_equal_count_row('hris_applications', 'pre_school', $row->pre_school,'app_year',$y,'appStatus','Application Submitted');
                   
                ?>
                <tr>
                    <td style="text-align:center"><?= $c++; ?></td>
                    <td><?= strtoupper($row->schoolName); ?></td>
                    <td style="text-align:center"><?= $app->num_rows(); ?></td>
                    <td style="text-align:center"><?= $validated->num_rows(); ?></td>
                    <td  style="text-align:center">
                        <?php
                        $a = $app->num_rows();
                        $v = $validated->num_rows();
                        if($v != 0){
                        $per = round(($v / $a) * 100,0);
                        
                        echo '<span ';
                        if($per != 100){echo " style='color:red; font-weight:bold' ";}
                        echo '>';
                        echo $per.'%'.'</span>';
                        }else{
                            echo '0%';
                        }
                        ?>
                     </td>
                </tr>
                <?php }  ?>
            </table>

         
        
        
        </div>

       


        
    </body>
</html>