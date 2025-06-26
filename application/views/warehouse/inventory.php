<div class="row">
    <div class="col-md-3">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Tra cứu</h3>
            </div>
            <form action="{$base_url}warehouse/inventory" method="post">
                <div class="card-body">
                    {if $mes neq ""}
                    <p class="mb-0" style="color: red;">{$mes}</p>
                    {/if}
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Ngày</span>
                            </div>
                            <input type="date" class="form-control" id="date" name="date" value="{$date}" required>
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
        <form action="{$base_url}warehouse/kiemke" method="post">
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
                                    <td width="15%">Mã kho</td>
                                    <td>Quy cách</td>
                                    <td>Hàng hóa</td>
                                    <td>Size</td>
                                    <td>Nhập kho</td>
                                    <td>Xuất kho</td>
                                    <td>Tồn SL</td>
                                    <td>Net</td>
                                    <td>SUM Net</td>
                                    <td>Kiểm kê SL</td>
                                    <td>Kiểm kê KL</td>
                                </tr>
                            </thead>
                            {$i=1}
                            {foreach $inventory as $obj}
                            <tr align="center">
                                <input type="hidden" class="form-control" name="warehouse_id[]"
                                    value="{$obj->warehouse_id}" />
                                <input type="hidden" class="form-control" name="remain[]"
                                    value="{$obj->quantity_remain}" />
                                <td>{$i++}</td>
                                <td>{$obj->warehouse_id}</td>
                                <td>{$obj->quycach_name}</td>
                                <td>{$obj->product_name}</td>
                                <td>{$obj->size_name}</td>
                                <td><a
                                        href="{$base_url}warehouse/inhistory/{$obj->warehouse_id}">{$obj->quantity_in}</a></td>
                                <td><a
                                        href="{$base_url}warehouse/outhistory/{$obj->warehouse_id}">{$obj->quantity_out}</a>
                                </td>
                                <td>{$obj->quantity_remain}</td>
                                <td>{$obj->netweight}</td>
                                <td>{$obj->total_netweight}</td>
                                <td width="10%">
                                    <input type="number" class="form-control" name="quantity[]"
                                        value="{$obj->quantity_remain}" min="0" />
                                </td>
                                <td width="10%">
                                    <input type="number" class="form-control" name="weight[]"
                                        value="0" min="0" step="0.01"/>
                                </td>
                            </tr>
                            {/foreach}
                        </table>
                    </div>

                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <div class="btn-group btn-block">
                        <button type="submit" class="btn btn-info btn-sm" name="kiemke">Kiểm kê</button>
                    </div>
                </div>
        </form>
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