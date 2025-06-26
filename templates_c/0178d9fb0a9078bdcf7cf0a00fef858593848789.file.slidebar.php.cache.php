<?php /* Smarty version Smarty-3.1.16, created on 2024-01-29 08:53:56
         compiled from "C:\xampp\htdocs\application\views\slidebar.php" */ ?>
<?php /*%%SmartyHeaderCode:206816233065b45b61b71e29-38203361%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0178d9fb0a9078bdcf7cf0a00fef858593848789' => 
    array (
      0 => 'C:\\xampp\\htdocs\\application\\views\\slidebar.php',
      1 => 1706455870,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '206816233065b45b61b71e29-38203361',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_65b45b620b00b0_42036883',
  'variables' => 
  array (
    'base_url' => 0,
    'hoten' => 0,
    'machine' => 0,
    'role' => 0,
    'admin' => 0,
    'elements' => 0,
    'action' => 0,
    'menu_open' => 0,
    'machine_serial' => 0,
    'm' => 0,
    'temp' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_65b45b620b00b0_42036883')) {function content_65b45b620b00b0_42036883($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_in_array')) include 'C:\\xampp\\htdocs\\application\\third_party\\Smarty-3.1.16\\libs\\plugins\\modifier.in_array.php';
?>  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
" class="brand-link">
          <img src="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
          <span class="brand-text font-weight-light">MenTin</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
          <!-- Sidebar user panel (optional) -->
          <div class="user-panel mt-3 pb-3 mb-3 d-flex">
              <div class="image">
                  <img src="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
dist/img/user2-160x160.png" class="img-circle elevation-2" alt="User Image">
              </div>
              <div class="info">
                  <a href="#" class="d-block"><?php echo $_smarty_tpl->tpl_vars['hoten']->value;?>
</a>
              </div>
          </div>

          <!-- SidebarSearch Form -->
          <!-- <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div> -->

          <!-- Sidebar Menu -->
          <nav class="mt-2">
              <ul class="nav nav-pills nav-sidebar flex-column nav-compact text-sm nav-flat" data-widget="treeview" role="menu" data-accordion="false">
                  <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                  <?php if (count($_smarty_tpl->tpl_vars['machine']->value)>0) {?>
                  <li class="nav-header"><i class="nav-icon fas fa-chart-pie text-warning"></i> CÂN NĂNG SUẤT</li>
                  <?php }?>
                  <?php if (smarty_modifier_in_array('stat_overview',$_smarty_tpl->tpl_vars['role']->value,$_smarty_tpl->tpl_vars['admin']->value)&&$_smarty_tpl->tpl_vars['elements']->value->stat_overview==1) {?>
                  <li class="nav-item has-treeview">
                      <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
chartreport/overview" class="nav-link <?php if (($_smarty_tpl->tpl_vars['action']->value=='stat_overview')) {?>active<?php }?>">
                        <i class="nav-icon fa fa-bar-chart text-warning"></i>Tổng quan
                      </a>
                  </li>
                  <?php }?>
                  <li class="nav-item has-treeview <?php echo $_smarty_tpl->tpl_vars['menu_open']->value['general'];?>
">
                      <a href="#" class="nav-link">
                          <i class="nav-icon fa fa-file"></i>
                          <p>
                              Dữ liệu cơ bản
                              <i class="right fas fa-angle-left"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <?php if (smarty_modifier_in_array('worker',$_smarty_tpl->tpl_vars['role']->value,$_smarty_tpl->tpl_vars['admin']->value)&&$_smarty_tpl->tpl_vars['elements']->value->worker==1) {?>
                          <li class="nav-item">
                              <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
group" class="nav-link <?php if (($_smarty_tpl->tpl_vars['action']->value=='group')||($_smarty_tpl->tpl_vars['action']->value=='worker')||($_smarty_tpl->tpl_vars['action']->value=='worker_card')||($_smarty_tpl->tpl_vars['action']->value=='group_card')) {?>active<?php }?>">
                                  <i class="far fas fa-users nav-icon"></i>
                                  <p>Nhóm/Công nhân</p>
                              </a>
                          </li>
                          <?php }?>
                          <?php if (smarty_modifier_in_array('khothe',$_smarty_tpl->tpl_vars['role']->value,$_smarty_tpl->tpl_vars['admin']->value)&&$_smarty_tpl->tpl_vars['elements']->value->kho_the==1) {?>
                          <li class="nav-item">
                              <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
KhoThe" class="nav-link <?php if (($_smarty_tpl->tpl_vars['action']->value=='khothe')) {?>active<?php }?>">
                                  <i class="fa fa-credit-card nav-icon text-info"></i>
                                  <p>Kho thẻ CN</p>
                              </a>
                          </li>
                          <?php }?>
                          <?php if (smarty_modifier_in_array('congdoan',$_smarty_tpl->tpl_vars['role']->value,$_smarty_tpl->tpl_vars['admin']->value)&&$_smarty_tpl->tpl_vars['elements']->value->congdoan==1) {?>
                          <li class="nav-item">
                              <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
congdoan" class="nav-link <?php if (($_smarty_tpl->tpl_vars['action']->value=='congdoan')||($_smarty_tpl->tpl_vars['action']->value=='congdoan_card')) {?>active<?php }?>">
                                  <i class="far fas fa-users nav-icon"></i>
                                  <p>Công đoạn</p>
                              </a>
                          </li>
                          <?php }?>
                          <?php if (smarty_modifier_in_array('product',$_smarty_tpl->tpl_vars['role']->value,$_smarty_tpl->tpl_vars['admin']->value)&&$_smarty_tpl->tpl_vars['elements']->value->product==1) {?>
                          <li class="nav-item">
                              <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
product" class="nav-link <?php if (($_smarty_tpl->tpl_vars['action']->value=='product')||($_smarty_tpl->tpl_vars['action']->value=='product_card')) {?>active<?php }?>">
                                  <i class="fa fa-product-hunt nav-icon"></i>
                                  <p>Sản phẩm</p>
                              </a>
                          </li>
                          <?php }?>
                          <?php if (smarty_modifier_in_array('size',$_smarty_tpl->tpl_vars['role']->value,$_smarty_tpl->tpl_vars['admin']->value)&&$_smarty_tpl->tpl_vars['elements']->value->size==1) {?>
                          <li class="nav-item">
                              <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
size" class="nav-link <?php if (($_smarty_tpl->tpl_vars['action']->value=='size')||($_smarty_tpl->tpl_vars['action']->value=='size_card')) {?>active<?php }?>">
                                  <i class="fa fa-product-hunt nav-icon"></i>
                                  <p>Size</p>
                              </a>
                          </li>
                          <?php }?>
                          <?php if (smarty_modifier_in_array('me',$_smarty_tpl->tpl_vars['role']->value,$_smarty_tpl->tpl_vars['admin']->value)&&$_smarty_tpl->tpl_vars['elements']->value->me==1) {?>
                          <li class="nav-item">
                              <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
me" class="nav-link <?php if (($_smarty_tpl->tpl_vars['action']->value=='me')||($_smarty_tpl->tpl_vars['action']->value=='me_card')) {?>active<?php }?>">
                                  <i class="fa fa-product-hunt nav-icon"></i>
                                  <p>Mẻ</p>
                              </a>
                          </li>
                          <?php }?>
                          <?php if (smarty_modifier_in_array('coi',$_smarty_tpl->tpl_vars['role']->value,$_smarty_tpl->tpl_vars['admin']->value)&&$_smarty_tpl->tpl_vars['elements']->value->coi==1) {?>
                          <li class="nav-item">
                              <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
coi" class="nav-link <?php if (($_smarty_tpl->tpl_vars['action']->value=='coi')||($_smarty_tpl->tpl_vars['action']->value=='coi_card')) {?>active<?php }?>">
                                  <i class="fa fa-product-hunt nav-icon"></i>
                                  <p>Cối</p>
                              </a>
                          </li>
                          <?php }?>
                          <?php if (smarty_modifier_in_array('threshold',$_smarty_tpl->tpl_vars['role']->value,$_smarty_tpl->tpl_vars['admin']->value)&&$_smarty_tpl->tpl_vars['elements']->value->threshold==1) {?>
                          <li class="nav-item">
                              <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
threshold/index" class="nav-link <?php if ($_smarty_tpl->tpl_vars['action']->value=='threshold') {?>active<?php }?>">
                                  <i class="fa fa-angle-right nav-icon"></i>
                                  <p>Định mức</p>
                              </a>
                          </li>
                          <?php }?>
                          <?php if (smarty_modifier_in_array('spice',$_smarty_tpl->tpl_vars['role']->value,$_smarty_tpl->tpl_vars['admin']->value)&&$_smarty_tpl->tpl_vars['elements']->value->gia_vi==1) {?>
                          <li class="nav-item">
                              <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
spice" class="nav-link <?php if (($_smarty_tpl->tpl_vars['action']->value=='spice')||($_smarty_tpl->tpl_vars['action']->value=='spice_card')) {?>active<?php }?>">
                                  <i class="fa fa-product-hunt nav-icon"></i>
                                  <p>Gia vị </p>
                              </a>
                          </li>
                          <?php }?>
                          <?php if (smarty_modifier_in_array('recipe',$_smarty_tpl->tpl_vars['role']->value,$_smarty_tpl->tpl_vars['admin']->value)&&$_smarty_tpl->tpl_vars['elements']->value->recipe==1) {?>
                          <li class="nav-item">
                              <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
recipe" class="nav-link <?php if (($_smarty_tpl->tpl_vars['action']->value=='recipe')) {?>active<?php }?>">
                                  <i class="fa fa-product-hunt nav-icon"></i>
                                  <p>Công thức </p>
                              </a>
                          </li>
                          <?php }?>
                          <?php if (smarty_modifier_in_array('spice_program',$_smarty_tpl->tpl_vars['role']->value,$_smarty_tpl->tpl_vars['admin']->value)&&$_smarty_tpl->tpl_vars['elements']->value->spice_program==1) {?>
                          <li class="nav-item">
                              <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
spiceprogram" class="nav-link <?php if (($_smarty_tpl->tpl_vars['action']->value=='spice_program')) {?>active<?php }?>">
                                  <i class="fa fa-product-hunt nav-icon"></i>
                                  <p>Chương trình cân</p>
                              </a>
                          </li>
                          <?php }?>
                          <?php if (smarty_modifier_in_array('basket',$_smarty_tpl->tpl_vars['role']->value,$_smarty_tpl->tpl_vars['admin']->value)&&$_smarty_tpl->tpl_vars['elements']->value->basket==1) {?>
                          <li class="nav-item">
                              <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
basket" class="nav-link <?php if (($_smarty_tpl->tpl_vars['action']->value=='basket')||($_smarty_tpl->tpl_vars['action']->value=='basket_card')) {?>active<?php }?>">
                                  <i class="far fas fa-shopping-basket nav-icon"></i>
                                  <p>Rổ</p>
                              </a>
                          </li>
                          <?php }?>
                          <?php if (smarty_modifier_in_array('quycach',$_smarty_tpl->tpl_vars['role']->value,$_smarty_tpl->tpl_vars['admin']->value)&&$_smarty_tpl->tpl_vars['elements']->value->quycach==1) {?>
                          <li class="nav-item">
                              <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
quycach" class="nav-link <?php if (($_smarty_tpl->tpl_vars['action']->value=='quycach')||($_smarty_tpl->tpl_vars['action']->value=='quycach_card')) {?>active<?php }?>">
                                  <i class="far fas fa-shopping-basket nav-icon"></i>
                                  <p>Quy cách</p>
                              </a>
                          </li>
                          <?php }?>
                          <?php if (smarty_modifier_in_array('lohang',$_smarty_tpl->tpl_vars['role']->value,$_smarty_tpl->tpl_vars['admin']->value)&&$_smarty_tpl->tpl_vars['elements']->value->lohang==1) {?>
                          <li class="nav-item">
                              <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
lot" class="nav-link <?php if (($_smarty_tpl->tpl_vars['action']->value=='lohang')||($_smarty_tpl->tpl_vars['action']->value=='lohang_card')) {?>active<?php }?>">
                                  <i class="fa fa-tasks nav-icon"></i>
                                  <p>Lô hàng</p>
                              </a>
                          </li>
                          <?php }?>
                          <?php if (smarty_modifier_in_array('customer',$_smarty_tpl->tpl_vars['role']->value,$_smarty_tpl->tpl_vars['admin']->value)&&$_smarty_tpl->tpl_vars['elements']->value->customer==1) {?>
                          <li class="nav-item">
                              <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
customer" class="nav-link <?php if (($_smarty_tpl->tpl_vars['action']->value=='customer')||($_smarty_tpl->tpl_vars['action']->value=='customer_card')) {?>active<?php }?>">
                                  <i class="fa fa-tasks nav-icon"></i>
                                  <p>Khách hàng</p>
                              </a>
                          </li>
                          <?php }?>
                          <?php if (smarty_modifier_in_array('servicecard',$_smarty_tpl->tpl_vars['role']->value,$_smarty_tpl->tpl_vars['admin']->value)&&$_smarty_tpl->tpl_vars['elements']->value->servicecard==1) {?>
                          <li class="nav-item">
                              <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
servicecard" class="nav-link <?php if (($_smarty_tpl->tpl_vars['action']->value=='servicecard')||($_smarty_tpl->tpl_vars['action']->value=='servicecard_card')) {?>active<?php }?>">
                                  <i class="fa fa-credit-card nav-icon text-info"></i>
                                  <p>Thẻ dịch vụ</p>
                              </a>
                          </li>
                          <?php }?>
                          <?php if (smarty_modifier_in_array('gradersize',$_smarty_tpl->tpl_vars['role']->value,$_smarty_tpl->tpl_vars['admin']->value)&&$_smarty_tpl->tpl_vars['elements']->value->gradersize==1) {?>
                          <li class="nav-item">
                              <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
gradersize" class="nav-link <?php if (($_smarty_tpl->tpl_vars['action']->value=='gradersize')) {?>active<?php }?>">
                                  <i class="fa fa-tasks nav-icon"></i>
                                  <p>Size phân cỡ</p>
                              </a>
                          </li>
                          <?php }?>
                          <li class="nav-header">THẺ</li>
                          <?php if (smarty_modifier_in_array('minus_card',$_smarty_tpl->tpl_vars['role']->value,$_smarty_tpl->tpl_vars['admin']->value)&&$_smarty_tpl->tpl_vars['elements']->value->minus_card==1) {?>
                          <li class="nav-item">
                              <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
minuscard" class="nav-link <?php if ($_smarty_tpl->tpl_vars['action']->value=='minus_card') {?>active<?php }?>">
                                  <i class="fa fa-credit-card nav-icon"></i>
                                  <p>Thẻ trả về</p>
                              </a>
                          </li>
                          <?php }?>
                          <?php if (smarty_modifier_in_array('withdraw_card',$_smarty_tpl->tpl_vars['role']->value,$_smarty_tpl->tpl_vars['admin']->value)&&$_smarty_tpl->tpl_vars['elements']->value->withdraw_card==1) {?>
                          <li class="nav-item">
                              <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
withdrawcard" class="nav-link <?php if ($_smarty_tpl->tpl_vars['action']->value=='withdraw_card') {?>active<?php }?>">
                                  <i class="fa fa-credit-card nav-icon"></i>
                                  <p>Thẻ thu hồi</p>
                              </a>
                          </li>
                          <?php }?>
                          <?php if (smarty_modifier_in_array('card',$_smarty_tpl->tpl_vars['role']->value,$_smarty_tpl->tpl_vars['admin']->value)) {?>
                          <li class="nav-item">
                              <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
card" class="nav-link <?php if ($_smarty_tpl->tpl_vars['action']->value=='card') {?>active<?php }?>">
                                  <i class="fa fa-credit-card nav-icon text-warning"></i>
                                  <p>Thẻ từ</p>
                              </a>
                          </li>
                          <?php }?>

                      </ul>
                  </li>
                  <?php if ($_smarty_tpl->tpl_vars['elements']->value->pso_stat==1) {?>
                  <li class="nav-item has-treeview <?php echo $_smarty_tpl->tpl_vars['menu_open']->value['pso'];?>
">
                      <a href="#" class="nav-link">
                          <i class="nav-icon fas fa-chart-pie"></i>
                          <p>
                              Cân vùng nuôi
                              <i class="fas fa-angle-left right"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <?php if (smarty_modifier_in_array('pso_stat_detail',$_smarty_tpl->tpl_vars['role']->value,$_smarty_tpl->tpl_vars['admin']->value)) {?>
                          <li class="nav-item">
                              <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
pso/detail" class="nav-link <?php if ($_smarty_tpl->tpl_vars['action']->value=='pso_stat_detail') {?>active<?php }?>">
                                  <i class="fa fa-angle-right nav-icon"></i>
                                  <p>Chi tiết</p>
                              </a>
                          </li>
                          <?php }?>
                          <?php if (smarty_modifier_in_array('pso_stat_general',$_smarty_tpl->tpl_vars['role']->value,$_smarty_tpl->tpl_vars['admin']->value)) {?>
                          <li class="nav-item">
                              <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
pso/general" class="nav-link <?php if ($_smarty_tpl->tpl_vars['action']->value=='pso_stat_general') {?>active<?php }?>">
                                  <i class="fa fa-angle-right nav-icon"></i>
                                  <p>Tổng hợp</p>
                              </a>
                          </li>
                          <?php }?>

                      </ul>
                  </li>
                  <?php }?>
                  <?php if ($_smarty_tpl->tpl_vars['elements']->value->nguyen_lieu_stat==1) {?>
                  <li class="nav-item has-treeview <?php echo $_smarty_tpl->tpl_vars['menu_open']->value['nguyenlieu'];?>
">

                      <a href="#" class="nav-link">
                          <i class="nav-icon fas fa-chart-pie"></i>
                          <p>
                              Thống kê Nguyên liệu
                              <i class="fas fa-angle-left right"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <?php if (smarty_modifier_in_array('nguyenlieu_stat_chitiet',$_smarty_tpl->tpl_vars['role']->value,$_smarty_tpl->tpl_vars['admin']->value)) {?>
                          <li class="nav-item">
                              <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
nguyenlieu/chitiet" class="nav-link <?php if ($_smarty_tpl->tpl_vars['action']->value=='nguyenlieu_stat_chitiet') {?>active<?php }?>">
                                  <i class="fa fa-angle-right nav-icon"></i>
                                  <p>Chi tiết</p>
                              </a>
                          </li>
                          <?php }?>
                          <?php if (smarty_modifier_in_array('nguyenlieu_stat_product',$_smarty_tpl->tpl_vars['role']->value,$_smarty_tpl->tpl_vars['admin']->value)) {?>
                          <li class="nav-item">
                              <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
nguyenlieu/tonghop" class="nav-link <?php if ($_smarty_tpl->tpl_vars['action']->value=='nguyenlieu_stat_product') {?>active<?php }?>">
                                  <i class="fa fa-angle-right nav-icon"></i>
                                  <p>Tổng hợp</p>
                              </a>
                          </li>
                          <?php }?>

                      </ul>
                  </li>
                  <?php }?>
                  <?php if ($_smarty_tpl->tpl_vars['elements']->value->fillet_stat==1) {?>
                  <li class="nav-item has-treeview <?php echo $_smarty_tpl->tpl_vars['menu_open']->value['fillet'];?>
">
                      <a href="#" class="nav-link">
                          <i class="nav-icon fas fa-chart-pie"></i>
                          <p>
                              Thống kê Fillet
                              <i class="fas fa-angle-left right"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <?php if (smarty_modifier_in_array('stat_fillet_detail',$_smarty_tpl->tpl_vars['role']->value,$_smarty_tpl->tpl_vars['admin']->value)) {?>
                          <li class="nav-item">
                              <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
fillet/detail" class="nav-link <?php if ($_smarty_tpl->tpl_vars['action']->value=='stat_fillet_detail') {?>active<?php }?>">
                                  <i class="fa fa-angle-right nav-icon"></i>
                                  <p>Chi tiết</p>
                              </a>
                          </li>
                          <?php }?>
                          <?php if (smarty_modifier_in_array('stat_fillet_product',$_smarty_tpl->tpl_vars['role']->value,$_smarty_tpl->tpl_vars['admin']->value)) {?>
                          <li class="nav-item">
                              <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
fillet/product" class="nav-link <?php if ($_smarty_tpl->tpl_vars['action']->value=='stat_fillet_product') {?>active<?php }?>">
                                  <i class="fa fa-angle-right nav-icon"></i>
                                  <p>Theo sản phẩm</p>
                              </a>
                          </li>
                          <?php }?>

                          <?php if (smarty_modifier_in_array('stat_fillet_worker',$_smarty_tpl->tpl_vars['role']->value,$_smarty_tpl->tpl_vars['admin']->value)) {?>
                          <li class="nav-item">
                              <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
fillet/worker" class="nav-link <?php if ($_smarty_tpl->tpl_vars['action']->value=='stat_fillet_worker') {?>active<?php }?>">
                                  <i class="fa fa-angle-right nav-icon"></i>
                                  <p>Theo công nhân</p>
                              </a>
                          </li>
                          <?php }?>
                          <?php if (smarty_modifier_in_array('stat_fillet_worker_total',$_smarty_tpl->tpl_vars['role']->value,$_smarty_tpl->tpl_vars['admin']->value)) {?>
                          <li class="nav-item">
                              <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
fillet/worker_total" class="nav-link <?php if ($_smarty_tpl->tpl_vars['action']->value=='stat_fillet_worker_total') {?>active<?php }?>">
                                  <i class="fa fa-angle-right nav-icon"></i>
                                  <p>Tổng hợp</p>
                              </a>
                          </li>
                          <?php }?>
                          <?php if (smarty_modifier_in_array('stat_fillet_worker_no_input',$_smarty_tpl->tpl_vars['role']->value,$_smarty_tpl->tpl_vars['admin']->value)) {?>
                          <li class="nav-item">
                              <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
fillet/no_input" class="nav-link <?php if ($_smarty_tpl->tpl_vars['action']->value=='stat_fillet_worker_no_input') {?>active<?php }?>">
                                  <i class="fa fa-angle-right nav-icon"></i>
                                  <p>Không có đầu vào</p>
                              </a>
                          </li>
                          <?php }?>
                          <?php if (smarty_modifier_in_array('stat_fillet_worker_no_output',$_smarty_tpl->tpl_vars['role']->value,$_smarty_tpl->tpl_vars['admin']->value)) {?>
                          <li class="nav-item">
                              <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
fillet/no_output" class="nav-link <?php if ($_smarty_tpl->tpl_vars['action']->value=='stat_fillet_worker_no_output') {?>active<?php }?>">
                                  <i class="fa fa-angle-right nav-icon"></i>
                                  <p>Chưa cân đầu ra</p>
                              </a>
                          </li>
                          <?php }?>
                          <?php if (smarty_modifier_in_array('stat_fillet_overtime',$_smarty_tpl->tpl_vars['role']->value,$_smarty_tpl->tpl_vars['admin']->value)) {?>
                          <li class="nav-item">
                              <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
fillet/overtime" class="nav-link <?php if ($_smarty_tpl->tpl_vars['action']->value=='stat_fillet_overtime') {?>active<?php }?>">
                                  <i class="fa fa-angle-right nav-icon"></i>
                                  <p>Quá thời gian</p>
                              </a>
                          </li>
                          <?php }?>
                          <?php if (smarty_modifier_in_array('stat_fillet_invalid',$_smarty_tpl->tpl_vars['role']->value,$_smarty_tpl->tpl_vars['admin']->value)) {?>
                          <li class="nav-item">
                              <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
fillet/invalid" class="nav-link <?php if ($_smarty_tpl->tpl_vars['action']->value=='stat_fillet_invalid') {?>active<?php }?>">
                                  <i class="fa fa-angle-right nav-icon"></i>
                                  <p>Không hợp lệ</p>
                              </a>
                          </li>
                          <?php }?>
                          <?php if (smarty_modifier_in_array('stat_fillet_working',$_smarty_tpl->tpl_vars['role']->value,$_smarty_tpl->tpl_vars['admin']->value)) {?>
                          <li class="nav-item">
                              <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
fillet/working" class="nav-link <?php if ($_smarty_tpl->tpl_vars['action']->value=='stat_fillet_working') {?>active<?php }?>">
                                  <i class="fa fa-angle-right nav-icon"></i>
                                  <p>Đang cân</p>
                              </a>
                          </li>
                          <?php }?>
                          <?php if (smarty_modifier_in_array('stat_fillet_over_threshold',$_smarty_tpl->tpl_vars['role']->value,$_smarty_tpl->tpl_vars['admin']->value)) {?>
                          <li class="nav-item">
                              <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
fillet/over_threshold" class="nav-link <?php if ($_smarty_tpl->tpl_vars['action']->value=='stat_fillet_over_threshold') {?>active<?php }?>">
                                  <i class="fa fa-angle-right nav-icon"></i>
                                  <p>Ngoài định mức</p>
                              </a>
                          </li>
                          <?php }?>
                      </ul>
                  </li>
                  <?php }?>
                  <?php if ($_smarty_tpl->tpl_vars['elements']->value->sua_ca_stat==1) {?>
                  <li class="nav-item has-treeview <?php echo $_smarty_tpl->tpl_vars['menu_open']->value['suaca'];?>
">
                      <a href="#" class="nav-link">
                          <i class="nav-icon fas fa-chart-pie"></i>
                          <p>
                              Thống kê Sửa cá
                              <i class="fas fa-angle-left right"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <?php if (smarty_modifier_in_array('stat_suaca_detail',$_smarty_tpl->tpl_vars['role']->value,$_smarty_tpl->tpl_vars['admin']->value)) {?>
                          <li class="nav-item">
                              <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
suaca/detail" class="nav-link <?php if ($_smarty_tpl->tpl_vars['action']->value=='stat_suaca_detail') {?>active<?php }?>">
                                  <i class="fa fa-angle-right nav-icon"></i>
                                  <p>Chi tiết</p>
                              </a>
                          </li>
                          <?php }?>
                          <?php if (smarty_modifier_in_array('stat_suaca_product',$_smarty_tpl->tpl_vars['role']->value,$_smarty_tpl->tpl_vars['admin']->value)) {?>
                          <li class="nav-item">
                              <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
suaca/product" class="nav-link <?php if ($_smarty_tpl->tpl_vars['action']->value=='stat_suaca_product') {?>active<?php }?>">
                                  <i class="fa fa-angle-right nav-icon"></i>
                                  <p>Theo sản phẩm</p>
                              </a>
                          </li>
                          <?php }?>
                          <?php if (smarty_modifier_in_array('stat_suaca_worker',$_smarty_tpl->tpl_vars['role']->value,$_smarty_tpl->tpl_vars['admin']->value)) {?>
                          <li class="nav-item">
                              <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
suaca/worker" class="nav-link <?php if ($_smarty_tpl->tpl_vars['action']->value=='stat_suaca_worker') {?>active<?php }?>">
                                  <i class="fa fa-angle-right nav-icon"></i>
                                  <p>Theo công nhân</p>
                              </a>
                          </li>
                          <?php }?>
                          <?php if (smarty_modifier_in_array('stat_suaca_worker_total',$_smarty_tpl->tpl_vars['role']->value,$_smarty_tpl->tpl_vars['admin']->value)) {?>
                          <li class="nav-item">
                              <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
suaca/worker_total" class="nav-link <?php if ($_smarty_tpl->tpl_vars['action']->value=='stat_suaca_worker_total') {?>active<?php }?>">
                                  <i class="fa fa-angle-right nav-icon"></i>
                                  <p>Tổng hợp</p>
                              </a>
                          </li>
                          <?php }?>
                          <!-- <?php if (smarty_modifier_in_array('suaca_threshold',$_smarty_tpl->tpl_vars['role']->value,$_smarty_tpl->tpl_vars['admin']->value)) {?>
                          <li class="nav-item">
                              <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
threshold/suaca_read" class="nav-link <?php if ($_smarty_tpl->tpl_vars['action']->value=='suaca_threshold') {?>active<?php }?>">
                                  <i class="fa fa-angle-right nav-icon"></i>
                                  <p>Định mức chuẩn</p>
                              </a>
                          </li>
                          <?php }?> -->
                          <?php if (smarty_modifier_in_array('stat_suaca_qcworker_detail',$_smarty_tpl->tpl_vars['role']->value,$_smarty_tpl->tpl_vars['admin']->value)) {?>
                          <li class="nav-item">
                              <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
suaca/qcworker_detail" class="nav-link <?php if ($_smarty_tpl->tpl_vars['action']->value=='stat_suaca_qcworker_detail') {?>active<?php }?>">
                                  <i class="fa fa-angle-right nav-icon"></i>
                                  <p>Kiểm chi tiết</p>
                              </a>
                          </li>
                          <?php }?>
                          <?php if (smarty_modifier_in_array('stat_suaca_qcworker_general',$_smarty_tpl->tpl_vars['role']->value,$_smarty_tpl->tpl_vars['admin']->value)) {?>
                          <li class="nav-item">
                              <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
suaca/qcworker_general" class="nav-link <?php if ($_smarty_tpl->tpl_vars['action']->value=='stat_suaca_qcworker_general') {?>active<?php }?>">
                                  <i class="fa fa-angle-right nav-icon"></i>
                                  <p>Kiểm tổng hợp</p>
                              </a>
                          </li>
                          <?php }?>
                          <?php if (smarty_modifier_in_array('stat_suaca_worker_no_input',$_smarty_tpl->tpl_vars['role']->value,$_smarty_tpl->tpl_vars['admin']->value)) {?>
                          <li class="nav-item">
                              <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
suaca/no_input" class="nav-link <?php if ($_smarty_tpl->tpl_vars['action']->value=='stat_suaca_worker_no_input') {?>active<?php }?>">
                                  <i class="fa fa-angle-right nav-icon"></i>
                                  <p>Không có đầu vào</p>
                              </a>
                          </li>
                          <?php }?>
                          <?php if (smarty_modifier_in_array('stat_suaca_worker_no_output',$_smarty_tpl->tpl_vars['role']->value,$_smarty_tpl->tpl_vars['admin']->value)) {?>
                          <li class="nav-item">
                              <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
suaca/no_output" class="nav-link <?php if ($_smarty_tpl->tpl_vars['action']->value=='stat_suaca_worker_no_output') {?>active<?php }?>">
                                  <i class="fa fa-angle-right nav-icon"></i>
                                  <p>Chưa cân đầu ra</p>
                              </a>
                          </li>
                          <?php }?>
                          <?php if (smarty_modifier_in_array('stat_suaca_overtime',$_smarty_tpl->tpl_vars['role']->value,$_smarty_tpl->tpl_vars['admin']->value)) {?>
                          <li class="nav-item">
                              <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
suaca/overtime" class="nav-link <?php if ($_smarty_tpl->tpl_vars['action']->value=='stat_suaca_overtime') {?>active<?php }?>">
                                  <i class="fa fa-angle-right nav-icon"></i>
                                  <p>Quá thời gian</p>
                              </a>
                          </li>
                          <?php }?>
                          <?php if (smarty_modifier_in_array('stat_suaca_invalid',$_smarty_tpl->tpl_vars['role']->value,$_smarty_tpl->tpl_vars['admin']->value)) {?>
                          <li class="nav-item">
                              <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
suaca/invalid" class="nav-link <?php if ($_smarty_tpl->tpl_vars['action']->value=='stat_suaca_invalid') {?>active<?php }?>">
                                  <i class="fa fa-angle-right nav-icon"></i>
                                  <p>Không hợp lệ</p>
                              </a>
                          </li>
                          <?php }?>
                          <?php if (smarty_modifier_in_array('stat_suaca_over_threshold',$_smarty_tpl->tpl_vars['role']->value,$_smarty_tpl->tpl_vars['admin']->value)) {?>
                          <li class="nav-item">
                              <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
suaca/over_threshold" class="nav-link <?php if ($_smarty_tpl->tpl_vars['action']->value=='stat_suaca_over_threshold') {?>active<?php }?>">
                                  <i class="fa fa-angle-right nav-icon"></i>
                                  <p>Ngoài định mức</p>
                              </a>
                          </li>
                          <?php }?>
                          <?php if (smarty_modifier_in_array('stat_suaca_skinmachine',$_smarty_tpl->tpl_vars['role']->value,$_smarty_tpl->tpl_vars['admin']->value)) {?>
                          <li class="nav-item">
                              <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
suaca/skinmachine" class="nav-link <?php if ($_smarty_tpl->tpl_vars['action']->value=='stat_suaca_skinmachine') {?>active<?php }?>">
                                  <i class="fa fa-angle-right nav-icon"></i>
                                  <p>Máy lạn da</p>
                              </a>
                          </li>
                          <?php }?>
                          <?php if (smarty_modifier_in_array('stat_suaca_worker_for_view',$_smarty_tpl->tpl_vars['role']->value,$_smarty_tpl->tpl_vars['admin']->value)) {?>
                          <li class="nav-item">
                              <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
suaca/workerforview" class="nav-link <?php if ($_smarty_tpl->tpl_vars['action']->value=='stat_suaca_worker_for_view') {?>active<?php }?>">
                                  <i class="fa fa-angle-right nav-icon"></i>
                                  <p>Xem năng suất</p>
                              </a>
                          </li>
                          <?php }?>
                          <?php if (smarty_modifier_in_array('stat_suaca_working',$_smarty_tpl->tpl_vars['role']->value,$_smarty_tpl->tpl_vars['admin']->value)) {?>
                          <li class="nav-item">
                              <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
suaca/working" class="nav-link <?php if ($_smarty_tpl->tpl_vars['action']->value=='stat_suaca_working') {?>active<?php }?>">
                                  <i class="fa fa-angle-right nav-icon"></i>
                                  <p>Đang cân</p>
                              </a>
                          </li>
                          <?php }?>
                          <!-- <?php if (smarty_modifier_in_array('edit_phieucan',$_smarty_tpl->tpl_vars['role']->value,$_smarty_tpl->tpl_vars['admin']->value)) {?>
                          <li class="nav-item">
                              <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
suaca/phieucan" class="nav-link <?php if ($_smarty_tpl->tpl_vars['action']->value=='edit_phieucan') {?>active<?php }?>">
                                  <i class="fa fa-angle-right nav-icon"></i>
                                  <p>Điều chỉnh phiếu cân</p>
                              </a>
                          </li>
                          <?php }?> -->
                      </ul>
                  </li>
                  <?php }?>
                  <li class="nav-item has-treeview <?php echo $_smarty_tpl->tpl_vars['menu_open']->value['xebuom'];?>
">

                      <a href="#" class="nav-link">
                          <i class="nav-icon fas fa-chart-pie"></i>
                          <p>
                              Thống kê Xẻ bướm
                              <i class="fas fa-angle-left right"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <?php if (smarty_modifier_in_array('stat_xebuom_detailin',$_smarty_tpl->tpl_vars['role']->value,$_smarty_tpl->tpl_vars['admin']->value)) {?>
                          <li class="nav-item">
                              <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
xebuom/detailin" class="nav-link <?php if ($_smarty_tpl->tpl_vars['action']->value=='stat_xebuom_detailin') {?>active<?php }?>">
                                  <i class="fa fa-angle-right nav-icon"></i>
                                  <p>Chi tiết vào</p>
                              </a>
                          </li>
                          <?php }?>
                          <?php if (smarty_modifier_in_array('stat_xebuom_detailout',$_smarty_tpl->tpl_vars['role']->value,$_smarty_tpl->tpl_vars['admin']->value)) {?>
                          <li class="nav-item">
                              <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
xebuom/detailout" class="nav-link <?php if ($_smarty_tpl->tpl_vars['action']->value=='stat_xebuom_detailout') {?>active<?php }?>">
                                  <i class="fa fa-angle-right nav-icon"></i>
                                  <p>Chi tiết ra</p>
                              </a>
                          </li>
                          <?php }?>
                          <?php if (smarty_modifier_in_array('stat_xebuom_product',$_smarty_tpl->tpl_vars['role']->value,$_smarty_tpl->tpl_vars['admin']->value)) {?>
                          <li class="nav-item">
                              <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
xebuom/product" class="nav-link <?php if ($_smarty_tpl->tpl_vars['action']->value=='stat_xebuom_product') {?>active<?php }?>">
                                  <i class="fa fa-angle-right nav-icon"></i>
                                  <p>Sản phẩm</p>
                              </a>
                          </li>
                          <?php }?>
                          <?php if (smarty_modifier_in_array('stat_xebuom_worker',$_smarty_tpl->tpl_vars['role']->value,$_smarty_tpl->tpl_vars['admin']->value)) {?>
                          <li class="nav-item">
                              <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
xebuom/worker" class="nav-link <?php if ($_smarty_tpl->tpl_vars['action']->value=='stat_xebuom_worker') {?>active<?php }?>">
                                  <i class="fa fa-angle-right nav-icon"></i>
                                  <p>Công nhân</p>
                              </a>
                          </li>
                          <?php }?>
                      </ul>
                  </li>
                  <?php if ($_smarty_tpl->tpl_vars['elements']->value->weightgain_stat==1) {?>
                  <li class="nav-item has-treeview <?php echo $_smarty_tpl->tpl_vars['menu_open']->value['weightgain'];?>
">
                      <a href="#" class="nav-link">
                          <i class="nav-icon fas fa-chart-pie"></i>
                          <p>
                              Tăng trọng
                              <i class="fas fa-angle-left right"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <?php if (smarty_modifier_in_array('saukiem_stat_chitiet',$_smarty_tpl->tpl_vars['role']->value,$_smarty_tpl->tpl_vars['admin']->value)) {?>
                          <li class="nav-item">
                              <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
saukiem/chitiet" class="nav-link <?php if ($_smarty_tpl->tpl_vars['action']->value=='saukiem_stat_chitiet') {?>active<?php }?>">
                                  <i class="fa fa-angle-right nav-icon"></i>
                                  <p>Chi tiết</p>
                              </a>
                          </li>
                          <?php }?>
                          <?php if (smarty_modifier_in_array('saukiem_stat_product',$_smarty_tpl->tpl_vars['role']->value,$_smarty_tpl->tpl_vars['admin']->value)) {?>
                          <li class="nav-item">
                              <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
saukiem/tonghop" class="nav-link <?php if ($_smarty_tpl->tpl_vars['action']->value=='saukiem_stat_product') {?>active<?php }?>">
                                  <i class="fa fa-angle-right nav-icon"></i>
                                  <p>Tổng hợp</p>
                              </a>
                          </li>
                          <?php }?>
                          <?php if (smarty_modifier_in_array('stat_weightgain_general',$_smarty_tpl->tpl_vars['role']->value,$_smarty_tpl->tpl_vars['admin']->value)) {?>
                          <li class="nav-item">
                              <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
weightgain/htpweightgain" class="nav-link <?php if ($_smarty_tpl->tpl_vars['action']->value=='stat_weightgain_general') {?>active<?php }?>">
                                  <i class="fa fa-angle-right nav-icon"></i>
                                  <p>Tăng trọng</p>
                              </a>
                          </li>
                          <?php }?>
                      </ul>
                  </li>
                  <?php }?>
                  <?php if ($_smarty_tpl->tpl_vars['elements']->value->phu_pham_stat==1) {?>
                  <li class="nav-item has-treeview <?php echo $_smarty_tpl->tpl_vars['menu_open']->value['phupham'];?>
">
                      <a href="#" class="nav-link">
                          <i class="nav-icon fas fa-chart-pie"></i>
                          <p>
                              Phụ phẩm
                              <i class="fas fa-angle-left right"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <?php if (smarty_modifier_in_array('phu_pham_stat_detail',$_smarty_tpl->tpl_vars['role']->value,$_smarty_tpl->tpl_vars['admin']->value)) {?>
                          <li class="nav-item">
                              <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
phupham2/detail" class="nav-link <?php if ($_smarty_tpl->tpl_vars['action']->value=='phu_pham_stat_detail') {?>active<?php }?>">
                                  <i class="fa fa-angle-right nav-icon"></i>
                                  <p>Chi tiết</p>
                              </a>
                          </li>
                          <?php }?>
                          <?php if (smarty_modifier_in_array('phu_pham_stat_general',$_smarty_tpl->tpl_vars['role']->value,$_smarty_tpl->tpl_vars['admin']->value)) {?>
                          <li class="nav-item">
                              <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
phupham2/general" class="nav-link <?php if ($_smarty_tpl->tpl_vars['action']->value=='phu_pham_stat_general') {?>active<?php }?>">
                                  <i class="fa fa-angle-right nav-icon"></i>
                                  <p>Tổng hợp</p>
                              </a>
                          </li>
                          <?php }?>

                      </ul>
                  </li>
                  <?php }?>
                  <?php if ($_smarty_tpl->tpl_vars['elements']->value->spice_stat==1) {?>
                  <li class="nav-item has-treeview <?php echo $_smarty_tpl->tpl_vars['menu_open']->value['spice'];?>
">
                      <a href="#" class="nav-link">
                          <i class="nav-icon fas fa-chart-pie"></i>
                          <p>
                              Thống kê gia vị
                              <i class="fas fa-angle-left right"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <?php if (smarty_modifier_in_array('recipe_history',$_smarty_tpl->tpl_vars['role']->value,$_smarty_tpl->tpl_vars['admin']->value)) {?>
                          <li class="nav-item">
                              <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
recipe/history" class="nav-link <?php if ($_smarty_tpl->tpl_vars['action']->value=='recipe_history') {?>active<?php }?>">
                                  <i class="fa fa-angle-right nav-icon"></i>
                                  <p>Lịch sử công thức</p>
                              </a>
                          </li>
                          <?php }?>
                          <?php if (smarty_modifier_in_array('spice_stat_detail',$_smarty_tpl->tpl_vars['role']->value,$_smarty_tpl->tpl_vars['admin']->value)) {?>
                          <li class="nav-item">
                              <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
spice/detail" class="nav-link <?php if ($_smarty_tpl->tpl_vars['action']->value=='spice_stat_detail') {?>active<?php }?>">
                                  <i class="fa fa-angle-right nav-icon"></i>
                                  <p>Chi tiết</p>
                              </a>
                          </li>
                          <?php }?>
                          <?php if (smarty_modifier_in_array('spice_stat_general',$_smarty_tpl->tpl_vars['role']->value,$_smarty_tpl->tpl_vars['admin']->value)) {?>
                          <li class="nav-item">
                              <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
spice/general" class="nav-link <?php if ($_smarty_tpl->tpl_vars['action']->value=='spice_stat_general') {?>active<?php }?>">
                                  <i class="fa fa-angle-right nav-icon"></i>
                                  <p>Tổng hợp</p>
                              </a>
                          </li>
                          <?php }?>

                      </ul>
                  </li>
                  <?php }?>
                  <li class="nav-item has-treeview <?php echo $_smarty_tpl->tpl_vars['menu_open']->value['warehouse'];?>
">
                      <a href="#" class="nav-link">
                          <i class="nav-icon fas fa-chart-pie"></i>
                          <p>
                              Kho
                              <i class="fas fa-angle-left right"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <?php if (smarty_modifier_in_array('warehouse_infor',$_smarty_tpl->tpl_vars['role']->value,$_smarty_tpl->tpl_vars['admin']->value)) {?>
                          <li class="nav-item">
                              <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
warehouse/infor" class="nav-link <?php if ($_smarty_tpl->tpl_vars['action']->value=='warehouse_infor') {?>active<?php }?>">
                                  <i class="fa fa-angle-right nav-icon"></i>
                                  <p>Lập mã kho</p>
                              </a>
                          </li>
                          <?php }?>
                      </ul>
                      <ul class="nav nav-treeview">
                          <?php if (smarty_modifier_in_array('warehouse_reason_out',$_smarty_tpl->tpl_vars['role']->value,$_smarty_tpl->tpl_vars['admin']->value)) {?>
                          <li class="nav-item">
                              <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
warehouse/reason_out" class="nav-link <?php if ($_smarty_tpl->tpl_vars['action']->value=='warehouse_reason_out') {?>active<?php }?>">
                                  <i class="fa fa-angle-right nav-icon"></i>
                                  <p>Tạo lý do xuất</p>
                              </a>
                          </li>
                          <?php }?>
                      </ul>
                      <ul class="nav nav-treeview">
                          <?php if (smarty_modifier_in_array('warehouse_out',$_smarty_tpl->tpl_vars['role']->value,$_smarty_tpl->tpl_vars['admin']->value)) {?>
                          <li class="nav-item">
                              <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
warehouse/out" class="nav-link <?php if ($_smarty_tpl->tpl_vars['action']->value=='warehouse_out') {?>active<?php }?>">
                                  <i class="fa fa-angle-right nav-icon"></i>
                                  <p>Xuất kho</p>
                              </a>
                          </li>
                          <?php }?>
                      </ul>
                      <ul class="nav nav-treeview">
                          <?php if (smarty_modifier_in_array('warehouse_inventory',$_smarty_tpl->tpl_vars['role']->value,$_smarty_tpl->tpl_vars['admin']->value)) {?>
                          <li class="nav-item">
                              <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
warehouse/inventory" class="nav-link <?php if ($_smarty_tpl->tpl_vars['action']->value=='warehouse_inventory') {?>active<?php }?>">
                                  <i class="fa fa-angle-right nav-icon"></i>
                                  <p>Tồn kho</p>
                              </a>
                          </li>
                          <?php }?>
                      </ul>
                      <ul class="nav nav-treeview">
                          <?php if (smarty_modifier_in_array('warehouse_in_history',$_smarty_tpl->tpl_vars['role']->value,$_smarty_tpl->tpl_vars['admin']->value)) {?>
                          <li class="nav-item">
                              <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
warehouse/inhistory" class="nav-link <?php if ($_smarty_tpl->tpl_vars['action']->value=='warehouse_in_history') {?>active<?php }?>">
                                  <i class="fa fa-angle-right nav-icon"></i>
                                  <p>Lịch sử nhập</p>
                              </a>
                          </li>
                          <?php }?>
                      </ul>
                      <ul class="nav nav-treeview">
                          <?php if (smarty_modifier_in_array('warehouse_out_history',$_smarty_tpl->tpl_vars['role']->value,$_smarty_tpl->tpl_vars['admin']->value)) {?>
                          <li class="nav-item">
                              <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
warehouse/outhistory" class="nav-link <?php if ($_smarty_tpl->tpl_vars['action']->value=='warehouse_out_history') {?>active<?php }?>">
                                  <i class="fa fa-angle-right nav-icon"></i>
                                  <p>Lịch sử xuất</p>
                              </a>
                          </li>
                          <?php }?>
                      </ul>
                  </li>
                  <li class="nav-item has-treeview <?php echo $_smarty_tpl->tpl_vars['menu_open']->value['errorlog'];?>
">
                      <a href="#" class="nav-link">
                          <i class="nav-icon fas fa-chart-pie"></i>
                          <p>
                              Thao tác lỗi
                              <i class="fas fa-angle-left right"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <?php if (smarty_modifier_in_array('errorlog_stat_detail',$_smarty_tpl->tpl_vars['role']->value,$_smarty_tpl->tpl_vars['admin']->value)) {?>
                          <li class="nav-item">
                              <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
errorlog/detail" class="nav-link <?php if ($_smarty_tpl->tpl_vars['action']->value=='errorlog_stat_detail') {?>active<?php }?>">
                                  <i class="fa fa-angle-right nav-icon"></i>
                                  <p>Chi tiết</p>
                              </a>
                          </li>
                          <?php }?>
                          <?php if (smarty_modifier_in_array('errorlog_stat_general',$_smarty_tpl->tpl_vars['role']->value,$_smarty_tpl->tpl_vars['admin']->value)) {?>
                          <li class="nav-item">
                              <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
errorlog/general" class="nav-link <?php if ($_smarty_tpl->tpl_vars['action']->value=='errorlog_stat_general') {?>active<?php }?>">
                                  <i class="fa fa-angle-right nav-icon"></i>
                                  <p>Tổng hợp</p>
                              </a>
                          </li>
                          <?php }?>

                      </ul>
                  </li>
                  <?php if ($_smarty_tpl->tpl_vars['elements']->value->other_device==1) {?>
                  <?php if (count($_smarty_tpl->tpl_vars['machine']->value)>0) {?>
                  <li class="nav-header"><i class="nav-icon fas fa-chart-pie text-warning"></i> THIẾT BỊ KHÁC</li>
                  <?php $_smarty_tpl->tpl_vars['temp'] = new Smarty_variable('stat_machine', null, 0);?>
                  <?php $_smarty_tpl->tpl_vars['temp2'] = new Smarty_variable($_smarty_tpl->tpl_vars['machine_serial']->value, null, 0);?>
                  <?php  $_smarty_tpl->tpl_vars['m'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['m']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['machine']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['m']->key => $_smarty_tpl->tpl_vars['m']->value) {
$_smarty_tpl->tpl_vars['m']->_loop = true;
?>
                  <?php if (smarty_modifier_in_array($_smarty_tpl->tpl_vars['m']->value->machine_code,$_smarty_tpl->tpl_vars['role']->value,$_smarty_tpl->tpl_vars['admin']->value)) {?>
                  <li class="nav-item">
                      <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
machine/index/<?php echo $_smarty_tpl->tpl_vars['m']->value->machine_code;?>
/<?php echo $_smarty_tpl->tpl_vars['m']->value->machine_serial;?>
" class="nav-link <?php if (($_smarty_tpl->tpl_vars['action']->value).($_smarty_tpl->tpl_vars['machine_serial']->value)==($_smarty_tpl->tpl_vars['temp']->value).($_smarty_tpl->tpl_vars['m']->value->machine_serial)) {?>active<?php }?>">
                          <i class="fa fa-angle-right nav-icon"></i>
                          <p><?php echo $_smarty_tpl->tpl_vars['m']->value->machine_name;?>
</p>
                      </a>
                  </li>
                  <?php }?>
                  <?php } ?>
                  <?php }?>
                  <?php }?>
                  <!-- <li class="nav-item has-treeview <?php echo $_smarty_tpl->tpl_vars['menu_open']->value['machine'];?>
">
                      <a href="#" class="nav-link active">
                          <i class="nav-icon fa fa-file"></i>
                          <p>
                              Thiết bị khác
                              <i class="fas fa-angle-left right"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <?php $_smarty_tpl->tpl_vars['temp'] = new Smarty_variable('stat_machine', null, 0);?>
                          <?php $_smarty_tpl->tpl_vars['temp2'] = new Smarty_variable($_smarty_tpl->tpl_vars['machine_serial']->value, null, 0);?>
                          <?php  $_smarty_tpl->tpl_vars['m'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['m']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['machine']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['m']->key => $_smarty_tpl->tpl_vars['m']->value) {
$_smarty_tpl->tpl_vars['m']->_loop = true;
?>
                          <li class="nav-item">
                              <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
machine/index/<?php echo $_smarty_tpl->tpl_vars['m']->value->machine_code;?>
/<?php echo $_smarty_tpl->tpl_vars['m']->value->machine_serial;?>
" class="nav-link <?php if (($_smarty_tpl->tpl_vars['action']->value).($_smarty_tpl->tpl_vars['machine_serial']->value)==($_smarty_tpl->tpl_vars['temp']->value).($_smarty_tpl->tpl_vars['m']->value->machine_serial)) {?>active<?php }?>">
                                  <i class="fa fa-angle-right nav-icon"></i>
                                  <p><?php echo $_smarty_tpl->tpl_vars['m']->value->machine_name;?>
</p>
                              </a>
                          </li>
                          <?php } ?>
                      </ul>
                  </li> -->
                  <li class="nav-item has-treeview <?php echo $_smarty_tpl->tpl_vars['menu_open']->value['user'];?>
">
                      <a href="#" class="nav-link">
                          <i class="nav-icon fas fa-user-secret"></i>
                          <p>
                              Tài khoản
                              <i class="fas fa-angle-left right"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="#" data-toggle="modal" data-target="#changepassword" class="nav-link">
                                  <i class="fa fa-angle-right nav-icon"></i>
                                  <p>Đổi mật khẩu</p>
                              </a>
                          </li>
                          <?php if ($_smarty_tpl->tpl_vars['admin']->value==99) {?>
                          <li class="nav-item">
                              <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
elements" class="nav-link <?php if ($_smarty_tpl->tpl_vars['action']->value=='elements') {?>active<?php }?>">
                                  <i class="fa fa-angle-right nav-icon"></i>
                                  <p>Danh sách chức năng</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
role" class="nav-link <?php if ($_smarty_tpl->tpl_vars['action']->value=='role') {?>active<?php }?>">
                                  <i class="fa fa-angle-right nav-icon"></i>
                                  <p>Danh sách quyền</p>
                              </a>
                          </li>
                          <?php if (($_smarty_tpl->tpl_vars['admin']->value==1)||($_smarty_tpl->tpl_vars['admin']->value==99)) {?>
                          <li class="nav-item">
                              <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
worker/view_cn_nghi" class="nav-link <?php if ($_smarty_tpl->tpl_vars['action']->value=='worker_nghi') {?>active<?php }?>">
                                  <i class="fa fa-angle-right nav-icon"></i>
                                  <p>DS công nhân nghỉ</p>
                              </a>
                          </li>
                          <?php }?>
                          <li class="nav-item">
                              <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
machine/manager" class="nav-link <?php if ($_smarty_tpl->tpl_vars['action']->value=='machine_manager') {?>active<?php }?>">
                                  <i class="fa fa-angle-right nav-icon"></i>
                                  <p>Thêm thiết bị</p>
                              </a>
                          </li>
                          <?php }?>
                          <?php if (($_smarty_tpl->tpl_vars['admin']->value==1)||($_smarty_tpl->tpl_vars['admin']->value==99)) {?>
                          <li class="nav-item">
                              <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
user/permission" class="nav-link <?php if ($_smarty_tpl->tpl_vars['action']->value=='permission') {?>active<?php }?>">
                                  <i class="fa fa-angle-right nav-icon"></i>
                                  <p>Phân quyền</p>
                              </a>
                          </li>
                          <?php }?>

                          <li class="nav-item">
                              <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
user/logout" class="nav-link">
                                  <i class="fa fa-power-off nav-icon"></i>
                                  <p>Đăng xuất</p>
                              </a>
                          </li>
                      </ul>
                  </li>

              </ul>
          </nav>
          <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
  </aside>
  <div class="modal fade" id="changepassword">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <h4 class="modal-title">Đổi mật khẩu</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <form class="form-horizontal" method="post" name="updateproduct" action="">
                  <div class="modal-body">
                      <div class="form-group">
                          <div class="input-group">
                              <div class="input-group-prepend">
                                  <span class="input-group-text">Mật khẩu cũ</span>
                              </div>
                              <input type="password" class="form-control float-right" name="oldpass" id="oldpass">
                          </div>
                          <div id="mes" class="text-danger"></div>
                      </div>

                      <div class="form-group">
                          <div class="input-group">
                              <div class="input-group-prepend">
                                  <span class="input-group-text">Mật khẩu mới</span>
                              </div>
                              <input type="password" class="form-control float-right" name="newpass" id="newpass">
                          </div>
                      </div>
                      <div class="form-group">
                          <div class="input-group">
                              <div class="input-group-prepend">
                                  <span class="input-group-text">Nhập lại MK mới</span>
                              </div>
                              <input type="password" class="form-control float-right" name="confirmpass" id="confirmpass">
                          </div>
                          <div id="alert" class="text-danger">Mật khẩu mới phải có tối thiểu 6 ký tự <br>Và xác nhận
                              mật khẩu trùng khớp nhau</div>
                      </div>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Đóng</button>
                      <button type="button" class="btn btn-primary btn-sm" id="capnhat">Cập nhật</button>
                  </div>
              </form>
          </div>
          <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
  </div>
  <script type="text/javascript">
      $(document).ready(function() {
          $("#alert").hide();
      });
      $("#capnhat").click(function() {

          /*$("#alert").hide();
          $( "#mes" ).html("");*/
          $("#alert").hide();
          if (($("#confirmpass").val() != $("#newpass").val()) || ($("#newpass").val().length < 6)) {
              $("#alert").show("fast");
              return false;
          } else {
              $("#mes").html("");
              $.post("<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
user/changepassword", {
                      oldpass: $('#oldpass').val(),
                      newpass: $("#newpass").val()
                  },
                  function(data, status) {
                      $("#mes").html(data);
                  }
              );
          }
      });

      $("#doimatkhau").click(function() {

          $("#alert").hide();
          $("#mes").html("");
      });
  </script><?php }} ?>
