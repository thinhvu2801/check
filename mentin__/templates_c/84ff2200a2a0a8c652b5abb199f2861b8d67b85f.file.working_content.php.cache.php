<?php /* Smarty version Smarty-3.1.16, created on 2023-02-28 09:21:52
         compiled from "C:\xampp\htdocs\demo\application\views\statistic\suaca\working_content.php" */ ?>
<?php /*%%SmartyHeaderCode:166417528563fdb9a0228537-66622097%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '84ff2200a2a0a8c652b5abb199f2861b8d67b85f' => 
    array (
      0 => 'C:\\xampp\\htdocs\\demo\\application\\views\\statistic\\suaca\\working_content.php',
      1 => 1671765001,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '166417528563fdb9a0228537-66622097',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'result_in' => 0,
    'rs' => 0,
    'r' => 0,
    'result_out' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_63fdb9a024bf03_52829852',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_63fdb9a024bf03_52829852')) {function content_63fdb9a024bf03_52829852($_smarty_tpl) {?><div class="row" style="overflow: visible;">
    <div class="col-md-5">
        <div class="table-responsive">
            <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr style="font-weight: bold; color:red;" align="center">
                        <th>Lô</th>
                        <th>Rổ</th>
                        <th>CN</th>
                        <th>SP</th>
                        <th>KL Vào</th>
                        <th>Giờ Vào</th>
                    </tr>
                </thead>
                <tbody>
                    <?php  $_smarty_tpl->tpl_vars['rs'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['rs']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['result_in']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['rs']->key => $_smarty_tpl->tpl_vars['rs']->value) {
$_smarty_tpl->tpl_vars['rs']->_loop = true;
?>
                    <tr align="center">
                        <?php  $_smarty_tpl->tpl_vars['r'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['r']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['rs']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['r']->key => $_smarty_tpl->tpl_vars['r']->value) {
$_smarty_tpl->tpl_vars['r']->_loop = true;
?>
                        <td><?php echo $_smarty_tpl->tpl_vars['r']->value;?>
</td>
                        <?php } ?>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-md-7">
        <div class="table-responsive">
            <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr style="font-weight: bold;color:blue;" align="center">
                        <th>Lô</th>
                        <th>Rổ</th>
                        <th>CN</th>
                        <th>SP</th>
                        <th>KL Vào</th>
                        <th>Giờ Vào</th>
                        <th>KL Ra</th>
                        <th>Giờ Ra</th>
                    </tr>
                </thead>
                <tbody>
                    <?php  $_smarty_tpl->tpl_vars['rs'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['rs']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['result_out']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['rs']->key => $_smarty_tpl->tpl_vars['rs']->value) {
$_smarty_tpl->tpl_vars['rs']->_loop = true;
?>
                    <tr align="center">
                        <?php  $_smarty_tpl->tpl_vars['r'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['r']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['rs']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['r']->key => $_smarty_tpl->tpl_vars['r']->value) {
$_smarty_tpl->tpl_vars['r']->_loop = true;
?>
                        <td><?php echo $_smarty_tpl->tpl_vars['r']->value;?>
</td>
                        <?php } ?>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div><?php }} ?>
