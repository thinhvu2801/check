<?php /* Smarty version Smarty-3.1.16, created on 2023-03-22 04:21:51
         compiled from "C:\xampp\htdocs\mentin\application\views\card\info.php" */ ?>
<?php /*%%SmartyHeaderCode:1013417985641a744fb702b5-78592889%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3d1f53cf4c95e1d946b73ca6121a4e5b7747fc45' => 
    array (
      0 => 'C:\\xampp\\htdocs\\mentin\\application\\views\\card\\info.php',
      1 => 1675846917,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1013417985641a744fb702b5-78592889',
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
  'unifunc' => 'content_641a744fc05078_11684625',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_641a744fc05078_11684625')) {function content_641a744fc05078_11684625($_smarty_tpl) {?><div class="col-lg-12 col-12">
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
