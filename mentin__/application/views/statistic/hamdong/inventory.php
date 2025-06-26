<form action="{$base_url}hamdong/inventory" method="post" id="form">

<div class="row">
    <div class="col-md-3">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Lựa chọn</h3>
            </div>
            
                <div class="card-body">
                    <!-- Date and time range -->
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Ngày KK</span>
                            </div>
                            <input type="date" class="form-control float-right" name="date" value="{$date}" onchange="this.form.submit();">
                        </div>
                        <!-- /.input group -->
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Giờ KK</span>
                            </div>
                            <input type="time" class="form-control float-right" name="time" value="{$time}">
                        </div>
                        <!-- /.input group -->
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Hầm</span>
                            </div>
                            <select class="form-control" name="ham_id" id="ham_id" onchange="this.form.submit();">
                                {foreach $hamdong as $h}
                                <option value="{$h->ham_id}" {if $ham_id eq $h->ham_id}selected{/if}>{$h->ham_name}</option>
                                {/foreach}
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Loại</span>
                            </div>
                            <select class="form-control" name="product_type_id" id="product_type_id" onchange="this.form.submit();">
                                {foreach $product_type as $s}
                                <option value="{$s->product_type_id}" {if $product_type_id eq $s->product_type_id}selected{/if}>{$s->product_type_id}</option>
                                {/foreach}
                            </select>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">

                </div>
                <!-- /.card-footer -->
        </div>
    </div><!-- ./col-md-3-->
    <div class="col-md-9">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">
                    Size
                </h3>
            </div>
            <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr style="font-weight: bold;" align="center">
                                    <th width="5%">#</th>
                                    <th width="5%">TT</th>
                                    <th>Ngày</th>
                                    <th>Giờ</th>
                                    <th>Size</th>
                                    <th>Khối lượng</th>
                                </tr>
                            </thead>
                            <tbody>
                                {$i=1}
                                {foreach $size as $rs}
                                <tr align="center">
                                    <td>
                                        <input type="checkbox" name="size_id[]" value="{$rs->size_id}" />
                                        <input type="hidden" name="size_id2[]" value="{$rs->size_id}" />
                                    </td>
                                    <td>{$i++}</td>
                                    <td>{$rs->date|date_format:"d/m/Y"}</td>
                                    <td>{$rs->time}</td>
                                    <td>{$rs->size_name}</td>
                                    <td>
                                        <input type="number" class="form-control" name="{$rs->size_id}" value="{$rs->weight}" step="0.001" />
                                    </td>
                                </tr>
                                {/foreach}
                            </tbody>
                        </table>
                        <button type="submit" class="btn btn-info" name="inventory">Kiểm kê</button>
                    </div>
                
            </div>
            <!-- /.card-body -->
            <div class="card-footer">

            </div>
            <!-- /.card-footer -->
        </div>
    </div><!-- ./col-md-8-->
</div>
</form>
<script>
    $(document).ready(function() {
        $('#dataTable').DataTable();
        $('#ham_id').select2();
        $('#product_type_id').select2();
    });
</script>