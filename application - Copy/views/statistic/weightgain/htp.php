<div class="row">
    <div class="col-md-3">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Lựa chọn</h3>
            </div>
            <form action="{$base_url}weightgain/htpweightgain" method="post" id="form">
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
        <div class="card card-info">
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
                                <td>Cối</td>
                                <td>TG vào cối</td>
                                <td>Ngày NL</td>
                                <td>Loại cá</td>
                                <td>Size</td>
                                <td>KL vào cối</td>
                                <td>TG ra cối</td>
                                <td>Khối lượng</td>
                                <td>Trừ nước</td>
                                <td>Cá B</td>
                            </tr>
                        </thead>
                        <tbody>
                            {$i=1}
                            {$khoi_luong=0}
                            {foreach $result as $rs}
                            <tr>
                                <td align="center">{$i++}</td>
                                <td align="center">{$rs.coi_id}</td>
                                <td align="center">{$rs.date_in|date_format:"d/m/Y"} {$rs.time_in}</td>
                                <td align="center">{$rs.date_nl|date_format:"d/m/Y"}</td>
                                <td align="center">{$rs.product_id_in}</td>
                                <td align="center">{$rs.size}</td>
                                <td align="center">{$rs.weight_in}</td>
                                <td align="right">{$rs.time_out|date_format:"%d/%m/%Y %H:%M:%S"}</td>
                                <td align="right">{$rs.TONG_REAL}</td>
                                <td align="right">{$rs.TONG}</td>
                                <td align="right">{$rs.CAB}</td>
                            </tr>
                            {/foreach}
                        </tbody>
                        <!-- <tfoot>
                            <tr style="font-weight: bold;">
                                <td align="right" colspan="7">Tổng: </td>
                                <td align="right">{$khoi_luong|number_format:3:",":"."}</td>
                            </tr>
                        </tfoot> -->
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
            timePicker24Hour: true,
            locale: {
                format: 'DD/MM/YYYY HH:mm A'
            }
        })
    });
</script>