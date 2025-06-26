<div class="row">
    <div class="col-md-3">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Lựa chọn</h3>
            </div>
            <form action="{$base_url}/fillet/over_threshold" method="post" id="form">
                <div class="card-body">
                    <!-- Date and time range -->
                    <!-- <div class="form-group">
                        <label>Ngày giờ:</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="far fa-clock"></i></span>
                            </div>
                            <input type="date" value="{$date}" class="form-control" name="date">
                        </div>
                    </div> -->
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
                                <option value="{$lo->lo_id}" {if $lo_id eq $lo->lo_id}selected{/if}>{$lo->lo_id}
                                </option>
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
                        <tr style="font-weight: bold;" align="center" >
                            <!-- <td width="3%">STT</td> -->
                            <td>Lô</td>
                            <td width="10%">Mã CN</td>
                            <td>Công nhân</td>
                           <!--  <td width="10%">Mã SP</td> -->
                            <td>Sản phẩm</td>
                            <td>Định mức SP</td>
                            <td>KL vào</td>
                            <td>KL ra</td>
                            <td>Định mức</td>
                            <td>Loại</td>
                            <td>Thời gian</td>
                        </tr>
                    </thead>
                    <tbody>
                        {$i=1}
                        {foreach $result as $rs}
                        {if $rs.type_over_threshold == 'Vượt'}
                            <tr style="color: blue;">
                        {else}
                            <tr style="color: red;">
                        {/if}
                            <!-- <td align="center">{$i++}</td> -->
                            <td align="center">{$rs.lo_id}</td>
                            <td align="center">{$rs.worker_id}</td>
                            <td>{$rs.worker_name}</td>
                            <!-- <td align="center">{$rs.product_id}</td> -->
                            <td>{$rs.product_name}</td>
                            <td align="center">{$rs.dinh_muc_min} - {$rs.dinh_muc_max}</td>
                            <td align="right">{$rs.weight_in|number_format:3:",":"."}</td>
                            <td align="right">{$rs.weight_out|number_format:3:",":"."}</td>
                            <td align="right">{$rs.dinh_muc|number_format:3:",":"."}</td>
                            <td align="center">{$rs.type_over_threshold}</td>
                            <td align="right">{$rs.time_out}</td>
                        </tr>
                        {/foreach}
                    </tbody>
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