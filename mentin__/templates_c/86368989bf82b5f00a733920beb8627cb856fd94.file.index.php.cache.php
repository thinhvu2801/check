<?php /* Smarty version Smarty-3.1.16, created on 2023-02-17 02:05:02
         compiled from "C:\xampp\htdocs\demo\application\views\customer\index.php" */ ?>
<?php /*%%SmartyHeaderCode:139524496663eed2be99bb93-97006737%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '86368989bf82b5f00a733920beb8627cb856fd94' => 
    array (
      0 => 'C:\\xampp\\htdocs\\demo\\application\\views\\customer\\index.php',
      1 => 1673073049,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '139524496663eed2be99bb93-97006737',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'base_url' => 0,
    'mes' => 0,
    'customer' => 0,
    'i' => 0,
    'pr' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_63eed2bea4cdd7_49046504',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_63eed2bea4cdd7_49046504')) {function content_63eed2bea4cdd7_49046504($_smarty_tpl) {?><div class="row">
  <div class="col-md-3">
    <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title">Thêm thủ công</h3>
      </div>
      <form action="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
customer/insert" method="post">
        <div class="card-body">
          <?php if ($_smarty_tpl->tpl_vars['mes']->value!='') {?>
          <p class="mb-0" style="color: red;"><?php echo $_smarty_tpl->tpl_vars['mes']->value;?>
</p>
          <?php }?>
          <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Mã khách hàng" id="customer_id" name="customer_id"required maxlength="20" pattern="[A-Za-z0-9-_]{3,}">
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
          <?php $_smarty_tpl->tpl_vars['i'] = new Smarty_variable(1, null, 0);?>
          <?php  $_smarty_tpl->tpl_vars['pr'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['pr']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['customer']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['pr']->key => $_smarty_tpl->tpl_vars['pr']->value) {
$_smarty_tpl->tpl_vars['pr']->_loop = true;
?>
            <tr align="center">
              <td><?php echo $_smarty_tpl->tpl_vars['i']->value++;?>
</td>
              <td><?php echo $_smarty_tpl->tpl_vars['pr']->value->customer_id;?>
</td>
              <td><?php echo $_smarty_tpl->tpl_vars['pr']->value->customer_name;?>
</td>
              <td><?php echo $_smarty_tpl->tpl_vars['pr']->value->note;?>
</td>
              <td>
                <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
customer/card/<?php echo $_smarty_tpl->tpl_vars['pr']->value->customer_id;?>
">
                    <i class="fas fa-credit-card">
                    </i>
                </a>
                <a style="color: #17a2b8" href="#" data-toggle="modal" data-target="#update<?php echo $_smarty_tpl->tpl_vars['pr']->value->customer_id;?>
" style="cursor: pointer;" alt="Điều chỉnh">
                    <i class="fas fa-pencil-alt">
                    </i>
                </a>
                <a style="color: #da251d" href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
customer/delete/<?php echo $_smarty_tpl->tpl_vars['pr']->value->customer_id;?>
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

  </div>
  <!-- col-md-8-->
</div>
<?php  $_smarty_tpl->tpl_vars['pr'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['pr']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['customer']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['pr']->key => $_smarty_tpl->tpl_vars['pr']->value) {
$_smarty_tpl->tpl_vars['pr']->_loop = true;
?>
<div class="modal fade" id="update<?php echo $_smarty_tpl->tpl_vars['pr']->value->customer_id;?>
">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Điều chỉnh</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="form-horizontal" method="post" name="updatecustomer" action="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
customer/update">
        <input type="hidden" name="old_customer_id" value="<?php echo $_smarty_tpl->tpl_vars['pr']->value->customer_id;?>
">
        <div class="modal-body">
          <div class="form-group row">
            <label for="new_customer_id" class="col-sm-2 col-form-label">Mã:</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" placeholder="Mã khách hàng" id="new_customer_id" name="new_customer_id" required maxlength="20" value="<?php echo $_smarty_tpl->tpl_vars['pr']->value->customer_id;?>
" pattern="[A-Za-z0-9+-_]{3,}">
            </div>
          </div>
          <div class="form-group row">
            <label for="customer_name" class="col-sm-2 col-form-label">Tên:</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" placeholder="Tên khách hàng" id="customer_name" name="customer_name" required value="<?php echo $_smarty_tpl->tpl_vars['pr']->value->customer_name;?>
">
            </div>
          </div>
          <div class="form-group row">
            <label for="note" class="col-sm-2 col-form-label">Ghi chú:</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" placeholder="Ghi chú" name="note" id="note" value="<?php echo $_smarty_tpl->tpl_vars['pr']->value->note;?>
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
    $("#customer_id" ).focus();
    $("#dataTable").DataTable({
        stateSave: true
    });
  });
</script><?php }} ?>
