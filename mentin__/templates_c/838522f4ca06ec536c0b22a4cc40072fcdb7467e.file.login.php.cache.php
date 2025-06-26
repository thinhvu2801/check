<?php /* Smarty version Smarty-3.1.16, created on 2023-02-28 09:20:06
         compiled from "C:\xampp\htdocs\demo\application\views\user\login.php" */ ?>
<?php /*%%SmartyHeaderCode:26746062563ea1dd117c3e2-13970514%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '838522f4ca06ec536c0b22a4cc40072fcdb7467e' => 
    array (
      0 => 'C:\\xampp\\htdocs\\demo\\application\\views\\user\\login.php',
      1 => 1677571493,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '26746062563ea1dd117c3e2-13970514',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_63ea1dd11b3248_82369307',
  'variables' => 
  array (
    'base_url' => 0,
    'mes' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_63ea1dd11b3248_82369307')) {function content_63ea1dd11b3248_82369307($_smarty_tpl) {?><!DOCTYPE html>
<html lang="vi">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">

  <link href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
dist/img/ment.ico" type="image/x-icon" rel="shortcut icon" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
dist/css/adminlte.min.css">
  <script src="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
dist/js/adminlte.min.js"></script>
</head>
<body class="hold-transition login-page">
  <div class="login-box">
  <div class="login-logo">
    <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
"><b>MenTin</b></a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Đăng nhập để bắt đầu phiên làm việc</p>

      <form action="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
user/validate" method="post">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Tài khoản" name="username" id="username">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Mật khẩu" name="password" id="password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <!-- <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div> -->
          <!-- /.col -->
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block btn-sm">Đăng nhập</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
      <p class="mb-0">
        <?php echo $_smarty_tpl->tpl_vars['mes']->value;?>

      </p>
      <!-- /.social-auth-links -->

      <!-- <p class="mb-1">
        <a href="forgot-password.html">I forgot my password</a>
      </p>
      <p class="mb-0">
        <a href="register.html" class="text-center">Register a new membership</a>
      </p> -->
    </div>
    <!-- /.login-card-body -->
  </div>
  </div>
<!-- /.login-box -->
</body>
</html><?php }} ?>
