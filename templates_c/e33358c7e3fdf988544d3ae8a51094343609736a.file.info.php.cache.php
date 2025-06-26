<?php /* Smarty version Smarty-3.1.16, created on 2024-01-27 04:07:39
         compiled from "C:\xampp\htdocs\application\views\card\info.php" */ ?>
<?php /*%%SmartyHeaderCode:85031224265b4737bafa6e3-16550921%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e33358c7e3fdf988544d3ae8a51094343609736a' => 
    array (
      0 => 'C:\\xampp\\htdocs\\application\\views\\card\\info.php',
      1 => 1675846918,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '85031224265b4737bafa6e3-16550921',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'card' => 0,
    'card_id' => 0,
    'delete_card' => 0,
    'base_url' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_65b4737bb8af87_83302741',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_65b4737bb8af87_83302741')) {function content_65b4737bb8af87_83302741($_smarty_tpl) {?><div class="col-lg-12 col-12">
    <div class="small-box bg-info">
        <div class="inner">
        <?php if ($_smarty_tpl->tpl_vars['card']->value!=null) {?>
            <h3>Mã thẻ: <?php echo $_smarty_tpl->tpl_vars['card_id']->value;?>
</h3>
            <h3>Loại thẻ: <?php echo $_smarty_tpl->tpl_vars['card']->value->object_type;?>
</h3>
            <h4>Mã: <?php echo $_smarty_tpl->tpl_vars['card']->value->object_id;?>
</h4>
            <h4>Tên: <?php echo $_smarty_tpl->tpl_vars['card']->value->object_name;?>
</h4>
        <?php } else { ?>
            <h3>Mã thẻ: <?php echo $_smarty_tpl->tpl_vars['card_id']->value;?>
</h3>
            <h3>Thẻ trống</h3>
            <h4>Mã: ---</h4>
            <h4>Tên: ---</h4>
        <?php }?>
        </div>
        <div class="icon">
          <i class="fas fa-credit-card"></i>
        </div>
        <?php if ($_smarty_tpl->tpl_vars['delete_card']->value==1) {?>
        <?php if ($_smarty_tpl->tpl_vars['card']->value!=null) {?>
        <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
card/delete/<?php echo $_smarty_tpl->tpl_vars['card_id']->value;?>
" onclick="return confirm('Bạn có chắc chắn hủy thẻ <?php echo $_smarty_tpl->tpl_vars['card_id']->value;?>
 không?');" class="small-box-footer">
            <i class="fas fa-trash"></i>
            Hủy thẻ
        </a>
        <?php }?>
        <?php }?>
        
    </div>
</div><?php }} ?>
