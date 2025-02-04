<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <?php include('includes/page-title.php'); ?>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Responsive bootstrap 4 admin template" name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="<?= base_url(); ?>assets/images/favicon.ico">

        <!-- Plugins css-->
        <link href="<?= base_url(); ?>assets/css/renren.css" rel="stylesheet" type="text/css" />
        <link href="https://db.onlinewebfonts.com/a/0nH393RJctHgt1f2YvZvyruY" rel="stylesheet" type="text/css"/>
 

    </head>


    <body class="aip_generate app_print ppmp aip" id="printTable">
    <?php if($this->session->position == 'School'){ ?>
        <div class="links">
                <a href="<?= base_url(); ?>Page/generate_aip" class="btn">AIP</a>
                <a href="<?= base_url(); ?>Page/generate_sop" class="btn btn-info">SOP</a>
                <a href="<?= base_url(); ?>Page/generate_app" class="btn btn-secondary">APP</a>
                <!-- <a href="<?= base_url(); ?>Page/generate_ppmp" class="btn btn-primary">PPMP</a> -->
                <a href="<?= base_url(); ?>Page/implementation_plans" class="btn btn-success">PLANS</a>
        </div>
        <?php }elseif($this->session->position == 'Admin' || $this->session->position == 'smme'){ ?>
        <div class="links">
                <a href="<?= base_url(); ?>Page/aip_admin/<?= $data_row->school_id.'/'.$data_row->fy.'/'.$data_row->b_code.'/'.$data_row->id; ?>" class="btn">AIP</a>
                <a href="<?= base_url(); ?>Page/generate_sop_admin/<?= $data_row->school_id.'/'.$data_row->fy.'/'.$data_row->b_code.'/'.$data_row->id; ?>" class="btn btn-info">SOP</a>
                <?php $sap = $this->SGODModel->two_cond_row('sgod_app_percentage','b_code',$data_row->b_code,'fy',$data_row->fy); ?>
                <?php if(!empty($sap)){?>
                <a href="<?= base_url(); ?>Page/generate_app_admin/<?= $data_row->school_id.'/'.$data_row->fy.'/'.$data_row->b_code.'/'.$data_row->id; ?>" class="btn btn-secondary">APP</a>
                <a href="<?= base_url(); ?>Page/generate_ppmp_admin/<?= $school->schoolID.'/'.$data_row->fy.'/'.$data_row->b_code.'/'.$data_row->id; ?>" class="btn btn-primary">PPMP</a>
                <?php } ?>
                <a href="<?= base_url(); ?>Page/aip_sub_district" class="btn btn-info">By District</a>
                <a href="<?= base_url(); ?>Page/aip_track/<?= $this->uri->segment(6); ?>" class="btn btn-success">View Status</a>
        </div>
    <?php } ?>
    
    <div class="at">
    
   
    </div>
   


    <img class="logo" src="<?= base_url(); ?>assets/images/report/ke.png" alt="">
    <p>
    <span class="rp">Republic of the Philippines</span><br />
        <span class="de">Department of Education</span><br />
        <span class="r">Region XI</span><br />
        <span class="r">School Division of Davao Oriental</span><br />
        <span class="sadress"><?= strtoupper($school->district); ?><br />
         <?= strtoupper($school->schoolName); ?><br />
         <?= strtoupper($school->sitio); ?> <?= strtoupper($school->brgy); ?>, <?= strtoupper($school->city); ?>, <?= strtoupper($school->province); ?></span> 
    </p>
    <div class="hr"></div>
    <h1><?= $title; ?><br />FY <?= $fy; ?> </h1>
   

    <table>
        <?php 
            $mb = '.'.$abp->mb;
            $mr = '.'.$abp->mr;
            $tlip = '.'.$abp->tli;
            $tst = '.'.$abp->tst;


            $mooe = $ssa->alloc_amount; 
            $mandatory = $mooe*$mb;
            $minor = $mooe*$mr;
            $tli = $mooe*$tlip;
            $ac = $mooe*$tst;
            $monthly = $mooe/12;
            $quarterly = $monthly*3;
        ?>
        
            <tr>
            <th colspan="32" class="nobc"></th>
            <th colspan="2">Monthly</th>
            </tr>
            <tr>
                <th colspan="4">Source of Fund:</th>
                <th colspan="8" class="nobc"> MOOE</th>
                <th colspan="14">Mandatory   (<?= $abp->mb; ?>%):</th>
                <th colspan="6" class="nobc"><?= number_format(($mandatory), 2, '.', ','); ?></th>
                <th colspan="2" class="nobc"><?= number_format(($monthly*$mb), 2, '.', ','); ?></th><?php $mbmc = $monthly*$mb; ?>
            </tr>
            <tr>
                <th colspan="4">Annual Amount:</th>
                <th colspan="8" class="nobc"><?= number_format(($mooe), 2, '.', ','); ?></th>
                <th colspan="14">Minor Repair (<?= $abp->mr; ?>%)</th>
                <th colspan="6" class="nobc"><?= number_format(($minor), 2, '.', ','); ?></th>
                <th colspan="2" class="nobc"><?= number_format(($monthly*$mr), 2, '.', ','); ?></th><?php $mrmc = $monthly*$mr; ?>
            </tr>
            <tr>
                <th colspan="4">Monthly</th>
                <th colspan="8" class="nobc"><?= number_format(($monthly), 2, '.', ','); ?></th></th>
                <th colspan="14">Teaching-Learning Instructions (<?= $abp->tli; ?>%)</th>
                <th colspan="6" class="nobc"><?= number_format(($tli), 2, '.', ','); ?></th>
                <th colspan="2" class="nobc"><?= number_format(($monthly*$tlip), 2, '.', ','); ?></th><?php $tlimc = $monthly*$tlip; ?>
            </tr>
            <tr>
                <th colspan="4">Quarterly</th>
                <th colspan="8" class="nobc"><?= number_format(($quarterly), 2, '.', ','); ?></th>
                <th colspan="14">Attendance to & Conduct of Trainings/Seminars/Conferences (<?= $abp->tst; ?>%) </th>
                <th colspan="6" class="nobc"><?= number_format(($ac), 2, '.', ','); ?></th>
                <th colspan="2" class="nobc"><?= number_format(($monthly*$tst), 2, '.', ','); ?></th><?php $tstmc = $monthly*$tst; ?>
            </tr>
            
            
         
        <tbody >
            <tr>
                <td rowspan="2">No.</td>
                <td rowspan="2">ITEM & DESCRIPTION</td>
                <td rowspan="2">UNIT PRICE</td>
                <td rowspan="2">Unit Measure</td>
                <td colspan="7">1st Quarter</td>
                <td colspan="7">2nd Quarter</td>
                <td colspan="7">3rd Quarter</td>
                <td colspan="7">4rth Quarter</td>
                <td>Total</td>
            </tr>
            <tr>
                <td colspan="2">January</td>
                <td colspan="2">February</td>
                <td colspan="2">March</td>
                <td>Total</td>
                <td colspan="2">April</td>
                <td colspan="2">May</td>
                <td colspan="2">June</td>
                <td>Total</td>
                <td colspan="2">July</td>
                <td colspan="2">August</td>
                <td colspan="2">September</td>
                <td>Total</td>
                <td colspan="2">October</td>
                <td colspan="2">November</td>
                <td colspan="2">December</td>
                <td>Total</td>
                <td>Amount</td>
            </tr>
            <tr>
                <td colspan="4"></td>
                <td>Quantity</td>
                <td>Amount </td>
                <td>Quantity</td>
                <td>Amount </td>
                <td>Quantity</td>
                <td>Amount </td>
                <td></td>
                <td>Quantity</td>
                <td>Amount </td>
                <td>Quantity</td>
                <td>Amount </td>
                <td>Quantity</td>
                <td>Amount </td>
                <td></td>
                <td>Quantity</td>
                <td>Amount </td>
                <td>Quantity</td>
                <td>Amount </td>
                <td>Quantity</td>
                <td>Amount </td>
                <td></td>
                <td>Quantity</td>
                <td>Amount </td>
                <td>Quantity</td>
                <td>Amount </td>
                <td>Quantity</td>
                <td>Amount </td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td colspan="33" class="bar">I. MANDATORY (<?= $abp->mb; ?>%)</td>
            </tr>
            <?php
                $get_app = $this->Reg->aip_app_join(); 
                foreach($get_app as $row){
            ?>
            <tr>
                <td></td>
                <td><?= $row->materials; ?></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <?php } ?>

            


        </tbody> 
    </table>








    </body>
    </html>

    