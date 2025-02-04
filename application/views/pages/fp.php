<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <title>Management Information System (MIS)</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Responsive bootstrap 4 admin template" name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/dts.ico">

        <!-- App css -->
        <link href="<?= base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" id="bootstrap-stylesheet" />
        <link href="<?= base_url(); ?>assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <link href="<?= base_url(); ?>assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-stylesheet" />

    </head>

    <body class="authentication-page">

        <div class="account-pages my-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card mt-4">
                            <div class="card-header text-center p-4 bg-primary">
                                <h4 class="text-white mb-0 mt-0">Forgot Password</h4>
                            </div>
                            <div class="card-body">
                            <?php if($this->session->flashdata('failed')) : ?>

                                <?= '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>'
                                        .$this->session->flashdata('failed'). 
                                    '</div>'; 
                                ?>
                                <?php endif; ?> 

                                <?php if($this->session->flashdata('success')) : ?>

                                    <?= '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>'
                                            .$this->session->flashdata('success'). 
                                        '</div>'; 
                                    ?>
                                    <?php endif; ?>

                                    
                                <?= validation_errors(); ?>
                                
                                <?= form_open('Pages/forgot_password'); ?>

                               
                                    <div class="form-group text-center mb-0">

                                    <div class="form-group row">
                                                            <div class="col-lg-12">
                                                                <select class="form-control" name="at">
                                                                    <option disabled selected>Account Type</option>
                                                                    <?php 
                                                                        $at = array(1 => 'Applicant',2 => 'Employee',3 => 'School'); 
                                                                        foreach($at as $row => $key){
                                                                    ?>
                                                                    <option value="<?= $row; ?>"><?= $key; ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                                
                                                            </div>
                                                        </div>
                                        <div class="input-group">
                                            <input type="email" name="email" class="form-control" placeholder="Enter your Email Address">
                                            <span class="input-group-append"> <button type="submit" class="btn btn-primary">Submit</button> </span>
                                        </div>

                                    </div>
                                </form>

                            </div>
                            <!-- end card-body -->
                        </div>
                        <!-- end card -->

                        <!-- end row -->

                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->

            </div>
        </div>

        <!-- Vendor js -->
        <script src="<?= base_url(); ?>assets/js/vendor.min.js"></script>

        <!-- App js -->
        <script src="<?= base_url(); ?>assets/js/app.min.js"></script>

    </body>

</html>