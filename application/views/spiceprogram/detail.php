<div class="row">
  <div class="col-md-3">
    <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title">Chọn ngày</h3>
      </div>
      <form action="{$base_url}spice/detail" method="post">
        <div class="card-body">
          <div class="form-group">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text">Ngày</span>
              </div>
              <input name="date" class="form-control" type="date" value="{$date}" />
            </div>
          </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          <div class="btn-group btn-block">
            <button type="submit" class="btn btn-info btn-md" name="stat_detail">Thống kê</button>
          </div>
        </div>
      </form>
    </div>
  </div><!-- ./col-md-3-->
  <div class="col-md-9">
    <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title">Chương trình cân</h3>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <form method="POST" action="{$base_url}spice/detail">
            <input name="date" class="form-control" type="hidden" value="{$date}" />
            <table class="table table-hover table-bordered" width="100%" cellspacing="0">
              <thead>
                <tr style="font-weight: bold;" align="center">
                  <td width="3%">STT</td>
                  <td width="10%">Mã SP</td>
                  <td>Tên SP</td>
                  <td width="15%">Số túi</td>
                  <td width="15%">Khối lượng(kg)</td>
                  <td width="10%">Thời gian</td>
                  <td width="10%">Chọn</td>
                </tr>
              </thead>
              {$i=1}
              {$total=0}
              {$quantity=0}
              <tbody>
                {foreach $program as $r}
                {$total = $total +$r->target_weight}
                {$quantity = $quantity +$r->quantity}
                <tr align="center" {if $program_id eq $r->id}style="color:red;font-weight:bold;"{/if}>
                  <td>{$i++}</td>
                  <td>{$r->product_id}</td>
                  <td>{$r->product_name}</td>
                  <td>{$r->quantity}</td>
                  <td align="right">{$r->target_weight|number_format:3:",":"."}</td>
                  <td>{$r->time}</td>
                  <td>
                    <button type="submit" class="btn btn-info btn-md" name="program_id[]" value="{$r->id}">Chọn</button>
                  </td>
                </tr>
                {/foreach}
              </tbody>
              <tfoot>
                <tr align="right" style="font-weight:bold;">
                  <td colspan="3">Tổng</td>
                  <td align="center">{$quantity}</td>
                  <td>{$total|number_format:3:",":"."}</td>
                  <td></td>
                </tr>
              </tfoot>
            </table>
          </form>
        </div>
      </div>
      <!-- /.card-body -->
      <div class="card-footer">
      </div>
      <!-- /.card-footer -->
    </div>
  </div><!-- ./col-md-9-->
