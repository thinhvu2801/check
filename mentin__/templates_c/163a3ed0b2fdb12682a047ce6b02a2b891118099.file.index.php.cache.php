<?php /* Smarty version Smarty-3.1.16, created on 2023-03-17 07:59:51
         compiled from "C:\xampp\htdocs\mentin\application\views\me\index.php" */ ?>
<?php /*%%SmartyHeaderCode:122752204064140fe7caf5d4-34971996%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '163a3ed0b2fdb12682a047ce6b02a2b891118099' => 
    array (
      0 => 'C:\\xampp\\htdocs\\mentin\\application\\views\\me\\index.php',
      1 => 1641972968,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '122752204064140fe7caf5d4-34971996',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'base_url' => 0,
    'mes' => 0,
    'me' => 0,
    'i' => 0,
    'bk' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_64140fe7ce8d85_72613058',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_64140fe7ce8d85_72613058')) {function content_64140fe7ce8d85_72613058($_smarty_tpl) {?><div class="row">
  <div class="col-md-3">
    <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title">Thêm thủ công</h3>
      </div>
      <form action="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
me/insert" method="post">
        <div class="card-body">
          <?php if ($_smarty_tpl->tpl_vars['mes']->value!='') {?>
          <p class="mb-0" style="color: red;"><?php echo $_smarty_tpl->tpl_vars['mes']->value;?>
</p>
          <?php }?>
          <div class="input-group mb-3">
            <input type="text" class="form-control" id="me_id" name="me_id" required maxlength="20" placeholder="Mã mẻ" pattern="[A-Za-z0-9-_]{1,}">
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
  </div><!-- ./col-md-3-->
  <div class="col-md-9">
    <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title">Danh sách mẻ</h3>
      </div>
        <div class="card-body">
        <div class="table-responsive">
          <table class="table table-hover table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                  <tr style="font-weight: bold;" align="center">
                    <td width="3%">STT</td>
                    <td width="15%">Mã mẻ</td>
                    <td width="35%">Ghi chú</td>
                    <td width="13%">Chức năng</td>
                  </tr>
                </thead>
              <?php $_smarty_tpl->tpl_vars['i'] = new Smarty_variable(1, null, 0);?>
              <?php  $_smarty_tpl->tpl_vars['bk'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['bk']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['me']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['bk']->key => $_smarty_tpl->tpl_vars['bk']->value) {
$_smarty_tpl->tpl_vars['bk']->_loop = true;
?>
                <tr align="center">
                  <td><?php echo $_smarty_tpl->tpl_vars['i']->value++;?>
</td>
                  <td><?php echo $_smarty_tpl->tpl_vars['bk']->value->me_id;?>
</td>
                  <td><?php echo $_smarty_tpl->tpl_vars['bk']->value->note;?>
</td>
                  <td>
                    <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
me/card/<?php echo $_smarty_tpl->tpl_vars['bk']->value->me_id;?>
">
                      <i class="fas fa-credit-card">
                      </i>
                    </a>
                    <a style="color: #17a2b8" href="#" data-toggle="modal" data-target="#update<?php echo $_smarty_tpl->tpl_vars['bk']->value->me_id;?>
" style="cursor: pointer;" alt="Điều chỉnh">
                        <i class="fas fa-pencil-alt">
                        </i>
                    </a>
                    <a style="color: #da251d" href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
me/delete/<?php echo $_smarty_tpl->tpl_vars['bk']->value->me_id;?>
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
 $_from = $_smarty_tpl->tpl_vars['me']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['bk']->key => $_smarty_tpl->tpl_vars['bk']->value) {
$_smarty_tpl->tpl_vars['bk']->_loop = true;
?>
<div class="modal fade" id="update<?php echo $_smarty_tpl->tpl_vars['bk']->value->me_id;?>
">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Điều chỉnh</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="form-horizontal" method="post" name="updateme" action="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
me/update">
        <input type="hidden" name="old_me_id" value="<?php echo $_smarty_tpl->tpl_vars['bk']->value->me_id;?>
">
        <div class="modal-body">
          <div class="form-group row">
            <label for="new_me_id" class="col-sm-2 col-form-label">Mã:</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="new_me_id" name="new_me_id" required maxlength="20" value="<?php echo $_smarty_tpl->tpl_vars['bk']->value->me_id;?>
" pattern="[A-Za-z0-9+-_]{1,}">
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
  $( document ).ready(function() {
    $("#me_id").focus();
    $('#dataTable').DataTable({
        stateSave: true
    });
  });
</script><?php }} ?>
