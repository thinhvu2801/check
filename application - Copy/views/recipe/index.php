<div class="row">
  <div class="col-md-3">
    <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title">Thêm công thức</h3>
      </div>
      <form action="{$base_url}recipe" method="post">
        <div class="card-body">
          {if $mes neq ""}
          <p class="mb-0" style="color: red;">{$mes}</p>
          {/if}
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
                <span class="input-group-text">Gia vị</span>
              </div>
              <select class="form-control" name="spice_id" id="spice_id">
                {foreach $spice as $p}
                <option value="{$p->spice_id}" {if $spice_id eq $p->spice_id}selected{/if}>{$p->spice_name}</option>
                {/foreach}
              </select>
            </div>
          </div>
          <div class="form-group">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text">KL nồi</span>
              </div>
              <input name="standard_weight" class="form-control" type="number" min="0" max="200" value="{$standard_weight}" />
            </div>
          </div>
          <div class="form-group">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text">KL gia vị</span>
              </div>
              <input name="weight" class="form-control" type="number" min="0" max="10000" value="0" step="0.001"/>
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
        <h3 class="card-title">Công thức</h3>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <form method="POST" action="{$base_url}recipe">
            <table class="table table-hover table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr style="font-weight: bold;" align="center">
                  <td width="3%">STT</td>
                  <td width="15%">Mã gia vị</td>
                  <td>Tên gia vị</td>
                  <td width="15%">Khối lượng nồi (kg)</td>
                  <td width="15%">Khối lượng gia vị (kg)</td>
                  <td width="15%">Chức năng</td>
                </tr>
              </thead>
              {$i=1}
              {$tong=0}
              {foreach $recipe as $r}
              {$tong = $tong + $r->weight}
              <tbody align="center">
                <td>{$i++}</td>
                <td>{$r->spice_id}</td>
                <td>{$r->spice_name}</td>
                <td>{$r->standard_weight|number_format:3:",":"."}</td>
                <td>{$r->weight|number_format:3:",":"."}</td>
                <td>
                  <!-- <a style="color: #17a2b8" href="#" data-toggle="modal" data-target="#update{$r->id}" style="cursor: pointer;" alt="Điều chỉnh">
                        <i class="fas fa-pencil-alt">
                        </i>
                    </a> -->
                  <a style="color: #da251d" href="{$base_url}recipe/delete/{$r->id}/{$r->product_id}" onclick="return confirm('Bạn có chắc chắn xóa không?');">
                    <i class="fas fa-trash">
                    </i>
                  </a>
                </td>
              </tbody>
              {/foreach}
              <tfoot style="font-weight:bold;text-align:center">
                <td colspan="4">Tổng:</td>
                <td>{$tong|number_format:3:",":"."}</td>
                <td></td>
              </tfoot>
            </table>
            <input type="hidden" value="{$product_id}" name="product_id"/>
            <input type="hidden" value="{$spice_id}" name="spice_id"/>
            <input type="hidden" value="{$standard_weight}" name="standard_weight"/>
            <button type="submit" class="btn btn-info btn-md" name="recipe_create"
             onclick="return confirm('Bạn có chắc chắn tạo công thức mới không?');">Tạo công thức mới</button>
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