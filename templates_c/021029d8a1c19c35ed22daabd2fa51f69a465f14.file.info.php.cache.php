<?php /* Smarty version Smarty-3.1.16, created on 2025-03-18 10:22:41
         compiled from "C:\xampp\htdocs\check\application\views\card\info.php" */ ?>
<?php /*%%SmartyHeaderCode:93646369567c16f76db2ea7-66207995%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '021029d8a1c19c35ed22daabd2fa51f69a465f14' => 
    array (
      0 => 'C:\\xampp\\htdocs\\check\\application\\views\\card\\info.php',
      1 => 1742289753,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '93646369567c16f76db2ea7-66207995',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_67c16f77264121_76378739',
  'variables' => 
  array (
    'card_sl' => 0,
    'typecard' => 0,
    'card' => 0,
    'card_id' => 0,
    'delete_card' => 0,
    'base_url' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_67c16f77264121_76378739')) {function content_67c16f77264121_76378739($_smarty_tpl) {?><div class="col-lg-12 col-12">
    <div class="small-box bg-info">
        <div class="inner">
        <h4><?php echo $_smarty_tpl->tpl_vars['card_sl']->value;?>
</h4>
        <h4>Loại thẻ: <?php echo $_smarty_tpl->tpl_vars['typecard']->value;?>
</h4>
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
