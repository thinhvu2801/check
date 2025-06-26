<div class="row">
  <div class="col-md-3">
    <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title">Thêm thủ công</h3>
      </div>
      <form action="{$base_url}customer/insert" method="post">
        <div class="card-body">
          {if $mes neq ""}
          <p class="mb-0" style="color: red;">{$mes}</p>
          {/if}
          <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Mã khách hàng" id="customer_id" name="customer_id"required maxlength="20" {literal}pattern="[A-Za-z0-9-_]{3,}"{/literal}>
          </div>
          <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Tên khách hàng" name="customer_name">
          </div>
          <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Ghi chú" name="note">
          </div>
          <div class="input-group mb-3">
            <button type="submit" class="btn btn-success btn-sm btn-block">Thêm</button>
          </div>
          <!-- /input-group -->
        </div>
        <!-- /.card-body -->
        
      </form>
    </div>
  </div>
  <!-- col-md-3-->
  <div class="col-md-9">
    <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title">
            Danh sách khách hàng
        </h3>
      </div>
      <div class="card-body">
      <div class="table-responsive">
        <table class="table table-hover table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr style="font-weight: bold;" align="center">
              <td width="2%">STT</td>
              <td width="15%">Mã</td>
              <td>khách hàng</td>
              <td width="30%">Ghi chú</td>
              <td width="15%">Chức năng</td>
            </tr>
          </thead>
          {$i=1}
          {foreach $customer as $pr}
            <tr align="center">
              <td>{$i++}</td>
              <td>{$pr->customer_id}</td>
              <td>{$pr->customer_name}</td>
              <td>{$pr->note}</td>
              <td>
                <a href="{$base_url}customer/card/{$pr->customer_id}">
                    <i class="fas fa-credit-card">
                    </i>
                </a>
                <a style="color: #17a2b8" href="#" data-toggle="modal" data-target="#update{$pr->customer_id}" style="cursor: pointer;" alt="Điều chỉnh">
                    <i class="fas fa-pencil-alt">
                    </i>
                </a>
                <a style="color: #da251d" href="{$base_url}customer/delete/{$pr->customer_id}" onclick="return confirm('Bạn có chắc chắn xóa không?');">
                    <i class="fas fa-trash">
                    </i>
                </a>
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
{foreach $customer as $pr}
<div class="modal fade" id="update{$pr->customer_id}">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Điều chỉnh</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="form-horizontal" method="post" name="updatecustomer" action="{$base_url}customer/update">
        <input type="hidden" name="old_customer_id" value="{$pr->customer_id}">
        <div class="modal-body">
          <div class="form-group row">
            <label for="new_customer_id" class="col-sm-2 col-form-label">Mã:</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" placeholder="Mã khách hàng" id="new_customer_id" name="new_customer_id" required maxlength="20" value="{$pr->customer_id}" {literal}pattern="[A-Za-z0-9+-_]{3,}"{/literal}>
            </div>
          </div>
          <div class="form-group row">
            <label for="customer_name" class="col-sm-2 col-form-label">Tên:</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" placeholder="Tên khách hàng" id="customer_name" name="customer_name" required value="{$pr->customer_name}">
            </div>
          </div>
          <div class="form-group row">
            <label for="note" class="col-sm-2 col-form-label">Ghi chú:</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" placeholder="Ghi chú" name="note" id="note" value="{$pr->note}">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Đóng</button>
          <button type="submit" class="btn btn-primary btn-sm" id="capnhat">Cập nhật</button>
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
    $("#customer_id" ).focus();
    $("#dataTable").DataTable({
        stateSave: true
    });
  });
</script>