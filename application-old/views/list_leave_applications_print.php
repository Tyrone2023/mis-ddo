
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leave Application Form</title>
    <style>
   body {
            font-family: Arial, sans-serif;
            font-size: 8px;
            line-height: 1.6;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            /* background-color: #f7f7f7; */
        }

        strong {
            font-size: 11px;
        }


        
        .header img {
            max-width: 100%;
        }

        .textheader h4 {
            text-align: center;
            margin-top: 8px;
            margin-bottom: 5px;
        }

        input[type="text"] {
            border: 1px solid #000;
            outline: none;
            width: 10px;
            height: 10px;
            text-align: center;
            font-size: 10px;
            padding: 0;
            margin: 5px;
        }

        input[type="text"]:focus {
            outline: none;
        }


        table {
            width: 100%;
            border-collapse: collapse;
            margin: 0px;
            padding: 0px;
        }

        /* tr {
            border: 1px solid #000000;
        } */
        th, td {
            padding-top: 0px;
            padding-bottom: 0px;
            padding-right: 5px;
            padding-left: 5px;
            border: none;
        }


        /* th {
            background-color: #f0f0f0;
        } */

        th[colspan="4"] {
            text-align: center;
        }

        th[colspan="2"] {
            width: 50%;
        }

        td[colspan="3"] {
            border-right: 1px solid #000;
                border-left: 1px solid #000;
                border-bottom: none;
        }
        td[colspan="6"] {
            border-right: 1px solid #000;
                border-left: 1px solid #000;
                border-bottom: none;
        }
 .minitable {
            float: left;
            margin-left: 30px;
            padding: 5px;
            width: 300px;
            height: 200px;
           
        }

        .asOf {
            float: left;
            margin-left: 30px;

        }

        .asOf {
            margin: 2px 0;
            text-align: center;
        }

        .asOf td {
            margin: 2px 0;
            text-align: center;
        }


        .minitable th {
            border: 1px solid #000;
        }

        .minitable tr {
            border: 1px solid #000;
        }

        .minitable td {
            border: 1px solid #000;
        }


        .signature {
            text-align: center;
            font-size: 10px;
            line-height: 1;
            margin-top: 70px;
        }

.signature p {
    margin: 0px;
    font-size: 12px;
}

.signature strong {
    margin: 0px;
    font-size: 12px;
}

/* .signature1 strong {
    font-size: 12px;
    margin: 0;
            padding: 0;
} */

.signature strong {
    font-size: 12px;
    display: inline-block;
    margin-right: 5px;
    margin-bottom: 0;
}

.signature p:last-child {
    margin-bottom: 0px; /* Add some space between the last line and the following content */
}

.signature strong:last-child {
    margin-bottom: 0px; /* Add some space between the last line and the following content */
}

.signature td {
    margin: 0px;
    padding: 0px;
}


.signature .signatureline {
    border-bottom: 1px solid #000;
    width: 300px; /* Adjust the width to reduce the length of the line */
    height: auto;
    margin: 0 auto; /* Center the line horizontally */
}


        .signature1 {
            text-align: center;
    font-size: 10px;
    line-height: 1;
    margin-top: 50px;
}

.signature1 p {
    margin: 0px;
    font-size: 12px;
}

.signature1 strong {
    margin: 0px;
    font-size: 12px;
}

/* .signature1 strong {
    font-size: 12px;
    margin: 0;
            padding: 0;
} */

.signature1 strong {
    font-size: 12px;
    display: inline-block;
    margin-right: 5px;
    margin-bottom: 0;
}

.signature1 p:last-child {
    margin-bottom: 0px; /* Add some space between the last line and the following content */
}

.signature1 strong:last-child {
    margin-bottom: 0px; /* Add some space between the last line and the following content */
}

.signature1 td {
    margin: 0px;
    padding: 0px;
}


.signature1 .signatureline {
    border-bottom: 1px solid #000;
    width: 300px; /* Adjust the width to reduce the length of the line */
    height: auto;
    margin: 0 auto; /* Center the line horizontally */
}
        


        table {

            border: 1px solid #000;
        }



        /* .line {
            border-bottom: 1px solid #000;
        } */

        .signature {
            /* font-weight: bold; */
            margin-top: 20px;
            text-align: center;
            font-size: 10px;
            line-height: 1;
    /* margin-top: 70px; */
        }

        .textheader h4 {
            font-size: 20px;
        }

        /* Media Query for A4 paper size */
        @media print {
            @page {
                size: A4;
                margin: 0;
            }

            body {
                margin: 2mm;
            }
        }
    </style>


