<div class="row">
  <div class="col-md-3">
    <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title">Chọn SP</h3>
      </div>
      <form action="{$base_url}recipe/history" method="post">
        <div class="card-body">
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
        </div>
        <!-- /.card-body -->
      </form>
    </div>
  </div><!-- ./col-md-3-->
  <div class="col-md-9">
    <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title">Công thức</h3>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <form method="POST" action="{$base_url}recipe/history">
            <input type="hidden" name="product_id" value="{$product_id}"/>
            <table class="table table-hover table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr style="font-weight: bold;" align="center">
                  <td width="20%">Phiên bản</td>
                  <td width="15%">Mã gia vị</td>
                  <td>Tên gia vị</td>
                  <td width="15%">Khối lượng nồi (kg)</td>
                  <td width="15%">Khối lượng gia vị (kg)</td>
                </tr>
              </thead>
              {$version=0}
              <tbody align="center">
                {foreach $recipe as $r}
                <tr>
                  {if $version neq $r->version}
                  {$version = $r->version}
                  <td>
                    {$r->version}<br>
                    ({$r->date_create|date_format:"d/m/Y"} {if $r->active eq 1}Đang áp dụng{/if})<br>
                    {if $r->active eq 0}
                    <button type="submit" class="btn btn-info btn-md" name="recipe_active[]" value="{$r->version}" onclick="return confirm('Bạn có chắc chắn áp dụng công thức mới?');">
                    Áp dụng </button>{/if}
                    
                  </td>
                  {else}
                  <td></td>
                  {/if}
                  <td>{$r->spice_id}</td>
                  <td>{$r->spice_name}</td>
                  <td>{$r->standard_weight|number_format:3:",":"."}</td>
                  <td>{$r->weight|number_format:3:",":"."}</td>
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
    <!-- card-info-->
  </div><!-- ./col-md-9-->
</div>
<script>
  $(document).ready(function() {
    $('#product_id').select2();
    $('#spice_id').select2();
  });
</script>