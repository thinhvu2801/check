<div class="row">
  <div class="col-md-3">
    <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title">Thêm thủ công</h3>
      </div>
      <form action="{$base_url}role/insert" method="post">
        <div class="card-body">
          {if $mes neq ""}
          <p class="mb-0" style="color: red;">{$mes}</p>
          {/if}
          <div class="input-group mb-3">
            <input type="text" class="form-control" id="role_id" name="role_id" required maxlength="30" placeholder="Mã quyền" {literal}pattern="[A-Za-z0-9-_]{3,}"{/literal}>
          </div>
          
          <div class="input-group mb-3">
            <input type="text" class="form-control" id="role_name" name="role_name" required maxlength="50" placeholder="Tên quyền">
          </div>

          <div class="input-group mb-3">
            <input type="number" class="form-control" id="orderby" name="orderby" required value="1">
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
    <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title">Thêm từ Excel</h3>
      </div>
      <form action="{$base_url}role/import" method="post" enctype="multipart/form-data">
        <div class="card-body">
          <div class="form-group">
            <div class="input-group">
              <input type="file" class="form-control" id="file_xls" name="file_xls" placeholder="Chọn file excel chứa dữ liệu" accept=".xls" required>
            </div>
            <div class="input-group">
              <a href="{$base_url}role.xls">Tải mẫu</a>
            </div>
            
          </div>
          <!-- /input-group -->
          <div class="form-group">
            <label>
              <input type="checkbox" name="thaythe" value="1">Thay thế
            </label>
          </div>
          <div class="form-group">
             <button type="submit" class="btn btn-success btn-sm btn-block" name="import">Thêm</button>
            </div>
        </div>
        <!-- /.card-body -->
       
      </form>
    </div>
    <!-- card-info-->
  </div><!-- ./col-md-3-->
  <div class="col-md-9">
    <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title">Danh sách rổ</h3>
      </div>
        <div class="card-body">
          <div class="table-responsive">
          <table class="table table-hover table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                  <tr style="font-weight: bold;" align="center">
                    <td width="3%">STT</td>
                    <!-- <td width="3%">
                      <input type="checkbox" name="checkall" id="checkall">
                    </td> -->
                    <td width="15%">Mã quyền</td>
                    <td>Tên quyền</td>
                    <td>Thứ tự</td>
                    <td>Kích hoạt</td>
                    <td width="15%">Chức năng</td>
                  </tr>
                </thead>
              {$i=1}
              {foreach $role as $bk}
                <tr align="left">
                  <td>{$i++}</td>
                  <td>{$bk->role_id}</td>
                  <td>{$bk->role_name}</td>
                  <td align="center">{$bk->orderby}</td>
                  <td align="center">{$bk->active}</td>
                  <td>
                    <a style="color: #17a2b8" href="#" data-toggle="modal" data-target="#update{$bk->role_id}" style="cursor: pointer;" alt="Điều chỉnh">
                        <i class="fas fa-pencil-alt">
                        </i>
                    </a>
                    <a style="color: #da251d" href="{$base_url}role/delete/{$bk->role_id}" onclick="return confirm('Bạn có chắc chắn xóa không?');">
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
    <!-- card-info-->
  </div><!-- ./col-md-9-->
</div>
{foreach $role as $bk}
<div class="modal fade" id="update{$bk->role_id}">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Điều chỉnh</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="form-horizontal" method="post" name="updaterole" action="{$base_url}role/update">
        <input type="hidden" name="old_role_id" value="{$bk->role_id}">
        <div class="modal-body">
          <div class="form-group row">
            <label for="new_role_id" class="col-sm-2 col-form-label">Mã:</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="new_role_id" name="new_role_id" required maxlength="20" value="{$bk->role_id}" {literal}pattern="[A-Za-z0-9+-_]{2,}"{/literal}>
            </div>
          </div>
          
          <div class="form-group row">
            <label for="note" class="col-sm-2 col-form-label">Tên quyền:</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" placeholder="Tên quyền" name="role_name" id="role_name" value="{$bk->role_name}">
            </div>
          </div>

          <div class="form-group row">
            <label for="note" class="col-sm-2 col-form-label">Thứ tự:</label>
            <div class="col-sm-10">
              <input type="number" class="form-control"  name="orderby" id="orderby" value="{$bk->orderby}">
            </div>
          </div>
          <div class="form-group row">
            <label for="note" class="col-sm-2 col-form-label">Kích hoạt:</label>
            <div class="col-sm-10">
              <input type="number" class="form-control"  name="active" id="active" value="{$bk->active}">
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
  $(document).ready(function() {
    $("#role_id").focus();
    $('#dataTable').DataTable({
        "stateSave": true,
        "pageLength": 50
    });
  });
</script>