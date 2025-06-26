<?php /* Smarty version Smarty-3.1.16, created on 2023-03-15 09:46:39
         compiled from "C:\xampp\htdocs\mentin\application\views\backup\index.php" */ ?>
<?php /*%%SmartyHeaderCode:8150213786411841a774f29-21478469%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '787061b6276fe5ec27b7f70ff61e32ac4c53881e' => 
    array (
      0 => 'C:\\xampp\\htdocs\\mentin\\application\\views\\backup\\index.php',
      1 => 1678869997,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '8150213786411841a774f29-21478469',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_6411841a977a79_26095734',
  'variables' => 
  array (
    'success' => 0,
    'base_url' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_6411841a977a79_26095734')) {function content_6411841a977a79_26095734($_smarty_tpl) {?><div class="row">
    <div class="col-md-12">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Sao lưu dữ liệu</h3>
            </div>
            <div class="card-body">
                <?php if ($_smarty_tpl->tpl_vars['success']->value=="1") {?>
                <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
MenTPS.bak">Tải về</a>
                <?php } else { ?>
                Có lỗi trong quá trình backup! Thử lại lần nữa!
                <?php }?>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
</div><?php }} ?>
