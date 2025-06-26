<div class="row">
  <div class="col-md-3">
    <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title">Thêm thủ công</h3>
      </div>
      <form action="{$base_url}gradersize/insert" method="post">
        <div class="card-body">
          {if $mes neq ""}
          <p class="mb-0" style="color: red;">{$mes}</p>
          {/if}
          <div class="form-group">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text">Tên size</span>
              </div>
              <input type="text" class="form-control" id="size_name" name="size_name" required maxlength="20" placeholder="Tên size" {literal}pattern="[A-Za-z0-9-_]{3,}" {/literal}>
            </div>
            <!-- /.input group -->
          </div>
          <div class="form-group">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text">Min</span>
              </div>
              <input type="number" class="form-control" name="min" value="0">
            </div>
            <!-- /.input group -->
          </div>
         
          <div class="form-group">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text">Max</span>
              </div>
              <input type="number" class="form-control" name="max" value="0">
            </div>
            <!-- /.input group -->
          </div>
          <div class="input-group mb-3">
            <button type="submit" class="btn btn-success btn-sm btn-block">Thêm</button>
          </div>
          <!-- /input-group -->
        </div>
        <!-- /.card-body -->
      </form>
    </div>

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
                <td width="15%">Tên size</td>
                <td>Min</td>
                <td>Max</td>
                <td width="15%">Chức năng</td>
              </tr>
            </thead>
            {$i=1}
            {foreach $gradersize as $bk}
            <tr align="center">
              <td>{$i++}</td>
              <td>{$bk->size_name}</td>
              <td>{$bk->min}</td>
              <td>{$bk->max}</td>
              <td>
                <a style="color: #17a2b8" href="#" data-toggle="modal" data-target="#update{$bk->size_name}" style="cursor: pointer;" alt="Điều chỉnh">
                  <i class="fas fa-pencil-alt">
                  </i>
                </a>
                <a style="color: #da251d" href="{$base_url}gradersize/delete/{$bk->size_name}" onclick="return confirm('Bạn có chắc chắn xóa không?');">
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
{foreach $gradersize as $bk}
<div class="modal fade" id="update{$bk->size_name}">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Điều chỉnh</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="form-horizontal" method="post" name="updategradersize" action="{$base_url}gradersize/update">
        <input type="hidden" name="old_size_name" value="{$bk->size_name}">
        <div class="modal-body">
          <div class="form-group row">
            <label for="new_size_name" class="col-sm-2 col-form-label">Tên size:</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="new_size_name" name="new_size_name" required maxlength="20" value="{$bk->size_name}" {literal}pattern="[A-Za-z0-9+-_]{2,}" {/literal}>
            </div>
          </div>
          <div class="form-group row">
            <label for="note" class="col-sm-2 col-form-label">Min</label>
            <div class="col-sm-10">
              <input type="number" class="form-control" name="min" id="min" value="{$bk->min}">
            </div>
          </div>
          <div class="form-group row">
            <label for="note" class="col-sm-2 col-form-label">Max</label>
            <div class="col-sm-10">
              <input type="number" class="form-control" name="max" id="max" value="{$bk->max}">
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
    $("#size_name").focus();
    $('#dataTable').DataTable({
      stateSave: true
    });
  });
</script>