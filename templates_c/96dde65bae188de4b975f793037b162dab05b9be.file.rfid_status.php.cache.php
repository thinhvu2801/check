<?php /* Smarty version Smarty-3.1.16, created on 2025-02-27 03:17:40
         compiled from "C:\xampp\htdocs\check\application\views\card\rfid_status.php" */ ?>
<?php /*%%SmartyHeaderCode:69309171367bfcb44b9c032-34968848%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '96dde65bae188de4b975f793037b162dab05b9be' => 
    array (
      0 => 'C:\\xampp\\htdocs\\check\\application\\views\\card\\rfid_status.php',
      1 => 1676718040,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '69309171367bfcb44b9c032-34968848',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'status' => 0,
    'i' => 0,
    'rs' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_67bfcb44bef030_91151705',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_67bfcb44bef030_91151705')) {function content_67bfcb44bef030_91151705($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include 'C:\\xampp\\htdocs\\check\\application\\third_party\\Smarty-3.1.16\\libs\\plugins\\modifier.date_format.php';
?><div class="table-responsive">
    <table class="table table-hover table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr style="font-weight: bold;" align="center">
                <td width="3%">STT</td>
                <td>Client name</td>
                <td>Ngày</td>
                <td>Giờ cập nhật</td>
            </tr>
        </thead>
        <tbody>
            <?php $_smarty_tpl->tpl_vars['i'] = new Smarty_variable(1, null, 0);?>
            <?php  $_smarty_tpl->tpl_vars['rs'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['rs']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['status']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['rs']->key => $_smarty_tpl->tpl_vars['rs']->value) {
$_smarty_tpl->tpl_vars['rs']->_loop = true;
?>
            <tr>
                <td align="center"><?php echo $_smarty_tpl->tpl_vars['i']->value++;?>
</td>
                <td align="center"><?php echo $_smarty_tpl->tpl_vars['rs']->value->client_name;?>
</td>
                <td align="center"><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['rs']->value->date,"d/m/Y");?>
</td>
                <td align="center"><?php echo $_smarty_tpl->tpl_vars['rs']->value->time;?>
</td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div><?php }} ?>
