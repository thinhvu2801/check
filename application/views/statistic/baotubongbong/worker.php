<div class="row">
    <div class="col-md-3">
        <div class="card card-info" id="card_filter">
            <div class="card-header">
                <h3 class="card-title">Lựa chọn</h3>
            </div>
            <form action="{$base_url}baotubongbong/worker" method="post" id="form">
                <div class="card-body">
                    <!-- Date and time range -->
                    <div class="form-group">
                        <label>Ngày giờ:</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="far fa-clock"></i></span>
                            </div>
                            <input type="text" class="form-control float-right" name="datetime" id="reservationtime">
                        </div>
                        <!-- /.input group -->
                    </div>

                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <div class="btn-group btn-block">
                        <button type="submit" class="btn btn-info btn-sm" name="statistic">Thống kê</button>
                        <button type="submit" class="btn btn-success btn-sm" name="export">Xuất file</button>
                    </div>
                </div>
                <!-- /.card-footer -->
            </form>
        </div>
    </div><!-- ./col-md-3-->
    <div class="col-md-9">
        <div class="card card-info" id="card_result">
            <div class="card-header">
                <h3 class="card-title">
                    Kết quả
                </h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                <table class="table table-hover table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr style="font-weight: bold;" align="center">
                            <td width="3%">STT</td>
                            <td>Mã CN</td>
                            <td>Tên CN</td>
                            <td>SP</td>
                            <td width="15%">KL trước 18h30</td>
                            <td width="15%">KL sau 18h30</td>
                            <td width="15%">KL tổng</td>
                        </tr>
                    </thead>
                    <tbody>
                        {$i=1}
                        {$khoi_luong=0}
                        {$khoi_luong_before18=0}
                        {$khoi_luong_after18=0}
                        {foreach $result as $rs}
                        {$khoi_luong = $khoi_luong + $rs.weight_total}
                        {$khoi_luong_before18 = $khoi_luong_before18 + $rs.weight_before_18}
                        {$khoi_luong_after18 = $khoi_luong_after18 + $rs.weight_after_18}
                        <tr>
                            <td align="center">{$i++}</td>
                            <td>{$rs.worker_id}</td>
                            <td>{$rs.worker_name}</td>
                            <td>{$rs.product_name}</td>
                            <td align="right">{$rs.weight_before_18|number_format:3:",":"."}</td>
                            <td align="right">{$rs.weight_after_18|number_format:3:",":"."}</td>
                            <td align="right">{$rs.weight_total|number_format:3:",":"."}</td>
                            
                        </tr>
                        {/foreach}
                    </tbody>
                    <tfoot>
                        <tr align="right" style="font-weight: bold;">
                            <td align="right" colspan="4">Tổng: </td>
                            <td align="right">{$khoi_luong_before18|number_format:3:",":"."}</td>
                            <td align="right">{$khoi_luong_after18|number_format:3:",":"."}</td>
                            <td align="right">{$khoi_luong|number_format:3:",":"."}</td>
                            
                        </tr>
                    </tfoot>
                </table>
            </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">

            </div>
            <!-- /.card-footer -->
        </div>
    </div><!-- ./col-md-8-->
</div>
<script>
$(document).ready(function() {
    $('#lo_id').select2();
    $('#dataTable').dataTable();
    $('#reservationtime').daterangepicker({
        timePicker: true,
        startDate: '{$startDate}',
        endDate: '{$endDate}',
        timePickerIncrement: 1,
        timePicker24Hour:true,
        locale: {
            format: 'DD/MM/YYYY HH:mm A'
        }
    })
});
</script>