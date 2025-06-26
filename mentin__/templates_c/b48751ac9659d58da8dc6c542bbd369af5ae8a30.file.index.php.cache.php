<?php /* Smarty version Smarty-3.1.16, created on 2023-03-02 09:45:34
         compiled from "C:\xampp\htdocs\demo\application\views\product\index.php" */ ?>
<?php /*%%SmartyHeaderCode:42904759163ec92abc5b772-36631541%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b48751ac9659d58da8dc6c542bbd369af5ae8a30' => 
    array (
      0 => 'C:\\xampp\\htdocs\\demo\\application\\views\\product\\index.php',
      1 => 1677742544,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '42904759163ec92abc5b772-36631541',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_63ec92abcec8d1_85647183',
  'variables' => 
  array (
    'base_url' => 0,
    'parent_id' => 0,
    'mes' => 0,
    'product' => 0,
    'i' => 0,
    'pr' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_63ec92abcec8d1_85647183')) {function content_63ec92abcec8d1_85647183($_smarty_tpl) {?><div class="row">
  <div class="col-md-3">
    <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title">Thêm thủ công</h3>
      </div>
      <form action="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
product/insert" method="post">
        <input type="hidden" name="parent_id" value="<?php echo $_smarty_tpl->tpl_vars['parent_id']->value;?>
">
        <div class="card-body">
          <?php if ($_smarty_tpl->tpl_vars['mes']->value!='') {?>
          <p class="mb-0" style="color: red;"><?php echo $_smarty_tpl->tpl_vars['mes']->value;?>
</p>
          <?php }?>
          <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Mã sản phẩm" id="product_id" name="product_id"required maxlength="20" pattern="[A-Za-z0-9-_]{3,}">
          </div>
          <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Tên sản phẩm" name="product_name">
          </div>
          <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="KL min" name="weight_min" value="0">
          </div>
          <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="KL max" name="weight_max" value="0">
          </div>
          <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Khách hàng" name="note">
          </div>
          <div class="form-group">
            <label>Liên kết</label>
            <select class="form-control select2" style="width: 100%;" name="linkable">
              <option value="0" selected="selected">Không</option>
              <option value="1">Có</option>
            </select>
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
    <?php if ($_smarty_tpl->tpl_vars['parent_id']->value!="0") {?>
    <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title">Thêm từ Excel</h3>
      </div>
      <form action="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
product/import" method="post" enctype="multipart/form-data">
        <input type="hidden" name="parent_id" value="<?php echo $_smarty_tpl->tpl_vars['parent_id']->value;?>
">
        <div class="card-body">
          <div class="form-group">
            <div class="input-group">
              <input type="file" class="form-control" id="file_xls" name="file_xls" placeholder="Chọn file excel chứa dữ liệu" accept=".xls" required>
            </div>
            <div class="input-group">
              <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
product.xls">Tải mẫu</a>
            </div>
          </div>
          <div class="form-group">
            <label>
              <input type="checkbox" name="thaythe" value="1">Thay thế
            </label>
          </div>
          <div class="form-group">
            <button type="submit" name="import" class="btn btn-success btn-sm btn-block">Thêm</button>
          </div>
          <!-- /input-group -->
        </div>
        <!-- /.card-body -->
        
      </form>
    </div>
    <!-- card-info-->
    <?php }?>
  </div>
  <!-- col-md-3-->
  <div class="col-md-9">
    <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title">
            Danh sách sản phẩm <?php if ($_smarty_tpl->tpl_vars['parent_id']->value!="0") {?><?php echo $_smarty_tpl->tpl_vars['parent_id']->value;?>
<?php }?>
        </h3>
      </div>
      <div class="card-body">
      <div class="table-responsive">
        <table class="table table-hover table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr style="font-weight: bold;" align="center">
              <td width="2%">STT</td>
              <td width="15%">Mã</td>
              <td width="30%">Sản phẩm</td>
              <td>KL min</td>
              <td>KL max</td>
              <td>Khách hàng</td>
              <td width="15%">Chức năng</td>
            </tr>
          </thead>
          <?php $_smarty_tpl->tpl_vars['i'] = new Smarty_variable(1, null, 0);?>
          <?php  $_smarty_tpl->tpl_vars['pr'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['pr']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['product']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['pr']->key => $_smarty_tpl->tpl_vars['pr']->value) {
$_smarty_tpl->tpl_vars['pr']->_loop = true;
?>
            <tr align="center">
              <td><?php echo $_smarty_tpl->tpl_vars['i']->value++;?>
</td>
              <td><?php echo $_smarty_tpl->tpl_vars['pr']->value->product_id;?>
</td>
              <?php if ($_smarty_tpl->tpl_vars['pr']->value->parent_id=="0") {?>
              <td><a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
product/view/<?php echo $_smarty_tpl->tpl_vars['pr']->value->product_id;?>
"><?php echo $_smarty_tpl->tpl_vars['pr']->value->product_name;?>
</a></td>
              <?php } else { ?>
              <td><?php echo $_smarty_tpl->tpl_vars['pr']->value->product_name;?>
 <?php if ($_smarty_tpl->tpl_vars['pr']->value->hidden==1) {?>(Ẩn)<?php }?></td>
              
              <?php }?>
              <td><?php echo $_smarty_tpl->tpl_vars['pr']->value->weight_min;?>
</td>
              <td><?php echo $_smarty_tpl->tpl_vars['pr']->value->weight_max;?>
</td>
              <td><?php echo $_smarty_tpl->tpl_vars['pr']->value->note;?>
 <?php if ($_smarty_tpl->tpl_vars['pr']->value->linkable==1) {?>Được liên kết<?php }?></td>
              <td>
                <?php if ($_smarty_tpl->tpl_vars['pr']->value->parent_id!="0") {?>
                <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
product/card/<?php echo $_smarty_tpl->tpl_vars['pr']->value->product_id;?>
">
                    <i class="fas fa-credit-card">
                    </i>
                </a>
                <?php }?>
                <a style="color: #17a2b8" href="#" data-toggle="modal" data-target="#update<?php echo $_smarty_tpl->tpl_vars['pr']->value->product_id;?>
" style="cursor: pointer;" alt="Điều chỉnh">
                    <i class="fas fa-pencil-alt">
                    </i>
                </a>
                <?php if ($_smarty_tpl->tpl_vars['pr']->value->has_child=='') {?>
                <a style="color: #da251d" href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
product/delete/<?php echo $_smarty_tpl->tpl_vars['pr']->value->product_id;?>
/<?php echo $_smarty_tpl->tpl_vars['pr']->value->parent_id;?>
" 
                onclick="return confirm('Bạn có chắc chắn xóa không?');">
                    <i class="fas fa-trash">
                    </i>
                </a>
                <?php }?>
              </td>
            </tr>
          <?php } ?>
        </table>
      </div>
      </div>
      <!-- /.card-body -->
      <div class="card-footer">
          
      </div>
        <!-- /.card-footer -->
    </div>

  </div>
  <!-- col-md-8-->
</div>
<?php  $_smarty_tpl->tpl_vars['pr'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['pr']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['product']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['pr']->key => $_smarty_tpl->tpl_vars['pr']->value) {
$_smarty_tpl->tpl_vars['pr']->_loop = true;
?>
<div class="modal fade" id="update<?php echo $_smarty_tpl->tpl_vars['pr']->value->product_id;?>
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
product/update">
        <input type="hidden" name="parent_id" value="<?php echo $_smarty_tpl->tpl_vars['parent_id']->value;?>
">
        <input type="hidden" name="old_product_id" value="<?php echo $_smarty_tpl->tpl_vars['pr']->value->product_id;?>
">
        <div class="modal-body">
          <div class="form-group row">
            <label for="new_product_id" class="col-sm-4 col-form-label">Mã:</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" placeholder="Mã sản phẩm" id="new_product_id" name="new_product_id" required maxlength="20" value="<?php echo $_smarty_tpl->tpl_vars['pr']->value->product_id;?>
" pattern="[A-Za-z0-9+-_]{3,}">
            </div>
          </div>
          <div class="form-group row">
            <label for="product_name" class="col-sm-4 col-form-label">Tên:</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" placeholder="Tên sản phẩm" id="product_name" name="product_name" required value="<?php echo $_smarty_tpl->tpl_vars['pr']->value->product_name;?>
">
            </div>
          </div>
          <div class="form-group row">
            <label for="product_name" class="col-sm-4 col-form-label">KL min:</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" placeholder="KL min" id="weight_min" name="weight_min" required value="<?php echo $_smarty_tpl->tpl_vars['pr']->value->weight_min;?>
">
            </div>
          </div> <div class="form-group row">
            <label for="product_name" class="col-sm-4 col-form-label">KL max:</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" placeholder="KL max" id="weight_max" name="weight_max" required value="<?php echo $_smarty_tpl->tpl_vars['pr']->value->weight_max;?>
">
            </div>
          </div>
          <div class="form-group row">
            <label for="note" class="col-sm-4 col-form-label">Ghi chú:</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" placeholder="Ghi chú" name="note" id="note" value="<?php echo $_smarty_tpl->tpl_vars['pr']->value->note;?>
">
            </div>
          </div>
          <div class="form-group row">
            <label for="linkable" class="col-sm-4 col-form-label">Liên kết:</label>
            <div class="col-sm-8">
              <select class="form-control select2" style="width: 100%;" id="linkable" name="linkable">
                <option value="0" selected="selected" <?php if ($_smarty_tpl->tpl_vars['pr']->value->linkable==0) {?>selected<?php }?>>Không</option>
                <option value="1" <?php if ($_smarty_tpl->tpl_vars['pr']->value->linkable==1) {?>selected<?php }?>>Có</option>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label for="linkable" class="col-sm-4 col-form-label">Ẩn</label>
            <div class="col-sm-8">
              <select class="form-control select2" style="width: 100%;" id="hidden" name="hidden">
                <option value="0" selected="selected" <?php if ($_smarty_tpl->tpl_vars['pr']->value->hidden==0) {?>selected<?php }?>>Không</option>
                <option value="1" <?php if ($_smarty_tpl->tpl_vars['pr']->value->hidden==1) {?>selected<?php }?>>Có</option>
              </select>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
          <button type="submit" class="btn btn-primary" id="capnhat">Cập nhật</button>
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<?php } ?>
<script>
  $( document ).ready(function() {
    $("#product_id" ).focus();
    $("#dataTable").DataTable({
        stateSave: true
    });
  });
  $(function () {
    $('.select2').select2()
  })
</script><?php }} ?>
