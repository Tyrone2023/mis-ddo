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

        <style>
            body{
                font-family: Arial, Helvetica, sans-serif;
                font-size:10px;
                margin:20px;
            }
            a{
                text-decoration:none;
            }
            .dcpr{
                border-collapse: collapse;
            }

            .dcpr td, .dcpr th{
                border:1px solid #222;
                padding:5px 10px;
            }
            .text-center{
                text-align:center;
            }
            .dcpr th{
                background-color:#7c7979;
                color:#fff;
            }
            .rwrap{
                margin:auto 20px;
                overflow-x:auto;
                overflow: scroll;
            }
            
        </style>
        
    
    </head>

    <button id="btnExport" onclick="fnExcelReport();"> EXPORT TO EXCEL</button>



    <body>
        <div class="rwrap">
            <h1 class="text-center"><?= $title; ?></h1>

            <table class="dcpr" id='myTable'>
                <tr>
                    <th>ORGANIZATIONAL<br /> UNIT (1)</th>
                    <th>ITEM NUMBER (2)</th>	
                    <th>POSITION TITLE (3)</th>	
                    <th>SALARY GRADE (4)</th>	
                    <th>AUTHORIZED <br />ANNUAL SALARY (5)</th>	
                    <th>ACTUAL ANNUAL<br /> SALARY (6)</th>	
                    <th>STEP (7)</th>	
                    <th>AREA CODE (8)</th>	
                    <th>AREA TYPE (9)</th>	
                    <th>LEVEL (10)</th>		
                    <th>LAST NAME (11)</th>	
                    <th>FIRST NAME (12)</th>	
                    <th>MIDDLE NAME (13)</th>	
                    <th>SEX (14)</th>	
                    <th>DATE OF BIRTH (15)</th>	
                    <th>TIN (16)</th>	
                    <th>UMID NO. (17)</th>	
                    <th>DATE OF <br />ORIGINAL <br />APPOINTMENT (18)</th>	
                    <th>DATE OF <br />LAST PROMOTION/<br /> APPOINTMENT (19)</th>	
                    <th>STATUS (20)</th>
                    <th>CIVIL <br />SERVICE <br />ELIGIBILITY (21)</th>	
                    <th>COMMENT/ <br />ANNOTATION (22)</th>
                </tr>

                <tr style="background-color:#d2d2d2">
                    <td colspan="22">ELEMENTARY</td>
                </tr>
                <?php 
                    $kyle=1;
                    $elem_emp = $this->Common->two_cond_order_by('hris_staff','payGroup','ELEMENTARY','currentStatus','Active','sgNo','DESC'); 
                    foreach($elem_emp as $emprow){
                ?>
                <tr>
                    <td><?= $kyle++; ?></td>
                    <td><span style="white-space: nowrap"><?= strtoupper($emprow->itemNo); ?></span></td>
                    <td><span style="white-space: nowrap"><?= strtoupper($emprow->empPosition); ?><span></td>
                    <td><?= $emprow->sgNo; ?></td>
                    <td><?= $emprow->authAnSalary; ?></td>
                    <td><?= $emprow->actualSalary; ?></td>
                    <td><?= $emprow->stepNo; ?></td>
                    <td><?= $emprow->resZipCode; ?></td>
                    <td></td>
                    <td></td>
                    <td><a href="<?= base_url(); ?>Pages/employee_edit/<?= $emprow->IDNumber; ?>" target="_blank"><?= strtoupper($emprow->LastName); ?></a></td>
                    <td><?= strtoupper($emprow->FirstName); ?></td>
                    <td><?= strtoupper($emprow->MiddleName); ?></td>
                    <td><?= strtoupper($emprow->Sex); ?></td>
                    <td><?= $emprow->BirthDate; ?></td>
                    <td><?= strtoupper($emprow->tinNo); ?></td>
                    <td><?= strtoupper($emprow->umid); ?></td>
                    <td><?= $emprow->dateHired; ?></td>
                    <td><?= $emprow->lastAppointmentDate; ?></td>
                    <td>P</td>
                    <td><?= $emprow->csEligibility; ?></td>
                    <td></td>
                </tr>
                <?php } ?>


                <?php foreach($staff as $row){ ?>
                <tr style="background-color:#d2d2d2">
                    <td><?= $row->payGroup; ?></td>
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
                <?php 
                    $ivy=1;
                    $emp = $this->Common->two_cond_order_by('hris_staff','payGroup',$row->payGroup,'currentStatus','Active','sgNo','DESC');
                    foreach($emp as $emprow){
                ?>
                    
                <tr>
                    <td><?= $ivy++; ?></td>
                    <td><span style="white-space: nowrap"><?= strtoupper($emprow->itemNo); ?></span></td>
                    <td><span style="white-space: nowrap"><?= strtoupper($emprow->directHeadPosition); ?><span></td>
                    <td><?= $emprow->sgNo; ?></td>
                    <td><?= $emprow->authAnSalary; ?></td>
                    <td><?= $emprow->actualSalary; ?></td>
                    <td><?= $emprow->stepNo; ?></td>
                    <td><?= $emprow->resZipCode; ?></td>
                    <td></td>
                    <td></td>
                    <td><a href="<?= base_url(); ?>Pages/employee_edit/<?= $emprow->IDNumber; ?>" target="_blank"><?= strtoupper($emprow->LastName); ?></a></td>
                    <td><?= strtoupper($emprow->FirstName); ?></td>
                    <td><?= strtoupper($emprow->MiddleName); ?></td>
                    <td><?= strtoupper($emprow->Sex); ?></td>
                    <td><?= $emprow->BirthDate; ?></td>
                    <td><?= strtoupper($emprow->tinNo); ?></td>
                    <td><?= strtoupper($emprow->umid); ?></td>
                    <td><?= $emprow->dateHired; ?></td>
                    <td><?= $emprow->lastAppointmentDate; ?></td>
                    <td>P</td>
                    <td><?= $emprow->csEligibility; ?></td>
                    <td></td>
                </tr>
                
                <?php } }?>
                
            </table>

         
        
        
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