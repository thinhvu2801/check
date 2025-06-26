<?php /* Smarty version Smarty-3.1.16, created on 2024-01-30 02:30:37
         compiled from "C:\xampp\htdocs\application\views\quycach\index.php" */ ?>
<?php /*%%SmartyHeaderCode:73993816065b4a07e5e5101-29319476%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '520b303dc6b0d6aa1a28b9c53978848bddeb7bcf' => 
    array (
      0 => 'C:\\xampp\\htdocs\\application\\views\\quycach\\index.php',
      1 => 1706349144,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '73993816065b4a07e5e5101-29319476',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_65b4a07e681503_16833098',
  'variables' => 
  array (
    'base_url' => 0,
    'mes' => 0,
    'quycach' => 0,
    'i' => 0,
    'bk' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_65b4a07e681503_16833098')) {function content_65b4a07e681503_16833098($_smarty_tpl) {?><div class="row">
  <div class="col-md-3">
    <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title">Thêm thủ công</h3>
      </div>
      <form action="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
quycach/insert" method="post">
        <div class="card-body">
          <?php if ($_smarty_tpl->tpl_vars['mes']->value!='') {?>
          <p class="mb-0" style="color: red;"><?php echo $_smarty_tpl->tpl_vars['mes']->value;?>
</p>
          <?php }?>
          <div class="input-group mb-3">
            <input type="text" class="form-control" id="quycach_id" name="quycach_id" required maxlength="20" placeholder="Mã quy cách" pattern="[A-Za-z0-9-_]{3,}">
          </div>
          
          <div class="input-group mb-3">
            <input type="text" class="form-control" id="quycach_name" name="quycach_name" required maxlength="20" placeholder="Tên quy cách">
          </div>
          <div class="input-group mb-3">
            <input type="number" class="form-control" id="netweight" name="netweight" required step="0.1" value="0.0">
          </div>
          <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Ghi chú" name="note">
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
quycach/import" method="post" enctype="multipart/form-data">
        <div class="card-body">
          <div class="form-group">
            <div class="input-group">
              <input type="file" class="form-control" id="file_xls" name="file_xls" placeholder="Chọn file excel chứa dữ liệu" accept=".xls" required>
            </div>
            <div class="input-group">
              <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
quycach.xls">Tải mẫu</a>
            </div>
            
          </div>
          <!-- /input-group -->
          <div class="form-group">
            <label>
              <input type="checkbox" name="thaythe" value="1">Thay thế
            </label>
          </div>
          <div class="form-group">
             <button type="submit" class="btn btn-success btn-sm btn-block" name="import">Thêm</button>
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
        <h3 class="card-title">Danh sách quy cách</h3>
      </div>
        <div class="card-body">
          <div class="table-responsive">
          <table class="table table-hover table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                  <tr style="font-weight: bold;" align="center">
                    <td width="3%">STT</td>
                    <!-- <td width="3%">
                      <input type="checkbox" name="checkall" id="checkall">
                    </td> -->
                    <td width="15%">Mã quy cách</td>
                    <td width="15%">Tên quy cách</td>
                    <td width="15%">Net</td>
                    <td>Ghi chú</td>
                    <td width="15%">Chức năng</td>
                  </tr>
                </thead>
              <?php $_smarty_tpl->tpl_vars['i'] = new Smarty_variable(1, null, 0);?>
              <?php  $_smarty_tpl->tpl_vars['bk'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['bk']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['quycach']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['bk']->key => $_smarty_tpl->tpl_vars['bk']->value) {
$_smarty_tpl->tpl_vars['bk']->_loop = true;
?>
                <tr align="center">
                  <td><?php echo $_smarty_tpl->tpl_vars['i']->value++;?>
</td>
                  <td><?php echo $_smarty_tpl->tpl_vars['bk']->value->quycach_id;?>
</td>
                  <td><?php echo $_smarty_tpl->tpl_vars['bk']->value->quycach_name;?>
</td>
                  <td><?php echo $_smarty_tpl->tpl_vars['bk']->value->netweight;?>
</td>
                  <td><?php echo $_smarty_tpl->tpl_vars['bk']->value->note;?>
</td>
                  <td>
                    <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
quycach/card/<?php echo $_smarty_tpl->tpl_vars['bk']->value->quycach_id;?>
">
                      <i class="fas fa-credit-card">
                      </i>
                    </a>
                    <a style="color: #17a2b8" href="#" data-toggle="modal" data-target="#update<?php echo $_smarty_tpl->tpl_vars['bk']->value->quycach_id;?>
" style="cursor: pointer;" alt="Điều chỉnh">
                        <i class="fas fa-pencil-alt">
                        </i>
                    </a>
                    <a style="color: #da251d" href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
quycach/delete/<?php echo $_smarty_tpl->tpl_vars['bk']->value->quycach_id;?>
" onclick="return confirm('Bạn có chắc chắn xóa không?');">
                        <i class="fas fa-trash">
                        </i>
                    </a>
                  </td>
                </tr>
              <?php } ?>
            </table>
            </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
           <form action="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
quycach/dongbo" method="post">
            <div class="form-group">
                <button type="submit" name="import" class="btn btn-success btn-sm btn-block">Đồng bộ</button>
            </div>
          </form>
        </div>
        <!-- /.card-footer -->
    </div>
    <!-- card-info-->
  </div><!-- ./col-md-9-->
</div>
<?php  $_smarty_tpl->tpl_vars['bk'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['bk']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['quycach']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['bk']->key => $_smarty_tpl->tpl_vars['bk']->value) {
$_smarty_tpl->tpl_vars['bk']->_loop = true;
?>
<div class="modal fade" id="update<?php echo $_smarty_tpl->tpl_vars['bk']->value->quycach_id;?>
">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Điều chỉnh</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="form-horizontal" method="post" name="updatequycach" action="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
quycach/update">
        <input type="hidden" name="old_quycach_id" value="<?php echo $_smarty_tpl->tpl_vars['bk']->value->quycach_id;?>
">
        <div class="modal-body">
          <div class="form-group row">
            <label for="new_quycach_id" class="col-sm-2 col-form-label">Mã:</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="new_quycach_id" name="new_quycach_id" required maxlength="20" value="<?php echo $_smarty_tpl->tpl_vars['bk']->value->quycach_id;?>
" pattern="[A-Za-z0-9+-_]{2,}">
            </div>
          </div>
          <div class="form-group row">
            <label for="new_quycach_id" class="col-sm-2 col-form-label">Tên:</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="quycach_name" name="quycach_name" required maxlength="20" value="<?php echo $_smarty_tpl->tpl_vars['bk']->value->quycach_name;?>
">
            </div>
          </div>
          <div class="form-group row">
            <label for="netweight" class="col-sm-2 col-form-label">Net:</label>
            <div class="col-sm-10">
              <input type="number" class="form-control" id="netweight" name="netweight" required value="<?php echo $_smarty_tpl->tpl_vars['bk']->value->netweight;?>
" step="0.1">
            </div>
          </div>
          <div class="form-group row">
            <label for="note" class="col-sm-2 col-form-label">Ghi chú:</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" placeholder="Ghi chú" name="note" id="note" value="<?php echo $_smarty_tpl->tpl_vars['bk']->value->note;?>
">
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
    $("#quycach_id").focus();
    $('#dataTable').DataTable({
        stateSave: true
    });
  });
</script><?php }} ?>
