<div class="row">
    <div class="col-md-3">
        <div class="card card-info" id="card_filter">
            <div class="card-header">
                <h3 class="card-title">Lựa chọn</h3>
            </div>
            <form action="{$base_url}suaca/detail" method="post" id="form">
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
                                <span class="input-group-text">CN</span>
                            </div>
                            <select class="form-control" name="worker_id" id="worker_id">
                                <option value="">Tất cả</option>
                                {foreach $worker as $wk}
                                <option value="{$wk->worker_id}" {if $worker_id eq $wk->worker_id}selected{/if}>{$wk->worker_id}</option>
                                {/foreach}
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">SP</span>
                            </div>
                            <select class="form-control" name="product_id" id="product_id">
                                <option value="">Tất cả</option>
                                {foreach $product as $pr}
                                <option value="{$pr->product_id}" {if $product_id eq $pr->product_id}selected{/if}>{$pr->product_name}</option>
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
                            <td>Ngày</td>
                            <td>TT vào</td>
                            <td>TG vào</td>
                            <td>TT ra</td>
                            <td>TG ra</td>
                            <td>TG hoàn thành</td>
                            <td>Lô</td>
                            <td>Rổ</td>
                            <td>Mã CN</td>
                            <td>Mã thẻ</td>
                            <td>Công nhân</td>
                            <td>Mã SP</td>
                            <td>Sản phẩm</td>
                            <td>KL vào</td>
                            <td>KL ra</td>
                            <td>Định mức</td>
                        </tr>
                    </thead>
                    <tbody>
                        {$i=1}
                        {$khoi_luong=0}
                        {$khoi_luong_ra=0}
                        {foreach $result as $rs}
                        {$khoi_luong = $khoi_luong + $rs.weight_in}
                        {$khoi_luong_ra = $khoi_luong_ra + $rs.weight_in}
                        <tr>
                            <td align="center">{$i++}</td>
                            <td>{$rs.date|date_format:"d/m/Y"}</td>
                            <td align="center">{$rs.order_input}</td>
                            <td>{$rs.time_in}</td>
                            <td align="center">{$rs.order_output}</td>
                            <td>{$rs.time_out}</td>
                            <td>{$rs.time_finish}</td>
                            <td>{$rs.lo_id}</td>
                            <td>{$rs.basket_id}</td>
                            <td>{$rs.factory_id}</td>
                            <td>{$rs.worker_id}</td>
                            <td>{$rs.worker_name}</td>
                            <td>{$rs.product_id}</td>
                            <td>{$rs.product_name}</td>
                            <td align="right">{$rs.weight_in|number_format:3:",":"."}</td>
                            <td align="right">{$rs.weight_out|number_format:3:",":"."}</td>
                            <td align="right">{$rs.dinh_muc|number_format:3:",":"."}</td>
                            
                        </tr>
                        {/foreach}
                    </tbody>
                    <tfoot>
                        <tr align="right" style="font-weight: bold;">
                            <td align="right" colspan="14">Tổng: </td>
                            <td align="right">{$khoi_luong|number_format:3:",":"."}</td>
                            <td align="right">{$khoi_luong_ra|number_format:3:",":"."}</td>
                            
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