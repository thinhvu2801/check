<div class="row">
    <div class="col-md-3">
        <div class="card card-info" id="card_filter">
            <div class="card-header">
                <h3 class="card-title">Lựa chọn</h3>
            </div>
            <form action="{$base_url}truck/customer" method="post" id="form">
                <div class="card-body">
                    <!-- Date and time range -->
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Ngày</span>
                            </div>
                            <input type="date" class="form-control" id="date" name="date" value="{$date}" required>
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
                            <td>Khách hàng</td>
                            <td>Khối lượng xe và hàng</td>
                            <td>Khối lượng xe</td>
                            <td>Khối lượng hàng</td>
                        </tr>
                    </thead>
                    <tbody>
                        {$i=1}
                        {$khoi_luong=0}
                        {foreach $result as $rs}
                        {if $rs.weight_out neq 0}
                            {$khoi_luong = $khoi_luong + ($rs.weight_in - $rs.weight_out)}
                        {/if}
                        <tr align="center">
                            <td>{$i++}</td>
                            <td><a href="{$base_url}truck/general/{$rs.customer_id}/{$date}">{$rs.customer_name}</a></td>
                            <td>{$rs.weight_in}</td>
                            <td>{$rs.weight_out}</td>
                            <td align="right">{if $rs.weight_out eq 0}{($rs.weight_in - $rs.weight_in)}{else}{($rs.weight_in - $rs.weight_out)}{/if}</td>
                        </tr>
                        {/foreach}
                    </tbody>
                    <tfoot>
                        <tr align="right" style="font-weight: bold;">
                            <td align="right" colspan="4">Tổng: </td>
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
    $('#dataTable').dataTable();
});
</script>