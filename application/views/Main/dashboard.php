  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?=set_url('Dashboard') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
		</section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box box-warning">
            <div class="box-header with-border">
              <h3 class="box-title">Finance</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>

            <div class="box-body">
              <div class="col-md-6">
                <div class="box box-info">
                  <div class="box-header with-border">
                    <h3 class="box-title">Counter</h3>

                    <div class="box-tools pull-right">
                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                      </button>
                      <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                  </div>

                  <div class="box-body">
                    <div class="col-lg-6 col-xs-6">
                      <!-- small box -->
                      <div class="small-box bg-aqua">
                        <div class="inner">
                          <h3 id="ReturChainstore" data-value="<?=$pct_rcs?>"><?=$ReturChainstore?></h3>

                          <h4>Faktur Sisa Chainstore</h4>
                        </div>
                        <div class="icon">
                          <i class="ion ion-umbrella"></i>
                        </div>
                        <a href="<?=set_url('ReturChainstore')?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                      </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-6 col-xs-6">
                      <!-- small box -->
                      <div class="small-box bg-green">
                        <div class="inner">
                          <h3 id="Ppn" data-value="<?=$pct_ppn?>"><?=$Ppn?></h3>

                          <h4>Faktur Sisa SSP</h4>
                        </div>
                        <div class="icon">
                          <i class="ion ion-leaf"></i>
                        </div>
                        <a href="<?=set_url('Ppn')?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                      </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-6 col-xs-6">
                      <!-- small box -->
                      <div class="small-box bg-yellow">
                        <div class="inner">
                          <h3 id="Promo" data-value="<?=$pct_promo?>"><?=$Promo?></h3>

                          <h4>Faktur Sisa Promo</h4>
                        </div>
                        <div class="icon">
                          <i class="ion ion-planet"></i>
                        </div>
                        <a href="<?=set_url('Promo')?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                      </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-6 col-xs-6">
                      <!-- small box -->
                      <div class="small-box bg-red">
                        <div class="inner">
                          <h3><?=$total?></h3>

                          <h5>Total Faktur Sisa</h5>
                        </div>
                        <div class="icon">
                          <i class="ion ion-pie-graph"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                      </div>
                    </div>
                    <!-- ./col -->
                  </div>
                </div>
                <!-- ./box -->
              </div>
              <div class="col-md-6">
                <!-- DONUT CHART -->
                <div class="box box-danger">
                  <div class="box-header with-border">
                    <h3 class="box-title">Donut Chart</h3>

                    <div class="box-tools pull-right">
                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                      </button>
                      <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                  </div>
                  <div class="box-body">
                    <canvas id="pieChart" style="height:250px"></canvas>
                  </div>
                  <!-- /.box-body -->
                </div>
                <!-- /.box -->
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- /.row -->

      <div class="row">
        <div class="col-xs-12">
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Warehouse</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>

            <div class="box-body">
              <div class="col-md-6">

                <div class="box box-info">
                  <div class="box-header with-border">
                    <h3 class="box-title">Counter</h3>

                    <div class="box-tools pull-right">
                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                      </button>
                      <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                  </div>

                  <div class="box-body">
                    <div class="col-lg-6 col-xs-6">
                      <!-- small box -->
                      <div class="small-box bg-aqua">
                        <div class="inner">
                          <h3><?=$rbd?></h3>

                          <h4>Retur belum diterima</h4>
                        </div>
                        <div class="icon">
                          <i class="ion ion-umbrella"></i>
                        </div>
                        <a href="<?=set_url('RegisterRetur')?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                      </div>
                    </div>
                    <!-- ./col -->

                    <div class="col-lg-6 col-xs-6">
                      <!-- small box -->
                      <div class="small-box bg-green">
                        <div class="inner">
                          <h3><?=$mhe?></h3>

                          <h4>Jumlah MHE</h4>
                        </div>
                        <div class="icon">
                          <i class="ion ion-leaf"></i>
                        </div>
                        <a href="<?=set_url('MHE')?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                      </div>
                    </div>
                    <!-- ./col -->

                    <div class="col-lg-6 col-xs-6">
                      <!-- small box -->
                      <div class="small-box bg-yellow">
                        <div class="inner">
                          <h3><?=$mtc_rec?></h3>

                          <h4>Maintenance MHE</h4>
                        </div>
                        <div class="icon">
                          <i class="ion ion-planet"></i>
                        </div>
                        <a href="<?=set_url('MHE')?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                      </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-6 col-xs-6">
                      <!-- small box -->
                      <div class="small-box bg-red">
                        <div class="inner">
                          <h3><?=$spr_rec?></h3>
                          <h5>Ganti Sparepart MHE</h5>
                        </div>
                        <div class="icon">
                          <i class="ion ion-pie-graph"></i>
                        </div>
                        <a href="<?=set_url('MHE')?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                      </div>
                    </div>
                    <!-- ./col -->
                  </div>
                </div>
              </div>

              <div class="col-md-6">
                <!-- DONUT CHART -->
                <div class="box box-danger">
                  <div class="box-header with-border">
                    <h3 class="box-title">Line Chart</h3>

                    <div class="box-tools pull-right">
                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                      </button>
                      <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                  </div>
                  <div class="box-body">
                    <canvas id="lineChart" style="height:250px"></canvas>
                  </div>
                  <!-- /.box-body -->
                </div>
                <!-- /.box -->
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php
    foreach ($statistik as $data){
      $date[] = $data->date;
      $retur[] = $data->total_retur;
    }
  ?>

  <!-- ChartJS 1.0.1 -->
  <script src="<?=base_url('assets/plugins/chartjs/Chart.min.js');?>"></script>

  <!-- page script -->
  <script>
    $(function () {
      /* ChartJS
       * -------
       * Here we will create a few charts using ChartJS
       */

      var areaChartData = {
        labels  : <?php echo json_encode($date) ?>,
        datasets: [
          {
            label               : 'Electronics',
            fillColor           : 'rgba(210, 214, 222, 1)',
            strokeColor         : 'rgba(210, 214, 222, 1)',
            pointColor          : 'rgba(210, 214, 222, 1)',
            pointStrokeColor    : '#c1c7d1',
            pointHighlightFill  : '#fff',
            pointHighlightStroke: 'rgba(220,220,220,1)',
            data                : <?php echo json_encode($retur) ?>
          }
        ]
      }

      var areaChartOptions = {
        //Boolean - If we should show the scale at all
        showScale               : true,
        //Boolean - Whether grid lines are shown across the chart
        scaleShowGridLines      : false,
        //String - Colour of the grid lines
        scaleGridLineColor      : 'rgba(0,0,0,.05)',
        //Number - Width of the grid lines
        scaleGridLineWidth      : 1,
        //Boolean - Whether to show horizontal lines (except X axis)
        scaleShowHorizontalLines: true,
        //Boolean - Whether to show vertical lines (except Y axis)
        scaleShowVerticalLines  : true,
        //Boolean - Whether the line is curved between points
        bezierCurve             : true,
        //Number - Tension of the bezier curve between points
        bezierCurveTension      : 0.3,
        //Boolean - Whether to show a dot for each point
        pointDot                : false,
        //Number - Radius of each point dot in pixels
        pointDotRadius          : 4,
        //Number - Pixel width of point dot stroke
        pointDotStrokeWidth     : 1,
        //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
        pointHitDetectionRadius : 20,
        //Boolean - Whether to show a stroke for datasets
        datasetStroke           : true,
        //Number - Pixel width of dataset stroke
        datasetStrokeWidth      : 2,
        //Boolean - Whether to fill the dataset with a color
        datasetFill             : true,
        //String - A legend template
        legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].lineColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
        //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
        maintainAspectRatio     : true,
        //Boolean - whether to make the chart responsive to window resizing
        responsive              : true
      }

      //-------------
      //- PIE CHART -
      //-------------
      // Get context with jQuery - using jQuery's .get() method.
      var pieChartCanvas = $("#pieChart").get(0).getContext("2d");
      var pieChart = new Chart(pieChartCanvas);
      var PieData = [
        {
          value: $("#ReturChainstore").data('value'),
          color: "#00c0ef",
          highlight: "#00c0ef",
          label: "FS RTV"
        },
        {
          value: $("#Ppn").data('value'),
          color: "#00a65a",
          highlight: "#00a65a",
          label: "FS SSP"
        },
        {
          value: $("#Promo").data('value'),
          color: "#f39c12",
          highlight: "#f39c12",
          label: "FS Promo"
        }
      ];
      var pieOptions = {
        //Boolean - Whether we should show a stroke on each segment
        segmentShowStroke: true,
        //String - The colour of each segment stroke
        segmentStrokeColor: "#fff",
        //Number - The width of each segment stroke
        segmentStrokeWidth: 2,
        //Number - The percentage of the chart that we cut out of the middle
        percentageInnerCutout: 50, // This is 0 for Pie charts
        //Number - Amount of animation steps
        animationSteps: 100,
        //String - Animation easing effect
        animationEasing: "easeOutBounce",
        //Boolean - Whether we animate the rotation of the Doughnut
        animateRotate: true,
        //Boolean - Whether we animate scaling the Doughnut from the centre
        animateScale: false,
        //Boolean - whether to make the chart responsive to window resizing
        responsive: true,
        // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
        maintainAspectRatio: true,
        //String - A legend template
        legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>"
      };
      //Create pie or douhnut chart
      // You can switch between pie and douhnut using the method below.
      pieChart.Doughnut(PieData, pieOptions);


      //-------------
      //- LINE CHART -
      //--------------
      var lineChartCanvas          = $('#lineChart').get(0).getContext('2d')
      var lineChart                = new Chart(lineChartCanvas)
      var lineChartOptions         = areaChartOptions
      lineChartOptions.datasetFill = false
      lineChart.Line(areaChartData, lineChartOptions)

    });
  </script>