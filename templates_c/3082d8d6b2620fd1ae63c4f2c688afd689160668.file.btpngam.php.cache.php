<?php /* Smarty version Smarty-3.1.16, created on 2024-09-24 16:24:26
         compiled from "D:\xampp\htdocs\htdocsbentre\application\views\btpngam.php" */ ?>
<?php /*%%SmartyHeaderCode:170399992566f10ff10f24b5-70694251%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3082d8d6b2620fd1ae63c4f2c688afd689160668' => 
    array (
      0 => 'D:\\xampp\\htdocs\\htdocsbentre\\application\\views\\btpngam.php',
      1 => 1727187862,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '170399992566f10ff10f24b5-70694251',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_66f10ff113ac20_13693124',
  'variables' => 
  array (
    'result' => 0,
    'rs' => 0,
    'r' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_66f10ff113ac20_13693124')) {function content_66f10ff113ac20_13693124($_smarty_tpl) {?><div class="table-responsive">
    <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr style="font-weight: bold;color:blue;" align="center">
                <th>Rổ</th>
                <th>KL Vào</th>
                <th>KL Ra</th>
                <th>Tăng trọng</th>
            </tr>
        </thead>
        <tbody>
            <?php  $_smarty_tpl->tpl_vars['rs'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['rs']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['result']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
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
</div><?php }} ?>
