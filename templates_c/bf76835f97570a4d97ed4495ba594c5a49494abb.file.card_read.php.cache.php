<?php /* Smarty version Smarty-3.1.16, created on 2024-01-28 08:53:22
         compiled from "C:\xampp\htdocs\application\views\customer\card_read.php" */ ?>
<?php /*%%SmartyHeaderCode:68119490365b607f215eed3-87312506%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'bf76835f97570a4d97ed4495ba594c5a49494abb' => 
    array (
      0 => 'C:\\xampp\\htdocs\\application\\views\\customer\\card_read.php',
      1 => 1668593381,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '68119490365b607f215eed3-87312506',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'card_list' => 0,
    'i' => 0,
    'lst' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_65b607f21f7481_02278052',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_65b607f21f7481_02278052')) {function content_65b607f21f7481_02278052($_smarty_tpl) {?><?php if (count($_smarty_tpl->tpl_vars['card_list']->value)!=0) {?>
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
