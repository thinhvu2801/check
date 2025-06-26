<div class="row">
    <div class="col-md-3">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Lựa chọn</h3>
            </div>
            <form action="{$base_url}phupham/chitiet" method="post" id="form">
                <div class="card-body">
                    <!-- Date and time range -->
                    <div class="form-group">
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
                                <span class="input-group-text">Xe</span>
                            </div>
                            <select class="form-control" name="xe_id" id="xe_id">
                                <option value="">Tất cả</option>
                                {foreach $xe as $x}
                                <option value="{$x->xe_id}" {if $xe_id eq $x->xe_id}selected{/if}>{$x->xe_id}</option>
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
                                <th width="5%">TT</th>
                                <th width="10%">Mã SP</th>
                                <th>Sản phẩm</th>
                                <th  width="15%">Khối lượng</th>
                                <th  width="15%">Thời gian</th>
                                <th  width="5%">Điều chỉnh</th>
                            </tr>
                        </thead>
                        <tbody>
                            {$i=1}
                            {$sum_weight=0}
                            {foreach $result as $rs}
                            {$sum_weight=$sum_weight+$rs.weight}
                            <tr>
                            <td align="center">{$i++}</td>
                            <td>{$rs.product_id}</td>
                            <td>{$rs.product_name}</td>
                            <td align="right">{$rs.weight}</td>
                            <td>{$rs.time}</td>
                             <td>
                                    <a style="color: #17a2b8" href="#" data-toggle="modal" data-target="#update{$rs.id}" style="cursor: pointer;" alt="Điều chỉnh">
                                        <i class="fas fa-pencil-alt">
                                        </i>
                                    </a>
                                </td>
                            </tr>
                            {/foreach}
                        </tbody>
                        <tfoot  style="font-weight: bold;">
                            <td colspan="3" align="right">Tổng</td>
                            <td align="right">{$sum_weight|number_format:1:",":"."}</td>
                            <td></td>
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
      <form class="form-horizontal" method="post" name="updateChitiet" action="{$base_url}phupham/updateproductid">
        <input type="hidden" name="old_product_id" value="{$rs.product_id}">
        <input type="hidden" name="id" value="{$rs.id}">
        <div class="modal-body">
          <div class="form-group row">
            <label for="new_product_id" class="col-sm-2 col-form-label">Mã:</label>
            <div class="col-sm-10">
                <select class="form-control" name="new_product_id" id="new_product_id">
                                {foreach $product as $pr}
                                <option value="{$pr->product_id}">{$pr->product_name}
                                </option>
                                {/foreach}
                            </select>
            </div>
          </div>
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
          <button type="submit" class="btn btn-primary" id="capnhat" name="capnhat">Cập nhật</button>
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
{/foreach}
<script>
    $(document).ready(function() {
        $('#reservationtime').daterangepicker({
            timePicker: true,
            startDate: '{$startDate}',
            endDate: '{$endDate}',
            timePicker24Hour:true,
            timePickerIncrement: 1,
            locale: {
                format: 'DD/MM/YYYY HH:mm A'
            }
        });
        $('#dataTable').DataTable();
    });
</script>