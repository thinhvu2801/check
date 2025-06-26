<div class="row">
    <div class="col-md-3">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Thêm thủ công</h3>
            </div>
            <form action="{$base_url}warehouse/reason_out" method="post">
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
                                name="reason_id" required maxlength="20" {literal}pattern="[A-Za-z0-9-_]{2,}"
                                {/literal}>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Mô tả</span>
                            </div>
                            <input type="text" class="form-control" placeholder="Mô tả" id="reason_description"
                                name="reason_description" required {literal}pattern="[A-Za-z0-9-_]{2,}"
                                {/literal}>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Ngày</span>
                            </div>
                            <input type="date" class="form-control" id="date" name="date" value="{$date}" required>
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
                                <td width="15%">Mã lý do xuất</td>
                                <td>Mô tả</td>
                                <td>Ngày</td>
                                <td width="15%">Chức năng</td>
                            </tr>
                        </thead>
                        {$i=1}
                        {foreach $reason_out as $obj}
                        <tr align="center">
                            <td>{$i++}</td>
                            <td>{$obj->reason_id}</td>
                            <td>{$obj->reason_description}</td>
                            <td>{$obj->date|date_format:"d/m/Y"}</td>
                            <td>
                            <a style="color: #17a2b8" href="{$base_url}warehouse/out/{$obj->reason_id}">
                                    Xuất hàng
                                </a>
                                 | 
                                <a style="color: #da251d" href="{$base_url}warehouse/reasonout_delete/{$obj->reason_id}"
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