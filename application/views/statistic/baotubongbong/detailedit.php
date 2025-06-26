<div class="row">
    <div class="col-md-3">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Kiểm tra ID</h3>
            </div>
            <form action="{$base_url}baotubongbong/detail_edit" method="post">
                <div class="card-body">
                    {if $mes neq ""}
                    <p class="mb-0" style="color: red;">{$mes}</p>
                    {/if}
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">ID</span>
                            </div>
                            <input type="text" class="form-control" placeholder="ID" id="id" name="id" required {literal}pattern="[0-9]+" {/literal}>
                        </div>
                    </div>
                   
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <div class="btn-group btn-block">
                        <button type="submit" class="btn btn-info btn-sm" name="check">Kiểm tra</button>
                    </div>
                </div>
            </form>
        </div>
        {foreach $result_id as $rsid}
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Chỉnh sửa</h3>
            </div>
            <form action="{$base_url}baotubongbong/update" method="post">
                <div class="card-body">
                    <input type="hidden" name="id" value="{$rsid.id}">
                    <input type="hidden" name="worker_id" value="{$rsid.worker_id}">
                    <input type="hidden" name="old_product_id" value="{$rsid.product_id}">
                    <input type="hidden" name="weight" value="{$rsid.weight}">
                    <input type="hidden" name="date" value="{$rsid.date}">
                    <input type="hidden" name="time" value="{$rsid.time}">
                    <div class="form-group row">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Ngày</span>
                            </div>
                            <input type="text" class="form-control" id="date" name="date" required value="{$rsid.date|date_format:"d/m/Y"}" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Giờ</span>
                            </div>
                            <input type="text" class="form-control" id="time" name="time" required value="{$rsid.time}" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Mã CN</span>
                            </div>
                            <input type="text" class="form-control" id="worker_id" name="worker_id" required value="{$rsid.worker_id}" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Tên CN</span>
                            </div>
                            <input type="text" class="form-control" id="worker_name" name="worker_name" required value="{$rsid.worker_name}" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Sản phẩm:</span>
                            </div>
                            <select class="form-control" style="width: 100%;" name="product_id" id="product_id">
                                {foreach $product as $pr}
                                    <option value="{$pr->product_id}" {if $rsid.product_id eq $pr->product_id}selected{/if}>{$pr->product_name}</option>
                                {/foreach}
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Khối lượng</span>
                            </div>
                            <input type="text" class="form-control" id="weight" name="weight" required value="{$rsid.weight|number_format:2:",":"."}" disabled>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <div class="btn-group btn-block">
                        <button type="submit" class="btn btn-success btn-sm" name="capnhat">Cập nhật</button>
                    </div>
                </div>
            </form>
        </div>
        {/foreach}
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
                                <td>ID</td>
                                <td>Mã công nhân</td>
                                <td>Tên công nhân</td>
                                <td width="15%">Sản phẩm</td>
                                <td>Khối lượng</td>
                                <td>Ngày</td>
                                <td>Thời gian</td>
                                <td>Ghi chú</td>
                            </tr>
                        </thead>
                        {$i=1}
                        {foreach $result as $rs}
                        <tr align="center">
                            <td>{$i++}</td>
                            <td>{$rs.id}</td>
                            <td>{$rs.worker_id}</td>
                            <td>{$rs.worker_name}</td>
                            <td>{$rs.product_name}</td>
                            <td>{$rs.weight}</td>
                            <td>{$rs.date|date_format:"d/m/Y"}</td>
                            <td>{$rs.time}</td>
                            <td>{$rs.note}</td>
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