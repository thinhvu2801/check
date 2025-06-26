<div class="row">
  <div class="col-md-3">
    <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title">Thêm thủ công</h3>
      </div>
      <form action="{$base_url}khothe/insert" method="post">
        <div class="card-body">
          {if $mes neq ""}
          <p class="mb-0" style="color: red;">{$mes}</p>
          {/if}
          <div class="input-group mb-3">
            <input type="text" class="form-control" id="id" name="id" required maxlength="20" placeholder="Mã" {literal}pattern="[A-Za-z0-9-_]{3,}"{/literal}>
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
      <form action="{$base_url}khothe/import" method="post" enctype="multipart/form-data">
        <div class="card-body">
          <div class="form-group">
            <div class="input-group">
              <input type="file" class="form-control" id="file_xls" name="file_xls" placeholder="Chọn file excel chứa dữ liệu" accept=".xls" required>
            </div>
            <div class="input-group">
              <a href="{$base_url}khothe.xls">Tải mẫu</a>
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
        <h3 class="card-title">Danh sách mã cân</h3>
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
                    <td >Mã thẻ</td>
                    <!-- <td>Loại</td>
                    <td>Thứ tự</td>
                    <td>Ghi chú</td> -->
                    <td width="15%">Chức năng</td>
                  </tr>
                </thead>
              {$i=1}
              {foreach $khothe as $sc}
                <tr align="center">
                  <td>{$i++}</td>
                  <td>{$sc->id}</td>
                  <!-- <td>{$sc->type}</td>
                  <td>{$sc->order_by}</td>
                  <td>{$sc->note}</td> -->
                  <td>
                    <a href="{$base_url}khothe/card/{$sc->id}">
                      <i class="fas fa-credit-card">
                      </i>
                    </a>
                    <!-- <a style="color: #17a2b8" href="#" data-toggle="modal" data-target="#update{$sc->id}" style="cursor: pointer;" alt="Điều chỉnh">
                        <i class="fas fa-pencil-alt">
                        </i>
                    </a> -->
                    <a style="color: #da251d" href="{$base_url}khothe/delete/{$sc->id}" onclick="return confirm('Bạn có chắc chắn xóa không?');">
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
<!-- {foreach $khothe as $sc}
<div class="modal fade" id="update{$sc->id}">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Điều chỉnh</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="form-horizontal" method="post" name="updatekhothe" action="{$base_url}khothe/update">
        <input type="hidden" name="old_id" value="{$sc->id}">
        <div class="modal-body">
          <div class="form-group row">
            <label for="new_id" class="col-sm-2 col-form-label">Mã:</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="new_id" name="new_id" required maxlength="20" value="{$sc->id}" {literal}pattern="[A-Za-z0-9+-_]{2,}"{/literal}>
            </div>
          </div>
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Đóng</button>
          <button type="submit" class="btn btn-primary btn-sm" id="capnhat">Cập nhật</button>
        </div>
      </form>
    </div>
  </div>
</div>
{/foreach} -->
<script>
  $(document).ready(function() {
    $("#id").focus();
    $('#dataTable').DataTable({
        stateSave: true
    });
  });
</script>