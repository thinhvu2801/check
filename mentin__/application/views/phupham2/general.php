<div class="row">
    <div class="col-md-3">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Lựa chọn</h3>
            </div>
            <form action="{$base_url}phupham2/general" method="post" id="form">
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
                                <span class="input-group-text">Khách hàng</span>
                            </div>
                            <select class="form-control" name="customer_id" id="customer_id">
                                <option value="">Tất cả</option>
                                {foreach $customer as $x}
                                <option value="{$x->customer_id}" {if $customer_id eq $x->customer_id}selected{/if}>{$x->customer_name}</option>
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
                                <th width="5%">TT</th>
                                <th width="15%">Ngày</th>
                                <th width="15%">Khách hàng</th>
                                <th width="10%">Mã SP</th>
                                <th>Sản phẩm</th>
                                <th  width="15%">Khối lượng</th>
                                <th>Thời gian</th>
                            </tr>
                        </thead>
                        <tbody>
                            {$i=1}
                            {$sum_weight=0}
                            {foreach $result as $rs}
                            {$sum_weight=$sum_weight+$rs.weight}
                            <tr>
                            <td align="center">{$i++}</td>
                            <td>{$rs.date|date_format:"d/m/Y"}</td>
                            <td>{$rs.customer_name}</td>
                            <td>{$rs.product_id}</td>
                            <td>{$rs.product_name}</td>
                            <td align="right">{$rs.weight|number_format:2:",":"."}</td>
                            <td>{$rs.min_time} - {$rs.max_time}</td>
                            </tr>
                            {/foreach}
                        </tbody>
                        <tfoot style="font-weight: bold;">
                            <td colspan="5" align="right">Tổng</td>
                            <td align="right">{$sum_weight|number_format:2:",":"."}</td>
                            <td></td>
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
        $('#reservationtime').daterangepicker({
            timePicker: true,
            startDate: '{$startDate}',
            endDate: '{$endDate}',
            timePicker24Hour:true,
            timePickerIncrement: 1,
            locale: {
                format: 'DD/MM/YYYY HH:mm A'
            }
        });
        $('#dataTable').DataTable();
    });
</script>