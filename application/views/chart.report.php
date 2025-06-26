<div class="row">
  <div class="col-md-12">
    <!-- BAR CHART -->
    <div class="card card-success">
      <div class="card-header">
        <h3 class="card-title">Tổng quan</h3>
      </div>
      <div class="card-body">
        <div class="chart">
          <canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
        </div>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
</div>
<div class="row">
  <div class="col-md-6">
    <!-- PIE CHART -->
    <div class="card card-success">
      <div class="card-header">
        <h3 class="card-title">Fillet</h3>
      </div>
      <div class="card-body">
        <canvas id="fillet_pieChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
  <div class="col-md-6">
    <!-- PIE CHART -->
    <div class="card card-success">
      <div class="card-header">
        <h3 class="card-title">Sửa cá</h3>
      </div>
      <div class="card-body">
        <canvas id="sua_ca_pieChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
</div>
<script type="text/javascript">
  var areaChartData = {
    labels  : [{$label_total}],
    datasets: [
      {
        label               : 'Khối lượng',
        backgroundColor     : 'rgba(60,141,188,0.9)',
        borderColor         : 'rgba(60,141,188,0.8)',
        pointRadius          : false,
        pointColor          : '#3b8bba',
        pointStrokeColor    : 'rgba(60,141,188,1)',
        pointHighlightFill  : '#fff',
        pointHighlightStroke: 'rgba(60,141,188,1)',
        data                : [{$data_total},0]
      },
    ]
  }
  //-------------
    //- BAR CHART -
    //-------------
    var barChartCanvas = $('#barChart').get(0).getContext('2d')
    var barChartData = $.extend(true, {}, areaChartData)
    var temp0 = areaChartData.datasets[0]
    barChartData.datasets[0] = temp0
    var barChartOptions = {
      responsive              : true,
      maintainAspectRatio     : false,
      datasetFill             : false,
      legend: {
        position: 'bottom',
        display: false,
      }
    }

    var barChart = new Chart(barChartCanvas, {
      type: 'bar',
      data: barChartData,
      options: barChartOptions,
    })
  //-------------
    //- PIE CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    
    var fillet_data        = {
      labels: [
          {$label_fillet}
      ],
      datasets: [
        {
          data: [{$data_fillet}],
          backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
        }
      ]
    }
    var sua_ca_data        = {
      labels: [
          {$label_sua_ca}
      ],
      datasets: [
        {
          data: [{$data_sua_ca}],
          backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
        }
      ]
    }
    var pieOptions     = {
      maintainAspectRatio : false,
      responsive : true,
      legend: {
        position: 'right',
        display: true,
      }
    }

    var pieChartCanvas = $('#fillet_pieChart').get(0).getContext('2d')
    var pieData        = fillet_data;
    var pieChart = new Chart(pieChartCanvas, {
      type: 'pie',
      data: pieData,
      options: pieOptions
    })
    
    pieChartCanvas = $('#sua_ca_pieChart').get(0).getContext('2d')
    pieData        = sua_ca_data;
    pieChart = new Chart(pieChartCanvas, {
      type: 'pie',
      data: pieData,
      options: pieOptions
    })
</script>