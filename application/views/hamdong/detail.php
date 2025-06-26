<div class="row">
    <div class="col-md-3">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Lựa chọn</h3>
            </div>
            <form action="{$base_url}hamdong/detail" method="post" id="form">
                <div class="card-body">
                    <!-- Date and time range -->
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="far fa-clock"></i></span>
                            </div>
                            <input type="date" class="form-control float-right" name="date" value="{$date}">
                        </div>
                        <!-- /.input group -->
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Lô</span>
                            </div>
                            <select class="form-control" name="lo_id" id="lo_id">
                                <option value="">Tất cả</option>
                                {foreach $lohang as $s}
                                <option value="{$s->lo_id}" {if $lo_id eq $s->lo_id}selected{/if}>{$s->lo_id}</option>
                                {/foreach}
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Hầm</span>
                            </div>
                            <select class="form-control" name="ham_id" id="ham_id">
                                <option value="">Tất cả</option>
                                {foreach $hamdong as $h}
                                <option value="{$h->ham_id}" {if $ham_id eq $h->ham_id}selected{/if}>{$h->ham_name}</option>
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
                    Vào
                </h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered" id="dataTableIn" width="100%" cellspacing="0">
                        <thead>
                            <tr style="font-weight: bold;" align="center">
                                <th>Lô</th>
                                <th>Hầm</th>
                                <th>Size</th>
                                <th>Loại</th>
                                <th>Giờ</th>
                                <th>Khối lượng</th>
                            </tr>
                        </thead>
                        <tbody>
                            {$tong=0}
                            {foreach $result_in as $rs}
                            {$tong=$tong + $rs['weight']}
                            <tr align="center">
                                <td>{$rs['lo_id']}</td>
                                <td>{$rs['ham_name']}</td>
                                <td>{$rs['size_name']}</td>
                                <td>{$rs['product_type_id']}</td>
                                <td>{$rs['time']}</td>
                                <td align="right">{$rs['weight']|number_format:3:",":"."}</td>
                            </tr>
                            {/foreach}
                        </tbody>
                        <tfoot align="right">
                            <th colspan="5" align="right">Tổng</th>
                            <th>{$tong|number_format:3:",":"."}</th>
                        </tfoot>
                    </table>
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">

            </div>
            <!-- /.card-footer -->
        </div>

        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">
                    Ra
                </h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered" id="dataTableOut" width="100%" cellspacing="0">
                        <thead>
                            <tr style="font-weight: bold;" align="center">
                                <th>Lô</th>
                                <th>Hầm</th>
                                <th>Size</th>
                                <th>Loại</th>
                                <th>Giờ</th>
                                <th>Khối lượng</th>
                            </tr>
                        </thead>
                        <tbody>
                            {$tong=0}
                            {foreach $result_out as $rs}
                            {$tong=$tong + $rs['weight']}
                            <tr align="center">
                                <td>{$rs['lo_id']}</td>
                                <td>{$rs['ham_name']}</td>
                                <td>{$rs['size_name']}</td>
                                <td>{$rs['product_type_id']}</td>
                                <td>{$rs['time']}</td>
                                <td align="right">{$rs['weight']|number_format:3:",":"."}</td>
                            </tr>
                            {/foreach}
                        </tbody>
                        <tfoot align="right">
                            <th colspan="5" align="right">Tổng</th>
                            <th>{$tong|number_format:3:",":"."}</th>
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
        $('#dataTableIn').DataTable();
        $('#dataTableOut').DataTable();
        $('#lo_id').select2();
    });
</script>