<?php /* Smarty version Smarty-3.1.16, created on 2023-02-13 07:56:48
         compiled from "C:\xampp\htdocs\demo\application\views\navbar.php" */ ?>
<?php /*%%SmartyHeaderCode:193995138263e9df308a38f9-14750488%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c302d9908c3fffe31f9ccc35c284b587c59c1fb5' => 
    array (
      0 => 'C:\\xampp\\htdocs\\demo\\application\\views\\navbar.php',
      1 => 1668222474,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '193995138263e9df308a38f9-14750488',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'role' => 0,
    'admin' => 0,
    'elements' => 0,
    'base_url' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_63e9df308be2a4_95194643',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_63e9df308be2a4_95194643')) {function content_63e9df308be2a4_95194643($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_in_array')) include 'C:\\xampp\\htdocs\\demo\\application\\third_party\\Smarty-3.1.16\\libs\\plugins\\modifier.in_array.php';
?><!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <?php if (smarty_modifier_in_array('stat_overview',$_smarty_tpl->tpl_vars['role']->value,$_smarty_tpl->tpl_vars['admin']->value)&&$_smarty_tpl->tpl_vars['elements']->value->stat_overview==1) {?>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
chartreport/overview" class="nav-link text-info"><i class="fa fa-bar-chart" aria-hidden="true"></i> Tổng quan</a>
      </li>
      <?php }?>
      <?php if (smarty_modifier_in_array('dongbo',$_smarty_tpl->tpl_vars['role']->value,$_smarty_tpl->tpl_vars['admin']->value)&&$_smarty_tpl->tpl_vars['elements']->value->dongbo==1) {?>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
card/dongbo" class="nav-link text-info"><i class="fa fa-refresh" aria-hidden="true"></i> Đồng bộ thẻ</a>
      </li>
      <?php }?>

      <?php if ($_smarty_tpl->tpl_vars['admin']->value==1) {?>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
user/license" class="nav-link"><i class="fa fa-copyright" aria-hidden="true"></i> Bản quyền</a>
      </li>
      <?php }?>
      <?php if (smarty_modifier_in_array('working',$_smarty_tpl->tpl_vars['role']->value,$_smarty_tpl->tpl_vars['admin']->value)&&$_smarty_tpl->tpl_vars['elements']->value->working==1) {?>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
working/index" class="nav-link text-info"><i class="fa fa-refresh" aria-hidden="true"></i> Working</a>
      </li>
      <?php }?>
    </ul>

    <!-- SEARCH FORM -->
    <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <!-- <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div> -->
      </div>
    </form>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link" onclick="openFullscreen();" id="fullscreen"><i class="fa fa-desktop nav-icon"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link" onclick="closeFullscreen();" id="exitfullscreen"><i class="fa fa-desktop nav-icon"></i></a>
      </li>
    </ul>
  </nav>
<!-- /.navbar --><?php }} ?>
