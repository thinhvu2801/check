<?php /* Smarty version Smarty-3.1.16, created on 2024-02-20 01:36:30
         compiled from "D:\xampp\htdocs\htdocsbentre\application\views\user\role.php" */ ?>
<?php /*%%SmartyHeaderCode:20750456665d3f40e31a132-13029340%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '99464f97047233425f6c2deea134d4b5fe19b102' => 
    array (
      0 => 'D:\\xampp\\htdocs\\htdocsbentre\\application\\views\\user\\role.php',
      1 => 1598429406,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '20750456665d3f40e31a132-13029340',
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
  'unifunc' => 'content_65d3f40e381278_01327232',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_65d3f40e381278_01327232')) {function content_65d3f40e381278_01327232($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_in_array')) include 'D:\\xampp\\htdocs\\htdocsbentre\\application\\third_party\\Smarty-3.1.16\\libs\\plugins\\modifier.in_array.php';
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
