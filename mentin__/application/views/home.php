<!DOCTYPE html>
<html lang="vi">

<head>
  <?php
  $ci = &get_instance();
  $this->view->base_url = base_url();
  $ci->load->model("MUser");
  $ci->load->model("MMachine");
  $user = $ci->MUser->readByUsername($this->session->userdata("username"));
  $elements = $ci->MUser->elementsRead();
  $machine = $ci->MMachine->read();
  $this->view->hoten = $user->hoten;
  $admin = $user->admin;
  $role = explode(',', $user->role);
  $this->view->admin = $admin;
  $this->view->role = $role;
  $this->view->elements = $elements;
  $this->view->current_year = date("Y");
  if (($action != "home") && (!$admin))

    if (!in_array($action, $role)) {
      redirect(base_url());
    }
  $this->view->parse('header');
  ?>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">
    <?php
    $this->view->action = $action;
    if (isset($data['machine_serial']))
      $this->view->machine_serial = $data['machine_serial'];
    else
      $this->view->machine_serial = "";
    $menu_open = array(
      "general" => "", "phupham" => "menu-open", "fillet" => "", "pso" => "", "nguyenlieu" => "", "suaca" => "", "spice" => "",
      "phansize" => "", "kirimi" => "", "canngheu" => "", "pcxk" => "", "weightgain" => "", "hamdong" => "", "errorlog" => "", "machine" => "", "user" => ""
    );
    function SetMenuOpen(&$menu_open, $key)
    {
      foreach ($menu_open as $item) {
        $item = "";
      }
      $menu_open[$key] = "menu-open";
    }
    switch ($action) {
      case 'card':
      case 'product':
      case 'product_card':
      case 'spice':
      case 'spice_card':
      case 'spice_program':
      case 'recipe':
      case 'phupham':
      case 'phupham_card':
      case 'xe':
      case 'xe_card':
      case 'worker':
      case 'worker_card':
      case 'group':
      case 'group_card':
      case 'basket':
      case 'basket_card':
      case 'lohang':
      case 'lohang_card':
      case 'size':
      case 'size_card':
      case 'provider':
      case 'provider_card':
      case 'process':
      case 'process_card':
      case 'hamdong':
      case 'hamdong_card':
      case 'product_type':
      case 'product_type_card':
      case 'customer':
      case 'customer_card':
      case 'minus_card':
      case 'withdraw_card':
      case 'number_card':
      case 'threshold':
      case 'servicecard':
      case 'servicecard_card':
      case 'gradersize':
      case 'me':
      case 'me_card':
        SetMenuOpen($menu_open, "general");
        break;
      case 'recipe_history':
      case 'spice_stat_detail':
      case 'spice_stat_general':
        SetMenuOpen($menu_open, "spice");
        break;
      case 'phu_pham_stat_detail':
      case 'phu_pham_stat_general':
        SetMenuOpen($menu_open, "phu_pham");
        break;
      case 'pso_stat_detail':
      case 'pso_stat_general':
        SetMenuOpen($menu_open, "pso");
        break;
      case 'phupham_stat_tonghop':
      case 'phupham_stat_chitiet':
        SetMenuOpen($menu_open, "phupham");
        break;
      case 'stat_fillet_detail':
      case 'stat_fillet_product':
      case 'stat_fillet_worker':
      case 'stat_fillet_invalid':
      case 'stat_fillet_over_threshold':
      case 'stat_fillet_worker_total':
      case 'stat_fillet_worker_no_input':
      case 'stat_fillet_worker_no_output':
      case 'stat_fillet_overtime':
      case 'stat_fillet_working':
        SetMenuOpen($menu_open, "fillet");
        break;
      case 'nguyenlieu_stat_chitiet':
      case 'nguyenlieu_stat_product':
        SetMenuOpen($menu_open, "nguyenlieu");
        break;
      case 'stat_suaca_detail':
      case 'stat_suaca_product':
      case 'stat_suaca_worker':
      case 'stat_suaca_worker_total':
      case 'stat_suaca_worker_no_input':
      case 'stat_suaca_worker_no_output':
      case 'stat_suaca_invalid':
      case 'suaca_threshold':
      case 'stat_suaca_over_threshold':
      case 'stat_suaca_overtime':
      case 'stat_suaca_qcworker_detail':
      case 'stat_suaca_qcworker_general':
      case 'stat_suaca_working':
      case 'stat_suaca_skinmachine':
      case 'stat_suaca_worker_for_view':
      case 'edit_phieucan':
        SetMenuOpen($menu_open, "suaca");
        break;
      case 'stat_phansize_detail':
      case 'stat_phansize_product':
        SetMenuOpen($menu_open, "phansize");
        break;
      case 'stat_kirimi_in':
      case 'stat_kirimi_out':
      case 'stat_kirimi_in_detail':
      case 'stat_kirimi_out_detail':
      case 'stat_kirimi_in_product':
      case 'stat_kirimi_out_product':
        SetMenuOpen($menu_open, "kirimi");
        break;
      case 'stat_canngheu_detail':
      case 'stat_canngheu_product':
      case 'stat_canngheu_worker':
        SetMenuOpen($menu_open, "canngheu");
        break;
      case 'stat_weightgain_detail':
      case 'stat_weightgain_general':
        SetMenuOpen($menu_open, "weightgain");
        break;
      case 'stat_pcxk_detail':
      case 'stat_pcxk_product':
      case 'stat_pcxk_worker':
        SetMenuOpen($menu_open, "pcxk");
        break;
      case 'stat_hamdong_detail':
      case 'stat_hamdong_synthetic':
      case 'stat_hamdong_inventory':
        SetMenuOpen($menu_open, "hamdong");
        break;
      case 'permission':
      case 'role':
      case 'elements':
      case 'machine_manager':
        SetMenuOpen($menu_open, "user");
        break;
      case 'stat_machine':

        SetMenuOpen($menu_open, "machine");
        break;
      case 'errorlog_stat_detail':
      case 'errorlog_stat_general':
        SetMenuOpen($menu_open, "errorlog");
        break;
      default:
        SetMenuOpen($menu_open, "phupham");
        break;
    }
    $this->view->menu_open = $menu_open;
    $this->view->parse('script');
    $this->view->parse('navbar');
    $this->view->parse('slidebar', array('machine' => $machine));
    ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <?php
          if (isset($template))
            $this->view->parse($template, $data);
          else {
          }
          ?>
        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <?php
    $this->view->parse('footer');
    ?>
  </div>
  <!-- ./wrapper -->
</body>

</html>