<?php /* Smarty version Smarty-3.1.16, created on 2024-02-01 02:41:09
         compiled from "C:\xampp\htdocs\application\views\warehouse\inventory.php" */ ?>
<?php /*%%SmartyHeaderCode:183524761165baf6b58bb616-93014934%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'dee5c87aa44e58852314130f8a3c704e31d7ec7c' => 
    array (
      0 => 'C:\\xampp\\htdocs\\application\\views\\warehouse\\inventory.php',
      1 => 1706241234,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '183524761165baf6b58bb616-93014934',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'base_url' => 0,
    'mes' => 0,
    'date' => 0,
    'warehouse_infor' => 0,
    'obj' => 0,
    'warehouse_id' => 0,
    'inventory' => 0,
    'i' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_65baf6b597eb19_18777902',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_65baf6b597eb19_18777902')) {function content_65baf6b597eb19_18777902($_smarty_tpl) {?><div class="row">
    <div class="col-md-3">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Thêm thủ công</h3>
            </div>
            <form action="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
warehouse/inventory" method="post">
                <div class="card-body">
                    <?php if ($_smarty_tpl->tpl_vars['mes']->value!='') {?>
                    <p class="mb-0" style="color: red;"><?php echo $_smarty_tpl->tpl_vars['mes']->value;?>
</p>
                    <?php }?>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Ngày</span>
                            </div>
                            <input type="date" class="form-control" id="date" name="date" value="<?php echo $_smarty_tpl->tpl_vars['date']->value;?>
" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Mã kho</span>
                            </div>
                            <select class="form-control" name="warehouse_id" id="warehouse_id">
                                <option value="">Tất cả</option>
                                <?php  $_smarty_tpl->tpl_vars['obj'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['obj']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['warehouse_infor']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['obj']->key => $_smarty_tpl->tpl_vars['obj']->value) {
$_smarty_tpl->tpl_vars['obj']->_loop = true;
?>
                                <option value="<?php echo $_smarty_tpl->tpl_vars['obj']->value->warehouse_id;?>
" <?php if ($_smarty_tpl->tpl_vars['warehouse_id']->value==$_smarty_tpl->tpl_vars['obj']->value->warehouse_id) {?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['obj']->value->warehouse_id;?>

                                    (<?php echo $_smarty_tpl->tpl_vars['obj']->value->quycach_name;?>
, <?php echo $_smarty_tpl->tpl_vars['obj']->value->product_name;?>
, <?php echo $_smarty_tpl->tpl_vars['obj']->value->size_name;?>
)</option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <div class="btn-group btn-block">
                        <button type="submit" class="btn btn-info btn-sm" name="view">Xem</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- col-md-3-->
    <div class="col-md-9">
        <form action="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
warehouse/kiemke" method="post">
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
                                    <td width="15%">Mã kho</td>
                                    <td>Quy cách</td>
                                    <td>Hàng hóa</td>
                                    <td>Size</td>
                                    <td>Nhập kho</td>
                                    <td>Xuất kho</td>
                                    <td>Tồn SL</td>
                                    <td>Net</td>
                                    <td>SUM Net</td>
                                    <td>Kiểm kê SL</td>
                                    <td>Kiểm kê KL</td>
                                </tr>
                            </thead>
                            <?php $_smarty_tpl->tpl_vars['i'] = new Smarty_variable(1, null, 0);?>
                            <?php  $_smarty_tpl->tpl_vars['obj'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['obj']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['inventory']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['obj']->key => $_smarty_tpl->tpl_vars['obj']->value) {
$_smarty_tpl->tpl_vars['obj']->_loop = true;
?>
                            <tr align="center">
                                <input type="hidden" class="form-control" name="warehouse_id[]"
                                    value="<?php echo $_smarty_tpl->tpl_vars['obj']->value->warehouse_id;?>
" />
                                <input type="hidden" class="form-control" name="remain[]"
                                    value="<?php echo $_smarty_tpl->tpl_vars['obj']->value->quantity_remain;?>
" />
                                <td><?php echo $_smarty_tpl->tpl_vars['i']->value++;?>
</td>
                                <td><?php echo $_smarty_tpl->tpl_vars['obj']->value->warehouse_id;?>
</td>
                                <td><?php echo $_smarty_tpl->tpl_vars['obj']->value->quycach_name;?>
</td>
                                <td><?php echo $_smarty_tpl->tpl_vars['obj']->value->product_name;?>
</td>
                                <td><?php echo $_smarty_tpl->tpl_vars['obj']->value->size_name;?>
</td>
                                <td><a
                                        href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
warehouse/inhistory/<?php echo $_smarty_tpl->tpl_vars['obj']->value->warehouse_id;?>
"><?php echo $_smarty_tpl->tpl_vars['obj']->value->quantity_in;?>
</a></td>
                                <td><a
                                        href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
warehouse/outhistory/<?php echo $_smarty_tpl->tpl_vars['obj']->value->warehouse_id;?>
"><?php echo $_smarty_tpl->tpl_vars['obj']->value->quantity_out;?>
</a>
                                </td>
                                <td><?php echo $_smarty_tpl->tpl_vars['obj']->value->quantity_remain;?>
</td>
                                <td><?php echo $_smarty_tpl->tpl_vars['obj']->value->netweight;?>
</td>
                                <td><?php echo $_smarty_tpl->tpl_vars['obj']->value->total_netweight;?>
</td>
                                <td width="10%">
                                    <input type="number" class="form-control" name="quantity[]"
                                        value="<?php echo $_smarty_tpl->tpl_vars['obj']->value->quantity_remain;?>
" min="0" />
                                </td>
                                <td width="10%">
                                    <input type="number" class="form-control" name="weight[]"
                                        value="0" min="0" step="0.01"/>
                                </td>
                            </tr>
                            <?php } ?>
                        </table>
                    </div>

                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <div class="btn-group btn-block">
                        <button type="submit" class="btn btn-info btn-sm" name="kiemke">Kiểm kê</button>
                    </div>
                </div>
        </form>
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
