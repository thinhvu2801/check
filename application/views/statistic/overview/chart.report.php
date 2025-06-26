<div class="chart" id="chart">
    <div style="text-align: center;">
        <h4>BIỂU ĐỒ NGÀY {$date|date_format:"d/m/Y"}</h4>
    </div>
    <canvas id="barChart" style="height:300px"></canvas>
</div>
<script type="text/javascript">
var body_height = $("#body").height();
$("#chart").height(body_height / 2);
$('#card_chart').on('minimized.lte.cardwidget', function(){
    $("#result").height(body_height/2);
})
Chart.plugins.register({
    afterDraw: function(chartInstance) {
        if (chartInstance.config.options.showDatapoints) {
            var helpers = Chart.helpers;
            var ctx = chartInstance.chart.ctx;
            var fontColor = helpers.getValueOrDefault(chartInstance.config.options.showDatapoints.fontColor,
                chartInstance.config.options.defaultFontColor);

            // render the value of the chart above the bar
            ctx.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontSize, 'normal', Chart
                .defaults.global.defaultFontFamily);
            ctx.textAlign = 'center';
            ctx.textBaseline = 'bottom';
            ctx.fillStyle = fontColor;

            chartInstance.data.datasets.forEach(function(dataset, i) {
                var meta = chartInstance.controller.getDatasetMeta(i);
                var first_data = dataset.data[0];

                for (let index = 0; index < 5; index++) {
                    if(dataset.data[index]!=null){
                        first_data=dataset.data[index];
                        break;
                    }
                }
                meta.data.forEach(function(bar, index) {
                    var data = dataset.data[index];
                    //ctx.fillText(data + "(" +(100*data/first_data).toFixed(1) +"%)", bar._model.x, bar._model.y);
                    ctx.fillText(data, bar._model.x, bar._model.y + bar.height() / 2 - 5);
                    ctx.fillText("(" + (100 * data / first_data).toFixed(1) + "%)", bar
                        ._model.x, bar._model.y + bar.height() / 2 + 10);
                });
            });
        }
        $("#chart").height($("#result").height());
    }
});
var areaChartData = {
    labels: [{$label_overview}],
    datasets: [{
        label: 'Khối lượng (tấn)',
        backgroundColor: ["rgba(255, 99, 132, 0.8)", "rgba(255, 159, 64, 0.8)", "rgba(255, 205, 86, 0.8)",
            "rgba(75, 192, 192, 0.8)", "rgba(54, 162, 235, 0.8)"
        ],
        borderColor: ["rgba(255, 99, 132, 0.8)", "rgba(255, 159, 64, 0.8)", "rgba(255, 205, 86, 0.8)",
            "rgba(75, 192, 192, 0.8)", "rgba(54, 162, 235, 0.8)"
        ],
        pointRadius: false,
        data: [{$data_overview}]
    }, ]
}
//-------------
//- BAR CHART -
//-------------
var barChartCanvas = $('#barChart').get(0).getContext('2d')
var barChartData = $.extend(true, {}, areaChartData)
var temp0 = areaChartData.datasets[0]
//var temp1 = areaChartData.datasets[1]
barChartData.datasets[0] = temp0
//barChartData.datasets[1] = temp0

var options = {
    responsive: true,
    maintainAspectRatio: false,
    datasetFill: true,
    legend: {
        position: 'bottom',
        display: true,
    },
    showDatapoints: true,
    scales: {
        yAxes: [{
            display: true,
            gridLines: {
                display: true
            },
            ticks: {
                display: true,
                beginAtZero: true
            }
        }]
    }
}

var barChart = new Chart(barChartCanvas, {
    type: 'bar',
    data: barChartData,
    options: options,
})
</script>