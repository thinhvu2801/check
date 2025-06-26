<?php /* Smarty version Smarty-3.1.16, created on 2025-06-23 02:54:36
         compiled from "D:\App\Wampp\www\check\application\views\user\role.php" */ ?>
<?php /*%%SmartyHeaderCode:10602762946858c1ecdce7d8-70558690%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '51b41584c6d980ff42af1c35816a2a5fa5413238' => 
    array (
      0 => 'D:\\App\\Wampp\\www\\check\\application\\views\\user\\role.php',
      1 => 1598429406,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '10602762946858c1ecdce7d8-70558690',
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
  'unifunc' => 'content_6858c1ecdde904_98584459',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_6858c1ecdde904_98584459')) {function content_6858c1ecdde904_98584459($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_in_array')) include 'D:\\App\\Wampp\\www\\check\\application\\third_party\\Smarty-3.1.16\\libs\\plugins\\modifier.in_array.php';
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
