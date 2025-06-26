<?php /* Smarty version Smarty-3.1.16, created on 2024-02-01 00:15:44
         compiled from "C:\xampp\htdocs\application\views\warehouse\infor.php" */ ?>
<?php /*%%SmartyHeaderCode:95686804465b4a1a0c26995-85308063%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'cee594a361d0df3e4cf1ab20568a0445a2b0271e' => 
    array (
      0 => 'C:\\xampp\\htdocs\\application\\views\\warehouse\\infor.php',
      1 => 1706417356,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '95686804465b4a1a0c26995-85308063',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_65b4a1a0ce21b7_81845145',
  'variables' => 
  array (
    'base_url' => 0,
    'mes' => 0,
    'quycach' => 0,
    'obj' => 0,
    'product' => 0,
    'size' => 0,
    'warehouse_infor' => 0,
    'i' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_65b4a1a0ce21b7_81845145')) {function content_65b4a1a0ce21b7_81845145($_smarty_tpl) {?><div class="row">
    <div class="col-md-3">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Thêm thủ công</h3>
            </div>
            <form action="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
warehouse/infor" method="post">
                <div class="card-body">
                    <?php if ($_smarty_tpl->tpl_vars['mes']->value!='') {?>
                    <p class="mb-0" style="color: red;"><?php echo $_smarty_tpl->tpl_vars['mes']->value;?>
</p>
                    <?php }?>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Mã kho</span>
                            </div>
                            <input type="text" class="form-control" placeholder="Mã kho" id="warehouse_id"
                                name="warehouse_id" required maxlength="20" pattern="[A-Za-z0-9-_]{2,}"
                                >
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Quy cách</span>
                            </div>
                            <select class="form-control" name="quycach_id" id="quycach_id">
                                <option value="">Tất cả</option>
                                <?php  $_smarty_tpl->tpl_vars['obj'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['obj']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['quycach']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['obj']->key => $_smarty_tpl->tpl_vars['obj']->value) {
$_smarty_tpl->tpl_vars['obj']->_loop = true;
?>
                                <option value="<?php echo $_smarty_tpl->tpl_vars['obj']->value->quycach_id;?>
"><?php echo $_smarty_tpl->tpl_vars['obj']->value->quycach_name;?>
</option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Sản phẩm</span>
                            </div>
                            <select class="form-control" name="product_id" id="product_id">
                                <option value="">Tất cả</option>
                                <?php  $_smarty_tpl->tpl_vars['obj'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['obj']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['product']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['obj']->key => $_smarty_tpl->tpl_vars['obj']->value) {
$_smarty_tpl->tpl_vars['obj']->_loop = true;
?>
                                <option value="<?php echo $_smarty_tpl->tpl_vars['obj']->value->product_id;?>
"><?php echo $_smarty_tpl->tpl_vars['obj']->value->product_name;?>
</option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Size</span>
                            </div>
                            <select class="form-control" name="size_id" id="size_id">
                                <option value="">Tất cả</option>
                                <?php  $_smarty_tpl->tpl_vars['obj'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['obj']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['size']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['obj']->key => $_smarty_tpl->tpl_vars['obj']->value) {
$_smarty_tpl->tpl_vars['obj']->_loop = true;
?>
                                <option value="<?php echo $_smarty_tpl->tpl_vars['obj']->value->size_id;?>
"><?php echo $_smarty_tpl->tpl_vars['obj']->value->size_name;?>
</option>
                                <?php } ?>
                            </select>
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
    </div>
    <!-- col-md-3-->
    <div class="col-md-9">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">
                    Danh sách
                </h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr style="font-weight: bold;" align="center">
                                <td width="2%">STT</td>
                                <td width="15%">Mã kho</td>
                                <td>Quy cách</td>
                                <td>Hàng hóa</td>
                                <td>Size</td>
                                <td width="15%">Chức năng</td>
                            </tr>
                        </thead>
                        <?php $_smarty_tpl->tpl_vars['i'] = new Smarty_variable(1, null, 0);?>
                        <?php  $_smarty_tpl->tpl_vars['obj'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['obj']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['warehouse_infor']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['obj']->key => $_smarty_tpl->tpl_vars['obj']->value) {
$_smarty_tpl->tpl_vars['obj']->_loop = true;
?>
                        <tr align="center">
                            <td><?php echo $_smarty_tpl->tpl_vars['i']->value++;?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['obj']->value->warehouse_id;?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['obj']->value->quycach_name;?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['obj']->value->product_name;?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['obj']->value->size_name;?>
</td>
                            <td>
                                <a style="color: #da251d" href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
warehouse/delete/<?php echo $_smarty_tpl->tpl_vars['obj']->value->warehouse_id;?>
"
                                    onclick="return confirm('Bạn có chắc chắn xóa không?');">
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
warehouse/dongbo" method="post">
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

<script>
    $(document).ready(function () {
        $("#size_id").focus();
        $("#quycach_id").select2();
        $("#product_id").select2();
        $("#size_id").select2();
        $("#dataTable").DataTable({
            stateSave: true
        });
    });
</script><?php }} ?>