</head>
<body>



    <div class="container"> 

                <div class="header">
                   <img src="<?=base_url(); ?>assets/images/hris/<?php echo $data1[0]->letterHead; ?>" alt="">									
                </div>

                <div class="textheader">
                    <h4>APPLICATION FOR LEAVE</h4>
                </div>



                <div class="table">
                    <table>
                     
                        <tr style="border-top: 1px solid #000; border-left: 1px solid #000; border-right: 1px solid #000;">
                            <td>1. OFFICE/DEPARTMENT</td>
                           
                            <td style="text-align:center; ">2. NAME:</td>
                            <td colspan="2" style="text-align:center; ">(Last)</td>
                            
                            <td colspan="2"style="text-align:center; ">(First)</td>
                            
                            <td colspan="2"style="text-align:center; ">(Middle)</td>
                        </tr>
                        <tr style="border-bottom: 1px solid #000; border-left: 1px solid #000; border-right: 1px solid #000;">
                            <td colspan="2"><span style="font-size: 10px;"><strong><?php echo $data[0]->Department; ?></strong></span></td>
                            <td colspan="2" style="text-align:center; "><span style="font-size: 10px;"><strong><?php echo $data[0]->LastName; ?></strong></span></td>
                            
                            <td colspan="2" style="text-align:center; "><span style="font-size: 10px;"><strong><?php echo $data[0]->FirstName; ?></strong></span></td>
                            
                            <td colspan="2" style="text-align:center; "><span style="font-size: 10px;"><strong><?php echo $data[0]->MiddleName; ?></strong></span></td>
                        </tr>

                        
                        <tr style="border: 1px solid #000;">
                            <td>3. DATE OF FILING: <span style="font-size: 10px;"><strong><?php echo $data[0]->appDate; ?></strong></span></td>
                            <td colspan="2"></td>
                        
                            <td>4. POSITION</td>
                            <td colspan="2"><span style="font-size: 10px;"><strong><?php echo $data[0]->empPosition; ?></strong></span></td>
                        
                            <td>5. SALARY</td>
                            <td colspan="2"><span style="font-size: 10px;"><strong><?php echo number_format($data[0]->monthlySalary,2); ?></strong></span></td>
                        </tr>


                        <!-- For Details -->


                        <tr style="border: 1px solid #000;">
                            <td colspan="10" style="text-align: center;"><strong>6. DETAILS OF APPLICATION</strong></td>
                        </tr>
                        <tr>
                            <td colspan="3" style="border-top: 1px solid #000;">6.A TYPE OF LEAVE TO BE AVAILED OF</td>
                            <td colspan="6" style="border-top: 1px solid #000;" >6.B DETAILS OF LEAVE</td>
                        </tr>
                        <tr>
                            <td colspan="3"> <input type="text"><strong>Vacation Leave </strong>(Sec. 51, Rule XVI, Omnibus Rules Implementing E.O. No. 292)</td>
                            <td colspan="6">In case of Vacation/Special Privilege Leave:</td>
                        </tr>

                        <tr>
                            <td colspan="3"> <input type="text"><strong>Mandatory/Forced Leave </strong>(Sec. 25, Rule XVI, Omnibus Rules Implementing E.O. No. 292)</td>
                            <td colspan="6"> <input type="text">Within the Philippines   ______________________________<div class="line"></div></td>
                        </tr>

                        <tr>
                            <td colspan="3"> <input type="text"><strong>Sick Leave </strong>(Sec. 43, Rule XVI, Omnibus Rules Implementing E.O. No. 292)</td>
                            <td colspan="6"> <input type="text">Abroad (Specify)      __________________________________<div class="line"></div></td>
                        </tr>

                        <tr>
                            <td colspan="3"> <input type="text"><strong>Maternity Leave </strong>(R.A. No. 11210 / IRR issued by CSC, DOLE and SSS)</td>
                            <td colspan="6"><i>In case of Sick Leave:</i></td>
                        </tr>

                        <tr>
                            <td colspan="3"> <input type="text"><strong>Paternity Leave </strong>(R.A. No. 8187 / CSC MC No. 71, s. 1998, as amended)</td>
                            <td colspan="6"> <input type="text">In Hospital (Specify Illness)  ___________________________<div class="line"></div></td>
                        </tr>
                        
                        <tr>
                            <td colspan="3"> <input type="text"><strong>Special Privilege Leave </strong>(Sec. 21, Rule XVI, Omnibus Rules Implementing E.O. No. 292)</td>
                            <td colspan="6"> <input type="text">Out Patient (Specify Illness)   ___________________________ <div class="line"></div></td>
                        </tr>

                        <tr>
                            <td colspan="3"> <input type="text"><strong>Solo Parent Leave </strong>(RA No. 8972 / CSC MC No. 8, s. 2004)</td>
                            <td colspan="6"><i> In case of Special Leave Benefits for Women:</i></td>
                        </tr>

                        <tr>
                            <td colspan="3"> <input type="text"><strong>Study Leave </strong>(Sec. 68, Rule XVI, Omnibus Rules Implementing E.O. No. 292)</td>
                            <td colspan="6"> <input type="text">(Specify Illness)   ___________________________________<div class="line"></div></td>
                        </tr>

                        <tr>
                            <td colspan="3"> <input type="text"><strong>10-Day VAWC Leave </strong>(RA No. 9262 / CSC MC No. 15, s. 2005)</td>
                            <td colspan="6"><i>In case of Study Leave:</i></td>
                        </tr>

                        <tr>
                            <td colspan="3"> <input type="text"><strong>Rehabilitation Privilege </strong>(Sec. 55, Rule XVI, Omnibus Rules Implementing E.O. No. 292)</td>
                            <td colspan="6"> <input type="text">Completion of Master's Degree </td>
                        </tr>

                        <tr>
                            <td colspan="3"> <input type="text"><strong>Special Leave Benefits for Women </strong>(RA No. 9710 / CSC MC No. 25, s. 2010)</td>
                            <td colspan="6"> <input type="text">BAR/Board Examination Review Other  </td>
                        </tr>
                        
                        <tr>
                            <td colspan="3"> <input type="text"><strong>Special Emergency (Calamity) Leave </strong>(CSC MC No. 2, s. 2012, as amended) </td>
                            <td colspan="6"> purpose:  _________________________________________________<div class="line"></div></td>
                        </tr>

                        <tr>
                            <td  colspan="3"> <input type="text"><strong>Adoption Leave </strong> (R.A. No. 8552)</td>
                            <td colspan="6"> <input type="text">Monetization of Leave Credits</td>
                        </tr>

                        <tr style="border: 1px solid #000;">
                            <td  colspan="3" style="border-bottom: 1px solid #000;">6.C  NUMBER OF WORKING DAYS APPLIED FOR<br />
                                    <center> <p><strong><?php echo $data[0]->daysApplied; ?> day/s </strong></p> </center>
                 
                                    <p>INCLUSIVE DATES: <strong><?php echo $data[0]->dateFrom.' to '.$data[0]->dateTo; ?> </strong></p>

                                    <!-- date_format($date,"Y/m/d H:i:s"); -->
                            </td>
                            <td colspan="6" style="border-bottom: 1px solid #000;"> 6.D  COMMUTATION 

                                <p><input type="text" value="">Not Requested</p>
                                <p><input type="text" value="">Requested</p>
                               
                            <br />
                        
                            </td>
                        </tr>

                        <!-- Checkbox check value -->
                        <!-- value="&#x2714; -->

                        <tr style="border: 1px solid #000;">
                            <td colspan="10" style="text-align: center;"><strong>7. DETAILS OF ACTION ON APPLICATION</strong></td>
                        </tr>

                        <tr>
                            <td colspan="3" style="border-top: 1px solid #000;">7.A CERTIFICATION OF LEAVE CREDITS
                            </td>  
                            <td colspan="6" style="border-top: 1px solid #000;" >7.B RECOMMENDATION</td>
                        </tr>
                        <!-- <tr>
                            <div class="asOf">
                            <td colspan="3">
                            <p>As of <div class="line"></div></p>
                            </td>
                            <td colspan="6"></td>
                            </div>
                        </tr> -->

                        <tr>
                            <td colspan="3" style="border-bottom: 1px solid #000;">

                        
                           <div class="minitable">
                            <table>
                            <p>As of ____________________________</p>
                                <th></th>
                                <th>Vacation Leave</th>
                                <th>Sick Leave</th>
                                <tr>
                                    <td>Total earned</td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Less this application </td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Balance</td>
                                    <td></td>
                                    <td></td>
                                </tr>
                         </table>
                          
