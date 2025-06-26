<div class="row">
    <div class="col-md-3">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Thêm thủ công</h3>
            </div>
            <form action="{$base_url}warehouse/out" method="post">
                <div class="card-body">
                    {if $mes neq ""}
                    <p class="mb-0" style="color: red;">{$mes}</p>
                    {/if}
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Mã lý do xuất</span>
                            </div>
                            <input type="text" class="form-control" placeholder="Mã lý do xuất" id="reason_id"
                                value="{$reason_id}" name="reason_id" required maxlength="20"
                                {literal}pattern="[A-Za-z0-9-_]{2,}" {/literal}>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Mã kho</span>
                            </div>
                            <select class="form-control" name="warehouse_id" id="warehouse_id">
                                {foreach $warehouse_infor as $obj}
                                <option value="{$obj->warehouse_id}" {if $warehouse_id eq $obj->warehouse_id}selected{/if}>{$obj->warehouse_id}
                                    (Tồn {$obj->quantity_in - $obj->quantity_out}, {$obj->quycach_name}, {$obj->product_name}, {$obj->size_name})</option>
                                {/foreach}
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Số lượng</span>
                            </div>
                            <input type="number" class="form-control" id="quantity" name="quantity" required value="1"
                                min="1">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Ghi chú</span>
                            </div>
                            <input type="text" class="form-control" placeholder="Ghi chú" id="note" name="note">
                        </div>
                    </div>
                   
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <div class="btn-group btn-block">
                    <button type="submit" class="btn btn-info btn-sm" name="view">Xem</button>
                        <button type="submit" class="btn btn-success btn-sm" name="out">Xuất</button>
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
                                <td width="15%">Mã lý do xuất</td>
                                <td>Nội dung</td>
                                <td width="15%">Mã kho</td>
                                <td>Quy cách</td>
                                <td>Hàng hóa</td>
                                <td>Size</td>
                                <td>Số lượng</td>
                                <td width="15%">Chức năng</td>
                            </tr>
                        </thead>
                        {$i=1}
                        {foreach $warehouse_out as $obj}
                        <tr align="center">
                            <td>{$i++}</td>
                            <td>{$obj->reason_id}</td>
                            <td>{$obj->reason_description}</td>
                            <td>{$obj->warehouse_id}</td>
                            <td>{$obj->quycach_name}</td>
                            <td>{$obj->product_name}</td>
                            <td>{$obj->size_name}</td>
                            <td>{$obj->quantity}</td>
                            <td>
                                <a style="color: #da251d"
                                    href="{$base_url}warehouse/out_delete/{$obj->reason_id}/{$obj->warehouse_id}"
                                    onclick="return confirm('Bạn có chắc chắn xóa không?');">
                                    <i class="fas fa-trash">
                                    </i>
                                </a>
                            </td>
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