<div class="row">
    <div class="col-md-3">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Lựa chọn</h3>
            </div>
            <form action="{$base_url}pcxk/detail" method="post" id="form">
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
                                <span class="input-group-text">Công nhân</span>
                            </div>
                            <select class="form-control" name="worker_id" id="worker_id">
                                <option value="">Tất cả</option>
                                {foreach $worker as $w}
                                <option value="{$w->worker_id}" {if $worker_id eq $w->worker_id}selected{/if}>{$w->worker_name}</option>
                                {/foreach}
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Sản phẩm</span>
                            </div>
                            <select class="form-control" name="product_id" id="product_id">
                                <option value="">Tất cả</option>
                                {foreach $product as $p}
                                <option value="{$p->product_id}" {if $product_id eq $p->product_id}selected{/if}>{$p->product_name}</option>
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
                    <table class="table table-hover table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr style="font-weight: bold;" align="center">
                                <th>#</th>
                                <th>Công nhân</th>
                                <th>Sản phẩm</th>
                                <th>Giờ</th>
                                <th>Khối lượng</th>
                            </tr>
                        </thead>
                        <tbody>
                            {$i=1}
                            {$tong=0}
                            {foreach $result as $rs}
                            {$tong=$tong + $rs['weight']}
                            <tr align="center">
                                <td>{$i++}</td>
                                <td>{$rs['worker_id']}</td>
                                <td>{$rs['product_name']}</td>
                                <td>{$rs['time']}</td>
                                <td align="right">{$rs['weight']|number_format:3:",":"."}</td>
                            </tr>
                            {/foreach}
                        </tbody>
                        <tfoot align="right">
                            <th colspan="4" align="right">Tổng</th>
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
        $('#dataTable').DataTable();
    });
</script>