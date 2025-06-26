<?php /* Smarty version Smarty-3.1.16, created on 2024-02-27 05:27:25
         compiled from "D:\xampp\htdocs\htdocsbentre\application\views\role\index.php" */ ?>
<?php /*%%SmartyHeaderCode:31226649965dd64ad9ace27-93102495%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c181ada6ba6977ab283925ad5fa60760fa9e650c' => 
    array (
      0 => 'D:\\xampp\\htdocs\\htdocsbentre\\application\\views\\role\\index.php',
      1 => 1678850150,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '31226649965dd64ad9ace27-93102495',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'base_url' => 0,
    'mes' => 0,
    'role' => 0,
    'i' => 0,
    'bk' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_65dd64adb7f625_60120197',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_65dd64adb7f625_60120197')) {function content_65dd64adb7f625_60120197($_smarty_tpl) {?><div class="row">
  <div class="col-md-3">
    <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title">Thêm thủ công</h3>
      </div>
      <form action="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
role/insert" method="post">
        <div class="card-body">
          <?php if ($_smarty_tpl->tpl_vars['mes']->value!='') {?>
          <p class="mb-0" style="color: red;"><?php echo $_smarty_tpl->tpl_vars['mes']->value;?>
</p>
          <?php }?>
          <div class="input-group mb-3">
            <input type="text" class="form-control" id="role_id" name="role_id" required maxlength="30" placeholder="Mã quyền" pattern="[A-Za-z0-9-_]{3,}">
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
      <form action="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
role/import" method="post" enctype="multipart/form-data">
        <div class="card-body">
          <div class="form-group">
            <div class="input-group">
              <input type="file" class="form-control" id="file_xls" name="file_xls" placeholder="Chọn file excel chứa dữ liệu" accept=".xls" required>
            </div>
            <div class="input-group">
              <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
role.xls">Tải mẫu</a>
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
              <?php $_smarty_tpl->tpl_vars['i'] = new Smarty_variable(1, null, 0);?>
              <?php  $_smarty_tpl->tpl_vars['bk'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['bk']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['role']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['bk']->key => $_smarty_tpl->tpl_vars['bk']->value) {
$_smarty_tpl->tpl_vars['bk']->_loop = true;
?>
                <tr align="left">
                  <td><?php echo $_smarty_tpl->tpl_vars['i']->value++;?>
</td>
                  <td><?php echo $_smarty_tpl->tpl_vars['bk']->value->role_id;?>
</td>
                  <td><?php echo $_smarty_tpl->tpl_vars['bk']->value->role_name;?>
</td>
                  <td align="center"><?php echo $_smarty_tpl->tpl_vars['bk']->value->orderby;?>
</td>
                  <td align="center"><?php echo $_smarty_tpl->tpl_vars['bk']->value->active;?>
</td>
                  <td>
                    <a style="color: #17a2b8" href="#" data-toggle="modal" data-target="#update<?php echo $_smarty_tpl->tpl_vars['bk']->value->role_id;?>
" style="cursor: pointer;" alt="Điều chỉnh">
                        <i class="fas fa-pencil-alt">
                        </i>
                    </a>
                    <a style="color: #da251d" href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
role/delete/<?php echo $_smarty_tpl->tpl_vars['bk']->value->role_id;?>
" onclick="return confirm('Bạn có chắc chắn xóa không?');">
                        <i class="fas fa-trash">
                        </i>
                    </a>
                  </td>
                </tr>
              <?php } ?>
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
<?php  $_smarty_tpl->tpl_vars['bk'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['bk']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['role']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['bk']->key => $_smarty_tpl->tpl_vars['bk']->value) {
$_smarty_tpl->tpl_vars['bk']->_loop = true;
?>
<div class="modal fade" id="update<?php echo $_smarty_tpl->tpl_vars['bk']->value->role_id;?>
">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Điều chỉnh</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="form-horizontal" method="post" name="updaterole" action="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
role/update">
        <input type="hidden" name="old_role_id" value="<?php echo $_smarty_tpl->tpl_vars['bk']->value->role_id;?>
">
        <div class="modal-body">
          <div class="form-group row">
            <label for="new_role_id" class="col-sm-2 col-form-label">Mã:</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="new_role_id" name="new_role_id" required maxlength="20" value="<?php echo $_smarty_tpl->tpl_vars['bk']->value->role_id;?>
" pattern="[A-Za-z0-9+-_]{2,}">
            </div>
          </div>
          
          <div class="form-group row">
            <label for="note" class="col-sm-2 col-form-label">Tên quyền:</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" placeholder="Tên quyền" name="role_name" id="role_name" value="<?php echo $_smarty_tpl->tpl_vars['bk']->value->role_name;?>
">
            </div>
          </div>

          <div class="form-group row">
            <label for="note" class="col-sm-2 col-form-label">Thứ tự:</label>
            <div class="col-sm-10">
              <input type="number" class="form-control"  name="orderby" id="orderby" value="<?php echo $_smarty_tpl->tpl_vars['bk']->value->orderby;?>
">
            </div>
          </div>
          <div class="form-group row">
            <label for="note" class="col-sm-2 col-form-label">Kích hoạt:</label>
            <div class="col-sm-10">
              <input type="number" class="form-control"  name="active" id="active" value="<?php echo $_smarty_tpl->tpl_vars['bk']->value->active;?>
">
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
<?php } ?>
<script>
  $(document).ready(function() {
    $("#role_id").focus();
    $('#dataTable').DataTable({
        "stateSave": true,
        "pageLength": 50
    });
  });
</script><?php }} ?>
