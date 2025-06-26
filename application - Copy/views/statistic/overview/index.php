<div class="row">
    <div class="col-md-4">
        <div class="card card-info" id="card_filter">
            <div class="card-header">
                <h3 class="card-title">Điều kiện lọc</h3>
            </div>
            <div class="card-body">
                <form class="form-horizontal" method="post" action="{$base_url}chartreport/overview">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="far fa-clock"></i></span>
                            </div>
                            <input type="date" class="form-control" id="start_date" name="start_date"
                                placeholder="Từ ngày" required value="{$start_date}">
                        </div>
                        <!-- /.input group -->
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="far fa-clock"></i></span>
                            </div>
                            <input type="date" class="form-control" id="end_date" name="end_date" placeholder="Từ ngày"
                                required value="{$end_date}">
                        </div>
                        <!-- /.input group -->
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">LÔ</span>
                            </div>
                            <select class="form-control" name="lo_id" id="lo_id">
                                <option value="">Tất cả</option>
                                {foreach $lohang as $lo}
                                <option value="{$lo->lo_id}" {if $lo_id eq $lo->lo_id}selected{/if}>{$lo->lo_id}</option>
                                {/foreach}
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="btn-group btn-block">
                            <button type="submit" class="btn btn-sm btn-danger" name="thongke">Thống kê</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="card card-info" id="card_chart">
            <div class="card-header">
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i>
                    </button>
                </div>
                <h3 class="card-title">Biểu đồ</h3>
            </div>
            <div class="card-body" id="result">
                <!-- <div id="result" style="text-align: center;"></div> -->
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card card-info" id="card_result">
            <div class="card-header">
                <h3 class="card-title">Kết quả</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <!-- <div style="text-align: center;">
                        <h4 style="text-transform: uppercase">Thống kê tổng quan<br> Từ ngày
                            {$start_date|date_format:"d/m/Y"} đến ngày {$end_date|date_format:"d/m/Y"}
                        </h4>
                    </div>
 -->
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr class="btn-success" style="font-weight: bold;" align="center">
                                <td width="3%">TT</td>
                                <td width="20%">Ngày</td>
                                <td>Nguyên Liệu</td>
                                <td>Cắt Tiết</td>
                                <td>Phi Lê</td>
                                <td>Lạng Da</td>
                                <td>Sửa Cá</td>
                                <td>Biểu đồ</td>
                            </tr>
                        </thead>
                        {$i=1}
                        {$tong_nl = 0}
                        {$tong_tfl = 0}
                        {$tong_sfl = 0}
                        {$tong_ttp = 0}
                        {$tong_stp = 0}
                        <tbody>
                            {foreach $result as $rs}
                            {$tong_nl = $tong_nl + $rs.nl_weight}
                            {$tong_tfl = $tong_tfl + $rs.fl_weight_in}
                            {$tong_sfl = $tong_sfl + $rs.fl_weight_out}
                            {$tong_ttp = $tong_ttp + $rs.sc_weight_in}
                            {$tong_stp = $tong_stp + $rs.sc_weight_out}
                            <tr align="right">
                                <td align="center">{$i++}</td>
                                <td align="center">{$rs.date|date_format:"d/m/Y"}</td>
                                <td>{$rs.nl_weight|number_format:3:",":"."}</td>
                                <td>{$rs.fl_weight_in|number_format:3:",":"."}</td>
                                <td>{$rs.fl_weight_out|number_format:3:",":"."}</td>
                                <td>{$rs.sc_weight_in|number_format:3:",":"."}</td>
                                <td>{$rs.sc_weight_out|number_format:3:",":"."}</td>
                                <td align="center">
                                    <a href="#" alt="Điều chỉnh" onclick="ViewChartReport('{$rs.date}')" class="btn btn-sm btn-outline-success"><i class="fa fa-bar-chart" aria-hidden="true"></i></a>
                                    <!-- <a href="{$base_url}chartreport/index/{$rs.date}" target="_blank">Biểu đồ</a> -->
                                </td>
                            </tr>
                            {/foreach}
                        </tbody>
                        <tfoot>
                            <tr style="font-weight: bold;" align="right">
                                <td colspan="2">Tổng cộng: </td>
                                <td>{$tong_nl|number_format:3:",":"."}</td>
                                <td>{$tong_tfl|number_format:3:",":"."}</td>
                                <td>{$tong_sfl|number_format:3:",":"."}</td>
                                <td>{$tong_ttp|number_format:3:",":"."}</td>
                                <td>{$tong_stp|number_format:3:",":"."}</td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
function ViewChartReport(date) {
    // var height = 520;
    // var width = 800;
    // var left = screen.width/2 - width/2;
    // var top = screen.height/2 - height/2;
    // window.open("{$base_url}chartreport/index/"+date,"Bieu do","menubar=no,left="+left+",top="+top+",height="+height+",width="+width);
    $("#result").html("Đang tải...");
    $.post("{$base_url}chartreport", {
        date: date
    }, function(data) {
        $("#result").html(data);
        $('#card_result').css('min-height', $('#card_filter').height()+$('#card_chart').height()+15);
    });
    
}
$(document).ready(function() {
    $("#result").html("Đang tải...");
    $.post("{$base_url}chartreport", {
        date: "{$end_date}"
    }, function(data) {
        $("#result").html(data);
        $('#card_result').css('min-height', $('#card_filter').height()+$('#card_chart').height()+15);
    });
    $('#dataTable').DataTable();
});
</script>