</div>
<div class="row">
  <div class="col-md-5">
    <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title">Công thức</h3>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <form method="POST" action="">
            <table class="table table-hover table-bordered" width="100%" cellspacing="0">
              <thead>
                <tr style="font-weight: bold;" align="center">
                  <td width="3%">STT</td>
                  <td width="15%">Mã gia vị</td>
                  <td>Tên gia vị</td>
                  <td width="20%">KL nồi</td>
                  <td width="20%">KL gia vị theo CT</td>
                  <td width="20%">KL gia vị cần cân</td>
                </tr>
              </thead>
              {$i=1}
              {$total=0}
              <tbody>
                {foreach $recipe as $r}
                {$total = $total + $r->weight_reality}
                <tr align="center">
                  <td>{$i++}</td>
                  <td>{$r->spice_id}</td>
                  <td>{$r->spice_name}</td>
                  <td>{$r->standard_weight|number_format:3:",":"."}</td>
                  <td>{$r->weight|number_format:3:",":"."}</td>
                  <td>{$r->weight_reality|number_format:3:",":"."}</td>
                </tr>
                {/foreach}
              </tbody>
              <tfoot>
                <tr style="font-weight:bold; text-align:right;">
                  <td colspan="5">Tổng:</td>
                  <td align="center">{$total|number_format:3:",":"."}</td>
                </tr>
              </tfoot>
            </table>
          </form>
        </div>
      </div>
      <!-- /.card-body -->
      <div class="card-footer">
      </div>
      <!-- /.card-footer -->
    </div>
    <!-- card-info-->
    <form method="POST" action="{$base_url}spice/detail">
      <input name="date" class="form-control" type="hidden" value="{$date}" />
      <input name="program_id[]" class="form-control" type="hidden" value="{$program_id}" />
      <div class="card card-info">
        <div class="card-header">
          <h3 class="card-title">Tổng hợp khối lượng gia vị</h3>
          <div class="card-tools">
            <button type="submit" class="btn btn-danger btn-sm" name="export_spice">Xuất file</button>
          </div>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-hover table-bordered" width="100%" cellspacing="0">
              <thead>
                <tr style="font-weight: bold;" align="center">
                  <td width="3%">STT</td>
                  <td width="15%">Mã gia vị</td>
                  <td>Tên gia vị</td>
                  <td width="20%">Số lượng</td>
                  <td width="20%">Khối lượng</td>
                </tr>
              </thead>
              {$i=1}
              {$total_weight=0}
              {$quantity=0}
              <tbody>
                {foreach $total_spice as $r}
                {$total_weight = $total_weight + $r->total_weight}
                {$quantity =$quantity+ $r->quantity}
                <tr align="center">
                  <td>{$i++}</td>
                  <td>{$r->spice_id}</td>
                  <td>{$r->spice_name}</td>
                  <td>{$r->quantity}</td>
                  <td align="right">{$r->total_weight|number_format:3:",":"."}</td>
                </tr>
                {/foreach}
              </tbody>
              <tfoot>
                <tr style="font-weight:bold; text-align:right;">
                  <td colspan="3">Tổng:</td>
                  <td align="center">{$quantity}</td>
                  <td>{$total_weight|number_format:3:",":"."}</td>
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
    </form>
    <!-- card-info-->
  </div><!-- ./col-md-5-->
  <div class="col-md-7">
    <form method="POST" action="{$base_url}spice/detail">
      <input name="date" class="form-control" type="hidden" value="{$date}" />
      <input name="program_id[]" class="form-control" type="hidden" value="{$program_id}" />
      <div class="card card-info">
        <div class="card-header">
          <h3 class="card-title">Cân chi tiết</h3>
          <div class="card-tools">
            <button type="submit" class="btn btn-danger btn-sm" name="export_detail">Xuất file</button>
          </div>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-hover table-bordered" id="dataTable_Detail" width="100%" cellspacing="0">
              <thead>
                <tr style="font-weight: bold;" align="center">
                  <td width="3%">STT</td>
                  <td width="15%">Mã gia vị</td>
                  <td>Tên gia vị</td>
                  <td width="20%">Khối lượng(kg)</td>
                  <td width="20%">Thời gian</td>
                </tr>
              </thead>
              {$i=1}
              {$tong=0}
              <tbody>
                {foreach $data_detail as $r}
                {$tong = $tong +$r->weight}
                <tr align="center">
                  <td>{$i++}</td>
                  <td>{$r->spice_id}</td>
                  <td>{$r->spice_name} {if $r->method eq 1}(Check){/if}</td>
                  <td align="right">{$r->weight|number_format:3:",":"."}</td>
                  <td>{$r->time}</td>
                </tr>
                {/foreach}
              </tbody>
              <tfoot>
                <tr style="font-weight:bold; text-align:right;">
                  <td colspan="3">Tổng:</td>
                  <td>{$tong|number_format:3:",":"."}</td>
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
    </form>
    <!-- card-info-->
    <form method="POST" action="{$base_url}spice/detail">
      <input name="date" class="form-control" type="hidden" value="{$date}" />
      <input name="program_id[]" class="form-control" type="hidden" value="{$program_id}" />
      <div class="card card-info">
        <div class="card-header">
          <h3 class="card-title">Cân tổng hợp</h3>
          <div class="card-tools">
            <button type="submit" class="btn btn-danger btn-sm" name="export_general">Xuất file</button>
          </div>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-hover table-bordered" id="dataTable_General" width="100%" cellspacing="0">
              <thead>
                <tr style="font-weight: bold;" align="center">
                  <td width="3%">STT</td>
                  <td width="15%">Mã gia vị</td>
                  <td>Tên gia vị</td>
                  <td width="20%">Số lần cân</td>
                  <td width="20%">Khối lượng(kg)</td>
                </tr>
              </thead>
              {$i=1}
              {$quantity=0}
              {$total_weight=0}
              <tbody>
                {foreach $data_general as $r}
                {$quantity = $quantity +$r->quantity}
                {$total_weight = $total_weight +$r->total_weight}
                <tr align="center">
                  <td>{$i++}</td>
                  <td>{$r->spice_id}</td>
                  <td>{$r->spice_name} {if $r->method eq 1}(Check){/if}</td>
                  <td>{$r->quantity}</td>
                  <td align="right">{$r->total_weight|number_format:3:",":"."}</td>
                </tr>
                {/foreach}
              </tbody>
              <tfoot style="font-weight:bold; text-align:right;">
                <td colspan="3">Tổng:</td>
                <td align="center">{$quantity}</td>
                <td>{$total_weight|number_format:3:",":"."}</td>
              </tfoot>
            </table>
          </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
        </div>
        <!-- /.card-footer -->
      </div>
    </form>
    <!-- card-info-->
  </div><!-- ./col-md-7-->
</div>
<script>
  $(document).ready(function() {
    $('#product_id').select2();
    $('#spice_id').select2();
    $("#dataTable_Detail").DataTable();
    $("#dataTable_General").DataTable();
  });
</script>