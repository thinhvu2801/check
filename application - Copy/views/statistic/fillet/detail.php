<div class="row">
    <div class="col-md-2">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Lựa chọn</h3>
            </div>
            <form action="{$base_url}fillet/detail" method="post" id="form">
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
                                <span class="input-group-text">CN</span>
                            </div>
                            <select class="form-control" name="worker_id" id="worker_id">
                                <option value="">Tất cả</option>
                                {foreach $worker as $wk}
                                <option value="{$wk->worker_id}" {if $worker_id eq $wk->worker_id}selected{/if}>{$wk->worker_name}</option>
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
                    <!-- <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">KL vào</span>
                            </div>
                            <input type="number" value="{$weight_in}" step="0.001" name="weight_in" class="form-control">
                        </div>
                    </div> -->
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
    <div class="col-md-10">
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
                                <td>Ngày</td>
                                <td>TT vào</td>
                                <td>TG vào</td>
                                <td>TT ra</td>
                                <td>TG ra</td>
                                <td>TG hoàn thành</td>
                                <td>Lô</td>
                                <td>Mã NM</td>
                                <td>Mã CN</td>
                                <td>Công nhân</td>
                                <td>Mã SP</td>
                                <td>Sản phẩm</td>
                                <td>KL vào</td>
                                <td>KL ra</td>
                                <td>Định mức</td>
                               
                            </tr>
                        </thead>
                        <tfoot>
                            <td colspan="12" align="right" style="font-weight: bold;">Tổng</td>
                            <td>{$total->weight_in|number_format:3:",":"."}</td>
                            <td>{$total->weight_out|number_format:3:",":"."}</td>
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
            timePickerIncrement: 1,
            timePicker24Hour: true,
            locale: {
                format: 'DD/MM/YYYY HH:mm A'
            }
        })
        $('#dataTable').DataTable({
            "ordering": false,
            "processing": true,
            "serverSide": true,
            "searching": false,
            "ajax": {
                "url": "{$base_url}fillet/detail_read",
                "data": function(d) {
                    d.start_date = "{$startDate}";
                    d.end_date = "{$endDate}";
                    d.weight_in = "{$weight_in}";
                    d.product_id = "{$product_id}";
                    d.worker_id = "{$worker_id}";
                    d.lo_id = "{$lo_id}";
                }
            }
        });
        $('#worker_id').select2();
    });
</script>