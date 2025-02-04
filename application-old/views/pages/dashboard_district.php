
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
                        <h4 class="page-title"><?= $district->discription; ?></h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb p-0 m-0">
                                <!-- <li class="breadcrumb-item"><a href="#">Velonic</a></li>
                                            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                                            <li class="breadcrumb-item active">Dashboard 3</li> -->
                            </ol>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <?php if ($this->session->flashdata('success')) : ?>

                <?= '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>'
                    . $this->session->flashdata('success') .
                    '</div>';
                ?>
            <?php endif; ?>

            <?php if ($this->session->flashdata('danger')) : ?>
                <?= '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>'
                    . $this->session->flashdata('danger') .
                    '</div>';
                ?>
            <?php endif;  ?>

            <div class="row">
                            
                            <div class="col-xl-3 col-sm-6">
                                <div class="card bg-primary">
                                    <div class="card-body widget-style-2">
                                        <div class="text-white media">
                                            <div class="media-body align-self-center">
                                                <?php $school = $this->Common->one_cond_count_row('schools','district',$district->discription); ?>
                                                <h2 class="my-0 text-white"><a href="<?= base_url(); ?>Pages/school_list" class="text-white"><span data-plugin="counterup"><?= $school->num_rows(); ?></span></a></h2>
                                                <p class="mb-0">School List</p>
                                            </div>
                                            <i class="  ion ion-md-person"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End row -->

           

            




        </div>
        <!-- end container-fluid -->

    </div>
    <!-- end content -->
