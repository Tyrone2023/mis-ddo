                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">

                                    <div class="page-title-right">
                                        <ol class="breadcrumb p-0 m-0">
                                            <li class="breadcrumb-item"><a href="<?= base_url(); ?>pages/activity">Activities</a></li>
                                            <li class="breadcrumb-item active">Add New Activity</li>
                                        </ol>
                                    </div>

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

                                    <?= validation_errors(); ?>
                                    
                                   
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->


                       <!-- ============================================================== -->
                       <!-- Main Content here -->
                       <!-- ============================================================== -->


                       <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body bg-info">
                                        <h2 class="text-center text-white"><?= $act->act_name; ?></h2>
                                        <h2 class="m-t-0 header-title mb-4 text-white text-center">date : <?= $act->date_start; ?> - <?= $act->date_end; ?></h2>
                                    </div>
                                    <div class="card-body">
                                        <h4 class="header-title mb-4">Add Facilitator</h4>

                                        <?php 
                                            $attributes = array('class' => 'parsley-examples');
                                            echo form_open('pages/speakers', $attributes);
                                        ?>
                                          
                                            <input type="hidden" name="act_id" value="<?= $this->uri->segment(3); ?>">

                                            

                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label">Day <span class="text-danger">*</span></label>
                                                <div class="col-md-8">
                                                    <?php 
                                                        $date1 = $act->date_start;
                                                        $date2 = $act->date_end;
                                                        
                                                        $diff = abs(strtotime($date2) - strtotime($date1));
                                                        
                                                        $years = floor($diff / (365*60*60*24));
                                                        $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
                                                        $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
                                                        
                                                        //printf("%d years, %d months, %d days\n", $years, $months, $days);
                                                        $day = $days+1;
                                                        
                                                        ?>
                                                        <select class="custom-select mt-3" name="day">
                                                            <option selected></option>
                                                            <?php for($i=1; $i < $day+1; $i++){ ?>
                                                            <option value="<?= $i; ?>">Day <?= $i; ?></option>
                                                            <?php } ?>
                                                        </select> 
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="hori-pass2" class="col-md-3 col-form-label">FACILITATORS<span class="text-danger">*</span></label>
                                                <div class="col-md-8">
                                                    
                                                <select class="form-control select2-multiple" name="speaker[]" data-toggle="select2" multiple="multiple" data-placeholder="Choose ...">
                                                    <?php 
                                                         $speaker = explode(',', $act->speaker);
                                                        foreach($speaker as $row){ 
                                                            ?>
                                                        <option value="<?= $row; ?>"><?= $row; ?></option>
                                                    <?php } ?>
                                                </select>    
                                                </div>
                                            </div>

                                            
                                            
                                            <div class="form-group row mb-0">
                                                <div class="col-md-8 offset-md-4">
                                                    <button type="submit" class="btn btn-info waves-effect waves-light mr-1">
                                                        Save
                                                    </button>
                                                    <button type="reset" class="btn btn-secondary waves-effect waves-light">
                                                        Cancel
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




                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body table-responsive">
                                        <h4 class="m-t-0 header-title mb-4"><?= $title; ?></h4>

                                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">

                                            <thead>
                                                <tr>
                                                    <th>Day</th>
                                                    <th>Speaker</th>
                                                    <th>Manage</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <?php foreach($s as $row){ ?>
                                                <tr>
                                                    <td>Day <?= $row->day; ?> </td>
                                                    <td><?php $output = str_replace(',', '<br />', $row->qs_id); echo $output; ?></td>
                                                    <td><a onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger" href="<?= base_url(); ?>pages/day_speaker_delete/<?= $row->id; ?>/<?= $this->uri->segment(3); ?>">Delete</a></td>
                                                </tr>
                                                <?php } ?>
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->