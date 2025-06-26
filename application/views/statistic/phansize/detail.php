<div class="row">
    <div class="col-md-3">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Lựa chọn</h3>
            </div>
            <form action="{$base_url}statistic/phansize_detail" method="post" id="form">
                <div class="card-body">
                    <!-- Date and time range -->
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="far fa-clock"></i></span>
                            </div>
                            <input type="text" class="form-control float-right" name="datetime" id="reservationtime">
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
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">MÀU</span>
                            </div>
                            <select class="form-control" name="group_id" id="group_id">
                                <option value="">Tất cả</option>
                                {foreach $group as $gr}
                                <option value="{$gr->group_id}" {if $group_id eq $gr->group_id}selected{/if}>{$gr->group_name}</option>
                                {/foreach}
                            </select>
                        </div>
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
                            <td>Lô</td>
                            <td width="10%">Nhóm màu</td>
                            <td width="10%">Mã SP</td>
                            <td>Sản phẩm</td>
                            <td width="10%">Khối lượng</td>
                            <td width="10%">Thời gian</td>
                        </tr>
                    </thead>
                    <tbody>
                        {$i=1}
                        {$khoi_luong=0}
                        {foreach $result as $rs}
                        {$khoi_luong = $khoi_luong + $rs.weight}
                        <tr>
                            <td align="center">{$i++}</td>
                            <td align="center">{$rs.lo_id}</td>
                            <td>{$rs.group_id}</td>
                            <td align="center">{$rs.product_id}</td>
                            <td>{$rs.product_name}</td>
                            <td align="right">{$rs.weight|number_format:3:",":"."}</td>
                            <td align="center">{$rs.time}</td>
                        </tr>
                        {/foreach}
                    </tbody>
                    <tfoot>
                        <tr>
                            <td align="right" colspan="6">Tổng: </td>
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
        $('#group_id').select2();
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
        $('#dataTable').dataTable();
    });
</script>