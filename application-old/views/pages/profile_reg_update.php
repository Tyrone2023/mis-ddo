
<script type="text/javascript">
		function submitBday() {
		   
			var Bdate = document.getElementById('bday').value;
			var Bday = +new Date(Bdate);
			Q4A= ~~ ((Date.now() - Bday) / (31557600000));
			var theBday = document.getElementById('resultBday');
			theBday.value = Q4A;
		}

		</script>
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
                                    <h4 class="page-title"><?= $title; ?></h4>
                                 
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        
                        <!-- Form row -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                    
                                        <?= validation_errors(); ?>

										<?php $att = array('class' => 'parsley-examples'); ?>
                                        <?= form_open('Pages/profile_reg_edit/'.$app->id, $att); ?>
                                        <div class="row">
										<h5>Personal Information</h5>
									</div>
									<div class="row">
										<!-- <div class="col-lg-3">
												<div class="form-group">
													<label for="lastName">Record No. <span class="ren_r">*</span></label>
													<input type="text" class="form-control" name="IDNumber" readonly required value="">
                                                    
												</div>	
										</div>
										<div class="col-lg-3">
												<div class="form-group">
													<label for="lastName">Employee No. <span class="ren_r">*</span></label>
													<input type="text" class="form-control" name="employeeNo" readonly required value="">
												</div>	
										</div> -->
										<input type="hidden" class="form-control" name="id" readonly required value="<?= $app->id; ?>">
										<div class="col-lg-3">
												<div class="form-group">
													<label for="lastName">Prefix <span class="ren_r">*</span></label>
													<select name="prefix" class="form-control">
                                                        <option></option>
                                                        <?php 
                                                            $array = array('Mr.', 'Ms.', 'Mrs.'); 
                                                            foreach($array as $ar){
                                                                echo '<option';
																if($ar == $app->prefix){echo " selected ";}
																echo '>'. $ar . '</option>';
                                                            }
                                                        ?>
													</select>
												</div>	
										</div>											
									</div>
									
									<div class="row">
										<div class="col-lg-3">
												<div class="form-group">
													<label>First Name <span class="ren_r">*</span></label>
													<input type="text" class="form-control" name="FirstName"  value="<?= $app->FirstName; ?>" required >
												</div>	
										</div>	
										<div class="col-lg-3">
											<div class="form-group">
											<label>Middle Name</label>
											 <input type="text" class="form-control" name="MiddleName"  value="<?= $app->MiddleName; ?>" >
											</div>
										</div>  
										<div class="col-lg-3">
											<div class="form-group">
											<label>Last Name <span class="ren_r">*</span></label>
											 <input type="text" class="form-control" name="LastName"  value="<?= $app->LastName; ?>" required >
                                        </div>
										</div>
										<div class="col-lg-3">
												<div class="form-group">
													<label for="lastName">Name Extn.</label>
													<input type="text" class="form-control" name="NameExtn" value="<?= $app->NameExtn; ?>" >
												</div>	
										</div>	
									</div>	
									
									<div class="row">
										
										<div class="col-lg-3">
												<div class="form-group">
													<label>Sex <span class="ren_r">*</span></label>
													<select name="Sex" class="form-control" required>
                                                        <option></option>
                                                        <?php 
                                                            $array = array('Female' => 'F', 'Male' => 'M'); 
                                                            foreach($array as $ar=>$key){
                                                                echo '<option value="'.$key.'" ';
																if($app->Sex == $key){echo " Selected ";}
																echo ' >'. $ar . '</option>';
                                                            }
                                                        ?>
													</select>
												</div>
										</div> 
										<div class="col-lg-3">
											<div class="form-group">
											<label>Birth Date <span class="ren_r">*</span></label>
											 <input type="date" name="BirthDate" class="form-control" id="bday" onchange="submitBday()" required value="<?= $app->BirthDate; ?>">
											</div>
										</div>  
										<div class="col-lg-1">
											<div class="form-group">
											<label>Age </label>
											 <input type="text" readonly name="age" id="resultBday" class="form-control" value="<?= $app->age; ?>"/>
											</div>
										</div> 
										<div class="col-lg-5">
											<div class="form-group">
												<label>Birth Place</label>
													 <input type="text" class="form-control" name="BirthPlace" value="<?= $app->BirthPlace; ?>" >
													 
											</div>
										</div>										
											
									</div>
									
									<div class="row">
									<div class="col-lg-3">
												<div class="form-group">
													<label>Civil Status <span class="ren_r">*</span></label>
													 <select name="MaritalStatus" class="form-control" required>
                                                        <option></option>
                                                        <?php 
                                                            $array = array('Single', 'Married','Divorced','Separated','Widowed'); 
                                                            foreach($array as $ar){
                                                                echo '<option';
																if($ar == $app->MaritalStatus){echo " selected ";}
																echo '>'. $ar . '</option>';
                                                            }
                                                        ?>
													</select>
												</div>
											</div>
											<div class="col-lg-3">
												<div class="form-group">
													<label>Height (in meter)</label>
													<input type="text" class="form-control" name="height" value="<?= $app->height; ?>" >
												</div>
											</div>
										<div class="col-lg-3">
											<div class="form-group">
											<label>Weight (in kg)</label>
											 <input type="text" class="form-control" name="weight" value="<?= $app->weight; ?>" >
											</div>
										</div>
										<div class="col-lg-3">
											<div class="form-group">
											<label>Blood Type</label>
											 <input type="text" class="form-control" name="bloodType" value="<?= $app->bloodType; ?>" >
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-3">
											<div class="form-group">
											<label>Telephone No.</label>
											 <input type="text" class="form-control" name="empTelNo" value="<?= $app->empTelNo; ?>" >
											</div>
										</div>
										<div class="col-lg-3">
											<div class="form-group">
											<label>Mobile No.</label>
											 <input type="text" class="form-control" <?php // if($this->session->position == 'reg'){echo 'readonly';}?> name="empMobile" value="<?= $app->contactNo; ?>" >
											</div>
										</div>
										<div class="col-lg-6">
											<div class="form-group">
											<label>E-mail <span class="ren_r">*</span></label>
											 <input type="email" readonly class="form-control" name="empEmail" value="<?= $app->empEmail; ?>" required >
											</div>
										</div>
									</div>
									
									<div class="row">
										<div class="col-lg-3">
											<div class="form-group">
											<label>Citizenship</label>
											 <input type="text" class="form-control" name="citizenship" value="Filipino" >
											</div>
										</div>
										<div class="col-lg-3">
												<div class="form-group">
													<label>Dual Citizen?</label>
													 <select class="form-control" name="dualCitizenship">
                                                        <option value="">Select</option>
                                                        <?php 
                                                                $array = array('No Data', 'No', 'Yes'); 
                                                                foreach($array as $ar){
                                                                    echo '<option';
																	if($ar == $app->dualCitizenship){echo " selected ";}
																	echo '>'. $ar . '</option>';
                                                                }
                                                            ?>
													 </select>
													 
												</div>
										</div>
										<div class="col-lg-3">
												<div class="form-group">
													<label>Citizen Type</label>
													 <select class="form-control" name="citizenshipType">
														<option></option>
                                                        <?php 
                                                                $array = array('By Birth', 'By Naturalization'); 
                                                                foreach($array as $ar){
                                                                    echo '<option';
																	if($ar == $app->citizenshipType){echo " selected ";}
																	echo '>'. $ar . '</option>';
                                                                }
                                                            ?>
													 </select>
													 
												</div>
										</div>
										<div class="col-lg-3">
											<div class="form-group">
											<label>Country</label>
											 <input type="text" class="form-control" name="citizenshipCountry" value="<?= $app->citizenshipCountry; ?>" >
											</div>
										</div>
									</div>


									</div></div></div></div>
													<div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body">
									<h5>Education</h5>
									<div class="row">
                                                                        <div class="col-lg-8">
                                                                                <div class="form-group">
                                                                                    <label>Bachelors Degree</label>
                                                                                    <input type="text" class="form-control" name="bd"  value="<?= $app->bd; ?>" >
                                                                                </div>	
                                                                        </div>	
                                                                        <div class="col-lg-4">
                                                                                <div class="form-group">
                                                                                    <label>Date Graduated</label>
                                                                                    <input type="date" class="form-control" name="dg"  value="<?= $app->dg; ?>" >
                                                                                </div>	
                                                                        </div>
                                                                        
                                    </div>
									<?php 
										$jhss = explode(' ',trim($app->jhss)); 
										$shss = explode(' ',trim($app->shss)); 
									?>

									<div class="row">
                                                                        <div class="col-lg-3">
                                                                            <label class="col-form-label">Learning Area <cite class="text-danger">(Junior High School)</cite></label>
                                                                                <select class="form-control" required name="learn">
                                                                                    <option></option>
                                                                                    <?php $la = array('Filipino','English','Mathematics','Science','Araling Panlipunan',
                                                                                            'Edukasyon sa Pagpapakatao','Music and Arts','Physical Education and Health',
                                                                                            'SPED',
                                                                                            'TLE'
                                                                                        );
                                                                                        foreach($la as $row){
                                                                                    ?>
                                                                                    <option <?php if($row == $jhss[0]){echo " selected ";}?> value="<?= $row; ?>"><?= $row; ?></option>
                                                                                    <?php } ?>
                                                                                </select>
                                                                        </div>	
																		

                                                                        <div class="col-lg-3">
                                                                            <label class="col-form-label">Specialized Area </label>
                                                                            <select class="form-control" name="special">
																					<option value=""></option>
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
                                                                                    <option  value="<?= $val; ?>"><?= $val; ?></option>
                                                                                    <?php } ?>
                                                                                    </optgroup>
                                                                                    <?php } } ?>
                                                                                    
                                                                                </select>

                                                                                
                                                                        </div>	

																		<div class="col-lg-3">
                                                                            <label class="col-form-label">Group <cite class="text-danger">(Senior High School)</cite></label>
                                                                                <select class="form-control" required name="group">
                                                                                    <option></option>
                                                                                    <?php $la = array('HUMSS','ABM','STEM','TVL','Sports','Arts and Design');
                                                                                        foreach($la as $row){
                                                                                    ?>
                                                                                    <option <?php if($row == $shss[0]){echo " selected ";}?>><?= $row; ?></option>
                                                                                    <?php } ?>
                                                                                </select>
                                                                        </div>	

                                                                        <div class="col-lg-3">
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
									</div>




									<!-- <div class="row">
										<div class="col-lg-6">
											<div class="form-group">
											<label>Specialization</label>
											
											<select name="specialization" class="form-control">
                                                    <option></option>
                                                    <?php 
                                                        $array = array('English', 'Filipino', 'MAPEH', 'Mathematics', 'Science',  'Social Studies', 'Agriculture Fishery and Arts (AFA)', 'Technology and Livelihood Education (TLE)', 'TVE/TVL-Animal Production', 'TVE/TVL-Carpentry and Masonry', 'TVE/TVL-Dressmaking', 'TVE/TVL-Home Economics', 'TVE/TVL-ICT', 'Values Education'); 
                                                        foreach($array as $ar){
															echo '<option';
															if($ar == $app->specialization){echo " selected ";}
															echo '>'. $ar . '</option>';
                                                        }
                                                    ?>
                                                    </select>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="form-group">
											<label>Track/Strand</label>
											<select name="track" class="form-control">
                                                    <option></option>
                                                    <?php 
                                                        $array = array('Arts and Design', 'Academic Track - Accountancy, Business and Management (ABM)', 'Academic Track - Science, Technology, Engineering, and Mathematics (STEM)', 'Academic Track - Humanities and Social Science (HUMSS)', 'Academic Track - General Academic Strand (GAS)', 'TVL - Agricultural-Fishery Arts (AFA)',  'TVL - Home Economics (HE)', 'TVL - Industrial Arts (IA)',  'TVL - Information and Communications Technology (ICT)', 'Sports'); 
                                                        foreach($array as $ar){
															echo '<option';
															if($ar == $app->track){echo " selected ";}
															echo '>'. $ar . '</option>';
                                                        }
                                                    ?>
                                                    </select>

												

											</div>
										</div>
									</div> -->

													</div></div></div></div>
													<div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body">
													

									
									<div class="row">
										<h5>Official Information</h5>	<hr />
									</div>
									<!-- <div class="row">
										<div class="col-lg-3">
											<div class="form-group">
											<label>Current Position</label>
											 <input type="text" class="form-control" name="empPosition" value="<?= $app->empPosition; ?>" >
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
											<label>Item No.</label>
											 <input type="text" class="form-control" name="currentItemNo" value="" >
											</div>
										</div>
										<div class="col-lg-2">
												<div class="form-group">
												<label>SG No.</label>
												<select class="form-control" name="sgNo">
													<option></option>
													<?php
														for ($x = 1; $x <= 33; $x+=1) {
														echo "<option";
														if($x == $app->sgNo){echo " selected ";}
														echo ">SG $x</option>";
														}
														?>													
												</select>
												</div>
											</div>
										<div class="col-lg-1">
												<div class="form-group">
												<label>Step No.</label>
												<select class="form-control" name="stepNo">
													<option></option>
													<?php
														for ($x = 1; $x <= 8; $x+=1) {
														echo "<option";
														if($x == $app->stepNo){echo " selected ";}
														echo ">$x</option>";
														}
														?>											
												</select>
												</div>
											</div>
										<div class="col-lg-2">
											<div class="form-group">
											<label>Auth. Annual Salary</label>
											 <input type="text" class="form-control" name="authAnSalary" value="<?= $app->authAnSalary; ?>" >
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
											<label>Actual Salary</label>
											 <input type="text" class="form-control" name="actualSalary" value="<?= $app->actualSalary; ?>" >
											</div>
										</div>
									</div> -->
									<!-- <div class="row">
										<div class="col-lg-6">
											<div class="form-group">
											<label>Department</label>
											 <input type="text" class="form-control" name="Department" value="<?= $app->Department; ?>" >
											</div>
										</div>
										<div class="col-lg-3">
											<div class="form-group">
											<label>Agency Code</label>
											 <input type="text" class="form-control" name="agencyCode" value="<?= $app->agencyCode; ?>"  >
											</div>
										</div>
										<div class="col-lg-3">
											<div class="form-group">
											<label>Station Code </label>
											 <input type="text" class="form-control" name="stationCode" value="<?= $app->stationCode; ?>" >
											</div>
										</div>
									</div> -->
									<!-- <div class="row">
										
										<div class="col-lg-4">
											<div class="form-group">
											<label>Date Hired</label>
											 <input type="date" class="form-control" name="dateHired" value="<?= $app->dateHired; ?>" >
											</div>
										</div>
										<div class="col-lg-4">
											<div class="form-group">
											<label>Last Appointment</label>
											 <input type="date" class="form-control" name="lastAppointmentDate" value="<?= $app->lastAppointmentDate; ?>" >
											</div>
										</div>
										<div class="col-lg-4">
											<div class="form-group">
											<label>Expected Ret. Year</label>
											 <input type="text" class="form-control" name="retYear" value="<?= $app->retYear; ?>" >
											</div>
										</div>
										
										
									</div> -->
									<div class="row">
									<div class="col-lg-2">
											<div class="form-group">
											<label>UMID</label>
											 <input type="text" class="form-control" name="umid" value="<?= $app->umid; ?>" >
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
											<label>PhilHeatlth No.</label>
											 <input type="text" class="form-control" name="philHealth" value="<?= $app->philHealth; ?>" >
											</div>
										</div>
										
										<div class="col-lg-2">
											<div class="form-group">
											<label>GSIS</label>
											 <input type="text" class="form-control" name="gsis" value="<?= $app->gsis; ?>" >
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
											<label>PAGIBIG</label>
											 <input type="text" class="form-control" name="pagibig" value="<?= $app->pagibig; ?>" >
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
											<label>SSS No.</label>
											 <input type="text" class="form-control" name="sssNo" value="<?= $app->sssNo; ?>" >
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
											<label>TIN</label>
											 <input type="text" class="form-control" name="tinNo" value="<?= $app->tinNo; ?>" >
											</div>
										</div>
									</div>
									<!-- <div class="row">
										<div class="col-lg-3">
												<div class="form-group">
												<label>Employment Status</label>
												<select class="form-control" name="empStatus">
													<option></option>
													<?php 
                                                                $array = array('Elected', 'Co-Terminous','Permanent','Presidential','Temporary',
															'JO','COS','MOA','Casual/Contractual'); 
                                                                foreach($array as $ar){
                                                                    echo '<option';
																	if($ar == $app->empStatus){echo " selected ";}
																	echo '>'. $ar . '</option>';
                                                                }
                                                            ?>												
												</select>
												</div>
											</div>
										<div class="col-lg-3">
											<div class="form-group">
											<label>Civil Service Eligibility</label>
											<select class="form-control" name="csEligibility">
												<option></option>
												<?php 
                                                    $array = array('No Eligibility', 'PBET','RA 4670','RA 6850','RA 1080','LET',
															'PD 907'); 
                                                                foreach($array as $ar){
                                                                    echo '<option';
																	if($ar == $app->csEligibility){echo " selected ";}
																	echo '>'. $ar . '</option>';
                                                                }
                                                        ?>
											</select>
											</div>
										</div>
										<div class="col-lg-3">
											<div class="form-group">
											<label>CS Eligibility Level</label>
											<select class="form-control" name="csLevel">
												<option></option>
												<?php 
                                                    $array = array('1st Level', '2nd Level','3rd Level','No Eligibility'); 
                                                                foreach($array as $ar){
                                                                    echo '<option';
																	if($ar == $app->csLevel){echo " selected ";}
																	echo '>'. $ar . '</option>';
                                                                }
                                                        ?>
											</select>
											</div>
										</div>
										<div class="col-lg-3">
											<div class="form-group">
											<label>Current Status</label>
											<select class="form-control" name="currentStatus">
												<option></option>
												<?php 
                                                    $array = array('Active', 'Retired','Resigned','Terminated'); 
                                                                foreach($array as $ar){
                                                                    echo '<option';
																	if($ar == $app->currentStatus){echo " selected ";}
																	echo '>'. $ar . '</option>';
                                                                }
                                                        ?>
											</select>
											</div>
										</div>
									</div> -->
									<!-- <div class="row">
											<div class="col-lg-3">
												<div class="form-group">
												<label>No. of Years as JO/COS</label>
												<input type="number" class="form-control" name="YearsAsJO" value="<?= $app->YearsAsJO; ?>" >
												</div>
											</div>
										<div class="col-lg-3">
											<div class="form-group">
											<label>Nature of Work 1</label>
											<select class="form-control" name="workNature1">
												<option></option>
												<?php 
                                                    $array = array('Clerical Services', 'IT Services','Administrative','Watchman','Driver'); 
                                                                foreach($array as $ar){
                                                                    echo '<option';
																	if($ar == $app->workNature1){echo " selected ";}
																	echo '>'. $ar . '</option>';
                                                                }
                                                        ?>
											</select>
											</div>
										</div>

										<div class="col-lg-3">
											<div class="form-group">
											<label>Nature of Work 2</label>
											<select class="form-control" name="workNature2">
												<option></option>
												<?php 
                                                    $array = array('Clerical Services', 'IT Services','Administrative','Watchman','Driver'); 
                                                                foreach($array as $ar){
                                                                    echo '<option';
																	if($ar == $app->workNature2){echo " selected ";}
																	echo '>'. $ar . '</option>';
                                                                }
                                                        ?>
											</select>
											</div>
										</div>

									</div> -->

									</div></div></div></div>
													<div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body">


									<div class="row">
										<br /><h5>Contact Person in Case of Emergency</h5>
									</div>
									
									<div class="row">
										<div class="col-lg-3">
											<div class="form-group">
											<label>Contact Name</label>
											 <input type="text" class="form-control" name="contactName" value="<?= $app->contactName; ?>" >
											</div>
										</div>
										<div class="col-lg-3">
											<div class="form-group">
												<label>Relationship</label>
												<input type="text" class="form-control" name="contactRel" value="<?= $app->contactRel; ?>" >
											</div>
										</div>
										<div class="col-lg-6">
											<div class="form-group">
												<label>Email</label>
												<input type="email" class="form-control" name="contactEmail" value="<?= $app->contactEmail; ?>" >
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-3">
											<div class="form-group">
												<label>Contact No.</label>
												<input type="text" class="form-control" name="contactNo" value="<?= $app->empMobile; ?>" >
											</div>
										</div>
										<div class="col-lg-9">
											<div class="form-group">
												<label>Address</label>
												<input type="text" class="form-control" name="contactAddress" value="<?= $app->contactAddress; ?>" >
											</div>
										</div>
									</div>


									</div></div></div></div>
													<div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body">

									<div class="row">
										<h5>Personnel Address</h5>
									</div>
									<div class="row">
										<div class="col-lg-3">
											<div class="form-group">
												<label>House No.</label>
												<input type="text" class="form-control" name="resHouseNo" value="<?= $app->resHouseNo; ?>" >
											</div>
										</div>
										<div class="col-lg-3">
											<div class="form-group">
												<label>Street</label>
												<input type="text" class="form-control" name="resStreet" value="<?= $app->resStreet; ?>" >
											</div>
										</div>
										<div class="col-lg-3">
											<div class="form-group">
												<label>Village</label>
												<input type="text" class="form-control" name="resVillage" value="<?= $app->resVillage; ?>" >
											</div>
										</div>
										<div class="col-lg-3">
											<div class="form-group">
												<label>Barangay</label>
												<input type="text" class="form-control" name="resBarangay" value="<?= $app->resBarangay; ?>" >
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-3">
											<div class="form-group">
												<label>Zip Code</label>
												<input type="text" class="form-control" name="resZipCode" value="<?= $app->resZipCode; ?>" >
											</div>
										</div>
										<div class="col-lg-3">
											<div class="form-group">
												<label>City/Municipality</label>
												<input type="text" class="form-control" name="resCity" value="<?= $app->resCity; ?>" >
											</div>
										</div>
										<div class="col-lg-6">
											<div class="form-group">
												<label>Province</label>
												<input type="text" class="form-control" name="resProvince" value="<?= $app->resProvince; ?>" >
											</div>
										</div>
									</div>
									
									<div class="row">
										<div class="col-lg-12">
											<input type="submit" name="submit" class="btn btn-info" value="Update Profile">
										</div>
									</div>

                          </div><!-- /.box -->

					</div>
                                        






                                        </form>
                                    </div>
                                </div>
                            </div>
                        <!-- end row -->

                    </div>
                    <!-- end container-fluid -->

                </div>
                <!-- end content -->

                

               