<br><!-- ... Other HTML code ... -->
<br>
<br>

<div class="signature">
    <strong><?php echo $data1[0]->sig1; ?></strong>
    <div class="signatureline"></div>
    <p><?php echo $data1[0]->sig1Position; ?></p>
</div>

<td colspan="6" style="border-bottom: 1px solid #000;">
    <input type="text">For approval<br>
    <input type="text">For disapproval due to ____________________________<br>
    _______________________________________________________________<br>
    _______________________________________________________________<br>
    <br>
    <br>
    <div class="signature">
        <strong><?php echo $data[0]->directHead; ?></strong>
        <div class="signatureline"></div>
        <p><?php echo $data[0]->directHeadPosition; ?></p>
    </div>
</td>
</tr>

<tr>
    <td colspan="3" style="border-right: none;">7.C APPROVED FOR:</td>
    <td colspan="6" style="border-left: none;">7. D DISAPPROVED DUE TO: __________________________________________</td>
</tr>

<br>

<tr>
    <td colspan="3" style="border-right: none;">_________ days with pay</td>
    <td colspan="6" style="border-left: none;">_______________________________________________________________</td>
</tr>

<tr>
    <td colspan="3" style="border-right: none;">_________ days without pay</td>
    <td colspan="6" style="border-left: none;">_______________________________________________________________</td>
</tr>

<tr>
    <td colspan="3" style="border-right: none;">_________ others (Specify)</td>
    <td colspan="6" style="border-left: none;">_______________________________________________________________</td>
</tr>

<br>

<tr>
    <td colspan="10">
        <div class="signature1">
           <strong><?php echo $data1[0]->asds; ?></strong></p>
              <div class="signatureline"></div>
            <p><?php echo $data1[0]->asdsPosition; ?></p>
            <br>
            <br>
        </div>
    </td>
</tr>
<br>


                      
                    </table>

               
                            
                             
                  
            
            </div>
    </div>



    
</body>
</html>