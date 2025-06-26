<?php /* Smarty version Smarty-3.1.16, created on 2024-11-20 02:32:14
         compiled from "D:\xampp\htdocs\htdocsbentre\application\views\card\info.php" */ ?>
<?php /*%%SmartyHeaderCode:81179241265d94d02be35b8-17839497%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c829227a15b9a1c6be63d146a4f3f58d7be49153' => 
    array (
      0 => 'D:\\xampp\\htdocs\\htdocsbentre\\application\\views\\card\\info.php',
      1 => 1732066328,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '81179241265d94d02be35b8-17839497',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_65d94d02c46835_65704526',
  'variables' => 
  array (
    'card_sl' => 0,
    'card' => 0,
    'card_id' => 0,
    'delete_card' => 0,
    'base_url' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_65d94d02c46835_65704526')) {function content_65d94d02c46835_65704526($_smarty_tpl) {?><div class="col-lg-12 col-12">
    <div class="small-box bg-info">
        <div class="inner">
        <h4><?php echo $_smarty_tpl->tpl_vars['card_sl']->value;?>
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
