<?php

// Create a function for converting the amount in words
function AmountInWords(float $amount)
{
   $amount_after_decimal = round($amount - ($num = floor($amount)), 2) * 100;
   // Check if there is any number after decimal
   $amt_hundred = null;
   $count_length = strlen($num);
   $x = 0;
   $string = array();
   $change_words = array(0 => '', 1 => 'One', 2 => 'Two',
     3 => 'Three', 4 => 'Four', 5 => 'Five', 6 => 'Six',
     7 => 'Seven', 8 => 'Eight', 9 => 'Nine',
     10 => 'Ten', 11 => 'Eleven', 12 => 'Twelve',
     13 => 'Thirteen', 14 => 'Fourteen', 15 => 'Fifteen',
     16 => 'Sixteen', 17 => 'Seventeen', 18 => 'Eighteen',
     19 => 'Nineteen', 20 => 'Twenty', 30 => 'Thirty',
     40 => 'Forty', 50 => 'Fifty', 60 => 'Sixty',
     70 => 'Seventy', 80 => 'Eighty', 90 => 'Ninety');
    $here_digits = array('', 'Hundred','Thousand','Hundred', 'Million');
    while( $x < $count_length ) {
      $get_divider = ($x == 2) ? 10 : 100;
      $amount = floor($num % $get_divider);
      $num = floor($num / $get_divider);
      $x += $get_divider == 10 ? 1 : 2;
      if ($amount) {
       $add_plural = (($counter = count($string)) && $amount > 9) ? 's' : null;
       $amt_hundred = ($counter == 1 && $string[0]) ? ' and ' : null;
       $string [] = ($amount < 21) ? $change_words[$amount].' '. $here_digits[$counter]. $add_plural.' 
       '.$amt_hundred:$change_words[floor($amount / 10) * 10].' '.$change_words[$amount % 10]. ' 
       '.$here_digits[$counter].$add_plural.' '.$amt_hundred;
        }
   else $string[] = null;
   }
   $implode_to_Rupees = implode('', array_reverse($string));
   $get_paise = ($amount_after_decimal > 0) ? "And " . ($change_words[$amount_after_decimal / 10] . " 
   " . $change_words[$amount_after_decimal % 10]) . ' Centavos' : '';
   return ($implode_to_Rupees ? $implode_to_Rupees . 'Pesos ' : '') . $get_paise;
}
?>

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
        
        <style>
            @page {
                    size: A4;
                    margin: 20px 0;
                    }
        </style>
    </head>


    <body class="aip_generate" id="printTable">

        <table style="width:100%; display:none">
            <tr>
                <th>Quantity</th>
                <th>Unit Of Measure</th>
                <th>Item Description</th>
                <th>Stock No.</th>
                <th>Estimated Unit Cost</th>
                <th>Estimated Cost </th>
            </tr>

            
            <tr>
                <td colspan="5" class="alignLeft2">I. MANDATORY BILLS</td>
                <td></td>
            </tr>
            <?php $tmb = 0;
                foreach($mb as $row){?>
                <?php 
                $get_app = $this->SGODModel->two_cond_rca('sgod_app', 'aip_id',$row->id,$mon);
                
                foreach($get_app as $row){?>
                <?php 
                    if($mon == 'jan'){
                        $mq = $row->qjan;
                        $m = $row->jan;
                    }elseif($mon == 'feb'){
                        $mq = $row->qfeb;
                        $m = $row->feb;
                    }elseif($mon == 'mar'){
                        $mq = $row->qmar;
                        $m = $row->mar;
                    }elseif($mon == 'april'){
                        $mq = $row->qapril;
                        $m = $row->april;
                    }elseif($mon == 'may'){
                        $mq = $row->qmay;
                        $m = $row->may;
                    }elseif($mon == 'june'){
                        $mq = $row->qjune;
                        $m = $row->june;
                    }elseif($mon == 'july'){
                        $mq = $row->qjuly;
                        $m = $row->july;
                    }elseif($mon == 'aug'){
                        $mq = $row->qaug;
                        $m = $row->aug;
                    }elseif($mon == 'sept'){
                        $mq = $row->qsept;
                        $m = $row->sept;
                    }elseif($mon == 'oct'){
                        $mq = $row->qoct;
                        $m = $row->oct;
                    }elseif($mon == 'nov'){
                        $mq = $row->qnov;
                        $m = $row->nov;
                    }else{
                        $mq = $row->qdec;
                        $m = $row->ddec;
                    }
                    
                    ?>

                <tr>
                    <td><?= $mq; ?></td>
                    <td><?= $row->unit_measure; ?></td>
                    <td><?= $row->materials; ?></td>
                    <td></td>
                    <td><?= number_format($m); ?></td>
                    <td><?php $mb_ups = (double)$m*(double)$mq; echo  number_format($mb_ups); ?></td>
                    
                </tr>

                <?php $tmb+=$mb_ups;?>
                <?php  } ?>
                
            <?php  }  ?>


            <tr>
                <td colspan="5" class="alignLeft2">  II. MINOR REPAIR</td>
                <td></td>
            </tr>
            <?php $tmr = 0;
                foreach($mr as $row){?>
                <?php 
                $get_app = $this->SGODModel->two_cond_rca('sgod_app', 'aip_id',$row->id,$mon);
                
                foreach($get_app as $row){?>
                <?php 
                    if($mon == 'jan'){
                        $mq = $row->qjan;
                        $m = $row->jan;
                    }elseif($mon == 'feb'){
                        $mq = $row->qfeb;
                        $m = $row->feb;
                    }elseif($mon == 'mar'){
                        $mq = $row->qmar;
                        $m = $row->mar;
                    }elseif($mon == 'april'){
                        $mq = $row->qapril;
                        $m = $row->april;
                    }elseif($mon == 'may'){
                        $mq = $row->qmay;
                        $m = $row->may;
                    }elseif($mon == 'june'){
                        $mq = $row->qjune;
                        $m = $row->june;
                    }elseif($mon == 'july'){
                        $mq = $row->qjuly;
                        $m = $row->july;
                    }elseif($mon == 'aug'){
                        $mq = $row->qaug;
                        $m = $row->aug;
                    }elseif($mon == 'sept'){
                        $mq = $row->qsept;
                        $m = $row->sept;
                    }elseif($mon == 'oct'){
                        $mq = $row->qoct;
                        $m = $row->oct;
                    }elseif($mon == 'nov'){
                        $mq = $row->qnov;
                        $m = $row->nov;
                    }else{
                        $mq = $row->qdec;
                        $m = $row->ddec;
                    }

                    
                    ?>
                <tr>
                    <td><?= $mq; ?></td>
                    <td><?= $row->unit_measure; ?></td>
                    <td><?= $row->materials; ?></td>
                    <td></td>
                    <td><?= number_format($m); ?></td>
                    <td><?php $mb_ups = (double)$m*(double)$mq; echo  number_format($mb_ups); ?></td>
                    
                </tr>

                <?php $tmr+=$mb_ups;?>
                <?php  } ?>
                
            <?php  }  ?>

            <tr>
                <td colspan="5" class="alignLeft2"> III. TEACHING-LEARNING INSTRUCTION</td>
                <td></td>
            </tr>
            <?php $ttli = 0;
                foreach($tli as $row){?>
                <?php 
                $get_app = $this->SGODModel->two_cond_rca('sgod_app', 'aip_id',$row->id,$mon);
                
                foreach($get_app as $row){?>
                <?php 
                    if($mon == 'jan'){
                        $mq = $row->qjan;
                        $m = $row->jan;
                    }elseif($mon == 'feb'){
                        $mq = $row->qfeb;
                        $m = $row->feb;
                    }elseif($mon == 'mar'){
                        $mq = $row->qmar;
                        $m = $row->mar;
                    }elseif($mon == 'april'){
                        $mq = $row->qapril;
                        $m = $row->april;
                    }elseif($mon == 'may'){
                        $mq = $row->qmay;
                        $m = $row->may;
                    }elseif($mon == 'june'){
                        $mq = $row->qjune;
                        $m = $row->june;
                    }elseif($mon == 'july'){
                        $mq = $row->qjuly;
                        $m = $row->july;
                    }elseif($mon == 'aug'){
                        $mq = $row->qaug;
                        $m = $row->aug;
                    }elseif($mon == 'sept'){
                        $mq = $row->qsept;
                        $m = $row->sept;
                    }elseif($mon == 'oct'){
                        $mq = $row->qoct;
                        $m = $row->oct;
                    }elseif($mon == 'nov'){
                        $mq = $row->qnov;
                        $m = $row->nov;
                    }else{
                        $mq = $row->qdec;
                        $m = $row->ddec;
                    }
                    
                    ?>
                <tr>
                    <td><?= $mq; ?></td>
                    <td><?= $row->unit_measure; ?></td>
                    <td><?= $row->materials; ?></td>
                    <td></td>
                    <td><?= number_format($m); ?></td>
                    <td><?php $mb_ups = (double)$m*(double)$mq; echo  number_format($mb_ups); ?></td>
                    
                </tr>
                <?php $ttli+=$mb_ups;?>
                <?php  } ?>
                
            <?php  }  ?>
            <tr>
                <td colspan="5" class="alignLeft2">IV.TRAININGS/SEMINAR/TRAVEL</td>
                <td></td>
            </tr>
            <?php $ttst = 0;
                foreach($tst as $row){?>
                <?php 
                $get_app = $this->SGODModel->two_cond_rca('sgod_app', 'aip_id',$row->id,$mon);
                
                foreach($get_app as $row){?>
                <?php 
                    if($mon == 'jan'){
                        $mq = $row->qjan;
                        $m = $row->jan;
                    }elseif($mon == 'feb'){
                        $mq = $row->qfeb;
                        $m = $row->feb;
                    }elseif($mon == 'mar'){
                        $mq = $row->qmar;
                        $m = $row->mar;
                    }elseif($mon == 'april'){
                        $mq = $row->qapril;
                        $m = $row->april;
                    }elseif($mon == 'may'){
                        $mq = $row->qmay;
                        $m = $row->may;
                    }elseif($mon == 'june'){
                        $mq = $row->qjune;
                        $m = $row->june;
                    }elseif($mon == 'july'){
                        $mq = $row->qjuly;
                        $m = $row->july;
                    }elseif($mon == 'aug'){
                        $mq = $row->qaug;
                        $m = $row->aug;
                    }elseif($mon == 'sept'){
                        $mq = $row->qsept;
                        $m = $row->sept;
                    }elseif($mon == 'oct'){
                        $mq = $row->qoct;
                        $m = $row->oct;
                    }elseif($mon == 'nov'){
                        $mq = $row->qnov;
                        $m = $row->nov;
                    }else{
                        $mq = $row->qdec;
                        $m = $row->ddec;
                    }
                    
                    ?>
                <tr>
                    <td><?= $mq; ?></td>
                    <td><?= $row->unit_measure; ?></td>
                    <td><?= $row->materials; ?></td>
                    <td></td>
                    <td><?= number_format($m); ?></td>
                    <td><?php $mb_ups = (double)$m*(double)$mq; echo  number_format($mb_ups); ?></td>
                    
                </tr>
                <?php $ttst+=$mb_ups;?>
                <?php  } ?>
                
            <?php  }  ?>

            <tr>
                <td colspan="5" class="alignLeft">TOTAL</td>
                <td><?php $omtt = $tmb+$tmr+$ttli+$ttst;  ?></td>
            </tr>
        </table>



    <img class="logo" src="<?= base_url(); ?>assets/images/report/ke.png" alt="">
    <p>
    <span class="rp">Republic of the Philippines</span><br />
        <span class="de">Department of Education</span><br />
        <span class="r">Region XI</span><br />
        <span class="r">School Division of Davao Oriental</span><br />
        <?php $get_amount= AmountInWords($omtt); ?>
        <span class="sadress"><?= strtoupper($school->district); ?><br />
         <?= strtoupper($school->schoolName); ?><br />
         <?= strtoupper($school->sitio); ?> <?= strtoupper($school->brgy); ?>, <?= strtoupper($school->city); ?>, <?= strtoupper($school->province); ?></span> 
    </p>

    
    <div class="hr hrrca"></div>

    <?php 
                if($mon == 'jan'){
                    $month = 'January';
                }elseif($mon == 'feb'){
                    $month = 'February';
                }elseif($mon == 'mar'){
                    $month = 'March';
                }elseif($mon == 'april'){
                    $month = 'April';
                }elseif($mon == 'may'){
                    $month = 'May';
                }elseif($mon == 'june'){
                    $month = 'June';
                }elseif($mon == 'july'){
                    $month = 'July';
                }elseif($mon == 'aug'){
                    $month = 'August';
                }elseif($mon == 'sept'){
                    $month = 'September';
                }elseif($mon == 'oct'){
                    $month = 'October';
                }elseif($mon == 'nov'){
                    $month = 'November';
                }else{
                    $month = 'December';
                }
       
                ?>



    <div class="rca">
    <p><?php 
        date_default_timezone_set('Asia/Manila');
        //echo date('F d, Y', strtotime('20130814')); 
        echo date('F d, Y', time());
    ?></p>
    <p class="name"><b>DR. JOSEPHINE L. FADUL</b><br />Schools Division Superintendent</p>
    <p class="sname"><b>Thru: DENNIS Y. BELARMINO</b><br/><span class="hide"><b>Thru: </b></span>Accountant III</p>
    <p class="maam">Maam:</p>
    <p class="coa">In pursuance to COA Circular No. 97-002 dated February 10, 2007, the undersigned respectfully request the amount of <b> <?= $get_amount; ?></b>(&#8369; <?= number_format($omtt); ?> ) as Cash Advance for the Month of <b><?= $month; ?></b> the Maintenance & Other Operating Expenses (MOOE) of <b><?= strtoupper($school->schoolName); ?> <?= strtoupper($school->course); ?>, <?= strtoupper($school->sitio); ?>, <?= strtoupper($school->brgy); ?>, <?= strtoupper($school->city); ?>, <?= strtoupper($school->province); ?></b> for payments of bills/travels/ purchases of various supplies and materials listed below for the Month of <b><?= $month; ?></b>.</p>


    <table style="width:100%">
        <tr>
            <th>Quantity</th>
            <th>Unit Of Measure</th>
            <th>Item Description</th>
            <th>Stock No.</th>
            <th>Estimated Unit Cost</th>
            <th>Estimated Cost </th>
        </tr>

        
        <tr>
            <td colspan="5" class="alignLeft2">I. MANDATORY BILLS</td>
            <td></td>
        </tr>
        <?php $tmb = 0;
            foreach($mb as $row){?>
            <?php 
            $get_app = $this->SGODModel->two_cond_rca('sgod_app', 'aip_id',$row->id,$mon);
            
            foreach($get_app as $row){?>
            <?php 
                if($mon == 'jan'){
                    $mq = $row->qjan;
                    $m = $row->jan;
                }elseif($mon == 'feb'){
                    $mq = $row->qfeb;
                    $m = $row->feb;
                }elseif($mon == 'mar'){
                    $mq = $row->qmar;
                    $m = $row->mar;
                }elseif($mon == 'april'){
                    $mq = $row->qapril;
                    $m = $row->april;
                }elseif($mon == 'may'){
                    $mq = $row->qmay;
                    $m = $row->may;
                }elseif($mon == 'june'){
                    $mq = $row->qjune;
                    $m = $row->june;
                }elseif($mon == 'july'){
                    $mq = $row->qjuly;
                    $m = $row->july;
                }elseif($mon == 'aug'){
                    $mq = $row->qaug;
                    $m = $row->aug;
                }elseif($mon == 'sept'){
                    $mq = $row->qsept;
                    $m = $row->sept;
                }elseif($mon == 'oct'){
                    $mq = $row->qoct;
                    $m = $row->oct;
                }elseif($mon == 'nov'){
                    $mq = $row->qnov;
                    $m = $row->nov;
                }else{
                    $mq = $row->qdec;
                    $m = $row->ddec;
                }
                
                ?>

            <tr>
                <td><?= $mq; ?></td>
                <td><?= $row->unit_measure; ?></td>
                <td><?= $row->materials; ?></td>
                <td></td>
                <td><?= number_format($m); ?></td>
                <td><?php $mb_ups = (double)$m*(double)$mq; echo  number_format($mb_ups); ?></td>
                
            </tr>

            <?php $tmb+=$mb_ups;?>
            <?php  } ?>
            
        <?php  }  ?>


        <tr>
            <td colspan="5" class="alignLeft2">  II. MINOR REPAIR</td>
            <td></td>
        </tr>
        <?php $tmr = 0;
            foreach($mr as $row){?>
            <?php 
            $get_app = $this->SGODModel->two_cond_rca('sgod_app', 'aip_id',$row->id,$mon);
            
            foreach($get_app as $row){?>
            <?php 
                if($mon == 'jan'){
                    $mq = $row->qjan;
                    $m = $row->jan;
                }elseif($mon == 'feb'){
                    $mq = $row->qfeb;
                    $m = $row->feb;
                }elseif($mon == 'mar'){
                    $mq = $row->qmar;
                    $m = $row->mar;
                }elseif($mon == 'april'){
                    $mq = $row->qapril;
                    $m = $row->april;
                }elseif($mon == 'may'){
                    $mq = $row->qmay;
                    $m = $row->may;
                }elseif($mon == 'june'){
                    $mq = $row->qjune;
                    $m = $row->june;
                }elseif($mon == 'july'){
                    $mq = $row->qjuly;
                    $m = $row->july;
                }elseif($mon == 'aug'){
                    $mq = $row->qaug;
                    $m = $row->aug;
                }elseif($mon == 'sept'){
                    $mq = $row->qsept;
                    $m = $row->sept;
                }elseif($mon == 'oct'){
                    $mq = $row->qoct;
                    $m = $row->oct;
                }elseif($mon == 'nov'){
                    $mq = $row->qnov;
                    $m = $row->nov;
                }else{
                    $mq = $row->qdec;
                    $m = $row->ddec;
                }

                
                ?>
            <tr>
                <td><?= $mq; ?></td>
                <td><?= $row->unit_measure; ?></td>
                <td><?= $row->materials; ?></td>
                <td></td>
                <td><?= number_format($m); ?></td>
                <td><?php $mb_ups = (double)$m*(double)$mq; echo  number_format($mb_ups); ?></td>
                
            </tr>

            <?php $tmr+=$mb_ups;?>
            <?php  } ?>
            
        <?php  }  ?>

        <tr>
            <td colspan="5" class="alignLeft2"> III. TEACHING-LEARNING INSTRUCTION</td>
            <td></td>
        </tr>
        <?php $ttli = 0;
            foreach($tli as $row){?>
            <?php 
            $get_app = $this->SGODModel->two_cond_rca('sgod_app', 'aip_id',$row->id,$mon);
            
            foreach($get_app as $row){?>
            <?php 
                if($mon == 'jan'){
                    $mq = $row->qjan;
                    $m = $row->jan;
                }elseif($mon == 'feb'){
                    $mq = $row->qfeb;
                    $m = $row->feb;
                }elseif($mon == 'mar'){
                    $mq = $row->qmar;
                    $m = $row->mar;
                }elseif($mon == 'april'){
                    $mq = $row->qapril;
                    $m = $row->april;
                }elseif($mon == 'may'){
                    $mq = $row->qmay;
                    $m = $row->may;
                }elseif($mon == 'june'){
                    $mq = $row->qjune;
                    $m = $row->june;
                }elseif($mon == 'july'){
                    $mq = $row->qjuly;
                    $m = $row->july;
                }elseif($mon == 'aug'){
                    $mq = $row->qaug;
                    $m = $row->aug;
                }elseif($mon == 'sept'){
                    $mq = $row->qsept;
                    $m = $row->sept;
                }elseif($mon == 'oct'){
                    $mq = $row->qoct;
                    $m = $row->oct;
                }elseif($mon == 'nov'){
                    $mq = $row->qnov;
                    $m = $row->nov;
                }else{
                    $mq = $row->qdec;
                    $m = $row->ddec;
                }
                
                ?>
            <tr>
                <td><?= $mq; ?></td>
                <td><?= $row->unit_measure; ?></td>
                <td><?= $row->materials; ?></td>
                <td></td>
                <td><?= number_format($m); ?></td>
                <td><?php $mb_ups = (double)$m*(double)$mq; echo  number_format($mb_ups); ?></td>
                
            </tr>
            <?php $ttli+=$mb_ups;?>
            <?php  } ?>
            
        <?php  }  ?>
        <tr>
            <td colspan="5" class="alignLeft2">IV.TRAININGS/SEMINAR/TRAVEL</td>
            <td></td>
        </tr>
        <?php $ttst = 0;
            foreach($tst as $row){?>
            <?php 
            $get_app = $this->SGODModel->two_cond_rca('sgod_app', 'aip_id',$row->id,$mon);
            
            foreach($get_app as $row){?>
            <?php 
                if($mon == 'jan'){
                    $mq = $row->qjan;
                    $m = $row->jan;
                }elseif($mon == 'feb'){
                    $mq = $row->qfeb;
                    $m = $row->feb;
                }elseif($mon == 'mar'){
                    $mq = $row->qmar;
                    $m = $row->mar;
                }elseif($mon == 'april'){
                    $mq = $row->qapril;
                    $m = $row->april;
                }elseif($mon == 'may'){
                    $mq = $row->qmay;
                    $m = $row->may;
                }elseif($mon == 'june'){
                    $mq = $row->qjune;
                    $m = $row->june;
                }elseif($mon == 'july'){
                    $mq = $row->qjuly;
                    $m = $row->july;
                }elseif($mon == 'aug'){
                    $mq = $row->qaug;
                    $m = $row->aug;
                }elseif($mon == 'sept'){
                    $mq = $row->qsept;
                    $m = $row->sept;
                }elseif($mon == 'oct'){
                    $mq = $row->qoct;
                    $m = $row->oct;
                }elseif($mon == 'nov'){
                    $mq = $row->qnov;
                    $m = $row->nov;
                }else{
                    $mq = $row->qdec;
                    $m = $row->ddec;
                }
                
                ?>
            <tr>
                <td><?= $mq; ?></td>
                <td><?= $row->unit_measure; ?></td>
                <td><?= $row->materials; ?></td>
                <td></td>
                <td><?= number_format($m); ?></td>
                <td><?php $mb_ups = (double)$m*(double)$mq; echo  number_format($mb_ups); ?></td>
                
            </tr>
            <?php $ttst+=$mb_ups;?>
            <?php  } ?>
            
        <?php  }  ?>

        <tr>
            <td colspan="5" class="alignLeft">TOTAL</td>
            <td><?php $omt = $tmb+$tmr+$ttli+$ttst;  echo number_format($omt); ?></td>
            <?php $_SESSION['omt'] = $omt; ?>
        </tr>
    </table>



    <div class="fcon">
                <img style="width:90px; float:left;" src="https://qrcode.tec-it.com/API/QRCode?data=<?= base_url(); ?>Page/rca_view/<?= $data_row->school_id.'/'.$data_row->fy.'/'.$data_row->b_code.'/'.$mon; ?>" title="" />
                <div class="lcon">
                    System Generated Report<br />
                    Date Generated: <?php  date_default_timezone_set('Asia/Manila'); echo date('F d, Y', time()); ?><br />
                </div>
                <div class="blocker"></div>
    </div>


    </div>
    </body>
    </hmlm>
