<div class="row">
    <div class="col-md-3">
        <div class="card card-info" id="card_filter">
            <div class="card-header">
                <h3 class="card-title">Lựa chọn</h3>
            </div>
            <form action="{$base_url}warehouse/totalkho" method="post" id="form">
                <div class="card-body">
                    <!-- Date and time range -->
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Từ</span>
                            </div>
                            <input type="date" class="form-control" id="start_date" name="start_date" value="{$start_date}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Đến</span>
                            </div>
                            <input type="date" class="form-control" id="end_date" name="end_date" value="{$end_date}" required>
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
                            <td>STT</td>
                            <td>Mã kho</td>
                            <td>Quy cách</td>
                            <td>Hàng hóa</td>
                            <td>Size</td>
                            <td>Số lượng</td>
                            <td>Khối lượng</td>
                        </tr>
                    </thead>
                    <tbody>
                        {$i=1}
                        {$khoi_luong=0}
                        {$so_luong=0}
                        {foreach $result as $rs}
                        {$so_luong = $so_luong + $rs->quantity}
                        {$khoi_luong = $khoi_luong + $rs->weight}
                        <tr align="center">
                            <td>{$i++}</td>
                            <td>{$rs->warehouse_id}</td>
                            <td>{$rs->quycach_name}</td>
                            <td>{$rs->product_name}</td>
                            <td>{$rs->size_name}</td>
                            <td align="right">{$rs->quantity}</td>
                            <td align="right">{$rs->weight}</td>
                        </tr>
                        {/foreach}
                    </tbody>
                    <tfoot>
                        <tr align="right" style="font-weight: bold;">
                            <td align="right" colspan="5">Tổng: </td>
                            <td align="right">{$so_luong}</td>
                            <td align="right">{$khoi_luong}</td>
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
    $('#dataTable').dataTable({
        "stateSave": true,
        "pageLength":25
    });
});
</script>