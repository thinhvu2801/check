<?php /* Smarty version Smarty-3.1.16, created on 2024-02-20 01:36:29
         compiled from "D:\xampp\htdocs\htdocsbentre\application\views\user\permission.php" */ ?>
<?php /*%%SmartyHeaderCode:150421906765d3f40db667a7-74042193%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9852a94a9b50f55bddb54159a0c836b2cd52d14d' => 
    array (
      0 => 'D:\\xampp\\htdocs\\htdocsbentre\\application\\views\\user\\permission.php',
      1 => 1678084354,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '150421906765d3f40db667a7-74042193',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'users' => 0,
    'us' => 0,
    'i' => 0,
    'base_url' => 0,
    'mes' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_65d3f40dbd3ce6_03994443',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_65d3f40dbd3ce6_03994443')) {function content_65d3f40dbd3ce6_03994443($_smarty_tpl) {?><!-- /.card -->
<div class="row">
  <div class="col-md-3">
    <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title">Chọn tài khoản</h3>
      </div>
      <div class="card-body">
        <select size="5" class="form-control" name="users" id="users" style="font-size: 1.3em">
        <?php $_smarty_tpl->tpl_vars['i'] = new Smarty_variable(1, null, 0);?>
        <?php  $_smarty_tpl->tpl_vars['us'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['us']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['users']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['us']->key => $_smarty_tpl->tpl_vars['us']->value) {
$_smarty_tpl->tpl_vars['us']->_loop = true;
?>
          <option value="<?php echo $_smarty_tpl->tpl_vars['us']->value->username;?>
" <?php if ($_smarty_tpl->tpl_vars['i']->value==1) {?> selected <?php }?>><?php echo $_smarty_tpl->tpl_vars['us']->value->username;?>
 (<?php echo $_smarty_tpl->tpl_vars['us']->value->hoten;?>
)</option>
          <?php $_smarty_tpl->tpl_vars['i'] = new Smarty_variable($_smarty_tpl->tpl_vars['i']->value+1, null, 0);?>
        <?php } ?>
        </select>
      </div>
      <!-- /.card-body -->
      <div class="card-footer">
          
      </div>
        <!-- /.card-footer -->
    </div><!-- /.card-info -->
    <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title">Thêm tài khoản</h3>
      </div>
      <form action="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
user/insert" method="post">
        <div class="card-body">
          <?php if ($_smarty_tpl->tpl_vars['mes']->value!='') {?>
          <p class="mb-0" style="color: red;"><?php echo $_smarty_tpl->tpl_vars['mes']->value;?>
</p>
          <?php }?>
          <div class="input-group mb-3">
            <input type="text" class="form-control" id="username" name="username" 
            required maxlength="20" placeholder="Tài khoản" pattern="[A-Za-z0-9+-_]{3,}">
          </div>
           <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Họ tên" name="hoten">
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control" placeholder="Mật khẩu" name="password" value="" require>
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control" placeholder="Nhập lại mật khẩu" name="repassword" value="" require>
          </div>
          <!-- /input-group -->
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <button type="submit" class="btn btn-info btn-sm">Thêm</button>
        </div>
        <!-- /.card-footer -->
      </form>
    </div><!-- /.card-info -->
  </div><!-- ./col-md-3-->
  <div class="col-md-9">
    <!-- /.card -->
    <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title">Phân quyền</h3>
      </div>
      <!-- /.card-header -->
      <form action="#" method="post" id="demoform">
        <div class="card-body">
        <div class="row">
        <div class="col-12">
          <div class="form-group" id="list_role">
            
          </div>
          <div id="mes"></div>
          <!-- /.form-group -->
        </div>
        <!-- /.col -->
        </div>
        <!-- /.row -->
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          <button type="button" name="permission" id="update_role" class="btn btn-info btn-sm">Hoàn tất</button>
          <p>Nếu không có quyền nào, tài khoản sẽ bị xóa!</p>
        </div>
      </form>
    </div>
    <!-- /.card -->
  </div><!-- ./col-md-9-->
</div>
<script type="text/javascript">
  $( document ).ready(function() {
    read_role();
  });
  function read_role(){
    $.post("<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
user/role",{
        username: $("#users").val()
      },
      function(data,status){
          $( "#list_role" ).html(data);
      }
    );
  }
  $('#role').bootstrapDualListbox();
  $("#update_role").click(function() {
    $( "#mes" ).html("");
    $.post("<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
user/update_role",{
        role: $('#role').val(),
        username: $("#users").val()
      },
      function(data,status){
          alert("Đã cập nhật");
          //$( "#mes" ).html("Đã cập nhật");
      }
    );
    if ($('#role').val()=="")
      window.location.href = "<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
user/permission";
  });
  $("#users").click(function(){
    read_role();
  });
</script><?php }} ?>
