<?php /* Smarty version Smarty-3.1.16, created on 2023-02-19 16:03:48
         compiled from "C:\xampp\htdocs\demo\application\views\user\role.php" */ ?>
<?php /*%%SmartyHeaderCode:132112412963f23a541aa7b2-23089471%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0bf5b09a3bfaae858324f7372506fee5ec6e0676' => 
    array (
      0 => 'C:\\xampp\\htdocs\\demo\\application\\views\\user\\role.php',
      1 => 1598429406,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '132112412963f23a541aa7b2-23089471',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'role_list' => 0,
    'rl' => 0,
    'role' => 0,
    'admin' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_63f23a542047d1_07827688',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_63f23a542047d1_07827688')) {function content_63f23a542047d1_07827688($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_in_array')) include 'C:\\xampp\\htdocs\\demo\\application\\third_party\\Smarty-3.1.16\\libs\\plugins\\modifier.in_array.php';
?><label>Danh sách quyền</label>
<select id="role" multiple="multiple" name="role">
    <?php  $_smarty_tpl->tpl_vars['rl'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['rl']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['role_list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['rl']->key => $_smarty_tpl->tpl_vars['rl']->value) {
$_smarty_tpl->tpl_vars['rl']->_loop = true;
?>
    <option value="<?php echo $_smarty_tpl->tpl_vars['rl']->value->role_id;?>
" <?php if (smarty_modifier_in_array($_smarty_tpl->tpl_vars['rl']->value->role_id,$_smarty_tpl->tpl_vars['role']->value,$_smarty_tpl->tpl_vars['admin']->value)) {?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['rl']->value->role_name;?>

    </option>
    <?php } ?>
</select>
<script type="text/javascript">
$('#role').bootstrapDualListbox();
</script><?php }} ?>
