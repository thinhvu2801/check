<div class="row">
  <div class="col-md-3">
  
    <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title">Thêm thủ công</h3>
      </div>
      <form action="{$base_url}worker/insert_nghi" method="post">
        <!-- <input type="hidden" name="group_id" value="{$worker->group_id}"> -->
        
        <div class="card-body">
          {if $mes neq ""}
          <p class="mb-0" style="color: red;">{$mes}</p>
          {/if}
          <div class="input-group mb-3">
            <input type="text" class="form-control" id="worker_id" name="worker_id" placeholder="Mã công nhân" maxlength="20" {literal}pattern="[A-Za-z0-9-_]{3,}" {/literal}>
          </div>
          <!-- <div class="input-group mb-3">
            <input type="text" class="form-control" id="factory_id" name="factory_id" required maxlength="20" placeholder="Mã công nhân" {literal}pattern="[A-Za-z0-9-_]{3,}" {/literal}>
          </div> -->

          <div class="input-group mb-3">
            <input type="text" class="form-control" id="worker_name" name="worker_name" placeholder="Họ và tên" maxlength="50" required>
          </div>
          <div class="form-group">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text">Nhóm:</span>
              </div>
              <select class="form-control" name="group_id" id="group_id">
                <option value="">Không</option>
                  {foreach $groups as $g}
                    {assign var='selected' value=''}
                    {if isset($worker) && $worker->group_id == $g->group_id}
                        {assign var='selected' value='selected'}
                    {/if}
                    <option value="{$g->group_id}" {$selected}>{$g->group_name}</option>
                  {/foreach}
              </select>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Ghi chú" name="note">
          </div>

          <div class="input-group mb-3">
            <button type="submit" class="btn btn-success btn-sm btn-block">Thêm</button>
          </div>
         
        </div>
        

      </form>
    </div>
   
    <!-- card-info-->
    <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title">Thêm từ Excel</h3>
      </div>
      <form action="{$base_url}worker/import_nghi" method="post" enctype="multipart/form-data">
        <!-- <input type="hidden" name="group_id" value="{$group->group_id}"> -->
        <div class="card-body">
          <div class="form-group">
            <div class="input-group">
              <input type="file" class="form-control" id="file_xls" name="file_xls" placeholder="Chọn file excel chứa dữ liệu" accept=".xls" required>
            </div>
            <div class="input-group">
              <a href="{$base_url}worker_nghi.xls">Tải mẫu</a>
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
        </div>
        

      </form>
    </div>
    <!-- card-info-->
  </div>
  <!-- ./col-md-3-->
  <div class="col-md-9">
    <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title">
          Danh sách công nhân nghỉ
        </h3>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-hover table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr style="font-weight: bold;" align="center">
                <td width="3%">STT</td>
                <td width="15%">Mã công nhân</td>
                <td width="15%">Mã thẻ</td>
                <td>Họ và tên</td>
                <td>Công đoạn</td>
                <td width="10%">Ghi chú</td>
                <td width="5%">Chức năng</td>
                <td width="5%">Làm lại</td>
              </tr>
            </thead>
            {$i=1}
            <tbody>
              {foreach $worker as $wk}
              {if $wk->status eq 0}
              <tr align="center">
                <td>{$i++}</td>
                <td>{$wk->worker_id}</td>
                <td>{$wk->factory_id}</td>
                <td align="left">{$wk->worker_name}</td>
                <td>{$wk->congdoan_id}</td>
                <td>{$wk->note}</td>
                <td>
                <!-- <a style="color: #17a2b8" href="#" data-toggle="modal" data-target="#update{$wk->worker_id}" style="cursor: pointer;" alt="Điều chỉnh">
                    <i class="fas fa-pencil-alt">
                    </i>
                  </a> -->
                  <a style="color: #da251d" href="{$base_url}worker/delete_nghi/{$wk->worker_id}/{$wk->group_id}" onclick="return confirm('Bạn có chắc chắn xóa không?');">
                    <i class="fas fa-trash">
                    </i>
                  </a>
                </td>
                <td>
                <a href="{$base_url}worker/update_cn_nghi/{$wk->worker_id}/{$wk->status}">
                    {if $wk->status eq 0}
                    Làm lại
                    {/if}
                    </a>
                </td>
              </tr>
              {/if}
              {/foreach}
            </tbody>
          </table>
        </div>
      </div>
      <!-- /.card-body -->
      <div class="card-footer">

      </div>
      <!-- /.card-footer -->
    </div>
  </div><!-- ./col-md-3-->
</div>
<!-- {foreach $worker as $wk}
<div class="modal fade" id="update{$wk->worker_id}">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Điều chỉnh</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="form-horizontal" method="post" name="updateproduct" action="{$base_url}worker/update_nghi">
        <input type="hidden" name="old_worker_id" value="{$wk->worker_id}">
        <div class="modal-body">
          <div class="form-group row">
            <label for="NEW_worker_id" class="col-sm-2 col-form-label">Mã công nhân:</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" placeholder="Mã công nhân" id="NEW_worker_id" name="new_worker_id" required maxlength="20" value="{$wk->worker_id}" {literal}pattern="[A-Za-z0-9+-_]{3,}" {/literal}>
            </div>
          </div>
          <div class="form-group row">
            <label for="factory_id" class="col-sm-2 col-form-label">Mã thẻ:</label>
            <div class="col-sm-10">
              <select class="form-control group_product" style="width: 100%;" name="factory_id" id="factory_id">
                  <option value="">Không</option>
                  {foreach $factory as $f}
                      {if !in_array($f->id, array_column($worker, 'factory_id')) && $f->id != $wk->factory_id}
                          <option value="{$f->id}">{$f->id}</option>
                      {/if}
                  {/foreach}
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label for="worker_name" class="col-sm-2 col-form-label">Tên:</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" placeholder="Tên công nhân" id="worker_name" name="worker_name" placeholder="công nhân" required value="{$wk->worker_name}">
            </div>
          </div>
          <div class="form-group row">
            <label for="note" class="col-sm-2 col-form-label">Ghi chú:</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" placeholder="Ghi chú" name="note" id="note" value="{$wk->note}">
            </div>
          </div>

          <div class="form-group row">
            <label for="parent_id" class="col-sm-2 col-form-label">Nhóm:</label>
            <div class="col-sm-10">
              <select class="form-control group_product" style="width: 100%;" name="group_id" id="group_id">
                {foreach $groups as $g}
                {assign var='selected' value=''}
                {if isset($worker) && $worker->group_id == $g->group_id}
                    {assign var='selected' value='selected'}
                {/if}
                <option value="{$g->group_id}" {$selected}>{$g->group_name}</option>
            {/foreach}
              </select>
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
    $("#worker_id").focus();
    $('#dataTable').DataTable({
      stateSave: true
    });
  });
</script>