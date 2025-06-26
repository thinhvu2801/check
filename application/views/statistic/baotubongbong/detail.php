<div class="row">
    <div class="col-md-3">
        <div class="card card-info" id="card_filter">
            <div class="card-header">
                <h3 class="card-title">Lựa chọn</h3>
            </div>
            <form action="{$base_url}baotubongbong/detail" method="post" id="form">
                <div class="card-body">
                    <!-- Date and time range -->
                    <div class="form-group">
                        <label>Ngày giờ:</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="far fa-clock"></i></span>
                            </div>
                            <input type="text" class="form-control float-right" name="datetime" id="reservationtime">
                        </div>
                        <!-- /.input group -->
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">LÔ</span>
                            </div>
                            <select class="form-control" name="lo_id" id="lo_id">
                                <option value="">Tất cả</option>
                                {foreach $lohang as $lo}
                                <option value="{$lo->lo_id}" {if $lo_id eq $lo->lo_id}selected{/if}>{$lo->lo_id}</option>
                                {/foreach}
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">CN</span>
                            </div>
                            <select class="form-control" name="worker_id" id="worker_id">
                                <option value="">Tất cả</option>
                                {foreach $worker as $wk}
                                <option value="{$wk->worker_id}" {if $worker_id eq $wk->worker_id}selected{/if}>{$wk->worker_name}</option>
                                {/foreach}
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">SP</span>
                            </div>
                            <select class="form-control" name="product_id" id="product_id">
                                <option value="">Tất cả</option>
                                {foreach $product as $pr}
                                <option value="{$pr->product_id}" {if $product_id eq $pr->product_id}selected{/if}>{$pr->product_name}</option>
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
        <div class="card card-info" id="card_result">
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
                            <td width="3%">STT</td>
                            <td>Id</td>
                            <td>Mã thẻ</td>
                            <td>Mã công nhân</td>
                            <td width="20%">Công nhân</td>
                            <!-- <td>Mã sản phẩm</td> -->
                            <td>Sản phẩm</td>
                            <td width="10%">Khối lượng</td>
                            <td width="13%">Ngày</td>
                            <td>TG</td>
                            <!-- <td></td> -->
                        </tr>
                    </thead>
                    <tbody>
                        {$i=1}
                        {$khoi_luong=0}
                        {foreach $result as $rs}
                        {$khoi_luong = $khoi_luong + $rs.weight}
                        <tr>
                            <td align="center">{$i++}</td>
                            <td>{$rs.id}</td>
                            <td>{$rs.factory_id}</td>
                            <td>{$rs.worker_id}</td>
                            <td>{$rs.worker_name}</td>
                            <!-- <td>{$rs.product_id}</td> -->
                            <td>{$rs.product_name}</td>
                            <td align="right">{$rs.weight|number_format:3:",":"."}</td>
                            <td>{$rs.date|date_format:"d/m/Y"}</td>
                            <td>{$rs.time}</td>
                            <!-- <td>
                                {if ($admin eq 1) or ( $admin eq 99)}
                                    {if (empty($rs.note))}
                                        <input type="button" name="editButton" style="margin-top:5px; padding:5px;" value="Sửa" data-toggle="modal" data-target="#update{$rs.id}" style="cursor: pointer;" alt="Điều chỉnh">
                                        </input>
                                    {/if}
                                {/if}
                            </td> -->
                        </tr>
                        {/foreach}
                    </tbody>
                    <tfoot>
                        <tr align="right" style="font-weight: bold;">
                            <td align="right" colspan="7">Tổng: </td>
                            <td align="right">{$khoi_luong|number_format:3:",":"."}</td>
                            <td></td>
                        </tr>
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
{foreach $result as $rs}
<div class="modal fade" id="update{$rs.id}">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Điều chỉnh</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="form-horizontal" method="post" name="updateproduct" action="{$base_url}baotubongbong/update">
        <input type="hidden" name="id" value="{$rs.id}">
        <div class="modal-body">
            <div class="form-group row">
            <label for="worker_id" class="col-sm-2 col-form-label">Mã công nhân:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="worker_id{$rs.id}" name="worker_id" placeholder="Mã công nhân" required value="{$rs.worker_id}" disabled>
                </div>
            </div>
          <div class="form-group row">
            <label for="worker_name" class="col-sm-2 col-form-label">Tên công nhân:</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="worker_name{$rs.id}" name="worker_name" placeholder="Tên công nhân" required value="{$rs.worker_name}" disabled>
            </div>
          </div>
          <div class="form-group row">
            <label for="product_id" class="col-sm-2 col-form-label">Sản phẩm:</label>
            <div class="col-sm-10">
              <select class="form-control group_product" style="width: 100%;" name="product_id" id="product_id{$rs.id}">
                    {foreach $product as $pr}
                        <option value="{$pr->product_id}" {if $rs.product_id eq $pr->product_id}selected{/if}>{$pr->product_name}</option>
                    {/foreach}
              </select>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Đóng</button>
          <button type="submit" class="btn btn-primary btn-sm" name="editcapnhat" data-so-phieu="{$rs.id}">Cập nhật</button>
        </div>
      </form>
    </div>
  </div>
</div>
{/foreach}
<script>
$(document).ready(function() {
    $('#lo_id,#worker_id,#product_id').select2();
    $('#dataTable').dataTable();
    $('#reservationtime').daterangepicker({
        timePicker: true,
        startDate: '{$startDate}',
        endDate: '{$endDate}',
        timePickerIncrement: 1,
        timePicker24Hour:true,
        locale: {
            format: 'DD/MM/YYYY HH:mm A'
        }
    })
});
</script>