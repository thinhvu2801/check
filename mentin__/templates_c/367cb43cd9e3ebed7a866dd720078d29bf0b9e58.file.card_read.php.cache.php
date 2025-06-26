<?php /* Smarty version Smarty-3.1.16, created on 2023-03-17 08:34:13
         compiled from "C:\xampp\htdocs\mentin\application\views\me\card_read.php" */ ?>
<?php /*%%SmartyHeaderCode:777263883641417f560ddb1-79733380%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '367cb43cd9e3ebed7a866dd720078d29bf0b9e58' => 
    array (
      0 => 'C:\\xampp\\htdocs\\mentin\\application\\views\\me\\card_read.php',
      1 => 1603078853,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '777263883641417f560ddb1-79733380',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'card_list' => 0,
    'lst' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_641417f5637f38_25075075',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_641417f5637f38_25075075')) {function content_641417f5637f38_25075075($_smarty_tpl) {?><?php if (count($_smarty_tpl->tpl_vars['card_list']->value)!=0) {?>
<table class="table table-hover table-bordered" id="dataTable" width="100%" cellspacing="0">
	<thead>
	<tr class="btn-success">
		<td>Mã thẻ</td>
		<td width="35%">Chức năng</td>
	</tr>
	</thead>
	<tbody>
	<?php  $_smarty_tpl->tpl_vars['lst'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['lst']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['card_list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['lst']->key => $_smarty_tpl->tpl_vars['lst']->value) {
$_smarty_tpl->tpl_vars['lst']->_loop = true;
?>
	<tr>
	<td><?php echo $_smarty_tpl->tpl_vars['lst']->value->card_id;?>
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
<?php }?>
<?php }} ?>
