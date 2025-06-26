<div class="row">
    <div class="col-md-3">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Lựa chọn</h3>
            </div>
            <form action="{$base_url}fillet/worker_total" method="post" id="form">
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
                                <span class="input-group-text">LÔ</i></span>
                            </div>
                            <select class="form-control" name="lo_id" id="lo_id">
                                <option value="">Tất cả</option>
                                {foreach $lohang as $lo}
                                <option value="{$lo->lo_id}" {if $lo_id eq $lo->lo_id}selected{/if}>{$lo->lo_id}</option>
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
                            <td>Mã NM</td>
                            <td>Mã CN</td>
                            <td>Công nhân</td>
                            <td>Mã SP</td>
                            <td>Sản phẩm</td>
                            <td width="7%">Số lượng</td>
                            <td width="7%">&sum;KL vào</td>
                            <td width="7%">&sum;KL ra</td>
                            <td width="7%">Định mức</td>
                            <td width="7%">Thời gian</td>
                        </tr>
                    </thead>
                    <tbody>
                        {$i=1}
                        {$quantity=0}
                        {$weight_in=0}
                        {$weight_out=0}
                        {foreach $result as $rs}
                        {$quantity = $quantity + $rs.quantity}
                        {$weight_in = $weight_in + $rs.weight_in}
                        {$weight_out = $weight_out + $rs.weight_out}
                        <tr>
                            <td align="center">{$i++}</td>
                            <td>{$rs.factory_id}</td>
                            <td>{$rs.worker_id}</td>
                            <td>{$rs.worker_name}</td>
                            <td>{$rs.product_id}</td>
                            <td>{$rs.product_name}</td>
                            <td align="right">{$rs.quantity}</td>
                            <td align="right">{$rs.weight_in|number_format:3:",":"."}</td>
                            <td align="right">{$rs.weight_out|number_format:3:",":"."}</td>
                            <td align="right">{$rs.dinh_muc|number_format:3:",":"."}</td>
                            <td>{$rs.min_time} - {$rs.max_time}</td>
                        </tr>
                        {/foreach}
                    </tbody>
                    <tfoot>
                        <tr>
                            <td align="right" colspan="6">Tổng: </td>
                            <td align="right">{$quantity}</td>
                            <td align="right">{$weight_in|number_format:3:",":"."}</td>
                            <td align="right">{$weight_out|number_format:3:",":"."}</td>
                            <td></td><td></td>
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