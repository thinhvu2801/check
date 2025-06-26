<div class="row">
    <div class="col-md-3">
        <div class="card card-info" id="card_filter">
            <div class="card-header">
                <h3 class="card-title">Lựa chọn</h3>
            </div>
            <form action="{$base_url}truck/detailhistory" method="post">
                <div class="card-body">
                    <div class="form-group">
                        <label>Ngày giờ:</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="far fa-clock"></i></span>
                            </div>
                            <input type="text" class="form-control float-right" name="datetime" id="reservationtime">
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="btn-group btn-block">
                        <button type="submit" class="btn btn-info btn-sm" name="statistic">Thống kê</button>
                        <button type="submit" class="btn btn-success btn-sm" name="export">Xuất file</button>
                    </div>
                    <!-- <div>
                        <input type="button" class="btn btn-block btn-primary btn-xs" style="margin-top:5px; padding:5px;" value="In tổng hợp" name="printvalue" onclick="printphieu()">
                    </div> -->
                </div>
            </form>
            <!-- <div class="card-footer">
                <input type="button" class="btn btn-block btn-primary btn-xs" style="margin-top:5px; padding:5px;" value="In phiếu" name="printvaluedetail" onclick="printphieu2()">
            </div> -->
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
                            <td>Ngày</td>
                            <td>Biển số</td>
                            <td>Khách hàng</td>
                            <td>Sản phẩm</td>
                            <td>Thời gian vào</td>
                            <td>Thời gian ra</td>
                            <td>Khối lượng vào</td>
                            <td>Khối lượng ra</td>
                            <td>Khối lượng hàng</td>
                        </tr>
                    </thead>
                    <tbody>
                        {$i=1}
                        {$khoi_luong=0}
                        {foreach $result as $rs}
                        {$khoi_luong = $khoi_luong + ($rs.weight_in - $rs.weight_out)}
                        <tr>
                            <td align="center">{$i++}</td>
                            <td>{$rs.date|date_format:"d/m/Y"}</td>
                            <td align="center">{$rs.xe_id}</td>
                            <td>{$rs.customer_name}</td>
                            <td>{$rs.product_name}</td>
                            <td align="center">{$rs.time_in}</td>
                            <td align="center">{$rs.time_out}</td>
                            <td align="right">{$rs.weight_in|number_format:3:",":"."}</td>
                            <td align="right">{$rs.weight_out|number_format:3:",":"."}</td>
                            <td align="right">{if $rs.weight_out eq 0}{($rs.weight_in - $rs.weight_in)|number_format:3:",":"."}{else}{($rs.weight_in - $rs.weight_out)|number_format:3:",":"."}{/if}</td>
                            
                        </tr>
                        {/foreach}
                    </tbody>
                    <tfoot>
                        <tr align="right" style="font-weight: bold;">
                            <td align="right" colspan="9">Tổng: </td>
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
    });
});
</script>