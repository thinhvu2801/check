<div class="row">
    <div class="col-md-3">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Thêm thủ công</h3>
            </div>
            <form action="{$base_url}warehouse/outhistory" method="post">
                <div class="card-body">
                    {if $mes neq ""}
                    <p class="mb-0" style="color: red;">{$mes}</p>
                    {/if}
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
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Mã kho</span>
                            </div>
                            <select class="form-control" name="warehouse_id" id="warehouse_id">
                                <option value="">Tất cả</option>
                                {foreach $warehouse_infor as $obj}
                                <option value="{$obj->warehouse_id}" {if $warehouse_id eq $obj->
                                    warehouse_id}selected{/if}>{$obj->warehouse_id}
                                    ({$obj->quycach_name}, {$obj->product_name}, {$obj->size_name})</option>
                                {/foreach}
                            </select>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <div class="btn-group btn-block">
                        <button type="submit" class="btn btn-info btn-sm" name="view">Xem</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- col-md-3-->
    <div class="col-md-9">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">
                    Danh sách
                </h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr style="font-weight: bold;" align="center">
                                <td width="2%">STT</td>
                                <td width="15%">Ngày xuất</td>
                                <td width="15%">Giờ xuất</td>
                                <td width="15%">Mã lý do xuất</td>
                                <td width="15%">Mã kho</td>
                                <td>Quy cách</td>
                                <td>Hàng hóa</td>
                                <td>Size</td>
                                <td>Số lượng</td>
                                <td>Ghi chú</td>
                            </tr>
                        </thead>
                        {$i=1}
                        {foreach $outhistory as $obj}
                        <tr align="center">
                            <td>{$i++}</td>
                            <td>{$obj->date|date_format:"d/m/Y"}</td>
                            <td>{$obj->time}</td>
                            <td>{$obj->reason_id}</td>
                            <td><a
                                        href="{$base_url}warehouse/inventory/{$obj->warehouse_id}">{$obj->warehouse_id}</a></td>
                            <td>{$obj->quycach_name}</td>
                            <td>{$obj->product_name}</td>
                            <td>{$obj->size_name}</td>
                            <td>{$obj->quantity}</td>
                            <td>{$obj->note}</td>
                        </tr>
                        {/foreach}
                    </table>
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">

            </div>
            <!-- /.card-footer -->
        </div>

    </div>
    <!-- col-md-8-->
</div>

<script>
    $(document).ready(function () {
        $("#size_id").focus();
        $("#warehouse_id").select2();
        $("#dataTable").DataTable({
            stateSave: true
        });
    });
</script>