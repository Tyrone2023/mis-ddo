<?php 
    $sub = $this->SGODModel->count_table_row('sgod_aip_submit');
    $school = $this->SGODModel->count_table_row('schools');
    $tsub = $school->num_rows();
    $tnotsub = $sub->num_rows();


?>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    
    google.charts.load("current", {packages:["corechart"]});
    google.charts.setOnLoadCallback(drawChart);
    

    function drawChart() {
      var data = google.visualization.arrayToDataTable([
        ["Element", "Density", { role: "style" } ],
        ["Not Submitted", <?= $tsub-$tnotsub; ?>, "color: yellow"],
        ["Submitted", <?= $sub->num_rows(); ?>, "green"]
      ]);

      

      var view = new google.visualization.DataView(data);
      view.setColumns([0, 1,
                       { calc: "stringify",
                         sourceColumn: 1,
                         type: "string",
                         role: "annotation" },
                       2]);

      var options = {
        title: "Schools AIP Submission Counts",
        height: 400,
        bar: {groupWidth: "95%"},
        legend: { position: "none" },
      };
      var chart = new google.visualization.BarChart(document.getElementById("barchart_values"));
      chart.draw(view, options);
    }

    window.onresize = doALoadOfStuff;

    function doALoadOfStuff() {
        drawChart();
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
                                    <?php if($this->session->position == 'Accountant'){ ?>
                                    <h4 class="page-title">Last Batch Code <span class="badge badge-warning"><?= $last->alloc_batch; ?></span></h4>
                                    <?php } ?>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
                       
                        <div class="row">
                            <div class="col-xl-3 col-sm-6">
                                <div class="card bg-pink">
                                    <div class="card-body widget-style-2">
                                        <div class="text-white media">
                                            <div class="media-body align-self-center">
                                                <h2 class="my-0 text-white"><a href="<?=base_url(); ?>Page/aip_sub_district" class="text-white"><span data-plugin="counterup">18</span></a></h2>
                                                <p class="mb-0 ">District</p>
                                            </div>
                                            <i class="ion ion-md-people"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-3 col-sm-6">
                                <div class="card bg-purple">
                                    <div class="card-body widget-style-2">
                                        <div class="text-white media">
                                            <div class="media-body align-self-center">
                                                <h2 class="my-0 text-white"><a href="<?=base_url(); ?>Page/aip_sub"  class="text-white"><span data-plugin="counterup"><?= $sub->num_rows(); ?></span></a></h2>
                                                <p class="mb-0">SUBMITTED</p>
                                            </div>
                                            <i class="ion ion-md-person-add "></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-3 col-sm-6">
                                <div class="card bg-info">
                                    <div class="card-body widget-style-2">
                                        <div class="text-white media">
                                            <div class="media-body align-self-center">
                                                <h2 class="my-0 text-white"><a href="<?=base_url(); ?>Page/aip_approved"  class="text-white"><span data-plugin="counterup"><?= $ap->num_rows(); ?></span></a></h2>
                                                <p class="mb-0">APPROVED</p>
                                            </div>
                                            <i class=" ion ion-md-contact"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-3 col-sm-6">
                                <div class="card bg-primary">
                                    <div class="card-body widget-style-2">
                                        <div class="text-white media">
                                            <div class="media-body align-self-center">
                                                <h2 class="my-0 text-white"><a href="<?=base_url(); ?>Page/aip_requested" class="text-white"><span data-plugin="counterup"><?= $req->num_rows(); ?></span></a></h2>
                                                <p class="mb-0">REQUESTED</p>
                                            </div>
                                            <i class="  ion ion-md-person"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End row -->

                        <div class="row">
                            <div class="col-12">
                                <div id="barchart_values"></div>
                            </div>
                        </div>

                        

                        

                        
                    

                </div>
                <!-- end content -->

                

                