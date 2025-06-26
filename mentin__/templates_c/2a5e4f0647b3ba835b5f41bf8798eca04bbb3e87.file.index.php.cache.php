<?php /* Smarty version Smarty-3.1.16, created on 2023-02-17 02:35:52
         compiled from "C:\xampp\htdocs\demo\application\views\basket\index.php" */ ?>
<?php /*%%SmartyHeaderCode:128936744163eed9f82b00d2-52372840%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2a5e4f0647b3ba835b5f41bf8798eca04bbb3e87' => 
    array (
      0 => 'C:\\xampp\\htdocs\\demo\\application\\views\\basket\\index.php',
      1 => 1652077804,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '128936744163eed9f82b00d2-52372840',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'base_url' => 0,
    'mes' => 0,
    'basket' => 0,
    'i' => 0,
    'bk' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_63eed9f82fd176_68640791',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_63eed9f82fd176_68640791')) {function content_63eed9f82fd176_68640791($_smarty_tpl) {?><div class="row">
  <div class="col-md-3">
    <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title">Thêm thủ công</h3>
      </div>
      <form action="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
basket/insert" method="post">
        <div class="card-body">
          <?php if ($_smarty_tpl->tpl_vars['mes']->value!='') {?>
          <p class="mb-0" style="color: red;"><?php echo $_smarty_tpl->tpl_vars['mes']->value;?>
</p>
          <?php }?>
          <div class="input-group mb-3">
            <input type="text" class="form-control" id="basket_id" name="basket_id" required maxlength="20" placeholder="Mã rổ" pattern="[A-Za-z0-9-_]{3,}">
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
      <form action="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
basket/import" method="post" enctype="multipart/form-data">
        <div class="card-body">
          <div class="form-group">
            <div class="input-group">
              <input type="file" class="form-control" id="file_xls" name="file_xls" placeholder="Chọn file excel chứa dữ liệu" accept=".xls" required>
            </div>
            <div class="input-group">
              <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
basket.xls">Tải mẫu</a>
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
                    <td width="15%">Mã rổ</td>
                    <td>Ghi chú</td>
                    <td width="15%">Chức năng</td>
                  </tr>
                </thead>
              <?php $_smarty_tpl->tpl_vars['i'] = new Smarty_variable(1, null, 0);?>
              <?php  $_smarty_tpl->tpl_vars['bk'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['bk']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['basket']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['bk']->key => $_smarty_tpl->tpl_vars['bk']->value) {
$_smarty_tpl->tpl_vars['bk']->_loop = true;
?>
                <tr align="center">
                  <td><?php echo $_smarty_tpl->tpl_vars['i']->value++;?>
</td>
                  <td><?php echo $_smarty_tpl->tpl_vars['bk']->value->basket_id;?>
</td>
                  <td><?php echo $_smarty_tpl->tpl_vars['bk']->value->note;?>
</td>
                  <td>
                    <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
basket/card/<?php echo $_smarty_tpl->tpl_vars['bk']->value->basket_id;?>
">
                      <i class="fas fa-credit-card">
                      </i>
                    </a>
                    <a style="color: #17a2b8" href="#" data-toggle="modal" data-target="#update<?php echo $_smarty_tpl->tpl_vars['bk']->value->basket_id;?>
" style="cursor: pointer;" alt="Điều chỉnh">
                        <i class="fas fa-pencil-alt">
                        </i>
                    </a>
                    <a style="color: #da251d" href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
basket/delete/<?php echo $_smarty_tpl->tpl_vars['bk']->value->basket_id;?>
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
 $_from = $_smarty_tpl->tpl_vars['basket']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['bk']->key => $_smarty_tpl->tpl_vars['bk']->value) {
$_smarty_tpl->tpl_vars['bk']->_loop = true;
?>
<div class="modal fade" id="update<?php echo $_smarty_tpl->tpl_vars['bk']->value->basket_id;?>
">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Điều chỉnh</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="form-horizontal" method="post" name="updatebasket" action="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
basket/update">
        <input type="hidden" name="old_basket_id" value="<?php echo $_smarty_tpl->tpl_vars['bk']->value->basket_id;?>
">
        <div class="modal-body">
          <div class="form-group row">
            <label for="new_basket_id" class="col-sm-2 col-form-label">Mã:</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="new_basket_id" name="new_basket_id" required maxlength="20" value="<?php echo $_smarty_tpl->tpl_vars['bk']->value->basket_id;?>
" pattern="[A-Za-z0-9+-_]{2,}">
            </div>
          </div>
          
          <div class="form-group row">
            <label for="note" class="col-sm-2 col-form-label">Ghi chú:</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" placeholder="Ghi chú" name="note" id="note" value="<?php echo $_smarty_tpl->tpl_vars['bk']->value->note;?>
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
    $("#basket_id").focus();
    $('#dataTable').DataTable({
        stateSave: true
    });
  });
</script><?php }} ?>
