<div class="row">
  <div class="col-md-3">
    <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title">Thêm thủ công</h3>
      </div>
      <form action="{$base_url}product/insert" method="post">
        <input type="hidden" name="parent_id" value="{$parent_id}">
        <div class="card-body">
          {if $mes neq ""}
          <p class="mb-0" style="color: red;">{$mes}</p>
          {/if}
          <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Mã sản phẩm" id="product_id" name="product_id"required maxlength="20" {literal}pattern="[A-Za-z0-9-_]{3,}"{/literal}>
          </div>
          <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Tên sản phẩm" name="product_name">
          </div>
          <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="KL min" name="weight_min" value="0">
          </div>
          <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="KL max" name="weight_max" value="0">
          </div>
          <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Khách hàng" name="note">
          </div>
          <div class="form-group">
            <label>Liên kết</label>
            <select class="form-control select2" style="width: 100%;" name="linkable">
              <option value="0" selected="selected">Không</option>
              <option value="1">Có</option>
            </select>
          </div>
          <div class="input-group mb-3">
            <button type="submit" class="btn btn-success btn-sm btn-block">Thêm</button>
          </div>
          <!-- /input-group -->
        </div>
        <!-- /.card-body -->
       
      </form>
    </div>
    <!-- card-info-->
    {if $parent_id neq "0"}
    <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title">Thêm từ Excel</h3>
      </div>
      <form action="{$base_url}product/import" method="post" enctype="multipart/form-data">
        <input type="hidden" name="parent_id" value="{$parent_id}">
        <div class="card-body">
          <div class="form-group">
            <div class="input-group">
              <input type="file" class="form-control" id="file_xls" name="file_xls" placeholder="Chọn file excel chứa dữ liệu" accept=".xls" required>
            </div>
            <div class="input-group">
              <a href="{$base_url}product.xls">Tải mẫu</a>
            </div>
          </div>
          <div class="form-group">
            <label>
              <input type="checkbox" name="thaythe" value="1">Thay thế
            </label>
          </div>
          <div class="form-group">
            <button type="submit" name="import" class="btn btn-success btn-sm btn-block">Thêm</button>
          </div>
          <!-- /input-group -->
        </div>
        <!-- /.card-body -->
        
      </form>
    </div>
    <!-- card-info-->
    {/if}
  </div>
  <!-- col-md-3-->
  <div class="col-md-9">
    <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title">
            Danh sách sản phẩm {if $parent_id neq "0"}{$parent_id}{/if}
        </h3>
      </div>
      <div class="card-body">
      <div class="table-responsive">
        <table class="table table-hover table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr style="font-weight: bold;" align="center">
              <td width="2%">STT</td>
              <td width="15%">Mã</td>
              <td width="30%">Sản phẩm</td>
              <td>KL min</td>
              <td>KL max</td>
              <td>Khách hàng</td>
              <td width="15%">Chức năng</td>
            </tr>
          </thead>
          {$i=1}
          {foreach $product as $pr}
            <tr align="center">
              <td>{$i++}</td>
              <td>{$pr->product_id}</td>
              {if $pr->parent_id eq "0"}
              <td><a href="{$base_url}product/view/{$pr->product_id}">{$pr->product_name}</a></td>
              {else}
              <td>{$pr->product_name} {if $pr->hidden eq 1}(Ẩn){/if}</td>
              
              {/if}
              <td>{$pr->weight_min}</td>
              <td>{$pr->weight_max}</td>
              <td>{$pr->note} {if $pr->linkable eq 1}Được liên kết{/if}</td>
              <td>
                {if $pr->parent_id neq "0"}
                <a href="{$base_url}product/card/{$pr->product_id}">
                    <i class="fas fa-credit-card">
                    </i>
                </a>
                {/if}
                <a style="color: #17a2b8" href="#" data-toggle="modal" data-target="#update{$pr->product_id}" style="cursor: pointer;" alt="Điều chỉnh">
                    <i class="fas fa-pencil-alt">
                    </i>
                </a>
                {if $pr->has_child eq ""}
                <a style="color: #da251d" href="{$base_url}product/delete/{$pr->product_id}/{$pr->parent_id}" 
                onclick="return confirm('Bạn có chắc chắn xóa không?');">
                    <i class="fas fa-trash">
                    </i>
                </a>
                {/if}
              </td>
            </tr>
          {/foreach}
        </table>
      </div>
      </div>
      <!-- /.card-body -->
      <div class="card-footer">
          
      </div>
        <!-- /.card-footer -->
    </div>

  </div>
  <!-- col-md-8-->
</div>
{foreach $product as $pr}
<div class="modal fade" id="update{$pr->product_id}">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Điều chỉnh</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="form-horizontal" method="post" name="updateproduct" action="{$base_url}product/update">
        <input type="hidden" name="parent_id" value="{$parent_id}">
        <input type="hidden" name="old_product_id" value="{$pr->product_id}">
        <div class="modal-body">
          <div class="form-group row">
            <label for="new_product_id" class="col-sm-4 col-form-label">Mã:</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" placeholder="Mã sản phẩm" id="new_product_id" name="new_product_id" required maxlength="20" value="{$pr->product_id}" {literal}pattern="[A-Za-z0-9+-_]{3,}"{/literal}>
            </div>
          </div>
          <div class="form-group row">
            <label for="product_name" class="col-sm-4 col-form-label">Tên:</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" placeholder="Tên sản phẩm" id="product_name" name="product_name" required value="{$pr->product_name}">
            </div>
          </div>
          <div class="form-group row">
            <label for="product_name" class="col-sm-4 col-form-label">KL min:</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" placeholder="KL min" id="weight_min" name="weight_min" required value="{$pr->weight_min}">
            </div>
          </div> <div class="form-group row">
            <label for="product_name" class="col-sm-4 col-form-label">KL max:</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" placeholder="KL max" id="weight_max" name="weight_max" required value="{$pr->weight_max}">
            </div>
          </div>
          <div class="form-group row">
            <label for="note" class="col-sm-4 col-form-label">Ghi chú:</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" placeholder="Ghi chú" name="note" id="note" value="{$pr->note}">
            </div>
          </div>
          <div class="form-group row">
            <label for="linkable" class="col-sm-4 col-form-label">Liên kết:</label>
            <div class="col-sm-8">
              <select class="form-control select2" style="width: 100%;" id="linkable" name="linkable">
                <option value="0" selected="selected" {if $pr->linkable eq 0}selected{/if}>Không</option>
                <option value="1" {if $pr->linkable eq 1}selected{/if}>Có</option>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label for="linkable" class="col-sm-4 col-form-label">Ẩn</label>
            <div class="col-sm-8">
              <select class="form-control select2" style="width: 100%;" id="hidden" name="hidden">
                <option value="0" selected="selected" {if $pr->hidden eq 0}selected{/if}>Không</option>
                <option value="1" {if $pr->hidden eq 1}selected{/if}>Có</option>
              </select>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
          <button type="submit" class="btn btn-primary" id="capnhat">Cập nhật</button>
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
{/foreach}
<script>
  $( document ).ready(function() {
    $("#product_id" ).focus();
    $("#dataTable").DataTable({
        stateSave: true
    });
  });
  $(function () {
    $('.select2').select2()
  })
</script>