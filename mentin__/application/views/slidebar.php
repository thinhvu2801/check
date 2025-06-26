  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="{$base_url}" class="brand-link">
          <img src="{$base_url}dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
          <span class="brand-text font-weight-light">MenTin</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
          <!-- Sidebar user panel (optional) -->
          <div class="user-panel mt-3 pb-3 mb-3 d-flex">
              <div class="image">
                  <img src="{$base_url}dist/img/user2-160x160.png" class="img-circle elevation-2" alt="User Image">
              </div>
              <div class="info">
                  <a href="#" class="d-block">{$hoten}</a>
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
                  {if count($machine)>0}
                  <li class="nav-header"><i class="nav-icon fas fa-chart-pie text-warning"></i> CÂN NĂNG SUẤT</li>
                  {/if}
                  {if 'stat_overview'|in_array:$role:$admin and $elements->stat_overview eq 1}
                  <li class="nav-item has-treeview">
                      <a href="{$base_url}chartreport/overview" class="nav-link {if ($action eq 'stat_overview')}active{/if}">
                        <i class="nav-icon fa fa-bar-chart text-warning"></i>Tổng quan
                      </a>
                  </li>
                  {/if}
                  <li class="nav-item has-treeview {$menu_open.general}">
                      <a href="#" class="nav-link">
                          <i class="nav-icon fa fa-file"></i>
                          <p>
                              Dữ liệu cơ bản
                              <i class="right fas fa-angle-left"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          {if 'worker'|in_array:$role:$admin and $elements->worker eq 1}
                          <li class="nav-item">
                              <a href="{$base_url}group" class="nav-link {if ($action eq 'group') or ($action eq 'worker') or ($action eq 'worker_card') or ($action eq 'group_card')}active{/if}">
                                  <i class="far fas fa-users nav-icon"></i>
                                  <p>Nhóm/Công nhân</p>
                              </a>
                          </li>
                          {/if}
                          {if 'product'|in_array:$role:$admin and $elements->product eq 1}
                          <li class="nav-item">
                              <a href="{$base_url}product" class="nav-link {if ($action eq 'product') or ($action eq 'product_card')}active{/if}">
                                  <i class="fa fa-product-hunt nav-icon"></i>
                                  <p>Sản phẩm</p>
                              </a>
                          </li>
                          {/if}
                          {if 'size'|in_array:$role:$admin and $elements->size eq 1}
                          <li class="nav-item">
                              <a href="{$base_url}size" class="nav-link {if ($action eq 'size') or ($action eq 'size_card')}active{/if}">
                                  <i class="fa fa-product-hunt nav-icon"></i>
                                  <p>Size</p>
                              </a>
                          </li>
                          {/if}
                          {if 'me'|in_array:$role:$admin and $elements->me eq 1}
                          <li class="nav-item">
                              <a href="{$base_url}me" class="nav-link {if ($action eq 'me') or ($action eq 'me_card')}active{/if}">
                                  <i class="fa fa-product-hunt nav-icon"></i>
                                  <p>Mẻ</p>
                              </a>
                          </li>
                          {/if}
                          {if 'threshold'|in_array:$role:$admin and $elements->threshold eq 1}
                          <li class="nav-item">
                              <a href="{$base_url}threshold/index" class="nav-link {if $action eq 'threshold'}active{/if}">
                                  <i class="fa fa-angle-right nav-icon"></i>
                                  <p>Định mức</p>
                              </a>
                          </li>
                          {/if}
                          {if 'spice'|in_array:$role:$admin and $elements->gia_vi eq 1}
                          <li class="nav-item">
                              <a href="{$base_url}spice" class="nav-link {if ($action eq 'spice') or ($action eq 'spice_card')}active{/if}">
                                  <i class="fa fa-product-hunt nav-icon"></i>
                                  <p>Gia vị </p>
                              </a>
                          </li>
                          {/if}
                          {if 'recipe'|in_array:$role:$admin and $elements->recipe eq 1}
                          <li class="nav-item">
                              <a href="{$base_url}recipe" class="nav-link {if ($action eq 'recipe')}active{/if}">
                                  <i class="fa fa-product-hunt nav-icon"></i>
                                  <p>Công thức </p>
                              </a>
                          </li>
                          {/if}
                          {if 'spice_program'|in_array:$role:$admin and $elements->spice_program eq 1}
                          <li class="nav-item">
                              <a href="{$base_url}spiceprogram" class="nav-link {if ($action eq 'spice_program')}active{/if}">
                                  <i class="fa fa-product-hunt nav-icon"></i>
                                  <p>Chương trình cân</p>
                              </a>
                          </li>
                          {/if}
                          {if 'basket'|in_array:$role:$admin and $elements->basket eq 1}
                          <li class="nav-item">
                              <a href="{$base_url}basket" class="nav-link {if ($action eq 'basket') or ($action eq 'basket_card')}active{/if}">
                                  <i class="far fas fa-shopping-basket nav-icon"></i>
                                  <p>Rổ</p>
                              </a>
                          </li>
                          {/if}
                          {if 'lohang'|in_array:$role:$admin and $elements->lohang eq 1}
                          <li class="nav-item">
                              <a href="{$base_url}lot" class="nav-link {if ($action eq 'lohang') or ($action eq 'lohang_card')}active{/if}">
                                  <i class="fa fa-tasks nav-icon"></i>
                                  <p>Lô hàng</p>
                              </a>
                          </li>
                          {/if}
                          {if 'customer'|in_array:$role:$admin and $elements->customer eq 1}
                          <li class="nav-item">
                              <a href="{$base_url}customer" class="nav-link {if ($action eq 'customer') or ($action eq 'customer_card')}active{/if}">
                                  <i class="fa fa-tasks nav-icon"></i>
                                  <p>Khách hàng</p>
                              </a>
                          </li>
                          {/if}
                          {if 'servicecard'|in_array:$role:$admin and $elements->servicecard eq 1}
                          <li class="nav-item">
                              <a href="{$base_url}servicecard" class="nav-link {if ($action eq 'servicecard') or ($action eq 'servicecard_card')}active{/if}">
                                  <i class="fa fa-credit-card nav-icon text-info"></i>
                                  <p>Thẻ dịch vụ</p>
                              </a>
                          </li>
                          {/if}
                          {if 'gradersize'|in_array:$role:$admin and $elements->gradersize eq 1}
                          <li class="nav-item">
                              <a href="{$base_url}gradersize" class="nav-link {if ($action eq 'gradersize')}active{/if}">
                                  <i class="fa fa-tasks nav-icon"></i>
                                  <p>Size phân cỡ</p>
                              </a>
                          </li>
                          {/if}
                          <li class="nav-header">THẺ</li>
                          {if 'minus_card'|in_array:$role:$admin and $elements->minus_card eq 1}
                          <li class="nav-item">
                              <a href="{$base_url}minuscard" class="nav-link {if $action eq 'minus_card'}active{/if}">
                                  <i class="fa fa-credit-card nav-icon"></i>
                                  <p>Thẻ trả về</p>
                              </a>
                          </li>
                          {/if}
                          {if 'withdraw_card'|in_array:$role:$admin and $elements->withdraw_card eq 1}
                          <li class="nav-item">
                              <a href="{$base_url}withdrawcard" class="nav-link {if $action eq 'withdraw_card'}active{/if}">
                                  <i class="fa fa-credit-card nav-icon"></i>
                                  <p>Thẻ thu hồi</p>
                              </a>
                          </li>
                          {/if}
                          {if 'card'|in_array:$role:$admin}
                          <li class="nav-item">
                              <a href="{$base_url}card" class="nav-link {if $action eq 'card'}active{/if}">
                                  <i class="fa fa-credit-card nav-icon text-warning"></i>
                                  <p>Thẻ từ</p>
                              </a>
                          </li>
                          {/if}

                      </ul>
                  </li>
                  {if $elements->pso_stat eq 1}
                  <li class="nav-item has-treeview {$menu_open.pso}">
                      <a href="#" class="nav-link">
                          <i class="nav-icon fas fa-chart-pie"></i>
                          <p>
                              Cân vùng nuôi
                              <i class="fas fa-angle-left right"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          {if 'pso_stat_detail'|in_array:$role:$admin}
                          <li class="nav-item">
                              <a href="{$base_url}pso/detail" class="nav-link {if $action eq 'pso_stat_detail'}active{/if}">
                                  <i class="fa fa-angle-right nav-icon"></i>
                                  <p>Chi tiết</p>
                              </a>
                          </li>
                          {/if}
                          {if 'pso_stat_general'|in_array:$role:$admin}
                          <li class="nav-item">
                              <a href="{$base_url}pso/general" class="nav-link {if $action eq 'pso_stat_general'}active{/if}">
                                  <i class="fa fa-angle-right nav-icon"></i>
                                  <p>Tổng hợp</p>
                              </a>
                          </li>
                          {/if}

                      </ul>
                  </li>
                  {/if}
                  {if $elements->nguyen_lieu_stat eq 1}
                  <li class="nav-item has-treeview {$menu_open.nguyenlieu}">

                      <a href="#" class="nav-link">
                          <i class="nav-icon fas fa-chart-pie"></i>
                          <p>
                              Thống kê Nguyên liệu
                              <i class="fas fa-angle-left right"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          {if 'nguyenlieu_stat_chitiet'|in_array:$role:$admin}
                          <li class="nav-item">
                              <a href="{$base_url}nguyenlieu/chitiet" class="nav-link {if $action eq 'nguyenlieu_stat_chitiet'}active{/if}">
                                  <i class="fa fa-angle-right nav-icon"></i>
                                  <p>Chi tiết</p>
                              </a>
                          </li>
                          {/if}
                          {if 'nguyenlieu_stat_product'|in_array:$role:$admin}
                          <li class="nav-item">
                              <a href="{$base_url}nguyenlieu/tonghop" class="nav-link {if $action eq 'nguyenlieu_stat_product'}active{/if}">
                                  <i class="fa fa-angle-right nav-icon"></i>
                                  <p>Tổng hợp</p>
                              </a>
                          </li>
                          {/if}

                      </ul>
                  </li>
                  {/if}
                  {if $elements->fillet_stat eq 1}
                  <li class="nav-item has-treeview {$menu_open.fillet}">
                      <a href="#" class="nav-link">
                          <i class="nav-icon fas fa-chart-pie"></i>
                          <p>
                              Thống kê Fillet
                              <i class="fas fa-angle-left right"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          {if 'stat_fillet_detail'|in_array:$role:$admin}
                          <li class="nav-item">
                              <a href="{$base_url}fillet/detail" class="nav-link {if $action eq 'stat_fillet_detail'}active{/if}">
                                  <i class="fa fa-angle-right nav-icon"></i>
                                  <p>Chi tiết</p>
                              </a>
                          </li>
                          {/if}
                          {if 'stat_fillet_product'|in_array:$role:$admin}
                          <li class="nav-item">
                              <a href="{$base_url}fillet/product" class="nav-link {if $action eq 'stat_fillet_product'}active{/if}">
                                  <i class="fa fa-angle-right nav-icon"></i>
                                  <p>Theo sản phẩm</p>
                              </a>
                          </li>
                          {/if}

                          {if 'stat_fillet_worker'|in_array:$role:$admin}
                          <li class="nav-item">
                              <a href="{$base_url}fillet/worker" class="nav-link {if $action eq 'stat_fillet_worker'}active{/if}">
                                  <i class="fa fa-angle-right nav-icon"></i>
                                  <p>Theo công nhân</p>
                              </a>
                          </li>
                          {/if}
                          {if 'stat_fillet_worker_total'|in_array:$role:$admin}
                          <li class="nav-item">
                              <a href="{$base_url}fillet/worker_total" class="nav-link {if $action eq 'stat_fillet_worker_total'}active{/if}">
                                  <i class="fa fa-angle-right nav-icon"></i>
                                  <p>Tổng hợp</p>
                              </a>
                          </li>
                          {/if}
                          {if 'stat_suaca_worker_no_input'|in_array:$role:$admin}
                          <li class="nav-item">
                              <a href="{$base_url}fillet/no_input" class="nav-link {if $action eq 'stat_fillet_worker_no_input'}active{/if}">
                                  <i class="fa fa-angle-right nav-icon"></i>
                                  <p>Không có đầu vào</p>
                              </a>
                          </li>
                          {/if}
                          {if 'stat_suaca_worker_no_output'|in_array:$role:$admin}
                          <li class="nav-item">
                              <a href="{$base_url}fillet/no_output" class="nav-link {if $action eq 'stat_fillet_worker_no_output'}active{/if}">
                                  <i class="fa fa-angle-right nav-icon"></i>
                                  <p>Chưa cân đầu ra</p>
                              </a>
                          </li>
                          {/if}
                          {if 'stat_fillet_overtime'|in_array:$role:$admin}
                          <li class="nav-item">
                              <a href="{$base_url}fillet/overtime" class="nav-link {if $action eq 'stat_fillet_overtime'}active{/if}">
                                  <i class="fa fa-angle-right nav-icon"></i>
                                  <p>Quá thời gian</p>
                              </a>
                          </li>
                          {/if}
                          {if 'stat_fillet_invalid'|in_array:$role:$admin}
                          <li class="nav-item">
                              <a href="{$base_url}fillet/invalid" class="nav-link {if $action eq 'stat_fillet_invalid'}active{/if}">
                                  <i class="fa fa-angle-right nav-icon"></i>
                                  <p>Không hợp lệ</p>
                              </a>
                          </li>
                          {/if}
                          {if 'stat_fillet_working'|in_array:$role:$admin}
                          <li class="nav-item">
                              <a href="{$base_url}fillet/working" class="nav-link {if $action eq 'stat_fillet_working'}active{/if}">
                                  <i class="fa fa-angle-right nav-icon"></i>
                                  <p>Đang cân</p>
                              </a>
                          </li>
                          {/if}
                          {if 'stat_fillet_over_threshold'|in_array:$role:$admin}
                          <li class="nav-item">
                              <a href="{$base_url}fillet/over_threshold" class="nav-link {if $action eq 'stat_fillet_over_threshold'}active{/if}">
                                  <i class="fa fa-angle-right nav-icon"></i>
                                  <p>Ngoài định mức</p>
                              </a>
                          </li>
                          {/if}
                      </ul>
                  </li>
                  {/if}
                  {if $elements->sua_ca_stat eq 1}
                  <li class="nav-item has-treeview {$menu_open.suaca}">
                      <a href="#" class="nav-link">
                          <i class="nav-icon fas fa-chart-pie"></i>
                          <p>
                              Thống kê Sửa cá
                              <i class="fas fa-angle-left right"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          {if 'stat_suaca_detail'|in_array:$role:$admin}
                          <li class="nav-item">
                              <a href="{$base_url}suaca/detail" class="nav-link {if $action eq 'stat_suaca_detail'}active{/if}">
                                  <i class="fa fa-angle-right nav-icon"></i>
                                  <p>Chi tiết</p>
                              </a>
                          </li>
                          {/if}
                          {if 'stat_suaca_product'|in_array:$role:$admin}
                          <li class="nav-item">
                              <a href="{$base_url}suaca/product" class="nav-link {if $action eq 'stat_suaca_product'}active{/if}">
                                  <i class="fa fa-angle-right nav-icon"></i>
                                  <p>Theo sản phẩm</p>
                              </a>
                          </li>
                          {/if}
                          {if 'stat_suaca_worker'|in_array:$role:$admin}
                          <li class="nav-item">
                              <a href="{$base_url}suaca/worker" class="nav-link {if $action eq 'stat_suaca_worker'}active{/if}">
                                  <i class="fa fa-angle-right nav-icon"></i>
                                  <p>Theo công nhân</p>
                              </a>
                          </li>
                          {/if}
                          {if 'stat_suaca_worker_total'|in_array:$role:$admin}
                          <li class="nav-item">
                              <a href="{$base_url}suaca/worker_total" class="nav-link {if $action eq 'stat_suaca_worker_total'}active{/if}">
                                  <i class="fa fa-angle-right nav-icon"></i>
                                  <p>Tổng hợp</p>
                              </a>
                          </li>
                          {/if}
                          <!-- {if 'suaca_threshold'|in_array:$role:$admin}
                          <li class="nav-item">
                              <a href="{$base_url}threshold/suaca_read" class="nav-link {if $action eq 'suaca_threshold'}active{/if}">
                                  <i class="fa fa-angle-right nav-icon"></i>
                                  <p>Định mức chuẩn</p>
                              </a>
                          </li>
                          {/if} -->
                          {if 'stat_suaca_qcworker_detail'|in_array:$role:$admin}
                          <li class="nav-item">
                              <a href="{$base_url}suaca/qcworker_detail" class="nav-link {if $action eq 'stat_suaca_qcworker_detail'}active{/if}">
                                  <i class="fa fa-angle-right nav-icon"></i>
                                  <p>Kiểm chi tiết</p>
                              </a>
                          </li>
                          {/if}
                          {if 'stat_suaca_qcworker_general'|in_array:$role:$admin}
                          <li class="nav-item">
                              <a href="{$base_url}suaca/qcworker_general" class="nav-link {if $action eq 'stat_suaca_qcworker_general'}active{/if}">
                                  <i class="fa fa-angle-right nav-icon"></i>
                                  <p>Kiểm tổng hợp</p>
                              </a>
                          </li>
                          {/if}
                          {if 'stat_suaca_worker_no_input'|in_array:$role:$admin}
                          <li class="nav-item">
                              <a href="{$base_url}suaca/no_input" class="nav-link {if $action eq 'stat_suaca_worker_no_input'}active{/if}">
                                  <i class="fa fa-angle-right nav-icon"></i>
                                  <p>Không có đầu vào</p>
                              </a>
                          </li>
                          {/if}
                          {if 'stat_suaca_worker_no_output'|in_array:$role:$admin}
                          <li class="nav-item">
                              <a href="{$base_url}suaca/no_output" class="nav-link {if $action eq 'stat_suaca_worker_no_output'}active{/if}">
                                  <i class="fa fa-angle-right nav-icon"></i>
                                  <p>Chưa cân đầu ra</p>
                              </a>
                          </li>
                          {/if}
                          {if 'stat_suaca_overtime'|in_array:$role:$admin}
                          <li class="nav-item">
                              <a href="{$base_url}suaca/overtime" class="nav-link {if $action eq 'stat_suaca_overtime'}active{/if}">
                                  <i class="fa fa-angle-right nav-icon"></i>
                                  <p>Quá thời gian</p>
                              </a>
                          </li>
                          {/if}
                          {if 'stat_suaca_invalid'|in_array:$role:$admin}
                          <li class="nav-item">
                              <a href="{$base_url}suaca/invalid" class="nav-link {if $action eq 'stat_suaca_invalid'}active{/if}">
                                  <i class="fa fa-angle-right nav-icon"></i>
                                  <p>Không hợp lệ</p>
                              </a>
                          </li>
                          {/if}
                          {if 'stat_suaca_over_threshold'|in_array:$role:$admin}
                          <li class="nav-item">
                              <a href="{$base_url}suaca/over_threshold" class="nav-link {if $action eq 'stat_suaca_over_threshold'}active{/if}">
                                  <i class="fa fa-angle-right nav-icon"></i>
                                  <p>Ngoài định mức</p>
                              </a>
                          </li>
                          {/if}
                          {if 'stat_suaca_skinmachine'|in_array:$role:$admin}
                          <li class="nav-item">
                              <a href="{$base_url}suaca/skinmachine" class="nav-link {if $action eq 'stat_suaca_skinmachine'}active{/if}">
                                  <i class="fa fa-angle-right nav-icon"></i>
                                  <p>Máy lạn da</p>
                              </a>
                          </li>
                          {/if}
                          {if 'stat_suaca_worker_for_view'|in_array:$role:$admin}
                          <li class="nav-item">
                              <a href="{$base_url}suaca/workerforview" class="nav-link {if $action eq 'stat_suaca_worker_for_view'}active{/if}">
                                  <i class="fa fa-angle-right nav-icon"></i>
                                  <p>Xem năng suất</p>
                              </a>
                          </li>
                          {/if}
                          {if 'stat_suaca_working'|in_array:$role:$admin}
                          <li class="nav-item">
                              <a href="{$base_url}suaca/working" class="nav-link {if $action eq 'stat_suaca_working'}active{/if}">
                                  <i class="fa fa-angle-right nav-icon"></i>
                                  <p>Đang cân</p>
                              </a>
                          </li>
                          {/if}
                          <!-- {if 'edit_phieucan'|in_array:$role:$admin}
                          <li class="nav-item">
                              <a href="{$base_url}suaca/phieucan" class="nav-link {if $action eq 'edit_phieucan'}active{/if}">
                                  <i class="fa fa-angle-right nav-icon"></i>
                                  <p>Điều chỉnh phiếu cân</p>
                              </a>
                          </li>
                          {/if} -->
                      </ul>
                  </li>
                  {/if}
                  {if $elements->weightgain_stat eq 1}
                  <li class="nav-item has-treeview {$menu_open.weightgain}">
                      <a href="#" class="nav-link">
                          <i class="nav-icon fas fa-chart-pie"></i>
                          <p>
                              Tăng trọng
                              <i class="fas fa-angle-left right"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          {if 'stat_weightgain_detail'|in_array:$role:$admin}
                          <li class="nav-item">
                              <a href="{$base_url}weightgain/detail" class="nav-link {if $action eq 'stat_weightgain_detail'}active{/if}">
                                  <i class="fa fa-angle-right nav-icon"></i>
                                  <p>Chi tiết</p>
                              </a>
                          </li>
                          {/if}
                          {if 'stat_weightgain_general'|in_array:$role:$admin}
                          <li class="nav-item">
                              <a href="{$base_url}weightgain/general" class="nav-link {if $action eq 'stat_weightgain_general'}active{/if}">
                                  <i class="fa fa-angle-right nav-icon"></i>
                                  <p>Tổng hợp</p>
                              </a>
                          </li>
                          {/if}

                      </ul>
                  </li>
                  {/if}
                  {if $elements->phu_pham_stat eq 1}
                  <li class="nav-item has-treeview {$menu_open.phupham}">
                      <a href="#" class="nav-link">
                          <i class="nav-icon fas fa-chart-pie"></i>
                          <p>
                              Phụ phẩm
                              <i class="fas fa-angle-left right"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          {if 'phu_pham_stat_detail'|in_array:$role:$admin}
                          <li class="nav-item">
                              <a href="{$base_url}phupham2/detail" class="nav-link {if $action eq 'phu_pham_stat_detail'}active{/if}">
                                  <i class="fa fa-angle-right nav-icon"></i>
                                  <p>Chi tiết</p>
                              </a>
                          </li>
                          {/if}
                          {if 'phu_pham_stat_general'|in_array:$role:$admin}
                          <li class="nav-item">
                              <a href="{$base_url}phupham2/general" class="nav-link {if $action eq 'phu_pham_stat_general'}active{/if}">
                                  <i class="fa fa-angle-right nav-icon"></i>
                                  <p>Tổng hợp</p>
                              </a>
                          </li>
                          {/if}

                      </ul>
                  </li>
                  {/if}
                  {if $elements->spice_stat eq 1}
                  <li class="nav-item has-treeview {$menu_open.spice}">
                      <a href="#" class="nav-link">
                          <i class="nav-icon fas fa-chart-pie"></i>
                          <p>
                              Thống kê gia vị
                              <i class="fas fa-angle-left right"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          {if 'recipe_history'|in_array:$role:$admin}
                          <li class="nav-item">
                              <a href="{$base_url}recipe/history" class="nav-link {if $action eq 'recipe_history'}active{/if}">
                                  <i class="fa fa-angle-right nav-icon"></i>
                                  <p>Lịch sử công thức</p>
                              </a>
                          </li>
                          {/if}
                          {if 'spice_stat_detail'|in_array:$role:$admin}
                          <li class="nav-item">
                              <a href="{$base_url}spice/detail" class="nav-link {if $action eq 'spice_stat_detail'}active{/if}">
                                  <i class="fa fa-angle-right nav-icon"></i>
                                  <p>Chi tiết</p>
                              </a>
                          </li>
                          {/if}
                          {if 'spice_stat_general'|in_array:$role:$admin}
                          <li class="nav-item">
                              <a href="{$base_url}spice/general" class="nav-link {if $action eq 'spice_stat_general'}active{/if}">
                                  <i class="fa fa-angle-right nav-icon"></i>
                                  <p>Tổng hợp</p>
                              </a>
                          </li>
                          {/if}

                      </ul>
                  </li>
                  {/if}
                  <li class="nav-item has-treeview {$menu_open.errorlog}">
                      <a href="#" class="nav-link">
                          <i class="nav-icon fas fa-chart-pie"></i>
                          <p>
                              Thao tác lỗi
                              <i class="fas fa-angle-left right"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          {if 'errorlog_stat_detail'|in_array:$role:$admin}
                          <li class="nav-item">
                              <a href="{$base_url}errorlog/detail" class="nav-link {if $action eq 'errorlog_stat_detail'}active{/if}">
                                  <i class="fa fa-angle-right nav-icon"></i>
                                  <p>Chi tiết</p>
                              </a>
                          </li>
                          {/if}
                          {if 'errorlog_stat_general'|in_array:$role:$admin}
                          <li class="nav-item">
                              <a href="{$base_url}errorlog/general" class="nav-link {if $action eq 'errorlog_stat_general'}active{/if}">
                                  <i class="fa fa-angle-right nav-icon"></i>
                                  <p>Tổng hợp</p>
                              </a>
                          </li>
                          {/if}

                      </ul>
                  </li>
                  {if $elements->other_device eq 1}
                  {if count($machine)>0}
                  <li class="nav-header"><i class="nav-icon fas fa-chart-pie text-warning"></i> THIẾT BỊ KHÁC</li>
                  {$temp='stat_machine'}
                  {$temp2=$machine_serial}
                  {foreach $machine as $m}
                  {if $m->machine_code|in_array:$role:$admin}
                  <li class="nav-item">
                      <a href="{$base_url}machine/index/{$m->machine_code}/{$m->machine_serial}" class="nav-link {if $action|cat:$machine_serial eq $temp|cat:$m->machine_serial}active{/if}">
                          <i class="fa fa-angle-right nav-icon"></i>
                          <p>{$m->machine_name}</p>
                      </a>
                  </li>
                  {/if}
                  {/foreach}
                  {/if}
                  {/if}
                  <!-- <li class="nav-item has-treeview {$menu_open.machine}">
                      <a href="#" class="nav-link active">
                          <i class="nav-icon fa fa-file"></i>
                          <p>
                              Thiết bị khác
                              <i class="fas fa-angle-left right"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          {$temp='stat_machine'}
                          {$temp2=$machine_serial}
                          {foreach $machine as $m}
                          <li class="nav-item">
                              <a href="{$base_url}machine/index/{$m->machine_code}/{$m->machine_serial}" class="nav-link {if $action|cat:$machine_serial eq $temp|cat:$m->machine_serial}active{/if}">
                                  <i class="fa fa-angle-right nav-icon"></i>
                                  <p>{$m->machine_name}</p>
                              </a>
                          </li>
                          {/foreach}
                      </ul>
                  </li> -->
                  <li class="nav-item has-treeview {$menu_open.user}">
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
                          {if $admin eq 99}
                          <li class="nav-item">
                              <a href="{$base_url}elements" class="nav-link {if $action eq 'elements'}active{/if}">
                                  <i class="fa fa-angle-right nav-icon"></i>
                                  <p>Danh sách chức năng</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="{$base_url}role" class="nav-link {if $action eq 'role'}active{/if}">
                                  <i class="fa fa-angle-right nav-icon"></i>
                                  <p>Danh sách quyền</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="{$base_url}machine/manager" class="nav-link {if $action eq 'machine_manager'}active{/if}">
                                  <i class="fa fa-angle-right nav-icon"></i>
                                  <p>Thêm thiết bị</p>
                              </a>
                          </li>
                          {/if}
                          {if ($admin eq 1) or ( $admin eq 99)}
                          <li class="nav-item">
                              <a href="{$base_url}user/permission" class="nav-link {if $action eq 'permission'}active{/if}">
                                  <i class="fa fa-angle-right nav-icon"></i>
                                  <p>Phân quyền</p>
                              </a>
                          </li>
                          {/if}

                          <li class="nav-item">
                              <a href="{$base_url}user/logout" class="nav-link">
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
              $.post("{$base_url}user/changepassword", {
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
  </script>