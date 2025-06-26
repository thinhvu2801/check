<div class="row">
    <div class="col-md-2">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Lựa chọn</h3>
            </div>
            <form action="{$base_url}suaca/phieucan" method="post" id="form">
                <div class="card-body">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Mã phiếu</i></span>
                            </div>
                            <input type="text" class="form-control" name="id_suaca" value="{$id_suaca}" />
                        </div>
                    </div>

                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <div class="btn-group btn-block">
                        <button type="submit" class="btn btn-info btn-sm" name="search">Tìm</button>
                    </div>
                </div>
                <!-- /.card-footer -->
            </form>
        </div>

    </div><!-- ./col-md-3-->
    <div class="col-md-10">
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
                                <td>Ngày</td>
                                <td>Lô</td>
                                <td>Mã NM</td>
                                <td>Mã CN</td>
                                <td>Công nhân</td>
                                <td>Mã SP</td>
                                <td>Sản phẩm</td>
                                <td width="7%">Giờ vào</td>
                                <td width="7%">KL vào</td>
                                <td width="7%">Giờ ra</td>
                                <td width="7%">KL ra</td>
                            </tr>
                        </thead>
                        <tbody>
                            {if $result neq null}
                            <tr>
                                <td>{$result->date|date_format:"d/m/Y"}</td>
                                <td>{$result->lo_id}</td>
                                <td>{$result->factory_id}</td>
                                <td>{$result->worker_id}</td>
                                <td>{$result->worker_name}</td>
                                <td>{$result->product_id}</td>
                                <td>{$result->product_name}</td>
                                <td>{$result->time_in}</td>
                                <td>{$result->weight_in}</td>
                                <td>{$result->time_out}</td>
                                <td>{$result->weight_out}</td>
                            </tr>
                            {/if}
                        </tbody>
                    </table>
                </div>
            </div><!-- /.card-body -->
            <div class="card-footer">
                {if $result neq null}
                <form action="{$base_url}suaca/phieucan" method="POST">
                    <input type="hidden" class="form-control" name="id_suaca" value="{$id_suaca}" />
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Lô cần đổi</span>
                            </div>
                            <select class="form-control" name="lo_id" id="lo_id">
                                {foreach $lohang as $pr}
                                <option value="{$pr->lo_id}" {if $result->lo_id eq $pr->lo_id}selected{/if}>{$pr->lo_id}</option>
                                {/foreach}
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Sản phẩm cần đổi</span>
                            </div>
                            <select class="form-control" name="product_id" id="product_id">
                                {foreach $product as $pr}
                                <option value="{$pr->product_id}" {if $result->product_id eq $pr->product_id}selected{/if}>({$pr->product_id}){$pr->product_name}</option>
                                {/foreach}
                            </select>
                            <div class="input-group-prepend">
                                <button type="submit" class="btn btn-info btn-sm" name="update">Cập nhật</button>
                                <button type="submit" class="btn btn-danger btn-sm" name="delete">Xóa phiếu</button>
                            </div>
                        </div>
                    </div>
                </form>

                <div class="table-responsive">
                    <table class="table table-hover table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr style="font-weight: bold;" align="center">
                                <td>Phiếu</td>
                                <td>Mã lô mới</td>
                                <td>Mã SP mới</td>
                                <td>Ngày</td>
                                <td>Giờ</td>
                                <td>Người cập nhật</td>
                                <td width="7%">Thao tác</td>
                                <td></td>
                            </tr>
                        </thead>
                        <tbody>
                            {foreach $history as $rs}
                            <tr align="center">
                                <td>{$rs.id_suaca}</td>
                                <td>{$rs.lo_id}</td>
                                <td>{$rs.product_id}</td>
                                <td>{$rs.date|date_format:"d/m/Y"}</td>
                                <td>{$rs.time}</td>
                                <td>{$rs.username}</td>
                                <td>{if $rs.deleted eq 0}Cập nhật{else}Xóa{/if}</td>
                                <td>
                                    <a style="color: #da251d" href="{$base_url}suaca/deletephieucan/{$rs.id_suaca}" onclick="return confirm('Bạn có chắc chắn xóa không?');">
                                        <i class="fas fa-trash">
                                        </i>
                                    </a>
                                </td>
                            </tr>
                            {/foreach}
                        </tbody>
                    </table>
                </div>
                {/if}
            </div>
            <!-- /.card-footer -->
        </div>


    </div>
</div><!-- ./col-md-8-->
</div>
<script>
    $(document).ready(function() {
        $('#product_id').select2();
        $('#lo_id').select2();
    });
</script>