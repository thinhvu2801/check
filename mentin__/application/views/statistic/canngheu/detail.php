<div class="row">
    <div class="col-md-3">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Lựa chọn</h3>
            </div>
            <form action="{$base_url}statistic/canngheu_detail" method="post" id="form">
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
                                <option value="{$lo->lo_id}" {if $lo_id eq $lo->lo_id}selected{/if}>{$lo->lo_id}
                                </option>
                                {/foreach}
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">ĐL</span>
                            </div>
                            <select class="form-control" name="provider_id" id="provider_id">
                                <option value="">Tất cả</option>
                                {foreach $provider as $pr}
                                <option value="{$pr->provider_id}" {if $provider_id eq $pr->
                                    provider_id}selected{/if}>{$pr->provider_name}</option>
                                {/foreach}
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">QT</span>
                            </div>
                            <select class="form-control" name="process_id" id="process_id">
                                <option value="">Tất cả</option>
                                {foreach $process as $pr}
                                <option value="{$pr->process_id}" {if $process_id eq $pr->
                                    process_id}selected{/if}>{$pr->process_name}</option>
                                {/foreach}
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">SP</span>
                            </div>
                            <select class="form-control" name="product" id="product">
                                <option value="">Tất cả</option>
                                <option value="T" {if $product eq "T" }selected{/if}>Nghêu trắng</option>
                                <option value="N" {if $product eq "N" }selected{/if}>Nghêu nâu</option>
                                <option value="M" {if $product eq "M" }selected{/if}>Nghêu thịt</option>
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
                                <option value="{$wk->worker_id}" {if $worker_id eq $wk->
                                    worker_id}selected{/if}>{$wk->worker_name}</option>
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
                                <td>Đại lý</td>
                                <td>Quy trình</td>
                                <td width="10%">Mã CN</td>
                                <td>Công nhân</td>
                                <td>Sản phẩm</td>
                                <td>Size</td>
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
                                <td align="center">{$rs.provider_name}</td>
                                <td align="center">{$rs.process_name}</td>
                                <td align="center">{$rs.worker_id}</td>
                                <td>{$rs.worker_name}</td>
                                <td align="center">{$rs.product}</td>
                                <td align="center">{$rs.size}</td>
                                <td align="right">{$rs.weight|number_format:3:",":"."}</td>
                                <td align="center">{$rs.time}</td>
                            </tr>
                            {/foreach}
                        </tbody>
                        <tfoot>
                            <tr>
                                <td align="right" colspan="8">Tổng: </td>
                                <td align="right">{$khoi_luong|number_format:3:",":"."}</td>
                                <td align="center"></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
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
        $('#worker_id').select2();
        $('#provider_id').select2();
        $('#process_id').select2();
        $('#dataTable').dataTable();
        $('#reservationtime').daterangepicker({
            timePicker: true,
            startDate: '{$startDate}',
            endDate: '{$endDate}',
            timePickerIncrement: 1,
            locale: {
                format: 'DD/MM/YYYY hh:mm A'
            }
        })
    });
</script>