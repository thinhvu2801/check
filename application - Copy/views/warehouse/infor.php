<div class="row">
    <div class="col-md-3">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Thêm thủ công</h3>
            </div>
            <form action="{$base_url}warehouse/infor" method="post">
                <div class="card-body">
                    {if $mes neq ""}
                    <p class="mb-0" style="color: red;">{$mes}</p>
                    {/if}
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Mã kho</span>
                            </div>
                            <input type="text" class="form-control" placeholder="Mã kho" id="warehouse_id"
                                name="warehouse_id" required maxlength="20" {literal}pattern="[A-Za-z0-9-_]{2,}"
                                {/literal}>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Quy cách</span>
                            </div>
                            <select class="form-control" name="quycach_id" id="quycach_id">
                                <option value="">Tất cả</option>
                                {foreach $quycach as $obj}
                                <option value="{$obj->quycach_id}">{$obj->quycach_name}</option>
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
                                {foreach $product as $obj}
                                <option value="{$obj->product_id}">{$obj->product_name}</option>
                                {/foreach}
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Size</span>
                            </div>
                            <select class="form-control" name="size_id" id="size_id">
                                <option value="">Tất cả</option>
                                {foreach $size as $obj}
                                <option value="{$obj->size_id}">{$obj->size_name}</option>
                                {/foreach}
                            </select>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <button type="submit" class="btn btn-success btn-sm btn-block">Thêm</button>
                    </div>
                    <!-- /input-group -->
                </div>
                <!-- /.card-body -->

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
                                <td width="15%">Mã kho</td>
                                <td>Quy cách</td>
                                <td>Hàng hóa</td>
                                <td>Size</td>
                                <td width="15%">Chức năng</td>
                            </tr>
                        </thead>
                        {$i=1}
                        {foreach $warehouse_infor as $obj}
                        <tr align="center">
                            <td>{$i++}</td>
                            <td>{$obj->warehouse_id}</td>
                            <td>{$obj->quycach_name}</td>
                            <td>{$obj->product_name}</td>
                            <td>{$obj->size_name}</td>
                            <td>
                                <a style="color: #da251d" href="{$base_url}warehouse/delete/{$obj->id}"
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
        $("#quycach_id").select2();
        $("#product_id").select2();
        $("#size_id").select2();
        $("#dataTable").DataTable({
            stateSave: true
        });
    });
</script>