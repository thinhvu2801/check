<?php /* Smarty version Smarty-3.1.16, created on 2025-02-27 03:17:48
         compiled from "C:\xampp\htdocs\check\application\views\statistic\overview\chart.report.php" */ ?>
<?php /*%%SmartyHeaderCode:67420196867bfcb4c8d4be2-52537042%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '74f7b0e70d11ccc49e6adadaa446bdb36547e27f' => 
    array (
      0 => 'C:\\xampp\\htdocs\\check\\application\\views\\statistic\\overview\\chart.report.php',
      1 => 1738937684,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '67420196867bfcb4c8d4be2-52537042',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'date' => 0,
    'label_overview' => 0,
    'data_overview' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_67bfcb4ca04a94_59413631',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_67bfcb4ca04a94_59413631')) {function content_67bfcb4ca04a94_59413631($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include 'C:\\xampp\\htdocs\\check\\application\\third_party\\Smarty-3.1.16\\libs\\plugins\\modifier.date_format.php';
?><div class="chart" id="chart">
    <div style="text-align: center;">
        <h4>BIỂU ĐỒ NGÀY <?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['date']->value,"d/m/Y");?>
</h4>
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
    labels: [<?php echo $_smarty_tpl->tpl_vars['label_overview']->value;?>
],
    datasets: [{
        label: 'Khối lượng (tấn)',
        backgroundColor: ["rgba(255, 99, 132, 0.8)", "rgba(255, 159, 64, 0.8)", "rgba(255, 205, 86, 0.8)",
            "rgba(75, 192, 192, 0.8)", "rgba(54, 162, 235, 0.8)"
        ],
        borderColor: ["rgba(255, 99, 132, 0.8)", "rgba(255, 159, 64, 0.8)", "rgba(255, 205, 86, 0.8)",
            "rgba(75, 192, 192, 0.8)", "rgba(54, 162, 235, 0.8)"
        ],
        pointRadius: false,
        data: [<?php echo $_smarty_tpl->tpl_vars['data_overview']->value;?>
]
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
</script><?php }} ?>
