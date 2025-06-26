<?php /* Smarty version Smarty-3.1.16, created on 2024-02-01 02:58:36
         compiled from "C:\xampp\htdocs\application\views\warehouse\out.php" */ ?>
<?php /*%%SmartyHeaderCode:210918496365bafacce683b1-25650137%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e281fb81ad2c0e67ea441a2342493b17c2120c81' => 
    array (
      0 => 'C:\\xampp\\htdocs\\application\\views\\warehouse\\out.php',
      1 => 1705929996,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '210918496365bafacce683b1-25650137',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'base_url' => 0,
    'mes' => 0,
    'reason_id' => 0,
    'warehouse_infor' => 0,
    'obj' => 0,
    'warehouse_id' => 0,
    'warehouse_out' => 0,
    'i' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_65bafaccf3b2f3_47025144',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_65bafaccf3b2f3_47025144')) {function content_65bafaccf3b2f3_47025144($_smarty_tpl) {?><div class="row">
    <div class="col-md-3">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Thêm thủ công</h3>
            </div>
            <form action="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
warehouse/out" method="post">
                <div class="card-body">
                    <?php if ($_smarty_tpl->tpl_vars['mes']->value!='') {?>
                    <p class="mb-0" style="color: red;"><?php echo $_smarty_tpl->tpl_vars['mes']->value;?>
</p>
                    <?php }?>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Mã lý do xuất</span>
                            </div>
                            <input type="text" class="form-control" placeholder="Mã lý do xuất" id="reason_id"
                                value="<?php echo $_smarty_tpl->tpl_vars['reason_id']->value;?>
" name="reason_id" required maxlength="20"
                                pattern="[A-Za-z0-9-_]{2,}" >
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Mã kho</span>
                            </div>
                            <select class="form-control" name="warehouse_id" id="warehouse_id">
                                <?php  $_smarty_tpl->tpl_vars['obj'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['obj']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['warehouse_infor']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['obj']->key => $_smarty_tpl->tpl_vars['obj']->value) {
$_smarty_tpl->tpl_vars['obj']->_loop = true;
?>
                                <option value="<?php echo $_smarty_tpl->tpl_vars['obj']->value->warehouse_id;?>
" <?php if ($_smarty_tpl->tpl_vars['warehouse_id']->value==$_smarty_tpl->tpl_vars['obj']->value->warehouse_id) {?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['obj']->value->warehouse_id;?>

                                    (Tồn <?php echo $_smarty_tpl->tpl_vars['obj']->value->quantity_in-$_smarty_tpl->tpl_vars['obj']->value->quantity_out;?>
, <?php echo $_smarty_tpl->tpl_vars['obj']->value->quycach_name;?>
, <?php echo $_smarty_tpl->tpl_vars['obj']->value->product_name;?>
, <?php echo $_smarty_tpl->tpl_vars['obj']->value->size_name;?>
)</option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Số lượng</span>
                            </div>
                            <input type="number" class="form-control" id="quantity" name="quantity" required value="1"
                                min="1">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Ghi chú</span>
                            </div>
                            <input type="text" class="form-control" placeholder="Ghi chú" id="note" name="note">
                        </div>
                    </div>
                   
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <div class="btn-group btn-block">
                    <button type="submit" class="btn btn-info btn-sm" name="view">Xem</button>
                        <button type="submit" class="btn btn-success btn-sm" name="out">Xuất</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- col-md-3-->
    <div class="col-md-9">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">
                    Danh sách
                </h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr style="font-weight: bold;" align="center">
                                <td width="2%">STT</td>
                                <td width="15%">Mã lý do xuất</td>
                                <td>Nội dung</td>
                                <td width="15%">Mã kho</td>
                                <td>Quy cách</td>
                                <td>Hàng hóa</td>
                                <td>Size</td>
                                <td>Số lượng</td>
                                <td width="15%">Chức năng</td>
                            </tr>
                        </thead>
                        <?php $_smarty_tpl->tpl_vars['i'] = new Smarty_variable(1, null, 0);?>
                        <?php  $_smarty_tpl->tpl_vars['obj'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['obj']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['warehouse_out']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['obj']->key => $_smarty_tpl->tpl_vars['obj']->value) {
$_smarty_tpl->tpl_vars['obj']->_loop = true;
?>
                        <tr align="center">
                            <td><?php echo $_smarty_tpl->tpl_vars['i']->value++;?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['obj']->value->reason_id;?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['obj']->value->reason_description;?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['obj']->value->warehouse_id;?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['obj']->value->quycach_name;?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['obj']->value->product_name;?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['obj']->value->size_name;?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['obj']->value->quantity;?>
</td>
                            <td>
                                <a style="color: #da251d"
                                    href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
warehouse/out_delete/<?php echo $_smarty_tpl->tpl_vars['obj']->value->reason_id;?>
/<?php echo $_smarty_tpl->tpl_vars['obj']->value->warehouse_id;?>
"
                                    onclick="return confirm('Bạn có chắc chắn xóa không?');">
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

            </div>
            <!-- /.card-footer -->
        </div>

    </div>
    <!-- col-md-8-->
</div>

<script>
    $(document).ready(function () {
        $("#size_id").focus();
        $("#warehouse_id").select2();

        $("#dataTable").DataTable({
            stateSave: true
        });
    });
</script><?php }} ?>
