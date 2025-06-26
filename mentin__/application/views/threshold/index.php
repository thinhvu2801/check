<div class="row">
    <div class="col-md-3">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Lựa chọn</h3>
            </div>
            <form action="{$base_url}threshold/index" method="post" id="form">
                <div class="card-body">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">LÔ</span>
                            </div>
                            <select class="form-control" name="lo_id" id="lo_id">
                                <option value="-">Tất cả</option>
                                {foreach $lohang as $lo}
                                <option value="{$lo->lo_id}" {if $lo_id eq $lo->lo_id}selected{/if}>{$lo->lo_id}
                                </option>
                                {/foreach}
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <button type="submit" class="btn btn-success btn-sm btn-block" name="select">Chọn</button>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">

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
                <form method="post" name="product_threshold" action="{$base_url}threshold/index">
                    <input type="hidden" name="lo_id" value="{$lo_id}">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr style="font-weight: bold;" align="center">
                                    <td width="3%">STT</td>
                                    <td width="20%">Mã SP</td>
                                    <td>Sản phẩm</td>
                                    <td width="20%">Định mức min</td>
                                    <td width="20%">Định mức max</td>
                                </tr>
                            </thead>
                            <tbody>
                                {$i=1}
                                {foreach $result as $rs}
                                <tr>
                                    <td align="center">{$i++}</td>
                                    <td align="center">{$rs->product_id}</td>
                                    <td>{$rs->product_name}</td>
                                    <td align="right">
                                        <input type="hidden" name="product_id[]" value="{$rs->product_id}">
                                        <input type="number" class="form-control float-right" name="threshold_min[]" step="0.001" value="{if $rs->min eq null}1{else}{$rs->min}{/if}">
                                    </td>
                                    <td><input type="number" class="form-control float-right" name="threshold_max[]" step="0.001" value="{if $rs->max eq null}1{else}{$rs->max}{/if}"></td>
                                </tr>
                                {/foreach}
                            </tbody>
                        </table>
                    </div>
                    {if ($lo_id neq "") and ($result|count neq 0)}
                    <button type="submit" class="btn btn-success btn-sm btn-block" name="update">Cập nhật</button>
                    {/if}
                </form>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">

            </div>
            <!-- /.card-footer -->
        </div>
    </div><!-- ./col-md-8-->
</div>