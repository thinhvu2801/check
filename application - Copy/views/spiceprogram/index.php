<div class="row">
  <div class="col-md-3">
    <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title">Chương trình cân</h3>
      </div>
      <form action="{$base_url}spiceprogram" method="post">

        <div class="card-body">
          {if $mes neq ""}
          <p class="mb-0" style="color: red;">{$mes}</p>
          {/if}
          <div class="form-group">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text">Ngày</span>
              </div>
              <input name="date" class="form-control" type="date" value="{$date}" onchange="this.form.submit();" />
            </div>
          </div>
          <div class="form-group">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text">Sản phẩm</span>
              </div>
              <select class="form-control" name="product_id" id="product_id" onchange="this.form.submit();">
                {foreach $product as $p}
                <option value="{$p->product_id}" {if $product_id eq $p->product_id}selected{/if}>{$p->product_name}</option>
                {/foreach}
              </select>
            </div>
          </div>
          <div class="form-group">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text">Số túi</span>
              </div>
              <input name="quantity" class="form-control" type="number" min="1" max="200" value="{$quantity}" />
            </div>
          </div>
          <div class="form-group">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text">Khối lượng</span>
              </div>
              <input name="target_weight" class="form-control" type="number" min="1" max="10000" value="{$target_weight}" />
            </div>
          </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          <div class="btn-group btn-block">
            <button type="submit" class="btn btn-info btn-md" name="recipe_insert">Thêm</button>
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
          <form method="POST" action="{$base_url}/spiceprogram/selected">
            <input type="hidden" name="date" value="{$date}" />
            <table class="table table-hover table-bordered" width="100%" cellspacing="0">
              <thead>
                <tr style="font-weight: bold;" align="center">
                  <td width="3%">STT</td>
                  <td width="10%">Mã SP</td>
                  <td>Tên SP</td>
                  <td width="15%">Số túi</td>
                  <td width="15%">Khối lượng(kg)</td>
                  <td width="10%">Thời gian</td>
                  <td width="7%">Cân</td>
                  <td width="7%">Kiểm</td>
                  <td width="10%">Chọn</td>
                </tr>
              </thead>
              {$i=1}
              {$tong=0}
              <tbody>
                {foreach $program as $r}
                <tr align="center" {if $r->selected eq 1}style="color:red;font-weight:bold;"{/if}>
                  <td>{$i++}</td>
                  <td>{$r->product_id}</td>
                  <td>{$r->product_name}</td>
                  <td>{$r->quantity}</td>
                  <td align="right">{$r->target_weight|number_format:3:",":"."}</td>
                  <td>{$r->time}</td>
                  <td>
                    <input class="form-control" type="radio" id="way0" name="method{$r->id}[]" value="0" {if $r->method eq 0}checked{/if}>
                    <!-- <label for="way0">Cân</label> -->
                  </td>
                  <td><input class="form-control" type="radio" id="way1" name="method{$r->id}[]" value="1" {if $r->method eq 1}checked{/if}>
                    <!-- <label for="way1">Kiểm</label> -->
                  </td>
                  <td>
                    <button type="submit" class="btn btn-info btn-md" name="selected_program[]" value="{$r->id}">Chọn</button>
                  </td>
                </tr>
                {/foreach}
              </tbody>
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
        <h3 class="card-title">Công thức quy đổi</h3>
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
                  <td width="20%">Số túi</td>
                  <td width="20%">KL chuẩn (kg)</td>
                  <td width="20%">KL quy đổi(kg)</td>
                </tr>
              </thead>
              {$i=1}
              {$tong=0}
              <tbody>
                {foreach $recipe as $r}
                {$weight = $r->weight*($r->target_weight/$r->standard_weight)}
                {$tong = $tong +$weight}
                <tr align="center">
                  <td>{$i++}</td>
                  <td>{$r->spice_id}</td>
                  <td>{$r->spice_name}</td>
                  <td>{$r->quantity}</td>
                  <td>{$r->weight|number_format:3:",":"."}/{$r->standard_weight|number_format:3:",":"."}</td>
                  <td align="right">{$weight|number_format:3:",":"."}</td>
                </tr>
                {/foreach}
              </tbody>
              <tfoot>
                <tr style="font-weight:bold; text-align:right;">
                  <td colspan="5">Tổng:</td>
                  <td>{$tong|number_format:3:",":"."}</td>
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
  </div><!-- ./col-md-5-->
  <div class="col-md-7">
    <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title">Chi tiết</h3>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <form method="POST" action="">
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
          </form>
        </div>
      </div>
      <!-- /.card-body -->
      <div class="card-footer">
      </div>
      <!-- /.card-footer -->
    </div>
    <!-- card-info-->
    <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title">Tổng hợp</h3>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <form method="POST" action="">
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
          </form>
        </div>
      </div>
      <!-- /.card-body -->
      <div class="card-footer">
      </div>
      <!-- /.card-footer -->
    </div>
    <!-- card-info-->
  </div><!-- ./col-md-7-->
</div>
<script>
  
  $(document).ready(function() {
    $('#product_id').select2();
    $("#dataTable_Detail").DataTable();
    $("#dataTable_General").DataTable();
  });
</script>