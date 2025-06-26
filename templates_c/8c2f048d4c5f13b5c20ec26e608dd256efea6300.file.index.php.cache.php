<?php /* Smarty version Smarty-3.1.16, created on 2024-02-01 06:02:16
         compiled from "D:\xampp\htdocs\htdocsbentre\application\views\size\index.php" */ ?>
<?php /*%%SmartyHeaderCode:45000164765bb25d85364a0-02708850%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8c2f048d4c5f13b5c20ec26e608dd256efea6300' => 
    array (
      0 => 'D:\\xampp\\htdocs\\htdocsbentre\\application\\views\\size\\index.php',
      1 => 1706416980,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '45000164765bb25d85364a0-02708850',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'base_url' => 0,
    'mes' => 0,
    'size' => 0,
    'i' => 0,
    'pr' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_65bb25d8592fc7_25280165',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_65bb25d8592fc7_25280165')) {function content_65bb25d8592fc7_25280165($_smarty_tpl) {?><div class="row">
  <div class="col-md-3">
    <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title">Thêm thủ công</h3>
      </div>
      <form action="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
size" method="post">
        <div class="card-body">
          <?php if ($_smarty_tpl->tpl_vars['mes']->value!='') {?>
          <p class="mb-0" style="color: red;"><?php echo $_smarty_tpl->tpl_vars['mes']->value;?>
</p>
          <?php }?>
          <div class="form-group">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text">Mã size</span>
              </div>
              <input type="text" class="form-control" placeholder="Mã size" id="size_id" name="size_id" required maxlength="20" pattern="[A-Za-z0-9-_]{2,}" >
            </div>
          </div>
          <div class="form-group">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text">Tên size</span>
              </div>
              <input type="text" class="form-control" placeholder="Tên size" name="size_name">
            </div>
          </div>
          <div class="form-group">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text">Thứ tự</span>
              </div>
              <input type="number" class="form-control" name="order_by" value="1">
            </div>
          </div>
          
          <div class="input-group mb-3">
            <button type="submit" class="btn btn-success btn-sm btn-block">Thêm</button>
          </div>
          <!-- /input-group -->
        </div>
        <!-- /.card-body -->

      </form>
    </div>
    <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title">Thêm từ Excel</h3>
      </div>
      <form action="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
size/import" method="post" enctype="multipart/form-data">
        <div class="card-body">
          <div class="form-group">
            <div class="input-group">
              <input type="file" class="form-control" id="file_xls" name="file_xls" placeholder="Chọn file excel chứa dữ liệu" accept=".xls" required>
            </div>
            <div class="input-group">
              <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
size.xls">Tải mẫu</a>
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
  </div>
  <!-- col-md-3-->
  <div class="col-md-9">
    <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title">
          Danh sách size
        </h3>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-hover table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr style="font-weight: bold;" align="center">
                <td width="2%">STT</td>
                <td width="15%">Mã</td>
                <td>Size</td>
                <td width="30%">Sắp xếp</td>
                <td width="15%">Chức năng</td>
              </tr>
            </thead>
            <?php $_smarty_tpl->tpl_vars['i'] = new Smarty_variable(1, null, 0);?>
            <?php  $_smarty_tpl->tpl_vars['pr'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['pr']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['size']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['pr']->key => $_smarty_tpl->tpl_vars['pr']->value) {
$_smarty_tpl->tpl_vars['pr']->_loop = true;
?>
            <tr align="center">
              <td><?php echo $_smarty_tpl->tpl_vars['i']->value++;?>
</td>
              <td><?php echo $_smarty_tpl->tpl_vars['pr']->value->size_id;?>
</td>
              <td><?php echo $_smarty_tpl->tpl_vars['pr']->value->size_name;?>
</td>
              <td><?php echo $_smarty_tpl->tpl_vars['pr']->value->order_by;?>
</td>
              <td>
                <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
size/card/<?php echo $_smarty_tpl->tpl_vars['pr']->value->size_id;?>
">
                  <i class="fas fa-credit-card">
                  </i>
                </a>
                <a style="color: #17a2b8" href="#" data-toggle="modal" data-target="#update<?php echo $_smarty_tpl->tpl_vars['pr']->value->size_id;?>
" style="cursor: pointer;" alt="Điều chỉnh">
                  <i class="fas fa-pencil-alt">
                  </i>
                </a>
                <a style="color: #da251d" href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
size/delete/<?php echo $_smarty_tpl->tpl_vars['pr']->value->size_id;?>
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
          <form action="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
size/dongbo" method="post">
            <div class="form-group">
                <button type="submit" name="import" class="btn btn-success btn-sm btn-block">Đồng bộ</button>
            </div>
          </form>
      </div>
      <!-- /.card-footer -->
    </div>

  </div>
  <!-- col-md-8-->
</div>
<?php  $_smarty_tpl->tpl_vars['pr'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['pr']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['size']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['pr']->key => $_smarty_tpl->tpl_vars['pr']->value) {
$_smarty_tpl->tpl_vars['pr']->_loop = true;
?>
<div class="modal fade" id="update<?php echo $_smarty_tpl->tpl_vars['pr']->value->size_id;?>
">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Điều chỉnh</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="form-horizontal" method="post" name="updatesize" action="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
size/update">
        <input type="hidden" name="old_size_id" value="<?php echo $_smarty_tpl->tpl_vars['pr']->value->size_id;?>
">
        <div class="modal-body">
          <div class="form-group row">
            <label for="new_size_id" class="col-sm-2 col-form-label">Mã:</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" placeholder="Mã size" id="new_size_id" name="new_size_id" required maxlength="20" value="<?php echo $_smarty_tpl->tpl_vars['pr']->value->size_id;?>
" pattern="[A-Za-z0-9+-_]{2,}" >
            </div>
          </div>
          <div class="form-group row">
            <label for="size_name" class="col-sm-2 col-form-label">Tên:</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" placeholder="Tên size" id="size_name" name="size_name" required value="<?php echo $_smarty_tpl->tpl_vars['pr']->value->size_name;?>
">
            </div>
          </div>
          <div class="form-group row">
            <label for="note" class="col-sm-2 col-form-label">Thứ tự</label>
            <div class="col-sm-10">
              <input type="number" class="form-control" name="order_by" id="order_by" value="<?php echo $_smarty_tpl->tpl_vars['pr']->value->order_by;?>
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
    $("#size_id").focus();
    $("#dataTable").DataTable({
      stateSave: true
    });
  });
</script><?php }} ?>
