<?php /* Smarty version Smarty-3.1.16, created on 2023-02-15 09:12:39
         compiled from "C:\xampp\htdocs\demo\application\views\threshold\index.php" */ ?>
<?php /*%%SmartyHeaderCode:181836781763ec93f71950c8-77397643%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7d04fba962f206e39e41a2005076746c3e03bf8d' => 
    array (
      0 => 'C:\\xampp\\htdocs\\demo\\application\\views\\threshold\\index.php',
      1 => 1669273815,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '181836781763ec93f71950c8-77397643',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'base_url' => 0,
    'lohang' => 0,
    'lo' => 0,
    'lo_id' => 0,
    'result' => 0,
    'i' => 0,
    'rs' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_63ec93f71dd336_83792059',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_63ec93f71dd336_83792059')) {function content_63ec93f71dd336_83792059($_smarty_tpl) {?><div class="row">
    <div class="col-md-3">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Lựa chọn</h3>
            </div>
            <form action="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
threshold/index" method="post" id="form">
                <div class="card-body">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">LÔ</span>
                            </div>
                            <select class="form-control" name="lo_id" id="lo_id">
                                <option value="-">Tất cả</option>
                                <?php  $_smarty_tpl->tpl_vars['lo'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['lo']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['lohang']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['lo']->key => $_smarty_tpl->tpl_vars['lo']->value) {
$_smarty_tpl->tpl_vars['lo']->_loop = true;
?>
                                <option value="<?php echo $_smarty_tpl->tpl_vars['lo']->value->lo_id;?>
" <?php if ($_smarty_tpl->tpl_vars['lo_id']->value==$_smarty_tpl->tpl_vars['lo']->value->lo_id) {?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['lo']->value->lo_id;?>

                                </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <button type="submit" class="btn btn-success btn-sm btn-block" name="select">Chọn</button>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">

                </div>
                <!-- /.card-footer -->
            </form>
        </div>
    </div><!-- ./col-md-3-->
    <div class="col-md-9">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">
                    Kết quả
                </h3>
            </div>
            <div class="card-body">
                <form method="post" name="product_threshold" action="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
threshold/index">
                    <input type="hidden" name="lo_id" value="<?php echo $_smarty_tpl->tpl_vars['lo_id']->value;?>
">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr style="font-weight: bold;" align="center">
                                    <td width="3%">STT</td>
                                    <td width="20%">Mã SP</td>
                                    <td>Sản phẩm</td>
                                    <td width="20%">Định mức min</td>
                                    <td width="20%">Định mức max</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $_smarty_tpl->tpl_vars['i'] = new Smarty_variable(1, null, 0);?>
                                <?php  $_smarty_tpl->tpl_vars['rs'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['rs']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['result']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['rs']->key => $_smarty_tpl->tpl_vars['rs']->value) {
$_smarty_tpl->tpl_vars['rs']->_loop = true;
?>
                                <tr>
                                    <td align="center"><?php echo $_smarty_tpl->tpl_vars['i']->value++;?>
</td>
                                    <td align="center"><?php echo $_smarty_tpl->tpl_vars['rs']->value->product_id;?>
</td>
                                    <td><?php echo $_smarty_tpl->tpl_vars['rs']->value->product_name;?>
</td>
                                    <td align="right">
                                        <input type="hidden" name="product_id[]" value="<?php echo $_smarty_tpl->tpl_vars['rs']->value->product_id;?>
">
                                        <input type="number" class="form-control float-right" name="threshold_min[]" step="0.001" value="<?php if ($_smarty_tpl->tpl_vars['rs']->value->min==null) {?>1<?php } else { ?><?php echo $_smarty_tpl->tpl_vars['rs']->value->min;?>
<?php }?>">
                                    </td>
                                    <td><input type="number" class="form-control float-right" name="threshold_max[]" step="0.001" value="<?php if ($_smarty_tpl->tpl_vars['rs']->value->max==null) {?>1<?php } else { ?><?php echo $_smarty_tpl->tpl_vars['rs']->value->max;?>
<?php }?>"></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <?php if (($_smarty_tpl->tpl_vars['lo_id']->value!='')&&(count($_smarty_tpl->tpl_vars['result']->value)!=0)) {?>
                    <button type="submit" class="btn btn-success btn-sm btn-block" name="update">Cập nhật</button>
                    <?php }?>
                </form>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">

            </div>
            <!-- /.card-footer -->
        </div>
    </div><!-- ./col-md-8-->
</div><?php }} ?>
