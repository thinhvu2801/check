<?php /* Smarty version Smarty-3.1.16, created on 2024-03-01 03:19:21
         compiled from "D:\xampp\htdocs\htdocsbentre\application\views\worker\index.php" */ ?>
<?php /*%%SmartyHeaderCode:162524384065bb1dfd519212-80616133%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '42a2ceacc9a45526946a3124792868f4303a8951' => 
    array (
      0 => 'D:\\xampp\\htdocs\\htdocsbentre\\application\\views\\worker\\index.php',
      1 => 1709259558,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '162524384065bb1dfd519212-80616133',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_65bb1dfd5a1e20_86931669',
  'variables' => 
  array (
    'base_url' => 0,
    'group' => 0,
    'mes' => 0,
    'factory' => 0,
    'f' => 0,
    'worker' => 0,
    'congdoan' => 0,
    'cd' => 0,
    'congdoan_id' => 0,
    'wk' => 0,
    'i' => 0,
    'groups' => 0,
    'g' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_65bb1dfd5a1e20_86931669')) {function content_65bb1dfd5a1e20_86931669($_smarty_tpl) {?><div class="row">
  <div class="col-md-3">
  
    <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title">Thêm thủ công</h3>
      </div>
      <form action="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
worker/insert" method="post">
        <input type="hidden" name="group_id" value="<?php echo $_smarty_tpl->tpl_vars['group']->value->group_id;?>
">
        <div class="card-body">
          <?php if ($_smarty_tpl->tpl_vars['mes']->value!='') {?>
          <p class="mb-0" style="color: red;"><?php echo $_smarty_tpl->tpl_vars['mes']->value;?>
</p>
          <?php }?>
          <div class="input-group mb-3">
            <input type="text" class="form-control" id="worker_id" name="worker_id" placeholder="Mã nhà máy" maxlength="20" pattern="[A-Za-z0-9-_]{3,}" >
          </div>
          <!-- <div class="input-group mb-3">
            <input type="text" class="form-control" id="factory_id" name="factory_id" required maxlength="20" placeholder="Mã công nhân" pattern="[A-Za-z0-9-_]{3,}" >
          </div> -->
          <div class="form-group">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text">Mã thẻ</span>
              </div>
              <select class="form-control" name="factory_id" id="factory_id">
                <option value="">Không</option>
                <?php  $_smarty_tpl->tpl_vars['f'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['f']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['factory']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['f']->key => $_smarty_tpl->tpl_vars['f']->value) {
$_smarty_tpl->tpl_vars['f']->_loop = true;
?>
                <?php if (!in_array($_smarty_tpl->tpl_vars['f']->value->id,array_column($_smarty_tpl->tpl_vars['worker']->value,'factory_id'))) {?>
                    <option value="<?php echo $_smarty_tpl->tpl_vars['f']->value->id;?>
"><?php echo $_smarty_tpl->tpl_vars['f']->value->id;?>
</option>
                <?php }?>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="text" class="form-control" id="worker_name" name="worker_name" placeholder="Họ và tên" maxlength="50" required>
          </div>
          <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Ghi chú" name="note">
          </div>
          <div class="form-group">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text">Công đoạn</span>
              </div>
              <select class="form-control" name="congdoan_id" id="congdoan_id">
                <option value="">Không</option>
                <?php  $_smarty_tpl->tpl_vars['cd'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['cd']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['congdoan']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['cd']->key => $_smarty_tpl->tpl_vars['cd']->value) {
$_smarty_tpl->tpl_vars['cd']->_loop = true;
?>
                <option value="<?php echo $_smarty_tpl->tpl_vars['cd']->value->congdoan_id;?>
" <?php if ($_smarty_tpl->tpl_vars['congdoan_id']->value==$_smarty_tpl->tpl_vars['cd']->value->congdoan_id) {?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['cd']->value->congdoan_name;?>
</option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="input-group mb-3">
            <button type="submit" class="btn btn-success btn-sm btn-block">Thêm</button>
          </div>
          <!-- /input-group -->
        </div>
        <!-- /.card-body -->

      </form>
    </div>
    
    <!-- card-info-->
    <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title">Thêm từ Excel</h3>
      </div>
      <form action="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
worker/import" method="post" enctype="multipart/form-data">
        <input type="hidden" name="group_id" value="<?php echo $_smarty_tpl->tpl_vars['group']->value->group_id;?>
">
        <div class="card-body">
          <div class="form-group">
            <div class="input-group">
              <input type="file" class="form-control" id="file_xls" name="file_xls" placeholder="Chọn file excel chứa dữ liệu" accept=".xls" required>
            </div>
            <div class="input-group">
              <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
worker.xls">Tải mẫu</a>
            </div>
          </div>
          <!-- /input-group -->
          <div class="form-group">
            <label>
              <input type="checkbox" name="thaythe" value="1">Thay thế
            </label>
          </div>
          <div class="form-group">
            <button type="submit" name="import" class="btn btn-success btn-sm btn-block">Thêm</button>
          </div>
        </div>
        <!-- /.card-body -->

      </form>
    </div>
    <!-- card-info-->
  </div><!-- ./col-md-3-->
  <div class="col-md-9">
    <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title">
          Danh sách công nhân <?php echo $_smarty_tpl->tpl_vars['group']->value->group_name;?>

        </h3>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-hover table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr style="font-weight: bold;" align="center">
                <td width="3%">STT</td>
                <td width="15%">Mã công nhân</td>
                <td width="10%">Mã thẻ</td> 
                <td>Họ và tên</td>
                <td width="12%">Công đoạn</td>
                <td width="10%">Ghi chú</td>
                <td width="10%">Chức năng</td>
                <td width="5%">Nghỉ làm</td>
              </tr>
            </thead>
            <?php $_smarty_tpl->tpl_vars['i'] = new Smarty_variable(1, null, 0);?>
            <tbody>
              <?php  $_smarty_tpl->tpl_vars['wk'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['wk']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['worker']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['wk']->key => $_smarty_tpl->tpl_vars['wk']->value) {
$_smarty_tpl->tpl_vars['wk']->_loop = true;
?>
              <?php if ($_smarty_tpl->tpl_vars['wk']->value->status==1) {?>
              <tr align="center">
                <td><?php echo $_smarty_tpl->tpl_vars['i']->value++;?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['wk']->value->worker_id;?>
</td>
                <td><a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
khothe/card/<?php echo $_smarty_tpl->tpl_vars['wk']->value->factory_id;?>
"><?php echo $_smarty_tpl->tpl_vars['wk']->value->factory_id;?>
</a></td>
                <td align="left"><?php echo $_smarty_tpl->tpl_vars['wk']->value->worker_name;?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['wk']->value->congdoan_id;?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['wk']->value->note;?>
</td>
                <td>
                  <!-- <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
worker/card/<?php echo $_smarty_tpl->tpl_vars['wk']->value->worker_id;?>
">
                    <i class="fas fa-credit-card">
                    </i>
                  </a> -->
                  <a style="color: #17a2b8" href="#" data-toggle="modal" data-target="#update<?php echo $_smarty_tpl->tpl_vars['wk']->value->worker_id;?>
" style="cursor: pointer;" alt="Điều chỉnh">
                    <i class="fas fa-pencil-alt">
                    </i>
                  </a>
                  <!-- <a style="color: #da251d" href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
worker/delete/<?php echo $_smarty_tpl->tpl_vars['wk']->value->worker_id;?>
/<?php echo $_smarty_tpl->tpl_vars['wk']->value->group_id;?>
" onclick="return confirm('Bạn có chắc chắn xóa không?');">
                    <i class="fas fa-trash">
                    </i>
                  </a> -->
                </td>
                <td>
                <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
worker/update_cn/<?php echo $_smarty_tpl->tpl_vars['wk']->value->worker_id;?>
/<?php echo $_smarty_tpl->tpl_vars['wk']->value->status;?>
/<?php echo $_smarty_tpl->tpl_vars['wk']->value->group_id;?>
">
                    <?php if ($_smarty_tpl->tpl_vars['wk']->value->status==1) {?>
                    <i class='fas fa-check-circle' style='font-size:24px;color:green'></i>
                    <?php }?>
                    </a>
                </td>
              </tr>
              <?php }?>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
      <!-- /.card-body -->
      <div class="card-footer">

      </div>
      <!-- /.card-footer -->
    </div>
  </div><!-- ./col-md-3-->
</div>
<?php  $_smarty_tpl->tpl_vars['wk'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['wk']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['worker']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['wk']->key => $_smarty_tpl->tpl_vars['wk']->value) {
$_smarty_tpl->tpl_vars['wk']->_loop = true;
?>
<div class="modal fade" id="update<?php echo $_smarty_tpl->tpl_vars['wk']->value->worker_id;?>
">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Điều chỉnh</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="form-horizontal" method="post" name="updateproduct" action="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
worker/update">
        <input type="hidden" name="old_worker_id" value="<?php echo $_smarty_tpl->tpl_vars['wk']->value->worker_id;?>
">
        <input type="hidden" name="group_id" value="<?php echo $_smarty_tpl->tpl_vars['group']->value->group_id;?>
">
        <div class="modal-body">
          <div class="form-group row">
            <label for="NEW_worker_id" class="col-sm-2 col-form-label">Mã công nhân:</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" placeholder="Mã công nhân" id="NEW_worker_id" name="new_worker_id" required maxlength="20" value="<?php echo $_smarty_tpl->tpl_vars['wk']->value->worker_id;?>
" pattern="[A-Za-z0-9+-_]{3,}" >
            </div>
          </div>
          <div class="form-group row">
            <label for="factory_id" class="col-sm-2 col-form-label">Mã thẻ:</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="factory_id" id="factory_id" value="<?php echo $_smarty_tpl->tpl_vars['wk']->value->factory_id;?>
" disabled>
              <select class="form-control group_product" style="width: 100%;" name="factory_id" id="rfid">
                  <option value="<?php echo $_smarty_tpl->tpl_vars['wk']->value->factory_id;?>
"><?php echo $_smarty_tpl->tpl_vars['wk']->value->factory_id;?>
</option>
                  <?php  $_smarty_tpl->tpl_vars['f'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['f']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['factory']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['f']->key => $_smarty_tpl->tpl_vars['f']->value) {
$_smarty_tpl->tpl_vars['f']->_loop = true;
?>
                      <?php if (!in_array($_smarty_tpl->tpl_vars['f']->value->id,array_column($_smarty_tpl->tpl_vars['worker']->value,'factory_id'))&&$_smarty_tpl->tpl_vars['f']->value->id!=$_smarty_tpl->tpl_vars['wk']->value->factory_id) {?>
                          <option value="<?php echo $_smarty_tpl->tpl_vars['f']->value->id;?>
"><?php echo $_smarty_tpl->tpl_vars['f']->value->id;?>
</option>
                      <?php }?>
                  <?php } ?>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label for="worker_name" class="col-sm-2 col-form-label">Tên:</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" placeholder="Tên công nhân" id="worker_name" name="worker_name" placeholder="công nhân" required value="<?php echo $_smarty_tpl->tpl_vars['wk']->value->worker_name;?>
">
            </div>
          </div>
          <div class="form-group row">
            <label for="note" class="col-sm-2 col-form-label">Ghi chú:</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" placeholder="Ghi chú" name="note" id="note" value="<?php echo $_smarty_tpl->tpl_vars['wk']->value->note;?>
">
            </div>
          </div>

          <div class="form-group row">
            <label for="parent_id" class="col-sm-2 col-form-label">Nhóm:</label>
            <div class="col-sm-10">
              <select class="form-control group_product" style="width: 100%;" name="group_id" id="group_id">
                <?php  $_smarty_tpl->tpl_vars['g'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['g']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['groups']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['g']->key => $_smarty_tpl->tpl_vars['g']->value) {
$_smarty_tpl->tpl_vars['g']->_loop = true;
?>
                <option value="<?php echo $_smarty_tpl->tpl_vars['g']->value->group_id;?>
" <?php if ($_smarty_tpl->tpl_vars['g']->value->group_id==$_smarty_tpl->tpl_vars['wk']->value->group_id) {?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['g']->value->group_name;?>
</option>
                <?php } ?>
              </select>
            </div>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Đóng</button>
          <button type="submit" class="btn btn-primary btn-sm" id="capnhat">Cập nhật</button>
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<?php } ?>
<script>
  $(document).ready(function() {
    $('#factory_id').select2();
    $('#rfid').select2();
    $("#worker_id").focus();
    $('#dataTable').DataTable({
      stateSave: true
    });
  });
</script><?php }} ?>
