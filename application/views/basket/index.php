<div class="row">
  <div class="col-md-3">
    <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title">Thêm thủ công</h3>
      </div>
      <form action="{$base_url}basket/insert" method="post">
        <div class="card-body">
          {if $mes neq ""}
          <p class="mb-0" style="color: red;">{$mes}</p>
          {/if}
          <div class="input-group mb-3">
            <input type="text" class="form-control" id="basket_id" name="basket_id" required maxlength="20" placeholder="Mã rổ" {literal}pattern="[A-Za-z0-9-_]{3,}"{/literal}>
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
    <!-- card-info-->
    <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title">Thêm từ Excel</h3>
      </div>
      <form action="{$base_url}basket/import" method="post" enctype="multipart/form-data">
        <div class="card-body">
          <div class="form-group">
            <div class="input-group">
              <input type="file" class="form-control" id="file_xls" name="file_xls" placeholder="Chọn file excel chứa dữ liệu" accept=".xls" required>
            </div>
            <div class="input-group">
              <a href="{$base_url}basket.xls">Tải mẫu</a>
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
                    <td width="15%">Mã rổ</td>
                    <td>Ghi chú</td>
                    <td width="15%">Chức năng</td>
                  </tr>
                </thead>
              {$i=1}
              {foreach $basket as $bk}
                <tr align="center">
                  <td>{$i++}</td>
                  <td>{$bk->basket_id}</td>
                  <td>{$bk->note}</td>
                  <td>
                    <a href="{$base_url}basket/card/{$bk->basket_id}">
                      <i class="fas fa-credit-card">
                      </i>
                    </a>
                   
                    <!-- <a style="color: #17a2b8" href="#" data-toggle="modal" data-target="#update{$bk->basket_id}" style="cursor: pointer;" alt="Điều chỉnh">
                        <i class="fas fa-pencil-alt">
                        </i>
                    </a> -->
                    <a style="color: #da251d" href="{$base_url}basket/delete/{$bk->basket_id}" onclick="return confirm('Bạn có chắc chắn xóa không?');">
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

<script>
  $(document).ready(function() {
    $("#basket_id").focus();
    // $('#dataTable').DataTable({
    //     stateSave: true
    // });
  });
</script>