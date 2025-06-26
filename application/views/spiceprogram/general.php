<div class="row">
  <div class="col-md-3">
    <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title">Chọn ngày</h3>
      </div>
      <form action="{$base_url}spice/general" method="post">
        <div class="card-body">
          <div class="form-group">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text">Từ</span>
              </div>
              <input type="date" name="start_date" class="form-control" value="{$start_date}" />
            </div>
          </div>
          <div class="form-group">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text">Đến</span>
              </div>
              <input type="date" class="form-control" name="end_date" value="{$end_date}" />
            </div>
          </div>
          <div class="form-group">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text">Sản phẩm</span>
              </div>
              <select class="form-control" name="product_id" id="product_id">
                <option value="">Tất cả</option>
                {foreach $product as $pr}
                <option value="{$pr->product_id}" {if $product_id eq $pr->product_id}selected{/if}>{$pr->product_name}</option>
                {/foreach}
              </select>
            </div>
          </div>
          <div class="form-group">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text">Gia vị</span>
              </div>
              <select class="form-control" name="spice_id" id="spice_id">
                <option value="">Tất cả</option>
                {foreach $spice as $sp}
                <option value="{$sp->spice_id}" {if $spice_id eq $sp->spice_id}selected{/if}>{$sp->spice_name}</option>
                {/foreach}
              </select>
            </div>
          </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          <div class="btn-group btn-block">
            <button type="submit" class="btn btn-info btn-md" name="stat_general">Thống kê</button>
          </div>
        </div>
      </form>
    </div>
  </div><!-- ./col-md-3-->
  <div class="col-md-9">
    <form method="POST" action="{$base_url}spice/general">
      <input type="hidden" name="start_date" class="form-control" value="{$start_date}" />
      <input type="hidden" name="end_date" class="form-control" value="{$end_date}" />
      <input type="hidden" name="product_id" class="form-control" value="{$product_id}" />
      <input type="hidden" name="spice_id" class="form-control" value="{$spice_id}" />
      <div class="card card-info">
        <div class="card-header">
          <h3 class="card-title">Kết quả cân</h3>
          <div class="card-tools">
            <button type="submit" class="btn btn-danger btn-sm" name="export_general">Xuất file</button>
          </div>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-hover table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr style="font-weight: bold;" align="center">
                  <td width="3%">STT</td>
                  <td width="10%">Mã SP</td>
                  <td>Tên SP</td>
                  <td width="15%">Mã GV</td>
                  <td width="15%">Tên GV</td>
                  <td width="10%">Số lượng</td>
                  <td width="10%">Khối lượng</td>
                </tr>
              </thead>
              {$i=1}
              {$total=0}
              {$quantity=0}
              {$product_id=""}
              <tbody>
                {foreach $result as $r}
                {$total = $total +$r->total_weight}
                {$quantity = $quantity +$r->quantity}
                <tr align="center">
                  {if $product_id neq $r->product_id}
                  <td>{$i++}</td>
                  <td>{$r->product_id}</td>
                  <td>{$r->product_name}</td>
                  {$product_id = $r->product_id}
                  {else}
                  <td></td>
                  <td></td>
                  <td></td>
                  {/if}
                  <td>{$r->spice_id}</td>
                  <td>{$r->spice_name}</td>
                  <td>{$r->quantity}</td>
                  <td align="right">{$r->total_weight|number_format:3:",":"."}</td>
                </tr>
                {/foreach}
              </tbody>
              <tfoot>
                <tr align="right" style="font-weight:bold;">
                  <td colspan="5">Tổng</td>
                  <td align="center">{$quantity}</td>
                  <td>{$total|number_format:3:",":"."}</td>
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
      <!-- /.card-infor -->
    </form>
  </div><!-- ./col-md-9-->
</div>

<script>
  $(document).ready(function() {
    $("#product_id").select2();
    $("#spice_id").select2();
    $("#dataTable").DataTable({
      'ordering':false
    });
  });
</script>