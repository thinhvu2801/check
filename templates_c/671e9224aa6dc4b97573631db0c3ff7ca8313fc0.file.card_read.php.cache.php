<?php /* Smarty version Smarty-3.1.16, created on 2024-01-30 07:29:52
         compiled from "C:\xampp\htdocs\application\views\basket\card_read.php" */ ?>
<?php /*%%SmartyHeaderCode:123936328865b46bf7e867e8-55783470%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '671e9224aa6dc4b97573631db0c3ff7ca8313fc0' => 
    array (
      0 => 'C:\\xampp\\htdocs\\application\\views\\basket\\card_read.php',
      1 => 1668593362,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '123936328865b46bf7e867e8-55783470',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_65b46bf7f26a82_35528516',
  'variables' => 
  array (
    'card_list' => 0,
    'i' => 0,
    'lst' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_65b46bf7f26a82_35528516')) {function content_65b46bf7f26a82_35528516($_smarty_tpl) {?><?php if (count($_smarty_tpl->tpl_vars['card_list']->value)!=0) {?>
<table class="table table-hover table-bordered" id="dataTable" width="100%" cellspacing="0">
	<thead>
		<tr class="btn-success">
			<td>TT thẻ</td>
			<td width="35%">Chức năng</td>
		</tr>
	</thead>
	<tbody>
	<?php $_smarty_tpl->tpl_vars['i'] = new Smarty_variable(1, null, 0);?>
	<?php  $_smarty_tpl->tpl_vars['lst'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['lst']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['card_list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['lst']->key => $_smarty_tpl->tpl_vars['lst']->value) {
$_smarty_tpl->tpl_vars['lst']->_loop = true;
?>
	<tr>
	<td>Thẻ <?php echo $_smarty_tpl->tpl_vars['i']->value++;?>
</td>	
	<td align="center">
		<a class="btn btn-danger btn-sm" href="#" onclick="_delete('<?php echo $_smarty_tpl->tpl_vars['lst']->value->card_id;?>
');">
            <i class="fas fa-trash"></i>
        </a>
    </td>
	</tr>
	<?php } ?>	
	</tbody>
</table>
<?php } else { ?>
Chưa có thẻ nào được liên kết
<?php }?><?php }} ?>
