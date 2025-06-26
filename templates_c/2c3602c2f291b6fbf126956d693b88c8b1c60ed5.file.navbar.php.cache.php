<?php /* Smarty version Smarty-3.1.16, created on 2024-07-23 03:07:58
         compiled from "D:\xampp\htdocs\htdocsbentre\application\views\navbar.php" */ ?>
<?php /*%%SmartyHeaderCode:162193552765bb1d82b348d4-37921042%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2c3602c2f291b6fbf126956d693b88c8b1c60ed5' => 
    array (
      0 => 'D:\\xampp\\htdocs\\htdocsbentre\\application\\views\\navbar.php',
      1 => 1721696876,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '162193552765bb1d82b348d4-37921042',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_65bb1d82b508d7_29156522',
  'variables' => 
  array (
    'role' => 0,
    'admin' => 0,
    'elements' => 0,
    'base_url' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_65bb1d82b508d7_29156522')) {function content_65bb1d82b508d7_29156522($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_in_array')) include 'D:\\xampp\\htdocs\\htdocsbentre\\application\\third_party\\Smarty-3.1.16\\libs\\plugins\\modifier.in_array.php';
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
      <!-- <?php if (smarty_modifier_in_array('backup',$_smarty_tpl->tpl_vars['role']->value,$_smarty_tpl->tpl_vars['admin']->value)&&$_smarty_tpl->tpl_vars['elements']->value->backup==1) {?>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
backup" class="nav-link text-danger"><i class="fa fa-refresh" aria-hidden="true"></i> Sao lưu</a>
      </li>
      <?php }?> -->
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
